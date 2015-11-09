.. include:: ../../Includes.txt

.. _pagemod:

->MOD
^^^^^

Configuration for backend modules. Generally the syntax is
*[module\_name].[property]*. The module name is defined in the
conf.php files for the module.

.. _pageblindingfunctionmenuoptions:

Blinding Function Menu options in Backend Modules
"""""""""""""""""""""""""""""""""""""""""""""""""

Most of the modules in TYPO3 have a "function menu" selector box and
this menu is usually configurable so you are able to remove menu items
in specific sections of the page tree (or by overriding via User
TSconfig, you could disable an option totally for a specific
user/group).

In this case the main menu of the Web > Info module looks like this:

.. figure:: ../../Images/manual_html_m615ff10e.png
   :alt: The original function menu inside the info module

By adding this Page TSconfig we can remove the "Page TSconfig" item

.. code-block:: typoscript

   mod.web_info.menu.function {
      tx_infopagetsconfig_webinfo = 0
   }

The function menu will now look like this:

.. figure:: ../../Images/manual_html_10bf0f2e.png
   :alt: The function menu inside the info module without Page TSconfig

The 'Page TSconfig' option is simply disabled by setting this Page
TSconfig!

All you need to know in order to disable function menu items in the
backend modules is, *which* modules support it and what the *key* of
the menu item is (in the above example it was
'tx\_infopagetsconfig\_webinfo'). Modules extending the class
"t3lib\_SCbase" will most likely provide this out-of-the-box since
it is a part of the base class in t3lib\_SCbase::menuConfig().

Examples from the TYPO3 core are listed in the table below:

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         web\_layout.menu.function

   Description
         **Web > Page module**

         .. figure:: ../../Images/manual_html_5268c65f.png
            :alt: The original layout menu inside the page module

         **Option tags:**

         .. code-block:: html

            <select name="SET[function]">
               <option value="1">Columns</option>
               <option value="0">QuickEdit</option>
               <option value="2">Languages</option>
               <option value="3">Grid-View</option>
            </select>

         **Example:**

         .. code-block:: typoscript

            # Disables all items except the "QuickEdit" item:
            mod.web_layout.menu.function {
               1 = 0
               2 = 0
               3 = 0
            }


.. container:: table-row

   Property
         web\_info.menu.function

   Description
         **Web > Info module**

         .. figure:: ../../Images/manual_html_4c191623.png
            :alt: The original function menu inside the info module

         **Option tags:**

         .. code-block:: typoscript

            <select name="SET[function]">
               <option value="tx_cms_webinfo_page">Page tree Overview</option>
               <option value="tx_cms_webinfo_lang">Localization Overview</option>
               <option value="tx_belog_webinfo">Log</option>
               <option value="tx_infopagetsconfig_webinfo">Page TSconfig</option>
               <option value="tx_linkvalidator_ModFuncReport">Linkvalidator</option>
               <option value="tx_realurl_modfunc1">Speaking Url Management</option>
               <option value="tx_indexedsearch_modfunc1">Indexed search</option>
               <option value="tx_indexedsearch_modfunc2">Indexed search statistics</option>
            </select>

         .. note::

            The Module "Speaking Url Management" is provided by the
            extension RealURL, which is not part of the TYPO3 Core.

         **Example:**

         .. code-block:: typoscript

            # Disables the item "Indexed search statistics":
            mod.web_info.menu.function {
               tx_indexedsearch_modfunc2 = 0
            }


.. container:: table-row

   Property
         web\_func.menu.function

   Description
         **Web > Functions module**

         .. figure:: ../../Images/manual_html_4570ee97.png
            :alt: The original function menu inside the functions module

         **Option tags:**

         .. code-block:: html

            <select name="SET[function]">
               <option value="tx_funcwizards_webfunc">Wizards</option>
            </select>


