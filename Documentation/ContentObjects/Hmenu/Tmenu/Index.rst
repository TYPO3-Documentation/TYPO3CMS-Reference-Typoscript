..  include:: /Includes.rst.txt
..  index:: TMENU
..  _menu-objects:
..  _data-type-menuobj:
..  _tmenu:

=====
TMENU
=====

..  warning::
    This TypoScript object is still available to provide backward compatibility
    for old sites. When creating a new menu or refactoring an existing one
    always use the `menu data processor <https://docs.typo3.org/permalink/t3tsref:menuprocessor>`_
    and a Fluid template.

For examples on how to use the TMENU please refer to old version of this
document, for example :ref:`TMENU <t3tsref/11.5:tmenu>`-.

..  toctree::
    :glob:

    *

..  contents::
    :local:

..  index:: TMENU; Item states

..  _tmenu-common-property-no:
..  _tmenu-common-property-ifsub:
..  _tmenu-common-property-act:
..  _tmenu-common-property-actifsub:
..  _tmenu-common-property-cur:
..  _tmenu-common-property-curifsub:
..  _tmenu-common-property-usr:
..  _tmenu-common-property-spc:
..  _tmenu-common-property-userdef1:
..  _tmenu-common-property-userdef2:
..  _tmenu-common-properties:

TMENU item states
=================

These properties are all the item states used by :typoscript:`TMENU`.

..  warning::

    Be aware to properly escape menu item content in order to prevent
    Cross-site scripting vulnerabilities. It is therefore highly recommended
    to use :php:`stdWrap.htmlSpecialChars = 1` in all TMENU item states.

The following Item states are listed from the least to the highest priority:

..  confval-menu::
    :name: tmenu-item-states
    :caption: TMENU item states
    :display: table
    :type:
    :Default:

    ..  confval:: NO
        :name: tmenu-common-property-no
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 1 (true)


        The default "Normal" state rendering of Item. This is required for all
        menus.

    ..  confval:: IFSUB
        :name: tmenu-common-property-ifsub
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for menu items which has subpages.

    ..  confval:: ACT
        :name: tmenu-common-property-act
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for menu items which are found in the rootLine.

    ..  confval:: ACTIFSUB
        :name: tmenu-common-property-actifsub
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for menu items which are found in the rootLine
        and have subpages.

    ..  confval:: CUR
        :name: tmenu-common-property-cur
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for a menu item if the item is the current page.

    ..  confval:: CURIFSUB
        :name: tmenu-common-property-curifsub
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for a menu item if the item is the current page
        and has subpages.

    ..  confval:: USR
        :name: tmenu-common-property-usr
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for menu items which are access restricted pages
        that a user has access to.

    ..  confval:: SPC
        :name: tmenu-common-property-spc
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`
        :Default: 0

        Enable/Configuration for 'Spacer' pages.

        Spacers are pages of the doktype "Spacer". These are not viewable
        pages but "placeholders" which can be used to divide menu items.

    ..  confval:: USERDEF1
        :name: tmenu-common-property-userdef1
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`

        User-defined, see :confval:`menu-common-properties-itemArrayProcFunc` for details on how
        to use this.

        You can set the ITEM\_STATE values USERDEF1 and USERDEF2 (+...RO) from
        a script/user function processing the menu item array. See the property
        :confval:`menu-common-properties-itemArrayProcFunc` of the menu objects.

    ..  confval:: USERDEF2
        :name: tmenu-common-property-userdef2
        :type: :ref:`data-type-boolean` / :ref:`tmenuitem`

        Same like :confval:`USERDEF1 <tmenu-common-property-userdef1>` but has a higher
        priority.

..  _menu-common-properties:

..  index:: TMENU; properties

Properties
==========

