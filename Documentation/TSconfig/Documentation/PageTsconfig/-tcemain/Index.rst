.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


->TCEMAIN
^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:


.. container:: table-row

   Property
         table.[ *tablename* ]

         default

   Data type
         ->TCEMAIN\_tables

   Description
         Options for each table.


.. container:: table-row

   Property
         permissions.userid

         permissions.groupid

   Data type
         int+

   Description
         Hardcodes the default owner Backend User / Group UID of new and copied
         pages.

         (The default owner is the backend user that creates / copies the
         record. The default user group is the "main group" of the backend user
         - the group in the very top of the users group-list.)

         **Example:** ::

            TCEMAIN {
                # Owner be_users UID for new pages:
              permissions.userid = 2
                # Owner be_groups UID for new pages:
              permissions.groupid = 3
            }

         Backend User with UID 2 is "test" and the Backend Group with UID 3 is
         "test\_group". With the configuration above a new page would be
         created with this user/group setting instead of the defaults:

         .. figure:: ../../Images/manual_html_63233290.png
            :alt: Page with altered permissions for backend users and groups


.. container:: table-row

   Property
         permissions.user

         permissions.group

         permissions.everybody

   Data type
         list of string/int[0-31]

   Description
         Default permissions set for owner-user, owner-group and everybody.

         Keylist: show,edit,delete,new,editcontent

         Alternatively you can specify an integer from 0 to 31 indicating which
         bits corresponding to the keylist should be set. (Bits in keylist:
         show=1,edit=2,delete=4,new=8,editcontent=16)

         Defaults from $TYPO3\_CONF\_VARS::

            'user' => 'show,edit,delete,new,editcontent',
            'group' => 'show,edit,new,editcontent',
            'everybody' => ''

         **Example:** ::

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

         .. figure:: ../../Images/manual_html_23d64d7b.png
            :alt: Page with altered permissions for backend users, groups and everybody


.. container:: table-row

   Property
         clearCacheCmd

   Data type
         List of values (integers, "all", "pages")

   Description
         This can allow you to have the cache for additional pages cleared when
         saving to some page or branch of the page tree.

         **Examples:** ::

              # Will clear the cache for page ID 12 and 23
              # when saving a record in this page:
            TCEMAIN.clearCacheCmd = 12,23

              # Will clear all pages cache:
            TCEMAIN.clearCacheCmd = pages

              # Will clear ALL cache:
            TCEMAIN.clearCacheCmd = all


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


.. container:: table-row

   Property
         clearCache\_pageGrandParent

   Data type
         boolean

   Description
         If set, then the grand parent of a page being edited will have the
         page cache cleared.


.. container:: table-row

   Property
         clearCache\_disable

   Data type
         boolean

   Description
         If set, then the automatic clearing of page cache when records are
         edited etc. is disabled. This also disables the significance of the
         two "clearCache\_page\*" options listed above.


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

         **Example:** ::

            TCEMAIN {
                # Set a German label:
              translateToMessage = Bitte in "%s" übersetzen:
            }


.. container:: table-row

   Property
         notificationEmail\_subject

   Data type
         string

   Description
         Defines the header of workspace status change notification emails.

         The special string "%s" will be replaced with the table name and
         record uid of the changed record.

         Default is "TYPO3 Workspace Note: Stage Change for [tablename:uid]".

         **Example:** ::

            TCEMAIN {
                # Set a German header:
              notificationEmail_subject = TYPO3-Arbeitsumgebungshinweis: Änderung der Stufe für %s
            }

         **Note** : This option is deprecated since TYPO3 4.5. Since TYPO3 4.5
         localized emails are sent by default, if the translation files for the
         respective language have been downloaded with the Extension Manager.


.. container:: table-row

   Property
         notificationEmail\_body

   Data type
         string

   Description
         Defines the bodytext of workspace status change notification emails.

         There are eleven special strings (like "%s", "%11$s" and "%10$s")
         present in that text.

         In order of appearance the nine strings "%s" will be replaced as
         follows:

         1. Sitename coming from
         $GLOBALS['TYPO3\_CONF\_VARS']['SYS']['sitename']

         2. Link to the TYPO3\_mainDir

         3. Title of the workspace

         4. uid of the workspace

         5. Table name and uid of the changed record

         6. Name of the new stage

         7. Comment which the user entered when requesting the stage change

         8. Real name of the changing user coming from his user record

         9. Username of the changing user coming from his user record

         Note that you cannot change their order.

         Finally, there are the strings %10$s and %11$s.

         %10$s is replaced with the path of the changed record and

         %11$s is replaced with the title of the record.

         Default text is:

         "At the TYPO3 site "%s" (%s)

         in workspace "%s" (#%s)

         the stage has changed for the element(s) "%11$s" (%s) at location
         "%10$s" in the page tree:

         ==> %s

         User Comment:

         "%s"

         State was change by %s (username: %s)"

         **Example:** ::

            TCEMAIN {
                # Set a German bodytext:
              notificationEmail_body (
                Auf der TYPO3-Seite "%s" (%s)
                wurde in der Arbeitsumgebung "%s" (%s)
                die Stufe des Elements/der Elemente "%11$s" (%s) am Ort "%10$s" im Seitenbaum verändert:
                ==> %s
                Kommentar des Benutzers:
                "%s"

                Die Stufe wurde geändert von %s (Benutzername: %s).
              )
            }

         **Note** : This option is deprecated since TYPO3 4.5. Since TYPO3 4.5
         localized emails are sent by default, if the translation files for the
         respective language have been downloaded with the Extension Manager.


.. ###### END~OF~TABLE ######

[page:TCEMAIN]


->TCEMAIN\_tables
"""""""""""""""""

Processing options for a $TCA configured table.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:


.. container:: table-row

   Property
         history.keepEntries

   Data type
         int+

   Description
         Maximum number of entries in the sys\_history for this table. Range
         0-200. Zero turns the history off.

         **Example:** ::

            TCEMAIN {
                # Default for all tables is 10 entries:
              default.history.keepEntries = 10
                # But the Content Elements will have 20 levels:
              table.tt_content.history.keepEntries = 20
            }

         **Note** : This option has been removed in TYPO3 4.0.


.. container:: table-row

   Property
         history.maxAgeDays

   Data type
         int+

   Description
         The number of days elements are in the history at most. Takes
         precedence over keepEntries.

         Default is 7 days. Range 0-200. Zero turns the maxAgeDays off.

         **Note** : This option has been removed in TYPO3 6.0.


.. container:: table-row

   Property
         disablePrependAtCopy

   Data type
         boolean

   Description
         Disables the "prependAtCopy" feature (if configured for the table in
         $TCA).

         (The word "prepend" is misguiding - the "(copy)" label is  *appended*
         to (put after) the record title! Sorry for that mistake, it isn't the
         only time I have made that.)

         **Example:** ::

            TCEMAIN.table.pages {
                # Pages will NOT have "(copy)" appended:
              disablePrependAtCopy = 1
                # Pages will NOT be hidden upon copy:
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

         .. figure:: ../../Images/manual_html_m5a1cc22d.png
            :alt: Hidden page with added suffx after copying its orignal page

.. container:: table-row

   Property
         disableHideAtCopy

   Data type
         boolean

   Description
         Disables the "hideAtCopy" feature (if configured for the table in
         $TCA).

         For an example, see "disablePrependAtCopy" above.


.. ###### END~OF~TABLE ######

[page:TCEMAIN.default/TCEMAIN.table.(tablename)/->TCEMAIN\_tables]