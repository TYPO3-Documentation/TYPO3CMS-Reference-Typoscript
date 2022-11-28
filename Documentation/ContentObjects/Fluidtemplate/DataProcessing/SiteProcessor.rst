..  include:: /Includes.rst.txt
..  _SiteProcessor:

=============
SiteProcessor
=============

The :php:`SiteProcessor` fetches data from the :ref:`site configuration
<t3coreapi:sitehandling>`.


Options
=======

..  data-processor-site:: as

    :Required: false
    :type: string
    :default: "site"

    The variable name to be used in the Fluid template.


Example: Output some data from the site configuration
=====================================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`SiteProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/SiteProcessor.rst.txt

..  versionadded:: 12.1
    One can use the alias :typoscript:`site` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\SiteProcessor`.


The Fluid template
------------------

In the Fluid template the properties of the site configuration can be accessed:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcSite.rst.txt


Output
------

The array now contains the information from the site configuration:

..  include:: /Images/AutomaticScreenshots/DataProcessing/SiteProcessor.rst.txt
