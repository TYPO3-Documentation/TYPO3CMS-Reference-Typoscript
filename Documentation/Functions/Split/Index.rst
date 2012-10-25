.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


split
^^^^^

This object is used to split the input by a character and then parse
the result onto some functions.

For each iteration the split index starting with 0 (zero) is stored in
the register key SPLIT\_COUNT.


((generated))
"""""""""""""

Example:
~~~~~~~~

This is an example of TypoScript-code that imports the content of
field "bodytext" from the $cObj->data-array (ln 2). The content is
split by the linebreak-character (ln 4). The items should all be
treated with a stdWrap (ln 5) which imports the value of the item (ln
6). This value is wrapped in a tablerow where the first column is a
bullet-gif (ln 7). Finally the whole thing is wrapped in the proper
table-tags (ln 9) ::

   1    20 = TEXT
   2         20.field = bodytext
   3         20.split {
   4           token.char = 10
   5           cObjNum = 1
   6           1.current = 1
   7           1.wrap = <TR><TD valign="top"><IMG src="dot.gif"></TD><TD valign="top"> | </TD></TR>
   8         }
   9         20.wrap = <TABLE border="0" cellpadding="0" cellspacing="3" width="368"> | </TABLE><BR>

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
         token

   Data type
         str /stdWrap

   Description
         string or character (token) used to split the value

   Default


.. container:: table-row

   Property
         max

   Data type
         int /stdWrap

   Description
         max number of splits

   Default


.. container:: table-row

   Property
         min

   Data type
         int /stdWrap

   Description
         min number of splits.

   Default


.. container:: table-row

   Property
         returnKey

   Data type
         int /stdWrap

   Description
         Instead of parsing the split result, just return this element of the
         index immediately.

   Default


.. container:: table-row

   Property
         cObjNum

   Data type
         *cObjNum*

         +optionSplit

         /stdWrap

   Description
         This is a pointer the array of this object ("1,2,3,4"), that should
         treat the items, resulting from the split.

   Default


.. container:: table-row

   Property
         1,2,3,4

   Data type
         ->CARRAY /stdWrap

   Description
         The object that should treat the value.

         **NOTE:** The "current"-value is set to the value of current item,
         when the objects are called. See "stdWrap" / current.

         **Example (stdWrap used):** ::

            1.current = 1
            1.wrap = <B> | </B>

         **Example (CARRAY used):** ::

            1 {
              10 = TEXT
              10.current = 1
              10.wrap = <B> | </B>
              20 = CLEARGIF
              20.height = 20
            }

   Default


.. container:: table-row

   Property
         wrap

   Data type
         wrap

         +optionSplit

         /stdWrap

   Description
         Defines a wrap for each item.

   Default


.. ###### END~OF~TABLE ######

[tsref:->split]

