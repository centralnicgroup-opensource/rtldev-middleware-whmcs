## [7.2.16](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.15...v7.2.16) (2022-01-10)


### Bug Fixes

* **additional domain fields:** reviewed .de fields autocompletion ([87f4abf](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/87f4abf05f740639fb2d44ada48ccb06c647b736))

## [7.2.15](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.14...v7.2.15) (2022-01-04)


### Bug Fixes

* **.ae:** removed all additional fields (deprecated) ([181511e](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/181511eaa877234e453393e4d99e8f8d2f7f23bd))
* **.ca:** added contact confirmation menu entry ([389d645](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/389d645118ee166cf8bc820255ecec309b3d2688))

## [7.2.14](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.13...v7.2.14) (2021-12-21)


### Bug Fixes

* **additional fields:** suppress additional fields for repository owners ([fd888d0](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/fd888d0e7a440b2f93e480dff6093aa9d98fb2c4))

## [7.2.13](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.12...v7.2.13) (2021-12-08)


### Bug Fixes

* **data gathering:** added missing whereIn clause and registrar configuration option ([d4f894b](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/d4f894b03527b22f8f9913ea407bcdc80d9a7383))

## [7.2.12](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.11...v7.2.12) (2021-12-06)


### Bug Fixes

* **domain synchronization:** fix status after expiration (transferred away / expired / unchanged) ([f97bc74](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/f97bc74b0e2c7fcf04857fc058a3a9e452094934))

## [7.2.11](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.10...v7.2.11) (2021-12-01)


### Bug Fixes

* **.nu:** final fix for additional domain fields ([0f0d948](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/0f0d948eced67168c222738bcae27b98161eace0))

## [7.2.10](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.9...v7.2.10) (2021-11-30)


### Bug Fixes

* **.nu:** additional domain fields for change of owner fixed ([264d8e2](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/264d8e23842be0316878bfb0e96b033f2cfa1c35))

## [7.2.9](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.8...v7.2.9) (2021-11-29)


### Bug Fixes

* **.nu:** no Additional Fields Configuration for Trade ([9fdcff4](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/9fdcff40cbd86ece4b11e476c161548b20f8bd4e))


### Performance Improvements

* **registrar tld sync:** minimize idn conversion runtime of IDN TLDs ([048b195](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/048b19540d0f84784aa9a12a10f0aabeb8e78aa9))
* **zone configuration cache:** added caching mechanism to QueryDomain(Options|Repository) calls ([bdeb39f](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/bdeb39fe6d43c42cf9442f14ce81e715daa45a24))

## [7.2.8](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.7...v7.2.8) (2021-11-19)


### Bug Fixes

* **irtp:** fix IRTP detection ([2bbf3cc](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/2bbf3cc8ac7f8624d5f0eee9fdc797838acac93b))

## [7.2.7](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.6...v7.2.7) (2021-11-10)


### Bug Fixes

* **registrar tld sync:** exclude breaking IDN TLD .XN--HX814E for now (RSRBE-6790) ([b2c98c0](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/b2c98c05310c169251eb879410b77cbb36773d57))

## [7.2.6](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.5...v7.2.6) (2021-11-09)


### Bug Fixes

* **transferdomain:** generic mechanism for eliminating additional fields not supported by transfer ([415bcd0](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/415bcd0204cf93966ac1d9546f0f0a4779d69558))

## [7.2.5](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.4...v7.2.5) (2021-11-05)


### Bug Fixes

* **transferdomain:** request not forwarded to backend system ([df64c43](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/df64c43c2491c645e4afff775bad142cd38229d8))

## [7.2.4](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.3...v7.2.4) (2021-11-04)


### Bug Fixes

* **transferdomain:** remove additional field for .nu transfers ([3185849](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/3185849b0a4a883f708ca1a04892be3cf60c5a78))

## [7.2.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.2...v7.2.3) (2021-11-03)


### Bug Fixes

* **api client:** upgrade php-sdk to 6.1.2 fixing POST requests ([c180f12](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/c180f123cad246ad04938d7dc926120786c06beb))

## [7.2.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.1...v7.2.2) (2021-10-07)


### Bug Fixes

* **domain sync:** sync expirydate for .dk domains renewed at dkh but still pending in our system ([bdb4ff1](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/bdb4ff1fccf0c1e41c4fa2d7b273732333a475c1))

## [7.2.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.2.0...v7.2.1) (2021-10-06)


### Bug Fixes

