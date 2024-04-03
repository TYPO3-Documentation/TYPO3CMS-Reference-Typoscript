.. include:: /Includes.rst.txt

.. index::
   mod; web_list
   Modules; List
.. _pageweblist:

========
web_list
========

Configuration options of the "Web > List" module.

.. contents::
   :local:

.. index::
   allowedNewTables
   Buttons; Create new
.. _pageTsConfigWebListAllowedNewTables:

allowedNewTables
================

:aspect:`Datatype`
   list of table names

:aspect:`Description`
   If this list is set, then only tables listed here will have a link to "create new" in the page and sub pages.
   This also affects the "Create new record" content element wizard.

   This is the opposite of :ref:`deniedNewTables property <pageTsConfigWebListDeniedNewTables>`.

   .. note::

      Technically records can be created (e.g. by copying/moving), so this is not a security feature.
      The point is to reduce the number of options for new records visually.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list {
         # Only pages and sys_category table elements will be linked to in the new record wizard
         allowedNewTables = pages, sys_category
      }

   .. figure:: /Images/ManualScreenshots/List/PageTsModWebListAllowedNewTables.png
      :alt: The New record screen after modifying the allowed elements

      The New record screen after modifying the allowed elements


.. index:: clickTitleMode

clickTitleMode
==============

:aspect:`Datatype`
   string

:aspect:`Description`
   Keyword which defines what happens when a user clicks a record title in the list.

   The following values are possible:

   edit
      Edits record

   info
      Shows information

   show
      Shows page in the frontend

:aspect:`Default`
   edit


.. index::
   csvDelimiter
   CSV Exports; Delimiter

csvDelimiter
============

:aspect:`Datatype`
   string

:aspect:`Description`
   Defines the default delimiter for CSV downloads (Microsoft Excel expects
   `;` to be set). The value set will be displayed as default delimiter in the
   download dialog in the list module.

:aspect:`Default`
   ,

:aspect:`Example`
   .. include:: /CodeSnippets/PageTSconfig/Mod/CsvExport.rst.txt

   .. include:: /Images/AutomaticScreenshots/WebList/ExportDialog.rst.txt


.. index::
   csvQuote
   CSV Downloads; Quoting character

csvQuote
========

:aspect:`Datatype`
   string

:aspect:`Description`
   Defines the default quoting character for CSV downloads. The value set will
   be displayed as default quoting in the download dialog in the list module.


:aspect:`Default`
    "

:aspect:`Example`
   .. include:: /CodeSnippets/PageTSconfig/Mod/CsvExport.rst.txt

   .. include:: /Images/AutomaticScreenshots/WebList/ExportDialog.rst.txt

.. index::
   deniedNewTables
   Buttons; Create new
.. _pageTsConfigWebListDeniedNewTables:

deniedNewTables
===============

:aspect:`Datatype`
   list of table names

:aspect:`Description`
   If this list is set, then the tables listed here won't have a link to "create new record" in the page
   and sub pages. This also affects the "Create new record" content element wizard.

   This is the opposite of :ref:`allowedNewTables property <pageTsConfigWebListAllowedNewTables>`.

   If `allowedNewTables` and `deniedNewTables` contain a common subset, `deniedNewTables` takes precedence.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list {
         deniedNewTables = sys_category, tt_content
      }


.. index:: disableSingleTableView

disableSingleTableView
======================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, then the links on the table titles which shows a single table
   listing will not be available - including sorting links on columns
   titles, because these links jumps to the table-only view.



.. index:: displayColumnSelector

displayColumnSelector
=====================

:aspect:`Datatype`
   boolean

:aspect:`Default`
   true

:aspect:`Description`
   The column selector is enabled by default and can be disabled with this
   option. The column selector is displayed at the top of each record list in
   the :guilabel:`List` module. It can be used to compare different fields of
   the listed records.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # disable the column selector completely
      mod.web_list.displayColumnSelector = 0

.. index::
   enableClipBoard
   Buttons; Show clipboard
   Clipboard; Enable

enableClipBoard
===============

:aspect:`Datatype`
   list of keywords

:aspect:`Description`
   Determines whether the checkbox "Show clipboard" in the list module is
   shown or hidden. If it is hidden, you can predefine it to be always
   activated or always deactivated.

   The following values are possible:

   activated
      The option is activated and the checkbox is hidden.

   deactivated
      The option is deactivated and the checkbox is hidden.

   selectable
      The checkbox is shown so that the option can be selected by the user.

:aspect:`Default`
   selectable


.. index::
   enableDisplayBigControlPanel
   List module; Extended view

enableDisplayBigControlPanel
============================

.. versionchanged:: 11.3
   The checkbox :guilabel:`Extended view` was removed with TYPO3 v11.3.
   Therefore the option :typoscript:`mod.web_list.enableDisplayBigControlPanel`
   has no effect anymore.

.. index::
   hideTables
   List module; Hide tables

hideTables
==========

:aspect:`Datatype`
   list of table names, or *

:aspect:`Description`
   Hide these tables in record listings (comma-separated)

   If `*` is used, all tables will be hidden


.. index::
   hideTranslations
   List module; Hide translations
   Localization; Hide translations in List module

hideTranslations
================

:aspect:`Datatype`
   list of table names, or *

:aspect:`Description`
   For tables in this list all their translated records in additional website languages will be hidden
   in the List module.

   Use `*` to hide all records of additional website languages in all tables or set
   single table names as comma-separated list.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list.hideTranslations = *

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list.hideTranslations = tt_content, tt_news


