.. include:: /Includes.rst.txt

.. index::
   mod; web_layout
   Modules; Page
.. _pagewebpage:

==========
web_layout
==========

Configuration options of the "Web > Page" module.

.. contents::
   :local:

.. index::
   Localization; Inconsistent language mode
   Localization; Independently translated content
   allowInconsistentLanguageHandling

allowInconsistentLanguageHandling
=================================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   By default, TYPO3 will not allow you to mix translated content and independent content in the page module.
   Content elements violating this behavior will be marked in the page module and there is no UI control (yet)
   allowing you to create independent content elements in a given language.

   If you want to go back to the old, inconsistent behavior, you can toggle it back on using this switch.

:aspect:`Example`
   Allows to set TYPO3s page module back to inconsistent language mode

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.allowInconsistentLanguageHandling = 1


.. index:: BackendLayouts

BackendLayouts
==============

:aspect:`Datatype`
   array

:aspect:`Description`
   Allows to define backend layouts via Page TSconfig directly, without using database records.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.BackendLayouts {
         exampleKey {
            title = Example
            icon = EXT:example_extension/Resources/Public/Images/BackendLayouts/default.gif
            config {
               backend_layout {
                  colCount = 1
                  rowCount = 2
                  rows {
                     1 {
                        columns {
                           1 {
                              name = LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:colPos.I.3
                              colPos = 3
                              colspan = 1
                           }
                        }
                     }
                     2 {
                        columns {
                           1 {
                              name = Main
                                       colPos = 0
                                       colspan = 1
                                   }
                               }
                           }
                       }
                   }
               }
           }
       }


.. index::
   defaultLanguageLabel
   Localization; Default language label

defaultLanguageLabel
====================

:aspect:`Datatype`
   string

:aspect:`Description`
   Alternate label for "Default" when language labels are shown in the interface.

   Overrides the same property from :ref:`mod.SHARED <pageTsConfigSharedDefaultLanguageLabel>` if set.

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
   work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the default language label is
   set from the site configuration's language settings and this option will have no effect at all.


.. index::
   defLangBinding
   Localization; Show default content element

defLangBinding
==============

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, translations of content elements are bound to the default record in the display. This means that
   within each column with content elements any translation found for exactly the shown default content
   element will be shown in the language column next to.

   This display mode should be used depending on how the frontend is configured to display localization.
   The frontend must display localized pages by selecting the default content elements and for each
   one overlay with a possible translation if found.

:aspect:`Default`
   0

.. index::
   hideRestrictedCols
   Page columns; Hide restricted

hideRestrictedCols
==================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If activated, only columns will be shown in the backend that the editor is
   allowed to access. All columns with access restriction are hidden in that case.

   By default columns with restricted access are rendered with a message
   telling *that* the user doesn't have access. This may be useless and
   distracting or look repelling. Instead, all columns an editor doesn't have
   access to can be hidden:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.hideRestrictedCols = 1

   .. attention::

      This setting will break your layout if you are using backend layouts.

:aspect:`Default`
   false


.. index::
   localization.enableCopy
   Localization; Free mode
   Localization; Copy content elements

localization.enableCopy
=======================

:aspect:`Datatype`
   boolean


:aspect:`Description`
   Enables the creation of copies of content elements into languages in the translation wizard ("free mode").

:aspect:`Default`
   1

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout {
         localization.enableCopy = 0
      }


.. index::
   localization.enableTranslate
   Localization; Connected mode
   Localization; Translate content elements

localization.enableTranslate
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Enables simple translations of content elements in the translation wizard ("connected mode").

:aspect:`Default`
   1

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout {
         localization.enableTranslate = 0
      }


.. index::
   web_layout.menu.functions
   Module menu; Pages
.. _pageblindingfunctionmenuoptions-weblayout:

menu.functions
~~~~~~~~~~~~~~

:aspect:`Datatype`
   array

:aspect:`Description`
   Disable elements of the "Function selector" in the document header of the module.

   .. figure:: /Images/ManualScreenshots/Page/FunctionMenuPageModule.png
      :alt: The function menu of the Page module

   The function keys are numerical:

   Columns
      1
   Languages
      2

   .. warning::

      Blinding Function Menu items is not hardcore access control! All it
      does is hide the possibility of accessing that module functionality
      from the interface. It might be possible for users to hack their way
      around it and access the functionality anyways. You should use the
      option of blinding elements mostly to remove otherwise distracting options.


:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      # Disables "Languages" from function menu
      mod.web_layout.menu.functions {
         2 = 0
      }


.. index::
   noCreateRecordsLink
   Buttons; Create new record

noCreateRecordsLink
~~~~~~~~~~~~~~~~~~~

:aspect:`Datatype`
   boolean

:aspect:`Description`
   If set, the link in the bottom of the page, "Create new record", is hidden.

:aspect:`Default`
   0


.. index::
   preview
   Content elements; Preview definition
.. _pageweblayoutpreview:

preview
~~~~~~~

:aspect:`Datatype`
   string

:aspect:`Description`
   It is possible to render previews of your own content elements in the page module.
   By referencing a Fluid template you can create a visual representation of your content element,
   making it easier for an editor to understand what is going on on the page.

   The syntax is as follows:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.tt_content.preview.[CTYPE].[list_type value] = EXT:site_mysite/Resources/Private/Templates/Preview/ExamplePlugin.html

   This way you can even switch between previews for your plugins by supplying `list` as CType.

   .. note::

      This only works, if there is no hook registered for this content type, you may want to check this
      section in the :guilabel:`System > Configuration` module:

      .. code-block:: php
         :caption: Search for registrations of this hook

         $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']
            ['tt_content_drawItem']['content_element_xy'];

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.web_layout.tt_content {
         preview.custom_ce = EXT:site_mysite/Resources/Private/Templates/Preview/CustomCe.html
         preview.table = EXT:site_mysite/Resources/Private/Templates/Preview/Table.html
         preview.list.tx_news = EXT:site_mysite/Resources/Private/Templates/Preview/TxNews.html
      }
