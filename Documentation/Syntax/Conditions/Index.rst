:navigation-title: Conditions

..  include:: /Includes.rst.txt
..  index::
    TypoScript; Operator "["
    TypoScript; Conditions
    TypoScript; [GLOBAL] condition
    TypoScript; Symfony expression language
..  _typoscript-syntax-conditions:
..  _typoscript-syntax-implementing-custom-conditions:
..  _typoscript-syntax-conditions-examples:

===================================
Conditions in the TypoScript syntax
===================================

TypoScript can contain :code:`if` and :code:`if / else` control structures. They
are called `conditions`, their "body" is only considered if a condition criteria
evaluates to true. Examples of condition criteria are:

-   Is a user logged in?
-   Is it Monday?
-   Is the page called in a certain language?

Conditions are a TypoScript syntax construct. They are thus available in both
frontend TypoScript and backend TSconfig. However, condition criteria are based
on prepared variables and functions, and those are different in frontend
TypoScript and backend TSconfig. For example, the :typoscript:`frontend` variable does
not exist in TSconfig, it is (obviously) impossible to have a backend TSconfig
condition that checks for a logged in frontend user.

..  contents:: Table of contents

..  _typoscript-syntax-conditions-usage:

Basic usage of TypoScript conditions
====================================

..  literalinclude:: _codesnippets/_basic.typoscript
    :captions: packages/my_site_package/Configuration/TypoScript/setup.typoscript

..  _typoscript-syntax-conditions-syntax:

Syntax and rules
================

These general rules apply:

..  _typoscript-syntax-conditions-confinements:
..  _typoscript-syntax-conditions-braces:
..  _typoscript-syntax-syntax-square-brackets:
..  _typoscript-syntax-syntax-conditions:

General condition syntax
------------------------

Conditions are encapsulated in :typoscript:`[` and :typoscript:`]`

..  _typoscript-syntax-the-global-condition:
..  _typoscript-syntax-global-condition:
..  _typoscript-syntax-else-condition:
..  _typoscript-syntax-end-condition:

`[GLOBAL]`, `[ELSE]` and `[END]`
--------------------------------

:typoscript:`[ELSE]` negates a previous condition criteria and can contain
a new body until :typoscript:`[END]` or :typoscript:`[GLOBAL]`. :typoscript:`[ELSE]`
is considered if the condition criteria did *not* evaluate to true.

:typoscript:`[END]` and :typoscript:`[GLOBAL]` stop a given condition scope.
This is similar to a closing curly brace :code:`}` in programming languages like PHP.

..  literalinclude:: _codesnippets/_condition.typoscript
    :captions: packages/my_site_package/Configuration/TypoScript/setup.typoscript

Conditions automatically stop at the end of a text snippet (file or record), even
without :typoscript:`[END]` or :typoscript:`[GLOBAL]`. Another snippet on the same
level is in "global" scope automatically. The backend TypoScript and
TSconfig modules may mumble about a not properly closed condition, though.

..  versionchanged:: 12.0

    :typoscript:`[END]` and :typoscript:`[GLOBAL]` behave exactly the same. Both
    are kept for historical reasons (for now).

    Conditions automatically stop at the end of a text snippet (file or record).

..  _typoscript-syntax-end-condition-and:
..  _typoscript-syntax-end-condition-or:

Combining multiple TypoScript conditions with `and` or `or`
-----------------------------------------------------------

Multiple condition criteria can be combined using :typoscript:`or` or :typoscript:`||`,
as well as :typoscript:`and` or :typoscript:`&&`

..  literalinclude:: _codesnippets/_andor.typoscript
    :captions: packages/my_site_package/Configuration/TypoScript/setup.typoscript

Single criteria can be negated using :typoscript:`!`

..  _typoscript-syntax-end-condition-constants:

TypoScript constant usage in Conditions
---------------------------------------

Conditions can use constants. They are available in frontend TypoScript "setup" and
in TSconfig from "site settings". A simple example if this constant
:typoscript:`myPageUid = 42` is set:

..  code-block:: typoscript

    [traverse(page, "uid") == {$myPageUid}]
        page.10.value = Page uid is 42
    [end]

..  note::

    Using the `Null coalescing operator ?? <https://docs.typo3.org/permalink/t3tsref:typoscript-syntax-syntax-null-coalescing>`_
    with constants used within conditions is not possible.

..  _typoscript-syntax-end-condition-nesting:

Nesting conditions via TypoScript imports
-----------------------------------------

Conditions can *not* be nested within code blocks.

..  code-block:: typoscript

    # Invalid: Conditions must not be used within code blocks
    # someIdentifier {
    #    someProperty = foo
    #    [frontend.user.isloggedIn]
    #       someProperty = bar
    #    [GLOBAL]
    # }

..  versionchanged:: 12.0

Conditions *can* be nested into each other, if they are located in
different snippets (files or records), see example below. They can *not* be nested
within the same code snippet.

A second condition that is *not* :typoscript:`[ELSE]`, :typoscript:`[END]`
or :typoscript:`[GLOBAL]` *stops* a previous condition and starts a new one.
This is the main reason conditions can *not* be nested within one text snippet.

:typoscript:`@import` *can* be nested
inside conditions. This allows conditional includes and is a new feature of the
TYPO3 v12 parser.

..  _typoscript-syntax-end-condition-null-save:

Using the null-safe operator in conditions
------------------------------------------

..  versionadded:: 12.1

Using the null-safe operator is possible when accessing properties on objects
which might not be available in some context, for example `TSFE` in the
backend:

..  code-block:: typoscript

    # Previously
    # [getTSFE() && getTSFE().id == 123]

    # Now
    [getTSFE()?.id == 123]

..  _typoscript-syntax-syntax-value:

Allowed criteria in TypoScript conditions
=========================================

For a reference of allowed condition criteria, please refer to the according
chapter in the :ref:`frontend TypoScript Reference <conditions>` and
the :ref:`backend TSconfig Reference <tsconfig-conditions>`. These references
come with examples for single condition criteria as well.

The TSconfig and TypoScript backend modules show lists of existing conditions
and allow simulating criteria verdicts to analyze their impact on the
resulting TypoScript tree.

..  _typoscript-syntax-conditions-expression-language:

TypoScript conditions and the Symfony expression language
=========================================================

Condition criteria are based on
the `Symfony expression language <https://symfony.com/doc/current/components/expression_language/syntax.html>`__.
The Core allows extending the Symfony expression language with own variables and
functions, see :ref:`symfony expression language API <t3coreapi:sel-within-typoscript-conditions>`
for more details.
