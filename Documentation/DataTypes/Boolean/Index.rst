.. include:: ../../Includes.txt


.. _data-type-boolean:
.. _data-type-bool:

boolean
=======

:aspect:`Data type:`
   boolean

:aspect:`Description:`
   Possible values for boolean variables are `1` and `0`
   meaning TRUE and FALSE.

   Everything else is `evaluated to one of these values by PHP`__:
   Non-empty strings (except `0` [zero]) are treated as TRUE,
   empty strings are evaluated to FALSE.

   __ https://www.php.net/manual/en/language.types.boolean.php


:aspect:`Examples:`
   ::

      dummy.enable = 0   # false, preferred notation
      dummy.enable = 1   # true,  preferred notation
      dummy.enable =     # false, because the value is empty
