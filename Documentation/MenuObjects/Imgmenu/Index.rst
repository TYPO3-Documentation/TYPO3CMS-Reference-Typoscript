.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _imgmenu:

IMGMENU
^^^^^^^

Imagemaps are made by creating one large GIFBUILDER object based on
the GIFBUILDER object ".main" and adding the properties of the
GIFBUILDER objects for each item (NO, ACT, SPC... and so on).

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         target

   Data type
         target

   Description
         Target of the menu links

   Default
         self


.. container:: table-row

   Property
         forceTypeValue

   Data type
         integer

   Description
         If set, the &type parameter of the link is forced to this value
         regardless of target.


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         Wraps the whole image-map.


.. container:: table-row

   Property
         params

   Data type
         <img>-params


.. container:: table-row

   Property
         main

   Data type
         ->GIFBUILDER

   Description
         Main configuration of the image-map! This defines the "underlay"!


.. container:: table-row

   Property
         dWorkArea

   Data type
         offset + calc

   Description
         Main offset of the GIFBUILDER-items (also called the "distribution")


.. container:: table-row

   Property
         [Common Item States, see above]

   Data type
         ->IMGMENUITEM

         \+ .distrib

   Description
         This is the TMENUITEM-options for each category of menu item that can
         be generated.

         **Special:**

         The ->OptionSplit function is run on the whole GIFBUILDER-
         configuration before the items are generated.

         **.distrib** is (x,y,v,h +calc) of the distribution of the menu items.
         This provides a way to space each item from the other. The codes
         "textX" and "textY" can be used for the width (X) and height (Y)
         dimension of each link.

         This works by adding a WORKAREA-Gifbuilder Object between each of the
         IMGMENUITEM ("subset" of a GIFBUILDER object) and this work area
         defines where the text should be printed. As such the "x,y" defines
         the offset **the next item will have** (this should be the width of
         the previous in many cases!) and "v,h" defines the **dimensions of
         the current item**.

         Consider this example taken from the static\_template "template: MM":

         NO.distrib = textX+10, 0, textX+10, textY+5

         In the future TypoScript may provide better ways to position
         GIFBUILDER objects on the image-maps!

         **ImgMap** is automatically used on the links! (Meaning the ".imgMap"
         property of the TEXT objects in the GIFBUILDER objects is set
         automatically, unless it is already set.)


.. container:: table-row

   Property
         imgMapExtras

   Data type
         <area...>-tags

   Description
         Extra <area...>tags for the image-map


.. container:: table-row

   Property
         debugRenumberedObject

   Data type
         boolean

   Description
         if set, the final GIFBUILDER object configuration is output in order
         for you to debug your configuration


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).IMGMENU]

