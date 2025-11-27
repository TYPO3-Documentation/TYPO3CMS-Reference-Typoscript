..  include:: /Includes.rst.txt

..  index::
    mod; web_list
    Modules; List
..  _pageweblist:

========
web_list
========

..  versionchanged:: 14.0
    The main module `Web` has been renamed to `Content`.
    See `Feature: #107628 - Improved backend module naming and structure <https://docs.typo3.org/permalink/changelog:feature-107628-1729026000>`_

Configuration options of the :guilabel:`Content > Records` module.

..  contents::
    :local:

..  index::
    allowedNewTables
    Buttons; Create new
..  _pageTsConfigWebListAllowedNewTables:

allowedNewTables
================

..  confval:: allowedNewTables
    :name: mod-web-list-allowedNewTables
    :type: list of table names

    If this list is set, then only tables listed here will have a link to "create new" in the page and sub pages.
    This also affects the "Create new record" content element wizard.

    This is the opposite of :ref:`deniedNewTables property <pageTsConfigWebListDeniedNewTables>`.

    ..  note::

        Technically records can be created (e.g. by copying/moving), so this is not a security feature.
        The point is to reduce the number of options for new records visually.

..  _pageTsConfigWebListAllowedNewTable-example:

Example: Only allow records of type pages or sys_category in the new record wizard
----------------------------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list {
        # Only pages and sys_category table elements will be linked to in the new record wizard
        allowedNewTables = pages, sys_category
    }

..  figure:: /Images/ManualScreenshots/List/PageTsModWebListAllowedNewTables.png
    :alt: The New record screen after modifying the allowed elements

    The New record screen after modifying the allowed elements


..  index:: clickTitleMode
..  _pageTsConfigWebList-clickTitleMode:

clickTitleMode
==============

..  confval:: clickTitleMode
    :name: mod-web-list-clickTitleMode
    :type: string
    :Default: edit

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
..  _pageTsConfigWebList-csvDelimiter:

csvDelimiter
============

..  confval:: csvDelimiter
    :name: mod-web-list-csvDelimiter
    :type: string
    :Default: `,`

    Defines the default delimiter for CSV downloads (Microsoft Excel expects
    `;` to be set). The value set will be displayed as default delimiter in the
    download dialog in the :guilabel:`Content > Records` module.

Example: Use semicolon as delimiter CSV downloads
-------------------------------------------------

..  include:: /CodeSnippets/PageTSconfig/Mod/CsvExport.rst.txt

..  include:: /Images/AutomaticScreenshots/WebList/ExportDialog.rst.txt


..  index::
    csvQuote
    CSV Downloads; Quoting character
..  _pageTsConfigWebList-csvQuote:

csvQuote
========

..  confval:: csvQuote
    :name: mod-web-list-csvQuote
    :type: string
    :Default: `"`

    Defines the default quoting character for CSV downloads. The value set will
    be displayed as default quoting in the download dialog in the
    :guilabel:`Content > Records` module.

..  _pageTsConfigWebList-csvQuote-example:

Example: Use single quotes as quoting character for CSV downloads
-----------------------------------------------------------------

..  include:: /CodeSnippets/PageTSconfig/Mod/CsvExport.rst.txt

..  include:: /Images/AutomaticScreenshots/WebList/ExportDialog.rst.txt

..  index::
    deniedNewTables
    Buttons; Create new
..  _pageTsConfigWebListDeniedNewTables:

deniedNewTables
===============

..  confval:: deniedNewTables
    :name: mod-web-list-deniedNewTables
    :type: list of table names

    If this list is set, then the tables listed here won't have a link to "create new record" in the page
    and sub pages. This also affects the "Create new record" content element wizard.

    This is the opposite of :ref:`allowedNewTables property <pageTsConfigWebListAllowedNewTables>`.

    If `allowedNewTables` and `deniedNewTables` contain a common subset, `deniedNewTables` takes precedence.

Hide "Create new record" links in tables sys_category and tt_content
--------------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list {
        deniedNewTables = sys_category, tt_content
    }


..  index:: disableSearchBox
..  _pageTsConfigWebList-disableSearchBox:

disableSearchBox
======================

..  confval:: disableSearchBox
    :name: mod-web-list-disableSearchBox
    :type: boolean

    If set, the checkbox "Show search" in the :guilabel:`Content > Records` module is hidden.


..  index:: disableSingleTableView
..  _pageTsConfigWebList-disableSingleTableView:

