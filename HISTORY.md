## [2.4.13](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.12...v2.4.13) (2020-03-16)


### Bug Fixes

* **namespace:** changed namespace to fix widget refresh ([71f26f8](https://github.com/hexonet/whmcs-ispapi-registrar/commit/71f26f844c8c369ca8dd4abb9315ae59625838f8))

## [2.4.12](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.11...v2.4.12) (2020-03-11)


### Bug Fixes

* **sync:** fixed sync of domain status for outbound transfers ([95a2428](https://github.com/hexonet/whmcs-ispapi-registrar/commit/95a24289494a3b87657d7b0a7aac290009f9d6f4))

## [2.4.11](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.10...v2.4.11) (2020-03-04)


### Bug Fixes

* **Change of Registrant:** added additional fields support ([af26be1](https://github.com/hexonet/whmcs-ispapi-registrar/commit/af26be189b910b5b25d2e1a140dbe74a09943b7f))

## [2.4.10](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.9...v2.4.10) (2020-03-04)


### Bug Fixes

* **Change of Registrant:** fix for missing additional fields in the Change of Registrant page ([3aca746](https://github.com/hexonet/whmcs-ispapi-registrar/commit/3aca746940fcf810be24562c74111b34a7370098))

## [2.4.9](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.8...v2.4.9) (2020-02-28)


### Bug Fixes

* **sync:** fixed expirationdate calculation ([87d1654](https://github.com/hexonet/whmcs-ispapi-registrar/commit/87d16542ed7d8de8e7ccb5398fa7d4e01ac4d399))

## [2.4.8](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.7...v2.4.8) (2020-02-28)


### Bug Fixes

* **domain import:** fixed price import for normal domain names ([907187f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/907187f5d993bea97043f0eddd2cf3ae20e6d4da))

## [2.4.7](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.6...v2.4.7) (2020-02-26)


### Bug Fixes

* **savecontactdetails:** reintroduce fallback to $params["original"] as of broken idn domain name ([e356cdf](https://github.com/hexonet/whmcs-ispapi-registrar/commit/e356cdfb0dd2f270c36e1299619e309874ad286d))

## [2.4.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.5...v2.4.6) (2020-02-13)


### Bug Fixes

* **sync:** cleanup temporary workaround for expiry date detection after transfer ([b13bcca](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b13bcca8f107ec61e3cec5f87a5e1c65377c811c))

## [2.4.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.4...v2.4.5) (2020-01-22)


### Bug Fixes

* **_Sync:** review auto-update mechanism ([be47dc6](https://github.com/hexonet/whmcs-ispapi-registrar/commit/be47dc66372881ed358840c4a704ee11369ff7d4))

## [2.4.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.3...v2.4.4) (2020-01-16)


### Bug Fixes

* **authentication:** review output ([ceaef9f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ceaef9fd8eea48952f7911f36d6fd6489f470fe3)), closes [#129](https://github.com/hexonet/whmcs-ispapi-registrar/issues/129) [#128](https://github.com/hexonet/whmcs-ispapi-registrar/issues/128)

## [2.4.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.2...v2.4.3) (2020-01-13)


### Bug Fixes

* **sync:** fixed data key name used to access registrant data ([4d22817](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4d22817537bc53bcea2a55015acb2874e63f3b55))

## [2.4.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.1...v2.4.2) (2020-01-03)


### Bug Fixes

* **sync:** do not return expirydate if not available on API side ([3a32573](https://github.com/hexonet/whmcs-ispapi-registrar/commit/3a32573ed2d80117f7f82dc81f529a2640fc9ca2))

## [2.4.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.0...v2.4.1) (2020-01-02)


### Bug Fixes

* **additional fields:** fixed pre-fill to check for getCustomFields fn ([f7eb9e4](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f7eb9e40950e14fee41887fa2ac133889652b503))

# [2.4.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.3.0...v2.4.0) (2020-01-02)


### Features

* **.dk additional fields:** auto-prefill DK-Hostmaster User ID input fields ([10a642c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/10a642cebc5a76913431b6a3630ffc8f17051fba))

# [2.3.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.2.3...v2.3.0) (2019-12-19)


### Features

* **sync:** transferSync fallback to Sync for expirydate detection and share contact data auto-upd ([c31db05](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c31db05dd71c7c4947de44a7e9ecf3400d0a28db))

## [2.2.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.2.2...v2.2.3) (2019-12-19)


### Bug Fixes

* **transfersync:** review to improve in direction of huge transfer lists ([73537aa](https://github.com/hexonet/whmcs-ispapi-registrar/commit/73537aaa151706f71c464234f0f5588d17d37dcf))

## [2.2.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.2.1...v2.2.2) (2019-12-16)


### Bug Fixes

* **savecontactdetails:** fixed data usage in case of contact dropdown list usage ([5a5f961](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5a5f9618b23bab9da23a01418e74c6792f45cfe3))

## [2.2.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.2.0...v2.2.1) (2019-12-13)


### Bug Fixes

* **transferdomain:** to consider renamed field eppcode (formerly known as transfersecret) ([5235f7a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5235f7a4cd740ef397dffced7557c30edc7c6f07))

# [2.2.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.1.1...v2.2.0) (2019-12-11)


### Features

* **transfer:** transferSync: update com/net/cc/tv domain with contact data after transfer ([b899802](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b899802554fb60825e31549d4c81bd7864950d0a))

## [2.1.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.1.0...v2.1.1) (2019-12-11)


### Bug Fixes

* **dep-bump:** fix currency conversion for premium imports ([ce4a3f6](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ce4a3f67fcbe91dc85ef49d4c0cbc6b8557f8aea))

# [2.1.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.0.0...v2.1.0) (2019-12-10)


### Features

* **dep-bump:** upgrade whmcs-ispapi-helper to v2.3.4 ([2144fff](https://github.com/hexonet/whmcs-ispapi-registrar/commit/2144fff43b863131a65769a4e69397d328337653))

# [2.0.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.12.4...v2.0.0) (2019-12-04)


### Bug Fixes

* **CheckAvailability:** review premium price/transfer detection ([546ecf4](https://github.com/hexonet/whmcs-ispapi-registrar/commit/546ecf4c8cf71ec6aae9ad8fab90a034ffd17045))


### BREAKING CHANGES

* **CheckAvailability:** reviewed premium price detection

## [1.12.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.12.3...v1.12.4) (2019-12-03)


### Bug Fixes

* **savenameservers:** review case "Missing required attribute; TOO FEW ADMIN CONTACTS (min=1)" ([6a30604](https://github.com/hexonet/whmcs-ispapi-registrar/commit/6a306043d33bd0b662e2d4594ea089bc01a58dd1))

## [1.12.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.12.2...v1.12.3) (2019-12-03)


### Bug Fixes

* **transferdomain:** review use of $params ([f3c0619](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f3c061999c9f86469e3a00365450fe3ab2fac04b))
* **transfersync:** reviewed in direction of QueryEventList to be more reliable ([b618892](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b6188925871492800a7f675efa2d086f908ca914))

## [1.12.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.12.1...v1.12.2) (2019-11-04)


### Bug Fixes

* **transfer:** change period auto-detection to apply for only 0Y ([5fb61bb](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5fb61bbfa820812c539e3a8ddc8baac12a3bf9fe))

## [1.12.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v1.12.0...v1.12.1) (2019-10-22)


### Bug Fixes

* **TransferDomains:** a minor bug fix in Transfer domain checks ([de76823](https://github.com/hexonet/whmcs-ispapi-registrar/commit/de76823598f351c9d0c690996a7f6c8b0c9c07d2))

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
