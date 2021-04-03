.. include:: /Includes.rst.txt
.. index::
   PAGE; Examples
.. _page_examples:

=============
PAGE Examples
=============

.. _page_examples_hello_world:

A simple "Hello World" Example
==============================


.. code-block:: typoscript

   # Default PAGE object:
   page = PAGE
   page.10 = TEXT
   page.10.value = HELLO WORLD!


.. _page_examples_fluid:

A page using a Fluid template
=============================

.. code-block:: typoscript

   page = PAGE
   page.10 = FLUIDTEMPLATE
   page.10 {
      templateName = Default
      layoutRootPaths {
         10 = EXT:sitepackage/Resources/Private/Layouts
      }
      partialRootPaths {
         10 = EXT:sitepackage/Resources/Private/Partials
      }
      templateRootPaths {
         10 = EXT:sitepackage/Resources/Private/Templates
      }
      variables {
         foo = TEXT
         foo.value = bar
      }
   }


.. _page_examples_ajax:

A page type used for ajax requests
==================================

.. code-block:: typoscript

   myAjax = PAGE
   myAjax {
       typeNum = 1617455214
       config {
           disableAllHeaderCode = 1
           xhtml_cleaning = 0
           admPanel = 0
           debug = 0
           no_cache = 1
       }
       10 < plugin.tx_myextension_myajaxplugin
   }


.. _page_examples_json:

A page type used for JSON data
==============================

To create a page type in the format json an additional
header with `Content-type:application/json` has to be set:

.. code-block:: typoscript

   json = PAGE
   json {
      typeNum = 1617455215
      10 =< tt_content.list.20.tx_myextension_myjsonplugin
      config {
         disableAllHeaderCode = 1
         additionalHeaders.10.header = Content-type:application/json
         xhtml_cleaning = 0
         admPanel = 0
      }
   }

The build in :php:`JsonView` can be used to create the content
via Extbase. See :ref:`Using built in JsonView
<t3extbasebook:using-built-in-jsonview>`