disableSingleTableView
======================

..  confval:: disableSingleTableView
    :name: mod-web-list-disableSingleTableView
    :type: boolean

    If set, then the links on the table titles which shows a single table
    listing will not be available - including sorting links on columns
    titles, because these links jumps to the table-only view.


..  index:: displayColumnSelector
..  _pageTsConfigWebList-displayColumnSelector:

displayColumnSelector
=====================

..  confval:: displayColumnSelector
    :name: mod-web-list-displayColumnSelector
    :type: boolean
    :Default: `true`

    The column selector is enabled by default and can be disabled with this
    option. The column selector is displayed at the top of each record list in
    the :guilabel:`List` module. It can be used to compare different fields of
    the listed records.

..  _pageTsConfigWebList-displayRecordDownload:

displayRecordDownload
=====================

..  confval:: displayRecordDownload
    :name: mod-web-list-displayRecordDownload
    :type: boolean
    :Default: `1`

    The "Download" functionality is available in the :guilabel:`Content > Records`
    module via the "Download" button in the relevant
    table header row. It is available in both the list and the single table
    view and can be managed using this option.

    As well as the general option, it is also possible to set this option on
    a table basis using the
    :typoscript:`mod.web_list.table.<tablename>.displayRecordDownload` option.
    If this option is set, it takes precedence over the general option.

    ..  code-block:: typoscript
        :caption: packages/my_sitepackage/Configuration/Sets/MySet/page.tsconfig

        # Page TSconfig
        mod.web_list {
            # Disable "Export" button in Content Records module header
            noExportRecordsLinks = 1

            # Generally disable "Download" button
            displayRecordDownload = 0

            # Enable "Download" button for table "tt_content"
            table.tt_content.displayRecordDownload = 1
        }


..  _pageTsConfigWebList-displayColumnSelector-example:

Example: Hide the column selector
---------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list.displayColumnSelector = 0

..  _pageTsConfigWebList-downloadPresets:

downloadPresets
===============

..  confval:: downloadPresets.[table]
    :name: mod-web-list-downloadPresets
    :type: array of presets

    ..  versionadded:: 13.2
        A new function has been introduced that makes it possible to select the data columns
        to be exported from a list of configurable presets.

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

..  _pageTsConfigWebList-downloadPresets-example:

Example: Create download presets for table page
-----------------------------------------------

..  literalinclude:: _WebList/_downloadPresets.tsconfig
    :caption: EXT:my_extension/Configuration/page.tsconfig

This can be manipulated with user TSconfig by adding the :typoscript:`page.`
prefix. User TSconfig is loaded after page TSconfig, so you can overwrite
the existing default settings using the same TypoScript path.

..  literalinclude:: _WebList/_downloadPresets.tsconfig
    :caption: EXT:my_extension/Configuration/user.tsconfig

..  index::
    enableClipBoard
    Buttons; Show clipboard
    Clipboard; Enable

..  _pageTsConfigWebList-enableClipBoard:

enableClipBoard
===============

..  confval:: enableClipBoard
    :name: mod-web-list-enableClipBoard
    :type: list of keywords
    :Default: `selectable`

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
..  _pageTsConfigWebList-enableDisplayBigControlPanel:

enableDisplayBigControlPanel
============================

..  versionchanged:: 11.3
    The checkbox :guilabel:`Extended view` was removed with TYPO3 v11.3.
    Therefore the option :typoscript:`mod.web_list.enableDisplayBigControlPanel`
    has no effect anymore.

..  index::
    hideTables
    Content Records module; Hide tables
..  _pageTsConfigWebList-hideTables:

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
..  _pageTsConfigWebList-hideTranslations:

hideTranslations
================

..  confval:: hideTranslations
    :name: mod-web-list-hideTranslations
    :type: list of table names, or *

    For tables in this list all their translated records in additional website languages will be hidden
    in the :guilabel:`Content > Records` module.

    Use `*` to hide all records of additional website languages in all tables or set
    single table names as comma-separated list.

..  _pageTsConfigWebList-hideTranslations-example-all:

Example: Hide all translated records
------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list.hideTranslations = *

..  _pageTsConfigWebList-hideTranslations-example:

Example: Hide translated records in tables tt_content and tt_news
-----------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list.hideTranslations = tt_content, tt_news

..  index::
    itemsLimitPerTable
    Content Records module; Items per table
..  _pageTsConfigWebList-itemsLimitPerTable:

