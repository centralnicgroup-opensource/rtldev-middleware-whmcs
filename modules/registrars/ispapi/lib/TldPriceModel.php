<?php

namespace WHMCS\Module\Registrar\Ispapi;

class TldPriceModel extends \Illuminate\Database\Eloquent\Model
{
    /**
     * The table associated with the user relation model.
     *
     * @var string
     */
    protected $table = "ispapi_tblprices";
    public $timestamps = false;
    protected $fillable = ["tldclass", "prices"];
    public static $exrates = null;

    //NOTE: filter out IDN TLDs as not yet officially supported by WHMCS (first part of regex)

    public static function hasTable()
    {
        return \WHMCS\Database\Capsule::schema()->hasTable("ispapi_tblprices");
    }

    public static function createTableIfNotExists()
    {
        if (!self::hasTable()) {
            \WHMCS\Database\Capsule::schema()->create("ispapi_tblprices", function ($table) {
                /** @var \Illuminate\Database\Schema\Blueprint $table */
                $table->string("tldclass")->index()->unique()->primary();
                // v3.0.2 maria db not supporting type json
                $table->longText("prices")->nullable();
                $table->charset = "utf8";
                $table->collation = "utf8_unicode_ci";
            });
        } else {
            // v3.0.2 maria db not supporting type json
            // method getColumnType not available for use
            $pdo = \WHMCS\Database\Capsule::connection()->getPdo();
            $pdo->beginTransaction();
            try {
                $statement = $pdo->prepare("ALTER TABLE `ispapi_tblprices` MODIFY `prices` LONGTEXT");
                $statement->execute();
                $pdo->commit();
            } catch (\Exception $e) {
                $pdo->rollBack();
            }
            // v4.2.1 missing primary key index
            $pdo->beginTransaction();
            try {
                $statement = $pdo->prepare("SELECT constraint_name FROM information_schema.table_constraints WHERE table_name = 'ispapi_tblprices' AND constraint_name = 'PRIMARY'");
                if ($statement->execute()) {
                    $result = $statement->fetch(\PDO::FETCH_ASSOC);
                    if (!$result["constraint_name"]) {
                        $statement = $pdo->prepare("DROP TABLE ispapi_tblprices");
                        $statement->execute();
                        self::createTableIfNotExists();
                    }
                }
                $pdo->commit();
            } catch (\Exception $e) {
                $pdo->rollBack();
            }
        }
    }

    public static function insertFromRelations($relations, $apiAccountCurrency)
    {
        $inserts = [];
        foreach ($relations as $relation) {
            $tldcl = $relation->relation_subclass;
            if (!isset($inserts[$tldcl])) {
                $inserts[$tldcl] = [
                    "tldclass" => $tldcl,
                    "prices" => [
                        "currency" => $apiAccountCurrency
                    ]
                ];
            }
            $sc = strtolower($relation->relation_subcategory);
            if ($sc === "currency") {
                $inserts[$tldcl]["prices"][$sc] = $relation->relation_value;
                continue;
            }
            if (!isset($inserts[$tldcl]["prices"][$sc])) {
                $inserts[$tldcl]["prices"][$sc] = [];
            }

            if ($relation->relation_value === "") {
                $inserts[$tldcl]["prices"][$sc][$relation->getPeriod()] = -1;//block / unsupported
            } else {
                $inserts[$tldcl]["prices"][$sc][$relation->getPeriod()] = (float)$relation->relation_value;
            }
        }
        foreach ($inserts as &$i) {
            $i["prices"] = json_encode($i["prices"]);
        }
        foreach (array_chunk($inserts, 1000) as $t) {
            self::insert($t);
        }
    }

    public static function setExchangeRates($rates)
    {
        self::$exrates = $rates;
    }

    public static function getTLDPrices($tldclassmap, $cfgs)
    {
        $results = [];
        foreach ($tldclassmap as $tldcl => $tld) {
            $row = self::where("tldclass", $tldcl)->first();
            if ($row && isset($cfgs[$tld])) {
                $results[$tld] = $row->getPrices($cfgs[$tld]->periods["registration"][0]);
            }
        }
        return $results;
    }

    public static function getWHMCSDefaultCurrency()
    {
        static $defaultcurrency = null;
        if (!$defaultcurrency) {
            $vals = get_query_vals("tblcurrencies", "code", ["`default`" => "1"]);
            $defaultcurrency = $vals["code"];
        }
        return $defaultcurrency;
    }

    public function getPrices($minPeriod)
    {
        // default prices
        $prices = [
            "registration" => $this->getRegistrationPrice($minPeriod),
            "renewal" => $this->getRenewalPrice($minPeriod),
            "transfer" => $this->getTransferPrice($minPeriod),
            "redemption" => $this->getRedemptionPrice($minPeriod)
        ];
        // load WHMCS default currency
        $defaultcurrency = self::getWHMCSDefaultCurrency();

        // convert prices to default currency
        foreach ($prices as $key => $val) {
            if ($val !== null) {
                $prices[$key] = self::convertCurrency($val, $this->prices["currency"], $defaultcurrency);
            }
        }
        return array_merge($prices, [
            "grace" => null,
            "currency" => $defaultcurrency
        ]);
    }

    public static function convertCurrency($val, $currFrom, $currTo)
    {
        return ($val / self::$exrates[$currFrom]) * self::$exrates[$currTo];
    }

    public function setPricesAttribute($value)
    {
        $this->attributes["prices"] = json_encode($value);
    }

    public function getPricesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getRegistrationPrice($period)
    {
        if (
            (isset($this->prices["setup"][$period]) && $this->prices["setup"][$period] === -1)
            || (isset($this->prices["setup"]["default"]) && $this->prices["setup"]["default"] === -1)
        ) {
            return null;
        }
        if (isset($this->prices["setup"][$period]) && isset($this->prices["annual"][$period])) {
            return ($this->prices["setup"][$period] + $this->prices["annual"][$period]);
        }
        if (isset($this->prices["setup"]["default"]) && isset($this->prices["annual"]["default"])) {
            return ($this->prices["setup"]["default"] + ($period * $this->prices["annual"]["default"]));
        }
        return null;
    }

    public function getRenewalPrice($period)
    {
        if (
            (isset($this->prices["annual"][$period]) && $this->prices["annual"][$period] === -1)
            || (isset($this->prices["annual"]["default"]) && $this->prices["annual"]["default"] === -1)
        ) {
            return null;
        }
        if (isset($this->prices["annual"][$period])) {
            return $this->prices["annual"][$period];
        }
        if (isset($this->prices["annual"]["default"])) {
            return ($period * $this->prices["annual"]["default"]);
        }
        return null;
    }

    public function getTransferPrice($period)
    {
        if (
            (isset($this->prices["transfer"][$period]) && $this->prices["transfer"][$period] === -1)
            || (isset($this->prices["transfer"]["default"]) && $this->prices["transfer"]["default"] === -1)
        ) {
            return null;
        }
        if (isset($this->prices["transfer"][$period])) {
            return $this->prices["transfer"][$period];
        }
        if (isset($this->prices["transfer"]["default"])) {
            return ($period * $this->prices["transfer"]["default"]);
        }
        return null;
    }

    public function getRedemptionPrice($period)
    {
        if (isset($this->prices["restore"]["default"]) && $this->prices["restore"]["default"] === -1) {
            return null;
        }
        if (isset($this->prices["restore"]["default"])) {
            return $this->prices["restore"]["default"];
        }
        return null;
    }
}
