:navigation-title: site-language

..  include:: /Includes.rst.txt
..  _SiteLanguageProcessor:

==============================
`site-language` data processor
==============================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\SiteLanguageProcessor`,
alias `site-language`, fetches language-related data from the
:ref:`site configuration<t3coreapi:sitehandling>`.

..  contents:: Table of contents

..  _SiteLanguageProcessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  _SiteLanguageProcessor-as:

    ..  confval:: as
        :name: SiteLanguageProcessor-as
        :Required: false
        :type: :ref:`data-type-string`
        :Default: "site"

        The variable name to be used in the Fluid template.

..  _SiteLanguageProcessor-example:

Example: Output some data from the site language configuration
==============================================================

Please see also :ref:`dataProcessing-about-examples`.

..  rubric:: TypoScript

Using the :php:`SiteLanguageProcessor` the following scenario is possible:

.. literalinclude:: /CodeSnippets/DataProcessing/TypoScript/SiteLanguageProcessor.typoscript
   :caption: EXT:examples/Configuration/TypoScript/DataProcessors/Processors/SiteLanguageProcessor.typoscript

..  rubric:: The Fluid template

In the Fluid template the properties of the site language configuration can
be accessed:

.. literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcSiteLanguage.html
   :caption: EXT:examples/Resources/Private/Templates/ContentElements/DataProcSiteLanguage.html

..  rubric:: Output

The array now contains the information from the site language configuration:

..  figure:: /Images/ManualScreenshots/SiteLanguageProcessor.png
    :class: with-shadow
