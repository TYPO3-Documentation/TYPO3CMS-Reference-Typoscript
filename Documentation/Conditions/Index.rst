.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _conditions:

Conditions
----------

.. _condition-syntax:

General syntax
""""""""""""""

Each condition is encapsulated by square brackets. For a list of
available conditions see below.

"[ELSE]" is available as else operator. It is a condition, which will
return TRUE, if the previous condition returned FALSE.

Each condition block is ended with "[GLOBAL]".


Example:
~~~~~~~~

::

   [browser = msie]
     # TypoScript Code for users of Internet Explorer.
   [ELSE]
     # TypoScript Code for users of other browsers.
   [GLOBAL]


.. _condition-general-notes:

General notes
"""""""""""""

Values are normally trimmed before comparison, so leading and trailing
blanks are not taken into account.

Note that conditions cannot be used inside of curly brackets.

You may combine several conditions with two operators: && (and), \|\|
(or). Alternatively you may use "AND" and "OR" instead of "&&" and
"\|\|". The AND operator always takes higher precedence over OR. If no
operator has been specified, it will default to OR.


Examples:
~~~~~~~~~

This condition will match if the visitor opens the website with
Internet Explorer on Windows (but not on Mac) ::

   [browser = msie] && [system = win]

This will match with either Opera or Firefox browsers ::

   [browser = opera] || [browser = firefox]

This will match with either Firefox or Internet Explorer. In case of
Internet Explorer, the version must be above 8. ::

   [browser = firefox] || [browser = msie] && [version => 8]

For full explanations about conditions, especially about condition
syntax, please refer to :ref:`the according chapter in "TypoScript
Syntax and In-depth Study" <t3tssyntax:conditions>`.


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Reference/Index

