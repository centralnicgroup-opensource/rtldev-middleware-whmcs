# [1.12.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.11.4...v1.12.0) (2019-10-09)


### Features

* **IRTP:** support for IRTP ([552c9a7](https://github.com/hexonet/whmcs-ispapi-registrar/commit/552c9a7e34d5bf3df50eeb366ebfc21eb7bcaea9))
* **IRTP:** support handling opt-out for AFNIC TLDs ([6c1ef85](https://github.com/hexonet/whmcs-ispapi-registrar/commit/6c1ef85caa75a1996f0efab8a23f7293b459bd90))
* **TransferDomain:** domain transfer pre-check ([28104bc](https://github.com/hexonet/whmcs-ispapi-registrar/commit/28104bc8cf9a7b2beeab06c13437a74058471dc7))


### Performance Improvements

* **Transfer-period:** auto-detect default transfer period ([c739637](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c7396376e04d5ce09f0efd63082574a57976a3b6))

## [1.11.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.11.3...v1.11.4) (2019-09-18)


### Bug Fixes

* **release process:** review from scratch ([41dd3b5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/41dd3b5))

## [1.11.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.11.2...v1.11.3) (2019-09-13)


### Bug Fixes

* **dep-bump:** Migrate CI to semantic-release-whmcs ([bfc3f13](https://github.com/hexonet/whmcs-ispapi-registrar/commit/bfc3f13))

## [1.11.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.11.1...v1.11.2) (2019-09-06)


### Bug Fixes

* **RegistrarLock:** update hook for Registrar Lock ([ffb8522](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ffb8522))

## [1.11.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.11.0...v1.11.1) (2019-09-04)


### Performance Improvements

* **SE fields:** updated .SE additional fields ([310e572](https://github.com/hexonet/whmcs-ispapi-registrar/commit/310e572))

# [1.11.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.10.0...v1.11.0) (2019-09-04)


### Features

* **premium domain:** added support for renewals ([149d010](https://github.com/hexonet/whmcs-ispapi-registrar/commit/149d010))

# [1.10.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.9.0...v1.10.0) (2019-08-22)


### Features

* **VAT-ID:** autofill VAT-ID additional field during domain registrations ([cbd92ac](https://github.com/hexonet/whmcs-ispapi-registrar/commit/cbd92ac))

# [1.9.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.8.5...v1.9.0) (2019-08-20)


### Features

* **feature:** remove 'Registrar lock' option for unsupported TLDs ([db963fb](https://github.com/hexonet/whmcs-ispapi-registrar/commit/db963fb))

## [1.8.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.8.4...v1.8.5) (2019-08-16)


### Bug Fixes

* **logo:** updated to our new logo design ([27aa4d2](https://github.com/hexonet/whmcs-ispapi-registrar/commit/27aa4d2))

## [1.8.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.8.3...v1.8.4) (2019-08-06)


### Bug Fixes

* **.ca:** review additional fields ([b18a9cb](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b18a9cb))

## [1.8.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.8.2...v1.8.3) (2019-07-12)


### Bug Fixes

* **encoding:** removed use of htmlspecialchars for EPP code and NS1-5 ([882d9f9](https://github.com/hexonet/whmcs-ispapi-registrar/commit/882d9f9))

## [1.8.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.8.1...v1.8.2) (2019-06-17)


### Bug Fixes

* **Data Sync:** Review (properties: expirydate, expired) ([bcbc005](https://github.com/hexonet/whmcs-ispapi-registrar/commit/bcbc005)), closes [#82](https://github.com/hexonet/whmcs-ispapi-registrar/issues/82)

## [1.8.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.8.0...v1.8.1) (2019-06-04)


### Bug Fixes

* **call_raw:** remove die() used to debug ([289db74](https://github.com/hexonet/whmcs-ispapi-registrar/commit/289db74))

# [1.8.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.7.5...v1.8.0) (2019-06-04)


### Features

* **call_raw:** skip built-in idn conversion by SKIPIDNCONVERT parameter ([aa6acc5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/aa6acc5))

## [1.7.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.7.4...v1.7.5) (2019-06-04)


### Bug Fixes

* **config:** reviewed usage guide + minor code change ([157f772](https://github.com/hexonet/whmcs-ispapi-registrar/commit/157f772))

## [1.7.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.7.3...v1.7.4) (2019-06-04)


### Bug Fixes

* **config:** connect to api.ispapi.net in both cases (http, https) ([fef06f6](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fef06f6))

## [1.7.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.7.2...v1.7.3) (2019-05-07)


### Bug Fixes

* **dep-bump:** shared-libs v2.1.3 ([1524e3f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1524e3f))

## [1.7.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.7.1...v1.7.2) (2019-05-07)


### Bug Fixes

* **dep-bump:** shared-libs to v2.1.2 ([3889a2c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/3889a2c))

## [1.7.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.7.0...v1.7.1) (2019-05-02)


### Bug Fixes

* **shared-lib:** dep bump to v2.1.0 for domainchecker module ([fc3c42b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fc3c42b))

# [1.7.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.6.2...v1.7.0) (2019-05-02)


### Features

* **pkg:** add shared libraries for restructuring ([226711c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/226711c))

## [1.6.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.6.1...v1.6.2) (2019-04-11)


### Bug Fixes

* **widget:** fix domain importer module url ([d6b6476](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d6b6476))

## [1.6.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.6.0...v1.6.1) (2019-01-28)


### Bug Fixes

* **pkg:** update(https://github.com/hexonet/whmcs-ispapi-registrar/commit/bd332ff))
  * UpdateDNSZone command updated with RESOLVETTLCONFLICTS=1
  * TransferLock adaptation for unsupported TLDs
  * Removed unsupported INTERNALDNS parameter in AddDommainApplication

# [1.6.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.5.0...v1.6.0) (2018-11-16)


### Bug Fixes

* **additionaldomainfields:** updated .ie additional domain fields ([0095827](https://github.com/hexonet/whmcs-ispapi-registrar/commit/0095827))
* **symlinks:** improvement of integration of the module via symlinks ([579c52b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/579c52b))
* **transfers:** fix for .es transfer issues ([66cb048](https://github.com/hexonet/whmcs-ispapi-registrar/commit/66cb048))


### Features

* **AdminWidget:** Add missing modules; code review ([234fc6f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/234fc6f))
* **AdminWidget:** Add missing modules; code review ([a655be9](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a655be9))

# [1.5.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.4.0...v1.5.0) (2018-10-24)

# [1.4.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.3.0...v1.4.0) (2018-10-19)


### Features

* **releaseInfo:** add json file covering repository info ([488a3b4](https://github.com/hexonet/whmcs-ispapi-registrar/commit/488a3b4))

# [1.3.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.10...v1.3.0) (2018-10-17)

## [1.2.10](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.9...v1.2.10) (2018-10-17)


### Bug Fixes

* **dependabot:** minor release on build commit msg ([1447ddf](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1447ddf))

## [1.2.9](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.8...v1.2.9) (2018-10-15)


### Bug Fixes

* **release:** check branch protection ([d895047](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d895047))

## [1.2.8](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.7...v1.2.8) (2018-10-15)


### Bug Fixes

* **pkg:** Bug fix for Domain WHOIS Lookup ([8c77f81](https://github.com/hexonet/whmcs-ispapi-registrar/commit/8c77f81))

## [1.2.7](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.6...v1.2.7) (2018-10-11)


### Bug Fixes

* **domainstatus:** WHMCS v7.6.1 fix for updating domain status when transferredAway/expired ([4c16fa1](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4c16fa1))

## [1.2.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.5...v1.2.6) (2018-10-10)


### Bug Fixes

* **pkg:** provide latest zip archive ([ac40231](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ac40231))

## [1.2.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.4...v1.2.5) (2018-10-10)


### Bug Fixes

* **assets:** replace 'v' in current module version ([b68bf5a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b68bf5a))

## [1.2.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.3...v1.2.4) (2018-10-10)


### Bug Fixes

* **assets:** include module version in zip folder ([8d764d8](https://github.com/hexonet/whmcs-ispapi-registrar/commit/8d764d8))
* **assets:** include module version in zip folder ([fd434f8](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fd434f8))

## [1.2.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.2...v1.2.3) (2018-10-10)


### Bug Fixes

* **widget:** review latest version detection ([0c36b0f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/0c36b0f))

## [1.2.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.1...v1.2.2) (2018-10-09)


### Bug Fixes

* **archives:** review assets naming ([b7c7374](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b7c7374))

## [1.2.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.2.0...v1.2.1) (2018-10-09)


### Bug Fixes

* **archives:** path of .tar.gz asset ([40bcf26](https://github.com/hexonet/whmcs-ispapi-registrar/commit/40bcf26))

# [1.2.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.1.1...v1.2.0) (2018-10-09)


### Bug Fixes

* **archives:** remove typo in package.json ([b6fa06e](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b6fa06e))


### Features

* **archives:** add make file to generate assets ([da80fcf](https://github.com/hexonet/whmcs-ispapi-registrar/commit/da80fcf))

## [1.1.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.1.0...v1.1.1) (2018-10-09)


### Bug Fixes

* **pkg:** test release process ([5c7b081](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5c7b081))

# [1.1.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.0.62...v1.1.0) (2018-10-09)


### Bug Fixes

* **changelog:** review all tags in repository ([885460f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/885460f))
* **pkg:** introduce PSR2 standard; unit tests; CI/CD ([c82adb5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c82adb5))
* **readme:** add old entries to old changelog ([755da3e](https://github.com/hexonet/whmcs-ispapi-registrar/commit/755da3e))


### Features

* **version:** trigger new feature release test ([311c4ed](https://github.com/hexonet/whmcs-ispapi-registrar/commit/311c4ed))

## [1.0.63](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.0.62...v1.0.63) (2018-10-09)


### Bug Fixes

* **changelog:** review all tags in repository ([885460f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/885460f))
* **pkg:** introduce PSR2 standard; unit tests; CI/CD ([c82adb5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c82adb5))
* **readme:** add old entries to old changelog ([802efd8](https://github.com/hexonet/whmcs-ispapi-registrar/commit/802efd8))

## [1.0.47](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.0.46...v1.0.47) (2018-10-08)


### Bug Fixes

* **pkg:** introduce PSR2 standard; unit tests; CI/CD ([c82adb5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c82adb5))
