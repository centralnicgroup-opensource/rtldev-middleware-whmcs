---
name: jira-conventions
description: "RSRMID Jira conventions — the fields every issue needs (Work Category, Business Unit, Team, Components), this repository's `[COMPONENT][BU]: ` title prefix, choosing the parent epic, the Markdown description format, and the worklog rule for Done and Cancelled. Load before creating, editing, or transitioning a Jira issue."
---

<!-- markdownlint-disable -->
<!-- prettier-ignore-start -->

# Atlassian / JIRA

<!--
Everything outside the jira-conventions:repository markers is identical in every
repository and comes from rtldev-middleware-template. The block between them is rendered
from .github/jira-skill.tsv in rtldev-middleware-workspace. Change either there — a weekly
job in the workspace fails on any copy that differs. The prettier-ignore region keeps the
copies byte-identical under every repository's own prettier config.
-->

<!-- jira-conventions:repository:begin -->

## This Repository

- **Title prefix:** `[WHMCS][<BU>]: `
- **Component:** WHMCS SW Bundle (`10254`)
- Use the component WHMCS IBS/Moniker (`10257`) instead when the Business Unit is Internet.bs or Moniker.

<!-- jira-conventions:repository:end -->

## Project

- **Cloud ID:** `4e50e119-d5ea-4f89-afb1-d4cd47e40177`
- **Site:** centralnic.atlassian.net
- **Jira project key:** RSRMID (3rd-party Software Integrations / Middleware)
- **Issue types:** Task (`10002`), Bug (`10004`), Story (`10001`), Sub-task (`10003`),
  Discovery (`11174`), Cybersecurity (`12171`), Epic (`10000`)
- **Transitions** (global, available from any status): To Do (`11`), In Progress (`21`),
  In Review (`41`), Q&A (`61`), Ready for Deployment (`51`), Done (`31`), Stand-by (`71`),
  Cancelled (`91`)
- **Account IDs** (assignee, mentions): look them up with `lookupJiraAccountId` by name;
  never write one into a repository file — most of these repositories are public

## Fields to Set on Every Issue

Work Category and Business Unit are **required** — the create fails without them. Team,
Components and the parent epic are optional to Jira but set on every RSRMID issue.

| Field         | ID                  | Type           | Default                                                                          |
| ------------- | ------------------- | -------------- | -------------------------------------------------------------------------------- |
| Work Category | `customfield_12383` | select         | `13286` — Tech Debt                                                              |
| Business Unit | `customfield_10027` | multi-checkbox | `10187` — CentralNic Reseller                                                    |
| Team          | `customfield_10001` | Atlassian team | `3a19b075-e025-44c3-b3e8-af1a958bc36f` — Channel 3rd Party Software Integrations |
| Components    | `components`        | component list | see [This Repository](#this-repository)                                          |
| Parent        | `parent`            | epic           | see [Parent Epic](#parent-epic)                                                  |

Work Category options: `13284` — Strategic, `13285` — Maintain Revenue /BAU, `13286` — Tech Debt,
`13287` — Security. **Default to Tech Debt** unless told otherwise.

Business Unit options in use here (the field offers ~30, most belong to other teams):

| ID      | Value               | Prefix abbreviation |
| ------- | ------------------- | ------------------- |
| `10187` | CentralNic Reseller | `CNR`               |
| `10050` | Internet.bs         | `IBS`               |
| `10049` | Moniker             | `MON`               |
| `10054` | IWMN                | `IWMN`              |

**Default to CentralNic Reseller.**

Team is the Atlassian Team field. The separate `Team/s` checkbox field (`customfield_10050`) is set
**only on a Story**, to `10162` — Channel - 3rd Party Apps: `"customfield_10050": [{ "id": "10162" }]`.
Leave it unset on every other issue type.

Pass the fields in `additional_fields`, e.g. for a Task:

```json
{
  "customfield_12383": { "id": "13286" },
  "customfield_10027": [{ "id": "10187" }],
  "customfield_10001": "3a19b075-e025-44c3-b3e8-af1a958bc36f",
  "components": [{ "id": "<component id>" }]
}
```

## Issue Titles

`[<COMPONENT>][<BU>]: <summary>` — e.g. `[WHMCS][CNR]: DNS save in client area wipes NS records`.

The prefix and the component follow from **the repository the fix lands in**, not from where the
problem was found. For a fix in this repository, take both from [This Repository](#this-repository).
For a fix that lands elsewhere, use that repository's — its own copy of this skill names them, and
rtldev-middleware-workspace's copy lists every repository.

**BU** is the abbreviation of the Business Unit field. Several units go in one bracket separated by
`/`: `[WHMCS][IBS/MON]: `.

Older RSRMID titles use a plain `<scope>: ` prefix (`node-sdk: `, `Workspace: `, `CI: `) — don't copy
a title from an old ticket.

## Parent Epic

Every issue gets a parent epic. Epics are per year, so never reuse a key from memory or from an old
ticket — look them up:

```
project = RSRMID AND issuetype = Epic AND statusCategory != Done ORDER BY created DESC
```

Suggest the best match from that list and confirm it before creating the issue. The usual choices:

- `[RSRMID] Tech Debt <year>` — the default for tooling, CI, dependency and maintenance work
- `[RSRMID] Customer Support <year>` — customer escalations
- `[RSRMID] Capitalisable Tasks <year>` — when told the work is capitalisable
- a feature epic, when the work belongs to one

## Description Format

Always pass `contentFormat: "markdown"` explicitly on `createJiraIssue` / `editJiraIssue` — the
tool's default varies — and write the description in **Markdown**, not Jira wiki markup. Jira stores
it as ADF either way; Markdown is the cheaper way to say it. Wiki markup passed under `markdown` is
stored verbatim and renders as literal text.

| Use (Markdown)         | Not (wiki markup)      |
| ---------------------- | ---------------------- |
| `### Heading`          | `h3. Heading`          |
| `**bold**`, `_italic_` | `*bold*`, `__italic__` |
| `` `mono` ``           | `{{mono}}`             |
| triple-backtick fence  | `{code}` … `{code}`    |
| `- item`               | `* item`               |

Use real newline characters in the string, never `\n` escape sequences — those pass through as
plain text and have no formatting effect.

Square brackets are Markdown link syntax, so a bare `[WHMCS][CNR]`-style prefix quoted inside a
description gets escaped. Either wrap it in backticks or drop the brackets when referring to another
issue's title.

## Closing an Issue: Done or Cancelled

Neither **Done** nor **Cancelled** holds without a worklog — automation stamps
`missing-time-spent` and reopens the issue. That includes a cancelled issue nobody worked on:
log the time spent finding that out. Sequence: (1) add a worklog, asking for the amount when it
is not obvious; (2) remove the `missing-time-spent` label if present; (3) transition to Done
(`31`) or Cancelled (`91`).

After opening a pull request for an issue, add the PR URL to the issue as a comment.

<!-- prettier-ignore-end -->
