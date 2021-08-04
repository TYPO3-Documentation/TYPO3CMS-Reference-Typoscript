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

While many examples found in the internet promote to set
:ts:`config.no_cache = 1` it is better to only disable the cache for objects
where it absolutely needs to be disabled, leaving all other caches untouched.
This can be achieved for example by using a non-cacheable array, the
:ref:`COA_INT <cobj-coa-int>`.

.. code-block:: typoscript

   myAjax = PAGE
   myAjax {
      typeNum = 1617455214
      config {
         disableAllHeaderCode = 1
         admPanel = 0
         debug = 0
      }
      # Prevent caching if necessary
      10 = COA_INT
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
         admPanel = 0
      }
   }

The built-in :php:`JsonView` can be used to create the content
via Extbase. See :ref:`Using built-in JsonView
<t3extbasebook:using-built-in-jsonview>`
