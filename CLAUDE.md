# Project Instructions

## Project Overview

Public distribution repository for the CentralNic WHMCS integrations: built zip archives and
release metadata, no source. Its content is pushed here by the release of the private
`centralnicgroup/rtldev-middleware-whmcs-src` repository, where all module code lives.

- **Contents:** the CNIC software bundle (`whmcs-cnic-bundle.zip`), the `cnic1`/`cnic2`
  wrapper, Internet.bs, Moniker and TPP registrar archives, plus `HISTORY.md`, `README.md`,
  `LICENSE`, `COPYRIGHTS`, `release.json` and `.htaccess_sample`
- **Default branch:** `main`

## Architecture

- **Two products, two tags.** The CNIC bundle releases as `v<version>`; Internet.bs and
  Moniker release together as `ibs-moniker-<version>`.
- **The publish owns most files.** `whmcs-cnic-bundle.zip`, `HISTORY.md`, `README.md`,
  `LICENSE`, `COPYRIGHTS`, `release.json`, `.htaccess_sample` and the
  `whmcs-ibs-`/`whmcs-moniker-registrar-latest.zip` archives are overwritten on every
  release. Change them in whmcs-src, never here.
- **TPP is manual.** `whmcs-tpp-registrar-latest.zip` is a deprecated, manually maintained
  download outside the automated release.
- **So are the wrappers.** `whmcs-cnic1-wrapper-registrar-latest.zip` and
  `whmcs-cnic2-wrapper-registrar-latest.zip` are not in `distributionRepo.files`; they are
  built by whmcs-src's `scripts/release-cli.js wrapper-archives` and committed by hand.
- **Releases here are cut only by distribution commits.** The nested semantic-release run
  counts only commits scoped `cnic-distribution` or `ibs-moniker-distribution`, which the
  whmcs-src release creates.

## Build, CI & Policies

- **No CI, build or tests in this repository.** Build, IonCube encryption, tests and
  release run in whmcs-src (`build-release.yml`), which checks this repository out as
  `public-repo` and pushes over the `RTLDEV_MW_CI_DIST_SSH_KEY` deploy key.
- **A publish writes `.releaserc.mjs` and `release-products.json` here temporarily** for its
  nested semantic-release run (`releaserc`/`releaseConfigFiles` in whmcs-src's
  `release-products.json`). Never commit either, nor the git-ignored `.releaserc.json` or
  `build`.
- **Large history.** Every release commits new zip archives; never run a command that reads
  every historical blob (`git log -p`, `git grep <rev>`, `git fsck`).

## Git Conventions

- **Commit messages:** Conventional Commits with **mandatory scope** —
  `<type>(<scope>): <summary>`. Never append a `Co-Authored-By:` trailer.
- **Never use the scopes `cnic-distribution` or `ibs-moniker-distribution` by hand** — a
  `feat`/`fix` with either scope is counted as a release by the next publish.
- **Branch creation:** before creating a branch, and again after any PR merges,
  run `git checkout main && git pull --ff-only` first — it brings in the merged
  commits and their release tags. Never branch from a stale local `main`, from
  `origin/main` (it becomes the new branch's upstream) or from another feature
  branch.
- **Branch naming:** prefix with the Jira issue ID — `RSRMID-1234-short-description`.
- **Pull requests:** include the Jira issue link in the description; after opening, add the
  PR URL as a comment on the Jira issue.
- **Merging:** rebase-merge (`gh pr merge --rebase`). Squash merges are disabled at the
  repository level.

## Atlassian / JIRA

Work is tracked in **Jira Cloud**, project `RSRMID` — not GitHub Issues. Load the
`jira-conventions` skill before creating, editing or transitioning an issue: it carries the
required fields, this repository's title prefix and component, and the worklog rule for Done and Cancelled.

Two of its rules apply whether or not the skill is loaded:

- Write every Jira issue key as a link to the issue, never bare:
  `[RSRMID-1234](https://centralnic.atlassian.net/browse/RSRMID-1234)`.
  Branch names and commit messages keep the bare key.
- Once an issue's last pull request has merged and its worklog is in, close it
  without asking if nothing is left — the skill lists what counts.

## Do NOT

- Add `Co-Authored-By:` trailers to commit messages
- Hand-edit a file the whmcs-src release publishes — the next release overwrites it
- Add source code, a build or a CI workflow here — it belongs in whmcs-src
- Decrypt or reverse-engineer the encrypted CNIC bundle — its licence forbids it (see
  `README.md`)
