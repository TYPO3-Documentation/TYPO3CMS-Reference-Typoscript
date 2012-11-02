.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-ctable:

CTABLE
^^^^^^

Creates a table in which you can define the content of the the various
cells.

A CTABLE is a little more feature packed than the simple OTABLE. It
features a content column and four surrounding columns, which may be
useful for putting menus into them.

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

   Default
         0,0


.. container:: table-row

   Property
         tm

   Data type
         ->CARRAY +TDParams /stdWrap

   Description
         TopMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.

   Default


.. container:: table-row

   Property
         lm

   Data type
         ->CARRAY +TDParams /stdWrap

   Description
         LeftMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.

   Default


.. container:: table-row

   Property
         rm

   Data type
         ->CARRAY +TDParams /stdWrap

   Description
         RightMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.

   Default


.. container:: table-row

   Property
         bm

   Data type
         ->CARRAY +TDParams /stdWrap

   Description
         BottomMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.

   Default


.. container:: table-row

   Property
         c

   Data type
         ->CARRAY +TDParams /stdWrap

   Description
         Content-cell

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.

   Default


.. container:: table-row

   Property
         cMargins

   Data type
         margins /stdWrap

   Description
         Distance around the content-cell "c".

   Default
         0,0,0,0


.. container:: table-row

   Property
         cWidth

   Data type
         pixels /stdWrap

   Description
         Width of the content-cell "c".

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

[tsref:(cObject).CTABLE]


.. _cobj-ctable-examples:

Example:
""""""""

::

   page.10 = CTABLE
   page.10 {
     offset = 5, 0
     tableParams = style="border-width: 0px; width: 400px;"
     cWidth = 400
     c.1 = CONTENT
     c.1.table = tt_content
     c.1.select {
       pidInList = this
       orderBy = sorting
     }

     tm.10 < temp.sidemenu
     tm.TDParams = valign="top"

     stdWrap.wrap = <div id="mytable">|</div>
   }

