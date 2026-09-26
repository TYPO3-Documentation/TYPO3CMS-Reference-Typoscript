..  include:: /Includes.rst.txt
..  index::
    Functions; numRows
    Database; count
..  _numrows:

=======
numRows
=======

This object allows you to specify a :sql:`SELECT` query, which will be
executed in the database. The object then returns the number of
rows, which were returned by the query.

..  contents::
    :local:

..  index:: _numRows; Properties
..  _numRows-properties:

Properties
==========

..  _numrows-table:

table
-----

..  confval:: table
    :name: _numrows-table
    :type: Table name

    Name of the database table to query.

..  _numrows-select:

select
------

..  confval:: select
    :name: numrows-select
    :type: :ref:`select <select>`

    Select query for the operation.

    The sub-property :typoscript:`selectFields` is overridden internally with
    `count(*)`.

..  _numRows-examples:

Example
=======

Get the number of content elements within certain `colPos` of the current
page.

..  literalinclude:: _numRows.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript
