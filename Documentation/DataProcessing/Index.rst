..  include:: /Includes.rst.txt

..  _cobj-fluidtemplate-properties-dataprocessing:
..  _dataprocessing:

===============
Data processors
===============

:ref:`dataProcessing <fluidtemplate-dataprocessing>` is a property of
:ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` and :ref:`PAGEVIEW <cobj-pageview>`.

The property adds one or multiple processors to manipulate the :php:`$data`
variable of the currently rendered content object, like tt_content or page.
The sub-property :typoscript:`dataProcessing.options` can be used to pass
parameters to the processor class.

There are several data processors available to allow flexible processing,
for example for comma-separated values, related files or related records.

..  toctree::
    :titlesonly:

    CommaSeparatedValueProcessor
    DatabaseQueryProcessor
    FilesProcessor
    FlexFormProcessor
    GalleryProcessor
    LanguageMenuProcessor
    MenuProcessor/Index
    PageContentFetchingProcessor
    RecordTransformationProcessor
    SiteProcessor
    SiteLanguageProcessor
    SplitProcessor
    CustomDataProcessors

..  _dataprocessing-about-examples:

About the examples
==================

The examples come from an extension, `my_extension`. Each example defines a
content element type of its own in the TypoScript setup of the extension, and
renders it with a Fluid template from the extension. To add a content element
type, see :ref:`Create a custom content element type (CType)
<t3coreapi:adding-your-own-content-elements>`.

You can also use data processors in page templates. There they work on the
page record, and all fields of the `pages` table are available.

All examples are based on :typoscript:`lib.contentElement`, which the system
extension :doc:`fluid_styled_content <typo3/cms-fluid-styled-content:Index>`
provides. The system extension defines it as follows:

..  literalinclude:: _about.typoscript
    :caption: EXT:fluid_styled_content/Configuration/TypoScript/Helper/ContentElement.typoscript

The extension `my_extension` adds the paths to its own templates:

..  literalinclude:: /CodeSnippets/DataProcessing/DataProcessingTemplates.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript
