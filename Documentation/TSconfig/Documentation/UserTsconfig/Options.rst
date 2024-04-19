..  include:: /Includes.rst.txt
..  index:: User TSconfig; Options
..  _useroptions:

=======
options
=======

Various options for the user affecting the Core at various points.

As an example, this enables the :guilabel:`Flush frontend caches` button in the
upper right toolbar cache menu for non-admin users:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    options.clearCache.pages = 1

..  _useroptions-properties:

Properties
==========

..  contents::
    :depth: 2
    :local:


..  todo:: How does this work with site configurations?
..  index:: Localization; preview languages
..  _useroptions-additionalPreviewLanguages:

additionalPreviewLanguages
--------------------------

..  confval:: additionalPreviewLanguages
    :name: useroptions-additionalPreviewLanguages
    :type: list of sys_language IDs

    The user will see these additional languages when localizing stuff in
    TCEforms. The list are IDs of site languages, as defined in the
    :yaml:`languageId` property of the
    :ref:`site configuration <t3coreapi:sitehandling-addingLanguages>`.


..  index:: Backend; Alert popups
..  _useroptions-alertPopups:

alertPopups
-----------

..  confval:: alertPopups
    :name: useroptions-alertPopups
    :type: bitmask
    :Default: 255 (show all warnings)

    Configure which Javascript popup alerts have to be displayed and which not:

    *   1 – onTypeChange
    *   2 – copy / move / paste
    *   4 – delete
    *   8 – FE editing
    *   128 – other (not used yet)


..  index:: Backend; Bookmark groups
..  _useroptions-bookmarkGroups:

bookmarkGroups
--------------

..  confval:: bookmarkGroups
    :name: useroptions-bookmarkGroups
    :type: Array of integers / strings

    Set groups of bookmarks that can be accessed by the user. This affects the
    bookmarks toolbar item in the top right of the backend.

    By default, 5 default groups will be defined globally (shared, can
    only be set by admins) and also for each user (personal bookmarks):

    1.  Pages
    2.  Records
    3.  Files
    4.  Tools
    5.  Miscellaneous

    Set 0 to disable one of these group IDs, 1 to enable it (this is the
    default) or "string" to change the label accordingly.

    Example:

    ..  code-block:: typoscript
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

    ..  versionadded:: 11.0

    Custom language labels can also be used instead of a fixed label:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        bookmarkGroups {
          2 = LLL:EXT:sitepackage/Resources/Private/Language/locallang_be.xlf:bookmarkGroups.2
        }

..  _useroptions-clearCache:

clearCache
----------

..  index:: Clear cache; Clear all button for non admins
..  _useroptions-clearCache-all:

clearCache.all
~~~~~~~~~~~~~~

..  confval:: clearCache.all
    :name: useroptions-clearCache-all
    :type: boolean
    :Default: 0


    This will allow a non-admin user to clear frontend and page-related caches,
    plus some backend-related caches (that is everything including templates);
    if it is explicitly set to 0 for an admin user, it will remove the clear all
    option on toolbar for that user.


..  index:: Clear cache; Clear pages button for non admins
..  _useroptions-clearCache-pages:

clearCache.pages
~~~~~~~~~~~~~~~~

..  confval:: clearCache.pages
    :name: useroptions-clearCache-pages
    :type: boolean
    :Default: 0

    If set to 1, this will allow a non-admin user to clear frontend and
    page-related caches.


..  index:: Clipboard; Number of pads
..  _useroptions-clipboardNumberPads:

clipboardNumberPads
-------------------

..  confval:: clipboardNumberPads
    :name: useroptions-clipboardNumberPads
    :type: integer (0-20)
    :Default: 3

    This allows you to enter how many pads you want on the clipboard.


..  index:: ContextMenu; Disable items
..  _useroptions-contextMenu-key-disableItems:

contextMenu disableItems
------------------------

