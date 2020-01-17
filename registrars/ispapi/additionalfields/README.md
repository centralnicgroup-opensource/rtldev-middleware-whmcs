# Additional domain fields in WHMCS

The default list of **default WHMCS' additional domain fields** can be found under `/resources/domain/dist.additionalfields.php`.

Don **NOT** modify this file as it will be probably overwritten by WHMCS Upgrades.

Target of this documentation is to basically combine the standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields) with the extensions for the HEXONET/ISPAPI provider module.

## Uniqueness of domain fields

The property `Name` in the additional domain fields is used as unique identifier. Thus you have to specify it **ALWAYS**, when you introduce your custom fields or when overriding/removing existing WHMCS' additional fields.

When you have to introduce a new custom field, ensure that the value for property `Name` doesn't already exist in the the default list mentioned above.

## Activate OUR default additional fields configuration

Nothing you need to care about. Method `_AdditionalDomainFields` of this registrar module cares about everything you need.
If you have already the custom additional domainfields override file in use which is located under `/resources/domain/additionalfields.php`, please remove the entire file if you're just using us as registrar.
If you have there also TLD configurations for other registrars, be so kind to just cleanup TLD configurations affecting TLDs offered over us.

**NOTE:** We have **no** Local Presence Service activated by default, because of [this issue](https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on).
This could lead to loosing money on your side, when not having the Local Presence Service Fee included in the domain prices.
Please have a further read [here](#local-presence-trustee-service).

## Customizing additional domain fields

In general it depends on who introduced the additional field you want to customize or to deactivate. If an addtional domain field is required to register a domain over us / registrar `ispapi` and is not provided by **OUR** default configuration, then open a github issue and let us know. If there's an issue with **OUR** default configuration, also open a github issue. We will care about such cases in short!

If, for any reason, you'll have to apply custom changes to our built-in configuration, please also open a github issue so that we can check if we can change our default configuration in that direction.

Any other customizing of additional domain fields on customer's side should happen in `/resources/domain/additionalfields.php` which again can be used to overwrite our defaults. You can follow the steps described in the standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields) to get this realized.

## Developer Resources

Our tld-specific configuration files are located under `/modules/registrars/ispapi/additionalfields/register` for registration-related fields and under `/modules/registrars/ispapi/additionalfields/transfer` for transfer-related fields.

**NOTE:** Customers should **NEVER** apply changes to these files as they might get overwritten by registrar module upgrades. HEXONET' developers can of course do that when fixing bugs or adding new fields which will then be included in next registrar module release.

**NOTE:** Our configuration is quite dynamic. We do not specify the domain name extension in the configuration like WHMCS' is doing it e.g.

**NOTE:** WHMCS up to now, doesn't reflect the correct type in $params["type"], so that it is impossible to distinguish between transfers and registrations up to now. When this is fixed, everything will correctly work on our side.

> **```$additionaldomainfields[$tld]``` (our notation) vs. ```$additionaldomainfields[".ca"]``` (WHMCS)**

### Introducing a new TLD

Just create a new tld-specific file like `uk.php` or `co.uk.php`. Of course the logic already starts here...

* Case 1: 2nd level extension requires additional fields, 3rd level extension not
  -> Just create empty files for the 3rd level extensions. This might of course be a corner-case, so just documenting it here
* Case 2: 2nd level extension AND 3rd level extensions share the additional fields configuration
  -> Just create a configuration file for the 2nd level extension. It will be reused for the 3rd level extensions too.
* Case 3: 2nd level extension does not require additional fields, 3rd level extensions do.
  -> Just create configuration files for the 3rd level extensions.

**NOTE:** If you want to reuse configurations, move the parts you want to share into separate files which start with `_` (underscore) in file name. Finally include them again.
Existing examples are `_acceptregistrationtac.php`, `_highlyregulatedtld.php` and `_intendeduse.php`.

### Deactivating a default WHMCS' field

Some of the default fields might be deprecated and thus deactivating them, is useful.

1. Open `/resources/domain/dist.additionalfields.php` and search for the domain extension e.g. `.ca`
2. Copy the field configuration you want to remove into clipboard
3. Insert it into the tld-specific configuration file
4. Modify the configuration to follow the below snippet:

   ```php
   $additionaldomainfields[$tld][] = [
    'Name' => 'CIRA Agreement',
    "Remove" => true
   ];
   ```

   So, by just keeping property `Name` and adding property `Remove` and setting its value to `true`. Replace the domain extension key name by `$tld`.

### Editing a default WHMCS' field

1. Open `/resources/domain/dist.additionalfields.php` and search for the domain extension e.g. `.ca`
2. Copy the field configuration you want to customize into clipboard
3. Insert it into the tld-specific configuration file
4. Modify the configuration as desired - note:
   * key-value pairs you do not want to change, just remove
   * key-value pairs you want to modify, keep them and customize them (see standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields))
