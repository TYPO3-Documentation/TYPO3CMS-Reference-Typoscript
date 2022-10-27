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

Options
========

..  confval:: fieldname

    :Required: false
    :type: string
    :default: 'pi_flexform'

    Field name of the column the FlexForm data is stored in.

..  confval:: as

    :Required: false
    :type: string
    :default: 'flexFormData'

    Name for the variable in the Fluid template..

Examples
========

Example of a minimal TypoScript configuration
---------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor

The converted array can be accessed within the Fluid template with the
:html:`{flexFormData}` variable.

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