* **getnameservers,getregistrarlock:** cleanup reverted (until WHMCS' #CORE-17038 got rolled out) ([8f8cf40](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/8f8cf40f06acfba627a6465640183c3eb47a359e)), closes [#CORE-17038](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/CORE-17038)

# [7.2.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.1.5...v7.2.0) (2021-10-05)


### Features

* **additional fields:** added autocompletion (mailto: / https?s://) for .de contact fields ([fe9863e](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/fe9863e6230bffd2aaca9a0799e0cba388607dee))

## [7.1.5](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.1.4...v7.1.5) (2021-10-05)


### Bug Fixes

* **language override:** fix translation keys of .dk additional fields for contacts ([bc2ea26](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/bc2ea265864948ccca469f07bcbcc3a203980ae2))

## [7.1.4](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.1.3...v7.1.4) (2021-10-04)


### Bug Fixes

* **transfer validation:** html_entity_decode eppcode for validation on checkout ([867d605](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/867d605b16ff670314a180d486ab3b5116ec592e))

## [7.1.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.1.2...v7.1.3) (2021-10-04)


### Bug Fixes

* **transfer log:** fixed ui width in admin area when showing big blog transfer log data (e.g. .fm) ([c4c8935](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/c4c8935a7bc24b4cbfc1b0857c05ddddeb09a044)), closes [#216](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/216)

## [7.1.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.1.1...v7.1.2) (2021-10-04)


### Bug Fixes

* **domain transfer:** of .au to include contact data ([da7c642](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/da7c6429b8e5b884ea87698b1340a8673391b16b))

## [7.1.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.1.0...v7.1.1) (2021-09-30)


### Bug Fixes

* **domain sync:** fix for .dk domains to get returned as transferred away instead of expired ([63459ff](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/63459ffb6c9e698ac9c56f51dd8b1ea61aff123f))

# [7.1.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.0.4...v7.1.0) (2021-09-15)


### Features

* **Whois Output & ERRP Settings:** added fields to admin area ([15b7ca3](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/15b7ca37ef2b9e2442bc5e25556edd1e98996486))

## [7.0.4](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.0.3...v7.0.4) (2021-09-08)


### Bug Fixes

* **sidebar menu:** on client area not showing menu entries "Registrar Lock", "Nameservers" ([0ee142a](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/0ee142ac15f108edfe066a661de01990e0ba5e53)), closes [#213](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/213)

## [7.0.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.0.2...v7.0.3) (2021-09-03)


### Bug Fixes

* **additional fields:** add missing fields for AFNIC TLDs ([963e852](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/963e852eba854b152b0717db1a91b7048aa302b7))

## [7.0.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.0.1...v7.0.2) (2021-09-03)


### Bug Fixes

* **additional fields:** make .IT fields partially required ([7707d6c](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/7707d6c7aa4db63c494c462f76d48d05a45c924b))

## [7.0.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v7.0.0...v7.0.1) (2021-09-02)


### Bug Fixes

* **additional fields:** fix issue with .NGO Transfers ([8ea1407](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/8ea1407cb7f8b1e148bd30d286922e01c4f1e83f)), closes [#208](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/208)

# [7.0.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.6.0...v7.0.0) (2021-08-20)


### Bug Fixes

* **availability check:** deprecate aftermarket premiums (blocking transfers), fixed price detection ([7c14a5e](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/7c14a5e8186cafcf86d75769ebf424f0a6f137c5))
* **client area:** fixed broken additional domainfields injection in contact information page ([a9261b3](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/a9261b313da4344306dd60d8e9f36fe527dfdb97))
* **getdomaininformation:** return nameservers correctly for pending transfers ([3a3bdb7](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/3a3bdb75ec3aabb038b257379c5104ab455597b3))


### Features

* **suspend after expiration:** configure auto-suspension after expiration (before ARGP) ([d403dbb](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/d403dbb3fa36c82408f09df4131b7e97dce4c628))
* **transfer status:** show Transfer Status & Logs in Admin Area ([56a6abd](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/56a6abd33774306d3055c01ac3ec48b8c08f01b9))


### Performance Improvements

* **idn conversion:** cleanup idn conversion, this is handled automatically now ([8998451](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/8998451b1ffc8f26dac07485d8b9a7e412fb7e05))


### BREAKING CHANGES

* **transfer status:** https://developers.whmcs.com/domain-registrars/domain-information/ making
GetRegistrarLock and GetNameservers superfluous

# [6.6.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.5.0...v6.6.0) (2021-08-12)


### Bug Fixes

* **additional fields:** fixed typo with .ES Admin Type ([ef2f8c9](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/ef2f8c957bb823b93f0e3fbb4f0a42f5d782393a))


### Features

* **idnlanguage:** auto-detection in GetDomainInformation for our domain importer addon ([bc6ccc9](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/bc6ccc9471a2931f57f8e942c6cf3736cf2e864e))

# [6.5.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.4.3...v6.5.0) (2021-08-10)


### Features

* **registrar tld sync:** include syncing id protection addon support (registrar config setting) ([6702270](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/6702270f8b361c4604069845436cf3d872837c27))

## [6.4.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.4.2...v6.4.3) (2021-08-10)


### Bug Fixes

* **getdomaininformation:** removed debug output ([c623e53](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/c623e535fdb0de8a5a0f9acbc15bd949d2bead2e))

## [6.4.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.4.1...v6.4.2) (2021-08-10)


### Bug Fixes

* **getdomaininformation:** do not change domain status on our own, delegate this to whmcs (in sync) ([1fdf99f](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/1fdf99f3769c71eb39fd190b2ab38115cbd2967c))

## [6.4.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.4.0...v6.4.1) (2021-08-10)


### Bug Fixes

* **new aa buttons:** add missing check for pending transfer status ([d356686](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/d356686ea55f76d9920adad66222ad1bd7417084))

# [6.4.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.3.2...v6.4.0) (2021-08-10)


### Features

* **new admin area buttons:** for resending transfer confirmation email & cancelling transfer ([3faa74f](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/3faa74feb7f0b4e55e994cb4715c4d588781251a))

## [6.3.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.3.1...v6.3.2) (2021-08-09)


### Bug Fixes

* **web apps:** fixed web apps logo size ([248601a](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/248601a6db3e6f5eed0e7721b84051d955afbf1f))

## [6.3.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.3.1...v6.3.2) (2021-08-09)


### Bug Fixes

* **web apps:** fixed web apps logo size ([2e4f4da](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/2e4f4da67be83ff9c585455cdfbaca51832c4950))

## [6.3.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.3.0...v6.3.1) (2021-08-06)


### Bug Fixes

* **domain (un)suspension:** added error details for error case ([677804e](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/677804eb0d706f6460f0707551b0f1f37149d0a8))

# [6.3.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.9...v6.3.0) (2021-08-06)


### Features

* **domain (un)suspenion:** admin Area Button to suspend/unsuspend the domain name ([a68e303](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/a68e303b57aa7530a0e23598a7e39f5dc56589af))

## [6.2.9](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.8...v6.2.9) (2021-08-06)


### Bug Fixes

* **additional fields:** fixed .jobs company url field ([3dd5146](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/3dd5146c83b3ddf1ee12d79d8400838c97a54143))

## [6.2.8](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.7...v6.2.8) (2021-08-05)


### Performance Improvements

* **translations:** moved into our module folder. include them in language override files ([fe4908e](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/fe4908eb21d9514bf4529461494972e724c421ba)), closes [#201](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/201)

## [6.2.7](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.6...v6.2.7) (2021-08-05)


### Bug Fixes

* **additional fields:** configure .SE Registrant ID Number as required ([152eb92](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/152eb9256963c527ecb0b2d160e60734abe47be9)), closes [#204](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/204)
* **transliteration:** fixed transliteration php errors ([29baeb3](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/29baeb3efcf04721c6174fe66b369edd081113d1)), closes [#202](https://github.com/hexonet/whmcs-ispapi-registrar-src/issues/202)

## [6.2.6](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.5...v6.2.6) (2021-08-04)


### Bug Fixes

* **getdomaininformation:** fixed registrationdate returned by custom mechanism (no need to upgrade) ([7d7786c](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/7d7786c7e0ff0491d585145c9447c1d3e9cb0131))

## [6.2.5](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.4...v6.2.5) (2021-08-03)


### Bug Fixes

* **getdomaininformation:** fixed index access (no need to upgrade) ([96f9db2](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/96f9db232fef59da2549520184e5ccc714bb95c2))

## [6.2.4](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.3...v6.2.4) (2021-08-03)


### Bug Fixes

* **getdomaininformation:** added custom data for important addon ([0ee06be](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/0ee06be647b434a4bc7ae6f2661b6878612bb266))

## [6.2.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.2...v6.2.3) (2021-07-29)


### Bug Fixes

* **savecontactdetails:** fixed to consider the right submitted contact data ([97c248c](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/97c248c08fe709b84b6ef9bc845377e712c15052))

## [6.2.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.1...v6.2.2) (2021-07-28)


### Bug Fixes

* **contact update:** fixed method chaining when taking additional fields from POST Request ([fe8a99c](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/fe8a99cdf1b363e41a922c8bd700d13b41904bbc))

## [6.2.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.2.0...v6.2.1) (2021-07-28)


### Bug Fixes

* **additional fields:** .nu requirements reviewed ([360d16a](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/360d16a7010fa6405db7424fb6521fa542793cb4))

# [6.2.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.1.5...v6.2.0) (2021-07-26)


### Features

* **getdomaininformation:** extended to return further custom registrar data ([7825135](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/782513514c538b30d23077d42f5763f17980debd))

## [6.1.5](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.1.4...v6.1.5) (2021-07-26)


### Bug Fixes

* **additional fields:** fixed missing .fi configuration field id: X-FI-REGISTRANT-BIRTH-DATE ([ce8b2e6](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/ce8b2e6009ddcf2010023ccf7f60d1acd4a5f324))

## [6.1.4](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.1.3...v6.1.4) (2021-07-23)


### Bug Fixes

* **additional fields:** for transfers: review when to not include contact data using generics ([ef88cfc](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/ef88cfc39bf964edb6a687cdabcd96028c3fc875))

## [6.1.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.1.2...v6.1.3) (2021-07-23)


### Bug Fixes

* **additional fields:** fixed for transfers (WHMCS provides fields for registration) ([33e8684](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/33e8684a970aa5c34fffcd7f4a4dd3032231a24a))

## [6.1.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.1.1...v6.1.2) (2021-07-22)


### Bug Fixes

* **getdomaininformation:** extend to return addon status. (no need to upgrade) ([382bc57](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/382bc57ae3cf1ef43cbe05ea8417cd8af90826f9))

## [6.1.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.1.0...v6.1.1) (2021-07-21)


### Bug Fixes

* **savecontactdetails:** not saving new additional field value (field name new/changed) ([097b8c4](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/097b8c4b6e86f6e3aed501b7fec2a7021f25dcbf))

# [6.1.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.8...v6.1.0) (2021-07-20)


### Features

* **domain importer:** support of direct domain import to specified client (our importer addon) ([5943904](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/5943904e6dd2982c355c952ebe4718e2129e0510))

## [6.0.8](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.7...v6.0.8) (2021-07-14)


### Bug Fixes

* **idprotection:** include idprotection setting in SaveContactDetails (except Owner Change/Trade) ([d13e813](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/d13e813a46ef68d3f4d4cd5af472fefbceaa9689))

## [6.0.7](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.6...v6.0.7) (2021-07-12)


### Bug Fixes

* **archive:** wrong folder structure; reviewed encryption of hooks.php ([14dca89](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/14dca892fc476ac9b434eae9c82fde2b022ab761))

## [6.0.6](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.5...v6.0.6) (2021-07-09)


### Bug Fixes

* **logo:** missing logo for our modules overview widget (will be cleaned up soon again) ([049a558](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/049a5581d84321399933024999519d296f6301a5))

## [6.0.5](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.4...v6.0.5) (2021-07-09)


### Bug Fixes

* **ci:** do not encrypt language files ([3afd10c](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/3afd10ca28207abf06c949c67fe8aa68a051a78e))

## [6.0.4](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.3...v6.0.4) (2021-07-08)


### Bug Fixes

* **additional fields:** create fields in DB if not existing ([9590cb7](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/9590cb7ed1b712a6941d9b4cf0c5662969dde1e0))

## [6.0.3](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.2...v6.0.3) (2021-07-07)


### Bug Fixes

* **additional fields:** set tickbox field values as int ([436003c](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/436003c7310090405ab980720c724901f8075a59))

## [6.0.2](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.1...v6.0.2) (2021-07-07)


### Bug Fixes

* **5.1.9-5.1.12:** add missing changes ([dc3f0a6](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/dc3f0a61a02f20b0321e1b1cfc638a853badd955))

## [6.0.1](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v6.0.0...v6.0.1) (2021-07-07)


### Bug Fixes

* **contacts:** reviewed contact data mechanism for .it (ADMIN = REGISTRANT) ([3ce4d74](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/3ce4d74f97535255365d7f25b204d7b919e96722))

# [6.0.0](https://github.com/hexonet/whmcs-ispapi-registrar-src/compare/v5.1.12...v6.0.0) (2021-07-07)

## [5.1.12](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.11...v5.1.12) (2021-06-24)


### Bug Fixes

* **transfer:** consider additional fields for .ro ([a7867e0](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a7867e0df84cfac974d809eb200ca3cb21dc8d86)), closes [#195](https://github.com/hexonet/whmcs-ispapi-registrar/issues/195)

## [5.1.11](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.10...v5.1.11) (2021-06-21)


### Bug Fixes

* **failed orders:** with status "pending" are left untouched ([962b3d0](https://github.com/hexonet/whmcs-ispapi-registrar/commit/962b3d063b8eb10c9b0c9c4cac55ded1f67f5d95)), closes [#192](https://github.com/hexonet/whmcs-ispapi-registrar/issues/192)

## [5.1.10](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.9...v5.1.10) (2021-06-21)


### Bug Fixes

* **premium domains:** fixed domain synchronization/details page related to premium domains ([5ef0ddf](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5ef0ddf4615b594d75f56ed23d12ac6e24105033)), closes [#192](https://github.com/hexonet/whmcs-ispapi-registrar/issues/192)

## [5.1.9](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.8...v5.1.9) (2021-06-21)


### Bug Fixes

* **expirydate:** do no longer consider to subtract 1d. Sorry for the inconveniences caused ([1fe4479](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1fe4479848cb6f239b8191d4640fd9f1bc5a1721))
### Features

* **revamp:** revamping Transliteration, Domain Fields, Contact Update ([20c3310](https://github.com/hexonet/whmcs-ispapi-registrar-src/commit/20c3310d94555f95ee96d4e1dd8384fc0901c522))


### BREAKING CHANGES

* **revamp:** New way of Handling Domain Fields, Contact Updates/Owner Changes and consider
Transliterations and introducing a new Translation Mechanism

## [5.1.8](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.7...v5.1.8) (2021-06-15)


### Bug Fixes

* **six:** SRV Record Integration ([32f093a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/32f093a3775e7d8cb027e9cefd1e6d8659c4c748))
* **twenty-one:** SRV Record Integration ([d84fa26](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d84fa2624ae65485599e534bd1aa31c22293df91)), closes [#191](https://github.com/hexonet/whmcs-ispapi-registrar/issues/191)

## [5.1.7](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.6...v5.1.7) (2021-06-04)


### Bug Fixes

* **dep-bump:** fix SQL Query related to expired (deleted) domains ([d6c2dfe](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d6c2dfe93aa78c84e3f984f6f0c658162a10f53f)), closes [#186](https://github.com/hexonet/whmcs-ispapi-registrar/issues/186)

## [5.1.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.5...v5.1.6) (2021-06-04)


### Bug Fixes

* **dep bump:** upgrade helper lib to fix namespace lookup issue for DB Class ([83e64ba](https://github.com/hexonet/whmcs-ispapi-registrar/commit/83e64ba6bbefe76045e7e8644cabd02b85f0b9cf)), closes [#186](https://github.com/hexonet/whmcs-ispapi-registrar/issues/186)

## [5.1.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.4...v5.1.5) (2021-06-04)


### Bug Fixes

* **expiry data:** use former way; sub 1d: whmcs deals with date portion ([622aa26](https://github.com/hexonet/whmcs-ispapi-registrar/commit/622aa2609d486d1d4ed24883785cce9696daf54b))

## [5.1.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.3...v5.1.4) (2021-05-31)


### Bug Fixes

* **expirydate:** considering FAILUREDATE - 1d as better approach for expirydate ([b593ba2](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b593ba23f8aa1c1e5687dc890b6f3591bfccf571))

## [5.1.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.2...v5.1.3) (2021-05-25)


### Bug Fixes

* **hooks:** ensure to load registrar functions if not available ([5c8883c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5c8883c69a2180c256735332bef8bba77dd19558))

## [5.1.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.1...v5.1.2) (2021-05-25)


### Bug Fixes

* **savenameservers:** nameserver update including dnszone creation but dns management not active ([f31055a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f31055afe0aa94ff7077fdd2c3e8e02a2ca17ffe))

## [5.1.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.1.0...v5.1.1) (2021-05-21)


### Bug Fixes

* **expirydate:** fixed expirydate detection for special TLDs like .dk ([d4d2f75](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d4d2f7581f0113813796729f7333ee60b213356d))

# [5.1.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v5.0.0...v5.1.0) (2021-05-21)


### Features

* **shopping cart:** transfer Pre-Checks on Checkout. See Registrar Module Configuration ([fd2e717](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fd2e7173139f21edc8fbb1413efdcca166ce3404))

# [5.0.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.10.0...v5.0.0) (2021-05-18)


### Bug Fixes

* **domain renew:** rollback menu entry removal. Correct way added to our docs ([ad79042](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ad790426cdba10744c5a5e92b7b9904fbc643d76))
* **sync:** correctly cover outbound transfers ([5d69f25](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5d69f2514e0b16e13dadf1c365395133604b0ac9))


### Code Refactoring

* **auto contact update:** config option for auto-contact update plus reviewed process ([50c60bd](https://github.com/hexonet/whmcs-ispapi-registrar/commit/50c60bd21925c9342167995044a511aff2467788))


### BREAKING CHANGES

* **auto contact update:** The automatic contact update had been always active and also been part of Domain
Synchronization which is now no longer the case to avoid mass suspensions as of possible IRTP.

# [4.10.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.9.4...v4.10.0) (2021-05-12)


### Features

* **domain renew:** hide "Renew" menu entry if timestamp does not yet allow for it (TLDs like .dk) ([939ddc4](https://github.com/hexonet/whmcs-ispapi-registrar/commit/939ddc4dc8eb24a13d429466f73225b18f5926c8))

## [4.9.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.9.3...v4.9.4) (2021-05-10)


### Bug Fixes

* **menu:** move private nameservers menu entries to the bottom ([95130b1](https://github.com/hexonet/whmcs-ispapi-registrar/commit/95130b13fd1c95269ffc2df55bbd2a2c5e26f3c1))

## [4.9.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.9.2...v4.9.3) (2021-05-10)


### Bug Fixes

* **expirydate:** reviewed Sync method ([547f7b9](https://github.com/hexonet/whmcs-ispapi-registrar/commit/547f7b9dd4117e8bb7918fd05471f274ed629769))
* **getdomaininformation:** expirydate and contactChangeExpiryDate reviewed ([15a0a3a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/15a0a3acff9f149523421a36a876c722617ed65a))
* **getdomaininformation:** review in direction of pending transfers ([0fbf7a7](https://github.com/hexonet/whmcs-ispapi-registrar/commit/0fbf7a773f8b739e09c45dab9c7c5465c6295976))
* **releasedomain:** add check for active registrar lock before trying to release ([3d29679](https://github.com/hexonet/whmcs-ispapi-registrar/commit/3d29679f4244f1e4c174d8e0fd560c8f76aa3396))
* **transfersync:** convert UTC expirydate to WHMCS' timezone ([8f38cee](https://github.com/hexonet/whmcs-ispapi-registrar/commit/8f38cee80d64ed2e99e611aa92963deccc988d40))


### Performance Improvements

* **expirydate:** rewrite to consider newly introduced backend response' property (QueryObjectList) ([f63d7b5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f63d7b527e5bac4daf74e6be08c459770d97fe30))

## [4.9.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.9.1...v4.9.2) (2021-05-04)


### Bug Fixes

* **hooks.php:** fixed php warning regarding unknown constant ([58dce8c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/58dce8cb84aafd621c95c1932b0f3b72d4ad3903))

## [4.9.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.9.0...v4.9.1) (2021-05-03)


### Bug Fixes

* **geteppcode:** add logging to System Activity Log ([23f0e28](https://github.com/hexonet/whmcs-ispapi-registrar/commit/23f0e28f8e74e82dbf88bc701f9cfd927678c8f8))

# [4.9.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.8.2...v4.9.0) (2021-04-29)


### Features

* **private nameservers:** added listing of domain related private nameservers ([2517350](https://github.com/hexonet/whmcs-ispapi-registrar/commit/2517350b8cdf64e3033afacce0530c963e3d4706))

## [4.8.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.8.1...v4.8.2) (2021-04-28)


### Bug Fixes

* **transfersync:** fix expirydate detection ([9695484](https://github.com/hexonet/whmcs-ispapi-registrar/commit/9695484011532720e2b1643164535a9f09bc8bf6))

## [4.8.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.8.0...v4.8.1) (2021-04-28)


### Bug Fixes

* **transfersync:** review expirydate detection, add it to log output ([135a7b6](https://github.com/hexonet/whmcs-ispapi-registrar/commit/135a7b6b74e7de4d1bd6c49c55cf03e9bd227c4d))

# [4.8.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.6...v4.8.0) (2021-04-26)


### Bug Fixes

* **domaininformation:** reviewed GetDomainInformation to improve in direction of expired domains ([4757d6b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4757d6becffbe67bf4d2e33a62455113b8b72afc))


### Features

* **restore:** introduce domain restores ([e6f8c48](https://github.com/hexonet/whmcs-ispapi-registrar/commit/e6f8c48e16a28247f79c99496b53a4a37e50e56c))

## [4.7.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.5...v4.7.6) (2021-04-23)


### Performance Improvements

* **review epp:** improved existing logic of epp code ([36e3270](https://github.com/hexonet/whmcs-ispapi-registrar/commit/36e32707de92ebb819026043f7d387e890e3e597))

## [4.7.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.4...v4.7.5) (2021-04-20)


### Bug Fixes

* **transfersync:** return expirydate to avoid call of Sync ([42ca56c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/42ca56c716c8fbbdd0aadddb66d8e71fa8934513))

## [4.7.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.3...v4.7.4) (2021-04-08)


### Bug Fixes

* **sync:** improved status sync around and after expiration ([a192a2b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a192a2bc95db3b86e9d4ff8c69ae8c1c1f848590))

## [4.7.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.2...v4.7.3) (2021-03-23)


### Bug Fixes

* **additional domain fields:** fixed wrong .ca WHOIS Opt-Out Description ([4cba7ad](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4cba7ad31c1afc196a0287e5990dd81eded6dd50))
* **registerdomain:** transferlock not active for domain registrations ([42daf4b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/42daf4b42c5dfa1d80a7e122e9baabe551a8e302))

## [4.7.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.1...v4.7.2) (2021-03-22)


### Bug Fixes

* **getdomaininformation:** fixed issue showing registrar lock as always turned on ([3040af4](https://github.com/hexonet/whmcs-ispapi-registrar/commit/3040af4cc3cdc8413fa9ad67bc8ad2b2a03f00c1)), closes [#170](https://github.com/hexonet/whmcs-ispapi-registrar/issues/170)

## [4.7.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.7.0...v4.7.1) (2021-03-22)


### Bug Fixes

* **transfersync:** reviewed TransferSync in direction of status sync issues ([b3c27c3](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b3c27c3a3b1269883b29c48664b4263d9ab3c280))

# [4.7.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.7...v4.7.0) (2021-03-09)


### Features

* **.de:** autocomplete additional field values in case protocol is missing ([1038d5c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1038d5ce0c83c292e493711c975530cce1d64d08)), closes [#167](https://github.com/hexonet/whmcs-ispapi-registrar/issues/167)

## [4.6.7](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.6...v4.6.7) (2021-03-09)


### Bug Fixes

* **dep-bump:** upgrade helper library to get array_map error fixed ([ec69daa](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ec69daaf980ad39dd9ea126ae61b6c398ccf5029)), closes [#169](https://github.com/hexonet/whmcs-ispapi-registrar/issues/169)

## [4.6.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.5...v4.6.6) (2021-03-08)


### Bug Fixes

* **transfer sync:** wrong parameter type used for method getSuccessLog ([a7b56e7](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a7b56e77c5bbdfbd6e91e7b5821b64e4af146473)), closes [#168](https://github.com/hexonet/whmcs-ispapi-registrar/issues/168)

## [4.6.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.4...v4.6.5) (2021-03-05)


### Bug Fixes

* **premium domains:** premium renewal in some cases not working (currency different) ([dad18e8](https://github.com/hexonet/whmcs-ispapi-registrar/commit/dad18e8638c758fe19e15dc460d071044cc037c4))

## [4.6.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.3...v4.6.4) (2021-02-09)


### Bug Fixes

* **typo:** removed typo from code ([b91052a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b91052a4a2dc745e11337692079f4e81f9e97947))

## [4.6.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.2...v4.6.3) (2021-02-09)


### Bug Fixes

* **transferlock:** refactored; remove `Registrar Lock` menu if not supported ([e301f7a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/e301f7af936c8de2bc94e75d756c1de1017ef4a1)), closes [#164](https://github.com/hexonet/whmcs-ispapi-registrar/issues/164)

## [4.6.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.1...v4.6.2) (2021-02-05)


### Bug Fixes

* **transfersync:** fixed wrong war usage [#2](https://github.com/hexonet/whmcs-ispapi-registrar/issues/2) ([29adaeb](https://github.com/hexonet/whmcs-ispapi-registrar/commit/29adaeb002228e40e6074fc6095d7003e52081ae))

## [4.6.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.6.0...v4.6.1) (2021-02-05)


### Bug Fixes

* **transfersync:** fixed wrong var usage ([f818f88](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f818f8823260b51bca74b55d3b40b133c36a2697))

# [4.6.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.25...v4.6.0) (2021-02-02)


### Features

* **transferdomain:** auto-unlock domain (behavior still losing registrar dependent) ([c479efd](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c479efde359b9ad41e69d88f69645e9954c501c2))

## [4.5.25](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.24...v4.5.25) (2021-02-01)


### Bug Fixes

* **github actions:** checkout including submodules ([fa8c4ab](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fa8c4ab903f0153e687b04bbbcf9c89ce5aa5096))
* **github actions:** checkout including submodules in release step ([fc1b5a0](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fc1b5a04022f06cbf17b7fa26bf17eec726157fe))

## [4.5.24](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.23...v4.5.24) (2021-02-01)


### Bug Fixes

* **github actions:** add submodules checkout (this worked in Travis CI by default) ([8dac6a4](https://github.com/hexonet/whmcs-ispapi-registrar/commit/8dac6a48aeb991677dbf7562dffbe1be259f83d6))

## [4.5.23](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.22...v4.5.23) (2021-01-27)


### Bug Fixes

* **ci:** migration to github actions and gulp; reviewed folder structure ([f61cd23](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f61cd239841c2a11e5675623f03bea3d7bacbc23))

## [4.5.22](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.21...v4.5.22) (2021-01-11)


### Bug Fixes

* **statistics data:** auto-cleanup old entries ([c7ce418](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c7ce418013c3bd95b9bc415648327749550c7075))

## [4.5.21](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.20...v4.5.21) (2021-01-08)


### Bug Fixes

* **statistics:** fixed WHMCS Version lookup ([36afdf1](https://github.com/hexonet/whmcs-ispapi-registrar/commit/36afdf18499163552d6cf66b93e29a9b30b12fef))

## [4.5.20](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.19...v4.5.20) (2021-01-07)


### Bug Fixes

* **variable fee premium domains:** fix currency lookup regexp ([168b57a](https://github.com/hexonet/whmcs-ispapi-registrar/commit/168b57acd82526e4cef43bc9dd27d364daa67e7e))

## [4.5.19](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.18...v4.5.19) (2020-12-17)


### Bug Fixes

* **tld & pricing sync:** add missing 3rd level TLD .com.fr ([5df8088](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5df8088d2bdbfe2bdb455e6a9aef14e5ad7ad81d))

## [4.5.18](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.17...v4.5.18) (2020-12-14)


### Bug Fixes

* **checkavailability:** fallback to whois lookup for unsupported TLDs ([f0f5028](https://github.com/hexonet/whmcs-ispapi-registrar/commit/f0f5028153713ba429992ffbb37a7eb34e23b972))

## [4.5.17](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.16...v4.5.17) (2020-12-11)


### Bug Fixes

* **transferdomain:** fallback to 0Y if supported and WHMCS' provided period is not supported ([9af4592](https://github.com/hexonet/whmcs-ispapi-registrar/commit/9af45927444e36b768446eec6fe0fe3d1958c038))

## [4.5.16](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.15...v4.5.16) (2020-12-08)


### Bug Fixes

* **transfer:** 0Y transfer only if regperiod transfer not supported (e.g. .NZ, .ES, .NO, .NU) ([a912e58](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a912e58476c8e2701097438546001879a0dce5d8))

## [4.5.15](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.14...v4.5.15) (2020-12-04)

### Bug Fixes

* **transferdomain:** fixed issue with AFNIC TLDs (exclude registrant & billing-c) ([bbd777c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/bbd777cae99b0eee62bf3e57e9e2e2e3916a0344))

## [4.5.14](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.13...v4.5.14) (2020-12-03)

### Bug Fixes

* **dep-bump:** missing dependency upgrade ([d6d60b7](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d6d60b7c6f9cdc10f4732cc01a6e75a2ad2a939d))

## [4.5.13](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.12...v4.5.13) (2020-12-03)

### Bug Fixes

* **_config_validate:** not reliable to use (caches results, core bug reported to WHMCS) ([b8c6f48](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b8c6f482b0f3a1b2a429e5f4a8fc74546e2c3c46))

## [4.5.12](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.11...v4.5.12) (2020-12-01)

### Bug Fixes

* **migrate button:** reviewed appearance and extended usage (taking over settings from hx module) ([0d4a5f0](https://github.com/hexonet/whmcs-ispapi-registrar/commit/0d4a5f0e1566a31d38281765af5b846bfc3b56a1))
* **tld & pricing sync:** not offerable TLDs appeared with registration price 0.00 (not critical!) ([d5c4b56](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d5c4b56776becfa36cfda76f991e3fce38f1f120))

### Performance Improvements

* **configuration validation:** use undocumented method _config_validate as replacement ([5b2bb92](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5b2bb92eca08d668b238aea85968bc38850bcdf8)), closes [#ESD-183344](https://github.com/hexonet/whmcs-ispapi-registrar/issues/ESD-183344)

## [4.5.11](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.10...v4.5.11) (2020-11-24)

### Bug Fixes

* **web apps:** list of connectable Web Apps empty (issue in archive build process) ([95e786b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/95e786b0dc3dd953a2f3a0d9f67fafe81b53a4be))

## [4.5.10](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.9...v4.5.10) (2020-11-20)

### Bug Fixes

* **dk hostmaster contact:** cast the additional domain field values to uppercase format explicitely ([4d71861](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4d71861a1ede527e6f2d4428c9db9bf35deb9e26))

## [4.5.9](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.8...v4.5.9) (2020-11-20)

### Bug Fixes

* **dk hostmaster id:** prefilling happens always using the uppercase value ([810e3f1](https://github.com/hexonet/whmcs-ispapi-registrar/commit/810e3f18eb03f6de5b9f5d71f270e32592dc9441))

## [4.5.8](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.7...v4.5.8) (2020-11-20)

### Bug Fixes

* **dependency:** fixed missing dependency upgrade ([d76a09c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/d76a09cd87fdf949cdde09fc32e707e8ccf36cb3))

## [4.5.7](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.6...v4.5.7) (2020-11-20)

### Performance Improvements

* **getconfigarray:** better performance; moved stats to daily sync; fixed server ip output ([0014829](https://github.com/hexonet/whmcs-ispapi-registrar/commit/0014829d904aebb58f757b45a6fd85e52561ba37))

## [4.5.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.5...v4.5.6) (2020-11-12)

### Performance Improvements

* **getconfigarray:** dependency reviewed to avoid loading prices ([67f6e7e](https://github.com/hexonet/whmcs-ispapi-registrar/commit/67f6e7eeb0b238ebdaa6bfa29f2e9a01f08921e3))

## [4.5.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.4...v4.5.5) (2020-11-11)

### Performance Improvements

* **getconfigarray:** reviewed for better performance (affected list of registered domains) ([722a538](https://github.com/hexonet/whmcs-ispapi-registrar/commit/722a5386df0d0cbc77c5781d11fdf50f722a6d2a))

## [4.5.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.3...v4.5.4) (2020-11-09)

### Bug Fixes

* **path issues:** fixed in savecontactdetails, sync methods ([56b4e02](https://github.com/hexonet/whmcs-ispapi-registrar/commit/56b4e02ce41d675e8af0df72b73bb2c28f979874))

## [4.5.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.2...v4.5.3) (2020-10-29)

### Bug Fixes

* **transfersync:** partially missing automatic ns update ([560a424](https://github.com/hexonet/whmcs-ispapi-registrar/commit/560a4245ac8119c3bd9e6961890e5fe1bfa0f5ef))

## [4.5.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.1...v4.5.2) (2020-10-05)

### Bug Fixes

* **dnssec:** offer DNSSEC/Secure DNS also non-DNS Management cases ([6495de3](https://github.com/hexonet/whmcs-ispapi-registrar/commit/6495de398c712fa64cc584722c3fc84106ef050f))

## [4.5.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.0...v4.5.1) (2020-09-24)

### Bug Fixes

* **transfersync:** use status check and just leave corner cases to log lookup mechanism ([da0c6f7](https://github.com/hexonet/whmcs-ispapi-registrar/commit/da0c6f704a811edf5817be079f867fb7f76cb725))

# [4.5.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.4.5...v4.5.0) (2020-09-18)

### Features

* **additionalfields:** added additional fields configuration code for .GAY ([57f5a92](https://github.com/hexonet/whmcs-ispapi-registrar/commit/57f5a92c7229997e2ae707b222d157e83f8efe4c))

## [4.4.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.4.4...v4.4.5) (2020-09-17)

### Bug Fixes

* **transfersync:** reactivating fixed whois privacy service sync/auto-update ([337a102](https://github.com/hexonet/whmcs-ispapi-registrar/commit/337a102d38e5e24f9d0bd7fa90cddee673270170))

## [4.4.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.4.3...v4.4.4) (2020-09-16)

### Bug Fixes

* **transfersync:** idprotection incorrectly considered as active. commenting sync partially out ([33a4223](https://github.com/hexonet/whmcs-ispapi-registrar/commit/33a422312786fbe4b44d6a94f94cbc053cf69476))

## [4.4.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.4.2...v4.4.3) (2020-09-16)

### Bug Fixes

* **transfersync:** added configuration option to turn nameserver update after transfer on/off ([952de92](https://github.com/hexonet/whmcs-ispapi-registrar/commit/952de927f14e71b7d68cb83e22bf370445e4ab32))

## [4.4.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.4.1...v4.4.2) (2020-09-03)

### Bug Fixes

* **configuration:** change order of use statements and explicitely assign aliases ([1f15194](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1f151944bb5c35125e585c9993c85ca83c0699f4))

## [4.4.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.4.0...v4.4.1) (2020-09-03)

### Bug Fixes

* **configuration:** fixes DB calls to be downward compatible ([edc2867](https://github.com/hexonet/whmcs-ispapi-registrar/commit/edc28672bb116c3552ddca23738fd21f512332eb))

# [4.4.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.3.2...v4.4.0) (2020-09-02)

### Features

* **configuration:** offer automigration possibility from HEXONET to ISPAPI ([b1fc532](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b1fc532f35da3ed4d0c8371c88ae47c6fdb21d9c))

## [4.3.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.3.1...v4.3.2) (2020-08-26)

### Bug Fixes

* **transfersync:** refactor transfersync and fixed issue with status detection ([3107545](https://github.com/hexonet/whmcs-ispapi-registrar/commit/31075452df5099162161f52e7c3bc0b004f8e7c6))

## [4.3.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.3.0...v4.3.1) (2020-08-13)

### Bug Fixes

* **whmcs8 beta3:** review IDN TLD support in Registrar TLD Sync based on WHMCS Ticket #SMT-38645 ([b692d2e](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b692d2e531d0770566d1bdd25e1bf542434fde2c))

# [4.3.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.2.1...v4.3.0) (2020-08-12)

### Features

* **whmcs8 beta3:** registrar TLD Sync allowing IDN TLDs [Pending uncritical  Bug Report SMT-386450] ([8337eff](https://github.com/hexonet/whmcs-ispapi-registrar/commit/8337efffc9e7aa724370bce1d1fefab73ffd871b))

## [4.2.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.2.0...v4.2.1) (2020-08-12)

### Bug Fixes

* **registrartldsync:** tables now using primary key (otherwise backup solutions might complain) ([a621f35](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a621f35ba3d409c0d04d0f2330db00dadf09cd81))

# [4.2.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.1.0...v4.2.0) (2020-08-10)

### Features

* **domainnamesuggestions:** extended configuration possibilities ([a4c091f](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a4c091f5c0436bd87e5f73df1a42e13f65cb75fc))

### Performance Improvements

* **checkavailability:** reviewed for better performance (chunked checks) and code structure ([c460afe](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c460afe910bafccdf8a954683bd3024789a17178))

# [4.1.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.0.1...v4.1.0) (2020-08-06)

### Features

* **transfersync:** sync status to active in case object is accessible ([6c36512](https://github.com/hexonet/whmcs-ispapi-registrar/commit/6c36512490589acc788867cb35ce17a418254d5d))

## [4.0.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.0.0...v4.0.1) (2020-08-06)

### Bug Fixes

* **registrartldsync:** add missing configuration for .geek.nz ([4a2d34c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4a2d34c4def684de1a10e47dfe5f3dfc0a9ef581))

# [4.0.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.1.0...v4.0.0) (2020-07-29)

### Bug Fixes

* **statistics:** submit PHP Version without extra data ([a6a4a40](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a6a4a409ffa457bebf3a338398153134e7390b2c))
* **transfersync:** fixed issue detecting requested nameservers ([1b3bb1c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1b3bb1c1db9f2dcbc44dc9e3d934db861b4df5dd))
* **transfersync:** replace queryeventlist with queryobjectloglist; more reliable and performant ([793c2c3](https://github.com/hexonet/whmcs-ispapi-registrar/commit/793c2c3796c15f282efa6bc99625aa6e3c09bcf2))

### Features

* **transfersync:** auto-update nameservers to the requested ones after successful transfer ([999b3fa](https://github.com/hexonet/whmcs-ispapi-registrar/commit/999b3fa92ff869195dd88752d9c8fda48281857e))

### BREAKING CHANGES

* **transfersync:** WHMCS provides specifying new Nameservers within domain transfer process. This is
not compliant with EPP standard of the most registries and not working for the most TLDs using the
HEXONET API. Therefore we care about updating on WHMCS-side. As this is a completely different
module behavior, we trigger a new major release.

# [3.1.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.14...v3.1.0) (2020-07-22)

### Features

* **webapps:** offer G-Suite integration ([ac937f5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ac937f5bf8aed3d0e8b5d60f6212d3251fb09002))

## [3.0.14](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.13...v3.0.14) (2020-07-17)

### Bug Fixes

* **sdk:** upgrade to 5.8.5 (fixes logger log call in http error case) ([da30aa0](https://github.com/hexonet/whmcs-ispapi-registrar/commit/da30aa0415d7e94e1961b9978427f8686f478eb5))

## [3.0.13](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.12...v3.0.13) (2020-07-03)

### Bug Fixes

* **savecontactdetails:** fixes .CA contact details update (state to code mapping) ([7cd2291](https://github.com/hexonet/whmcs-ispapi-registrar/commit/7cd2291f01b2fdc44c22adf7d372aae828d9ed90))

## [3.0.12](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.11...v3.0.12) (2020-06-22)

### Bug Fixes

* **sync:** update admin/tech/billing-c with client data (empty email) ([ac77de6](https://github.com/hexonet/whmcs-ispapi-registrar/commit/ac77de6e90588fb2b725fdbd160f29762cfc81ca))

## [3.0.11](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.10...v3.0.11) (2020-06-04)

### Bug Fixes

* **ci:** fixes missing whmcs.json in release commit ([5ace85d](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5ace85dd9270cdc0d19b05967097067c17470990))

## [3.0.10](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.9...v3.0.10) (2020-06-04)

### Bug Fixes

* **domainsuggestionoptions:** fixed logic to compare whmcs version ([5e024d1](https://github.com/hexonet/whmcs-ispapi-registrar/commit/5e024d129f001f98aaf05fc161bca053129c85f7))
* **irtp:** review configuration to by default suggest the WHMCS way for IRTP ([2cb942d](https://github.com/hexonet/whmcs-ispapi-registrar/commit/2cb942d8202a8923ea5bad6c9a29ad1d28a4b6b2))
* **whmcs.json:** added file and logo.png ([fd05041](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fd0504196533dcd35f40796d07986d69921a932f))

## [3.0.9](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.8...v3.0.9) (2020-06-02)

### Bug Fixes

* **sync:** review auto-update mechanism ([c239d78](https://github.com/hexonet/whmcs-ispapi-registrar/commit/c239d7891ac570cbb9ec8cbdf9bbe6a4a60f45dc))

## [3.0.8](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.7...v3.0.8) (2020-05-28)

### Bug Fixes

* **ci:** fixed version update process ([7ce9773](https://github.com/hexonet/whmcs-ispapi-registrar/commit/7ce97735333f3779a4a5da6b1579dc4239541360)), closes [#148](https://github.com/hexonet/whmcs-ispapi-registrar/issues/148)

## [3.0.7](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.6...v3.0.7) (2020-05-28)

### Bug Fixes

* **statistics:** review how to better load addon module versions ([013117e](https://github.com/hexonet/whmcs-ispapi-registrar/commit/013117e3fadfef563475d158b59b6be07acd7126))

## [3.0.6](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.5...v3.0.6) (2020-05-25)

### Bug Fixes

* **phpcompatibility:** added process to check for PHP compatibility ([4bacc24](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4bacc2495a6e0fa6d81504b861a8ffcd2393aab6))
* **phpcompatibility:** use of PDO instead of mysql_* functions (up to now to a problem) ([b52d0bf](https://github.com/hexonet/whmcs-ispapi-registrar/commit/b52d0bfa15b72332781574397a9bf3162475d31b))
* **phpstyle:** use double quotes instead of single quotes ([2c1e7d0](https://github.com/hexonet/whmcs-ispapi-registrar/commit/2c1e7d09f2f3ead7ff3a378969d6a2b38fd55a4e))

## [3.0.5](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.4...v3.0.5) (2020-05-20)

### Bug Fixes

* **registerdomain:** revert previous change (customer issue was a missing whmcs config) ([4355d2c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4355d2c79e61d343c1156397bb890a77c1272db0))

## [3.0.4](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.3...v3.0.4) (2020-05-20)

### Bug Fixes

* **registerdomain, savecontactdetails:** use $origparams instead of $params ([37b2ee5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/37b2ee5724136625c57bf051890922d29eee7661))

## [3.0.3](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.2...v3.0.3) (2020-04-27)

### Bug Fixes

* **tld & pricing sync:** support maria db (unsupported column type `json`) - follow-up fix ([4146a06](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4146a0630dfaba0d5291b4df380caaf0c0c27c73))

## [3.0.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.1...v3.0.2) (2020-04-27)

### Bug Fixes

* **tld & pricing sync:** support maria db (unsupported column type `json`) ([35c3367](https://github.com/hexonet/whmcs-ispapi-registrar/commit/35c3367ebe328e2761b2151a9943cdcd63be73e0))

## [3.0.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v3.0.0...v3.0.1) (2020-04-27)

### Bug Fixes

* **dep-bump:** upgrade helper module ([0b30051](https://github.com/hexonet/whmcs-ispapi-registrar/commit/0b300518a12a122b34cec5b610d868868956795d))

# [3.0.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.7.1...v3.0.0) (2020-04-27)

### improvement

* **php-sdk:** migrate to PHP-SDK to get connector code replaced ([870b6b3](https://github.com/hexonet/whmcs-ispapi-registrar/commit/870b6b321a54684e741dc970926118f4abcbe2cf))

### BREAKING CHANGES

* **php-sdk:** replaced connector code with the use of our PHP-SDK which is built for that
purpose.

## [2.7.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.7.0...v2.7.1) (2020-04-27)

### Bug Fixes

* **hooks:** renaming variable names (conflicting with stripe payment gateway for any reason) ([76ce8ea](https://github.com/hexonet/whmcs-ispapi-registrar/commit/76ce8eaa19de99286d1d2d8bd50a17dced0a3538))

# [2.7.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.6.2...v2.7.0) (2020-04-14)

### Features

* **pricingsync:** added redemptionfee/gracefee settings to TLD & Pricing Sync mechanism ([4dec7da](https://github.com/hexonet/whmcs-ispapi-registrar/commit/4dec7da76dd9995eae181bef38588cb7056748f1))

## [2.6.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.6.1...v2.6.2) (2020-04-03)

### Bug Fixes

* **makefile:** missing additionalfields file in package ([2506c6b](https://github.com/hexonet/whmcs-ispapi-registrar/commit/2506c6bd4f7f6a26ef327a6b3b289c9ace45575d))

## [2.6.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.6.0...v2.6.1) (2020-04-03)

### Bug Fixes

* **dep-bump:** upgrade whmcs-ispapi-helper to the latest release (fixed path issue) ([8b6c2b2](https://github.com/hexonet/whmcs-ispapi-registrar/commit/8b6c2b20df1eadc1b5870579d7388fd9676a161d))

# [2.6.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.5.2...v2.6.0) (2020-04-02)

### Features

* **additional fields:** prefill X-CA-LANGUAGE with configured client language ([fa8597c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fa8597c53acd807d27325ffea53a61a2979c29f7))

## [2.5.2](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.5.1...v2.5.2) (2020-04-02)

### Bug Fixes

* **checkavailability:** fixed namespace usage of ResultsList ([bddd8aa](https://github.com/hexonet/whmcs-ispapi-registrar/commit/bddd8aaa999098a282b2f81b87d079067a4eb542))

## [2.5.1](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.5.0...v2.5.1) (2020-04-01)

### Bug Fixes

* **IRTP:** minor fix to support opt-out option ([fc6772c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/fc6772c7adfe9f32d103851213672c55d5f6df2b))

# [2.5.0](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.16...v2.5.0) (2020-03-27)

### Features

* **pricingsync:** WHMCS 7.10 feature integration for TLD Pricing Import/Sync ([1bd13e6](https://github.com/hexonet/whmcs-ispapi-registrar/commit/1bd13e6898656cb44104b5ae5e9ef8a410ad15de))

## [2.4.16](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.15...v2.4.16) (2020-03-25)

### Bug Fixes

* **registerdomain:** remove transfer lock for premium domain and .swiss registrations ([046aee5](https://github.com/hexonet/whmcs-ispapi-registrar/commit/046aee51d1468a416f9c0f6aad74e4517d1c797b))

## [2.4.15](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.14...v2.4.15) (2020-03-20)

### Bug Fixes

* **transferdomain:** consider additional fields for .CA ([a42a311](https://github.com/hexonet/whmcs-ispapi-registrar/commit/a42a31139fa912e135bb7e164f39f9633697cd86))

## [2.4.14](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v2.4.13...v2.4.14) (2020-03-20)

### Bug Fixes

* **savecontactdetails:** reactivating X-CA-LEGALTYPE ([7459e68](https://github.com/hexonet/whmcs-ispapi-registrar/commit/7459e6878cd84849e0d84fde613995669a1def26))

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

* **pkg:** update(<https://github.com/hexonet/whmcs-ispapi-registrar/commit/bd332ff>))
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
