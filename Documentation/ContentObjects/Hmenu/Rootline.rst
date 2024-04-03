..  include:: /Includes.rst.txt
..  index:: HMENU; special = rootline
..  _hmenu-special-rootline:

==========================
Rootline - breadcrumb menu
==========================

The path of pages from the current page to the root page of the page
tree is called "rootline".

A root line menu is a menu which shows you these pages one by one in
their hierarchical order.

An :typoscript:`HMENU` with the property :typoscript:`special = rootline` creates
a root line menu (also known as "breadcrumb trail") that could look like this:

..  code-block:: none

    Page level 1 > Page level 2 > Page level 3 > Current page

Such a click path facilitates the user's orientation on the website
and makes navigation to a certain page level easier.

..  note::
    :ref:`Mount points <t3coreapi:MountPoints>` are supported.


..  contents::
    :local:

..  _hmenu-special-rootline-properties:

Properties
==========

..  _hmenu-special-rootline-range:

special.range
-------------

..  confval:: special.range
    :name: hmenu-rootline-special-range
    :type: string /:ref:`stdWrap <stdwrap>`
    :Syntax: `[begin-level] | [end-level]`

    `[begin-level]` and `[end-level]` are counted like the
    :ref:`.entryLevel <hmenu-entrylevel>` for an `HMENU`).

..  _hmenu-special-rootline-range-example:

Example: Skip the current page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The following
example will start at level 1 and does not show the page the user is
currently on:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    temp.breadcrumbs = HMENU
    temp.breadcrumbs.special = rootline
    temp.breadcrumbs.special.range = 1|-2


..  _hmenu-special-rootline-reverseorder:

special.reverseOrder
--------------------

..  confval:: special.reverseOrder
    :name: hmenu-rootline-special-reverseOrder
    :type: boolean
    :Default: `false`

    If set to true, the order of the root line menu elements will be
    reversed.


..  _hmenu-special-rootline-targets:

special.targets.[level number]
------------------------------

..  confval:: special.targets.[level number]
    :name: hmenu-rootline-special-reverseOrder
    :type: boolean
    :Default: `false`

    For framesets. You can set a default target and a target for each
    level by using the level number as sub-property.

..  _hmenu-special-rootline-targets-example:

Example: Set targets for levels
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Here the links to pages on level 3 will have :html:`target="page"`, while
all other levels will have :html:`target="_top"` as defined for the
:ref:`TMENU <tmenu>` property :ref:`menu-common-properties-target`.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.2 = HMENU
    page.2.special = rootline
    page.2.special.range = 1|-2
    page.2.special.targets.3 = page
    page.2.1 = TMENU
    page.2.1.target = _top
    page.2.1.wrap = <ol> | <ol>
    page.2.1.NO.linkWrap = <li> | </li>

..  _hmenu-special-rootline-examples:

Examples
=========

Breadcrumb styled with Fluid
-----------------------------

The following breadcrumb menu is created with the
:ref:`MenuProcessor <MenuProcessor>`, based on the HMENU. It is styled via Fluid:

..  include:: /CodeSnippets/Menu/TypoScript/BreadcrumbDataProcessor.rst.txt

The following Fluid partial can be used to style the breadcrumb menu:

..  include:: /CodeSnippets/Menu/Template/BreadcrumbDataProcessor.rst.txt

Breadcrumb with pure TypoScript
--------------------------------

The following breadcrumb menu is styled with pure Typoscript:

..  include:: /CodeSnippets/Menu/TypoScript/BreadcrumbLib.rst.txt