.. container:: table-row

   Property
         web\_func.menu.wiz

   Description
         **Web > Functions module, Wizards submodule**

         This is the 2nd level Function Menu in the Web > Functions module.
         Instead of the "function" key of the main menu it just uses the key
         "wiz" instead.

         .. figure:: ../../Images/manual_html_601b8e77.png
            :alt: Wizards submodules of the function menu inside the functions module

         **Option tags:**

         .. code-block:: html

            <select name="SET[wiz]">
               <option value="tx_wizardcrpages_webfunc_2">Create multiple pages</option>
               <option value="tx_wizardsortpages_webfunc_2">Sort pages</option>
            </select>

         **Example:**

         .. code-block:: typoscript

            # Disables the sub-item "Create multiple pages":
            mod.web_func.menu.wiz {
               tx_wizardcrpages_webfunc_2 = 0
            }


.. container:: table-row

   Property
         web\_ts.menu.function

   Description
         **Web > Template module**

         .. figure:: ../../Images/manual_html_38b1b9c9.png
            :alt: The original function menu from the template module

         **Option tags:**

         .. code-block:: html

            <select name="SET[function]">
               <option value="tx_tstemplateceditor">Constant Editor</option>
               <option value="tx_tstemplateinfo">Info/Modify</option>
               <option value="tx_tstemplateobjbrowser">TypoScript Object Browser</option>
               <option value="tx_tstemplateanalyzer">Template Analyzer</option>
            </select>


.. container:: table-row

   Property
         user\_task.menu.function

   Description
         **User > Task Center**

         Prior to TYPO3 4.5 the Task Center worked the following way:

         The Task Center does not provide a selector box function menu. But
         behind the scenes it uses the same functionality of saving "states"
         and therefore you can also blind items in the Task Center.

         There is one tricky thing though: The Task Center is not depending on
         a page in the page tree! So you either have to set default Page
         TSconfig or User TSconfig to blind options here!

         .. figure:: ../../Images/manual_html_1d084bf7.png
            :alt: The TYPO3 taskcenter

         **Keys are:**

         tx\_sysnotepad = Quick Notetx\_taskcenterrecent = Recent
         Pagestx\_taskcenterrootlist = Web > List module /
         roottx\_taskcentermodules = Pluginstx\_sysaction = Actionstx\_systodos
         = Tasks

         **Example:**

         Set this as *User TSconfig*

         .. code-block:: typoscript

            # Task Center configuration:
            mod.user_task.menu.function {
               # Disable "Recent Pages" display:
               tx_taskcenterrecent = 0
               # Disable "Action" list
               tx_sysaction = 0
            }


.. ###### END~OF~TABLE ######

[page:mod; beuser:mod]

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         taskcenter

   Description
         **User > Task Center**

         In TYPO3 4.5 and newer the Task Center can be configured as follows:

         The Task Center does not provide a selector box function menu holding
         the different tasks. But behind the scenes it uses the same
         functionality of saving "states" and therefore you can also blind
         items in the Task Center.

         There is one tricky thing though: The Task Center is not depending on
         a page in the page tree! So you have to set User TSconfig to blind
         options here!

         .. figure:: ../../Images/manual_html_m44e31433.png
            :alt: Configuring the TYPO3 Taskcenter

         You can hide a task by using the following syntax in User TSconfig

         .. code-block:: typoscript

            taskcenter {
               <extension-key>.<task-class> = 0
            }

         Be aware that <extension-key> needs to be replaced by the actual
         extension key and <task-class> by the class name of the PHP class
         providing the task.

         **Example:**

         Set this as *User TSconfig*

         .. code-block:: typoscript

            # Task Center configuration:
            taskcenter {
               # Disable "Quick Note":
               sys_notepad.tx_sysnotepad_task = 0
               # Disable "Action":
               sys_action.tx_sysaction_task = 0
               # Disable "Import/Export":
               impexp.tx_impexp_task = 0
            }


.. ###### END~OF~TABLE ######

[beuser]

Since function menu items can be provided by extensions it is not
possible to create a complete list of menu keys. The list above
represents a typical installation of the TYPO3 Core with the
Introduction Package. Therefore the listing includes options from
system extensions and some additional ones.

Therefore, if you want to blind a menu item, the only safe way of
doing it, is to look at the HTML source of the backend module, to find
the selector box with the function menu and to extract the key from
the <option> tags. This listing is a cleaned-up version of a function
menu. The keys are the values of the option tags.

