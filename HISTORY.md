## [4.5.15](https://github.com/hexonet/whmcs-ispapi-registrar/compare/v4.5.14...v4.5.15) (2020-12-04)


### Bug Fixes

* **transferdomain:** fixed issue with AFNIC TLDs (exclude registrant & admin-c) ([bbd777c](https://github.com/hexonet/whmcs-ispapi-registrar/commit/bbd777cae99b0eee62bf3e57e9e2e2e3916a0344))

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
