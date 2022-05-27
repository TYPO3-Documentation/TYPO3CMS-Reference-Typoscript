.. include:: /Includes.rst.txt

.. !!! use 3 spaces to indent on this page

.. index::
   Page TSconfig; mod
   mod
.. _pagemod:


===
mod
===

Configuration for backend modules. This is the part of page TSconfig
with the most options, most sections affect the main TYPO3 editing modules
like *Web > Page* and *Web > List*.


.. index::
   mod; SHARED
   Modules; All
.. _pagesharedotionsformodules:

SHARED
======

.. youtube:: xJtsLlEtY5U


.. index::
   colPos_list
   Columns; Disable

colPos_list
-----------

:aspect:`Datatype`
   list of integers

:aspect:`Description`
   This option lets you specify which columns of tt_content elements should be editable in the
   'Columns' view of the Web > Page module.

   Used on top of backend layouts, this setting controls which columns are editable. Columns configured
   in the Backend Layout which are not listed here, will be displayed with placeholder area.

   Each column has a number which ultimately comes from the configuration of the table tt_content,
   field 'colPos'. These are the values of the four default columns used in the default backend layout:

   Left: `1`, Normal: `0`, Right: `2`, Border: `3`

:aspect:`Default`
   1,0,2,3


:aspect:`Example`
   .. _example_for_backend_layout:

   The example creates a basic backend layout and sets the "Left" column to be not editable:

   *  Create a record of type "Backend Layout", for instance in the root page of your website

   *  Add a title, e.g. "My Layout"

   *  Use the wizard to create a two column backend layout, the result may look like this:

      .. figure:: /Images/ManualScreenshots/List/SimpleBackendLayout.png
         :alt: A simple backend layout

         A simple backend layout

   *  Create a page and select this new backend layout in the "Appearance" tab.
      The page module then looks like this, displaying the two defined columns:

      .. figure:: /Images/ManualScreenshots/Page/SimpleBackendLayoutInPageModule.png
         :alt: Backend layout used in page module

         Backend layout used in page module

   *  Now set the "Left" column to be not editable using page TSconfig in the
      :guilabel:`Resources` tab of the page, by restricting `colPos_list` to
      `0` (the "Content" columns as defined above):

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/page.tsconfig

         mod.SHARED.colPos_list = 0

   *  The result in the page module then looks like this:

      .. figure:: /Images/ManualScreenshots/Page/SimpleBackendLayoutLeftNotEditable.png
         :alt: One column not editable in a backend layout

         One column not editable in a backend layout


.. index::
   defaultLanguageFlag
   Localization; Default language flag
.. _pageTsConfigSharedDefaultLanguageLabel:

defaultLanguageFlag
-------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   Country flag shown for the "Default" language in the backend, used in Web > List and Web > Page module.
   Values as listed in the "Select flag icon" of a language record in the backend are allowed, including
   the value "multiple".

   .. figure:: /Images/ManualScreenshots/List/SelectFlagIcon.png
      :alt: The flag selector of a language record in the backend

      The flag selector of a language record in the backend

:aspect:`Example`
   This will show the German flag, and the text "deutsch" on hover.

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.SHARED {
         defaultLanguageFlag = de
         defaultLanguageLabel = deutsch
      }

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 10** and will only
   work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the default language icon is
   set from the site configuration's language settings and this option will have no effect at all.


.. index::
   defaultLanguageLabel
   Localization; Default language label

defaultLanguageLabel
--------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   Alternate label for "Default" when language labels are shown in the interface.

   Used in Web > List and Web > Page module.

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 10** and will only
   work in the backend for a "NullSite". For instance a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the default language label is
   set from the site configuration's language settings and this option will have no effect at all.


.. index::
   disableLanguages
   Localization; disable languages

disableLanguages
----------------

:aspect:`Datatype`
   string

:aspect:`Description`
   Comma-separated list of language UIDs which will be disabled in the given page tree.

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 10** and will only
   work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the language settings
   from the site configuration are applied and this option will have no effect at all.


.. index::
   disableSysNoteButton
   Buttons; disable sys_note

disableSysNoteButton
--------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Disables the `sys_note` creation button in the modules' top button bar in the :guilabel:`Page`, :guilabel:`List` and :guilabel:`Info`
   modules.


.. index::
   mod; web_info
   Modules; Info

web_info
========

Configuration options of the "Web > Info" module.


.. index::
   fieldDefinitions
   Pagetree overview; Available fields
.. _fieldDefinitions-webinfo:

fieldDefinitions
----------------

