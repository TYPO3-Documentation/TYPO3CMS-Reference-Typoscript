..  include:: /Includes.rst.txt
..  _CommaSeparatedValueProcessor:

============================
CommaSeparatedValueProcessor
============================

The :php:`CommaSeparatedValueProcessor` allows to split values into a
two-dimensional array used for :abbr:`CSV (Comma-separated values)` files or
:sql:`tt_content` records of CType `table`.

The table data is transformed to a multi-dimensional array, taking the delimiter
and enclosure into account, before it is passed to the view.


Options:
========

..  data-processor-csv:: if

    :Required: false
    :type: :ref:`if` condition
    :default: ""

    If the condition is met the data processor is processed.

..  data-processor-csv:: fieldName

    :Required: true
    :type: string, :ref:`stdWrap`
    :default: ''

    Name of the field in the processed ContentObjectRenderer.

..  data-processor-csv:: as

    :Required: false
    :type: string
    :default: defaults to the fieldName

    The variable's name to be used in the Fluid template.

..  data-processor-csv:: maximumColumns

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: 0

    Maximal number of columns to be transformed. Surplus columns will be
    silently dropped. When set to `0` (default) all columns will be
    transformed.

..  data-processor-csv:: fieldDelimiter

    :Required:  false
    :type: string(1), :ref:`stdWrap`
    :default: ','

    The field delimiter, a character separating the values.

..  data-processor-csv:: fieldEnclosure

    :Required:  false
    :type: string(1), :ref:`stdWrap`
    :default: '"'

    The field enclosure, a character surrounding the values.


Example: Transforming comma separated content into a html table
===============================================================

Please see also :ref:`dataProcessing-about-examples`.

In this example, the :php:`bodytext` field contains comma-separated
values (CSV) data. To support different formats, the separator between
the values can be specified.

This example is also described in-depth in :ref:`TYPO3 Explained:
Extended content element example <t3coreapi:AddingCE-Extended-Example>`.


Example data in the field :php:`bodytext`
-----------------------------------------

Field :sql:`bodytext` in table :sql:`tt_content`:

..  code-block:: text

    "This is row 1 column 1","This is row 1 column 2","This is row 1 column 3"
    "This is row 2 column 1","This is row 2 column 2","This is row 2 column 3"
    "This is row 3 column 1","This is row 3 column 2","This is row 3 column 3"


TypoScript
----------

We define the :typoscript:`dataProcessing` property to use the
:php:`CommaSeparatedValueProcessor`:

..  include:: /CodeSnippets/DataProcessing/TypoScript/CommaSeparatedValueProcessor.rst.txt

..  versionadded:: 12.1
    One can use the alias :typoscript:`comma-separated-value` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\CommaSeparatedValueProcessor`.

The Fluid template
------------------

In the Fluid template, you can iterate over the processed data. "myContentTable" can
be used as a variable :html:`{myContentTable}` inside Fluid for iteration.

..  include:: /CodeSnippets/DataProcessing/Template/DataProcCsv.rst.txt


Output
------

Using :typoscript:`maximumColumns` limits the amount of columns in the multi dimensional array.
In this example, the field data of the last column will be stripped off. Therefore the output would be:

..  include:: /Images/AutomaticScreenshots/DataProcessing/CommaSeparatedValueProcessor.rst.txt
