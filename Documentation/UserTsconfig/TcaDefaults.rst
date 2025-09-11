..  include:: /Includes.rst.txt
..  index:: TCAdefaults
..  highlight:: php
..  _userTsTcaDefaults:

===========
TCAdefaults
===========

..  versionadded:: 14.0
    The :typoscript:`TCAdefaults` configuration has been extended to support
    type-specific syntax enabling different default values based on the record type.

This allows to set or override the `default` values of `TCA` fields that is available
for various TCA column types, for instance for :ref:`type=input <t3tca:columns-input-properties-default>`.

Default values can be set on type level: `TCAdefaults.[table name].[field].types.[type]`
or field level: `TCAdefaults.[table name].[field]`.

This key is also available on :ref:`Page TSconfig level <pageTsTcaDefaults>`, the order of default
values when creating new records in the backend is this:


#.  Database field default value
#.  Value from `$GLOBALS['TCA']`
#.  Field-level ref:`user TSconfig <userTsTcaDefaults>`
#.  Type-level ref:`user TSconfig <userTsTcaDefaults>`
#.  Field-level :typoscript:`TCAdefaults` configuration
#.  Type-level :typoscript:`TCAdefaults` configuration
#.  Value from "defVals" GET variables
#.  Value from previous record based on
    :ref:`useColumnsForDefaultValues <t3tca:ctrl-reference-usecolumnsfordefaultvalues>`

However the order for default values used by :php:`\TYPO3\CMS\Core\DataHandling\DataHandler` if a certain
field is not granted access to for user will be:

#.  Value from :php:`$GLOBALS['TCA']`
#.  Value from User TSconfig (these settings)

So these values will be authoritative if the user has no access to the field anyway.

Example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    # Show newly created pages by default
    TCAdefaults.pages.hidden = 0

..  attention::

    This example will not work when creating the page from the context menu
    since this is triggered by the values listed in the `ctrl` section of
    :file:`typo3/sysext/core/Configuration/TCA/pages.php`:

    ..  code-block:: php
        :caption: typo3/sysext/core/Configuration/TCA/pages.php

        'ctrl' => [
          'useColumnsForDefaultValues' => 'doktype,fe_group,hidden',
          ...
        ]

If 'hidden' is in the list, it gets overridden with the "neighbor" record value (see
:php:`\TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::setDefaultsFromNeighborRow`)
and as the value is set - usually to '0' - it will not be overridden
again. To make it work as expected, that value must be overridden. This
can be done for example in the :file:`Configuration/TCA/Overrides` folder
of an extension:

..  code-block:: php
   :caption: EXT:site_package/Configuration/TCA/Overrides/pages.php

   $GLOBALS['TCA']['pages']['ctrl']['useColumnsForDefaultValues'] = 'doktype,fe_group';

..  _userTsTcaDefaults-example-types:

Example: Set type specific default values in user TSconfig
==========================================================

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    TCAdefaults.tt_content {
        header_layout = 1
        # Use specific default values for certain types
        header_layout.types {
            textmedia = 3
            image = 2
        }
    }

In this example: If a user with no write access to the field `tt_content.header_layout`
creates a new content element of type `textmedia` the header layout will be set
to 3. If the user does have write access to the field, 3 will be used as default
and they may change it.
