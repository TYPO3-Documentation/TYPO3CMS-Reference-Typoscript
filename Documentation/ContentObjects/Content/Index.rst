.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-content:

CONTENT
^^^^^^^

This object is designed to generate content by making it possible to
finely select records and rendering them.

The register-key SYS\_LASTCHANGED is updated with the tstamp-field of
the records selected which has a higher value than the current.

The cObject :ref:`RECORDS <cobj-records>` in contrast is for displaying
lists of records from a variety of tables without fine graining.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         select

   Data type
         :ref:`->select <select>`

   Description
         The SQL-statement, a SELECT query, is set here!


.. container:: table-row

   Property
         table

   Data type
         *table name* /:ref:`stdWrap <stdwrap>`

   Description
         The table, the content should come from. Any table can be used;
         a check for a table prefix is not done.

         In standard configuration this will be "tt\_content".


.. container:: table-row

   Property
         renderObj

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         The cObject used for rendering the records resulting from the query in
         .select.

         If .renderObj is not set explicitly, then *< [table name]* is used. So
         in this case the configuration of the according table is being copied.
         See the notes on the example below.

   Default
         < [table name]


.. container:: table-row

   Property
         slide

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         If set and no content element is found by the select command, the
         rootLine will be traversed back until some content is found.

         Possible values are "-1" (slide back up to the siteroot), "1" (only
         the current level) and "2" (up from one level back).

         Use -1 in combination with collect.

         **.collect:** (integer /:ref:`stdWrap <stdwrap>`) If set, all content elements found
         on the current and parent pages will be collected. Otherwise, the sliding
         would stop after the first hit. Set this value to the amount of levels
         to collect on, or use "-1" to collect up to the siteroot.

         **.collectFuzzy:** (boolean /:ref:`stdWrap <stdwrap>`) Only useful in collect mode. If
         no content elements have been found for the specified depth in collect
         mode, traverse further until at least one match has occurred.

         **.collectReverse:** (boolean /:ref:`stdWrap <stdwrap>`) Reverse
         order of elements in collect mode. If set, elements of the current
         page will be at the bottom.

         **Note:** The sliding will stop when reaching a folder.
         See $cObj->checkPid_badDoktypeList.

.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wrap the whole content.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         (Executed after ".wrap".)


.. ###### END~OF~TABLE ######

[tsref:(cObject).CONTENT]


.. _cobj-content-examples:

Example:
""""""""

Here is an example of the CONTENT object::

     1 = CONTENT
     1.table = tt_content
     1.select {
       pidInList = this
       orderBy = sorting
     }

Since in the above example .renderObj is not set explicitly, TYPO3
will automatically set *1.renderObj < tt_content*, so that renderObj
will reference the TypoScript configuration of tt_content. The
according TypoScript configuration will be copied to renderObj.


Example:
""""""""

Here is an example of record-rendering objects::

   // Configuration for records with the "field" type value
   // (often "CType") set to "header"
   tt_content.header.default {
     10 = TEXT
     10.stdWrap.field = header
     .....
   }

   // Configuration for records with the "field" type value
   // (often "CType") set to "bullets"
   // If field "layout" is set to "1" or "2", a special configuration is used,
   // else defaults are being used.
   tt_content.bullets.subTypeField = layout
   tt_content.bullets.default {
     .....
   }
   tt_content.bullets.1 {
     .....
   }
   tt_content.bullets.2 {
     .....
   }

   // This is what happens if the "field" type value does not match any of the above
   tt_content.default.default {
     .....
   }

