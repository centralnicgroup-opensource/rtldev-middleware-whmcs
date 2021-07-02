# Additional domain fields in WHMCS

The default list of **default WHMCS' additional domain fields** can be found under `/resources/domain/dist.additionalfields.php`. Do **NOT** modify this file as it will be probably overwritten by WHMCS Upgrades.

Custom additional fields configurations could be applied in the past by keeping them in file `/resources/domain/additionalfields.php` (prior to WHMCS 7.0 `/includes/additionaldomainfields.php`), we refer to that file by OVERRIDEFILE below. The new and better way is to use method `_AdditionalDomainFields` of the registrar module which we introduced with v3.0.0 of our module. Read below.

Target of this documentation is to basically combine the standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields) with the extensions made for our provider module. We identified an interesting approach in use by another Registrar's Module listed in public at GitHub.com which we followed and deeply polished.

## Known Bugs / Support Tickets / Feature Requests

* Wrong Dropdown List Entry pre-selected, should be the first one with empty value. [#PHW-648709](https://www.whmcs.com/members/viewticket.php?tid=PHW-648709&c=VtIFzrAa)
* Dropdown List Entry with `falsy` value is returned as `missing` in submission when field is configured as required field. [#CORE-14277](https://www.whmcs.com/members/viewticket.php?tid=WRJ-298239&c=PtkKH0Ck)
* Feature Request [`Ability to separate registration additional fields from transfer additional fields`](https://requests.whmcs.com/topic/ability-to-separate-registration-additional-fields-from-transfer-additional-field)
* Rejected Feature Request [`Finalize translation support for additional domain fields`](https://requests.whmcs.com/topic/finalize-translation-support-for-additional-domain-fields)

Feel free to upvote the feature requests - very appreciated!

## Features of our implementation

* Standardized way
* Shipped directly with the registrar module
* No manual effort with additional domain fields
* Auto-Cleanup of WHMCS built-in additional domain fields
* Still, our solution is overridable
* Auto-Generate Translation keys out of configuration if not provided
* 100% translation support (covering Name, Options, Description): english, german, french
* Changes can be rolled out in short through a new release
* Localized County Dropdown Lists can be realized in ease
* Localized Language Dropdown Lists can be realized in ease
* Auto-add empty valued option in case dropdown list is configured to be optional
* Auto-add Fax Form fields (linking to our [form generator](https://domainform.net))
* Configure Options in array notation for better readability
* Support of Conditional Requirements, but compatible with WHMCS < 7.9 (we require >=7.8!)
* Auto-prefill with previous configuration values in owner change process

## Activate OUR default additional fields configuration

Nothing you need to care about. Just cleanup your existing additional domain fields configuration (described at the top of this document). If you have already the OVERRIDEFILE file in use, please remove the entire file if you're just using `Ispapi` as registrar. If you have there also TLD configurations for other registrars, be so kind to just cleanup TLD configurations affecting TLDs offered over us.

**NOTE:** We have **no** Local Presence Service activated by default. Please have a further read [here](#local-presence-trustee-service).

Ensure to follow [this section](#translating-additional-domain-fields) to get translations shown, otherwise texts are missing and menu entries not shown.

## Uniqueness of domain fields

The property `Name` in the additional domain fields is used as unique field identifier per TLD. Thus specifying it is **MANDATORY**, when you introduce your custom fields or when overriding default field configurations shipped with WHMCS itself.

NOTE: **NEVER** apply translations by translating the `Name` field directly. WHMCS / our registrar module provides mechanisms for that. Please refer to the [translation guide](#translating-additional-domain-fields) instead.

## Customizing additional domain fields

If an addtional domain field is required for domain registration / transfer / trade / update for a TLD offered over us / registrar `Ispapi` and is not provided, then open a github issue and let us know. If you want to have something changed (translations, missing field, field review), also open a github issue. We will care about such cases in short!

Any other customizing of additional domain fields on customer's side should happen in the OVERRIDEFILE which again can be used to overwrite our defaults. You can follow the steps described in the standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields) to get this realized. Still, we would prefer to know about such cases to be able to improve.

## Translating additional domain fields

Based on the standard [WHMCS Documentation](https://docs.whmcs.com/Additional_Domain_Fields) section `Translating a Field Name`, we worked on a generic implementation allowing us to translate the additional fields (and our registrar module in general). Please copy the folder `lang/overrides` of the registrar module to your WHMCS's system accordingly. If you have already such files there in place, please merge our files into them.

Even though translating the `Description` or `Options` field is not possible by WHMCS built-in configuration parameters for additional fields ([see](https://requests.whmcs.com/topic/finalize-translation-support-for-additional-domain-fields)), our solution makes this possible. Please note that you should **not** modify our translation files. If you would like to contribute with another language or if you want us to change something, please let us know. Just open a github issue - we will care about it in short! Your Support is very appreciated!

We have translation files available for `arabic`, `english`, `germnan` and `french`. For all other languages we just fallback to english.

## Local Presence / Trustee Service

As a Local Presence service is not free of charge and WHMCS does not offer a generic domain addon for this kind of service (see [feature request](https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on)), you as reseller have to care about the configuration manually. Activating local presence service over additional domain fields could lead to losing money on your side when not having the Local Presence Service Fee included in the domain prices. Even though we at HEXONET offer our domain addons over additional domain fields (or so-called extension parameters), WHMCS handles these things over Domain Add-Ons like `Email Forwarding`, `DNS Management`. So the above feature request is about getting such an Add-On realized for Local Presence Service as it is perfect for exactly that purpose - allowing configuration of separate pricing and further configurations like a terms and conditions document.

Right now, you have to include the service fee in the domain extension price configuration when you want to use a local presence service to not lose money. This also means that customers who do not need a local presence service, would also pay a higher price even though not using that service.

Therefore, we decided to not activate the local presence service by default in our additional fields, to avoid any issues. If you still want to use a local presence service, follow these steps:

1. Add the local presence fee to all parts of the domain pricing of your TLD (registration, transfer) for every period.
2. Add below code example to the OVERRIDEFILE, but specific to your TLD:

```php
$additionaldomainfields[".it"] = [
    [
        "Name" => "Local Presence",
        "Type" => "dropdown",
        "Options" => ",1|Use local presence service",
        "Description" => "(required if not residing in/belonging to a EU Member State)",
        "Default" => "",
        "Ispapi-Name" => "X-IT-ACCEPT-TRUSTEE-TAC"
    ]
];
```

**NOTE:**

* Always keep `Ispapi-Name` tld-dependent e.g. `X-EU-ACCEPT-TRUSTEE-TAC`.
* Our default implementation doesn't consider local presence service for the reasons mentioned above.
* If it still doesn't work as expected, let us know.

TLDs known to support a trustee service over HEXONET: .bayern, .berlin, .de, .eu, .forex, .it, .jp, .ruhr, .sg, AFNIC TLDs.
