.. include:: /Includes.rst.txt

.. index::
   mod; web_view
   Modules; View
.. _pagewebview:

========
web_view
========

Configuration options of the "Web > View" module.

.. contents::
   :local:

.. index::
   previewFrameWidths
   Preview; Frame widths
   Preview; Tablet
   Preview; Mobile

previewFrameWidths
==================

:aspect:`Datatype`
   array

:aspect:`Description`
   Configure available presets in view module.

   <key>.label
      Label for the preset

   <key>.type
      Category of the preset, must be one of 'desktop', 'tablet' or 'mobile'

   <key>.width
      Width of the preset

   <key>.height
      Height of the preset

:aspect:`Example`
   With this configuration a new preset '1014' with size 1027x768 will be configured with a label
   loaded from an xlf file and the category 'desktop'.

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_view.previewFrameWidths {
         1024.label = LLL:EXT:viewpage/Resources/Private/Language/locallang.xlf:computer
         1024.type = desktop
         1024.width = 1024
         1024.height = 768
      }

   .. figure:: /Images/ManualScreenshots/View/WebViewTSConfigPreview.png
      :alt: Dropdown menu Width with added frame size called myPreview

      Dropdown menu Width with added frame size called myPreview



.. index::
   View module; type parameter

type
====

:aspect:`Datatype`
   positive integer

:aspect:`Description`
   Enter the value of the &type parameter passed to the webpage.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_view {
         # Frontend link will be something like index.php?id=123&type=1
         type = 1
      }
