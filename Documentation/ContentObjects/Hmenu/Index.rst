.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-hmenu:

HMENU
^^^^^

Generates hierarchical menus.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-number:

         (1 / 2 / 3 /...)

   Data type
         :ref:`menuObj <data-type-menuobj>`

   Description
         **Required!**

         Defines which menuObj that should render the menu items on the various
         levels.

         1 is the first level, 2 is the second level, 3 is the third level, 4
         is ....

         **Example:** ::

            temp.sidemenu = HMENU
            temp.sidemenu.1 = GMENU

   Default
         (no menu)


.. container:: table-row

   Property
         .. _hmenu-cache-period:

         cache\_period

   Data type
         integer

   Description
         The number of seconds a menu may remain in cache. If this value is not
         set, the first available value of the following will be used:

         1) cache\_timeout of the current page

         2) config.cache\_period defined globally

         3) 86400 (= 1 day)


.. container:: table-row

   Property
         .. _hmenu-entrylevel:

         entryLevel

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Defines at which level in the rootLine the menu should start.

         Default is "0" which gives us a menu of the very first pages on the
         site.

         If the value is < 0, entryLevel is chosen from "behind" in the
         rootLine. Thus "-1" is a menu with items from the outermost level,
         "-2" is the level before the outermost...

   Default
         0


.. container:: table-row

   Property
         .. _hmenu-special:

         special

   Data type
         *"directory" / "list" / "updated" / "browse" / "rootline" / "keywords"
         / "language"*

   Description
         *See section "The .special property" and the according tables below.*


.. container:: table-row

   Property
         .. _hmenu-special-value:

         special.value

   Data type
         *list of page-uid's* /:ref:`stdWrap <stdwrap>`

   Description
         See above


.. container:: table-row

   Property
         .. _hmenu-minitems:

         minItems

   Data type
         Until TYPO3 4.6: integer

         Since TYPO3 4.7: integer /:ref:`stdWrap <stdwrap>`

   Description
         The minimum items in the menu. If the number of pages does not reach
         this level, a dummy-page with the title "..." and
         uid=[currentpage\_id] is inserted.

         **Note:** Affects all sub menus as well. To set the value for each
         menu level individually, set the properties in the menu objects (see
         "Common properties" table).


.. container:: table-row

   Property
         .. _hmenu-maxitems:

         maxItems

   Data type
         Until TYPO3 4.6: integer

         Since TYPO3 4.7: integer /:ref:`stdWrap <stdwrap>`

   Description
         The maximum items in the menu. More items will be ignored.

         **Note:** Affects all sub menus as well. (See "minItems" for a
         notice.)


.. container:: table-row

   Property
         .. _hmenu-begin:

         begin

   Data type
         Until TYPO3 4.6: integer :ref:`+calc <objects-calc>`

         Since TYPO3 4.7: integer /:ref:`stdWrap <stdwrap>` :ref:`+calc <objects-calc>`

   Description
         The first item in the menu.

         **Example:**

         This results in a menu, where the first two items are skipped starting
         with item number 3::

            begin = 3

         **Note:** Affects all sub menus as well. (See "minItems" for a
         notice.)


.. container:: table-row

   Property
         .. _hmenu-excludeuidlist:

         excludeUidList

   Data type
         list of integers /:ref:`stdWrap <stdwrap>`

   Description
         This is a list of page uid's to exclude when the select statement is
         done. Comma-separated. You may add "current" to the list to exclude
         the current page.

         **Example:**

         The pages with these uid-numbers will **not** be within the menu!
         Additionally the current page is always excluded too. ::

            excludeUidList = 34,2,current


.. container:: table-row

   Property
         .. _hmenu-excludedoktypes:

         excludeDoktypes

   Data type
         list of integers

   Description
         Enter the list of page document types (doktype) to exclude from menus.
         By default pages that are "not in menu" (5) are excluded and those
         marked for backend user access only (6).

   Default
         5,6


.. container:: table-row

   Property
         .. _hmenu-includenotinmenu:

         includeNotInMenu

   Data type
         boolean

   Description
         If set, pages with the checkbox "Not in menu" checked will be included
         in menus.


