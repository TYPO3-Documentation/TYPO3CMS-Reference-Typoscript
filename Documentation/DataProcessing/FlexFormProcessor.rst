:navigation-title: flex-form
..  include:: /Includes.rst.txt
..  _FlexFormProcessor:
..  index:: FlexForm, DataProcessing

==========================
`flex-form` data processor
==========================

TYPO3 offers :ref:`FlexForms <t3coreapi:flexforms>` which can be used to store
data within an XML structure inside a single database column. The data processor
:php:`\TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor`,
alias `flex-form`, converts the
FlexForm data of a given field into a Fluid-readable array.

..  contents:: Table of contents

..  _FlexFormProcessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  _FlexFormProcessor-fieldname:

    ..  confval:: fieldname
        :name: FlexFormProcessor-fieldname
        :Required: false
        :type: :ref:`data-type-string`
        :Default: 'pi_flexform'

        Field name of the column the FlexForm data is stored in.


    ..  _FlexFormProcessor-references:

    ..  confval:: references
        :name: FlexFormProcessor-references

        ..  versionadded:: 13.0
        :Required: false
        :type: array

        Associative array of FlexForm fields (key) and the according database field
        (value).

        Each FlexForm field, which should be resolved, needs a reference definition
        to the :ref:`foreign_match_fields <t3tca:columns-inline-properties-foreign-match-fields>`.
        This reference is used in the :ref:`FilesProcessor <FilesProcessor>` to
        resolve the correct :ref:`FAL <t3coreapi:fal>` resource.

        See :ref:`FlexFormProcessor-resolving-fal`.


    ..  _FlexFormProcessor-as:

    ..  confval:: as
        :name: FlexFormProcessor-as
        :Required: false
        :type: :ref:`data-type-string`
        :Default: 'flexFormData'

        Name for the variable in the Fluid template.

..  _FlexFormProcessor-examples:

Examples
========

..  _FlexFormProcessor-example-minimal:

Example of a minimal TypoScript configuration
---------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    10 = flex-form

The converted array can be accessed within the Fluid template with the
:html:`{flexFormData}` variable.

..  _FlexFormProcessor-example-advanced:

Example of an advanced TypoScript configuration
-----------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    10 = flex-form
    10 {
        fieldName = my_flexform_field
        as = myOutputVariable
    }

The converted array can be accessed within the Fluid template with the
:html:`{myOutputVariable}` variable.

..  _FlexFormProcessor-example-sub-processor:

Example with a custom sub-processor
-----------------------------------

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    10 = flex-form
    10 {
        fieldName = my_flexform_field
        as = myOutputVariable
        dataProcessing {
            10 = Vendor\MyExtension\DataProcessing\CustomFlexFormProcessor
        }
    }

..  _FlexFormProcessor-resolving-fal:

Example of resolving FAL references
-----------------------------------

..  versionadded:: 13.0

Example of an advanced TypoScript configuration, which processes the field
:xml:`my_flexform_field`, resolves its FAL references and assigns the array to
the :typoscript:`myOutputVariable` variable:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    10 = flex-form
    10 {
      fieldName = my_flexform_field
      references {
        my_flex_form_group.my_flex_form_field = my_field_reference
      }
      as = myOutputVariable
    }

The according FlexForm configuration:

..  literalinclude:: _FlexFormWithFal.xml
    :language: xml
    :caption: Excerpt of a FlexForm configuration
