:navigation-title: Browse
..  include:: /Includes.rst.txt
..  _hmenu-special-browse:
..  _MenuProcessor-special-browse:

===========================================
Browse navigation - previous and next links
===========================================

This data processor provides pages which give your reader the possibility to
browse to the previous page, to the next page, to a page with the
table of contents and so on.

..  tip::
    In older TypoScript browser menus were created using the `HMENU` object.
    This still works for backward compatibility reasons. We recommend to only use
    data processors for newly created menus.

    See :ref:`TYPO3 11, Browse navigation <t3tsref/:hmenu-special-browse>` for
    examples how this was done.

..  attention::
    Mount pages are *not* supported!

..  contents::
    :local:

..  _MenuProcessor-special-browse-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  confval:: special.value
        :name: hmenu-browse-special-value
        :type: integer /:ref:`stdWrap <stdwrap>`
        :Default: current page ID

        The default value can be overridden with a different page ID as starting
        point for the menu in some rare use cases.

    ..  confval:: special.items
        :name: hmenu-browse-special-items
        :type: list of item names separated by `|`
        :Default: `index|up|next|prev`

        A list, separated by pipes `|`, containing the following item types:

        `next` / `prev`
            Links to the next page / the previous page.
            Next and previous pages are from the same "pid" as the current page id
            (or "value") - that is the next item in a menu with the current page.
            Also referred to as current level.

            If :confval:`hmenu-browse-special-items-prevnextToSection` is set then
            `next` / `prev` will link to the first
            page of the next section / to the last page of the previous section,
            too.

        `nextsection` / `prevsection`
            Links to the next section / the
            previous section. A section is defined as the subpages of a page on
            the same level as the parent (pid) page of the current page. Will not
            work if the parent page of the current page is the root page of the
            site.

        `nextsection_last` / `prevsection_last`
            Where `nextsection` / `prevsection` links to the first page in a section, these
            link to the last page. If there is only one page in the section that
            will be both first and last. Will not work if the parent page of the
            current page is the root page of the site.

        `first` / `last`
            First / last page on the current level. If
            there is only one page on the current level that page will be both
            first and last.

        `up`
            Links to the parent (pid) page of the current page (up 1
            level). Will always be available.

        `index`
            Links to the parent of the parent page of the current
            page(up 2 levels). May not be available, if that page is out of the
            root line.

    ..  confval:: special.items.prevnextToSection
        :name: hmenu-browse-special-items-prevnextToSection
        :type: boolean
        :Default: false

        If set, the `prev` and `next` navigation will jump to the next section
        when it reaches the end of pages in the current section. That way
        `prev` and `next` will also link to the first page of the next section
        / to the last page of the previous section.

    ..  confval:: special.excludeNoSearchPages
        :name: hmenu-browse-special-excludeNoSearchPages
        :type: boolean
        :Default: false

        If set, pages marked with the `no search` checkbox will be excluded from the menu.

..  _MenuProcessor-special-browse-example:

Example: Display a browse navigation
====================================

The menu data processor with `special = browse` returns the found items as an
array. The items in this array contain no information about what kind of item
(previous, next, up, etc) they are. We therefore recommend to only use one
item kind per data processor:

..  literalinclude:: _code-snippets/_BrowseNavigation.typoscript
    :caption: config/sites/mySite/setup.typoscript

The result of each data processor can then be used, assuming that the result is
the first item of the array saved into the database.
