#!/bin/bash
OLDBRANCH=$(git branch | sed -n '/\* /s///p')
DEVBRANCH="$1";

git fetch origin -p
git checkout master -f &&
git pull &&
git checkout "$DEVBRANCH" -f &&
git pull &&
git rebase master &&
git push --force-with-lease
git checkout "$OLDBRANCH"
exit "$?";