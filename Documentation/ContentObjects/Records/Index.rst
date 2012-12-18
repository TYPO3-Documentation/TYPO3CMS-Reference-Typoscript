.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-records:

RECORDS
^^^^^^^

This object is meant for displaying lists of records from a variety of
tables. Contrary to the CONTENT object, it does not allow for very
fine selections of records (it has no "select" property)

The register-key SYS\_LASTCHANGED is updated with the tstamp-field of
the records selected which has a higher value than the current.

**Note:** Records with parent ids (pid's) for non-accessible pages
(that is hidden, timed or access-protected pages) are normally not
selected. Pages may be of any type, except recycler. Disable the check
with the "dontCheckPid"-option.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         source

   Data type
         *records-list* /stdWrap

   Description
         List of record-id's, optionally with prepended table-names.

         **Example:** ::

            source = tt_content_34, 45, tt_links_56


.. container:: table-row

   Property
         tables

   Data type
         *list of tables* /stdWrap

   Description
         List of accepted tables. If any items in the ".source"-list are not
         prepended with a table name, the first table in this list is assumed
         to be the table for such records.

         Also table names configured in .conf are allowed.

         **Example:** ::

            tables = tt_content, tt_address, tt_links
            conf.tx_myexttable = TEXT
            conf.tx_myexttable.value = Hello world

         This adds the tables tt\_content, tt\_address, tt\_links and
         tx\_myexttable.


.. container:: table-row

   Property
         conf.[*table name*]

   Data type
         cObject

   Description
         Config array which renders records from table *table name*.

   Default
         If this is *not* defined, the rendering of the records is done with
         the top-level object [table name] - just like the cObject CONTENT!


.. container:: table-row

   Property
         dontCheckPid

   Data type
         boolean /stdWrap

   Description
         Normally a record cannot be selected, if its parent page (pid) is not
         accessible for the website user. This option disables that check.

   Default
         0


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description
         Wraps the output. Executed before ".stdWrap".


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         (Executed after ".wrap".)


.. ###### END~OF~TABLE ######

[tsref:(cObject).RECORDS]


.. _cobj-records-examples:

Example:
""""""""

::

     20 = RECORDS
     20.source.field = records
     20.tables = tt_address
     20.conf.tt_address < tt_address.default

