
.. include:: /Includes.rst.txt


.. _data-type-case:

case
====

:aspect:`Data type:`
   case

:aspect:`Description:`
   Do a case conversion.

:aspect:`Possible values:`
   ===================== ==========================================================
   Value                 Effect
   ===================== ==========================================================
   :ts:`upper`           Convert all letters of the string to upper case
   :ts:`lower`           Convert all letters of the string to lower case
   :ts:`capitalize`      Uppercase the first character of each word in the string
   :ts:`ucfirst`         Convert the first letter of the string to upper case
   :ts:`lcfirst`         Convert the first letter of the string to lower case
   :ts:`uppercamelcase`  Convert underscored `upper_camel_case` to `UpperCamelCase`
   :ts:`lowercamelcase`  Convert underscored `lower_camel_case` to `lowerCamelCase`
   ===================== ==========================================================

:aspect:`Example:`
   Code::

      10 = TEXT
      10.value = Hello world!
      10.case = upper

   Result::

      HELLO WORLD!
