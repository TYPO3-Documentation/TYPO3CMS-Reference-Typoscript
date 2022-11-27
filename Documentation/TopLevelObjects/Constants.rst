.. include:: /Includes.rst.txt
.. index:: Top-level objects; constants
.. _tlo-constants:
.. _constants:

=========
constants
=========

..  attention::
    ..  deprecated:: 12.1
        Using the :typoscript:`constants` top-level-object in combination with the
        :typoscript:`constants = 1` in :ref:`parseFunc` to substitute strings
        like :typoscript:`###MY_CONSTANT###` triggers a deprecation level log error
        in TYPO3 v12 and will stop working in v13.

The Frontend TypoScript setup (!) top-level-object :typoscript:`constants` can be
used to define constants for replacement inside a :ref:`parseFunc`.
If :typoscript:`parseFunc` somewhere is configured with :typoscript:`.constants = 1`,
then all occurrences of the constant in the text will be substituted with the
actual value.

.. _tlo-constants-migration:

Migration
=========

One possible solution is to switch to TypoScript constants / settings instead
for simple cases.

A simple example usage before:

.. code-block:: typoscript

    TypoScript setup:

    constants.EMAIL = mail@example.com
    page = PAGE
    page.10 = TEXT
    page.10.value = Write an email to ###EMAIL###
    page.10.parseFunc.constants = 1

Switching to a TypoScript constant / setting:

.. code-block:: typoscript

    TypoScript constants / settings:

    myEmail = mail@example.com

    TypoScript setup:

    page = PAGE
    page.10 = TEXT
    page.10.value = Write an email to {$myEmail}

The main usage of this feature has been a "magic" substitution within
:typoscript:`lib.parseFunc_RTE`:

When :sql:`tt_content` rich-text editor (RTE) content elements contain such
substitution strings, they are replaced by :typoscript:`parseFunc` accordingly.
For instance, a :sql:`tt_content` RTE element with the content
`Send an email to ###EMAIL###` would substitute to
`Send an email to email@example.org` *if*
the top-level setup :typoscript:`constants` object has been set up.

This substitution relies on the the fact that editors actively know about
and use this construct: If only one content element did not prepare for this
- since an editor forgot or have not been trained about it, changing
such a constant on TypoScript level would still lead to faulty frontend output,
rendering the entire substitution approach useless.

In case instances still rely on this magic substitution principle, and made sure all editors
always know and follow this approach, instances can use the :typoscript:`userFunc`
property of :typoscript:`parseFunc` to re-implement the functionality:

Basically by copying the deprecated code to an own class and registering the
:typoscript:`userFunc` in :typoscript:`lib.parseFunc_RTE`.