.. code-block:: html

   <select>
      <option value="tx_cms_webinfo_page">Page tree overview</option>
      <option value="tx_belog_webinfo">Log</option>
      <option value="tx_infopagetsconfig_webinfo">Page TSconfig</option>
   </select>

As you can see, this is where the key for the example before was
found.

.. code-block:: typoscript

   mod.web_info.menu.function {
      tx_infopagetsconfig_webinfo = 0
   }

.. warning::

   Blinding Function Menu items is not hardcore access control! All it
   does is to hide the possibility of accessing that module functionality
   from the interface. It might be possible for users to hack their way
   around it and access the functionality anyways. You should use the
   option of blinding elements mostly to remove otherwise distracting
   options.

.. _pageoverridingpagetsconfigwithusertsconfig:

Overriding Page TSconfig with User TSconfig
"""""""""""""""""""""""""""""""""""""""""""

In all standard modules the Page TSconfig values of the "mod." branch
may be overridden by the same branch of values set for the backend
user.

To illustrate this feature let's consider the case from above where a
menu item in the Web > Info module was disabled in the Page TSconfig
with this value

.. code-block:: typoscript

   mod.web_info.menu.function {
      tsconf = 0
   }

If however we activate this configuration in the TSconfig of a certain
backend user (e.g. the admin user), that user would still be able to
select this menu item because the value of his User TSconfig overrides
the same value set in the Page TSconfig

.. code-block:: typoscript

   mod.web_info.menu.function {
      tsconf = 1
   }

.. figure:: ../../Images/manual_html_m6b2884ce.png
   :alt: Example 1: Overriding the Page TSconfig menu function


Here is another example: The value of
'mod.web\_layout.editFieldsAtATime' has been set to '1' in Page
TSconfig. Additionally it is also set in the User TSconfig of the
user, who is currently logged in, but there to the value '5'. The
upper image shows you how to check the Page TSconfig. In the lower
image you see the result of this user's User TSconfig: It overrides
the Page TSconfig and alters the configuration:

.. figure:: ../../Images/manual_html_748558d0.png
   :alt: Example 2: Overriding the Page TSconfig menu function

.. _pagesharedotionsformodules:

