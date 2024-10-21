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

..  include:: /CodeSnippets/DataProcessing/TypoScript/SiteProcessor.rst.txt

..  rubric:: The Fluid templat

In the Fluid template the properties of the site configuration can be accessed:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcSite.rst.txt

..  rubric:: Output

The array now contains the information from the site configuration:

..  include:: /Images/AutomaticScreenshots/DataProcessing/SiteProcessor.rst.txt
