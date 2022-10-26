..  include:: /Includes.rst.txt
..  _SiteLanguageProcessor:

=====================
SiteLanguageProcessor
=====================

..  versionadded:: 12.0

The :php:`SiteLanguageProcessor` fetches language-related data from the
:ref:`site configuration<t3coreapi:sitehandling>`.


Options
=======

..  confval:: as

    :Required: false
    :type: string
    :default: "site"

    The variable name to be used in the Fluid template.


Example: Output some data from the site language configuration
==============================================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`SiteProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/SiteLanguageProcessor.rst.txt


The Fluid template
------------------

In the Fluid template the properties of the site language configuration can
be accessed:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcSiteLanguage.rst.txt


Output
------

The array now contains the information from the site language configuration:

..  figure:: /Images/ManualScreenshots/SiteLanguageProcessor.png
    :class: with-shadow
