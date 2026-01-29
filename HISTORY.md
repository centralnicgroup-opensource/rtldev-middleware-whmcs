# [28.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.6...v28.5.0) (2026-01-29)


### Features

* **cnic registrar module:** add child theme support for Nexus theme in WHMCS 9.0 ([464351c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/464351cd04efac8615761e55d513be85f2c8a6ef))

## [28.4.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.5...v28.4.6) (2026-01-28)


### Bug Fixes

* **cnic domain search & admin config addon:** updated template files related to FontAwesome icons and FontAwesome stylesheet path to ensure compatibility with WHMCS v9 ([26a71ae](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/26a71ae1f41817c2f02021b967e81afa97deeff6))

## [28.4.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.4...v28.4.5) (2026-01-27)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.48 to 3.0.49 ([eda734e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eda734e45b4e43a5e63b155e7c1bab03f4c38aaa))

## [28.4.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.3...v28.4.4) (2026-01-27)


### Bug Fixes

* **cnic registrar module:** do not show "Suspend" button if yet suspensded by TLD Provider ([a0c34fc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a0c34fc1d0f7689a995246f5618bb5ca5a47c5ce))

## [28.4.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.2...v28.4.3) (2026-01-27)


### Bug Fixes

* **cnic registrar module:** fix show required contact verification after registration (RAA) ([ab73d5e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ab73d5edc1d88d0a5c8ada4248bc97b70056503f))

## [28.4.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.1...v28.4.2) (2026-01-21)


### Bug Fixes

* **deps:** bump lodash-es from 4.17.21 to 4.17.23 ([4ab6d16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4ab6d16ce2311f5ecab2291e4c047d54a70b99cc))

## [28.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.4.0...v28.4.1) (2026-01-12)


### Bug Fixes

* **cnic monitoring addon:** enhance premium pricing mismatch detection for renewals ([437d914](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/437d91421bd9548b4a8023f8ad5138f3c0808342))

# [28.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.3.0...v28.4.0) (2026-01-06)


### Bug Fixes

* **pricing-importer:** avoid kidnapping existing hosting product group ([ee0b5c4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ee0b5c47b4456f211a458c38d4a6267a521bf91d))


### Features

* **pricing-import:** allow monthly rates for hosting products ([8576df3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8576df3b97d93dfbdca563a083e27421db9c5226))

# [28.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.11...v28.3.0) (2025-12-23)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.47 to 3.0.48 ([e005f4c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e005f4c9ef38aac7cf6b84ebece87cf1777d3f6b))


### Features

* **cnic registrar module:** add setting to disable automatic domain restoration during renewals ([e30562a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e30562aae6a3ea402c3732f94d633f87c48fcb8e))

## [28.2.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.10...v28.2.11) (2025-12-11)


### Bug Fixes

* **cnic registrar module:** in case of too early restore, fallback to renewal ([63f4d0e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/63f4d0e121cc970e635e268d1623c0adaa7db3fa))

## [28.2.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.9...v28.2.10) (2025-12-04)


### Bug Fixes

* **cnic dns manager:** correct DNSSEC link and update breadcrumb URLs ([16f3599](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/16f359914605d6529df4286aa875aa1cd2fbc4e9))
* **cnic dns manager:** review menu entry url to our DNS Manager Addon ([5644c6c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5644c6c983b0766041b2ff11185363ee61f1df77))

## [28.2.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.8...v28.2.9) (2025-12-02)


### Bug Fixes

* **cnic pricing importer:** patch link to the Domain Pricing Importer of WHMCS ([ce5e42e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ce5e42ecb3327adf00a73daa14442c068d903198))

## [28.2.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.7...v28.2.8) (2025-12-01)


### Bug Fixes

* **cnic registrar module:** generate activity log entry when requesting a new eppcode/auth code ([a43b605](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a43b6054f30d1db2a658ee5b3c7256ecabe8fff1))
* **cnic registrar module:** patched activity log generator ([2eefd89](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2eefd89bf63f80c7e68231985fa78cbfed31f90d))

## [28.2.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.6...v28.2.7) (2025-11-25)


### Bug Fixes

* **release workflow:** try new way of releasing to whmcs marketplace (dep install) ([5ae7a34](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5ae7a342462aae214df10dc0e3d6ab842e57e0e2))

## [28.2.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.5...v28.2.6) (2025-11-25)


### Bug Fixes

