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

..  t3-data-processor-flex:: fieldname

    :Required: false
    :type: string
    :default: 'pi_flexform'

    Field name of the column the FlexForm data is stored in.

..  t3-data-processor-flex:: as

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

    # Before TYPO3 v12.1 you have to specify the fully-qualified class name of the processor
    # dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor
    # Since TYPO3 v12.1 one can also use the available alias
    10 = flex-form

..  versionadded:: 12.1
    One can use the alias :typoscript:`flex-form` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor`.

The converted array can be accessed within the Fluid template with the
:html:`{flexFormData}` variable.

Example of an advanced TypoScript configuration
-----------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    # Before TYPO3 v12.1 you have to specify the fully-qualified class name of the processor
    # dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor
    # Since TYPO3 v12.1 one can also use the available alias
    10 = flex-form
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

    # Before TYPO3 v12.1 you have to specify the fully-qualified class name of the processor
    # dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\FlexFormProcessor
    # Since TYPO3 v12.1 one can also use the available alias
    10 = flex-form
    10 {
        fieldName = my_flexform_field
        as = myOutputVariable
        dataProcessing {
            10 = Vendor\MyExtension\DataProcessing\CustomFlexFormProcessor
        }
    }

