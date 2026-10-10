# AGENTS.md — TypoScript Explained

## Repo structure

```
Documentation/                   # the actual manual (reST source, published to docs.typo3.org)
Build/Scripts/runTests.sh        # lint / coding-guideline runner for the included PHP files
CONTRIBUTING.md                  # how to contribute
```

## Commands

- `make docs` — render the manual locally with Docker
- `make test-docs` — render in minimal-test mode (the same validation CI runs); use this to validate any change before committing
- `pre-commit run --all-files` — apply the whitespace hooks (`trailing-whitespace`,
  `end-of-file-fixer`) configured in `.pre-commit-config.yaml`; `pre-commit install`
  wires them into `git commit`
- `make test-editorconfig` — check indentation and whitespace against
  `.editorconfig`. It runs only over code files: `.editorconfig-checker.json`
  excludes reST, because the checker cannot tell a directive body from an
  embedded code block and would flag every snippet whose indentation is not a
  multiple of four. `max_line_length` is disabled there too — it stays in
  `.editorconfig` as advice for editors, not as a gate, since reflowing prose
  is an editorial decision. Add an exclude for a file whose indentation is
  content rather than formatting: in the TypoScript multiline value example
  the leading spaces end up in the value. Never reformat an example whose
  subject is its own formatting, and check what a file's whitespace actually
  does before touching it.
- `make test-typoscript` — check the TypoScript snippets under
  `Documentation/` for syntax errors. TypoScript silently ignores whatever it
  cannot parse, so a broken example looks fine until somebody copies it: the
  check round trips each snippet through the Core tokenizer, whose output has
  to come back unchanged, and counts the opening against the closing block
  lines, because an unbalanced curly brace round trips unchanged. Exempt a
  snippet that demonstrates invalid syntax on purpose with a
  `# typoscript-lint: ignore-file` comment in its first line. Only for a file
  whose content reaches the reader verbatim, list its path in
  `Build/typoscriptLint.ignore` instead: the renderer ignores the `:lines:`
  option of `literalinclude`, so there the comment would be printed as part
  of the example.
- `make test` — full test suite (docs, lint, cgl, yaml, typoscript, json,
  editorconfig)
- `make screenshots` — take the backend screenshots listed in
  `Build/Screenshots/screenshots.mjs` from a throwaway TYPO3 instance, built
  from `.Build` (run `make install` first in a new worktree).
  `Build/Scripts/runTests.sh -s screenshots List/PagesDoktypeDifferentLabels`
  takes only the named ones. `Build/Screenshots/create-records.php` gives
  each page TSconfig example a page of its own whose TSconfig field holds
  the snippet the documentation includes, so the screenshot shows what the
  example does. A screenshot of a whole module (`window: true`) shows the
  backend 1000 px wide, so readers see where the module is in the menu: the
  page tree is hidden and every other menu group collapsed. Give it an
  `until` element to end below, so the image takes no more room on the page
  than it needs. Commit only the images that really changed.

## Documentation writing rules

