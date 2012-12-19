.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


->OPTIONS
^^^^^^^^^

Various options for the user affecting the core at various points.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         dontMountAdminMounts

   Data type
         boolean

   Description
         This options prevents the root to be mounted for an admin user.

         **NOTE:** Only for admin-users. For other users it has no effect.


.. container:: table-row

   Property
         RTEkeyList

   Data type
         *(list of keywords)*

   Description
         This is a list of the Rich Text Editor buttons the user may see
         displayed. The user will not see any buttons not listed here.

         Either enter a comma list of button keywords (see "TYPO3 Core API /
         RTE section") or specify all with a wildcard "\*" for everything.

   Default
         \*

         (If value is not set at all, \*, is default)


.. container:: table-row

   Property
         clearCache.pages

   Data type
         boolean

   Description
         This will allow a user to clear the whole page cache.


.. container:: table-row

   Property
         clearCache.all

   Data type
         boolean

   Description
         This will allow a user to clear all cache (that is everything
         including templates)


.. container:: table-row

   Property
         clearCache.clearRTECache

   Data type
         boolean

   Description
         If set, the option «Clear RTE Cache» is enabled in the Clear Cache
         menu. Note that the option is always available to admin users.

   Default
         0


.. container:: table-row

   Property
         lockToIP

   Data type
         string

   Description
         List of IP-numbers with wildcards.

         **Note:** This option is enabled only if the
         TYPO3\_CONF\_VARS['BE']['enabledBeUserIPLock'] configuration is true.

         **Examples:**

         192.168.\*.\*

         \- will allow all from 192.168-network

         192.168.\*.\*, 212.22.33.44

         \- will allow all from 192.168-network plus all from REMOTE\_ADDR
         212.22.33.44

         192.168, 212.22.33.44

         \- the same as the previous. Leaving out parts of the IP address is
         the same as wild cards...


.. container:: table-row

   Property
         saveClipboard

   Data type
         boolean

   Description
         If set, the clipboard content will be preserved for the next login.
         Normally the clipboard content lasts only during the session.


.. container:: table-row

   Property
         clipboardNumberPads

   Data type
         integer (0-20)

   Description
         This allows you to enter how many pads you want on the clipboard.

   Default
         3


.. container:: table-row

   Property
         enableShowPalettes

   Data type
         boolean

   Description
         .. figure:: ../../Images/manual_html_2f9c146a.png
            :alt: Shown secondary options (palettes) in the content editing forms

         If true, the checkbox "Show secondary options (palettes)" is
         displayed in content editing forms.

   Default
         1


.. container:: table-row

   Property
         enableShortcuts

   Data type
         boolean

   Description
         Enables the usage of bookmarks in the backend.

         Note: This option is deprecated since TYPO3 4.5.

   Default
         1


.. container:: table-row

   Property
         enableBookmarks

   Data type
         boolean

   Description
         Enables the usage of bookmarks in the backend.

   Default
         1


.. container:: table-row

   Property
         shortcutFrame

   Data type
         boolean

   Description
         If set, the bookmark frame in the bottom of the window appears. This
         frame contains the bookmarks, the search field and the workspace
         selector.

         **Note** : Only takes effect, if alt\_main.php, the old backend from
         TYPO3 4.1, is used.

         **Note** : This option has been removed in TYPO3 4.4.


.. container:: table-row

   Property
         shortcutGroups

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

         **Example:** ::

            shortcutGroups {
              1=1
              2=My Group
              3=0
              4=
            }

         Bookmark group 1 is loaded with the default label (Pages), group 2 is
         loaded and labeled as "My Group" and groups 3 and 4 are disabled.
         Group 5 has not been set, so it will be displayed by default, just
         like group 1.

         Note: This option is deprecated since TYPO3 4.5.


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

         **Example:** ::

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


.. container:: table-row

   Property
         shortcut\_onEditId\_dontSetPageTree

   Data type
         boolean

   Description
         If set, the page tree is  *not* opened to the page being edited when
         an id number is entered in the "Edit Id" box.

         Note: This option is deprecated since TYPO3 4.5.


.. container:: table-row

   Property
         bookmark\_onEditId\_dontSetPageTree

   Data type
         boolean

   Description
         If set, the page tree is  *not* opened to the page being edited when
         an id number is entered in the "Edit Id" box.


.. container:: table-row

   Property
         shortcut\_onEditId\_keepExistingExpanded

   Data type
         boolean

   Description
         If set, the existing expanded pages in the page tree are not collapsed
         when an id is entered in the "Edit Id" box.

         (provided .shortcut\_onEditId\_dontSetPageTree is not set!)

         Note: This option is deprecated since TYPO3 4.5.


.. container:: table-row

   Property
         bookmark\_onEditId\_keepExistingExpanded

   Data type
         boolean

   Description
         If set, the existing expanded pages in the page tree are not collapsed
         when an id is entered in the "Edit Id" box.

         (provided .bookmark\_onEditId\_dontSetPageTree is not set!)


.. container:: table-row

   Property
         mayNotCreateEditShortcuts

   Data type
         boolean

   Description
         If set, the user cannot create or edit bookmarks.

         **Note** : In TYPO3 4.3 and older depends on .shortcutFrame being set.

         Note: This option is deprecated since TYPO3 4.5.


.. container:: table-row

   Property
         mayNotCreateEditBookmarks

   Data type
         boolean

   Description
         If set, the user cannot create or edit bookmarks.


.. container:: table-row

   Property
         createFoldersInEB

   Data type
         boolean

   Description
         If set, a createFolders option appears in the element browser (for
         admin-users this is always enabled).


.. container:: table-row

   Property
         noThumbsInEB

   Data type
         boolean

   Description
         If set, then image thumbnails are not shown in the element browser.


.. container:: table-row

   Property
         noThumbsInRTEimageSelect

   Data type
         boolean

   Description
         As .noThumbsInEB but for the Rich Text Editor image selector.


.. container:: table-row

   Property
         uploadFieldsInTopOfEB

   Data type
         boolean

   Description
         If set, the upload-fields in the element browser are put in the top of
         the window.


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
         in the top of the page (default is after instead of top). ::

            options.saveDocNew = 0
            options.saveDocNew.tt_content = top


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


.. container:: table-row

   Property
         disableDelete

         disableDelete.[table]

   Data type
         boolean

   Description
         Disables the "Delete" button in TCEFORMs.

         Overriding for single tables works like "saveDocNew" above.


.. container:: table-row

   Property
         showHistory

         showHistory.[table]

   Data type
         boolean

   Description
         Shows link to the history for the record in TCEFORMs.

         Overriding for single tables works like "saveDocNew" above.


.. container:: table-row

   Property
         pageTree.backgroundColor

   Data type
         string

   Description
         (Since TYPO3 6.0) Set background colors for tree branches.

         Color can be any valid CSS color value. The best results can be
         achieved by using rgba values.

         The syntax is: options.pageTree.backgroundColor.<pageId> = <color>

         **Examples:** ::

            options.pageTree.backgroundColor.2 = red
            options.pageTree.backgroundColor.3 = #00FFFF
            options.pageTree.backgroundColor.4 = rgba(0, 255, 0, 0.1)

         .. figure:: ../../Images/options.pageTree.backgroundColor.png
            :alt: Tree branches with configured background colors


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


.. container:: table-row

   Property
         pageTree.disableTitleHighlight

   Data type
         boolean

   Description
         If set, the page titles in the page tree will not be highlighted when
         clicked.


.. container:: table-row

   Property
         pageTree.showPageIdWithTitle

   Data type
         boolean

   Description
         If set, the titles in the page navigation tree will have their ID
         numbers printed before the clickable title.


.. container:: table-row

   Property
         pageTree.showDomainNameWithTitle

   Data type
         boolean

   Description
         If set, the domain name will be appended to the page title for

         pages that have "Is root of web site?" checked in the page properties.

         Useful if there are several domains in one page tree.


.. container:: table-row

   Property
         pageTree.showNavTitle

   Data type
         boolean

   Description
         If set, the navigation title is displayed in the page navigation tree
         instead of the normal page title. The page title is showed in a
         tooltip if the mouse hovers the navigation title.


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


.. container:: table-row

   Property
         pageTree.onlineWorkspaceInfo

   Data type
         boolean

   Description
         If set, the workspace info box will also be shown in the page tree
         even in online mode. Recommended when working with workspaces a lot.

.. container:: table-row

   Property
         pageTree.hideFilter

   Data type
         boolean

   Description
         If set, the filter-box in the top of the page tree will be hidden.


.. container:: table-row

   Property
         pageTree.separateNotinmenuPages

   Data type
         boolean

   Description
         If set, not in menu and special pages are separated in the page tree
         from standard pages.


.. container:: table-row

   Property
         pageTree.alphasortNotinmenuPages

   Data type
         boolean

   Description
         If set and pageTree.seperateNotinmenuPages=1, separated pages are
         sorted alphabetically.


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

         These alternative webmounts  **replace** configured DB Mountpoints.

         **Example** ::

            options.pageTree.altElementBrowserMountPoints = 34,123


.. container:: table-row

   Property
         folderTree.altElementBrowserMountPoints

   Data type
         *(list of foldernames)*

   Description
         Sets alternative filemounts for use in the Element Browser. The
         folders you specify here must exist within the fileadmin/ folder. You
         separate folders by a comma. If a folder you specify does not exist it
         will not get mounted. Effective in workspaces too.

         The alternative filemounts are  **added** to the existing filemounts.

         **Example** ::

            options.folderTree.altElementBrowserMountPoints = _temp_/, templates


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


.. container:: table-row

   Property
         folderTree.hideCreateFolder

   Data type
         boolean

   Description
         If set, the user can't create new folders.

   Default
         false


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


.. container:: table-row

   Property
         contextMenu.options.alwaysShowClickMenuInTopFrame

   Data type
         boolean

   Description
         If set, then the clickmenu in the top frame is always shown. Default
         is that it's shown only if the pop-up menus are disabled by user or by
         browser.


.. container:: table-row

   Property
         overridePageModule

   Data type
         string

   Description
         By this value you can substitute the default "Web > Page" module key
         ("web\_layout") with another backend module key.

         **Example:** ::

            options.overridePageModule = web_txtemplavoilaM1

         This will enable TemplaVoila page module as default page module.


.. container:: table-row

   Property
         moduleMenuCollapsable

   Data type
         boolean

   Description
         If set, the user can collapse main modules in the left menu.

   Default
         1


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


.. container:: table-row

   Property
         defaultFileUploads

   Data type
         integer

   Description
         Default number of file upload forms shown in the File->List module


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

         **Example:** ::

            options.hideRecords.pages = 12,45


.. container:: table-row

   Property
         workspaces.previewLinkTTLHours

   Data type
         integer

   Description
         Number of hours for expiry of preview links to workspaces. Default is
         48 hours.


.. container:: table-row

   Property
         workspaces.swapMode

   Data type
         string

   Description
         Possible values are:

         "any" - if page or element (meaning any record on the page) is
         published, all content elements on the page and page itself will be
         published regardless of the current editing stage.

         "page" - if page is published, all content elements on the page will
         be published as well. If element is published, its publishing does not
         affect other elements or page.

   Default
         normal behavior (same as in 4.0)


.. container:: table-row

   Property
         workspaces.changeStageMode

   Data type
         string

   Description
         Possible values are:

         "any" - if page or element (meaning any record on the page) stage is
         changed (for example, from "editing" to "review"), all content
         elements on the page and page will change to that new stage as well
         (possibly bypassing intermediate stages).

         "page" - if page stage is changed (for example, from "editing" to
         "review"), all content elements on the page will change stage as well
         (possibly bypassing intermediate stages). If stage is changed for
         element, all other elements on the page and page itself remain in the
         previous stage.

   Default
         normal behavior (same as in 4.0)


.. container:: table-row

   Property
         workspaces.considerReferences

   Data type
         boolean

   Description
         If elements which are part of an interdependent structure (e.g. Inline
         Relational Record Editing) are swapped, published or sent to a stage
         alone, the whole related parent/child structure is taken into account
         automatically.

   Default
         1


.. container:: table-row

   Property
         workspaces.allowed\_languages.[workspaceId]

   Data type
         *(list of sys\_language ids)*

   Description
         This is a list of sys\_language uids which will be allowed in a
         workspace. This list - if set - will override the allowed languages
         list in the BE user group configuration.


.. container:: table-row

   Property
         additionalPreviewLanguages

   Data type
         *(list of sys\_language ids)*

   Description
         The user will see these additional languages when localizing stuff in
         TCEforms. The list are uid numbers of sys\_language records.


.. container:: table-row

   Property
         checkPageLanguageOverlay

   Data type
         boolean

   Description
         If set, localized fields in flexforms are shown only for languages
         which the current page is translated to.


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

         **Example:** ::

            options.view.languageOrder = 2,1


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


[beuser:options]