Shared options for modules (mod.SHARED)
"""""""""""""""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         colPos\_list

   Data type
         *(list of integers)*

   Description
         This option lets you specify which columns of tt\_content elements
         should be displayed in the 'Columns' view of the modules, in
         particular Web > Page.

         By default there are four columns, Left, Normal, Right, Border.
         However most websites use only the Normal column, maybe another also.
         In that case the remaining columns are not needed. By this option you
         can specify exactly which of the columns you want to display.

         If used on top of Backend Layouts, this setting controls which columns
         are editable. Columns configured in the Backend Layout which are not
         listed here, will be displayed with placeholder area.

         Each column has a number which ultimately comes from the configuration
         of the table tt\_content, field 'colPos' found in the tables.php file.
         These are the values of the four default columns used in the default
         Backend Layout:

         Left: 1

         Normal: 0

         Right: 2

         Border: 3

         **Example:**

         This results in only the Normal and Border column being displayed

         .. code-block:: typoscript

            mod.SHARED.colPos_list = 0,3

         .. note::

            Since TYPO3 6.0 mod.SHARED.colPos_list is no longer working.
            Use Backend Layouts instead.

            In TYPO3 CMS 6.2, this setting was reintroduced and affects Backend Layouts.

         .. _example_for_backend_layout:

         **Example for a Backend Layout**

         * Create a record of type "Backend Layout"
           (e.g. in the root page of your website).

         * Add a title (e.g. My Layout).

         * Add in field "Config" the following configuration:

         .. tip::

            You can use the wizard next to the configuration field as a help.

         .. code-block:: typoscript

            backend_layout {
               colCount = 2
               rowCount = 1
               rows {
                  1 {
                     columns {
                        1 {
                           name = Left
                           colPos = 1
                        }
                        2 {
                           name = Content
                           colPos = 0
                        }
                     }
                  }
               }
            }

         * Click on the root page of your website.

         * Click Page Properties > Appearance.

         * Select the new Backend Layout for this page and for the subpages.
           This way the new Backend Layout will be preselected for all subpages
           (also for new ones).

         * Now the columns with colPos=1 and colPos=0 are displayed, labeled
           with "Left" and "Content".

         .. figure:: ../../Images/simpleBackendLayout.png
            :alt: A simple Backend Layout

   Default
         1,0,2,3


.. container:: table-row

   Property
         defaultLanguageLabel

   Data type
         string

   Description
         Alternative label for "Default" when language labels are shown in the
         interface.

         Used in Web > List, Web > Page and TemplaVoilà page module.


.. container:: table-row

   Property
         defaultLanguageFlag

   Data type
         string

   Description
         Filename of the file with the flag icon for the default language. Do
         not use the complete filename, but only the name without dot and
         extension. The file is taken from :file:`typo3/sysext/t3skin/images/flags/`.

         Used in Web > List and TemplaVoilà page module.

         **Example:** This will show the German flag.

         .. code-block:: typoscript

            mod.SHARED {
               defaultLanguageFlag = de
               defaultLanguageLabel = deutsch
            }

         .. tip::

            You can specify "multiple" for the multi-language flag.
            In general: Use the "Select flag icon" selector of a language
            record in the backend to find out what names are available.

            .. figure:: ../../Images/SelectFlagIcon.png

               The flag selector of a language record in the backend -
               a handy way to find out what flag names are available

         .. note::

            Prior to TYPO3 4.5 you had to set the complete filename as
            defaultLanguageFlag, for example "de.gif" to get the german
            flag. Since TYPO3 4.5 you must use the name without dot and
            extension.


.. container:: table-row

   Property
         disableLanguages

   Data type
         string

   Description
         Comma-separated list of language UID which will be disabled in the
         given page tree.


.. ###### END~OF~TABLE ######

[page:mod.SHARED; beuser:mod.SHARED]

.. _pagewebpage:

Web > Page (mod.web\_layout)
""""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         allowInconsistentLanguageHandling

   Data type
         *boolean*

   Description
         By default, TYPO3 will not allow you to mix translated content and independent content in the page module.
         Content elements violating this behavior will be marked in the Page Module and there is no UI control allowing
         you to create independent content elements in a given language.

         If you want to go back to the old, inconsistent behavior, you can toggle it back on via this switch.

         **Example:**

         Allows to set TYPO3s page module back to inconsistent language mode

         .. code-block:: typoscript

            mod.web_layout.allowInconsistentLanguageHandling = 1


.. container:: table-row

   Property
         tt\_content.colPos\_list

   Data type
         *(list of integers)*

   Description
         See mod.SHARED.colPos\_list for details.

         If non-blank, this list will override the one set by
         mod.SHARED.colPos\_list.

         **Example:**

         This results in only the Normal and Border column being displayed

         .. code-block:: typoscript

            mod.web_layout.tt_content.colPos_list = 0,3


.. container:: table-row

   Property
         editFieldsAtATime

   Data type
         positive integer

   Description
         Specifies the number of subsequent content elements to load in the
         edit form when clicking the edit icon of a content element in the
         'Columns' view of the module.

         **Example:**

         .. code-block:: typoscript

            mod.web_layout {
               editFieldsAtATime = 2
            }

   Default
         1


.. container:: table-row

   Property
         noCreateRecordsLink

   Data type
         boolean

   Description
         If set, the link in the bottom of the page, "Create new record", is
         hidden.

   Default
         0


.. container:: table-row

   Property
         QEisDefault

   Data type
         boolean

   Description
         If set, then the QuickEditor is the first element in the Function Menu
         in the top of the menu in Web > Page

   Default
         0


.. container:: table-row

   Property
         disableSearchBox

   Data type
         boolean

   Description
         Disables the search box in Columns view.

   Default
         0


.. container:: table-row

   Property
         disableAdvanced

   Data type
         boolean

   Description
         Disables the clear cache advanced function in the bottom of the page
         in the module, including the "Create new record" link. As well removes
         the "Clear cache for this page" icon in the right top of the page
         module.

   Default
         0


.. container:: table-row

   Property
         disableNewContentElementWizard

   Data type
         boolean

   Description
         Disables the fact that the new-content-element icons links to the
         content element wizard and not directly to a blank "NEW" form.


