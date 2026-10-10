..  include:: /Includes.rst.txt

..  index::
    mod; web_list
    Modules; List
..  _pageweblist:

========
web_list
========

..  versionchanged:: 14.0
    :changelog: feature-107628-1729026000

    The main module `Web` has been renamed to `Content`.

Configuration options of the :guilabel:`Content > Records` module.

..  contents::
    :local:

..  index::
    allowedNewTables
    Buttons; Create new
..  _pagetsconfigweblistallowednewtables:

allowedNewTables
================

..  confval:: allowedNewTables
    :name: mod-web-list-allowedNewTables
    :type: list of table names

    If this list is set, then only tables listed here will have a link to "create new" in the page and sub pages.
    This also affects the "Create new record" content element wizard.

    This is the opposite of :ref:`deniedNewTables property <pagetsconfigweblistdeniednewtables>`.

    ..  note::

        Technically records can be created (e.g. by copying/moving), so this is not a security feature.
        The point is to reduce the number of options for new records visually.

..  _pagetsconfigweblistallowednewtable-example:

Example: Allow records of type pages or sys_category in the new record wizard
-----------------------------------------------------------------------------

..  literalinclude:: _codesnippets/_pageTsConfigWebListAllowedNewTable.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

..  figure:: /Images/GeneratedScreenshots/List/PageTsModWebListAllowedNewTables.png
    :alt: The New record screen after modifying the allowed elements

    The New record screen after modifying the allowed elements


..  index:: clickTitleMode
..  _pagetsconfigweblist-clicktitlemode:

clickTitleMode
==============

..  confval:: clickTitleMode
    :name: mod-web-list-clickTitleMode
    :type: string
    :default: edit

    Keyword which defines what happens when a user clicks a record title in the list.

    The following values are possible:

    edit
        Edits record

    info
        Shows information

    show
        Shows page in the frontend

..  index::
    csvDelimiter
    CSV Exports; Delimiter
..  _pagetsconfigweblist-csvdelimiter:

csvDelimiter
============

..  confval:: csvDelimiter
    :name: mod-web-list-csvDelimiter
    :type: string
    :default: `,`

    Defines the default delimiter for CSV downloads (Microsoft Excel expects
    `;` to be set). The value set will be displayed as default delimiter in the
    download dialog in the :guilabel:`Content > Records` module.

..  _page-ts-config-web-list-csv-delimiter-example-semicolon-delimiter:

Example: Use semicolon as delimiter CSV downloads
-------------------------------------------------

..  literalinclude:: /CodeSnippets/PageTSconfig/Mod/CsvExport.typoscript
    :caption: EXT:examples/Configuration/TsConfig/Page/Mod/csvExport.tsconfig

..  figure:: /Images/GeneratedScreenshots/WebList/ExportDialog.png
    :alt: The download dialog with a semicolon as delimiter and a single quote as quoting character

    The download dialog of the :guilabel:`Content > Records` module


..  index::
    csvQuote
    CSV Downloads; Quoting character
..  _pagetsconfigweblist-csvquote:

csvQuote
========

..  confval:: csvQuote
    :name: mod-web-list-csvQuote
    :type: string
    :default: `"`

    Defines the default quoting character for CSV downloads. The value set will
    be displayed as default quoting in the download dialog in the
    :guilabel:`Content > Records` module.

..  _pagetsconfigweblist-csvquote-example:

Example: Use single quotes as quoting character for CSV downloads
-----------------------------------------------------------------

..  literalinclude:: /CodeSnippets/PageTSconfig/Mod/CsvExport.typoscript
    :caption: EXT:examples/Configuration/TsConfig/Page/Mod/csvExport.tsconfig

..  figure:: /Images/GeneratedScreenshots/WebList/ExportDialog.png
    :alt: The download dialog with a semicolon as delimiter and a single quote as quoting character

    The download dialog of the :guilabel:`Content > Records` module

