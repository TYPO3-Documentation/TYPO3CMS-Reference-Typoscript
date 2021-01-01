.. include:: /Includes.txt
.. _DatabaseQueryProcessor:

======================
DatabaseQueryProcessor
======================

The :php:`DatabaseQueryProcessor` fetches records from the database,
using the default :ref:`select` semantics  from TypoScript. The result
then gets handed over to the :ref:`cobj-fluidtemplate` as an array.

This way a :ref:`cobj-fluidtemplate` cObject can iterate over the
array of records.


Options:
========

.. rst-class:: dl-parameters

if
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` :ref:`if` condition
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   If the condition is not met the data is not processed

table
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` string, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   Name of the table from which the records should be fetched

as
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` 'records'
   :sep:`|`

   The variable's name to be used in the Fluid template

dataProcessing
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` array of :ref:`dataProcessing`
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   Array of DataProcessors to be applied to all fetched records.


.. note:: all other options will be interpreted as in the typoscript function
   "select", including :typoscript:`pidInList``, :typoscript:`orderBy`,
   :typoscript:`where` etc. See the reference of ref:`select`.


Example: Selecting all tt_address records from pid 13 and 14
============================================================


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
         as = myRecords

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
      <f:for each="{myRecords}" as="record">
         <li>
            <f:image image="{record.files.0}" />
            <a href="{record.data.www}">{record.data.first_name} {record.data.last_name}</a>
         </li>
      </f:for>
   </ul>
