.. include:: ../../Includes.txt


.. _cobj-columns:

COLUMNS
^^^^^^^

.. note::

   This content object has been deprecated in TYPO3 CMS 7.1. If you still use it
   for now, you need to install the extension "compatibility6". In the
   long run, you are advised to migrate to alternatives such as FLUIDTEMPLATE to
   customize the output of the content.

Inserts a table with several columns. Size and styling of the table
tag can be defined with the according options.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         tableParams

   Data type
         <TABLE>-params /:ref:`stdWrap <stdwrap>`

   Description
         Attributes of the table tag.

   Default
         border="0" cellspacing="0" cellpadding="0"


.. container:: table-row

   Property
         TDparams

   Data type
         <TD>-params /:ref:`stdWrap <stdwrap>`

   Description
         Attributes of the td tags.

   Default
         valign="top"


.. container:: table-row

   Property
         rows

   Data type
         integer (Range: 2-20) /:ref:`stdWrap <stdwrap>`

   Description
         The number of rows in the columns.

   Default
         2


.. container:: table-row

   Property
         totalWidth

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The total-width of the columns+gaps.


.. container:: table-row

   Property
         gapWidth

   Data type
         integer /:ref:`stdWrap <stdwrap>` :ref:`+optionSplit <objects-optionsplit>`

   Description
         Width of the gap between columns.

         0 = no gap


.. container:: table-row

   Property
         gapBgCol

   Data type
         HTML-color /:ref:`stdWrap <stdwrap>` :ref:`+optionSplit <objects-optionsplit>`

   Description
         Background-color for the gap-tablecells.


.. container:: table-row

   Property
         gapLineThickness

   Data type
         integer /:ref:`stdWrap <stdwrap>` :ref:`+optionSplit <objects-optionsplit>`

   Description
         Thickness of the divider line in the gap between cells.

         0 = no line


.. container:: table-row

   Property
         gapLineCol

   Data type
         HTML-color /:ref:`stdWrap <stdwrap>` :ref:`+optionSplit <objects-optionsplit>`

   Description
         Line color of the divider line.

   Default
         black


.. container:: table-row

   Property
         [column-number]

         1,2,3,4...

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         This is the content object for each column.


.. container:: table-row

   Property
         after

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         This is a cObject placed after the columns-table.


.. container:: table-row

   Property
         if

   Data type
         :ref:`->if <if>`

   Description
         If "if" returns false, the columns are not rendered!


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).COLUMNS]

