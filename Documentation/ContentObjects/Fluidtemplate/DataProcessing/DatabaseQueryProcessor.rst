.. include:: /Includes.txt
.. _DatabaseQueryProcessor:

======================
DatabaseQueryProcessor
======================

The :php:`DatabaseQueryProcessor` works like the code from the Content Object
CONTENT, except for just handing over the result as array. A :ts:`FLUIDTEMPLATE`
can then simply iterate over processed data automatically.


Using the :php:`DatabaseQueryProcessor` the following scenario is possible::

   tt_content.mycontent.20 = FLUIDTEMPLATE
   tt_content.mycontent.20 {
      file = EXT:site_default/Resources/Private/Templates/ContentObjects/MyContent.html

      dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor
      dataProcessing.10 {
         # regular if syntax
         if.isTrue.field = records

         # the table name from which the data is fetched from
         # + stdWrap
         table = tt_address

         # All properties from .select :ref:`select` can be used directly
         # + stdWrap
         orderBy = sorting
         pidInList = 13,14

         # The target variable to be handed to the ContentObject again, can
         # be used in Fluid e.g. to iterate over the objects. defaults to
         # "records" when not defined
         # + stdWrap
         as = myrecords

         # The fetched records can also be processed by DataProcessors.
         # All configured processors are applied to every row of the result.
         dataProcessing {
            10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
            10 {
               references.fieldName = image
            }
         }
      }
   }

In the Fluid template then iterate over the files:

.. code-block:: html

   <ul>
   <f:for each="{myrecords}" as="record">
      <li>
         <f:image image="{record.files.0}" />
         <a href="{record.data.www}">{record.data.first_name} {record.data.last_name}</a>
      </li>
   </f:for>
   </ul>
