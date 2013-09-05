.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _if:

if
^^

Allows you to check multiple conditions.

This function returns true, if ALL of the present conditions are met
(they are connected with an "AND", a logical conjunction). If a
single condition is false, the value returned is false.

The returned value may still be negated by the ".negate"-property.

Also check the explanations and the examples further below!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         directReturn

   Data type
         boolean

   Description
         If this property exists, no other conditions will be checked. Instead
         the true/false of this value is returned. Can be used to set
         true/false with a TypoScript constant.


.. container:: table-row

   Property
         isNull

   Data type
         stdWrap

   Description
         If the resulting content of the stdWrap is null (NULL type in PHP)
         ...

         Since null values cannot be assigned in TypoScript, only the stdWrap
         features are available below this property.

         **Example:** ::

            page.10 = COA_INT
            page.10.10 = TEXT
            page.10.10 {
              if.isNull.field = description
              value = No description available.
            }

         This example returns "No description available.", if the content of
         the field "description" is NULL.


.. container:: table-row

   Property
         isTrue

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If the content is "true".... (not empty string and not zero)


.. container:: table-row

   Property
         isFalse

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If the content is "false"... (empty or zero)


.. container:: table-row

   Property
         isPositive

   Data type
         integer /:ref:`stdWrap <stdwrap>` \+ calc

   Description
         Returns false, if the content is not positive.


.. container:: table-row

   Property
         isGreaterThan

   Data type
         value /:ref:`stdWrap <stdwrap>`

   Description
         Returns false, if the content is not greater than ".value".


.. container:: table-row

   Property
         isLessThan

   Data type
         value /:ref:`stdWrap <stdwrap>`

   Description
         Returns false, if the content is not less than ".value".


.. container:: table-row

   Property
         equals

   Data type
         value /:ref:`stdWrap <stdwrap>`

   Description
         Returns false, if the content does not equal ".value".


.. container:: table-row

   Property
         isInList

   Data type
         value /:ref:`stdWrap <stdwrap>`

   Description
         Returns false, if the content is not in the comma-separated list
         ".value".

         **Note:** The list in ".value" may not have spaces between elements!


.. container:: table-row

   Property
         value

   Data type
         value /:ref:`stdWrap <stdwrap>`

   Description
         The value to check. This is the comparison value mentioned above.


.. container:: table-row

   Property
         negate

   Data type
         boolean

   Description
         This property is checked after all other properties. If set, it
         negates the result, which is present before its execution.

         So if all other conditions, which were used, returned true, with
         this property the overall return ends up being false. If at least
         one of the other conditions, which were used, returned false, the
         overall return ends up being true.

   Default
         0


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

