.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _numberformat:

numberFormat
^^^^^^^^^^^^

With this property you can format a float value and display it as you
want, for example as a price. It is a wrapper for the number\_format()
function of PHP.

You can define how many decimals you want and which separators you
want for decimals and thousands.

Since the properties are finally used by the PHP function
number\_format(), you need to make sure that they are valid parameters
for that function. Consult the PHP manual, if unsure.


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
         decimals

   Data type
         integer /stdWrap

   Description
         Number of decimals the formatted number will have. Defaults to 0, so
         that your input will in that case be rounded up or down to the next
         integer.

   Default
         0


.. container:: table-row

   Property
         dec\_point

   Data type
         string /stdWrap

   Description
         Character that divides the decimals from the rest of the number.
         Defaults to ".".

   Default
         .


.. container:: table-row

   Property
         thousands\_sep

   Data type
         string /stdWrap

   Description
         Character that divides the thousands of the number. Defaults to ",";
         set an empty value to have no thousands separator.

   Default
         ,


.. ###### END~OF~TABLE ######


[tsref:->numberFormat]


.. _numberformat-examples:

Examples:
"""""""""

::

   lib.myPrice = TEXT
   lib.myPrice {
     value = 0.8
     numberFormat {
       decimals = 2
       dec_point.cObject = TEXT
       dec_point.cObject {
         value = .
         lang.de = ,
       }
     }
     noTrimWrap = || &euro;|
   }
   # Will basically result in "0.80 €", but for German in "0,80 €".

   lib.carViews = CONTENT
   lib.carViews {
     table = tx_mycarext_car
     select.pidInList = 42
     renderObj = TEXT
     renderObj {
       field = views
       # By default use 3 decimals or
       # use the number given by the Get/Post variable precisionLevel, if set.
       numberFormat.decimals = 3
       numberFormat.decimals.override.data = GP:precisionLevel
       numberFormat.dec_point = ,
       numberFormat.thousands_sep = .
     }
   }
   # Could result in something like "9.586,007".

