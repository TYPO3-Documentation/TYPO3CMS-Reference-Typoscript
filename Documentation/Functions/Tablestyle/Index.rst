.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _tablestyle:

tableStyle
^^^^^^^^^^

This is used to style a table-tag. The input is wrapped by this table-
tag.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         align

   Data type
         align /:ref:`stdWrap <stdwrap>`

   Description
         Specifies the alignment of the table according to surrounding
         text.


.. container:: table-row

   Property
         border

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The number of pixels for the table border.


.. container:: table-row

   Property
         cellspacing

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The number of pixels for the cellspacing.


.. container:: table-row

   Property
         cellpadding

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The number of pixels for the cellpadding.


.. container:: table-row

   Property
         color.field

   Data type
         string

   Description
         Set to field name from the $cObj->data-array.


.. container:: table-row

   Property
         color.default

         color.1

         color.2

         color...

   Data type
         string

   Description
         Set background colors for the table. One of these colors
         will be used depending on the value of color.field. You can
         set the colors using color names, hex numbers or RGB numbers.

         [default],[1],[2] are user defined.


.. container:: table-row

   Property
         params

   Data type
         <table>-params

   Description
         Additional parameters for the table tag. E.g.::

            id="my-table"

         This will add the id attribute with the value "my-table" to
         the table tag.

.. ###### END~OF~TABLE ######

[tsref:->tableStyle]


.. _tablestyle-examples:

Example:
""""""""

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

