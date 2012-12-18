.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _carray:

"CARRAY"
^^^^^^^^

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
         1,2,3,4...

   Data type
         cObject

   Description
         This is a numerical "array" of content objects (cObjects). The order
         in which you specify the objects is not important as the array will
         be sorted numerically before it's parsed!


.. container:: table-row

   Property
         **Occasional properties:**


.. container:: table-row

   Property
         (stdWrap properties...)

   Data type
         ->stdWrap

   Description
         **Note:** This applies ONLY if "CARRAY /stdWrap" is set to be data
         type.

         If you specify any non-integer properties to a CARRAY, stdWrap will be
         invoked with all properties of the CARRAY.

         **Example:** ::

            10 = TEXT
            10.value = testing

            5 = TEXT
            5.value = This will be rendered before "10"

            wrap = <b>\|</b>

         This will return '<b>This will be rendered before "10"testing</b>'.


.. container:: table-row

   Property
         (TDParams)

   Data type
         <TD>-params

   Description
         **Note:** This applies ONLY if "CARRAY +TDParams" is set to be data
         type.

         This property is used only in some cases where CARRAY is used. Please
         look out for a note about that in the various cases.


.. ###### END~OF~TABLE ######

[tsref:->CARRAY]