..  index::
    deniedNewTables
    Buttons; Create new
..  _pagetsconfigweblistdeniednewtables:

deniedNewTables
===============

..  confval:: deniedNewTables
    :name: mod-web-list-deniedNewTables
    :type: list of table names

    If this list is set, then the tables listed here won't have a link to "create new record" in the page
    and sub pages. This also affects the "Create new record" content element wizard.

    This is the opposite of :ref:`allowedNewTables property <pagetsconfigweblistallowednewtables>`.

    If `allowedNewTables` and `deniedNewTables` contain a common subset, `deniedNewTables` takes precedence.

..  _page-ts-config-web-list-denied-new-tables-hide-create:

Hide "Create new record" links in tables sys_category and tt_content
--------------------------------------------------------------------

..  literalinclude:: _codesnippets/_create.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig


..  index:: disableSearchBox
..  _pagetsconfigweblist-disablesearchbox:

disableSearchBox
======================

..  confval:: disableSearchBox
    :name: mod-web-list-disableSearchBox
    :type: boolean

    If set, the checkbox "Show search" in the :guilabel:`Content > Records` module is hidden.


..  index:: disableSingleTableView
..  _pagetsconfigweblist-disablesingletableview:

disableSingleTableView
======================

..  confval:: disableSingleTableView
    :name: mod-web-list-disableSingleTableView
    :type: boolean

    If set, then the links on the table titles which shows a single table
    listing will not be available - including sorting links on columns
    titles, because these links jumps to the table-only view.


..  index:: displayColumnSelector
..  _pagetsconfigweblist-displaycolumnselector:

displayColumnSelector
=====================

..  confval:: displayColumnSelector
    :name: mod-web-list-displayColumnSelector
    :type: boolean
    :default: `true`

    The column selector is enabled by default and can be disabled with this
    option. The column selector is displayed at the top of each record list in
    the :guilabel:`List` module. It can be used to compare different fields of
    the listed records.

..  _pagetsconfigweblist-displayrecorddownload:

displayRecordDownload
=====================

..  confval:: displayRecordDownload
    :name: mod-web-list-displayRecordDownload
    :type: boolean
    :default: `1`

    The "Download" functionality is available in the :guilabel:`Content > Records`
    module via the "Download" button in the relevant
    table header row. It is available in both the list and the single table
    view and can be managed using this option.

    As well as the general option, it is also possible to set this option on
    a table basis using the
    :typoscript:`mod.web_list.table.<tablename>.displayRecordDownload` option.
    If this option is set, it takes precedence over the general option.

    ..  literalinclude:: _codesnippets/_displayRecordDownload.typoscript
        :caption: EXT:my_sitepackage/Configuration/Sets/Main/page.tsconfig


..  _pagetsconfigweblist-displaycolumnselector-example:

Example: Hide the column selector
---------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.displayColumnSelector = 0

..  _pagetsconfigweblist-downloadpresets:

downloadPresets
===============

..  confval:: downloadPresets.[table]
    :name: mod-web-list-downloadPresets
    :type: array of presets

    This property adds presets of preselected fields to the download area in
    the :guilabel:`Content > Records` backend module.

    Those presets can be configured via page TSconfig, and can also be
    overridden via user TSconfig (for example, to expand certain presets
    only to specific users).

    Each entry of :typoscript:`mod.web_list.downloadPresets`
    defines the table name on the first level, followed by
    any number of presets.

    Each preset contains a :typoscript:`label` (the displayed name of the preset,
    which can be a locallang key), a comma-separated list of each column that
    should be included in the export as :typoscript:`columns` and optionally
    an :typoscript:`identifier`. In case :typoscript:`identifier` is not provided,
    the identifier is generated as hash of the :typoscript:`label` and
    :typoscript:`columns`.

    Since any table can be configured for a preset, any extension
    can deliver a defined set of presets through the
    :file:`EXT:my_extension/Configuration/page.tsconfig` file and
    their table name(s).

    Additionally, the list of presets can be manipulated via the PSR-14 event
    :ref:`\TYPO3\CMS\Backend\RecordList\Event\BeforeRecordDownloadPresetsAreDisplayedEvent <t3coreapi:BeforeRecordDownloadPresetsAreDisplayedEvent>`.