.. container:: table-row

   Property
         defaultLanguageLabel

   Data type
         string

   Description
         Alternative label for "Default" when language labels are shown in the
         interface.

         Overrides the same property from mod.SHARED if set.


.. container:: table-row

   Property
         defLangBinding

   Data type
         boolean

   Description
         If set, translations of content elements are bound to the default
         record in the display. This means that within each column with content
         elements any translation found for exactly the shown default content
         element will be shown in the language column next to.

         This display mode should be used depending on how the frontend is
         configured to display localization. The frontend must display
         localized pages by selecting the default content elements and for each
         one overlay with a possible translation if found.

   Default
         0


.. container:: table-row

   Property
         disableIconToolbar

   Data type
         boolean

   Description
         Disables the topmost icon toolbar with the "view"-Icon and the icon
         toolbar below.


.. container:: table-row

   Property
         disablePageInformation

   Data type
         boolean

   Description
         (Since TYPO3 4.7) Hide the menu item "Page information" in the drop
         down box.

         Use this option instead of removing page information completely.

         .. note::

            This option and the item "Page Information" have been removed
            in TYPO3 6.0.

   Default
         0


.. container:: table-row

   Property
         BackendLayouts

   Data type
         array

   Description
         Define backend layouts without database records.

         **Example:**

         .. code-block:: typoscript

            mod.web_layout.BackendLayouts {
               exampleKey {
                  title = Example
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
                  icon = EXT:example_extension/Resources/Public/Images/BackendLayouts/default.gif
               }
            }

.. ###### END~OF~TABLE ######

[page:mod.web\_layout; beuser:mod.web\_layout]

.. _pageweblist:

Web > List (mod.web\_list)
""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         noCreateRecordsLink

   Data type
         boolean

   Description
         If set, the link in the bottom of the page, "Create new record", is
         hidden.

         **Example:**

         .. code-block:: typoscript

            mod.web_list {
               noCreateRecordsLink = 1
            }

   Default
         0


.. container:: table-row

   Property
         disableSingleTableView

   Data type
         boolean

   Description
         If set, then the links on the table titles which shows a single table
         listing only will not be available (including sorting links on columns
         titles, because these links jumps to the table-only view).


.. container:: table-row

   Property
         listOnlyInSingleTableView

   Data type
         boolean

   Description
         If set, the default view will not show the single records inside a
         table anymore, but only the available tables and the number of records
         in these tables. The individual records will only be listed in the
         single table view, that means when a table has been clicked. This is
         very practical for pages containing many records from many tables!

         **Example:**

         .. code-block:: typoscript

            mod.web_list {
               listOnlyInSingleTableView = 1
            }

         The result will be that records from tables are only listed in the
         single-table mode:

         .. figure:: ../../Images/manual_html_165a5551.png
            :alt: The list module after activating the single-table mode

   Default
         0


.. container:: table-row

   Property
         noExportRecordsLinks

   Data type
         boolean

   Description
         (Since TYPO3 6.1) If set, the "Export" and "Download CSV file" buttons
         are hidden in single table view inside the list module. This option is
         for example important to disable batch download of sensitive data via
         csv or t3d exports.

         **Example:**

         .. code-block:: typoscript

            mod.web_list {
               noExportRecordsLinks = 1
            }

         The buttons "Export" and "Download CSV file" are hidden
         in single table view inside the list module:

         .. figure:: ../../Images/listModuleWithoutExportButtons.png
            :alt: The list module without export buttons after activating the single-table mode

   Default
         0


.. container:: table-row

   Property
         itemsLimitSingleTable

   Data type
         positive integer

   Description
         Set the default maximum number of items to show in single table view.

   Default
         100


.. container:: table-row

   Property
         itemsLimitPerTable

   Data type
         positive integer

   Description
         Set the default maximum number of items to show per table.

   Default
         20


.. container:: table-row

   Property
         noViewWithDokTypes

   Data type
         string

   Description
         Hide view icon for the defined doktypes (comma-separated)

   Default
         254,255


.. container:: table-row

   Property
         hideTables

   Data type
         *(list of table names)*

   Description
         Hide these tables in record listings (comma-separated)


