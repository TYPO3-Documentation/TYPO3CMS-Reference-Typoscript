.. include:: ../../Includes.txt


.. _strpad:

======
strPad
======

This property returns the input value padded to a certain length. The
padding is added on the left side, the right side or on both sides.
strPad uses the PHP function :php:`str_pad()` for the operation.


.. _strpad-length:

length
======

:aspect:`Property`
   length

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap`

:aspect:`Description`
   The length of the output string. If the value is negative, less
   than, or equal to the length of the input value, no padding
   takes place.

:aspect:`Default`
   0

.. _strpad-padwith:

padWith
=======

:aspect:`Property`
   padWith

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   The character(s) to pad with. The value of :ref:`strpad-padWith` may be
   truncated, if the required number of padding characters cannot
   be evenly divided by the length of the value of :ts:`padWith`. Note
   that leading and trailing spaces of :ts:`padWith` are stripped! If
   you want to pad with spaces, omit this option.

:aspect:`Default`
   (space character)

.. _strpad-type:

type
====

:aspect:`Property`
   type

:aspect:`Data type`
   *(list of keywords)* / :ref:`stdwrap`

:aspect:`Description`
   The side(s) of the input value, on which the padding should be
   added. Possible keywords are "left", "right" or "both".

:aspect:`Default`
   right


.. _strpad-examples:

Examples
========

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
