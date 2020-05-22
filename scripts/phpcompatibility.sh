#!/bin/bash
phpcs --ignore=registrars/ispapi/lib --standard=PHPCompatibility -q -n --colors --runtime-set testVersion 5.6 registrars || exit 1;
phpcs --ignore=registrars/ispapi/lib --standard=PHPCompatibility -q -n --colors --runtime-set testVersion 7.2 registrars || exit 1;
phpcs --ignore=registrars/ispapi/lib --standard=PHPCompatibility -q -n --colors --runtime-set testVersion 7.3 registrars || exit 1;