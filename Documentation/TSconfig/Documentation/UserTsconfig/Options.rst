.. include:: /Includes.rst.txt
.. index:: User TSconfig; Options
.. _useroptions:

=======
options
=======

Various options for the user affecting the core at various points.

As an example, this enables the "Flush frontend caches" button in the upper right toolbar
cache menu for non admin users:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/user.tsconfig

   options.clearCache.pages = 1

Properties
==========

.. contents::
   :depth: 2
   :local:


.. todo:: How does this work with site configurations?
.. index:: Localization; preview languages
.. _useroptions-additionalPreviewLanguages:

additionalPreviewLanguages
--------------------------

:aspect:`Datatype`
   list of sys_language ids

:aspect:`Description`
   The user will see these additional languages when localizing stuff in
   TCEforms. The list are ids of site languages, as defined in the
   :ref:`config.yaml languageId <t3coreapi:sitehandling-addingLanguages>`.


.. index:: Backend; Alert popups
.. _useroptions-alertPopups:

alertPopups
-----------

:aspect:`Datatype`
   bitmask

:aspect:`Description`
   Configure which Javascript popup alerts have to be displayed and which not:

   1 – onTypeChange

   2 – copy / move / paste

   4 – delete

   8 – FE editing

   128 – other (not used yet)

:aspect:`Default`
   255 (show all warnings)


.. index:: Backend; Bookmark groups
.. _useroptions-bookmarkGroups:

bookmarkGroups
--------------

:aspect:`Datatype`
   Array of integers/ strings

:aspect:`Description`
   Set groups of bookmarks that can be accessed by the user. This affects the
   bookmarks toolbar item in the top right of the backend.

   By default, 5 default groups will be defined globally (shared, can
   only be set by admins) and also for each user (personal bookmarks):

   1. Pages

   2. Records

   3. Files

   4. Tools

   5. Miscellaneous

   Set 0 to disable one of these group IDs, 1 to enable it (this is the
   default) or "string" to change the label accordingly.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      bookmarkGroups {
         1 = 1
         2 = My Group
         3 = 0
         4 =
      }

   Bookmark group 1 is loaded with the default label (Pages), group 2 is
   loaded and labeled as "My Group" and groups 3 and 4 are disabled.
   Group 5 has not been set, so it will be displayed by default, just
   like group 1.

   .. versionadded:: 11.0

   Custom language labels can also be used instead of a fixed label:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      bookmarkGroups {
         2 = LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:bookmarkGroups.2
      }


.. index:: Clear cache; Clear all button for non admins
.. _useroptions-clearCache-all:

clearCache.all
--------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   This will allow a non-admin user to clear frontend and page-related caches, plus some backend-related
   caches (that is everything including templates); if it is explicitly set to 0 for an admin user,
   it will remove the clear all option on toolbar for that user.

:aspect:`Default`
   0


.. index:: Clear cache; Clear pages button for non admins
.. _useroptions-clearCache-pages:

clearCache.pages
----------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set to 1, this will allow a non-admin user to clear frontend and page-related caches.

:aspect:`Default`
   0


.. index:: Clipboard; Number of pads
.. _useroptions-clipboardNumberPads:

clipboardNumberPads
-------------------

:aspect:`Datatype`
   integer (0-20)

:aspect:`Description`
   This allows you to enter how many pads you want on the clipboard.

:aspect:`Default`
   3


.. index:: ContextMenu; Disable items
.. _useroptions-contextMenu-key-disableItems:

contextMenu disableItems
------------------------

:aspect:`Datatype`
   list of items

:aspect:`Description`
   List of context menu ("clickmenu") items to disable.

   .. figure:: /Images/ManualScreenshots/List/PagesContextMenu.png
      :alt: Context menu of the page tree

      Context menu of the page tree

   The full path of this property is:
   `contextMenu.table.[tableName][.context].disableItems`

   The "[tableName]" refers to the type of the record (database table name)
   the context menu is shown for e.g.  "pages", "sys_file", "tt_content", etc.

   Optional key "[.context]" refers to the place from which the context menu
   is triggered. The core uses just one context called `tree` for context menus
   triggered from page tree and folder tree. This way you can disable certain
   options for one context, but keep them for another.

   Items to disable for "page" type are: `view`, `edit`, `new`, `info`, `copy`,
   `copyRelease`, `cut`, `cutRelease`, `pasteAfter`, `pasteInto`, `newWizard`,
   `pagesSort`, `pagesNewMultiple`, `openListModule`, `mountAsTreeRoot`,
   `hideInMenus`, `showInMenus`, `permissions`, `enable`, `disable`, `delete`,
   `history`, `clearCache`

   Items to disable for "sys_file" type (that is files/folders) are: `edit`,
   `rename`, `upload`, `new`, `info`, `copy`, `copyRelease`, `cut`,
   `cutRelease`, `pasteInto`, `delete`

   When the system extension Import/Export (impexp) is installed then two more
   options become available: `exportT3d` and `importT3d`

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      # Remove "New" and "Create New wizard" for pages context menu (list module)
      options.contextMenu.table.pages.disableItems = new,newWizard

      # Remove "New" and "Create New wizard" in page tree context menu
      options.contextMenu.table.pages.tree.disableItems = new,newWizard

      # Remove the "More options" item in the page tree context menu and all its subelements
      options.contextMenu.table.pages.tree.disableItems = newWizard, pagesSort, pagesNewMultiple, openListModule, mountAsTreeRoot, exportT3d, importT3d, hideInMenus, showInMenus, permissions

.. index:: Element browser; Create Folders
.. _useroptions-createFoldersInEB:

createFoldersInEB
-----------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, a createFolders option appears in the element browser (for
   admin-users this is always enabled).


.. index:: Dashboard; Presets
.. _useroptions-dashboard-dashboardPresetsForNewUsers:

dashboard.dashboardPresetsForNewUsers
-------------------------------------

:aspect:`Datatype`
   list of dashboard identifiers

:aspect:`Description`
   List of dashboard identifiers to be used on initial dashboard module access.

:aspect:`Default`
   default

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.dashboard.dashboardPresetsForNewUsers := addToList(customDashboard)


.. index:: Upload folder; Default
.. _useroptions-defaultUploadFolder:

defaultUploadFolder
-------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   When a user uploads files they are stored in the default upload folder
   of the first file storage that user may access. The folder is used for
   uploads in the TCEforms fields. In general, this will be :file:`fileadmin/user_upload`.

   With this property it is possible to set a specific upload folder.

   The syntax is "storage_uid:file_path".

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.defaultUploadFolder = 2:user_folders/my_folder/


.. index:: Records; Delete disabled
.. _useroptions-disableDelete:

disableDelete
-------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Disables the "Delete" button in TCEFORMs.

   Note it is possible to set this for single tables using `options.disableDelete.<tableName>`.
   Any value set for a single table will override the default value set for "disableDelete".

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.disableDelete.tt_content = 1


.. index:: DB mounts; Hide root from admins
.. _useroptions-dontMountAdminMounts:

dontMountAdminMounts
--------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   This options prevents the root to be mounted for an admin user.

   .. note::

      Only for admin-users. For other users it has no effect.


.. index:: Bookmarks; enable
.. _useroptions-enableBookmarks:

enableBookmarks
---------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Enables the usage of bookmarks in the backend.

:aspect:`Default`
   1


.. index:: File list

file_list
---------


.. index:: File list; Clipboard enable
.. _useroptions-file_list-enableClipBoard:

file_list.enableClipBoard
~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   list of keywords

:aspect:`Description`
   Determines whether the checkbox "Show clipboard" in the filelist
   module is shown or hidden. If it is hidden, you can predefine it to be
   always activated or always deactivated.

   The following values are possible:

   - activated: The option is activated and the checkbox is hidden.

   - deactivated: The option is deactivated and the checkbox is hidden.

   - selectable: The checkbox is shown so that the option can be selected by the user.

