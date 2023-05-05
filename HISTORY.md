## [17.1.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.1.0...v17.1.1) (2023-05-05)


### Bug Fixes

* **cnic registrar module:** fix PHP Error in Aavailability Check ([b83ed76](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b83ed761d4670f673ecbf2eebe34889af7859c15)), closes [#249](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/249)

# [17.1.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.17...v17.1.0) (2023-05-03)


### Bug Fixes

* **cnic registrar module:** fix .app additional domain fields ([ebf998c](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ebf998c4882bfe83e580c3d7999d69bc1fb732a9))
* **cnic registrar module:** fix not skipping contacts on transfer when using migrator ([b354297](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b3542972e0d1ef1f24ed396b983e5a3053ac13a1))


### Features

* **cnic registrar:** show warning in DNS Management page if nameservers do not point to KeyDNS ([d64d656](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d64d656ebbfdb46f29aacff4dec172da3d983d48))
* **templates:** include child templates for improving DNS management ([9c97cec](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/9c97cece9b5d83d53d2931301f942d6126eaafff))

## [17.0.17](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.16...v17.0.17) (2023-05-02)


### Bug Fixes

* **ispapi registrar module:** DomainTransferSync > getContactDetailsWHMCS error fix ([afe63d9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/afe63d96ef650aeba3d1e4a89324ae2250abe3ae))
* **ispapi registrar module:** function hook_transliterate conflict fix ([0b592e3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0b592e388b44a0bd09c516f9c53b6aa4b40c02c6))

## [17.0.16](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.15...v17.0.16) (2023-04-28)


### Bug Fixes

* **ispapi registrar module:** fix IRTP Lock output ([27d954d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/27d954d792a6e25f0475d497c5d550f0c2dd82d2))

## [17.0.15](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.14...v17.0.15) (2023-04-28)


### Bug Fixes

* **ispapi registrar module:** review .eu fields (country of citizenship dropped for companies) ([16551fc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/16551fcf0f53c41465eff5b1407e07a9d1d67fbf))

## [17.0.14](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.13...v17.0.14) (2023-04-27)


### Bug Fixes

* **ispapi registrar module:** patch GetEPPCode implementation for .eu ([82858bc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/82858bcf25e98bdd277bd782eccb7bc50a5b11c5))

## [17.0.13](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.12...v17.0.13) (2023-04-26)


### Bug Fixes

* **ispapi registrar module:** final patch for Transfer-related Buttons in Admin Area ([5f7484d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/5f7484d27cb0e8bb24cd844d3b0d956fd96734ed))

## [17.0.12](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.11...v17.0.12) (2023-04-26)


### Bug Fixes

* **ispapi registrar module:** buttons related to Pending Transfer not showing ([fe70482](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fe70482b1d1780ab9133cb9745a0aa0e50073ab5))

## [17.0.11](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.10...v17.0.11) (2023-04-24)


### Bug Fixes

* **ispapi registrar module:** patch Domain Sync for WHMCS7 (laravel query builder) ([0bb3e18](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/0bb3e1891e6a44bb8f8812cbe1ab549338935fec))

## [17.0.10](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.9...v17.0.10) (2023-04-24)


### Bug Fixes

* **ispapi registrar module:** patch system-internal transfer (USERTRANSFER) ([06c89a4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/06c89a45268f30bcf6f05872a3a39bcbf9d44c74))

## [17.0.9](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.8...v17.0.9) (2023-04-21)


### Bug Fixes

* **cnr + ispapi registrar module:** patch grace & redemption fees ([8ae6fae](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8ae6faedf2ed53971e9f609817e7b49f78f2605e)), closes [#248](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/issues/248)

## [17.0.8](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.7...v17.0.8) (2023-04-19)


### Bug Fixes

* **cleanup:** assets cleanup ([1fa0564](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/1fa05645b2ad4c213750ff55e3461b076351418e))

## [17.0.7](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.6...v17.0.7) (2023-04-18)


### Bug Fixes

* **cnic registrar module:** keep additional fields related files unencrypted ([f245232](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f2452324b8b8e13147b829e00d732fb095ee3667))

## [17.0.6](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.5...v17.0.6) (2023-04-17)


### Bug Fixes

* **ispapi registrar module:** .dk sync: status cancelled requires active as true ([96d4abf](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/96d4abf3f40f25b810efc7e8ba76d31a9e74e09f))

## [17.0.5](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.4...v17.0.5) (2023-04-17)


### Bug Fixes

* **ispapi registrar module:** .dk domain sync: switch to cancelled in case of status PENDINGDELETE ([7c3b94d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/7c3b94d167fc5b640fde20b063a5fb0aeb5383c2))

## [17.0.4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.3...v17.0.4) (2023-04-17)


### Bug Fixes

* **ispapi+cnic registrar module:** review output of Transfers (GetDomainInformation) ([104784d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/104784dcb5b8bc66299224c01d2f9d27c6bbd309))

## [17.0.3](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.2...v17.0.3) (2023-04-14)


### Bug Fixes

* **cnic registrar:** revamped additional fields for *.au tld ([23b44b2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/23b44b2f55e51054fffd3c68ed3a14fb19b465d2))

## [17.0.2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.1...v17.0.2) (2023-04-14)


### Bug Fixes

* **cnic registrar module:** fix for Resend transfer email and cancel domain transfer buttons ([8c55d86](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/8c55d86cc41df18bb1c4ada6ef56acc9cce4be4e))
* **cnic registrar:** add required additional field for .app tld ([b4e96de](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b4e96de984bc09a3dd85a79c0de2274a573f6df2))

## [17.0.1](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v17.0.0...v17.0.1) (2023-04-05)


### Bug Fixes

* **cnic registrar module:** avoid changing nameservers when activating dns zone ([f8666de](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/f8666de5e3685703a9e6457de22f1aa9e140fce4))

# [17.0.0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.23...v17.0.0) (2023-04-05)


### Bug Fixes

* **cnic domain importer:** support CentralNic Reseller Module as Registrar in Dropdown List ([b88a067](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/b88a06735c06f448ef6c3c3a7bee041854b4b6d2))
* **cnr registrar module:** patch integration of special admin area buttons ([371d35f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/371d35f34916668fb960c4db8af8b5ff55fbd42f))
* **cnr/ispapi registrar modules:** upgrade to v8.0.5 of connector library (curlopt settings patch) ([57895fc](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/57895fc7d564c6a98616afe17c7a22cca2815068))


### Code Refactoring

* **hx reg mod:** replaced querydomainrepositoryinfo with querydomainoptions (categories) ([e18f58f](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e18f58fbd1f06669036634e4c0987045ee38d38a))


### Features

* **cnic registrar module:** show connectivity result in registrar module settings overview ([90fff84](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/90fff848be69a7da0f42e6f3e75c28ad1e1c668a))
* **cnic registrar module:** support of domain restores ([bbf201b](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/bbf201b18ad9ff72a6d45722185c2f229115a8ba))
* **cnic+ispapi registrar module:** add/review transfer precheck on shopping cart level ([fdbc119](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/fdbc119e156ceca6e40a846d271b004322b80866))
* **cnic+ispapi registrar module:** added/reviewed injection of private nameservers listing ([c4032a0](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/c4032a06312e5240af1501a7ef250cea3adf6707))
* **cnic+ispapi registrar module:** added/reviewed injection of private nameservers listing ([61bd983](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/61bd983444b332864f105f9f8e3d5a6a4b9d9a71))
* **cnr registrar module:** add "Cancel Domain Transfer" / "Resend Transfer Approval Email" buttons ([de757ef](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/de757ef8aef6a60130fbd027b8eff685adb1b7f2))
* **cnr registrar module:** added automatic/manual supension/unsuspension feature ([d5063e2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/d5063e2f8b160ef008a926ccff798fa2e084ebea))
* **ispapi registrar module:** add explicit system activity logs for NS and DNSZone RRs updates ([74a47f2](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/74a47f2305f0dd990eb2c581dcf00e1ca85884cd))
* **ispapi registrar module:** auto post-transfer contact & nameserver update extended to all TLDs ([ecb966d](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/ecb966d2f50d92a81a57aee6d6d03b1b6a40ec3c))


### BREAKING CHANGES

* **hx reg mod:** The internal data structure of TLD Settings got extended. Please execute the following SQL Query to avoid PHP issues: ```DELETE FROM `tbltransientdata` WHERE name LIKE "ispapiZoneInfo%"```
* **ispapi registrar module:** Post-Transfer Update is no longer only covering .com/.net/.cc/.tv, but all TLDs. In addition, it first updates contact data and then doing the nameserver update. Nameserver Data is now taken out of the order in WHMCS which is faster than looking this up from transfer request. The post processing got in addition moved into a hook and isn't any longer part of the TransferSync (Separation of Concerns).

## [16.15.23](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.22...v16.15.23) (2023-03-31)


### Bug Fixes

* **ispapi registrar module:** dropped email check in contact data update mechanism after transfer ([e77a689](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/e77a68973e2322b98980c7fc56fdefc42bbe1435))

## [16.15.22](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.21...v16.15.22) (2023-03-31)


### Bug Fixes

* **cnic migrator addon:** drop whois data lookup; problematic in case of active id protection ([19a7b44](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/19a7b442dd2560a9d200b7bb9563f8c49e9eac58))

## [16.15.21](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/compare/v16.15.20...v16.15.21) (2023-03-29)


### Bug Fixes

* **ispapi:** fix for requesting authcode for .de domains via whmcs ([66657b4](https://github.com/centralnicgroup/rtldev-middleware-whmcs-src/commit/66657b4984863c9fb354c2f5df5eaf08e88aff01))

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
