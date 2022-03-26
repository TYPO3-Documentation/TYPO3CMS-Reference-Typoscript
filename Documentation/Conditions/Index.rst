.. include:: /Includes.rst.txt
.. highlight:: typoscript

.. _conditions:

==========
Conditions
==========

.. seealso::

   For full explanations about conditions, especially about condition
   syntax, please refer to :ref:`the according chapter in
   "TYPO3 Explained" <t3coreapi:typoscript-syntax-conditions>`.


.. _condition-syntax:

General syntax
==============

Each condition is encapsulated by square brackets. For a list of
available conditions see below.

`[ELSE]` is available as else operator. It is a condition, which will
return TRUE, if the previous condition returned FALSE.

Each condition block is ended with `[END]`.


`[GLOBAL]` is a condition by itself that always returns "true".
It ensures that the following TypoScript code is located in the
global scope. So you can be sure that it's not affected by previous
TypoScript, for example if a closing bracket is missing.
The *Template Analyzer* shows this very well: TYPO3 places a
`[GLOBAL]` condition at the beginning of each TypoScript file.

As a developer you can use `[GLOBAL]` for testing purposes
to ensure that your own condition works as expected.

.. todo:: Add more information and links

Example
-------

Test browser::

   [browser = msie]
     # TypoScript Code for users of Internet Explorer.
   [ELSE]
     # TypoScript Code for users of other browsers.
   [END]


.. _condition-general-notes:

General notes
=============

Values are normally trimmed before comparison, so leading and trailing
blanks are not taken into account.

Note that conditions cannot be used inside of curly brackets.

You may combine several conditions with two operators: && (and), \|\|
(or). Alternatively you may use "AND" and "OR" instead of "&&" and
"\|\|". The AND operator always takes higher precedence over OR. If no
operator has been specified, it will default to OR.


Examples
--------

Test browser and system
~~~~~~~~~~~~~~~~~~~~~~~

This condition will match if the visitor opens the website with
Internet Explorer on Windows (but not on Mac)::

   [browser = msie] && [system = win]

Test browser
~~~~~~~~~~~~

This will match with either Opera or Firefox browsers::

   [browser = opera] || [browser = firefox]

Test browser and version
~~~~~~~~~~~~~~~~~~~~~~~~

This will match with either Firefox or Internet Explorer. In case of
Internet Explorer, the version must be above 8::

   [browser = firefox] || [browser = msie] && [version => 8]


Test for empty value
~~~~~~~~~~~~~~~~~~~~

This will match with an empty value::

   [globalString = IENV:HTTP_REFERER = /^$/]

Test for non-empty value
~~~~~~~~~~~~~~~~~~~~~~~~

This will match with an not empty value::

   [globalString = IENV:HTTP_REFERER = /.+/]


More
====

.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Reference/Index