:aspect:`Datatype`
   array

:aspect:`Description`
   The available fields in the "Pagetree overview" module under the Info module, by default ship with the entries
   "Basic settings", "Record overview", and "Cache and age".

   .. figure:: /Images/ManualScreenshots/Info/PageTsModWebInfoFieldDefinitions.png
      :alt: Default entries of Pagetree Overview

      Default entries of Pagetree Overview

   By using page TsConfig it is possible to change the available fields and add additional entries to the select box.

   Next to using a list of fields from the `pages` table you can add counters for records in a given table by prefixing a
   table name with `table_` and adding it to the list of fields.

   The string `###ALL_TABLES###` is replaced with a list of all table names an editor has access to.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_info.fieldDefinitions {
         0 {
            # Basic settings
            label = LLL:EXT:info/Resources/Private/Language/locallang_webinfo.xlf:pages_0
            fields = title,uid,slug,alias,starttime,endtime,fe_group,target,url,shortcut,shortcut_mode
         }
         1 {
            # Record overview
            label = LLL:EXT:info/Resources/Private/Language/locallang_webinfo.xlf:pages_1
            fields = title,uid,###ALL_TABLES###
         }
         2 {
            # Cache and age
            label = LLL:EXT:info/Resources/Private/Language/locallang_webinfo.xlf:pages_2
            fields = title,uid,table_tt_content,table_fe_users
         }
      }


.. index::
   web_info.menu.function
   Module menu; Info
.. _pageblindingfunctionmenuoptions-webinfo:

menu.function
-------------

:aspect:`Datatype`
   array

:aspect:`Description`
   Disable elements of the "Function selector" in the document header of the module. The keys for single
   items can be found by browsing *System > Configuration > $GLOBALS['TBE_MODULES_EXT']*.

   .. figure:: /Images/ManualScreenshots/Info/FunctionMenuInfoModule.png
      :alt: The function menu of the Info module

      The function menu of the Info module

   .. warning::

      Blinding the function mMenu items is not hardcore access control! All it
      does is hide the possibility of accessing that module functionality
      from the interface. It might be possible for users to hack their way
      around it and access the functionality anyways. You should use the
      option of blinding elements mostly to remove otherwise distracting options.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_info.menu.function {
         # Disable item "Page Tsconfig"
         TYPO3\CMS\Info\Controller\InfoPageTyposcriptConfigController = 0
         # Disable item "Log"
         TYPO3\CMS\Belog\Module\BackendLogModuleBootstrap = 0
         # Disable item "Pagetree Overview"
         TYPO3\CMS\Info\Controller\PageInformationController = 0
         # Disable item "Localization Overview"
         TYPO3\CMS\Info\Controller\TranslationStatusController = 0
         # Disable item "Linkvalidator"
         TYPO3\CMS\Linkvalidator\Report\LinkValidatorReport = 0
      }


.. index::
   mod; web_layout
   Modules; Page
.. _pagewebpage:

web_layout
==========

Configuration options of the "Web > Page" module.


.. index::
   Localization; Inconsistent language mode
   Localization; Independently translated contend
   allowInconsistentLanguageHandling

allowInconsistentLanguageHandling
---------------------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   By default, TYPO3 will not allow you to mix translated content and independent content in the page module.
   Content elements violating this behavior will be marked in the page module and there is no UI control (yet)
   allowing you to create independent content elements in a given language.

   If you want to go back to the old, inconsistent behavior, you can toggle it back on using this switch.

:aspect:`Example`
   Allows to set TYPO3s page module back to inconsistent language mode

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.allowInconsistentLanguageHandling = 1


.. index:: BackendLayouts

BackendLayouts
--------------

:aspect:`Datatype`
   array

:aspect:`Description`
   Allows to define backend layouts via Page TSconfig directly, without using database records.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.BackendLayouts {
         exampleKey {
            title = Example
            icon = EXT:example_extension/Resources/Public/Images/BackendLayouts/default.gif
            config {
               backend_layout {
                  colCount = 1
                  rowCount = 2
                  rows {
                     1 {
                        columns {
                           1 {
                              name = LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:colPos.I.3
                              colPos = 3
                              colspan = 1
                           }
                        }
                     }
                     2 {
                        columns {
                           1 {
                              name = Main
                                       colPos = 0
                                       colspan = 1
                                   }
                               }
                           }
                       }
                   }
               }
           }
       }


.. index::
   defaultLanguageLabel
   Localization; Default language label

