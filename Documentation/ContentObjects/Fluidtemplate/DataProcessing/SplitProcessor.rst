..  include:: /Includes.rst.txt
..  _splitProcessor:

==============
SplitProcessor
==============

The :php:`SplitProcessor` allows to split values separated with a delimiter
from a single database field. The result is an array that can be iterated over.
Whitespaces are automatically trimmed.


Options
=======

..  _splitProcessor-if:

..  confval:: if

    :Required: false
    :Data type: :ref:`if` condition
    :default: ''

    Only if the condition is met the data processor is executed.


..  _splitProcessor-fieldName:

..  confval:: fieldName

    :Required: true
    :Data type: :ref:`data-type-string` / :ref:`stdWrap`
    :default: ''

    Name of the field to be used.


..  _splitProcessor-as:

..  confval:: as

    :Required: false
    :Data type: :ref:`data-type-string`
    :default: defaults to the fieldName

    The variable name to be used in the Fluid template.


..  _splitProcessor-delimiter:

..  confval:: delimiter

    :Required: false
    :Data type: :ref:`data-type-string` / :ref:`stdWrap`
    :default: Line Feed
    :Example: ","

    The field delimiter, a character separating the values.


..  _splitProcessor-filterIntegers:

..  confval:: filterIntegers

    :Required: false
    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`
    :default: 0
    :Example: 1

    If set to `1`, all values are being cast to int.


..  _splitProcessor-filterUnique:

..  confval:: filterUnique

    :Required: false
    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`
    :default: 0
    :Example: 1

    If set to `1`, all duplicates will be removed.


..  _splitProcessor-removeEmptyEntries:

..  confval:: removeEmptyEntries

    :Required: false
    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`
    :default: 0
    :Example: 1

    If set to `1`, all empty values will be removed.


Example: Splitting a URL
========================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

With the help of the :php:`SplitProcessor` the following scenario is
possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/SplitProcessor.rst.txt

The Fluid template
------------------

In the Fluid template then iterate over the split data:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcSplit.rst.txt


Output
------

The array now contains the split strings:

..  include:: /Images/AutomaticScreenshots/DataProcessing/SplitProcessor.rst.txt
