.. include:: /Includes.rst.txt
.. index:: HMENU; special = categories
.. _hmenu-special-language:

===================
Language menu
===================

.. seealso::
   The :ref:`LanguageMenuProcessor <LanguageMenuProcessor>` can be used to
   create a language menu styled by Fluid.

Creates a language selector menu.

The :typoscript:`special = language` type will create menu items based on
the current page record but with the language record for each language
overlaid if available.

.. contents::
   :local:

Properties
==========


.. ### BEGIN~OF~TABLE ###

.. _hmenu-special-language-value:

.. container:: table-row

   Property
         special.value

   Data type
         comma list of sys\_language uids /:ref:`stdWrap <stdwrap>` or `auto`

   Description
         The number of elements in this list determines the number of menu
         items. Setting to `auto` will include all available languages from
         the current site.

.. _hmenu-special-language-normalwhennolanguage:


.. container:: table-row

   Property
         special.normalWhenNoLanguage

   Data type
         boolean

   Description
         If set to 1, the button for a language will be rendered as a non-
         disabled button even if no translation is found for the language.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = language]


.. _hmenu-special-language-examples:

Example
========

Creates a language menu with pure Typoscript:

.. include:: /CodeSnippets/Menu/TypoScript/LanguageMenuLib.rst.txt

.. seealso::
   For a language menu styled by Fluid see
   :ref:`LanguageMenuProcessor <LanguageMenuProcessor>`.

Note on item states
====================

When "TSFE->sys\_language\_uid" matches the sys\_language uid for an
element the state is set to "ACT", otherwise "NO". However, if a page
is not available due to the pages "Localization settings" (which can
disable translations) or if no Alternative Page Language record was
found (can be disabled with ".normalWhenNoLanguage", see below) the
state is set to "USERDEF1" for non-active items and "USERDEF2" for
active items. So in total there are four states to create designs for.
It is recommended to disable the link on menu items rendered with
"USERDEF1" and "USERDEF2" in this case since they are disabled exactly
because a page in that language does not exist and might even issue an
error if tried accessed (depending on site configuration).
