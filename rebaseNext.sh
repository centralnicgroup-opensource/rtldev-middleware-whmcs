#!/bin/bash
OLDBRANCH=$(git branch | sed -n '/\* /s///p')
git fetch origin -p &&
git checkout master -f &&
git checkout next -f &&
git rebase master &&
git push &&
git checkout "$OLDBRANCH"
exit "$?";

#      {
#        "path": "@semantic-release/exec",
#        "cmd": "./rebaseNext.sh"
#      }