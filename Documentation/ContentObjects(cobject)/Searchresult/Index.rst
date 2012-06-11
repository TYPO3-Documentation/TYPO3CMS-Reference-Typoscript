

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


SEARCHRESULT
^^^^^^^^^^^^

This object can be used to display search results.

Search words are loaded into the register in a form ready for linking
to pages:


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   register:SWORD_PARAMS = '&sword_list[]=word1&sword_list[]=word2 .....'

See typolink for more info!

SEARCHRESULT returns results only from pages with of doktype
"Standard" (1), "Advanced" (2) and "Not in menu" (5)

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         allowedCols
   
   Data type
         string
   
   Description
         List (separated by ":") of allowed table-cols.
         
         **Example:**
         
         ::
         
            pages.title:tt_content.bodytext
   
   Default


.. container:: table-row

   Property
         layout
   
   Data type
         string
   
   Description
         This defines how the search content is shown.
         
         **Example:**
         
         This substitutes the following fields:
         
         ::
         
            ###RANGELOW###:        The low result range, eg. "1"
            ###RANGEHIGH###:        The high result range, eg. "10"
            ###TOTAL###:    The total results
            ###RESULT###:   The result itself
            ###NEXT###:            The next-button
            ###PREV###:             The prev-button
   
   Default


.. container:: table-row

   Property
         next
   
   Data type
         cObject
   
   Description
         This cObject will be wrapped by a link to the next search result. This
         is the code substituting the "###NEXT###"-mark
   
   Default


.. container:: table-row

   Property
         prev
   
   Data type
         cObject
   
   Description
         This cObject will be wrapped by a link to the prev search result. This
         is the code substituting the "###PREV###"-mark
   
   Default


.. container:: table-row

   Property
         target
   
   Data type
         target /stdWrap
   
   Description
         target til next/prev links!
   
   Default


.. container:: table-row

   Property
         range
   
   Data type
         integer /stdWrap
   
   Description
         The number of results at a time!
   
   Default
         20


.. container:: table-row

   Property
         renderObj
   
   Data type
         cObject
   
   Description
         The cObject to render the search results
         
         $cObj->data array is set to the resulting record from the search.
         
         Please note, that in all fields are named [tablename]\_[fieldnam].
         Thus the page title is in the field "pages\_title".
         
         Apart from this, these fields from the pages-table are also present:
         
         ::
         
                   uid
   
   Default


.. container:: table-row

   Property
         renderWrap
   
   Data type
         wrap /stdWrap
   
   Description
   
   
   Default


.. container:: table-row

   Property
         resultObj
   
   Data type
         cObject
   
   Description
         The cObject prepended in the search results returns rows
   
   Default


.. container:: table-row

   Property
         noResultObj
   
   Data type
         cObject
   
   Description
         The cObject used if the search results in no rows.
   
   Default


.. container:: table-row

   Property
         noOrderBy
   
   Data type
         boolean /stdWrap
   
   Description
         If this is set, the result is NOT sorted after lastUpdated, tstamp for
         the pages-table.
   
   Default


.. container:: table-row

   Property
         wrap
   
   Data type
         wrap /stdWrap
   
   Description
         Wrap the whole content...
   
   Default


.. container:: table-row

   Property
         stdWrap
   
   Data type
         ->stdWrap
   
   Description
         Wrap the whole content...
   
   Default


.. container:: table-row

   Property
         addExtUrlsAndShortCuts
   
   Data type
         boolean
   
   Description
         If set, then the doktypes 3 and 4 (External URLS and Shortcuts) are
         added to the doktypes being searched.
         
         However at this point in time, no pages will be select if they do not
         have at least one tt\_content record on them! That is because the
         pages and tt\_content (or other) table is joined. So there must at
         least be one occurrence of a tt\_content element on an External URL /
         Shortcut page for them to show up.
   
   Default


.. container:: table-row

   Property
         languageField.[2nd table]
   
   Data type
         string
   
   Description
         Setting a field name to filter language on. This works like the
         "languageField" setting in ->select
         
         **Example:**
         
         ::
         
            languageField.tt_content = sys_language_uid
   
   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).SEARCHRESULT]

**NOTE:** "sword" and "scols" MUST be set in order for the search to
be engaged.

var "sword" = search word(s)

var "scols" = search columns separated by ":". E.g.:
pages.title:pages.keywords:tt\_content.bodytext

var "stype" = the starting point of the search: false = current page,
L-2 = page before currentPage, L-1 = current page, L0 = rootlevel, L1
= from first level, L2 = from second level

var $GLOBALS['HTTP\_POST\_VARS']['locationData']: If this is set, the
search is done as was it from another page in the website given by the
value of "locationData" here. See the description at the cObject
"FORMS".

Only if the page locationData is pointing to, is inside the real
rootLine of the site, the search will take this into account.

internal:

var "scount": If this is set this is used as the searchCount - the
total rows in the search. This way we don't need to reconstruct this
number!

var "spointer": This points to the start-record in the search.

LATER:

var "alldomains" : boolean: If set the search will proceed into other
domains

var "allsites" : boolean: If set the search will proceed into other
sites (defined by the "root" setting of an active template.)

var "depth": The depth


Search syntax
"""""""""""""

When you search, you can use three operator types

- AND: "+", "and" (UK), "og" (DK)

- OR: "or" (UK), "eller" (DK)

- NOT: "-", "not" (UK), "uden" (DK)

Default operator is AND. If you encapsulate words in "" they are
searched for as a whole string. The search is case insensitive and
matches parts of words also.


Examples:
~~~~~~~~~

#. *menu backend* - will find pages with both 'menu' and 'backend'.

#. *"menu backend"* - will find pages with the phrase "menu backend".

#. *menu or backend* - will find pages with either 'menu' or 'backend'

#. *menu or backend not content* - will find pages with either 'menu' or
   'backend' but not 'content'


Queries to the examples
"""""""""""""""""""""""

In this case "pagecontent" is chosen as the fields to search. That
includes  *tt\_content.header* ,  *tt\_content.bodytext* and
*tt\_content.imagecaption.*

Prefixed to these queries is this:

::

   SELECT pages.title AS pages_title, pages.subtitle AS pages_subtitle, pages.keywords AS pages_keywords, pages.description AS pages_description, pages.uid, tt_content.header AS tt_content_header, tt_content.bodytext AS tt_content_bodytext, tt_content.imagecaption AS tt_content_imagecaption
   FROM pages, tt_content
   WHERE(tt_content.pid=pages.uid) AND (pages.uid IN (2,5,6,20,21,22,29,30,31,3,4,8,9,16,1) AND pages.doktype in (1,2,5) AND pages.no_search=0 AND NOT tt_content.deleted AND NOT tt_content.hidden AND (tt_content.starttime<=985792797) AND (tt_content.endtime=0 OR tt_content.endtime>985792797) AND tt_content.fe_group IN (0,-1) AND NOT pages.deleted AND NOT pages.hidden AND (pages.starttime<=985792797) AND (pages.endtime=0 OR pages.endtime>985792797) AND pages.fe_group IN (0,-1)) ...

The part "... pages.uid IN (2,5,6,20,21,22,29,30,31,3,4,8,9,16,1)... "
is a list of pages-uid's to search. This list is based on the page-ids
in the website-branch of the pagetree and confines the search to that
branch and not the whole page-table.

#. ::
   
      ... AND ((tt_content.header LIKE '%menu%' OR tt_content.bodytext LIKE '%menu%' OR tt_content.imagecaption LIKE '%menu%') AND (tt_content.header LIKE '%backend%' OR tt_content.bodytext LIKE '%backend%' OR tt_content.imagecaption LIKE '%backend%')) GROUP BY pages.uid

#. ::
   
      ... AND ((tt_content.header LIKE '%menu backend%' OR tt_content.bodytext LIKE '%menu backend%' OR tt_content.imagecaption LIKE '%menu backend%')) GROUP BY pages.uid

#. ::
   
      ... AND ((tt_content.header LIKE '%menu%' OR tt_content.bodytext LIKE '%menu%' OR tt_content.imagecaption LIKE '%menu%') OR (tt_content.header LIKE '%backend%' OR tt_content.bodytext LIKE '%backend%' OR tt_content.imagecaption LIKE '%backend%')) GROUP BY pages.uid

#. ::
   
      ... AND ((tt_content.header LIKE '%menu%' OR tt_content.bodytext LIKE '%menu%' OR tt_content.imagecaption LIKE '%menu%') OR (tt_content.header LIKE '%backend%' OR tt_content.bodytext LIKE '%backend%' OR tt_content.imagecaption LIKE '%backend%') AND NOT (tt_content.header LIKE '%content%' OR tt_content.bodytext LIKE '%content%' OR tt_content.imagecaption LIKE '%content%')) GROUP BY pages.uid

Notice that upper and lowercase does not matter. Also 'menu' as
searchword will find 'menu', 'menus', 'menuitems' etc.