itemsLimitPerTable
==================

..  confval:: itemsLimitPerTable
    :name: mod-web-list-itemsLimitPerTable
    :type:  positive integer
    :Default: 20

    Set the default maximum number of items to show per table.
    The number must be between `0` and `10000`. If below or above this range,
    the nearest valid number will be used.

    If a value is defined in the `$TCA[<table>]['interface']['maxDBListItems']`
    of the table, it will override this TSconfig option.
    For example, the `maxDBListItems` for the `pages` table is `30` by default.

..  _pageTsConfigWebList-itemsLimitPerTable-example:

Example: Limit items per table in overview to 10
------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list {
        itemsLimitPerTable = 10
    }

..  index::
    itemsLimitSingleTable
    Content Records module; Items per table in single table view
..  _pageTsConfigWebList-itemsLimitSingleTable:

itemsLimitSingleTable
=====================

..  confval:: itemsLimitSingleTable
    :name: mod-web-list-itemsLimitSingleTable
    :type:  positive integer
    :Default: 100

    Set the default maximum number of items to show in single table view.
    The number must be between `0` and `10000`. If below or above this range,
    the nearest valid number will be used.

    If a value is defined in the `$TCA[<table>]['interface']['maxSingleDBListItems']`
    of the table, it will override this TSconfig option.
    For example, the `maxSingleDBListItems` for the `pages` table is `50` by default.

..  _pageTsConfigWebList-itemsLimitSingleTable-example:

Example: Limit items in single table view to 10
-----------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list {
        itemsLimitSingleTable = 10
    }

..  index::
    listOnlyInSingleTableView
    Content Records module; Records in single table view only
..  _pageTsConfigWebList-listOnlyInSingleTableView:

listOnlyInSingleTableView
=========================

..  confval:: listOnlyInSingleTableView
    :name: mod-web-list-listOnlyInSingleTableView
    :type:  boolean
    :Default: 0

    If set, the default view will not show the single records inside a
    table anymore, but only the available tables and the number of records
    in these tables. The individual records will only be listed in the
    single table view, that means when a table has been clicked. This is
    very practical for pages containing many records from many tables!

..  _pageTsConfigWebList-listOnlyInSingleTableView-example:

Example: Only list records of tables in single-table mode
---------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list {
        listOnlyInSingleTableView = 1
    }

    The result will be that records from tables are only listed in the single-table mode:

..  figure:: /Images/ManualScreenshots/List/PageTsModWebListListOnlyInSingleTableView.png
    :alt: The Content Records module after activating the single-table mode

    The :guilabel:`Content > Records` module after activating the single-table mode

..  index::
    newPageWizard.override
    Pages; New wizard
..  _pageTsConfigWebList-newPageWizard-override:

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
..  _pageTsConfigWebList-noCreateRecordsLink:

noCreateRecordsLink
===================

..  confval:: noCreateRecordsLink
    :name: mod-web-list-noCreateRecordsLink
    :type:  boolean
    :Default: 0

    If set, the link "Create new record" is hidden.

..  _pageTsConfigWebList-noCreateRecordsLink-example:

Example: Hide the "Create new record" link.
-------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list {
        noCreateRecordsLink = 1
    }


..  index::
    noExportRecordsLinks
    Buttons; Export
..  _pageTsConfigWebList-noExportRecordsLinks:

noExportRecordsLinks
====================

..  confval:: noExportRecordsLinks
    :name: mod-web-list-noExportRecordsLinks
    :type:  boolean
    :Default: 0

    ..  versionchanged:: 13.1.0, 12.4.11
        Up until these versions this option also hid the
        :guilabel:`Download` button used for CSV export.

    If set, the :guilabel:`Download` button is hidden
    in the :guilabel:`Content > Records` module.

    This option is important, for example, to disable batch
    download of sensitive data via t3d exports.

    ..  include:: /Images/AutomaticScreenshots/WebList/WithExportButtons.rst.txt

    ..  include:: /Images/AutomaticScreenshots/WebList/NoExportButtons.rst.txt

    ..  note::
        This option only hides the buttons in the :guilabel:`Content > Records`
        module. Bulk export of data is still possible via the context menu of
        the page tree.

..  _pageTsConfigWebList-noExportRecordsLinks-example:

Example: Hide the "Download" and "Export" links
-----------------------------------------------

..  include:: /CodeSnippets/PageTSconfig/Mod/noExportRecordsLinks.rst.txt

