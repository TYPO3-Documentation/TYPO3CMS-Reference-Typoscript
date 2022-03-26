.. include:: /Includes.rst.txt


.. _tmenu-common-properties:

Common item states
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

These properties are all the item states used by TMENU.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         NO

   Data type
         boolean / (config)

   Default
         1 (true)

   Description
         The default "Normal" state rendering of Item. This is required for all
         menus.

         If you specify properties for the "NO" property you do not have to set
         it "1". Otherwise with no properties setting "NO=1" will render the
         menu anyways (for TMENU this may make sense).

         The simplest menu TYPO3 can generate is then::

            page.20 = HMENU
            page.20.1 = TMENU
            page.20.1.NO = 1

         That will be pure <a> tags wrapped around page titles.




.. container:: table-row

   Property
         IFSUB

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for menu items which has subpages.



.. container:: table-row

   Property
         ACT

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for menu items which are found in the rootLine.



.. container:: table-row

   Property
         ACTIFSUB

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for menu items which are found in the rootLine
         and have subpages.



.. container:: table-row

   Property
         CUR

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for a menu item if the item is the current page.



.. container:: table-row

   Property
         CURIFSUB

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for a menu item if the item is the current page
         and has subpages.



.. container:: table-row

   Property
         USR

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for menu items which are access restricted pages
         that a user has access to.



.. container:: table-row

   Property
         SPC

   Data type
         boolean / (config)

   Default
         0

   Description
         Enable/Configuration for 'Spacer' pages.

         Spacers are pages of the doktype "Spacer". These are not viewable
         pages but "placeholders" which can be used to divide menu items.



.. container:: table-row

   Property
         USERDEF1

   Data type
         boolean / (config)

   Description
         Userdefined, see .itemArrayProcFunc for details on how to use this.

         You can set the ITEM\_STATE values USERDEF1 and USERDEF2 (+...RO) from
         a script/user function processing the menu item array. See the property
         .itemArrayProcFunc of the menu objects.


.. container:: table-row

   Property
         USERDEF2

   Data type
         boolean / (config)

   Description
         (See above)


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj\_itemStates)]

Order of priority: USERDEF2, USERDEF1, SPC, USR, CURIFSUB, CUR,
ACTIFSUB, ACT, IFSUB.

All \*RO states require the default "RO" configuration to be set up.

