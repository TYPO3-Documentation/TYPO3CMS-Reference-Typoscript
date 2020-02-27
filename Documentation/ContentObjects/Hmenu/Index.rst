.. include:: ../../Includes.txt


.. _cobj-hmenu:

=====
HMENU
=====

Objects of type HMENU generate hierarchical menus. It is the one usually being
used to create the navigation menu of websites.

The cObject HMENU allows you to define the global settings of the menu
as a whole. For the rendering of the single menu levels, different
:ref:`menu objects <menu-objects>` can be used.

Apart from just creating a hierarchical menu of the pages as they are
structured in the page tree, HMENU also allows you to use the
:ref:`.special property <hmenu-special-property>` to create special
menus. These special menus take characteristics of special menu types
into account.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-number:

         (1 / 2 / 3 /...)

   Data type
         :ref:`menu object <data-type-menuobj>`

   Default
         (no menu)

   Description
         For every menu level, that should be rendered, an according entry must
         exist. It defines the menu object that should render the menu items on
         the according level. 1 is the first level, 2 is the second level, 3 is
         the third level and so on.

         **The property "1" is required!**

         The entry 1 for the first level always must exist. All other levels only
         will be generated when they are configured.

         **Example:** ::

            temp.sidemenu = HMENU
            temp.sidemenu.1 = GMENU
            temp.sidemenu.1 {
              # Configuration of that GMENU here...
            }
            temp.sidemenu.2 = TMENU
            temp.sidemenu.2 {
              # Configuration of that TMENU here...
            }
            temp.sidemenu.3 = TMENU
            temp.sidemenu.3 {
              # Configuration of that TMENU here...
            }

         This creates a menu with up to three levels: The first level being a GMENU,
         the second and third level being TMENUs.

         TYPO3 offers :ref:`a variety of menu objects <menu-objects>`.



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


.. include:: ../../DataTypes/Properties/Cache.rst.txt


.. container:: table-row

   Property
         .. _hmenu-entrylevel:

         entryLevel

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         Defines at which level in the rootLine the menu should start.

         Default is "0" which gives us a menu of the very first pages on the
         site.

         If the value is < 0, entryLevel is chosen from "behind" in the
         rootLine. Thus "-1" is a menu with items from the outermost level,
         "-2" is the level before the outermost...

         **Note:** :ts:`entryLevel` does not show a menu **of a certain level of pages**
         (use :ts:`special = directory` for that)
         but it means that it will start to be visible **from that level on**.

         So, for example if you build a simple "sitemap" menu like this one::

            page.10 = HMENU
            page.10 {
              entryLevel = 4
              1 = TMENU
              1.wrap = <ul> | </ul>
              1.NO.wrapItemAndSub = <li> | </li>
              1.expAll = 1
              2 < .1
              3 < .2
              4 < .3
              5 < .4
              6 < .5
              7 < .6
            }

         it will start to be visible from the 4th level (and will contain only the subpages from that level).
         Please note also that this affects also the menu generated with :ts:`MenuProcessor`. Example::

            page.10{
               dataProcessing {
                10 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
                10 {
                   special = list
                   special.value.field = pages
                   levels = 7
                   entryLevel = 4
                   as = menu
                   expandAll = 1
                   titleField = nav_title // title
                }
              }
            }


.. container:: table-row

   Property
         .. _hmenu-special:

         special

   Data type
         *"directory" / "list" / "updated" / "rootline" / "browse" / "keywords"
         / "categories" / "language" / "userfunction"*

   Description
         Lets you define special types of menus.

         See the section about the :ref:`.special property <hmenu-special-property>`!


.. container:: table-row

   Property
         .. _hmenu-special-value:

         special.value

   Data type
         *list of page-uid's* /:ref:`stdWrap <stdwrap>`

   Description
         List of page uid's to use for the special menu. What they are used
         for depends on the menu type as defined by ".special"; see the
         section about the :ref:`.special property <hmenu-special-property>`!


.. container:: table-row

   Property
         .. _hmenu-minitems:

         minItems

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The minimum number of items in the menu. If the number of pages does
         not reach this level, a dummy-page with the title "..." and
         uid=[currentpage\_id] is inserted.

         **Note:** Affects all sub menus as well. To set the value for each
         menu level individually, set the properties in the menu objects (see
         "Common properties" table).