:aspect:`Default`
   selectable

.. index:: File list; Column Selector
.. _useroptions-file_list-displayColumnSelector:

file_list.displayColumnSelector
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    boolean

:aspect:`Default`
   true

:aspect:`Description`
   The column selector is enabled by default and can be disabled with this
   option. The column selector is displayed at the top of each file list.

   It can be used to manage the fields displayed for each file / folder,
   while containing convenience actions such as "filter", "check all / none"
   and "toggle selection".

   The fields to be selected are a combination of special fields, such as
   `references` or `read/write` permissions, the corresponding `sys_file`
   record fields, as well as all available `sys_file_metadata` fields.

:aspect:`Example`
    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/user.tsconfig

       # disable the column selector
       file_list.displayColumnSelector = 0


.. index:: File list; Extended view enable
.. _useroptions-file_list-enableDisplayBigControlPanel:

file_list.enableDisplayBigControlPanel
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. versionchanged:: 11.3
   The checkbox :guilabel:`Extended view` was removed with TYPO3 11.3.
   Therefore the option :typoscript:`file_list.enableDisplayBigControlPanel`
   has no effect anymore.

.. index:: File list; Thumbnails enable
.. _useroptions-file_list-enableDisplayThumbnails:

file_list.enableDisplayThumbnails
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   list of keywords

:aspect:`Description`
   Determines whether the checkbox "Display thumbnails" in the filelist module is shown or hidden.
   If it is hidden, you can predefine it to be always activated or always deactivated.

   The following values are possible:

   - activated: The option is activated and the checkbox is hidden.

   - deactivated: The option is deactivated and the checkbox is hidden.

   - selectable: The checkbox is shown so that the option can be selected by the user.

:aspect:`Default`
   selectable


.. index:: File list; Files per page
.. _useroptions-file_list-filesPerPage:

file_list.filesPerPage
~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   integer

:aspect:`Description`
   The maximum number of files shown per page in File > List

:aspect:`Default`
   40

..  index::
    File list; Primary actions
    File list; Allowed actions
..  _useroptions-file_list-primaryActions:

file_list.primaryActions
~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
    string

:aspect:`Description`
    Option to add more primary actions to the list view.
    The list of actions to be displayed can be given in the TSConfig of
    the backend user. The actions that can be added are `view`, `metadata`,
    `delete`, `copy` and `cut`. `translations` is always active.

:aspect:`Default`
    :typoscript:`view,metadata,translations,delete`


.. index:: File list; Thumbnails height
.. _useroptions-file_list-thumbnail-height:

file_list.thumbnail.height
~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   integer

:aspect:`Description`
   All preview images in the file list will be rendered with the configured thumbnail height.

:aspect:`Default`
   64


.. index:: File list; Thumbnails width
.. _useroptions-file_list-thumbnail-width:

file_list.thumbnail.width
~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   integer

:aspect:`Description`
   All preview images in the file list will be rendered with the configured thumbnail width.

:aspect:`Default`
   64


.. index:: Uploader; Name collision default action
.. _useroptions-file_list-uploader-defaultaction:

file_list.uploader.defaultAction
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   string

:aspect:`Description`
   Default action for the modal that appears when during file upload a name collision occurs.
   Possible values:

   * Cancel: abort the action
   * Rename: append the file name with a numerical index
   * Replace: override the file with the uploaded one

:aspect:`Default`
   Cancel


.. index:: Folder tree

folderTree
----------


.. index:: Folder tree; File mounts in element browser
.. _useroptions-folderTree-altElementBrowserMountPoints:

folderTree.altElementBrowserMountPoints
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   list of "storageUid:folderName" items

