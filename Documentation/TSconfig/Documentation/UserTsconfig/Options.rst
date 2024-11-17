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

..  confval-menu::
    :name: confval-group-1
    :display: table
    :type:
    :Default:

    ..  _useroptions-additionalPreviewLanguages:

    ..  confval:: additionalPreviewLanguages
        :name: useroptions-additionalPreviewLanguages
        :type: list of sys_language IDs

        ..  todo:: How does this work with site configurations?

        The user will see these additional languages when localizing stuff in
        TCEforms. The list are IDs of site languages, as defined in the
        :yaml:`languageId` property of the
        :ref:`site configuration <t3coreapi:sitehandling-addingLanguages>`.


    ..  _useroptions-alertPopups:

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


    ..  _useroptions-bookmarkGroups:

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

    ..  confval:: clearCache
        :name: useroptions-clearCache

        ..  _useroptions-clearCache-all:

        ..  confval:: all
            :name: useroptions-clearCache-all
            :type: boolean
            :Default: 0
            :Path: options.clearCache.all

            This will allow a non-admin user to clear frontend and page-related caches,
            plus some backend-related caches (that is everything including templates);
            if it is explicitly set to 0 for an admin user, it will remove the clear all
            option on toolbar for that user.

        ..  _useroptions-clearCache-pages:

        ..  confval:: pages
            :name: useroptions-clearCache-pages
            :type: boolean
            :Default: 0
            :Path: options.clearCache.pages

            If set to 1, this will allow a non-admin user to clear frontend and
            page-related caches.

    ..  _useroptions-clipboardNumberPads:

    ..  confval:: clipboardNumberPads
        :name: useroptions-clipboardNumberPads
        :type: integer (0-20)
        :Default: 3

        This allows you to enter how many pads you want on the clipboard.

    ..  _useroptions-contextMenu-key-disableItems:

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

    ..  _useroptions-dashboard:

    ..  confval:: dashboard
        :name: useroptions-dashboard

        ..  _useroptions-dashboard-dashboardPresetsForNewUsers:

        ..  confval:: dashboardPresetsForNewUsers
            :name: useroptions-dashboard-dashboardPresetsForNewUsers
            :type: list of dashboard identifiers
            :Default: default
            :Path: options.dashboard.dashboardPresetsForNewUsers

            List of dashboard identifiers to be used on initial dashboard module access.

            Example:

            ..  code-block:: typoscript
                :caption: EXT:site_package/Configuration/user.tsconfig

                options.dashboard.dashboardPresetsForNewUsers := addToList(customDashboard)

    ..  _useroptions-defaultResourcesViewMode:

    ..  confval:: defaultResourcesViewMode
        :name: useroptions-defaultResourcesViewMode
        :type: `list` or `tiles`
        :Default: `tiles`

        The option :typoscript:`options.defaultResourcesViewMode` has
        been introduced, which allows to define the initial display mode. Valid
        values are therefore `list` and `tiles`, e.g.:

        The listing of resources in the TYPO3 Backend, e.g. in the
        :guilabel:`File > Filelist` module or the `FileBrowser` can be changed
        between `list` and `tiles`. TYPO3 serves by default `tiles`, if the user
        has not already made a choice.

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/user.tsconfig

            options.defaultResourcesViewMode = list

    ..  _useroptions-defaultUploadFolder:

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

    ..  _useroptions-disableDelete:

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

    ..  _useroptions-dontMountAdminMounts:

    ..  confval:: dontMountAdminMounts
        :name: useroptions-dontMountAdminMounts
        :type: boolean

        This options prevents the root to be mounted for an admin user.

        ..  note::
            Only for admin users. For other users it has no effect.

    ..  _useroptions-enableBookmarks:

    ..  confval:: enableBookmarks
        :name: useroptions-enableBookmarks
        :type: boolean
        :Default: 1

        Enables the usage of bookmarks in the backend.

    ..  _useroptions-file_list:

    ..  confval:: file_list
        :name: useroptions-file_list

        ..  _useroptions-file_list-enableClipBoard:

        ..  confval:: enableClipBoard
            :name: useroptions-enableClipBoard
            :type: list of keywords
            :Default: selectable
            :Path: options.file_list.enableClipBoard

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

        ..  _useroptions-file_list-displayColumnSelector:

        ..  confval:: displayColumnSelector
            :name: useroptions-file_list-displayColumnSelector
            :type: boolean
            :Default: true
            :Path: options.file_list.displayColumnSelector

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

        ..  _useroptions-file_list-enableDisplayThumbnails:

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

        ..  _useroptions-file_list-filesPerPage:

        ..  confval:: filesPerPage
            :name: useroptions-file_list-filesPerPage
            :type: integer
            :Default: 40
            :Path: options.file_list.filesPerPage

            The maximum number of files shown per page in the :guilabel:`File > List`
            module.

        ..  _useroptions-file_list-primaryActions:


        ..  confval:: primaryActions
            :name: useroptions-useroptions-file_list-primaryActions
            :type: string
            :Default: :typoscript:`view,metadata,translations,delete`
            :Path: options.file_list.primaryActions

            Option to add more primary actions to the list view,
            which are otherwise only accessible through the "..." menu in the file list
            module.

            The list of actions to be displayed can be given in the TSConfig of
            the backend user. The actions that can be set are

            *   :typoscript:`copy`
            *   :typoscript:`cut`
            *   :typoscript:`delete`
            *   :typoscript:`download`
            *   :typoscript:`edit`
            *   :typoscript:`info`
            *   :typoscript:`metadata`
            *   :typoscript:`paste`
            *   :typoscript:`rename`
            *   :typoscript:`replace`
            *   :typoscript:`translations` (always active)
            *   :typoscript:`updateOnlineMedia`
            *   :typoscript:`upload`
            *   :typoscript:`view`

            Example:

            ..  code-block:: tsconfig
                :caption: EXT:site_package/Configuration/user.tsconfig

                # This will add "copy", "cut" and "replace" buttons in addition to the three default
                # buttons. "translations" can be omitted, as it will be added by default,
                # if a TYPO3 site is set up multilingual.
                options.file_list.primaryActions = view,metadata,delete,copy,cut,replace

            ..  figure:: /Images/ManualScreenshots/List/FileListPrimaryActions.png
                :alt: Show primary action with additional copy, cut and replace buttons
                :class: with-shadow

                See option `primaryActions` with three default buttons and the three
                additional buttons "copy", "cut" and "replace". As there is no TYPO3
                site set up multilingual the button "translations" is not rendered in
                that TYPO3 environment.

        ..  _useroptions-file_list-thumbnail-height:

        ..  confval:: thumbnail.height
            :name: useroptions-file_list-thumbnail-height
            :type: integer
            :Default: 64
            :Path: options.file_list.thumbnail.height

            All preview images in the file list will be rendered with the configured
            thumbnail height.

        ..  _useroptions-file_list-thumbnail-width:

        ..  confval:: thumbnail.width
            :name: useroptions-file_list-thumbnail-width
            :type: integer
            :Default: 64
            :Path: options.file_list.thumbnail.width

            All preview images in the file list will be rendered with the configured
            thumbnail width.

        ..  _useroptions-file_list-uploader-defaultaction:

        ..  confval:: uploader.defaultAction
            :name: useroptions-file_list-uploader-defaultaction
            :type: string
            :Default: :typoscript:`Cancel`
            :Path: options.file_list.uploader.defaultAction

            Default action for the modal that appears when during file upload a name
            collision occurs. Possible values:

            :typoscript:`cancel`
                Abort the action.

            :typoscript:`rename`
                Append the file name with a numerical index.

            :typoscript:`replace`
                Override the file with the uploaded one.

    ..  confval:: folderTree
        :name: useroptions-folderTree

        ..  _useroptions-folderTree-altElementBrowserMountPoints:

        ..  confval:: altElementBrowserMountPoints
            :name: useroptions-folderTree-altElementBrowserMountPoints
            :type: list of "storageUid:folderName" items
            :Path: options.folderTree.altElementBrowserMountPoints

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

        ..  _useroptions-folderTree-uploadFieldsInLinkBrowser:

        ..  confval:: uploadFieldsInLinkBrowser
            :name: useroptions-folderTree-uploadFieldsInLinkBrowser
            :type: integer
            :Default: 3
            :Path: options.folderTree.uploadFieldsInLinkBrowser

            This value defines the number of upload fields in the element browser.
            Default value is 3, if set to 0, no upload form will be shown.

    ..  _useroptions-hideModules:

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

    ..  confval:: hideRecords

        ..  _useroptions-hideRecords-pages:

        ..  confval:: pages
            :name: useroptions-hideRecords-pages
            :type: list of page IDs
            :Path: options.hideRecords.pages

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

    ..  confval:: impexp
        :name: useroptions-impexp

        ..  _useroptions-impexp-enableExportForNonAdminUser:

        ..  confval:: enableExportForNonAdminUser
            :name: useroptions-impexp-enableExportForNonAdminUser
            :type: boolean
            :Default: 0
            :Path: options.impexp.enableExportForNonAdminUser

            ..  note::
                This option was introduced to avoid `information disclosure
                <https://typo3.org/security/advisory/typo3-core-sa-2022-001>`__.

            The import/export module of `EXT:impexp` is disabled by default for
            non-admin users. Enable this option, if non-admin users need to use the
            module and export data. This should only be enabled for trustworthy
            backend users, as it might impose a security risk.

        ..  _useroptions-impexp-enableImportForNonAdminUser:

        ..  confval:: enableImportForNonAdminUser
            :name: useroptions-impexp-enableImportForNonAdminUser
            :type: boolean
            :Default: 0
            :Path: options.impexp.enableImportForNonAdminUser

            ..  note::
                This option was introduced to avoid `information disclosure <https://typo3.org/article/typo3-core-sa-2016-015>`__.

            The import/export module of `EXT:impexp` is disabled by default for
            non-admin users. Enable this option, if non-admin users need to use the
            module and import data. This should only be enabled for trustworthy
            backend users, as it might impose a security risk.

    ..  _useroptions-mayNotCreateEditBookmarks:

    ..  confval:: mayNotCreateEditBookmarks
        :name: useroptions-mayNotCreateEditBookmarks
        :type: boolean

        If set, the user can not create or edit bookmarks.


    ..  _useroptions-noThumbsInEB:

    ..  confval:: noThumbsInEB
        :name: useroptions-noThumbsInEB
        :type: boolean

        If set, then image thumbnails are not shown in the element browser.

    ..  _useroptions-overridePageModule:


    ..  _useroptions-pageTree:

    ..  confval:: pageTree
        :name: useroptions-pageTree

        ..  confval:: overridePageModule
            :name: useroptions-pageTree-overridePageModule

            ..  versionchanged:: 13.0
                This setting has been removed.

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

        ..  _useroptions-pageTree-altElementBrowserMountPoints:

        ..  confval:: altElementBrowserMountPoints
            :name: useroptions-pageTree-altElementBrowserMountPoints
            :type: list of integers
            :Path: options.pageTree.altElementBrowserMountPoints

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


        ..  _useroptions-pageTree-altElementBrowserMountPoints-append:

        ..  confval:: altElementBrowserMountPoints.append
            :name: useroptions-pageTree-altElementBrowserMountPoints-append
            :type: boolean
            :Path: options.pageTree.altElementBrowserMountPoints.append

            This option allows administrators to add additional mount points
            in the RTE and the wizard element browser instead of replacing
            the configured database mount points of the user when using the
            existing user TSconfig option.

            Example:

            ..  code-block:: typoscript
                :caption: EXT:site_package/Configuration/user.tsconfig

                options.pageTree.altElementBrowserMountPoints = 34,123
                options.pageTree.altElementBrowserMountPoints.append = 1

        ..  _useroptions-pageTree-doktypesToShowInNewPageDragArea:

        ..  confval:: doktypesToShowInNewPageDragArea
            :name: useroptions-pageTree-doktypesToShowInNewPageDragArea
            :type: string
            :Default: 1,6,4,7,3,254,255,199
            :Path: options.pageTree.doktypesToShowInNewPageDragArea

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

        ..  _useroptions-pageTree-excludeDoktypes:

        ..  confval:: excludeDoktypes
            :name: useroptions-pageTree-excludeDoktypes
            :type: list of integers
            :Path: options.pageTree.excludeDoktypes

            Excludes nodes (pages) with one of the defined
            :ref:`doktypes <t3coreapi:list-of-page-types>` from the page tree.
            Can be used, for example, for hiding
            :ref:`custom doktypes <t3coreapi:page-types-example>`.

            Example:

            ..  code-block:: typoscript
                :caption: EXT:site_package/Configuration/user.tsconfig

                options.pageTree.excludeDoktypes = 254,1

        ..  _useroptions-pageTree-label:

        ..  confval:: label.<page-id>
            :name: useroptions-pageTree-label
            :type: list of page IDs
            :Path: options.pageTree.label.<page-id>

            ..  versionadded:: 13.1
                This setting is the successor of the removed
                :ref:`t3tsconfig/13:useroptions-pageTree-backgroundColor`.

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
        ..  _useroptions-pageTree-showDomainNameWithTitle:

        ..  confval:: showDomainNameWithTitle
            :name: useroptions-pageTree-showDomainNameWithTitle
            :type: boolean
            :Path: options.pageTree.showDomainNameWithTitle

            If set, the domain name will be appended to the page title for
            pages that have :guilabel:`Is root of web site?` checked in the page properties.
            Useful if there are several domains in one page tree.


        ..  _useroptions-pageTree-showNavTitle:

        ..  confval:: showNavTitle
            :name: useroptions-pageTree-showNavTitle
            :type: boolean
            :Path: options.pageTree.showNavTitle

            If set, the navigation title is displayed in the page navigation tree
            instead of the normal page title. The page title is shown in a
            tooltip if the mouse hovers the navigation title.


        ..  _useroptions-pageTree-showPageIdWithTitle:

        ..  confval:: showPageIdWithTitle
            :name: useroptions-pageTree-showPageIdWithTitle
            :type: boolean
            :Path: options.pageTree.showPageIdWithTitle

            If set, the titles in the page tree will have their ID numbers printed
            before the title.


        ..  _useroptions-pageTree-showPathAboveMounts:

        ..  confval:: showPathAboveMounts
            :name: useroptions-pageTree-showPathAboveMounts
            :type: boolean
            :Path: options.pageTree.showPathAboveMounts

            If set, the user db mount path above the mount itself is shown.
            This is useful if you work a lot with user db mounts.

            ..  figure:: /Images/ManualScreenshots/List/PanelUserDB.png
                :alt: Active user db mount
                :class: with-shadow

                Active user db mount

    ..  _useroptions-passwordReset:

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

    ..  _useroptions-saveClipboard:

    ..  confval:: saveClipboard
        :name: useroptions-saveClipboard
        :type: boolean

        If set, the clipboard content will be preserved for the next login.
        Normally the clipboard content lasts only during the session.


    ..  _useroptions-saveDocNew:

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

    ..  _useroptions-saveDocView:

    ..  confval:: saveDocView
        :name: useroptions-saveDocView
        :type: boolean
        :Default: 1

        If set, a button :guilabel:`Save and view` will appear in TCEFORMs.

        Note, it is possible to set this for single tables using
        :typoscript:`options.saveDocView.[tableName]`.
        Any value set for a single table will override the default value set for
        :typoscript:`saveDocView`.

    ..  _useroptions-showDuplicate:

    ..  confval:: showDuplicate
        :name: useroptions-showDuplicate
        :type: boolean
        :Default: 0

        If set, a button :guilabel:`Duplicate` will appear in TCEFORMs.

        Note, that it is possible to set this for single tables using
        :typoscript:`options.showDuplicate.[tableName]`.
        Any value set for a single table will override the default value set for
        :typoscript:`showDuplicate`.


    ..  _useroptions-showHistory:

    ..  confval:: showHistory
        :name: useroptions-showHistory
        :type: boolean

        Shows link to the history for the record in TCEFORMs.

        Note, it is possible to set this for single tables using
        :typoscript:`options.showHistory.[tableName]`.
        Any value set for a single table will override the default value set for
        :typoscript:`showHistory`.
