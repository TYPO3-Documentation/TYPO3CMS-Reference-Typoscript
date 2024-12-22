..  include:: /Includes.rst.txt
..  index::
    Content objects; HMENU
    Content objects; Menu without Data Processor
    HMENU
..  _cobj-hmenu:

=====
HMENU
=====

..  warning::
    This TypoScript object is still available to provide backward compatibility
    for old sites. When creating a new menu or refactoring an existing one
    always use the `menu data processor <https://docs.typo3.org/permalink/t3tsref:menuprocessor>`_
    and a Fluid template.

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

..  _cobj-hmenu-options:

Properties
==========

..  confval-menu::
    :display: table
    :type:

    ..  _hmenu-number:

    ..  confval:: 1, 2, 3, ...
        :name: hmenu-array
        :type: :ref:`menu object <data-type-menuobj>`
        :Default: (no menu)

        For every menu level, that should be rendered, an according entry must
        exist. It defines the menu object that should render the menu items on
        the according level. 1 is the first level, 2 is the second level, 3 is
        the third level and so on.

        **The property "1" is required!**

        The entry 1 for the first level always must exist. All other levels only
        will be generated when they are configured.

        TYPO3 offers :ref:`the menu object TMENU <menu-objects>`.

    ..  _hmenu-cache-period:

    ..  confval:: cache_period
        :name: hmenu-cache-period
        :type: :ref:`data-type-integer`

        The number of seconds a menu may remain in cache. If this value is not
        set, the first available value of the following will be used:

        1) cache\_timeout of the current page

        2) config.cache\_period defined globally

        3) 86400 (= 1 day)

    ..  _hmenu-cache:

    ..  confval:: cache
        :name: hmenu-cache
        :type: :ref:`cache <cache>`

        See :ref:`cache function description <cache>` for details.

    ..  _hmenu-entrylevel:

    ..  confval:: entryLevel
        :name: hmenu-entryLevel
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`
        :Default: 0

        Defines at which level in the rootLine the menu should start.

    ..  _hmenu-special:

    ..  confval:: special
        :name: hmenu-special
        :type: *"directory" / "list" / "updated" / "rootline" / "browse" / "keywords"
             / "categories" / "language" / "userfunction"*

        Lets you define special types of menus.

        See the section about the :ref:`.special property <hmenu-special-property>`!

    ..  _hmenu-special-value:

    ..  confval:: special.value
        :name: hmenu-special-value
        :type: *list of page-uid's* / :ref:`stdWrap <stdwrap>`

        List of page uid's to use for the special menu. What they are used
        for depends on the menu type as defined by ".special"; see the
        section about the :ref:`.special property <hmenu-special-property>`!

    ..  _hmenu-minitems:

    ..  confval:: minItems
        :name: hmenu-minItems
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

        The minimum number of items in the menu. If the number of pages does
        not reach this level, a dummy-page with the title "..." and
        `uid=[currentpage\_id]` is inserted.

        **Note:** Affects all sub menus as well. To set the value for each
        menu level individually, set the properties in the menu objects (see
        "Common properties" table).

    ..  _hmenu-maxitems:

    ..  confval:: maxItems
        :name: hmenu-maxItems
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

        The maximum number of items in the menu. Additional items will be
        ignored.

        **Note:** Affects all sub menus as well. (See "minItems" for a
        notice.)

    ..  _hmenu-begin:

    ..  confval:: begin
        :name: hmenu-begin
        :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>` :ref:`+calc <objects-calc>`

        The first item in the menu.

        **Note:** Affects all sub menus as well. (See "minItems" for a
        notice.)

    ..  _hmenu-excludeuidlist:

    ..  confval:: excludeUidList
        :name: hmenu-excludeUidList
        :type: list of :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

        See :confval:`MenuProcessor-excludeUidList`.

    ..  _hmenu-excludedoktypes:

    ..  confval:: excludeDoktypes
        :name: hmenu-excludeDoktypes
        :type: list of :ref:`data-type-integer`
        :Default: 6,254

        See :confval:`MenuProcessor-excludeDoktypes`.

    .. _hmenu-includenotinmenu:

    ..  confval:: includeNotInMenu
        :name: hmenu-includeNotInMenu
        :type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`

        See :confval:`MenuProcessor-includeNotInMenu`

    .. _hmenu-alwaysactivepidlist:

    ..  confval:: alwaysActivePIDlist
        :name: hmenu-alwaysActivePIDlist
        :type: list of :ref:`data-type-integer` /:ref:`stdWrap <stdwrap>`

        See :confval:`MenuProcessor-alwaysActivePIDlist`

    ..  _hmenu-protectlvar:

    ..  confval:: protectLvar
        :name: hmenu-protectlvar
        :type: :ref:`data-type-boolean` / keyword

        See :confval:`MenuProcessor-protectlvar`.

    ..  _hmenu-if:

    ..  confval:: if
        :name: hmenu-if
        :type: :ref:`->if <if>`

        If "if" returns false, the menu is not generated.
    ..  _hmenu-wrap:

    ..  confval:: wrap
        :name: hmenu-wrap
        :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap <stdwrap>`

        Wrap for the HMENU.

    ..  _hmenu-stdwrap:

    ..  confval:: stdWrap
        :name: hmenu-stdWrap
        :type: :ref:`->stdWrap <stdwrap>`

        (Executed after ".wrap".)

    ..  _hmenu-examples:
    ..  _hmenu-special-property:

    For examples on how to use the HMENU please refer to old version of this
    document, for example :ref:`HMENU <t3tsref/11.5:cobj-hmenu>`

    ..  toctree::
        :titlesonly:
        :glob:
        :hidden:

        Tmenu/Index
        *
