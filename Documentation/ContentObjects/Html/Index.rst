.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-html:

HTML
^^^^

The content object "HTML" can be used to output static text or HTML.
stdWrap is available for the cObject itself and for the property
"value". See the examples.

**Note:** This content object was deprecated since TYPO3 4.6 and has
been removed in TYPO3 6.0. Use the content object ":ref:`cobj-text`" instead!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         value

   Data type
         HTML /:ref:`stdWrap <stdwrap>`

   Description
         Raw HTML code.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         (Executed after the stdWrap for the property ".value".)


.. ###### END~OF~TABLE ######

[tsref:(cObject).HTML]


.. _cobj-html-examples:

Examples:
"""""""""

::

   10 = HTML
   10.value = This is a text in uppercase
   10.value.case = upper

The above example uses the stdWrap property "case". It returns "THIS
IS A TEXT IN UPPERCASE".


::

   10 = HTML
   10.stdWrap.field = title
   10.stdWrap.wrap = <strong>|</strong>

The above example gets the header of the current page (which is
stored in the database field "title"). The header is then wrapped in
<strong> tags, before it is returned.


::

   10 = HTML
   10.value.field = bodytext
   10.value.br = 1

The above example returns the content, which was found in the field
"bodytext" of the current record from $cObj->data-array. Here that
shall be the current record from the database table tt_content. This
is useful inside :ref:`COA <cobj-coa>` objects.

