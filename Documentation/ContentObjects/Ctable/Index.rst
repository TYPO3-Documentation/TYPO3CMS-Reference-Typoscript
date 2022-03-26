.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: /Includes.rst.txt


.. _cobj-ctable:

CTABLE
^^^^^^

.. note::

   This content object has been deprecated in TYPO3 CMS 7.1. If you still use it
   for now, you need to install the extension "compatibility6". In the
   long run, you are advised to migrate to alternatives such as FLUIDTEMPLATE to
   customize the output of the content.

Creates a table in which you can define the content of the various
cells.

A CTABLE is a little more feature packed than the simple
:ref:`OTABLE <cobj-otable>`. It features a content column and four
surrounding columns, which may be useful for putting menus into them.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         offset

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Description
         Offset from upper left corner.

   Default
         0,0


.. container:: table-row

   Property
         tm

   Data type
         :ref:`->CARRAY <carray>` +TDParams /:ref:`stdWrap <stdwrap>`

   Description
         TopMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.


.. container:: table-row

   Property
         lm

   Data type
         :ref:`->CARRAY <carray>` +TDParams /:ref:`stdWrap <stdwrap>`

   Description
         LeftMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.


.. container:: table-row

   Property
         rm

   Data type
         :ref:`->CARRAY <carray>` +TDParams /:ref:`stdWrap <stdwrap>`

   Description
         RightMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.


.. container:: table-row

   Property
         bm

   Data type
         :ref:`->CARRAY <carray>` +TDParams /:ref:`stdWrap <stdwrap>`

   Description
         BottomMenu

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.


.. container:: table-row

   Property
         c

   Data type
         :ref:`->CARRAY <carray>` +TDParams /:ref:`stdWrap <stdwrap>`

   Description
         Content-cell

         The default value of TDParams is: valign="top".

         stdWrap is available for the property TDParams.


.. container:: table-row

   Property
         cMargins

   Data type
         :ref:`margins <data-type-margins>` /:ref:`stdWrap <stdwrap>`

   Description
         Distance around the content-cell "c".

   Default
         0,0,0,0


.. container:: table-row

   Property
         cWidth

   Data type
         :ref:`pixels <data-type-pixels>` /:ref:`stdWrap <stdwrap>`

   Description
         Width of the content-cell "c".


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
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


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
     tm.TDParams = style="vertical-align: top;"

     stdWrap.wrap = <div id="mytable">|</div>
   }

