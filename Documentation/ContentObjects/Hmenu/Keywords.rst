..  include:: /Includes.rst.txt
..  index:: HMENU; special = keywords
..  _hmenu-special-keywords:

=================================
Keywords - menu of related pages
=================================

Makes a menu of pages, which contain one or more keywords also found
on the current page.

Mount pages are supported.

..  contents::
    :local:

..  _hmenu-special-keywords-properties:

Properties
==========

..  _hmenu-special-keywords-value:

special.value
-------------

..  confval:: special.value
    :name: hmenu-keywords-special-value
    :type: integer /:ref:`stdWrap <stdwrap>`

    UID of the page for which related pages by keyword should be found.

..  _hmenu-special-keywords-value-example:

Example: Find related pages of the current page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.relatedPagesMenu = HMENU
    lib.relatedPagesMenu {
        special = keywords
        special {
            value.data = TSFE:id
            entryLevel = 1
            mode = manual
        }
        // render the menu
    }

..  _hmenu-special-keywords-mode:

special.mode
-------------

..  confval:: special.mode
    :name: hmenu-keywords-special-mode
    :type: string
    :Default: `SYS_LASTCHANGED`

    Which field in the :sql:`pages` table should be used for sorting?

    Possible values are:

    `SYS_LASTCHANGED`
        Is updated to the youngest time stamp of the
        records on the page when a page is generated.

    `manual` or `lastUpdated`
        Uses the field :sql:`lastUpdated`, which
        can be set manually in the page record.

    `tstamp`
        Uses the :sql:`tstamp` field of the page record, which is set
        automatically when the record is changed.

    `crdate`
        Uses the :sql:`crdate` field of the page record. This field is set
        once on creation of the record and left unchanged afterwards.

    `starttime`
        Uses the :sql:`starttime` field.


..  _hmenu-special-keywords-entrylevel:

special.entryLevel
-------------------

..  confval:: special.entryLevel
    :name: hmenu-keywords-special-entryLevel
    :type: integer

    Where in the root line the search begins.

    See property :ref:`entryLevel in the HMENU <hmenu-entrylevel>`.

..  _hmenu-special-keywords-depth:

special.depth
--------------

..  confval:: special.depth
    :name: hmenu-keywords-special-depth
    :type: integer
    :Default: 20

    Same as in section :ref:`"special = updated" <hmenu-special-updated-depth>`.


..  _hmenu-special-keywords-limit:

special.limit
--------------

..  confval:: special.limit
    :name: hmenu-keywords-special-limit
    :type: integer
    :Default: 10

    Maximal number of items in the menu. Default is 10, maximum is 100.


..  _hmenu-special-keywords-excludenosearchpages:

special.excludeNoSearchPages
-----------------------------

..  confval:: special.excludeNoSearchPages
    :name: hmenu-keywords-special-excludeNoSearchPages
    :type: boolean
    :Default: false

..  container:: table-row

   Property
         special.excludeNoSearchPages

   Data type
         boolean

   Description
         If set, pages marked `No search` are not included.

..  _hmenu-special-keywords-begin:

special.begin
--------------

..  confval:: special.begin
    :name: hmenu-keywords-special-begin
    :type: boolean

    ..  TODO: What does this do?

..  _hmenu-special-keywords-setkeywords:

special.setKeywords
--------------------

..  confval:: special.setKeywords
    :name: hmenu-keywords-special-setKeywords
    :type: string /:ref:`stdWrap <stdwrap>`

    Lets you define the keywords manually by defining them as a comma-
    separated list. If this property is defined, it overrides the default,
    which is the keywords of the current page.

..  _hmenu-special-keywords-keywordsfield:

special.keywordsField
----------------------

..  confval:: special.keywordsField
    :name: hmenu-keywords-special-keywordsField
    :type: string
    :Default: `keywords`

    Defines the field in the :sql:`pages` table in which to search for the
    keywords. Default is the field name :sql:`keyword`. No check is done to see
    if the field you enter here exists, so make sure to enter an existing field.

..  _hmenu-special-keywords-sourcefield:

special.keywordsField.sourceField
----------------------------------

..  confval:: special.keywordsField.sourceField
    :name: hmenu-keywords-special-setKeywords-sourceField
    :type: string
    :Default: `keywords`

    Defines the field from the current page from which to take the
    keywords being matched. The default is :sql:`keyword`. (Notice that
    :confval:`hmenu-keywords-special-setKeywords` is only setting the
    page record field to *search in*!)

..  _hmenu-special-keywords-examples:

Example: Menu of related pages
==============================

The content element :guilabel:`Menu > Related pages` provided by the system
Extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

..  include:: /CodeSnippets/Menu/TypoScript/MenuRelatedPages.rst.txt

The following Fluid template can be used to style the menu:

..  include:: /CodeSnippets/Menu/Template/MenuRelatedPages.rst.txt
