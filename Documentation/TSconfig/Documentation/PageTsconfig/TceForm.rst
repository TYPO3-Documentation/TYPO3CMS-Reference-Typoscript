.. include:: ../Includes.txt

.. _tceform:
.. _pagetceformconfobj:
.. _pagetceformflexformsheet:

=======
TCEFORM
=======

Allows detailed configuration of how editing forms are rendered for a page
tree branch and for individual tables if you like. You can enable and
disable options, blind options in selector boxes etc.

See the core API document section :ref:`FormEngine <t3coreapi:FormEngine>` for more
details on how records are rendered in the backend.

The properties listed below apply to various contexts which are explained per
property. The full property path thus depends on the property and where it should
apply. In general, a more specific property path overrides a less specific one:

Some properties apply to single fields, those can be usually set per table or
per table and record type. This leads to the property paths
`TCEFORM.[tableName].[fieldName].[propertyName]` to configure the field for all types
and `TCEFORM.[tabeName].[fieldName].types.[typeName]` to configure a fierd for a specific
type, see the :ref:`TCA type section <t3tca:types>` for details on types.

Other properties also apply to flex form fields, in this case the full property
path including the data structure key has to be set:
`TCEFORM.[tableName].[fieldName].[dataStructureKey].[flexSheet].[flexFieldName].[propertyName]`.
The `[dataStructKey]` represents the key of a FlexForm in
:php:`$GLOBALS['TCA'][<tableName>]['columns'][<field>]['config']['ds']`. This key will be split into up to
two parts. By default the first part will be used as identifier of the FlexForm in TSconfig. The second part
will override the identifier if it is not empty, `list` or `*`. For example the identifier of the key
`my_ext_pi1,list` will be `my_ext_pi1` and of the key `*,my_CType` it will be `my_CType`. See section
:ref:`Pointing to a data structure <t3tca:columns-flex-ds-pointer>` of the TCA reference for details.

Some properties apply to whole FlexForm sheets, their property path is
`TCEFORM.[tableName].[fieldName].[dataStructureKey].[flexSheet].[propertyName]`.

While all that property path munging looks messy at first, it should become more
clear if reading through the single properties below and looking at the examples.


addItems
========

:aspect:`Datatype`
    localized string

:aspect:`Description`
    Change the list of items in :ref:`TCA type=select <t3tca:columns-select>` fields. Using this property,
    items can be added to the list. Note that the added elements might be removed if the selector represents
    records: If the select box is a relation to another table. In that case only existing records
    will be preserved.

    The subkey `icon` will allow to add your own icons to new values.

    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header_layout.addItems`

    table and record type level, example:
        `TCEFORM.tt_content.header_layout.types.textpic.addItems`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.addItems`

    .. warning::
        Do not add page types this way (using `TCEFORM.pages.doktype.addItems`), instead the proper
        PHP API should be used to do this, see :ref:`Core APIs <t3coreapi:page-types>` for details.

    .. note::
        The `icon` is probably outdated, this documentation should be checked, probably an icon
        identifier is used nowadays.

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.tt_content.header_layout {
           # Add another header_layout option:
           addItems.1525215969 = Another header layout
           # Add another one with localized label and icon
           addItems.1525216023 = LLL:EXT:my_ext/Resources/Private/Language/locallang.xlf:header_layout
           addItems.1525216023.icon = EXT:my_ext/icon.png
        }


altLabels
=========

:aspect:`Datatype`
    localized string

