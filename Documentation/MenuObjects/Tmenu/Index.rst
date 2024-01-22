..  include:: /Includes.rst.txt
..  index:: TMENU
..  _tmenu:


=====
TMENU
=====

:typoscript:`TMENU` is a menu object type.

..  contents::
    :local:

..  index:: TMENU; Item states
..  _tmenu-common-properties:

TMENU item states
=================

These properties are all the item states used by :typoscript:`TMENU`.

..  note::
    Order of priority: :t3-menu-tmenu-state:`USERDEF2`, :t3-menu-tmenu-state:`USERDEF1`,
    :t3-menu-tmenu-state:`SPC`, :t3-menu-tmenu-state:`USR`, :t3-menu-tmenu-state:`CURIFSUB`,
    :t3-menu-tmenu-state:`CUR`, :t3-menu-tmenu-state:`ACTIFSUB`, :t3-menu-tmenu-state:`ACT`,
    :t3-menu-tmenu-state:`IFSUB`, :t3-menu-tmenu-state:`NO`.

NO
--

..  t3-menu-tmenu-state:: NO

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 1 (true)


    The default "normal" state rendering of item. This is required for all
    menus.

    If you specify properties for the :typoscript:`NO` property, you do not have
    to set it to "1". Otherwise with no properties setting :typoscript:`NO = 1`
    will render the menu anyways (for :typoscript:`TMENU` this may make sense).

    The simplest menu TYPO3 can generate is then:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.20 = HMENU
        page.20.1 = TMENU
        page.20.1.NO = 1

    That will be pure :html:`<a>` tags wrapped around page titles.

IFSUB
-----

..  t3-menu-tmenu-state:: IFSUB

    :Data type: :ref:`data-type-boolean` / (config)

    :Default: 0

    Enable/configuration for menu items which has subpages.

ACT
---

..  t3-menu-tmenu-state:: ACT

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 0

    Enable/configuration for menu items which are found in the root line.

ACTIFSUB
--------

..  t3-menu-tmenu-state:: ACTIFSUB

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 0

    Enable/configuration for menu items which are found in the root line
    and have subpages.

CUR
---

..  t3-menu-tmenu-state:: CUR

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 0


    Enable/configuration for a menu item, if the item is the current page.

CURIFSUB
--------

..  t3-menu-tmenu-state:: CURIFSUB

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 0

    Enable/configuration for a menu itemm if the item is the current page
    and has subpages.

USR
---

..  t3-menu-tmenu-state:: USR

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 0

    Enable/configuration for menu items which are access-restricted pages
    that a user has access to.

SPC
---

..  t3-menu-tmenu-state:: SPC

    :Data type: :ref:`data-type-boolean` / (config)
    :Default: 0

    Enable/configuration for "spacer" pages.

    Spacers are pages of the
    :ref:`doktype "Spacer" <t3coreapi:list-of-page-types>`. These are not
    viewable pages but "placeholders" which can be used to divide menu items.

USERDEF1
--------

..  t3-menu-tmenu-state:: USERDEF1

    :Data type: :ref:`data-type-boolean` / (config)

    User defined, see :t3-menu-tmenu:`itemArrayProcFunc` for details on how
    to use this.

    You can set the ITEM\_STATE values USERDEF1 and USERDEF2 (+...RO) from
    a script/user function processing the menu item array. See the property
    :t3-menu-tmenu:`itemArrayProcFunc` of the menu objects.

USERDEF2
--------

..  t3-menu-tmenu-state:: USERDEF2

    :Data type: :ref:`data-type-boolean` / (config)

    Same like :t3-menu-tmenu-state:`USERDEF1` but has a higher priority.


.. _menu-common-properties:

.. index:: TMENU; properties

Properties
==========

expAll
------

..  t3-menu-tmenu:: expAll

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`

    If this is true, the menu will always show the menu on the level
    underneath the menu item. This corresponds to a situation where a user
    has clicked a menu item and the menu folds out the next level. This
    can be enabled to happen on all items as default.

collapse (removed)
------------------

..  versionchanged:: 12.0
    The property was removed with TYPO3 v12.0. Use a custom user function or
    the PSR-14 event :ref:`t3coreapi:FilterMenuItemsEvent` to modify the menu
    items.

sectionIndex
------------

If this property is set, the menu will not consist of links to pages on the
"next level", but rather of links to the parent page to the menu and, in
addition, anchor links to the cObjects rendered on the page. In other words, the
menu items will be a section index with links to the content elements on the
page (by default with colPos=0!).

..  t3-menu-tmenu:: sectionIndex

    :Data type: :ref:`data-type-boolean`

    If you set this, all content elements (from :sql:`tt_content` table) of
    "Column" = "Normal" *and* the "Index" checkbox enabled are selected.
    This corresponds to the "Menu/Sitemap" content element when "Section
    index" is selected as type.


..  _tmenu-sectionIndex-type:

sectionIndex.type
~~~~~~~~~~~~~~~~~

..  t3-menu-tmenu:: sectionIndex.type

    :Data type: :ref:`data-type-string` ("all" / "header")

    "all"
        The "Index" checkbox is not considered and all content elements - by
        default with colPos=0 - are selected.

    "header"
        Only content elements with a visible header layout (and a
        non-empty "header" field!) are selected. In other words, if the
        header layout of an element is set to "hidden" then the
        page will not appear in the menu.


sectionIndex.includeHiddenHeaders
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  t3-menu-tmenu:: sectionIndex.includeHiddenHeaders

    :Data type: :ref:`data-type-boolean`

    If you set this and :ref:`sectionIndex.type <tmenu-sectionIndex-type>` is
    set to "header", also elements with a header layout set to "hidden" will
    appear in the menu.

sectionIndex.useColPos
~~~~~~~~~~~~~~~~~~~~~~

..  t3-menu-tmenu:: sectionIndex.useColPos

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

    :Default: 0

    This property allows you to set the colPos which should be used in the
    :sql:`WHERE` clause of the query. Possible values are integers, default is
    "0".

    Any positive integer and 0 will lead to a where clause containing
    :sql:`colPos=x` with x being the aforementioned integer. A negative value
    drops the filter :sql:`colPos=x` completely.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        tt_content.menu.20.3.1.sectionIndex.useColPos = -1

The data record in sectionIndex menus
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

When the menu records are selected, it works like this: The parent page
record is used as the "base" for the menu record. That means that any
`no_cache` or `target` properties of the parent page are used for the
whole menu.

But of course some fields from the :sql:`tt_content` records are
transferred. This is how it is mapped:

..  code-block:: php
    :caption: Example of data mapping

    $temp[$row[uid]] = $basePageRow;
    $temp[$row[uid]]['title'] = $row['header'];
    $temp[$row[uid]]['subtitle'] = $row['subheader'];
    $temp[$row[uid]]['starttime'] = $row['starttime'];
    $temp[$row[uid]]['endtime'] = $row['endtime'];
    $temp[$row[uid]]['fe_group'] = $row['fe_group'];
    $temp[$row[uid]]['media'] = $row['media'];
    $temp[$row[uid]]['header_layout'] = $row['header_layout'];
    $temp[$row[uid]]['bodytext'] = $row['bodytext'];
    $temp[$row[uid]]['image'] = $row['image'];
    $temp[$row[uid]]['sectionIndex_uid'] = $row['uid'];

Basically this shows that

*   The fields :sql:`header` and :sql:`subheader` from the :sql:`tt_content`
    table are mapped to `title` and `subtitle` in the page record. Thus you
    shouldn't need to change your standard menu objects to fit this thing.

*   The fields :sql:`starttime`, :sql:`endtime`, :sql:`fe\_group` and
    :sql:`media` from the :sql:`tt_content` table are mapped to the same fields
    in a page record.

*   The fields :sql:`header_layout`, :sql:`bodytext` and :sql:`image` are mapped
    to non-existing fields in the page record

*   A new field, `sectionIndex_uid` is introduced in the pages record, which is
    detected by the :php:`\TYPO3\CMS\Frontend\Typolink\PageLinkBuilder`. If this
    field is present in a page record, the :php:`PageLinkBuilder` will prepend a
    hash mark, followed by `c` and the number of the field (for example,
    `#c42`).

