.. include:: /Includes.rst.txt
.. index::
   Functions; if
   if
.. _if:

==
if
==

Allows you to check multiple conditions.

This function returns true, if **all** of the present conditions are met
(they are connected with an "AND", a logical conjunction). If a
single condition is false, the value returned is false.

The returned value may still be negated by the :ref:`if-negate`-property.

There is no else property available. The "else" branch of an "if" statement is a
missing feature. You can implement a workaround by a logic based on the
:ref:`stdwrap-override-conditions`.

Also check the explanations and the examples further below!

.. contents::
   :local:

Properties
==========

.. index:: if; bitAnd
.. _if-bitand:

bitAnd
------

:aspect:`Property`
   bitAnd

:aspect:`Data type`
   value / :ref:`stdwrap`

:aspect:`Description`
   Returns true, if the value is part of the bit set.

:aspect:`Example`
   TYPO3 uses bits to store radio and checkboxes via TCA, `bitAnd` can be used to test against these fields.

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      hideDefaultLanguageOfPage = TEXT
      hideDefaultLanguageOfPage {
          value = 0
          value {
              override = 1
              override.if {
                  bitAnd.field = l18n_cfg
                  value = 1
              }
          }
      }

.. index:: if; directReturn
.. _if-directreturn:

directReturn
------------

:aspect:`Property`
   directReturn

:aspect:`Data type`
   :ref:`data-type-bool`

:aspect:`Description`
   If this property exists, no other conditions will be checked. Instead
   the true/false of this value is returned. Can be used to set
   true/false with a TypoScript constant.


.. index:: if; equals
.. _if-equals:

equals
------

:aspect:`Property`
   equals

:aspect:`Data type`
   value / :ref:`stdwrap`

:aspect:`Description`
   Returns true, if the content is equal to :typoscript:`value`.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      if.equals = POST
      if.value.data = GETENV:REQUEST_METHOD


.. index:: if; isInList
.. _if-isinlist:

isInList
--------

:aspect:`Property`
   isInList

:aspect:`Data type`
   value / :ref:`stdwrap`

:aspect:`Description`
   Returns true, if the content is in the comma-separated list
   :typoscript:`.value`.

   **Note:** The list in :typoscript:`value` may not have spaces between elements!

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      if.isInList.field = uid
      if.value = 1,2,34,50,87

   This returns true, if the uid is part of the list in :typoscript:`value`.


.. index:: if; isLessThan
.. _if-islessthan:

isLessThan
----------

:aspect:`Property`
   isLessThan

:aspect:`Data type`
   value / :ref:`stdwrap`

:aspect:`Description`
   Returns true, if the content is less than :typoscript:`value`.


.. index:: if; isNull
.. _if-isnull:

isNull
------

:aspect:`Property`
   isNull

:aspect:`Data type`
   :ref:`stdWrap`

:aspect:`Description`
   If the resulting content of the :typoscript:`stdWrap` is null (:php:`NULL` type in PHP).

   Since null values cannot be assigned in TypoScript, only the :typoscript:`stdWrap`
   features are available below this property.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 = COA_INT
      page.10.10 = TEXT
      page.10.10 {
            stdWrap.if.isNull.field = description
            value = No description available.
      }

   This example returns "No description available.", if the content of
   the field "description" is :php:`NULL`.


.. index:: if; isPositive
.. _if-ispositive:

isPositive
----------

:aspect:`Property`
   isPositive

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap` \+ :ref:`objects-calc`

:aspect:`Description`
   Returns true, if the content is positive.


.. index:: if; isTrue
.. _if-istrue:

isTrue
------

:aspect:`Property`
   isTrue

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   If the content is "true", which is not empty string and not zero.


.. index:: if; negate
.. _if-negate:

negate
------

:aspect:`Property`
   negate

:aspect:`Data type`
   :ref:`data-type-bool`

:aspect:`Description`
   This property is checked after all other properties. If set, it
   negates the result, which is present before its execution.

   So if all other conditions, which were used, returned true, with
   this property the overall return ends up being false. If at least
   one of the other conditions, which were used, returned false, the
   overall return ends up being true.

:aspect:`Default`
   0


.. index:: if; value
.. _if-value:

value
-----

:aspect:`Property`
   value

:aspect:`Data type`
   value / :ref:`stdwrap`

:aspect:`Description`
   The value to check. This is the comparison value mentioned above.


.. index:: if; Explanation
.. _if-explanation:

Explanation
===========

The "if"-function is a very odd way of returning true or false!
Beware!

"if" is normally used to decide whether to render an object or to return
a value (see the :ref:`data-type-cobject` and :ref:`stdWrap`).

Here is how it works:

The function returns true or false. Whether it returns true or false
depends on the properties of this function. Say if you set :typoscript:`isTrue = 1`
then the result is true. If you set :typoscript:`isTrue.field = header`, the
function returns true if the field "header" in :php:`$cObj->data` is set!

If you want to compare values, you must load a base-value in the
:typoscript:`value`-property. Example:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.10.value = 10
   page.10.isGreaterThan = 11

This would return true because the value of :typoscript:`isGreaterThan` is
greater than 10, which is the base-value.

More complex is this:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.10 {
       value = 10
       isGreaterThan = 11
       isTrue.field = header
       negate = 1
   }

There are two conditions - :typoscript:`isGreaterThan` and :typoscript:`isTrue`.
If they are both true, the total is true (both are connected with an AND).
BUT(!) then the result of the function in total would be false because the
:typoscript:`negate`-flag inverts the result!

.. _if-examples:

Examples
========

This is a GIFBUILDER object that will write "NEW" on a menu-item if
the field "newUntil" has a date less than the current date!

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   30 = TEXT
   30.text = NEW!
   30.offset = 10,10
   30.if {
       value.data = date: U
       isLessThan.field = newUntil
       negate = 1
   }
