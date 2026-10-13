..  include:: /Includes.rst.txt

..  index::
    mod; web_view
    Modules; View
..  _pagewebview:

========
web_view
========

..  versionchanged:: 14.0
    :changelog: feature-107628-1729026000

    The main module `Web` has been renamed to `Content`.

Configuration options of the :guilabel:`Content > Preview` module.

..  contents::
    :local:

..  index::
    previewFrameWidths
    Preview; Frame widths
    Preview; Tablet
    Preview; Mobile

..  _pagewebview-previewframewidths:

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

..  _pagewebview-previewframewidths-example-define-new:

Example: Define a new preview preset
------------------------------------

This configuration adds the preset `1024` with a size of 1024 x 768 pixels
to the category `desktop`. Its label comes from the language file of the
Preview module.

..  literalinclude:: _new.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

..  figure:: /Images/ManualScreenshots/View/WebViewTSConfigPreview.png
    :alt: Dropdown menu Width with added frame size called myPreview

    Dropdown menu Width with added frame size called myPreview


..  index::
    View module; type parameter

..  _pagewebview-type:

type
====

..  confval:: type
    :name: mod-web-view-type
    :type: positive integer

    Enter the value of the `&type=` parameter passed to the webpage.

..  _pagewebview-type-example-show-pages:

Example: Show pages of type 42 in the preview
---------------------------------------------

..  literalinclude:: _showPages.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig
