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

.. rst-class:: dl-parameters

if
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` :ref:`if` condition
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   If the condition is not met the data is not processed

fieldName
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` string, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   Name of the field to be used

as
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string
   :sep:`|` :aspect:`Default:` defaults to the fieldName
   :sep:`|`

   The variable's name to be used in the Fluid template

delimiter
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string(1), :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` Line Feed
   :sep:`|` :aspect:`Example:` ","
   :sep:`|`

   The field delimiter, a character separating the values.

filterIntegers
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` bool, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` false
   :sep:`|` :aspect:`Example:` true
   :sep:`|`

   If set to true all values are being cast to int


filterUnique
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` bool, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` false
   :sep:`|` :aspect:`Example:` true
   :sep:`|`

   All duplicates will be removed

removeEmptyEntries
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` bool, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` false
   :sep:`|` :aspect:`Example:` true
   :sep:`|`

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