..  confval:: contextMenu.table.[tableName][.context].disableItems
    :name: useroptions-contextMenu-key-disableItems
    :type: list of items

    List of :ref:`context menu <t3coreapi:context-menu>` ("clickmenu") items to
    disable.

    ..  figure:: /Images/ManualScreenshots/List/PagesContextMenu.png
        :alt: Context menu of the page tree
        :class: with-shadow

        Context menu of the page tree

    The :typoscript:`[tableName]` refers to the type of the record (database
    table name) the context menu is shown for, for example, :sql:`pages`,
    :sql:`sys_file`, :sql:`tt_content`, etc.

    The optional key :typoscript:`[.context]` refers to the place from which the
    context menu is triggered. The Core uses just one context called `tree` for
    context menus triggered from page tree and folder tree. This way you can
    disable certain options for one context, but keep them for another.

    Items to disable for "page" type are:

    *   :typoscript:`view`
    *   :typoscript:`edit`
    *   :typoscript:`new`
    *   :typoscript:`info`
    *   :typoscript:`copy`
    *   :typoscript:`copyRelease`
    *   :typoscript:`cut`
    *   :typoscript:`cutRelease`
    *   :typoscript:`pasteAfter`
    *   :typoscript:`pasteInto`
    *   :typoscript:`newWizard`
    *   :typoscript:`pagesSort`
    *   :typoscript:`pagesNewMultiple`
    *   :typoscript:`openListModule`
    *   :typoscript:`mountAsTreeRoot`
    *   :typoscript:`hideInMenus`
    *   :typoscript:`showInMenus`
    *   :typoscript:`permissions`
    *   :typoscript:`enable`
    *   :typoscript:`disable`
    *   :typoscript:`delete`
    *   :typoscript:`history`
    *   :typoscript:`clearCache`

    Items to disable for "sys_file" type (that is files/folders) are:

    *   :typoscript:`edit`
    *   :typoscript:`rename`
    *   :typoscript:`upload`
    *   :typoscript:`new`
    *   :typoscript:`info`
    *   :typoscript:`copy`
    *   :typoscript:`copyRelease`
    *   :typoscript:`cut`
    *   :typoscript:`cutRelease`
    *   :typoscript:`pasteInto`
    *   :typoscript:`delete`

    When the system extension Import/Export (EXT:impexp) is installed then two
    more options become available:

    *   :typoscript:`exportT3d`
    *   :typoscript:`importT3d`

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # Remove "New" and "Create New wizard" for pages context menu (list module)
        options.contextMenu.table.pages.disableItems = new,newWizard

        # Remove "New" and "Create New wizard" in page tree context menu
        options.contextMenu.table.pages.tree.disableItems = new,newWizard

        # Remove the "More options" item in the page tree context menu and all its subelements
        options.contextMenu.table.pages.tree.disableItems = newWizard, pagesSort, pagesNewMultiple, openListModule, mountAsTreeRoot, exportT3d, importT3d, hideInMenus, showInMenus, permissions


..  index:: Element browser; Create Folders
..  _useroptions-createFoldersInEB:

createFoldersInEB
-----------------

..  versionchanged:: 12.4
    With the :ref:`migration of the "Create folder" view into a separate modal <ext_core:feature-99191-1669906308>`
    used in EXT:filelist, which is based on the element browser as well, this
    option became useless and is not evaluated anymore.

..  _useroptions-dashboard:

dashboard
---------

..  index:: Dashboard; Presets
..  _useroptions-dashboard-dashboardPresetsForNewUsers:

dashboard.dashboardPresetsForNewUsers
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: dashboard.dashboardPresetsForNewUsers
    :name: useroptions-dashboard-dashboardPresetsForNewUsers
    :type: list of dashboard identifiers
    :Default: default

    List of dashboard identifiers to be used on initial dashboard module access.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.dashboard.dashboardPresetsForNewUsers := addToList(customDashboard)


..  index:: Upload folder; Default
..  _useroptions-defaultUploadFolder:

defaultUploadFolder
-------------------

