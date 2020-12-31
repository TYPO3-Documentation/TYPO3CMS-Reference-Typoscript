.. include:: /Includes.txt

.. _cobj-fluidtemplate-properties-dataprocessing:
.. _dataProcessing:

==============
dataProcessing
==============

:typoscript:`dataProcessing` is a property of :ref:`cobj-fluidtemplate`.


.. rst-class:: dl-parameters

dataProcessing
   :sep:`|` :aspect:`Data type:` array of class references by full namespace
   :sep:`|`

   Add one or multiple processors to manipulate the :php:`$data` variable of
   the currently rendered content object, like tt_content or page. The sub-
   property :ts:`options` can be used to pass parameters to the processor
   class.

There are several DataProcessors available to allow flexible processing e.g.
for comma-separated values.

.. toctree::
   :titlesonly:

   DataProcessing/CommaSeparatedValueProcessor
   DataProcessing/DatabaseQueryProcessor
   DataProcessing/FilesProcessor
   DataProcessing/GalleryProcessor
   DataProcessing/LanguageMenuProcessor
   DataProcessing/MenuProcessor
   DataProcessing/SiteProcessor
   DataProcessing/SplitProcessor
   DataProcessing/CustomDataProcessors