..  _pagetsconfigweblist-downloadpresets-example:

Example: Create download presets for table page
-----------------------------------------------

..  literalinclude:: _WebList/_downloadPresets.tsconfig
    :caption: EXT:my_extension/Configuration/page.tsconfig

This can be manipulated with user TSconfig by adding the :typoscript:`page.`
prefix. User TSconfig is loaded after page TSconfig, so you can overwrite
the existing default settings using the same TypoScript path.

..  literalinclude:: _WebList/_downloadPresetsUser.tsconfig
    :caption: EXT:my_extension/Configuration/user.tsconfig

..  index::
    enableClipBoard
    Buttons; Show clipboard
    Clipboard; Enable

..  _pagetsconfigweblist-enableclipboard:

enableClipBoard
===============

..  confval:: enableClipBoard
    :name: mod-web-list-enableClipBoard
    :type: list of keywords
    :default: `selectable`

    Determines whether the checkbox "Show clipboard" in the
    :guilabel:`Content > Records` module is
    shown or hidden. If it is hidden, you can predefine it to be always
    activated or always deactivated.

    The following values are possible:

    activated
        The option is activated and the checkbox is hidden.

    deactivated
        The option is deactivated and the checkbox is hidden.

    selectable
        The checkbox is shown so that the option can be selected by the user.

..  index::
    enableDisplayBigControlPanel
    Content Records module; Extended view
..  _pagetsconfigweblist-enabledisplaybigcontrolpanel:

enableDisplayBigControlPanel
============================

..  versionchanged:: 11.3
    The checkbox :guilabel:`Extended view` was removed with TYPO3 v11.3.
    Therefore the option :typoscript:`mod.web_list.enableDisplayBigControlPanel`
    has no effect anymore.

..  index::
    hideTables
    Content Records module; Hide tables
..  _pagetsconfigweblist-hidetables:

hideTables
==========

..  confval:: hideTables
    :name: mod-web-list-hideTables
    :type: list of table names, or *

    Hide these tables in record listings (comma-separated)

    If `*` is used, all tables will be hidden


..  index::
    hideTranslations
    Content Records module; Hide translations
    Localization; Hide translations in Content Records module
..  _pagetsconfigweblist-hidetranslations:

hideTranslations
================

..  confval:: hideTranslations
    :name: mod-web-list-hideTranslations
    :type: list of table names, or *

    For tables in this list all their translated records in additional website languages will be hidden
    in the :guilabel:`Content > Records` module.

    Use `*` to hide all records of additional website languages in all tables or set
    single table names as comma-separated list.

..  _pagetsconfigweblist-hidetranslations-example-all:

Example: Hide all translated records
------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.hideTranslations = *

..  _pagetsconfigweblist-hidetranslations-example:

Example: Hide translated records in tables tt_content and tt_news
-----------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.hideTranslations = tt_content, tt_news

..  index::
    itemsLimitPerTable
    Content Records module; Items per table
..  _pagetsconfigweblist-itemslimitpertable:

itemsLimitPerTable
==================

..  confval:: itemsLimitPerTable
    :name: mod-web-list-itemsLimitPerTable
    :type:  positive integer
    :default: 20

    Set the default maximum number of items to show per table.
    The number must be between `0` and `10000`. If below or above this range,
    the nearest valid number will be used.

..  _pagetsconfigweblist-itemslimitpertable-example:

Example: Limit items per table in overview to 10
------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list {
        itemsLimitPerTable = 10
    }

..  index::
    itemsLimitSingleTable
    Content Records module; Items per table in single table view