..  confval:: defaultUploadFolder
    :name: useroptions-defaultUploadFolder
    :type: string

    When a user uploads files they are stored in the default upload folder
    of the first file storage that user may access. The folder is used for
    uploads in the TCEforms fields. In general, this will be
    :file:`fileadmin/user_upload/`.

    With this property it is possible to set a specific upload folder.

    The syntax is "storage_uid:file_path".

    ..  note::
        It is also possible to set a default upload folder for a page via
        :ref:`page TSconfig <pagedefaultuploadfolder>`.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.defaultUploadFolder = 2:user_folders/my_folder/


..  index:: Records; Delete disabled
..  _useroptions-disableDelete:

disableDelete
-------------

..  confval:: disableDelete
    :name: useroptions-disableDelete
    :type: boolean

    Disables the :guilabel:`Delete` button in TCEFORMs.

    Note, it is possible to set this for single tables using
    :typoscript:`options.disableDelete.<tableName>`. Any value set for a single
    table will override the default value set for :typoscript:`disableDelete`.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.disableDelete.tt_content = 1


..  index:: DB mounts; Hide root from admins
..  _useroptions-dontMountAdminMounts:

dontMountAdminMounts
--------------------

..  confval:: dontMountAdminMounts
    :name: useroptions-dontMountAdminMounts
    :type: boolean

    This options prevents the root to be mounted for an admin user.

    ..  note::
        Only for admin users. For other users it has no effect.


..  index:: Bookmarks; enable
..  _useroptions-enableBookmarks:

enableBookmarks
---------------

..  confval:: enableBookmarks
    :name: useroptions-enableBookmarks
    :type: boolean
    :Default: 1

    Enables the usage of bookmarks in the backend.


..  index:: File list

..  _useroptions-file_list:

file_list
---------

..  index:: File list; Clipboard enable
..  _useroptions-file_list-enableClipBoard:

file_list.enableClipBoard
~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.enableClipBoard
    :name: useroptions-enableClipBoard
    :type: list of keywords
    :Default: selectable

    Determines whether the checkbox :guilabel:`Show clipboard` in the file list
    module is shown or hidden. If it is hidden, you can predefine it to be
    always activated or always deactivated.

    The following values are possible:

    :typoscript:`activated`
        The option is activated and the checkbox is hidden.

    :typoscript:`deactivated`
        The option is deactivated and the checkbox is hidden.

    :typoscript:`selectable`
        The checkbox is shown so that the option can be selected by the user.


..  index:: File list; Column Selector
..  _useroptions-file_list-displayColumnSelector:

file_list.displayColumnSelector
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.displayColumnSelector
    :name: useroptions-file_list-displayColumnSelector
    :type: boolean
    :Default: true

    The column selector is enabled by default and can be disabled with this
    option. The column selector is displayed at the top of each file list.

    It can be used to manage the fields displayed for each file / folder,
    while containing convenience actions such as "filter", "check all / none"
    and "toggle selection".

    The fields to be selected are a combination of special fields, such as
    `references` or `read/write` permissions, the corresponding :sql:`sys_file`
    record fields, as well as all available :sql:`sys_file_metadata` fields.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # Disable the column selector
        file_list.displayColumnSelector = 0


..  index:: File list; Extended view enable
..  _useroptions-file_list-enableDisplayBigControlPanel:

file_list.enableDisplayBigControlPanel
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  versionchanged:: 11.3
    The checkbox :guilabel:`Extended view` was removed with TYPO3 v11.3.
    Therefore the option :typoscript:`file_list.enableDisplayBigControlPanel`
    has no effect anymore.


..  index:: File list; Thumbnails enable
..  _useroptions-file_list-enableDisplayThumbnails:

