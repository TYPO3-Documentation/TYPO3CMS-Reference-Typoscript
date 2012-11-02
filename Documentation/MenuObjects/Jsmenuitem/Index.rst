.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _jsmenuitem:

JSMENUITEM
^^^^^^^^^^

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
         noLink

   Data type
         boolean

   Description
         Normally the selection of a menu item in the selector box will update
         the selector on the next level (if there is a next level) and if there
         are no items for that selector (because there were no subpages), then
         the link jumps to the page of itself.

         If this flag is set, however, no menu items in the selector box will
         ever link to anything. Only update the content of the next selector
         box on next level.

   Default


.. container:: table-row

   Property
         alwaysLink

   Data type
         boolean

   Description
         If set an item in the menu selector will always link. This takes
         precedence over "noLink".

   Default


.. container:: table-row

   Property
         showFi rst

   Data type
         boolean

   Description
         if set, the first link will be shown when the menu is updated.

   Default


.. container:: table-row

   Property
         showActive

   Data type
         boolean

   Description
         if set, the active level will be selected, if present

   Default


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         wraps the selector box

   Default


.. container:: table-row

   Property
         width

   Data type
         int+

   Description
         Initial width of the boxes set by a number of \_ (underscores)

   Default
         14


.. container:: table-row

   Property
         elements

   Data type
         int+

   Description
         Initial number of elements in the menu. This is of course overruled by
         the actual menu item texts.

   Default
         5


.. container:: table-row

   Property
         additionalParams

   Data type
         string

   Description
         Additional parameters to the <select> box. Eg, you could set the width
         with a style-parameter like this:

         style="width: 200px;"

   Default


.. container:: table-row

   Property
         firstLabel

   Data type
         string

   Description
         Firt label in top of the menu (default is blank)

   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).JSMENUITEM]


Example:
""""""""

::

   # The menu:
   temp.jsmenu = HMENU
   temp.jsmenu.1 = JSMENU
   temp.jsmenu.1 {
     levels = 2
     1.wrap = |<br>
     2.wrap = |<hr>
   }

   # Insert on page.
   page = PAGE
   page.typeNum =0
   page.5 = TEXT
   page.5.field = title
   page.10 < temp.jsmenu

This draws a menu with two selector boxes.

