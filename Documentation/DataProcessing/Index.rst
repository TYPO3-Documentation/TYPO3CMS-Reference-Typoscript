..  include:: /Includes.rst.txt

..  _cobj-fluidtemplate-properties-dataprocessing:
..  _dataProcessing:

===============
Data processors
===============

:ref:`dataProcessing <fluidtemplate-dataProcessing>` is a property of
:ref:`cobj-fluidtemplate` and :ref:`cobj-pageview`.

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

..  _dataProcessing-about-examples:

About the examples
==================

All examples listed here can be found in the TYPO3 Documentation Team
extension `examples <https://extensions.typo3.org/extension/examples/>`__.

Once the extension t3docs/examples is installed the examples are available
as content elements:

..  figure:: /Images/ManualScreenshots/DataProcessors.png
    :class: with-shadow

All examples listing here depend on
:ref:`t3coreapi:adding-your-own-content-elements`.  Data processors can
also be used in rendering page templates. In this case TypoScript context
would be the page record and all fields of the :typoscript:`pages` table
are available.

All examples base on :typoscript:`lib.contentElement`, which is provided by
the system extension :doc:`fluid_styled_content <typo3/cms-fluid-styled-content:Index>`.

In this system extension it is defined as follows:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.contentElement >
    lib.contentElement = FLUIDTEMPLATE
    lib.contentElement {
       templateName = Default
       // ...
    }

The extension `examples` also sets the paths to the additional templates:

..  include:: /CodeSnippets/DataProcessing/DataProcessingTemplates.rst.txt
