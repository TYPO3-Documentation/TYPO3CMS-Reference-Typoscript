..  include:: /Includes.rst.txt
..  index:: HMENU; special = browse
..  _hmenu-special-browse:

================================
Browse - previous and next links
================================

This menu contains pages which give your user the possibility to
browse to the previous page, to the next page, to a page with the
table of contents and so on. The menu is built of items given by a
list from the property ".items".

..  attention::
   Mount pages are *not* supported!

..  contents::
   :local:

..  _hmenu-special-browse-properties:

Properties
==========

..  _hmenu-special-browse-value:

special.value
--------------

..  confval:: special.value
    :name: hmenu-browse-special-value
    :type: integer /:ref:`stdWrap <stdwrap>`
    :Default: current page ID

    The default value can be overridden with a different page ID as starting
    point for the menu in some rare use cases.


..  _hmenu-special-browse-items:

special.items
-------------

..  confval:: special.items
    :name: hmenu-browse-special-items
    :type: list of item names separated by `|`
    :Default: Current page ID

    Each element in the list (separated by `|`) is either a reserved item
    name (see list) with a predefined function, or a user-defined name
    which you can assign a link to any page. Note that the current page
    cannot be the root-page of a site.

    ..  rubric:: Reserved item names:

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

        ..  figure:: /Images/ManualScreenshots/FrontendOutput/Hmenu/ContentObjectsHmenuSpecialBrowse.png
            :alt: Example for the usage of the property "items".

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


..  _hmenu-special-browse-items-example:

Example: Display different types of browse links
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If id = 20 is the current page then:

21 = prev and first, 19 = next, 18 = last, 17 = up, 1 = index, 10 =
nextsection, 11 = nextsection\_last

prevsection and prevsection\_last are not present because id = 3 has
no subpages!

**TypoScript (only "browse"-part, needs also TMENU):**

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    xxx = HMENU
    xxx.special = browse
    xxx.special {
        items = index|up|next|prev
        items.prevnextToSection = 1
        index.target = _blank
        index.fields.title = INDEX
        index.uid = 8
    }

..  _hmenu-special-browse-prevnexttosection:

special.items.prevnextToSection
--------------------------------

..  confval:: special.items.prevnextToSection
    :name: hmenu-browse-special-items-prevnextToSection
    :type: boolean
    :Default: false

    If set, the `prev` and `next` navigation will jump to the next section
    when it reaches the end of pages in the current section. That way
    `prev` and `next` will also link to the first page of the next section
    / to the last page of the previous section.


..  _hmenu-special-browse-target:

special.[itemname].target
--------------------------

..  confval:: special.[itemname].target
    :name: hmenu-browse-special-itemname-target
    :type: string

    Optional or alternative target of the item.

..  _hmenu-special-browse-uid:

special.[itemname].uid
-----------------------

..  confval:: special.[itemname].uid
    :name: hmenu-browse-special-itemname-uid
    :type: integer (UID of page)

    Optional or alternative page UID to link to.

..  _hmenu-special-browse-fields:

special.[itemname].fields.[field name]
---------------------------------------

..  confval:: special.[itemname].fields.[field name]
    :name: hmenu-browse-special-itemname-fields
    :type: string

    Use the provided string as linked text instead of the pages title.


..  _hmenu-special-browse-fields-example:

Example: Use "back" as text on the `prev` link
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This gives the link to the previous page the linked text "« back":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    prev.fields.title = « back


..  _hmenu-special-browser-excludenosearchpages:

special.excludeNoSearchPages
-----------------------------


..  confval:: special.excludeNoSearchPages
    :name: hmenu-browse-special-excludeNoSearchPages
    :type: boolean
    :Default: false

    If set, pages marked with the `no search` checkbox will be excluded from the menu.

..  _hmenu-special-browser-example:

Example: Pagination with rel="next" and rel="prev"
==================================================

The following snippet uses a :ref:`HMENU <cobj-hmenu>` with
:typoscript:`special = browse` to display links like the following:

..  code-block:: html
   :caption: Example HTML output

   <link rel="prev" href="http://www.example.org/page1" />
   <link rel="next" href="http://www.example.org/page2" />

The menu excludes pages with the flag :guilabel:`Include in Search` removed
and jumps to the next section when the last of subpages is reached.

..  include:: /CodeSnippets/Menu/TypoScript/RelPrevNextMenu.rst.txt
