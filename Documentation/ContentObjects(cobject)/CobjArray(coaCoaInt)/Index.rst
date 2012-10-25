.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


COBJ\_ARRAY (COA, COA\_INT)
^^^^^^^^^^^^^^^^^^^^^^^^^^^

This is a cObject, in which you can place several other cObjects using
numbers to enumerate them.

It has the alias COA standing for "content object array". You can also
call it "COA" instead of COBJ\_ARRAY.

You can also create this object as a COA\_INT in which case it works
exactly like the USER\_INT object does: It's rendered non-cached! The
COA\_INT provides a way to utilize this feature not only with USER
cObjects but with any cObject.


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
         1,2,3,4...

   Data type
         cObject

   Description


   Default


.. container:: table-row

   Property
         if

   Data type
         ->if

   Description
         if "if" returns false the COA is NOT rendered

   Default


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description


   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. container:: table-row

   Property
         includeLibs

   Data type
         *list of* resource /stdWrap

   Description
         **(This property is used only if the object is COA\_INT!, See
         introduction.)**

         This is a comma-separated list of resources that are included as PHP-
         scripts (with include\_once() function) if this script is included.

         This is possible to do because any include-files will be known before
         the scripts are included. That's not the case with the regular
         PHP\_SCRIPT cObject.

   Default


.. ###### END~OF~TABLE ######


[tsref:(cObject).COA/(cObject).COA\_INT/(cObject).COBJ\_ARRAY]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   temp.menutable = COBJ_ARRAY
   temp.menutable {
     10 = TEXT
     10.value = <table border="0" cellpadding="0" cellspacing="0">

     20 = HMENU
     20.entryLevel = 0
     20.1 = GMENU
     20.1.NO {
       wrap = <tr><td> | </td></tr>
       XY = {$menuXY}
       backColor = {$bgCol}
       20  = TEXT
       20 {
         text.field = title
         fontFile = fileadmin/fonts/hatten.ttf
         fontSize = 23
         fontColor = {$menuCol}
         offset = |*| 5,18 || 25,18
       }
     }

     30 = TEXT
     30.value = </table>
   }

