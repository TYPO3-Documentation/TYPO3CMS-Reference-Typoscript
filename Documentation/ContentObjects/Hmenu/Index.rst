..  include:: /Includes.rst.txt
..  index::
    Content objects; HMENU
    Content objects; Menu without Data Processor
    HMENU
..  _cobj-hmenu:

=====
HMENU
=====

Objects of type HMENU generate hierarchical menus. In a
:ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` the HMENU can be used as
a DataProcessor called :ref:`MenuProcessor <MenuProcessor>`, which
internally uses the HMENU functionality.

The cObject HMENU allows you to define the global settings of the menu
as a whole. For the rendering of the single menu levels, different
:ref:`menu objects <menu-objects>` can be used.

Apart from creating a hierarchical menu of the pages as they are
structured in the page tree, HMENU also allows you to use the
:ref:`.special property <hmenu-special-property>` to create special
menus. These special menus take characteristics of special menu types
into account.

.. contents::
   :local:

.. _cobj-hmenu-options:

Properties
===========

.. _hmenu-number:

1, 2, 3, ...
-------------

..  t3-cobj-hmenu:: 1, 2, 3, ...

    :Data type: :ref:`menu object <data-type-menuobj>`

    :Default: (no menu)

    For every menu level, that should be rendered, an according entry must
    exist. It defines the menu object that should render the menu items on
    the according level. 1 is the first level, 2 is the second level, 3 is
    the third level and so on.

    **The property "1" is required!**

    The entry 1 for the first level always must exist. All other levels only
    will be generated when they are configured.

    **Example:**

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       temp.sidemenu = HMENU
       temp.sidemenu.1 = TMENU
       temp.sidemenu.1 {
         # Configuration of that TMENU here...
       }
       temp.sidemenu.2 = TMENU
       temp.sidemenu.2 {
         # Configuration of that TMENU here...
       }
       temp.sidemenu.3 = TMENU
       temp.sidemenu.3 {
         # Configuration of that TMENU here...
       }

    This creates a menu with up to three levels: Each TMENU level can hold a
    different menu configuration.

    TYPO3 offers :ref:`a variety of menu objects <menu-objects>`.

.. _hmenu-cache-period:

cache_period
-------------

..  t3-cobj-hmenu:: cache_period

    :Data type: integer

    The number of seconds a menu may remain in cache. If this value is not
    set, the first available value of the following will be used:

    1) cache\_timeout of the current page

    2) config.cache\_period defined globally

    3) 86400 (= 1 day)

.. _hmenu-cache:

cache
------

.. include:: /DataTypes/Properties/Cache.rst.txt

.. _hmenu-entrylevel:

entryLevel
-----------

..  t3-cobj-hmenu:: entryLevel

    :Data type: integer /:ref:`stdWrap <stdwrap>`

    :Default: 0

    Defines at which level in the rootLine the menu should start.

    Default is "0" which gives us a menu of the very first pages on the
    site.

    If the value is < 0, entryLevel is chosen from "behind" in the
    rootLine. Thus "-1" is a menu with items from the outermost level,
    "-2" is the level before the outermost...

    **Note:** :typoscript:`entryLevel` does not show a menu **of a certain level of pages**
    (use :typoscript:`special = directory` for that)
    but it means that it will start to be visible **from that level on**.

    So, for example if you build a simple "sitemap" menu like this one:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
    Please note also that this affects also the menu generated with :typoscript:`MenuProcessor`. Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 {
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

.. _hmenu-special:

special
--------

..  t3-cobj-hmenu:: special

    :Data type: *"directory" / "list" / "updated" / "rootline" / "browse" / "keywords"
         / "categories" / "language" / "userfunction"*

    Lets you define special types of menus.

    See the section about the :ref:`.special property <hmenu-special-property>`!

.. _hmenu-special-value:

special.value
~~~~~~~~~~~~~~

..  t3-cobj-hmenu:: special.value

    :Data type: *list of page-uid's* /:ref:`stdWrap <stdwrap>`

    List of page uid's to use for the special menu. What they are used
    for depends on the menu type as defined by ".special"; see the
    section about the :ref:`.special property <hmenu-special-property>`!

.. _hmenu-minitems:

minItems
---------

..  t3-cobj-hmenu:: minItems

    :Data type: integer /:ref:`stdWrap <stdwrap>`

    The minimum number of items in the menu. If the number of pages does
    not reach this level, a dummy-page with the title "..." and
    uid=[currentpage\_id] is inserted.

    **Note:** Affects all sub menus as well. To set the value for each
    menu level individually, set the properties in the menu objects (see
    "Common properties" table).

.. _hmenu-maxitems:

maxItems
---------

..  t3-cobj-hmenu:: maxItems

    :Data type: integer /:ref:`stdWrap <stdwrap>`

    The maximum number of items in the menu. Additional items will be
    ignored.

    **Note:** Affects all sub menus as well. (See "minItems" for a
    notice.)

.. _hmenu-begin:

begin
------

..  t3-cobj-hmenu:: begin

    :Data type: integer /:ref:`stdWrap <stdwrap>` :ref:`+calc <objects-calc>`

    The first item in the menu.

    **Example:**

    This results in a menu, where the first two items are skipped starting
    with item number 3:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        begin = 3

    **Note:** Affects all sub menus as well. (See "minItems" for a
    notice.)

.. _hmenu-excludeuidlist:

excludeUidList
---------------

..  t3-cobj-hmenu:: excludeUidList

    :Data type: list of integers /:ref:`stdWrap <stdwrap>`

    This is a list of page uid's to exclude when the select statement is
    done. Comma-separated. You may add "current" to the list to exclude
    the current page.

    **Example:**

    The pages with these uid-numbers will **not** be within the menu!
    Additionally the current page is always excluded too.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        excludeUidList = 34,2,current

.. _hmenu-excludedoktypes:

excludeDoktypes
---------------

..  t3-cobj-hmenu:: excludeDoktypes

    :Data type: list of integers

    :Default: 6,254

    Enter the list of page document types (doktype) to exclude from menus.
    By default pages that are "backend user access only" (6) or "folder"
    (254) are excluded.

.. _hmenu-includenotinmenu:

includeNotInMenu
-----------------

..  t3-cobj-hmenu:: includeNotInMenu

    :Data type: boolean /:ref:`stdWrap <stdwrap>`

    If set, pages with the checkbox "Page enabled in menus" disabled will still be included
    in menus.

.. _hmenu-alwaysactivepidlist:

alwaysActivePIDlist
--------------------

..  t3-cobj-hmenu:: alwaysActivePIDlist

    :Data type: list of integers /:ref:`stdWrap <stdwrap>`

    This is a list of page UID numbers that will always be regarded as
    active menu items and thereby automatically opened regardless of the
    rootline.

.. _hmenu-protectlvar:

protectLvar
------------

..  t3-cobj-hmenu:: protectLvar

    :Data type: boolean / keyword

    If set, then for each page in the menu it will be checked if an
    Alternative Page Language record for the language defined in
    "config.sys\_language\_uid" exists for the
    page. If that is not the case and the pages "Localization settings"
    have the "Hide page if no translation for current language exists"
    flag set, then the menu item will link to a non accessible page that
    will yield an error page to the user. Setting this option will prevent
    that situation by adding "&L=0" for such pages, meaning that
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

.. _hmenu-addquerystring:

addQueryString
---------------

..  t3-cobj-hmenu:: addQueryString

    :Data type: string

    *see typolink.addQueryString*

    **Note:** This works only for *special=language*.

.. _hmenu-if:

if
--

..  t3-cobj-hmenu:: if

    :Data type: :ref:`->if <if>`

    If "if" returns false, the menu is not generated.

.. _hmenu-wrap:

wrap
----

..  t3-cobj-hmenu:: wrap

    :Data type: :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

    Wrap for the HMENU.

.. _hmenu-stdwrap:

stdWrap
--------

..  t3-cobj-hmenu:: stdWrap

    :Data type: :ref:`->stdWrap <stdwrap>`

    (Executed after ".wrap".)

.. _hmenu-examples:

Example:
========

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

..  index:: HMENU; special
..  _hmenu-special-property:

The .special property
=====================

This property makes it possible to create menus that are not strictly
reflecting the current page-structure, but rather creating a
:ref:`breadcrumb menu <hmenu-special-rootline>`, a
:ref:`language menu <hmenu-special-language>` or menus with
links to pages like :ref:`next/previous <hmenu-special-browse>`,
:ref:`last modified <hmenu-special-updated-examples>`,
:ref:`all subpages of a page <hmenu-special-directory>` and so on.

..  note::

    :typoscript:`.entryLevel` generally is not supported together with the
    :typoscript:`.special` property! The only exception is :typoscript:`special = keywords`.

Also be aware that this property selects pages for the first level in
the menu. Submenus by menuObjects 2+ will be created as usual.

See the following menus types based on the :typoscript:`special` property:

..  toctree::
    :titlesonly:
    :glob:

    *
