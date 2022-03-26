.. include:: /Includes.rst.txt


.. _cobj-cobj-array:
.. _cobj-coa:
.. _cobj-coa-int:

COA, COA\_INT
^^^^^^^^^^^^^

COA stands for "content object array" and is a cObject, in which you
can place several other cObjects using numbers to enumerate them.

You can also create this object as a COA\_INT in which case it works
exactly like the :ref:`USER_INT <cobj-user-int>` object does: It's
rendered non-cached! That way COA\_INT allows you not only to render
:ref:`USER_INT <cobj-user-int>` objects non-cached, but to render
*every* cObject non-cached.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         if

   Data type
         :ref:`->if <if>`

   Description
         If "if" returns false, the COA is **not** rendered.


.. container:: table-row

   Property
         1,2,3,4...

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Numbered properties to define the different cObjects, which should be
         rendered.


.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. container:: table-row

   Property
         includeLibs

   Data type
         *(list of resources)* /:ref:`stdWrap <stdwrap>`

   Description
         **(This property is used only if the object is COA\_INT! See
         introduction.)**

         This is a comma-separated list of resources that are included as PHP-
         scripts (with include\_once() function) if this script is included.

         This is possible to do, because any include-files will be known before
         the scripts are included. That is not the case with the regular
         COA cObject.

         **Note:** This property is deprecated in TYPO3 7 and will be
         removed with TYPO3 8! Make sure everything that was previously loaded
         via includeLibs is now encapsulated in proper PHP classes, which is
         referenced by COA/COA_INT when needed. Use proper class naming and
         autoloading.


.. ###### END~OF~TABLE ######


[tsref:(cObject).COA/(cObject).COA\_INT]


.. _cobj-cobj-array-examples:
.. _cobj-coa-examples:
.. _cobj-coa-int-examples:

Examples:
"""""""""

::

   lib.menutable = COA
   lib.menutable {
     10 = TEXT
     10.value = <table border="0" style="border-spacing: 0px;">

     20 = HMENU
     20.entryLevel = 0
     20.1 = GMENU
     20.1.NO {
       wrap = <tr><td> | </td></tr>
       XY = {$menuXY}
       backColor = {$bgCol}
       20 = TEXT
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

The previous example will print a table with a graphical menu in it.

::

   lib.currentDate = COA_INT
   lib.currentDate {
     10 = TEXT
     10.stdWrap.data = date:U
     10.stdWrap.strftime = %H:%M:%S
   }

This example will not be cached and so will display the current time
on each page hit.
