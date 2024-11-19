..  include:: /Includes.rst.txt

..  index::
    mod; web_view
    Modules; View
..  _pagewebview:

========
web_view
========

Configuration options of the "Web > View" module.

..  contents::
    :local:

..  index::
    previewFrameWidths
    Preview; Frame widths
    Preview; Tablet
    Preview; Mobile

previewFrameWidths
==================

..  confval:: previewFrameWidths
    :name: mod-web-view-previewFrameWidths
    :type: array

    Configure available presets in view module.

    <key>.label
        Label for the preset

    <key>.type
        Category of the preset, must be one of 'desktop', 'tablet' or 'mobile'

    <key>.width
        Width of the preset

    <key>.height
        Height of the preset

Example: Define a new preview preset
------------------------------------

With this configuration a new preset '1014' with size 1024x768 will be configured with a label
loaded from an xlf file and the category 'desktop'.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_view.previewFrameWidths {
        1024.label = LLL:EXT:viewpage/Resources/Private/Language/locallang.xlf:computer
        1024.type = desktop
        1024.width = 1024
        1024.height = 768
    }

..  figure:: /Images/ManualScreenshots/View/WebViewTSConfigPreview.png
    :alt: Dropdown menu Width with added frame size called myPreview

    Dropdown menu Width with added frame size called myPreview


..  index::
    View module; type parameter

type
====

..  confval:: type
    :name: mod-web-view-type
    :type: positive integer

    Enter the value of the `&type=` parameter passed to the webpage.

Example: Show pages of type 42 in the preview
---------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_view {
        # Frontend link will be something like index.php?id=123&type=42
        type = 42
    }
