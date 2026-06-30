# WHMCS Integrations

[![Latest Release](https://img.shields.io/github/v/release/centralnicgroup-opensource/rtldev-middleware-whmcs)](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/releases)
[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](CONTRIBUTING.md)
[![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/semantic-release/semantic-release)
[![GitHub Closed Issues](https://img.shields.io/github/issues-closed/centralnicgroup-opensource/rtldev-middleware-whmcs)](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/issues?q=is%3Aissue+is%3Aclosed)
[![Contributors](https://img.shields.io/github/contributors/centralnicgroup-opensource/rtldev-middleware-whmcs)](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/graphs/contributors)
[![GitHub Stars](https://img.shields.io/github/stars/centralnicgroup-opensource/rtldev-middleware-whmcs)](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/stargazers)

WHMCS registrar modules and domain management addons for **Team Internet Group PLC** brands. Includes a full-featured software bundle for CentralNic Reseller and standalone registrar modules for Internet.bs and Moniker.

---

## Contents

- [Key Features](#key-features)
- [Registrar Modules](#registrar-modules)
- [WHMCS CNIC Software Bundle](#whmcs-cnic-software-bundle)
  - [Included Addons](#included-addons)
  - [Quick Start](#quick-start)
- [Resources](#resources)
- [Support](#support)
- [Maintainers](#maintainers)
- [License](#license)

---

## Key Features

- **All-in-one, inside WHMCS** — Domains, DNS, DNSSEC, and SSL are managed directly from the WHMCS admin and client area, with no separate control panel to learn or maintain.
- **Fewer failed orders** — TLD-aware additional-field handling and validation for demanding TLDs (such as `.de`, `.us`, and `.dk`) and IDNs, so registrations and transfers go through the first time.
- **Self-service DNS & DNSSEC** — Customers manage their own DNS records and DNSSEC keys directly from the client area.
- **Multi-account & localized** — Run multiple CentralNic Reseller accounts or brand variants side by side, with admin and client workflows available in 8 languages.

---

## Registrar Modules

| Brand | WHMCS Module ID | Status | Download | Docs |
|---|---|---|---|---|
| CentralNic Reseller | `cnic` | ![maintained](https://img.shields.io/badge/MAINTAINED-green.svg) | [📦 Bundle](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/main/whmcs-cnic-bundle.zip) | [📘 Docs](https://support.centralnicreseller.com/hc/en-gb/sections/13438422570781-WHMCS) |
| CentralNic Reseller Wrapper 1 | `cnic1`* | ![maintained](https://img.shields.io/badge/MAINTAINED-green.svg) | [📦 Download](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/refs/heads/main/whmcs-cnic1-wrapper-registrar-latest.zip) | [📘 Docs](https://support.centralnicreseller.com/hc/en-gb/sections/13438422570781-WHMCS) |
| CentralNic Reseller Wrapper 2 | `cnic2`* | ![maintained](https://img.shields.io/badge/MAINTAINED-green.svg) | [📦 Download](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/refs/heads/main/whmcs-cnic2-wrapper-registrar-latest.zip) | [📘 Docs](https://support.centralnicreseller.com/hc/en-gb/sections/13438422570781-WHMCS) |
| Internet.bs | `ibs` | ![maintained](https://img.shields.io/badge/MAINTAINED-green.svg) | [📦 Download](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/refs/heads/main/whmcs-ibs-registrar-latest.zip) | [📘 Docs](https://faq.internetbs.net/hc/en-gb/articles/13828327871773-WHMCS-Registrar-Module) |
| Moniker | `moniker` | ![maintained](https://img.shields.io/badge/MAINTAINED-green.svg) | [📦 Download](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/refs/heads/main/whmcs-moniker-registrar-latest.zip) | [📘 Docs](https://support.moniker.com/hc/en-gb/articles/24649624856349-WHMCS-Registrar-Module) |
| TPP Wholesale | `tppwregistrar` | ![deprecated](https://img.shields.io/badge/DEPRECATED-red.svg) | [📦 Download](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/refs/heads/main/whmcs-tpp-registrar-latest.zip) | [📘 Docs](https://www.tppwholesale.com.au/whmcs/) |

**`*` Wrapper modules** — `cnic1`, `cnic2`, and any additional `cnicN` wrappers allow running multiple CentralNic Reseller accounts or brand variants side by side within one WHMCS installation. Install each wrapper by extracting the archive so the resulting path is `modules/registrars/cnicX`. If extracted elsewhere, the module will not be detected by WHMCS.

> **TPP Wholesale** was deprecated on **March 12, 2026**. A replacement module is now shipped with WHMCS. Please report any issues directly to WHMCS.

---

## WHMCS CNIC Software Bundle

The **WHMCS CNIC Software Bundle** is a comprehensive solution for managing domains, DNS, and SSL certificates within WHMCS. Developed by **Team Internet Group PLC**, it integrates with CentralNic Reseller to provide an all-in-one platform for domain resellers.

[**Download the latest bundle →**](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/main/whmcs-cnic-bundle.zip)

### Included Addons

| Addon | Description |
|---|---|
| **Domain Search** | Fast domain discovery with suggestions, bulk search, and premium domain support. |
| **Domain Importer** | Bulk import existing domains from CentralNic brands or other registrar sources. |
| **Domain Migrator** | Seamlessly transfer domains between registrars with minimal disruption. |
| **Domain Monitoring** | Real-time tracking and alerts for domain status changes and upcoming expirations. |
| **DNS Templating** | Apply predefined DNS record templates across multiple domains for consistent setup. |
| **DNS Manager** ![updated](https://img.shields.io/badge/Updated-orange.svg) | Full DNS record management with DNSSEC key support — view DS records and key status, copy values in one click, and perform KSK rollovers. Redesigned editing flow with copy-to-clipboard and inline validation. |
| **SSL Provisioning** | Automated SSL certificate ordering, issuance, and renewal management. |
| **CNIC Admin Config** | Manage default values for additional domain fields and advanced registrar settings. |

> The **Backorder Addon** is currently being revamped and is temporarily excluded from this bundle.

For the latest features and fixes, see the [Release Notes](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/releases).

### Quick Start

1. [Download the latest bundle](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/raw/main/whmcs-cnic-bundle.zip).
2. Extract the archive and upload the contents to your WHMCS `/modules` directory.
3. Follow the [Installation Guide](https://support.centralnicreseller.com/hc/en-gb/sections/13438422570781-WHMCS) to complete setup.
4. Enable and configure modules and addons through the WHMCS admin interface.

---

## Resources

| Resource | Link |
|---|---|
| CentralNic Reseller WHMCS Docs | [support.centralnicreseller.com](https://support.centralnicreseller.com/hc/en-gb/sections/13438422570781-WHMCS) |
| Internet.bs WHMCS Docs | [faq.internetbs.net](https://faq.internetbs.net/hc/en-gb/articles/13828327871773-WHMCS-Registrar-Module) |
| Moniker WHMCS Docs | [support.moniker.com](https://support.moniker.com/hc/en-gb/articles/24649624856349-WHMCS-Registrar-Module) |
| Release Notes | [GitHub Releases](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/releases) |
| Bug Reports & Feature Requests | [GitHub Issues](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/issues) |

---

## Support

- **CentralNic Reseller**: [support.centralnicreseller.com](https://support.centralnicreseller.com/)
- **Internet.bs**: [faq.internetbs.net](https://faq.internetbs.net/)
- **Moniker**: [support.moniker.com](https://support.moniker.com/)
- **GitHub Issues**: [Report a bug or request a feature](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/issues)

---

## Maintainers

| Name | Role | GitHub |
|---|---|---|
| Kai Schwarz | Team Lead | [@KaiSchwarz-cnic](https://github.com/KaiSchwarz-cnic) |
| Asif Nawaz | Developer | [@AsifNawaz-cnic](https://github.com/AsifNawaz-cnic) |
| Sebastian Vassiliou | Developer | [@SebastianVassiliou-cnic](https://github.com/SebastianVassiliou-cnic) |

---

## License

The **WHMCS CNIC Software Bundle** is closed source. You may use the encrypted addons freely, but decrypting, reverse engineering, or otherwise attempting to access the underlying source code is strictly prohibited.

The **Internet.bs**, **Moniker**, and **TPP Wholesale** registrar modules are available separately under the [MIT License](LICENSE). They are not included in the CNIC bundle.

See the [LICENSE](https://github.com/centralnicgroup-opensource/rtldev-middleware-whmcs/blob/master/LICENSE) file for full terms.

---

Developed and maintained by [**Team Internet Group PLC**](https://teaminternet.com).
