## 30.7.1 (2026-08-31)


### Bug Fixes

* **cnic admin config addon:** improve TLD additional fields configuration

* the TLD additional fields page now explains why no fields are available instead of always showing "No Additional Fields Required", including when the TLD is not assigned to a CNIC registrar module or when the registrar lookup fails; TLDs from additional CNR accounts (wrapper modules) can now be configured as well, which previously only worked for the main account, and the same applies to the DNS zone overview
* "Load Traditional PHP Code for Additional Fields" now works for registry dropdown fields such as .co.ae, .dk and .it, and generated configurations are accepted by WHMCS without internal helper data, with the correct TLD keys and conditional requirements; the instructions now use resources/domains/additionalfields.php instead of dist.additionalfields.php, which is overwritten by WHMCS updates and should not be edited
* TLD selection and lookup handling now supports TLDs with or without a leading dot, prevents duplicate entries and repeated lookups, clears stale fields after a failed lookup, and no longer shares cached field definitions between different CNR accounts 

# 30.7.0 (2026-08-17)


### Features

* **domain search addon:** Domain Search v2 - new client theme, on-device name ideas, redesigned admin

Second generation of the domain search add-on, aimed at resellers who embed
it as their storefront search.

Client theme v2 (new)
* New `client_theme_v2` storefront theme alongside the existing one: landing
  state with hero copy, featured TLD pricing cards and promotions, and an
  app-style Search / Transfer / Whois / Aftermarket mode switcher.
* Result rows rebuilt - inline premium/aftermarket badges, honest price
  suffixes when renewal matches registration, collapsed runs of taken
  domains, best-match priority and a confident whois summary.
* Mobile-first: condensed sticky search shell, single-row toolbar, bottom
  sheets for filters and sorting stacked above a sticky priced cart bar.
* Appearance tokens drive radii, spacing, dividers, glass materials and dark
  mode; RTL plus all four shipped languages (en/de/ar/pt-BR) updated.
* Optional hiding of the host page title and breadcrumb so the add-on owns
  the page.

Semantic name ideas
* New `src/domain-ideas` engine generates keyword-relevant domain ideas in
  the browser: thesaurus/synonym shards, a trained phrase-fluency model, and
  relevance + scoring passes, so suggestions read like real names instead of
  keyword mashups. Shards are bundled at build time - no extra round trips.
* Server side only plans and trims the work: `SuggestionRequestPlanner`,
  `SemanticCandidatePayload` and the registrar-side `SuggestionEnhancer`.
  Client-generated candidates no longer force an availability batch.
* Zones are ordered by the reseller's configured priority, spotlights first;
  featured zones stay reachable for semantic candidates.
* Progressive loading streams results in groups behind a kinetic word-level
  loader, with bounded auto-load and recovery from stalled requests.
* Price filtering on results, with matching sort and filter controls.

Admin
* Schema-driven settings page (`SettingsSchema`) with grouped, conditional
  fields replacing the old flat form and jQuery-UI accordion.
* Shared cnic admin design-system base, consumed by domain search: flat pill
  navigation, consistent settings rows, loading placeholders, visible focus
  rings, and layouts that survive narrow viewports.

Also
* Fix BalanceWidget redeclaration SyntaxError on the admin dashboard.
* PHPUnit coverage for the suggestion planner, payload, enhancer, pricing
  service and common helper; Node tests for idea generation, keyword
  handling, price filter, progressive load groups, whois summary and zone
  ranking.
* APPEARANCE.md customisation guide, README/CONTRIBUTING refresh, marketplace
  listing drafts, and asset versioning for cache-busting client bundles. 

## 30.6.6 (2026-08-07)


### Bug Fixes

* **cnic registrar module:** improve formatting of registration periods in ZoneInfo class 
* **cnic registrar module:** prevent invalid expiry dates from being synced to WHMCS

