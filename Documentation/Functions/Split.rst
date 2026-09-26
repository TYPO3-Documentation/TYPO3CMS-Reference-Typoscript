..  include:: /Includes.rst.txt
..  index:: Functions; split
..  _split:

=====
split
=====

This object is used to split the input by a character and then parse
the result onto some functions.

For each iteration the split index starting with 0 (zero) is stored in
the register key :typoscript:`SPLIT_COUNT`.

..  contents::
    :local:

..  index:: split; Properties
..  _split-properties:

Properties
==========

..  _split-token:

token
-----

..  confval:: token
    :name: split-token
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    String or character (token) used to split the value.


..  _split-max:

max
---

..  confval:: max
    :name: split-max
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>`

    Maximum number of splits.


..  _split-min:

min
---

..  confval:: min
    :name: split-min
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>`

    Minimum number of splits.


..  _split-returnKey:

returnKey
---------

..  confval:: returnKey
    :name: split-returnKey
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>`

    Instead of parsing the split result, return the element of the
    index with this number immediately and stop processing of the split
    function.


..  _split-returnCount:

returnCount
-----------

..  confval:: returnCount
    :name: split-returnCount
    :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdwrap>`

    Counts all elements resulting from the split, returns their number
    and stops processing of the split function.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_returnCount.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _split-cObjNum:

cObjNum
-------

..  confval:: cObjNum
    :name: split-cObjNum
    :type: *cObjNum* + :ref:`optionSplit <optionsplit>` / :ref:`stdWrap <stdwrap>`

    This is a pointer the array of this object ("1,2,3,4"), that should
    treat the items, resulting from the split.


..  _split-cObject:

1,2,3,4
-------

..  confval:: 1,2,3,4,...
    :name: split-cObject
    :type: :ref:`cObject <data-type-cobject>` / :ref:`stdWrap <stdwrap>`

    The object that should treat the value.

    **Note:** The "current"-value is set to the value of current item,
    when the objects are called. See :ref:`stdWrap <stdwrap>` / current.

    ..  rubric:: Example for stdWrap

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        1.current = 1
        1.wrap = <b> | </b>

    ..  rubric:: Example for stdWrap

    ..  literalinclude:: _codesnippets/_cObject.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

..  _split-wrap:

wrap
----

..  confval:: wrap
    :name: split-wrap
    :type: wrap + :ref:`optionSplit <optionsplit>` / :ref:`stdWrap <stdwrap>`

    Defines a wrap for each item.


..  _split-examples:

Example
=======

This is an example of TypoScript code that imports the content of
field "bodytext" from the :php:`$cObj->data-array` (ln 3). The content is
split by the line break character (ln 5). The items should all be
treated with a :typoscript:`stdWrap` (ln 6) which imports the value of the item (ln
7). This value is wrapped in a table row where the first column is a
bullet-gif (ln 8). Finally the whole thing is wrapped in the proper
table-tags (ln 10). :

..  literalinclude:: _codesnippets/_split.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
    :linenos:
