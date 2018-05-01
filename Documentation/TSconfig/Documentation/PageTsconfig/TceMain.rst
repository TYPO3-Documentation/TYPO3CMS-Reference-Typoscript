.. include:: ../Includes.txt

.. _pagetcemain:
.. _pagetcemain-properties:

=======
TCEMAIN
=======

Configuration for the TYPO3 Core Engine (DataHandler). For general information, see
the :ref:`according section of the TYPO3 Core API document <t3coreapi:tce>`.


.. _pagetcemain-permissions-user-group:

permissions
===========


userid
------

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Hard code the default owner of new and copied pages: The default owner is
    usually the user that creates / copies the page, this setting allows to
    override this.

:aspect:`Example`
    .. code-block:: typoscript

        TCEMAIN {
            # Owner be_users UID for new pages
            permissions.userid = 2
        }

    In this instance, backend user with UID 2 is "test". With the configuration
    above a new page would be created with this owner setting instead of the default,
    even if another user creates the page:

    .. figure:: ../Images/AccessDefaultPermissions.png
        :alt: Page with altered permissions for backend users

        Page with altered permissions for backend users

groupid
-------

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Hard code the default group of new and copied pages: The default user group is
    the "main group" of the backend user - the group in the very top of the users
    group-list. This setting allows to override this default and set a specific group uid.

:aspect:`Example`
    .. code-block:: typoscript

        TCEMAIN {
            # Owner be_groups UID for new pages
            permissions.groupid = 3
        }

    In this instance, backend group with UID 3 is "test_group". With the configuration
    above a new page would be created with this group setting instead of the default,
    even if a user who is not member of that group creates the page:

    .. figure:: ../Images/AccessDefaultPermissions.png
        :alt: Page with altered permissions for backend users and groups

        Page with altered permissions for backend groups


.. _pagetcemain-permissions-actions:

user
----

:aspect:`Datatype`
    list of strings or integer 0-31

:aspect:`Description`
    Default permissions for owner user, key list: `show`, `edit`, `delete`, `new`, `editcontent`

    Alternatively, it is allowed to set an integer between 0 and 31, indicating which bits
    corresponding to the key list should be set: `show = 1`, `edit = 2`, `delete = 4`, `new = 8`, `editcontent = 16`

:aspect:`Default`
    show,edit,delete,new,editcontent

:aspect:`Example`
    .. code-block:: typoscript

        TCEMAIN.permissions {
            # User can do anything, this is identical to the default value
            user = 31
        }

group
-----

:aspect:`Datatype`
    list of strings or integer 0-31

:aspect:`Description`
    Default permissions for group members, key list: `show`, `edit`, `delete`, `new`, `editcontent`

    Alternatively, it is allowed to set an integer between 0 and 31, indicating which bits
    corresponding to the key list should be set: `show = 1`, `edit = 2`, `delete = 4`, `new = 8`, `editcontent = 16`

:aspect:`Default`
    show,edit,new,editcontent

:aspect:`Example`
    .. code-block:: typoscript

        TCEMAIN.permissions {
            # Group can do anything, normally "delete" is disabled
            group = 31
        }

    The page "Community" was created with the settings from the example
    above. Compared to the two other pages created with default
    permissions you can see the effect: The Backend Group can now also
    delete the page by default:

    .. figure:: ../Images/AccessDefaultActions.png
        :alt: Page with altered permissions for backend users, groups and everybody

        Page with altered permissions for backend users, groups and everybody


everybody
---------

:aspect:`Datatype`
    list of strings or integer 0-31

:aspect:`Description`
    Default permissions for everybody who is not the owner user or member of the owning group,
    key list: `show`, `edit`, `delete`, `new`, `editcontent`

    Alternatively, it is allowed to set an integer between 0 and 31, indicating which bits
    corresponding to the key list should be set: `show = 1`, `edit = 2`, `delete = 4`, `new = 8`, `editcontent = 16`

:aspect:`Default`
    0

:aspect:`Example`
    .. code-block:: typoscript

        TCEMAIN.permissions {
            # Everybody can at least see the page, normally everybody can do nothing
            everybody = show
        }

    The page "Community" was created with the settings from the example
    above. Compared to the two other pages created with default
    permissions you can see the effect: "Everybody" has read access:

    .. figure:: ../Images/AccessDefaultActions.png
        :alt: Page with altered permissions for backend users, groups and everybody

        Page with altered permissions for backend users, groups and everybody



.. _pagetcemain-clearcachecmd:

clearCacheCmd
=============

:aspect:`Datatype`
    List of integers, `all`, `pages` or tags

:aspect:`Description`
    This allows you to have the frontend cache for additional pages cleared when saving
    to some page or branch of the page tree.

    It it possible to trigger clearing of all caches or just the pages cache. It is also
    possible to target precise pages either by referring to their ID numbers or to tags
    that are attached to them.

    Attaching tags to page cache is described in the :ref:`TypoScript Reference <t3tsref:stdwrap-addpagecachetags>`.

:aspect:`Examples`

    .. code-block:: typoscript

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


.. _pagetcemain-clearcache-pagesiblingchildren:

clearCache_pageSiblingChildren
==============================

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, then children of all siblings of a page being edited will have the page cache cleared.

    Default is that when a page record is edited, the cache for itself and siblings (same level) is cleared.


.. _pagetcemain-clearcache-pagegrandparent:

clearCache_pageGrandParent
==========================

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, then the grand parent of a page being edited will have the page cache cleared.


.. _pagetcemain-clearcache-disable:

clearCache_disable
==================

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, then the automatic clearing of page cache when records are edited etc. is disabled.
    This also disables the significance of the two options
    :ref:`clearCache_pageSiblingChildren <pagetcemain-clearcache-pagesiblingchildren>`
    and :ref:`clearCache_pageGrandParent <pagetcemain-clearcache-pagegrandparent>`


.. _pagetcemain-translatetomessage:

translateToMessage
==================

:aspect:`Datatype`
    string

:aspect:`Description`
    Defines the string that will be prepended to every field value if you copy an element to another
    language version. The special string "%s" will be replaced with the language title.

    Default is `Translate to [language title]: `.

:apsect:`Example`

    .. code-block:: typoscript

        TCEMAIN {
            # Set a German label
            translateToMessage = Bitte in "%s" übersetzen:
        }


.. _pagetcemain-preview:

preview
=======

:aspect:`Datatype`
    array

:aspect:`Description`
    Configure preview link generated for the save+view button and other frontend view related buttons
    in the backend. This allows to have different preview URLs depending on the record type. A common
    use case is to have previews for blog or news records, and this feature allows you to define a different
    preview page for content elements as well, which might be handy if those are stored in a sysfolder.

    .. code-block:: typoscript

        TCEMAIN.preview {
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

    The :ts:`previewPageId` is the uid of the page to use for preview. If this setting is omitted the
    current page will be used. If the current page is not a normal page, the root page will be chosen.

    The :ts:`useDefaultLanguageRecord` defaults to `1` and ensures that translated records will use the
    uid of the default record for the preview link. You may disable this, if your extension can deal
    with the uid of translated records.

    The :ts:`fieldToParameterMap` is a mapping which allows you to select fields of the record to be
    included as GET-parameters in the preview link. The key specifies the field name and the value specifies
    the GET-parameter name.

    Finally :ts:`additionalGetParameters` allow you to add arbitrary GET-parameters and even override others.

    The core automatically sets the "no_cache" and the "L" parameter. The language matches the language of
    the current record. You may override each parameter by using the :ts:`additionalGetParameters` configuration
    option.

    .. note::

        Make sure not to set :ts:`options.saveDocView.<table name> = 0`, otherwise the save+view button
        will not be displayed when editing records of your table.


.. _pagetcemain-previewdomain:

previewDomain
=============

:aspect:`Datatype`
    string

:aspect:`Description`
    Defines a preview domain used for frontend previews triggered from the backend, for instance
    the "Save and View" button. The value must be a valid domain, optionally prefixed by a schema.

    If the option is not specified, the first available domain record within the current rootline is used.
    If there is no domain record either, the current domain (and schema) used for the backend will be chosen.

:aspect:`Example`
    .. code-block:: typoscript

        TCEMAIN.previewDomain = dev.local
        TCEMAIN.previewDomain = http://dev.local
        TCEMAIN.previewDomain = https://example.com


.. _pagetcemaintables:
.. _pagetcemain-table-table-name:

table
=====

Processing options for tables. The table name is added, for instance `TCEMAIN.table.pages.disablePrependAtCopy = 1`
or `TCEMAIN.table.tt_content.disablePrependAtCopy = 1`.


.. _pagetcemaintables-disableprependatcopy:

disablePrependAtCopy
--------------------

:aspect:`Datatype`
    boolean

:aspect:`Description`
    Disable the :ref:`prependAtCopy TCA feature <t3tca:ctrl-reference-prependatcopy>` if
    configured for the table.

    The word "prepend" is misleading. The "(copy)" label is actually *appended* to the record title.

:aspect:`Example`
    .. code-block:: typoscript

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

    .. figure:: ../Images/PageCopyWithSuffix.png
        :alt: Hidden page with added suffix after copying its original page

        Hidden page with added suffix after copying its original page


.. _pagetcemaintables-disablehideatcopy:

disableHideAtCopy
-----------------

:aspect:`Datatype`
    boolean

:aspect:`Description`
    Disables the :ref:`hideAtCopy TCA feature <t3tca:ctrl-reference-hideatcopy>` if
    configured for the table.

:aspect:`Example`
    .. code-block:: typoscript

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

    .. figure:: ../Images/PageCopyWithSuffix.png
        :alt: Hidden page with added suffix after copying its original page

        Hidden page with added suffix after copying its original page
