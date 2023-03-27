## [16.15.20](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.19...v16.15.20) (2023-03-27)


### Bug Fixes

* **cnic:** fallback to expiration date if paid date is not returned from API ([6f2c6c2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6f2c6c21551d395f27450eb26882ae01566bd9a4))

## [16.15.19](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.18...v16.15.19) (2023-03-24)


### Bug Fixes

* **cnic:** set cancelled domains to default renewal mode in pre cron check ([cd108a3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cd108a3bc0c528c8562f8d92c0346fff7b1980c8))

## [16.15.18](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.17...v16.15.18) (2023-03-24)


### Bug Fixes

* **cnic:** use correct expiration date in daily cron ([93a6ca8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/93a6ca8e2508a4528e43de67cd7b98e2fd8a7b31))

## [16.15.17](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.16...v16.15.17) (2023-03-17)


### Bug Fixes

* **cnic migrator addon:** fix fieldnames consumed from GetClientsDetails ([cc4e5aa](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cc4e5aa561286c7738cb405958874e78edcce358))

## [16.15.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.15...v16.15.16) (2023-03-17)


### Bug Fixes

* **cnic migrator addon:** auto-retry transfer without contact data to improve success rate ([4d64549](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4d64549e774dd3120bf71e905b5249a5bd4bb9e1))

## [16.15.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.14...v16.15.15) (2023-03-16)


### Bug Fixes

* **cnic migrator addon:** patched whois data lookup for registrant & admin ([ae5287a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ae5287ab5b532d1ea2d80c053e847dd3446db0e0))

## [16.15.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.13...v16.15.14) (2023-03-14)


### Bug Fixes

* **cnic migration addon:** added fallback to whmcs data in case Whois Data lookup fails ([59d26af](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/59d26af016ce8c7e6df9774a02a730bec27ca4c7))

## [16.15.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.12...v16.15.13) (2023-03-06)


### Bug Fixes

* **ispapi registrar module:** migrate .AT whois disclose to hardcoded solution (non-ui solution) ([45c2fc4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/45c2fc4001cda49ed37aa7b94250c2ab8a928f14))

## [16.15.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.11...v16.15.12) (2023-03-06)


### Bug Fixes

* **ispapi registrar module:** reviewed expirydate sync of domains in redemption ([ddbbb12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ddbbb12d694334bde2486716beab5ce581a922f1))

## [16.15.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.10...v16.15.11) (2023-03-03)


### Bug Fixes