.. container:: table-row

   Property
         .. _hmenu-maxitems:

         maxItems

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The maximum number of items in the menu. Additional items will be
         ignored.

         **Note:** Affects all sub menus as well. (See "minItems" for a
         notice.)


.. container:: table-row

   Property
         .. _hmenu-begin:

         begin

   Data type
         integer /:ref:`stdWrap <stdwrap>` :ref:`+calc <objects-calc>`

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

   Default
         5,6

   Description
         Enter the list of page document types (doktype) to exclude from menus.
         By default pages that are "backend user access only" (6) are excluded.



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
         "config.sys\_language\_uid" exists for the
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
     NO.afterImg = media/bullets/dots2.gif |*||*| _
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


.. note::

   :ts:`.entryLevel` generally is not supported together with the
   :ts:`.special` property! The only exception is :ts:`special = keywords`.

Also be aware that this property selects pages for the first level in
the menu. Submenus by menuObjects 2+ will be created as usual.


.. _hmenu-special-directory:

special = directory
~~~~~~~~~~~~~~~~~~~

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

   Default
         current page id

   Description
         This will generate a menu of all pages with pid = 35 and pid = 56. ::

            20 = HMENU
            20.special = directory
            20.special.value = 35, 56



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = directory]


.. _hmenu-special-list:

special = list
~~~~~~~~~~~~~~

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

   Default
         0

   Description
         This will generate a menu with the two pages (uid=35 and uid=56)
         listed::

            20 = HMENU
            20.special = list
            20.special.value = 35, 56

         If .value is not set, the default uid is 0, so that only your homepage
         will be listed.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = list]


.. _hmenu-special-updated:

special = updated
~~~~~~~~~~~~~~~~~

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

   Default
         SYS\_LASTCHANGED

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



.. container:: table-row

   Property
         .. _hmenu-special-updated-depth:

         depth

   Data type
         integer

   Default
         20

   Description
         Defines the tree depth.

         The allowed range is 1-20.

         A depth of 1 means only the start id, depth of 2 means start-id +
         first level.

         **Note:** "depth" is relative to "beginAtLevel".



.. container:: table-row

   Property
         .. _hmenu-special-updated-beginatlevel:

         beginAtLevel

   Data type
         integer

   Default
         0

   Description
         Determines starting level for the page trees generated based on .value
         and .depth.

         0 is default and includes the start id.

         1 starts with the first row of subpages,

         2 starts with the second row of subpages.

         **Note:** "depth" is relative to this property.



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

   Default
         10

   Description
         Maximal number of items in the menu. Default is 10, max is 100.



.. container:: table-row

   Property
         .. _hmenu-special-updated-excludenosearchpages:

         excludeNoSearchPages

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, pages marked "No search" are not included.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = updated]


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

special = rootline
~~~~~~~~~~~~~~~~~~

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

   Default
         0 (false)

   Description
         If set to true, the order of the rootline menu elements will be
         reversed.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = rootline]


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

special = browse
~~~~~~~~~~~~~~~~

**Warning:** Mount pages are *not* supported!

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

   Default
         current page id

   Description
         Default is the current page id. Seldom you might want to override this
         value with another page-uid which will then act as the base point for
         the menu and the predefined items.



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
         will be both first and last. Will not work if the parent page of the
         current page is the root page of the site.

         **first** / **last:** First / last page on the current level. If
         there is only one page on the current level that page will be both
         first and last.

         **up:** Links to the parent (pid) page of the current page (up 1
         level). Will always be available.

         **index:** Links to the parent of the parent page of the current
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


.. container:: table-row

   Property
         .. _hmenu-special-browser-excludenosearchpages:

         excludeNoSearchPages

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, pages marked with the "no search" checkbox will be excluded from the menu.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = browse]


.. _hmenu-special-keywords:

special = keywords
~~~~~~~~~~~~~~~~~~

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

   Default
         SYS\_LASTCHANGED

   Description
         Which field in the pages table to use for sorting.

         Possible values are:

         **SYS\_LASTCHANGED:** Is updated to the youngest tstamp of the
         records on the page when a page is generated.

         **manual** or **lastUpdated:** Uses the field "lastUpdated", which
         can be set manually in the page-record.

         **tstamp:** Uses the "tstamp"-field of the pagerecord, which is set
         automatically when the record is changed.

         **crdate:** Uses the "crdate"-field of the pagerecord.

         **starttime:** Uses the starttime field.



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

   Default
         20

   Description
         (same as in section "special = updated")



