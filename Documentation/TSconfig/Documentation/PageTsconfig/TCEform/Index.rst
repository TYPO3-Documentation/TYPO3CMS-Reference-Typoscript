.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt

.. _tceform:

->TCEFORM
^^^^^^^^^

Allows detailed configuration of how TCEforms are rendered for a page
tree branch and for individual tables if you like. You can enable and
disable options, blind options in selector boxes etc.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         [*table name*].[*field*]

         [*table name*].[*field*].types.[*type*]

   Data type
         ->TCEFORM\_confObj

   Description
         These objects contain additional configuration of the TCEFORM
         interface. For the properties available, refer to the table below.
         This is a description of how you can customize in general and override
         for specific types.

         TCEFORM.[table name].[field] - configures the field in TCEFORM for all
         types.

         TCEFORM.[table name].[field].types.[type] - configures the field in
         TCEFORM in case the 'type'-value of the field matches type.


.. container:: table-row

   Property
         [*table name*].[*field*].config.[*key*]

   Data type
         string / array

   Description
         This setting allows to override TCA field configuration and offers a
         flexible opportunity to reuse tables and TCA definitions but adapt
         them to individual demands. So this will influence configuration
         settings in
         $GLOBALS['TCA'][<table name>]['columns'][<field>]['config'][<key>].

         Depending on the $GLOBALS['TCA'] type of the field, the allowed keys
         are:

         **input** - size, max

         **text** - cols, rows, wrap

         **check** - cols, showIfRTE

         **select** - size, autoSizeMax, maxitems, minitems

         **group** - size, autoSizeMax, max\_size, show\_thumbs, maxitems,
         minitems, disable\_controls

         **inline** - appearance, foreign\_label, foreign\_selector,
         foreign\_unique, maxitems, minitems, size, autoSizeMax,
         symmetric\_label


.. container:: table-row

   Property
         suggest.default

         suggest.[queryTable]

         [table name].[field].suggest.default

         [table name].[field].suggest.[queryTable]

   Data type
         ->TCEFORM\_suggest

   Description
         Configuration for the "suggest" wizard.

         .. figure:: ../../Images/manual_html_m4f51d09f.png
            :alt: Configured "suggest" wizard

         Each level of the configuration overwrites the values of the level
         below it:

         \- "suggest.default" is overwritten by "suggest.[queryTable]".

         \- Both are overwritten by "[table name].[field].suggest.default" which
         itself is overwritten by "[table name].[field].suggest.[queryTable]"

         suggest.default:

         Configuration for all suggest wizards in all tables

         suggest.[queryTable]:

         Configuration for all suggest wizards from all tables listing records
         from table [queryTable]

         [table name].[field].suggest.default

         Configuration for the suggest wizard for field [field] in table
         [table name]

         [table name].[field].suggest.[queryTable]

         Configuration for the suggest wizard for field [field] in table
         [table name] listing records from [queryTable]


.. container:: table-row

   Property
         [table name].[field].[dataStructKey]

   Data type
         ->TCEFORM\_flexform

   Description
         (Since TYPO3 4.6) Properties for the TCEFORM FlexForm meta
         configuration.

         FlexForms have a built in possibility to use different field
         configuration for multiple languages. The handling of this multi-
         language behavior is configurable in the meta settings of a FlexForm.


.. container:: table-row

   Property
         [table name].[field].[dataStructKey].[flexSheet]

   Data type
         ->TCEFORM\_flexformSheet

   Description
         Configuration for the data structure of a sheet with type "flex".

         The [dataStructKey] represents the key of a FlexForm in
         $GLOBALS['TCA'][<table name>]['columns'][<field>]['config']['ds'].

         This key will be split into up to two parts. By default the first part
         will be used as identifier of the FlexForm in TSconfig.

         The second part will override the identifier if it is not empty,
         "list" or "\*".

         For example the identifier of the key "my\_ext\_pi1,list" will be
         "my\_ext\_pi1" and of the key "\*,my\_CType" it will be "my\_CType".

         TCEFORM.[table name].[field].[dataStructKey].[flexSheet] configures a
         whole FlexForm sheet.


.. container:: table-row

   Property
         [table name].[field].[dataStructKey].[flexSheet].[flexField]

   Data type
         ->TCEFORM\_confObj

   Description
         Configuration for the data structure of a field with type "flex".

         TCEFORM.[table name].[field].[dataStructKey].[flexSheet].[flexField]
         configures a single FlexForm field.

         Only these TCEFORM\_confObj options are available for FlexForm fields:

         \- disabled

         \- label

         \- keepItems

         \- removeItems

         \- addItems

         \- altLabels

         **Example:**

            :ts:`TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField {`
                :ts:`# Remove`

                :ts:`disabled = 1`

                :ts:`# Rename`

                :ts:`label = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField`

                :ts:`# Remove all items from select but these ones`

                :ts:`keepItems = item1,item2,item3`

                :ts:`# Remove items from select`

                :ts:`removeItems = item1,item2,item3`

                :ts:`# Add new items to select`

                :ts:`addItems {`
                    :ts:`item1 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item1`

                    :ts:`item2 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item2`

                    :ts:`item3 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item3`
                :ts:`}`

                :ts:`# Rename existing items`

                :ts:`altLabels {`
                    :ts:`item1 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item1`

                    :ts:`item2 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item2`

                    :ts:`item3 = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF.myField.item3`
                :ts:`}`
            :ts:`}`


.. container:: table-row

   Property
         [table name].[field].[dataStructKey].[flexSheet].[flexField].config.[ke
         y]

   Data type
         string / array

   Description
         This setting allows to override FlexForm field configuration.

         Depending on the $GLOBALS['TCA'] type of the field, the allowed keys
         are:

         \- input: size, max

         \- text: cols, rows, wrap

         \- check: cols, showIfRTE

         \- select: size, autoSizeMax, maxitems, minitems

         \- group: size, autoSizeMax, max\_size, show\_thumbs, maxitems,
         minitems, disable\_controls


.. ###### END~OF~TABLE ######

[page:TCEFORM]

.. _pagetceformconfobj:

->TCEFORM\_confObj
""""""""""""""""""

Properties for the TCEFORM configuration object (see introduction
above).

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         disabled

   Data type
         boolean

   Description
         If set, the field is not rendered.

         **Example:**

            :ts:`TCEFORM.pages.title {`
                :ts:`# You cannot edit the Page title field now:`

                :ts:`disabled = 1`
            :ts:`}`


.. container:: table-row

   Property
         label

   Data type
         string (localized)

   Description
         This allows you to enter alternative labels for any field.

         **Example:**

            :ts:`TCEFORM.pages.title {`
                :ts:`label = LLL:EXT:my_ext/locallang_db.xml:table.column`

                :ts:`label.default = New Label`

                :ts:`label.de = Neuer Feldname`
            :ts:`}`


.. container:: table-row

   Property
         keepItems

   Data type
         *(list of values)*

   Description
         *(Applies to select-types only.)*

         This keeps in the list only the items defined here. All others are
         removed.

         **Example:**

            :ts:`TCEFORM.pages.doktype {`
                :ts:`# Show only standard and "Spacer" page types`

                :ts:`keepItems = 1,199`
            :ts:`}`


.. container:: table-row

   Property
         removeItems

   Data type
         *(list of values)*

   Description
         *(applies to select-types only)*

         This removes the items from the list which has a value found in this
         comma list of values.

         **Example:**

            :ts:`TCEFORM.pages.doktype {`
                :ts:`# Remove the "Recycler" and "Spacer" page type options:`

                :ts:`removeItems = 199, 255`
            :ts:`}`