.. index::
   itemsLimitPerTable
   List module; Items per table

itemsLimitPerTable
==================

:aspect:`Datatype`
   positive integer

:aspect:`Description`
   Set the default maximum number of items to show per table.
   The number must be between `5` and `10000`. If below or above this range,
   the nearest valid number will be used.

:aspect:`Default`
   20

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list {
         itemsLimitPerTable = 10
      }

.. index::
   itemsLimitSingleTable
   List module; Items per table in single table view

itemsLimitSingleTable
=====================

:aspect:`Datatype`
   positive integer

:aspect:`Description`
   Set the default maximum number of items to show in single table view.
   The number must be between `5` and `10000`. If below or above this range,
   the nearest valid number will be used.

:aspect:`Default`
   100

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list {
         itemsLimitSingleTable = 10
      }


.. index::
   listOnlyInSingleTableView
   List module; Records in single table view only

listOnlyInSingleTableView
=========================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the default view will not show the single records inside a
   table anymore, but only the available tables and the number of records
   in these tables. The individual records will only be listed in the
   single table view, that means when a table has been clicked. This is
   very practical for pages containing many records from many tables!

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list {
         listOnlyInSingleTableView = 1
      }

      The result will be that records from tables are only listed in the single-table mode:

   .. figure:: /Images/ManualScreenshots/List/PageTsModWebListListOnlyInSingleTableView.png
      :alt: The list module after activating the single-table mode

      The list module after activating the single-table mode

:aspect:`Default`
   0

.. index::
   newPageWizard.override
   Pages; New wizard

newPageWizard.override
======================

:aspect:`Datatype`
   string

:aspect:`Description`
   If set to an extension key, then the specified module or route will be used for creating
   new elements on the page.


.. index::
   noCreateRecordsLink
   Buttons; Create new record

noCreateRecordsLink
===================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the link "Create new record" is hidden.

:aspect:`Default`
   0

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list {
         noCreateRecordsLink = 1
      }


.. index::
   noExportRecordsLinks
   Buttons; Export
   Buttons; Download

noExportRecordsLinks
====================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the :guilabel:`Download` and :guilabel:`Export` buttons are hidden
   in the list module. This applies to
   the :guilabel:`Export` button located at the top left for t3d exports, the
   :guilabel:`Download` button directly on the table
   listing for csv download and the :guilabel:`Download` button in the tables
   single view.

   This option is for example important to disable batch
   download of sensitive data via CSV or t3d exports.

   .. include:: /Images/AutomaticScreenshots/WebList/WithExportButtons.rst.txt

   .. include:: /Images/AutomaticScreenshots/WebList/NoExportButtons.rst.txt

   .. note::
      This option only hides the buttons in the list module. Bulk export of
      data is still possible via the context menu of the page tree.

:aspect:`Default`
    0

:aspect:`Example`
   .. include:: /CodeSnippets/PageTSconfig/Mod/noExportRecordsLinks.rst.txt


.. index::
   noViewWithDokTypes
   Buttons; View page

noViewWithDokTypes
==================

:aspect:`Datatype`
   string

:aspect:`Description`
   Hide view icon for the defined :ref:`doktypes <t3coreapi:list-of-page-types>`
   (comma-separated).

:aspect:`Default`
   254,255


.. index::
   table.[tableName].hideTable
   List module; Hide tables

table.[tableName].hideTable
===========================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set to non-zero, the table is hidden. If it is zero, table is shown
   even if table name is listed in "hideTables" list.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list.table.tt_content.hideTable = 1


.. index::
   table.[tableName].displayColumnSelector
   List module; columns selector

table.[tableName].displayColumnSelector
=======================================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set to false, the column selector in the title row of the specified
   table gets hidden. If the column selctors have been disabled globally
   this option can be used to enable it for a specific table.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # disable the column selector for tt_content
      mod.web_list.table.tt_content.displayColumnSelector = 0


   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Disable the column selector everywhere except for a specific table
      mod.web_list.displayColumnSelector = 0
      mod.web_list.table.sys_category.displayColumnSelector = 1


.. index::
   tableDisplayOrder
   List module; Order tables

tableDisplayOrder
=================

:aspect:`Datatype`
   array

:aspect:`Description`
   Flexible configuration of the order in which tables are displayed.

   The keywords `before` and `after` can be used to specify an order relative to other table names.

:aspect:`Example`
   .. code-block:: typoscript

      mod.web_list.tableDisplayOrder.<tableName> {
         before = <tableA>, <tableB>, ...
         after = <tableA>, <tableB>, ...
      }

.. index::
   searchLevel.items
   Items; Search level

searchLevel.items
=================

:aspect:`Datatype`
   array

:aspect:`Description`
   Sets labels for each level label in the search level select box

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_list.searchLevel.items {
         -1 = EXT:core/Resources/Private/Language/locallang_core.xlf:labels.searchLevel.infinite
         0 = EXT:core/Resources/Private/Language/locallang_core.xlf:labels.searchLevel.0
         1 = EXT:core/Resources/Private/Language/locallang_core.xlf:labels.searchLevel.1
         2 = EXT:core/Resources/Private/Language/locallang_core.xlf:labels.searchLevel.2
         3 = EXT:core/Resources/Private/Language/locallang_core.xlf:labels.searchLevel.3
         4 = EXT:core/Resources/Private/Language/locallang_core.xlf:labels.searchLevel.4
      }
