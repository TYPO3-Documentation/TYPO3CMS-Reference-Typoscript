.. include:: /Includes.rst.txt

======
web_ts
======

Configuration options of the "Web > Template" module.

.. contents::
   :local:

.. index::
   web_info.menu.function
   Module menu; Template
.. _pageblindingfunctionmenuoptions-webts:

menu.function
=============

:aspect:`Datatype`
   array

:aspect:`Description`
   Disable elements of the "Function selector" in the document header of the module. The keys for single
   items can be found by browsing *System > Configuration > $GLOBALS['TBE_MODULES_EXT']*.

   .. figure:: /Images/ManualScreenshots/Template/FunctionMenuTemplateModule.png
      :alt: The function menu of the Template module

      The function menu of the Template module

   .. warning::

      Blinding Function Menu items is not hardcore access control! All it
      does is hide the possibility of accessing that module functionality
      from the interface. It might be possible for users to hack their way
      around it and access the functionality anyways. You should use the
      option of blinding elements mostly to remove otherwise distracting options.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Disable the item "Template Analyzer"
      mod.web_ts.menu.function {
         TYPO3\CMS\Tstemplate\Controller\TemplateAnalyzerModuleFunctionController = 0
      }

