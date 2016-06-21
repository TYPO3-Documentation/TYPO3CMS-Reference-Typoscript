.. include:: ../../Includes.txt


.. _cobj-otable:

OTABLE
^^^^^^

.. note::

   This content object has been deprecated in TYPO3 CMS 7.1. If you still use it
   for now, you need to install the extension "compatibility6". In the
   long run, you are advised to migrate to alternatives such as FLUIDTEMPLATE to
   customize the output of the content.

Creates a simple table. You can set an offset and some parameters for
the table tag.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         offset

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Description
         Offset from upper left corner.

         **Note:**

         Actually the data type is "x,y,r,b,w,h" and stdWrap:

         x,y is the offset from upper left corner.

         r,b is the offset (margin) to right and bottom.

         w is the required width of the content field.

         h is the required height of the content field.

         All measures are in pixels.


.. container:: table-row

   Property
         1,2,3,4...

   Data type
         :ref:`cObject <data-type-cobject>`


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

[tsref:(cObject).OTABLE]


.. _cobj-otable-examples:

Example:
""""""""

::

   top.100 = OTABLE
   top.100.offset = 310,8
   top.100.tableParams = border="1" style="border-spacing: 0px;"
   top.100.1 < temp.topmenu

