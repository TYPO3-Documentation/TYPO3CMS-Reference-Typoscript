.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-text:

TEXT
^^^^

The content object "TEXT" can be used to output static text or html.
Note that the stdWrap properties are not available under the property
"stdWrap" (as they are for the other cObjects), but on the very
rootlevel of the object. This is non-standard! Check the examples.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:


.. container:: table-row

   Property
         value

   Data type
         string /stdWrap

   Description
         Text, which you want to output.


.. container:: table-row

   Property
         (stdWrap properties...)

   Data type
         ->stdWrap


.. ###### END~OF~TABLE ######

[tsref:(cObject).TEXT]


Example:
""""""""

::

   10 = TEXT
   10.value = This is a text in uppercase
   10.case = upper


Example:
""""""""

::

   10 = TEXT
   10.field = bodytext
   10.br = 1


Example:
""""""""

::

   10 = TEXT
   10.field = title
   10.wrap = <strong>|</strong>

