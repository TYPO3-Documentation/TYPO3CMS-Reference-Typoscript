:navigation-title: menu
..  include:: /Includes.rst.txt
..  _MenuProcessor:

=====================
`menu` data processor
=====================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\MenuProcessor`,
alias `menu`, utilizes :ref:`HMENU <cobj-hmenu>` to generate a list
of menu items which can be assigned to :typoscript:`FLUIDTEMPLATE` as a
variable.

Additional data processing is supported and will be applied to each record.

..  contents:: Table of contents

..  hint::
    The third party extension `b13/menus
    <https://extensions.typo3.org/extension/menus>`__ also provides menu
    processors like :php:`\B13\Menus\DataProcessing\TreeMenu` and
    :php:`\B13\Menus\DataProcessing\BreadcrumbsMenu`.

    Refer to the `manual of the extension b13/menus
    <https://github.com/b13/menus/blob/master/README.md>`__ for more
    information.

..  _MenuProcessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  _MenuProcessor-as:

    ..  confval:: as
        :name: MenuProcessor-as
        :Required: false
        :type: :ref:`data-type-string`
        :Default: "menu"

        Name for the variable in the Fluid template.

    ..  confval:: alwaysActivePIDlist
        :name: MenuProcessor-alwaysActivePIDlist
        :type: list of :ref:`data-type-integer` /:ref:`stdWrap <stdwrap>`

        This is a list of page UID numbers that will always be regarded as
        active menu items and thereby automatically opened regardless of the
        rootline.

    ..  confval:: entryLevel
        :name: MenuProcessor-entryLevel
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`
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

        ..  literalinclude:: _code-snippets/_entryLevel.typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        it will start to be visible from the 4th level (and will contain only
        the subpages from that level).

    ..  confval:: excludeDoktypes
        :name: MenuProcessor-excludeDoktypes
        :type: list of :ref:`data-type-integer`
        :Default: 6,254

        Enter the list of page document types (doktype) to exclude from menus.
        By default pages that are "backend user access only" (6) or "folder"
        (254) are excluded.

    ..  confval:: excludeUidList
        :name: MenuProcessor-excludeUidList
        :type: list of :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

        This is a list of page uids to exclude when the select statement is
        done. Comma-separated. You may add "current" to the list to exclude
        the current page.

        **Example:**

        The pages with these uid-numbers will **not** be within the menu!
        Additionally the current page is always excluded too.

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.dataProcessing.20.excludeUidList = 34,2,current

    ..  _MenuProcessor-expandAll:

    ..  confval:: expandAll
        :name: MenuProcessor-expandAll
        :Required: true
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`
        :Default: 1
        :Example: 0

        Include all submenus (`1`) or only those of the active pages (`0`).

    ..  _MenuProcessor-levels:

    ..  confval:: levels
        :name: MenuProcessor-levels
        :Required: true
        :type: :ref:`data-type-integer` / :ref:`stdWrap`
        :Default: 1
        :Example: 5

        Maximal number of levels to be included in the output array.

    ..  confval:: includeNotInMenu
        :name: MenuProcessor-includeNotInMenu
        :type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`

        If set, pages with the checkbox "Page enabled in menus" disabled will still be included
        in menus.

    ..  _MenuProcessor-includeSpacer:

    ..  confval:: includeSpacer
        :name: MenuProcessor-includeSpacer
        :Required: true
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`
        :Default: 0
        :Example: 1

        Include pages with type "spacer".

    ..  confval:: protectLvar
        :name: MenuProcessor-protectlvar
        :type: :ref:`data-type-boolean` / keyword

        If set, then for each page in the menu it will be checked if an
        Alternative Page Language record for the language defined in
        the site exists for the
        page. If that is not the case and the pages "Localization settings"
        have the "Hide page if no translation for current language exists"
        flag set, then the menu item will link to a non accessible page that
        will yield an error page to the user. Setting this option will prevent
        that situation by adding "&L=0" for such pages, meaning that
        they will switch to the default language rather than keeping the
        current language.

        The check is only carried out if a translation is requested, not for the
        standard language.

        **Keyword: "all"**

        When set to "all" the same check is carried out but it will not look
        if "Hide page if no translation for current language exists" is set -
        it always reverts to default language if no translation is found.

    ..  confval:: special
        :name: MenuProcessor-special
        :type: *"directory" / "list" / "updated" / "rootline" / "browse" / "keywords"
             / "categories" / "language" / "userfunction"*

        Lets you define special types of menus.

        See the section about the :ref:`.special property <hmenu-special-property>`!

        ..  confval:: value
            :name: MenuProcessor-special-value
            :type: *list of page-uid's* / :ref:`stdWrap <stdwrap>`

            List of page uid's to use for the special menu. What they are used
            for depends on the menu type as defined by ".special"; see the
            section about the :ref:`.special property <hmenu-special-property>`!

    ..  _MenuProcessor-titleField:

    ..  confval:: titleField
        :name: MenuProcessor-titleField
        :Required: true
        :type: :ref:`data-type-string` / :ref:`stdWrap`
        :Default: "nav_title // title"
        :Example: "subtitle"

        Fields to be used as title.

..  _MenuProcessor-special:

Special menu types
==================

The following special menu types are available:

..  toctree::
    :glob:
    :titlesonly:

    *

..  _MenuProcessor-example-two-levels:

Example: Two level menu of the web page
=======================================

Please see also :ref:`dataProcessing-about-examples`.

..  rubric:: TypoScript

Using the :php:`MenuProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/MenuProcessor.rst.txt

..  rubric:: The Fluid template

This generated menu can be used in Fluid like this:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcMenu.rst.txt

..  rubric:: Output

The array now contains the menu items on level one. Each item in return has the
menu items of level 2 in an array called :php:`children`.

..  include:: /Images/AutomaticScreenshots/DataProcessing/MenuProcessor.rst.txt
