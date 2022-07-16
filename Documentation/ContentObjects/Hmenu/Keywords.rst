.. include:: /Includes.rst.txt
.. index:: HMENU; special = keywords
.. _hmenu-special-keywords:

special = keywords
------------------

Makes a menu of pages, which contain one or more keywords also found
on the current page.

**Ordering** is by default done in reverse order (desc) with the field
specified by "mode", but setting "alternativeSortingField" for the
TMENU object will override that.

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-keywords-value:

         special.value

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Page for which keywords to find similar pages

         **Example:**

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            20 = HMENU
            20.special = keywords
            20.special {
              value.data = TSFE:id
              entryLevel = 1
              mode = manual
            }
            20.1 = TMENU
            20.1.NO {
              ...
            }


.. container:: table-row

   Property
         .. _hmenu-special-keywords-mode:

         special.mode

   Data type
         string

   Default
         SYS\_LASTCHANGED

   Description
         Which field in the pages table to use for sorting.

         Possible values are:

         **SYS\_LASTCHANGED:** Is updated to the youngest tstamp of the
         records on the page when a page is generated.

         **manual** or **lastUpdated:** Uses the field "lastUpdated", which
         can be set manually in the page-record.

         **tstamp:** Uses the "tstamp"-field of the pagerecord, which is set
         automatically when the record is changed.

         **crdate:** Uses the "crdate"-field of the pagerecord.

         **starttime:** Uses the starttime field.



.. container:: table-row

   Property
         .. _hmenu-special-keywords-entrylevel:

         special.entryLevel

   Data type
         integer

   Description
         Where in the rootline the search begins.

         *See property entryLevel in the section "HMENU" above.*


.. container:: table-row

   Property
         .. _hmenu-special-keywords-depth:

         special.depth

   Data type
         integer

   Default
         20

   Description
         (same as in section "special = updated")



.. container:: table-row

   Property
         .. _hmenu-special-keywords-limit:

         special.limit

   Data type
         integer

   Default
         10

   Description
         (same as in section "special = updated")



.. container:: table-row

   Property
         .. _hmenu-special-keywords-excludenosearchpages:

         special.excludeNoSearchPages

   Data type
         boolean

   Description
         (same as in section "special = updated")


.. container:: table-row

   Property
         .. _hmenu-special-keywords-begin:

         special.begin

   Data type
         boolean

   Description
         (same as in section "special = updated")


.. container:: table-row

   Property
         .. _hmenu-special-keywords-setkeywords:

         special.setKeywords

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Lets you define the keywords manually by defining them as a comma-
         separated list. If this property is defined, it overrides the default,
         which is the keywords of the current page.


.. container:: table-row

   Property
         .. _hmenu-special-keywords-keywordsfield:

         special.keywordsField

   Data type
         string

   Default
         keywords

   Description
         Defines the field in the pages table in which to search for the
         keywords. Default is the field name "keyword". No check is done to see
         if the field you enter here exists, so make sure to enter an existing field!



.. container:: table-row

   Property
         .. _hmenu-special-keywords-sourcefield:

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
