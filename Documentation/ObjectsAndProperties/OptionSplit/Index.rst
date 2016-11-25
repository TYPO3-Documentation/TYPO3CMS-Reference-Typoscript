.. include:: ../../Includes.txt


.. _objects-optionsplit:

===========
optionSplit
===========

.. attention::

   Currently this page is being reworked. So it is totally WIP
   (work in progress.

`optionSplit` is the codename of a very tricky - but useful! - function
and functionality. When you are dealing with lists often special
rules apply to the first and the last element. `optionSplit` takes
that into account and allows a very concise notation for this.

The overall goal here is to explain:

   Given a special `optionSplit` expression and given
   different output lists of different length: Which sequence
   of elements will we get?

`optionSplit` is primarily used with the menu objects.
So let's take an example from menu building::

   temp.topmenu.1.NO {
     ATagParams = class="c"
     # ...
   }

As a result all link tags in the output will have a class attribute like
 `<a href="..." class="c" ...>`. Now, since the value of `ATagParams`
is fed through `optionSplit` first, we can write::

   ATagParams =  class="a"  |*|  class="b"  |*|  class="c"

Here we have three specifications in one line. `|*|` is the character sequence used
as delimiter to split the three parts. As a result the first link in the menu will have
`class="a"`, all items in the middle have `class="b"` and the last one has
`class="c"`.

What makes `optionSplit` tricky is the fact that you don't have to specify all three parts.
And, of course, there may only be one element in the output. Or two.
What should be done in those cases?

And as if this wasn't complicated enough `optionSplit` offers to split each of the three parts again
in - upto - three subparts each. The character sequence `||` is used as delimiter for splitting into subparts.



.. _objects-optionsplit-syntax:

Syntax
======

`|*|` splits the value in parts *first*, *middle* and *last*.

`||` splits each of the parts *first*, *middle* and *last* into - upto - three subparts.



.. _objects-optionsplit-rules:

The rules
=========

`optionSplit` follows these rules:

1. The overall priority is *last*, *first*, *middle*.

2. If the *middle*-value is empty (""), the last part of the first-
   value is repeated.

3. If the *first* value AND the *middle* value are empty, the first part of the
   last-value is repeated before the last value.

4. The *middle* value is repeated.

Example::

   first1 || first2 |*| middle1 || middle2 || middle3 |*| last1 || last2


Examples:
=========

This is very complex and you might think that this has gone too far.
But it's actually useful.

Now consider a menu with five items:

   Introduction

   Who are we?

   Business

   Contact

   Links

... and a configuration like this::

   temp.topmenu.1.NO {
     backColor = red
     ....
   }

((... all properties of *.NO* are parsed through `optionSplit` ...))





Example:
========

Here we only have the *first* part. It is split into three subparts. If there
are more than three items in the result the *last subpart* will be repeated:

.. code-block:: none

   # Definition:
   backColor = red || yellow || green

   Result:
   N        Sequence
   1        green
   2        red green
   3        red yellow green
   >3       red yellow green green ...



Example:
========

Here the *middle*-value is left out. Then the last subpart of the first
primary part is repeated.

((needs to be verified!!!))

.. code-block:: none

   # Definition:
   backColor = red || yellow  |*||*|  blue || olive

   Result:
   N        Sequence
   1        olive
   2        blue olive
   3        ?
   4        ?
   5        red yellow yellow blue olive


.. attention::

   To make the middle part empty no space may exist between the delimiters!

   Right: `|*||*|`

   Wrong: `|*| |*|`



Example:
========

Here part one (*first*) AND part two (*middle*) are empty. Part three
(*last*) is split into two subparts:

.. code-block:: none

   # Definition:
   backColor = |*||*|  blue || olive

   Result:
   N        Sequence
   1        olive
   2        blue olive
   3        blue blue olive
   >3       blue blue ... blue olive

Example:
========

We have part one (*first*)and two (*middle*), but not three (*last*).
For *middle* there are two subparts.

.. code-block:: none

   # Definition:
   backColor = red  |*|  yellow || green  |*|

   Result:
   N        Sequence
   1        red
   2        red yellow
   3        red yellow green
   4        red yellow green yellow
   5        red yellow green yellow green
   >5       red yellow green yellow green yellow ...

.. _objects-optionsplit-condensed:

Overview with abstract examples
===============================



.. contents:: Chapter contents
   :local:
   :backlinks: top



The following table gives you a condensed overview of how the
optionSplit rules work together:

((old table))
-------------

=============================  ====  ======================  =======
optionSplit                    N     Resulting sequence      Rule
=============================  ====  ======================  =======
`a`                            >=3   a a a ...
`a || b || c`                  >=5   a b c c c ...
`a || b  |*|  c`               >=5   a b c c c ...
`a || b  |*|  c  |*|  d || e`  >=8   a b c c ... c c d e     1
`a || b  |*|  c  |*|  d || e`  4     a b d e                 1
`a || b  |*|  c  |*|  d || e`  3     a d e                   1
`a || b  |*|     |*|  c || d`  >=5   a b ... b c d           2
`|*|  |*|  a || b`             >=4   a a ... a b             3
`a  |*|  b || c  |*|`          >=9   a b c b c b c ... b c   4
=============================  ====  ======================  =======


((old table rewritten in new form - still needs to be reviewed))

.. 1. The overall priority is *last, first, middle*.
..
.. 2. If the *middle*-value is empty (""), the last part of the first-
..    value is repeated.
..
.. 3. If the *first* value AND the *middle* value are empty, the first part of the
..    last-value is repeated before the last value.
..
.. 4. The *middle* value is repeated.

Example: `a`
------------

N is the the number of input elements.

=========================  ====  ======================  =======
optionSplit                N     Resulting sequence      Rule
=========================  ====  ======================  =======
`a`                        1     a
`a`                        2     a a
`a`                        3     a a a
`a`                        >3    a a a ...
=========================  ====  ======================  =======



Example: `a || b || c`
----------------------

N is the the number of input elements.

=========================  ====  ======================  =======
optionSplit                N     Resulting sequence      Rule
=========================  ====  ======================  =======
`a || b || c`              1     a
`a || b || c`              2     a b
`a || b || c`              3     a b c
`a || b || c`              4     a b c c
`a || b || c`              >4    a b c c c ...
=========================  ====  ======================  =======


Example: `|*|  |*| a || b`
--------------------------

N is the the number of input elements.

((is this correct?))

==========================  ====  ======================  =======
optionSplit                 N     Resulting sequence      Rule
==========================  ====  ======================  =======
`|*|  |*|  a || b`          1     b                       1
`|*|  |*|  a || b`          2     a b                     1
`|*|  |*|  a || b`          3     a a b                   1,3
`|*|  |*|  a || b`          >3    a ... a b               1,3
==========================  ====  ======================  =======



Example: `a |*| b || c |*|`
----------------------------

N is the the number of input elements.

((is this correct?))

============================  ====  ======================  =======
optionSplit                   N     Resulting sequence      Check!
============================  ====  ======================  =======
`a  |*|  b || c  |*|`         1     a
`a  |*|  b || c  |*|`         2     a b
`a  |*|  b || c  |*|`         3     a b c
`a  |*|  b || c  |*|`         4     a b b c                 or is it: a b c c ?
`a  |*|  b || c  |*|`         >4    a b ... b c             or is it: a b c ... c?)
============================  ====  ======================  =======



