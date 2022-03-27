.. include:: /Includes.rst.txt
.. index::
   Functions; numRows
   Database; count
.. _numrows:

=======
numRows
=======

This object allows you to specify a SELECT query, which will be
executed in the database. The object then returns the number of
rows, which were returned by the query.

.. _numrows-table:

table
=====

:aspect:`Property`
   table

:aspect:`Data type`
   Table name

:aspect:`Description`
   Name of the database table to query.

.. _numrows-select:

select
======

:aspect:`Property`
   select

:aspect:`Data type`
   :ref:`select`

:aspect:`Description`
   Select query for the operation.

   The sub-property :typoscript:`selectFields` is overridden internally with
   :php:`count(*)`.
