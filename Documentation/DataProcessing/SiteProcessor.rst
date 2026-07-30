:navigation-title: site
..  include:: /Includes.rst.txt
..  _SiteProcessor:

=====================
`site` data processor
=====================

The :php:`\TYPO3\CMS\Frontend\DataProcessing\SiteProcessor`,
alias `site`, fetches data from the :ref:`site configuration
<t3coreapi:sitehandling>`.

..  contents:: Table of contents

..  _SiteProcessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  _SiteProcessor-as:

    ..  confval:: as
        :name: SiteProcessor-as
        :Required: false
        :type: :ref:`data-type-string`
        :Default: "site"

        The variable name to be used in the Fluid template.

..  _SiteProcessor-examples:

Example: Output some data from the site configuration
=====================================================

Please see also :ref:`dataProcessing-about-examples`.

..  rubric:: TypoScript

Using the :php:`SiteProcessor` the following scenario is possible:

.. literalinclude:: /CodeSnippets/DataProcessing/TypoScript/SiteProcessor.typoscript
   :caption: EXT:examples/Configuration/TypoScript/DataProcessors/Processors/SiteProcessor.typoscript

..  rubric:: The Fluid template

In the Fluid template the properties of the site configuration can be accessed:

.. literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcSite.fluid.html
   :caption: EXT:examples/Resources/Private/Templates/ContentElements/DataProcSite.fluid.html

..  rubric:: Output

The array now contains the information from the site configuration:

..  figure:: /Images/ManualScreenshots/DataProcessing/SiteProcessor.png
    :zoom: lightbox
    :alt: Output of a SiteProcessor, including debug output