:aspect:`Description`
   Sets alternative filemounts for use in any folder tree, including in the
   :guilabel:`Filelist` list module, in the element browser and in file
   selectors.

   Each item consists of storage UID followed by a colon
   and the folder name inside that storage. Separate multiple items by
   a comma.

   For backwards compatibility, defining only a folder name but no
   storage uid and colon prepended is still supported. Folders
   without a storage UID prepended are assumed to be located in the default
   storage, which by default is the :file:`fileadmin/` folder. If a folder
   you specify does not exist it will not get mounted.

   Settings this option is effective in workspaces too.

   The alternative file mounts are added to the existing ones defined in
   the user or group configuration.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.folderTree.altElementBrowserMountPoints = _temp_/, 2:/templates, 1:/files/images


.. index:: Folder tree; Create folder; hide
.. _useroptions-folderTree-hideCreateFolder:

folderTree.hideCreateFolder
~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the user can't create new folders.

:aspect:`Default`
   false


.. index::
   Uploader; File number
   Uploader; Hide
.. _useroptions-folderTree-uploadFieldsInLinkBrowser:

folderTree.uploadFieldsInLinkBrowser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   integer

:aspect:`Description`
   This value defines the number of upload fields in the element browser.
   Default value is 3, if set to 0, no upload form will be shown.

:aspect:`Default`
   3

..  index:: Modules; Hide
..  _useroptions-hideModules:

hideModules
-----------

:aspect:`Datatype`
    list of module groups or modules

:aspect:`Description`
    Configure which module groups or modules should be hidden from the main menu.

    ..  important::
        It is not an access restriction but makes defined modules invisible.
        This means that in principle these modules can still be accessed if the
        rights allow this.

    ..  hint::
        A list of all available module groups and modules can be found in in the
        backend module :guilabel:`System > Configuration > Backend Modules`. The
        system extension "lowlevel" has to be available for accessing this list.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # Hide only module groups "file" and "help"
        options.hideModules = file, help

        # Hide additional modules "info" and "ts" from the "web" group
        options.hideModules := addToList(web_info, web_ts)

        # Hide only module BeLogLog from "system" group
        options.hideModules = system_BelogLog


.. index:: Records; Hide on pages
.. _useroptions-hideRecords-pages:

hideRecords.pages
-----------------

:aspect:`Datatype`
   list of page ids

:aspect:`Description`
   This hides records in the backend user interface. It is not an access restriction but makes defined
   records invisible. That means in principle those records can still be edited if the user rights allow.
   This makes sense if only a specialized module should be used to edit those otherwise hidden records.

   This option is currently implemented for the pages table only and has an effect in the following places:

   - Page tree navigation frame

   - Web > List module

   - New record wizard

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.hideRecords.pages = 12,45

.. index:: Import export; Enable for non admins
.. _useroptions-impexp-enableExportForNonAdminUser:

impexp.enableExportForNonAdminUser
----------------------------------

.. versionadded:: 10.4.29/11.5.11
   This option was introduced to avoid `information disclosure
   <https://typo3.org/security/advisory/typo3-core-sa-2022-001>`_.

:aspect:`Datatype`
   boolean

:aspect:`Description`
   The import/export module of `EXT:impext` is disabled by default for non-admin users. Enable this
   option, if non-admin users need to use the module and export data. This should only be enabled for trustworthy
   backend users, as it might impose a security risk.

:aspect:`Default`
   0

.. index:: Import export; Enable for non admins
.. _useroptions-impexp-enableImportForNonAdminUser:

impexp.enableImportForNonAdminUser
----------------------------------

This option was introduced to avoid `information disclosure
<https://typo3.org/article/typo3-core-sa-2016-015>`_.

:aspect:`Datatype`
   boolean

:aspect:`Description`
   The import/export module of `EXT:impext` is disabled by default for non-admin users. Enable this
   option, if non-admin users need to use the module and import data. This should only be enabled for trustworthy
   backend users, as it might impose a security risk.

:aspect:`Default`
   0

