..  include:: /Includes.rst.txt
..  _customdataprocessors:

======================
Custom data processors
======================

Implementing a custom data processor is out of scope in this reference.
You can find information on the implementation in :ref:`TYPO3 Explained
<t3coreapi:content-elements-custom-data-processor>`.

Custom data processors can be used in TypoScript just like any other
data processor:

..  literalinclude:: /CodeSnippets/DataProcessing/TypoScript/CustomCategoryProcessor.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

The available configuration depends on the implementation of the
specific custom data processor.

..  rubric:: Example output

..  figure:: /Images/GeneratedScreenshots/DataProcessing/CustomDataProcessors.png
    :zoom: lightbox
    :alt: Debug output of the variable "categories", an array of two category
        records, and the output of the template: a list of the categories
        "TypoScript" and "Fluid"