..  _pagetsconfigweblist-itemslimitsingletable:

itemsLimitSingleTable
=====================

..  confval:: itemsLimitSingleTable
    :name: mod-web-list-itemsLimitSingleTable
    :type:  positive integer
    :default: 100

    Set the default maximum number of items to show in single table view.
    The number must be between `0` and `10000`. If below or above this range,
    the nearest valid number will be used.

..  _pagetsconfigweblist-itemslimitsingletable-example:

Example: Limit items in single table view to 10
-----------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list {
        itemsLimitSingleTable = 10
    }

..  index::
    listOnlyInSingleTableView
    Content Records module; Records in single table view only
..  _pagetsconfigweblist-listonlyinsingletableview:

listOnlyInSingleTableView
=========================

..  confval:: listOnlyInSingleTableView
    :name: mod-web-list-listOnlyInSingleTableView
    :type:  boolean
    :default: 0

    If set, the default view will not show the single records inside a
    table anymore, but only the available tables and the number of records
    in these tables. The individual records will only be listed in the
    single table view, that means when a table has been clicked. This is
    very practical for pages containing many records from many tables!

..  _pagetsconfigweblist-listonlyinsingletableview-example:

Example: Only list records of tables in single-table mode
---------------------------------------------------------

..  literalinclude:: _codesnippets/_listOnlyInSingleTableView.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

The result will be that records from tables are only listed in the single-table mode:

..  figure:: /Images/GeneratedScreenshots/List/PageTsModWebListListOnlyInSingleTableView.png
    :alt: The Content Records module after activating the single-table mode

    The :guilabel:`Content > Records` module after activating the single-table mode

..  index::
    newPageWizard.override
    Pages; New wizard
..  _pagetsconfigweblist-newpagewizard-override:

newPageWizard.override
======================

..  confval:: newPageWizard.override
    :name: mod-web-list-newPageWizard-override
    :type: string

    If set to an extension key, then the specified module or route will be used for creating
    new elements on the page.


..  index::
    noCreateRecordsLink
    Buttons; Create new record
..  _pagetsconfigweblist-nocreaterecordslink:

noCreateRecordsLink
===================

..  confval:: noCreateRecordsLink
    :name: mod-web-list-noCreateRecordsLink
    :type:  boolean
    :default: 0

    If set, the link "Create new record" is hidden.

..  _pagetsconfigweblist-nocreaterecordslink-example:

Example: Hide the "Create new record" link.
-------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list {
        noCreateRecordsLink = 1
    }


..  index::
    noExportRecordsLinks
    Buttons; Export
..  _pagetsconfigweblist-noexportrecordslinks:

noExportRecordsLinks
====================

..  confval:: noExportRecordsLinks
    :name: mod-web-list-noExportRecordsLinks
    :type:  boolean
    :default: 0

    If set, the :guilabel:`Download` button is hidden
    in the :guilabel:`Content > Records` module.

    This option is important, for example, to disable batch
    download of sensitive data via t3d exports.

    ..  include:: /Images/ManualScreenshots/WebList/WithExportButtons.rst.txt

    ..  include:: /Images/ManualScreenshots/WebList/NoExportButtons.rst.txt

    ..  note::
        This option only hides the buttons in the :guilabel:`Content > Records`
        module. Bulk export of data is still possible via the context menu of
        the page tree.

..  _pagetsconfigweblist-noexportrecordslinks-example:

Example: Hide the "Download" and "Export" links
-----------------------------------------------

..  literalinclude:: /CodeSnippets/PageTSconfig/Mod/noExportRecordsLinks.typoscript
    :caption: EXT:examples/Configuration/TsConfig/Page/Mod/noExportRecordsLinks.tsconfig

..  _pagetsconfigweblist-noviewwithdoktypes:

noViewWithDokTypes (removed)
============================

