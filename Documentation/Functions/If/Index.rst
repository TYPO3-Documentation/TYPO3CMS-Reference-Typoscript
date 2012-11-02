.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _if:

if
^^

This function returns true if ALL of the present conditions are met
(they are connected with an "AND", a logical conjunction). If a
single condition is false, the value returned is false.

The returned value may still be negated by the ".negate"-property.

Also check the explanations and the examples further below!

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
         isTrue

   Data type
         str /stdWrap

   Description
         If the content is "true".... (not empty string and not zero)

   Default


.. container:: table-row

   Property
         isFalse

   Data type
         str /stdWrap

   Description
         If the content is "false"... (empty or zero)

   Default


.. container:: table-row

   Property
         isPositive

   Data type
         int /stdWrap

         \+ calc

   Description
         returns false if content is not positive

   Default


.. container:: table-row

   Property
         isGreaterThan

   Data type
         value /stdWrap

   Description
         returns false if content is not greater than ".value"

   Default


.. container:: table-row

   Property
         isLessThan

   Data type
         value /stdWrap

   Description
         returns false if content is not less than ".value"

   Default


.. container:: table-row

   Property
         equals

   Data type
         value /stdWrap

   Description
         returns false if content does not equal ".value"

   Default


.. container:: table-row

   Property
         isInList

   Data type
         value /stdWrap

   Description
         returns false if content is not in the comma-separated list ".value".

         The list in ".value" may not have spaces between elements!!

   Default


.. container:: table-row

   Property
         value

   Data type
         value /stdWrap

   Description
         "value" (the comparison value mentioned above)

   Default


.. container:: table-row

   Property
         negate

   Data type
         boolean

   Description
         This negates the result just before it exits. So if anything above
         returns true the overall returns ends up returning false!!

   Default


.. container:: table-row

   Property
         directReturn

   Data type
         boolean

   Description
         If this property exists the true/false of this value is returned.
         Could be used to set true/false by TypoScript constant

   Default


.. ###### END~OF~TABLE ######


[tsref:->if]


.. _if-explanation:

Explanation
"""""""""""

The "if"-function is a very odd way of returning true or false!
Beware!

"if" is normally used to decide whether to render an object or to return
a value (see the cObjects and stdWrap).

Here is how it works:

The function returns true or false. Whether it returns true or false
depends on the properties of this function. Say if you set "isTrue =
1" then the result is true. If you set "isTrue.field = header", the
function returns true if the field "header" in $cObj->data is set!

If you want to compare values, you must load a base-value in the
".value"-property. Example::

   .value = 10
   .isGreaterThan = 11

This would return true because the value of ".isGreaterThan" is
greater than 10, which is the base-value.

More complex is this::

   .value = 10
   .isGreaterThan = 11
   .isTrue.field = header
   .negate = 1

There are two conditions - isGreaterThan and isTrue. If they are both
true, the total is true (both are connected with an AND). BUT(!) then
the result if the function in total would be false because the
".negate"-flag inverts the result!


.. _if-examples:

Example:
~~~~~~~~

This is a GIFBUILDER object that will write "NEW" on a menu-item if
the field "newUntil" has a date less than the current date! ::

   ...
     30 = TEXT
     30.text = NEW!
     30.offset = 10,10
     30.if {
       value.data = date: U
       isLessThan.field = newUntil
       negate = 1
     }
   …

