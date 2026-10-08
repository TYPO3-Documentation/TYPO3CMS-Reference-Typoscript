:navigation-title: split
..  include:: /Includes.rst.txt
..  _splitprocessor:

======================
`split` data processor
======================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\SplitProcessor`,
alias `split`, allows to split values separated with a delimiter
from a single database field. The result is an array that can be iterated over.
Whitespaces are automatically trimmed.

..  contents:: Table of contents

..  _splitprocessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :default:

    ..  _splitprocessor-if:

    ..  rubric:: if

    ..  confval:: if
        :name: splitProcessor-if
        :type: :ref:`if <if>` condition
        :default: ''

        Only if the condition is met the data processor is executed.

    ..  _splitprocessor-fieldname:

    ..  rubric:: fieldName

    ..  confval:: fieldName
        :name: splitProcessor-fieldName
        :required: true
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: ''

        Name of the field to be used.

    ..  _splitprocessor-as:

    ..  rubric:: as

    ..  confval:: as
        :name: splitProcessor-as
        :type: :ref:`string <data-type-string>`
        :default: defaults to the fieldName

        The variable name to be used in the Fluid template.

    ..  _splitprocessor-delimiter:

    ..  rubric:: delimiter

    ..  confval:: delimiter
        :name: splitProcessor-delimiter
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: Line Feed
        :Example: ","

        The field delimiter, a character separating the values.

    ..  _splitprocessor-filterintegers:

    ..  rubric:: filterIntegers

    ..  confval:: filterIntegers
        :name: splitProcessor-filterIntegers
        :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdwrap>`
        :default: 0
        :Example: 1

        If set to `1`, all values are being cast to int.

    ..  _splitprocessor-filterunique:

    ..  rubric:: filterUnique

    ..  confval:: filterUnique
        :name: splitProcessor-filterUnique
        :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdwrap>`
        :default: 0
        :Example: 1

        If set to `1`, all duplicates will be removed.

    ..  _splitprocessor-removeemptyentries:

    ..  rubric:: removeEmptyEntries

    ..  confval:: removeEmptyEntries
        :name: splitProcessor-removeEmptyEntries
        :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdwrap>`
        :default: 0
        :Example: 1

        If set to `1`, all empty values will be removed.

..  _splitprocessor-example-split-url:

Example: Splitting a URL
========================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.


..  rubric:: TypoScript

With the help of the
:php-short:`\TYPO3\CMS\Frontend\DataProcessing\SplitProcessor` the following
scenario is possible:

..  literalinclude:: /CodeSnippets/DataProcessing/TypoScript/SplitProcessor.typoscript
    :caption: EXT:examples/Configuration/TypoScript/DataProcessors/Processors/SplitProcessor.typoscript

..  rubric:: The Fluid template

In the Fluid template then iterate over the split data:

..  literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcSplit.fluid.html
    :caption: EXT:examples/Resources/Private/Templates/ContentElements/DataProcSplit.fluid.html

..  rubric:: Output

The array now contains the split strings:

..  figure:: /Images/ManualScreenshots/DataProcessing/SplitProcessor.png
    :zoom: lightbox
    :alt: Output of a SplitProcessor, including debug output