5. Replace the domain extension key name by `$tld`.

There's no possibility to just deactivate a key-value pair, you can just overwrite them.

### Adding a new additional field

1. Open `/resources/domain/dist.additionalfields.php` and look for a similar configuration field
2. Copy the field configuration into clipboard
3. Insert it into the tld-specific configuration file
4. Modify the configuration as desired
5. Replace the domain extension key name by `$tld`.

(see standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields))

### Local Presence / Trustee Service

As a Local Presence service is not free of charge and WHMCS does not offer a generic domain addon to offer it as a kind of service, you as reseller have to care about the configuration manually. We decided to not activate the local presence service by default in our additional fields, as you as reseller might lose money if you don't add the service fee to the domain registration price configuration. We have prepared things to support you as far as possible, e.g. Local Presence Service for .it:

Open file `/modules/registrars/ispapi/additionalfields/register/it.php`, you'll find the below comment block:

```php
## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
##
## When you uncomment the Local Presence service:
## - mark X-IT-ACCEPT-LIABILITY-TAC as not required
## - mark X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC as not required
## - mark X-IT-ACCEPT-EXPLICIT-TAC as not required
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant is domiciled in the EU (PIN required) / Use Local Presence Service",
    "Default" => "",
    "Ispapi-Name" => "X-IT-ACCEPT-TRUSTEE-TAC"
);
*/
```

All you have to do to get the Local Presence Service working, is to

* Add the trustee service price to your domain registration prices for the appropriate TLD
* uncomment the additional field configuration (`X-<TLD>-ACCEPT-TRUSTEE-TAC`)
* ensure all the other mentioned additional fields are configured as not required

Enjoy!

### ISPAPI specific configuration settings

#### Ispapi-Name

This property covers the so-called extension flag name of the additional domain field in our backend system API e.g.

```php
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Ispapi-Name" => "X-CA-LEGALTYPE",
    // ...
];
```

#### Ispapi-Options [REMOVED by v3.0.0]

Removed in favour of the more compact piped notation WHMCS now allows in property `options`.
Specify here values for dropdown lists / fields that should reach our backend system API. The index of the value provided here has to correspond to the one specified in property `Options`. e.g.:

```php
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Options" => implode(",", [
        "Corporation",
        "Canadian Citizen",
        // ...
        "Her Majesty the Queen"
    ]),
    "Ispapi-Options" => implode(",", [
        "CCO",
        "CCT",
        // ...
        "MAJ"
    ]),
    "Ispapi-Name" => "X-CA-LEGALTYPE",
];
```

Replace the above by

```php
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Options" => implode(",", [
        "CCO|Corporation",
        "CCT|Canadian Citizen",
        // ...
        "MAJ|Her Majesty the Queen"
    ]),
    "Ispapi-Name" => "X-CA-LEGALTYPE",
];
```

The values have to be provided as comma-separated string. For better visualization and maintenance, we just concatenate array entries with comma.

#### Ispapi-IgnoreForCountries

Specify a comma-separated list of countries for which this field should get ignored before sending it to our backend system API.

The list will then be compared to registrant's country which is provided by WHMCS in `$params["country"]` in the appropriate registrar module methods.

```php
$additionaldomainfields[$tld][] = [
    //...
    "Ispapi-IgnoreForCountries" => ['AT','BE','BG']
];
```

> In v3.x.x this parameter changed from type string to array to remove extra code in our registrar module.

#### Ispapi-Format

This will auto-format the additional field's value in the format of choice before it is being added to the backend system API command.

Supported values: `UPPERCASE` (to be extended on demand), e.g.

```php
$additionaldomainfields[$tld][] = [
    //...
    "Ispapi-Format" => "UPPERCASE"
];
```

#### Ispapi-Replacements [REMOVED by v3.0.0]

If the parameter value is a valid key of this array, it gets replaced by the respective value. Indirect use via Ispapi-Options is preferred, direct use makes sense to map older values for backward compatibility.

> This config property has been removed in favour of `Options` setting.

#### Ispapi-Eval [REMOVED by v3.0.0]

PHP code to execute short before additional domain fields value (`$value`) will be applied to the backend system API command.
Provide it as _string_. Thought for manipulating that value manually for any reason.

> For security reasons (**even though no security issue was known**), we decided to deprecate and remove this setting. "Eval is evil!"

Replaced by `Ispapi-Format`.
