.. include:: /Includes.rst.txt


.. _tmenu-gmenu-imgmenu-common-properties:

Common item states for TMENU, GMENU and IMGMENU
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

These properties are in common for TMENU, GMENU and IMGMENU.
That means they are not used by for instance the JSMENU.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         NO

   Data type
         boolean / (config)

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

   Default
         1


.. container:: table-row

   Property
         IFSUB

         IFSUBRO

   Data type
         boolean / (config)

   Description
         Enable/Configuration for menu items which has subpages.

   Default
         0


.. container:: table-row

   Property
         ACT

         ACTRO

   Data type
         boolean / (config)

   Description
         Enable/Configuration for menu items which are found in the rootLine.

   Default
         0


.. container:: table-row

   Property
         ACTIFSUB

         ACTIFSUBRO

   Data type
         boolean / (config)

   Description
         Enable/Configuration for menu items which are found in the rootLine
         and have subpages.

   Default
         0


.. container:: table-row

   Property
         CUR

         CURRO

   Data type
         boolean / (config)

   Description
         Enable/Configuration for a menu item if the item is the current page.

   Default
         0


.. container:: table-row

   Property
         CURIFSUB

         CURIFSUBRO

   Data type
         boolean / (config)

   Description
         Enable/Configuration for a menu item if the item is the current page
         and has subpages.

   Default
         0


.. container:: table-row

   Property
         USR

         USRRO

   Data type
         boolean / (config)

   Description
         Enable/Configuration for menu items which are access restricted pages
         that a user has access to.

   Default
         0


.. container:: table-row

   Property
         SPC

   Data type
         boolean / (config)

   Description
         Enable/Configuration for 'Spacer' pages.

         Spacers are pages of the doktype "Spacer". These are not viewable
         pages but "placeholders" which can be used to divide menu items.

         **Note:** Rollovers do not work with spacers, if you use GMENU!

   Default
         0


.. container:: table-row

   Property
         USERDEF1

         USERDEF1RO

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

         USERDEF2RO

   Data type
         boolean / (config)

   Description
         (See above)


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj\_itemStates)]

Order of priority: USERDEF2, USERDEF1, SPC, USR, CURIFSUB, CUR,
ACTIFSUB, ACT, IFSUB.

All \*RO states require the default "RO" configuration to be set up.

