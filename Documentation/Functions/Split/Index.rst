.. include:: ../../Includes.txt


.. _split:

=====
split
=====

This object is used to split the input by a character and then parse
the result onto some functions.

For each iteration the split index starting with 0 (zero) is stored in
the register key :ts:`SPLIT_COUNT`.


.. ### BEGIN~OF~TABLE ###

.. _split-token:

token
=====

.. container:: table-row

   Property
         token

   Data type
         :ref:`data-type-string` / :ref:`stdwrap`

   Description
         String or character (token) used to split the value.

.. _split-max:

max
===

.. container:: table-row

   Property
         max

   Data type
         :ref:`data-type-integer` / :ref:`stdwrap`

   Description
         Maximum number of splits.

.. _split-min:

min
===

.. container:: table-row

   Property
         min

   Data type
         :ref:`data-type-integer` / :ref:`stdwrap`

   Description
         Minimum number of splits.

.. _split-returnkey:

returnKey
=========

.. container:: table-row

   Property
         returnKey

   Data type
         :ref:`data-type-integer` / :ref:`stdwrap`

   Description
         Instead of parsing the split result, just return the element of the
         index with this number immediately and stop processing of the split
         function.

.. _split-returncount:

returnCount
===========

.. container:: table-row

   Property
         returnCount

   Data type
         :ref:`data-type-bool` / :ref:`stdwrap`

   Description
         Counts all elements resulting from the split, returns their number
         and stops processing of the split function.

         **Example:** ::

            # returns 9
            1 = TEXT
            1 {
                value = x,y,z,1,2,3,a,b,c
                split.token = ,
                split.returnCount = 1
            }

.. _split-cobjnum:

cObjNum
=======

.. container:: table-row

   Property
         cObjNum

   Data type
         *cObjNum* +optionSplit / :ref:`stdwrap`

   Description
         This is a pointer the array of this object ("1,2,3,4"), that should
         treat the items, resulting from the split.

.. _split-1,2,3,4:

1,2,3,4
=======

.. container:: table-row

   Property
         1,2,3,4

   Data type
         ->CARRAY / :ref:`stdwrap`

   Description
         The object that should treat the value.

         **Note:** The "current"-value is set to the value of current item,
         when the objects are called. See :ref:`stdwrap` / current.

         **Example for stdWrap:** ::

            1.current = 1
            1.wrap = <b> | </b>

         **Example for CARRAY:** ::

            1 {
                10 = TEXT
                10.stdWrap.current = 1
                10.stdWrap.wrap = <b> | </b>
            }

.. _split-wrap:

wrap
====

.. container:: table-row

   Property
         wrap

   Data type
         wrap +optionSplit / :ref:`stdwrap`

   Description
         Defines a wrap for each item.


.. ###### END~OF~TABLE ######

[tsref:->split]


.. _split-examples:

Example:
========

This is an example of TypoScript code that imports the content of
field "bodytext" from the :php:`$cObj->data-array` (ln 2). The content is
split by the line break character (ln 4). The items should all be
treated with a :ts:`stdWrap` (ln 5) which imports the value of the item (ln
6). This value is wrapped in a table row where the first column is a
bullet-gif (ln 7). Finally the whole thing is wrapped in the proper
table-tags (ln 9). :

.. code-block:: typoscript
   :linenos:

   20 = TEXT
   20.stdWrap {
       field = bodytext
       split {
           token.char = 10
           cObjNum = 1
           1.current = 1
           1.wrap = <tr><td><img src="dot.gif"></td><td> | </td></tr>
       }
       stdWrap.wrap = <table style="width: 368px;"> | </table><br>
   }
