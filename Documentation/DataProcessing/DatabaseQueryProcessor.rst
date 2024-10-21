:navigation-title: database-query
..  include:: /Includes.rst.txt
..  _DatabaseQueryProcessor:

===============================
`database-query` data processor
===============================

..  versionadded:: 12.1
    One can use the alias :typoscript:`database-query` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor`.

The :php:`\TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor`,
alias `database-query`, fetches records from the database, using
standard TypoScript :ref:`select` semantics. The result is then passed to the
:ref:`cobj-fluidtemplate` as an array.

This way a :ref:`cobj-fluidtemplate` cObject can iterate over the
array of records.

..  contents:: Table of contents

..  versionadded:: 13.2
    The :typoscript:`database-query` processor can be used in combination with the
    :ref:`RecordTransformationProcessor` to use additional computed information.

..  _DatabaseQueryProcessor-options:

Options:
========

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  _DatabaseQueryProcessor-if:

    ..  confval:: if
        :name: DatabaseQueryProcessor-if
        :Required: false
        :type: :ref:`if` condition
        :Default: ''

        Only if the condition is met the data processor is executed.


    ..  _DatabaseQueryProcessor-table:

    ..  confval:: table
        :name: DatabaseQueryProcessor-table
        :Required: true
        :type: :ref:`data-type-string` / :ref:`stdWrap`
        :Default: ''

        Name of the table from which the records should be fetched.

    ..  _DatabaseQueryProcessor-as:

    ..  confval:: as
        :name: DatabaseQueryProcessor-as
        :Required: false
        :type: :ref:`data-type-string` / :ref:`stdWrap`
        :Default: 'records'

        The variable's name to be used in the Fluid template.

    ..  _DatabaseQueryProcessor-dataProcessing:

    ..  confval:: dataProcessing
        :name: DatabaseQueryProcessor-dataProcessing
        :Required: false
        :type: array of :ref:`dataProcessing`
        :Default: []

        Array of data processors to be applied to all fetched records.

    ..  note::
        All other options will be interpreted as in the TypoScript function
        :typoscript:`select`, including :typoscript:`pidInList`,
        :typoscript:`orderBy`, :typoscript:`where`, etc. See the reference of
        :ref:`select`.

    ..  warning::
        When using the DatabaseQueryProcessor, you may encounter issues with
        language and/or versioning overlays, that currently can not be resolved.
        See `here <https://forge.typo3.org/issues/85284#note-5>`__ for more
        information.

..  _DatabaseQueryProcessor-example-record-transformation:

Example: Usage in combination with the RecordTransformationProcessor
====================================================================

..  versionadded:: 13.2

Example usage for the data processor in conjunction with the
:ref:`RecordTransformationProcessor`.

..  literalinclude:: _RecordTransformationProcessor/_WithDatabaseQueryProcessor.typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

For usage of the variables within Fluid see
:ref:`RecordTransformationProcessor-fluidtemplate-example`.


..  _DatabaseQueryProcessor-examples:

Example: Display haiku records
==============================

Please see also :ref:`dataProcessing-about-examples`.

..  rubric:: TypoScript

We define the :typoscript:`dataProcessing` property to use the
:php:`DatabaseQueryProcessor`:

..  include:: /CodeSnippets/DataProcessing/TypoScript/DatabaseQueryProcessor.rst.txt

..  rubric:: The Fluid template

In the Fluid template then iterate over the records. As we used the recursive
data processor :ref:`FilesProcessor` on the image records, we can also output
the images.

..  include:: /CodeSnippets/DataProcessing/Template/DataProcDb.rst.txt

..  rubric:: Output

Each entry of the records array contains the data of the table in :php:`data`
and the data of the images in :php:`files`.

..  figure:: /Images/ManualScreenshots/FrontendOutput/DataProcessing/DatabaseProcessor.png
    :class: with-shadow
    :alt: Haiku record data dump and output

    Haiku record data dump and output
