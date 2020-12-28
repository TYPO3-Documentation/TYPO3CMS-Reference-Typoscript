.. include:: /Includes.rst.txt
.. index:: TypoScript; Debugging
.. _typoscript-debugging:

=====================
Debugging / analyzing
=====================

Debugging TypoScript can be complicated as there are many influences like the
active page and conditions. Also constants can be used which get substituted.
The following sections provide information about how to debug TypoScript and how
to find errors within TypoScript.


.. index::
   TypoScript; Constants debugging
   Constants; debugging

Analyzing defined constants
===========================

The *TypoScript Object Browser* provides an tree view to all defined constants
on the currently active page.

.. figure:: ../Images/TemplatesConstants.png
   :alt: Overview of the defined constants
   :class: with-shadow

.. index:: TypoScript; Syntax errors
.. _typoscript-syntax-finding-errors:

Finding errors
==============

There are no tools that will tell whether the given TypoScript code is 100%
correct. The :guilabel:`TypoScript object browser` will warn about syntax errors though:

.. figure:: ../Images/TemplatesSyntaxError.png
   :alt: The TypoScript Object Browser showing a syntax error
   :class: with-shadow

Errors will also appear in the :guilabel:`template analyzer`, when viewing the content of a
given template. It is also possible to see the full TypoScript code by clicking
on the :guilabel:`View the complete TS listing` button at the bottom of the template
analyzer:

.. figure:: ../Images/TemplatesViewFullListingButton.png
   :alt: The TypoScript Object Browser showing a syntax error
   :class: with-shadow

The result is a long listing with all compiled line numbers, which makes it
possible to find the error reported by the :guilabel:`TypoScript object browser`.

.. figure:: ../Images/TemplatesFullListing.png
   :alt: The TypoScript Object Browser showing a syntax error
   :class: with-shadow

In the frontend, the :guilabel:`admin panel` is another possibility to debug TypoScript; use
its section called :guilabel:`TypoScript`. It shows selected rendered (configuration)
values, SQL queries, error messages and more.


.. index::
   TypoScript; Debugging stdWrap
   TypoScript; Debugging TMENU
.. _typoscript-syntax-debugging:
.. _typoscript-syntax-templates-debugging:

Debugging
=========

TypoScript itself offers a number of debug functions:

- :ref:`stdWrap <stdwrap>` comes with the properties
  :ref:`debug <stdwrap-debug>`, :ref:`debugFunc <stdwrap-debugfunc>` and
  :ref:`debugData <stdwrap-debugdata>`
  which help checking which values are currently available and which
  configuration is being handled.

- :ref:`TMENU <tmenu>` comes with the property
  :ref:`debugItemConf <menu-common-properties>`.
  If set to :ts:`1`, it outputs the configuration arrays for each menu item.
  Useful to debug :ref:`optionSplit <objects-optionsplit>` things and such.
