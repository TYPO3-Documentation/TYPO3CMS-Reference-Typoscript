..  include:: /Includes.rst.txt
..  index::
    TCAdefaults
    Records; Default values
..  _pageTsTcaDefaults:

===========
TCAdefaults
===========

..  versionadded:: 14.0
    The :typoscript:`TCAdefaults` configuration has been extended to support
    type-specific syntax similar to `TCEFORM <https://docs.typo3.org/permalink/t3tsref:tceform>`_,
    enabling different default values based on the record type.

This allows the `default` values of `TCA` fields available
for various TCA column types to be set or overridden, for instance for
:ref:`type=input <t3tca:columns-input-properties-default>`.

Default values can be set at the type level: `TCAdefaults.[table name].[field].types.[type]`
or field level: `TCAdefaults.[table name].[field]`

This key is also available at the :ref:`User TSconfig level <userTsTcaDefaults>`.
The order of setting default values when creating new records in the backend is
this:

#.  Database field default value
#.  Value from `$GLOBALS['TCA']`
#.  Field-level ref:`user TSconfig <userTsTcaDefaults>`
#.  Type-level ref:`user TSconfig <userTsTcaDefaults>`
#.  Field-level :typoscript:`TCAdefaults` configuration
#.  Type-level :typoscript:`TCAdefaults` configuration
#.  Value from "defVals" GET variables
#.  Value from previous record based on
    :ref:`useColumnsForDefaultValues <t3tca:ctrl-reference-usecolumnsfordefaultvalues>`

..  note::
    `TCAdefaults` are not applied to :ref:`FlexForm <t3coreapi:flexforms>` values.
    These can only be set via :xml:`<default>` elements within the
    FlexForm data structure.


..  _pageTsTcaDefaults-example:

Example: Do not hide newly created pages by default
===================================================

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCAdefaults.pages.hidden = 0

..  _pageTsTcaDefaults-example-type:

Example: Set type specific default values
=========================================

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCAdefaults.tt_content {
        header_layout = 1
        header_layout.types {
            textmedia = 3
            image = 2
        }

        frame_class = default
        frame_class.types {
            textmedia = ruler-before
            image = none
        }

        space_before_class = none
    }