:aspect:`Description`
    This property applies to :ref:`TCA type=select <t3tca:columns-select>`,
    :ref:`TCA type=check <t3tca:columns-check>` and :ref:`TCA type=radio <t3tca:columns-radio>`.

    This property allows you to enter alternative labels for the items in the list. For a single checkbox or radio
    button, use `default`, for multiple checkboxes and radiobuttons, use an integer for their position starting at 0.

    This property is available for various levels:

    table level:
        `TCEFORM.[tableName].[fieldName].altLables`

    table and record type level:
        `TCEFORM.[tableName].[fieldName].types.typeName.altLabels`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.altLables`

:aspect:`Example`

    .. code-block:: typoscript

        TCEFORM.pages.doktype {
            # Set a different item label
            altLabels.1 = STANDARD Page Type
            altLabels.254 = Folder (for various elements)
            # Sets the default label for Recycler via "locallang":
            altLabels.255 = LLL:EXT:my_ext/Resources/Private/Language/locallang_tca.xlf:recycler
        }

    .. figure:: ../Images/PagesDoktypeDifferentLabels.png
        :alt: The Page types with modified labels

        The Page types with modified labels


config
======

:aspect:`Datatype`
    string / array

:aspect:`Description`
    This setting allows to override TCA field configuration. This will influence configuration settings in
    $GLOBALS['TCA'][<tableName>]['columns'][<fieldName>]['config'][<key>], see
    :ref:`TCA reference <t3tca:columns-properties-config>` for details. Not all configuration options can
    be overriden, the properties are restricted and depend on the field type:
    :code:`typo3/sysext/backend/Classes/Form/Utility/FormEngineUtility.php->$allowOverrideMatrix`:

    .. code-block:: php

        'input' => ['size', 'max', 'readOnly'],
        'text' => ['cols', 'rows', 'wrap', 'max', 'readOnly'],
        'check' => ['cols', 'readOnly'],
        'select' => ['size', 'autoSizeMax', 'maxitems', 'minitems', 'readOnly', 'treeConfig'],
        'group' => ['size', 'autoSizeMax', 'max_size', 'maxitems', 'minitems', 'readOnly'],
        'inline' => ['appearance', 'behaviour', 'foreign_label', 'foreign_selector', 'foreign_unique', 'maxitems', 'minitems', 'size', 'autoSizeMax', 'symmetric_label', 'readOnly'],
        'imageManipulation' => ['ratios', 'cropVariants']


    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header.config.max`

    table and record type level, example:
        `TCEFORM.tt_content.header.types.textpic.config.max`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.config.max`


disabled
========

:aspect:`Datatype`
    boolean

:aspect:`Description`
    If set, the field is rendered, but not editable by the user.
    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header.disabled`

    table and record type level, example:
        `TCEFORM.tt_content.header.types.textpic.disabled`

    Flex form sheet level. If set, the entire tab is not rendered, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.disabled`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.disabled`

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.title {
            # The title field of the pages table is not editable
            disabled = 1
        }


.. _pageFormEngineDisableNoMatchingElement:

disableNoMatchingValueElement
=============================

:aspect:`Datatype`
    boolean

:aspect:`Description`
    This property applies only to items in :ref:`TCA type=select <t3tca:columns-select>` fields.
    If a selector box value is not available among the options in the box, the default behavior
    of TYPO3 is to preserve the value and to show a label which warns about this special state:

    .. figure:: ../Images/SelectInvalidValue.png
        :alt: A missing selector box value is indicated by a warning message

        A missing selector box value is indicated by a warning message

    If disableNoMatchingValueElement is set, the element "INVALID VALUE" will not be added to the list.

    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header_layout.disableNoMatchingValueElement`

    table and record type level, example:
        `TCEFORM.tt_content.header_layout.types.textpic.disableNoMatchingValueElement`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.disableNoMatchingValueElement`

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.doktype {
            # "INVALID VALUE ..." label will never show up
            disableNoMatchingValueElement = 1
        }

    Now the selector box will default to the first element in the selector box:

    .. figure:: ../Images/SelectNoInvalidValue.png
        :alt: Instead of show a warning message the system choose the first element in the selector box

        Instead of show a warning message the system choose the first element in the selector box


itemsProcFunc
=============

:aspect:`Datatype`
    custom