* **release workflow:** testing new GH PAT (don't upgrade) ([74ceb31](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/74ceb3119a9426940c27dd4cedb663326c389ca1))

## [28.2.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.4...v28.2.5) (2025-11-25)


### Bug Fixes

* **cnic-domain-search:** show all TLDs in domain results; remove CNIC-only TLD restriction ([4ede33e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4ede33efb71525450058861d40aa1aebfff67d40))

## [28.2.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.3...v28.2.4) (2025-11-18)


### Bug Fixes

* **deps:** bump glob from 10.4.5 to 10.5.0 ([56352cf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/56352cf6f7c5e6ba3a5b1c8c7316d24dde381ee8))

## [28.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.2...v28.2.3) (2025-11-14)


### Performance Improvements

* **cnic config addon:** Refactor sync interface to enhance user experience and performance ([05c62ec](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/05c62ec690e662c9d5efc2ce3ac3c0288ae51206))

## [28.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.1...v28.2.2) (2025-11-12)


### Bug Fixes

* **cnic registrar module:** fully api-driven auth code retrieval aka. Get EPP Code ([1595c2b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1595c2be4d385965b8f1c0221fc620b334288d2e))

## [28.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.2.0...v28.2.1) (2025-11-12)


### Bug Fixes

* **Domain Search Addon:** reviewed overrides custom language file path from /lang/overrides/<language>.json to /lang/overrides/cnic-domain-search-addon-<language>.json to ([e2fdeb9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e2fdeb9b87b0564e2c04516c11b8abad22a69f30))

# [28.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.1.0...v28.2.0) (2025-11-12)


### Features

* **cnr registrar module:** show status inactive in domain detail view in admin area as well ([d97c856](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d97c8565d2300b37b547251e0ab495024e221abd))

# [28.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.0.5...v28.1.0) (2025-11-10)


### Features

* **cnic admin config addon:** add traditional additional fields copy feature for dist.additionalfields.php ([78ace07](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/78ace07316d5be5acc90358b05ddba7643ff4649))

## [28.0.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.0.4...v28.0.5) (2025-11-10)


### Bug Fixes

* **cnic addons:** making sure cnic addon language files are unecrypted ([8d82364](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8d8236466c691ad22f4e500d69f229b78087e9c4))

## [28.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.0.3...v28.0.4) (2025-11-10)


### Bug Fixes

* **cnic registrar module:** PHP 8.3 code improvements ([c78deea](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c78deeaec23cb8d373dbaec5ca81db14a85f6395))

## [28.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.0.2...v28.0.3) (2025-11-07)


### Bug Fixes

* **cnic registrar module:** patched logger and CONTACT related PHP issues ([30386df](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/30386df32e63f675963492744436d2f0ffbbc388))

## [28.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.0.1...v28.0.2) (2025-11-07)


### Bug Fixes

* **cnic registrar module:** patched  issue where WHMCS incorrectly returning Sync Not Supported by Registrar Module ([31e5474](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/31e54742002e02fa02f896ed06226972d7d66421))

## [28.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v28.0.0...v28.0.1) (2025-11-05)


### Bug Fixes

* **cnic registrar module:** fix saving url forwarding in case the dnszone is not present yet ([0c2c858](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0c2c8583e9d43be31d67819b2cfa7a37f3188d38))

# [28.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.16.4...v28.0.0) (2025-11-04)


### Bug Fixes

* **cnic ssl addon:** improve error handling on CSR and Private Key generation ([b455c13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b455c13ed58180b568a96377eb6c26655628f768))


### chore

* **ispapi registrar module:** official deprecation and cleanup of Brand HEXONET, ISPAPI ([4d63364](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4d63364794545929932f9e0e91f054b9393a9e25))


### Code Refactoring

* **cnic ssl addon:** remove hexonet/ispapi support from ssl module ([0428942](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/04289420be426ef497e7c6bff484aef8f7352ee2))


### Features

* **cnic cpnael hosting addon:** add server module for CNIC cPanel hosting support ([583fcc2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/583fcc25d206a2b76bbf13132242853025b41c24))
* **cnic price importer addon:** Implement Hosting Import UI and product group import ([f7cc396](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f7cc3961bc251c4e4a3094230add199f360e33ab))
* **cnic price importer addon:** implement module upgrade procedure ([e55057a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e55057a658f412ee6c4bd1622b0f9a62b5bdf914))
* **cnic price importer addon:** refactoring for pricing import ([afefd97](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/afefd97fa5d283dde654c8216331e3f01120c1d6))
* **cnic ssl addon:** pricing import logic moved to cnic price importer addon ([0adb05f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0adb05f6006ef5a5ab533792fa0236b9ddff66eb))


### BREAKING CHANGES

* **cnic ssl addon:** ISPAPI is no longer supported in the SSL modules as customers have been migrated
* **cnic ssl addon:** the pricing import functionality of the SSL addon has been moved to the cnic price importer addon for better UX and achieving a single place of trust for CNIC pricing imports.

re RSRMID-2386 and RSRMID-2428
* **ispapi registrar module:** This release removes the legacy ISPAPI (HEXONET) Integration from our
software bundle and its support in our addons. Use v27 if you still need support for it.

## [27.16.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.16.3...v27.16.4) (2025-10-28)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([347e857](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/347e857b874499e0196a80e317a0a59a9715d605))

## [27.16.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.16.2...v27.16.3) (2025-10-28)


### Bug Fixes

* **dns manager addon:** Patched an issue which was causing dnssec to disappear ([6fdef6c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6fdef6cdc810b5959d5e6bdda183aacceeaaed09))

## [27.16.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.16.1...v27.16.2) (2025-10-27)


### Bug Fixes

* **deps:** bump tar-fs from 2.1.3 to 2.1.4 ([83f1527](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/83f1527cdb59b6f25092a4449311c2a268a1a8dd))

## [27.16.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.16.0...v27.16.1) (2025-10-23)


### Bug Fixes

* **cnic registrar module:** patch issue where an incorrect client ID was assigned to activity log entries ([b65b498](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b65b498e11f14562f7b1e448b7f07572997890f9))

# [27.16.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.15.4...v27.16.0) (2025-10-14)


### Features

* **cnic admin addon:** add force update option for expiry date synchronization including next due date ([3eca271](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3eca2715c38cdd2a853b5058702b1b4e0562f78e))

## [27.15.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.15.3...v27.15.4) (2025-10-13)


### Bug Fixes

* **cnic admin addon:** streamline due date calculation in domain expiry sync ([f3f5202](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f3f52022dd24579be29ad3a7d1685b617620b34d))

## [27.15.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.15.2...v27.15.3) (2025-10-13)


### Bug Fixes

* **cnic admin addon:** enhance error handling and add detailed status information for domain sync and improve expiry logic ([551eebe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/551eebea2fd0fa1deeb08fc70c4d21280ebd0d34))

## [27.15.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.15.1...v27.15.2) (2025-10-07)


### Bug Fixes

* **cnic monitoring addon:** improve accessibility and event handling for premium domains pricing fix now button ([9dacc1f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9dacc1f06f9a5d0e3f1b8da7a85423ed9aeb34b2))

## [27.15.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.15.0...v27.15.1) (2025-10-06)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.46 to 3.0.47 ([c64f868](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c64f868ffc8c255353ba697786cc0b3728efea07))

# [27.15.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.14.0...v27.15.0) (2025-09-24)


### Features

* **event list:** implement event list feature with navigation, backend, and frontend components & extended domain expiration date sync to support filter by TLDs ([e2456f8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e2456f810b60fd18e7341385d2db6a7b09960b42))

# [27.14.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.13.3...v27.14.0) (2025-09-15)


### Bug Fixes

* **domain search addon:** add initial loader skeleton for domain search engine ([7c8346a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7c8346added3a5f9e14badf3fca3f0b186567328))


### Features

* **cnic registrar module:** add additional domain fields validator on checkout page ([66abe1c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/66abe1c23cca7402d3d27d4323ab29c41978ba23))

## [27.13.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.13.2...v27.13.3) (2025-09-05)


### Bug Fixes

* **cnic registrar module:** cleaning up whitespace from postal code for .SE tld ([52ae952](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/52ae952ff7470c66b69611b0c520b16b1830f412))

## [27.13.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.13.1...v27.13.2) (2025-09-03)


### Bug Fixes

* **cnic ssl addon:** fixed issue related to sslcert deletion ([e299044](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e29904470a5e43d2920ca6e070efad30f92dd8c5))

## [27.13.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.13.0...v27.13.1) (2025-09-03)


### Bug Fixes

* **cnic registrar module:** reviewed hook regarding software dependency load ([95617bc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/95617bcbf4a2a8ab1d6e13d0d329a648f5c60370))

# [27.13.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.12.5...v27.13.0) (2025-09-02)


### Features

* **cnic registrar settings:** added registrar settings page to configure "renewal mode" and "include renewals for internal transfer" ([20cc73c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/20cc73c248d0cfb543a7b6a453a7fa9e1192aff2))

## [27.12.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.12.4...v27.12.5) (2025-08-28)


### Bug Fixes

* **cnic ssl addon:** fix PHP error related to missing APIHelper class ([769a96e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/769a96ee837337d94f6b344fb3581b1f089490d1))

## [27.12.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.12.3...v27.12.4) (2025-08-28)


### Bug Fixes

* **cnic registrar module:** review domain search case TLD NOT SUPPORTED (more fine grained) ([e2671a0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e2671a03a4712a024fd37aeb1750cc25e2b836e2))

## [27.12.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.12.2...v27.12.3) (2025-08-26)


### Bug Fixes

* **cnic registrar module:** domain synchronization to better cover outgoing transfers ([6b54d75](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6b54d75b32a819bcf82696f9b63862c8c45b90eb))

## [27.12.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.12.1...v27.12.2) (2025-08-21)


### Bug Fixes

* **cnic registrar module:** fix unintended two year renewals in ARGP ([7ccd3f9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7ccd3f9e3164cd48d4504e542164d1b5cfb3c723))

## [27.12.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.12.0...v27.12.1) (2025-08-20)


### Bug Fixes

* **cnic registrar module:** sanitize error messages by removing command prefixes from client area ([afc6a39](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/afc6a392e4b1443295bf39fb14366c4f81e3cd54))

# [27.12.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.11.2...v27.12.0) (2025-08-20)


### Features

* **cnic registrar module:** replace data refresh on sync by a CNIC Config Addon Tool ([959adac](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/959adac25ebd7e5aae3614360f7ca5bf5f744f85))

## [27.11.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.11.1...v27.11.2) (2025-08-20)


### Bug Fixes

* **cnic registrar module:** add transfer term parameter conditionally (e.g. .qa, .se) ([5b5a57f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5b5a57f97b277c6dfb4bbad1a0d41cc1aee9f444))

## [27.11.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.11.0...v27.11.1) (2025-08-14)


### Bug Fixes

* **cnic registrar module:** improved contact details handling for Save Contact Details ([a9b8e46](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a9b8e462381a2fa34ac3b6cc7390bdcae9fdde93))

# [27.11.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.10.0...v27.11.0) (2025-08-12)


### Features

* **cnic admin addon:** add support to show all DNSZones from CentralNic Reseller account ([3aeb59e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3aeb59ee79fb2f2343d77fed7407824c74fc7dfd))

# [27.10.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.9.4...v27.10.0) (2025-08-07)


### Features

* **cnic registrar module:** show special stati (suspended et al) (set at registrar or registry) ([c16c86e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c16c86ec427cd9af51c78db06d3780a1faa0e7e0))

## [27.9.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.9.3...v27.9.4) (2025-08-06)


### Bug Fixes

* **cnic registrar module:** review renewal endpoint for EXPIRATION parameter ([8cd7004](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8cd7004ddd1495ca3ab9aa701e0c32e07f8bb928))

## [27.9.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.9.2...v27.9.3) (2025-08-05)


### Bug Fixes

* **cnic registrar module:** remove EXPIRATION parameter from domain renewal process ([e58a0a0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e58a0a036f2872f47bc2f48ee3e4b7b07fe7e40b))

## [27.9.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.9.1...v27.9.2) (2025-08-05)


### Bug Fixes

* **cnic registrar module:** retry transfer without period parameter (if returned as not supported) ([04ed8bf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/04ed8bf5d18e2da2aaa0a306c7202b6de0d7435a))

## [27.9.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.9.0...v27.9.1) (2025-08-05)


### Bug Fixes

* **cnic registrar module:** do not include nameservers in transfer requests in general - except .be ([7a1d633](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7a1d633153558419f5c72b8544882ae985bf9741))

# [27.9.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.8.0...v27.9.0) (2025-08-04)


### Features

* **cnic admin addon:** add bulk expiry date sync functionality with modern UI ([8a161c7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8a161c76d4b13ac447f17dd691d6ee334d2950ca))

# [27.8.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.7.2...v27.8.0) (2025-08-04)


### Features

* **cnic registrar module:** add dutch language support ([c79b573](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c79b57345a1989d10b77501c79414298eae546b6))
* **cnic registrar module:** add spanish language support ([c271883](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c271883157b1f24c33ae6c04cf141c7defe560ef))

## [27.7.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.7.1...v27.7.2) (2025-07-29)


### Bug Fixes

* **cnic registrar module:** do not submit empty nameserver parameters as part of a domain update ([84fc65d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/84fc65d45001a3d7d9d54816a8194504b48df49a))

## [27.7.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.7.0...v27.7.1) (2025-07-29)


### Bug Fixes

* **cnic registrar module:** do not return a middlename contact data field; refactored code base ([f2d5c25](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f2d5c256b046985f9e9c4ce572f79e656e9293ea))

# [27.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.6.0...v27.7.0) (2025-07-29)


### Features

* **cnic registrar module:** extend registrar settings with Enable EPP Code (sync TLD-specific EPP code requirements) for pricing sync ([8bb641b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8bb641b58840424845a79a1f98899084e693beb1))

# [27.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.14...v27.6.0) (2025-07-29)


### Features

* **cnic registrar module:** automatic hide of optional additional domain fields ([a9d3219](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a9d32193cce3077dfab4bdf105ba63b1c9738cd8))

## [27.5.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.13...v27.5.14) (2025-07-25)


### Bug Fixes

* **cnic domain search:** improve handling of unassigned TLDs in categories to prevent showing them as unsupported ([bc5a62d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bc5a62d47e1be7ec12dad96c9cc7eae70bc9bc70))
* **cnic registrar module:** update registrar dropdown mappings for immediate domain deletion mode ([bcbfafb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bcbfafb61dbc8733e8f277f2d7f99347d979d664))

## [27.5.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.12...v27.5.13) (2025-07-23)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([c44e853](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c44e853db65d1efa6517e0317d67d4e8ecc008c9))

## [27.5.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.11...v27.5.12) (2025-07-23)


### Bug Fixes

* **cnic registrar module:** return registry contact handles as contact tab with empty input fields ([23de401](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/23de4015264d0bca29d6533442b914cb67745e2f))

## [27.5.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.10...v27.5.11) (2025-07-21)


### Bug Fixes

* **cnic registrar module:** prevent registered domains from showing as available in Domain Suggestions ([71e1836](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/71e1836249eb958e897189c3fc38035e6efdcb75))

## [27.5.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.9...v27.5.10) (2025-07-21)


### Bug Fixes

* **cnic registrar module:** availability check - add explicit cast to int of cnics code ([030b903](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/030b903417d17864d944c720a14dae82d90c2a92))

## [27.5.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.8...v27.5.9) (2025-07-18)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.8 to 11.0.9 ([b0c860b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b0c860b15b1571dae995f0657dbc44018fff08a2))

## [27.5.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.7...v27.5.8) (2025-07-18)


### Bug Fixes

* **dns manager addon:** update action URL to patch error modals on DNS form submission ([862f72a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/862f72a2607d8e8df36961321a1ad28452780ef0))

## [27.5.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.6...v27.5.7) (2025-07-16)


### Bug Fixes

* **cnic dns addon:** support NS records with optional TTL and IN fields in DNS template handling ([a2ca190](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a2ca190e0176b7b0f125ffd6d30b2f1e9916471b))

# [27.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.5...v27.6.0) (2025-07-15)


### Features

* **cnic registrar module:** add PERIOD parameter handling for domain transfer requests ([168071a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/168071a138b21b96cdd8c56d93bd4ab6d1f72f65))

## [27.5.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.4...v27.5.5) (2025-07-15)


### Bug Fixes

* **cnic ssl addon:** skip empty product groups on pricing/product import ([8bb079b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8bb079b9f782460719f12df3831f680587ab3869))

## [27.5.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.3...v27.5.4) (2025-07-14)


### Bug Fixes

* **dns manager addon:** patched priority field handling for SRV Resource Records ([7ba8a82](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7ba8a829a8e2bb260e48db964451c1ab8aa10b4c))

## [27.5.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.2...v27.5.3) (2025-07-14)


### Bug Fixes

* **cnic registrar module:** explicit data refresh on domain sync / loading contact data ([f764309](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f76430966c9c85df24d64d9d867c75041065173e))

## [27.5.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.1...v27.5.2) (2025-07-14)


### Bug Fixes

* **cnic registrar module:** review contact information handling (not all/no contacts set) ([441e65c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/441e65c36cad70a2a4b57381fa7bfee7b13cc26a))

## [27.5.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.5.0...v27.5.1) (2025-07-11)


### Bug Fixes

* **deps:** bump lit from 3.3.0 to 3.3.1 in /domain-search-src-files ([f8f3f95](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f8f3f9508a6bc7f96ee8042f112ac92099ce93ec))

# [27.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.16...v27.5.0) (2025-07-11)


### Bug Fixes

* **cnic registrar module:** auto-fallback to trade process if contact update fails respectively ([de69532](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/de695329abe3f86ac7c0e50de391053e82158bac))
* **cnic registrar module:** identifying contacts to use whithin domain transfer process reviewed ([cea57bf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cea57bf2897278a65019d7181f09ed6214b4100a))
* **cnic registrar module:** return requested owner changes as pending ([313a3da](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/313a3daca66cf3f42a8763775882778aa49a1ff5))
* **cnic registrar module:** return the ownerchange status and expiry date ([cf1d9e5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cf1d9e5a5878e263b4ceeaf66411654008d92c58))


### Features

* **cnic registrar module:** show change of registrant form and or upload link for whois updates ([af91f92](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/af91f925d6b7b24c08ad866b5f88b96b8c76fce5))
* **cnic registrar module:** support showing fax form / doc upload link if necessary on ownerchange ([d9a8841](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d9a88414ad71816e9fdda2580ec1b10e38e864ac))

## [27.4.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.15...v27.4.16) (2025-07-10)


### Bug Fixes

* **cnic registrar module:** do not auto-cancel domains during sync if not found at provider ([60bfa65](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/60bfa657540419a4a497d048dcee481231bdc267))

## [27.4.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.14...v27.4.15) (2025-07-08)


### Bug Fixes

* **cnic registrar module:** handle redemption days and fees correctly in TLD pricing sync ([b0c3d3a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b0c3d3afa34551f6c28fdbc2d667a5df3a088905))

## [27.4.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.13...v27.4.14) (2025-07-08)


### Bug Fixes

* **cnic registrar module:** add support in domain details view for renewal mode DEFAULT ([aba0e34](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/aba0e34d2b97a26891eeca62735db0f8358cd956))

## [27.4.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.12...v27.4.13) (2025-07-07)


### Bug Fixes

* **ispapi registrar module:** patch dnssec section (smarty php error on access) ([c472eb6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c472eb65e5ed37aa6bf89397691c53fe8d765a59)), closes [#297](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/297)

## [27.4.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.11...v27.4.12) (2025-07-04)


### Bug Fixes

* **cnic registrar module:** .de registrations & nameservers ([6337245](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6337245647fec8436e065cc9ea0b95dd2ff03516))

## [27.4.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.10...v27.4.11) (2025-07-02)


### Bug Fixes

* **cnic registrar module:** major review of the domain sync integration ([6b031b8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6b031b84d49600a76a7b21a7408d02becd7fcc10))

## [27.4.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.9...v27.4.10) (2025-07-01)


### Bug Fixes

* **cnic registrar module:** reduced TLDs Sync Cache from 24h to 1h ([47474c4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/47474c45bf37e06ba7b08566c1861accfe0ec9d3))

## [27.4.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.8...v27.4.9) (2025-07-01)


### Bug Fixes

* **cnic registrar module:** patched an issue with balance widget toggle button ([d0e2b00](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d0e2b00a72b5034220287d480284b49d7322c6b9))

## [27.4.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.7...v27.4.8) (2025-06-30)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.45 to 3.0.46 ([b4b143e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b4b143ec550e8ecf832318fd0ff7ad64b78f00a1))

## [27.4.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.6...v27.4.7) (2025-06-27)


### Bug Fixes

* **cnic registrar module:** temp remove the Automatic DNS Zone deletion feature (post-migration) ([0c98ff2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0c98ff26926bfa28bda6a913630a52f608b7f691))

## [27.4.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.5...v27.4.6) (2025-06-25)


### Bug Fixes

* **cnic registrar module:** fix Nameserver Update after Transfer (Transfer initiated via Admin Area) ([73a9ff6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/73a9ff6d693aa93f781d5734467ac7cad80fc507))

## [27.4.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.4...v27.4.5) (2025-06-23)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.44 to 3.0.45 ([64dadd0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/64dadd01f8480efeebc21e0a3db91f14e92e5a7b))

## [27.4.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.3...v27.4.4) (2025-06-19)


### Bug Fixes

* **cnic dns manager:** normalize host to '@' when adding new DNS record if it matches dnszone ([bf432fb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bf432fb5b147f5ed8b0122bd050bb99fe9c30656))

## [27.4.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.2...v27.4.3) (2025-06-17)


### Bug Fixes

* **cnic registrar module:** request eppcode using modifydomain (except the special tlds) ([bf95c42](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bf95c421cbe911bd64b0eda3638c4b21a342a32b))

## [27.4.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.1...v27.4.2) (2025-06-17)


### Bug Fixes

* **cnic registrar module:** handle exceptions and hide dnszone status warning messages ([bb66202](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bb662022ecf9237bd4a4a5dbe984d10bde5fe749))

## [27.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.4.0...v27.4.1) (2025-06-12)


### Bug Fixes

* **cnic registrar module:** fix domain search (premiums domains = off, offered for regular price) ([d63c31f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d63c31fab43734afdb42bc84bf31f5d7511c1568))
* **cnic registrar module:** skip the add. field for the allocation token for premiums ([9e27218](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9e2721894d88aaf6f445ade5b7faa0381aeb9054))

# [27.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.3.0...v27.4.0) (2025-06-06)


### Features

* **cnic dnsmanager/dnssec addon:** enhance DNSSEC management with new UI elements and backend logic, auto activate dnssec via dnsmanager ([418233d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/418233d4820052176c240d8048c7b888889c5656))

# [27.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.7...v27.3.0) (2025-05-28)


### Features

* **cnic config addon:** add CNICConfig for TLD additional field management ([e4455f7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e4455f78a00eec2cb26088bbec81011e95eb058d))

## [27.2.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.6...v27.2.7) (2025-05-26)


### Bug Fixes

* **cnic registrar module:** fix expirydate after renew (renewonce, wrong backend data, e.g. .ch) ([5c741fd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5c741fde94644633f88527f4a97d95cb73caa786))

## [27.2.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.5...v27.2.6) (2025-05-21)


### Bug Fixes

* **cnic registrar module:** fix nameserver update after transfer to cover all nameservers ([ad8633d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ad8633dcf5a0d6f2d7baef218286ad4c574a3a06)), closes [#293](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/293)

## [27.2.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.4...v27.2.5) (2025-05-20)


### Bug Fixes

* **cnic registrar module:** review DNSSEC to be offered only for TLDs technically supporting it ([cf318ef](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cf318efc601c1cb0eda09fca5f4a3b6fe4e5b179))

## [27.2.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.3...v27.2.4) (2025-05-19)


### Bug Fixes

* **cnic registrar module:** reviewed auto transfer status caching to avoid unnecessary calls to the registrar API ([eb14520](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb1452094cdfffcc679a845bdddd414ac0588bf9))

## [27.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.2...v27.2.3) (2025-05-16)


### Bug Fixes

* **cnic registrar module:** improve contact field state handling by converting state codes from YK to YT ([697331b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/697331b8576abf5eddb9a5b2543cd14f70795d0d))

## [27.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.1...v27.2.2) (2025-05-16)


### Bug Fixes

* **software bundle:** trigger new release encrypted with ioncube encoder v14.0.2 ([82ad93e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/82ad93ea5a9f40c3e49d89059ff7dddfe7b4dab0))

## [27.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.2.0...v27.2.1) (2025-05-12)


### Bug Fixes

* **cnic register module:** update automatic transfer lock status handling and improve error messaging ([84cc079](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/84cc079eaa98b1dd07eb274934bc4c365fb1d619))

# [27.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.1.0...v27.2.0) (2025-05-12)


### Features

* **cnic registrar module & domain importer addon:** Add support for importing premium domain names to WHMCS via the domain importer addon. ([7ce94b6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7ce94b61b96a28bd481881d5b8dc72a303034a11))

# [27.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.0.3...v27.1.0) (2025-05-06)


### Bug Fixes

* **cnic dnsmanager addon:** update algorithm and digest option references for DNSSEC template consistency ([7483ce0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7483ce0f00aa5159df45de477f957b0acd814d06))


### Features

* **cnic registrar module:** improve error handling and display registrar error messages in client domain area ([fabcf4d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fabcf4df7a4a0e31aa879209d6533d9d5cb36114))

## [27.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.0.2...v27.0.3) (2025-05-02)


### Bug Fixes

* **cnic dnsmanager addon:** correct template paths to resolve redirection issues ([43eb08a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/43eb08a984a731cac5ffe619691947d238544640))

## [27.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.0.1...v27.0.2) (2025-05-02)


### Performance Improvements

* **cnic registrar module:** improve performance when loading private nameservers ([2ba88cb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2ba88cbecbb8b41e12bbc80533238fe5288f374c))

## [27.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v27.0.0...v27.0.1) (2025-04-30)


### Bug Fixes

* **cnic dnsmanager addon:** enhance DNSSEC management UI and logic, improve template structure ([1d3e645](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1d3e645f5bf470cffcd1a539a45b763a94cdfc2c))
* **cnic registrar module:** review module logging for addons ([a996afc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a996afc6172a1b5c6bfa81a8ac357d9815a46e2f))

# [27.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.2.2...v27.0.0) (2025-04-28)


### Bug Fixes

* **cnic registrar module:** consider settings (yes/no, default:true) even if initially not present ([d69c082](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d69c0820bb290778ad8c237b9186550f8072d5b8))


### Features

* **cnic registrar module:** cleanup dnszones if domain identified as Cancelled or Transferred Away ([066184f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/066184f0cd7b1aece044339c269acbaa420bea6a))
* **cnic registrar module:** TLD Settings / Pricing Import Review ([07f0b45](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/07f0b453c12b91bf6ac7963474d1a70b035eb77a))


### BREAKING CHANGES

* **cnic registrar module:** Table `mod_cnic_zones` has been deprecated and can be removed from the database.

The TLD Settings / Pricing Import has been refactored to use a new cache mechanism.
This change improves performance and reliability when importing TLD settings.
Pricing Import is now also fully api-driven with further potential for improvements (pending backend requests).

We reviewed the Post-Transfer Update Process for Contact and Nameserver Data.
Saving Contacts and Handling of Domain Transfers has been reviewed and improved as well considering the new TLD Settings Mechanism.

## [26.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.2.1...v26.2.2) (2025-04-17)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([5a34f1a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5a34f1a464356d2dc4670a234f3654c97f10154f))

## [26.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.2.0...v26.2.1) (2025-04-17)


### Bug Fixes

* **cnic registrar module:** updated return types for Add DNS Record and Enable DNSSec methods ([202d3e0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/202d3e0d382d1885c4b57d3a8b4ae52700e5330b))

# [26.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.1.4...v26.2.0) (2025-04-14)


### Features

* **cnic ssl:** add option to set cross-sell products on certificate pricing import ([225f7fc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/225f7fc33d052908505c3d1323e95e28edc72bb1))

## [26.1.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.1.3...v26.1.4) (2025-04-11)


### Bug Fixes

* **deps:** bump lit from 3.2.1 to 3.3.0 in /domain-search-src-files ([bce1a29](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bce1a295dea40ed44e727053a662ae83c25c9119))

## [26.1.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.1.2...v26.1.3) (2025-04-10)


### Bug Fixes

* **cnic registrar module:** improve error handling for automatic transfer lock status retrieval via GetProperty CMD ([574aacb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/574aacb72fb4366a38adb9f9bea043c1d3a5777b))

## [26.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.1.1...v26.1.2) (2025-04-02)


### Bug Fixes

* **cnic registrar module:** reviewed: Domain Sync to return domains as cancelled ([152b6a9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/152b6a9d6e509f55508ef7363c0bdbbd41dfdbde))

## [26.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.1.0...v26.1.1) (2025-04-02)


### Bug Fixes

* **cnic registrar module:** mark domains as cancelled if available for registration to improve domain status sync ([5846758](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5846758c6db39d8a1376ef9efb1eb5454a541e24))

# [26.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v26.0.0...v26.1.0) (2025-04-01)


### Features

* **cnic dns:** implement dnssec support for keydns zones ([b94b455](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b94b4555dcaed701ead97c052b04767eb06ff8a2))

# [26.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.12...v26.0.0) (2025-03-28)


### Features

* **cnic registrar module:** implement domain automatic transfer lock status retrieval on registrar settings ([184a4f5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/184a4f5facb49c5eac55aad139a3f3350a963c84))


### BREAKING CHANGES

* **cnic registrar module:** The automatic transfer lock after registration and transfer has changed. Check the registrar module settings for details on how to activate it.

## [25.7.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.11...v25.7.12) (2025-03-24)


### Bug Fixes

* **cnic dnsmanager addon:** streamline domain handling and sidebar generation ([22d46d8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/22d46d8f1dc5127a104c7b1abde1ea12a2c4ada8))

## [25.7.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.10...v25.7.11) (2025-03-19)


### Bug Fixes

* **cnic registar module:** resolve issues with detecting 3rd level TLDs (e.g., .pp.se) to improve domain zone accuracy ([048c598](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/048c59827a2a79cab66081d7c427f04d2f81b633))

## [25.7.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.9...v25.7.10) (2025-03-17)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([9d5a9ac](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9d5a9aca5c7c227eae421e9bc82855b2ea748fb0))

## [25.7.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.8...v25.7.9) (2025-03-17)


### Bug Fixes

* **cnic registar module / dns manager:** review TXT resource record / address field handling, UI improvements for DNS manager addon ([1ef554c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1ef554cd625bc155084fc724bdf48c0803b1e7d4))
* **cnic registrar module:** reviewed and optimised handling for contact verification in GetDomainInformation ([506b277](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/506b27741684a5478637940cdd8bb4086e192f7d))

## [25.7.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.7...v25.7.8) (2025-03-12)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.3 to 11.0.5 ([596952a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/596952a0e522b2b791edb84bb92f1503b4e7ca44))

## [25.7.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.6...v25.7.7) (2025-03-11)


### Bug Fixes

* **ispapi & cnic registrar module:** ensure user is logged in before accessing DNS Management; improve Nameservers handling ([ba99d66](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ba99d661a19a9882b0b764663d268f4060890315))

## [25.7.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.5...v25.7.6) (2025-03-10)


### Bug Fixes

* **ispapi & cnr registrar module:** correct link and label for terms and conditions agreement for .dk tld ([7fef0fb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7fef0fbddd0a34524e6e3458001f1b06526fd711))

## [25.7.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.4...v25.7.5) (2025-03-10)


### Bug Fixes

* **ispapi & cnr registrar module:** enhance .dk terms and conditions checkout layout for Lagom and retable themes ([0db263d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0db263dc223452dd8660e60be4dca33f347bd57e))

## [25.7.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.3...v25.7.4) (2025-03-07)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.2 to 11.0.3 ([2cd41f0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2cd41f081320b9153f22ae456a004a1cb3d480c0))

## [25.7.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.2...v25.7.3) (2025-02-28)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.1 to 11.0.2 ([94bf2d0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/94bf2d01f156390d3527f966921d1b5da009a942))

## [25.7.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.1...v25.7.2) (2025-02-20)


### Bug Fixes

* **ispapi registrar module:** Transfer Sync to consider also domains that joined the reseller account differently (non-transfer way) ([590133b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/590133bf8f093761abd3b738bee94e7c80ad4805))

## [25.7.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.7.0...v25.7.1) (2025-02-20)


### Bug Fixes

* **ispapi registrar module:** add missing REGISTRANT-IDNUMBER and VATID fields for .SE and .NU domain transfers ([2e99b56](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2e99b560b0c40fecf9c9d605de07546a3c088e70))

# [25.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.6.1...v25.7.0) (2025-02-18)


### Features

* **ispapi registrar module:** add .dk checkout page translations for Arabic, French, and German ([a79cc87](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a79cc878d3ea714c11c9eda91fb4ae5e80088c18))

## [25.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.6.0...v25.6.1) (2025-02-17)


### Bug Fixes

* **cnic dns manager:** fix default nameserver set suggestion in DNS Management ([d135b6d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d135b6dd6e4fb83448e893eb6942d47828ddfd0a))

# [25.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.5.0...v25.6.0) (2025-02-17)


### Features

* **cnic dns manager:** support custom settings for SOA MNAME, RNAME ([b84b3f1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b84b3f1df99290e89c0d92df10b6fdf8ec46df52))

# [25.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.4.5...v25.5.0) (2025-02-14)


### Features

* **cnic registrar module:** offer a global customizing of defaults for additional fields ([522ae1c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/522ae1c064b09f0f1cc37cff5689ef82aa5ec4e9))

## [25.4.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.4.4...v25.4.5) (2025-02-14)


### Bug Fixes

* **dns-manager-addon:** display KeyDNS nameservers warning and enhance UI for empty records ([bdfd82a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bdfd82ad44d4d7201e60a482e273bf93a375a6d1))

## [25.4.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.4.3...v25.4.4) (2025-02-13)


### Bug Fixes

* **cnic registrar module:** patch empty dnszones creation as part Domain Details View ([2238977](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2238977b72652c969fd840e7d6ebf707a3d65c78))

## [25.4.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.4.2...v25.4.3) (2025-02-12)


### Bug Fixes

* **dns manager addon:** include file extension in import statement ([acb7aa6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/acb7aa6202bd758ab436622c125d50039fa66f7b))

## [25.4.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.4.1...v25.4.2) (2025-02-12)


### Bug Fixes

* **cnic/ispapi registrar & domain search addon:** Enhance TLD handling in domain suggestions & improve domain availability status handling ([bbd8df0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bbd8df090142fa086ca252138fbffdb5382cb7b6))

## [25.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.4.0...v25.4.1) (2025-02-07)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 11.0.0 to 11.0.1 ([406adc4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/406adc4e4222b65d263ca7d6e0192cd6e15ac958))

# [25.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.3.2...v25.4.0) (2025-02-06)


### Features

* **CNIC DNS Manager Addon:** Introducing DNS Manager addon with responsive UI, error handling, and client area integration ([907c2e7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/907c2e7456177585d81c6cc14af4391c029a8d7f))

## [25.3.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.3.1...v25.3.2) (2025-02-06)


### Bug Fixes

* **cnic registrar module:** .CA additional field handling: add preselection of Legal Type ([d270523](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d270523487efcb48b1ac74bc3d2382c98858def5))

## [25.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.3.0...v25.3.1) (2025-02-06)


### Bug Fixes

* **cnic / ispapi registrar module:** patch issues with missing DkTaCHandler Class ([fee978b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fee978b4e2ba63419f15862628c35cdde24f3740))

# [25.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.2.1...v25.3.0) (2025-01-31)


### Features

* **ispapi / cnic registrar module:** add multi-lang support for .dk checkout page ([3ce56dc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3ce56dc75bd9b0afd1e88741e2d5d8454106635b))

## [25.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.2.0...v25.2.1) (2025-01-30)


### Bug Fixes

* **cnic registrar module:** return .CA Legal Type as required additional field ([a7edd04](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a7edd049b0fd937a780dab95656e10079308752d))

# [25.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.1.2...v25.2.0) (2025-01-30)


### Features

* **ispapi / cnic registrar module:** .DK Order Process reviewed in direction of Flow 1 compliance ([bea5854](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bea5854de81c3519786eee901cf6ab1a3e06a287))

## [25.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.1.1...v25.1.2) (2025-01-22)


### Performance Improvements

* **hexonet registrar module:** upgrade php-sdk to v10 for improved connection handling ([4c4bd3c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4c4bd3c0dd33537130a943285b28c6d55996ab55))

## [25.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.1.0...v25.1.1) (2025-01-22)


### Bug Fixes

* **hexonet registrar module:** update policies url for .ngo / .ong ([2605b1d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2605b1d8b356aa4817ce53932e6e8bc82a1f8d44))

# [25.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.0.3...v25.1.0) (2025-01-20)


### Features

* **domain monitoring addon:** Automate Premium Price & Domain Status Updates ([7ec99f8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7ec99f813ea6bfa264f035996b4552ef195be00d))

## [25.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.0.2...v25.0.3) (2025-01-15)


### Bug Fixes

* **ispapi registrar module:** add .dk domain terms and conditions additional field ([4bff2c8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4bff2c889047b2d7a0390c0cac70baaa50bcfbba))

## [25.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.0.1...v25.0.2) (2025-01-14)


### Bug Fixes

* **hexonet registrar module:** transfers to auto-fallback to 0Y period (to early for 1Y period) ([78fbaec](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/78fbaec5521efde865e8b06cd5ae7243a6f3a09d)), closes [#283](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/283)

## [25.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v25.0.0...v25.0.1) (2025-01-14)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 8.0.17 to 9.1.0 ([6814ed6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6814ed6de65e33dcbdc40985dde4267be68c05b6))

# [25.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.7...v25.0.0) (2025-01-14)


### Bug Fixes

* **cnic ssl:** take into account included domains amount when validating csr ([c567448](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c567448a3463dd96565dc3dd26a1e87a005318a8))


### Build System

* **php:** drop php7.4 encryption support ([cc8ca2d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cc8ca2d87972af0be0027a2acf885ed1f5a4b7ef))


### Features

* **cnic ssl:** get certificate information from API ([b68b3c9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b68b3c9daf0744674f98ef81a96be32107546777))
* **cnic ssl:** implement certificate deletion upon product termination ([782117e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/782117eea742541570bd1294424e097000d7f6a8))
* **cnic ssl:** implement certificate reissuing ([0cd6586](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0cd6586887ac0f944dcad76b06d35c3c35024b62))
* **cnic ssl:** implement CSR generation in order process ([6322fa6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6322fa605fee84cc33f097369a2e70656d451961))
* **cnic ssl:** only prompt for private key if autodeploy is enabled and webpros server is detected ([82d301e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/82d301e52da2ddd29cd85895d1614f53c5122321))
* **cnic ssl:** support wildcard and non-wildcard additional domains on base certs that allow that ([b4b1434](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b4b14341d77da7cf99a305ee5dbb272bb6c99cd4))


### BREAKING CHANGES

* **php:** Dropped support for PHP 7.4. Please use earlier versions of our module, if you can't upgrade to PHP 8.
* **cnic ssl:** You must reimport certificates using the CNIC SSL addon as additional required
information will get imported

RSRMID-2130

## [24.9.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.6...v24.9.7) (2025-01-07)


### Bug Fixes

* **cnic registrar module:** Added Compatibility to Get EPP Codes for .cn tld ([74006cb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/74006cb3a58c940b5678fed63eef7e8c06e716d3))

## [24.9.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.5...v24.9.6) (2025-01-07)


### Bug Fixes

* **domain search addon:** improve domain search functionality and domain search handling exact search terms ([5258c50](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5258c50e57140f00067fe18574d9eefef2237dcc))

## [24.9.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.4...v24.9.5) (2025-01-07)


### Bug Fixes

* **cnic & ispapi registrar module:** Enhance tracking by passing client ID instead of user ID to logActivity ([ad2d293](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ad2d2936a82c18cae293d5ec675e1bba6d0d4351))

## [24.9.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.3...v24.9.4) (2024-12-16)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.42 to 3.0.43 ([2e746e7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2e746e72b87a7d4a8aec661d35f7d3c96e8f9326))

## [24.9.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.2...v24.9.3) (2024-12-12)


### Bug Fixes

* **cnic registrar module:** update .uk fields translations (to align with recent API changes) ([9c2dc35](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9c2dc3529ba227dae666670c3e356143fc360aec))

## [24.9.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.1...v24.9.2) (2024-11-29)


### Bug Fixes

* **domain search addon:** improve handling of selected TLD categories in regular search tab ([9d0787a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9d0787ae411368992209374deab5d446d6bf2df3))

## [24.9.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.9.0...v24.9.1) (2024-11-22)


### Bug Fixes

* **cnic domain search addon:** Update tab action handling and improve domain transfer logic ([6c31041](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6c31041a5fa5a884a0288459e939a68338f094d8))

# [24.9.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.8.3...v24.9.0) (2024-11-21)


### Features

* **cnic registrar module:** enhance domain suggestion functionality & added configuration to lookup provider ([3b7358d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3b7358d00dff564daada1240724fbdeda77ec51d))

## [24.8.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.8.2...v24.8.3) (2024-11-19)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([8e81d9d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8e81d9d10d89d6e126013236c35c309de0b7f033))

## [24.8.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.8.1...v24.8.2) (2024-11-18)


### Bug Fixes

* **deps:** bump cross-spawn from 7.0.3 to 7.0.6 ([0a66104](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0a661040ce662accd0fd2916b86b0bda7d73b77d))

## [24.8.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.8.0...v24.8.1) (2024-11-14)


### Bug Fixes

* **cnic registrar module:** improve domain indexing and validation in CheckDomains command for the domain search ([ce51b54](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ce51b5453c9511628254023eb704d175ec7e1e2e))

# [24.8.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.7.4...v24.8.0) (2024-11-14)


### Features

* **cnic registrar module:** Implement trade cost detection and logging for CNR Integration. Add To-Do List item for costs and invoice creation for end customers. ([77c0b9d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/77c0b9dcdc79967a3501710f19ad51c4e8524b0f))


### Performance Improvements

* **cnic registrar module:** optimize contact details fetch and save integration ([a495d5d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a495d5d39a34e3882f321955835459baa3d6e242))

## [24.7.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.7.3...v24.7.4) (2024-11-14)


### Performance Improvements

* **cnic registrar module:** optimize contact details fetch and save integration ([c536f0a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c536f0a844848efe7da5e5c0c12ca099f608b168))

## [24.7.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.7.2...v24.7.3) (2024-11-14)


### Bug Fixes

* **cnic registrar module:** review .au (and related 3rd level tlds) translations / texts ([d11cb39](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d11cb39941d074f85696bc600ffc1cc5d13d16b5))

## [24.7.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.7.1...v24.7.2) (2024-11-11)


### Bug Fixes

* **cnic registrar module:** review .FI additional domain fields ([bfe60f7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bfe60f7833fd45e26aeda9e1b7e070e8dab5aad5))

## [24.7.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.7.0...v24.7.1) (2024-11-11)


### Bug Fixes

* **cnic registrar module:** switch fields gen back to non-tmp. workaround (issue with 3rd lvl tlds) ([071cb24](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/071cb24ddc37660edf2dc8e7a93df03b67d6adc6))

# [24.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.6.2...v24.7.0) (2024-11-08)


### Bug Fixes

* **cnic registrar module:** added partial missing translation for AFNIC TLDs ([3c3cf50](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3c3cf50eb7e8a4bf1647e5b993d55f154979cb00))
* **cnic registrar module:** improve description for .EU citizenship field ([b69ea3c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b69ea3c8c21308344f1a94c244ab0ec0b5b2363b))
* **cnic registrar module:** reviewed API error handling within additional domain fields generator ([46fc1eb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/46fc1eb010ff00d364dddf7db68332510df96ee3))


### Features

* **cnic registrar module:** add .abogado additional domain fields translations ([79115d8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/79115d80c7a7fd7f99a9963def5c93726b0841ab))
* **cnic registrar module:** add .aero additional domain fields translations ([e21a5ca](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e21a5ca6558191e13e722a2510bbc37fae0450b2))
* **cnic registrar module:** add .attorney additional fields translations ([c675a8b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c675a8b43cd957b55688f780600623bd861452e2))
* **cnic registrar module:** add .au additional fields translations ([2e85479](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2e854794ce4f199d14eb9dee04ceb06d52d2e0d8))
* **cnic registrar module:** add .ca additional fields translations ([1cd06fd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1cd06fd42e7152c35cc554c25b52d2527405a338))
* **cnic registrar module:** add .cn additional fields translations and prefilling ([47f20e3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/47f20e3c0697ef173afa1357f0213e91758bb071))
* **cnic registrar module:** add .com.br additional fields translations ([c1aad90](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c1aad900ec41279cfc625b4147ec6138edcc6bf1))
* **cnic registrar module:** add .coop additional fields translations ([2147936](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/214793646db35f0a4a1e5031d00c667e63cc5cb7))
* **cnic registrar module:** add .dk additional domain fields translations ([fea8098](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fea8098678991cf816017a015991883ff9f9745d))
* **cnic registrar module:** add .es additional domain fields translations ([2db87ea](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2db87eafc06cd8aa24c9c73e9efb7e5356017f74))
* **cnic registrar module:** add .fi additional domain fields translations ([8659926](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/86599261eb480e1e4a1253dc836ff2603a9299e9))
* **cnic registrar module:** add .gay additional domain fields translations ([3c3eaaa](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3c3eaaaf4de7091be90a09ca2bc5a47ecfa35119))
* **cnic registrar module:** add .HK additional domain fields translations ([b344968](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b3449683d3d2901980ee6836f27a1f3f00076e8a))
* **cnic registrar module:** add .ie additional domain fields translations ([172f9ec](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/172f9ecad12c0dc365af94c10bbf0df61e0e8dfa))
* **cnic registrar module:** add .LT additional domain fields translations ([5085c96](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5085c96bb544f1dc05213fb45d0fa14aea8e1c78))
* **cnic registrar module:** add .LV additional domain fields translations ([61fff19](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/61fff194b450ce3968fe69e6d4ea8bf846829a13))
* **cnic registrar module:** add .MK additional domain fields translations ([6e00578](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6e00578ca1b11db638ee5f9803b8ab35a67e3278))
* **cnic registrar module:** add .MY additional domain fields translations ([469b9e9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/469b9e977b6e8729e31cbe470ba58057dd4af201))
* **cnic registrar module:** add .NO additional domain fields translations ([eb475b3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb475b3bc28fc31a2dc7edc67739a2ffae2fd55d))
* **cnic registrar module:** add .NU additional domain fields translations ([249994a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/249994aaba51f5041fc5af89480d13f34f3251cc))
* **cnic registrar module:** add .NYC additional domain fields translations ([445bd48](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/445bd48d337d08a7e93a0ac08d95fe6cd8a79a00))
* **cnic registrar module:** add .PARIS additional domain fields translations ([d7c9a9a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d7c9a9aa5680259831d9342b00dec65523fcc20c))
* **cnic registrar module:** add .PT additional fields translations ([a3092b7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a3092b7ff40519821d42756e636979ceed90ca57))
* **cnic registrar module:** add .RO additional domain fields translations ([c185231](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c18523115d040db9f9447dd7c1541483f20b0f9c))
* **cnic registrar module:** add .RU additional domain fields translations ([403249d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/403249d4a0769b95d38076ac4fc4882a6bd2d8f4))
* **cnic registrar module:** add .SE additional domain fields translations ([abeaed5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/abeaed58692163a384ca833dacc7a9c3843378db))
* **cnic registrar module:** add .SG additional domain fields translations ([eeb9e75](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eeb9e75e099420f882e5f252efccb27de97784e8))
* **cnic registrar module:** add .SWISS additional domain fields translations ([f15640a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f15640aeddfd2ab2d328c4d2a8b4c535b815c411))
* **cnic registrar module:** add .TRAVEL addditional domain fields translations ([d3cd3f5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d3cd3f523c5347ac55c7d63e9337aa37bd9ba220))
* **cnic registrar module:** add .US additional domain fields translations ([6a15a6d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6a15a6ddb8d468a8b84fca34af99350e01a704ce))
* **cnic registrar module:** add .XXX additional domain fields translations ([ec19346](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ec1934613ca34aba6e56d521275786833a7fc93e))
* **cnic registrar module:** add Google TLD additional domain fields translations ([8888384](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8888384c26a2f5f6aa8a27a534ec0125a39c8518))
* **cnic registrar module:** add prefilling for .SWISS Owner Type field ([41b80c6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/41b80c64a1f03d81e59542ab165f9e3f05ed5601))
* **cnic registrar module:** add. fields: .IE lang preselection; default to EN for lang fields ([18acd7e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/18acd7e522bb41d0289ddc491fcccde9dbca54e9))

## [24.6.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.6.1...v24.6.2) (2024-10-31)


### Bug Fixes

* **domain search addon:** Patch issue causing filters and additional options to ignore configurations ([8562eea](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8562eea1fffbe49b2220dcb62c96aa860ed1406a))
* **ispapi & cnic registrar module:** Patch issue causing monitoring errors on Premium domains renewals ([1720e0a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1720e0ab408214ea4038fce1ae2b1733796614e1))

## [24.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.6.0...v24.6.1) (2024-10-23)


### Bug Fixes

* **domain search addon:** patched cache clearing ttl expiry timeout loops ([753b5a3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/753b5a3a113a64e25e485d5276abd1e7031a89ba))

# [24.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.5.4...v24.6.0) (2024-10-22)


### Features

* **domain search addon:** enhance caching and UI features for better user experience ([eb2fc0a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb2fc0aa94104089ac683bceb606ffdacefbf5da))

## [24.5.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.5.3...v24.5.4) (2024-10-22)


### Bug Fixes

* **ispapi registrar module:** additional field issue (X-ACCEPT-SSL-REQUIREMENT) with contact updates ([2de61c3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2de61c308031ece876a52e531533c851b8deb2d5))

## [24.5.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.5.2...v24.5.3) (2024-10-16)


### Bug Fixes

* **cnic registrar module:** add platform config to composer to ensure PHP 7.4 emulation ([a1a5273](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a1a5273cc0a9b856ff349f68a8a2273e61e99951))

## [24.5.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.5.1...v24.5.2) (2024-10-16)


### Bug Fixes

* **cnic:** ensure PHP 7.4 compatibility in vendor libs ([1b1d7c8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1b1d7c87b515334a477803fdc51600a3e42b4ec8))

## [24.5.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.5.0...v24.5.1) (2024-10-15)


### Bug Fixes

* **activity logging:** forward 0 as uid if there is no client session or uid present there ([2430458](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2430458059de9f4bb5a89fa2d6a86b46c96582d3))

# [24.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.4.0...v24.5.0) (2024-10-11)


### Bug Fixes

* **cnic ssl:** fix php 7.4 compatibility ([db913a8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/db913a8064472f11d136f79329e9e5eff51e26b3))
* **cnic ssl:** prevent scenario where products are missing registrar property in db ([0a52647](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0a526475a4fa165062c0cbe98df51b3e7f1d58fe))


### Features

* **cnic ssl module:** implement automatic cert validation configuration and cert installation for Plesk/DirectAdmin/cPanel ([835268e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/835268e52b9faa67e2f2d02c84d2d58367235da1))

# [24.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.3.2...v24.4.0) (2024-10-10)


### Features

* **cnic registrar module:** add translations for .uk additional fields ([b02d003](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b02d003f40e72cbd67c6b8fbbde858e34575f98c))
* **cnic registrar module:** introduced registrar setting Automatic DNSSEC Deactivation on Transfer ([437d159](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/437d159f00a87a5a8266ba2a884094ec394f26d7))

## [24.3.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.3.1...v24.3.2) (2024-10-09)


### Bug Fixes

* **cnr domain registrar:** added ioncube support for php 8.1 and 8.2 ([3aed5dd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3aed5dd6320cf29db14c01f276cddb93fdd5989f))

## [24.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.3.0...v24.3.1) (2024-10-08)


### Bug Fixes

* **deps:** bump lit from 3.2.0 to 3.2.1 in /domain-search-src-files ([43b5521](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/43b552127f77644eb195f8a38dc304e0a5eeeee5))

# [24.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.2.0...v24.3.0) (2024-10-07)


### Features

* **hexonet & cnr registrar module:** added support for PHP 8.2 & support for WHMCS v8.11+ ([f837631](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f83763176fdb81e3ac782af5f182f5892e4063d5))

# [24.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.1.0...v24.2.0) (2024-10-04)


### Features

* **cnic registrar module:** support for the High-Performance Setup via Registrar Module Settings ([2cdc58b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2cdc58b09f40b9a74e980db671596f972c881a35))

# [24.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v24.0.0...v24.1.0) (2024-10-02)


### Bug Fixes

* **domain-search-addon:** patched domain extraction and formatting logic ([b442c31](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b442c31618881f80b0d8d5820e2fc3ee405e111a))


### Features

* **cnic registrar module:** add additional field translations for .SK ([5c5cc0d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5c5cc0db86401042834d34afba2c0fd888e42d75))

# [24.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.13.2...v24.0.0) (2024-09-30)


### Bug Fixes

* **cnr registrar module:** additional domain fields: improvements for .eu, .fr, it ([0f3b9ae](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0f3b9aec9d5b32c80b1dee04c34e53dbfcc84826))


### Features

* **cnr registrar module:** additional fields lang files/support: english, german, french, arabic (.de,.eu,.fr,.it for now) ([bd1e956](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bd1e956b415d192eba74508e5820958658d0a69b))


### BREAKING CHANGES

* **cnr registrar module:** For HEXONET/ispapi customers: please remove the include statements you have for our language files in your language override files under /lang/overrides.

## [23.13.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.13.1...v23.13.2) (2024-09-27)


### Bug Fixes

* **domain-search-addon:** Improved domain cleaning logic to handle unsupported TLDs by merging and retaining only the matching TLD for search ([e3885ee](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e3885eeace25c4c05684b9f724ebf2c940f4ad8f))

## [23.13.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.13.0...v23.13.1) (2024-09-27)


### Bug Fixes

* **cnr registrar module:** consider fullphonenumber instead of phonenumber (missing phone-cc) ([28198da](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/28198daab3fadc3325d74757df88698a2cb00d94))

# [23.13.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.12.1...v23.13.0) (2024-09-17)


### Features

* **domain search addon:** support custom language files for official languages if available ([1502ea4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1502ea40532e67d0d682e0dd8ecab30557a314b5))

## [23.12.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.12.0...v23.12.1) (2024-09-16)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.41 to 3.0.42 ([6274b57](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6274b579ba604c4f8e1be60f2ab2eb624103908c))

# [23.12.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.11.1...v23.12.0) (2024-09-09)


### Bug Fixes

* **cnic ssl:** fix multiline file content handling for sectigo certificates ([55c5a8c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/55c5a8cee35fdfbc4536187ec1a73b4d496e814e))


### Features

* **cnic registrar module:** Extend domain renewal mode status and settings for TLDs that do not support explicit renewals via admin panel client domains configuration ([49c06b1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/49c06b13e7c239ce7413496e17f6b104a9f547e8))

## [23.11.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.11.0...v23.11.1) (2024-09-06)


### Bug Fixes

* **domain-search-addon:** Fix client theme path and premium domains toggle in search engine admin config ([bc3fac8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bc3fac8889fdf27716d834697ecfa424bbf71c7a))

# [23.11.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.7...v23.11.0) (2024-09-02)


### Features

* **domain-search-addon:** Add support for custom languages ([d995923](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d995923e621605b9106173a11640f283aebe73aa))

## [23.10.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.6...v23.10.7) (2024-08-26)


### Bug Fixes

* **ispapi registrar module:** .health transfer: skip additional fields (for registration only) ([f7d1a9f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f7d1a9f94e2d27e544028332f096d6ddc0d29880))

## [23.10.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.5...v23.10.6) (2024-08-22)


### Bug Fixes

* **cnic registrar module:** include .itregional TLDs in GetTldPricing import ([8d22183](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8d2218355b3c0dd361e172338188996f52796587))

## [23.10.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.4...v23.10.5) (2024-08-12)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.39 to 3.0.41 ([806bdd1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/806bdd1dcacec386adbe8395a75d689897ec8833))

## [23.10.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.3...v23.10.4) (2024-08-06)


### Bug Fixes

* **deps:** bump lit from 3.1.4 to 3.2.0 in /domain-search-src-files ([5723dfe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5723dfe81681dff2e326e99eb311aa2871c336da))

## [23.10.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.2...v23.10.3) (2024-08-05)


### Bug Fixes

* **ispapi registrar module:** add missing registration prices for some premium domains ([3ac3bfb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3ac3bfb5e7d2f0d801f10ec1e4b08bb494825060))
* **ssl:** product configuration option is now hard linked to the product ([28aea16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/28aea1641177e7c2f643a002ddedc7dcb50cf279))


### Performance Improvements

* **domain-search-addon:** add custom.css stylesheet for custom styling ([45c57e3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/45c57e3075a46eeff0221220da0ed825296898eb))

## [23.10.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.1...v23.10.2) (2024-07-29)


### Bug Fixes

* **domain-search-addon:** resolve 'TLD not supported' error in transfer results ([ed6bdb9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ed6bdb942a5cd3afe22c92cda28c68b69e34a06b))

## [23.10.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.10.0...v23.10.1) (2024-07-25)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([2af1ea2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2af1ea2c876a61f059ff4bb9b51a39b0095d8bec))

# [23.10.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.9.1...v23.10.0) (2024-07-25)


### Features

* **domain-search-addon:** introduced configuration to turn on/off mobile sticky menu and improved UI ([547b038](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/547b038e1b9e7989468a914a2de2d5d5fce866b8))

## [23.9.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.9.0...v23.9.1) (2024-07-24)


### Bug Fixes

* **domain-search-addon:** resolve domain price range and default tab issues ([5c42a57](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5c42a579f2733b3650c97b6bed6bc7875fb3e294))
* **domain-search-addon:** resolved issue with suggestions tab causing no results to display in some cases ([246f2d5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/246f2d58d310789410c93b0eb1266692b72809b6))

# [23.9.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.8.5...v23.9.0) (2024-07-23)


### Features

* **domain search addon:** Add functionality to reorder feature tabs for enhanced organization ([4097e7f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4097e7f00db1a339546221d663a7e0889ba21522))

## [23.8.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.8.4...v23.8.5) (2024-07-23)


### Bug Fixes

* **domain-search-addon:** resolve issue causing no results to display in some cases ([19e0dce](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/19e0dcedd9abf6439dec8071de02936dc15e7209))

## [23.8.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.8.3...v23.8.4) (2024-07-22)


### Bug Fixes

* **domain search addon:** correct TLD matching for third-level domains and improve domain extraction ([5a6acd0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5a6acd0b7945c0ae30549a98a0d4a638d51c9cbc))

## [23.8.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.8.2...v23.8.3) (2024-07-19)


### Bug Fixes

* **ispapi + cnic registrar module:** deactivate charset/collation setting when creating DB Tables ([45ec212](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/45ec2125c5dea9375e69e58c03b2653eb4031e3b))

## [23.8.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.8.1...v23.8.2) (2024-07-17)


### Bug Fixes

* **cnic ssl module:** fix cert renew not updating cert id ([36a9e20](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/36a9e208219c59c41dd092e87619ab161f35e5c4))

## [23.8.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.8.0...v23.8.1) (2024-07-17)


### Bug Fixes

* **domain search addon:** reviewed and revamped menu for mobile and devices with smaller screens ([1825319](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/18253192bf779725f65e329a57c3f3b7e421c77e))

# [23.8.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.11...v23.8.0) (2024-07-11)


### Features

* **domain search addon:** Remove additional scroll bar and implement infinite scrolling with browser scroll bar for better UX ([eb03f2e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb03f2e1d51954fcd6cf39e2668872254adeccc3))

## [23.7.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.10...v23.7.11) (2024-07-09)


### Bug Fixes

* **ispapi registrar module:** deprecation of Afternic and Namemedia aftermarket domains ([eb5a603](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb5a6038ffc08fb43d531690da8d571dbde431fa))

## [23.7.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.9...v23.7.10) (2024-07-09)


### Bug Fixes

* **ispapi registrar module & domain search addon:** Changed aftermarket domain status to unavailable if no pricing, and domain search referrer from whmcs to system for reseller compatibility. ([7e46485](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7e46485b38c8b22c8d1dbb1bc3ba5aeef8b6f9bf))

## [23.7.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.8...v23.7.9) (2024-07-08)


### Bug Fixes

* **ispapi registrar module:** patch .pm contact handling for transfers ([a5123d2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a5123d240f1252d6f29845d5a747dd13ee770768))

## [23.7.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.7...v23.7.8) (2024-07-04)


### Bug Fixes

* **cnic registrar module:** fix pricing import (issue with IDN converter) ([20dcba1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/20dcba13536395449dfde447d7981cf01ed43476))

## [23.7.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.6...v23.7.7) (2024-07-04)


### Bug Fixes

* **ispapi registrar module:**  Reviewed and patched premium domains check which was flagging  premium domains as not available ([77cf5c1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/77cf5c1ea72b44489fc5a40dd8894eafcf0eb626))

## [23.7.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.5...v23.7.6) (2024-06-24)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.38 to 3.0.39 ([3333630](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3333630be91c1c5382a6f557b746b64a9658f28b))

## [23.7.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.4...v23.7.5) (2024-06-17)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.37 to 3.0.38 ([076aa15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/076aa152abea017641506723ccefca513db8bffe))

## [23.7.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.3...v23.7.4) (2024-06-12)


### Bug Fixes

* **cnic dns & migration addon:** reviewed & fixed navbar styling and optimised user viewability ([c91d913](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c91d9131fe55164a493b4760ce2b82f1131f7bf4))

## [23.7.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.2...v23.7.3) (2024-06-06)


### Bug Fixes

* **cnic migrator addon:** patched format of displayed dates ([071c4b4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/071c4b45e0553a92195b051bd64aacc3c762b7dc))

## [23.7.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.1...v23.7.2) (2024-06-06)


### Bug Fixes

* **ispapi registrar module:** patch renewal mode shown/preselected ([03a666c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/03a666c178c61bc87f997017b2c183e9f83759f9))

## [23.7.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.7.0...v23.7.1) (2024-06-05)


### Bug Fixes

* **deps:** bump lit from 3.1.3 to 3.1.4 in /domain-search-src-files ([d88b6a3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d88b6a37eb74f6d7939348d4134b67bea28800f2))

# [23.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.6.1...v23.7.0) (2024-06-05)


### Bug Fixes

* **cnic dns templating addon:** fix Template::apply to consider an optionally provided domain id ([6bc5da1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6bc5da1d69773f4b93c70b12d153d86ed1f6fe19))
* **ispapi registrar module:** SaveDNS using wrong TTL ([de27d79](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/de27d79013a600bc1217b369a8b24fa8f9c32892))


### Features

* **dns templating addon:** apply dns template after successful transfer ([ba2a3a4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ba2a3a448794936c60adcb6ec5ee18017f75a145))

## [23.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.6.0...v23.6.1) (2024-06-03)


### Bug Fixes

* **cnic migrator & domain import addon:** reviewed & replaced deprecated php functions ([be0f033](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/be0f033bf7dba93f2ea8e90fdb2b9ae43c17ee7f))

# [23.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.5.0...v23.6.0) (2024-05-31)


### Features

* **ispapi registrar module:** creates an invoice when domain owner change is requested ([83a5312](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/83a53121cc960da4edb548c117da7d209a540f4e))

# [23.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.4.5...v23.5.0) (2024-05-21)


### Bug Fixes

* **ispapi registrar module:** patch DNS Management's ALIAS RR in direction of type X-ALIAS-A ([2589d59](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2589d591eb996ace26ce1daf7cb35e432b63798a))


### Features

* **cnic domain registrar:** mark non-instant domain registrations as pending registration status ([dbc5c11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/dbc5c11d4363a18730c5a8b60d5a7089f58d3c83))

## [23.4.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.4.4...v23.4.5) (2024-05-08)


### Performance Improvements

* **cnic registrar module:** perf. review of Registrar Lock Support Detection for UI update ([25be082](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/25be08258120d52b575003d2146c7a067e39db9e))
* **ispapi registrar module:** perf. review of Registrar Lock Support Detection for UI update ([42ae1a3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/42ae1a39a80ddcba4331306214c6010ac3393993))

## [23.4.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.4.3...v23.4.4) (2024-05-07)


### Bug Fixes

* **ispapi registrar module:** cleanup var_dump ([7c5a4ce](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7c5a4ce67b9174de513b9bf7114280eb13d238ca))

## [23.4.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.4.2...v23.4.3) (2024-05-02)


### Bug Fixes

* **ispapi/cnic registrar module:** fix icons / counter of widgets ([455fa43](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/455fa43e43f1978fc89e9fb56ded9bede3dcafb0))

## [23.4.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.4.1...v23.4.2) (2024-05-02)


### Bug Fixes

* **cnic registrar module:** review sync method to cover foreign transfers correctly ([093f4c8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/093f4c8b7552906718ea0c775f55dfbdfd556852))

## [23.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.4.0...v23.4.1) (2024-05-02)


### Bug Fixes

* **ispapi registrar module:** cleanup relicts of old IDN Converter library ([44244b7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/44244b794185a328ed14af3e9f1228780338c20e))

# [23.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.6...v23.4.0) (2024-05-02)


### Features

* **cnic domain search:** Enable Direct Link Search with Predefined Search Term to Skip Two-Step SearchProcess ([769ff7a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/769ff7a935ed635e5a9893804ebfb7a2a88c4239))

## [23.3.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.5...v23.3.6) (2024-04-30)


### Bug Fixes

* **do not upgrade:** internal testing fix for the broken archives - do not upgrade ([d8df084](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d8df084d1f1ad9395e23aea6f043aa0e75f12c02))

## [23.3.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.4...v23.3.5) (2024-04-30)


### Bug Fixes

* **archives:** this is just a test release to check broken archives - do not upgrade ([680f90d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/680f90d49f164a7ea032b6f822bcef7bb46b5a8f))

## [23.3.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.3...v23.3.4) (2024-04-25)


### Bug Fixes

* **ispapi registrar module:** review .swiss additional fields to support natural persons ([7d750f7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7d750f7069e47cd92c9cfa7f97654d52d9a5b3eb))

## [23.3.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.2...v23.3.3) (2024-04-18)


### Bug Fixes

* **release process:** building registrar logo with version number ([1b52a46](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1b52a46da29d317322e00ff613078dce15837964))
* **release process:** reviewed gulp tasks and gh secrets usage ([c02e2a7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c02e2a7996f36ea3ef2be4e92111a76f8bb5cd71))

## [23.3.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.1...v23.3.2) (2024-04-16)


### Bug Fixes

* **deps:** bump lit from 3.1.2 to 3.1.3 in /domain-search-src-files ([8451824](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/84518242aea0faf9f80623c03086617f84724118))

## [23.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.3.0...v23.3.1) (2024-04-16)


### Bug Fixes

* **cnic registrar module:** patch PHP Warning in Command Library StatusDomain ([b621451](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b6214518cb03d50ec6600d4d6a2f6245c3fb0716))

# [23.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.2.5...v23.3.0) (2024-04-11)


### Bug Fixes

* **cnic ssl module:** avoid showing duplicate validation information in Client Area ([5e2068c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5e2068cca1b555cc764eed60779ad6c3223613b1))
* **cnic ssl module:** fix revoke certificate in CNIC ([0c3f311](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0c3f3114a89847032f9de47cbcaa48f86d14479b))
* **ispapi registrar module:** patch dns management in direction of IDNs in address field ([4d975c3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4d975c32f853b84abc07950bf4bf4f9534914f60))


### Features

* **cnic ssl module:** improve wildcard domain handling in CSR parsing ([ff7f6b4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ff7f6b47c071fae8813032f09060f5c1cd98f897))


### Performance Improvements

* **ispapi registrar module:** reviewed & replaced api idn conversion with php-idn-converter ([1518c47](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1518c473dda6cef0ae5dede24adae552f5f2afe1))

## [23.2.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.2.4...v23.2.5) (2024-04-10)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([60bc08b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/60bc08b3adbf0de8db12b1206b155230592a7cb9))

## [23.2.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.2.3...v23.2.4) (2024-04-08)


### Bug Fixes

* **zip archive:** rebuild (docker container patch) ([0499b20](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0499b20aee4da5b0bf18317414012e32a3885b62))

## [23.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.2.2...v23.2.3) (2024-04-06)


### Bug Fixes

* **cnic ssl module:** fix parsing of DNS records for Sectigo certificates ([a76cb14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a76cb1427e073af0a5601a92a554bc9f9f5860e8))

## [23.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.2.1...v23.2.2) (2024-04-05)


### Bug Fixes

* **deps:** bump centralnic-reseller/php-sdk from 8.0.16 to 8.0.17 ([4af67c3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4af67c37ca3e7e70e983b5e11b56f4d300f649e1))

## [23.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.2.0...v23.2.1) (2024-04-05)


### Bug Fixes

* **ispapi registrar module:** reviewed renewalmode UI for .at,.dk etc tlds ([bb783e4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bb783e458520bfa85482ca85159912255f4e6dda))

# [23.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.1.0...v23.2.0) (2024-03-20)


### Features

* **ispapi registrar module:** Allow resellers to change domain renewals to AUTODELETE on specific tlds e.g. (.DK, .AT, etc) from Domain Configurations via admin panel ([fde2f5e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fde2f5ef91e94e64e67f2415023e803b2e37b5bb))

# [23.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.0.5...v23.1.0) (2024-03-19)


### Features

* **cnic registrar module:** suppress api-side id protection service on demand ([8657799](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8657799dd7074d9ffb9d2cca8408ac4044f35d02))
* **ispapi registrar module:** suppress api-side id protection service on demand ([55f5cc5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/55f5cc54657728aa2c1b7e4199096049077271c4))

## [23.0.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.0.4...v23.0.5) (2024-03-15)


### Bug Fixes

* **cnic ssl module:** fix centralnic dns validation method for some certificate classes ([c0e1e3b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c0e1e3b1451d4ecfe48645c56483f92cee1ddcf1))
* **cnic ssl module:** fix unable to order wildcard certificates with CNIC ([0dd39f8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0dd39f8e0e270e4e20153afd2a7038bbcd662dbc))
* **cnic ssl module:** improve CSR validation ([d2d275a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d2d275a14ab6c51317304548959919a8e2a1132f))
* **cnic ssl module:** improve handling of DNS and FILE validation methods in CNIC ([28d0ecc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/28d0ecc4bc5b60d2a12a82867705bc35e14b80dc))

## [23.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.0.3...v23.0.4) (2024-03-13)


### Performance Improvements

* **cnic domain search:** minifying javascript source files to improve the performance and user experience ([8e62597](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8e6259725bdec98f855ab80fde569b65aafe00e5))

## [23.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.0.2...v23.0.3) (2024-03-12)


### Bug Fixes

* **cnic domain search addon:** remove invalid characters from searched keywords ([a8f14e3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a8f14e319183e8f347b23109364d69089287ebb5))

## [23.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.0.1...v23.0.2) (2024-03-12)


### Bug Fixes

* **cnic ssl module:** fix CNIC certificates not showing in status ([476a089](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/476a089d003b1666df1b045c5d7c95da4e31b29a))

## [23.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v23.0.0...v23.0.1) (2024-03-12)


### Bug Fixes

* **cnic migrator addon:** fix merge issue ([e7c4922](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e7c4922866fcd5e72b5ba822ef60a3e86b47066f))

# [23.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.7.5...v23.0.0) (2024-03-11)


### Features

* **cnic migrator addon:** switch email configuration files to email templates ([af30cf6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/af30cf68f2effcfc7881de719f916024b37320c8))


### BREAKING CHANGES

* **cnic migrator addon:** We switched from json configuration file based approach to using WHMCS built-in
email templating system. Check our Documentation at https://www.hexonet.support/hc/en-gb/articles/13653135500573-WHMCS-Domain-Migrator-Addon Section Client Email Templates and following.

## [22.7.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.7.4...v22.7.5) (2024-3-7)


### Bug Fixes

* **cnic ssl module:** fix contact handling in CentralNic SSL module ([cb79282](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cb7928267378463cf5d045a5752d0334f5aeaabf))

## [22.7.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.7.3...v22.7.4) (2024-3-7)


### Performance Improvements

* **release automation:** to no longer use Chrome for web scripting ([85054c8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/85054c899497fb11b19af01a206d1844a785f371))

## [22.7.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.7.2...v22.7.3) (2024-3-6)


### Bug Fixes

* **ispapi registrar module:** additional fields: add description for field .IT PIN ([d91525f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d91525fdae77eb095a634fe870a545a231f8cef9))
* **ispapi registrar module:** additional fields: add description for field .IT PIN (Transfer) ([4dccb1e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4dccb1efd2f9ff3ebd591f833756c633213b32a2))

## [22.7.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.7.1...v22.7.2) (2024-3-6)


### Bug Fixes

* **software bundle:** patched issues with ioncube encryption mechanism ([90b9c90](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/90b9c90df93b2acea9d2c8ce7f2ce24dff691053))

## [22.7.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.7.0...v22.7.1) (2024-3-5)


### Bug Fixes

* **cnic registrar module:** create todo item for 0Y term transfers only if pricing is not 0.00 ([75407ea](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/75407ea7ccfd975538abd1a693e475df46dd8d07))
* **ispapi registrar module:** create todo item for 0Y term transfers only if pricing is not  0.00 ([e4d479f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e4d479f9959849d7eebf510c1e403c6291b2ecbd))

# [22.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.6.3...v22.7.0) (2024-3-4)


### Bug Fixes

* **cnic dns templating addon:** review default nameservers for DNS Management ([b53132a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b53132a033c0c16c3a02eec1b4cc7e93901c4ec9))
* **dns addon:** fix handling of IDN domains ([fc9fc85](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fc9fc85b4a3e7452de2606e8276cb846ce29f65a))


### Features

* **dns addon:** add option to enforce registry nameservers when creating dns zone ([e31a44b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e31a44b96c071ddad11f176b36ff3323efa8c6d4))
* **ispapi registrar module:** nameserver configuration setting for dns templating addon ([039b3d8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/039b3d89db60fc5207e08d993f87bb3890453228))

## [22.6.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.6.2...v22.6.3) (2024-3-4)


### Bug Fixes

* **ispapi registrar module:** improved error messaging for domain transfers pre-checks ([2708668](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/270866870071af1a2b4627f75acdf59f38612f5d))

## [22.6.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.6.1...v22.6.2) (2024-3-4)


### Bug Fixes

* **cnic registrar module:** patch handling of contact data's middlename via firstname field ([bdb5ce5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bdb5ce57164d63e2b4c9e782318437e265e6956e))

## [22.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.6.0...v22.6.1) (2024-3-1)


### Bug Fixes

* **deps:** bump idna-uts46-hx in /domain-search-src-files ([591576a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/591576af07c3a5a93fb8c4bd5f81b8fe7ac6e861))

# [22.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.5.0...v22.6.0) (2024-2-27)


### Features

* **ispapi/cnic registrar module:** client area nameserver update to show a provider-specific error ([6c51f67](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6c51f679de0a2630e3257d528fb6646bd2de1f52))

# [22.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.9...v22.5.0) (2024-2-27)


### Features

* **cnic registrar module:** add auto-loading custom hooks file (/resources/hooks_cnic_custom.php) ([24de8e3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/24de8e395b95b0b6eeabc80f7d67910a39b02798))

## [22.4.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.8...v22.4.9) (2024-2-26)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.35 to 3.0.36 ([7b0a2f9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7b0a2f98ee78fe0d7b73f7b0a3a01c3ce30cc10c))

## [22.4.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.7...v22.4.8) (2024-2-26)


### Bug Fixes

* **hexonet registrar module:** (89) Show aftermarket domains as available via regular domain tab in cnic domain search addon and whmcs core search engine ([a7b94fd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a7b94fde986b8403985701b5049cd5bb8f71d4fb))

## [22.4.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.6...v22.4.7) (2024-2-26)


### Bug Fixes

* **ispapi registrar module:** patch loading the list of existing email forwardings ([846a8b5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/846a8b52b3ce5f962914bba89d5b1911d534808c))

## [22.4.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.5...v22.4.6) (2024-2-22)


### Bug Fixes

* **cnic / ispapi registrar module:** ignore Migrator Addon related Transfers in Post-Transfer Processing ([11d016f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/11d016f28315a871123d60e8b540aceb5afd7852))

## [22.4.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.4...v22.4.5) (2024-2-19)


### Bug Fixes

* **cnic migrator addon:** fix country code field forwarding to HEXONET integration ([304fb59](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/304fb597808443e44d9ce24aaf7093229f656505))

## [22.4.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.3...v22.4.4) (2024-2-16)


### Bug Fixes

* **cnr registrar module:** fix additional fields generator (.fr at least affected) ([7f5a533](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7f5a5333884d558d0c31f135f6a6e83bc4e678af))

## [22.4.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.2...v22.4.3) (2024-2-15)


### Bug Fixes

* **cnic registrar module:** patched .EU domain transfers with too many contact data submitted ([48abb9f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/48abb9fae389983cfc821884efbc283f6c1e92cc))
* **cnic registrar module:** using unformatted phone number for registrations and transfers ([5919f6c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5919f6c1579373da13e44172f67cdeebccc24277))

## [22.4.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.1...v22.4.2) (2024-2-15)


### Bug Fixes

* **composer.json:** deprecated PHP version requirement ([8861a62](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8861a62148bb6e5d4df5b05fb7ba364bc72964a5))

## [22.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.4.0...v22.4.1) (2024-2-9)


### Bug Fixes

* **cnr registrar module:** aftermarket integration: check for registrar id before processing ([4b33e4b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4b33e4b6fb8c802b23e55ff0f994310150dce31f))
* **cnr registrar module:** aftermarket integration: don't set a registration to pending transfer ([2482c91](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2482c91fd188712673ac2088a83942be75fc29af))
* **hooks:** fixed scope of hooks ([b65ceec](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b65ceec18e5a0eef979ca5054ec758e91ba908a1))
* **ispapi registrar module:** keep non-realtime registrations pending until completion e.g. .dk ([70e25f6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/70e25f6cc54a6940c6b10b53a864977d8193d0f4))

# [22.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.8...v22.4.0) (2024-2-6)


### Features

* **cnr registrar module:** Implemented Transfer Status and Log integration for domains in "Pending Transfer" status ([bd14184](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bd14184dfe295a168a8237a4f9861e93b6367563))

## [22.3.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.7...v22.3.8) (2024-2-3)


### Bug Fixes

* **migrator:** improve database performance ([4bc886d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4bc886d5bd19d0ca3ea0af468ca2f429e0531a02))

## [22.3.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.6...v22.3.7) (2024-2-2)


### Bug Fixes

* **cnic dns addon:** Ensure freshly created DNS Templates are available for Bulk Update ([ad677c6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ad677c66861b8cc5d64a31ba5a32762b2d7ba7cd))

## [22.3.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.5...v22.3.6) (2024-2-2)


### Bug Fixes

* **ispapi registrar module:** fix SaveDNS integration (return error case of internal GetDNS call) ([b711854](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b71185479c875a2112917a610612ce6c9be299f2))

## [22.3.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.4...v22.3.5) (2024-2-2)


### Bug Fixes

* **cnr registrar module:** minor improvement for setting transferlock within registration process ([238ad9f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/238ad9f5f200b6dbfda537e95a3ec9ef62a698a5))

## [22.3.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.3...v22.3.4) (2024-2-1)


### Bug Fixes

* **deps:** bump lit from 3.1.1 to 3.1.2 in /domain-search-src-files ([49aed0d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/49aed0d31ddb47d2815716370cb2e27614773149))

## [22.3.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.2...v22.3.3) (2024-2-1)


### Bug Fixes

* **domain search addon:** enhance Compatibility for WHMCS Database Operations ([9ac16b6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9ac16b64c6b68a1dc9702125efb07fbcbfcb3cbd))


### Performance Improvements

* **css and javascripts:** preloading stylesheets and defer loading javascripts to improve UI ([e84b17c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e84b17c042b18b04d923e3df8a79dbab09bb422d))

## [22.3.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.1...v22.3.2) (2024-1-30)


### Performance Improvements

* **css and js files:** reviewed and optimised css and js file with resource hints ([72c32df](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/72c32df1022b0e6773711a43f3a46f6202df5787))

## [22.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.3.0...v22.3.1) (2024-1-24)


### Bug Fixes

* **cnic and ibs registrar:** patch for adding to do items for  domain transfers without renewals ([98cacf7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/98cacf7bc1fb88af9ba6b1d729b9ffbb973e61c4))

# [22.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.2.1...v22.3.0) (2024-1-22)


### Features

* **ispapi/cnr/ibs registrar module:** add todo item in case of free/0Y transfer ([37551fa](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/37551fac355dd5dc0a65138d26d01b6a88f393fb))

## [22.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.2.0...v22.2.1) (2024-1-18)


### Bug Fixes

* **ispapi & cnic registrar:** exclude invalid domains from appearing in the SearchEngine via API ([126f2d3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/126f2d3a54f98d6e0dcc0d46676ae80ec0ca6b6e))

# [22.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.1.2...v22.2.0) (2024-1-16)


### Features

* **domain search addon:** Added a quick link for Aftermarket domains in Regular/Suggestions tab search results, directing users to the Aftermarket search tab. ([0f691f0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0f691f0c3bd0370ce4bcd512be50d9947fe99975))

## [22.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.1.1...v22.1.2) (2024-1-16)


### Bug Fixes

* **domain search addon:** Marking Aftermarket domains as reserved in regular and suggestion tabs. ([a51d141](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a51d14187c9de5e3ac39414c682f287d5311c41e))

## [22.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.1.0...v22.1.1) (2024-1-15)


### Bug Fixes

* **domain search addon:** Fixed an issue that was preventing the adding domains to the cart for domain transfers. ([cc99db6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cc99db6fb052b03603e28d3c7df26cd05e3e7bc5))

# [22.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.0.5...v22.1.0) (2024-1-15)


### Features

* **domain search addon:** aftermarket domains integration for HX and CNIC ([936504a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/936504ac19f0d1603b391aaab9787932f0fef08b))

## [22.0.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.0.4...v22.0.5) (2024-01-11)


### Bug Fixes

* **ispapi registrar module:** .ES fields (X-ES-REGISTRANT-TIPO-IDENTIFICACION, add option VAT ID) ([d8c41a9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d8c41a9fbf38ec659dac4666caa9aaa7427aea8e))

## [22.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.0.3...v22.0.4) (2024-01-10)


### Bug Fixes

* **deps:** bump lit from 3.1.0 to 3.1.1 in /domain-search-src-files ([aa2ae68](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/aa2ae68eda8972d58a8d0e3791a0d6428b042b8c))

## [22.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.0.2...v22.0.3) (2024-01-10)


### Bug Fixes

* **domain search addon:** fixed the stylesheet loading issue for WHMCS installations in sub-folders ([cc388a2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cc388a2237fec2a426b00d2d358d4c25d624e6f5))

## [22.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.0.1...v22.0.2) (2024-01-10)


### Bug Fixes

* **ispapi registrar module:** temporarily deactivate premium domain data auto-cleanup ([10f0633](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/10f0633818d6371e63bc67455bda51b962a1a8c6))

## [22.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v22.0.0...v22.0.1) (2024-01-09)


### Bug Fixes

* **deps:** bump phpseclib/phpseclib from 3.0.34 to 3.0.35 ([485c9ee](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/485c9ee15cdca0d10713cf08762e72041f4d320f))

# [22.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.13...v22.0.0) (2024-01-09)


### Features

* **ssl:** implement new CNR SSL API 2.0 ([4b399f1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4b399f146028f82607c5f01d464bc591b3e6ef52))


### BREAKING CHANGES

* **ssl:** Existing legacy certificates must be migrated by opening the SSL Addon once.

## [21.6.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.12...v21.6.13) (2024-01-08)


### Bug Fixes

* **cnr registrar:** fix ignored error on domain status when domain is transfered away ([74b1beb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/74b1beb98d51bac4448d23a0dee91a1229c9b614))

## [21.6.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.11...v21.6.12) (2023-12-15)


### Bug Fixes

* **cnr registrar:** make sure DNS zone is existing when saving records ([322459f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/322459f075312be9620401dff013997fa22af1e2))
* **dns addon:** fix template failing to apply ([38b88bc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/38b88bc9b04a20a07c8522b67173983728619257))

## [21.6.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.10...v21.6.11) (2023-12-14)


### Bug Fixes

* **domain search addon:** Updated the link for transferring domains to our search engine addon URL, overriding the default Store > Transfer Domain To Us link. ([e97446c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e97446cfefa5af50bc9fac1609a1a61d687c70a2))

## [21.6.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.9...v21.6.10) (2023-12-14)


### Bug Fixes

* **domain search addon:** Fixed the "cannot redeclare gettldlist" error issue for specific resellers. ([a566776](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a5667768271bc216cd489fffd818aab402c7a624))

## [21.6.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.8...v21.6.9) (2023-12-07)


### Bug Fixes

* **domain search addon:** Domain transfer authorization codes with dots (.) were not being processed correctly. ([408a7da](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/408a7da9474ebc4c050988bf2ebee8b3f0c17c9b))

## [21.6.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.7...v21.6.8) (2023-11-24)


### Bug Fixes

* **cnic registrar module:** remove contact-related params NEW, PREVERIFY and AUTODELETE ([ce29e99](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ce29e999a2c7d84ae32d150db619e400fadd59ce))

## [21.6.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.6...v21.6.7) (2023-11-24)


### Bug Fixes

* **ispapi registrar module:** tLD & Pricing Import to ignore garbage data from API e.g. .nu (CA) ([4b2beaa](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4b2beaa1444e4bfcbad13d1685749124e83a6be3))

## [21.6.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.5...v21.6.6) (2023-11-17)


### Bug Fixes

* **deps:** bump lit from 3.0.2 to 3.1.0 in /domain-search-src-files ([f4abaf6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f4abaf67a2622ecacac387ac5930a0d9908cf5d4))

## [21.6.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.4...v21.6.5) (2023-11-10)


### Bug Fixes

* **ci:** test release process after rewrite (no need to upgrade) ([714b3ff](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/714b3ffe3179f80459f0612ebe1b58c99254faec))
* **deps:** bump lit from 3.0.1 to 3.0.2 in /domain-search-src-files ([fad89a4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fad89a46e2ae0b1a2ad8ef08869942aa639b2a7f))
* **ispapi registrar module:** fix Transfer integration and use of additional fields (e.g. .dk) ([b2f59b3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b2f59b32edeeb359b0c4ede155278fa3ba3191be))
* **release process:** patch release process ([88849cf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/88849cf8c4bb7887d4d9260593f3ba43f545eb72))

## [21.6.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.3...v21.6.4) (2023-11-02)

### Bug Fixes

- **deps:** bump idna-uts46-hx in /domain-search-src-files ([4136d45](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4136d453f9b678c27817d27108c478b7e1515685))
- **deps:** bump lit from 3.0.0 to 3.0.1 in /domain-search-src-files ([973b3a0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/973b3a0416b4a7b84a3716211cf654776b769927))

## [21.6.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.2...v21.6.3) (2023-10-30)

### Bug Fixes

- **ibs / cnic / ispapi registrar modules:** patch issue with if branch in dnssec template ([b8a4d18](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b8a4d187fe0bf2446790dd68a36f5c2e3432270a))

## [21.6.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.1...v21.6.2) (2023-10-30)

### Bug Fixes

- **ibs / cnic / ispapi registrar modules:** review dnssec template for translation support ([9172f93](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9172f93bf0074a68cb506fcdc96a096ac7d2a3b4)), closes [#271](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/271)

## [21.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.6.0...v21.6.1) (2023-10-25)

### Bug Fixes

- **ispapi registrar module:** reviewed handling of applications (premium domains, .swiss et al) ([f9c0e86](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f9c0e86bf70e0268e0dd8eb1393c847a85a76809))

# [21.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.5.4...v21.6.0) (2023-10-20)

### Features

- **cnic registrar module:** add support for managing DS records in DNSSEC ([2547c38](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2547c389096c063b6405331d9ce60b542b261630))
- **cnic registrar module:** automatically detect if DNSSEC supports DS records for TLD ([3f13d30](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3f13d3015d73bf282836af6c9ed95364906c8317))
- **ibs registrar module:** automatically detect if DNSSEC supports DS records for TLD ([9c2f301](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9c2f301c840d7f62e4e76cb6493522720cf91095))
- **ispapi registrar module:** auto-detect which dnssec form is supported (dsdata or dnskey) ([69de940](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/69de940b67fa047b038f1eb67631404a1bf81c46))
- **ispapi registrar module:** revamped DNSSEC management feature ([dfef791](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/dfef79106eb8a216272b470625e8533531913cef))

## [21.5.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.5.3...v21.5.4) (2023-10-12)

### Bug Fixes

- **ssl module:** fix default registrar fallback ([e381599](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e38159930f0436de76ff5e3215de0335c3104454))

## [21.5.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.5.2...v21.5.3) (2023-10-12)

### Bug Fixes

- **ispapi registrar module:** review additional domain fields for TLD .giving ([ec43ad4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ec43ad4ad84883f47800ec784396204da4ce4c9a))

## [21.5.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.5.1...v21.5.2) (2023-10-11)

### Bug Fixes

- **cnic registrar module:** deprecate & cleanup of feature "Daily Cron" ([8c67b88](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8c67b88b1617c88e9d3cb526b6aeb4daf56d79e3))

## [21.5.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.5.0...v21.5.1) (2023-10-11)

### Bug Fixes

- **cnic & ispapi registrar module:** Domain private Nameservers access and deletion functionality fixed. ([7bf0217](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7bf0217d88a519b53bbe0d6031ceb7737455e442))

# [21.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.7...v21.5.0) (2023-10-09)

### Features

- **cnic registrar module:** added AA buttons for approving/rejecting outgoing transfers ([5e4f40f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5e4f40fa0ebafb1f262a530a2e30e4cdf6991402))
- **ispapi registrar module:** added AA buttons for approving/rejecting outgoing transfers ([da5b0f2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/da5b0f2c72dd4dafcc3984025a1c6ee489fb32f9))

## [21.4.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.6...v21.4.7) (2023-10-09)

### Bug Fixes

- **package.json:** bumped semantic-release-whmcs package depedency to 5.0.4 (no need to upgrade) ([26fde4a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/26fde4a3416fa2da5c0e70ce74e7375d9759b565))

## [21.4.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.5...v21.4.6) (2023-10-02)

### Bug Fixes

- **cnic registrar module:** add DNSZone for EmailForwardings if not present ([508eec9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/508eec990a6621ba65db5ed3904911c7bac952c6))

## [21.4.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.4...v21.4.5) (2023-09-29)

### Bug Fixes

- **ispapi/cnic registrar module:** additional domain fields validation scope & processing ([e052c7d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e052c7d1b07f79446b614375c30132f6aa0001fe))

## [21.4.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.3...v21.4.4) (2023-09-28)

### Bug Fixes

- **ispapi registrar module:** reviewed Get/SaveEmailforwarding. Create DNSZone dnsmanagement-like ([e6ee658](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e6ee6584d25091c5650b1ebac766a8456d22b34d))

## [21.4.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.2...v21.4.3) (2023-09-28)

### Bug Fixes

- **cnic domain monitoring addon:** patched an issue throwing an error on activation ([b69c430](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b69c4300b92642db988aac2e35d63f0e11e3d56c))

## [21.4.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.1...v21.4.2) (2023-09-28)

### Bug Fixes

- **migrator addon:** store EPP codes without encoded HTML entities ([ca4c4c1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ca4c4c16e41a9975849aa86984a50b72ed141f4f))

## [21.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.4.0...v21.4.1) (2023-09-28)

### Bug Fixes

- **cnic domain monitoring addon:** delete record functionality patch ([10af4d6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/10af4d624a21bcfea8d8092e04ea4817c180c5b8))
- **cnic domain monitoring addon:** patch to recalculate premium prices manually with extended info ([15948de](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/15948dee9b576bb9105105e2cb41a3c6d430dfe3))

# [21.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.3.1...v21.4.0) (2023-09-27)

### Features

- **cnic domain monitoring addon:** Sync premium status and apply pricing updates to domains ([370fd99](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/370fd995d4a144cc58cac8e196f7cf5f29c947f7))

## [21.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.3.0...v21.3.1) (2023-09-26)

### Bug Fixes

- **ispapi registrar module:** patch PHP Error in GetContactDetails in case of missing API data ([a09c44d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a09c44dc0d75a28ad796994396133732a4e30cec))

# [21.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.2.4...v21.3.0) (2023-09-25)

### Features

- **cnic & ispapi registrar module:** implemented validation for additional fields on the domain cart page ([a98befe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a98befebdb9598c4055dc1ae331518f5c701d2cf))

## [21.2.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.2.3...v21.2.4) (2023-09-25)

### Bug Fixes

- **ispapi registrar module:** .eu domain registration error due to conflicting client data fields ([76e5b73](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/76e5b731880e5a047b9e4309747c444ac9091f1c))

## [21.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.2.2...v21.2.3) (2023-09-20)

### Bug Fixes

- **cnic search engine addon:** fixed ob_start conflict with zlib compression ([fc2d3cf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fc2d3cfd6504a57010bb1f7130e5e2c73a9c037f))

## [21.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.2.1...v21.2.2) (2023-09-13)

### Bug Fixes

- **ispapi registrar:** add multiple improvements to DNS Management and detection of duplicate RRs ([cfd31cf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cfd31cf77dd14e6ad553fd3cbe7f13036ec2d039)), closes [#267](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/267)

## [21.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.2.0...v21.2.1) (2023-09-06)

### Bug Fixes

- **cnic domain search addon:** patched an issue related to add/remove items to cart ([e72da1b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e72da1b99716803c0ba350a738d690af0931cf71))

# [21.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.1.2...v21.2.0) (2023-09-05)

### Features

- **cnic domain search addon:** notifications when adding items to cart; UI for info in transfer tab ([5da5d99](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5da5d99b64c4747b9dec6162d9f27031673c9c34))

## [21.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.1.1...v21.1.2) (2023-08-31)

### Bug Fixes

- **cnic domain search addon:** sidebar menu entries on review & checkout page ([1b07242](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1b07242dc6ff88fe47ba3cbe570735fe71c7c260))

## [21.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.1.0...v21.1.1) (2023-08-31)

### Bug Fixes

- **cnic domain search addon:** patched a bug related to domain transfers auth code ([4ff1a34](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4ff1a349a36b691421d7cfc51bd810eab5594000))

# [21.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.0.3...v21.1.0) (2023-08-31)

### Features

- **ispapi registrar module:** to-Do List add: failed post-transfer updates + non-free domain trades ([7a4e881](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7a4e8813074f1bc7cff2ef39465d7a94916a1a7b))

## [21.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.0.2...v21.0.3) (2023-08-29)

### Bug Fixes

- **readme:** updated path of readme.md file ([6ca104e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6ca104e7a29cf5221b25cbf870d689c0a9de4677))

## [21.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.0.1...v21.0.2) (2023-08-29)

### Bug Fixes

- **readme.md:** updated readme.md file ([65432e8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/65432e8ce758b081800d3e2ab1519a2aca6c6a4d))

## [21.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v21.0.0...v21.0.1) (2023-08-28)

### Bug Fixes

- **cnic domain importer:** fix controller endpoints json response for http code 200 ([716f2e9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/716f2e91f51fb647d689919d8594b99fedd8f065))

# [21.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v20.0.4...v21.0.0) (2023-08-28)

### Bug Fixes

- **cnic + ispapi registrar module:** inject private nameserver list now via child theme ([7ebb039](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7ebb0395ea040499108b5a151e7c97d0b980009b))
- **ispapi registrar module:** add global default TTL Setting for DNS RR ([f3fe4bd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f3fe4bd57d40739406ebb4266513245808b764cd))
- **ispapi registrar module:** deprecated add. fields injection in admin area (contact information) ([569d22b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/569d22bf4c349ad9f6c4f098635af5d012e2c6d3))
- **ispapi registrar module:** Dns Management replacement for RR deletion via wildcard ([a826cc5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a826cc5416e0bd1c038581c6c8215d994e2dd34f))

### Features

- **cnic + ispapi registrar module:** add exact error of DNS Update to output and more record types (child theme) ([ff929fd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ff929fdf528136f1ee0cc53fe5ca4eb5263890dc))
- **cnic + ispapi registrar module:** add support for TTL field for DNS Management Section ([0d682d5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0d682d55808c1efcf756387ceaa32ca70c0ac85d))
- **cnic + ispapi registrar module:** review private nameserver deletion for better UX ([e3fb49d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e3fb49d66bfebda9a18f0a60e4c641f022021422))
- **cnic registrar module:** add support for MXE resource record (internally covered via MX, A) ([dfc57ca](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/dfc57ca847d4562f3b8c4725e660eb4896911308))
- **cnic sex/twenty-one theme:** show success message for succeeded dns update ([d556633](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d556633cfb11c5cbe3c3536c824e6173b42b013c))
- **ispapi registrar module:** offer more supported DNS Resource Records ([e3ca300](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e3ca30063b7a75f3116e970ffdf56072f0293d79))

### BREAKING CHANGES

- **ispapi registrar module:** The way of doing the additional domain fields injection on contact information page in admin are wasn't compatible to all themes and were it did not work, we run into bugs. If you want to cover a contact update via admin area, please do the additional fields update via domain details first and then the contact update itself.
- **cnic + ispapi registrar module:** We use beneficial child themes now (compatible to WHMCS 8) to improve the DNS Management Section. We added a TTL field plus better error / success messaging and more supported resource records. Please ensure so update your template fields by taking over custom changes we applied to includes/alert.tpl and clientareadomaindns.tpl. Find our custom files under /templates/cnic-six or /templates/cnic-twenty-one. Custom changes are wrapped with comments to ease up taking them over.
- **cnic + ispapi registrar module:** Javascript-based way for private Nameserver List injection got replaced by
  injection over child theme.

## [20.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v20.0.3...v20.0.4) (2023-08-28)

### Bug Fixes

- **cnic domain search addon:** input search fix for bulk domain transfers ([4796874](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/47968741042a693aba0f6b145d6afac3ebecb1d9))

## [20.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v20.0.2...v20.0.3) (2023-08-25)

### Bug Fixes

- **cnic registrar module:** .dk transfers to be initiated without contact data ([34e8bc1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/34e8bc10b31402370e6253356d0441d7aae3b779))

## [20.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v20.0.1...v20.0.2) (2023-08-24)

### Bug Fixes

- **composer dependencies:** changed the way of producing the vendor directory ([fb3987c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fb3987c596c14df719cb868072007c5cde36f23e))

## [20.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v20.0.0...v20.0.1) (2023-08-04)

### Bug Fixes

- **cnic & ispapi registrar module:** patch for pre-select domain addons on checkout ([020f54f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/020f54fc3952400e19971ff1ebcd81bf6f7881aa))

# [20.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.1.3...v20.0.0) (2023-08-04)

### Bug Fixes

- **cnic registrar module:** patch GetContactDetails to return all contact even if not set ([2c432d4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2c432d444c613ee1b6fabb2f4d61bf4dec9f4fa5))
- **ispapi registrar module:** improved description for .NO "Registrant ID Number" additional field ([60b0382](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/60b0382107bdfa5e585b7f8b30e1625b7b05134d))
- **ispapi registrar module:** inject additional fields via Child Theme (deprecate JS solution) ([a5d8578](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a5d857822d7fd504a6a28c6a3aedbd3d7563d39c))

### BREAKING CHANGES

- **ispapi registrar module:** Replaced our Javascript-based injection of additional fields into the contact
  information form in clientarea with a mechanism using Child Themes.

## [19.1.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.1.2...v19.1.3) (2023-07-31)

### Bug Fixes

- **cnic dns addon:** disable Apply button while in progress ([f5a37f1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f5a37f1db846e39586d8468b709466fe0992b248))

## [19.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.1.1...v19.1.2) (2023-07-31)

### Bug Fixes

- **cnic registrar module:** review registrar context in hooks ([e51e642](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e51e6420b52eef603ccf9382e7f9ed428270f60d))

## [19.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.1.0...v19.1.1) (2023-07-31)

### Bug Fixes

- **cnic registrar module:** additional fields conditional requirements detection ([eb0ef0e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb0ef0eacf02c12b2c92d2eb933f3ae72806f2a4))

# [19.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.16...v19.1.0) (2023-07-27)

### Features

- **cnic dns addon:** add ability to bulk apply templates to multiple domains ([8ea581a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8ea581a1ee69e710dd37bf4ff693ca90ddc036cf))

## [19.0.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.15...v19.0.16) (2023-07-26)

### Bug Fixes

- **cnic registar module:** fix issue with additional fields update in `_SaveContactDetails` ([efa3ca7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/efa3ca7083e2709bf750db2f67d95c19cda13980))

## [19.0.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.14...v19.0.15) (2023-07-26)

### Bug Fixes

- **cnic registrar module:** domain Sync to map Active to Transferred Away ([6091f03](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6091f038c3a0a5b071235021f008eb2ee29517e1))

## [19.0.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.13...v19.0.14) (2023-07-26)

### Bug Fixes

- **ispapi registrar module:** add X-AT-DISCLOSE = 0 in contact data updates (auto-hide contact data) ([08d35c3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/08d35c3a5ddcb6794f23b1c707d605156fb2468a))

## [19.0.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.12...v19.0.13) (2023-07-25)

### Bug Fixes

- **cnic registrar module:** no PHP error when saving contact data in context of pending domains ([3e94e7e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3e94e7eaa27cc64285926e093f0b9bcb2d44ea9f))

## [19.0.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.11...v19.0.12) (2023-07-25)

### Bug Fixes

- **cnic domain search add-on:** Patched domain suggestion search ending in PHP error ([4a6c73b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4a6c73b45660f401b20c35ec6d5a45cd2d839707))

## [19.0.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.10...v19.0.11) (2023-07-24)

### Bug Fixes

- **cnic registrar module:** fix transfer precheck on shopping cart ([478f3f1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/478f3f1eb556e022d8e9dbf2c62c7c819f888d7f))

## [19.0.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.9...v19.0.10) (2023-07-24)

### Bug Fixes

- **cnic and ispapi registrar module:** beautifying the system activity logs ([f943d5c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f943d5c4d814d0fc63b5a2a57d408adc0626cd09))
- **ispapi registrar module:** getEPPCode for .NZ, .FI reviewed ([0b8a14e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0b8a14e40cbd09f119e367beb26793f0b944f685))
- **ispapi registrar module:** logging for renewal patched ([98b2517](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/98b2517cce7876518091018d70f0b382a1a5c810))

## [19.0.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.8...v19.0.9) (2023-07-18)

### Bug Fixes

- **ispapi + cnic registrar module:** cleanup additional fields handling in \_GetDomainInformation ([d59ea2c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d59ea2c31169dd0ad564949654846a09ff0e28be))

## [19.0.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.7...v19.0.8) (2023-07-14)

### Bug Fixes

- **cnic ssl addon:** patch ouput of Intermediate Cert + Root Cert for CNR ([5c39e69](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5c39e69e2e0d7bbb8566cbcab2de5e151200b280))

## [19.0.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.6...v19.0.7) (2023-07-13)

### Bug Fixes

- **cnic registrar module:** replace comma in additional field option labels (=new option for WHMCS) ([d335b46](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d335b4633dd89f19401c9471cb8218dbfa44c6b2))

## [19.0.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.5...v19.0.6) (2023-07-13)

### Bug Fixes

- **cnic domain importer:** do not include additional fields in import (auto-reg lookup of whmcs) ([31f138b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/31f138bc7f3912d79ab1471cd5678db1f895a9d4))
- **cnic registrar module:** patch AdditionalFields' Class internal function call to $this context ([e89b4ee](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e89b4ee821c56a92c8c86363c685d6c193d99cba))

## [19.0.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.4...v19.0.5) (2023-07-13)

### Bug Fixes

- **cnic registrar module:** patched issue related to domain status for DNS management ([0e43b96](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0e43b96d204cfa9f9868929e9bb5c999bc7750d7))

## [19.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.3...v19.0.4) (2023-07-13)

### Bug Fixes

- **cnic ssl addon:** works again with ispapi registrar module ([f0ae65d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f0ae65d524d46fc786c5d92129100960c1d93e6e))

## [19.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.2...v19.0.3) (2023-07-12)

### Bug Fixes

- **cnic registrar module:** review and cleanup of additional fields' required property detection ([8473cd2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8473cd2302b2de3da242cbf4364cdb0590b73dac))

## [19.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.1...v19.0.2) (2023-07-11)

### Bug Fixes

- **cnic registrar module:** patch issue in field generator ([0512f2b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0512f2b3fca96ddb8a936cd4a0d98ba103419102))

## [19.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v19.0.0...v19.0.1) (2023-07-10)

### Bug Fixes

- **cnic registrar module:** cleanup additional fields tmp. workaround ([2a07184](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2a071847547998827ebb2bec8be856a163323177))

# [19.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v18.0.3...v19.0.0) (2023-07-10)

### Features

- **cnic registrar module:** api-driven additional domain fields integration (no config required) ([c77d7b5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c77d7b59dbb74b4f89ac5bb256f1c1251f13d9e7))

### BREAKING CHANGES

- **cnic registrar module:** New API-driven way for Additional Domain Fields added. Therefore, a custom configuration via /resources/domains/additionalfields.php is no longer required for the cnic registrar module. It follows the HEXONET Brand in that regard with few improvements. The Integration itself in direction of additional domain fields is by this step fully API-driven and with no support effort (missing or wrong additional domain fields configuration) and it makes a custom configuration entirely superfluous. In addition, we have made auto-prefilling available for tax id, language, country related input fields and we made the fields 100% translatable via Language Override Files.
  If you're interested in adding your custom translation, add domains with TLDs of interests to your Shopping Cart and switch to the Shopping Cart Item's Configuration. There, add "&showtranslationkeys=1" to the URL and press enter. Instead of the texts, you'll now see the Translation Keys which can be used in the Language Override files for adding your custom translations. If you remove that URL parameter again, texts will be displayed as usual. The fallback will always be our default english texts in case a translation is not present. It allows for translating step by step.

## [18.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v18.0.2...v18.0.3) (2023-07-07)

### Bug Fixes

- **cnic domain search engine addon:** fixed DB query issue preventing addon upgrade ([153c94c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/153c94c4203fbf9fa2ca6e5077ca7cfa117fb66e))

## [18.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v18.0.1...v18.0.2) (2023-07-05)

### Bug Fixes

- **cnic domain search addon:** updated broken url in spotlight tlds section ([d98e3b9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d98e3b91eceb00ad0308f93ac1bd908adefc3f5c))

## [18.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v18.0.0...v18.0.1) (2023-07-05)

### Bug Fixes

- **cnic ssl addon:** patch issue with missing dependency utopia/domains ([8912a2a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8912a2a8cf52ee70424e2f8860fbdcf81facbbc9))

# [18.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.26...v18.0.0) (2023-07-03)

### Features

- **cnic domain search addon:** Deprecating domain search v2 and introducing domain search v3 ([7ada120](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7ada120d5a862e1e9190bb7d10d2cf562536722b))

### BREAKING CHANGES

- **cnic domain search addon:** In this release, we have deprecated Version 2 of our ISPAPI Domain Search addon. As a result, it is no longer accessible. We kindly ask you to remove the older version of our domain search addon and start with the Version 3. To take advantage of the new and improved Domain Search with exciting features, we recommend reading and following our updated public documentation.

## [17.2.26](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.25...v17.2.26) (2023-07-03)

### Bug Fixes

- **cnic registrar module:** fix private nameservers page in client area not working ([c12da8d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c12da8dcb9a6ecc45d6ae4606e52b1fcce3569cc))

## [17.2.25](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.24...v17.2.25) (2023-06-28)

### Bug Fixes

- **ispapi registrar module:** improve additional fields injection theme compatibility (lagom) ([36e3144](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/36e3144d6e30351f102e935c0da2c32dd894dbb8))

## [17.2.24](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.23...v17.2.24) (2023-06-23)

### Bug Fixes

- **cnic registrar module:** remove additional fields for .SWISS Domain Transfers ([172aa6c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/172aa6cac3ceba8211b96898cd3a25b261b6f94f))

## [17.2.23](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.22...v17.2.23) (2023-06-22)

### Bug Fixes

- **cnic registrar module:** patch .swiss transfers (consider lower-case parameter name) ([3c08b98](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3c08b98a577ece169f6a391547442df86da21272))

## [17.2.22](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.21...v17.2.22) (2023-06-22)

### Bug Fixes

- **migrator addon:** abort migration if non-premium domain is premium on target registrar ([d98dacc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d98dacca9df5d32dd2eeb9b4f487a447f1dc64d9))

## [17.2.21](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.20...v17.2.21) (2023-06-22)

### Bug Fixes

- **cnic registrar module:** missing .ES additional fields (Admin, Tech, Billing) for registrations ([1294556](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/129455632e4143ad3a6004a691369224f38baee7))
- **cnic registrar module:** patch .SWISS Transfer (removing parameter CLASS = SWISS-GOLIVE) ([fe43e2e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fe43e2e52d2b7d654db85b905ad842471f0ac3ec))
- **ispapi registrar module:** patch dns management activation via sync to rely on dnszone status ([6efd3c9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6efd3c9c75fc9a484f6417c130b8c9d3b3a5f4ef))

## [17.2.20](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.19...v17.2.20) (2023-06-16)

### Performance Improvements

- **cnic registrar module:** remove check for last version in registrar module overview ([eb39a4b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/eb39a4bfcee20a6adb5e4e1958e13971d8b2adbe))

## [17.2.19](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.18...v17.2.19) (2023-06-16)

### Bug Fixes

- **cnic registrar module:** premium domain transfer support ([4ac293d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4ac293db7c463fff825f971cb09d805a4702c9d4))

## [17.2.18](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.17...v17.2.18) (2023-06-14)

### Bug Fixes

- **ispapi registrar module:** migrate connectivity check to \_config_validate ([526e8c1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/526e8c1cbd716a415a8d3dbfff457839848cffd2))

## [17.2.17](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.16...v17.2.17) (2023-06-14)

### Bug Fixes

- **cnic registrar module:** move connection validation to \_config_validate ([5245555](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5245555d5c1e2983ef66d6aa06fc80a72324ae2e))

## [17.2.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.15...v17.2.16) (2023-06-13)

### Bug Fixes

- **cnic registrar module:** use configured data for admin/tech/billing if not ＂Use Clients Details＂ ([6e015c4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6e015c4518780d2d1ef42d00de452f17f26719fb))

## [17.2.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.14...v17.2.15) (2023-06-12)

### Bug Fixes

- **cnic registrar module:** fix expirydate detection (consider api property renewaldate) ([175493d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/175493ddf5b9a38cb7d1b8d8d2b2d81b4b754a26))

## [17.2.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.13...v17.2.14) (2023-06-09)

### Bug Fixes

- **cnic registrar module:** patched PHP Error in SaveContactDetails ([fcd6ff4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fcd6ff4674632b4a1a0f7457db0874c38db17a23))

## [17.2.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.12...v17.2.13) (2023-06-09)

### Bug Fixes

- **ispapi registrar module:** dNS Management ([4d48b28](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4d48b28e91582723c3d6657876c3009cc2147584))

## [17.2.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.11...v17.2.12) (2023-06-07)

### Bug Fixes

- **ispapi registrar module:** restrict output of "Cancel Transfer", "Resend Transfer Approval Email" ([b98b924](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b98b9242a90ba254838ccf0b4fc734fac6199e11))

## [17.2.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.10...v17.2.11) (2023-06-07)

### Bug Fixes

- **cnic + ispapi registrar module:** patch getConfigArray to consider custom admin folder name ([a38be33](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a38be331b58471b7c2310071d4fce0d609f4aaaf))

## [17.2.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.9...v17.2.10) (2023-06-06)

### Bug Fixes

- **ispapi registrar module:** update .HK registration policies url ([b876688](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b876688bdb650fb99657bfb6321841e01a88c5cb))

## [17.2.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.8...v17.2.9) (2023-06-05)

### Bug Fixes

- **ispapi registrar module:** generic field solution for google TLDs (X-ACCEPT-SSL-REQUIREMENT) ([fa13d83](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fa13d8385e6e60990d1b6a503475ddf3dc21a686))

## [17.2.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.7...v17.2.8) (2023-06-02)

### Bug Fixes

- **cnic registrar module:** patch wrong output of eppcode with special chars ([8d35785](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8d3578550f7e3d4c7fa4c6c90eaa9d822e8a584f))

## [17.2.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.6...v17.2.7) (2023-06-02)

### Bug Fixes

- **ispapi registrar module:** patched expirydate for new regs (finalization-, failuredate n/a yet) ([8c83d1b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8c83d1b2694405fc328d43b0462990a3beb266be))

## [17.2.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.5...v17.2.6) (2023-05-31)

### Bug Fixes

- **cnic registrar module:** fix .SWISS additional domain fields binding to default WHMCS' fields ([1fdf47b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1fdf47bc8c6b6937dcc7542746d43374bd0697ee))

## [17.2.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.4...v17.2.5) (2023-05-31)

### Bug Fixes

- **ispapi registrar module:** contact information form & reviewed additional domain fields injection ([74af371](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/74af37178c49f74b6343c315c3bd9d9438b4968d))

## [17.2.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.3...v17.2.4) (2023-05-30)

### Bug Fixes

- **ispapi registrar module:** remove X-SE-ACCEPT-REGISTRATION-TAC from Contact Update ([c5aff1a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c5aff1aa8acca5fdd92547a8983b34d713abef77))

## [17.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.2...v17.2.3) (2023-05-24)

### Bug Fixes

- **cnic registrar module:** include contact data in .SI Transfer Request ([65a3293](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/65a3293d1aec80c56e9fb4e9318e908c6f8797cd))

## [17.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.1...v17.2.2) (2023-05-22)

### Bug Fixes

- **ispapi registrar module:** add missing namespace to class Carbon ([9558489](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9558489af965ca0a202436cc892cdfb0420ac46c))

## [17.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.2.0...v17.2.1) (2023-05-22)

### Bug Fixes

- **cnic registrar module:** add additional domain fields for .EUS ([d057177](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d0571776f999e0fcb014a26372ce41cb00d42497))

# [17.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.7...v17.2.0) (2023-05-22)

### Bug Fixes

- **ispapi registrar module:** patch pending contact verification output ([6848c84](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6848c849a8cba258412d1792a12487ff0ba6f9d0))
- **ispapi registrar module:** review `setPendingSuspension` integration for Registrant Verification ([f8435fb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f8435fbb54ecf8b7cfe1d7a390111fe0492309f6))
- **ispapi registrar module:** review IRTP for 60d lock display and lock opt-out ([d7ce839](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d7ce8399fab999db6286c195b6db85fadef62fcf))

### Features

- **cnic registrar module:** add initial IRTP integration ([608b0d5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/608b0d5a79000b027aaf9e18e69ddecfe27476d9))

## [17.1.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.6...v17.1.7) (2023-05-16)

### Bug Fixes

- **cnic registrar module:** trimming of contact data before use in api commands ([7bbec00](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7bbec00e772193d3bdb96cf4812f28abedc41200))

## [17.1.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.5...v17.1.6) (2023-05-16)

### Performance Improvements

- **all registrar modules:** improve performance for Domain Registrations page in Admin Area ([fcf062d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fcf062d3bd503562e458ec9c41b89087322abdde))

## [17.1.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.4...v17.1.5) (2023-05-16)

### Bug Fixes

- **ispapi registrar module:** fix for Creating DNS Zone as non-hidden internal ([9a3c32e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9a3c32e20422a4e7bc3822867d85030f62d4a751))

## [17.1.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.3...v17.1.4) (2023-05-10)

### Bug Fixes

- **cnic registrar module:** PHP Error fix in Domain Availability Check ([9fe930b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9fe930be8d7c8c863de0449652d2221cfe00e1a1))

## [17.1.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.2...v17.1.3) (2023-05-09)

### Bug Fixes

- **cnic registrar module:** support for .CAT domains in WHMCS ([2efdc22](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2efdc22609f760d1e0e854df3624c6913d948b83))

## [17.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.1...v17.1.2) (2023-05-05)

### Bug Fixes

- **cnic domain importer addon:** import: show original msg if no translation available ([3a712b1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3a712b1fe5832fdc7c942fd2ac9fe32cf1e19a97))

## [17.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.0...v17.1.1) (2023-05-05)

### Bug Fixes

- **cnic registrar module:** fix PHP Error in Aavailability Check ([b83ed76](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b83ed761d4670f673ecbf2eebe34889af7859c15)), closes [#249](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/249)

# [17.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.17...v17.1.0) (2023-05-03)

### Bug Fixes

- **cnic registrar module:** fix .app additional domain fields ([ebf998c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ebf998c4882bfe83e580c3d7999d69bc1fb732a9))
- **cnic registrar module:** fix not skipping contacts on transfer when using migrator ([b354297](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b3542972e0d1ef1f24ed396b983e5a3053ac13a1))

### Features

- **cnic registrar:** show warning in DNS Management page if nameservers do not point to KeyDNS ([d64d656](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d64d656ebbfdb46f29aacff4dec172da3d983d48))
- **templates:** include child templates for improving DNS management ([9c97cec](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9c97cece9b5d83d53d2931301f942d6126eaafff))

## [17.0.17](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.16...v17.0.17) (2023-05-02)

### Bug Fixes

- **ispapi registrar module:** DomainTransferSync > getContactDetailsWHMCS error fix ([afe63d9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/afe63d96ef650aeba3d1e4a89324ae2250abe3ae))
- **ispapi registrar module:** function hook_transliterate conflict fix ([0b592e3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0b592e388b44a0bd09c516f9c53b6aa4b40c02c6))

## [17.0.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.15...v17.0.16) (2023-04-28)

### Bug Fixes

- **ispapi registrar module:** fix IRTP Lock output ([27d954d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/27d954d792a6e25f0475d497c5d550f0c2dd82d2))

## [17.0.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.14...v17.0.15) (2023-04-28)

### Bug Fixes

- **ispapi registrar module:** review .eu fields (country of citizenship dropped for companies) ([16551fc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/16551fcf0f53c41465eff5b1407e07a9d1d67fbf))

## [17.0.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.13...v17.0.14) (2023-04-27)

### Bug Fixes

- **ispapi registrar module:** patch GetEPPCode implementation for .eu ([82858bc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/82858bcf25e98bdd277bd782eccb7bc50a5b11c5))

## [17.0.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.12...v17.0.13) (2023-04-26)

### Bug Fixes

- **ispapi registrar module:** final patch for Transfer-related Buttons in Admin Area ([5f7484d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5f7484d27cb0e8bb24cd844d3b0d956fd96734ed))

## [17.0.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.11...v17.0.12) (2023-04-26)

### Bug Fixes

- **ispapi registrar module:** buttons related to Pending Transfer not showing ([fe70482](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fe70482b1d1780ab9133cb9745a0aa0e50073ab5))

## [17.0.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.10...v17.0.11) (2023-04-24)

### Bug Fixes

- **ispapi registrar module:** patch Domain Sync for WHMCS7 (laravel query builder) ([0bb3e18](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0bb3e1891e6a44bb8f8812cbe1ab549338935fec))

## [17.0.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.9...v17.0.10) (2023-04-24)

### Bug Fixes

- **ispapi registrar module:** patch system-internal transfer (USERTRANSFER) ([06c89a4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/06c89a45268f30bcf6f05872a3a39bcbf9d44c74))

## [17.0.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.8...v17.0.9) (2023-04-21)

### Bug Fixes

- **cnr + ispapi registrar module:** patch grace & redemption fees ([8ae6fae](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8ae6faedf2ed53971e9f609817e7b49f78f2605e)), closes [#248](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/248)

## [17.0.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.7...v17.0.8) (2023-04-19)

### Bug Fixes

- **cleanup:** assets cleanup ([1fa0564](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1fa05645b2ad4c213750ff55e3461b076351418e))

## [17.0.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.6...v17.0.7) (2023-04-18)

### Bug Fixes

- **cnic registrar module:** keep additional fields related files unencrypted ([f245232](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f2452324b8b8e13147b829e00d732fb095ee3667))

## [17.0.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.5...v17.0.6) (2023-04-17)

### Bug Fixes

- **ispapi registrar module:** .dk sync: status cancelled requires active as true ([96d4abf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/96d4abf3f40f25b810efc7e8ba76d31a9e74e09f))

## [17.0.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.4...v17.0.5) (2023-04-17)

### Bug Fixes

- **ispapi registrar module:** .dk domain sync: switch to cancelled in case of status PENDINGDELETE ([7c3b94d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7c3b94d167fc5b640fde20b063a5fb0aeb5383c2))

## [17.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.3...v17.0.4) (2023-04-17)

### Bug Fixes

- **ispapi+cnic registrar module:** review output of Transfers (GetDomainInformation) ([104784d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/104784dcb5b8bc66299224c01d2f9d27c6bbd309))

## [17.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.2...v17.0.3) (2023-04-14)

### Bug Fixes

- **cnic registrar:** revamped additional fields for \*.au tld ([23b44b2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/23b44b2f55e51054fffd3c68ed3a14fb19b465d2))

## [17.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.1...v17.0.2) (2023-04-14)

### Bug Fixes

- **cnic registrar module:** fix for Resend transfer email and cancel domain transfer buttons ([8c55d86](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8c55d86cc41df18bb1c4ada6ef56acc9cce4be4e))
- **cnic registrar:** add required additional field for .app tld ([b4e96de](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b4e96de984bc09a3dd85a79c0de2274a573f6df2))

## [17.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.0...v17.0.1) (2023-04-05)

### Bug Fixes

- **cnic registrar module:** avoid changing nameservers when activating dns zone ([f8666de](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f8666de5e3685703a9e6457de22f1aa9e140fce4))

# [17.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.23...v17.0.0) (2023-04-05)

### Bug Fixes

- **cnic domain importer:** support CentralNic Reseller Module as Registrar in Dropdown List ([b88a067](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b88a06735c06f448ef6c3c3a7bee041854b4b6d2))
- **cnr registrar module:** patch integration of special admin area buttons ([371d35f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/371d35f34916668fb960c4db8af8b5ff55fbd42f))
- **cnr/ispapi registrar modules:** upgrade to v8.0.5 of connector library (curlopt settings patch) ([57895fc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/57895fc7d564c6a98616afe17c7a22cca2815068))

### Code Refactoring

- **hx reg mod:** replaced querydomainrepositoryinfo with querydomainoptions (categories) ([e18f58f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e18f58fbd1f06669036634e4c0987045ee38d38a))

### Features

- **cnic registrar module:** show connectivity result in registrar module settings overview ([90fff84](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/90fff848be69a7da0f42e6f3e75c28ad1e1c668a))
- **cnic registrar module:** support of domain restores ([bbf201b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bbf201b18ad9ff72a6d45722185c2f229115a8ba))
- **cnic+ispapi registrar module:** add/review transfer precheck on shopping cart level ([fdbc119](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fdbc119e156ceca6e40a846d271b004322b80866))
- **cnic+ispapi registrar module:** added/reviewed injection of private nameservers listing ([c4032a0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c4032a06312e5240af1501a7ef250cea3adf6707))
- **cnic+ispapi registrar module:** added/reviewed injection of private nameservers listing ([61bd983](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/61bd983444b332864f105f9f8e3d5a6a4b9d9a71))
- **cnr registrar module:** add "Cancel Domain Transfer" / "Resend Transfer Approval Email" buttons ([de757ef](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/de757ef8aef6a60130fbd027b8eff685adb1b7f2))
- **cnr registrar module:** added automatic/manual supension/unsuspension feature ([d5063e2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d5063e2f8b160ef008a926ccff798fa2e084ebea))
- **ispapi registrar module:** add explicit system activity logs for NS and DNSZone RRs updates ([74a47f2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/74a47f2305f0dd990eb2c581dcf00e1ca85884cd))
- **ispapi registrar module:** auto post-transfer contact & nameserver update extended to all TLDs ([ecb966d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ecb966d2f50d92a81a57aee6d6d03b1b6a40ec3c))

### BREAKING CHANGES

- **hx reg mod:** The internal data structure of TLD Settings got extended. Please execute the following SQL Query to avoid PHP issues: ``DELETE FROM `tbltransientdata` WHERE name LIKE "ispapiZoneInfo%"``
- **ispapi registrar module:** Post-Transfer Update is no longer only covering .com/.net/.cc/.tv, but all TLDs. In addition, it first updates contact data and then doing the nameserver update. Nameserver Data is now taken out of the order in WHMCS which is faster than looking this up from transfer request. The post processing got in addition moved into a hook and isn't any longer part of the TransferSync (Separation of Concerns).

## [16.15.23](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.22...v16.15.23) (2023-03-31)

### Bug Fixes

- **ispapi registrar module:** dropped email check in contact data update mechanism after transfer ([e77a689](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e77a68973e2322b98980c7fc56fdefc42bbe1435))

## [16.15.22](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.21...v16.15.22) (2023-03-31)

### Bug Fixes

- **cnic migrator addon:** drop whois data lookup; problematic in case of active id protection ([19a7b44](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/19a7b442dd2560a9d200b7bb9563f8c49e9eac58))

## [16.15.21](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.20...v16.15.21) (2023-03-29)

### Bug Fixes

- **ispapi:** fix for requesting authcode for .de domains via whmcs ([66657b4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/66657b4984863c9fb354c2f5df5eaf08e88aff01))

## [16.15.20](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.19...v16.15.20) (2023-03-27)

### Bug Fixes

- **cnic:** fallback to expiration date if paid date is not returned from API ([6f2c6c2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6f2c6c21551d395f27450eb26882ae01566bd9a4))

## [16.15.19](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.18...v16.15.19) (2023-03-24)

### Bug Fixes

- **cnic:** set cancelled domains to default renewal mode in pre cron check ([cd108a3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cd108a3bc0c528c8562f8d92c0346fff7b1980c8))

## [16.15.18](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.17...v16.15.18) (2023-03-24)

### Bug Fixes

- **cnic:** use correct expiration date in daily cron ([93a6ca8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/93a6ca8e2508a4528e43de67cd7b98e2fd8a7b31))

## [16.15.17](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.16...v16.15.17) (2023-03-17)

### Bug Fixes

- **cnic migrator addon:** fix fieldnames consumed from GetClientsDetails ([cc4e5aa](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cc4e5aa561286c7738cb405958874e78edcce358))

## [16.15.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.15...v16.15.16) (2023-03-17)

### Bug Fixes

- **cnic migrator addon:** auto-retry transfer without contact data to improve success rate ([4d64549](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4d64549e774dd3120bf71e905b5249a5bd4bb9e1))

## [16.15.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.14...v16.15.15) (2023-03-16)

### Bug Fixes

- **cnic migrator addon:** patched whois data lookup for registrant & admin ([ae5287a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ae5287ab5b532d1ea2d80c053e847dd3446db0e0))

## [16.15.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.13...v16.15.14) (2023-03-14)

### Bug Fixes

- **cnic migration addon:** added fallback to whmcs data in case Whois Data lookup fails ([59d26af](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/59d26af016ce8c7e6df9774a02a730bec27ca4c7))

## [16.15.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.12...v16.15.13) (2023-03-06)

### Bug Fixes

- **ispapi registrar module:** migrate .AT whois disclose to hardcoded solution (non-ui solution) ([45c2fc4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/45c2fc4001cda49ed37aa7b94250c2ab8a928f14))

## [16.15.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.11...v16.15.12) (2023-03-06)

### Bug Fixes

- **ispapi registrar module:** reviewed expirydate sync of domains in redemption ([ddbbb12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ddbbb12d694334bde2486716beab5ce581a922f1))

## [16.15.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.10...v16.15.11) (2023-03-03)

### Bug Fixes

- **ispapi registrar module:** in case of a restorable domain do only return "expired" in sync ([3a6490b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3a6490bbfddeb53e39c6648eae1bb545f1c2799e)), closes [#XAT-159107](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/XAT-159107)

## [16.15.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.9...v16.15.10) (2023-03-03)

### Bug Fixes

- **migrator addon:** doing whois data lookup via localAPI; cnic: AddContact made optional ([86982cd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/86982cd55b50321968727b92b223f1d9d6a96777))

## [16.15.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.8...v16.15.9) (2023-03-03)

### Bug Fixes

- **cnr registrar module:** exclude transfer precheck in TransferDomain integration ([c47185c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c47185cc944761dbe9e0c2866f47adcd317b2b1b))
- **cnr registrar module:** fix ClientAreaHeadOutput to only invoke function if present ([ba7cf9e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ba7cf9e476f65c9d7148cb877cfce1c5f1e9f826))

## [16.15.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.7...v16.15.8) (2023-03-03)

### Bug Fixes

- **cnic migrator addon:** .uk: do a push via losing registrar after initiating the transfer ([319a3c3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/319a3c33e43d331fb36405e82787f9e187ca14c3))
- **cnr registrar module:** review .uk transfer (action=request); requires Push at losing Registrar ([98329f7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/98329f771f872a487620ab41c0210866772e433c))
- **ispapi registrar module:** .uk transfers using action=request (waiting for Domain Release / Push) ([92ce879](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/92ce879f3dd3b9c2f6870ce029473fd5c969a5fd))

## [16.15.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.6...v16.15.7) (2023-02-22)

### Bug Fixes

- **ispapi registrar module:** added missing additional domain fields for .boo ([c6d6095](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c6d6095f112d0327d97f1f6fe149d350c2011d57))

## [16.15.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.5...v16.15.6) (2023-02-15)

### Bug Fixes

- **ispapi registrar module:** extend messaging of .dk additional fields regarding email confirmation ([40a9d0c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/40a9d0cd4be9765ae1c0fa6179d02fc6e1698b5a))

## [16.15.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.4...v16.15.5) (2023-02-14)

### Bug Fixes

- **cnic registrar module:** fix transferlock handling ([d6ffa99](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d6ffa996bf55092904f4da9ace4f32dd6d6c2b99))

## [16.15.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.3...v16.15.4) (2023-02-14)

### Bug Fixes

- **dashboard widget:** show right versioning information after upgrade ([179ce37](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/179ce37e8fe607b26f1beaf854dd478ae928a4b0))

## [16.15.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.2...v16.15.3) (2023-02-10)

### Bug Fixes

- **migration:** fix pagination issue in upcoming migrations table ([2416fe7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2416fe7dafa50e0203ecc84d7da3a26f107ec1f0))

## [16.15.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.1...v16.15.2) (2023-02-09)

### Bug Fixes

- **cnic registrar module:** fix .se additional fields for transfer ([564e503](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/564e50305c34421bba4668fd9b80de00d4ebb4ba))

## [16.15.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.0...v16.15.1) (2023-02-09)

### Bug Fixes

- **cnic dns addon:** pHP error when loading hooks, added missing composer autoloader ([23c0050](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/23c0050285d5bcaf6502b84ee6f387c07165d436))

# [16.15.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.3...v16.15.0) (2023-02-06)

### Features

- **cnr registrar module:** support premium domain names ([d821ed9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d821ed9d0b9b2b3227d70a4996e685d7456fe3ef))

## [16.14.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.2...v16.14.3) (2023-02-06)

### Bug Fixes

- **download links:** to latest software bundle archive patched ([15a414b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/15a414b5e32000f9482eac0f42e86e9b09ddb871))

## [16.14.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.1...v16.14.2) (2023-02-03)

### Bug Fixes

- **registrars:** cleanup accidental inclusion of tpp wholesale. registrar module to be reviewed 1st ([cac5e91](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cac5e91cfb9a2767dd722a97ac88a07c9681a155))

## [16.14.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.0...v16.14.1) (2023-02-03)

### Bug Fixes

- **ispapi registrar module:** added .coop additional fields for contact update ([45a819b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/45a819b6c8320ec59128d1e0e62c16f79af88aa6))

# [16.14.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.13.1...v16.14.0) (2023-01-30)

### Features

- **reg hx mod:** additionalfield ID Protection support for .AT TLD ([71f2f07](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/71f2f0785722703e5c1283410d5455bbdf99f2eb))

## [16.13.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.13.0...v16.13.1) (2023-01-27)

### Bug Fixes

- **cnic pricing import:** clean code refactoring & patching & performance review ([8215d0f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8215d0fc9853562808479958dab1a129db76cd6b))

# [16.13.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.12.2...v16.13.0) (2023-01-26)

### Features

- **hx mod reg:** auto-unsuspension for renewed domains ([497d03b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/497d03b2701a171327be9738992496010d25c87c))

## [16.12.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.12.1...v16.12.2) (2023-01-26)

### Performance Improvements

- **hx reg mod:** Dynamic TLD configuration, tldmap.json file deprecated ([ddd5044](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ddd50444aeb45e1e16446887db4942b5c7008b66))

## [16.12.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.12.0...v16.12.1) (2023-01-25)

### Bug Fixes

- **cnr:** fix smarty error in renewal protection notification email ([0cb0bb3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0cb0bb35ac7b1946de9136fbbd110080edeb3283))

# [16.12.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.11.0...v16.12.0) (2023-01-23)

### Bug Fixes

- **hx registrar:** additional fields for .giving ([0a6add5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0a6add5403edb593ace70caabfb413dce12761e2))
- **registration:** fix registration failing for some tlds not supporting transfer lock ([503b2f0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/503b2f0ff1e8e2eedf2507637d9750fb70e99016))

### Features

- **cnic:** hide transfer lock from Client Area if TLD does not support it ([988fd06](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/988fd06526450e37598e3a072dad59cb63151f07))

# [16.11.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.10.2...v16.11.0) (2023-01-20)

### Features

- **domain checker:** add possibility for subscribing to availability checks ([8a2f63b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8a2f63b2be898c6c20213d440d8c721e0e2eeb49))

## [16.10.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.10.1...v16.10.2) (2023-01-19)

### Bug Fixes

- **cnic:** add support for old WHMCS v7 ([0946a86](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0946a867fdb92c3ba6b698cd4eaf97b2685e0eaa))

## [16.10.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.10.0...v16.10.1) (2023-01-19)

### Bug Fixes

- **hx domainchecker:** add missing markup to renewal price for premium domains ([ba93e12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ba93e12525cd7e4091c76ce86a94caf6ae5c9daf))
- **hx domainchecker:** update number of items in shopping cart ([db30f82](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/db30f8240d297d74e18b7bc2278a13d1ce81b96c))

# [16.10.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.9.1...v16.10.0) (2023-01-10)

### Features

- **hooks:** support customs hooks by file /your/path/to/whmcs/resources/hooks_ispapi_custom.php ([25f99d8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/25f99d8f3527954d76626807b72361e23c575dfa))

## [16.9.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.9.0...v16.9.1) (2023-01-06)

### Bug Fixes

- **ispapi registrar module:** identify and use right locale for additional domain fields translation ([c78f9ce](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c78f9cef8fc29e2a71cfb6d1523bb20369cf4234))

# [16.9.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.5...v16.9.0) (2023-01-04)

### Bug Fixes

- **tweak:** front-end and error messages improvements ([c65a7c6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c65a7c6b71708d2cb6b1eeceb84f5edd00ce51bb))

### Features

- **epp-csv:** bulk Import EPP Codes via CSV file ([2b9d5eb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2b9d5ebf4a3e3b99d1174b0988ad0464e43b646f))

## [16.8.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.4...v16.8.5) (2023-01-03)

### Bug Fixes

- **assets:** review mechanism for browser cache update ([2e38f67](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2e38f675b3c9b1c8c768bd3774604e9a9bd1c50e))

## [16.8.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.3...v16.8.4) (2022-12-08)

### Bug Fixes

- **release process test:** automated publishing to WHMCS Marketplace ([2364cb4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2364cb4990ab6d665c0160c81b9769a86f125520))

## [16.8.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.2...v16.8.3) (2022-12-08)

### Bug Fixes

- **release process test:** automated publishing on WHMCS Marketplace ([0ff21bc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0ff21bc7715eb4eb805e0ef19099b2495cf26fb4))

## [16.8.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.1...v16.8.2) (2022-12-08)

### Bug Fixes

- **ispapi registrar module:** patch bug with connected web apps ([da464a8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/da464a8a198388ac85c8ebdf498153f995eec230))

## [16.8.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.0...v16.8.1) (2022-12-06)

### Bug Fixes

- **statistics data:** only submit cnic/ispapi addons in use (for customer support improvements) ([59901a4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/59901a4609aa73e77b65707da6e7230037c32ab4))

# [16.8.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.7.0...v16.8.0) (2022-12-01)

### Bug Fixes

- **domain search:** fadeIn/-Out transfer button in search field based on input value ([afe9348](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/afe9348d3b3f209a1b33491bb11a470d3db599fc))
- **domain search:** patch CSS of toggles (for mobile devices) ([7fb30f9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7fb30f9669b0bbd596ce3b8ae45d7d5a8f445543))
- **ispapi registrar module:** patch output of connectivity result in module settings (WHMCS 8.6) ([3411751](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3411751b4e633c88d1ea4e8bb14a73cc11d5dc6a))
- **ispapi registrar module:** web apps cfg (file-based solution not working in corner cases) ([d559c6d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d559c6db9af2ac406c77b8ad52e86c46737e4b56))

### Features

- **domain search:** configurable transfer button in search field ([0aad3a6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0aad3a6586ceb6fa8c6ac2f202d8a3f4fdd446fb))

# [16.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.5...v16.7.0) (2022-11-30)

### Bug Fixes

- **aftermarket domains:** consider registrar module setting in ISPAPI Domain Checker ([7b067d9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7b067d90d9b65774d5c03ffc53a9af92391d231b))
- **aftermarket domains:** review aftermarket premium domains to display with label "AFTERMARKET" ([7b32b04](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7b32b047ca7ae2403e7a0bce7ec8f6fec28cd9f3))

### Features

- **aftermarket domains:** configuration option added to registrar module (by default: off) ([af487fe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/af487fe8c6a8122e0fd166ce70203fd6889af4c1))

## [16.6.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.4...v16.6.5) (2022-11-30)

### Bug Fixes

- **domain search:** fixed issue with aftermarket pricing detection (non-premium class) ([bb54200](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bb5420019e80c694e3d64a74b8629f29a108ab76))
- **domain search:** fixed issue with currency detection and upgrade function ([95baa1c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/95baa1ceb8f128507843166102a114cb8fec71fc))
- **domain search:** update item count of shopping cart button ([8f836ea](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8f836ea48b2e9c7873c9f344d49f00fe709847d9))
- **helper library:** patched db communication wrapper ([7867ebe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7867ebe573f072b6cf6c2d071cfed08b0ed74e5f))

## [16.6.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.3...v16.6.4) (2022-11-29)

### Bug Fixes

- **php8 support:** replacing mktime() with time() ([481c178](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/481c17855879fc066444bcf49224d4e7cae639da))

## [16.6.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.2...v16.6.3) (2022-11-29)

### Bug Fixes

- **php8 support:** patched compatibility of DB Interactivity + Transactions ([3bd576c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3bd576cc04c8a4b4061482f4054ee96c7a6db3a0))

## [16.6.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.1...v16.6.2) (2022-11-23)

### Bug Fixes

- **domain-import:** premium domains import pricing fix ([97c5449](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/97c54495c2ca328103cc68359515b1ffe17ce008))
- **premium price detection:** for corner cases (probably just affecting the OT&E) patched ([19808af](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/19808af5f57ee42b527094c116dbd8809b2e0c76))

## [16.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.0...v16.6.1) (2022-11-21)

### Bug Fixes

- **widget:** quota usage Infinity (INF) percentage fix ([c4d14cb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c4d14cbf958a94b6d4d36e9a665858f911ccd214))
- **widget:** quota usage Infinity (INF) percentage fix ([4e5a158](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4e5a158f978d24b843da91f2d41beb10d13eaf4e))

# [16.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.5.0...v16.6.0) (2022-11-18)

### Features

- **statistics:** extended statistics data functionality ([cac452d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cac452d993b4feaec8822ee5aa60f24daa19ff37))

# [16.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.4.1...v16.5.0) (2022-11-15)

### Features

- **domain checker:** support language overrides ([720d026](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/720d026c8c96accfbc719fe81974fe560db934fa))

## [16.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.4.0...v16.4.1) (2022-11-14)

### Bug Fixes

- **cnicmigration:** fix email template paths ([cf9d4dc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cf9d4dcf70596c5c925f12c4fcea90e7b92ff9dd))

# [16.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.7...v16.4.0) (2022-11-14)

### Features

- **dashboard widget:** total request/query limit quota shown on Hexonet (Ispapi) widget ([bb1be6f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bb1be6f0ec9285b92f4c340c999579dec172bbc4))

## [16.3.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.6...v16.3.7) (2022-11-14)

### Bug Fixes

- **license:** changes to our LICENSE and COPYRIGHTS ([6a14a19](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6a14a1907ba6aa0b6784962312b3436d6870a943))

## [16.3.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.5...v16.3.6) (2022-11-13)

### Bug Fixes

- **migration:** failure message is now displayed correctly ([a780a1a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a780a1a49de3e31baca0f3c1069fd3a4f5a66307))

## [16.3.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.4...v16.3.5) (2022-11-11)

### Bug Fixes

- **widget:** widget styling fixes for Windows OS users ([55b35e4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/55b35e4a8d3ab2ebeccc515f08ccd84398ac572c))

## [16.3.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.3...v16.3.4) (2022-11-10)

### Bug Fixes

- **ioncube:** php version encoding bundling - fixes corrupt files ([38c80e4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/38c80e49961352bb5a2ac88fd518862bac3b7e74))
- **widgets:** widget error fixed, index.tpl not found ([1e00b77](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1e00b770da34e3e079ff611e792619bbf4d7dad9))

## [16.3.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.2...v16.3.3) (2022-11-10)

### Bug Fixes

- **translations:** patching additional fields translation (different lang used that we don't ship) ([34ceaa2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/34ceaa2b7eb61aa062631c35d4ff76ad731fa258))

## [16.3.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.1...v16.3.2) (2022-11-09)

### Bug Fixes

- **ioncube:** fixed corrupt files issue by separating archives for php versions ([bd1c861](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bd1c86181ca43b2c376052ebdfc72e75847e6397))

## [16.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.0...v16.3.1) (2022-11-09)

### Bug Fixes

- **ioncube:** encoding order fix higher to lower ([a75d8ac](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a75d8ac422dcc98cb914440b6ef2a386cb8342fb))

# [16.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.3...v16.3.0) (2022-11-08)

### Bug Fixes

- **ioncube:** support for php 8.1 and 7.4 ([792fba2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/792fba25170ab5fca3b203f467e9682acbf38c92))

### Features

- **hexonet registrar module:** post-transfer activation of DNS Management added ([df0b81b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/df0b81bf363a3194e323f39a949b3eda021462d8))

## [16.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.2...v16.2.3) (2022-11-07)

### Bug Fixes

- **tld-eu:** remove unnecessary parameter that prevented .eu transfers ([0ef425d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0ef425d2bb5fcfe7eeac8e83796af5a1f19863f3))

## [16.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.1...v16.2.2) (2022-11-07)

### Bug Fixes

- **autoloading:** autoloading fixes when modules are deactivated ([3cb4273](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3cb4273cdb9d1862bc0a0f418111a87fbce71cd5))

## [16.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.0...v16.2.1) (2022-11-07)

### Bug Fixes

- **migrator:** Fix for migrator when fetching domain status ([f6f8f15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f6f8f15a020505778749901ebd48e18f9c9e08b2))

# [16.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.3...v16.2.0) (2022-11-07)

### Bug Fixes

- **cnicmigration:** fix link to documentation ([5cca1e7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5cca1e7e49623c3f969b83257f07752f9ce9e506))
- **ispapi registrar module:** extend TLD Mapping (.edu.mx <-> EDUMX) ([4ba43b5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4ba43b58b3e0d85be11be57c9e6c70c65846f5b7))

### Features

- **cnicmigration:** show warning if email templates have not been configured ([9e3712c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9e3712c9127a1cabf69ce138090dbe142bd05965))
- **cnicssl:** add ability to download certificates ([8d438d4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8d438d415e57b22abb14e1e76f5f475da0795662))

## [16.1.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.2...v16.1.3) (2022-10-20)

### Bug Fixes

- **cnr registrar module:** patch autoloading of function in hooks.php ([44fc4d5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/44fc4d5ead6e8c202d862c5da722e7595d899ad6))

## [16.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.1...v16.1.2) (2022-10-20)

### Bug Fixes

- **hx registrar module:** patch autoloading of function in hooks.php ([247411d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/247411d60b2840c5975a6bd1a0e056f46a29381b))

## [16.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.0...v16.1.1) (2022-10-20)

### Bug Fixes

- **ispapi registrar module:** nameserver update patched ([da45fc5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/da45fc5f721429f6f5a34018491c8a6086c66d84))

# [16.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.3...v16.1.0) (2022-10-20)

### Bug Fixes

- **cnic-ssl:** fix several issues and add PHP 8.1 compatibility ([65b76e9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/65b76e9126a5f71f3528a0436151c2f24d89d370))

### Features

- **precheck addons:** automatically precheck addons on cart level page, feature added ([fdbba09](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fdbba091533b78eeb081d32e9bcf6eec418429b6))

## [16.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.2...v16.0.3) (2022-10-19)

### Bug Fixes

- **gulp:** updated encryption files list ([150e603](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/150e603df47a2257b550be21144ebc665fb64451))

## [16.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.1...v16.0.2) (2022-10-19)

### Bug Fixes

- **domainchecker:** default categories import fix, build-release workflow fix, gulp config updated ([ff4b211](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ff4b211d11e8fb34b897b984cad96b2043d39ca8))
- **ispapi domain search:** fix multi-year terms dropdown order (10Y now after 9Y) ([1918b72](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1918b72d4f9936f53ab22b250e9b85bbb2318fda))

## [16.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.0...v16.0.1) (2022-10-19)

### Bug Fixes

- **tld-import:** skip tlds with no pricing ([2a58dbe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2a58dbe304fa69b8f6651b57d1a1ad5a6d3d0041))

# [16.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v15.9.9...v16.0.0) (2022-10-18)

### chore

- **restructuring:** in direction of a software bundle ([ac88ed6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ac88ed674da7c947d5874cd263337c52d70cb1a8))

### BREAKING CHANGES

- **restructuring:** Restructuring of all repositories into a single repository. Offering several benefits to us and our resellers.

# [16.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v15.9.9...v16.0.0) (2022-10-18)

### chore

- **restructuring:** in direction of a software bundle ([ac88ed6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ac88ed674da7c947d5874cd263337c52d70cb1a8))

### BREAKING CHANGES

- **restructuring:** Restructuring of all repositories into a single repository. Offering several benefits to us and our resellers.
