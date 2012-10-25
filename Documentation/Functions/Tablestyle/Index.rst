.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


tableStyle
^^^^^^^^^^

This is used to style a table-tag. The input is wrapped by this table-
tag

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
         align

   Data type
         align /stdWrap

   Description


   Default


.. container:: table-row

   Property
         border

   Data type
         int /stdWrap

   Description


   Default


.. container:: table-row

   Property
         cellspacing

   Data type
         int /stdWrap

   Description


   Default


.. container:: table-row

   Property
         cellpadding

   Data type
         int /stdWrap

   Description


   Default


.. container:: table-row

   Property
         color.field

   Data type
         string

   Description
         Set to field name from the $cObj->data-array

   Default


.. container:: table-row

   Property
         color.default

         color.1

         color.2

   Data type
         string

   Description
         [default],[1],[2] = User defined

   Default


.. container:: table-row

   Property
         params

   Data type
         <TABLE>-params

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:->tableStyle]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   styles.content.tableStyle {
     align.field = text_align
     border.field = table_border
     cellspacing.field = table_cellspacing
     cellpadding = 1

     color.field = table_bgColor
     color.default = {$styles.content.tableStyle.color}
     color.1 = {$styles.content.tableStyle.color1}
     color.2 = {$styles.content.tableStyle.color2}
   }

