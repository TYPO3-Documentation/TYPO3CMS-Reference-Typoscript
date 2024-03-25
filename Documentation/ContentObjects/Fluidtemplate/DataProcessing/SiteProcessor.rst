..  include:: /Includes.rst.txt
..  _SiteProcessor:

=============
SiteProcessor
=============

The :php:`SiteProcessor` fetches data from the :ref:`site configuration
<t3coreapi:sitehandling>`.


..  _SiteProcessor-options:

Options
=======

..  _SiteProcessor-as:

as
--

..  confval:: as
    :name: SiteProcessor-as

    :Required: false
    :Data type: :ref:`data-type-string`
    :default: "site"

    The variable name to be used in the Fluid template.

..  _SiteProcessor-examples:

Example: Output some data from the site configuration
=====================================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`SiteProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/SiteProcessor.rst.txt


The Fluid template
------------------

In the Fluid template the properties of the site configuration can be accessed:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcSite.rst.txt


Output
------

The array now contains the information from the site configuration:

..  include:: /Images/AutomaticScreenshots/DataProcessing/SiteProcessor.rst.txt
