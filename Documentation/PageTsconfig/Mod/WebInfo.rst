..  include:: /Includes.rst.txt

..  index::
    mod; web_info
    Modules; Info

..  _page-tsconfig-mod-web-info:

========
web_info
========

Configuration options of the :guilabel:`Content > Status` module.

..  versionchanged:: 14.0
    :changelog: feature-107628-1729026000

    The main module `Web` has been renamed to `Content`.

..  contents::
    :local:

..  index::
    fieldDefinitions
    Pagetree overview; Available fields
..  _fielddefinitions-webinfo:

fieldDefinitions
================

..  confval:: fieldDefinitions
    :name: mod-web-info-fieldDefinitions
    :type: array

    The "Pagetree overview" of the :guilabel:`Content > Status` module lets
    you choose which fields it shows. The system extension
    :composer:`typo3/cms-info` ships the entries "Basic settings",
    "Record overview", "Cache and Age", and "Layouts". The system extension
    :composer:`typo3/cms-seo` adds "SEO" and "Social Media".

    ..  figure:: /Images/GeneratedScreenshots/Info/PageTsModWebInfoFieldDefinitions.png
        :alt: Select box "Type" with the entries "SEO", "Social Media", "Basic
            settings", "Record overview", "Cache and Age", and "Layouts"

        Default entries of the "Pagetree overview", with the system extension
        `seo` installed

    Use page TSconfig to change the fields of an entry, or to add entries to
    the select box.

    The list of fields can contain fields of the `pages` table. To show the
    number of records of a table, add the table name with the prefix
    `table_`, for example `table_tt_content`.

    The string `###ALL_TABLES###` adds such a counter for each table that the
    editor can read.

..  _fielddefinitions-webinfo-example:

Example: Override the field definitions in the status module
------------------------------------------------------------

..  literalinclude:: _webinfo.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig
