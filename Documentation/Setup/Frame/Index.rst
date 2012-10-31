.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _frame:

"FRAME"
^^^^^^^


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
         obj

   Data type
         *pointer to top-level object-name*

   Description
         top-level object-name of a PAGE / FRAMESET

         **Example:**

         "left", "page", "frameset"

   Default


.. container:: table-row

   Property
         options

   Data type
         *url-parameters*

   Description
         **Example:**

         print=1&othervar=anotherthing

         would add ' *&print=1&othervar=anotherthing* ' to the ".src"-content
         (if not ".src" is set manually!!)

   Default


.. container:: table-row

   Property
         params

   Data type
         <frame>-params

   Description
         **Example:**

         scrolling="AUTO" noresize frameborder="NO"

   Default


.. container:: table-row

   Property
         name

   Data type
         <frame>-data:name

   Description
         Manually set name of frame

         **NOTE:** Is set automatically and should not be overridden under
         normal conditions!

   Default
         value of ".obj"


.. container:: table-row

   Property
         src

   Data type
         <frame>-data:src /stdWrap

   Description
         Instead of using the "obj" destination, you can define a specific src
         for your frame with this setting. This overrides the default behavior
         of using the "obj" parameter!

   Default
         typolink to id=[currentId]&type=[obj->typeNum]


.. ###### END~OF~TABLE ######


[tsref:(page).frameSet.(number)/->FRAMESET.(number)]


((generated))
"""""""""""""

Example of a simple frameset with a topframe and content-frame:
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

   frameset = PAGE
   frameset.typeNum = 0

   page = PAGE
   page.typeNum = 1

   top = PAGE
   top.typeNum = 3

   frameset.frameSet.rows = 150,*
   frameset.frameSet.params = border="0" framespacing="0" frameborder="NO"
   frameset.frameSet {
     1 = FRAME
     1.obj = top
     1.params = scrolling="NO" noresize frameborder="NO" marginwidth="0" marginheight="0"
     2 = FRAME
     2.obj = page
     2.params = scrolling="AUTO" noresize frameborder="NO"
   }

