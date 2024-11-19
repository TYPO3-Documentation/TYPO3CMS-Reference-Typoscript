..  include:: /Includes.rst.txt
..  index:: TCEMAIN
..  _pagetcemain:
..  _pagetcemain-properties:

=======
TCEMAIN
=======

Configuration for the TYPO3 Core Engine (DataHandler). For general information, see
the :ref:`according section of TYPO3 Explained <t3coreapi:tce>`.

..  youtube:: HnAdDHkes5A

Properties
==========

..  contents::
    :depth: 2
    :local:

..  index:: Clear cache; On saving record
..  _pagetcemain-clearcachecmd:

clearCacheCmd
-------------

..  confval:: clearCacheCmd
    :name: tcemain-clearCacheCmd
    :type: List of integers, `all`, `pages` or tags

    This allows you to have the frontend cache for additional pages cleared when saving
    to some page or branch of the page tree.

    It it possible to trigger clearing of all caches or just the pages cache. It is also
    possible to target precise pages either by referring to their ID numbers or to tags
    that are attached to them.

    Attaching tags to page cache is described in the :ref:`TypoScript Reference <t3tsref:stdwrap-addpagecachetags>`.

..  _pagetcemain-clearcachecmd-example:

Example: Clear the cache for certain pages when a record is changed
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN {
        # Clear the cache for page uid 12 and 23 when saving a record in this page
        clearCacheCmd = 12, 23
        # Clear all frontent page caches of pages
        clearCacheCmd = pages
        # Clear ALL caches
        clearCacheCmd = all
        # Clear cache for all pages tagged with tag "pagetag1"
        clearCacheCmd = cacheTag:pagetag1
    }

..  note::

    In order for the :typoscript:`pages` and :typoscript:`all` commands to work for non-admin users,
    make sure to set :typoscript:`options.clearCache.pages = 1` or :typoscript:`options.clearCache.all = 1` accordingly
    in the user TSconfig.

..  index:: Clear cache; Disable
..  _pagetcemain-clearcache-disable:

clearCache_disable
------------------

..  confval:: clearCache_disable
    :name: tcemain-clearCache_disable
    :type: boolean

    If set, then the automatic clearing of page cache when records are edited etc. is disabled.
    This also disables the significance of the two options
    :ref:`clearCache_pageSiblingChildren <pagetcemain-clearcache-pagesiblingchildren>`
    and :ref:`clearCache_pageGrandParent <pagetcemain-clearcache-pagegrandparent>`

..  index:: Clear cache; On saving child page
..  _pagetcemain-clearcache-pagegrandparent:

clearCache_pageGrandParent
--------------------------

..  confval:: clearCache_pageGrandParent
    :name: tcemain-clearCache_pageGrandParent
    :type: boolean

    If set, then the grand parent of a page being edited will have the page cache cleared.

..  index:: Clear cache; On saving sibling page
..  _pagetcemain-clearcache-pagesiblingchildren:

clearCache_pageSiblingChildren
------------------------------

..  confval:: clearCache_pageSiblingChildren
    :name: tcemain-clearCache_pageSiblingChildren
    :type: boolean

    If set, then children of all siblings of a page being edited will have the page cache cleared.

    Default is that when a page record is edited, the cache for itself, the parent, and siblings (same level) is cleared.

..  index:: Copy record; Disable hide
..  _pagetcemaintables-disablehideatcopy:

disableHideAtCopy
-----------------

..  confval:: disableHideAtCopy
    :name: tcemain-disableHideAtCopy
    :type: boolean

    Disables the :ref:`hideAtCopy TCA feature <t3tca:ctrl-reference-hideatcopy>` if
    configured for the table.

..  _pagetcemaintables-disablehideatcopy-example:

Example: Do not hide pages when they are copy-pasted
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN.table.pages {
       # Pages will *not* have "(copy)" appended:
       disablePrependAtCopy = 1
       # Pages will *not* be hidden upon copy:
       disableHideAtCopy = 1
    }

