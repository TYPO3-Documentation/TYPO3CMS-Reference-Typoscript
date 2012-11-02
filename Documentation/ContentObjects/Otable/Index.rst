.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-otable:

OTABLE
^^^^^^

Creates a simple table. You can set an offset and some parameters for
the table tag.

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
         offset

   Data type
         x,y /stdWrap

   Description
         Offset from upper left corner.

         **Note:**

         Actually the data type is "x,y,r,b,w,h" and stdWrap:

         x,y is the offset from upper left corner.

         r,b is the offset (margin) to right and bottom.

         w is the required width of the content field.

         h is the required height of the content field.

         All measures are in pixels.

   Default


.. container:: table-row

   Property
         1,2,3,4...

   Data type
         cObject

   Description


   Default


.. container:: table-row

   Property
         tableParams

   Data type
         <TABLE>-params /stdWrap

   Description
         Attributes of the table tag.

   Default
         border="0" cellspacing="0" cellpadding="0"


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).OTABLE]


.. _cobj-otable-examples:

Example:
""""""""

::

   top.100 = OTABLE
   top.100.offset = 310,8
   top.100.tableParams = border="1" cellpadding="0" cellspacing="0"
   top.100.1 < temp.topmenu

