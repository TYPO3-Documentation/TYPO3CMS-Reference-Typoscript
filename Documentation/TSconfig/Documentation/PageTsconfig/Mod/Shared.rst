.. include:: /Includes.rst.txt

.. index::
   mod; SHARED
   Modules; All
.. _pagesharedotionsformodules:

======
SHARED
======

.. youtube:: xJtsLlEtY5U

.. contents::
   :local:

.. index::
   colPos_list
   Columns; Disable

colPos_list
===========

:aspect:`Datatype`
   list of integers

:aspect:`Description`
   This option lets you specify which columns of tt_content elements should be editable in the
   'Columns' view of the Web > Page module.

   Used on top of backend layouts, this setting controls which columns are editable. Columns configured
   in the Backend Layout which are not listed here, will be displayed with placeholder area.

   Each column has a number which ultimately comes from the configuration of the table tt_content,
   field 'colPos'. These are the values of the four default columns used in the default backend layout:

   Left: `1`, Normal: `0`, Right: `2`, Border: `3`

:aspect:`Default`
   1,0,2,3


:aspect:`Example`
   .. _example_for_backend_layout:

   The example creates a basic backend layout and sets the "Left" column to be not editable:

   *  Create a record of type "Backend Layout", for instance in the root page of your website

   *  Add a title, e.g. "My Layout"

   *  Use the wizard to create a two column backend layout, the result may look like this:

      .. figure:: /Images/ManualScreenshots/List/SimpleBackendLayout.png
         :alt: A simple backend layout

         A simple backend layout

   *  Create a page and select this new backend layout in the "Appearance" tab.
      The page module then looks like this, displaying the two defined columns:

      .. figure:: /Images/ManualScreenshots/Page/SimpleBackendLayoutInPageModule.png
         :alt: Backend layout used in page module

         Backend layout used in page module

   *  Now set the "Left" column to be not editable using page TSconfig in the
      :guilabel:`Resources` tab of the page, by restricting `colPos_list` to
      `0` (the "Content" columns as defined above):

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/page.tsconfig

         mod.SHARED.colPos_list = 0

   *  The result in the page module then looks like this:

      .. figure:: /Images/ManualScreenshots/Page/SimpleBackendLayoutLeftNotEditable.png
         :alt: One column not editable in a backend layout

         One column not editable in a backend layout


.. index::
   defaultLanguageFlag
   Localization; Default language flag
.. _pageTsConfigSharedDefaultLanguageLabel:

defaultLanguageFlag
===================

:aspect:`Datatype`
   string

:aspect:`Description`
   Country flag shown for the "Default" language in the backend, used in Web > List and Web > Page module.
   Values as listed in the "Select flag icon" of a language record in the backend are allowed, including
   the value "multiple".

   .. figure:: /Images/ManualScreenshots/List/SelectFlagIcon.png
      :alt: The flag selector of a language record in the backend

      The flag selector of a language record in the backend

:aspect:`Example`
   This will show the German flag, and the text "deutsch" on hover.

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      mod.SHARED {
         defaultLanguageFlag = de
         defaultLanguageLabel = deutsch
      }

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
   work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the default language icon is
   set from the site configuration's language settings and this option will have no effect at all.


.. index::
   defaultLanguageLabel
   Localization; Default language label

defaultLanguageLabel
====================

:aspect:`Datatype`
   string

:aspect:`Description`
   Alternate label for "Default" when language labels are shown in the interface.

   Used in Web > List and Web > Page module.

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
   work in the backend for a "NullSite". For instance a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the default language label is
   set from the site configuration's language settings and this option will have no effect at all.


.. index::
   disableLanguages
   Localization; disable languages

disableLanguages
================

:aspect:`Datatype`
   string

:aspect:`Description`
   Comma-separated list of language UIDs which will be disabled in the given page tree.

.. warning::

   Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
   work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
   attached site configuration. Once a page tree has a site configuration, the language settings
   from the site configuration are applied and this option will have no effect at all.


.. index::
   disableSysNoteButton
   Buttons; disable sys_note

disableSysNoteButton
====================

:aspect:`Datatype`
   boolean

:aspect:`Description`
   Disables the `sys_note` creation button in the modules' top button bar in the :guilabel:`Page`, :guilabel:`List` and :guilabel:`Info`
   modules.


