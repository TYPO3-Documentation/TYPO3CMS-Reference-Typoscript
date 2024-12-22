..  include:: /Includes.rst.txt

..  index::
    mod; SHARED
    Modules; All
..  _pagesharedotionsformodules:
..  _mod-shared:

======
SHARED
======

..  youtube:: xJtsLlEtY5U

..  contents::
    :local:

..  index::
    colPos_list
    Columns; Disable

colPos_list
===========

..  confval:: colPos_list
    :name: mod-share-colPos-list
    :type: comma separated list of integers
    :default: ''
    :Path: mod.SHARED.colPos_list

    This setting controls which areas or columns of the backend layouts are
    editable. Columns configured in the :ref:`Backend Layout <backend-layouts>`,
    which are not listed here, will be displayed with placeholder area.

    The default backend layout only has one column, which has the id 0.

..  _example_for_backend_layout:

Example: Make a column in a backend layout not editable
-------------------------------------------------------

Assuming the current page uses the following backend layout:

..  literalinclude:: /PageTsconfig/Mod/WebLayout/_BackendLayout.tsconfig
    :caption: config/sites/my-site/page.tsconfig

And we want to make the area "Jumbotron" (colPos = 1) not editable.

As long as :confval:`mod-share-colPos-list` is empty all areas are allowed.
We therefore have to list all colPos, which should still be allowed. In this
that would be the columns left (colPos = 0) and right (colPos = 2).

..  literalinclude:: /PageTsconfig/Mod/_snippets/_mod.SHARED.colPos_list.tsconfig
    :caption: config/sites/my-site/page.tsconfig

..  index::
    defaultLanguageFlag
    Localization; Default language flag
..  _pageTsConfigSharedDefaultLanguageLabel:

defaultLanguageFlag
===================

..  warning::

    Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
    work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
    attached site configuration. Once a page tree has a site configuration, the default language icon is
    set from the site configuration's language settings and this option will have no effect at all.

..  confval:: defaultLanguageFlag
    :name: mod-share-defaultLanguageFlag
    :type: string

    Country flag shown for the "Default" language in the backend, used in Web > List and Web > Page module.
    Values as listed in the "Select flag icon" of a language record in the backend are allowed, including
    the value "multiple".

    ..  figure:: /Images/ManualScreenshots/List/SelectFlagIcon.png
        :alt: The flag selector of a language record in the backend

        The flag selector of a language record in the backend

Example: Show a German flag on a NullSite
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This will show the German flag, and the text "deutsch" on hover.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.SHARED {
        defaultLanguageFlag = de
        defaultLanguageLabel = deutsch
    }

..  index::
    defaultLanguageLabel
    Localization; Default language label

defaultLanguageLabel
====================

..  warning::

    Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
    work in the backend for a "NullSite". For instance a global sysfolder in the page tree without an
    attached site configuration. Once a page tree has a site configuration, the default language label is
    set from the site configuration's language settings and this option will have no effect at all.

..  confval:: defaultLanguageLabel
    :name: mod-share-defaultLanguageLabel
    :type: string

    Alternate label for "Default" when language labels are shown in the interface.

    Used in Web > List and Web > Page module.

..  index::
    disableLanguages
    Localization; disable languages

disableLanguages
================

..  warning::

    Note that this option has largely been superseded by site configuration since **TYPO3 v10** and will only
    work in the Backend for a "NullSite". For instance, a global sysfolder in the page tree without an
    attached site configuration. Once a page tree has a site configuration, the language settings
    from the site configuration are applied and this option will have no effect at all.

..  confval:: disableLanguages
    :name: mod-share-disableLanguages
    :type: string

    Comma-separated list of language UIDs which will be disabled in the given page tree.

..  index::
    disableSysNoteButton
    Buttons; disable sys_note

disableSysNoteButton
====================

..  confval:: disableSysNoteButton
    :name: mod-share-disableSysNoteButton
    :type: boolean

    Disables the `sys_note` creation button in the modules' top button bar
    in the :guilabel:`Page`, :guilabel:`List` and :guilabel:`Info`
    modules.