These settings adjust that a page which is copied will neither have "(copy X)" appended nor be hidden.

The last page in this tree, labeled "Test", is used as original to be copied. The first sub page was
copied using the settings from the above example: It is labeled "Test" and is visible exactly like
the original page. The page "Test (copy 2)" in the middle was in contrast copied in default mode:
The page is hidden and the "(copy X)" suffix is added, if another page with the same named existed already.

..  figure:: /Images/ManualScreenshots/List/PageCopyWithSuffix.png
    :alt: Hidden page with added suffix after copying its original page

    Hidden page with added suffix after copying its original page

Example: Apply disableHideAtCopy as default to all tables
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN.default {
      disableHideAtCopy = 1
    }


..  index:: Copy record; Disable prepend string (copy)
..  _pagetcemaintables-disableprependatcopy:

disablePrependAtCopy
--------------------

..  confval:: disablePrependAtCopy
    :name: tcemain-disablePrependAtCopy
    :type: boolean

    Disable the :ref:`prependAtCopy TCA feature <t3tca:ctrl-reference-prependatcopy>` if
    configured for the table.

    The word "prepend" is misleading. The "(copy)" label is actually *appended* to the record title.

..  _pagetcemaintables-disableprependatcopy-example:

Example: Do not append the "(copy)" label to newly copied pages
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN.table.pages {
       # Pages will *not* have "(copy)" appended:
       disablePrependAtCopy = 1
       # Pages will *not* be hidden upon copy:
       disableHideAtCopy = 1
    }

These settings adjust that a page which is copied will neither have "(copy X)" appended nor be hidden.

The last page in this tree, labeled "Test", is used as original to be copied. The first sub page was
copied using the settings from the above example: It is labeled "Test" and is visible exactly like
the original page. The page "Test (copy 2)" in the middle was in contrast copied in default mode:
The page is hidden and the "(copy X)" suffix is added, if another page with the same named existed already.

..  figure:: /Images/ManualScreenshots/List/PageCopyWithSuffix.png
    :alt: Hidden page with added suffix after copying its original page

    Hidden page with added suffix after copying its original page

Example: Apply disablePrependAtCopy as default to all tables
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN.default {
      disablePrependAtCopy = 1
    }


..  index:: Link handler
..  _pagetcemaintables-linkhandler:

linkHandler
-----------

..  confval:: linkHandler
    :name: tcemain-linkHandler
    :type: array of link handler configurations

    Contains an array of link handler configurations.

    ..  attention::
        The keys in this array
        uniquely identify the type of link and are used in the TYPO3 link format,
        for example `t3://record?identifier=my_content&uid=123`. Therefore the key
        must never be changed or all existing links in the content will stop working.

    :typoscript:`handler`
        Fully qualified name of the class containing the backend link handler.

    :typoscript:`configuration`
        Configuration for the link handler, depends on the :typoscript:`handler`.
        For :php:`TYPO3\CMS\Backend\LinkHandler\RecordLinkHandler`
        :typoscript:`configuration.table` must be defined.

    :typoscript:`scanBefore` / :typoscript:`scanAfter`
        Define the order in which handlers are queried when determining
        the responsible tab for editing an existing link.

    :typoscript:`displayBefore` / :typoscript:`displayAfter`
        Define the order of how the various tabs are displayed in the
        link browser.

    ..  versionchanged:: 12.0
        Due to the integration of EXT:recordlist into EXT:backend the namespace of
        LinkHandlers has changed from :php:`TYPO3\CMS\Recordlist\LinkHandler` to
        :php:`TYPO3\CMS\Backend\LinkHandler`.
        For TYPO3 v12 the moved classes are available as an alias under the old
        namespace to allow extensions to be compatible with TYPO3 v11 and v12.

..  _pagetcemaintables-linkhandler-example:

Example: Display an additional tab in the linkbrowser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The following page TSconfig display an additional tab with the `label` as
title in the linkbrowser. It then saves the link in the format
`t3://record?identifier=my_content&uid=123`. To render the link in the
frontend you need to define the same key in the TypoScript setup
:ref:`config.recordLinks <t3tsref:setup-config-recordLinks>`.

..  seealso::
    For a complete example see also the :ref:`Record link tutorial
    in TYPO3 Explained <t3coreapi:TableRecordLinkBrowserTutorials>`.

..  code-block:: typoscript
    :caption: Page TSconfig definition for identifier `my_content`

    TCEMAIN.linkHandler.my_content {
        handler = TYPO3\CMS\Backend\LinkHandler\RecordLinkHandler
        label = LLL:EXT:my_extension/Resources/Private/Language/locallang.xlf:link.customTab
        configuration {
            table = tx_myextension_content
        }
        scanBefore = page
    }

..  index:: Page permissions
..  _pagetcemain-permissions-user-group:

permissions
-----------

..  index:: Page permissions; copyFromParent
..  _pagetcemain-permissions-copyFromParent:

Value copyFromParent
~~~~~~~~~~~~~~~~~~~~

The value :typoscript:`copyFromParent` can be set for each of the
page TSconfig :typoscript:`TCEMAIN.permissions.*` sub keys. If this value is
set, the page access permissions are copied from the parent page.

Example: Inherit the group id of the parent page
""""""""""""""""""""""""""""""""""""""""""""""""

..  code-block:: php
    :caption: config/system/settings.php | typo3conf/system/settings.php

    $GLOBALS['TYPO3_CONF_VARS']['BE']['defaultPageTSconfig'] .= '
        TCEMAIN.permissions.groupid = copyFromParent
        TCEMAIN.permissions.group = 31
        TCEMAIN.permissions.everybody = 0
    ';

By default all new pages created by users will inherit the group of the parent
page. Members of this group get all permissions. Users not in the group get no
permissions.

When an administrator creates a new page she can use the module
:guilabel:`System > Access` to set a different owner group for this new page.

All subpages created to this new page will now automatically have the new pages
group. The administrator does not have to set custom TSconfig to achieve this.

This behaviour is similar to the "group sticky bit" in Unix for directories.

..  index:: Page permissions; everybody

..  _pagetcemain-permissions-everybody:

everybody
~~~~~~~~~

..  confval:: permissions.everybody
    :name: tcemain-permissions-everybody
    :type: list of strings or integer 0-31
    :Default: 0

    Default permissions for everybody who is not the owner user or member of
    the owning group, key list: `show`, `edit`, `delete`, `new`, `editcontent`.

    Alternatively, it is allowed to set an integer between 0 and 31, indicating
    which bits corresponding to the key list should be set: `show = 1`,
    `edit = 2`, `delete = 4`, `new = 8`, `editcontent = 16`.

    It also possible to set the value
    :ref:`copyFromParent <pagetcemain-permissions-copyFromParent>` to inherit
    the value from the parent page.

..  _pagetcemain-permissions-everybody-example:

Example: Set permissions defaults so that everybody can see the page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

    ..  code-block:: typoscript
       :caption: EXT:site_package/Configuration/page.tsconfig

       TCEMAIN.permissions {
           # Everybody can at least see the page, normally everybody can do nothing
           everybody = show
       }

    The page "Community" was created with the settings from the example
    above. Compared to the two other pages created with default
    permissions you can see the effect: "Everybody" has read access:

    ..  figure:: /Images/ManualScreenshots/Access/AccessDefaultActions.png
        :alt: Page with altered permissions for backend users, groups and everybody

        Page with altered permissions for backend users, groups and everybody

..  index:: Page permissions; Group

..  _pagetcemain-permissions-group:

group
~~~~~

..  confval:: permissions.group
    :name: tcemain-permissions-group
    :type: list of strings or integer 0-31
    :Default: show,edit,new,editcontent

    Default permissions for group members, key list: `show`, `edit`, `new`,
    `editcontent`.

   Alternatively, it is allowed to set an integer between 0 and 31, indicating
   which bits corresponding to the key list should be set: `show = 1`,
   `edit = 2`, `delete = 4`, `new = 8`, `editcontent = 16`.

   It also possible to set the value
   :ref:`copyFromParent <pagetcemain-permissions-copyFromParent>` to inherit
   the value from the parent page.


..  _pagetcemain-permissions-group-example:

Example: Set permission defaults so that the group can do anything but delete a page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN.permissions {
        # Group can do anything, normally "delete" is disabled
        group = 31
    }

The page "Community" was created with the settings from the example
above. Compared to the two other pages created with default
permissions you can see the effect: The Backend Group can now also
delete the page by default:

..  figure:: /Images/ManualScreenshots/Access/AccessDefaultActions.png
    :alt: Page with altered permissions for backend users, groups and everybody

    Page with altered permissions for backend users, groups and everybody

..  index:: Page permissions; Group id
..  _pagetcemain-permissions-groupid:

groupid
~~~~~~~

..  confval:: permissions.groupid
    :name: tcemain-permissions-groupid
    :type: positive integer or string

    By default the owner group of a newly created page is set to the main group
    of the backend user creating the page.

    By setting the value of this property to
    :ref:`copyFromParent <pagetcemain-permissions-copyFromParent>` the owner
    group is copied from the newly created pages parent page.

    The owner group of a newly created page can be hardcoded by setting this
    property to a positive integer greater then zero.

..  _pagetcemain-permissions-groupid-example:

Example: Set default user group for permissions on new pages
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN {
        # Owner be_groups UID for new pages
        permissions.groupid = 3
    }

In this instance, backend group with UID 3 is "test_group". With the configuration
above a new page would be created with this group setting instead of the default,
even if a user who is not member of that group creates the page:

..  figure:: /Images/ManualScreenshots/Access/AccessDefaultPermissions.png
    :alt: Page with altered permissions for backend users and groups

    Page with altered permissions for backend groups

..  index:: Page permissions; User
..  _pagetcemain-permissions-actions:

user
~~~~

..  confval:: permissions.user
    :name: tcemain-permissions-user
    :type: list of strings or integer 0-31
    :Default: show,edit,delete,new,editcontent

    Default permissions for owner user, key list: `show`, `edit`, `delete`,
    `new`, `editcontent`.

    Alternatively, it is allowed to set an integer between 0 and 31, indicating
    which bits corresponding to the key list should be set: `show = 1`,
    `edit = 2`, `delete = 4`, `new = 8`, `editcontent = 16`.

    It also possible to set the value
    :ref:`copyFromParent <pagetcemain-permissions-copyFromParent>` to inherit
    the value from the parent page.

..  _pagetcemain-permissions-actions-example:

Example: Set permission defaults so that the pages owner can do anything
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN.permissions {
        # User can do anything, this is identical to the default value
        user = 31
    }

..  index:: Page permissions; User id
..  _pagetcemain-permissions-userid:

userid
~~~~~~

..  confval:: permissions.userid
    :name: tcemain-permissions-userid
    :type: positive integer or string

   By default the owner of a newly created page is the user that created or
   copied the page.

   By setting the value of this property to
   :ref:`copyFromParent <pagetcemain-permissions-copyFromParent>` the owner
   group is copied from the newly created pages parent page.

   When this property is set to a positive integer the owner of new pages is
   hardcoded to the user of that uid.

..  _pagetcemain-permissions-userid-example:

Example: Set default user for permissions on new pages
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCEMAIN {
        # Owner be_users UID for new pages
        permissions.userid = 2
    }

In this instance, backend user with UID 2 is "test". With the configuration
above a new page would be created with this owner setting instead of the default,
even if another user creates the page:

..  figure:: /Images/ManualScreenshots/Access/AccessDefaultPermissions.png
    :alt: Page with altered permissions for backend users

    Page with altered permissions for backend users

..  index:: Page preview
..  _pagetcemain-preview:

preview
-------