..  versionchanged:: 14.0
    The TSconfig option :typoscript:`mod.web_list.noViewWithDokTypes` has been
    removed since it just duplicated the existing configuration
    `TCEMAIN.preview.disableButtonForDokType <https://docs.typo3.org/permalink/t3tsref:confval-tcemain-preview>`_.

Remove any usage of :typoscript:`mod.web_list.noViewWithDokTypes` from Page
TSconfig.

Instead, configure the equivalent behavior using:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TSconfig/Page/TCEMAIN.tsconfig

    TCEMAIN.preview.disableButtonForDokType = 199, 254

..  index::
    table.[tableName].hideTable
    Content Records module; Hide tables
..  _pagetsconfigweblist-table-tablename-hidetable:

table.[tableName].hideTable
===========================

..  confval:: table.[tableName].hideTable
    :name: mod-web-list-table-tableName-hideTable
    :type:  boolean
    :default: 0

    If set to non-zero, the table is hidden. If it is zero, table is shown
    even if table name is listed in "hideTables" list.

..  _pagetsconfigweblist-table-tablename-hidetable-example:

Example: Hide table tt_content
------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.table.tt_content.hideTable = 1


..  index::
    table.[tableName].displayColumnSelector
    Content Records module; columns selector
..  _pagetsconfigweblist-table-tablename-displaycolumnselector:

table.[tableName].displayColumnSelector
=======================================

..  confval:: table.[tableName].displayColumnSelector
    :name: mod-web-list-table-tableName-displayColumnSelector
    :type:  boolean

    If set to false, the column selector in the title row of the specified
    table gets hidden. If the column selectors have been disabled globally
    this option can be used to enable it for a specific table.

..  _pagetsconfigweblist-table-tablename-displaycolumnselector-example-disable:

Example: Hide the column selector for tt_content
------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.table.tt_content.displayColumnSelector = 0

..  _pagetsconfigweblist-table-tablename-displaycolumnselector-example-enable:

Example: Hide the column selector for all tables but sys_category
-----------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.displayColumnSelector = 0
    mod.web_list.table.sys_category.displayColumnSelector = 1


..  index::
    tableDisplayOrder
    Content Records module; Order tables
..  _pagetsconfigweblist-tabledisplayorder:

tableDisplayOrder
=================

..  confval:: tableDisplayOrder.[tableName]
    :name: mod-web-list-tableDisplayOrder
    :type: array

    Flexible configuration of the order in which tables are displayed.

    The keywords `before` and `after` can be used to specify an order relative
    to other table names.

    ..  literalinclude:: _codesnippets/_tableDisplayOrder.typoscript
        :caption: EXT:my_sitepackage/Configuration/Sets/Main/page.tsconfig

..  index::
    searchLevel.items
    Items; Search level
..  _pagetsconfigweblist-searchlevel-items:

searchLevel.items
=================

..  confval:: searchLevel.items
    :name: mod-web-list-searchLevel-items
    :type: array

    Sets labels for each level label in the search level select box

    ..  literalinclude:: _codesnippets/_items.typoscript
        :caption: EXT:my_sitepackage/Configuration/page.tsconfig

..  index::
    searchLevel.items
    Items; Search level

..  _pagetsconfigweblist-searchlevel-default:

searchLevel.default
===================

..  confval:: searchLevel.default
    :name: mod-web-list-searchLevel-default
    :type: integer

    This option allows to define one of the available level options
    as the default level to use.

    When searching for records in the :guilabel:`Content > Records` module as well as
    the database browser, it is possible to select the search levels (page tree
    levels to respect in the search).

    An editor is therefore able to select between the current page, a couple of
    defined levels (e.g. 1, 2, 3) as well as the special "infinite levels".

    Those options can already be extended using the TSconfig option
    :confval:`mod-web-list-searchLevel-items`.

..  _pagetsconfigweblist-searchlevel-default-example:

Example: Set the default search level to "infinite levels"
----------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.searchLevel.default = -1