..  confval-menu::
    :name: tmenu-properties
    :caption: TMENU Properties
    :display: table
    :type:
    :Default:

    ..  confval:: expAll
        :name: menu-common-properties-expAll
        :type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`

        If this is true, the menu will always show the menu on the level
        underneath the menu item. This corresponds to a situation where a user
        has clicked a menu item and the menu folds out the next level. This
        can enable that to happen on all items as default.

    ..  confval:: sectionIndex
        :name: menu-common-properties-sectionIndex
        :type: :ref:`data-type-boolean`

        If this property is set, then the
        menu will not consist of links to pages on the "next level" but rather
        of links to the parent page to the menu, and in addition "#"-links to
        the cObjects rendered on the page. In other words, the menu items will
        be a section index with links to the content elements on the page (by
        default with colPos=0!).

        If you set this, all content elements (from tt\_content table) of
        "Column" = "Normal" *and* the "Index"-check box clicked are selected.
        This corresponds to the "Menu/Sitemap" content element when "Section
        index" is selected as type.

        ..  confval:: sectionIndex.type
            :name: menu-common-properties-sectionIndex-type
            :type: :ref:`data-type-string` ("all" / "header")

            "all"
                The "Index"-checkbox is not considered and all content elements - by
                default with colPos=0 - are selected.

            "header"
                Only content elements with a visible header-layout (and a
                non-empty 'header'-field!) are selected. In other words, if the
                header layout of an element is set to "Hidden" then the
                page will not appear in the menu.



        ..  confval:: sectionIndex.includeHiddenHeaders
            :name: menu-common-properties-sectionIndex-includeHiddenHeaders
            :type: :ref:`data-type-boolean`

             If you set this and sectionIndex.type is set to "header",
             also elements with a header layout set to "Hidden" will appear
             in the menu.



        ..  confval:: sectionIndex.useColPos
            :name: menu-common-properties-sectionIndex-useColPos
            :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`
            :Default: 0

            This property allows you to set the colPos which should be used in the
            where clause of the query. Possible values are integers, default is "0".

            Any positive integer and 0 will lead to a where clause containing
            "colPos=x" with x being the aforementioned integer. A negative value
            drops the filter "colPos=x" completely.

            ..  code-block:: typoscript
                :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

                tt_content.menu.20.3.1.sectionIndex.useColPos = -1

    ..  confval:: target
        :name: menu-common-properties-target
        :type: string
        :Default: self

        Target of the menu links

    ..  confval:: forceTypeValue
        :name: menu-common-properties-forceTypeValue
        :type: :ref:`data-type-integer`

        If set, the `&type` parameter of the link is forced to this value
        regardless of target.


    ..  confval:: stdWrap
        :name: menu-common-properties-stdWrap
        :type: :ref:`stdWrap <stdwrap>`


        Wraps the whole block of sub items.

    ..  confval:: wrap
        :name: menu-common-properties-wrap
        :type: :ref:`wrap <data-type-wrap>`

        Wraps the whole block of sub items, but only if there were items in the menu!

    ..  confval:: IProcFunc
        :name: menu-common-properties-IProcFunc
        :type: function name

        The internal array "I" is passed to this function and expected
        returned as well. Subsequent to this function call the menu item is
        compiled by implode()'ing the array $I[parts] in the passed array.
        Thus you may modify this if you need to.

    ..  confval:: alternativeSortingField
        :name: menu-common-properties-alternativeSortingField
        :type: :ref:`data-type-string`

        Normally the menu items are sorted by the fields "sorting" in the
        pages- and tt\_content-table. Here you can enter a list of fields that
        is used in the SQL- "ORDER BY" statement instead. You can also provide
        the sorting order.

        **Limitations:**

        This property works with normal menus, sectionsIndex menus and
        special-menus of type "directory".

    ..  confval:: minItems
        :name: menu-common-properties-minItems
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

        The minimum items in the menu. If the number of pages does not reach
        this level, a dummy-page with the title "..." and
        uid=[currentpage\_id] is inserted.

        Takes precedence over HMENU property :ref:`hmenu-minitems`.

    ..  confval:: maxItems
        :name: menu-common-properties-maxItems
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

        The maximum items in the menu. More items will be ignored.

        Takes precedence over HMENU property :ref:`hmenu-maxitems`.

    ..  confval:: begin
        :name: menu-common-properties-begin
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>` :ref:`+calc <objects-calc>`

        The first item in the menu.

    ..  confval:: debugItemConf
        :name: menu-common-properties-debugItemConf
        :type: :ref:`data-type-boolean`

        Outputs (by the :php:`debug()` function) the configuration arrays for each
        menu item. Useful to debug :ref:`optionsplit` things and such...

    ..  confval:: overrideId
        :name: menu-common-properties-overrideId
        :type: :ref:`data-type-integer` (page id)

        If set, then all links in the menu will point to this pageid. Instead
        the real uid of the page is sent by the parameter "&real\_uid=[uid]".

        This feature is smart, if you have inserted a menu from somewhere
        else, perhaps a shared menu, but wants the menu items to call the same
        page, which then generates a proper output based on the real\_uid.

    ..  confval:: addParams
        :name: menu-common-properties-addParams
        :type: :ref:`data-type-string`

        Additional parameter for the menu links.

        Must be rawurlencoded.

    ..  confval:: showAccessRestrictedPages
        :name: menu-common-properties-showaccessrestrictedpages
        :type: :ref:`data-type-integer` (page ID) / keyword "NONE"

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

        **.addParam**: Additional parameter for the URL, which can hold two
        markers; ###RETURN\_URL### which will be substituted with the link the
        page would have had if it had been accessible and ###PAGE\_ID###
        holding the page ID of the page coming from (could be used to look up
        which fe\_groups was required for access.

        **.ATagParams**: Add custom attributes to the anchor tag.

    ..  confval:: additionalWhere
        :name: menu-common-properties-additionalWhere
        :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

        Adds an additional part to the WHERE clause for this menu.
        Make sure to start the part with "AND "!

    ..  confval:: itemArrayProcFunc
        :name: menu-common-properties-itemArrayProcFunc
        :type: function name

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

    ..  confval:: submenuObjSuffixes
        :name: menu-common-properties-submenuObjSuffixes
        :type: :ref:`data-type-string` / :ref:`optionsplit`

        Defines a suffix for alternative sub-level menu objects.
