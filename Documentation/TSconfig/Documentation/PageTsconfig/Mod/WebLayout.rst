..  include:: /Includes.rst.txt

..  index::
    mod; web_layout
    Modules; Page
..  _pagewebpage:

==========
web_layout
==========

Configuration options of the "Web > Page" module.

..  contents::
    :local:

..  index::
    Localization; Inconsistent language mode
    Localization; Independently translated content
    allowInconsistentLanguageHandling

..  _mod-web-layout-allowInconsistentLanguageHandling:

allowInconsistentLanguageHandling
=================================

..  confval:: allowInconsistentLanguageHandling
    :name: mod-web-layout-allowInconsistentLanguageHandling
    :type: boolean

    By default, TYPO3 will not allow you to mix translated content and independent content in the page module.
    Content elements violating this behavior will be marked in the page module and there is no UI control (yet)
    allowing you to create independent content elements in a given language.

    If you want to go back to the old, inconsistent behavior, you can toggle it back on using this switch.

..  _mod-web-layout-allowInconsistentLanguageHandling-example:

Example: Allow inconsistent language modes
------------------------------------------

Allows to set TYPO3s page module back to inconsistent language mode

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_layout.allowInconsistentLanguageHandling = 1


..  index:: BackendLayouts

..  _mod-web-layout-backendLayouts:

BackendLayouts
==============

..  confval:: BackendLayouts
    :type: array
    :no-index:

    Backend Layouts were initially introduced in order to customize the view of
    the :guilabel:`Page` module in TYPO3 Backend for a page, but has then since grown also in
    Frontend rendering to select for example Fluid template files via TypoScript for a page,
    commonly used via :confval:`data:pagelayout <t3tsref:data-pagelayout>`.

    See also the dedicated chapter :ref:`backend-layouts`.

..  _mod-web-layout-backendLayouts-example:

Example: Define a backend layout
--------------------------------

..  literalinclude:: WebLayout/_backendLayouts-example.tsconfig
    :language: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

..  index::
    defaultLanguageLabel
    Localization; Default language label

..  _mod-web-layout-defaultLanguageLabel:

defaultLanguageLabel
====================

..  warning::

    Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
    work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
    attached site configuration. Once a page tree has a site configuration, the default language label is
    set from the site configuration's language settings and this option will have no effect at all.

..  confval:: defaultLanguageLabel
    :name: mod-web-layout-defaultLanguageLabel
    :type: string

    Alternate label for "Default" when language labels are shown in the interface.

    Overrides the same property from :ref:`mod.SHARED <pageTsConfigSharedDefaultLanguageLabel>` if set.

..  index::
    defLangBinding
    Localization; Show default content element

..  _mod-web-layout-defLangBinding:

defLangBinding
==============

..  confval:: defLangBinding
    :name: mod-web-layout-defLangBinding
    :type: boolean
    :Default: 0

    If set, translations of content elements are bound to the default record in the display. This means that
    within each column with content elements any translation found for exactly the shown default content
    element will be shown in the language column next to.

    This display mode should be used depending on how the frontend is configured to display localization.
    The frontend must display localized pages by selecting the default content elements and for each
    one overlay with a possible translation if found.

..  index::
    hideRestrictedCols
    Page columns; Hide restricted

..  _mod-web-layout-hideRestrictedCols:

hideRestrictedCols
==================

..  confval:: hideRestrictedCols
    :name: mod-web-layout-hideRestrictedCols
    :type: boolean
    :Default: false

    If activated, only columns will be shown in the backend that the editor is
    allowed to access. All columns with access restriction are hidden in that case.

    By default columns with restricted access are rendered with a message
    telling *that* the user doesn't have access. This may be useless and
    distracting or look repelling. Instead, all columns an editor doesn't have
    access to can be hidden:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/page.tsconfig

        mod.web_layout.hideRestrictedCols = 1

    ..  attention::

        This setting will break your layout if you are using backend layouts.


..  index::
    localization.enableCopy
    Localization; Free mode
    Localization; Copy content elements

..  _mod-web-layout-localization-enableCopy:

localization.enableCopy
=======================

..  confval:: localization.enableCopy
    :name: mod-web-layout-localization-enableCopy
    :type: boolean
    :Default: 1

    Enables the creation of copies of content elements into languages in the translation wizard ("free mode").

..  _mod-web-layout-localization-enableCopy-example:

Example: Disable free mode button for localization
--------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_layout {
        localization.enableCopy = 0
    }


..  index::
    localization.enableTranslate
    Localization; Connected mode
    Localization; Translate content elements

..  _mod-web-layout-localization-enableTranslate:

localization.enableTranslate
============================

..  confval:: localization.enableTranslate
    :name: mod-web-layout-localization-enableTranslate
    :type: boolean
    :Default: 1

    Enables simple translations of content elements in the translation wizard ("connected mode").

..  _mod-web-layout-localization-enableTranslate-example:

Example: Disable "connected mode" button for translation
--------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_layout {
        localization.enableTranslate = 0
    }

..  index::
    web_layout.menu.functions
    Module menu; Pages
..  _pageblindingfunctionmenuoptions-weblayout:

menu.functions
==============

..  confval:: menu.functions
    :name: mod-web-layout-menu-functions
    :type: array

    Disable elements of the "Function selector" in the document header of the module.

    ..  figure:: /Images/ManualScreenshots/Page/FunctionMenuPageModule.png
        :alt: The function menu of the Page module

    The function keys are numerical:

    Columns
        1
    Languages
        2

    ..  warning::

        Blinding Function Menu items is not hardcore access control! All it
        does is hide the possibility of accessing that module functionality
        from the interface. It might be possible for users to hack their way
        around it and access the functionality anyways. You should use the
        option of blinding elements mostly to remove otherwise distracting options.

..  _pageblindingfunctionmenuoptions-weblayout-example:

Example: Disable "Languages" from the function menu
---------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Disables "Languages" from function menu
    mod.web_layout.menu.functions {
        2 = 0
    }


..  index::
    noCreateRecordsLink
    Buttons; Create new record

noCreateRecordsLink
===================

..  confval:: noCreateRecordsLink
    :name: mod-web-layout-noCreateRecordsLink
    :type: boolean
    :Default: 0

    If set, the link in the bottom of the page, "Create new record", is hidden.

..  index::
    preview
    Content elements; Preview definition
..  _pageweblayoutpreview:

tt_content.preview
==================

..  confval:: tt_content.preview
    :name: mod-web-layout-tt-content-preview
    :type: boolean

    It is possible to render previews of your own content elements in the page module.
    By referencing a Fluid template you can create a visual representation of your content element,
    making it easier for an editor to understand what is going on on the page.

    The syntax is as follows:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/page.tsconfig

        mod.web_layout.tt_content.preview.[CTYPE].[list_type value] = EXT:site_mysite/Resources/Private/Templates/Preview/ExamplePlugin.html

    This way you can even switch between previews for your plugins by supplying `list` as CType.

    ..  note::

        This only works if the registered preview renderer for the content type
        uses Fluid rendering and the rendering is not overridden by using
        an event listener for the event :php:`\TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent`.

        Have a look at :php:`\TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer`
        and the various methods for customizing the preview rendering:

        #.  :ref:`Register a preview renderer <t3coreapi:ConfigureCE-Preview>`
        #.  Register an event listener for :ref:`PageContentPreviewRenderingEvent <t3coreapi:PageContentPreviewRenderingEvent>`

        For checking for event listeners, see the list
        :guilabel:`System > Configuration > Event Listeners (PSR-14)` (available with installed EXT:lowlevel).


..  _pageweblayoutpreview-example:

Example: Define previews for custom content elements
----------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_layout.tt_content {
        preview.custom_ce = EXT:site_mysite/Resources/Private/Templates/Preview/CustomCe.html
        preview.table = EXT:site_mysite/Resources/Private/Templates/Preview/Table.html
        preview.list.tx_news = EXT:site_mysite/Resources/Private/Templates/Preview/TxNews.html
    }

..  toctree::
    :glob:

    WebLayout/*
