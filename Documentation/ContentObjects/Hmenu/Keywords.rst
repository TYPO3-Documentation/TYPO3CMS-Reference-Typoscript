.. include:: /Includes.rst.txt
.. index:: HMENU; special = keywords
.. _hmenu-special-keywords:

=================================
Keywords - menu of related pages
=================================

Makes a menu of pages, which contain one or more keywords also found
on the current page.

Mount pages are supported.

.. contents::
   :local:

Properties
==========

.. _hmenu-special-keywords-value:

special.value
-------------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         special.value

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Page for which keywords to find similar pages

         **Example:**

         .. code-block:: typoscript
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

.. _hmenu-special-keywords-mode:
special.mode
-------------

.. container:: table-row

   Property
         special.mode

   Data type
         string

   Default
         SYS\_LASTCHANGED

   Description
         Which field in the pages table to use for sorting.

         Possible values are:

         SYS\_LASTCHANGED:
            Is updated to the youngest tstamp of the
            records on the page when a page is generated.

         manual or lastUpdated:
            Uses the field "lastUpdated", which
            can be set manually in the page-record.

         tstamp:
            Uses the "tstamp"-field of the pagerecord, which is set
            automatically when the record is changed.

         crdate:
            Uses the "crdate"-field of the pagerecord.

         starttime:
            Uses the starttime field.


.. _hmenu-special-keywords-entrylevel:
special.entryLevel
-------------------

.. container:: table-row

   Property
         special.entryLevel

   Data type
         integer

   Description
         Where in the rootline the search begins.

         See property :ref:`entryLevel in the HMENU <hmenu-entrylevel>`.

.. _hmenu-special-keywords-depth:
special.depth
--------------

.. container:: table-row

   Property
         special.depth

   Data type
         integer

   Default
         20

   Description
         (same as in section "special = updated")


.. _hmenu-special-keywords-limit:
special.limit
--------------

.. container:: table-row

   Property
         special.limit

   Data type
         integer

   Default
         10

   Description
         (same as in section "special = updated")


.. _hmenu-special-keywords-excludenosearchpages:
special.excludeNoSearchPages
-----------------------------

.. container:: table-row

   Property
         special.excludeNoSearchPages

   Data type
         boolean

   Description
         (same as in section "special = updated")

.. _hmenu-special-keywords-begin:
special.begin
--------------

.. container:: table-row

   Property
         special.begin

   Data type
         boolean

   Description
         (same as in section "special = updated")

.. _hmenu-special-keywords-setkeywords:
special.setKeywords
--------------------

.. container:: table-row

   Property

         special.setKeywords

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Lets you define the keywords manually by defining them as a comma-
         separated list. If this property is defined, it overrides the default,
         which is the keywords of the current page.

.. _hmenu-special-keywords-keywordsfield:
special.keywordsField
----------------------

.. container:: table-row

   Property
         special.keywordsField

   Data type
         string

   Default
         keywords

   Description
         Defines the field in the pages table in which to search for the
         keywords. Default is the field name "keyword". No check is done to see
         if the field you enter here exists, so make sure to enter an existing field!


.. _hmenu-special-keywords-sourcefield:
special.keywordsField.sourceField
----------------------------------

.. container:: table-row

   Property
         special.keywordsField.sourceField

   Data type
         string

   Default
         keywords

   Description
         Defines the field from the current page from which to take the
         keywords being matched. The default is "keyword". (Notice that
         ".keywordsField" is only setting the page-record field to *search
         in*!)



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = keywords]

Examples
=========

Menu of related pages
----------------------

The content element :guilabel:`Menu > Related pages` provided by the system
Extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

.. include:: /CodeSnippets/Menu/TypoScript/MenuRelatedPages.rst.txt

The following Fluid template can be used to style the menu:

.. include:: /CodeSnippets/Menu/Template/MenuRelatedPages.rst.txt