* **ispapi registrar module:** in case of a restorable domain do only return "expired" in sync ([3a6490b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3a6490bbfddeb53e39c6648eae1bb545f1c2799e)), closes [#XAT-159107](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/XAT-159107)

## [16.15.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.9...v16.15.10) (2023-03-03)


### Bug Fixes

* **migrator addon:** doing whois data lookup via localAPI; cnic: AddContact made optional ([86982cd](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/86982cd55b50321968727b92b223f1d9d6a96777))

## [16.15.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.8...v16.15.9) (2023-03-03)


### Bug Fixes

* **cnr registrar module:** exclude transfer precheck in TransferDomain integration ([c47185c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c47185cc944761dbe9e0c2866f47adcd317b2b1b))
* **cnr registrar module:** fix ClientAreaHeadOutput to only invoke function if present ([ba7cf9e](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ba7cf9e476f65c9d7148cb877cfce1c5f1e9f826))

## [16.15.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.7...v16.15.8) (2023-03-03)


### Bug Fixes

* **cnic migrator addon:** .uk: do a push via losing registrar after initiating the transfer ([319a3c3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/319a3c33e43d331fb36405e82787f9e187ca14c3))
* **cnr registrar module:** review .uk transfer (action=request); requires Push at losing Registrar ([98329f7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/98329f771f872a487620ab41c0210866772e433c))
* **ispapi registrar module:** .uk transfers using action=request (waiting for Domain Release / Push) ([92ce879](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/92ce879f3dd3b9c2f6870ce029473fd5c969a5fd))

## [16.15.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.6...v16.15.7) (2023-02-22)


### Bug Fixes

* **ispapi registrar module:** added missing additional domain fields for .boo ([c6d6095](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c6d6095f112d0327d97f1f6fe149d350c2011d57))

## [16.15.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.5...v16.15.6) (2023-02-15)


### Bug Fixes

* **ispapi registrar module:** extend messaging of .dk additional fields regarding email confirmation ([40a9d0c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/40a9d0cd4be9765ae1c0fa6179d02fc6e1698b5a))

## [16.15.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.4...v16.15.5) (2023-02-14)


### Bug Fixes

* **cnic registrar module:** fix transferlock handling ([d6ffa99](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d6ffa996bf55092904f4da9ace4f32dd6d6c2b99))

## [16.15.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.3...v16.15.4) (2023-02-14)


### Bug Fixes

* **dashboard widget:** show right versioning information after upgrade ([179ce37](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/179ce37e8fe607b26f1beaf854dd478ae928a4b0))

## [16.15.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.2...v16.15.3) (2023-02-10)


### Bug Fixes

* **migration:** fix pagination issue in upcoming migrations table ([2416fe7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2416fe7dafa50e0203ecc84d7da3a26f107ec1f0))

## [16.15.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.1...v16.15.2) (2023-02-09)


### Bug Fixes

* **cnic registrar module:** fix .se additional fields for transfer ([564e503](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/564e50305c34421bba4668fd9b80de00d4ebb4ba))

## [16.15.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.0...v16.15.1) (2023-02-09)


### Bug Fixes

* **cnic dns addon:** pHP error when loading hooks, added missing composer autoloader ([23c0050](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/23c0050285d5bcaf6502b84ee6f387c07165d436))

# [16.15.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.3...v16.15.0) (2023-02-06)


### Features

* **cnr registrar module:** support premium domain names ([d821ed9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d821ed9d0b9b2b3227d70a4996e685d7456fe3ef))

## [16.14.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.2...v16.14.3) (2023-02-06)


### Bug Fixes

* **download links:** to latest software bundle archive patched ([15a414b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/15a414b5e32000f9482eac0f42e86e9b09ddb871))

## [16.14.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.1...v16.14.2) (2023-02-03)


### Bug Fixes

* **registrars:** cleanup accidental inclusion of tpp wholesale. registrar module to be reviewed 1st ([cac5e91](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cac5e91cfb9a2767dd722a97ac88a07c9681a155))

## [16.14.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.14.0...v16.14.1) (2023-02-03)


### Bug Fixes

* **ispapi registrar module:** added .coop additional fields for contact update ([45a819b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/45a819b6c8320ec59128d1e0e62c16f79af88aa6))

# [16.14.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.13.1...v16.14.0) (2023-01-30)


### Features

* **reg hx mod:** additionalfield  ID Protection support for .AT TLD ([71f2f07](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/71f2f0785722703e5c1283410d5455bbdf99f2eb))

## [16.13.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.13.0...v16.13.1) (2023-01-27)


### Bug Fixes

* **cnic pricing import:** clean code refactoring & patching & performance review ([8215d0f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8215d0fc9853562808479958dab1a129db76cd6b))

# [16.13.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.12.2...v16.13.0) (2023-01-26)


### Features

* **hx mod reg:** auto-unsuspension for renewed domains ([497d03b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/497d03b2701a171327be9738992496010d25c87c))

## [16.12.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.12.1...v16.12.2) (2023-01-26)


### Performance Improvements

* **hx reg mod:** Dynamic TLD configuration, tldmap.json file deprecated ([ddd5044](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ddd50444aeb45e1e16446887db4942b5c7008b66))

## [16.12.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.12.0...v16.12.1) (2023-01-25)


### Bug Fixes

* **cnr:** fix smarty error in renewal protection notification email ([0cb0bb3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0cb0bb35ac7b1946de9136fbbd110080edeb3283))

# [16.12.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.11.0...v16.12.0) (2023-01-23)


### Bug Fixes

* **hx registrar:** additional fields for .giving ([0a6add5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0a6add5403edb593ace70caabfb413dce12761e2))
* **registration:** fix registration failing for some tlds not supporting transfer lock ([503b2f0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/503b2f0ff1e8e2eedf2507637d9750fb70e99016))


### Features

* **cnic:** hide transfer lock from Client Area if TLD does not support it ([988fd06](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/988fd06526450e37598e3a072dad59cb63151f07))

# [16.11.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.10.2...v16.11.0) (2023-01-20)


### Features

* **domain checker:** add possibility for subscribing to availability checks ([8a2f63b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8a2f63b2be898c6c20213d440d8c721e0e2eeb49))

## [16.10.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.10.1...v16.10.2) (2023-01-19)


### Bug Fixes

* **cnic:** add support for old WHMCS v7 ([0946a86](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0946a867fdb92c3ba6b698cd4eaf97b2685e0eaa))

## [16.10.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.10.0...v16.10.1) (2023-01-19)


### Bug Fixes

* **hx domainchecker:** add missing markup to renewal price for premium domains ([ba93e12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ba93e12525cd7e4091c76ce86a94caf6ae5c9daf))
* **hx domainchecker:** update number of items in shopping cart ([db30f82](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/db30f8240d297d74e18b7bc2278a13d1ce81b96c))

# [16.10.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.9.1...v16.10.0) (2023-01-10)


### Features

* **hooks:** support customs hooks by file /your/path/to/whmcs/resources/hooks_ispapi_custom.php ([25f99d8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/25f99d8f3527954d76626807b72361e23c575dfa))

## [16.9.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.9.0...v16.9.1) (2023-01-06)


### Bug Fixes

* **ispapi registrar module:** identify and use right locale for additional domain fields translation ([c78f9ce](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c78f9cef8fc29e2a71cfb6d1523bb20369cf4234))

# [16.9.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.5...v16.9.0) (2023-01-04)


### Bug Fixes

* **tweak:** front-end and error messages improvements ([c65a7c6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c65a7c6b71708d2cb6b1eeceb84f5edd00ce51bb))


### Features

* **epp-csv:** bulk Import EPP Codes via CSV file ([2b9d5eb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2b9d5ebf4a3e3b99d1174b0988ad0464e43b646f))

## [16.8.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.4...v16.8.5) (2023-01-03)


### Bug Fixes

* **assets:** review mechanism for browser cache update ([2e38f67](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2e38f675b3c9b1c8c768bd3774604e9a9bd1c50e))

## [16.8.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.3...v16.8.4) (2022-12-08)


### Bug Fixes

* **release process test:** automated publishing to WHMCS Marketplace ([2364cb4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2364cb4990ab6d665c0160c81b9769a86f125520))

## [16.8.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.2...v16.8.3) (2022-12-08)


### Bug Fixes

* **release process test:** automated publishing on WHMCS Marketplace ([0ff21bc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0ff21bc7715eb4eb805e0ef19099b2495cf26fb4))

## [16.8.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.1...v16.8.2) (2022-12-08)


### Bug Fixes

* **ispapi registrar module:** patch bug with connected web apps ([da464a8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/da464a8a198388ac85c8ebdf498153f995eec230))

## [16.8.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.8.0...v16.8.1) (2022-12-06)


### Bug Fixes

* **statistics data:** only submit cnic/ispapi addons in use (for customer support improvements) ([59901a4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/59901a4609aa73e77b65707da6e7230037c32ab4))

# [16.8.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.7.0...v16.8.0) (2022-12-01)


### Bug Fixes

* **domain search:** fadeIn/-Out transfer button in search field based on input value ([afe9348](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/afe9348d3b3f209a1b33491bb11a470d3db599fc))
* **domain search:** patch CSS of toggles (for mobile devices) ([7fb30f9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7fb30f9669b0bbd596ce3b8ae45d7d5a8f445543))
* **ispapi registrar module:** patch output of connectivity result in module settings (WHMCS 8.6) ([3411751](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3411751b4e633c88d1ea4e8bb14a73cc11d5dc6a))
* **ispapi registrar module:** web apps cfg (file-based solution not working in corner cases) ([d559c6d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d559c6db9af2ac406c77b8ad52e86c46737e4b56))


### Features

* **domain search:** configurable transfer button in search field ([0aad3a6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0aad3a6586ceb6fa8c6ac2f202d8a3f4fdd446fb))

# [16.7.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.5...v16.7.0) (2022-11-30)


### Bug Fixes

* **aftermarket domains:** consider registrar module setting in ISPAPI Domain Checker ([7b067d9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7b067d90d9b65774d5c03ffc53a9af92391d231b))
* **aftermarket domains:** review aftermarket premium domains to display with label "AFTERMARKET" ([7b32b04](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7b32b047ca7ae2403e7a0bce7ec8f6fec28cd9f3))


### Features

* **aftermarket domains:** configuration option added to registrar module (by default: off) ([af487fe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/af487fe8c6a8122e0fd166ce70203fd6889af4c1))

## [16.6.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.4...v16.6.5) (2022-11-30)


### Bug Fixes

* **domain search:** fixed issue with aftermarket pricing detection (non-premium class) ([bb54200](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bb5420019e80c694e3d64a74b8629f29a108ab76))
* **domain search:** fixed issue with currency detection and upgrade function ([95baa1c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/95baa1ceb8f128507843166102a114cb8fec71fc))
* **domain search:** update item count of shopping cart button ([8f836ea](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8f836ea48b2e9c7873c9f344d49f00fe709847d9))
* **helper library:** patched db communication wrapper ([7867ebe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7867ebe573f072b6cf6c2d071cfed08b0ed74e5f))

## [16.6.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.3...v16.6.4) (2022-11-29)


### Bug Fixes

* **php8 support:** replacing mktime() with time() ([481c178](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/481c17855879fc066444bcf49224d4e7cae639da))

## [16.6.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.2...v16.6.3) (2022-11-29)


### Bug Fixes

* **php8 support:** patched compatibility of DB Interactivity + Transactions ([3bd576c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3bd576cc04c8a4b4061482f4054ee96c7a6db3a0))

## [16.6.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.1...v16.6.2) (2022-11-23)


### Bug Fixes

* **domain-import:** premium domains import pricing fix ([97c5449](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/97c54495c2ca328103cc68359515b1ffe17ce008))
* **premium price detection:** for corner cases (probably just affecting the OT&E) patched ([19808af](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/19808af5f57ee42b527094c116dbd8809b2e0c76))

## [16.6.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.6.0...v16.6.1) (2022-11-21)


### Bug Fixes

* **widget:** quota usage Infinity (INF) percentage fix ([c4d14cb](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c4d14cbf958a94b6d4d36e9a665858f911ccd214))
* **widget:** quota usage Infinity (INF) percentage fix ([4e5a158](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4e5a158f978d24b843da91f2d41beb10d13eaf4e))

# [16.6.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.5.0...v16.6.0) (2022-11-18)


### Features

* **statistics:** extended statistics data functionality ([cac452d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cac452d993b4feaec8822ee5aa60f24daa19ff37))

# [16.5.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.4.1...v16.5.0) (2022-11-15)


### Features

* **domain checker:** support language overrides ([720d026](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/720d026c8c96accfbc719fe81974fe560db934fa))

## [16.4.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.4.0...v16.4.1) (2022-11-14)


### Bug Fixes

* **cnicmigration:** fix email template paths ([cf9d4dc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/cf9d4dcf70596c5c925f12c4fcea90e7b92ff9dd))

# [16.4.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.7...v16.4.0) (2022-11-14)


### Features

* **dashboard widget:** total request/query limit quota shown on Hexonet (Ispapi) widget ([bb1be6f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bb1be6f0ec9285b92f4c340c999579dec172bbc4))

## [16.3.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.6...v16.3.7) (2022-11-14)


### Bug Fixes

* **license:** changes to our LICENSE and COPYRIGHTS ([6a14a19](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/6a14a1907ba6aa0b6784962312b3436d6870a943))

## [16.3.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.5...v16.3.6) (2022-11-13)


### Bug Fixes

* **migration:** failure message is now displayed correctly ([a780a1a](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a780a1a49de3e31baca0f3c1069fd3a4f5a66307))

## [16.3.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.4...v16.3.5) (2022-11-11)


### Bug Fixes

* **widget:** widget styling fixes for Windows OS users ([55b35e4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/55b35e4a8d3ab2ebeccc515f08ccd84398ac572c))

## [16.3.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.3...v16.3.4) (2022-11-10)


### Bug Fixes

* **ioncube:** php version encoding bundling - fixes corrupt files ([38c80e4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/38c80e49961352bb5a2ac88fd518862bac3b7e74))
* **widgets:** widget error fixed, index.tpl not found ([1e00b77](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1e00b770da34e3e079ff611e792619bbf4d7dad9))

## [16.3.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.2...v16.3.3) (2022-11-10)


### Bug Fixes

* **translations:** patching additional fields  translation (different lang used that we don't ship) ([34ceaa2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/34ceaa2b7eb61aa062631c35d4ff76ad731fa258))

## [16.3.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.1...v16.3.2) (2022-11-09)


### Bug Fixes

* **ioncube:** fixed corrupt files issue by separating archives for php versions ([bd1c861](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bd1c86181ca43b2c376052ebdfc72e75847e6397))

## [16.3.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.3.0...v16.3.1) (2022-11-09)


### Bug Fixes

* **ioncube:** encoding order fix higher to lower ([a75d8ac](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/a75d8ac422dcc98cb914440b6ef2a386cb8342fb))

# [16.3.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.3...v16.3.0) (2022-11-08)


### Bug Fixes

* **ioncube:** support for php 8.1 and 7.4 ([792fba2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/792fba25170ab5fca3b203f467e9682acbf38c92))


### Features

* **hexonet registrar module:** post-transfer activation of DNS Management added ([df0b81b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/df0b81bf363a3194e323f39a949b3eda021462d8))

## [16.2.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.2...v16.2.3) (2022-11-07)


### Bug Fixes

* **tld-eu:** remove unnecessary parameter that prevented .eu transfers ([0ef425d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0ef425d2bb5fcfe7eeac8e83796af5a1f19863f3))

## [16.2.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.1...v16.2.2) (2022-11-07)


### Bug Fixes

* **autoloading:** autoloading fixes when modules are deactivated ([3cb4273](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/3cb4273cdb9d1862bc0a0f418111a87fbce71cd5))

## [16.2.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.2.0...v16.2.1) (2022-11-07)


### Bug Fixes

* **migrator:** Fix for migrator when fetching domain status ([f6f8f15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f6f8f15a020505778749901ebd48e18f9c9e08b2))

# [16.2.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.3...v16.2.0) (2022-11-07)


### Bug Fixes

* **cnicmigration:** fix link to documentation ([5cca1e7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5cca1e7e49623c3f969b83257f07752f9ce9e506))
* **ispapi registrar module:** extend TLD Mapping (.edu.mx <-> EDUMX) ([4ba43b5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/4ba43b58b3e0d85be11be57c9e6c70c65846f5b7))


### Features

* **cnicmigration:** show warning if email templates have not been configured ([9e3712c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9e3712c9127a1cabf69ce138090dbe142bd05965))
* **cnicssl:** add ability to download certificates ([8d438d4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8d438d415e57b22abb14e1e76f5f475da0795662))

## [16.1.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.2...v16.1.3) (2022-10-20)


### Bug Fixes

* **cnr registrar module:** patch autoloading of function in hooks.php ([44fc4d5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/44fc4d5ead6e8c202d862c5da722e7595d899ad6))

## [16.1.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.1...v16.1.2) (2022-10-20)


### Bug Fixes

* **hx registrar module:** patch autoloading of function in hooks.php ([247411d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/247411d60b2840c5975a6bd1a0e056f46a29381b))

## [16.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.1.0...v16.1.1) (2022-10-20)


### Bug Fixes

* **ispapi registrar module:** nameserver update patched ([da45fc5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/da45fc5f721429f6f5a34018491c8a6086c66d84))

# [16.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.3...v16.1.0) (2022-10-20)


### Bug Fixes

* **cnic-ssl:** fix several issues and add PHP 8.1 compatibility ([65b76e9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/65b76e9126a5f71f3528a0436151c2f24d89d370))


### Features

* **precheck addons:** automatically precheck addons on cart level page, feature added ([fdbba09](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fdbba091533b78eeb081d32e9bcf6eec418429b6))

## [16.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.2...v16.0.3) (2022-10-19)


### Bug Fixes

* **gulp:** updated encryption files list ([150e603](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/150e603df47a2257b550be21144ebc665fb64451))

## [16.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.1...v16.0.2) (2022-10-19)


### Bug Fixes

* **domainchecker:** default categories import fix, build-release workflow fix, gulp config updated ([ff4b211](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ff4b211d11e8fb34b897b984cad96b2043d39ca8))
* **ispapi domain search:** fix multi-year terms dropdown order (10Y now after 9Y) ([1918b72](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1918b72d4f9936f53ab22b250e9b85bbb2318fda))

## [16.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.0.0...v16.0.1) (2022-10-19)


### Bug Fixes

* **tld-import:** skip tlds with no pricing ([2a58dbe](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/2a58dbe304fa69b8f6651b57d1a1ad5a6d3d0041))

# [16.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v15.9.9...v16.0.0) (2022-10-18)


### chore

* **restructuring:** in direction of a software bundle ([ac88ed6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ac88ed674da7c947d5874cd263337c52d70cb1a8))


### BREAKING CHANGES

* **restructuring:** Restructuring of all repositories into a single repository. Offering several benefits to us and our resellers.

# [16.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v15.9.9...v16.0.0) (2022-10-18)


### chore

* **restructuring:** in direction of a software bundle ([ac88ed6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ac88ed674da7c947d5874cd263337c52d70cb1a8))


### BREAKING CHANGES

* **restructuring:** Restructuring of all repositories into a single repository. Offering several benefits to us and our resellers.