.. container:: table-row

   Property
         .. _hmenu-special-keywords-limit:

         limit

   Data type
         integer

   Default
         10

   Description
         (same as in section "special = updated")



.. container:: table-row

   Property
         .. _hmenu-special-keywords-excludenosearchpages:

         excludeNoSearchPages

   Data type
         boolean

   Description
         (same as in section "special = updated")


.. container:: table-row

   Property
         .. _hmenu-special-keywords-begin:

         begin

   Data type
         boolean

   Description
         (same as in section "special = updated")


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

   Default
         keywords

   Description
         Defines the field in the pages table in which to search for the
         keywords. Default is the field name "keyword". No check is done to see
         if the field you enter here exists, so make sure to enter an existing field!



.. container:: table-row

   Property
         .. _hmenu-special-keywords-sourcefield:

         keywordsField.sourceField

   Data type
         string

   Default
         keywords

   Description
         Defines the field from the current page from which to take the
         keywords being matched. The default is "keyword". (Notice that
         ".keywordsField" is only setting the page-record field to *search
         in*!)



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = keywords]


.. _hmenu-special-categories:

special = categories
~~~~~~~~~~~~~~~~~~~~

Makes a menu of pages belonging to one or more categories. If a page
belongs to several of the selected categories, it will appear only once.
By default pages are unsorted.

Each in the resulting array of pages gets an additional entry with key
:code:`_categories` containing the list of categories the page belongs to,
as a comma-separated list of uid's. It can be accessed with
:ref:`stdWrap.field <stdwrap-field>` or :ref:`getText <data-type-gettext-field>`
like any other field.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-categories-value:

         value

   Data type
         list of categories / :ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of categories uid's.

         **Example:**

         .. code-block:: typoscript

            20 = HMENU
            20 {
            	special = categories
            	special.value = 1,2
            	1 = TMENU
            	1.NO {
            		...
            	}
            }


.. container:: table-row

   Property
         .. _hmenu-special-categories-relation:

         relation

   Data type
         :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

   Default
         categories

   Description
         Name of the categories-relation field to use for
         building the list of categorized pages, as there can
         be several such fields on a given table.



.. container:: table-row

   Property
         .. _hmenu-special-categories-sorting:

         sorting

   Data type
         :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

   Description
         Which field from the "pages" table should be used for sorting.
         Language overlays are taken into account, so alphabetical sorting
         on the "title" field, for example, will work.

         If an unknown field is defined, the pages will not be sorted.


.. container:: table-row

   Property
         .. _hmenu-special-categories-order:

         order

   Data type
         "asc" or "desc" / :ref:`stdWrap <stdwrap>`

   Default
         asc

   Description
         Order in which the pages should be ordered, ascending or
         descending. Should be "asc" or "desc", case-insensitive.
         Will default to "asc" in case of invalid value.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = categories]


.. _hmenu-special-language:

special = language
~~~~~~~~~~~~~~~~~~

Creates a language selector menu. Typically this is made as a menu
with flags for each language a page is translated to and when the user
clicks any element the translated page is hit.

The "language" type will create menu items based on the current page
record but with the language record for each language overlaid if
available.

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
         comma list of sys\_language uids /:ref:`stdWrap <stdwrap>` or `auto`

   Description
         The number of elements in this list determines the number of menu
         items. Setting to `auto` will include all available languages from
         the current site.


.. container:: table-row

   Property
         .. _hmenu-special-language-normalwhennolanguage:

         normalWhenNoLanguage

   Data type
         boolean

   Description
         If set to 1, the button for a language will be rendered as a non-
         disabled button even if no translation is found for the language.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = language]


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
     5.file = flag_uk.gif || flag_fr.gif || flag_es.gif
     5.offset = 2,2
   }

   lib.langMenu.1.ACT < lib.langMenu.1.NO
   lib.langMenu.1.ACT = 1
   lib.langMenu.1.ACT.backColor = black

   lib.langMenu.1.USERDEF1 < lib.langMenu.1.NO
   lib.langMenu.1.USERDEF1 = 1
   lib.langMenu.1.USERDEF1.5.file = flag_uk_d.gif  || flag_fr_d.gif  || flag_es_d.gif
   lib.langMenu.1.USERDEF1.noLink = 1


