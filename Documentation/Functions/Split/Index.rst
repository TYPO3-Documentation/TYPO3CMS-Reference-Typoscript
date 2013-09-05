.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _split:

split
^^^^^

This object is used to split the input by a character and then parse
the result onto some functions.

For each iteration the split index starting with 0 (zero) is stored in
the register key SPLIT\_COUNT.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         token

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         String or character (token) used to split the value.


.. container:: table-row

   Property
         max

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Maximum number of splits.


.. container:: table-row

   Property
         min

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Minimum number of splits.


.. container:: table-row

   Property
         returnKey

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Instead of parsing the split result, just return this element of the
         index immediately.


.. container:: table-row

   Property
         cObjNum

   Data type
         *cObjNum* +optionSplit /:ref:`stdWrap <stdwrap>`

   Description
         This is a pointer the array of this object ("1,2,3,4"), that should
         treat the items, resulting from the split.


.. container:: table-row

   Property
         1,2,3,4

   Data type
         ->CARRAY /:ref:`stdWrap <stdwrap>`

   Description
         The object that should treat the value.

         **Note:** The "current"-value is set to the value of current item,
         when the objects are called. See "stdWrap" / current.

         **Example for stdWrap:** ::

            1.current = 1
            1.wrap = <b> | </b>

         **Example for CARRAY:** ::

            1 {
              10 = TEXT
              10.current = 1
              10.wrap = <b> | </b>
              20 = CLEARGIF
              20.height = 20
            }


.. container:: table-row

   Property
         wrap

   Data type
         wrap +optionSplit /:ref:`stdWrap <stdwrap>`

   Description
         Defines a wrap for each item.


.. ###### END~OF~TABLE ######

[tsref:->split]


.. _split-examples:

Example:
""""""""

This is an example of TypoScript-code that imports the content of
field "bodytext" from the $cObj->data-array (ln 2). The content is
split by the line break character (ln 4). The items should all be
treated with a stdWrap (ln 5) which imports the value of the item (ln
6). This value is wrapped in a table row where the first column is a
bullet-gif (ln 7). Finally the whole thing is wrapped in the proper
table-tags (ln 9) ::

   1         20 = TEXT
   2         20.field = bodytext
   3         20.split {
   4           token.char = 10
   5           cObjNum = 1
   6           1.current = 1
   7           1.wrap = <tr><td><img src="dot.gif"></td><td> | </td></tr>
   8         }
   9         20.wrap = <table style="width: 368px;"> | </table><br>

