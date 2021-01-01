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

.. confval:: if

   :Required: false
   :type: :ref:`if` condition
   :default: ''

   If the condition is not met the data is not processed

.. confval:: table

   :Required: true
   :type: string, :ref:`stdWrap`
   :default: ''

   Name of the table from which the records should be fetched

.. confval:: as

   :Required: false
   :type: string, :ref:`stdWrap`
   :default: 'records'

   The variable's name to be used in the Fluid template

.. confval:: dataProcessing

   :Required: false
   :type: array of :ref:`dataProcessing`
   :default: ''

   Array of DataProcessors to be applied to all fetched records.


.. note:: all other options will be interpreted as in the TypoScript function
   "select", including :typoscript:`pidInList`, :typoscript:`orderBy`,
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
