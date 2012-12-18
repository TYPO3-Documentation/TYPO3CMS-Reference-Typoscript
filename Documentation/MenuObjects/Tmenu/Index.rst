.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _tmenu:

TMENU
^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         expAll

   Data type
         boolean /stdWrap

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
         Normally links are "blurred" if the browser is MSIE. Blurring removes
         the ugly box around a clicked link.

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
         regardless of target.


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         Wraps the whole item using stdWrap

         **Example:** see GMENU.stdWrap


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         Wraps only if there were items in the menu!


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

         See example in
         typo3/sysext/statictemplates/media/scripts/example\_itemArrayProcFunc.php


.. container:: table-row

   Property
         [Common Item States, see above]

   Data type
         ->TMENUITEM

   Description
         This is the TMENUITEM-options for each category of menu item that can
         be generated.

         **Special:**

         The ->OptionSplit function is run on the whole configuration before
         the items are generated.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).TMENU]

