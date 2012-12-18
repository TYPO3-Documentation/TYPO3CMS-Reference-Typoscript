.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _gmenulayers:
.. _tmenulayers:

GMENU\_LAYERS / TMENU\_LAYERS
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

GMENU\_LAYERS / TMENU\_LAYERS works as an extension to GMENU/TMENU,
which means that the properties underneath are additional properties
to the ones above.

The purpose of xMENU\_LAYERS is to create 2-level (or more!) menus
where the 2nd+ level is shown on a DHTML-layer. Most features work
with modern browsers including Netscape, Microsoft Internet Explorer,
Mozilla, Konqueror and Opera. You can cascade the menus as you like.

**Note:** You must include the library
"typo3/sysext/statictemplates/media/scripts/gmenu\_layers.php" (for
GMENU\_LAYERS) and/or
"typo3/sysext/statictemplates/media/scripts/tmenu\_layers.php" (for
TMENU\_LAYERS) and you must also expand the xMENU\_LAYERS to the next
for the menu to make sense (use the expAll-flag).

**Compatibility:** MSIE 4+, Netscape 4+ and 6+, Opera 5+, Konqueror.

**Notes:**

- Netscape 4 does not support mouseover on the layers.

- Opera seems to have problems with the mouseout event if you roll from
  an element to a layer. Then the event may not be fired before entering
  the layer. It happens only if the layer is placed very close to the
  trigger element. Problems from this may be that the rollover state of
  the items are not reset.

- Possible bug; It has been seen with cascaded layers that Opera may
  suddenly refuse any interaction on the page, even clicking normal
  links. It may be a JavaScript error that makes this happen, but as
  even normal links are not clickable anymore, I'm not really sure.
  Seems to be no problem with single-level menu.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         layerStyle

   Data type
         <DIV>-tag params

   Description
         Parameters for the <DIV>-layer-tags in the HTML-document. You might
         probably not need change this.

         **Example:**

         position: absolute; VISIBILITY: hidden;

   Default
         position:absolute; visibility: hidden;


.. container:: table-row

   Property
         lockPosition

   Data type
         "x" / "y" / ""

   Description
         If this is set to "x" or "y" the menu on the layers is locked and does
         not follow the mouse-cursor (which it does if this is not set).

         "x" or "y" defines respectively that the summed width (x) or height
         (y) is added to the x or y offset of the menu. That means that you
         should set this value to "x" if you have a horizontal GMENU\_LAYERS
         and to "y" if you have a vertical menu.


.. container:: table-row

   Property
         dontFollowMouse

   Data type
         boolean

   Description
         If set and lockPosition is blank (so that the menu layer follows the
         mouse) then the menu will **not** follow the mouse but still it will
         appear where the mouse cursor hit the trigger-element. Useful if you
         don't know the exact positions of elements.

         **Warning:** You should not set displayActiveOnLoad for menus with
         this feature enabled (because the absolute position of the layer is
         not known).


.. container:: table-row

   Property
         lockPosition\_adjust

   Data type
         integer

   Description
         A number which is added to the width/height of the menu items in order
         to compensate for e.g. hspace or other things between the images in
         the GMENU\_LAYERS


.. container:: table-row

   Property
         lockPosition\_addSelf

   Data type
         boolean

   Description
         Normally the width and height of the items (+lockPosition\_adjust) are
         summed up after the item has been rendered. This is good if the
         direction of the menu layers is right- og downwards.

         But if you use directionLeft/directionUp, you might want to add the
         width of the items before.

         If so, set this flag.


.. container:: table-row

   Property
         xPosOffset

   Data type
         integer

   Description
         The offset of the menu from the point where it's "activated" (if
         lockPosition is false) / from top left page corner (if lockPosition is
         set)


.. container:: table-row

   Property
         yPosOffset

   Data type
         integer

   Description
         As above, but for the y-dimension.


.. container:: table-row

   Property
         topOffset

   Data type
         integer

   Description
         The offset of menu items from top of browser. Should be set rather
         than defining it in the .layerStyle property. Must be set in order to
         use directionUp.

         Used with either lockPosition=x or xPosOffset defined.


.. container:: table-row

   Property
         leftOffset

   Data type
         integer

   Description
         The offset of menu items from left border of browser. Should be set
         rather than defining it in the .layerStyle property. Must be set in
         order to use directionLeft.

         Used with either lockPosition=y or yPosOffset defined.


.. container:: table-row

   Property
         blankStrEqFalse

   Data type
         boolean

   Description
         If set, then the properties topOffset,leftOffset, xPosOffset,
         yPosOffset are considered "blank" if they are really blank strings -
         not just "zero". You should enable this if you wish to be able to work
         with zero offsets. This is typically the case if you use relative
         positioning.


.. container:: table-row

   Property
         directionLeft

   Data type
         boolean

   Description
         Set this, if you want the items to be right-aligned (pop's out towards
         the left).

         Does not work with Opera at this time because I don't know how to make
         Opera read the width of each layer.

         If you set the width of the menu-layers in .layerStyles this might
         work no matter what.


.. container:: table-row

   Property
         directionUp

   Data type
         boolean

   Description
         Set this, if you want the items to be bottom-aligned (pop's out
         upwards instead of downwards).


