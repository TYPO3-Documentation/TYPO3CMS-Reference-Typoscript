.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-columns:

COLUMNS
^^^^^^^

Inserts a table with several columns. Size and styling of the table
tag can be defined with the according options.

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
         tableParams

   Data type
         <TABLE>-params /stdWrap

   Description
         Attributes of the table tag.

   Default
         border="0" cellspacing="0" cellpadding="0"


.. container:: table-row

   Property
         TDparams

   Data type
         <TD>-params /stdWrap

   Description
         Attributes of the td tags.

   Default
         valign="top"


.. container:: table-row

   Property
         rows

   Data type
         integer (Range: 2-20) /stdWrap

   Description
         The number of rows in the columns.

   Default
         2


.. container:: table-row

   Property
         totalWidth

   Data type
         integer /stdWrap

   Description
         The total-width of the columns+gaps.


.. container:: table-row

   Property
         gapWidth

   Data type
         integer /stdWrap

         +optionSplit

   Description
         Width of the gap between columns.

         0 = no gap


.. container:: table-row

   Property
         gapBgCol

   Data type
         HTML-color /stdWrap

         +optionSplit

   Description
         Background-color for the gap-tablecells.


.. container:: table-row

   Property
         gapLineThickness

   Data type
         integer /stdWrap

         +optionSplit

   Description
         Thickness of the divider line in the gap between cells.

         0 = no line


.. container:: table-row

   Property
         gapLineCol

   Data type
         HTML-color /stdWrap

         +optionSplit

   Description
         Line color of the divider line.

   Default
         black


.. container:: table-row

   Property
         [column-number]

         1,2,3,4...

   Data type
         cObject

   Description
         This is the content-object for each column.


.. container:: table-row

   Property
         after

   Data type
         cObject

   Description
         This is a cObject placed after the columns-table.


.. container:: table-row

   Property
         if

   Data type
         ->if

   Description
         If "if" returns false, the columns are not rendered!


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap


.. ###### END~OF~TABLE ######

[tsref:(cObject).COLUMNS]

