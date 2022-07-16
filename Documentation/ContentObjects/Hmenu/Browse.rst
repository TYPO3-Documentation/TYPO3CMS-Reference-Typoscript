.. include:: /Includes.rst.txt
.. index:: HMENU; special = browse
.. _hmenu-special-browse:

=================================
Browse - previous and next links
=================================

This menu contains pages which give your user the possibility to
browse to the previous page, to the next page, to a page with the
table of contents and so on. The menu is built of items given by a
list from the property ".items".

.. attention::
   Mount pages are *not* supported!


.. contents::
   :local:

Properties
==========

.. _hmenu-special-browse-value:

special.value
--------------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         special.value

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Default
         current page id

   Description
         Default is the current page id. Seldom you might want to override this
         value with another page-uid which will then act as the base point for
         the menu and the predefined items.


.. _hmenu-special-browse-items:

special.items
---------------

.. container:: table-row

   Property
         special.items

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

         .. figure:: /Images/ManualScreenshots/FrontendOutput/Hmenu/ContentObjectsHmenuSpecialBrowse.png
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

         **TypoScript (only "browse"-part, needs also TMENU):**

         .. code-block:: typoscript
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


.. _hmenu-special-browse-prevnexttosection:

special.items.prevnextToSection
--------------------------------

.. container:: table-row

   Property
         special.items.prevnextToSection

   Data type
         boolean

   Description
         If set, the "prev" and "next" navigation will jump to the next section
         when it reaches the end of pages in the current section. That way
         "prev" and "next" will also link to the first page of the next section
         / to the last page of the previous section.


.. _hmenu-special-browse-target:

special.[itemname].target
--------------------------

.. container:: table-row

   Property
         special.[itemname].target

   Data type
         string

   Description
         Optional/alternative target of the item.

.. _hmenu-special-browse-uid:

special.[itemname].uid
-----------------------

.. container:: table-row

   Property
         special.[itemname].uid

   Data type
         integer

   Description
         (uid of page) - optional/alternative page-uid to link to.

.. _hmenu-special-browse-fields:

special.[itemname].fields.[field name]
---------------------------------------

.. container:: table-row

   Property
         special.[itemname].fields.[field name]

   Data type
         string

   Description
         Override field "field name" in pagerecord.

         **Example:**

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            prev.fields.title = « zurück

         This gives the link to the previous page the linktext "« zurück".

.. _hmenu-special-browser-excludenosearchpages:

special.excludeNoSearchPages
-----------------------------

.. container:: table-row

   Property
         special.excludeNoSearchPages

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, pages marked with the "no search" checkbox will be excluded from the menu.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = browse]


Examples
=========

Pagination with rel="next" and rel="prev"
-----------------------------------------

The following snippet uses a :ref:`HMENU <cobj-hmenu>` with
:typoscript:`special = browse` to display links like the following:

.. code-block:: html
   :caption: Example HTML output

   <link rel="prev" href="http://www.example.org/page1" />
   <link rel="next" href="http://www.example.org/page2" />

The menu excludes pages with the flag :guilabel:`Include in Search` removed
and jumps to the next section when the last of subpages is reached.

.. include:: /CodeSnippets/Menu/TypoScript/RelPrevNextMenu.rst.txt
