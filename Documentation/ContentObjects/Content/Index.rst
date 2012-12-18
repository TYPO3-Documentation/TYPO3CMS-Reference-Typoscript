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
         select

   Data type
         ->select

   Description
         The SQL-statement is set here!


.. container:: table-row

   Property
         table

   Data type
         *table name* /stdWrap

   Description
         The table, the content should come from.

         In standard configuration this will be "tt\_content".

         **Note:** Allowed tables are "pages" or tables prefixed with one of
         these: "pages\_", "tt\_", "tx\_", "ttx\_", "fe\_", "user\_" or
         "static\_".


.. container:: table-row

   Property
         renderObj

   Data type
         cObject

   Default
         < [table name]


.. container:: table-row

   Property
         slide

   Data type
         integer /stdWrap

   Description
         If set and no content element is found by the select command, then the
         rootLine will be traversed back until some content is found.

         Possible values are "-1" (slide back up to the siteroot), "1" (only
         the current level) and "2" (up from one level back).

         Use -1 in combination with collect.

         **.collect:** (integer /stdWrap) If set, all content elements found
         on current and parent pages will be collected. Otherwise, the sliding
         would stop after the first hit. Set this value to the amount of levels
         to collect on, or use "-1" to collect up to the siteroot.

         **.collectFuzzy:** (boolean /stdWrap) Only useful in collect mode. If
         no content elements have been found for the specified depth in collect
         mode, traverse further until at least one match has occurred.

         **.collectReverse:** (boolean /stdWrap) Change order of elements in
         collect mode. If set, elements of the current page will be at the
         bottom.


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description
         Wrap the whole content-story...


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         (Executed after ".wrap".)


.. ###### END~OF~TABLE ######

[tsref:(cObject).CONTENT]


.. _cobj-content-examples:

Example:
""""""""

Here is an example of the CONTENT-obj::

     1 = CONTENT
     1.table = tt_content
     1.select {
       pidInList = this
       orderBy = sorting
     }


Example:
""""""""

Here is an example of record-renderObj's::

   // Configuration for records with the typeField-value (often "CType") set to "header"
   tt_content.header.default {
     10 = TEXT
     10.field = header
     .....
   }

   // Configuration for records with the typeField-value (often "CType") set to "bullets"
   // If field "layout" is set to "1" or "2" a special configuration is used, else default
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

   // This is what happens if the typeField-value does not match any of the above
   tt_content.default.default {
     .....
   }

