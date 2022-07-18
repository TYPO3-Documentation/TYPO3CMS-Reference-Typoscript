.. include:: /Includes.rst.txt
.. index:: HMENU; special = rootline
.. _hmenu-special-rootline:

===========================
Rootline - breadcrumb menu
===========================

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

.. contents::
   :local:

Properties
==========

.. _hmenu-special-rootline-range:
.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
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

.. _hmenu-special-rootline-reverseorder:


.. container:: table-row

   Property
         special.reverseOrder

   Data type
         boolean

   Default
         0 (false)

   Description
         If set to true, the order of the rootline menu elements will be
         reversed.

.. _hmenu-special-rootline-targets:

.. container:: table-row

   Property
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

Examples
=========

Breadcrumb styled with Fluid
-----------------------------

The following breadcrumb menu is created with the MenuProcessor, based on
the HMENU. It is styled via Fluid:

.. include:: /CodeSnippets/Menu/TypoScript/BreadcrumbDataProcessor.rst.txt

The following Fluid partial can be used to style the breadcrumb menu:

.. include:: /CodeSnippets/Menu/Template/BreadcrumbDataProcessor.rst.txt

Breadcrumb with pure TypoScript
--------------------------------

The following breadcrumb menu is styled with pure Typoscript:

.. include:: /CodeSnippets/Menu/TypoScript/BreadcrumbLib.rst.txt
