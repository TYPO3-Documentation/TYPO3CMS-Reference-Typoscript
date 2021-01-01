.. include:: /Includes.txt
.. _splitProcessor:

==============
SplitProcessor
==============

The :php:`SplitProcessor` allows to split values separated with a delimiter
inside a single database field into an array to loop over it. Whitespaces will
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



Example: Splitting keywords into an array
=========================================

With the help of the :php:`SplitProcessor` the following scenario is
possible::

   page {
      10 = FLUIDTEMPLATE
      10 {
         file = EXT:site_default/Resources/Private/Template/Default.html

         dataProcessing.2 = TYPO3\CMS\Frontend\DataProcessing\SplitProcessor
         dataProcessing.2 {
            if.isTrue.field = bodytext
            delimiter = ,
            fieldName = bodytext
            removeEmptyEntries = 1
            filterIntegers = 0
            filterUnique = 1
            as = keywords
         }
      }
   }

In the Fluid template then iterate over the splitted data:

.. code-block:: html

   <f:for each="{keywords}" as="keyword">
      <li>Keyword: {keyword}</li>
   </f:for>
