:navigation-title: site-language

..  include:: /Includes.rst.txt
..  _sitelanguageprocessor:

==============================
`site-language` data processor
==============================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\SiteLanguageProcessor`,
alias `site-language`, fetches language-related data from the
:ref:`site configuration<t3coreapi:sitehandling>`.

..  contents:: Table of contents

..  _sitelanguageprocessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  _sitelanguageprocessor-as:

    ..  confval:: as
        :name: SiteLanguageProcessor-as
        :type: :ref:`string <data-type-string>`
        :default: "site"

        The variable name to be used in the Fluid template.

..  _sitelanguageprocessor-example:

Example: Output some data from the site language configuration
==============================================================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.

..  rubric:: TypoScript

Using the :php-short:`\TYPO3\CMS\Frontend\DataProcessing\SiteLanguageProcessor`
the following scenario is possible:

..  literalinclude:: /CodeSnippets/DataProcessing/TypoScript/SiteLanguageProcessor.typoscript
    :caption: EXT:examples/Configuration/TypoScript/DataProcessors/Processors/SiteLanguageProcessor.typoscript

..  rubric:: The Fluid template

In the Fluid template the properties of the site language configuration can
be accessed:

..  literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcSiteLanguage.fluid.html
    :caption: EXT:examples/Resources/Private/Templates/ContentElements/DataProcSiteLanguage.fluid.html

..  rubric:: Output

The array now contains the information from the site language configuration:

..  figure:: /Images/ManualScreenshots/SiteLanguageProcessor.png
    :class: with-shadow