:aspect:`Description`
    This property applies only to items in :ref:`TCA type=select <t3tca:columns-select>` fields. The properties of
    this key is passed on to the :ref:`itemsProcFunc <t3tca:columns-select-properties-itemsprocfunc>` in the
    parameter array by the key "TSconfig".

    This property is available for various levels:

    table level:
        `TCEFORM.[tableName].[fieldName].itemsProcFunc`

    table and record type level:
        `TCEFORM.[tableName].[fieldName].types.[typeName].itemsProcFunc`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.itemsProcFunc`


keepItems
=========

:aspect:`Datatype`
    list of values

:aspect:`Description`
    Change the list of items in :ref:`TCA type=select <t3tca:columns-select>` fields. Using this property,
    all items except those defined here are removed.

    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header_layout.keepItems`

    table and record type level, example:
        `TCEFORM.tt_content.header_layout.types.textpic.keepItems`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.keepItems`

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.doktype {
            # Show only standard and "Spacer" page types
            keepItems = 1, 199
        }


label
=====

:aspect:`Datatype`
    localized string

:aspect:`Description`
    This allows you to enter alternative labels for any field. The value can be a `LLL:` reference
    to a localization file, the system will then look up the selected backend user language and tries
    to fetch the localized string if available. However, it is also possible to override these by
    appending the language key and hard setting a value, for example `label.de = Neuer Feldname`.

    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header.label`

    table and record type level, example:
        `TCEFORM.tt_content.header.types.textpic.label`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.label`

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.title {
            label = LLL:EXT:my_ext/Resources/Private/Language/locallang.xlf:table.column
            label.default = New Label
            label.de = Neuer Feldname
        }


noMatchingValue_label
=====================

:aspect:`Datatype`
    localized string

:aspect:`Description`
    This property applies only to items in :ref:`TCA type=select <t3tca:columns-select>` fields, it allows defining
    a different label of the :ref:`noMatchingValue <pageFormEngineDisableNoMatchingElement>` element.

    It is possible to use the placeholder `%s` to insert the value. If the property is set to empty,
    the label will be blank.

    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header_layout.noMatchingValue_label`

    table and record type level, example:
        `TCEFORM.tt_content.header_layout.types.textpic.noMatchingValue_label`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.noMatchingValue_label`

:aspect:`Example`

    .. code-block:: typoscript

        TCEFORM.pages.doktype {
            # Different "INVALID VALUE ..." label:
            noMatchingValue_label = VALUE "%s" was not available!
        }

    .. figure:: ../Images/SelectInvalidValueDifferentLabel.png
        :alt:  An invalid selector box value is indicated by a warning message

        An invalid selector box value is indicated by a warning message


removeItems
===========

:aspect:`Datatype`
    list of values

:aspect:`Description`
    Change the list of items in :ref:`TCA type=select <t3tca:columns-select>` fields. Using this property,
    single items can be removed, leaving all others.

    This property is available for various levels:

    table level, example:
        `TCEFORM.tt_content.header_layout.removeItems`

    table and record type level, example:
        `TCEFORM.tt_content.header_layout.types.textpic.removeItems`

    Flex form field level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.myField.removeItems`

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.doktype {
            # Remove "Recycler" and "Spacer" page types
            removeItems = 199, 255
        }


sheetDescription
================

:aspect:`Datatype`
    localized string

:aspect:`Description`
    Specifies a description for the sheet shown in the FlexForm.

    This property is only available on flex form sheet level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.sheetDescription`


sheetShortDescr
===============

:aspect:`Datatype`
    localized string

:aspect:`Description`
    Specifies a short description of the sheet used as link title in the tab-menu.

    This property is only available on flex form sheet level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.sheetShortDescription`


sheetTitle
==========

:aspect:`Datatype`
    localized string

:aspect:`Description`
    Set the title of the sheet / tab in a FlexForm configuration.

    This property is only available on flex form sheet level, example:
        `TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF.sheetTitle`

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.tt_content.pi_flexform.my_ext_pi1.sDEF {
            # Rename the first tab of the FlexForm plug-in configuration
            sheetTitle = LLL:my_ext/Resource/Private/Language/locallang.xlf:tt_content.pi_flexform.my_ext_pi1.sDEF
        }


.. _pagetceformsuggest:

suggest
=======

Configuration of the suggest wizard that is available and often enabled
for :ref:`TCA type=group <t3tca:columns-group>` fields.

.. figure:: ../Images/TcaTypeGroupSuggest.png
    :alt: A configured suggest wizard

    A configured suggest wizard

The properties listed below are available on various levels. A more specific setting overrides
a less specific one:

Configuration of all suggest wizards in all tables for all target query tables:
    `TCEFORM.suggest.default`

