#!/bin/bash

# THIS SCRIPT UPDATES THE HARDCODED VERSION
# IT WILL BE EXECUTED IN STEP "prepare" OF
# semantic-release. SEE package.json

# version format: X.Y.Z
newversion="$1"
date="$(date +'%Y-%m-%d')"

printf -v sed_script 's/define("ISPAPI_MODULE_VERSION", "[0-9]\+\.[0-9]\+\.[0-9]\+")/define("ISPAPI_MODULE_VERSION", "%s")/g' "${newversion}"
sed -i -e "${sed_script}" registrars/ispapi/ispapi.php

printf -v sed_script 's/"ISPAPI v[0-9]\+\.[0-9]\+\.[0-9]\+"/"ISPAPI v%s"/g' "${newversion}"
sed -i -e "${sed_script}" registrars/ispapi/whmcs.json

printf -v sed_script 's/"version": "[0-9]\+\.[0-9]\+\.[0-9]\+"/"version": "%s"/g' "${newversion}"
sed -i -e "${sed_script}" release.json

printf -v sed_script 's/"date": "[0-9]\+-[0-9]\+-[0-9]\+"/"date": "%s"/g' "${date}"
sed -i -e "${sed_script}" release.json
