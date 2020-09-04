.. include:: ../../Includes.txt


.. _cobj-content:

CONTENT
=======

.. note::

   * CONTENT is an object type (= complex data type).
   * It is a specific :ref:`cObject <cobject>` data type.


An object with the content type CONTENT is designed to generate content by allowing to
finely select records and have them rendered.

What records are visible is controlled by `start` and `end` fields and
more standard fields automatically. The internal value `SYS_LASTCHANGED`
is raised to the maximum timestamp value of the respective records.

.. seealso::

   The cObject :ref:`RECORDS <cobj-records>` in contrast is for displaying
   lists of records from a variety of tables without fine graining.


Comprehensive example
---------------------

See PHP class :php:`\TYPO3\CMS\Frontend\ContentObject\ContentContentObject`
for details on code level.

Preamble::

   # Note: TypoScript (TS) is just another way to define an array of settings which
   #       is later on INTERPRETED by TYPO3. TypoScript can be written in ANY order
   #       as long as it leads to the same array. Actual execution order is TOTALLY
   #       INDEPENDENT of TypoScript code order.
   #
   #       The order of TS in this example however tries to reflect execution order.
   #       The denoted steps are taking place in that order at execution time.

Condensed form::

   1 = CONTENT
   1 {
      if {
      }
      table = tt_content
      select {
         pidInList = this
         orderBy = sorting
      }
      renderObj = < tt_content
      slide = 0
      slide {
         collect = 0
         collectReverse = 0
         collectFuzzy = 0
      }
      wrap =
      stdWrap =
   }

Expanded form::

   1 = CONTENT

   // STEP 1: do nothing if 'if' evaluates to false

   1.if {
      # ifclause =
   }

::

   // STEP 2: define parameters

   1.table = tt_content           # default='' #stdWrap

   1.select {
      pidInList = this
      orderBy = sorting
   }

   # renderObj = <TABLEVALUE      # default!
   1.renderObj =

   # slide = 0                    # default! #stdWrap
   1.slide = -1

   # slideCollect = 0             # default! #stdWrap
   1.slide.collect =

   # slideCollectReverse = false  # default! #stdWrap
   1.slide.collectReverse =

   # slideCollectFuzzy = false    # default! #stdWrap
   1.slide.collectFuzzy =

::

   // STEP 3: find all records

   // STEP 4: apply the renderObj to each record and collect
   //         the results as string 'totalResult'

   // STEP 5: Apply wrap to the 'totalResult'
   1.wrap = |                     # default!

   // STEP 6: Apply stdWrap to the 'totalResult'
   1.stdWrap =                    # default! #stdWrap

   // STEP 6: Return 'totalResult'


See also: :ref:`if`, :ref:`select`, :ref:`data-type-wrap`, :ref:`stdWrap`,
:ref:`data-type-cobject`


.. _cobj-content-select:

select
------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         select

   Data type
         :ref:`select`

   Description
      The SQL-statement, a SELECT query, is set here,
      including automatic visibility control.

.. ###### END~OF~TABLE ######


.. _cobj-content-table:

table
-----

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
      table

   Data type
      *table name* /:ref:`stdwrap`

   Description
      The table, the content should come from. Any table can be used;
      a check for a table prefix is not done.

      In standard configuration this will be `tt_content`.

.. ###### END~OF~TABLE ######


.. _cobj-content-renderObj:

renderObj
---------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
      renderObj

   Data type
      :ref:`data-type-cObject`

   Default
      :ts:`< [table name]`

   Description
      The cObject used for rendering the records resulting from the query in
      .select.

      If :ts:`renderObj` is not set explicitly, then :ts:`< [table name]` is used. So
      in this case the configuration of the according table is being copied.
      See the notes on the example below.

.. ###### END~OF~TABLE ######


.. _cobj-content-slide:

slide
-----

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
      slide

   Data type
      integer /:ref:`stdWrap`

   Description
      If set and no content element is found by the select command, the
      rootLine will be traversed back until some content is found.

      Possible values are :ts:`-1` (slide back up to the siteroot), :ts:`1` (only
      the current level) and :ts:`2` (up from one level back).

      Use :ts:`-1` in combination with collect.

      slide.collect
         (integer /:ref:`stdWrap`) If set, all content elements found
         on the current and parent pages will be collected. Otherwise, the sliding
         would stop after the first hit. Set this value to the amount of levels
         to collect on, or use :ts:`-1` to collect up to the siteroot.

      slide.collectFuzzy
         (boolean /:ref:`stdWrap`) Only useful in collect mode. If
         no content elements have been found for the specified depth in collect
         mode, traverse further until at least one match has occurred.

      slide.collectReverse
         (boolean /:ref:`stdWrap`) Reverse
         order of elements in collect mode. If set, elements of the current
         page will be at the bottom.

      **Note:** The sliding will stop when reaching a folder.
      See :php:`$cObj->checkPid_badDoktypeList`.

.. ###### END~OF~TABLE ######


.. _cobj-content-wrap:

wrap
----

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
      wrap

   Data type
      :ref:`wrap <data-type-wrap>` /:ref:`stdWrap`

   Description
      Wrap the whole content.

.. ###### END~OF~TABLE ######


.. _cobj-content-stdWrap:

stdWrap
-------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
      stdWrap

   Data type
      :ref:`stdwrap`

   Description
      Apply `stdWrap` functionality.

.. ###### END~OF~TABLE ######


.. _cobj-content-cache:

cache
-----

.. ### BEGIN~OF~TABLE ###

.. include:: ../../DataTypes/Properties/Cache.rst.txt

.. ###### END~OF~TABLE ######


.. _cobj-content-examples:

CONTENT object example 1
------------------------

Here is an example of the CONTENT object::

   1 = CONTENT
   1.table = tt_content
   1.select {
      pidInList = this
      orderBy = sorting
   }

Since in the above example .renderObj is not set explicitly, TYPO3
will automatically set :ts:`1.renderObj < tt_content`, so that `renderObj`
will reference the TypoScript configuration of `tt_content`. The
according TypoScript configuration will be copied to `renderObj`.


CONTENT object example 2
------------------------

Here is an example of record-rendering objects::

   page = PAGE
   page.typeNum = 0

   # The CONTENT object executes a database query and loads the content.
   page.10 = CONTENT
   page.10.table = tt_content
   page.10.select {

      # "sorting" is a column from the tt_content table and
      # keeps track of the sorting order, which was specified in
      # the backend.
      orderBy = sorting

      # Only select content from column "0" (the column called
      # "normal") and quote the database identifier (column name)
      # "colPos" (indicated by wrapping with {#})
      where = {#colPos}=0
   }

   # For every result line from the database query (that means for every content
   # element) the renderObj is executed and the internal data array is filled
   # with the content. This ensures that we can call the .field property and we
   # get the according value.
   page.10.renderObj = COA
   page.10.renderObj {

      10 = TEXT

      # The field tt_content.header normally holds the headline.
      10.stdWrap.field = header

      10.stdWrap.wrap = <h1>|</h1>

      20 = TEXT

      # The field tt_content.bodytext holds the content text.
      20.stdWrap.field = bodytext

      20.stdWrap.wrap = <p>|</p>
   }
