.. include:: ../../Includes.txt


.. _jsmenu:

JSMENU
^^^^^^

.. note::
   JSMENU will be removed in TYPO3 9.5.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         levels

   Data type
         integer, 1-5

   Description
         How many levels there are

   Default
         1


.. container:: table-row

   Property
         menuName

   Data type
         string

   Description
         JavaScript menu name.

         If you have more than one JSMENU on the page, you should set this
         value for each one.


.. container:: table-row

   Property
         target

   Data type
         target

   Description
         Determines the target of the menu-links.


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
         1,2,3,4...

   Data type
         JSMENUITEM

   Description
         levels-config


.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         wrap around the selector-boxes


.. container:: table-row

   Property
         wrapAfterTags

   Data type
         wrap

   Description
         wrap around the selector-boxes with wrap and form-tags og JS-code.


.. container:: table-row

   Property
         firstLabelGeneral

   Data type
         string

   Description
         General first label. May be overridden by the one set in each
         JSMENUITEM


.. container:: table-row

   Property
         SPC

   Data type
         boolean

   Description
         If set, spacer can go into the menu, else not.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).JSMENU]

