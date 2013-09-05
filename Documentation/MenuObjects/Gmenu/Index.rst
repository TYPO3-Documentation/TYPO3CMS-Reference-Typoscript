.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _gmenu:

GMENU
^^^^^

GMENU works as an object under the cObject "HMENU" and it creates
graphical navigation, where each link is a separate gif-file.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         RO

   Data type
         boolean

   Description
         RollOver configuration enabled / disabled.

         If this is true, RO becomes a GIFBUILDER object defining the layout of
         the menu item when the mouse rolls over it

   Default
         0


.. container:: table-row

   Property
         expAll

   Data type
         boolean

   Description
         If this is true, the menu will always show the menu on the level
         underneath the menu item. This corresponds to a situation where a user
         has clicked a menu item and the menu folds out the next level. This
         can enable that to happen on all items as default.


.. container:: table-row

   Property
         collapse

   Data type
         boolean

   Description
         If set, "active" menu items that has expanded the next level on the
         menu will now collapse that menu again.


.. container:: table-row

   Property
         accessKey

   Data type
         boolean

   Description
         If set access-keys are set on the menu-links


.. container:: table-row

   Property
         noBlur

   Data type
         boolean

   Description
         Normally graphical links are "blurred" if the browser is MSIE.
         Blurring removes the ugly box around a clicked link.

         If this property is set, the link is **not** blurred (browser-default)
         with "onFocus".

         **Note:** This option and the JavaScript for blurring have been
         removed in TYPO3 6.0.


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
         regardless of target. Overrides the global equivalent in 'config' if
         set.


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         Wraps the whole item using stdWrap

         **Example:** ::

            2 = TMENU
            2 {
              stdWrap.dataWrap = <ul class="{register :
                 parentProperty}"> | </ul>
              NO {
                ...
              }
            }


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         Wraps only if there were items in the menu!


.. container:: table-row

   Property
         applyTotalH

   Data type
         objNumsList (offset)

   Description
         This adds the total height of the previously generated menu items to
         the offset of the GifBuilder Objects mentioned in this list.

         **Example:**

         This is useful it you want to create a menu with individual items but
         a common background image that extends to the whole area behind the
         menu. Then you should setup the background image in each GIFBUILDER-
         object and include the object-number in this list.

         Look at the implementation in static\_template "styles.gmenu.bug"


.. container:: table-row

   Property
         applyTotalW

   Data type
         objNumsList (offset)

   Description
         This adds the total width of the previously generated menu items to
         the offset of the GifBuilder Objects mentioned in this list.


.. container:: table-row

   Property
         min

   Data type
         x,y (calcInt)

   Description
         Forces the menu as a whole to these minimum dimensions


.. container:: table-row

   Property
         max

   Data type
         x,y (calcInt)

   Description
         Forces the menu as a whole to these maximum dimensions


.. container:: table-row

   Property
         useLargestItemX

   Data type
         boolean

   Description
         If set, then the width of all menu items will be equal to the largest
         of them all.


.. container:: table-row

   Property
         useLargestItemY

   Data type
         boolean

   Description
         If set, then the height of all menu items will be equal to the largest
         of them all.


.. container:: table-row

   Property
         distributeX

   Data type
         positive integer

   Description
         If set, the total width of all the menu items will be equal to this
         number of pixels by adding/subtracting an equal amount of pixels to
         each menu items width.

         Will overrule any setting for ".useLargestItemX"


.. container:: table-row

   Property
         distributeY

   Data type
         positive integer

   Description
         If set, the total height of all the menu items will be equal to this
         number of pixels by adding/subtracting an equal amount of pixels to
         each menu items height.

         Will overrule any setting for ".useLargestItemY"


.. container:: table-row

   Property
         removeObjectsOfDummy

   Data type
         objNumsList

   Description
         If the menu is forced to a certain minimum dimension, this is a list
         of objects in the GIFBUILDER object that is removed for this last
         item. This is important to do if the menu items has elements that
         should only be applied if the item is actually a menu item!


.. container:: table-row

   Property
         disableAltText

   Data type
         boolean

   Description
         If set, the alt-parameter of the images are not set. You can do it
         manually by "imgParams" (see below)


.. container:: table-row

   Property
         IProcFunc

   Data type
         function name

   Description
         The internal array "I" is passed to this function and expected
         returned as well. Subsequent to this function call the menu item is
         compiled by implode()'ing the array $I[parts] in the passed array.
         Thus you may modify this if you need to.

         See example in the extension statictemplates
         (statictemplates/media/scripts/example\_itemArrayProcFunc.php).


.. container:: table-row

   Property
         [Common Item States, see above]

         \+ rollover version for all, except SPC

   Data type
         ->GIFBUILDER

         \+ Additional properties! See table below

   Description
         This is the GIFBUILDER-options for each category of menu item that can
         be generated.

         **Note:** For the GMENU series you can also define the RollOver
         configuration for the item states. This means that you define the
         GIFBUILDER object for the 'Active' state by ACT and the RollOver
         GIFBUILDER object for the 'Active' state by ACTRO.

         This pattern goes for ALL the states except the SPC state.

         **Special:**

         The ->OptionSplit function is run on the whole GIFBUILDER-
         configuration before the items are generated.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).GMENU


.. _gmenu-additional-properties:

Additional properties for Menu item states
""""""""""""""""""""""""""""""""""""""""""

These properties are additionally available for the GMENU item states
although the main object is declared to be GIFBUILDER.

It is evident that it is an unclean solution to introduce these
properties on the same level as the GIFBUILDER object in a single
situation like this. However this is how it irreversibly is and has
been for a long time.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         noLink

   Data type
         boolean

   Description
         If set, the item is **not** linked!


.. container:: table-row

   Property
         imgParams

   Data type
         params

   Description
         Parameters for the <img>-tag


.. container:: table-row

   Property
         altTarget

   Data type
         string

   Description
         Alternative target which overrides the target defined for the GMENU


.. container:: table-row

   Property
         altImgResource

   Data type
         imgResouce

   Description
         Defines an alternative image to use. If an image returns here, it will
         override any GIFBUILDER configuration.


.. container:: table-row

   Property
         ATagParams

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Additional parameters


.. container:: table-row

   Property
         ATagTitle

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         which defines the title attribute of the a-tag. (See TMENUITEM also)


.. container:: table-row

   Property
         additionalParams

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Define parameters that are added to the end of the URL. This must be
         code ready to insert after the last parameter.

         For details, see typolink->additionalParams


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         Wrap of the menu item.


.. container:: table-row

   Property
         allWrap

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the whole item.


.. container:: table-row

   Property
         wrapItemAndSub

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the whole item and any submenu concatenated to it.


.. container:: table-row

   Property
         subst\_elementUid

   Data type
         boolean

   Description
         If set, "{elementUid}" is substituted with the item uid.

   Default
         0


.. container:: table-row

   Property
         allStdWrap

   Data type
         ->stdWrap

   Description
         stdWrap of the whole item


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).GMENU.(itemState)]

