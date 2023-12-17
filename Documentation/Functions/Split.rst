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

..  index:: select; Properties
..  _select-properties:

Properties
==========

token
-----

..  t3-function-split:: token

    :Data type: :ref:`data-type-string` / :ref:`stdwrap`

    String or character (token) used to split the value.

max
---

..  t3-function-split:: max

    :Data type: :ref:`data-type-integer` / :ref:`stdwrap`

    Maximum number of splits.

min
---

..  t3-function-split:: min

    :Data type: :ref:`data-type-integer` / :ref:`stdwrap`

    Minimum number of splits.

returnKey
---------

..  t3-function-split:: returnKey

    :Data type: :ref:`data-type-integer` / :ref:`stdwrap`

    Instead of parsing the split result, return the element of the
    index with this number immediately and stop processing of the split
    function.

returnCount
-----------

..  t3-function-split:: returnCount

    :Data type: :ref:`data-type-boolean` / :ref:`stdwrap`

    Counts all elements resulting from the split, returns their number
    and stops processing of the split function.

    ..  rubric:: Example

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       # returns 9
       1 = TEXT
       1 {
           value = x,y,z,1,2,3,a,b,c
           split.token = ,
           split.returnCount = 1
       }

cObjNum
-------

..  t3-function-split:: cObjNum

    :Data type: *cObjNum* + :ref:`optionsplit` / :ref:`stdwrap`

    This is a pointer the array of this object ("1,2,3,4"), that should
    treat the items, resulting from the split.

1,2,3,4
-------

..  t3-function-split:: 1,2,3,4,...

    :Data type: :ref:`cObject <data-type-cobject>` / :ref:`stdwrap`

    The object that should treat the value.

    **Note:** The "current"-value is set to the value of current item,
    when the objects are called. See :ref:`stdwrap` / current.

    ..  rubric:: Example for stdWrap

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        1.current = 1
        1.wrap = <b> | </b>

    ..  rubric:: Example for stdWrap

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        1 {
            10 = TEXT
            10.stdWrap.current = 1
            10.stdWrap.wrap = <b> | </b>
        }

.. _split-wrap:

wrap
----

..  t3-function-split:: wrap

    :Data type: wrap + :ref:`optionsplit` / :ref:`stdwrap`

    Defines a wrap for each item.


.. _split-examples:

Example
=======

This is an example of TypoScript code that imports the content of
field "bodytext" from the :php:`$cObj->data-array` (ln 3). The content is
split by the line break character (ln 5). The items should all be
treated with a :typoscript:`stdWrap` (ln 6) which imports the value of the item (ln
7). This value is wrapped in a table row where the first column is a
bullet-gif (ln 8). Finally the whole thing is wrapped in the proper
table-tags (ln 10). :

..  code-block:: typoscript
    :linenos:

    20 = TEXT
    20.stdWrap {
        field = bodytext
        split {
            token.char = 10
            cObjNum = 1
            1.current = 1
            1.wrap = <tr><td><img src="dot.gif"></td><td> | </td></tr>
        }
        stdWrap.wrap = <table style="width: 368px;"> | </table><br>
    }
