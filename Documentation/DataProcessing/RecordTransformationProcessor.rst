..  include:: /Includes.rst.txt
..  _RecordTransformationProcessor:

=============================
RecordTransformationProcessor
=============================

..  versionadded:: 13.2
    A new TypoScript data processor for :ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` and
    :typoscript:`PAGEVIEW` has been added.

The :typoscript:`record-transformation` Data Processor can typically be used in
conjunction with the DatabaseQuery Data Processor. The DatabaseQuery Data
Processor typically fetches records from the database, and the
:typoscript:`record-transformation` will take the result, and transforms
the objects into :php:`Record` objects, which contain only relevant data from
the TCA table, which has been configured in the TCA `columns` fields for this
record.

This is especially useful for TCA tables, which contain "types" (such as pages
or tt_content database tables), where only relevant fields are added to the
record object. In addition, special fields from "enableColumns" or deleted
fields, next to language and version information are extracted so they can be
addressed in a unified way.

The `type` property contains the database table name and the actual type based
on the record, such `tt_content.textmedia` for Content Elements.

..  note::

    The Record object is available but details are still to be finalized in
    the API until TYPO3 v13 LTS. Right now only the usage in Fluid is public
    API.

..  _RecordTransformationProcessor-databasequeryprocessor-example:

Example: Usage with the DatabaseQueryProcessor
==============================================

Example usage for the Data Processor in conjunction with the
:ref:`DatabaseQueryProcessor`.

..  literalinclude:: _RecordTransformationProcessor/_WithDatabaseQueryProcessor.typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript


..  _RecordTransformationProcessor-fluidtemplate-example:

Example: Usage with FLUIDTEMPLATE
=================================

Transform the current data array of :ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` to a record
object. This can be used for Content Elements of :ref:`Fluid Styled Content <typo3/cms-fluid-styled-content:start>` or
custom ones. In this example the Fluid Styled Content
element "Text" has its data transformed for easier and enhanced usage.

..  literalinclude:: _RecordTransformationProcessor/_WithDatabaseFluidTemplate.typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

..  _RecordTransformationProcessor-fluid:

Usage in Fluid
==============

The :html:`f:debug` output of the Record object is misleading for integrators,
as most properties are accessed differently as one would assume. The debug view
is most of all a better organized overview of all available information. E.g.
the property `properties` lists all relevant fields for the current Content
Type.

We are dealing with an object here, which behaves like an array. In short: you
can access your record properties as you are used to with :html:`{record.title}`
or :html:`{record.uid}`. In addition, you gain special, context-aware properties
like the language :html:`{record.languageId}` or workspace
:html:`{data.versionInfo.workspaceId}`.

Overview of all possibilities:

..  literalinclude:: _RecordTransformationProcessor/_FluidUsage.html
    :caption: Demonstration of available variables in Fluid

..  _RecordTransformationProcessor-options:

Options:
========

..  confval:: as
    :name: RecordTransformationProcessor-as
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default: 'record' or 'records'

    The target variable where the resolved record objects are contained
    if empty, 'record' or 'records' (if multiple records are given) is used.

..  confval:: if
    :name: RecordTransformationProcessor-if
    :type: :ref:`if` condition
    :Default: ''

    Only if the condition is met the Data Processor is executed.

..  confval:: table
    :name: RecordTransformationProcessor-table
    :type: :ref:`data-type-string`
    :Default: auto-resolved

    The name of the database table of the records. Leave empty to auto-resolve
    the table from context.

    If you are dealing with a custom data source you can adjust it here.

..  confval:: variableName
    :name: RecordTransformationProcessor-variableName
    :type: :ref:`data-type-string`
    :Default: 'data'

    The variable that contains the record(s) from a previous Data Processor,
    or from a :ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` view.

    If you are dealing with a custom data source you can adjust it here.
