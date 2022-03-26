.. include:: /Includes.rst.txt

.. _typoscript-debugging:

Debugging / Analyzing
=====================

Debugging TypoScript can be complicated as there are many influences like the
active page and conditions. Also constants can be used which get substituted.
The following sections provide information about how to debug TypoScript and how
to find errors within TypoScript.

Analyzing defined constants
---------------------------

The *TypoScript Object Browser* provides an tree view to all defined constants
on the currently active page.

.. figure:: ../Images/TemplatesConstants.png
   :alt: Overview of the defined constants
   :class: with-shadow

.. _typoscript-syntax-finding-errors:

Finding errors
--------------

There are no tools that will tell whether the given TypoScript code is 100%
correct. The TypoScript Object Browser will warn about syntax errors though:

.. figure:: ../Images/TemplatesSyntaxError.png
   :alt: The TypoScript Object Browser showing a syntax error
   :class: with-shadow

Errors will also appear in the Template Analyzer, when viewing the content of a
give template. It is also possible to see the full TypoScript code by clicking
on the "View the complete TS listing" button at the bottom of the Template
Analyzer:

.. figure:: ../Images/TemplatesViewFullListingButton.png
   :alt: The TypoScript Object Browser showing a syntax error
   :class: with-shadow

The result is a long listing with all compiled line numbers, which makes it
possible to find the error reported by the TypoScript Object Browser.

.. figure:: ../Images/TemplatesFullListing.png
   :alt: The TypoScript Object Browser showing a syntax error
   :class: with-shadow

In the frontend, the Admin Panel is another possibility to debug TypoScript; use
its section called "TypoScript". It shows selected rendered (configuration)
values, SQL queries, error messages and more.

.. _typoscript-syntax-debugging:
.. _typoscript-syntax-templates-debugging:

Debugging
---------

TypoScript itself offers a number of debug functions:

- :ref:`stdWrap <stdwrap>` comes with the properties
  :ref:`debug <stdwrap-debug>`, :ref:`debugFunc <stdwrap-debugfunc>` and
  :ref:`debugData <stdwrap-debugdata>`
  which help checking which values are currently available and which
  configuration is being handled.

- :ref:`GMENU <gmenu>`, :ref:`TMENU <tmenu>` and
  :ref:`IMGMENU <imgmenu>` come with the property
  :ref:`debugItemConf <menu-common-properties>`.
  If set to :ts:`1`, it outputs the configuration arrays for each menu item.
  Useful to debug :ref:`optionSplit <objects-optionsplit>` things and such.
