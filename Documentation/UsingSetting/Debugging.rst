..  include:: /Includes.rst.txt
..  index:: TypoScript; Debugging
..  _typoscript-debugging:

=====================
Debugging / analyzing
=====================

Debugging TypoScript can be complicated as there are many influences like the
active page and conditions. Also constants can be used which get substituted.
The following sections provide information about how to debug TypoScript and how
to find errors within TypoScript.

..  index::
    TypoScript; Constants debugging
    Constants; debugging
..  _typoscript-debugging-constants:

Analyzing defined constants
===========================

The backend submodule :guilabel:`Site Management > TypoScript > Active TypoScript`
provides a tree view to all defined TypoScript Constants on the currently active page.

..  figure:: /Images/ManualScreenshots/TypoScriptModule/ConstantsDisplayActiveTypoScript.png
    :alt: A Screenshot showing the "Constants" section of the "Active TypoScript" submodule.

    Analyzing defined TypoScript Constants in the :guilabel:`Active TypoScript` submodule.

..  index:: TypoScript; Syntax errors
..  _typoscript-syntax-finding-errors:

Finding errors
==============

There are no tools that will tell whether the given TypoScript code is 100%
correct. The :guilabel:`Included TypoScript` will warn about syntax errors though:

..  figure:: /Images/ManualScreenshots/TypoScriptModule/IncludedTypoScriptWarnings.png
    :alt: The submodule 'Included TypoScript' showing a syntax warning

In the frontend, the :composer:`typo3/cms-adminpanel` is another possibility
to debug TypoScript: use its section called :guilabel:`TypoScript`. It shows
selected rendered (configuration) values, SQL queries, error messages and more.

..  index::
    TypoScript; Debugging stdWrap
    TypoScript; Debugging TMENU
..  _typoscript-syntax-debugging:
..  _typoscript-syntax-templates-debugging:

Debugging
=========

TypoScript itself offers a number of debug functions:

-   :ref:`stdWrap <stdwrap>` comes with the properties
    :ref:`stdwrap-debug`, :ref:`stdwrap-debugFunc` and
    :ref:`stdwrap-debugData`
    which help checking which values are currently available and which
    configuration is being handled.

-   :ref:`TMENU <tmenu>` comes with the property
    :ref:`debugItemConf <menu-common-properties>`.
    If set to :typoscript:`1`, it outputs the configuration arrays for each menu item.
    Useful to debug :ref:`optionSplit <optionsplit>` things and such.