.. container:: table-row

   Property
         table.[*table name*].hideTable

   Data type
         boolean

   Description
         If set to non-zero, the table is hidden. If it is zero, table is shown
         no matter if table name is listed in "hideTables" list.

         **Example:**

         .. code-block:: typoscript

            mod.web_list.table.tt_content.hideTable = 1


.. container:: table-row

   Property
         hideTranslations

   Data type
         *(list of table names)*

   Description
         (Since TYPO3 4.6) For tables in this list all their records in
         additional website languages will be hidden in the List module. Only
         records in default website languages are visible.

         Use "\*" to hide all records of additional website languages in all
         tables or choose tables by comma-separated list.

         **Example:**

         .. code-block:: typoscript

            mod.web_list.hideTranslations = *

         or

         .. code-block:: typoscript

            mod.web_list.hideTranslations = tt_content,tt_news


.. container:: table-row

   Property
         disableSearchBox

   Data type
         boolean

   Description
         (Since TYPO3 4.6) Disables the search box located below the clipboard

   Default
         0


.. container:: table-row

   Property
         allowedNewTables

   Data type
         *(list of table names)*

   Description
         If this list is set, then only tables listed here will have a link to
         "create new" in the page and subpages.

         This also affects the display of "Create new record",
         typo3/sysext/backend/Classes/Controller/NewRecordController.php
         (db\_new.php).

         .. note::

            Technically records can be created (e.g. by copying/moving),
            so this is "pseudo security". The point is to reduce the number of
            options for new records visually.

         **Example:**

         .. code-block:: typoscript

            mod.web_list {
            allowedNewTables = pages, tt_news
            }

         Only pages and tt\_news table elements will be linked to in the New
         record screen:

         .. figure:: ../../Images/manual_html_6d60e8b.png
            :alt: The New record screen after modifying the allowed elements


.. container:: table-row

   Property
         deniedNewTables

   Data type
         *(list of table names)*

   Description
         If this list is set, then the tables listed here won't have a link to
         "create news" in the page and subpages. This also affects
         "db\_new.php" (the display of "Create new record").

         This is the opposite of the previous property "allowedNewTables".

         If allowedNewTables and deniedNewTables contain a common subset,
         deniedNewTables takes precedence.

         **Example:**

         .. code-block:: typoscript

            mod.web_list {
               deniedNewTables = tt_news,tt_content
            }


.. container:: table-row

   Property
         newWizards

   Data type
         boolean

   Description
         If set, then the new-link over the control panel of the pages and
         tt\_content listings in the List module will link to the wizards and
         not create a record in the top of the list.


.. container:: table-row

   Property
         showClipControlPanelsDespiteOfCMlayers

   Data type
         boolean

   Description
         If set, then the control- and clipboard panels of the module is shown
         even if the context-popups (ClickMenu) are available. Normally the
         control- and clipboard panels are disabled (unless extended mode is
         set) in order to save bandwidth.


.. container:: table-row

   Property
         enableDisplayBigControlPanel

   Data type
         *(list of keywords)*

   Description
         Determines whether the checkbox "Extended view" in the list module is
         shown or hidden. If it is hidden, you can predefine it to be always
         activated or always deactivated.

         .. figure:: ../../Images/manual_html_74103dfb.png
            :alt: "Extended view" is shown in the list module

         The following values are possible:

         - activated: The option is activated and the checkbox is hidden.

         - deactivated: The option is deactivated and the checkbox is hidden.

         - selectable: The checkbox is shown so that the option can be selected by the user.

   Default
         selectable


.. container:: table-row

   Property
         enableClipBoard

   Data type
         *(list of keywords)*

   Description
         Determines whether the checkbox "Show clipboard" in the list module is
         shown or hidden. If it is hidden, you can predefine it to be always
         activated or always deactivated.

         The following values are possible:

         - activated: The option is activated and the checkbox is hidden.

         - deactivated: The option is deactivated and the checkbox is hidden.

         - selectable: The checkbox is shown so that the option can be selected by the user.

   Default
         selectable