file_list.enableDisplayThumbnails
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.enableDisplayThumbnails
    :name: useroptions-file_list-enableDisplayThumbnails
    :type: list of keywords
    :Default: selectable

    Determines whether the checkbox :guilabel:`Display thumbnails` in the
    file list module is shown or hidden. If it is hidden, you can predefine it
    to be always activated or always deactivated.

    The following values are possible:

    :typoscript:`activated`
        The option is activated and the checkbox is hidden.

    :typoscript:`deactivated`
        The option is deactivated and the checkbox is hidden.

    :typoscript:`selectable`
        The checkbox is shown so that the option can be selected by the user.


..  index:: File list; Files per page
..  _useroptions-file_list-filesPerPage:

file_list.filesPerPage
~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.filesPerPage
    :name: useroptions-file_list-filesPerPage
    :type: integer
    :Default: 40

    The maximum number of files shown per page in the :guilabel:`File > List`
    module.


..  index::
    File list; Primary actions
    File list; Allowed actions
..  _useroptions-file_list-primaryActions:

file_list.primaryActions
~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.primaryActions
    :name: useroptions-useroptions-file_list-primaryActions
    :type: string
    :Default: :typoscript:`view,metadata,translations,delete`

    Option to add more primary actions to the list view.
    The list of actions to be displayed can be given in the TSConfig of
    the backend user. The actions that can be added are

    *   :typoscript:`view`
    *   :typoscript:`metadata`
    *   :typoscript:`delete`
    *   :typoscript:`copy`
    *   :typoscript:`cut`

    :typoscript:`translations` is always active.


..  index:: File list; Thumbnails height
..  _useroptions-file_list-thumbnail-height:

file_list.thumbnail.height
~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.thumbnail.height
    :name: useroptions-file_list-thumbnail-height
    :type: integer
    :Default: 64

    All preview images in the file list will be rendered with the configured
    thumbnail height.


..  index:: File list; Thumbnails width
..  _useroptions-file_list-thumbnail-width:

file_list.thumbnail.width
~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.thumbnail.width
    :name: useroptions-file_list-thumbnail-width
    :type: integer
    :Default: 64

    All preview images in the file list will be rendered with the configured
    thumbnail width.


..  index:: Uploader; Name collision default action
..  _useroptions-file_list-uploader-defaultaction:

file_list.uploader.defaultAction
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: file_list.uploader.defaultAction
    :name: useroptions-file_list-uploader-defaultaction
    :type: string
    :Default: :typoscript:`Cancel`

    Default action for the modal that appears when during file upload a name
    collision occurs. Possible values:

    :typoscript:`Cancel`
        Abort the action.

    :typoscript:`Rename`
        Append the file name with a numerical index.

    :typoscript:`Replace`
        Override the file with the uploaded one.


..  index:: Folder tree

folderTree
----------

..  index:: Folder tree; File mounts in element browser
..  _useroptions-folderTree-altElementBrowserMountPoints:

folderTree.altElementBrowserMountPoints
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: folderTree.altElementBrowserMountPoints
    :name: useroptions-folderTree-altElementBrowserMountPoints
    :type: list of "storageUid:folderName" items

    Sets alternative filemounts for use in any folder tree, including in the
    :guilabel:`File > List` module, in the element browser and in file
    selectors.

    Each item consists of storage UID followed by a colon
    and the folder name inside that storage. Separate multiple items by
    a comma.

    For backwards compatibility, defining only a folder name but no
    storage uid and colon prepended is still supported. Folders
    without a storage UID prepended are assumed to be located in the default
    storage, which by default is the :file:`fileadmin/` folder. If a folder
    you specify does not exist it will not get mounted.

    Settings this option is effective in
    :ref:`workspaces <t3coreapi:workspaces>` too.

    The alternative file mounts are added to the existing ones defined in
    the user or group configuration.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.folderTree.altElementBrowserMountPoints = _temp_/, 2:/templates, 1:/files/images


..  index:: Folder tree; Create folder; hide
..  _useroptions-folderTree-hideCreateFolder:

folderTree.hideCreateFolder
~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  versionchanged:: 12.4
    With the :ref:`migration of the "Create folder" view into a separate modal <ext_core:feature-99191-1669906308>`
    used in EXT:filelist, which is based on the element browser as well, this
    option became useless and is not evaluated anymore.


