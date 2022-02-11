.. include:: /Includes.rst.txt
.. _splitProcessor:

==============
SplitProcessor
==============

The :php:`SplitProcessor` allows split values separated with a delimiter
inside a single database field to be put into an array and looped over. Whitespaces will
be automatically trimmed.


Options:
========

.. confval:: if

   :Required: false
   :type: :ref:`if` condition
   :default: ''

   If the condition is not met the data is not processed

.. confval:: fieldName

   :Required: true
   :type: string, :ref:`stdWrap`
   :default: ''

   Name of the field to be used

.. confval:: as

   :Required: false
   :type: string
   :default: defaults to the fieldName

   The variable's name to be used in the Fluid template

.. confval:: delimiter

   :Required: false
   :type: string(1), :ref:`stdWrap`
   :default: Line Feed
   :Example: ","

   The field delimiter, a character separating the values.

.. confval:: filterIntegers

   :Required: false
   :type: bool, :ref:`stdWrap`
   :default: false
   :Example: true

   If set to true all values are being cast to int


.. confval:: filterUnique

   :Required: false
   :type: bool, :ref:`stdWrap`
   :default: false
   :Example: true

   All duplicates will be removed

.. confval:: removeEmptyEntries

   :Required: false
   :type: bool, :ref:`stdWrap`
   :default: false
   :Example: true

   All empty values will be removed



Example: Splitting an URL
=========================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

With the help of the :php:`SplitProcessor` the following scenario is
possible:

.. include:: /CodeSnippets/DataProcessing/TypoScript/SplitProcessor.rst.txt

The Fluid template
------------------

In the Fluid template then iterate over the splitted data:

.. code-block:: html

.. include:: /CodeSnippets/DataProcessing/Template/DataProcSplit.rst.txt


Output
------

The array now contains the split strings:

.. include:: /Images/AutomaticScreenshots/DataProcessing/SplitProcessor.rst.txt
