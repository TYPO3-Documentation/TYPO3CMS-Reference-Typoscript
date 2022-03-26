.. include:: /Includes.rst.txt


.. _round:

round
^^^^^

With this property you can round the value up, down or to a certain
number of decimals. For each roundType the according PHP function will
be used.

The value will be converted to a float value before applying the
selected round method.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         roundType

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Round method which should be used.

         Possible keywords:

         \-  **ceil:** Round the value up to the next integer.

         \-  **floor:** Round the value down to the previous integer.

         \-  **round:** Round the value to the specified number of decimals.

   Default
         round


.. container:: table-row

   Property
         decimals

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Number of decimals the rounded value will have. Only used with the
         roundType "round". Defaults to 0, so that your input will in that case
         be rounded up or down to the next integer.

   Default
         0


.. ###### END~OF~TABLE ######


[tsref:->round]


.. _round-examples:

Examples:
"""""""""

::

   lib.number = TEXT
   lib.number {
     value = 3.14159
     stdWrap.round.roundType = round
     stdWrap.round.decimals = 2
   }

This returns 3.14.