..  index::
    Uploader; File number
    Uploader; Hide
..  _useroptions-folderTree-uploadFieldsInLinkBrowser:

folderTree.uploadFieldsInLinkBrowser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: folderTree.uploadFieldsInLinkBrowser
    :name: useroptions-folderTree-uploadFieldsInLinkBrowser
    :type: integer
    :Default: 3

    This value defines the number of upload fields in the element browser.
    Default value is 3, if set to 0, no upload form will be shown.


..  index:: Modules; Hide
..  _useroptions-hideModules:

hideModules
-----------

..  versionchanged:: 12.0
    In TYPO3 versions before 12.0 the :typoscript:`hideModules` option was
    appended with the module group. This changed with the introduction of the
    new :ref:`module registration API <t3coreapi:backend-modules-configuration>`
    in TYPO3 v12. If you are using an older version of TYPO3 please use the
    version switcher on the top left of this document to go to the respective
    version.

..  confval:: hideModules
    :name: useroptions-hideModules
    :type: list of module groups or modules

    Configure which module groups or modules should be hidden from the main menu.

    ..  attention::
        It is not an access restriction but makes defined modules invisible.
        This means that in principle these modules can still be accessed if the
        rights allow this.

    ..  hint::
        A list of all available module groups and modules can be found in in the
        backend module :guilabel:`System > Configuration > Backend Modules`. The
        system extension "lowlevel" has to be available for accessing this list.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # Hide only module groups "file" and "help"
        options.hideModules = file, help

        # Hide additional modules "info" and "ts" from the "web" group
        options.hideModules := addToList(web_info, web_ts)

        # Hide only module BeLogLog from "system" group
        options.hideModules = system_BelogLog

..  _useroptions-hideRecords:

hideRecords
-----------

..  index:: Records; Hide on pages
..  _useroptions-hideRecords-pages:

hideRecords.pages
~~~~~~~~~~~~~~~~~

..  confval:: hideRecords.pages
    :name: useroptions-hideRecords-pages
    :type: list of page IDs

    This setting hides records in the backend user interface. It is not an
    access restriction but makes defined records invisible. That means in
    principle those records can still be edited if the user rights allow.
    This makes sense if only a specialized module should be used to edit those
    otherwise hidden records.

    This option is currently implemented for the pages table only and has an
    effect in the following places:

    *   Page tree navigation frame
    *   :guilabel:`Web > List` module
    *   New record wizard

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.hideRecords.pages = 12,45

..  _useroptions-impexp:

impexp
------

..  index:: Import export; Enable for non admins
..  _useroptions-impexp-enableExportForNonAdminUser:

impexp.enableExportForNonAdminUser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  versionadded:: 10.4.29/11.5.11
    This option was introduced to avoid `information disclosure
    <https://typo3.org/security/advisory/typo3-core-sa-2022-001>`__.

..  confval:: impexp.enableExportForNonAdminUser
    :name: useroptions-impexp-enableExportForNonAdminUser
    :type: boolean
    :Default: 0

    The import/export module of `EXT:impexp` is disabled by default for
    non-admin users. Enable this option, if non-admin users need to use the
    module and export data. This should only be enabled for trustworthy
    backend users, as it might impose a security risk.


..  index:: Import export; Enable for non admins
..  _useroptions-impexp-enableImportForNonAdminUser:

impexp.enableImportForNonAdminUser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This option was introduced to avoid `information disclosure
<https://typo3.org/article/typo3-core-sa-2016-015>`__.

..  confval:: impexp.enableImportForNonAdminUser
    :name: useroptions-impexp-enableImportForNonAdminUser
    :type: boolean
    :Default: 0

    The import/export module of `EXT:impexp` is disabled by default for
    non-admin users. Enable this option, if non-admin users need to use the
    module and import data. This should only be enabled for trustworthy
    backend users, as it might impose a security risk.


