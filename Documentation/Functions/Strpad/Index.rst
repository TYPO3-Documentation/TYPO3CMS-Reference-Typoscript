.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _strpad:

strPad
^^^^^^

This property returns the input value padded to a certain length. The
padding is added on the left side, the right side or on both sides.
strPad uses the PHP function str_pad() for the operation.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         length

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         The length of the output string. If the value is negative, less
         than, or equal to the length of the input value, no padding
         takes place.

   Default
         0


.. container:: table-row

   Property
         padWith

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         The character(s) to pad with. The value of padWith may be
         truncated, if the required number of padding characters cannot
         be evenly divided by the length of the value of padWith. Note
         that leading and trailing spaces of padWith are stripped! If
         you want to pad with spaces, omit this option.

   Default
         (space character)


.. container:: table-row

   Property
         type

   Data type
         *(list of keywords)* /:ref:`stdWrap <stdwrap>`

   Description
         The side(s) of the input value, on which the padding should be
         added. Possible keywords are "left", "right" or "both".

   Default
         right


.. ###### END~OF~TABLE ######


[tsref:->strPad]


.. _strpad-examples:

Examples:
"""""""""

::

   10 = TEXT
   # The input value is 34 signs long.
   10.value = TYPO3 - inspiring people to share.
   10.value.strPad {
     length = 37
     padWith = =
     type = both
   }

This results in "=TYPO3 - inspiring people to share.==".