.. container:: table-row

   Property
         addItems.[itemValue]

   Data type
         string (localized)

   Description
         *(applies to select-types only)*

         This will add elements to the list. Notice that the added elements
         might be removed if the selector represents records. In that case only
         still existing records will be preserved.

         **Example:**

            :ts:`TCEFORM.pages.doktype {`
                :ts:`# Creates a new page type option:`

                :ts:`addItems.123 = New Page type!`

                :ts:`# Creates yet a page type with "locallang" title:`

                :ts:`addItems.124 = LLL:EXT:lang/locallang_tca.php:title` 
            :ts:`}

         This example extends the options for Page types with two new items:

         .. figure:: ../../Images/manual_html_32b14869.png
            :alt: The Page types are extended by two new items

         **Warning:** This example shows the principle of adding
         adhoc-items to a selector box in TYPO3, but you *should not* add new
         *page types* or Content Element types this way!


.. container:: table-row

   Property
         disableNoMatchingValueElement

   Data type
         boolean

   Description
         *(applies to select-types only)*

         If a selector box value is not available among the options in the box,
         the default behavior of TYPO3 is to preserve the value and to show a
         label which warns about this special state:

         .. figure:: ../../Images/manual_html_m78bf4baf.png
            :alt: A missing selector box value is indicated by a warning message

         If disableNoMatchingValueElement is set, the element "INVALID VALUE"
         will not be added to the list.

         **Example:**

            :ts:`TCEFORM.pages.doktype {`
                :ts:`# "INVALID VALUE ..." label will never show up:`

                :ts:`disableNoMatchingValueElement = 1`
            :ts:`}`

         Now the selector box will default to the first element in the selector
         box:

         .. figure:: ../../Images/manual_html_m47a63dda.png
            :alt: Instead of show a warning message the system choose the first element in the selector box


.. container:: table-row

   Property
         noMatchingValue\_label

   Data type
         string (localized)

   Description
         *(applies to select-types only)*

         Allows for an alternative label of the "noMatchingValue" element.

         You can insert the placeholder "%s" to insert the value.

         If you supply a blank value the label will be blank.

         **Example:**

            :ts:`TCEFORM.pages.doktype {`
                :ts:`# Alternative "INVALID VALUE ..." label:`

                :ts:`noMatchingValue_label = VALUE "%s" was not available!`
            :ts:`}`

         The result will be:

         .. figure:: ../../Images/manual_html_m54280068.png
            :alt:  A invalid selector box value is indicated by a warning message


.. container:: table-row

   Property
         altLabels.[item\_value]

   Data type
         string (localized)

   Description
         *(applies to select-types only)*

         This allows you to enter alternative labels for the items in the list.

         **Example:**

            :ts:`TCEFORM.pages.doktype {`
                :ts:`# Setting alternative labels:`

                :ts:`altLabels.1 = STANDARD Page Type`

                :ts:`altLabels.254 = Folder (for various elements)`

                :ts:`# Sets the default label for Recycler via "locallang":`

                :ts:`altLabels.255 = LLL:EXT:lang/locallang_tca.php:doktype.I.2`
            :ts:`}`

         Result will be:

         .. figure:: ../../Images/manual_html_430ba952.png
            :alt: The Page types with modified labels


.. container:: table-row

   Property
         PAGE\_TSCONFIG\_ID

   Data type
         integer

   Description
         *(applies to select-types with foreign table)*

         When the select-types are used with foreign-table, the where-query has
         four markers (see description of $TCA in the "Inside TYPO3" document).
         The value of three of these markers may be set from Page TSconfig.

         **Examples:**

            :ts:`TCEFORM.tt_content.pi_flexform.PAGE_TSCONFIG_ID = 22`

         In this example, the value will substitute the marker in a plugin
         FlexForm.

            :ts:`TCEFORM.tx_myext.myfield.PAGE_TSCONFIG_ID = 22`

         This example might be used for a record in an extension. It refers to
         a table called "tx\_myext" and the field "myfield". Here the marker
         will be substituted by the value "22".


.. container:: table-row

   Property
         PAGE\_TSCONFIG\_IDLIST

   Data type
         *(list of integers)*

   Description
         *(Applies to select-types with foreign table.)*

         See above.

         **Examples:**

            :ts:`TCEFORM.tt_content.pi_flexform.PAGE_TSCONFIG_IDLIST = 20,21,22`

         In this example, the value will substitute the marker in a plugin
         FlexForm.

            :ts:`TCEFORM.tx_myext.myfield.PAGE_TSCONFIG_IDLIST = 20,21,22`

         This example might be used for a record in an extension. It refers to
         a table called "tx\_myext" and the field "myfield". Here the marker
         will be substituted by the list of integers.


.. container:: table-row

   Property
         PAGE\_TSCONFIG\_STR

   Data type
         string

   Description
         *(applies to select-types with foreign table)*

         See above.

         **Examples:**

            :ts:`TCEFORM.tt_content.pi_flexform.PAGE_TSCONFIG_STR = %hello%`

         In this example, the value will substitute the marker in a plugin
         FlexForm.

            :ts:`TCEFORM.tx_myext.myfield.PAGE_TSCONFIG_STR = %hello%`

         This example might be used for a record in an extension. It refers to
         a table called "tx\_myext" and the field "myfield". Here the marker
         will be substituted by the given value.


.. container:: table-row

   Property
         itemsProcFunc.[...]

   Data type
         (custom)

   Description
         *(applies to select-types with itemsProcFunc)*

         The properties of this key is passed on to the itemsProcFunc in the
         parameter array by the key "TSconfig".


.. container:: table-row

   Property
         RTEfullScreenWidth

   Data type
         positive integer / %

   Description
         *(Applies for RTE text fields only with the RTE wizard configured.)*

         The width of the RTE full screen display. If you set an integer value,
         that indicates the pixels width. You can also set a percentage value.

   Default
         100%


.. container:: table-row

   Property
         linkTitleToSelf

   Data type
         boolean

   Description
         *(all fields)*

         If set, then the title of the field in the forms links to alt\_doc.php
         editing ONLY that field.

         Works for existing records only - not for new records.

         **Example:**

            :ts:`TCEFORM.pages.title {`
                :ts:`# The label for the "title" field will link itself`

                :ts:`linkTitleToSelf = 1`
            :ts:`}`

         The result is that the label for the title field will be a link:

         .. figure:: ../../Images/manual_html_m156d544f.png
            :alt: The label for the title field turns into a link

         Clicking the link brings you to a form where only this field is shown:

         .. figure:: ../../Images/manual_html_62e7bc5f.png
            :alt: The Edit Page screen after clicking the link


.. ###### END~OF~TABLE ######

[page:TCEFORM.(table name).(field)/TCEFORM.(table name).(field).types.(t
ype)]

.. _pagetceformflexform:

->TCEFORM\_flexform
"""""""""""""""""""

(Since TYPO3 4.6) Properties for the TCEFORM FlexForm configuration
object.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         langDisable

   Data type
         boolean

   Description
         If set, then handling of localizations is disabled. Otherwise
         FlexForms will not only allow editing the default language, but also
         additional languages according to "sys\_languages" table contents.


.. container:: table-row

   Property
         langChildren

   Data type
         boolean

   Description
         If set, then localizations are bound to the default values 1-1
         ("value" level). Otherwise localizations are handled on "structure
         level".

         **Example:**

            :ts:`TCEFORM.tt_content.pi_flexform.login {`
                :ts:`# Language settings plug-in configuration`

                :ts:`langDisable  = 1`

                :ts:`langChildren = 0`
            :ts:`}`


.. ###### END~OF~TABLE ######

[page:TCEFORM.[table name].[field].[dataStructKey]]

.. _pagetceformflexformsheet:

->TCEFORM\_flexformSheet
""""""""""""""""""""""""

The following options were introduced in TYPO3 4.5. These are the
properties for the TCEFORM FlexForm sheet configuration object (see
->TCEFORM section above).

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         disabled

   Data type
         boolean

   Description
         If set, the FlexForm sheet is not rendered. One sheet represents one
         tab in plug-in configuration.

         **Example:**

            :ts:`TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF {`
                :ts:`# The tab with key "sDEF" of the FlexForm plug-in configuration is now hidden`

                :ts:`disabled = 1`
            :ts:`}`


.. container:: table-row

   Property
         sheetTitle

   Data type
         string / getText

   Description
         Set the title of the tab in FlexForm plug-in configuration.

         **Example:**

            :ts:`TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF {`
                :ts:`# Rename the first tab of the FlexForm plug-in configuration`

                :ts:`sheetTitle = LLL:fileadmin/locallang.xml:tt_content.pi_flexform.my_ext_pi1.sDEF`
            :ts:`}`


.. container:: table-row

   Property
         sheetDescription

   Data type
         string / getText

   Description
         (Since TYPO3 4.6) Specifies a description for the sheet shown in the
         FlexForm.


.. container:: table-row

   Property
         sheetShortDescr

   Data type
         string / getText

   Description
         (Since TYPO3 4.6) Specifies a short description of the sheet used as
         link title in the tab-menu.


.. ###### END~OF~TABLE ######

[page:TCEFORM.[table name].[field].[dataStructKey].[flexSheet]]


->TCEFORM\_suggest
""""""""""""""""""

Properties for the suggest wizard (see introduction above).

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         pidList

   Data type
         *(list of values)*

   Description
         Limit the search to certain pages (and their subpages). When pidList
         is empty all pages will be included in the search (as long as the
         be\_user is allowed to see them)

         **Example:**

            :ts:`TCEFORM.suggest.default {`
                :ts:`# sets the pidList for a suggest fields in all tables`

                :ts:`pidList = 1,2,3,45`
            :ts:`}`


.. container:: table-row

   Property
         pidDepth

   Data type
         positive integer

   Description
         Expand pidList by this number of levels. Only has an effect, if
         pidList has a value.

         **Example:**

            :ts:`TCEFORM.suggest.default {`
                :ts:`pidList = 6,7`

                :ts:`pidDepth = 4`
            :ts:`}`


.. container:: table-row

   Property
         minimumCharacters

   Data type
         positive integer

   Description
         Minimum number of characters needed to start the search. Works only
         for single fields.

         **Example:**

            :ts:`TCEFORM.pages.storage_pid.suggest.default {`
                :ts:`minimumCharacters = 3`
            :ts:`}`

   Default
         2


.. container:: table-row

   Property
         maxPathTitleLength

   Data type
         positive integer

   Description
         Maximum number of characters to display when a path element is too
         long.

         **Example:**

            :ts:`TCEFORM.suggest.default {`
                :ts:`maxPathTitleLength = 30`
            :ts:`}`


.. container:: table-row

   Property
         searchWholePhrase

   Data type
         boolean

   Description
         Whether to do a LIKE=%mystring% (searchWholePhrase = 1) or a
         LIKE=mystring% (to do a real find as you type).

         **Example:**

            :ts:`TCEFORM.pages.storage_pid.suggest.default {`
                :ts:`# configures the suggest wizard for the field "storage_pid" in table "pages" to search only for whole phrases`

                :ts:`searchWholePhrase = 1`
            :ts:`}`

   Default
         0


.. container:: table-row

   Property
         searchCondition

   Data type
         string

   Description
         Additional WHERE clause (no AND needed to prepend).

         **Example:**

            :ts:`TCEFORM.pages.storage_pid.suggest.default {`
                :ts:`# configures the suggest wizard for the field "storage_pid" in table "pages" to search only for pages with doktype=1`

                :ts:`searchCondition = doktype=1`
            :ts:`}`


.. container:: table-row

   Property
         cssClass

   Data type
         string

   Description
         Add a CSS class to every list item of the result list.

         **Example:**

            :ts:`TCEFORM.suggest.pages {`
                :ts:`# configures all suggest wizards which list records from table "pages" to add the CSS class "pages" to every list item of the result list.`

                :ts:`cssClass = pages`
            :ts:`}`


.. container:: table-row

   Property
         receiverClass

   Data type
         string

   Description
         PHP class alternative receiver class - the file that holds the class
         needs to be included manually before calling the suggest feature,
         should be derived from "t3lib\_tceforms\_suggest\_defaultreceiver"

   Default
         t3lib\_tceforms\_suggest\_defaultreceiver


.. container:: table-row

   Property
         renderFunc

   Data type
         string

   Description
         User function to manipulate the displayed records in the result.


.. container:: table-row

   Property
         hide

   Data type
         boolean

   Description
         Hide the suggest field. Works only for single fields.

         **Example:**

            :ts:`TCEFORM.pages.storage_pid.suggest.default {`
                :ts:`hide = 1`
            :ts:`}`


.. ###### END~OF~TABLE ######

[page:TCEFORM.suggest.default/TCEFORM.suggest.(queryTable)/TCEFORM.(ta
blename).(field).suggest.default/TCEFORM.(table name).(field).(queryTab
le)]