..  note::
    You cannot create submenus to :typoscript:`sectionIndex` menus. These
    elements are not pages and thereby have no children.


target
------

..  t3-menu-tmenu:: target

    :Data type: :ref:`data-type-target`
    :Default: self

    Target of the menu links.

forceTypeValue
---------------

..  t3-menu-tmenu:: forceTypeValue

    :Data type: :ref:`data-type-integer`

    If set, the `&type` parameter of the link is forced to this value
    regardless of target.

stdWrap
-------

..  t3-menu-tmenu:: stdWrap

    :Data type: :ref:`stdWrap <stdwrap>`

    Wraps the whole block of subitems.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        2 = TMENU
        2 {
           stdWrap.dataWrap = <ul class="{register : parentProperty}"> | </ul>
           NO {
              // ...
           }
        }

wrap
----

..  t3-menu-tmenu:: wrap

    :Data type: :ref:`wrap <data-type-wrap>`

    Wraps the whole block of subitems, but only if there were items in the menu!

IProcFunc
---------

..  t3-menu-tmenu:: IProcFunc

    :Data type: function name

    The internal array :php:`I` is passed to this function and expected
    returned as well. Subsequent to this function call the menu item is
    compiled by implode()'ing the array :php:`$I[parts]` in the passed array.
    Thus you may modify this if you need to.

Item states
-----------

..  todo: This does not seem to make sense?  Remove? Item states are already
    listed above

..  t3-menu-tmenu:: [Item States, like NO, ACT, CUR etc]

    :Data type: :ref:`->TMENUITEM <tmenu-common-properties>`

    This is the :typoscript:`TMENUITEM` options for each category of a menu item
    that can be generated.

    **Special:**

    The :ref:`optionsplit` function processes the whole configuration before
    the items are generated.


alternativeSortingField
-----------------------

..  t3-menu-tmenu:: alternativeSortingField

    :Data type: :ref:`data-type-string`

    Normally the menu items are sorted by the fields :sql:`sorting` in the
    :sql:`pages` and :sql:`tt_content` table. Here you can enter a list of
    fields that is used in the :sql:`ORDER BY` statement instead. You can also
    provide the sorting order.

    **Example (for "pages" table):**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        alternativeSortingField = title desc

    This will render the menu in reversed alphabetical order.

    **Limitations:**

    This property works with normal menus, :typoscript:`sectionsIndex` menus and
    special menus of type :typoscript:`directory`.

minItems
--------

..  t3-menu-tmenu:: minItems

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

    The minimum items in the menu. If the number of pages does not reach
    this level, a dummy page with the title "..." and
    `uid=[currentpage_id]` is inserted.

    It takes precedence over HMENU property :ref:`hmenu-minitems`.

maxItems
--------

..  t3-menu-tmenu:: maxItems

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

    The maximum items in the menu. More items will be ignored.

    Takes precedence over HMENU property :ref:`hmenu-maxitems`.

begin
-----

