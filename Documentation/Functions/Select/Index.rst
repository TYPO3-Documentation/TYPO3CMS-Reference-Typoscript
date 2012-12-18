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
automatically added to the SQL-select by looking in the $TCA
(enablefields).

Also, if the "pidInList" feature is used, any page in the pid-list
that is not visible for the user of the website IS REMOVED from the
pidlist. Thereby no records from hidden, timed or access-protected
pages are selected! Nor records from recyclers.

**Note:** Be careful if you are using GET/POST data (for example
GPvar) in this object! You could introduce SQL injections!

Always secure input from outside, for example with intval.

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
         uidInList

   Data type
         Until TYPO3 4.5: *list of page\_ids*

         Since TYPO3 4.6: *list of page\_ids* /stdWrap

   Description
         Comma-separated list of page ids.


.. container:: table-row

   Property
         pidInList

   Data type
         *list of page\_ids* /stdWrap

   Description
         Comma-separated list of parent ids.

   Default
         this


.. container:: table-row

   Property
         recursive

   Data type
         Until TYPO3 4.5: integer

         Since TYPO3 4.6: integer /stdWrap

   Description
         Recursive levels for the pidInList

   Default
         0


.. container:: table-row

   Property
         orderBy

   Data type
         *SQL-orderBy* /stdWrap

   Description
         ORDER BY clause without the words "ORDER BY".

         **Example:** ::

            orderBy = sorting, title


.. container:: table-row

   Property
         groupBy

   Data type
         *SQL-groupBy* /stdWrap

   Description
         GROUP BY clause without the words "GROUP BY".

         **Example:** ::

            groupBy = CType


.. container:: table-row

   Property
         max

   Data type
         Until TYPO3 4.5: integer +calc +"total"

         Since TYPO3 4.6: integer +calc +"total" /stdWrap

   Description
         Max records

         **Special keyword:** "total" is substituted with count(\*).


.. container:: table-row

   Property
         begin

   Data type
         Until TYPO3 4.5: integer +calc +"total"

         Since TYPO3 4.6: integer +calc +"total" /stdWrap

   Description
         Begin with record number *value*.

         **Special keyword:** "total" is substituted with count(\*).


.. container:: table-row

   Property
         where

   Data type
         Until TYPO3 4.5: *SQL-where*

         Since TYPO3 4.6: *SQL-where* /stdWrap

   Description
         WHERE clause without the word "WHERE".

         **Example:** ::

            where = (title LIKE '%SOMETHING%' AND NOT doktype)


.. container:: table-row

   Property
         andWhere

   Data type
         *SQL-where* /stdWrap

   Description
         AND clause in a WHERE clause; without the word "AND".

         **Example:** ::

            andWhere = NOT doktype


.. container:: table-row

   Property
         languageField

   Data type
         Until TYPO3 4.5: string

         Since TYPO3 4.6: string /stdWrap

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

         Since TYPO3 4.6: string /stdWrap

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

         Since TYPO3 4.6: string /stdWrap

   Description
         Enter the table name for JOIN , LEFT OUTER JOIN and RIGHT OUTER JOIN
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