defaultLanguageLabel
--------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   Alternate label for "Default" when language labels are shown in the interface.

   Overrides the same property from :ref:`mod.SHARED <pageTsConfigSharedDefaultLanguageLabel>` if set.

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 10** and will only
   work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the default language label is
   set from the site configuration's language settings and this option will have no effect at all.


.. index::
   defLangBinding
   Localization; Show default content element

defLangBinding
--------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, translations of content elements are bound to the default record in the display. This means that
   within each column with content elements any translation found for exactly the shown default content
   element will be shown in the language column next to.

   This display mode should be used depending on how the frontend is configured to display localization.
   The frontend must display localized pages by selecting the default content elements and for each
   one overlay with a possible translation if found.

:aspect:`Default`
   0


.. index::
   disableNewContentElementWizard
   New content element wizard; Disable

disableNewContentElementWizard
------------------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Disables the fact that the new-content-element icons links to the
   content element wizard and not directly to a blank "NEW" form.


.. index::
   hideRestrictedCols
   Page columns; Hide restricted

hideRestrictedCols
------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If activated, only columns will be shown in the backend that the editor is
   allowed to access. All columns with access restriction are hidden in that case.

   By default columns with restricted access are rendered with a message
   telling *that* the user doesn't have access. This may be useless and
   distracting or look repelling. Instead, all columns an editor doesn't have
   access to can be hidden:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.hideRestrictedCols = 1

   .. attention::

      This setting will break your layout if you are using backend layouts.

:aspect:`Default`
   false


.. index::
   localization.enableCopy
   Localization; Free mode
   Localization; Copy content elements

localization.enableCopy
-----------------------

:aspect:`Datatype`
   boolean


:aspect:`Description`
   Enables the creation of copies of content elements into languages in the translation wizard ("free mode").

:aspect:`Default`
   1

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout {
         localization.enableCopy = 0
      }


.. index::
   localization.enableTranslate
   Localization; Connected mode
   Localization; Translate content elements

localization.enableTranslate
----------------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Enables simple translations of content elements in the translation wizard ("connected mode").

:aspect:`Default`
   1

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout {
         localization.enableTranslate = 0
      }


.. index::
   web_layout.menu.functions
   Module menu; Pages
.. _pageblindingfunctionmenuoptions-weblayout:

menu.functions
--------------

:aspect:`Datatype`
   array

:aspect:`Description`
   Disable elements of the "Function selector" in the document header of the module.

   .. figure:: /Images/ManualScreenshots/Page/FunctionMenuPageModule.png
      :alt: The function menu of the Page module

   The function keys are numerical:

   Columns
      1
   Languages
      2

   .. warning::

      Blinding Function Menu items is not hardcore access control! All it
      does is hide the possibility of accessing that module functionality
      from the interface. It might be possible for users to hack their way
      around it and access the functionality anyways. You should use the
      option of blinding elements mostly to remove otherwise distracting options.


:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Disables "Languages" from function menu
      mod.web_layout.menu.functions {
         2 = 0
      }


.. index::
   noCreateRecordsLink
   Buttons; Create new record

noCreateRecordsLink
-------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the link in the bottom of the page, "Create new record", is hidden.

:aspect:`Default`
   0


.. index::
   preview
   Content elements; Preview definition

preview
-------

:aspect:`Datatype`
   string

:aspect:`Description`
   It is possible to render previews of your own content elements in the page module.
   By referencing a Fluid template you can create a visual representation of your content element,
   making it easier for an editor to understand what is going on on the page.

   The syntax is as follows:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.tt_content.preview.[CTYPE].[list_type value] = EXT:site_mysite/Resources/Private/Templates/Preview/ExamplePlugin.html

   This way you can even switch between previews for your plugins by supplying `list` as CType.

   .. note::

      This only works, if there is no hook registered for this content type, you may want to check this
      section in the :guilabel:`System > Configuration` module:

      .. code-block:: php
         :caption: Search for registrations of this hook

         $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']
            ['tt_content_drawItem']['content_element_xy'];

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.tt_content {
         preview.custom_ce = EXT:site_mysite/Resources/Private/Templates/Preview/CustomCe.html
         preview.table = EXT:site_mysite/Resources/Private/Templates/Preview/Table.html
         preview.list.tx_news = EXT:site_mysite/Resources/Private/Templates/Preview/TxNews.html
      }


.. index::
   mod; web_list
   Modules; List
.. _pageweblist:

web_list
========

Configuration options of the "Web > List" module.


.. index::
   allowedNewTables
   Buttons; Create new
.. _pageTsConfigWebListAllowedNewTables:

allowedNewTables
----------------

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
--------------

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
------------

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
--------

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
---------------

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
----------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, then the links on the table titles which shows a single table
   listing will not be available - including sorting links on columns
   titles, because these links jumps to the table-only view.



.. index:: displayColumnSelector

displayColumnSelector
---------------------

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
---------------

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
----------------------------

.. versionchanged:: 11.3
   The checkbox :guilabel:`Extended view` was removed with TYPO3 11.3.
   Therefore the option :typoscript:`mod.web_list.enableDisplayBigControlPanel`
   has no effect anymore.

.. index::
   hideTables
   List module; Hide tables

hideTables
----------

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
----------------

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
------------------

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
---------------------

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
-------------------------

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
   newContentElementWizard.override
   Content elements; New wizard

newContentElementWizard.override
--------------------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   If set to an extension key, then the specified module or route for creating
   new content elements.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.newContentElementWizard.override = my_custom_module
      mod.newContentElementWizard.override = my_module_route


.. index::
   newPageWizard.override
   Pages; New wizard

newPageWizard.override
----------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   If set to an extension key, then the specified module or route will be used for creating
   new elements on the page.


.. index::
   noCreateRecordsLink
   Buttons; Create new record

noCreateRecordsLink
-------------------

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
--------------------

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
------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   Hide view icon for the defined doktypes (comma-separated)

:aspect:`Default`
   254,255


.. index::
   table.[tableName].hideTable
   List module; Hide tables

table.[tableName].hideTable
------------------------------

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
---------------------------------------

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
-----------------

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
-----------------

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


web_ts
======

Configuration options of the "Web > Template" module.


.. index::
   web_info.menu.function
   Module menu; Template
.. _pageblindingfunctionmenuoptions-webts:

menu.function
-------------

:aspect:`Datatype`
   array

:aspect:`Description`
   Disable elements of the "Function selector" in the document header of the module. The keys for single
   items can be found by browsing *System > Configuration > $GLOBALS['TBE_MODULES_EXT']*.

   .. figure:: /Images/ManualScreenshots/Template/FunctionMenuTemplateModule.png
      :alt: The function menu of the Template module

      The function menu of the Template module

   .. warning::

      Blinding Function Menu items is not hardcore access control! All it
      does is hide the possibility of accessing that module functionality
      from the interface. It might be possible for users to hack their way
      around it and access the functionality anyways. You should use the
      option of blinding elements mostly to remove otherwise distracting options.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Disable the item "Template Analyzer"
      mod.web_ts.menu.function {
         TYPO3\CMS\Tstemplate\Controller\TemplateAnalyzerModuleFunctionController = 0
      }



.. index::
   mod; web_view
   Modules; View
.. _pagewebview:

web_view
========

Configuration options of the "Web > View" module.


.. index::
   previewFrameWidths
   Preview; Frame widths
   Preview; Tablet
   Preview; Mobile

previewFrameWidths
------------------

:aspect:`Datatype`
   array

:aspect:`Description`
   Configure available presets in view module.

   <key>.label
      Label for the preset

   <key>.type
      Category of the preset, must be one of 'desktop', 'tablet' or 'mobile'

   <key>.width
      Width of the preset

   <key>.height
      Height of the preset

:aspect:`Example`
   With this configuration a new preset '1014' with size 1027x768 will be configured with a label
   loaded from an xlf file and the category 'desktop'.

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_view.previewFrameWidths {
         1024.label = LLL:EXT:viewpage/Resources/Private/Language/locallang.xlf:computer
         1024.type = desktop
         1024.width = 1024
         1024.height = 768
      }

   .. figure:: /Images/ManualScreenshots/View/WebViewTSConfigPreview.png
      :alt: Dropdown menu Width with added frame size called myPreview

      Dropdown menu Width with added frame size called myPreview



.. index::
   View module; type parameter

type
----

:aspect:`Datatype`
   positive integer

:aspect:`Description`
   Enter the value of the &type parameter passed to the webpage.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_view {
         # Frontend link will be something like index.php?id=123&type=1
         type = 1
      }


.. index:: Wizards

wizards
=======

The `wizards` section allows to customize the *New record wizard* and the
*New content element wizard*.


.. index:: Wizards; new content element
.. _pagenewcontentelementwizard:

newContentElement.wizardItems
-----------------------------

:aspect:`Datatype`
   array

