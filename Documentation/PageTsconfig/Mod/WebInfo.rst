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

    By using page TsConfig it is possible to change the available fields and add additional entries to the select box.

    Next to using a list of fields from the `pages` table you can add counters for records in a given table by prefixing a
    table name with `table_` and adding it to the list of fields.

    The string `###ALL_TABLES###` is replaced with a list of all table names an editor has access to.

..  _fielddefinitions-webinfo-example:

Example: Override the field definitions in the status module
------------------------------------------------------------

..  literalinclude:: _webinfo.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig
