..  include:: /Includes.rst.txt

..  index::
    mod; web_info
    Modules; Info

========
web_info
========

Configuration options of the :guilabel:`Content > Info` module.

..  versionchanged:: 14.0
    The main module `Web` has been renamed to `Content`.
    See `Feature: #107628 - Improved backend module naming and structure <https://docs.typo3.org/permalink/changelog:feature-107628-1729026000>`_

..  contents::
    :local:

..  index::
    fieldDefinitions
    Pagetree overview; Available fields
..  _fieldDefinitions-webinfo:

fieldDefinitions
================

..  confval:: fieldDefinitions
    :name: mod-web-info-fieldDefinitions
    :type: array

    The available fields in the "Pagetree overview" module under the Info module, by default ship with the entries
    "Basic settings", "Record overview", and "Cache and age".

    ..  figure:: /Images/ManualScreenshots/Info/PageTsModWebInfoFieldDefinitions.png
        :alt: Default entries of Pagetree Overview

        Default entries of Pagetree Overview

    By using page TsConfig it is possible to change the available fields and add additional entries to the select box.

    Next to using a list of fields from the `pages` table you can add counters for records in a given table by prefixing a
    table name with `table_` and adding it to the list of fields.

    The string `###ALL_TABLES###` is replaced with a list of all table names an editor has access to.

..  _fieldDefinitions-webinfo-example:

Example: Override the field definitions in the info module
----------------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    mod.web_info.fieldDefinitions {
        0 {
            # Basic settings
            label = LLL:info.webinfo:pages_0
            fields = title,uid,slug,alias,starttime,endtime,fe_group,target,url,shortcut,shortcut_mode
        }
        1 {
            # Record overview
            label = LLL:info.webinfo:pages_1
            fields = title,uid,###ALL_TABLES###
        }
        2 {
            # Cache and age
            label = LLL:info.webinfo:pages_2
            fields = title,uid,table_tt_content,table_fe_users
        }
    }