.. container:: table-row

   Property
         enableLocalizationView

   Data type
         *(list of keywords)*

   Description
         Determines whether the checkbox "Localization view" in the list module
         is shown or hidden. If it is hidden, you can predefine it to be always
         activated or always deactivated.

         The following values are possible:

         - activated: The option is activated and the checkbox is hidden.

         - deactivated: The option is deactivated and the checkbox is hidden.

         - selectable: The checkbox is shown so that the option can be selected by the user.

   Default
         selectable


.. container:: table-row

   Property

         newPageWizard.override

         newContentElementWizard.override

   Data type
         string

   Description
         If set to an extension key, (e.g. "templavoila"), then the specified module or route  will be used for creating
         new elements on the page. "newContentElementWizard" will likewise use the defined module or route for creating
         new content elements.

         Also see "options.overridePageModule".

         **Example:**

         .. code-block:: typoscript

            mod.newContentElementWizard.override = my_custom_module
            mod.newContentElementWizard.override = my_module_route


.. container:: table-row

   Property
         clickTitleMode

   Data type
         string

   Description
         Keyword which defines what happens when a user clicks the title in the
         list.

         Default is that pages will go one level down while other records have
         no link at all.

         Keywords:

         **edit** = Edits record

         **info** = Shows information

         **show** = Shows page/content element in frontend


.. container:: table-row

   Property
         tableDisplayOrder.[*table name*]

   Data type
         array

   Description
         Flexible configuration of the order in which tables are displayed.

         The keywords ``before`` and ``after`` can be used to specify an order relative to other table names.

         **Example:**

         .. code-block:: typoscript

            mod.web_list.tableDisplayOrder.<tableName> {
              before = <tableA>, <tableB>, ...
              after = <tableA>, <tableB>, ...
            }



.. ###### END~OF~TABLE ######

[page:mod.web\_list; beuser:mod.web\_list]

.. _pagewebview:

Web > View (mod.web\_view)
""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         type

   Data type
         positive integer

   Description
         Enter the value of the &type parameter passed to the webpage.

         **Example:**

         By this configuration frontend pages will be shown with
         "index.php?id=123&type=1" from the Web > View module

         .. code-block:: typoscript

            mod.web_view {
               type = 1
            }


.. container:: table-row

   Property
         previewFrameWidths

   Data type
         positive integer

   Description
         Enter value for frame width and any LLL or string for label

         **Example:**

         With this configuration a new frame sizes with 500px x 300px labeled
         myPreview will be added in the dropdown menu Width inside Web > View module

         .. code-block:: typoscript

            mod.web_view.previewFrameWidths {
               300.label = myPreview
               300.height = 500
            }

         .. figure:: ../../Images/WebViewTSConfigPreview.png
            :alt: Dropdown menu Width with added frame size called myPreview


.. ###### END~OF~TABLE ######

[page:mod.web\_view; beuser:mod.web\_view]


