#!/bin/bash
PHP_VERSION="$(php -r 'echo PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION;')"
phpcs --ignore=node_modules,vendor,templates_c,modules/registrars/ispapi/lib/sdk,modules/registrars/ispapi/migration,modules/registrars/ispapi/hooks_migration --standard=PHPCompatibility -q -n --colors --runtime-set testVersion "$PHP_VERSION" registrars || exit 1;
