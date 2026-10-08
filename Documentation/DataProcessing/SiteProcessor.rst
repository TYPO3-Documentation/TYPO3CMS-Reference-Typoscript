:navigation-title: site
..  include:: /Includes.rst.txt
..  _siteprocessor:

=====================
`site` data processor
=====================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\SiteProcessor`,
alias `site`, fetches data from the :ref:`site configuration
<t3coreapi:sitehandling>`.

..  contents:: Table of contents

..  _siteprocessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :default:

    ..  _siteprocessor-as:

    ..  confval:: as
        :name: SiteProcessor-as
        :type: :ref:`string <data-type-string>`
        :default: "site"

        The variable name to be used in the Fluid template.

..  _siteprocessor-examples:

Example: Output some data from the site configuration
=====================================================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.

..  rubric:: TypoScript

Using the :php-short:`\TYPO3\CMS\Frontend\DataProcessing\SiteProcessor` the
following scenario is possible:

..  literalinclude:: /CodeSnippets/DataProcessing/TypoScript/SiteProcessor.typoscript
    :caption: EXT:examples/Configuration/TypoScript/DataProcessors/Processors/SiteProcessor.typoscript

..  rubric:: The Fluid template

In the Fluid template the properties of the site configuration can be accessed:

..  literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcSite.html
    :caption: EXT:examples/Resources/Private/Templates/ContentElements/DataProcSite.html

..  rubric:: Output

The array now contains the information from the site configuration:

..  figure:: /Images/ManualScreenshots/DataProcessing/SiteProcessor.png
    :zoom: lightbox
    :alt: Output of a SiteProcessor, including debug output
