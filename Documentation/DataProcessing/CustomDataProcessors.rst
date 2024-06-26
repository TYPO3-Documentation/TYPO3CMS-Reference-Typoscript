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

..  include:: /CodeSnippets/DataProcessing/TypoScript/CustomCategoryProcessor.rst.txt

The available configuration depends on the implementation of the
specific custom data processor, of course.

..  versionadded:: 12.1
    One can configure a custom alias in :file:`Configuration/Services.yaml`
    and use it in TypoScript instead of the fully-qualified class name.


Example output
==============

.. include:: /Images/AutomaticScreenshots/DataProcessing/CustomDataProcessors.rst.txt