..  index:: Bookmarks; Create and delete disabled
..  _useroptions-mayNotCreateEditBookmarks:

mayNotCreateEditBookmarks
-------------------------

..  confval:: mayNotCreateEditBookmarks
    :name: useroptions-mayNotCreateEditBookmarks
    :type: boolean

    If set, the user can not create or edit bookmarks.


..  index::
    Thumbnails; Disable in element browser
    Element browser; Disable thumbnails
..  _useroptions-noThumbsInEB:

noThumbsInEB
------------

..  confval:: noThumbsInEB
    :name: useroptions-noThumbsInEB
    :type: boolean

    If set, then image thumbnails are not shown in the element browser.


..  _useroptions-overridePageModule:

overridePageModule
------------------

..  versionchanged:: 13.0
    This setting has been removed.

Migration
~~~~~~~~~

In order to replace the :guilabel:`Web > Page` module within a third-party
extension, such as TemplaVoila, it is possible to create a custom module entry
in an extension's :file:`Configuration/Backend/Modules.php` with the following
entry:

..  code-block:: php
    :caption: EXT:my_extension/Configuration/Backend/Modules.php

    return [
        'my_module' => [
            'parent' => 'web',
            'position' => ['before' => '*'],
            'access' => 'user',
            'aliases' => ['web_layout'],
            'path' => '/module/my_module',
            'iconIdentifier' => 'module-page',
            'labels' => 'LLL:EXT:backend/Resources/Private/Language/locallang_mod.xlf',
            'routes' => [
                '_default' => [
                    'target' => \MyVendor\MyExtension\Controller\MyController::class . '::mainAction',
                ],
            ],
        ],
    ];


..  index:: Page tree

..  _useroptions-pageTree:

pageTree
--------

..  index:: Page tree; Webmounts replace
..  _useroptions-pageTree-altElementBrowserMountPoints:

pageTree.altElementBrowserMountPoints
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.altElementBrowserMountPoints
    :name: useroptions-pageTree-altElementBrowserMountPoints
    :type: list of integers

    Sets alternative webmounts for use in the element browser. You
    separate page IDs by a comma. Non-existing page IDs are ignored. If
    you insert a non-integer it will evaluate to "0" (zero) and the root
    of the page tree is mounted. Effective in
    :ref:`workspaces <t3coreapi:workspaces>` too.

    These alternative webmounts **replace** configured DB mount points
    unless you use the
    :ref:`altElementBrowserMountPoints.append <useroptions-pageTree-altElementBrowserMountPoints-append>`
    option.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.pageTree.altElementBrowserMountPoints = 34,123


..  index:: Page tree; Webmounts append
..  _useroptions-pageTree-altElementBrowserMountPoints-append:

pageTree.altElementBrowserMountPoints.append
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.altElementBrowserMountPoints.append
    :name: useroptions-pageTree-altElementBrowserMountPoints-append
    :type: boolean

    This option allows administrators to add additional mount points
    in the RTE and the wizard element browser instead of replacing
    the configured database mount points of the user when using the
    existing user TSconfig option.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.pageTree.altElementBrowserMountPoints = 34,123
        options.pageTree.altElementBrowserMountPoints.append = 1


..  index:: Page tree; Background colors
..  _useroptions-pageTree-backgroundColor:

pageTree.backgroundColor
~~~~~~~~~~~~~~~~~~~~~~~~

..  deprecated:: 13.1
    This setting has been deprecated and will be removed in TYPO3 v14 due to its
    lack of accessibility. It is being replaced with a
    :ref:`new label system <useroptions-pageTree-label>` for tree nodes.

    In TYPO3 v13 the setting will be migrated to the new label system. Since the
    use case is unknown, the generated label will be "Color: <value>". This
    information will be displayed on all affected nodes.