Wizards (mod.wizards)
"""""""""""""""""""""

The configuration for wizards was introduced in TYPO3 4.3. Wizards
make it possible to customize the new record wizard or the new content
element wizard, for example.

.. _pagewebrecordwizard:

New record wizard (mod.wizards.newRecord)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         pages

   Data type
         boolean

   Description
         (Since TYPO3 4.6) Use the following sub-properties to show or hide the
         specified links.

         **Available sub-properties:**

         show.pageAfter
           Show or hide the link to create new pages after
           the selected page.

         show.pageInside
           Show or hide the link to create new pages inside
           the selected page.

         show.pageSelectPosition
           Show or hide the link to create new pages
           at a selected position.

         Setting any of these properties to 0 will hide the corresponding link,
         but setting to 1 will leave it visible.

         **Example:**

         .. code-block:: typoscript

            mod.wizards.newRecord.pages.show {
               pageInside = 0
            }

         Hides the "Page (inside)" link.

         .. figure:: ../../Images/manual_html_44865d7b.png
            :alt: The modified New record screen without Page (inside)

   Default
         1


.. container:: table-row

   Property
         order

   Data type
         *(list of values)*

   Description
         Define an alternate order for the groups of records in the new records
         wizard. Pages and content elements will always be on top, but the
         order of other record groups can be changed.

         Records are grouped by extension keys, plus the special key "system"
         for records provided by the TYPO3 Core.

         **Example:**

         .. code-block:: typoscript

            mod.wizards.newRecord.order = tt_news

         This places the tt\_news group at the top (after pages and content
         elements). The other groups follow unchanged:

         .. figure:: ../../Images/manual_html_1c6e46bb.png
            :alt: The position of News changed after modifying the New record screen


.. ###### END~OF~TABLE ######

[page:mod.wizards.newRecord; beuser:page.mod.wizards.newRecord]

.. _pagenewcontentelementwizard:

New content element wizard (mod.wizards.newContentElement)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         wizardItems.[group]

   Data type
         array

   Description
         In the new content element wizard, content element types are grouped
         together by type. Each such group can be configured independently. The
         four default groups are: "common", "special", "forms" and "plugins".

         The configuration options below apply to any group.


.. container:: table-row

   Property
         wizardItems.[group].header

   Data type
         string (localized)

   Description
         Name of the group.


.. container:: table-row

   Property
         wizardItems.[group].show

   Data type
         string

   Description
         Comma-separated list of items to show in the group. Use "\*" to show
         all.

         **Example:**

         .. code-block:: typoscript

            # Hide bulletList
            mod.wizards.newContentElement.wizardItems.common.show := removeFromList(bullets)
            # Only show text and textpic in common
            mod.wizards.newContentElement.wizardItems.common.show = text,textpic


.. container:: table-row

   Property
         wizardItems.[group].elements

   Data type
         array

   Description
         List of items in the group.


.. container:: table-row

   Property
         wizardItems.[group].elements.[name]

   Data type
         array

   Description
         Configuration for a single item.


.. container:: table-row

   Property
         wizardItems.[group].elements.[name].iconIdentifier

   Data type
         string

   Description
         The icon identifier of the icon you want to display.


.. container:: table-row

   Property
         wizardItems.[group].elements.[name].title

   Data type
         string (localized)

   Description
         Name of the item.


.. container:: table-row

   Property
         wizardItems.[group].elements.[name].description

   Data type
         string (localized)

   Description
         Description text for the item.


.. container:: table-row

   Property
         wizardItems.[group].elements.[name].tt\_content\_defValues

   Data type
         array

   Description
         Default values for tt\_content fields.


.. ###### END~OF~TABLE ######

[page:mod.wizards.newContentElement;
beuser:mod.wizards.newContentElement]

.. _pageexample1:

Example 1:
~~~~~~~~~~

Add a new element (header) to the "common" group

.. code-block:: typoscript

   mod.wizards.newContentElement.wizardItems.common.elements.header {
      icon = gfx/c_wiz/regular_text.gif
      title = Header
      description = Adds a header element only
      tt_content_defValues {
         CType = header
      }
   }
   mod.wizards.newContentElement.wizardItems.common.show := addToList(header)

.. _pageexample2:

Example 2:
~~~~~~~~~~

Create a new group and add a (pre-filled) element to it

.. code-block:: typoscript

   mod.wizards.newContentElement.wizardItems.myGroup {
      header = LLL:EXT:cms/layout/locallang.xlf:advancedFunctions
      elements.customText {
         icon = gfx/c_wiz/regular_text.gif
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

This will add the following at the bottom of the new content element
wizard:

.. figure:: ../../Images/manual_html_73b37d4e.png
   :alt: Added entry in the new content element wizard

.. _pagetoolsem:

Tools > Extension Manager (mod.tools\_em)
"""""""""""""""""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         allowTVlisting

   Data type
         boolean

   Description
         If set, the listings "Technical", "Validation" and "Changed" are
         available in the Extension Manager. Those will evaluate ALL available
         extensions. That can take many seconds (up to 30) depending on the
         number of extensions.

         **Example:**

         .. code-block:: typoscript

            mod.tools_em.allowTVlisting = 1

         Enables these options in the Extension Manager:

         .. figure:: ../../Images/manual_html_3fa38a1.png
            :alt: The Extension Manager with additional options

         .. note::

            This setting does not influence the new Extension Manager
            which comes with TYPO3 4.5 and newer.

   Default
         0


.. ###### END~OF~TABLE ######

[beuser:mod.tools\_em]
