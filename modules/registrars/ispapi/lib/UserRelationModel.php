<?php

namespace WHMCS\Module\Registrar\Ispapi;

class UserRelationModel extends \Illuminate\Database\Eloquent\Model
{
    /**
     * The table associated with the user relation model.
     *
     * @var string
     */
    protected $table = "ispapi_tblrelations";
    public $timestamps = false;
    protected $fillable = ["relation_type", "relation_value", "relation_category",  "relation_subcategory", "relation_subclass", "relation_period"];

    //NOTE: filter out >>special<< IDN TLDs for now
    // * <TLD>IDN e.g. /^xn--[a-z0-9\-]+\.jp$/
    // * <TLD>IDNTLD e.g. /^xn--[a-z0-9\-]+\.(xn--fiqs8s|xn–fiqz9s)$/
    // * <TLD>IDNTLDASCII e.g. /^(..[^\-][a-z0-9\-]*|...[^\-][a-z0-9\-]*|.{1,3})\.(xn--fiqs8s|xn–fiqz9s)$/
    // * XN--.+<TLD> e.g. /^[^.]+\.xn--4it797k\.jp$/
    // * XN--.+<TLD>IDN e.g. /^xn--[a-z0-9\-]+\.xn--4it797k\.jp$/
    // we will work on a solution for that on customer demand as it is bound to expected huge effort, so for now
    // just XN--.+ is allowed with no special cases
    public static $tldclassfilter = "(MANDATE--SWISS|TESTDNSERVICESCOZA|TLDBOX|NAME|NAMEEMAIL|DPMLPUB|DPMLZONE|[^_]+(REGIONAL|IDN|IDNTLD|IDNTLDASCII|(CHARS|NUMBERS)[0-9]*)|XN--.+JP)";
    public static $categoryRegexp = "(DOMAIN_PREMIUM|PAYMENT|SERVICE_USAGE|DNSZONE|SSLCERT|VSERVER|DSERVER|DOMAIN|TRUSTEE_DOMAIN|MANAGED_DOMAIN|INVOICE|TMCHMARK|DOMAINALERT|PREMIUMDNS|MOBILE|WEBSITE|PROXY_WHOISPROXY)";

    public static function hasTable()
    {
        return \WHMCS\Database\Capsule::schema()->hasTable("ispapi_tblrelations");
    }

