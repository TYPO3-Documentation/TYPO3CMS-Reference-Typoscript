.. include:: ../Includes.txt


.. _split:

=====
split
=====

This object is used to split the input by a character and then parse
the result onto some functions.

For each iteration the split index starting with 0 (zero) is stored in
the register key :ts:`SPLIT_COUNT`.


.. _split-token:

token
=====

:aspect:`Property`
   token

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   String or character (token) used to split the value.

.. _split-max:

max
===

:aspect:`Property`
   max

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap`

:aspect:`Description`
   Maximum number of splits.

.. _split-min:

min
===

:aspect:`Property`
   min

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap`

:aspect:`Description`
   Minimum number of splits.

.. _split-returnkey:

returnKey
=========

:aspect:`Property`
   returnKey

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap`

:aspect:`Description`
   Instead of parsing the split result, just return the element of the
   index with this number immediately and stop processing of the split
   function.

.. _split-returncount:

returnCount
===========

:aspect:`Property`
   returnCount

:aspect:`Data type`
   :ref:`data-type-bool` / :ref:`stdwrap`

:aspect:`Description`
   Counts all elements resulting from the split, returns their number
   and stops processing of the split function.

:aspect:`Example`

   ::

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

:aspect:`Property`
   cObjNum

:aspect:`Data type`
   *cObjNum* + :ref:`objects-optionsplit` / :ref:`stdwrap`

:aspect:`Description`
   This is a pointer the array of this object ("1,2,3,4"), that should
   treat the items, resulting from the split.

.. _split-1,2,3,4:

1,2,3,4
=======

:aspect:`Property`
   1,2,3,4

:aspect:`Data type`
   :ref:`carray` / :ref:`stdwrap`

:aspect:`Description`
   The object that should treat the value.

   **Note:** The "current"-value is set to the value of current item,
   when the objects are called. See :ref:`stdwrap` / current.

:aspect:`Example for stdWrap`

   ::

      1.current = 1
      1.wrap = <b> | </b>

:aspect:`Example for CARRAY`

   ::

      1 {
            10 = TEXT
            10.stdWrap.current = 1
            10.stdWrap.wrap = <b> | </b>
      }

.. _split-wrap:

wrap
====

:aspect:`Property`
   wrap

:aspect:`Data type`
   wrap + :ref:`objects-optionsplit` / :ref:`stdwrap`

:aspect:`Description`
   Defines a wrap for each item.


.. _split-examples:

Example
=======

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
