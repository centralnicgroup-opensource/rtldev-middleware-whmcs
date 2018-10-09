#!/bin/bash

# THIS SCRIPT UPDATES THE HARDCODED VERSION
# IN /registrars/ispapi/ispapi.php
# IT WILL BE EXECUTED IN STEP "prepare" OF
# semantic-release. SEE package.json

# git version format: vX.Y.Z
# file version format: X.Y.Z
# -> remove leading "v" of tag version
newversion="${1:1}";
branch="$2";

if [ "$branch" = "master" ]; then
    oldversion="$(git fetch origin --tags >/dev/null && git describe --abbrev=0 --tags)";
    #remove leading "v" of tag version
    oldversion="${oldversion:1}";
    sed -i 's/'"$oldversion"'/'"$newversion"'/g' registrars/ispapi/ispapi.php
fi;