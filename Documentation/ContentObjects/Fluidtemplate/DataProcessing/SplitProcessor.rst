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
possible::

   tt_content {
      examples_dataprocsplit =< lib.contentElement
      examples_dataprocsplit {
         templateName = DataProcSplit
         dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\SplitProcessor
         dataProcessing.10 {
            as = urlParts
            delimiter = /
            fieldName = header_link
            removeEmptyEntries = 0
            filterIntegers = 0
            filterUnique = 0
         }
      }
   }


The Fluid template
------------------

In the Fluid template then iterate over the splitted data:

.. code-block:: html

   <html data-namespace-typo3-fluid="true" xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers">
      <h2>Data in variable urlParts</h2>
      <f:debug inline="true">{urlParts}</f:debug>

      <h2>Output</h2>
      <f:for each="{urlParts}" as="part" iteration="i">
         <span class="text-primary">{part}</span>
         <f:if condition="{i.isLast} == false">/</f:if>
      </f:for>

   </html>


Output
------

The array now contains the split strings:

.. figure:: /Images/ManualScreenshots/Fluidtemplate/SplitProcessor.png
   :class: with-shadow
   :alt: split dump and output
