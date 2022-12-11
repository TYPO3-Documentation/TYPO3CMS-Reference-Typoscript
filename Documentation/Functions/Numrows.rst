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

.. contents::
   :local:

.. index:: _numRows; Properties
.. _numRows-properties:

Properties
==========

.. _numrows-table:

table
-----

..  t3-function-numrows:: table

    :Data type: Table name

    Name of the database table to query.

.. _numrows-select:

select
------

..  t3-function-numrows:: select

    :Data type: :ref:`select`

    Select query for the operation.

    The sub-property :typoscript:`selectFields` is overridden internally with
    :php:`count(*)`.