.. index:: Bookmarks; Create and delete disabled
.. _useroptions-mayNotCreateEditBookmarks:

mayNotCreateEditBookmarks
-------------------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the user can not create or edit bookmarks.


.. index::
   Thumbnails; Disable in element browser
   Element browser; Disable thumbnails
.. _useroptions-noThumbsInEB:

noThumbsInEB
------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, then image thumbnails are not shown in the element browser.

.. todo:: can we remove this?
.. _useroptions-overridePageModule:

overridePageModule
------------------

:aspect:`Datatype`
   string

:aspect:`Description`
   By this value you can substitute the default "Web > Page" module key
   ("web\_layout") with another backend module key.

   .. note::

      This property has been introduced for TemplaVoila in the old days. It is of little use nowadays
      and can be achieved using :ref:`hideModules <useroptions-hideModules>`, too.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      # Enable TemplaVoila page module as default page module.
      options.overridePageModule = web_txtemplavoilaM1

.. index:: Page tree

pageTree
--------


.. index:: Page tree; Webmounts replace
.. _useroptions-pageTree-altElementBrowserMountPoints:

pageTree.altElementBrowserMountPoints
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   list of integers

:aspect:`Description`
   Sets alternative webmounts for use in the Element Browser. You
   separate page ids by a comma. Non-existing page ids are ignored. If
   you insert a non-integer it will evaluate to "0" (zero) and the root
   of the page tree is mounted. Effective in workspaces too.

   These alternative webmounts **replace** configured DB mount points
   unless you use the ``altElementBrowserMountPoints.append`` option
   described below.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.pageTree.altElementBrowserMountPoints = 34,123


.. index:: Page tree; Webmounts append
.. _useroptions-pageTree-altElementBrowserMountPoints-append:

pageTree.altElementBrowserMountPoints.append
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   This option allows administrators to add additional mount points
   in the RTE and the Wizard element browser instead of replacing
   the configured database mount points of the user when using the
   existing UserTSconfig option.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.pageTree.altElementBrowserMountPoints = 34,123
      options.pageTree.altElementBrowserMountPoints.append = 1


.. index:: Page tree; Background colors
.. _useroptions-pageTree-backgroundColor:

pageTree.backgroundColor
~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   string

:aspect:`Description`
   Set background colors for tree branches.

   Color can be any valid CSS color value. The best results can be achieved by using rgba values.

   The syntax is: :typoscript:`options.pageTree.backgroundColor.<pageId> = <color>`

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.pageTree.backgroundColor.147 = orange
      options.pageTree.backgroundColor.148 = #AFAFAF
      options.pageTree.backgroundColor.151 = rgba(0, 255, 0, 0.1)

   .. figure:: /Images/ManualScreenshots/List/optionsPageTreeBackgroundColor.png
      :alt: Tree branches with configured background colors

      Tree branches with configured background colors


.. index:: Page tree; Doktypes for new pages
.. _useroptions-pageTree-doktypesToShowInNewPageDragArea:

pageTree.doktypesToShowInNewPageDragArea
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   string

:aspect:`Description`
   If set, the node top panel feature can be configured by a comma-separated list.
   Each number stands for a doctype id that should be added to the node top panel.

   .. figure:: /Images/ManualScreenshots/List/PanelNormal.png
      :alt: Top panel in normal mode

   .. figure:: /Images/ManualScreenshots/List/PanelModified.png
      :alt: Top panel modified

:aspect:`Default`
   1,6,4,7,3,254,255,199

.. index:: Page tree; Exclude doktypes
.. _useroptions-pageTree-excludeDoktypes:

pageTree.excludeDoktypes
~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   list of integers

:aspect:`Description`
   Excludes nodes (pages) with one of the defined doktypes from the pagetree. Can be used for example for hiding custom doktypes.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.pageTree.excludeDoktypes = 254,1

