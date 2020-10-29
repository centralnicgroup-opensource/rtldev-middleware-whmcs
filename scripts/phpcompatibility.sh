#!/bin/bash
PHP_VERSION="$(php -r 'echo PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION;')"
phpcs --ignore=registrars/ispapi/lib,registrars/ispapi/migration,registrars/ispapi/hooks_migration --standard=PHPCompatibility -q -n --colors --runtime-set testVersion "$PHP_VERSION" registrars || exit 1;
