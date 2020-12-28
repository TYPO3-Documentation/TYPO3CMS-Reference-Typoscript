.. include:: ../Includes.txt
.. index:: Functions; numberFormat
.. _numberformat:

============
numberFormat
============

With this property you can format a float value and display it as you
want, for example as a price. It is a wrapper for the :php:`number_format()`
function of PHP.

You can define how many decimals you want and which separators you
want for decimals and thousands.

Since the properties are finally used by the PHP function
:php:`number_format()`, you need to make sure that they are valid parameters
for that function. Consult the PHP manual, if unsure.

.. _numberformat-decimals:

decimals
========

:aspect:`Property`
   decimals

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap`

:aspect:`Description`
   Number of decimals the formatted number will have.

:aspect:`Default`
   0

   Your input will in that case be rounded up or down to the next integer.


.. _numberformat-dec\_point:

dec\_point
==========

:aspect:`Property`
   dec\_point

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

:aspect:`Description`
   Character that divides the decimals from the rest of the number.

:aspect:`Default`
   .

.. _numberformat-thousands\_sep:

thousands\_sep
==============

:aspect:`Property`
   thousands\_sep

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   Character that divides the thousands of the number.
   Set an empty value to have no thousands separator.

:aspect:`Default`
   ,

.. _numberformat-examples:

Examples
--------

::

   lib.myPrice = TEXT
   lib.myPrice {
     value = 0.8
     stdWrap.numberFormat {
       decimals = 2
       dec_point.cObject = TEXT
       dec_point.cObject {
         value = .
         stdWrap.lang.de = ,
       }
     }
     stdWrap.noTrimWrap = || &euro;|
   }
   # Will basically result in "0.80 €", but for German in "0,80 €".

   lib.carViews = CONTENT
   lib.carViews {
       table = tx_mycarext_car
       select.pidInList = 42
       renderObj = TEXT
       renderObj {
           stdWrap.field = views
           # By default use 3 decimals or
           # use the number given by the Get/Post variable precisionLevel, if set.
           stdWrap.numberFormat.decimals = 3
           stdWrap.numberFormat.decimals.override.data = GP:precisionLevel
           stdWrap.numberFormat.dec_point = ,
           stdWrap.numberFormat.thousands_sep = .
       }
   }
   # Could result in something like "9.586,007".
