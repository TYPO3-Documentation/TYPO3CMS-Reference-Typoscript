.. include:: ../../Includes.txt

.. _useroptions:

=======
OPTIONS
=======

Various options for the user affecting the core at various points.


.. ### BEGIN~OF~TABLE ###

.. _useroptions-dontMountAdminMounts:

dontMountAdminMounts
====================

.. container:: table-row

   Property
         dontMountAdminMounts

   Data type
         boolean

   Description
         This options prevents the root to be mounted for an admin user.

         .. note::

            Only for admin-users. For other users it has no effect.

.. _useroptions-defaultUploadFolder:

defaultUploadFolder
===================

.. container:: table-row

   Property
         defaultUploadFolder

   Data type
         string

   Description
         When a user uploads files they are stored in the default upload folder
         of the first file storage that user may access. The folder is used for
         RTE and its magic images, as well as uploads in the TCEforms fields.
         In general, this will be :file:`fileadmin/user_upload`.

         With this property it is possible to set a specific upload folder.

         The syntax is "storage_uid:file_path". Example:

         .. code-block:: typoscript

            options.defaultUploadFolder = 2:user_folders/my_folder/


.. _useroptions-RTEkeyList:

RTEkeyList
==========

.. container:: table-row

   Property
         RTEkeyList

   Data type
         *(list of keywords)*

   Description
         This is a list of the Rich Text Editor buttons the user may see
         displayed. The user will not see any buttons not listed here.

         Either enter a comma-separated list of button keywords (see "TYPO3
         Core API / RTE section") or set a wildcard "\*" to show all.

   Default
         \*


.. _useroptions-clearCache-pages:

clearCache.pages
================

.. container:: table-row

   Property
         clearCache.pages

   Data type
         boolean

   Description
         This will allow a non-admin user to clear frontend and page-related caches.

   Default
         0

.. _useroptions-clearCache-system:

clearCache.system
=================

.. container:: table-row

   Property
         clearCache.system

   Data type
         boolean

   Description
         This will allow a non-admin user to clear frontend and page-related caches, plus some
         backend-related caches (that is everything including templates). This property is equivalent to clearCache.all.

   Default
         0

.. _useroptions-clearCache-all:

clearCache.all
==============

.. container:: table-row

   Property
         clearCache.all

   Data type
         boolean

   Description
         This will allow a non-admin user to clear frontend and page-related caches, plus some
         backend-related caches (that is everything including templates).

   Default
         0

.. _useroptions-lockToIP:

lockToIP
========

.. container:: table-row

   Property
         lockToIP

   Data type
         string

   Description
         List of IP-numbers with wildcards.

         .. note::

            This option is enabled only if the
            :php:`$TYPO3_CONF_VARS['BE']['enabledBeUserIPLock']`
            configuration is true.

         **Examples:**

         192.168.\*.\*

         \- will allow all from 192.168-network

         192.168.\*.\*, 212.22.33.44

         \- will allow all from 192.168-network plus all from REMOTE\_ADDR
         212.22.33.44

         192.168, 212.22.33.44

         \- the same as the previous. Leaving out parts of the IP address is
         the same as wild cards...


.. _useroptions-saveClipboard:

saveClipboard
=============

.. container:: table-row

   Property
         saveClipboard

   Data type
         boolean

   Description
         If set, the clipboard content will be preserved for the next login.
         Normally the clipboard content lasts only during the session.


.. _useroptions-clipboardNumberPads:

clipboardNumberPads
===================

.. container:: table-row

   Property
         clipboardNumberPads

   Data type
         integer (0-20)

   Description
         This allows you to enter how many pads you want on the clipboard.

   Default
         3



.. _useroptions-enableBookmarks:

enableBookmarks
===============

.. container:: table-row

   Property
         enableBookmarks

   Data type
         boolean

   Description
         Enables the usage of bookmarks in the backend.

   Default
         1


.. _useroptions-bookmarkGroups:

bookmarkGroups
==============

.. container:: table-row

   Property
         bookmarkGroups

   Data type
         Array of integers/ strings

   Description
         Set groups of bookmarks that can be accessed by the user.

         By default, 5 default groups will be defined globally (shared, can
         only be set by admins) and also for each user (personal bookmarks):

         1. Pages

         2. Records

         3. Files

         4. Tools

         5. Miscellaneous

         Set 0 to disable one of these group IDs, 1 to enable it (this is the
         default) or "string" to change the label accordingly.

         **Example:**

         .. code-block:: typoscript

            bookmarkGroups {
               1=1
               2=My Group
               3=0
               4=
            }

         Bookmark group 1 is loaded with the default label (Pages), group 2 is
         loaded and labeled as "My Group" and groups 3 and 4 are disabled.
         Group 5 has not been set, so it will be displayed by default, just
         like group 1.


.. _useroptions-mayNotCreateEditBookmarks:

mayNotCreateEditBookmarks
=========================

.. container:: table-row

   Property
         mayNotCreateEditBookmarks

   Data type
         boolean

   Description
         If set, the user cannot create or edit bookmarks.


.. _useroptions-createFoldersInEB:

createFoldersInEB
=================

.. container:: table-row

   Property
         createFoldersInEB

   Data type
         boolean

   Description
         If set, a createFolders option appears in the element browser (for
         admin-users this is always enabled).


.. _useroptions-noThumbsInEB:

noThumbsInEB
============

.. container:: table-row

   Property
         noThumbsInEB

   Data type
         boolean

   Description
         If set, then image thumbnails are not shown in the element browser.


.. _useroptions-popupWindowSize:

popupWindowSize
===============

.. container:: table-row

   Property
         popupWindowSize

   Data type
         string

   Description
         Defines the size of the element browser.


.. _useroptions-noThumbsInRTEimageSelect:

noThumbsInRTEimageSelect
========================

.. container:: table-row

   Property
         noThumbsInRTEimageSelect

   Data type
         boolean

   Description
         As :ts:`noThumbsInEB` but for the Rich Text Editor image selector.


.. _useroptions-uploadFieldsInTopOfEB:

uploadFieldsInTopOfEB
=====================

.. container:: table-row

   Property
         uploadFieldsInTopOfEB

   Data type
         boolean

   Description
         If set, the upload-fields in the element browser are put in the top of
         the window.


.. _useroptions-saveDocNew:

saveDocNew
==========

.. container:: table-row

   Property
         saveDocNew

         saveDocNew.[table]

   Data type
         boolean / "top"

   Description
         If set, a button "Save and create new" will appear in TCEFORMs.

         Any value set for a single table will override the default value set
         to the object "saveDocNew".

         **Example:**

         In this example the button is disabled for all tables, except
         tt\_content where it will appear, and in addition create the records
         in the top of the page (default is after instead of top).

         .. code-block:: typoscript

            options.saveDocNew = 0
            options.saveDocNew.tt_content = top


.. _useroptions-saveDocView:

saveDocView
===========

.. container:: table-row

   Property
         saveDocView

         saveDocView.[table]

   Data type
         boolean

   Description
         If set, a button "Save and view" will appear in TCEFORMs.

         Any value set for a single table will override the default value set
         to the object "saveDocView".

   Default
         1


.. _useroptions-disableDelete:

disableDelete
=============

.. container:: table-row

   Property
         disableDelete

         disableDelete.[table]

   Data type
         boolean

   Description
         Disables the "Delete" button in TCEFORMs.

         Overriding for single tables works like "saveDocNew" above.


.. _useroptions-showHistory:

showHistory
===========

.. container:: table-row

   Property
         showHistory

         showHistory.[table]

   Data type
         boolean

   Description
         Shows link to the history for the record in TCEFORMs.

         Overriding for single tables works like "saveDocNew" above.


.. _useroptions-pageTree-backgroundColor:

pageTree.backgroundColor
========================

.. container:: table-row

   Property
         pageTree.backgroundColor

   Data type
         string

   Description
         Set background colors for tree branches.

         Color can be any valid CSS color value. The best results can be
         achieved by using rgba values.

         The syntax is: options.pageTree.backgroundColor.<pageId> = <color>

         **Examples:**

         .. code-block:: typoscript

            options.pageTree.backgroundColor.2 = red
            options.pageTree.backgroundColor.3 = #00FFFF
            options.pageTree.backgroundColor.4 = rgba(0, 255, 0, 0.1)

         .. figure:: ../../Images/optionsPageTreeBackgroundColor.png
            :alt: Tree branches with configured background colors

            Tree branches with configured background colors


.. _useroptions-pageTree-disableIconLinkToContextmenu:

pageTree.disableIconLinkToContextmenu
=====================================

.. container:: table-row

   Property
         pageTree.disableIconLinkToContextmenu

         folderTree.disableIconLinkToContextmenu

   Data type
         boolean / "titlelink"

   Description
         If set, the page/folder-icons in the page/folder tree will not
         activate the clickmenu.

         If the value is set "titlelink" then the icon will instead be wrapped
         with the same link as the title.


.. _useroptions-pageTree-disableTitleHighlight:

pageTree.disableTitleHighlight
==============================

.. container:: table-row

   Property
         pageTree.disableTitleHighlight

   Data type
         boolean

   Description
         If set, the page titles in the page tree will not be highlighted when
         clicked.


.. _useroptions-pageTree-showPageIdWithTitle:

pageTree.showPageIdWithTitle
============================

.. container:: table-row

   Property
         pageTree.showPageIdWithTitle

   Data type
         boolean

   Description
         If set, the titles in the page navigation tree will have their ID
         numbers printed before the clickable title.


.. _useroptions-pageTree-showDomainNameWithTitle:

pageTree.showDomainNameWithTitle
================================

.. container:: table-row

   Property
         pageTree.showDomainNameWithTitle

   Data type
         boolean

   Description
         If set, the domain name will be appended to the page title for
         pages that have "Is root of web site?" checked in the page properties.
         Useful if there are several domains in one page tree.


.. _useroptions-pageTree-showNavTitle:

pageTree.showNavTitle
=====================

.. container:: table-row

   Property
         pageTree.showNavTitle

   Data type
         boolean

   Description
         If set, the navigation title is displayed in the page navigation tree
         instead of the normal page title. The page title is showed in a
         tooltip if the mouse hovers the navigation title.


.. _useroptions-pageTree-showPathAboveMounts:

pageTree.showPathAboveMounts
============================

.. container:: table-row

   Property
         pageTree.showPathAboveMounts

   Data type
         boolean

   Description
          If set, the user db mount path above the mount itself is shown.

          .. figure:: ../../Images/PanelUserDB.png
             :alt: Active user db mount

          This is useful if you work a lot with user db mounts.

.. _useroptions-pageTree-doktypesToShowInNewPageDragArea:

pageTree.doktypesToShowInNewPageDragArea
========================================

.. container:: table-row

   Property
         pageTree.doktypesToShowInNewPageDragArea

   Data type
         string

   Description
          If set, the node top panel feature can be configured by a comma-separated list.
          Each number stands for a doctype id that should be added to the node top panel.

          .. figure:: ../../Images/PanelNormal.png
             :alt: Top panel in normal mode

          .. figure:: ../../Images/PanelModified.png
             :alt: Top panel modified

   Default
         1,6,4,7,3,254,255,199


.. _useroptions-pageTree-hideFilter:

pageTree.hideFilter
===================

.. container:: table-row

   Property
         pageTree.hideFilter

   Data type
         boolean

   Description
         If set, the filter-box in the top of the page tree will be hidden.


.. _useroptions-pageTree-separateNotinmenuPages:

pageTree.separateNotinmenuPages
===============================

.. container:: table-row

   Property
         pageTree.separateNotinmenuPages

   Data type
         boolean

   Description
         If set, not in menu and special pages are separated in the page tree
         from standard pages.


.. _useroptions-pageTree-alphasortNotinmenuPages:

pageTree.alphasortNotinmenuPages
================================

.. container:: table-row

   Property
         pageTree.alphasortNotinmenuPages

   Data type
         boolean

   Description
         If set and pageTree.seperateNotinmenuPages = 1, separated pages are
         sorted alphabetically.


.. _useroptions-pageTree-altElementBrowserMountPoints:

pageTree.altElementBrowserMountPoints
=====================================

.. container:: table-row

   Property
         pageTree.altElementBrowserMountPoints

   Data type
         *(list of integers)*

   Description
         Sets alternative webmounts for use in the Element Browser. You
         separate page ids by a comma. Non-existing page ids are ignored. If
         you insert a non-integer it will evaluate to "0" (zero) and the root
         of the page tree is mounted. Effective in workspaces too.

         These alternative webmounts **replace** configured DB mount points
         unless you use the ``altElementBrowserMountPoints.append`` option
         described below.

         **Example**

         .. code-block:: typoscript

            options.pageTree.altElementBrowserMountPoints = 34,123


.. _useroptions-pageTree-altElementBrowserMountPoints-append:

pageTree.altElementBrowserMountPoints.append
============================================

.. container:: table-row

   Property
         pageTree.altElementBrowserMountPoints.append

   Data type
        boolean

   Description
         This option allows administrators to add additional mount points
         in the RTE and the Wizard element browser instead of replacing
         the configured database mount points of the user when using the
         existing UserTSconfig option.

         **Example**

         .. code-block:: typoscript

            options.pageTree.altElementBrowserMountPoints = 34,123
            options.pageTree.altElementBrowserMountPoints.append = 1


.. _useroptions-pageTree-excludeDoktypes:

pageTree.excludeDoktypes
========================

.. container:: table-row

   Property
         pageTree.excludeDoktypes

   Data type
         *(list of integers)*

   Description
         Excludes nodes (pages) with one of the defined doktypes from the
         pagetree. Can be used for example for hiding
         :ref:`custom doktypes <t3coreapi:page-types>`.

         **Example**

         .. code-block:: typoscript

            options.pageTree.excludeDoktypes = 254,1

.. _useroptions-pageTree-searchInAlias:

pageTree.searchInAlias
======================

.. container:: table-row

   Property
         pageTree.searchInAlias

   Data type
         boolean

   Description
         If set, the search in the pagetree (filter tree) also filters on the alias field.
         Contrary to filtered page titles the search result of alias fields will **not** be highlighted.

         **Example**

         Searching for ``my-`` now additionally returns also pages with these string in the alias field.

         .. figure:: ../../Images/optionsPageTreeSearchInAlias.png
            :alt: Filtering the pagetree for my- now additionally returns pages with matched alias fields.

.. _useroptions-folderTree-altElementBrowserMountPoints:

folderTree.altElementBrowserMountPoints
=======================================

.. container:: table-row

   Property
         folderTree.altElementBrowserMountPoints

   Data type
         *(list of folder names)*

   Description
         Sets alternative filemounts for use in the Element Browser. The
         folders you specify here must exist within the fileadmin/ folder. You
         separate folders by a comma. If a folder you specify does not exist it
         will not get mounted. Effective in workspaces too.

         The alternative filemounts are **added** to the existing filemounts.

         **Example**

         .. code-block:: typoscript

            options.folderTree.altElementBrowserMountPoints = _temp_/, templates


.. _useroptions-folderTree-uploadFieldsInLinkBrowser:

folderTree.uploadFieldsInLinkBrowser
====================================

.. container:: table-row

   Property
         folderTree.uploadFieldsInLinkBrowser

   Data type
         integer

   Description
         This value defines the number of upload fields in the element browser.
         Default value is 3, if set to 0, no upload form will be shown.

   Default
         3


.. _useroptions-folderTree-hideCreateFolder:

folderTree.hideCreateFolder
===========================

.. container:: table-row

   Property
         folderTree.hideCreateFolder

   Data type
         boolean

   Description
         If set, the user can't create new folders.

   Default
         false


.. _useroptions-contextMenu-key-disableItems:

contextMenu.[key].disableItems
==============================

.. container:: table-row

   Property
         contextMenu.[key].disableItems

   Data type
         *(list of items)*

   Description
         List of context menu ("clickmenu") items to disable.

         "key" points to which kind of icon that brings up the menu, and
         possible options are "pageTree", "pageList", "folderTree",
         "folderList". "page" and "folder" obviously point to either the Web or
         File main module. "Tree" and "List" points to whether the menu is
         activated from the page/folder tree or the listing of records/files.

         Items to disable are (for "page" type - that is database records):

         view,edit,hide,new,info,copy,cut,paste,delete,move\_wizard,

         history,perms,new\_wizard,hide,edit\_access,edit\_pageheader,db\_list,
         versioning,moreoptions

         Items to disable are (for "folder" type - that is files/folders):

         edit,upload,rename,new,info,copy,cut,paste,delete


.. _useroptions-contextMenu-options-leftIcons:

contextMenu.options.leftIcons
=============================

.. container:: table-row

   Property
         contextMenu.options.leftIcons

   Data type
         boolean

   Description
         If set, the icons in the clickmenu appear at the left side of the text
         instead of at the right side.

   Default
         1


.. _useroptions-contextMenu-options-clickMenuTimeOut:

contextMenu.options.clickMenuTimeOut
====================================

.. container:: table-row

   Property
         contextMenu.options.clickMenuTimeOut

   Data type
         integer (1-100)

   Description
         Number of seconds the click menu is visible in the top frame before it
         disappears by itself.

   Default
         5


.. _useroptions-contextMenu-options-alwaysShowClickMenuInTopFrame:

contextMenu.options.alwaysShowClickMenuInTopFrame
=================================================

.. container:: table-row

   Property
         contextMenu.options.alwaysShowClickMenuInTopFrame

   Data type
         boolean

   Description
         If set, then the clickmenu in the top frame is always shown. Default
         is that it is shown only if the pop-up menus are disabled by user or by
         browser.


.. _useroptions-overridePageModule:

overridePageModule
==================

.. container:: table-row

   Property
         overridePageModule

   Data type
         string

   Description
         By this value you can substitute the default "Web > Page" module key
         ("web\_layout") with another backend module key.

         **Example:**

         .. code-block:: typoscript

            options.overridePageModule = web_txtemplavoilaM1

            This will enable TemplaVoila page module as default page module.

.. container:: table-row

   Property
         hideModules.[module group]

   Data type
         *(list of module groups or modules)*

   Description
         Configure which module groups or modules should be hidden from
         the main menu.

         It is not an access restriction but makes defined modules invisible.
         That means in principle those modules can still be accessed
         if the rights allow.

         .. note::

            A list of all available module groups and modules can be found
            in in the backend module
            *SYSTEM -> Configuration -> $GLOBALS['TBE_MODULES'] (BE Modules)*

         **Example:**

         .. code-block:: typoscript

            # Hide module groups "file" + "help"
            options.hideModules = file, help

            # Hide module "func" and "info" from the "web" group
            options.hideModules.web := addToList(func,info)

            # Hide module BELogLog from "system" group
            options.hideModules.system = BelogLog

.. _useroptions-alertPopups:

alertPopups
===========

.. container:: table-row

   Property
         alertPopups

   Data type
         bitmask

   Description
         Configure which Javascript popup alerts have to be displayed and which
         not:

         1 – onTypeChange

         2 – copy / move / paste

         4 - delete

         8 – FE editing

         128 - other (not used yet)

   Default
         255 (show all warnings)


.. _useroptions-defaultFileUploads:

defaultFileUploads
==================

.. container:: table-row

   Property
         defaultFileUploads

   Data type
         integer

   Description
         Default number of file upload forms shown in the File->List module


.. _useroptions-hideRecords-table:

hideRecords.[table]
===================

.. container:: table-row

   Property
         hideRecords.[table]

   Data type
         *(list of record ids)*

   Description
         This hides records in the backend user interface. It is not an access

         restriction but makes defined records invisible. That means in
         principle

         those records can still be edited if the rights allow. This makes
         sense if a specialized module should be used only to edit those
         records.

         This option is currently implemented for pages only and has an effect
         in following places:

         \- Page tree navigation frame

         \- Web > List module

         \- New record wizard

         **Example:**

         .. code-block:: typoscript

            options.hideRecords.pages = 12,45


.. _useroptions-additionalPreviewLanguages:

additionalPreviewLanguages
==========================

.. container:: table-row

   Property
         additionalPreviewLanguages

   Data type
         *(list of sys\_language ids)*

   Description
         The user will see these additional languages when localizing stuff in
         TCEforms. The list are uid numbers of sys\_language records.


.. _useroptions-checkPageLanguageOverlay:

checkPageLanguageOverlay
========================

.. container:: table-row

   Property
         checkPageLanguageOverlay

   Data type
         boolean

   Description
         If set, localized fields in flexforms are shown only for languages
         which the current page is translated to.


.. _useroptions-view-languageOrder:

view.languageOrder
==================

.. container:: table-row

   Property
         view.languageOrder

   Data type
         *(list of sys\_language ids)*

   Description
         When a backend user clicks a view-page link in the backend (magnifying
         glass) the first language uid in this list which the user has access
         to edit will be added as the parameter "&L=[UID]" to the view-link.

         This is a useful setting for translators which primarily wish to see
         their translation when they click the view-links.

         **Example:**

         .. code-block:: typoscript

            options.view.languageOrder = 2,1


.. _useroptions-feedit-popupHeight:

feedit.popupHeight
==================

.. container:: table-row

   Property
         feedit.popupHeight

   Data type
         *integer*

   Description
         Sets the height of the popup window of feedit

         **Example:**

         .. code-block:: typoscript

            options.feedit.popupHeight = 700


.. _useroptions-feedit-popupWidth:

feedit.popupWidth
=================

.. container:: table-row

   Property
         feedit.popupWidth

   Data type
         *integer*

   Description
         Sets the width of the popup window of feedit

         **Example:**

         .. code-block:: typoscript

            options.feedit.popupWidth = 700


.. _useroptions-file_list-enableDisplayBigControlPanel:

file\_list.enableDisplayBigControlPanel
=======================================

.. container:: table-row

   Property
         file\_list.enableDisplayBigControlPanel

   Data type
         *(list of keywords)*

   Description
         Determines whether the checkbox "Extended view" in the filelist module
         is shown or hidden. If it is hidden, you can predefine it to be always
         activated or always deactivated.

         .. figure:: ../../Images/manual_html_704dc544.png
            :alt: Checkbox "Extended view" in the filelist module

         The following values are possible:

         \- activated: The option is activated and the checkbox is hidden.

         \- deactivated: The option is deactivated and the checkbox is hidden.

         \- selectable: The checkbox is shown so that the option can be
         selected by the user.

   Default
         selectable


.. _useroptions-file_list-enableDisplayThumbnails:

file\_list.enableDisplayThumbnails
==================================

.. container:: table-row

   Property
         file\_list.enableDisplayThumbnails

   Data type
         *(list of keywords)*

   Description
         Determines whether the checkbox "Display thumbnails" in the filelist
         module is shown or hidden. If it is hidden, you can predefine it to be
         always activated or always deactivated.

         The following values are possible:

         \- activated: The option is activated and the checkbox is hidden.

         \- deactivated: The option is deactivated and the checkbox is hidden.

         \- selectable: The checkbox is shown so that the option can be
         selected by the user.

   Default
         selectable


.. _useroptions-file_list-filesPerPage:

file\_list.filesPerPage
=======================

.. container:: table-row

   Property
         file\_list.filesPerPage

   Data type
         integer

   Description
         The maximum number of files shown per page in File > List

   Default
         40


.. _useroptions-file_list-enableClipBoard:

file\_list.enableClipBoard
==========================

.. container:: table-row

   Property
         file\_list.enableClipBoard

   Data type
         *(list of keywords)*

   Description
         Determines whether the checkbox "Show clipboard" in the filelist
         module is shown or hidden. If it is hidden, you can predefine it to be
         always activated or always deactivated.

         The following values are possible:

         \- activated: The option is activated and the checkbox is hidden.

         \- deactivated: The option is deactivated and the checkbox is hidden.

         \- selectable: The checkbox is shown so that the option can be
         selected by the user.

   Default
         selectable


.. ###### END~OF~TABLE ######