..  t3-menu-tmenu:: begin

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>` :ref:`+calc <objects-calc>`

    The first item in the menu.

    **Example:**

    This results in a menu, where the first two items are skipped starting
    with item number 3:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        begin = 3

    Takes precedence over HMENU property :ref:`hmenu-begin`.

debugItemConf
-------------

..  t3-menu-tmenu:: debugItemConf

    :Data type: :ref:`data-type-boolean`

    Outputs (by the :php:`debug()` function) the configuration arrays for each
    menu item. Useful to debug :ref:`optionsplit` things and such...

overrideId
----------

..  t3-menu-tmenu:: overrideId

    :Data type: :ref:`data-type-integer` (page ID)

    If set, then all links in the menu will point to this page ID. Instead,
    the real UID of the page is sent by the parameter `&real_uid=[uid]`.

    This feature is smart, if you have inserted a menu from somewhere
    else, perhaps a shared menu, but want the menu items to call the same
    page, which then generates a proper output based on the `real_uid`.

addParams
---------

..  t3-menu-tmenu:: addParams

    :Data type: :ref:`data-type-string`

    Additional parameter for the menu links.

    **Example:**

    ..  code-block:: text

        &some_var=some%20value

    It must be raw-urlencoded.


.. index:: TMENU; showAccessRestrictedPages
.. _menu-common-properties-showaccessrestrictedpages:

showAccessRestrictedPages
--------------------------

..  t3-menu-tmenu:: showAccessRestrictedPages

    :Data type: :ref:`data-type-integer` (page ID) / keyword "NONE"

    If set, pages in the menu will include pages with frontend user group
    access enabled. However the page is of course not accessible and
    therefore the URL in the menu will be linked to the page with the ID
    of this value. On that page you could put a login form or other
    message.

    If the value is "NONE" the link will not be changed and the site will
    perform page-not-found handling when clicked (which can be used to
    capture the event and act accordingly of course). This means that the
    link's URL will point to the page even if it is not accessible by the
    current frontend user. Note that the default behavior of page not found
    handling is to show the parent page instead.

    **Properties:**

    **.addParam**: Additional parameter for the URL, which can hold two
    markers; `###RETURN_URL###` which will be substituted with the link the
    page would have had if it had been accessible and `###PAGE_ID###`
    holding the page ID of the page coming from (could be used to look up
    which :sql:`fe_groups` was required for access.

    ..  versionadded:: 12.3

    **.ATagParams**: Add custom attributes to the anchor tag.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        showAccessRestrictedPages = 22
        showAccessRestrictedPages.addParams = &return_url=###RETURN_URL###&pageId=###PAGE_ID###
        showAccessRestrictedPages.ATagParams = class="restricted"

    The example will link access restricted menu items to page ID 22 with
    the return URL in the GET variable `return_url` and the page ID in the GET
    variable "pageId". Additionally, a CSS class "restricted" is added to the
    anchor tag.

additionalWhere
---------------

..  t3-menu-tmenu:: additionalWhere

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Adds an additional part to the :sql:`WHERE` clause for this menu.
    Make sure to start the part with "AND "!

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.authormenu = HMENU
        lib.authormenu.1 = TMENU
        lib.authormenu.1.additionalWhere = AND author!=""

itemArrayProcFunc
-----------------

..  t3-menu-tmenu:: itemArrayProcFunc

    :Data type: function name

    The first variable passed to this function is the :php:`menuArr` array with
    the menu items as they are collected based on the type of menu.

    You are free to manipulate or add to this array as you like. Just
    remember to return the array again!

    **Note:**

    :typoscript:`.parentObj` property is **hardcoded** to be a reference to the
    calling :file:`typo3/sysext/frontend/Classes/ContentObject/Menu/` object.
    Here you will find, for example, `->id` to be the UID of the menu item
    generating a submenu and such.

    **Presetting element state**

    You can override element states like SPC, IFSUB, ACT, CUR or USR by
    setting the key ITEM\_STATE in the page records.

submenuObjSuffixes
------------------

..  t3-menu-tmenu:: submenuObjSuffixes

    :Data type: :ref:`data-type-integer` / :ref:`optionsplit`

    Defines a suffix for alternative sub-level menu objects. Useful to
    create special submenus depending on their parent menu element. See
    example below.

    ..  rubric:: Example

    This example will generate a menu where the menu objects for the
    second level will differ depending on the number of the first level
    item for which the submenu is rendered. The second level objects used
    are "2" (the default), "2a" and "2b" (the alternatives). Which of them
    is used is defined by "1.submenuObjSuffixes" which has the
    configuration "a \|\*\| \|\*\| b". This configuration means that the
    first menu element will use configuration "2a" and the last will use
    "2b" while anything in between will use "2" (no suffix applied) :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    ..  figure:: /Images/ManualScreenshots/FrontendOutput/Hmenu/MenuObjectsCommonPropertiesSubmenuObjSuffixes.png
        :alt: Output of the above example.

    Applies to TMENU on >= 2 :sup:`nd` level in a menu.
