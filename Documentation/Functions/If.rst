..  include:: /Includes.rst.txt
..  index::
    Functions; if
    if
..  _if:

==
if
==

Allows you to check multiple conditions.

This function returns true, if **all** of the present conditions are met
(they are connected with an "AND", a logical conjunction). If a
single condition is false, the value returned is false.

The returned value may still be negated by the :ref:`negate <if-negate>` property.

There is no else property available. The "else" branch of an "if" statement is a
missing feature. You can implement a workaround by a logic based on the
:ref:`Properties for overriding and conditions <stdwrap-override-conditions>`.

Simple "if empty use different value" conditions for record data can be built
with the :ref:`TypoScript // (double slash) <data-type-gettext-double-slash>`
fallback operator.

Also check the explanations and the examples further below!

..  contents::
    :local:

..  _if-properties:

Properties
==========

..  _if-bitAnd:

bitAnd
------

..  confval:: bitAnd
    :name: if-bitAnd
    :type: value / :ref:`stdWrap <stdwrap>`

    Returns true, if the value is part of the bit set.

    ..  rubric:: Example

    TYPO3 uses bits to store radio and checkboxes via TCA, `bitAnd` can be used to test against these fields.

    ..  literalinclude:: _codesnippets/_bitAnd.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _if-contains:

contains
--------

..  confval::  contains
    :name: if-contains
    :type:  value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content contains :typoscript:`value`.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_contains.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
        :emphasize-lines: 11


..  _if-directReturn:

directReturn
------------

..  confval:: directReturn
    :name: if-directReturn
    :type: :ref:`boolean <data-type-boolean>`

    If this property exists, no other conditions will be checked. Instead
    the true/false of this value is returned. Can be used to set
    true/false with a TypoScript constant.


..  _if-endsWith:

endsWith
--------

..  confval::  endsWith
    :name: if-endsWith
    :type:  value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content ends with :typoscript:`value`.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_endsWith.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
        :emphasize-lines: 7

..  _if-equals:

equals
------

..  confval:: equals
    :name: if-equals
    :type: value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content is equal to :typoscript:`value`.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        if.equals = POST
        if.value.data = GETENV:REQUEST_METHOD


..  _if-isFalse:

isFalse
-------

..  confval:: isFalse
    :name: if-isFalse
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    If the content is "false", which is empty or zero.


..  _if-isGreaterThan:

isGreaterThan
-------------

..  confval:: isGreaterThan
    :name: if-isGreaterThan
    :type: value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content is greater than :typoscript:`value`.


..  _if-isInList:

isInList
--------

..  confval:: isInList
    :name: if-isInList
    :type: value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content is in the comma-separated list
    :typoscript:`.value`.

    **Note:** The list in :typoscript:`value` may not have spaces between elements!

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        if.isInList.field = uid
        if.value = 1,2,34,50,87

    This returns true, if the uid is part of the list in :typoscript:`value`.


..  _if-isLessThan:

isLessThan
----------

..  confval:: isLessThan
    :name: if-isLessThan
    :type: value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content is less than :typoscript:`value`.


..  _if-isNull:

isNull
------

..  confval:: isNull
    :name: if-isNull
    :type: :ref:`stdWrap <stdWrap>`

    If the resulting content of the :typoscript:`stdWrap` is null (:php:`NULL` type in PHP).

    Since null values cannot be assigned in TypoScript, only the :typoscript:`stdWrap`
    features are available below this property.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_isNull.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    This example returns "No description available.", if the content of
    the field "description" is :php:`NULL`.


..  _if-isPositive:

isPositive
----------

..  confval:: isPositive
    :name: if-isPositive
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>` \+ :ref:`Calculating values (+calc) <objects-calc>`

    Returns true, if the content is positive.


..  _if-isTrue:

isTrue
------

..  confval:: isTrue
    :name: if-isTrue
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    If the content is "true", which is not empty string and not zero.


..  _if-negate:

negate
------

..  confval:: negate
    :name: if-negate
    :type: :ref:`boolean <data-type-boolean>`
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

..  confval::  startsWith
    :name: if-startsWith
    :type:  value / :ref:`stdWrap <stdwrap>`

    Returns true, if the content starts with :typoscript:`value`.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_startsWith.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
        :emphasize-lines: 6


..  _if-value:

value
-----

..  confval:: value
    :name: if-value
    :type: value / :ref:`stdWrap <stdwrap>`

    The value to check. This is the comparison value mentioned above.


..  index:: if; Explanation
..  _if-explanation:

Explanation
===========

The "if"-function is a very odd way of returning true or false!
Beware!

"if" is normally used to decide whether to render an object or to return
a value (see the :ref:`Content Objects (cObject) <data-type-cobject>` and :ref:`stdWrap <stdWrap>`).

Here is how it works:

The function returns true or false. Whether it returns true or false
depends on the properties of this function. Say if you set :typoscript:`isTrue = 1`
then the result is true. If you set :typoscript:`isTrue.field = header`, the
function returns true if the field "header" in :php:`$cObj->data` is set!

If you want to compare values, you must load a base-value in the
:typoscript:`value`-property. Example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    page.10.if.value = 10
    page.10.if.isGreaterThan = 11

This would return true because the value of :typoscript:`isGreaterThan` is
greater than 10, which is the base-value.

More complex is this:

..  literalinclude:: _codesnippets/_explanation.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

There are two conditions - :typoscript:`isGreaterThan` and :typoscript:`isTrue`.
If they are both true, the total is true (both are connected with an AND).
BUT(!) then the result of the function in total would be false because the
:typoscript:`negate`-flag inverts the result!

..  _if-examples:

Examples
========

This is a GIFBUILDER object that will write "NEW" on a menu-item if
the field "newUntil" has a date less than the current date!

..  literalinclude:: _codesnippets/_if.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
