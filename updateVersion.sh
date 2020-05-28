#!/bin/bash

# THIS SCRIPT UPDATES THE HARDCODED VERSION
# IT WILL BE EXECUTED IN STEP "prepare" OF
# semantic-release. SEE package.json

# version format: X.Y.Z
newversion="$1";
date="$(date +'%Y-%m-%d')";

sed -i "s/define(\"ISPAPI_MODULE_VERSION\", \"[0-9]\+\.[0-9]\+\.[0-9]\+\")/define(\"ISPAPI_MODULE_VERSION\", \"${newversion}\")/g" registrars/ispapi/ispapi.php
sed -i "s/\"version\": \"[0-9]\+\.[0-9]\+\.[0-9]\+\"/\"version\": \"${newversion}\"/g" release.json
sed -i "s/\"date\": \"[0-9]\+-[0-9]\+-[0-9]\+\"/\"date\": \"${date}\"/g" release.json