Example: `a || b |*|  |*| d || e`
---------------------------------

N is the the number of input elements.

((is this correct?))

===========================  ====  ======================  =======
optionSplit                  N     Resulting sequence      Rule
===========================  ====  ======================  =======
`a || b  |*|  |*|  d || e`   1     e
`a || b  |*|  |*|  d || e`   2     a e
`a || b  |*|  |*|  d || e`   3     a b e
`a || b  |*|  |*|  d || e`   4     a b d e
`a || b  |*|  |*|  d || e`   5     a b b d e
`a || b  |*|  |*|  d || e`   >5    a b ... b d e
===========================  ====  ======================  =======



Example: `a || b |*| c |*| d || e`
----------------------------------

N is the the number of input elements.

((is this correct?))

=============================  ====  ======================  =======
optionSplit                    N     Resulting sequence      Rule
=============================  ====  ======================  =======
`a || b  |*|  c  |*|  d || e`  1     e
`a || b  |*|  c  |*|  d || e`  2     a e
`a || b  |*|  c  |*|  d || e`  3     a b e
`a || b  |*|  c  |*|  d || e`  4     a b d e
`a || b  |*|  c  |*|  d || e`  5     a b c d e
`a || b  |*|  c  |*|  d || e`  6     a b c c d e
`a || b  |*|  c  |*|  d || e`  >6    a b c ... c d e
=============================  ====  ======================  =======

