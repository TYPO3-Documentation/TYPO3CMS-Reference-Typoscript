.. include:: ../../Includes.txt


.. _menu-common-properties:

Common properties
^^^^^^^^^^^^^^^^^

These properties are in common for *all* menu objects unless
otherwise noted!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         sectionIndex

   Data type
         *(array of keys)*

   Description
         (see below)


.. container:: table-row

   Property
         alternativeSortingField

   Data type
         string

   Description
         Normally the menu items are sorted by the fields "sorting" in the
         pages- and tt\_content-table. Here you can enter a list of fields that
         is used in the SQL- "ORDER BY" statement instead. You can also provide
         the sorting order.

         **Examples (for "pages" table):**

         alternativeSortingField = title desc

         (This will render the menu in reversed alphabetical order.)

         **Limitations:**

         This property works with normal menus, sectionsIndex menus and
         special-menus of type "directory".


.. container:: table-row

   Property
         minItems

   Data type
         integer

   Description
         The minimum items in the menu. If the number of pages does not reach
         this level, a dummy-page with the title "..." and
         uid=[currentpage\_id] is inserted.

         Takes precedence over HMENU.minItems.


.. container:: table-row

   Property
         maxItems

   Data type
         integer

   Description
         The maximum items in the menu. More items will be ignored.

         Takes precedence over HMENU.maxItems.


.. container:: table-row

   Property
         begin

   Data type
         integer +calc

   Description
         The first item in the menu.

         **Example:**

         This results in a menu, where the first two items are skipped starting
         with item number 3::

            begin = 3

         Takes precedence over HMENU.begin.


.. container:: table-row

   Property
         JSWindow

   Data type
         boolean

   Description
         If set, the links of the menu-items will open by JavaScript in a pop-
         up window.

         **.newWindow:** Boolean. Lets every menu item open in its own
         window opposite to opening in the same window for each click.

         **.params:** The list of parameters sent to the JavaScript open-
         window function, e.g.::

            JSWindow.params = width=200,height=300,status=0,menubar=0


.. container:: table-row

   Property
         imgNamePrefix

   Data type
         string

   Default
         "img"
         
   Description
         Prefix for the image names. This prefix is appended with the uid of the
         page.



.. container:: table-row

   Property
         imgNameNotRandom

   Data type
         boolean

   Description
         If set, the image names of menu items is not randomly assigned. Useful
         switch if you're manipulating these images with some external
         JavaScript.

         **Note:** Don't set this if you're working with a menu with
         sectionIndex! In that case you need special unique names of items
         based on something else than the uid of the parent page of course!


.. container:: table-row

   Property
         debugItemConf

   Data type
         boolean

   Description
         Outputs (by the debug()-function) the configuration arrays for each
         menu item. Useful to debug optionSplit things and such...

         Applies to GMENU, TMENU and IMGMENU.


.. container:: table-row

   Property
         overrideId

   Data type
         integer (page-id)

   Description
         If set, then all links in the menu will point to this pageid. Instead
         the real uid of the page is sent by the parameter "&real\_uid=[uid]".

         This feature is smart, if you have inserted a menu from somewhere
         else, perhaps a shared menu, but wants the menu items to call the same
         page, which then generates a proper output based on the real\_uid.

         Applies to GMENU, TMENU and IMGMENU.


.. container:: table-row

   Property
         addParams

   Data type
         string

   Description
         Additional parameter for the menu-links.

         **Example:**

         "&some\_var=some%20value"

         Must be rawurlencoded.

         Applies to GMENU, TMENU and IMGMENU.

.. _menu-common-properties-showaccessrestrictedpages:

showAccessRestrictedPages
=========================

.. container:: table-row

   Property
         showAccessRestrictedPages

   Data type
         integer (page id) / keyword "NONE"

   Description
         If set, pages in the menu will include pages with frontend user group
         access enabled. However the page is of course not accessible and
         therefore the URL in the menu will be linked to the page with the ID
         of this value. On that page you could put a login form or other
         message.

         If the value is "NONE" the link will not be changed and the site will
         perform page-not-found handling when clicked (which can be used to
         capture the event and act accordingly of course). This means that the 
         link's URL will point to the page even if it is not accessible by the
         current frontend user. Note that the default behavior of page-not-found
         handling is to show the parent page instead.

         **Properties:**

         .addParam = Additional parameter for the URL, which can hold two
         markers; ###RETURN\_URL### which will be substituted with the link the
         page would have had if it had been accessible and ###PAGE\_ID###
         holding the page id of the page coming from (could be used to look up
         which fe\_groups was required for access.

         **Example:** ::

            showAccessRestrictedPages = 22
            showAccessRestrictedPages.addParams = &return_url=###RETURN_URL###&pageId=###PAGE_ID###

         The example will link access restricted menu items to page id 22 with
         the return URL in the GET var "return\_url" and the page id in the GET
         var "pageId".


.. container:: table-row

   Property
         additionalWhere

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Adds an additional part to the WHERE clause for this menu.
         Make sure to start the part with "AND "!

         **Example:** ::

            lib.authormenu = HMENU
            lib.authormenu.1 = TMENU
            lib.authormenu.1.additionalWhere = AND author!=""


.. container:: table-row

   Property
         itemArrayProcFunc

   Data type
         function name

   Description
         The first variable passed to this function is the "menuArr" array with
         the menu items as they are collected based on the type of menu.

         You're free to manipulate or add to this array as you like. Just
         remember to return the array again!

         **Note:**

         .parentObj property is **hardcoded** to be a reference to the calling
         typo3/sysext/frontend/Classes/ContentObject/Menu/ object. Here you'll
         find e.g. ->id to be the uid of the menu item generating a submenu and
         such.

         **Presetting element state**

         You can override element states like SPC, IFSUB, ACT, CUR or USR by
         setting the key ITEM\_STATE in the page records.


.. container:: table-row

   Property
         submenuObjSuffixes

   Data type
         string

         +optionSplit

   Description
         Defines a suffix for alternative sub-level menu objects. Useful to
         create special submenus depending on their parent menu element. See
         example below.

         **Example:**

         This example will generate a menu where the menu objects for the
         second level will differ depending on the number of the first level
         item for which the submenu is rendered. The second level objects used
         are "2" (the default), "2a" and "2b" (the alternatives). Which of them
         is used is defined by "1.submenuObjSuffixes" which has the
         configuration "a \|\*\| \|\*\| b". This configuration means that the
         first menu element will use configuration "2a" and the last will use
         "2b" while anything in between will use "2" (no suffix applied) ::

            page.200 = HMENU
            page.200 {
              1 = TMENU
              1.wrap = <div style="width:200px; border: 1px solid;">|</div>
              1.expAll = 1
              1.submenuObjSuffixes = a |*|  |*| b
              1.NO.allWrap = <b>|</b><br/>

              2 = TMENU
              2.NO.allWrap = <div style="background:red;">|</div>

              2a = TMENU
              2a.NO.allWrap = <div style="background:yellow;">|</div>

              2b = TMENU
              2b.NO.allWrap = <div style="background:green;">|</div>
            }

         The result can be seen in the image below:

         .. figure:: ../../Images/MenuObjectsCommonPropertiesSubmenuObjSuffixes.png
            :alt: Output of the above example.

         Applies to GMENU and TMENU on >= 2 :sup:`nd` level in a menu.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj)]