.. container:: table-row

   Property
         .. _hmenu-alwaysactivepidlist:

         alwaysActivePIDlist

   Data type
         list of integers /:ref:`stdWrap <stdwrap>`

   Description
         This is a list of page UID numbers that will always be regarded as
         active menu items and thereby automatically opened regardless of the
         rootline.


.. container:: table-row

   Property
         .. _hmenu-protectlvar:

         protectLvar

   Data type
         boolean / keyword

   Description
         If set, then for each page in the menu it will be checked if an
         Alternative Page Language record for the language defined in
         "config.sys\_language\_uid" (typically defined via &L) exists for the
         page. If that is not the case and the pages "Localization settings"
         have the "Hide page if no translation for current language exists"
         flag set, then the menu item will link to a non accessible page that
         will yield an error page to the user. Setting this option will prevent
         that situation by simply adding "&L=0" for such pages, meaning that
         they will switch to the default language rather than keeping the
         current language.

         The check is only carried out if a translation is requested
         ("config.sys\_language\_uid" is not zero).

         **Keyword: "all"**

         When set to "all" the same check is carried out but it will not look
         if "Hide page if no translation for current language exists" is set -
         it always reverts to default language if no translation is found.

         For these options to make sense, they should only be used when
         "config.sys\_language\_mode" is not set to "content\_fallback".


.. container:: table-row

   Property
         .. _hmenu-addquerystring:

         addQueryString

   Data type
         string

   Description
         *see typolink.addQueryString*

         **Note:** This works only for *special=language*.


.. container:: table-row

   Property
         .. _hmenu-if:

         if

   Data type
         :ref:`->if <if>`

   Description
         If "if" returns false, the menu is not generated.


.. container:: table-row

   Property
         .. _hmenu-wrap:

         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wrap for the HMENU.


.. container:: table-row

   Property
         .. _hmenu-stdwrap:

         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         (Executed after ".wrap".)


.. ###### END~OF~TABLE ######


[tsref:(cObject).HMENU]


.. _hmenu-examples:

Example:
""""""""

::

   temp.sidemenu = HMENU
   temp.sidemenu.entryLevel = 1
   temp.sidemenu.1 = TMENU
   temp.sidemenu.1 {
     target = page
     NO.afterImg = typo3conf/ext/statictemplates/media/bullets/dots2.gif |*||*| _
     NO.afterImgTagParams = style="margin: 0px 20px;"
     NO.linkWrap = {$fontTag}
     NO.ATagBeforeWrap = 1

     ACT < .NO
     ACT = 1
     ACT.linkWrap = <b>{$fontTag}</b>
   }


.. _hmenu-special-property:

The .special property
"""""""""""""""""""""

This property makes it possible to create menus that are not strictly
reflecting the current page-structure, but rather creating menus with
links to pages like "next/previous", "last modified", "pages in a
certain page" and so on.

**Note:** .entryLevel generally is not supported together with the
.special property! The only exception is special.keywords.

Also be aware that this property selects pages for the first level in
the menu. Submenus by menuObjects 2+ will be created as usual.


.. _hmenu-special-directory:

special.directory
~~~~~~~~~~~~~~~~~

A HMENU of type special = directory lets you create a menu listing the
subpages of one or more parent pages. The parent pages are defined in
the property ".value". It is usually used for sitemaps.

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-directory-value:

         value

   Data type
         list of page ids /:ref:`stdWrap <stdwrap>`

   Description
         This will generate a menu of all pages with pid = 35 and pid = 56. ::

            20 = HMENU
            20.special = directory
            20.special.value = 35, 56

   Default
         current page id


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.directory]


.. _hmenu-special-list:

special.list
~~~~~~~~~~~~

A HMENU of type special = list lets you create a menu that lists the
pages you define in the property ".value".

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-list-value:

         value

   Data type
         list of page ids /:ref:`stdWrap <stdwrap>`

   Description
         This will generate a menu with the two pages (uid=35 and uid=56)
         listed::

            20 = HMENU
            20.special = list
            20.special.value = 35, 56

         If .value is not set, the default uid is 0, so that only your homepage
         will be listed.

   Default
         0


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.list]


.. _hmenu-special-updated:

special.updated
~~~~~~~~~~~~~~~

An HMENU with the property special = updated will create a menu of the
most recently updated pages.

**A note on ordering:** The sorting menu is by default done in reverse
order (desc) with the field specified by "mode", but setting
"alternativeSortingField" for the menu object (e.g. TMENU or GMENU,
see later) will override that.

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-updated-value:

         value

   Data type
         list of page ids /:ref:`stdWrap <stdwrap>`

   Description
         This will generate a menu of the most recently updated pages from the
         branches in the tree starting with the uid's (uid=35 and uid=56)
         listed. ::

            20 = HMENU
            20.special = updated
            20.special.value = 35, 56


.. container:: table-row

   Property
         .. _hmenu-special-updated-mode:

         mode

   Data type
         string

   Description
         The field in the database which should be used to get the information
         about the last update from.

         The following values are possible:

         **SYS\_LASTCHANGED:** Is updated to the youngest tstamp of the
         records on the page when a page is generated.

         **crdate:** Uses the "crdate"-field of the pagerecord.

         **tstamp:** Uses the "tstamp"-field of the pagerecord, which is set
         automatically when the record is changed.

         **manual** or **lastUpdated:** Uses the field "lastUpdated", which
         can be set manually in the page-record.

         **starttime:** Uses the starttime field.

         Fields with empty values are generally not selected.

   Default
         SYS\_LASTCHANGED


.. container:: table-row

   Property
         .. _hmenu-special-updated-depth:

         depth

   Data type
         integer

   Description
         Defines the tree depth.

         The allowed range is 1-20.

         A depth of 1 means only the start id, depth of 2 means start-id +
         first level.

         **Note:** "depth" is relative to "beginAtLevel".

   Default
         20


.. container:: table-row

   Property
         .. _hmenu-special-updated-beginatlevel:

         beginAtLevel

   Data type
         integer

   Description
         Determines starting level for the page trees generated based on .value
         and .depth.

         0 is default and includes the start id.

         1 starts with the first row of subpages,

         2 starts with the second row of subpages.

         **Note:** "depth" is relative to this property.

   Default
         0


.. container:: table-row

   Property
         .. _hmenu-special-updated-maxage:

         maxAge

   Data type
         integer :ref:`+calc <objects-calc>`

   Description
         Only show pages, whose update-date *at most* lies this number of
         seconds in the past. Or with other words: Pages with update-dates
         older than the current time minus this number of seconds will not
         be shown in the menu no matter what.

         By default all pages are shown. You may use +-\*/ for calculations.


.. container:: table-row

   Property
         .. _hmenu-special-updated-limit:

         limit

   Data type
         integer

   Description
         Maximal number of items in the menu. Default is 10, max is 100.

   Default
         10


.. container:: table-row

   Property
         .. _hmenu-special-updated-excludenosearchpages:

         excludeNoSearchPages

   Data type
         boolean

   Description
         If set, pages marked "No search" are not included.

   Default
         0


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.updated]


.. _hmenu-special-updated-examples:

Example for special = updated:
''''''''''''''''''''''''''''''

The following example will generate a menu of the most recently
updated pages from the branches in the tree starting with the uid's
(uid=35 and uid=56) listed. Furthermore the field "tstamp" is used
(default is SYS\_LASTCHANGED) and the tree depth is 2 levels. Also a
maximum of 8 pages will be shown and they must have been updated
within the last three days (3600\*24\*3)::

   20 = HMENU
   20.special = updated
   20.special.value = 35, 56
   20.special {
     mode = tstamp
     depth = 2
     maxAge = 3600*24*3
     limit = 8
   }


.. _hmenu-special-rootline:

special.rootline
~~~~~~~~~~~~~~~~

The path of pages from the current page to the root page of the page
tree is called "rootline".

A rootline menu is a menu which shows you these pages one by one in
their hierarchical order.

An HMENU with the property special = rootline creates a rootline menu
(also known as "breadcrumb trail") that could look like this:

Page level 1 > Page level 2 > Page level 3 > *Current page*

Such a click path facilitates the user's orientation on the website
and makes navigation to a certain page level easier.

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-rootline-range:

         range

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         [begin-level] \| [end-level] (same way as you reference the
         .entryLevel for an HMENU). The following example will start at level 1
         and not show the page the user is currently on::

            temp.breadcrumbs = HMENU
            temp.breadcrumbs.special = rootline
            temp.breadcrumbs.special.range = 1|-2


.. container:: table-row

   Property
         .. _hmenu-special-rootline-reverseorder:

         reverseOrder

   Data type
         boolean

   Description
         If set to true, the order of the rootline menu elements will be
         reversed.

   Default
         false


.. container:: table-row

   Property
         .. _hmenu-special-rootline-targets:

         targets.[level number]

   Data type
         string

   Description
         For framesets. You can set a default target and a target for each
         level by using the level number as sub-property.

         **Example:**

         Here the links to pages on level 3 will have target="page", while all
         other levels will have target="\_top" as defined for the TMENU
         property .target. ::

            page.2 = HMENU
            page.2.special = rootline
            page.2.special.range = 1|-2
            page.2.special.targets.3 = page
            page.2.1 = TMENU
            page.2.1.target = _top
            page.2.1.wrap = <HR> | <HR>
            page.2.1.NO {
              linkWrap = | >
            }


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.rootline]


.. _hmenu-special-rootline-examples:

Example for special = rootline:
'''''''''''''''''''''''''''''''

The following example will generate an accessible rootline menu: It
will be wrapped as an unordered list. The first page in the menu is
the page on level 1, that is one level below the root page of the
website. The last page in the menu is the current page.

After each link there is an image, which could contain a small arrow.

The current page is not linked, but wrapped in em tags. It does not
have the image appended. ::

   20 = HMENU
   20.wrap = <ul>|</ul>
   20.special = rootline
   20.special.range = 1|-1

   20 {
     1 = TMENU

     1.NO.wrapItemAndSub = <li>|</li>
     1.NO.ATagTitle.field = description // subtitle // title
     1.NO.afterImg = fileadmin/arrow.jpg

     1.CUR = 1
     1.CUR < .1.NO
     1.CUR.doNotLinkIt = 1
     1.CUR.wrapItemAndSub = <li><em>|</em></li>
     1.CUR.afterImg >
   }


.. _hmenu-special-browse:

special.browse
~~~~~~~~~~~~~~

**Warning:** Mount pages are not supported!

This menu contains pages which give your user the possibility to
browse to the previous page, to the next page, to a page with the
table of contents and so on. The menu is built of items given by a
list from the property ".items".

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-browse-value:

         value

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Default is the current page id. Seldom you might want to override this
         value with another page-uid which will then act as the base point for
         the menu and the predefined items.

   Default
         current page id


.. container:: table-row

   Property
         .. _hmenu-special-browse-items:

         items

   Data type
         list of item names separated by "\|"

   Description
         Each element in the list (separated by "\|") is either a reserved item
         name (see list) with a predefined function, or a user-defined name
         which you can assign a link to any page. Note that the current page
         cannot be the root-page of a site.

         *Reserved item names:*

         **next** / **prev:** Links to the next page / the previous page.
         Next and previous pages are from the same "pid" as the current page id
         (or "value") - that is the next item in a menu with the current page.
         Also referred to as current level.

         If ".prevnextToSection" is set then next/prev will link to the first
         page of the next section / to the last page of the previous section,
         too.

         **nextsection** / **prevsection:** Links to the next section / the
         previous section. A section is defined as the subpages of a page on
         the same level as the parent (pid) page of the current page. Will not
         work if the parent page of the current page is the root page of the
         site.

         .. figure:: ../../Images/ContentObjectsHmenuSpecialBrowse.png
            :alt: Example for the usage of the property "items".

         **nextsection\_last** / **prevsection\_last:** Where
         nextsection/prevsection links to the first page in a section, these
         link to the last pages. If there is only one page in the section that
         will be both first and last.Will not work if the parent page of the
         current page is the root page of the site.

         **first** / **last:** First / last page on the current level. If
         there is only one page on the current level that page will be both
         first and last.

         **up:** Links to the parent (pid) page of the current page (up 1
         level). Will always be available.

         **index:** Links to the parent of the parent pageof the current
         page(up 2 levels). May not be available, if that page is out of the
         rootline.

         **Examples:**

         If id = 20 is the current page then:

         21 = prev and first, 19 = next, 18 = last, 17 = up, 1 = index, 10 =
         nextsection, 11 = nextsection\_last

         prevsection and prevsection\_last are not present because id = 3 has
         no subpages!

         **TypoScript (only "browse"-part, needs also TMENU/GMENU):** ::

            xxx = HMENU
            xxx.special = browse
            xxx.special {
              items = index|up|next|prev
              items.prevnextToSection = 1
              index.target = _blank
              index.fields.title = INDEX
              index.uid = 8
            }


.. container:: table-row

   Property
         .. _hmenu-special-browse-prevnexttosection:

         items.prevnextToSection

   Data type
         boolean

   Description
         If set, the "prev" and "next" navigation will jump to the next section
         when it reaches the end of pages in the current section. That way
         "prev" and "next" will also link to the first page of the next section
         / to the last page of the previous section.


.. container:: table-row

   Property
         .. _hmenu-special-browse-target:

         [itemname].target

   Data type
         string

   Description
         Optional/alternative target of the item.


.. container:: table-row

   Property
         .. _hmenu-special-browse-uid:

         [itemname].uid

   Data type
         integer

   Description
         (uid of page) - optional/alternative page-uid to link to.


.. container:: table-row

   Property
         .. _hmenu-special-browse-fields:

         [itemname].fields.[field name]

   Data type
         string

   Description
         Override field "field name" in pagerecord.

         **Example:** ::

            prev.fields.title = « zurück

         This gives the link to the previous page the linktext "« zurück".


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.browse]


.. _hmenu-special-keywords:

special.keywords
~~~~~~~~~~~~~~~~

Makes a menu of pages, which contain one or more keywords also found
on the current page.

**Ordering** is by default done in reverse order (desc) with the field
specified by "mode", but setting "alternativeSortingField" for the
menu object (e.g. for a GMENU, see later) will override that.

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-keywords-value:

         value

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Page for which keywords to find similar pages

         **Example:** ::

            20 = HMENU
            20.special = keywords
            20.special {
              value.data = TSFE:id
              entryLevel = 1
              mode = manual
            }
            20.1 = TMENU
            20.1.NO {
              ...
            }


.. container:: table-row

   Property
         .. _hmenu-special-keywords-mode:

         mode

   Data type
         string

   Description
         Which field in the pages-table to use for sorting.

         Possible values are:

         **SYS\_LASTCHANGED:** Is updated to the youngest tstamp of the
         records on the page when a page is generated.

         **manual** or **lastUpdated:** Uses the field "lastUpdated", which
         can be set manually in the page-record.

         **tstamp:** Uses the "tstamp"-field of the pagerecord, which is set
         automatically when the record is changed.

         **crdate:** Uses the "crdate"-field of the pagerecord.

         **starttime:** Uses the starttime field.

   Default
         SYS\_LASTCHANGED


.. container:: table-row

   Property
         .. _hmenu-special-keywords-entrylevel:

         entryLevel

   Data type
         integer

   Description
         Where in the rootline the search begins.

         *See property entryLevel in the section "HMENU" above.*


.. container:: table-row

   Property
         .. _hmenu-special-keywords-depth:

         depth

   Data type
         integer

   Description
         (same as in section "special.updated")

   Default
         20


.. container:: table-row

   Property
         .. _hmenu-special-keywords-limit:

         limit

   Data type
         integer

   Description
         (same as in section "special.updated")

   Default
         10


.. container:: table-row

   Property
         .. _hmenu-special-keywords-excludenosearchpages:

         excludeNoSearchPages

   Data type
         boolean

   Description
         (same as in section "special.updated")


.. container:: table-row

   Property
         .. _hmenu-special-keywords-begin:

         begin

   Data type
         boolean

   Description
         (same as in section "special.updated")


.. container:: table-row

   Property
         .. _hmenu-special-keywords-setkeywords:

         setKeywords

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Lets you define the keywords manually by defining them as a comma-
         separated list. If this property is defined, it overrides the default,
         which is the keywords of the current page.


.. container:: table-row

   Property
         .. _hmenu-special-keywords-keywordsfield:

         keywordsField

   Data type
         string

   Description
         Defines the field in the pages-table in which to search for the
         keywords. Default is the field name "keyword". No check is done to see
         if the field you enter here exists, so enter an existing field, OK?!

   Default
         keywords


.. container:: table-row

   Property
         .. _hmenu-special-keywords-sourcefield:

         keywordsField.sourceField

   Data type
         string

   Description
         Defines the field from the current page from which to take the
         keywords being matched. The default is "keyword". (Notice that
         ".keywordsField" is only setting the page-record field to *search
         in*!)

   Default
         keywords


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.keywords]


.. _hmenu-special-language:

special.language
~~~~~~~~~~~~~~~~

Creates a language selector menu. Typically this is made as a menu
with flags for each language a page is translated to and when the user
clicks any element the same page id is hit but with a change to the
"&L" parameter in the URL.

The "language" type will create menu items based on the current page
record but with the language record for each language overlaid if
available. The items all link to the current page id and only "&L" is
changed.

Note on item states:

When "TSFE->sys\_language\_uid" matches the sys\_language uid for an
element the state is set to "ACT", otherwise "NO". However, if a page
is not available due to the pages "Localization settings" (which can
disable translations) or if no Alternative Page Language record was
found (can be disabled with ".normalWhenNoLanguage", see below) the
state is set to "USERDEF1" for non-active items and "USERDEF2" for
active items. So in total there are four states to create designs for.
It is recommended to disable the link on menu items rendered with
"USERDEF1" and "USERDEF2" in this case since they are disabled exactly
because a page in that language does not exist and might even issue an
error if tried accessed (depending on site configuration).

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-language-value:

         value

   Data type
         comma list of sys\_language uids /:ref:`stdWrap <stdwrap>`

   Description
         The number of elements in this list determines the number of menu
         items.


.. container:: table-row

   Property
         .. _hmenu-special-language-normalwhennolanguage:

         normalWhenNoLanguage

   Data type
         boolean

   Description
         If set to 1 the button for a language will ve rendered as a non-
         disabled button even if no translation is found for the language.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.language]


.. _hmenu-special-language-examples:

Example:
''''''''

Creates a language menu with flags (notice that some lines break):

.. figure:: ../../Images/ContentObjectsHmenuFlags.png
   :alt: Output of the language menu with flags.

::

   lib.langMenu = HMENU
   lib.langMenu.special = language
   lib.langMenu.special.value = 0,1,2
   lib.langMenu.1 = GMENU
   lib.langMenu.1.NO {
     XY = [5.w]+4, [5.h]+4
     backColor = white
     5 = IMAGE
     5.file = typo3conf/ext/statictemplates/media/flags/flag_uk.gif || typo3conf/ext/statictemplates/media/flags/flag_fr.gif || typo3conf/ext/statictemplates/media/flags/flag_es.gif
     5.offset = 2,2
   }

   lib.langMenu.1.ACT < lib.langMenu.1.NO
   lib.langMenu.1.ACT = 1
   lib.langMenu.1.ACT.backColor = black

   lib.langMenu.1.USERDEF1 < lib.langMenu.1.NO
   lib.langMenu.1.USERDEF1 = 1
   lib.langMenu.1.USERDEF1.5.file = typo3conf/ext/statictemplates/media/flags/flag_uk_d.gif  || typo3conf/ext/statictemplates/media/flags/flag_fr_d.gif  || typo3conf/ext/statictemplates/media/flags/flag_es_d.gif
   lib.langMenu.1.USERDEF1.noLink = 1


.. _hmenu-special-userdefined:

special.userdefined
~~~~~~~~~~~~~~~~~~~

Lets you write your own little PHP script that generates the array of
menu items.

**Note:** The special type "userdefined" has been removed in TYPO3
4.6. Use the special type "userfunction" instead.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-userdefined-file:

         file

   Data type
         :ref:`resource <data-type-resource>`

   Description
         Filename of the PHP file to include.


.. container:: table-row

   Property
         .. _hmenu-special-userdefined-other:

         [any other key]

   Data type
         *(whatever)*

   Description
         Your own variables to your script. They are all accessible in the
         array $conf in your script.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.userdefined]


.. _hmenu-special-userdefined-examples:

How-to:
'''''''

You must populate an array called $menuItemsArray with page-records of
the menu items you want to be in the menu.

It works like this::

   $menuItemsArray[] = pageRow1;
   $menuItemsArray[] = pageRow2;
   $menuItemsArray[] = pageRow3;
   ...

A "pageRow" is a record from the table "pages" with all fields
selected (SELECT \* FROM...)

If you create fake page rows, make sure to add at least "title" and
"uid" field values.

Note:

If you work with mount-points you can set the MP param which should be
set for the page by setting the internal field "\_MP\_PARAM" in the
page-record (xxx-xxx).

Overriding URLs:

You can also use the internal field "\_OVERRIDE\_HREF" to set a custom
href-value (e.g. "http://www.typo3.org") which will in any case be used
rather than a link to the page that the page otherwise might
represent. If you use "\_OVERRIDE\_HREF" then "\_OVERRIDE\_TARGET" can
be used to override the target value as well (See example below).

Other reserved keys:

"\_ADD\_GETVARS" can be used to add get parameters to the URL, e.g.
"&L=xxx".

"\_SAFE" can be used to protect the element to make sure it is not
filtered out for any reason.

Creating submenus:

You can create submenus for the next level easily by just adding an
array of menu items in the internal field "\_SUB\_MENU" (See example
below).

Presetting element state

If you would like to preset an element to be recognized as a SPC,
IFSUB, ACT, CUR or USR mode item, you can do so by specifying one of
these values in the key "ITEM\_STATE" of the page record. This setting
will override the natural state-evaluation.


.. _hmenu-special-userfunction:

special.userfunction
~~~~~~~~~~~~~~~~~~~~

Calls a user function/method in class which should (similar to how
"userdefined" worked above) return an array with page records for the
menu.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-userfunction-userfunc:

         userFunc

   Data type
         string

   Description
         Name of the function


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special.userfunction]


.. _hmenu-special-userfunction-examples:

Example: Creating hierarchical menus of custom links
''''''''''''''''''''''''''''''''''''''''''''''''''''

By default the HMENU object is designed to create menus from pages in
TYPO3. Such pages are represented by their page-record contents.
Usually the "title" field is used for the title and the "uid" field is
used to create a link to that page in the menu.

However the HMENU and sub-menu objects are so powerful that it would
be very useful to use these objects for creating menus of links which
does not relate to pages in TYPO3 by their ids. This could be a menu
reflecting a menu structure of a plugin where each link might link to
the same page id in TYPO3 but where the difference would be in some
parameter value.

First, this listing creates a menu in three levels where the first two
are graphical items::

      0: # ************************
      1: # MENU LEFT
      2: # ************************
      3: lib.leftmenu.20 = HMENU
      4: lib.leftmenu.20.special = userfunction
      5: lib.leftmenu.20.special.userFunc = user_3dsplm_pi2->makeMenuArray
      6: lib.leftmenu.20.1 = GMENU
      7: lib.leftmenu.20.1.NO {
      8:   wrap = <tr><td>|</td></tr><tr><td class="bckgdgrey1" height="1"></td></tr>
      9:   XY = 163,19
     10:   backColor = white
     11:   10 = TEXT
     12:   10.text.field = title
     13:   10.text.case = upper
     14:   10.fontColor = red
     15:   10.fontFile = fileadmin/fonts/ARIALNB.TTF
     16:   10.niceText = 1
     17:   10.offset = 14,12
     18:   10.fontSize = 10
     19: }
     20: lib.leftmenu.20.2 = GMENU
     21: lib.leftmenu.20.2.wrap = | <tr><td class="bckgdwhite" height="4"></td></tr><tr><td class="bckgdgrey1" height="1"></td></tr>
     22: lib.leftmenu.20.2.NO {
     23:   wrap = <tr><td class="bckgdwhite" height="4"></td></tr><tr><td>|</td></tr>
     24:   XY = 163,16
     25:   backColor = white
     26:   10 = TEXT
     27:   10.text.field = title
     28:   10.text.case = upper
     29:   10.fontColor = #666666
     30:   10.fontFile = fileadmin/fonts/ARIALNB.TTF
     31:   10.niceText = 1
     32:   10.offset = 14,12
     33:   10.fontSize = 11
     34: }
     35: lib.leftmenu.20.2.RO < lib.leftmenu.20.2.NO
     36: lib.leftmenu.20.2.RO = 1
     37: lib.leftmenu.20.2.RO.backColor = #eeeeee
     38: lib.leftmenu.20.2.ACT < lib.leftmenu.20.2.NO
     39: lib.leftmenu.20.2.ACT = 1
     40: lib.leftmenu.20.2.ACT.10.fontColor = red
     41: lib.leftmenu.20.3 = TMENU
     42: lib.leftmenu.20.3.NO {
     43:   allWrap = <tr><td>|</td></tr>
     44:   linkWrap (
     45:    <table border="0" cellpadding="0" cellspacing="0" style="margin: 2px; 0px; 2px; 0px;">
     46:       <tr>
     47:         <td><img src="clear.gif" width="15" height="1" /></td>
     48:         <td><img src="fileadmin/arrow_gray.gif" height="9" width="9" hspace="3" /></td>
     49:         <td>|</td>
     50:       </tr>
     51:    </table>
     52:   )
     53: }

The menu looks like this on a web page:

.. figure:: ../../Images/ContentObjectsHmenuExampleMenu.png
   :alt: Output of the example menu.

The TypoScript code above generates this menu, but the items do not
link straight to pages as usual. This is because the *whole* menu is
generated from this array, which was returned from the function
"menuMenuArray" called in TypoScript line 4+5 ::

      1:     function makeMenuArray($content, $conf) {
      2:         return array(
      3:             array(
      4:                 'title' => 'Contact',
      5:                 '_OVERRIDE_HREF' => 'index.php?id=10',
      6:                 '_SUB_MENU' => array(
      7:                     array(
      8:                         'title' => 'Offices',
      9:                         '_OVERRIDE_HREF' => 'index.php?id=11',
     10:                         '_OVERRIDE_TARGET' => '_top',
     11:                         'ITEM_STATE' => 'ACT',
     12:                         '_SUB_MENU' => array(
     13:                             array(
     14:                                 'title' => 'Copenhagen Office',
     15:                                 '_OVERRIDE_HREF' => 'index.php?id=11&officeId=cph',
     16:                             ),
     17:                             array(
     18:                                 'title' => 'Paris Office',
     19:                                 '_OVERRIDE_HREF' => 'index.php?id=11&officeId=paris',
     20:                             ),
     21:                             array(
     22:                                 'title' => 'New York Office',
     23:                                 '_OVERRIDE_HREF' => 'http://www.newyork-office.com',
     24:                                 '_OVERRIDE_TARGET' => '_blank',
     25:                             )
     26:                         )
     27:                     ),
     28:                     array(
     29:                         'title' => 'Form',
     30:                         '_OVERRIDE_HREF' => 'index.php?id=10&cmd=showform',
     31:                     ),
     32:                     array(
     33:                         'title' => 'Thank you',
     34:                         '_OVERRIDE_HREF' => 'index.php?id=10&cmd=thankyou',
     35:                     ),
     36:                 ),
     37:             ),
     38:             array(
     39:                 'title' => 'Products',
     40:                 '_OVERRIDE_HREF' => 'index.php?id=14',
     41:             )
     42:         );
     43:     }

Notice how the array contains "fake" page-records which has *no* uid
field, only a "title" and "\_OVERRIDE\_HREF" as required and some
other fields as it fits.

- The first level with items "Contact" and "Products" contains "title"
  and "\_OVERRIDE\_HREF" fields, but "Contact" extends this by a
  "\_SUB\_MENU" array which contains a similar array of items.

- The first item on the second level, "Offices", contains a field called
  "\_OVERRIDE\_TARGET". Further the item has its state set to "ACT"
  which means it will render as an "active" item (you will have to
  calculate such stuff manually when you are not rendering a menu of
  real pages!). Finally there is even another sub-level of menu items.

