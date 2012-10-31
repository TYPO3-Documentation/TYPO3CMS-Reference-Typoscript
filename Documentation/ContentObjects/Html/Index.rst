.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-html:

HTML
^^^^

The content object "HTML" can be used to output static text or html.
stdWrap is available for the cObject itself and for the property
"value". See the examples.

**Note** : This content object was deprecated since TYPO3 4.6 and has
been removed in TYPO3 6.0. Use the content object "TEXT" instead!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         value

   Data type
         HTML /stdWrap

   Description
         Raw HTML-code.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         (Executed after the stdWrap for the property ".value".)

   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).HTML]


.. _cobj-html-examples:

((generated))
"""""""""""""

Example:
~~~~~~~~

::

   10 = HTML
   10.value = This is a text in uppercase
   10.value.case = upper


Example:
~~~~~~~~

::

   10 = HTML
   10.value.field = bodytext
   10.value.br = 1


Example:
~~~~~~~~

::

   10 = HTML
   10.stdWrap.field = title
   10.stdWrap.wrap = <strong>|</strong>