.. todo:: does this still work with site configuration?
.. index:: Page tree; Show domain names
.. _useroptions-pageTree-showDomainNameWithTitle:

pageTree.showDomainNameWithTitle
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the domain name will be appended to the page title for
   pages that have "Is root of web site?" checked in the page properties.
   Useful if there are several domains in one page tree.


.. index:: Page tree; Show navigation title
.. _useroptions-pageTree-showNavTitle:

pageTree.showNavTitle
~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the navigation title is displayed in the page navigation tree
   instead of the normal page title. The page title is showed in a
   tooltip if the mouse hovers the navigation title.


.. index:: Page tree; Show page id
.. _useroptions-pageTree-showPageIdWithTitle:

pageTree.showPageIdWithTitle
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the titles in the page tree will have their ID numbers printed before the title.


.. index:: Page tree; Show path above mounts
.. _useroptions-pageTree-showPathAboveMounts:

pageTree.showPathAboveMounts
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the user db mount path above the mount itself is shown.
   This is useful if you work a lot with user db mounts.

   .. figure:: /Images/ManualScreenshots/List/PanelUserDB.png
      :alt: Active user db mount


.. index:: Password; Reset
.. _useroptions-passwordReset:

passwordReset
-------------

:aspect:`Datatype`
   boolean

:aspect:`Default`
   true

:aspect:`Description`
   If set to `0` the initiating of the password reset in the backend
   will be disabled. This does not affect the password reset by
   cli command.

   To completely disable the password reset in the backend for all users, you can
   set the user TSconfig globally in your :file:`ext_localconf.php`:

   .. code-block:: php
      :caption: EXT:site_package/ext_localconf.php

      \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
         'options.passwordReset = 0'
      );

   If required, this setting can be overridden on a per user basis
   in the corresponding :guilabel:`TSconfig` field of the backend
   usergroup or user.

   The password reset functionality can also be disabled globally by setting:

   .. code-block:: php
      :caption: typo3conf/LocalConfiguration.php

      $GLOBALS['TYPO3_CONF_VARS']['BE']['passwordReset'] = false


.. index:: Clipboard; Save for next login
.. _useroptions-saveClipboard:

saveClipboard
-------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the clipboard content will be preserved for the next login.
   Normally the clipboard content lasts only during the session.


.. index:: Buttons; Save and create new
.. _useroptions-saveDocNew:

saveDocNew
----------

:aspect:`Datatype`
   boolean / "top"

:aspect:`Description`
   If set, a button "Save and create new" will appear in TCEFORMs.

   Note it is possible to set this for single tables using `options.saveDocNew.[tableName]`.
   Any value set for a single table will override the default value set for "saveDocNew".

:aspect:`Default`
   1

:aspect:`Example`
   In this example the button is disabled for all tables, except
   tt\_content where it will appear, and in addition create the records
   in the top of the page (default is after instead of top).

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/user.tsconfig

      options.saveDocNew = 0
      options.saveDocNew.tt_content = top


.. index:: Buttons; Save and view
.. _useroptions-saveDocView:

saveDocView
-----------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, a button "Save and view" will appear in TCEFORMs.

   Note it is possible to set this for single tables using `options.saveDocView.[tableName]`.
   Any value set for a single table will override the default value set for "saveDocView".

:aspect:`Default`
   1


.. index:: Buttons; Duplicate record
.. _useroptions-showDuplicate:

showDuplicate
-------------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, a button "Duplicate" will appear in TCEFORMs.

   Note that it is possible to set this for single tables using :typoscript:`options.showDuplicate.[tableName]`.
   Any value set for a single table will override the default value set for :typoscript:`saveDocView`.

:aspect:`Default`
   0


.. index:: Buttons; History of record
.. _useroptions-showHistory:

showHistory
-----------

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Shows link to the history for the record in TCEFORMs.

   Note it is possible to set this for single tables using `options.showHistory.[tableName]`.
   Any value set for a single table will override the default value set for "showHistory".


