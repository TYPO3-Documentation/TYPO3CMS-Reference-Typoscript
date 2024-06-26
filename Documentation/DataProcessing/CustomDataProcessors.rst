.. include:: /Includes.rst.txt
.. _CustomDataProcessors:

======================
Custom data processors
======================

Implementing a custom data processor is out of scope in this reference.
You can find information on the implementation in :ref:`TYPO3 Explained
<t3coreapi:content-elements-custom-data-processor>`.

Custom data processors can be used in TypoScript just like any other
data processor:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   tt_content {
      examples_dataproccustom =< lib.contentElement
      examples_dataproccustom {
         templateName = DataProcCustom
         dataProcessing.10 = T3docs\Examples\DataProcessing\CustomCategoryProcessor
         dataProcessing.10 {
            as = categories
            categoryList.field = tx_examples_main_category
         }
      }
   }

The available configuration depends on the implementation of the
specific custom data processor, of course.


Example output
==============

.. include:: /Images/AutomaticScreenshots/DataProcessing/CustomDataProcessors.rst.txt

