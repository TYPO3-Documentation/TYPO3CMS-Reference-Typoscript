.. include:: /Includes.rst.txt


.. _numrows:

numRows
^^^^^^^

This object allows you to specify a SELECT query, which will be
executed in the database. The object then returns the number of
rows, which were returned by the query.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         table

   Data type
         Table name

   Description
         Name of the database table to query.


.. container:: table-row

   Property
         select

   Data type
         :ref:`->select <select>`

   Description
         Select query for the operation.

         The sub-property "selectFields" is overridden internally with
         "count(\*)".


.. ###### END~OF~TABLE ######


[tsref:->numRows]

