.. include:: /Includes.rst.txt
.. index:: HMENU; special = rootline
.. _hmenu-special-rootline:

special = rootline
------------------

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

         special.range

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         [begin-level] \| [end-level] (same way as you reference the
         .entryLevel for an HMENU). The following example will start at level 1
         and not show the page the user is currently on:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            temp.breadcrumbs = HMENU
            temp.breadcrumbs.special = rootline
            temp.breadcrumbs.special.range = 1|-2


.. container:: table-row

   Property
         .. _hmenu-special-rootline-reverseorder:

         special.reverseOrder

   Data type
         boolean

   Default
         0 (false)

   Description
         If set to true, the order of the rootline menu elements will be
         reversed.

.. container:: table-row

   Property
         .. _hmenu-special-rootline-targets:

         special.targets.[level number]

   Data type
         string

   Description
         For framesets. You can set a default target and a target for each
         level by using the level number as sub-property.

         **Example:**

         Here the links to pages on level 3 will have target="page", while all
         other levels will have target="\_top" as defined for the TMENU
         property .target.

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
have the image appended.

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
