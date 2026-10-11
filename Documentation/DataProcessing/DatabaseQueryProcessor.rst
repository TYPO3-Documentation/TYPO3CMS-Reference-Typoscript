:navigation-title: database-query
..  include:: /Includes.rst.txt
..  _databasequeryprocessor:

===============================
`database-query` data processor
===============================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor`,
alias `database-query`, fetches records from the database, using
standard TypoScript :ref:`select <select>` semantics. The result is then passed to the
:ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` as an array.

This way a :ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` cObject can iterate over the
array of records.

The :typoscript:`database-query` processor can be used in combination with the
:ref:`record-transformation data processor <recordtransformationprocessor>` to use additional computed information.

..  contents:: Table of contents

..  _databasequeryprocessor-options:

Options:
========

..  confval-menu::
    :display: table
    :type:
    :default:

    ..  _databasequeryprocessor-if:

    ..  rubric:: if

    ..  confval:: if
        :name: DatabaseQueryProcessor-if
        :type: :ref:`if <if>` condition
        :default: ''

        Only if the condition is met the data processor is executed.

    ..  _databasequeryprocessor-table:

    ..  rubric:: table

    ..  confval:: table
        :name: DatabaseQueryProcessor-table
        :required: true
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: ''

        Name of the table from which the records should be fetched.

    ..  _databasequeryprocessor-as:

    ..  rubric:: as

    ..  confval:: as
        :name: DatabaseQueryProcessor-as
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: 'records'

        The variable's name to be used in the Fluid template.

    ..  _databasequeryprocessor-dataprocessing:

    ..  rubric:: dataProcessing

    ..  confval:: dataProcessing
        :name: DatabaseQueryProcessor-dataProcessing
        :type: array of :ref:`Data processors <dataprocessing>`
        :default: []

        Array of data processors to be applied to all fetched records.

    ..  note::
        All other options will be interpreted as in the TypoScript function
        :typoscript:`select`, including :typoscript:`pidInList`,
        :typoscript:`orderBy`, :typoscript:`where`, etc. See the reference of
        :ref:`select <select>`.

    ..  warning::
        When using the DatabaseQueryProcessor, you may encounter issues with
        language and/or versioning overlays, that currently can not be resolved.
        See `here <https://forge.typo3.org/issues/85284#note-5>`__ for more
        information.

..  _databasequeryprocessor-example-record-transformation:

Example: Usage in combination with the RecordTransformationProcessor
====================================================================

Example usage for the data processor in conjunction with the
:ref:`record-transformation data processor <recordtransformationprocessor>`.

..  literalinclude:: _RecordTransformationProcessor/_WithDatabaseQueryProcessor.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

For usage of the variables within Fluid see
:ref:`Example: Usage with FLUIDTEMPLATE <recordtransformationprocessor-fluidtemplate-example>`.


..  _databasequeryprocessor-examples:

Example: Display speaker records
================================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.

In this example, an extension stores the speakers of a conference in the
table `tx_myextension_speaker`, with the fields `name`, `company`, `bio`, and
`photo`. A content element lists the speakers from the folder in its field
`pages`.

..  rubric:: TypoScript

We define the :typoscript:`dataProcessing` property to use the
:php-short:`\TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor`:

..  literalinclude:: /CodeSnippets/my_extension/Configuration/Sets/Main/setup.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

..  rubric:: The Fluid template

In the Fluid template, iterate over the records. As the
:ref:`files data processor <filesprocessor>` processes the photo of each
record, the template can output the photos as well.

..  literalinclude:: /CodeSnippets/my_extension/Resources/Private/Templates/ContentElements/Speakers.fluid.html
    :caption: EXT:my_extension/Resources/Private/Templates/ContentElements/Speakers.fluid.html

..  rubric:: Output

Each entry of the records array contains the data of the table in `data`
and the data of the photo in `files`.

..  figure:: /Images/GeneratedScreenshots/DataProcessing/DatabaseQueryProcessor.png
    :class: with-shadow
    :alt: Dump of the variable speakers with 3 records, each with data and
        files, and three cards: Alex Example of Example Agency with a photo,
        Kai Muster of Muster AG, and Robin Sample of Sample Ltd, each with a
        short biography

..  _databasequeryprocessor-examples:

Example: Display sorted records from an MM table working with workspaces
========================================================================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.

We define the :typoscript:`dataProcessing` property to use the
:php-short:`\TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor`. To make
use of the `sorting` field in the MM table, a join is required.

However, performing this join will cause the fields from the MM table to be selected in the query. This can break the output when previewing the page using workspaces.

To prevent this issue, we use the :typoscript:`selectFields` property to explicitly define which fields should be retrieved.

..  literalinclude:: /CodeSnippets/DataProcessing/TypoScript/DatabaseQueryProcessorForMMTablesAndWorkspaces.typoscript
    :caption: config/sites/my-site/setup.typoscript