..  confval:: preview
    :name: tcemain-preview
    :type: array

    Configure preview link generated for the save+view button and other frontend view related buttons
    in the backend. This allows to have different preview URLs depending on the record type. A common
    use case is to have previews for blog or news records, and this feature allows you to define a different
    preview page for content elements as well, which might be handy if those are stored in a sysfolder.

    ..  code-block:: typoscript
       :caption: EXT:site_package/Configuration/page.tsconfig

       TCEMAIN.preview {
           disableButtonForDokType = 199, 254, 255
           <table name> {
               previewPageId = 123
               useDefaultLanguageRecord = 0
               fieldToParameterMap {
                   uid = tx_myext_pi1[showUid]
               }
               additionalGetParameters {
                   tx_myext_pi1.special = HELLO # results in tx_myext_pi1[special]
               }
           }
       }

    The :typoscript:`previewPageId` is the uid of the page to use for preview. If this setting is omitted the
    current page will be used. If the current page is not a normal page, the root page will be chosen.

    The :typoscript:`disableButtonForDokType` setting allows you to disable the preview button for a given list
    of :ref:`doktypes <t3coreapi:list-of-page-types>`. If none are configured, this defaults to: 199, 254, 255 (Spacer,
    Folder and Recycler).

    The :typoscript:`useDefaultLanguageRecord` defaults to `1` and ensures that translated records will use the
    uid of the default record for the preview link. You may disable this, if your extension can deal
    with the uid of translated records.

    The :typoscript:`fieldToParameterMap` is a mapping which allows you to select fields of the record to be
    included as GET-parameters in the preview link. The key specifies the field name and the value specifies
    the GET-parameter name.

    Finally :typoscript:`additionalGetParameters` allow you to add arbitrary GET-parameters and even override others.
    If the plugin on your target page shows a list of records by default you will also need something like
    :typoscript:`tx_myext_pi1.action = show` to ensure the record details are displayed.

    The core automatically sets the "no_cache" and the "L" parameter. The language matches the language of
    the current record. You may override each parameter by using the :typoscript:`additionalGetParameters` configuration
    option.

    ..  note::

        Make sure not to set :typoscript:`options.saveDocView.<table name> = 0`, otherwise the save+view button
        will not be displayed when editing records of your table.

    ..  attention::

        The configuration has to be defined for the page containing the records and :typoscript:`previewPageId`
        (for example sysfolder holding the records is located outside of your root)

..  index:: Copy record; Table based configuration
..  _pagetcemaintables:
..  _pagetcemain-table-table-name:

table
-----

Processing options for tables. The table name is added, for instance `TCEMAIN.table.pages.disablePrependAtCopy = 1`
or `TCEMAIN.table.tt_content.disablePrependAtCopy = 1`.

It is also possible to set a default value for all tables, for example
`TCEMAIN.default.disablePrependAtCopy = 1`.

..  index:: Localization; Translate to message
..  _pagetcemain-translatetomessage:

translateToMessage
------------------

..  confval:: translateToMessage
    :name: tcemain-translateToMessage
    :type: string
    :Default: `Translate to %s:`

    Defines the string that will be prepended to some field values if you copy an element to another
    language version. This applies to all fields where the TCA columns property
    :ref:`l10n_mode <t3tca:columns-properties-l10n-mode>` is set to :php:`prefixLangTitle`.

    The special string "%s" will be replaced with the language title.

    You can globally disable the prepending of the string by setting `translateToMessage` to
    an empty string. You can disable the message to a certain field by setting the `l10n_mode`
    to an empty string.

..  _pagetcemain-translatetomessage-example:

Example: Set a German prefix for newly translated records
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: PageTSconfig

    TCEMAIN {
        translateToMessage = Bitte in "%s" übersetzen:
    }


..  _pagetcemain-translatetomessage-example-disable:

Example: Disable the "[Translate to ...]" prefix
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: PageTSconfig

    TCEMAIN {
        translateToMessage =
    }