:aspect:`Description`
   In the new content element wizard, content element types are grouped
   together by type. Each such group can be configured independently. The
   four default groups are: "common", "special", "forms" and "plugins".

   The configuration options below apply to any group.

   mod.wizards.newContentElement.wizardItems.[group].before
      (string) Sorts [group] in front of the group given.

   mod.wizards.newContentElement.wizardItems.[group].after
      (string) Sorts [group] after the group given.

   mod.wizards.newContentElement.wizardItems.[group].header
      (localized string) Name of the group.

   mod.wizards.newContentElement.wizardItems.[group].show
      (string) Comma-separated list of items to show in the group. Use `*` to show all, example:

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/page.tsconfig

         # Hide bulletList
         mod.wizards.newContentElement.wizardItems.common.show := removeFromList(bullets)
         # Only show text and textpic in common
         mod.wizards.newContentElement.wizardItems.common.show = text,textpic

   mod.wizards.newContentElement.wizardItems.[group].elements
      (array) List of items in the group.

   mod.wizards.newContentElement.wizardItems.[group].elements.[name]
      (array) Configuration for a single item.

   mod.wizards.newContentElement.wizardItems.[group].elements.[name].iconIdentifier
      (string) The icon identifier of the icon you want to display.

   mod.wizards.newContentElement.wizardItems.[group].elements.[name].iconOverlay
      (string) The icon identifier of the overlay icon you want to use.

   mod.wizards.newContentElement.wizardItems.[group].elements.[name].title
      (localized string) Name of the item.

   mod.wizards.newContentElement.wizardItems.[group].elements.[name].description
      (localized string) Description text for the item.

   mod.wizards.newContentElement.wizardItems.[group].elements.[name].tt_content_defValues
      (array) Default values for tt_content fields.

:aspect:`Example`
   .. _pageexample1:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Add a new element (header) to the "common" group
      mod.wizards.newContentElement.wizardItems.common.elements.header {
         iconIdentifier = content-header
         title = Header
         description = Adds a header element only
         tt_content_defValues {
            CType = header
         }
      }
      mod.wizards.newContentElement.wizardItems.common.show := addToList(header)

   .. _pageexample2:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Create a new group and add a (pre-filled) element to it
      mod.wizards.newContentElement.wizardItems.myGroup {
         header = LLL:EXT:cms/layout/locallang.xlf:advancedFunctions
         elements.customText {
            iconIdentifier = content-text
            title = Introductory text for national startpage
            description = Use this element for all national startpages
            tt_content_defValues {
               CType = text
               bodytext (
                  <h2>Section Header</h2>
                  <p class="bodytext">Lorem ipsum dolor sit amet, consectetur, sadipisci velit ...</p>
               )
               header = Section Header
               header_layout = 100
            }
         }
      }
      mod.wizards.newContentElement.wizardItems.myGroup.show = customText

   With the second example, the bottom of the new content element wizard shows:

   .. figure:: /Images/ManualScreenshots/List/PageTsModWizardsNewContentElementExample2.png
      :alt: Added entry in the new content element wizard

      Added entry in the new content element wizard


.. index::
   Wizards; record
   New Record wizard; order
.. _pagewebrecordwizard:

newRecord.order
---------------

:aspect:`Datatype`
   list of values

:aspect:`Description`
   Define an alternate order for the groups of records in the new records
   wizard. Pages and content elements will always be on top, but the
   order of other record groups can be changed.

   Records are grouped by extension keys, plus the special key "system"
   for records provided by the TYPO3 Core.

:aspect:`Example`
   Place the tt_news group at the top (after pages and content
   elements), other groups follow unchanged:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.wizards.newRecord.order = tt_news

   .. figure:: /Images/ManualScreenshots/List/NewRecordWizardNewOrder.png
      :alt: The position of News changed after modifying the New record screen

      The position of News changed after modifying the New record screen


.. index::
   Wizards; record
   New Record wizard; After page button
   New Record wizard; Inside page button

newRecord.pages
---------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Use the following sub-properties to show or hide the specified links.
   Setting any of these properties to 0 will hide the corresponding link,
   but setting to 1 will leave it visible.

   show.pageAfter
      Show or hide the link to create new pages after the selected page.

   show.pageInside
      Show or hide the link to create new pages inside the selected page.

   show.pageSelectPosition
      Show or hide the link to create new pages at a selected position.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.wizards.newRecord.pages.show {
         # Hide the "Page (inside)" link.
         pageInside = 0
      }

   .. figure:: /Images/ManualScreenshots/List/PageTsModWizardsNewRecordHideInside.png
      :alt: The modified New record screen without Page (inside)

      The modified new record screen without page (inside)
