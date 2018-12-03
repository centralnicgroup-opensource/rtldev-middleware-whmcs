#!/bin/bash
OLDBRANCH=$(git branch | sed -n '/\* /s///p')
DEVBRANCH="$1";

git fetch origin -p &&
git checkout master -f &&
git pull &&
git checkout "$DEVBRANCH" -f &&
git pull &&
git rebase master &&
git push --force-with-lease &&
git checkout "$OLDBRANCH"
# shellcheck disable=SC2181
if [ "$?" -eq 0 ]; then
    echo "Rebase of branch next: SUCCEEDED"
else
    echo "Rebase of branch next: FAILED"
fi
exit 0