    public static function createTableIfNotExists()
    {
        if (!self::hasTable()) {
            \WHMCS\Database\Capsule::schema()->create("ispapi_tblrelations", function ($table) {
                /** @var \Illuminate\Database\Schema\Blueprint $table */
                $table->string("relation_subclass")->index();
                $table->string("relation_value");
                $table->string("relation_category")->index();
                $table->string("relation_subcategory")->index();
                $table->string("relation_type")->index()->unique()->primary();
                $table->tinyInteger("relation_period")->nullable();
                $table->charset = "utf8";
                $table->collation = "utf8_unicode_ci";
            });
        } else {
            // v4.2.1 missing primary key index
            $pdo = \WHMCS\Database\Capsule::connection()->getPdo();
            $pdo->beginTransaction();
            try {
                $statement = $pdo->prepare("SELECT constraint_name FROM information_schema.table_constraints WHERE table_name = 'ispapi_tblrelations' AND constraint_name = 'PRIMARY'");
                if ($statement->execute()) {
                    $result = $statement->fetch(\PDO::FETCH_ASSOC);
                    if (!$result["constraint_name"]) {
                        $statement = $pdo->prepare("DROP TABLE ispapi_tblrelations");
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

    public static function insertFromAPI($apiresponse)
    {
        $inserts = [];
        if (isset($apiresponse["PROPERTY"])) {
            $apiresponse = $apiresponse["PROPERTY"];
        }
        foreach ($apiresponse["RELATIONTYPE"] as $idx => &$t) {
            $insert = [
                "relation_type" => $t,
                "relation_value" => $apiresponse["RELATIONVALUE"][$idx],
                "relation_category" => self::parseRelationCategory($t),
                "relation_subclass" => self::parseRelationSubclass($t),
                "relation_period" => self::parsePeriod($t)
            ];
            $insert["relation_subcategory"] = self::parseRelationSubcategory($t, $insert["relation_category"]);
            $inserts[] = $insert;
        }
        foreach (array_chunk($inserts, 1000) as $t) {
            self::insert($t);
        }
    }

    private static function parseRelationCategory($type)
    {
        if (preg_match("/^PRICE_CLASS_" . self::$categoryRegexp . "_/", $type, $m)) {
            return str_replace("_", "", $m[1]) . "_PRICE";
        }
        if (preg_match("/^" . self::$categoryRegexp . "_/", $type, $m)) {
            return str_replace("_", "", $m[1]) . "_CONFIG";
        }
        return "";
    }

    private static function parseRelationSubcategory($type, $category)
    {
        if ($category === "DOMAIN_PRICE") {
            if (preg_match("/^PRICE_CLASS_DOMAIN_[^_]+_DPML(PUB|ZONE)_/", $type)) {
                return "DPML";
            }
            if (preg_match("/^PRICE_CLASS_DOMAIN_[^_]+_(EOI|EARLYACCESS[0-9]+|GOLIVE|SUNRISE|LANDRUSH)_/", $type)) {
                return "PREREG";
            }
            if (preg_match("/([^_]+_(PROMO|SCALE))[0-9]*$/", $type, $m)) {
                return preg_replace("/[0-9]+/", "", $m[1]); //SETUP<p>_PROMO, SETUP_SCALE<p>
            }
            if (preg_match("/^PRICE_CLASS_DOMAIN_[^_]+_(ANNUAL|[^_]+ACKORDER|CURRENCY|RESTORE|SETUP|TRADE|TRANSFER)([0-9]*|_.+)$/", $type, $m)) {
                return $m[1];
            }
        }
        if ($category === "DOMAINPREMIUM_PRICE") {
            if (preg_match("/([^_]+_(PROMO|SCALE))[0-9]*$/", $type, $m)) {
                return preg_replace("/[0-9]+/", "", $m[1]); //SETUP<p>_PROMO, SETUP_SCALE<p>
            }
            if (preg_match("/^PRICE_CLASS_DOMAIN_PREMIUM_.+_(ANNUAL|[^_]+ACKORDER|CURRENCY|RESTORE|SETUP|TRADE|TRANSFER)([0-9]*|_.+)$/", $type, $m)) {
                return $m[1];
            }
            if (preg_match("/^PRICE_CLASS_DOMAIN_PREMIUM_.+_(EOI|EARLYACCESS[0-9]+|GOLIVE|SUNRISE|LANDRUSH)_/", $type)) {
                return "PREREG";
            }
        }
        //To Be Extended
        return "";
    }

    private static function parseRelationSubclass($t)
    {
        if (preg_match("/^PRICE_CLASS_([^_]+_)?DOMAIN_([^_]+)_/", $t, $m)) {
            return $m[2];
        }
        return "";
    }

    private static function parsePeriod($relationType)
    {
        if (preg_match("/_[^_0-9]+([0-9]+)(_PROMO)?$/", $relationType, $m)) {
            return (int)$m[1];
        }
        return null;
    }

    public static function getDomainPriceRelations($subcatregex = "^(TRANSFER|SETUP|CURRENCY|ANNUAL|RESTORE)[0-9]*$", $excludefilter = null, $inclregex = null)
    {
        $excl = is_null($excludefilter) ? self::$tldclassfilter : $excludefilter;
        $r = self::where("relation_category", "DOMAIN_PRICE")
            ->whereRaw("relation_subcategory REGEXP '" . $subcatregex . "'")
            ->whereRaw("relation_subclass NOT REGEXP '^" . $excl . "$'");
        if (!is_null($inclregex)) {
            $r->whereRaw("relation_subclass REGEXP '^" . $inclregex . "$'");
        }
        return $r->get();
    }

    public function getPeriod()
    {
        return is_null($this->relation_period) ? "default" : $this->relation_period;
    }
}
