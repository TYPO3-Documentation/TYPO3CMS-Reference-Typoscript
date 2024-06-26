..  include:: /Includes.rst.txt
..  _FlexFormProcessor:
..  index:: FlexForm, DataProcessing

=================
FlexFormProcessor
=================

TYPO3 offers :ref:`FlexForms <t3coreapi:flexforms>` which can be used to store
data within an XML structure inside a single database column. The data processor
:php:`\TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor` converts the
FlexForm data of a given field into a Fluid-readable array.

..  _FlexFormProcessor-options:

Options
=======

..  _FlexFormProcessor-fieldname:

fieldname
---------

..  confval:: fieldname
    :name: FlexFormProcessor-fieldname
    :Required: false
    :type: :ref:`data-type-string`
    :Default: 'pi_flexform'

    Field name of the column the FlexForm data is stored in.


..  _FlexFormProcessor-as:

as
--

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

    10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor

The converted array can be accessed within the Fluid template with the
:html:`{flexFormData}` variable.

..  _FlexFormProcessor-example-advanced:

Example of an advanced TypoScript configuration
-----------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor
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

    10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor
    10 {
        fieldName = my_flexform_field
        as = myOutputVariable
        dataProcessing {
            10 = Vendor\MyExtension\DataProcessing\CustomFlexFormProcessor
        }
    }

