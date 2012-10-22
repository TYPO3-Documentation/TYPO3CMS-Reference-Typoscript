

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


TMENU
^^^^^

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
         expAll
   
   Data type
         Boolean /stdWrap
   
   Description
         If this is true, the menu will always show the menu on the level
         underneath the menu item. This corresponds to a situation where a user
         has clicked a menu item and the menu folds out the next level. This
         can enable that to happen on all items as default.
   
   Default


.. container:: table-row

   Property
         collapse
   
   Data type
         boolean
   
   Description
         If set, "active" menu items that has expanded the next level on the
         menu will now collapse that menu again.
   
   Default


.. container:: table-row

   Property
         accessKey
   
   Data type
         boolean
   
   Description
         If set access-keys are set on the menu-links
   
   Default


.. container:: table-row

   Property
         noBlur
   
   Data type
         boolean
   
   Description
         Normally links are "blurred" if the browser is MSIE. Blurring removes
         the ugly box around a clicked link.
         
         If this property is set, the link is NOT blurred (browser-default)
         with "onFocus".

         **Note** : This option and the JavaScript for blurring have been
         removed in TYPO3 6.0.

   Default


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
         int
   
   Description
         If set, the &type parameter of the link is forced to this value
         regardless of target.
   
   Default


.. container:: table-row

   Property
         stdWrap
   
   Data type
         ->stdWrap
   
   Description
         Wraps the whole item using stdWrap
         
         **Example:** see GMENU.stdWrap
   
   Default


.. container:: table-row

   Property
         wrap
   
   Data type
         wrap
   
   Description
         Wraps only if there were items in the menu!
   
   Default


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
         typo3/sysext/cms/tslib/media/scripts/example\_itemArrayProcFunc.php
   
   Default


.. container:: table-row

   Property
         [Common Item States, see above]
   
   Data type
         ->TMENUITEM
   
   Description
         This is the TMENUITEM-options for each category of menu item that can
         be generated.
         
         **SPECIAL:**
         
         The ->OptionSplit function is run on the whole configuration before
         the items are generated.
   
   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).TMENU]

