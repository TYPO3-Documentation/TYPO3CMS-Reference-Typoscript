.. include:: ../../Includes.txt

.. _pagetcemain:

->TCEMAIN
^^^^^^^^^


.. only:: html

   .. contents::
      :local:
      :depth: 1


.. _pagetcemain-properties:

Properties
""""""""""

.. container:: ts-properties

   =================================== =========================================
   Property                            Data Type
   =================================== =========================================
   `clearCacheCmd`_                    list of values
   `clearCache\_disable`_              boolean
   `clearCache\_pageGrandParent`_      boolean
   `clearCache\_pageSiblingChildren`_  boolean
   `disableHideAtCopy`_                boolean
   `disablePrependAtCopy`_             boolean
   `permissions (user and group)`_     integer
   `permissions (actions)`_            list of strings / integer
   `preview`_                          array
   `previewDomain`_                    string
   `table.[table name]`_               :ref:`TCEMAIN_tables <pagetcemaintables>`
   `translateToMessage`_               string
   =================================== =========================================


.. _pagetcemain-table-table-name:

table.[table name]
~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         table.[*table name*]

         default

   Data type
         :ref:`TCEMAIN_tables <pagetcemaintables>`

   Description
         Options for each table.


.. _pagetcemain-permissions-user-group:

permissions (user and group)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         permissions.userid

         permissions.groupid

   Data type
         positive integer

   Description
         Hardcodes the default owner Backend User / Group UID of new and copied
         pages.

         (The default owner is the backend user that creates / copies the
         record. The default user group is the "main group" of the backend user
         - the group in the very top of the users group-list.)

         **Example:**

         .. code-block:: typoscript

            TCEMAIN {
               # Owner be_users UID for new pages:
               permissions.userid = 2
               # Owner be_groups UID for new pages:
               permissions.groupid = 3
            }

         Backend User with UID 2 is "test" and the Backend Group with UID 3 is
         "test\_group". With the configuration above a new page would be
         created with this user/group setting instead of the defaults:

         .. figure:: ../../Images/AccessDefaultPermissions.png
            :alt: Page with altered permissions for backend users and groups


.. _pagetcemain-permissions-actions:

permissions (actions)
~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         permissions.user

         permissions.group

         permissions.everybody

   Data type
         *(list of strings)* / integer (0-31)

   Description
         Default permissions set for owner-user, owner-group and everybody.

         Keylist: show,edit,delete,new,editcontent

         Alternatively you can specify an integer from 0 to 31 indicating which
         bits corresponding to the keylist should be set. (Bits in keylist:
         show=1,edit=2,delete=4,new=8,editcontent=16)

         Defaults from :code:`$GLOBALS['TYPO3_CONF_VARS']`:

         .. code-block:: php

            'user' => 'show,edit,delete,new,editcontent',
            'group' => 'show,edit,new,editcontent',
            'everybody' => ''

         **Example:**

         .. code-block:: typoscript

            TCEMAIN.permissions {
               # User can do anything (default):
               user = 31
               # Group can do anything
               # (normally "delete" is disabled)
               group = 31
               # Everybody can at least see the page
               # (normally everybody can do nothing)
               everybody = show
            }

         The page "Community" was created with the settings from the example
         above. Compared to the two other pages created with default
         permissions you can see the effect: The Backend Group can now also
         delete the page by default and Everybody has read access:

         .. figure:: ../../Images/AccessDefaultActions.png
            :alt: Page with altered permissions for backend users, groups and everybody


.. _pagetcemain-clearcachecmd:

clearCacheCmd
~~~~~~~~~~~~~

.. container:: table-row

   Property
         clearCacheCmd

   Data type
         List of values (integers, "all", "pages" or tags)

   Description
         This allows you to have the cache for additional pages cleared when
         saving to some page or branch of the page tree.

         It it possible to trigger clearing of all caches or just the pages
         cache. It is also possible to target precise pages either by referring
         to their ID numbers or to tags that are attached to them.

         Attaching tags to page cache is described in the
         :ref:`TypoScript Reference <t3tsref:stdwrap-addpagecachetags>`.

         **Examples:**

         .. code-block:: typoscript

            # Will clear the cache for page ID 12 and 23
            # when saving a record in this page:
            TCEMAIN.clearCacheCmd = 12,23
            # Will clear all pages cache:
            TCEMAIN.clearCacheCmd = pages
            # Will clear ALL cache:
            TCEMAIN.clearCacheCmd = all
            # Will clear cache for all pages tagged with tag "pagetag1"
            TCEMAIN.clearCacheCmd = cacheTag:pagetag1


.. _pagetcemain-clearcache-pagesiblingchildren:

clearCache\_pageSiblingChildren
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         clearCache\_pageSiblingChildren

   Data type
         boolean

   Description
         If set, then children of all siblings of a page being edited will have
         the page cache cleared.

         (Default is that when a page record is edited, the cache for itself
         and siblings (same level) is cleared.)


.. _pagetcemain-clearcache-pagegrandparent:

clearCache\_pageGrandParent
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         clearCache\_pageGrandParent

   Data type
         boolean

   Description
         If set, then the grand parent of a page being edited will have the
         page cache cleared.


.. _pagetcemain-clearcache-disable:

clearCache\_disable
~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         clearCache\_disable

   Data type
         boolean

   Description
         If set, then the automatic clearing of page cache when records are
         edited etc. is disabled. This also disables the significance of the
         two "clearCache\_page\*" options listed above.


.. _pagetcemain-translatetomessage:

translateToMessage
~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         translateToMessage

   Data type
         string

   Description
         Defines the string that will be prepended to every field value if you
         copy an element to another language version.

         The special string "%s" will be replaced with the language title.

         Default is "Translate to [language title]:".

         **Example:**

         .. code-block:: typoscript

            TCEMAIN {
               # Set a German label:
               translateToMessage = Bitte in "%s" übersetzen:
            }


.. _pagetcemain-preview:

preview
~~~~~~~

.. container:: table-row

   Property
         preview

   Data type
         array

   Description
         Configure preview link generated for the save+view button in Backend.
         This allows to have different preview URLs depending on the record type.
         Common usecase is to have previews for blog or news records, but this feature
         now allows you to define a different preview page for content elements as well,
         which might be handy if those are stored in a sysfolder.

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

         The :ts:`previewPageId` is the uid of the page to use for preview. If this setting is omitted the current page will be used.
         If the current page is not a normal page, the root page will be chosen.

         The :ts:`useDefaultLanguageRecord` defaults to `1` and ensures that translated records will use the uid of the default record
         for the preview link. You may disable this, if your extension can deal with the uid of translated records.

         The :ts:`fieldToParameterMap` is a mapping which allows you to select fields of the record to be included as GET-parameters in
         the preview link. The key specifies the field name and the value specifies the GET-parameter name.

         Finally :ts:`additionalGetParameters` allow you to add arbitrary GET-parameters and even override others.

         The core automatically sets the "no_cache" and the "L" parameter. The language matches the language of the current record.
         You may override each parameter by using the :ts:`additionalGetParameters` configuration option.


.. _pagetcemain-previewdomain:

previewDomain
~~~~~~~~~~~~~

.. container:: table-row

   Property
         previewDomain

   Data type
         string

   Description
         Defines a preview domain used for frontend previews triggered from the backend. E.g. "Save and View" button
         The value must be a valid domain, optionally prefixed by a schema.

         **Examples:**

         .. code-block:: typoscript

            TCEMAIN.previewDomain = dev.local
            TCEMAIN.previewDomain = http://dev.local
            TCEMAIN.previewDomain = https://example.com

         .. note::

            If the option is not specified, the first available domain record within the current rootline is used.
            Moverover, if no domain record is present either, the current domain (and schema) used
            for the backend will be chosen.

[page:TCEMAIN]


.. _pagetcemaintables:

TCEMAIN\_tables sub-properties
""""""""""""""""""""""""""""""

Processing options for tables configured via :code:`$GLOBALS['TCA']`.


.. _pagetcemaintables-disableprependatcopy:

disablePrependAtCopy
~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         disablePrependAtCopy

   Data type
         boolean

   Description
         Disables the "prependAtCopy" feature (if configured for the table in
         :code:`$GLOBALS['TCA']`).

         .. note::

            The word "prepend" is misguiding. The "(copy)" label is actually *appended*
            to the record title

         **Example:**

         .. code-block:: typoscript

            TCEMAIN.table.pages {
               # Pages will *not* have "(copy)" appended:
               disablePrependAtCopy = 1
               # Pages will *not* be hidden upon copy:
               disableHideAtCopy = 1
            }

         These settings adjust that a page which is copied will neither have
         "(copy X)" appended nor be hidden.

         The last page in this tree, labeled "Test", is used as original to be
         copied.

         The first sub page was copied using the settings from the above
         example: It is labeled "Test" and is visible exactly like the original
         page.

         The page "Test (copy 2)" in the middle was in contrast copied in
         default mode: The page is hidden and the "(copy X)" suffix is added,
         if another page with the same named existed already.

         .. figure:: ../../Images/PageCopyWithSuffix.png
            :alt: Hidden page with added suffix after copying its original page


.. _pagetcemaintables-disablehideatcopy:

disableHideAtCopy
~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         disableHideAtCopy

   Data type
         boolean

   Description
         Disables the "hideAtCopy" feature (if configured for the table in
         :code:`$GLOBALS['TCA']`).

         For an example, see :ref:`disablePrependAtCopy <pagetcemaintables-disableprependatcopy>`
         above.

