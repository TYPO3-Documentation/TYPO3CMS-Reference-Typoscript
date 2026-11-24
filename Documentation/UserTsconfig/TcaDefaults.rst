..  include:: /Includes.rst.txt
..  index:: TCAdefaults
..  highlight:: php
..  _usertstcadefaults:

===========
TCAdefaults
===========

..  versionadded:: 14.0
    The :typoscript:`TCAdefaults` configuration has been extended to support
    type-specific syntax enabling different default values based on the record type.

This allows `default` values of `TCA` fields that are available for various TCA
column types to be set or overridden, for instance for
:ref:`type=input <t3tca:columns-input-properties-default>`.

Default values can be set at the type level: `TCAdefaults.[table name].[field].types.[type]`
or field level: `TCAdefaults.[table name].[field]`

This key is also available at the :ref:`Page TSconfig level <pagetstcadefaults>`.
The order that default values are set when creating new records in the backend
is this:

#.  Database field default value
#.  Value from `$GLOBALS['TCA']`
#.  Field-level `user TSconfig <https://docs.typo3.org/permalink/t3tsref:usertstcadefaults>`_
#.  Type-level `user TSconfig <https://docs.typo3.org/permalink/t3tsref:usertstcadefaults>`_
#.  Field-level `page TSconfig <https://docs.typo3.org/permalink/t3tsref:pagetstcadefaults>`_
#.  Type-level `page TSconfig <https://docs.typo3.org/permalink/t3tsref:pagetstcadefaults>`_
#.  Value from "defVals" GET variables
#.  Value from previous record based on
    :ref:`useColumnsForDefaultValues <t3tca:ctrl-reference-usecolumnsfordefaultvalues>`

..  _usertstcadefaults-datahandler:

..  versionchanged:: 15.0
    :changelog: important-107327-1770297680

The :php:`\TYPO3\CMS\Core\DataHandling\DataHandler` uses the same order
when it creates a record, also for a field that the user has no access to:

#.  Value from `$GLOBALS['TCA']`, a value of the record type before the
    value of the field
#.  Field-level user TSconfig
#.  Type-level user TSconfig
#.  Field-level page TSconfig of the page the record is created on
#.  Type-level page TSconfig of the page the record is created on

The values that are given for the new record take precedence. The DataHandler
sets the default values for all fields of the table, also for the fields that
the record type does not show.

Example:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/user.tsconfig

    # Show newly created pages by default
    TCAdefaults.pages.hidden = 0

..  attention::

    This example will not work when creating the page from the context menu
    since this is triggered by the values listed in the `ctrl` section of
    :file:`typo3/sysext/core/Configuration/TCA/pages.php`:

    ..  literalinclude:: _codesnippets/_pages.php
        :caption: typo3/sysext/core/Configuration/TCA/pages.php
        :visible-lines: 1-4, 17, 63-65

If 'hidden' is in the list, it gets overridden with the "neighbor" record value (see
:php:`\TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::setDefaultsFromNeighborRow`)
and as the value is set - usually to '0' - it will not be overridden
again. To make it work as expected, that value must be overridden. This
can be done for example in the :file:`Configuration/TCA/Overrides` folder
of an extension:

..  code-block:: php
    :caption: EXT:my_sitepackage/Configuration/TCA/Overrides/pages.php

    $GLOBALS['TCA']['pages']['ctrl']['useColumnsForDefaultValues'] = 'doktype,fe_group';

..  _usertstcadefaults-example-types:

Example: Set type specific default values in user TSconfig
==========================================================

..  literalinclude:: _types.typoscript
    :caption: EXT:my_sitepackage/Configuration/user.tsconfig

In this example: if a user with no write access to the field `tt_content.header_layout`
creates a new content element of type `textmedia` the header layout will be set
to 3. If the user does have write access to the field, 3 will be used by default
and they may change it.