Follow the official TYPO3 documentation writing conventions (see
https://github.com/TYPO3-Documentation/TYPO3CMS-Guide-HowToDocument):

1.  **reST, not Markdown** — everything under `Documentation/` is reStructuredText.
2.  **Sentence case headlines** — first word and proper nouns only:
    https://docs.typo3.org/permalink/h2document:content-styleguide-title-capitalization
3.  **4-space indentation** for directive bodies, 2 spaces after `..` markers:
    https://docs.typo3.org/permalink/h2document:cgl-indenting
4.  **Single backticks over double**, unless the content needs a literal
    backtick: https://docs.typo3.org/permalink/h2document:inline-code
5.  **Every headline needs a `..  _anchor:` target** directly above it
    (https://docs.typo3.org/permalink/h2document:link-anchor), and anchors are
    never removed once published
    (https://docs.typo3.org/permalink/h2document:anchor-persistence).
6.  **Link TYPO3 documentation with permalinks**, also inside this manual,
    and give every link its own link text:
    https://docs.typo3.org/permalink/h2document:permalinks. Do not suggest
    replacing a permalink with `:ref:`.
7.  **Validate before committing** — run `make test-docs`, and run the
    pre-commit hooks (see Commands). If you skip them the scheduled
    `apply-precommit` workflow fixes the whitespace later in a separate
    commit, which is avoidable noise.
8.  **Never commit or push without being asked.**

## Code block captions

Give every code block a `:caption:` saying where the code goes. That is the
question a reader of this manual has — setup, constants or page TSconfig? — and
the caption is the only place it gets answered.

The caption goes directly under the directive, with **no blank line** between
the two. A blank line ends the option block, so the caption is parsed as content
and rendered as the first line of the code:

```rst
..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript

    page = PAGE
```

If the block already has options such as `:linenos:` or `:emphasize-lines:`, the
caption goes first and the others stay directly below it, still without a blank
line between them.

Use these paths. Each of them is loaded by TYPO3 on its own, so a reader who
copies the example into that file gets a working result:

| What the block shows | Caption |
| --- | --- |
| Frontend TypoScript setup | `EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript` |
| TypoScript constants | `EXT:my_sitepackage/Configuration/Sets/Main/constants.typoscript` |
| Page TSconfig | `EXT:my_sitepackage/Configuration/Sets/Main/page.tsconfig`, or the extension's own `EXT:my_sitepackage/Configuration/page.tsconfig` |
| User TSconfig | `EXT:my_sitepackage/Configuration/user.tsconfig` |
| Site configuration | `config/sites/my_site/config.yaml` |
| Rendered output rather than a file | `Example output` (`Example input` for the value going in) |
| A shell command | the prompt for the directory it is run from, for example `typo3_root$` |

Do **not** write `EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript`.
Nothing includes that file unless the reader wires it up by hand, so it answers
the reader's question wrongly. A site set is included as soon as a site lists
it, an extension's `Configuration/page.tsconfig` has been picked up
automatically since TYPO3 v12 and `Configuration/user.tsconfig` since v13.
Many captions in this manual still use the old path; correct it when you touch
such a block.

### Which placeholder extension

The table above says `my_sitepackage`, the name the other TYPO3 manuals use
as well, but that is not automatic: this manual documents both sides of
TypoScript. Pick the name by what the example is about.

*   **`my_sitepackage`** for theming and site output — page templates, menus,
    titles, the site's own TypoScript and TSconfig.
*   **`my_extension`** for what an extension brings along — its own fields
    (`tx_myextension_myfield`), tables, plugins and their configuration.

Two adjacent code blocks may legitimately use different names:

```rst
..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    lib.foo.data = fullRootLine : 0, tx_myextension_myfield

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript

    lib.foo.data = fullRootLine : 1, title
```

Do not settle this by counting which name appears more often. `my_sitepackage`
leads by a wide margin, but that only reflects how many examples happen to be
about output — it does not make it the house form for an example about an
extension's own field.

## Which inline role

A role is not decoration: it renders an info button whose modal names a
language. Pick the one whose modal says something true.

| What it is | How to write it |
| --- | --- |
| TypoScript property or value (`stdWrap`, `cObject`) | `:typoscript:` |
| A bare number or quoted string (`0`, `-1`, `"B"`) | plain backticks |
| A database table or column (`tt_content`, `colPos`) | plain backticks |
| Actual SQL (`SELECT`, `JOIN`) | `:sql:` |
| PHP variable, call, constant (`$cObj->data`, `PHP_INT_MAX`) | `:php:` |
| A PHP class | its FQN in `:php-short:`, which prints the short name |
| An HTML element or attribute | `:html:` |
| A file path | `:file:`, a directory `:path:` |

A number or a quoted string is a value, not code: the `:typoscript:` modal
would claim it is TypoScript.

Do not use `:code:`. It renders exactly like plain backticks, so it says
nothing — and it swallows backslashes, which turned
`\TYPO3\CMS\Core\Html\RteHtmlParser` into `TYPO3CMSCoreHtmlRteHtmlParser`
on the published page until it was removed.

A namespace already spelled out in the running text stays that way: writing
the class whole is a deliberate choice where a section introduces it.

## Confval options

The renderer knows five `confval` options, and only in lower case:
`:name:`, `:type:`, `:default:`, `:required:` and `:noindex:`. Any other
option is printed as a field label exactly as written, so a misspelled
built-in does not fail — it just renders wrong. `:no-index:` showed a
stray "no-index" row while the value stayed linkable, and `:Default:` was
printed as an ordinary field instead of the default value.

*   Write the built-in options in lower case.
*   Write `:required: true` only for a value that must be set. Leave the
    option out otherwise; never write `:required: false`, which renders
    nothing and only states the obvious.
*   Write any other option as the label the reader sees, capitalized:
    `:Example:`, `:Syntax:`, `:Parameter:`.
*   Never write a bare `:Path:`. Name the configuration the path belongs
    to: `:Page TSconfig path:` for `mod.*` and the other page TSconfig
    paths, `:User TSconfig path:` for `options.*` and the other user
    TSconfig paths, in line with `:TCA path:` in the TCA reference.
*   Do not add a path to a property that has none of its own. A `stdWrap`
    function, a content object's property or a data processor's option
    works wherever its object is used, so a path would name a place that
    does not exist.

## Object types and functions

Every content object, top-level object, function and GIFBUILDER object has
a confval directly under its page headline. render-guides reads these from
`confvals.json` to show a popover for a `:typoscript:` role in any manual,
and finds them by their anchor, so their names follow a fixed scheme:

| What it is | `:name:` | `:type:` |
| --- | --- | --- |
| Content object | `cobj-<type>`, for example `cobj-user-int` | ``:ref:`cObject <data-type-cobject>` `` |
| Top-level object | the name, for example `page` or `config` | ``:ref:`toplevel <top-level-objects>` `` |
| Function | the name, for example `stdwrap` | ``:ref:`function <functions>` `` |
| GIFBUILDER object | `gifbuilder-<type>`, for example `gifbuilder-text` | ``:ref:`GIFBUILDER object <gifbuilder-object-names>` `` |

*   Write the confval title exactly as a role writes the name: `USER_INT`,
    `PAGE`, `stdWrap`. The popover matches only that spelling, so a
    lowercase `page` does not find the `PAGE` box.
*   If the anchor is already taken by a published confval, use
    `function-<name>` instead, as `function-htmlparser-tags` does. The
    popover does not find such a box.
*   The first paragraph is the popover summary: one or two sentences that
    say what the type does.
*   An unfiltered `confval-menu` lists every confval of its page, the box
    included. Add `:exclude: <name>` to the property table of such a page.

## Commit message format

Follow https://docs.typo3.org/m/typo3/docs-how-to-document/main/en-us/Howto/EditLocal.html:

- Prefix the subject line with `[TASK]`, `[BUGFIX]`, or `[FEATURE]`,
  followed by a short, imperative summary.
- Explain *why* the change is needed in the body — the diff already shows
  what changed.
- End with a `Signed-off-by: Your Name <email>` trailer.
- If AI assistance went beyond basic spelling/grammar checks, add an
  `Assisted-by: <tool/model name> <contact>` trailer, e.g.
  `Assisted-by: Claude Sonnet 5 <noreply@anthropic.com>`.
- If the change should be backported, add a `Releases: main, 14.3, 13.4`
  trailer listing every branch it applies to. This repo maintains multiple
  LTS branches, so `Releases:` applies here — including for changes to
  these agent instruction files themselves, since agents may be working
  on an older branch where a change is still relevant.

## Pull requests

- When a commit is the only commit in the PR, the PR title and body must
  match the commit's subject and body exactly.
- When the commit message has a `Releases:` trailer naming branches beyond
  `main`, attach the matching `backport <version>` label (e.g.
  `backport 14.3`, `backport 13.4`) to the PR for each of those branches
  when opening it — don't wait to be asked.
- Adding labels requires triage/write access, which an external
  contributor's account (e.g. a fork-based PR) usually doesn't have. If
  attaching a label fails for that reason, don't treat it as an error and
  don't note the failure in the PR — just skip it silently.

## For maintainers

- A PR opened by an agent may be missing its `backport <version>` labels
  if the agent's account lacked permission to add them. Check for and add
  any missing backport labels yourself before/when merging such a PR.

## References

- [TYPO3CMS-Guide-HowToDocument](https://github.com/TYPO3-Documentation/TYPO3CMS-Guide-HowToDocument) — official writing style guide and reST reference
- https://docs.typo3.org/m/typo3/docs-how-to-document/main/en-us/Howto/EditLocal.html — commit/PR conventions
