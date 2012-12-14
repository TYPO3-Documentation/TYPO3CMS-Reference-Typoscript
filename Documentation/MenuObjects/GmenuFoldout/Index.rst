.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _gmenu-foldout:

GMENU\_FOLDOUT
^^^^^^^^^^^^^^

GMENU\_FOLDOUT works as an extension to GMENU, which means the these
properties underneath is additional properties to the ones above.

The purpose of GMENU\_FOLDOUT is to create 2-level menus which are
folded out dynamically.

It works with both Netscape, Mozilla, Microsoft internet Explorer and
Opera. The menu on the first level is a GMENU because GMENU\_FOLDOUT
is responsible for this, but the submenu on the next level (referred
to as 2nd level) can be both TMENU and another GMENU.

**Note:** You must include the library
"typo3/sysext/statictemplates/media/scripts/gmenu\_foldout.php".

The script implemented is taken from
http://www9.ewebcity.com/skripts/foldoutmenu\_move.htm

**Compatibility:** MSIE 4+, Netscape 4+ and 6+, Opera 5+

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
         dontLinkIfSubmenu

   Data type
         boolean

   Description
         If set, items that has a submenu is not linked. Items without a
         submenu are always linked in the regular ways.


.. container:: table-row

   Property
         foldTimer

   Data type
         integer

   Description
         The timeout in the animation, these are milliseconds.

   Default
         40


.. container:: table-row

   Property
         foldSpeed

   Data type
         integer, range 1-100

   Description
         How many steps in an animation? Choose 1 for no animation.

   Default
         1


.. container:: table-row

   Property
         stayFolded

   Data type
         boolean

   Description
         Stay open when you click a new toplink? (Level 1)


.. container:: table-row

   Property
         bottomHeight

   Data type
         integer, pixels

   Description
         Sets the height of the bottom layer. Is important if the bottom layer
         contains either content or a background color: Else the layer will be
         clipped.

   Default
         100


.. container:: table-row

   Property
         menuWidth

   Data type
         integer, pixels

   Description
         Width of the whole menu main layer. Important to set, especially for
         the bottom layer as it is clipped by this value. Always try to set
         this to the width in pixels of the menu.

   Default
         170


.. container:: table-row

   Property
         menuHeight

   Data type
         integer

   Description
         Height of the whole menu layer. Seems not to be not that important.

   Default
         400


.. container:: table-row

   Property
         subMenuOffset

   Data type
         x,y

   Description
         Offset of the submenu for each menu item. This is important because if
         you don't set this value the items will appear on top of their
         "parent".


.. container:: table-row

   Property
         menuOffset

   Data type
         x,y

   Description
         Offset of the menu main layer on the page. From upper left corner


.. container:: table-row

   Property
         menuBackColor

   Data type
         HTML-color

   Description
         Background color behind menu. If not set, transparent (which will not
         work very well in case .foldSpeed is set to something else than 1. But
         see for yourself)


.. container:: table-row

   Property
         dontWrapInTable

   Data type
         boolean

   Description
         By default every menu item on the first level is wrapped in a table:

         <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TR><TD>

         [menu item HTML here..]

         </TD></TR></TABLE>

         Doing this ensures that the layers renders equally in the supported
         browsers. However you might need to disable that which is what you can
         do by setting this flag.

         **Note:** Using <TBODY> in this tables seems to break Netscape 4+

   Default
         0


.. container:: table-row

   Property
         bottomContent

   Data type
         cObject

   Description
         Content for the bottom layer that covers the end of the menu.


.. container:: table-row

   Property
         adjustItemsH

   Data type
         integer

   Description
         Adjusts the height calculation of the menulayers of the first level
         (called Top)

         **Example:** ::

            -10

         This value will substract 10 pixels from the height of the layer in
         calculations.


.. container:: table-row

   Property
         adjustSubItemsH

   Data type
         integer

   Description
         Adjusts the height calculation of the menu layers of the second level
         (subitems, called Sub)

         See above


.. container:: table-row

   Property
         arrowNO

         arrowACT

   Data type
         imgResource

   Description
         If both arrowNO and arrowACT is defined and valid imgResources then
         these images are use as "traditional arrows" that indicates whether an
         item is expanded (active) or not.

         NO is normal, ACT is expanded

         The image is inserted just before the menu item. If you want to change
         the position, put the marker ###ARROW\_IMAGE### into the wrap of the
         item and the image will be put there instead.


.. container:: table-row

   Property
         arrowImgParams

   Data type
         <img> params

   Description
         Parameters to the arrow-image.

         **Example:** ::

            hspace=5 vspace=7


.. container:: table-row

   Property
         displayActiveOnLoad

   Data type
         boolean

   Description
         If set, the active menu items will fold out "onLoad".


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).GMENU\_FOLDOUT]


Example:
""""""""

::

   ## GMENU_FOLDOUT
   includeLibs.gmenu_foldout = typo3/sysext/statictemplates/media/scripts/gmenu_foldout.php

   temp.foldoutMenu = HMENU
   temp.foldoutMenu.1 = GMENU_FOLDOUT
   temp.foldoutMenu.1.expAll = 1
   temp.foldoutMenu.1.NO {
     wrap = | <br>
     XY = 150,20
     backColor = silver

     10 = TEXT
     10.text.field = title
     10.fontSize = 12
     10.fontColor = Blue
     10.offset = 2,10
   }
   temp.foldoutMenu.1.RO < temp.foldoutMenu.1.NO
   temp.foldoutMenu.1.RO = 1
   temp.foldoutMenu.1.RO {
     10.fontColor = red
   }
   temp.foldoutMenu.2 = TMENU
   temp.foldoutMenu.2.NO {
     linkWrap = <nobr><font face=verdana size=1 color=black><b>|</b></font></nobr><br>
     stdWrap.case = upper
   }
   temp.foldoutMenu.1 {
     dontLinkIfSubmenu = 1
     stayFolded=1
     foldSpeed = 6
     subMenuOffset = 10,18
     menuOffset = 100,20
     menuBackColor = silver
     bottomBackColor = silver
     menuWidth = 170

     arrowNO = typo3/sysext/statictemplates/media/bullets/arrow_no.gif
     arrowACT = typo3/sysext/statictemplates/media/bullets/arrow_act.gif
     arrowImgParams = hspace=4 align=top

     bottomContent = TEXT
     bottomContent.value = Hello World! Here is some content!
   }

.. figure:: ../../Images/GmenuFoldout.png
   :alt: Example of this menu.

This creates a menu like this (above). One important point is the line ::

   temp.foldoutMenu.1.expAll = 1

If you don't set this (just like the GMENU\_LAYERS) then the second
level is not generated!