The Domain Sync could store an unusable expiry date on a domain when the API returned a renewal, paid-until or expiration date that could not be interpreted. Affected domains ended up with an expiry date of 1969-12-31 or 1970-01-01 (depending on the server's timezone), or with the current date, and WHMCS applied that value to the domain's Next Due Date and Next Invoice Date as well when "Set Next Due Date on Sync" is enabled. As a follow-up, WHMCS moved those domains to Expired, Grace or Redemption, cancelled or re-created their renewal invoices, and - if "Suspend Domain on Expiration" is enabled - the domain got suspended at the registry even though it was still paid for.
A second case affected domains using renewal mode RENEWONCE on TLDs that do not publish explicit renewal periods (for example .nl): the calculated expiry date could fall back to 1970 or lose the renewal period entirely.
With this release, the Domain Sync no longer derives an expiry date from data it cannot interpret. It reports the affected domain instead - visible in the module log and in the Domain Synchronisation cron report - and leaves the domain's expiry date, next due date and status untouched. For RENEWONCE domains, a renewal period of 1 year is now used when the TLD does not provide one, and the expiration date returned by the API is used if the renewal calculation fails.
Please note that this fix prevents new incorrect data only. Domains that already carry a wrong expiry date need to be corrected: set their status back to Active first (the Domain Sync only processes Active and Pending Registration domains), then re-run the Domain Sync or the Expiry Date Bulk Sync, and check your WHMCS system or registrar account for domains that were suspended by mistake. 
* **deps:** bump phpseclib/phpseclib from 3.0.55 to 3.0.56

Bumps [phpseclib/phpseclib](https://github.com/phpseclib/phpseclib) from 3.0.55 to 3.0.56.
- [Release notes](https://github.com/phpseclib/phpseclib/releases)
- [Changelog](https://github.com/phpseclib/phpseclib/blob/master/CHANGELOG.md)
- Commits 

## 30.6.5 (2026-08-05)


### Bug Fixes

## 30.6.4 (2026-07-28)


### Bug Fixes

* **cnic registrar module:** hide registrar lock UI for TLDs without transfer lock
WHMCS renders the "Domain Currently Unlocked!" alert whenever $lockstatus
is "unlocked", so TLDs that do not support a transfer lock at all (e.g. .qa)
told the customer to enable something that cannot be enabled.

Only our own themes suppressed it (via a $managementoptions.locking override
in clientareadomaindetails.tpl); stock and third-party themes did not. Handle
it in the ClientAreaPageDomainDetails hook instead so it works theme-agnostic.

Refs RSRMID-2928 

## 30.6.3 (2026-07-24)


### Bug Fixes

* **cnic registrar module:** improved environment validation and shows system requirements banner in admin area 

## 30.6.2 (2026-07-09)


### Bug Fixes

* **dns manager addon:** enhance dns manager addon experience for custom themes like Lagom 

## 30.6.1 (2026-07-07)


### Bug Fixes

* **cnic registrar module:** flag domains transferred via registrar-detected `Internal Transfers or User Transfers` for manual renewal review 

# 30.6.0 (2026-07-06)


### Features

* **domain search addon:** cache compiled templates, migrate to @lit/task and ref directive, fix WHOIS container styling and eval risk 

## 30.5.1 (2026-07-03)


### Bug Fixes

* **cnic registrar module:** resolves Undefined constant CNIC_VERSION error in some older WHMCS versions 

# 30.5.0 (2026-07-01)


### Features

* **cnic registrar module:** implement upgrade support, migrates .DK additional field values to new supported values 

## 30.4.1 (2026-07-01)


### Bug Fixes

* **cnic dns manager:** improve DNS zones handling when contain duplicate records 

# 30.4.0 (2026-06-30)


### Features

* **cnr registrar module:** improved DNSSEC key management 

## 30.3.1 (2026-06-22)


### Bug Fixes

* **cnic registrar module:** additional-fields support for Nexus cart and .dk fields implemented with boolean fallback for empty option labels and updated user type value 

# 30.3.0 (2026-06-16)


### Features

* **dns manager addon:** redesign deletion UX, add copy-to-clipboard, and inline validation 

## 30.2.1 (2026-06-15)


### Bug Fixes

* **cnic dns manager:** Fix DNS manager TXT/SPF saves 
* **cnic registrar module:** improve handling of TestMode and ProxyServer parameters 

# 30.2.0 (2026-06-04)


### Features

* **cnic registrar module:** add IDN language tag support for domain registration and transfer 

## 30.1.2 (2026-05-28)


### Bug Fixes

* **cnic registrar:** make StatusDomain more failsafe 

## 30.1.1 (2026-05-26)


### Bug Fixes

* **cnic registrar module:** prevent errors on domain detail pages when domain context is unavailable and resolve registrar ID not being detected correctly in addon and hook contexts 
* **DNS Manager Addon:** resolve DNS management page not loading for domains using supported registrars 

# 30.1.0 (2026-05-19)


### Features

* **cnic registrar module:** implemented NSENTRIES removal button for .de domains via domain configurations page in admin panel 

## 30.0.14 (2026-05-19)


### Bug Fixes

* **deps:** bump ws from 8.20.0 to 8.20.1 

## 30.0.13 (2026-05-15)


### Bug Fixes

* **dns manager addon:** patch false nameserver warning and the CheckDNSZone request without the TLD 

## 30.0.12 (2026-05-14)


### Bug Fixes

* **deps:** bump lit from 3.3.2 to 3.3.3 

## 30.0.11 (2026-05-14)


### Bug Fixes

* **cnic registrar module:** patches issue where `toArray()` warning was shown in some cases in the client area domains section 

## 30.0.10 (2026-05-08)


### Bug Fixes

* **cnic registrar module:** implement validation and handling for .DE General Request and Abuse Contact additional fields 

## 30.0.9 (2026-05-07)


### Bug Fixes

* **cnic registrar module:** patched an issue which blocked aftermarket domain registrations 

## 30.0.8 (2026-05-06)


### Bug Fixes

* **cnic registrar module:** improved validation and patches error in client area my domains section 
* **cnic ssl:** improve CSR handling 

## 30.0.7 (2026-05-01)


### Bug Fixes

* **cnic registrar module:** handle unknown TLD status in availability check fallback to WHMCS whois lookup 

## 30.0.6 (2026-04-29)


### Bug Fixes

* **cnic registrar module:** implement fallback to WHMCS whois lookup for TLDs that are not supported by CentralNic Reseller 

## 30.0.5 (2026-04-28)


### Bug Fixes

* **cnic registrar module:** resolve DNS Manager addon bug where record‑type selector failed to load, plus improved SPF record processing 

## 30.0.4 (2026-04-28)


### Bug Fixes

* **cnic pricing importer:** fixes 'Check Authorisation' issue on products import 

## 30.0.3 (2026-04-28)


### Bug Fixes

* **cnic registrar:** fix regression in api client leading to some addons unable to make requests 

## 30.0.2 (2026-04-27)


### Bug Fixes

* **cnic pricing importer:** pass registrar settings to HostingImporter constructor and update CheckHosting requests 

## 30.0.1 (2026-04-22)


### Bug Fixes

* **cnic registrar module:** improve domain validation during registration; patches error `Call to a member function toArray()` 

# 30.0.0 (2026-04-16)


### Bug Fixes

* **cnic admin config addon:** extend CNIC configuration addon features with registrar selector for improved domain management 
* **cnic dns manager:** patch fallback logo path 
* **cnic domain search addon:** make domain search compatible with cnic wrappers 
* **cnic registrar module:** fix useless GetProperty call in case no credentials are yet configured 
* **cnic registrar module:** pick module name from whmcs.json to allow white-labeling 
* **cnic registrar module:** review Domain Sync in direction of expirydate detection 
* **cnic registrar module:** switch from hook subscription to template change 
* **cnic registrar module:** update lookup provider handling and improve parameter initialization 


### Features

* **cnic registrar module:** fully revamped domain name suggestion engine 
* **cnic registrar module:** multi-account/wrapper module support and improved/dymamic domain registrars overview UI 
* **cnic registrar module:** review domain contact information (validation + verification) 


### BREAKING CHANGES

* **cnic registrar module:** We revamped our lookup provider settings and the underlying domain name suggestion
engine. There are downward incompatible changes and by that we recommend updating the Lookup
Provider Settings.
* **cnic registrar module:** This commit reviews the registar module in direction of supporting the use of so-called wrapper registrar modules. These modules can be build and used by resellers if they have multiple reseller accounts with CentralNic and want to use them all in WHMCS. The code refactoring should ensure that the wrapper modules benefit of the same features by reusing the core logic of the main CNIC registrar module. The review includes changes to the module's configuration, hooks, and core functions to allow for this flexibility and reuse of code.
* **cnic registrar module:** Switch from hook subscription to template change for more reliability. Check our themes for details in file clientareadomaindetails.tpl.
* **cnic registrar module:** We reviewed the expirydate detection, the registrar's _Sync function though, in
direction of some missing cases and issues we noticed. With did this with the help of our API Core
Devs and tested this change. Running a Bulk Sync using our Expirydate Bulk Sync Tool is recommended.

## 29.1.6 (2026-04-09)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 13.1.3 to 13.1.4 

## 29.1.5 (2026-04-08)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 13.1.2 to 13.1.3 

## 29.1.4 (2026-04-02)


### Bug Fixes

* **deps:** bump idna-uts46-hx from 6.1.5 to 6.1.7 

## 29.1.3 (2026-03-30)


### Bug Fixes

* **cnic registrar module:** Patched an issue which prevented client domain details access 

## 29.1.2 (2026-03-30)


### Bug Fixes

* **cnic registrar module:** show non validated contacts warnings in client area domain details 

## 29.1.1 (2026-03-24)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 13.1.1 to 13.1.2 

# 29.1.0 (2026-03-23)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.49 to 3.0.50 


### Features

* **cnic registrar module:** add incident reporting and implemented configurable notification modes (todo items, support tickets, and/or email notifications) 

## 29.0.4 (2026-03-18)


### Bug Fixes

* **cnic registrar module:** improved additional fields handling, domain transfer logic and patched issue with nexus child template 

## 29.0.3 (2026-03-16)


### Bug Fixes

* **cnic registrar module:** include nameservers for .IN domain transfers 
* **cnic registrar module:** include nameservers for .IT domain transfers 

## 29.0.2 (2026-03-16)


### Bug Fixes

* **cnic registrar module:** update domain suggestion logic to prioritize TLD requests; now supports tlds as batch requests 

## 29.0.1 (2026-03-13)


### Bug Fixes

* **cnic-registrar:** improve hostname normalization logic for URL forwardings 

# 29.0.0 (2026-03-12)


### Features

* **cnic registrar module:** fully revamped domain name suggestion engine 


### BREAKING CHANGES

* **cnic registrar module:** We revamped our lookup provider settings and the underlying domain name suggestion
engine. There are downward incompatible changes and by that we recommend updating the Lookup
Provider Settings.

## 28.9.6 (2026-03-11)


### Bug Fixes

* **cnic registrar module:** include contacts for .DE, .FR and .CN Domain Transfers 

## 28.9.5 (2026-03-09)


### Bug Fixes

* **cnr registrar module:** add fallback for domain transfers by retrying with owner contact when the API reports missing transfer contact data 

## 28.9.4 (2026-03-06)


### Bug Fixes

* **deps:** bumped some deps to latest version 

## 28.9.3 (2026-03-03)


### Bug Fixes

* **deps:** bump idna-uts46-hx from 6.1.1 to 6.1.3 

## 28.9.2 (2026-03-03)


### Bug Fixes

* **dependencies:** update centralnic-reseller/php-sdk to v13.1.1 

## 28.9.1 (2026-03-02)


### Bug Fixes

* **cnic registrar module:** reviewed API Command used for generating eppcodes (issues with .de) 

# 28.9.0 (2026-03-01)


### Features

* **cnic-pricingimport:** ability to choose product group on hosting product import 
* **cnichosting:** implement welcome email 

## 28.8.2 (2026-02-27)


### Bug Fixes

* **cnic registrar module:** improve .DK domain registration status check and sync logic for foreign transfers 
* **deps:** bump idna-uts46-hx from 6.1.0 to 6.1.1 

## 28.8.1 (2026-02-19)


### Bug Fixes

* **cnic registrar module:** update domain status handling to mark pending registrations as active efficiently 

# 28.8.0 (2026-02-17)


### Features

* **cnic ssl addon:** add pending reissue email notifications via daily cron 

## 28.7.1 (2026-02-10)


### Bug Fixes

* **cnic registrar module:** remove json file type from denied .htaccess list 

# 28.7.0 (2026-02-10)


### Bug Fixes

* **cnic registrar module:** ensure success status reflects actual DNSSEC actions submitted 


### Features

* **cnic domain search:** Add client theme variant configuration and implemented dark theme support 
* **dns manager addon:** Web forwarding as dedicated tab, import/export zone files, new DNS record types 

## 28.6.10 (2026-02-09)


### Bug Fixes

* **cnic registrar module:** review additional domain fields for AFNIC TLDs (.fr, .re et al) 

## 28.6.9 (2026-02-09)


### Bug Fixes

* **cnic registrar module:** transferred away detection based on QueryEventList reviewed for IDNs 

## 28.6.8 (2026-02-06)


### Bug Fixes

* **software bundle:** build process to consider hidden files (missing .htaccess earlier) 

## 28.6.7 (2026-02-06)


### Bug Fixes

* **software bundle:** block web crawlers indexing of folder /resources/cnic via .htaccess 

## 28.6.6 (2026-02-05)


### Bug Fixes

* **build-release:** clean up debug logging export in workflow, TEST RELEASE DO NOT UPDATE TO THIS RELEASE 


### Performance Improvements

* **build-release:** enable debug logging for semantic-release in the container, TEST RELEASE NO NEED TO UPGRADE 
* **build-release:** update working directory handling in Docker exec commands, DO NOT UPGRADE TEST RELEASE 

## 28.6.6 (2026-02-05)


### Bug Fixes

* **build-release:** clean up debug logging export in workflow, TEST RELEASE DO NOT UPDATE TO THIS RELEASE 


### Performance Improvements

* **build-release:** enable debug logging for semantic-release in the container, TEST RELEASE NO NEED TO UPGRADE 
* **build-release:** update working directory handling in Docker exec commands, DO NOT UPGRADE TEST RELEASE 

## 28.6.7 (2026-02-05)


### Performance Improvements

* **build-release:** update working directory handling in Docker exec commands, DO NOT UPGRADE TEST RELEASE 

## 28.6.6 (2026-02-05)


### Bug Fixes

* **build-release:** clean up debug logging export in workflow, TEST RELEASE DO NOT UPDATE TO THIS RELEASE 


### Performance Improvements

* **build-release:** enable debug logging for semantic-release in the container, TEST RELEASE NO NEED TO UPGRADE 

## 28.6.5 (2026-02-05)


### Bug Fixes

* **cnic registrar module:** fix key gen for data cache 

## 28.6.4 (2026-02-05)


### Performance Improvements

* **cnic registrar module:** improve data load by cache for StatusDomain 

## 28.6.3 (2026-02-03)


### Bug Fixes

* **deps:** bump @isaacs/brace-expansion from 5.0.0 to 5.0.1 

## 28.6.2 (2026-02-03)


### Bug Fixes

* **cnic registrar module:** review Buttons for Transfers in AdminCustomButtonArray 

## 28.6.1 (2026-02-03)


### Performance Improvements

* **cnic registrar module:** add Cache to AdminCustomButtonArray Function as WHMCS calls it twice 

# 28.6.0 (2026-02-02)


### Features

* **domain search addon:** add cart support for Nexus cart WHMCS v9 

# 28.5.0 (2026-01-29)


### Features

* **cnic registrar module:** add child theme support for Nexus theme in WHMCS 9.0 

## 28.4.6 (2026-01-28)


### Bug Fixes

* **cnic domain search & admin config addon:** updated template files related to FontAwesome icons and FontAwesome stylesheet path to ensure compatibility with WHMCS v9 

## 28.4.5 (2026-01-27)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.48 to 3.0.49 

## 28.4.4 (2026-01-27)


### Bug Fixes

* **cnic registrar module:** do not show "Suspend" button if yet suspensded by TLD Provider 

## 28.4.3 (2026-01-27)


### Bug Fixes

* **cnic registrar module:** fix show required contact verification after registration (RAA) 

## 28.4.2 (2026-01-21)


### Bug Fixes

* **deps:** bump lodash-es from 4.17.21 to 4.17.23 

## 28.4.1 (2026-01-12)


### Bug Fixes

* **cnic monitoring addon:** enhance premium pricing mismatch detection for renewals 

# 28.4.0 (2026-01-06)


### Bug Fixes

* **pricing-importer:** avoid kidnapping existing hosting product group 


### Features

* **pricing-import:** allow monthly rates for hosting products 

# 28.3.0 (2025-12-23)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.47 to 3.0.48 


### Features

* **cnic registrar module:** add setting to disable automatic domain restoration during renewals 

## 28.2.11 (2025-12-11)


### Bug Fixes

* **cnic registrar module:** in case of too early restore, fallback to renewal 

## 28.2.10 (2025-12-04)


### Bug Fixes

* **cnic dns manager:** correct DNSSEC link and update breadcrumb URLs 
* **cnic dns manager:** review menu entry url to our DNS Manager Addon 

## 28.2.9 (2025-12-02)


### Bug Fixes

* **cnic pricing importer:** patch link to the Domain Pricing Importer of WHMCS 

## 28.2.8 (2025-12-01)


### Bug Fixes

* **cnic registrar module:** generate activity log entry when requesting a new eppcode/auth code 
* **cnic registrar module:** patched activity log generator 

## 28.2.7 (2025-11-25)


### Bug Fixes

* **release workflow:** try new way of releasing to whmcs marketplace (dep install) 

## 28.2.6 (2025-11-25)


### Bug Fixes

* **release workflow:** testing new GH PAT (don't upgrade) 

## 28.2.5 (2025-11-25)


### Bug Fixes

* **cnic-domain-search:** show all TLDs in domain results; remove CNIC-only TLD restriction 

## 28.2.4 (2025-11-18)


### Bug Fixes

* **deps:** bump glob from 10.4.5 to 10.5.0 

## 28.2.3 (2025-11-14)


### Performance Improvements

* **cnic config addon:** Refactor sync interface to enhance user experience and performance 

## 28.2.2 (2025-11-12)


### Bug Fixes

* **cnic registrar module:** fully api-driven auth code retrieval aka. Get EPP Code 

## 28.2.1 (2025-11-12)


### Bug Fixes

* **Domain Search Addon:** reviewed overrides custom language file path from /lang/overrides/<language>.json to /lang/overrides/cnic-domain-search-addon-<language>.json to 

# 28.2.0 (2025-11-12)


### Features

* **cnr registrar module:** show status inactive in domain detail view in admin area as well 

# 28.1.0 (2025-11-10)


### Features

* **cnic admin config addon:** add traditional additional fields copy feature for dist.additionalfields.php 

## 28.0.5 (2025-11-10)


### Bug Fixes

* **cnic addons:** making sure cnic addon language files are unecrypted 

## 28.0.4 (2025-11-10)


### Bug Fixes

* **cnic registrar module:** PHP 8.3 code improvements 

## 28.0.3 (2025-11-07)


### Bug Fixes

* **cnic registrar module:** patched logger and CONTACT related PHP issues 

## 28.0.2 (2025-11-07)


### Bug Fixes

* **cnic registrar module:** patched  issue where WHMCS incorrectly returning Sync Not Supported by Registrar Module 

## 28.0.1 (2025-11-05)


### Bug Fixes

* **cnic registrar module:** fix saving url forwarding in case the dnszone is not present yet 

# 28.0.0 (2025-11-04)


### Bug Fixes

* **cnic ssl addon:** improve error handling on CSR and Private Key generation 


### chore

* **ispapi registrar module:** official deprecation and cleanup of Brand HEXONET, ISPAPI 


### Code Refactoring

* **cnic ssl addon:** remove hexonet/ispapi support from ssl module 


### Features

* **cnic cpnael hosting addon:** add server module for CNIC cPanel hosting support 
* **cnic price importer addon:** Implement Hosting Import UI and product group import 
* **cnic price importer addon:** implement module upgrade procedure 
* **cnic price importer addon:** refactoring for pricing import 
* **cnic ssl addon:** pricing import logic moved to cnic price importer addon 


### BREAKING CHANGES

* **cnic ssl addon:** ISPAPI is no longer supported in the SSL modules as customers have been migrated
* **cnic ssl addon:** the pricing import functionality of the SSL addon has been moved to the cnic price importer addon for better UX and achieving a single place of trust for CNIC pricing imports.

re RSRMID-2386 and RSRMID-2428
* **ispapi registrar module:** This release removes the legacy ISPAPI (HEXONET) Integration from our
software bundle and its support in our addons. Use v27 if you still need support for it.

## 27.16.4 (2025-10-28)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

## 27.16.3 (2025-10-28)


### Bug Fixes

* **dns manager addon:** Patched an issue which was causing dnssec to disappear 

## 27.16.2 (2025-10-27)


### Bug Fixes

* **deps:** bump tar-fs from 2.1.3 to 2.1.4 

## 27.16.1 (2025-10-23)


### Bug Fixes

* **cnic registrar module:** patch issue where an incorrect client ID was assigned to activity log entries 

# 27.16.0 (2025-10-14)


### Features

* **cnic admin addon:** add force update option for expiry date synchronization including next due date 

## 27.15.4 (2025-10-13)


### Bug Fixes

* **cnic admin addon:** streamline due date calculation in domain expiry sync 

## 27.15.3 (2025-10-13)


### Bug Fixes

* **cnic admin addon:** enhance error handling and add detailed status information for domain sync and improve expiry logic 

## 27.15.2 (2025-10-07)


### Bug Fixes

* **cnic monitoring addon:** improve accessibility and event handling for premium domains pricing fix now button 

## 27.15.1 (2025-10-06)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.46 to 3.0.47 

# 27.15.0 (2025-09-24)


### Features

* **event list:** implement event list feature with navigation, backend, and frontend components & extended domain expiration date sync to support filter by TLDs 

# 27.14.0 (2025-09-15)


### Bug Fixes

* **domain search addon:** add initial loader skeleton for domain search engine 


### Features

* **cnic registrar module:** add additional domain fields validator on checkout page 

## 27.13.3 (2025-09-05)


### Bug Fixes

* **cnic registrar module:** cleaning up whitespace from postal code for .SE tld 

## 27.13.2 (2025-09-03)


### Bug Fixes

* **cnic ssl addon:** fixed issue related to sslcert deletion 

## 27.13.1 (2025-09-03)


### Bug Fixes

* **cnic registrar module:** reviewed hook regarding software dependency load 

# 27.13.0 (2025-09-02)


### Features

* **cnic registrar settings:** added registrar settings page to configure "renewal mode" and "include renewals for internal transfer" 

## 27.12.5 (2025-08-28)


### Bug Fixes

* **cnic ssl addon:** fix PHP error related to missing APIHelper class 

## 27.12.4 (2025-08-28)


### Bug Fixes

* **cnic registrar module:** review domain search case TLD NOT SUPPORTED (more fine grained) 

## 27.12.3 (2025-08-26)


### Bug Fixes

* **cnic registrar module:** domain synchronization to better cover outgoing transfers 

## 27.12.2 (2025-08-21)


### Bug Fixes

* **cnic registrar module:** fix unintended two year renewals in ARGP 

## 27.12.1 (2025-08-20)


### Bug Fixes

* **cnic registrar module:** sanitize error messages by removing command prefixes from client area 

# 27.12.0 (2025-08-20)


### Features

* **cnic registrar module:** replace data refresh on sync by a CNIC Config Addon Tool 

## 27.11.2 (2025-08-20)


### Bug Fixes

* **cnic registrar module:** add transfer term parameter conditionally (e.g. .qa, .se) 

## 27.11.1 (2025-08-14)


### Bug Fixes

* **cnic registrar module:** improved contact details handling for Save Contact Details 

# 27.11.0 (2025-08-12)


### Features

* **cnic admin addon:** add support to show all DNSZones from CentralNic Reseller account 

# 27.10.0 (2025-08-07)


### Features

* **cnic registrar module:** show special stati (suspended et al) (set at registrar or registry) 

## 27.9.4 (2025-08-06)


### Bug Fixes

* **cnic registrar module:** review renewal endpoint for EXPIRATION parameter 

## 27.9.3 (2025-08-05)


### Bug Fixes

* **cnic registrar module:** remove EXPIRATION parameter from domain renewal process 

## 27.9.2 (2025-08-05)


### Bug Fixes

* **cnic registrar module:** retry transfer without period parameter (if returned as not supported) 

## 27.9.1 (2025-08-05)


### Bug Fixes

* **cnic registrar module:** do not include nameservers in transfer requests in general - except .be 

# 27.9.0 (2025-08-04)


### Features

* **cnic admin addon:** add bulk expiry date sync functionality with modern UI 

# 27.8.0 (2025-08-04)


### Features

* **cnic registrar module:** add dutch language support 
* **cnic registrar module:** add spanish language support 

## 27.7.2 (2025-07-29)


### Bug Fixes

* **cnic registrar module:** do not submit empty nameserver parameters as part of a domain update 

## 27.7.1 (2025-07-29)


### Bug Fixes

* **cnic registrar module:** do not return a middlename contact data field; refactored code base 

# 27.7.0 (2025-07-29)


### Features

* **cnic registrar module:** extend registrar settings with Enable EPP Code (sync TLD-specific EPP code requirements) for pricing sync 

# 27.6.0 (2025-07-29)


### Features

* **cnic registrar module:** automatic hide of optional additional domain fields 

## 27.5.14 (2025-07-25)


### Bug Fixes

* **cnic domain search:** improve handling of unassigned TLDs in categories to prevent showing them as unsupported 
* **cnic registrar module:** update registrar dropdown mappings for immediate domain deletion mode 

## 27.5.13 (2025-07-23)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

## 27.5.12 (2025-07-23)


### Bug Fixes

* **cnic registrar module:** return registry contact handles as contact tab with empty input fields 

## 27.5.11 (2025-07-21)


### Bug Fixes

* **cnic registrar module:** prevent registered domains from showing as available in Domain Suggestions 

## 27.5.10 (2025-07-21)


### Bug Fixes

* **cnic registrar module:** availability check - add explicit cast to int of cnics code 

## 27.5.9 (2025-07-18)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.8 to 11.0.9 

## 27.5.8 (2025-07-18)


### Bug Fixes

* **dns manager addon:** update action URL to patch error modals on DNS form submission 

## 27.5.7 (2025-07-16)


### Bug Fixes

* **cnic dns addon:** support NS records with optional TTL and IN fields in DNS template handling 

# 27.6.0 (2025-07-15)


### Features

* **cnic registrar module:** add PERIOD parameter handling for domain transfer requests 

## 27.5.5 (2025-07-15)


### Bug Fixes

* **cnic ssl addon:** skip empty product groups on pricing/product import 

## 27.5.4 (2025-07-14)


### Bug Fixes

* **dns manager addon:** patched priority field handling for SRV Resource Records 

## 27.5.3 (2025-07-14)


### Bug Fixes

* **cnic registrar module:** explicit data refresh on domain sync / loading contact data 

## 27.5.2 (2025-07-14)


### Bug Fixes

* **cnic registrar module:** review contact information handling (not all/no contacts set) 

## 27.5.1 (2025-07-11)


### Bug Fixes

* **deps:** bump lit from 3.3.0 to 3.3.1 in /domain-search-src-files 

# 27.5.0 (2025-07-11)


### Bug Fixes

* **cnic registrar module:** auto-fallback to trade process if contact update fails respectively 
* **cnic registrar module:** identifying contacts to use whithin domain transfer process reviewed 
* **cnic registrar module:** return requested owner changes as pending 
* **cnic registrar module:** return the ownerchange status and expiry date 


### Features

* **cnic registrar module:** show change of registrant form and or upload link for whois updates 
* **cnic registrar module:** support showing fax form / doc upload link if necessary on ownerchange 

## 27.4.16 (2025-07-10)


### Bug Fixes

* **cnic registrar module:** do not auto-cancel domains during sync if not found at provider 

## 27.4.15 (2025-07-08)


### Bug Fixes

* **cnic registrar module:** handle redemption days and fees correctly in TLD pricing sync 

## 27.4.14 (2025-07-08)


### Bug Fixes

* **cnic registrar module:** add support in domain details view for renewal mode DEFAULT 

## 27.4.13 (2025-07-07)


### Bug Fixes

* **ispapi registrar module:** patch dnssec section (smarty php error on access) , closes #297

## 27.4.12 (2025-07-04)


### Bug Fixes

* **cnic registrar module:** .de registrations & nameservers 

## 27.4.11 (2025-07-02)


### Bug Fixes

* **cnic registrar module:** major review of the domain sync integration 

## 27.4.10 (2025-07-01)


### Bug Fixes

* **cnic registrar module:** reduced TLDs Sync Cache from 24h to 1h 

## 27.4.9 (2025-07-01)


### Bug Fixes

* **cnic registrar module:** patched an issue with balance widget toggle button 

## 27.4.8 (2025-06-30)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.45 to 3.0.46 

## 27.4.7 (2025-06-27)


### Bug Fixes

* **cnic registrar module:** temp remove the Automatic DNS Zone deletion feature (post-migration) 

## 27.4.6 (2025-06-25)


### Bug Fixes

* **cnic registrar module:** fix Nameserver Update after Transfer (Transfer initiated via Admin Area) 

## 27.4.5 (2025-06-23)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.44 to 3.0.45 

## 27.4.4 (2025-06-19)


### Bug Fixes

* **cnic dns manager:** normalize host to '@' when adding new DNS record if it matches dnszone 

## 27.4.3 (2025-06-17)


### Bug Fixes

* **cnic registrar module:** request eppcode using modifydomain (except the special tlds) 

## 27.4.2 (2025-06-17)


### Bug Fixes

* **cnic registrar module:** handle exceptions and hide dnszone status warning messages 

## 27.4.1 (2025-06-12)


### Bug Fixes

* **cnic registrar module:** fix domain search (premiums domains = off, offered for regular price) 
* **cnic registrar module:** skip the add. field for the allocation token for premiums 

# 27.4.0 (2025-06-06)


### Features

* **cnic dnsmanager/dnssec addon:** enhance DNSSEC management with new UI elements and backend logic, auto activate dnssec via dnsmanager 

# 27.3.0 (2025-05-28)


### Features

* **cnic config addon:** add CNICConfig for TLD additional field management 

## 27.2.7 (2025-05-26)


### Bug Fixes

* **cnic registrar module:** fix expirydate after renew (renewonce, wrong backend data, e.g. .ch) 

## 27.2.6 (2025-05-21)


### Bug Fixes

* **cnic registrar module:** fix nameserver update after transfer to cover all nameservers , closes #293

## 27.2.5 (2025-05-20)


### Bug Fixes

* **cnic registrar module:** review DNSSEC to be offered only for TLDs technically supporting it 

## 27.2.4 (2025-05-19)


### Bug Fixes

* **cnic registrar module:** reviewed auto transfer status caching to avoid unnecessary calls to the registrar API 

## 27.2.3 (2025-05-16)


### Bug Fixes

* **cnic registrar module:** improve contact field state handling by converting state codes from YK to YT 

## 27.2.2 (2025-05-16)


### Bug Fixes

* **software bundle:** trigger new release encrypted with ioncube encoder v14.0.2 

## 27.2.1 (2025-05-12)


### Bug Fixes

* **cnic register module:** update automatic transfer lock status handling and improve error messaging 

# 27.2.0 (2025-05-12)


### Features

* **cnic registrar module & domain importer addon:** Add support for importing premium domain names to WHMCS via the domain importer addon. 

# 27.1.0 (2025-05-06)


### Bug Fixes

* **cnic dnsmanager addon:** update algorithm and digest option references for DNSSEC template consistency 


### Features

* **cnic registrar module:** improve error handling and display registrar error messages in client domain area 

## 27.0.3 (2025-05-02)


### Bug Fixes

* **cnic dnsmanager addon:** correct template paths to resolve redirection issues 

## 27.0.2 (2025-05-02)


### Performance Improvements

* **cnic registrar module:** improve performance when loading private nameservers 

## 27.0.1 (2025-04-30)


### Bug Fixes

* **cnic dnsmanager addon:** enhance DNSSEC management UI and logic, improve template structure 
* **cnic registrar module:** review module logging for addons 

# 27.0.0 (2025-04-28)


### Bug Fixes

* **cnic registrar module:** consider settings (yes/no, default:true) even if initially not present 


### Features

* **cnic registrar module:** cleanup dnszones if domain identified as Cancelled or Transferred Away 
* **cnic registrar module:** TLD Settings / Pricing Import Review 


### BREAKING CHANGES

* **cnic registrar module:** Table `mod_cnic_zones` has been deprecated and can be removed from the database.

The TLD Settings / Pricing Import has been refactored to use a new cache mechanism.
This change improves performance and reliability when importing TLD settings.
Pricing Import is now also fully api-driven with further potential for improvements (pending backend requests).

We reviewed the Post-Transfer Update Process for Contact and Nameserver Data.
Saving Contacts and Handling of Domain Transfers has been reviewed and improved as well considering the new TLD Settings Mechanism.

## 26.2.2 (2025-04-17)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

## 26.2.1 (2025-04-17)


### Bug Fixes

* **cnic registrar module:** updated return types for Add DNS Record and Enable DNSSec methods 

# 26.2.0 (2025-04-14)


### Features

* **cnic ssl:** add option to set cross-sell products on certificate pricing import 

## 26.1.4 (2025-04-11)


### Bug Fixes

* **deps:** bump lit from 3.2.1 to 3.3.0 in /domain-search-src-files 

## 26.1.3 (2025-04-10)


### Bug Fixes

* **cnic registrar module:** improve error handling for automatic transfer lock status retrieval via GetProperty CMD 

## 26.1.2 (2025-04-02)


### Bug Fixes

* **cnic registrar module:** reviewed: Domain Sync to return domains as cancelled 

## 26.1.1 (2025-04-02)


### Bug Fixes

* **cnic registrar module:** mark domains as cancelled if available for registration to improve domain status sync 

# 26.1.0 (2025-04-01)


### Features

* **cnic dns:** implement dnssec support for keydns zones 

# 26.0.0 (2025-03-28)


### Features

* **cnic registrar module:** implement domain automatic transfer lock status retrieval on registrar settings 


### BREAKING CHANGES

* **cnic registrar module:** The automatic transfer lock after registration and transfer has changed. Check the registrar module settings for details on how to activate it.

## 25.7.12 (2025-03-24)


### Bug Fixes

* **cnic dnsmanager addon:** streamline domain handling and sidebar generation 

## 25.7.11 (2025-03-19)


### Bug Fixes

* **cnic registar module:** resolve issues with detecting 3rd level TLDs (e.g., .pp.se) to improve domain zone accuracy 

## 25.7.10 (2025-03-17)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

## 25.7.9 (2025-03-17)


### Bug Fixes

* **cnic registar module / dns manager:** review TXT resource record / address field handling, UI improvements for DNS manager addon 
* **cnic registrar module:** reviewed and optimised handling for contact verification in GetDomainInformation 

## 25.7.8 (2025-03-12)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.3 to 11.0.5 

## 25.7.7 (2025-03-11)


### Bug Fixes

* **ispapi & cnic registrar module:** ensure user is logged in before accessing DNS Management; improve Nameservers handling 

## 25.7.6 (2025-03-10)


### Bug Fixes

* **ispapi & cnr registrar module:** correct link and label for terms and conditions agreement for .dk tld 

## 25.7.5 (2025-03-10)


### Bug Fixes

* **ispapi & cnr registrar module:** enhance .dk terms and conditions checkout layout for Lagom and retable themes 

## 25.7.4 (2025-03-07)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.2 to 11.0.3 

## 25.7.3 (2025-02-28)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.1 to 11.0.2 

## 25.7.2 (2025-02-20)


### Bug Fixes

* **ispapi registrar module:** Transfer Sync to consider also domains that joined the reseller account differently (non-transfer way) 

## 25.7.1 (2025-02-20)


### Bug Fixes

* **ispapi registrar module:** add missing REGISTRANT-IDNUMBER and VATID fields for .SE and .NU domain transfers 

# 25.7.0 (2025-02-18)


### Features

* **ispapi registrar module:** add .dk checkout page translations for Arabic, French, and German 

## 25.6.1 (2025-02-17)


### Bug Fixes

* **cnic dns manager:** fix default nameserver set suggestion in DNS Management 

# 25.6.0 (2025-02-17)


### Features

* **cnic dns manager:** support custom settings for SOA MNAME, RNAME 

# 25.5.0 (2025-02-14)


### Features

* **cnic registrar module:** offer a global customizing of defaults for additional fields 

## 25.4.5 (2025-02-14)


### Bug Fixes

* **dns-manager-addon:** display KeyDNS nameservers warning and enhance UI for empty records 

## 25.4.4 (2025-02-13)


### Bug Fixes

* **cnic registrar module:** patch empty dnszones creation as part Domain Details View 

## 25.4.3 (2025-02-12)


### Bug Fixes

* **dns manager addon:** include file extension in import statement 

## 25.4.2 (2025-02-12)


### Bug Fixes

* **cnic/ispapi registrar & domain search addon:** Enhance TLD handling in domain suggestions & improve domain availability status handling 

## 25.4.1 (2025-02-07)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.0 to 11.0.1 

# 25.4.0 (2025-02-06)


### Features

* **CNIC DNS Manager Addon:** Introducing DNS Manager addon with responsive UI, error handling, and client area integration 

## 25.3.2 (2025-02-06)


### Bug Fixes

* **cnic registrar module:** .CA additional field handling: add preselection of Legal Type 

## 25.3.1 (2025-02-06)


### Bug Fixes

* **cnic / ispapi registrar module:** patch issues with missing DkTaCHandler Class 

# 25.3.0 (2025-01-31)


### Features

* **ispapi / cnic registrar module:** add multi-lang support for .dk checkout page 

## 25.2.1 (2025-01-30)


### Bug Fixes

* **cnic registrar module:** return .CA Legal Type as required additional field 

# 25.2.0 (2025-01-30)


### Features

* **ispapi / cnic registrar module:** .DK Order Process reviewed in direction of Flow 1 compliance 

## 25.1.2 (2025-01-22)


### Performance Improvements

* **hexonet registrar module:** upgrade php-sdk to v10 for improved connection handling 

## 25.1.1 (2025-01-22)


### Bug Fixes

* **hexonet registrar module:** update policies url for .ngo / .ong 

# 25.1.0 (2025-01-20)


### Features

* **domain monitoring addon:** Automate Premium Price & Domain Status Updates 

## 25.0.3 (2025-01-15)


### Bug Fixes

* **ispapi registrar module:** add .dk domain terms and conditions additional field 

## 25.0.2 (2025-01-14)


### Bug Fixes

* **hexonet registrar module:** transfers to auto-fallback to 0Y period (to early for 1Y period) , closes #283

## 25.0.1 (2025-01-14)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 8.0.17 to 9.1.0 

# 25.0.0 (2025-01-14)


### Bug Fixes

* **cnic ssl:** take into account included domains amount when validating csr 


### Build System

* **php:** drop php7.4 encryption support 


### Features

* **cnic ssl:** get certificate information from API 
* **cnic ssl:** implement certificate deletion upon product termination 
* **cnic ssl:** implement certificate reissuing 
* **cnic ssl:** implement CSR generation in order process 
* **cnic ssl:** only prompt for private key if autodeploy is enabled and webpros server is detected 
* **cnic ssl:** support wildcard and non-wildcard additional domains on base certs that allow that 


### BREAKING CHANGES

* **php:** Dropped support for PHP 7.4. Please use earlier versions of our module, if you can't upgrade to PHP 8.
* **cnic ssl:** You must reimport certificates using the CNIC SSL addon as additional required
information will get imported

RSRMID-2130

## 24.9.7 (2025-01-07)


### Bug Fixes

* **cnic registrar module:** Added Compatibility to Get EPP Codes for .cn tld 

## 24.9.6 (2025-01-07)


### Bug Fixes

* **domain search addon:** improve domain search functionality and domain search handling exact search terms 

## 24.9.5 (2025-01-07)


### Bug Fixes

* **cnic & ispapi registrar module:** Enhance tracking by passing client ID instead of user ID to logActivity 

## 24.9.4 (2024-12-16)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.42 to 3.0.43 

## 24.9.3 (2024-12-12)


### Bug Fixes

* **cnic registrar module:** update .uk fields translations (to align with recent API changes) 

## 24.9.2 (2024-11-29)


### Bug Fixes

* **domain search addon:** improve handling of selected TLD categories in regular search tab 

## 24.9.1 (2024-11-22)


### Bug Fixes

* **cnic domain search addon:** Update tab action handling and improve domain transfer logic 

# 24.9.0 (2024-11-21)


### Features

* **cnic registrar module:** enhance domain suggestion functionality & added configuration to lookup provider 

## 24.8.3 (2024-11-19)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

## 24.8.2 (2024-11-18)


### Bug Fixes

* **deps:** bump cross-spawn from 7.0.3 to 7.0.6 

## 24.8.1 (2024-11-14)


### Bug Fixes

* **cnic registrar module:** improve domain indexing and validation in CheckDomains command for the domain search 

# 24.8.0 (2024-11-14)


### Features

* **cnic registrar module:** Implement trade cost detection and logging for CNR Integration. Add To-Do List item for costs and invoice creation for end customers. 


### Performance Improvements

* **cnic registrar module:** optimize contact details fetch and save integration 

## 24.7.4 (2024-11-14)


### Performance Improvements

* **cnic registrar module:** optimize contact details fetch and save integration 

## 24.7.3 (2024-11-14)


### Bug Fixes

* **cnic registrar module:** review .au (and related 3rd level tlds) translations / texts 

## 24.7.2 (2024-11-11)


### Bug Fixes

* **cnic registrar module:** review .FI additional domain fields 

## 24.7.1 (2024-11-11)


### Bug Fixes

* **cnic registrar module:** switch fields gen back to non-tmp. workaround (issue with 3rd lvl tlds) 

# 24.7.0 (2024-11-08)


### Bug Fixes

* **cnic registrar module:** added partial missing translation for AFNIC TLDs 
* **cnic registrar module:** improve description for .EU citizenship field 
* **cnic registrar module:** reviewed API error handling within additional domain fields generator 


### Features

* **cnic registrar module:** add .abogado additional domain fields translations 
* **cnic registrar module:** add .aero additional domain fields translations 
* **cnic registrar module:** add .attorney additional fields translations 
* **cnic registrar module:** add .au additional fields translations 
* **cnic registrar module:** add .ca additional fields translations 
* **cnic registrar module:** add .cn additional fields translations and prefilling 
* **cnic registrar module:** add .com.br additional fields translations 
* **cnic registrar module:** add .coop additional fields translations 
* **cnic registrar module:** add .dk additional domain fields translations 
* **cnic registrar module:** add .es additional domain fields translations 
* **cnic registrar module:** add .fi additional domain fields translations 
* **cnic registrar module:** add .gay additional domain fields translations 
* **cnic registrar module:** add .HK additional domain fields translations 
* **cnic registrar module:** add .ie additional domain fields translations 
* **cnic registrar module:** add .LT additional domain fields translations 
* **cnic registrar module:** add .LV additional domain fields translations 
* **cnic registrar module:** add .MK additional domain fields translations 
* **cnic registrar module:** add .MY additional domain fields translations 
* **cnic registrar module:** add .NO additional domain fields translations 
* **cnic registrar module:** add .NU additional domain fields translations 
* **cnic registrar module:** add .NYC additional domain fields translations 
* **cnic registrar module:** add .PARIS additional domain fields translations 
* **cnic registrar module:** add .PT additional fields translations 
* **cnic registrar module:** add .RO additional domain fields translations 
* **cnic registrar module:** add .RU additional domain fields translations 
* **cnic registrar module:** add .SE additional domain fields translations 
* **cnic registrar module:** add .SG additional domain fields translations 
* **cnic registrar module:** add .SWISS additional domain fields translations 
* **cnic registrar module:** add .TRAVEL addditional domain fields translations 
* **cnic registrar module:** add .US additional domain fields translations 
* **cnic registrar module:** add .XXX additional domain fields translations 
* **cnic registrar module:** add Google TLD additional domain fields translations 
* **cnic registrar module:** add prefilling for .SWISS Owner Type field 
* **cnic registrar module:** add. fields: .IE lang preselection; default to EN for lang fields 

## 24.6.2 (2024-10-31)


### Bug Fixes

* **domain search addon:** Patch issue causing filters and additional options to ignore configurations 
* **ispapi & cnic registrar module:** Patch issue causing monitoring errors on Premium domains renewals 

## 24.6.1 (2024-10-23)


### Bug Fixes

* **domain search addon:** patched cache clearing ttl expiry timeout loops 

# 24.6.0 (2024-10-22)


### Features

* **domain search addon:** enhance caching and UI features for better user experience 

## 24.5.4 (2024-10-22)


### Bug Fixes

* **ispapi registrar module:** additional field issue (X-ACCEPT-SSL-REQUIREMENT) with contact updates 

## 24.5.3 (2024-10-16)


### Bug Fixes

* **cnic registrar module:** add platform config to composer to ensure PHP 7.4 emulation 

## 24.5.2 (2024-10-16)


### Bug Fixes

* **cnic:** ensure PHP 7.4 compatibility in vendor libs 

## 24.5.1 (2024-10-15)


### Bug Fixes

* **activity logging:** forward 0 as uid if there is no client session or uid present there 

# 24.5.0 (2024-10-11)


### Bug Fixes

* **cnic ssl:** fix php 7.4 compatibility 
* **cnic ssl:** prevent scenario where products are missing registrar property in db 


### Features

* **cnic ssl module:** implement automatic cert validation configuration and cert installation for Plesk/DirectAdmin/cPanel 

# 24.4.0 (2024-10-10)


### Features

* **cnic registrar module:** add translations for .uk additional fields 
* **cnic registrar module:** introduced registrar setting Automatic DNSSEC Deactivation on Transfer 

## 24.3.2 (2024-10-09)


### Bug Fixes

* **cnr domain registrar:** added ioncube support for php 8.1 and 8.2 

## 24.3.1 (2024-10-08)


### Bug Fixes

* **deps:** bump lit from 3.2.0 to 3.2.1 in /domain-search-src-files 

# 24.3.0 (2024-10-07)


### Features

* **hexonet & cnr registrar module:** added support for PHP 8.2 & support for WHMCS v8.11+ 

# 24.2.0 (2024-10-04)


### Features

* **cnic registrar module:** support for the High-Performance Setup via Registrar Module Settings 

# 24.1.0 (2024-10-02)


### Bug Fixes

* **domain-search-addon:** patched domain extraction and formatting logic 


### Features

* **cnic registrar module:** add additional field translations for .SK 

# 24.0.0 (2024-09-30)


### Bug Fixes

* **cnr registrar module:** additional domain fields: improvements for .eu, .fr, it 


### Features

* **cnr registrar module:** additional fields lang files/support: english, german, french, arabic (.de,.eu,.fr,.it for now) 


### BREAKING CHANGES

* **cnr registrar module:** For HEXONET/ispapi customers: please remove the include statements you have for our language files in your language override files under /lang/overrides.

## 23.13.2 (2024-09-27)


### Bug Fixes

* **domain-search-addon:** Improved domain cleaning logic to handle unsupported TLDs by merging and retaining only the matching TLD for search 

## 23.13.1 (2024-09-27)


### Bug Fixes

* **cnr registrar module:** consider fullphonenumber instead of phonenumber (missing phone-cc) 

# 23.13.0 (2024-09-17)


### Features

* **domain search addon:** support custom language files for official languages if available 

## 23.12.1 (2024-09-16)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.41 to 3.0.42 

# 23.12.0 (2024-09-09)


### Bug Fixes

* **cnic ssl:** fix multiline file content handling for sectigo certificates 


### Features

* **cnic registrar module:** Extend domain renewal mode status and settings for TLDs that do not support explicit renewals via admin panel client domains configuration 

## 23.11.1 (2024-09-06)


### Bug Fixes

* **domain-search-addon:** Fix client theme path and premium domains toggle in search engine admin config 

# 23.11.0 (2024-09-02)


### Features

* **domain-search-addon:** Add support for custom languages 

## 23.10.7 (2024-08-26)


### Bug Fixes

* **ispapi registrar module:** .health transfer: skip additional fields (for registration only) 

## 23.10.6 (2024-08-22)


### Bug Fixes

* **cnic registrar module:** include .itregional TLDs in GetTldPricing import 

## 23.10.5 (2024-08-12)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.39 to 3.0.41 

## 23.10.4 (2024-08-06)


### Bug Fixes

* **deps:** bump lit from 3.1.4 to 3.2.0 in /domain-search-src-files 

## 23.10.3 (2024-08-05)


### Bug Fixes

* **ispapi registrar module:** add missing registration prices for some premium domains 
* **ssl:** product configuration option is now hard linked to the product 


### Performance Improvements

* **domain-search-addon:** add custom.css stylesheet for custom styling 

## 23.10.2 (2024-07-29)


### Bug Fixes

* **domain-search-addon:** resolve 'TLD not supported' error in transfer results 

## 23.10.1 (2024-07-25)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

# 23.10.0 (2024-07-25)


### Features

* **domain-search-addon:** introduced configuration to turn on/off mobile sticky menu and improved UI 

## 23.9.1 (2024-07-24)


### Bug Fixes

* **domain-search-addon:** resolve domain price range and default tab issues 
* **domain-search-addon:** resolved issue with suggestions tab causing no results to display in some cases 

# 23.9.0 (2024-07-23)


### Features

* **domain search addon:** Add functionality to reorder feature tabs for enhanced organization 

## 23.8.5 (2024-07-23)


### Bug Fixes

* **domain-search-addon:** resolve issue causing no results to display in some cases 

## 23.8.4 (2024-07-22)


### Bug Fixes

* **domain search addon:** correct TLD matching for third-level domains and improve domain extraction 

## 23.8.3 (2024-07-19)


### Bug Fixes

* **ispapi + cnic registrar module:** deactivate charset/collation setting when creating DB Tables 

## 23.8.2 (2024-07-17)


### Bug Fixes

* **cnic ssl module:** fix cert renew not updating cert id 

## 23.8.1 (2024-07-17)


### Bug Fixes

* **domain search addon:** reviewed and revamped menu for mobile and devices with smaller screens 

# 23.8.0 (2024-07-11)


### Features

* **domain search addon:** Remove additional scroll bar and implement infinite scrolling with browser scroll bar for better UX 

## 23.7.11 (2024-07-09)


### Bug Fixes

* **ispapi registrar module:** deprecation of Afternic and Namemedia aftermarket domains 

## 23.7.10 (2024-07-09)


### Bug Fixes

* **ispapi registrar module & domain search addon:** Changed aftermarket domain status to unavailable if no pricing, and domain search referrer from whmcs to system for reseller compatibility. 

## 23.7.9 (2024-07-08)


### Bug Fixes

* **ispapi registrar module:** patch .pm contact handling for transfers 

## 23.7.8 (2024-07-04)


### Bug Fixes

* **cnic registrar module:** fix pricing import (issue with IDN converter) 

## 23.7.7 (2024-07-04)


### Bug Fixes

* **ispapi registrar module:**  Reviewed and patched premium domains check which was flagging  premium domains as not available 

## 23.7.6 (2024-06-24)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.38 to 3.0.39 

## 23.7.5 (2024-06-17)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.37 to 3.0.38 

## 23.7.4 (2024-06-12)


### Bug Fixes

* **cnic dns & migration addon:** reviewed & fixed navbar styling and optimised user viewability 

## 23.7.3 (2024-06-06)


### Bug Fixes

* **cnic migrator addon:** patched format of displayed dates 

## 23.7.2 (2024-06-06)


### Bug Fixes

* **ispapi registrar module:** patch renewal mode shown/preselected 

## 23.7.1 (2024-06-05)


### Bug Fixes

* **deps:** bump lit from 3.1.3 to 3.1.4 in /domain-search-src-files 

# 23.7.0 (2024-06-05)


### Bug Fixes

* **cnic dns templating addon:** fix Template::apply to consider an optionally provided domain id 
* **ispapi registrar module:** SaveDNS using wrong TTL 


### Features

* **dns templating addon:** apply dns template after successful transfer 

## 23.6.1 (2024-06-03)


### Bug Fixes

* **cnic migrator & domain import addon:** reviewed & replaced deprecated php functions 

# 23.6.0 (2024-05-31)


### Features

* **ispapi registrar module:** creates an invoice when domain owner change is requested 

# 23.5.0 (2024-05-21)


### Bug Fixes

* **ispapi registrar module:** patch DNS Management's ALIAS RR in direction of type X-ALIAS-A 


### Features

* **cnic domain registrar:** mark non-instant domain registrations as pending registration status 

## 23.4.5 (2024-05-08)


### Performance Improvements

* **cnic registrar module:** perf. review of Registrar Lock Support Detection for UI update 
* **ispapi registrar module:** perf. review of Registrar Lock Support Detection for UI update 

## 23.4.4 (2024-05-07)


### Bug Fixes

* **ispapi registrar module:** cleanup var_dump 

## 23.4.3 (2024-05-02)


### Bug Fixes

* **ispapi/cnic registrar module:** fix icons / counter of widgets 

## 23.4.2 (2024-05-02)


### Bug Fixes

* **cnic registrar module:** review sync method to cover foreign transfers correctly 

## 23.4.1 (2024-05-02)


### Bug Fixes

* **ispapi registrar module:** cleanup relicts of old IDN Converter library 

# 23.4.0 (2024-05-02)


### Features

* **cnic domain search:** Enable Direct Link Search with Predefined Search Term to Skip Two-Step SearchProcess 

## 23.3.6 (2024-04-30)


### Bug Fixes

* **do not upgrade:** internal testing fix for the broken archives - do not upgrade 

## 23.3.5 (2024-04-30)


### Bug Fixes

* **archives:** this is just a test release to check broken archives - do not upgrade 

## 23.3.4 (2024-04-25)


### Bug Fixes

* **ispapi registrar module:** review .swiss additional fields to support natural persons 

## 23.3.3 (2024-04-18)


### Bug Fixes

* **release process:** building registrar logo with version number 
* **release process:** reviewed gulp tasks and gh secrets usage 

## 23.3.2 (2024-04-16)


### Bug Fixes

* **deps:** bump lit from 3.1.2 to 3.1.3 in /domain-search-src-files 

## 23.3.1 (2024-04-16)


### Bug Fixes

* **cnic registrar module:** patch PHP Warning in Command Library StatusDomain 

# 23.3.0 (2024-04-11)


### Bug Fixes

* **cnic ssl module:** avoid showing duplicate validation information in Client Area 
* **cnic ssl module:** fix revoke certificate in CNIC 
* **ispapi registrar module:** patch dns management in direction of IDNs in address field 


### Features

* **cnic ssl module:** improve wildcard domain handling in CSR parsing 


### Performance Improvements

* **ispapi registrar module:** reviewed & replaced api idn conversion with php-idn-converter 

## 23.2.5 (2024-04-10)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

## 23.2.4 (2024-04-08)


### Bug Fixes

* **zip archive:** rebuild (docker container patch) 

## 23.2.3 (2024-04-06)


### Bug Fixes

* **cnic ssl module:** fix parsing of DNS records for Sectigo certificates 

## 23.2.2 (2024-04-05)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 8.0.16 to 8.0.17 

## 23.2.1 (2024-04-05)


### Bug Fixes

* **ispapi registrar module:** reviewed renewalmode UI for .at,.dk etc tlds 

# 23.2.0 (2024-03-20)


### Features

* **ispapi registrar module:** Allow resellers to change domain renewals to AUTODELETE on specific tlds e.g. (.DK, .AT, etc) from Domain Configurations via admin panel 

# 23.1.0 (2024-03-19)


### Features

* **cnic registrar module:** suppress api-side id protection service on demand 
* **ispapi registrar module:** suppress api-side id protection service on demand 

## 23.0.5 (2024-03-15)


### Bug Fixes

* **cnic ssl module:** fix centralnic dns validation method for some certificate classes 
* **cnic ssl module:** fix unable to order wildcard certificates with CNIC 
* **cnic ssl module:** improve CSR validation 
* **cnic ssl module:** improve handling of DNS and FILE validation methods in CNIC 

## 23.0.4 (2024-03-13)


### Performance Improvements

* **cnic domain search:** minifying javascript source files to improve the performance and user experience 

## 23.0.3 (2024-03-12)


### Bug Fixes

* **cnic domain search addon:** remove invalid characters from searched keywords 

## 23.0.2 (2024-03-12)


### Bug Fixes

* **cnic ssl module:** fix CNIC certificates not showing in status 

## 23.0.1 (2024-03-12)


### Bug Fixes

* **cnic migrator addon:** fix merge issue 

# 23.0.0 (2024-03-11)


### Features

* **cnic migrator addon:** switch email configuration files to email templates 


### BREAKING CHANGES

* **cnic migrator addon:** We switched from json configuration file based approach to using WHMCS built-in
email templating system. Check our Documentation at https://www.hexonet.support/hc/en-gb/articles/13653135500573-WHMCS-Domain-Migrator-Addon Section Client Email Templates and following.

## 22.7.5 (2024-3-7)


### Bug Fixes

* **cnic ssl module:** fix contact handling in CentralNic SSL module 

## 22.7.4 (2024-3-7)


### Performance Improvements

* **release automation:** to no longer use Chrome for web scripting 

## 22.7.3 (2024-3-6)


### Bug Fixes

* **ispapi registrar module:** additional fields: add description for field .IT PIN 
* **ispapi registrar module:** additional fields: add description for field .IT PIN (Transfer) 

## 22.7.2 (2024-3-6)


### Bug Fixes

* **software bundle:** patched issues with ioncube encryption mechanism 

## 22.7.1 (2024-3-5)


### Bug Fixes

* **cnic registrar module:** create todo item for 0Y term transfers only if pricing is not 0.00 
* **ispapi registrar module:** create todo item for 0Y term transfers only if pricing is not  0.00 

# 22.7.0 (2024-3-4)


### Bug Fixes

* **cnic dns templating addon:** review default nameservers for DNS Management 
* **dns addon:** fix handling of IDN domains 


### Features

* **dns addon:** add option to enforce registry nameservers when creating dns zone 
* **ispapi registrar module:** nameserver configuration setting for dns templating addon 

## 22.6.3 (2024-3-4)


### Bug Fixes

* **ispapi registrar module:** improved error messaging for domain transfers pre-checks 

## 22.6.2 (2024-3-4)


### Bug Fixes

* **cnic registrar module:** patch handling of contact data's middlename via firstname field 

## 22.6.1 (2024-3-1)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files 

# 22.6.0 (2024-2-27)


### Features

* **ispapi/cnic registrar module:** client area nameserver update to show a provider-specific error 

# 22.5.0 (2024-2-27)


### Features

* **cnic registrar module:** add auto-loading custom hooks file (/resources/hooks_cnic_custom.php) 

## 22.4.9 (2024-2-26)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.35 to 3.0.36 

## 22.4.8 (2024-2-26)


### Bug Fixes

* **hexonet registrar module:** (89) Show aftermarket domains as available via regular domain tab in cnic domain search addon and whmcs core search engine 

## 22.4.7 (2024-2-26)


### Bug Fixes

* **ispapi registrar module:** patch loading the list of existing email forwardings 

## 22.4.6 (2024-2-22)


### Bug Fixes

* **cnic / ispapi registrar module:** ignore Migrator Addon related Transfers in Post-Transfer Processing 

## 22.4.5 (2024-2-19)


### Bug Fixes

* **cnic migrator addon:** fix country code field forwarding to HEXONET integration 

## 22.4.4 (2024-2-16)


### Bug Fixes

* **cnr registrar module:** fix additional fields generator (.fr at least affected) 

## 22.4.3 (2024-2-15)


### Bug Fixes

* **cnic registrar module:** patched .EU domain transfers with too many contact data submitted 
* **cnic registrar module:** using unformatted phone number for registrations and transfers 

## 22.4.2 (2024-2-15)


### Bug Fixes

* **composer.json:** deprecated PHP version requirement 

## 22.4.1 (2024-2-9)


### Bug Fixes

* **cnr registrar module:** aftermarket integration: check for registrar id before processing 
* **cnr registrar module:** aftermarket integration: don't set a registration to pending transfer 
* **hooks:** fixed scope of hooks 
* **ispapi registrar module:** keep non-realtime registrations pending until completion e.g. .dk 

# 22.4.0 (2024-2-6)


### Features

* **cnr registrar module:** Implemented Transfer Status and Log integration for domains in "Pending Transfer" status 

## 22.3.8 (2024-2-3)


### Bug Fixes

* **migrator:** improve database performance 

## 22.3.7 (2024-2-2)


### Bug Fixes

* **cnic dns addon:** Ensure freshly created DNS Templates are available for Bulk Update 

## 22.3.6 (2024-2-2)


### Bug Fixes

* **ispapi registrar module:** fix SaveDNS integration (return error case of internal GetDNS call) 

## 22.3.5 (2024-2-2)


### Bug Fixes

* **cnr registrar module:** minor improvement for setting transferlock within registration process 

## 22.3.4 (2024-2-1)


### Bug Fixes

* **deps:** bump lit from 3.1.1 to 3.1.2 in /domain-search-src-files 

## 22.3.3 (2024-2-1)


### Bug Fixes

* **domain search addon:** enhance Compatibility for WHMCS Database Operations 


### Performance Improvements

* **css and javascripts:** preloading stylesheets and defer loading javascripts to improve UI 

## 22.3.2 (2024-1-30)


### Performance Improvements

* **css and js files:** reviewed and optimised css and js file with resource hints 

## 22.3.1 (2024-1-24)


### Bug Fixes

* **cnic and ibs registrar:** patch for adding to do items for  domain transfers without renewals 

# 22.3.0 (2024-1-22)


### Features

* **ispapi/cnr/ibs registrar module:** add todo item in case of free/0Y transfer 

## 22.2.1 (2024-1-18)


### Bug Fixes

* **ispapi & cnic registrar:** exclude invalid domains from appearing in the SearchEngine via API 

# 22.2.0 (2024-1-16)


### Features

* **domain search addon:** Added a quick link for Aftermarket domains in Regular/Suggestions tab search results, directing users to the Aftermarket search tab. 

## 22.1.2 (2024-1-16)


### Bug Fixes

* **domain search addon:** Marking Aftermarket domains as reserved in regular and suggestion tabs. 

## 22.1.1 (2024-1-15)


### Bug Fixes

* **domain search addon:** Fixed an issue that was preventing the adding domains to the cart for domain transfers. 

# 22.1.0 (2024-1-15)


### Features

* **domain search addon:** aftermarket domains integration for HX and CNIC 

## 22.0.5 (2024-01-11)


### Bug Fixes

* **ispapi registrar module:** .ES fields (X-ES-REGISTRANT-TIPO-IDENTIFICACION, add option VAT ID) 

## 22.0.4 (2024-01-10)


### Bug Fixes

* **deps:** bump lit from 3.1.0 to 3.1.1 in /domain-search-src-files 

## 22.0.3 (2024-01-10)


### Bug Fixes

* **domain search addon:** fixed the stylesheet loading issue for WHMCS installations in sub-folders 

## 22.0.2 (2024-01-10)


### Bug Fixes

* **ispapi registrar module:** temporarily deactivate premium domain data auto-cleanup 

## 22.0.1 (2024-01-09)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.34 to 3.0.35 

# 22.0.0 (2024-01-09)


### Features

* **ssl:** implement new CNR SSL API 2.0 


### BREAKING CHANGES

* **ssl:** Existing legacy certificates must be migrated by opening the SSL Addon once.

## 21.6.13 (2024-01-08)


### Bug Fixes

* **cnr registrar:** fix ignored error on domain status when domain is transfered away 

## 21.6.12 (2023-12-15)


### Bug Fixes

* **cnr registrar:** make sure DNS zone is existing when saving records 
* **dns addon:** fix template failing to apply 

## 21.6.11 (2023-12-14)


### Bug Fixes

* **domain search addon:** Updated the link for transferring domains to our search engine addon URL, overriding the default Store > Transfer Domain To Us link. 

## 21.6.10 (2023-12-14)


### Bug Fixes

* **domain search addon:** Fixed the "cannot redeclare gettldlist" error issue for specific resellers. 

## 21.6.9 (2023-12-07)


### Bug Fixes

* **domain search addon:** Domain transfer authorization codes with dots (.) were not being processed correctly. 

## 21.6.8 (2023-11-24)


### Bug Fixes

* **cnic registrar module:** remove contact-related params NEW, PREVERIFY and AUTODELETE 

## 21.6.7 (2023-11-24)


### Bug Fixes

* **ispapi registrar module:** tLD & Pricing Import to ignore garbage data from API e.g. .nu (CA) 

## 21.6.6 (2023-11-17)


### Bug Fixes

* **deps:** bump lit from 3.0.2 to 3.1.0 in /domain-search-src-files 

## 21.6.5 (2023-11-10)


### Bug Fixes

* **ci:** test release process after rewrite (no need to upgrade) 
* **deps:** bump lit from 3.0.1 to 3.0.2 in /domain-search-src-files 
* **ispapi registrar module:** fix Transfer integration and use of additional fields (e.g. .dk) 
* **release process:** patch release process 

## 21.6.4 (2023-11-02)

### Bug Fixes

- **deps:** bump idna-uts46-hx in /domain-search-src-files 
- **deps:** bump lit from 3.0.0 to 3.0.1 in /domain-search-src-files 

## 21.6.3 (2023-10-30)

### Bug Fixes

- **ibs / cnic / ispapi registrar modules:** patch issue with if branch in dnssec template 

## 21.6.2 (2023-10-30)

### Bug Fixes

- **ibs / cnic / ispapi registrar modules:** review dnssec template for translation support , closes #271

## 21.6.1 (2023-10-25)

### Bug Fixes

- **ispapi registrar module:** reviewed handling of applications (premium domains, .swiss et al) 

# 21.6.0 (2023-10-20)

### Features

- **cnic registrar module:** add support for managing DS records in DNSSEC 
- **cnic registrar module:** automatically detect if DNSSEC supports DS records for TLD 
- **ibs registrar module:** automatically detect if DNSSEC supports DS records for TLD 
- **ispapi registrar module:** auto-detect which dnssec form is supported (dsdata or dnskey) 
- **ispapi registrar module:** revamped DNSSEC management feature 

## 21.5.4 (2023-10-12)

### Bug Fixes

- **ssl module:** fix default registrar fallback 

## 21.5.3 (2023-10-12)

### Bug Fixes

- **ispapi registrar module:** review additional domain fields for TLD .giving 

## 21.5.2 (2023-10-11)

### Bug Fixes

- **cnic registrar module:** deprecate & cleanup of feature "Daily Cron" 

## 21.5.1 (2023-10-11)

### Bug Fixes

- **cnic & ispapi registrar module:** Domain private Nameservers access and deletion functionality fixed. 

# 21.5.0 (2023-10-09)

### Features

- **cnic registrar module:** added AA buttons for approving/rejecting outgoing transfers 
- **ispapi registrar module:** added AA buttons for approving/rejecting outgoing transfers 

## 21.4.7 (2023-10-09)

### Bug Fixes

- **package.json:** bumped semantic-release-whmcs package depedency to 5.0.4 (no need to upgrade) 

## 21.4.6 (2023-10-02)

### Bug Fixes

- **cnic registrar module:** add DNSZone for EmailForwardings if not present 

## 21.4.5 (2023-09-29)

### Bug Fixes

- **ispapi/cnic registrar module:** additional domain fields validation scope & processing 

## 21.4.4 (2023-09-28)

### Bug Fixes

- **ispapi registrar module:** reviewed Get/SaveEmailforwarding. Create DNSZone dnsmanagement-like 

## 21.4.3 (2023-09-28)

### Bug Fixes

- **cnic domain monitoring addon:** patched an issue throwing an error on activation 

## 21.4.2 (2023-09-28)

### Bug Fixes

- **migrator addon:** store EPP codes without encoded HTML entities 

## 21.4.1 (2023-09-28)

### Bug Fixes

- **cnic domain monitoring addon:** delete record functionality patch 
- **cnic domain monitoring addon:** patch to recalculate premium prices manually with extended info 

# 21.4.0 (2023-09-27)

### Features

- **cnic domain monitoring addon:** Sync premium status and apply pricing updates to domains 

## 21.3.1 (2023-09-26)

### Bug Fixes

- **ispapi registrar module:** patch PHP Error in GetContactDetails in case of missing API data 

# 21.3.0 (2023-09-25)

### Features

- **cnic & ispapi registrar module:** implemented validation for additional fields on the domain cart page 

## 21.2.4 (2023-09-25)

### Bug Fixes

- **ispapi registrar module:** .eu domain registration error due to conflicting client data fields 

## 21.2.3 (2023-09-20)

### Bug Fixes

- **cnic search engine addon:** fixed ob_start conflict with zlib compression 

## 21.2.2 (2023-09-13)

### Bug Fixes

- **ispapi registrar:** add multiple improvements to DNS Management and detection of duplicate RRs , closes #267

## 21.2.1 (2023-09-06)

### Bug Fixes

- **cnic domain search addon:** patched an issue related to add/remove items to cart 

# 21.2.0 (2023-09-05)

### Features

- **cnic domain search addon:** notifications when adding items to cart; UI for info in transfer tab 

## 21.1.2 (2023-08-31)

### Bug Fixes

- **cnic domain search addon:** sidebar menu entries on review & checkout page 

## 21.1.1 (2023-08-31)

### Bug Fixes

- **cnic domain search addon:** patched a bug related to domain transfers auth code 

# 21.1.0 (2023-08-31)

### Features

- **ispapi registrar module:** to-Do List add: failed post-transfer updates + non-free domain trades 

## 21.0.3 (2023-08-29)

### Bug Fixes

- **readme:** updated path of readme.md file 

## 21.0.2 (2023-08-29)

### Bug Fixes

- **readme.md:** updated readme.md file 

## 21.0.1 (2023-08-28)

### Bug Fixes

- **cnic domain importer:** fix controller endpoints json response for http code 200 

# 21.0.0 (2023-08-28)

### Bug Fixes

- **cnic + ispapi registrar module:** inject private nameserver list now via child theme 
- **ispapi registrar module:** add global default TTL Setting for DNS RR 
- **ispapi registrar module:** deprecated add. fields injection in admin area (contact information) 
- **ispapi registrar module:** Dns Management replacement for RR deletion via wildcard 

### Features

- **cnic + ispapi registrar module:** add exact error of DNS Update to output and more record types (child theme) 
- **cnic + ispapi registrar module:** add support for TTL field for DNS Management Section 
- **cnic + ispapi registrar module:** review private nameserver deletion for better UX 
- **cnic registrar module:** add support for MXE resource record (internally covered via MX, A) 
- **cnic sex/twenty-one theme:** show success message for succeeded dns update 
- **ispapi registrar module:** offer more supported DNS Resource Records 

### BREAKING CHANGES

- **ispapi registrar module:** The way of doing the additional domain fields injection on contact information page in admin are wasn't compatible to all themes and were it did not work, we run into bugs. If you want to cover a contact update via admin area, please do the additional fields update via domain details first and then the contact update itself.
- **cnic + ispapi registrar module:** We use beneficial child themes now (compatible to WHMCS 8) to improve the DNS Management Section. We added a TTL field plus better error / success messaging and more supported resource records. Please ensure so update your template fields by taking over custom changes we applied to includes/alert.tpl and clientareadomaindns.tpl. Find our custom files under /templates/cnic-six or /templates/cnic-twenty-one. Custom changes are wrapped with comments to ease up taking them over.
- **cnic + ispapi registrar module:** Javascript-based way for private Nameserver List injection got replaced by
  injection over child theme.

## 20.0.4 (2023-08-28)

### Bug Fixes

- **cnic domain search addon:** input search fix for bulk domain transfers 

## 20.0.3 (2023-08-25)

### Bug Fixes

- **cnic registrar module:** .dk transfers to be initiated without contact data 

## 20.0.2 (2023-08-24)

### Bug Fixes

- **composer dependencies:** changed the way of producing the vendor directory 

## 20.0.1 (2023-08-04)

### Bug Fixes

- **cnic & ispapi registrar module:** patch for pre-select domain addons on checkout 

# 20.0.0 (2023-08-04)

### Bug Fixes

- **cnic registrar module:** patch GetContactDetails to return all contact even if not set 
- **ispapi registrar module:** improved description for .NO "Registrant ID Number" additional field 
- **ispapi registrar module:** inject additional fields via Child Theme (deprecate JS solution) 

### BREAKING CHANGES

- **ispapi registrar module:** Replaced our Javascript-based injection of additional fields into the contact
  information form in clientarea with a mechanism using Child Themes.

## 19.1.3 (2023-07-31)

### Bug Fixes

- **cnic dns addon:** disable Apply button while in progress 

## 19.1.2 (2023-07-31)

### Bug Fixes

- **cnic registrar module:** review registrar context in hooks 

## 19.1.1 (2023-07-31)

### Bug Fixes

- **cnic registrar module:** additional fields conditional requirements detection 

# 19.1.0 (2023-07-27)

### Features

- **cnic dns addon:** add ability to bulk apply templates to multiple domains 

## 19.0.16 (2023-07-26)

### Bug Fixes

- **cnic registar module:** fix issue with additional fields update in `_SaveContactDetails` 

## 19.0.15 (2023-07-26)

### Bug Fixes

- **cnic registrar module:** domain Sync to map Active to Transferred Away 

## 19.0.14 (2023-07-26)

### Bug Fixes

- **ispapi registrar module:** add X-AT-DISCLOSE = 0 in contact data updates (auto-hide contact data) 

## 19.0.13 (2023-07-25)

### Bug Fixes

- **cnic registrar module:** no PHP error when saving contact data in context of pending domains 

## 19.0.12 (2023-07-25)

### Bug Fixes

- **cnic domain search add-on:** Patched domain suggestion search ending in PHP error 

## 19.0.11 (2023-07-24)

### Bug Fixes

- **cnic registrar module:** fix transfer precheck on shopping cart 

## 19.0.10 (2023-07-24)

### Bug Fixes

- **cnic and ispapi registrar module:** beautifying the system activity logs 
- **ispapi registrar module:** getEPPCode for .NZ, .FI reviewed 
- **ispapi registrar module:** logging for renewal patched 

## 19.0.9 (2023-07-18)

### Bug Fixes

- **ispapi + cnic registrar module:** cleanup additional fields handling in \_GetDomainInformation 

## 19.0.8 (2023-07-14)

### Bug Fixes

- **cnic ssl addon:** patch ouput of Intermediate Cert + Root Cert for CNR 

## 19.0.7 (2023-07-13)

### Bug Fixes

- **cnic registrar module:** replace comma in additional field option labels (=new option for WHMCS) 

## 19.0.6 (2023-07-13)

### Bug Fixes

- **cnic domain importer:** do not include additional fields in import (auto-reg lookup of whmcs) 
- **cnic registrar module:** patch AdditionalFields' Class internal function call to $this context 

## 19.0.5 (2023-07-13)

### Bug Fixes

- **cnic registrar module:** patched issue related to domain status for DNS management 

## 19.0.4 (2023-07-13)

### Bug Fixes

- **cnic ssl addon:** works again with ispapi registrar module 

## 19.0.3 (2023-07-12)

### Bug Fixes

- **cnic registrar module:** review and cleanup of additional fields' required property detection 

## 19.0.2 (2023-07-11)

### Bug Fixes

- **cnic registrar module:** patch issue in field generator 

## 19.0.1 (2023-07-10)

### Bug Fixes

- **cnic registrar module:** cleanup additional fields tmp. workaround 

# 19.0.0 (2023-07-10)

### Features

- **cnic registrar module:** api-driven additional domain fields integration (no config required) 

### BREAKING CHANGES

- **cnic registrar module:** New API-driven way for Additional Domain Fields added. Therefore, a custom configuration via /resources/domains/additionalfields.php is no longer required for the cnic registrar module. It follows the HEXONET Brand in that regard with few improvements. The Integration itself in direction of additional domain fields is by this step fully API-driven and with no support effort (missing or wrong additional domain fields configuration) and it makes a custom configuration entirely superfluous. In addition, we have made auto-prefilling available for tax id, language, country related input fields and we made the fields 100% translatable via Language Override Files.
  If you're interested in adding your custom translation, add domains with TLDs of interests to your Shopping Cart and switch to the Shopping Cart Item's Configuration. There, add "&showtranslationkeys=1" to the URL and press enter. Instead of the texts, you'll now see the Translation Keys which can be used in the Language Override files for adding your custom translations. If you remove that URL parameter again, texts will be displayed as usual. The fallback will always be our default english texts in case a translation is not present. It allows for translating step by step.

## 18.0.3 (2023-07-07)

### Bug Fixes

- **cnic domain search engine addon:** fixed DB query issue preventing addon upgrade 

## 18.0.2 (2023-07-05)

### Bug Fixes

- **cnic domain search addon:** updated broken url in spotlight tlds section 

## 18.0.1 (2023-07-05)

### Bug Fixes

- **cnic ssl addon:** patch issue with missing dependency utopia/domains 

# 18.0.0 (2023-07-03)

### Features

- **cnic domain search addon:** Deprecating domain search v2 and introducing domain search v3 

### BREAKING CHANGES

- **cnic domain search addon:** In this release, we have deprecated Version 2 of our ISPAPI Domain Search addon. As a result, it is no longer accessible. We kindly ask you to remove the older version of our domain search addon and start with the Version 3. To take advantage of the new and improved Domain Search with exciting features, we recommend reading and following our updated public documentation.

## 17.2.26 (2023-07-03)

### Bug Fixes

- **cnic registrar module:** fix private nameservers page in client area not working 

## 17.2.25 (2023-06-28)

### Bug Fixes

- **ispapi registrar module:** improve additional fields injection theme compatibility (lagom) 

## 17.2.24 (2023-06-23)

### Bug Fixes

- **cnic registrar module:** remove additional fields for .SWISS Domain Transfers 

## 17.2.23 (2023-06-22)

### Bug Fixes

- **cnic registrar module:** patch .swiss transfers (consider lower-case parameter name) 

## 17.2.22 (2023-06-22)

### Bug Fixes

- **migrator addon:** abort migration if non-premium domain is premium on target registrar 

## 17.2.21 (2023-06-22)

### Bug Fixes

- **cnic registrar module:** missing .ES additional fields (Admin, Tech, Billing) for registrations 
- **cnic registrar module:** patch .SWISS Transfer (removing parameter CLASS = SWISS-GOLIVE) 
- **ispapi registrar module:** patch dns management activation via sync to rely on dnszone status 

## 17.2.20 (2023-06-16)

### Performance Improvements

- **cnic registrar module:** remove check for last version in registrar module overview 

## 17.2.19 (2023-06-16)

### Bug Fixes

- **cnic registrar module:** premium domain transfer support 

## 17.2.18 (2023-06-14)

### Bug Fixes

- **ispapi registrar module:** migrate connectivity check to \_config_validate 

## 17.2.17 (2023-06-14)

### Bug Fixes

- **cnic registrar module:** move connection validation to \_config_validate 

## 17.2.16 (2023-06-13)

### Bug Fixes

- **cnic registrar module:** use configured data for admin/tech/billing if not ＂Use Clients Details＂ 

## 17.2.15 (2023-06-12)

### Bug Fixes

- **cnic registrar module:** fix expirydate detection (consider api property renewaldate) 

## 17.2.14 (2023-06-09)

### Bug Fixes

- **cnic registrar module:** patched PHP Error in SaveContactDetails 

## 17.2.13 (2023-06-09)

### Bug Fixes

- **ispapi registrar module:** dNS Management 

## 17.2.12 (2023-06-07)

### Bug Fixes

- **ispapi registrar module:** restrict output of "Cancel Transfer", "Resend Transfer Approval Email" 

## 17.2.11 (2023-06-07)

### Bug Fixes

- **cnic + ispapi registrar module:** patch getConfigArray to consider custom admin folder name 

## 17.2.10 (2023-06-06)

### Bug Fixes

- **ispapi registrar module:** update .HK registration policies url 

## 17.2.9 (2023-06-05)

### Bug Fixes

- **ispapi registrar module:** generic field solution for google TLDs (X-ACCEPT-SSL-REQUIREMENT) 

## 17.2.8 (2023-06-02)

### Bug Fixes

- **cnic registrar module:** patch wrong output of eppcode with special chars 

## 17.2.7 (2023-06-02)

### Bug Fixes

- **ispapi registrar module:** patched expirydate for new regs (finalization-, failuredate n/a yet) 

## 17.2.6 (2023-05-31)

### Bug Fixes

- **cnic registrar module:** fix .SWISS additional domain fields binding to default WHMCS' fields 

## 17.2.5 (2023-05-31)

### Bug Fixes

- **ispapi registrar module:** contact information form & reviewed additional domain fields injection 

## 17.2.4 (2023-05-30)

### Bug Fixes

- **ispapi registrar module:** remove X-SE-ACCEPT-REGISTRATION-TAC from Contact Update 

## 17.2.3 (2023-05-24)

### Bug Fixes

- **cnic registrar module:** include contact data in .SI Transfer Request 

## 17.2.2 (2023-05-22)

### Bug Fixes

- **ispapi registrar module:** add missing namespace to class Carbon 

## 17.2.1 (2023-05-22)

### Bug Fixes

- **cnic registrar module:** add additional domain fields for .EUS 

# 17.2.0 (2023-05-22)

### Bug Fixes

- **ispapi registrar module:** patch pending contact verification output 
- **ispapi registrar module:** review `setPendingSuspension` integration for Registrant Verification 
- **ispapi registrar module:** review IRTP for 60d lock display and lock opt-out 

### Features

- **cnic registrar module:** add initial IRTP integration 

## 17.1.7 (2023-05-16)

### Bug Fixes

- **cnic registrar module:** trimming of contact data before use in api commands 

## 17.1.6 (2023-05-16)

### Performance Improvements

- **all registrar modules:** improve performance for Domain Registrations page in Admin Area 

## 17.1.5 (2023-05-16)

### Bug Fixes

- **ispapi registrar module:** fix for Creating DNS Zone as non-hidden internal 

## 17.1.4 (2023-05-10)

### Bug Fixes

- **cnic registrar module:** PHP Error fix in Domain Availability Check 

## 17.1.3 (2023-05-09)

### Bug Fixes

- **cnic registrar module:** support for .CAT domains in WHMCS 

## 17.1.2 (2023-05-05)

### Bug Fixes

- **cnic domain importer addon:** import: show original msg if no translation available 

## 17.1.1 (2023-05-05)

### Bug Fixes

- **cnic registrar module:** fix PHP Error in Aavailability Check , closes #249

# 17.1.0 (2023-05-03)

### Bug Fixes

- **cnic registrar module:** fix .app additional domain fields 
- **cnic registrar module:** fix not skipping contacts on transfer when using migrator 

### Features

- **cnic registrar:** show warning in DNS Management page if nameservers do not point to KeyDNS 
- **templates:** include child templates for improving DNS management 

## 17.0.17 (2023-05-02)

### Bug Fixes

- **ispapi registrar module:** DomainTransferSync > getContactDetailsWHMCS error fix 
- **ispapi registrar module:** function hook_transliterate conflict fix 

## 17.0.16 (2023-04-28)

### Bug Fixes

- **ispapi registrar module:** fix IRTP Lock output 

## 17.0.15 (2023-04-28)

### Bug Fixes

- **ispapi registrar module:** review .eu fields (country of citizenship dropped for companies) 

## 17.0.14 (2023-04-27)

### Bug Fixes

- **ispapi registrar module:** patch GetEPPCode implementation for .eu 

## 17.0.13 (2023-04-26)

### Bug Fixes

- **ispapi registrar module:** final patch for Transfer-related Buttons in Admin Area 

## 17.0.12 (2023-04-26)

### Bug Fixes

- **ispapi registrar module:** buttons related to Pending Transfer not showing 

## 17.0.11 (2023-04-24)

### Bug Fixes

- **ispapi registrar module:** patch Domain Sync for WHMCS7 (laravel query builder) 

## 17.0.10 (2023-04-24)

### Bug Fixes

- **ispapi registrar module:** patch system-internal transfer (USERTRANSFER) 

## 17.0.9 (2023-04-21)

### Bug Fixes

- **cnr + ispapi registrar module:** patch grace & redemption fees , closes #248

## 17.0.8 (2023-04-19)

### Bug Fixes

- **cleanup:** assets cleanup 

## 17.0.7 (2023-04-18)

### Bug Fixes

- **cnic registrar module:** keep additional fields related files unencrypted 

## 17.0.6 (2023-04-17)

### Bug Fixes

- **ispapi registrar module:** .dk sync: status cancelled requires active as true 

## 17.0.5 (2023-04-17)

### Bug Fixes

- **ispapi registrar module:** .dk domain sync: switch to cancelled in case of status PENDINGDELETE 

## 17.0.4 (2023-04-17)

### Bug Fixes

- **ispapi+cnic registrar module:** review output of Transfers (GetDomainInformation) 

## 17.0.3 (2023-04-14)

### Bug Fixes

- **cnic registrar:** revamped additional fields for \*.au tld 

## 17.0.2 (2023-04-14)

### Bug Fixes

- **cnic registrar module:** fix for Resend transfer email and cancel domain transfer buttons 
- **cnic registrar:** add required additional field for .app tld 

## 17.0.1 (2023-04-05)

### Bug Fixes

- **cnic registrar module:** avoid changing nameservers when activating dns zone 

# 17.0.0 (2023-04-05)

### Bug Fixes

- **cnic domain importer:** support CentralNic Reseller Module as Registrar in Dropdown List 
- **cnr registrar module:** patch integration of special admin area buttons 
- **cnr/ispapi registrar modules:** upgrade to v8.0.5 of connector library (curlopt settings patch) 

### Code Refactoring

- **hx reg mod:** replaced querydomainrepositoryinfo with querydomainoptions (categories) 

### Features

- **cnic registrar module:** show connectivity result in registrar module settings overview 
- **cnic registrar module:** support of domain restores 
- **cnic+ispapi registrar module:** add/review transfer precheck on shopping cart level 
- **cnic+ispapi registrar module:** added/reviewed injection of private nameservers listing 
- **cnic+ispapi registrar module:** added/reviewed injection of private nameservers listing 
- **cnr registrar module:** add "Cancel Domain Transfer" / "Resend Transfer Approval Email" buttons 
- **cnr registrar module:** added automatic/manual supension/unsuspension feature 
- **ispapi registrar module:** add explicit system activity logs for NS and DNSZone RRs updates 
- **ispapi registrar module:** auto post-transfer contact & nameserver update extended to all TLDs 

### BREAKING CHANGES

- **hx reg mod:** The internal data structure of TLD Settings got extended. Please execute the following SQL Query to avoid PHP issues: ``DELETE FROM `tbltransientdata` WHERE name LIKE "ispapiZoneInfo%"``
- **ispapi registrar module:** Post-Transfer Update is no longer only covering .com/.net/.cc/.tv, but all TLDs. In addition, it first updates contact data and then doing the nameserver update. Nameserver Data is now taken out of the order in WHMCS which is faster than looking this up from transfer request. The post processing got in addition moved into a hook and isn't any longer part of the TransferSync (Separation of Concerns).

## 16.15.23 (2023-03-31)

### Bug Fixes

- **ispapi registrar module:** dropped email check in contact data update mechanism after transfer 

## 16.15.22 (2023-03-31)

### Bug Fixes

- **cnic migrator addon:** drop whois data lookup; problematic in case of active id protection 

## 16.15.21 (2023-03-29)

### Bug Fixes

- **ispapi:** fix for requesting authcode for .de domains via whmcs 

## 16.15.20 (2023-03-27)

### Bug Fixes

- **cnic:** fallback to expiration date if paid date is not returned from API 

## 16.15.19 (2023-03-24)

### Bug Fixes

- **cnic:** set cancelled domains to default renewal mode in pre cron check 

## 16.15.18 (2023-03-24)

### Bug Fixes

- **cnic:** use correct expiration date in daily cron 

## 16.15.17 (2023-03-17)

### Bug Fixes

- **cnic migrator addon:** fix fieldnames consumed from GetClientsDetails 

## 16.15.16 (2023-03-17)

### Bug Fixes

- **cnic migrator addon:** auto-retry transfer without contact data to improve success rate 

## 16.15.15 (2023-03-16)

### Bug Fixes

- **cnic migrator addon:** patched whois data lookup for registrant & admin 

## 16.15.14 (2023-03-14)

### Bug Fixes

- **cnic migration addon:** added fallback to whmcs data in case Whois Data lookup fails 

## 16.15.13 (2023-03-06)

### Bug Fixes

- **ispapi registrar module:** migrate .AT whois disclose to hardcoded solution (non-ui solution) 

## 16.15.12 (2023-03-06)

### Bug Fixes

- **ispapi registrar module:** reviewed expirydate sync of domains in redemption 

## 16.15.11 (2023-03-03)

### Bug Fixes

- **ispapi registrar module:** in case of a restorable domain do only return "expired" in sync , closes #XAT-159107

## 16.15.10 (2023-03-03)

### Bug Fixes

- **migrator addon:** doing whois data lookup via localAPI; cnic: AddContact made optional 

## 16.15.9 (2023-03-03)

### Bug Fixes

- **cnr registrar module:** exclude transfer precheck in TransferDomain integration 
- **cnr registrar module:** fix ClientAreaHeadOutput to only invoke function if present 

## 16.15.8 (2023-03-03)

### Bug Fixes

- **cnic migrator addon:** .uk: do a push via losing registrar after initiating the transfer 
- **cnr registrar module:** review .uk transfer (action=request); requires Push at losing Registrar 
- **ispapi registrar module:** .uk transfers using action=request (waiting for Domain Release / Push) 

## 16.15.7 (2023-02-22)

### Bug Fixes

- **ispapi registrar module:** added missing additional domain fields for .boo 

## 16.15.6 (2023-02-15)

### Bug Fixes

- **ispapi registrar module:** extend messaging of .dk additional fields regarding email confirmation 

## 16.15.5 (2023-02-14)

### Bug Fixes

- **cnic registrar module:** fix transferlock handling 

## 16.15.4 (2023-02-14)

### Bug Fixes

- **dashboard widget:** show right versioning information after upgrade 

## 16.15.3 (2023-02-10)

### Bug Fixes

- **migration:** fix pagination issue in upcoming migrations table 

## 16.15.2 (2023-02-09)

### Bug Fixes

- **cnic registrar module:** fix .se additional fields for transfer 

## 16.15.1 (2023-02-09)

### Bug Fixes

- **cnic dns addon:** pHP error when loading hooks, added missing composer autoloader 

# 16.15.0 (2023-02-06)

### Features

- **cnr registrar module:** support premium domain names 

## 16.14.3 (2023-02-06)

### Bug Fixes

- **download links:** to latest software bundle archive patched 

## 16.14.2 (2023-02-03)

### Bug Fixes

- **registrars:** cleanup accidental inclusion of tpp wholesale. registrar module to be reviewed 1st 

## 16.14.1 (2023-02-03)

### Bug Fixes

- **ispapi registrar module:** added .coop additional fields for contact update 

# 16.14.0 (2023-01-30)

### Features

- **reg hx mod:** additionalfield ID Protection support for .AT TLD 

## 16.13.1 (2023-01-27)

### Bug Fixes

- **cnic pricing import:** clean code refactoring & patching & performance review 

# 16.13.0 (2023-01-26)

### Features

- **hx mod reg:** auto-unsuspension for renewed domains 

## 16.12.2 (2023-01-26)

### Performance Improvements

- **hx reg mod:** Dynamic TLD configuration, tldmap.json file deprecated 

## 16.12.1 (2023-01-25)

### Bug Fixes

- **cnr:** fix smarty error in renewal protection notification email 

# 16.12.0 (2023-01-23)

### Bug Fixes

- **hx registrar:** additional fields for .giving 
- **registration:** fix registration failing for some tlds not supporting transfer lock 

### Features

- **cnic:** hide transfer lock from Client Area if TLD does not support it 

# 16.11.0 (2023-01-20)

### Features

- **domain checker:** add possibility for subscribing to availability checks 

## 16.10.2 (2023-01-19)

### Bug Fixes

- **cnic:** add support for old WHMCS v7 

## 16.10.1 (2023-01-19)

### Bug Fixes

- **hx domainchecker:** add missing markup to renewal price for premium domains 
- **hx domainchecker:** update number of items in shopping cart 

# 16.10.0 (2023-01-10)

### Features

- **hooks:** support customs hooks by file /your/path/to/whmcs/resources/hooks_ispapi_custom.php 

## 16.9.1 (2023-01-06)

### Bug Fixes

- **ispapi registrar module:** identify and use right locale for additional domain fields translation 

# 16.9.0 (2023-01-04)

### Bug Fixes

- **tweak:** front-end and error messages improvements 

### Features

- **epp-csv:** bulk Import EPP Codes via CSV file 

## 16.8.5 (2023-01-03)

### Bug Fixes

- **assets:** review mechanism for browser cache update 

## 16.8.4 (2022-12-08)

### Bug Fixes

- **release process test:** automated publishing to WHMCS Marketplace 

## 16.8.3 (2022-12-08)

### Bug Fixes

- **release process test:** automated publishing on WHMCS Marketplace 

## 16.8.2 (2022-12-08)

### Bug Fixes

- **ispapi registrar module:** patch bug with connected web apps 

## 16.8.1 (2022-12-06)

### Bug Fixes

- **statistics data:** only submit cnic/ispapi addons in use (for customer support improvements) 

# 16.8.0 (2022-12-01)

### Bug Fixes

- **domain search:** fadeIn/-Out transfer button in search field based on input value 
- **domain search:** patch CSS of toggles (for mobile devices) 
- **ispapi registrar module:** patch output of connectivity result in module settings (WHMCS 8.6) 
- **ispapi registrar module:** web apps cfg (file-based solution not working in corner cases) 

### Features

- **domain search:** configurable transfer button in search field 

# 16.7.0 (2022-11-30)

### Bug Fixes

- **aftermarket domains:** consider registrar module setting in ISPAPI Domain Checker 
- **aftermarket domains:** review aftermarket premium domains to display with label "AFTERMARKET" 

### Features

- **aftermarket domains:** configuration option added to registrar module (by default: off) 

## 16.6.5 (2022-11-30)

### Bug Fixes

- **domain search:** fixed issue with aftermarket pricing detection (non-premium class) 
- **domain search:** fixed issue with currency detection and upgrade function 
- **domain search:** update item count of shopping cart button 
- **helper library:** patched db communication wrapper 

## 16.6.4 (2022-11-29)

### Bug Fixes

- **php8 support:** replacing mktime() with time() 

## 16.6.3 (2022-11-29)

### Bug Fixes

- **php8 support:** patched compatibility of DB Interactivity + Transactions 

## 16.6.2 (2022-11-23)

### Bug Fixes

- **domain-import:** premium domains import pricing fix 
- **premium price detection:** for corner cases (probably just affecting the OT&E) patched 

## 16.6.1 (2022-11-21)

### Bug Fixes

- **widget:** quota usage Infinity (INF) percentage fix 
- **widget:** quota usage Infinity (INF) percentage fix 

# 16.6.0 (2022-11-18)

### Features

- **statistics:** extended statistics data functionality 

# 16.5.0 (2022-11-15)

### Features

- **domain checker:** support language overrides 

## 16.4.1 (2022-11-14)

### Bug Fixes

- **cnicmigration:** fix email template paths 

# 16.4.0 (2022-11-14)

### Features

- **dashboard widget:** total request/query limit quota shown on Hexonet (Ispapi) widget 

## 16.3.7 (2022-11-14)

### Bug Fixes

- **license:** changes to our LICENSE and COPYRIGHTS 

## 16.3.6 (2022-11-13)

### Bug Fixes

- **migration:** failure message is now displayed correctly 

## 16.3.5 (2022-11-11)

### Bug Fixes

- **widget:** widget styling fixes for Windows OS users 

## 16.3.4 (2022-11-10)

### Bug Fixes

- **ioncube:** php version encoding bundling - fixes corrupt files 
- **widgets:** widget error fixed, index.tpl not found 

## 16.3.3 (2022-11-10)

### Bug Fixes

- **translations:** patching additional fields translation (different lang used that we don't ship) 

## 16.3.2 (2022-11-09)

### Bug Fixes

- **ioncube:** fixed corrupt files issue by separating archives for php versions 

## 16.3.1 (2022-11-09)

### Bug Fixes

- **ioncube:** encoding order fix higher to lower 

# 16.3.0 (2022-11-08)

### Bug Fixes

- **ioncube:** support for php 8.1 and 7.4 

### Features

- **hexonet registrar module:** post-transfer activation of DNS Management added 

## 16.2.3 (2022-11-07)

### Bug Fixes

- **tld-eu:** remove unnecessary parameter that prevented .eu transfers 

## 16.2.2 (2022-11-07)

### Bug Fixes

- **autoloading:** autoloading fixes when modules are deactivated 

## 16.2.1 (2022-11-07)

### Bug Fixes

- **migrator:** Fix for migrator when fetching domain status 

# 16.2.0 (2022-11-07)

### Bug Fixes

- **cnicmigration:** fix link to documentation 
- **ispapi registrar module:** extend TLD Mapping (.edu.mx <-> EDUMX) 

### Features

- **cnicmigration:** show warning if email templates have not been configured 
- **cnicssl:** add ability to download certificates 

## 16.1.3 (2022-10-20)

### Bug Fixes

- **cnr registrar module:** patch autoloading of function in hooks.php 

## 16.1.2 (2022-10-20)

### Bug Fixes

- **hx registrar module:** patch autoloading of function in hooks.php 

## 16.1.1 (2022-10-20)

### Bug Fixes

- **ispapi registrar module:** nameserver update patched 

# 16.1.0 (2022-10-20)

### Bug Fixes

- **cnic-ssl:** fix several issues and add PHP 8.1 compatibility 

### Features

- **precheck addons:** automatically precheck addons on cart level page, feature added 

## 16.0.3 (2022-10-19)

### Bug Fixes

- **gulp:** updated encryption files list 

## 16.0.2 (2022-10-19)

### Bug Fixes

- **domainchecker:** default categories import fix, build-release workflow fix, gulp config updated 
- **ispapi domain search:** fix multi-year terms dropdown order (10Y now after 9Y) 

## 16.0.1 (2022-10-19)

### Bug Fixes

- **tld-import:** skip tlds with no pricing 

# 16.0.0 (2022-10-18)

### chore

- **restructuring:** in direction of a software bundle 

### BREAKING CHANGES

- **restructuring:** Restructuring of all repositories into a single repository. Offering several benefits to us and our resellers.

# 16.0.0 (2022-10-18)

### chore

- **restructuring:** in direction of a software bundle 

### BREAKING CHANGES

- **restructuring:** Restructuring of all repositories into a single repository. Offering several benefits to us and our resellers.
