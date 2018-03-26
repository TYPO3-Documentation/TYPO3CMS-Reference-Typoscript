.. include:: ../../Includes.txt
.. highlight:: typoscript

.. _conditions-about-the-syntax:

==============================
About The Syntax Of Conditions
==============================

.. seealso::

   For full explanations about conditions, especially about condition
   syntax, please refer to :ref:`the according chapter in "TypoScript
   Syntax and In-depth Study" <t3tssyntax:conditions>`.


.. _condition-syntax:

General syntax
==============

Each condition is encapsulated by square brackets. For a list of
available conditions see below.

:ts:`[ELSE]` is available as else operator. It is a condition, which will
return TRUE, if the previous condition returned FALSE.

Each condition block is ended with :ts:`[END]`.


:ts:`[GLOBAL]` is a condition by itself that always returns "true".
It ensures that the following TypoScript code is located in the
global scope. So you can be sure that it's not affected by previous
TypoScript, for example if a closing bracket is missing.
The *Template Analyzer* shows this very well: TYPO3 places a
:ts:`[GLOBAL]` condition at the beginning of each TypoScript file.

As a developer you can use :ts:`[GLOBAL]` for testing purposes
to ensure that your own condition works as expected.
See :ref:`t3tssyntax:The-Global-Condition` for additional documentation.


Example
~~~~~~~

Test day of month::

   [dayofmonth = 9]
     # TypoScript for the ninth day of the month.
   [ELSE]
     # TypoScript for other days.
   [END]


.. _condition-general-notes:

Trimming, braces and condition operators
========================================

Values are normally trimmed before comparison, so leading and trailing
blanks are not taken into account.

Note that conditions cannot be used inside of curly brackets.

You may combine several conditions with two operators: && (and), \|\|
(or). Alternatively you may use "AND" and "OR" instead of "&&" and
"\|\|". The AND operator always takes higher precedence over OR. If no
operator has been specified, it will default to OR.


Examples
~~~~~~~~

Test day of month and month
"""""""""""""""""""""""""""

This condition will match on May 9th::

   [dayofmonth = 9] && [month = 5]

Test day of month
"""""""""""""""""

This will match on either the ninth or the tenth of a month::

   [dayofmonth = 9] || [dayofmonth = 10]

Test month and day of month
"""""""""""""""""""""""""""

This will match in either June or May. In case of
May, the day of the month must be above 8::

   [month = 6] || [month = 5] && [dayofmonth => 8]
