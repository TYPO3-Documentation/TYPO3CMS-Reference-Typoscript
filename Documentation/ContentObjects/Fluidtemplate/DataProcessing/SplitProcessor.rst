.. include:: /Includes.txt
.. _splitProcessor:

==============
SplitProcessor
==============

The :php:`SplitProcessor` allows to split values separated with a delimiter
inside a single database field into an array to loop over it.

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