..  _pageTsConfigWebList-noViewWithDokTypes:

noViewWithDokTypes (removed)
============================

..  versionchanged:: 14.0
    The TSconfig option :typoscript:`mod.web_list.noViewWithDokTypes` has been
    removed since it just duplicated the existing configuration
    `TCEMAIN.preview.disableButtonForDokType <https://docs.typo3.org/permalink/t3tsref:confval-tcemain-preview>`.

Remove any usage of :typoscript:`mod.web_list.noViewWithDokTypes` from Page
TSconfig.

Instead, configure the equivalent behavior using:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TSconfig/Page/TCEMAIN.tsconfig

   TCEMAIN.preview.disableButtonForDokType = 199, 254

..  index::
    table.[tableName].hideTable
    Content Records module; Hide tables
..  _pageTsConfigWebList-table-tableName-hideTable:

table.[tableName].hideTable
===========================

..  confval:: table.[tableName].hideTable
    :name: mod-web-list-table-tableName-hideTable
    :type:  boolean
    :Default: 0

    If set to non-zero, the table is hidden. If it is zero, table is shown
    even if table name is listed in "hideTables" list.

..  _pageTsConfigWebList-table-tableName-hideTable-example:

Example: Hide table tt_content
------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list.table.tt_content.hideTable = 1


..  index::
    table.[tableName].displayColumnSelector
    Content Records module; columns selector
..  _pageTsConfigWebList-table-tableName-displayColumnSelector:

table.[tableName].displayColumnSelector
=======================================

..  confval:: table.[tableName].displayColumnSelector
    :name: mod-web-list-table-tableName-displayColumnSelector
    :type:  boolean

    If set to false, the column selector in the title row of the specified
    table gets hidden. If the column selctors have been disabled globally
    this option can be used to enable it for a specific table.

..  _pageTsConfigWebList-table-tableName-displayColumnSelector-example-disable:

Example: Hide the column selector for tt_content
------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list.table.tt_content.displayColumnSelector = 0

..  _pageTsConfigWebList-table-tableName-displayColumnSelector-example-enable:

Example: Hide the column selector for all tables but sys_category
-----------------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_list.displayColumnSelector = 0
    mod.web_list.table.sys_category.displayColumnSelector = 1


..  index::
    tableDisplayOrder
    Content Records module; Order tables
..  _pageTsConfigWebList-tableDisplayOrder:

tableDisplayOrder
=================

..  confval:: tableDisplayOrder.[tableName]
    :name: mod-web-list-tableDisplayOrder
    :type: array

    Flexible configuration of the order in which tables are displayed.

    The keywords `before` and `after` can be used to specify an order relative
    to other table names.

    ..  code-block:: typoscript

        mod.web_list.tableDisplayOrder.<tableName> {
            before = <tableA>, <tableB>, ...
            after = <tableA>, <tableB>, ...
        }

..  index::
    searchLevel.items
    Items; Search level
..  _pageTsConfigWebList-searchLevel-items:

searchLevel.items
=================

..  confval:: searchLevel.items
    :name: mod-web-list-searchLevel-items
    :type: array

    Sets labels for each level label in the search level select box

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/page.tsconfig

        mod.web_list.searchLevel.items {
            -1 = LLL:core.core:labels.searchLevel.infinite
            0 = LLL:core.core:labels.searchLevel.0
            1 = LLL:core.core:labels.searchLevel.1
            2 = LLL:core.core:labels.searchLevel.2
            3 = LLL:core.core:labels.searchLevel.3
            4 = LLL:core.core:labels.searchLevel.4
        }

..  index::
    searchLevel.items
    Items; Search level

..  _pageTsConfigWebList-searchLevel-default:

searchLevel.default
===================

..  confval:: searchLevel.default
    :name: mod-web-list-searchLevel-default
    :type: integer

    ..  versionadded:: 13.2

    This option allows to define one of the available level options
    as the default level to use.

    When searching for records in the :guilabel:`Content > Records` module as well as
    the database browser, it is possible to select the search levels (page tree
    levels to respect in the search).

    An editor is therefore able to select between the current page, a couple of
    defined levels (e.g. 1, 2, 3) as well as the special "infinite levels".

    Those options can already be extended using the TSconfig option
    :confval:`mod-web-list-searchLevel-items`.

..  _pageTsConfigWebList-searchLevel-default-example:

Example: Set the default search level to "infinite levels"
----------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    mod.web_list.searchLevel.default = -1
