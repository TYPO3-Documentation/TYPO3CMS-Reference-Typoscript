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

.. hint::

   For full explanations about conditions, especially about condition
   syntax, please refer to :ref:`the according chapter in
   "TYPO3 Explained" <t3coreapi:typoscript-syntax-conditions>`.


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Reference/Index