.. _hmenu-special-userfunction:

special = userfunction
~~~~~~~~~~~~~~~~~~~~~~

Calls a user function/method in class which should return an array with
page records for the menu.

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

[tsref:(cObject).HMENU.special = userfunction]


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
are graphical items:

.. code-block:: typoscript
   :linenos:

   # ************************
   # MENU LEFT
   # ************************
   lib.leftmenu.20 = HMENU
   lib.leftmenu.20.special = userfunction
   lib.leftmenu.20.special.userFunc = user_3dsplm_pi2->makeMenuArray
   lib.leftmenu.20.1 = GMENU
   lib.leftmenu.20.1.NO {
     wrap = <tr><td>|</td></tr><tr><td class="bckgdgrey1" height="1"></td></tr>
     XY = 163,19
     backColor = white
     10 = TEXT
     10.text.field = title
     10.text.case = upper
     10.fontColor = red
     10.fontFile = fileadmin/fonts/ARIALNB.TTF
     10.niceText = 1
     10.offset = 14,12
     10.fontSize = 10
   }
   lib.leftmenu.20.2 = GMENU
   lib.leftmenu.20.2.wrap = | <tr><td></td></tr><tr><td></td></tr>
   lib.leftmenu.20.2.NO {
     wrap = <tr><td class="bckgdwhite" height="4"></td></tr><tr><td>|</td></tr>
     XY = 163,16
     backColor = white
     10 = TEXT
     10.text.field = title
     10.text.case = upper
     10.fontColor = #666666
     10.fontFile = fileadmin/fonts/ARIALNB.TTF
     10.niceText = 1
     10.offset = 14,12
     10.fontSize = 11
   }
   lib.leftmenu.20.2.RO < lib.leftmenu.20.2.NO
   lib.leftmenu.20.2.RO = 1
   lib.leftmenu.20.2.RO.backColor = #eeeeee
   lib.leftmenu.20.2.ACT < lib.leftmenu.20.2.NO
   lib.leftmenu.20.2.ACT = 1
   lib.leftmenu.20.2.ACT.10.fontColor = red
   lib.leftmenu.20.3 = TMENU
   lib.leftmenu.20.3.NO {
     allWrap = <tr><td>|</td></tr>
     linkWrap (
      <table border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td><img src="clear.gif" width="15" height="1" /></td>
           <td><img src="fileadmin/arrow_gray.gif" height="9" width="9" /></td>
           <td>|</td>
         </tr>
      </table>
     )
   }

The menu looks like this on a web page:

.. figure:: ../../Images/ContentObjectsHmenuExampleMenu.png
   :alt: Output of the example menu.

The TypoScript code above generates this menu, but the items do not
link straight to pages as usual. This is because the *whole* menu is
generated from this array, which was returned from the function
"makeMenuArray" called in TypoScript line 5+6 :

.. code-block:: php
   :linenos:

   function makeMenuArray($content, $conf) {
     return array(
       array(
           'title' => 'Contact',
           '_OVERRIDE_HREF' => 'index.php?id=10',
           '_SUB_MENU' => array(
               array(
                   'title' => 'Offices',
                   '_OVERRIDE_HREF' => 'index.php?id=11',
                   '_OVERRIDE_TARGET' => '_top',
                   'ITEM_STATE' => 'ACT',
                   '_SUB_MENU' => array(
                       array(
                           'title' => 'Copenhagen Office',
                           '_OVERRIDE_HREF' => 'index.php?id=11&officeId=cph',
                       ),
                       array(
                           'title' => 'Paris Office',
                           '_OVERRIDE_HREF' => 'index.php?id=11&officeId=paris',
                       ),
                       array(
                           'title' => 'New York Office',
                           '_OVERRIDE_HREF' => 'http://www.example.com',
                           '_OVERRIDE_TARGET' => '_blank',
                       )
                   )
               ),
               array(
                   'title' => 'Form',
                   '_OVERRIDE_HREF' => 'index.php?id=10&cmd=showform',
               ),
               array(
                   'title' => 'Thank you',
                   '_OVERRIDE_HREF' => 'index.php?id=10&cmd=thankyou',
               ),
           ),
       ),
       array(
           'title' => 'Products',
           '_OVERRIDE_HREF' => 'index.php?id=14',
       )
     );
   }

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