..  confval:: pageTree.backgroundColor
    :name: useroptions-pageTree-backgroundColor
    :type: string

    Set background colors for tree branches.

    The color can be any valid CSS color value. The best results can be achieved
    by using RGBa values.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # The syntax is:
        # options.pageTree.backgroundColor.<pageId> = <color>
        options.pageTree.backgroundColor.147 = orange
        options.pageTree.backgroundColor.148 = #AFAFAF
        options.pageTree.backgroundColor.151 = rgba(0, 255, 0, 0.1)

    ..  figure:: /Images/ManualScreenshots/List/optionsPageTreeBackgroundColor.png
        :alt: Tree branches with configured background colors
        :class: with-shadow

        Tree branches with configured background colors


..  index:: Page tree; Doktypes for new pages
..  _useroptions-pageTree-doktypesToShowInNewPageDragArea:

pageTree.doktypesToShowInNewPageDragArea
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.doktypesToShowInNewPageDragArea
    :name: useroptions-pageTree-doktypesToShowInNewPageDragArea
    :type: string
    :Default: 1,6,4,7,3,254,255,199

    If set, the node top panel feature can be configured by a comma-separated
    list. Each number stands for a :ref:`doktype ID <t3coreapi:list-of-page-types>`
    that should be added to the node top panel.

    ..  figure:: /Images/ManualScreenshots/List/PanelNormal.png
        :alt: Top panel in normal mode
        :class: with-shadow

        Top panel in normal mode

    ..  figure:: /Images/ManualScreenshots/List/PanelModified.png
        :alt: Top panel modified
        :class: with-shadow

        Top panel modified


..  index:: Page tree; Exclude doktypes
..  _useroptions-pageTree-excludeDoktypes:

pageTree.excludeDoktypes
~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.excludeDoktypes
    :name: useroptions-pageTree-excludeDoktypes
    :type: list of integers

    Excludes nodes (pages) with one of the defined
    :ref:`doktypes <t3coreapi:list-of-page-types>` from the page tree.
    Can be used, for example, for hiding
    :ref:`custom doktypes <t3coreapi:page-types-example>`.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.pageTree.excludeDoktypes = 254,1


..  index:: Page tree; Node labels
..  _useroptions-pageTree-label:

pageTree.label
~~~~~~~~~~~~~~

..  versionadded:: 13.1
    This setting is the successor of :ref:`useroptions-pageTree-backgroundColor`.

..  confval:: pageTree.label.<page-id>
    :name: useroptions-pageTree-label
    :type: list of page IDs

    Labels offer customizable color markings for tree nodes and require an
    associated label for accessibility.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:my_extension/Configuration/user.tsconfig

        options.pageTree.label.296 {
          label = Campaign A
          color = #ff8700
        }

    Display:

    ..  figure:: /Images/ManualScreenshots/List/optionsPageTreeLabel.png
        :alt: Page with configured color and label
        :class: with-shadow

        Page with configured color and label

    ..  note::
        Only one label per page can be set through this method. Use the
        PSR-14 event :ref:`t3coreapi:AfterPageTreeItemsPreparedEvent` to assign
        multiple labels to a page.

..  todo:: does this still work with site configuration?
..  index:: Page tree; Show domain names
..  _useroptions-pageTree-showDomainNameWithTitle:

pageTree.showDomainNameWithTitle
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.showDomainNameWithTitle
    :name: useroptions-pageTree-showDomainNameWithTitle
    :type: boolean

    If set, the domain name will be appended to the page title for
    pages that have :guilabel:`Is root of web site?` checked in the page properties.
    Useful if there are several domains in one page tree.


..  index:: Page tree; Show navigation title
..  _useroptions-pageTree-showNavTitle:

pageTree.showNavTitle
~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.showNavTitle
    :name: useroptions-pageTree-showNavTitle
    :type: boolean

    If set, the navigation title is displayed in the page navigation tree
    instead of the normal page title. The page title is shown in a
    tooltip if the mouse hovers the navigation title.


..  index:: Page tree; Show page id
..  _useroptions-pageTree-showPageIdWithTitle:

pageTree.showPageIdWithTitle
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.showPageIdWithTitle
    :name: useroptions-pageTree-showPageIdWithTitle
    :type: boolean

    If set, the titles in the page tree will have their ID numbers printed
    before the title.


..  index:: Page tree; Show path above mounts
..  _useroptions-pageTree-showPathAboveMounts:

pageTree.showPathAboveMounts
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: pageTree.showPathAboveMounts
    :name: useroptions-pageTree-showPathAboveMounts
    :type: boolean

    If set, the user db mount path above the mount itself is shown.
    This is useful if you work a lot with user db mounts.

    ..  figure:: /Images/ManualScreenshots/List/PanelUserDB.png
        :alt: Active user db mount
        :class: with-shadow

        Active user db mount


..  index:: Password; Reset
..  _useroptions-passwordReset:

passwordReset
-------------

..  confval:: passwordReset
    :name: useroptions-passwordReset
    :type: boolean
    :Default: 1

    If set to `0` the initiating of the password reset in the backend
    will be disabled. This does not affect the password reset by
    CLI command.

    To completely disable the password reset in the backend for all users, you
    can set the user TSconfig globally in your :file:`Configuration/user.tsconfig`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.passwordReset = 0

    If required, this setting can be overridden on a per user basis
    in the corresponding :guilabel:`TSconfig` field of the backend
    usergroup or user.

    The password reset functionality can also be disabled globally by setting:

    ..  code-block:: php
        :caption: config/system/settings.php | typo3conf/system/settings.php

        $GLOBALS['TYPO3_CONF_VARS']['BE']['passwordReset'] = false


..  index:: Clipboard; Save for next login
..  _useroptions-saveClipboard:

saveClipboard
-------------

..  confval:: saveClipboard
    :name: useroptions-saveClipboard
    :type: boolean

    If set, the clipboard content will be preserved for the next login.
    Normally the clipboard content lasts only during the session.


..  index:: Buttons; Save and create new
..  _useroptions-saveDocNew:

saveDocNew
----------

..  confval:: saveDocNew
    :name: useroptions-saveDocNew
    :type: boolean / "top"
    :Default: 1

    If set, a button :guilabel:`Save and create new` will appear in TCEFORMs.

    Note, it is possible to set this for single tables using
    :typoscript:`options.saveDocNew.[tableName]`.
    Any value set for a single table will override the default value set for
    :typoscript:`saveDocNew`.

    Example:

    In this example the button is disabled for all tables, except
    :sql:`tt_content` where it will appear, and in addition create the records
    in the top of the page (default is after instead of top).

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        options.saveDocNew = 0
        options.saveDocNew.tt_content = top


..  index:: Buttons; Save and view
..  _useroptions-saveDocView:

saveDocView
-----------

..  confval:: saveDocView
    :name: useroptions-saveDocView
    :type: boolean
    :Default: 1

    If set, a button :guilabel:`Save and view` will appear in TCEFORMs.

    Note, it is possible to set this for single tables using
    :typoscript:`options.saveDocView.[tableName]`.
    Any value set for a single table will override the default value set for
    :typoscript:`saveDocView`.


..  index:: Buttons; Duplicate record
..  _useroptions-showDuplicate:

showDuplicate
-------------

..  confval:: showDuplicate
    :name: useroptions-showDuplicate
    :type: boolean
    :Default: 0

    If set, a button :guilabel:`Duplicate` will appear in TCEFORMs.

    Note, that it is possible to set this for single tables using
    :typoscript:`options.showDuplicate.[tableName]`.
    Any value set for a single table will override the default value set for
    :typoscript:`showDuplicate`.


..  index:: Buttons; History of record
..  _useroptions-showHistory:

showHistory
-----------

..  confval:: showHistory
    :name: useroptions-showHistory
    :type: boolean

    Shows link to the history for the record in TCEFORMs.

    Note, it is possible to set this for single tables using
    :typoscript:`options.showHistory.[tableName]`.
    Any value set for a single table will override the default value set for
    :typoscript:`showHistory`.
