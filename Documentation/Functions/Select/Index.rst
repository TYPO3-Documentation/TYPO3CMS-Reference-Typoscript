.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _select:

select
^^^^^^

This object generates an SQL-select statement needed to select records
from the database.

Some records are hidden or timed by start and end-times. This is
automatically added to the SQL-select by looking in the $GLOBALS['TCA']
(enablefields).

**Note:** Be careful if you are using GET/POST data (for example
GPvar) in this object! You could introduce SQL injections!

Always secure input from outside, for example with intval!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         uidInList

   Data type
         Until TYPO3 4.5: *list of record\_ids*

         Since TYPO3 4.6: *list of record\_ids* /:ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of record uids from the according database table. For example
         when the select function works on the table tt_content, then this will be uids of
         tt_content records.

         **Special keyword:** "this" is replaced with the id of the current record.


.. container:: table-row

   Property
         pidInList

   Data type
         *list of page\_ids* /:ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of pids of the record. This will be page_ids. For example when the
         select function works on the table tt_content, then this will be pids of tt_content records,
         the parent pages of these records.

         Pages in the list, which are not visible for the website user, *are automatically removed*
         from the list. Thereby no records from hidden, timed or access-protected pages will be selected!
         Nor will be records from recyclers.

         **Special keyword:** "this" is replaced with the id of the current page.

   Default
         this


.. container:: table-row

   Property
         recursive

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Number of recursivity levels for the pidInList.

   Default
         0


.. container:: table-row

   Property
         orderBy

   Data type
         *SQL-orderBy* /:ref:`stdWrap <stdwrap>`

   Description
         ORDER BY clause without the words "ORDER BY".

         **Example:** ::

            orderBy = sorting, title


.. container:: table-row

   Property
         groupBy

   Data type
         *SQL-groupBy* /:ref:`stdWrap <stdwrap>`

   Description
         GROUP BY clause without the words "GROUP BY".

         **Example:** ::

            groupBy = CType


.. container:: table-row

   Property
         max

   Data type
         Until TYPO3 4.5: integer +calc +"total"

         Since TYPO3 4.6: integer +calc +"total" /:ref:`stdWrap <stdwrap>`

   Description
         Max records

         **Special keyword:** "total" is substituted with count(\*).


.. container:: table-row

   Property
         begin

   Data type
         Until TYPO3 4.5: integer +calc +"total"

         Since TYPO3 4.6: integer +calc +"total" /:ref:`stdWrap <stdwrap>`

   Description
         Begin with record number *value*.

         **Special keyword:** "total" is substituted with count(\*).


.. container:: table-row

   Property
         where

   Data type
         Until TYPO3 4.5: *SQL-where*

         Since TYPO3 4.6: *SQL-where* /:ref:`stdWrap <stdwrap>`

   Description
         WHERE clause without the word "WHERE".

         **Example:** ::

            where = (title LIKE '%SOMETHING%' AND NOT doktype)


.. container:: table-row

   Property
         andWhere

   Data type
         *SQL-where* /:ref:`stdWrap <stdwrap>`

   Description
         AND clause in a WHERE clause; without the word "AND".

         **Example:** ::

            andWhere = NOT doktype


.. container:: table-row

   Property
         languageField

   Data type
         Until TYPO3 4.5: string

         Since TYPO3 4.6: string /:ref:`stdWrap <stdwrap>`

   Description
         If set, this points to the field in the record which holds a reference
         to a record in sys\_language table. And if set, the records returned
         by the select-function will be selected only if the value of this
         field matches the $GLOBALS['TSFE']->sys\_language\_uid (which is set
         by the option config.sys\_language\_uid).


.. container:: table-row

   Property
         selectFields

   Data type
         Until TYPO3 4.5: string

         Since TYPO3 4.6: string /:ref:`stdWrap <stdwrap>`

   Description
         List of fields to select, or "count(\*)".

         If the records need to be localized, please include the
         relevant localization-fields (uid, pid, languageField and
         transOrigPointerField). Otherwise the TYPO3 internal localization
         will not succeed.

   Default
         \*


.. container:: table-row

   Property
         join

         leftjoin

         rightjoin

   Data type
         Until TYPO3 4.5: string

         Since TYPO3 4.6: string /:ref:`stdWrap <stdwrap>`

   Description
         Enter the table name for JOIN, LEFT OUTER JOIN and RIGHT OUTER JOIN
         respectively.


.. container:: table-row

   Property
         markers

   Data type
         *(array of markers)*

   Description
         The markers defined in this section can be used, wrapped in the usual
         ###markername### way, in any other property of select. Each value is
         properly escaped and quoted to prevent SQL injection problems. This
         provides a way to safely use external data (e.g. database fields,
         GET/POST parameters) in a query.

         **Available sub-properties:**

         **<markername>.value:** (value)

         Sets the value directly.

         **<markername>.commaSeparatedList:** (boolean)

         If set, the value is interpreted as a comma-separated list of values.
         Each value in the list is individually escaped and quoted.

         **(stdWrap properties ...)**

         All stdWrap properties can be used for each markername.

         **Example:** ::

            page.60 = CONTENT
            page.60 {
              table = tt_content
              select {
                pidInList = 73
                where = header != ###whatever###
                orderBy = ###sortfield###
                markers {
                  whatever.data = GP:first
                  sortfield.value = sor
                  sortfield.wrap = |ting
                }
              }
            }


.. ###### END~OF~TABLE ######

[tsref:->select]