Configuration of all suggest wizards in all tables looking up records from a specific target table:
    `TCEFORM.suggest.[queryTable]`

Configuration of one suggest wizard field in one table for all target query tables:
    `TCEFORM.[tableName].[fieldName].suggest.default`

Configuration of one suggest wizard field in one table for a specific target query table:
    `TCEFORM.[tableName].[fieldName].suggest.[queryTable]`

Configuration of one suggest wizard field in a flex form field of one table for all target query tables:
    `TCEFORM.[tableName].[fieldName].[dataStructureKey].[sheetName].[flexFieldName].suggest.default`

Configuration of one suggest wizard field in a flex form field of one table for a specific target query table:
    `TCEFORM.[tableName].[fieldName].[dataStructureKey].[sheetName].[flexFieldName].suggest.[queryTable]`


addWhere
--------

:aspect:`Datatype`
    string

:aspect:`Description`
    Additional WHERE clause (with AND at the beginning).

    Markers possible for replacement:

    * ###THIS_UID###
    * ###CURRENT_PID###
    * ###PAGE_TSCONFIG_ID###
    * ###PAGE_TSCONFIG_IDLIST###
    * ###PAGE_TSCONFIG_STR###

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.storage_pid.suggest.default {
            addWhere = AND pages.pid=###PAGE_TSCONFIG_ID###
        }


cssClass
--------

:aspect:`Datatype`
    string

:aspect:`Description`
    Add a CSS class to every list item of the result list.

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.suggest.pages {
            # Configure all suggest wizards which list records from table "pages"
            # to add the CSS class "pages" to every list item of the result list.
            cssClass = pages
        }


hide
----

:aspect:`Datatype`
    boolean

:aspect:`Description`
    Hide the suggest field. Works only for single fields.

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.storage_pid.suggest.default {
            hide = 1
        }


maxPathTitleLength
------------------

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Maximum number of characters to display when a path element is too long.

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.suggest.default {
            maxPathTitleLength = 30
        }


minimumCharacters
-----------------

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Minimum number of characters needed to start the search. Works only for single fields.

:aspect:`Default`
    2

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.storage_pid.suggest.default {
            minimumCharacters = 3
        }


pidDepth
--------

:aspect:`Datatype`
    positive integer

:aspect:`Description`
    Expand pidList by this number of levels. Only has an effect, if pidList has a value.

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.suggest.default {
            pidList = 6,7
            pidDepth = 4
        }


pidList
-------

:aspect:`Datatype`
    list of values

:aspect:`Description`
    Limit the search to certain pages (and their subpages). When pidList is empty all pages will be included
    in the search as long as the backend user is allowed to see them.

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.suggest.default {
            # sets the pidList for a suggest fields in all tables
            pidList = 1,2,3,45
        }


receiverClass
-------------

:aspect:`Datatype`
    PHP class name

:aspect:`Description`
    PHP class alternative receiver class - the file that holds the class should be derived
    from :code:`\TYPO3\CMS\Backend\Form\Element\SuggestDefaultReceiver`.

:aspect:`Default`
    :php:`\TYPO3\CMS\Backend\Form\Element\SuggestDefaultReceiver`


renderFunc
----------

:aspect:`Datatype`
    string

:aspect:`Description`
    User function to manipulate the displayed records in the result.


searchCondition
---------------

:aspect:`Datatype`
    string

:aspect:`Description`
    Additional WHERE clause (no AND needed to prepend).

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.storage_pid.suggest.default {
            # Configure the suggest wizard for the field "storage_pid" in table "pages"
            # to search only for pages with doktype=1
            searchCondition = doktype=1
        }


searchWholePhrase
-----------------

:aspect:`Datatype`
    boolean

:aspect:`Description`
    Whether to do a `LIKE=%mystring%` (searchWholePhrase = 1) or a `LIKE=mystring%` (to do a real find as you type).

:aspect:`Default`
    0

:aspect:`Example`
    .. code-block:: typoscript

        TCEFORM.pages.storage_pid.suggest.default {
            # Configure the suggest wizard for the field "storage_pid" in table "pages" to search only for whole phrases
           searchWholePhrase = 1
        }
