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

The returned value may still be negated by the :ref:`if-negate` property.

There is no else property available. The "else" branch of an "if" statement is a
missing feature. You can implement a workaround by a logic based on the
:ref:`stdwrap-override-conditions`.

Also check the explanations and the examples further below!

.. contents::
   :local:

.. _if-properties:

Properties
==========

..  _if-bitAnd:

bitAnd
------

..  confval:: bitAnd
    :name: if-bitAnd
    :type: value / :ref:`stdwrap`

    Returns true, if the value is part of the bit set.

    ..  rubric:: Example

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


..  _if-contains:

contains
--------

..  versionadded:: 12.1

..  confval::  contains
    :name: if-contains
    :type:  value / :ref:`stdwrap`

    Returns true, if the content contains :typoscript:`value`.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript
        :emphasize-lines: 11

        # Add a span tag before the page title if the page title
        # contains the string "media"
        page.10 = TEXT
        page.10 {
            data = page:title
            htmlSpecialChars = 1
            prepend = TEXT
            prepend {
                value = <span class="icon-video"></span>
                if.value.data = page:title
                if.contains = Media
            }
            outerWrap = <h1>|</h1>
        }


..  _if-directReturn:

directReturn
------------

..  confval:: directReturn
    :name: if-directReturn
    :type: :ref:`data-type-boolean`

    If this property exists, no other conditions will be checked. Instead
    the true/false of this value is returned. Can be used to set
    true/false with a TypoScript constant.


..  _if-endsWith:

endsWith
--------

..  versionadded:: 12.1

..  confval::  endsWith
    :name: if-endsWith
    :type:  value / :ref:`stdwrap`

    Returns true, if the content ends with :typoscript:`value`.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript
        :emphasize-lines: 7

        # Add a footer note, if the page author ends with "Kott"
        page.100 = TEXT
        page.100 {
            value = This is an article from Benji
            htmlSpecialChars = 1
            if.value.data = page:author
            if.endsWith = Kott
            wrap = <footer>|</footer>
        }

..  _if-equals:

equals
------

..  confval:: equals
    :name: if-equals
    :type: value / :ref:`stdwrap`

    Returns true, if the content is equal to :typoscript:`value`.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        if.equals = POST
        if.value.data = GETENV:REQUEST_METHOD


..  _if-isFalse:

isFalse
-------

..  confval:: isFalse
    :name: if-isFalse
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    If the content is "false", which is empty or zero.


..  _if-isGreaterThan:

isGreaterThan
-------------

..  confval:: isGreaterThan
    :name: if-isGreaterThan
    :type: value / :ref:`stdwrap`

    Returns true, if the content is greater than :typoscript:`value`.


..  _if-isInList:

isInList
--------

..  confval:: isInList
    :name: if-isInList
    :type: value / :ref:`stdwrap`

    Returns true, if the content is in the comma-separated list
    :typoscript:`.value`.

    **Note:** The list in :typoscript:`value` may not have spaces between elements!

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        if.isInList.field = uid
        if.value = 1,2,34,50,87

    This returns true, if the uid is part of the list in :typoscript:`value`.


..  _if-isLessThan:

isLessThan
----------

..  confval:: isLessThan
    :name: if-isLessThan
    :type: value / :ref:`stdwrap`

    Returns true, if the content is less than :typoscript:`value`.


..  _if-isNull:

isNull
------

..  confval:: isNull
    :name: if-isNull
    :type: :ref:`stdWrap`

    If the resulting content of the :typoscript:`stdWrap` is null (:php:`NULL` type in PHP).

    Since null values cannot be assigned in TypoScript, only the :typoscript:`stdWrap`
    features are available below this property.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = COA_INT
        page.10.10 = TEXT
        page.10.10 {
              stdWrap.if.isNull.field = description
              value = No description available.
        }

    This example returns "No description available.", if the content of
    the field "description" is :php:`NULL`.


..  _if-isPositive:

isPositive
----------

..  confval:: isPositive
    :name: if-isPositive
    :type: :ref:`data-type-integer` / :ref:`stdwrap` \+ :ref:`objects-calc`

    Returns true, if the content is positive.


..  _if-isTrue:

isTrue
------

..  confval:: isTrue
    :name: if-isTrue
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    If the content is "true", which is not empty string and not zero.


..  _if-negate:

negate
------

..  confval:: negate
    :name: if-negate
    :type: :ref:`data-type-boolean`
    :Default: 0

    This property is checked after all other properties. If set, it
    negates the result, which is present before its execution.

    So if all other conditions, which were used, returned true, with
    this property the overall return ends up being false. If at least
    one of the other conditions, which were used, returned false, the
    overall return ends up being true.


..  _if-startsWith:

startsWith
----------

..  versionadded:: 12.1

..  confval::  startsWith
    :name: if-startsWith
    :type:  value / :ref:`stdwrap`

    Returns true, if the content starts with :typoscript:`value`.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript
        :emphasize-lines: 6

        page.10 = TEXT
        page.10 {
            value = Your editor added the magic word in the header field
            htmlSpecialChars = 1
            if.value.data = DB:tt_content:1234:header
            if.startsWith = Bazinga
        }


..  _if-value:

value
-----

..  confval:: value
    :name: if-value
    :type: value / :ref:`stdwrap`

    The value to check. This is the comparison value mentioned above.


..  index:: if; Explanation
..  _if-explanation:

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

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10.value = 10
    page.10.isGreaterThan = 11

This would return true because the value of :typoscript:`isGreaterThan` is
greater than 10, which is the base-value.

More complex is this:

..  code-block:: typoscript
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

..  _if-examples:

Examples
========

This is a GIFBUILDER object that will write "NEW" on a menu-item if
the field "newUntil" has a date less than the current date!

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    30 = TEXT
    30.text = NEW!
    30.offset = 10,10
    30.if {
      value.data = date: U
      isLessThan.field = newUntil
      negate = 1
    }
