# WHMCS "ISPAPI" Registrar Module #

[![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/semantic-release/semantic-release)
[![Build Status](https://travis-ci.org/hexonet/whmcs-ispapi-registrar.svg?branch=master)](https://travis-ci.org/hexonet/whmcs-ispapi-registrar)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PRs welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](https://github.com/hexonet/whmcs-ispapi-registrar/blob/master/CONTRIBUTING.md)

This Repository covers the WHMCS Registrar Module of HEXONET. It provides the following features in WHMCS:

## Supported Features ##

* TLD Pricing Import/Sync (WHMCS 7.10)
* Domain Registration
  * Additional domain fields (default configurations integrated!)
* Domain Transfer (with AuthInfo code support)
* Domain Management
  * Domain locking
  * Update Contact Information (with UTF-8 support)
  * Change Nameservers
  * Nameserver Registration (Add, Modify, Delete)
  * Explicit Deletions supported in Admin panel
* Domain Renewal
  * Special handling for registries without explicit renewals (many ccTLDs)
* DNS Management
  * Record-Types: A, AAAA, MX, MXE, CNAME, TXT
  * Allows user defined TTL values and MX priorities
* Email forwarding
* URL forwarding
  * Redirect using HTTP
  * Forward using HTML Frame
* Optional TLS/SSL for API connection
  * Supports proxy server for accelerated API access
* Support for testing environment
* WHOIS Privacy management of .CA domain names
* Change of Registrant for .CA / .IT domain names
* Support for WHOIS Privacy / ID Protection
  * Uses privacy service WHOISTRUSTEE.com
  * ID Protection toggle in Admin area gets synchronized
  * Client area WHOIS Privacy management
* Support for all bulk update operations
* Support for IDNs
  * automatically selects IDNA2008 if supported by TLD (e.g. .de)
  * uses API based IDN conversion by default
  * can be configured to use PHP method instead
* Support for new domain sync method (_Sync)
  * Workaround for ccTLDs that need to get renewed before expiration
* Support for .SWISS registrations
* Support for SRV records
* Support for DNSSEC Management
* Auto-Prefill additional domain fields
  * VAT ID
  * DK Hostmaster User ID
  * Contact Language (.ca)

... and MORE!

## Resources ##

* [Usage Guide](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Usage-Guide)
* [Release Notes](https://github.com/hexonet/whmcs-ispapi-registrar/releases)
* [Development Guide](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Development-Guide)

NOTE: We introduced sematic-release starting with v1.0.63. This is why older Release Versions do not appear in the [current changelog](https://github.com/hexonet/whmcs-ispapi-registrar/blob/master/HISTORY.md). But these versions appear in the [release overview](https://github.com/hexonet/whmcs-ispapi-registrar/releases) and in the [old changelog](https://github.com/hexonet/whmcs-ispapi-registrar/blob/master/HISTORY.old).

**If you have any issue related to this module, please take a look at the FAQs [here](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/FAQs). If you can't find help in the FAQs feel free to contact our support team.**

## Usage Guide ##

Download the ZIP archive including the latest release version [here](https://github.com/hexonet/whmcs-ispapi-registrar/raw/master/whmcs-ispapi-registrar-latest.zip).

Read the following to get more information ...

* [Installation](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Usage-Guide#installation)
* [Configuration](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Usage-Guide#configuration)
* [Cronjob configuration](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Usage-Guide#cronjob-configuration)

## Minimum Requirements ##

For the latest WHMCS minimum system requirements, please refer to
[https://docs.whmcs.com/System_Requirements](https://docs.whmcs.com/System_Requirements)

## Contributing ##

Please read [our development guide](https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Development-Guide) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors ##

* **Anthony Schneider** - *development* - [AnthonySchn](https://github.com/anthonyschn)
* **Kai Schwarz** - *development* - [PapaKai](https://github.com/papakai)
* **Tulasi Seelamkurthi** - *development* - [Tulsi91](https://github.com/tulsi91)

See also the list of [contributors](https://github.com/hexonet/whmcs-ispapi-registrar/graphs/contributors) who participated in this project.

## License ##

This project is licensed under the MIT License - see the [LICENSE](https://github.com/hexonet/whmcs-ispapi-registrar/blob/master/LICENSE) file for details.

[HEXONET GmbH](https://hexonet.net)