.. container:: table-row

   Property
         setFixedWidth

   Data type
         integer

   Description
         For GMENU\_LAYERS the width and heights of the element is normally
         known from the graphical item. For TMENU\_LAYERS this cannot be known
         in the same way. Therefore you can use .setFixedWidth and
         .setFixedHeight to set these values to a number you find reasonable.
         Of course this may be blasted by the browsers rendering if the font
         gets out of proportions etc.

         Alternatively you may want to use the property "relativeToTriggerItem"
         which will position your menu layers relative to the item you roll
         over. This has some drawbacks though. A middle solution is to use a
         menu with lockPosition set to blank and dontFollowMouse set to true.
         Then you need only specify either an x or y coordinate to follow and
         the item will appear where the mouse hits the element.

         **Note:** Active if value is **not** a blank string. Setting this value
         to zero means that no width is calculated for the items in
         GMENU\_LAYERS.


.. container:: table-row

   Property
         setFixedHeight

   Data type
         integer

   Description
         See "setFixedWidth". Same, but for height.


.. container:: table-row

   Property
         bordersWithin

   Data type
         l,t,r,b,l,t

   Description
         Keep borders of the layer within these limits in pixels. Zero is 'not
         set'

         (Syntax: List of integers, evaluated clockwise: Left, Top, Right,
         Bottom, Left, Top)


.. container:: table-row

   Property
         displayActiveOnLoad

   Data type
         boolean

   Description
         If set, the submenu-layer of the active menu item is opened at page-
         load. If .freezeMouseover is also set and there is RO defined for the
         main menu items, the menu item belonging to the displayed submenu is
         also shown.

         **Properties:**

         .onlyOnLoad (boolean)

         If set, then the display of the active item will happen only when the
         page is loaded. The display will not be restored on mouseout of other
         items.

         **Warning:** If you are cascading GMENU\_LAYER objects, make sure that
         all elements before this element (for which you set this attribute)
         also have this attribute set!


.. container:: table-row

   Property
         freezeMouseover

   Data type
         boolean

   Description
         If set, any mouseout effect of main menu items is removed not on roll-
         out but when another element is rolled over (or the layer is
         hidden/default layer restored)

         **Properties:**

         .alwaysKeep (boolean)

         If set, the frozen element will always stay, even if the submenu is
         hidden.


.. container:: table-row

   Property
         hideMenuWhenNotOver

   Data type
         positive integer

   Description
         If set (> 1) then the menu will hide it self whenever a user moves the
         cursor away from the menu. The value of this parameter determines the
         width (pixels) of the zone around the element until the mouse pointer
         is considered to be far enough away to hide the layer.


.. container:: table-row

   Property
         hideMenuTimer

   Data type
         positive integer

   Description
         This is the number of milliseconds to wait before the submenu will
         disappear if hideMenuWhenNotOver is set.


.. container:: table-row

   Property
         dontHideOnMouseUp

   Data type
         boolean

   Description
         If set, the menu will not hide its layers when the mouse button is
         clicked. Useful if your menu items loads the pages in another frame.


.. container:: table-row

   Property
         layer\_menu\_id

   Data type
         string

   Description
         If you want to specifically name a menu on a page. Probably you don't
         need that!

         **Warning:** Don't use underscore and special characters in this
         string. Stick to alpha-numeric characters.

   Default
         [random 6 char hashstring]


.. container:: table-row

   Property
         relativeToTriggerItem

   Data type
         boolean

   Description
         This allows you to position the menu layers relative to the item that
         triggers it. However you should be aware of the following facts:

         - This does not work with Netscape 4 - the position of the trigger layer
           will be calculated to zero and thus the offset for all menu layers
           will be 0,0 + your values.

         - This feature will wrap the menu item in some <div>-tags right before
           the whole item is wrapped by the .wrap code (for GMENU\_LAYERS) or
           .allWrap (for TMENU\_LAYERS). The bottom line of this is: 1) If your
           menu is horizontal, always wrap your menu items in a table so line
           breaks does not appear because of the <div>-tags and 2) make sure the
           wrapping of the table cell is done with the .wrap/.allWrap properties
           respectively.

         - Works only effectively on the first xMENU\_LAYER in a cascade. For
           succeeding xMENU\_LAYERS items please use "relativeToParentLayer".

         *If set, properties xPosOffset, yPosOffset and lockPosition\* are not
         functional (properties directionLeft, directionUp, topOffset and
         leftOffset are still active)*

         **Additional Properties:**

         **.addWidth:** Adds the width of the trigger element.

         **.addHeight:** Adds the height of the trigger element.


.. container:: table-row

   Property
         relativeToParentLayer

   Data type
         boolean

   Description
         If set, then the layer will be positioned relative to the previous
         layer (parent) in a cascaded series of xMENU\_LAYERS. Basically the
         relative position of the parent layer is just added to the offset of
         the current menu.

         **Warning:** This property makes sense only if there really is a
         previous GMENU\_LAYER to get position from! So you must have a
         cascaded menu!

         **Additional Properties:**

         **.addWidth:** Adds the width of the parent layer.

         **.addHeight:** Adds the height of the parent layer.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).GMENU\_LAYERS,
(cObject).HMENU.(mObj).TMENU\_LAYERS]


Example:
""""""""

::

   page.includeLibs.gmenu_layers = typo3/sysext/statictemplates/media/scripts/gmenu_layers.php
   page.10 = HMENU
   page.10.1 = GMENU_LAYERS
   page.10.1 {
     layerStyle = position: absolute; visibility: hidden;
     xPosOffset = -30
     lockPosition = x
     expAll=1
     leftOffset = 15
     topOffset = 30
   }
   page.10.1.NO {
     backColor = #cccccc
     XY = [10.w]+10, 14
     10 = TEXT
     10.text.field = title
     10.offset = 5,10
   }
   page.10.2 = GMENU
   page.10.2.wrap = <nobr>|</nobr>
   page.10.2.NO {
     backColor = #99cccc
     XY = [10.w]+10, 14
     10 = TEXT
     10.text.field = title
     10.offset = 5,10
   }

