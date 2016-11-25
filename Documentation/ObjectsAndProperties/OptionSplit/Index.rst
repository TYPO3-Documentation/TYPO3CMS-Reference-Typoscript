.. include:: ../../Includes.txt


.. _objects-optionsplit:

===========
optionSplit
===========

.. attention::

   Currently this page is being reworked. So it is totally WIP (work in progress).

`optionSplit` is the codename of a very tricky - but useful! - function
and functionality. When you are dealing with lists often special
rules apply to the first and the last element. `optionSplit` takes
that into account and allows a very concise notation for this.

**The overall goal here is to explain:**

   Given a special `optionSplit` expression and given
   different output lists of different length: Which sequences
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

=============================  ====  ======================  =======
optionSplit                    N     Resulting sequence      Rule
=============================  ====  ======================  =======
`a || b  |*|  c  |*|  d || e`  1     e
`a || b  |*|  c  |*|  d || e`  2     d e
`a || b  |*|  c  |*|  d || e`  3     a d e
`a || b  |*|  c  |*|  d || e`  4     a b d e
`a || b  |*|  c  |*|  d || e`  5     a b c d e
`a || b  |*|  c  |*|  d || e`  6     a b c c d e
`a || b  |*|  c  |*|  d || e`  >6    a b c ... c d e
=============================  ====  ======================  =======



Test Code (TypoScript)
======================

Constants::

   # Bernd Wilke (πφ), 2016-11-24

   os_1 = a
   os_2 = a || b || c
   os_3 = |*|  |*| a || b
   os_4 = a |*| b || c |*|
   os_5 = a || b |*|  |*| d || e
   os_6 = a || b |*| c |*| d || e

   os1 = a
   os2 = a||b||c
   os3 = |*||*|a||b
   os4 = a|*|b||c|*|
   os5 = a||b|*||*|d||e
   os6 = a||b|*|c|*|d||e


Setup::

   # Bernd Wilke (πφ), 2016-11-24
   temp.marray = HMENU
   temp.marray {
     special = directory
     # enter a page with at least 9 visible subpages!
     special.value = 9
     maxItems = 5

     1 = TMENU
     1 {
       NO {
         before = _
         doNotShowLink = 1
       }
     }
   }

   temp.mrow = COA
   temp.mrow {
     1 = LOAD_REGISTER
     1.os = {$os4}

     5 = TEXT
     5.data = register:os
     5.wrap = <th>|</th>

     10 < temp.marray
     10.maxItems = 1
     10.wrap = <td>[|]</td>

     20 < .10
     20.maxItems = 2

     30 < .10
     30.maxItems = 3

     40 < .10
     40.maxItems = 4

     50 < .10
     50.maxItems = 5

     60 < .10
     60.maxItems = 6

     70 < .10
     70.maxItems = 7

     80 < .10
     80.maxItems = 8

     90 < .10
     90.maxItems = 9

     100 = RESTORE_REGISTER

     wrap = <tr>|</tr>
   }

   # Default PAGE object:
   page = PAGE

   page.10 = COA
   page.10 {
     wrap = <pre>|</pre>
     10 = COA
     10 {
       wrap (
       <table>
         <tr>
           <th>optionsplit</th>
           <th>1</th>
       <th>2</th>
       <th>3</th>
       <th>4</th>
       <th>5</th>
       <th>6</th>
       <th>7</th>
       <th>8</th>
       <th>9</th>
       </tr>
       |
       </table>
       )

       10 < temp.mrow
       10 {
         1.os = {$os1}
         10.1.NO.before.wrap = {$os1}
         20.1.NO.before.wrap = {$os1}
         30.1.NO.before.wrap = {$os1}
         40.1.NO.before.wrap = {$os1}
         50.1.NO.before.wrap = {$os1}
         60.1.NO.before.wrap = {$os1}
         70.1.NO.before.wrap = {$os1}
         80.1.NO.before.wrap = {$os1}
         90.1.NO.before.wrap = {$os1}
       }

       20 < .10
       20 {
         1.os = {$os2}
         10.1.NO.before.wrap = {$os2}
         20.1.NO.before.wrap = {$os2}
         30.1.NO.before.wrap = {$os2}
         40.1.NO.before.wrap = {$os2}
         50.1.NO.before.wrap = {$os2}
         60.1.NO.before.wrap = {$os2}
         70.1.NO.before.wrap = {$os2}
         80.1.NO.before.wrap = {$os2}
         90.1.NO.before.wrap = {$os2}
       }

       30 < .10
       30 {
         1.os = {$os3}
         10.1.NO.before.wrap = {$os3}
         20.1.NO.before.wrap = {$os3}
         30.1.NO.before.wrap = {$os3}
         40.1.NO.before.wrap = {$os3}
         50.1.NO.before.wrap = {$os3}
         60.1.NO.before.wrap = {$os3}
         70.1.NO.before.wrap = {$os3}
         80.1.NO.before.wrap = {$os3}
         90.1.NO.before.wrap = {$os3}
       }


       40 < .10
       40 {
         1.os = {$os4}
         10.1.NO.before.wrap = {$os4}
         20.1.NO.before.wrap = {$os4}
         30.1.NO.before.wrap = {$os4}
         40.1.NO.before.wrap = {$os4}
         50.1.NO.before.wrap = {$os4}
         60.1.NO.before.wrap = {$os4}
         70.1.NO.before.wrap = {$os4}
         80.1.NO.before.wrap = {$os4}
         90.1.NO.before.wrap = {$os4}
       }


       50 < .10
       50 {
         1.os = {$os5}
         10.1.NO.before.wrap = {$os5}
         20.1.NO.before.wrap = {$os5}
         30.1.NO.before.wrap = {$os5}
         40.1.NO.before.wrap = {$os5}
         50.1.NO.before.wrap = {$os5}
         60.1.NO.before.wrap = {$os5}
         70.1.NO.before.wrap = {$os5}
         80.1.NO.before.wrap = {$os5}
         90.1.NO.before.wrap = {$os5}
       }


       60 < .10
       60 {
         1.os = {$os6}
         10.1.NO.before.wrap = {$os6}
         20.1.NO.before.wrap = {$os6}
         30.1.NO.before.wrap = {$os6}
         40.1.NO.before.wrap = {$os6}
         50.1.NO.before.wrap = {$os6}
         60.1.NO.before.wrap = {$os6}
         70.1.NO.before.wrap = {$os6}
         80.1.NO.before.wrap = {$os6}
         90.1.NO.before.wrap = {$os6}
       }
     }

     20 = TEXT
     20.value = <hr />

     30 = COA
     30 {
       wrap (
       <table>
         <tr>
           <th>optionsplit</th>
           <th>1</th>
       <th>2</th>
       <th>3</th>
       <th>4</th>
       <th>5</th>
       <th>6</th>
       <th>7</th>
       <th>8</th>
       <th>9</th>
       </tr>
       |
       </table>
       )

       10 < temp.mrow
       10 {
         1.os = {$os_1}
         10.1.NO.before.wrap = {$os_1}
         20.1.NO.before.wrap = {$os_1}
         30.1.NO.before.wrap = {$os_1}
         40.1.NO.before.wrap = {$os_1}
         50.1.NO.before.wrap = {$os_1}
         60.1.NO.before.wrap = {$os_1}
         70.1.NO.before.wrap = {$os_1}
         80.1.NO.before.wrap = {$os_1}
         90.1.NO.before.wrap = {$os_1}
       }

       20 < .10
       20 {
         1.os = {$os_2}
         10.1.NO.before.wrap = {$os_2}
         20.1.NO.before.wrap = {$os_2}
         30.1.NO.before.wrap = {$os_2}
         40.1.NO.before.wrap = {$os_2}
         50.1.NO.before.wrap = {$os_2}
         60.1.NO.before.wrap = {$os_2}
         70.1.NO.before.wrap = {$os_2}
         80.1.NO.before.wrap = {$os_2}
         90.1.NO.before.wrap = {$os_2}
       }

       30 < .10
       30 {
         1.os = {$os_3}
         10.1.NO.before.wrap = {$os_3}
         20.1.NO.before.wrap = {$os_3}
         30.1.NO.before.wrap = {$os_3}
         40.1.NO.before.wrap = {$os_3}
         50.1.NO.before.wrap = {$os_3}
         60.1.NO.before.wrap = {$os_3}
         70.1.NO.before.wrap = {$os_3}
         80.1.NO.before.wrap = {$os_3}
         90.1.NO.before.wrap = {$os_3}
       }


       40 < .10
       40 {
         1.os = {$os_4}
         10.1.NO.before.wrap = {$os_4}
         20.1.NO.before.wrap = {$os_4}
         30.1.NO.before.wrap = {$os_4}
         40.1.NO.before.wrap = {$os_4}
         50.1.NO.before.wrap = {$os_4}
         60.1.NO.before.wrap = {$os_4}
         70.1.NO.before.wrap = {$os_4}
         80.1.NO.before.wrap = {$os_4}
         90.1.NO.before.wrap = {$os_4}
       }


       50 < .10
       50 {
         1.os = {$os_5}
         10.1.NO.before.wrap = {$os_5}
         20.1.NO.before.wrap = {$os_5}
         30.1.NO.before.wrap = {$os_5}
         40.1.NO.before.wrap = {$os_5}
         50.1.NO.before.wrap = {$os_5}
         60.1.NO.before.wrap = {$os_5}
         70.1.NO.before.wrap = {$os_5}
         80.1.NO.before.wrap = {$os_5}
         90.1.NO.before.wrap = {$os_5}
       }


       60 < .10
       60 {
         1.os = {$os_6}
         10.1.NO.before.wrap = {$os_6}
         20.1.NO.before.wrap = {$os_6}
         30.1.NO.before.wrap = {$os_6}
         40.1.NO.before.wrap = {$os_6}
         50.1.NO.before.wrap = {$os_6}
         60.1.NO.before.wrap = {$os_6}
         70.1.NO.before.wrap = {$os_6}
         80.1.NO.before.wrap = {$os_6}
         90.1.NO.before.wrap = {$os_6}
       }
     }
   }


Test Code Result
================

.. code-block:: none

   a                 [a_]  [a_a_]  [a_a_a_]  [a_a_a_a_]  [a_a_a_a_a_]  [a_a_a_a_a_a_]  [a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_a_]
   a||b||c           [a_]  [a_b_]  [a_b_c_]  [a_b_c_c_]  [a_b_c_c_c_]  [a_b_c_c_c_c_]  [a_b_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_c_]
   |*||*|a||b        [b_]  [a_b_]  [a_a_b_]  [a_a_a_b_]  [a_a_a_a_b_]  [a_a_a_a_a_b_]  [a_a_a_a_a_a_b_]  [a_a_a_a_a_a_a_b_]  [a_a_a_a_a_a_a_a_b_]
   a|*|b||c|*|       [a_]  [a_b_]  [a_b_c_]  [a_b_c_b_]  [a_b_c_b_c_]  [a_b_c_b_c_b_]  [a_b_c_b_c_b_c_]  [a_b_c_b_c_b_c_b_]  [a_b_c_b_c_b_c_b_c_]
   a||b|*||*|d||e    [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b_b_d_e_]  [a_b_b_b_d_e_]  [a_b_b_b_b_d_e_]  [a_b_b_b_b_b_d_e_]  [a_b_b_b_b_b_b_d_e_]
   a||b|*|c|*|d||e   [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b_c_d_e_]  [a_b_c_c_d_e_]  [a_b_c_c_c_d_e_]  [a_b_c_c_c_c_d_e_]  [a_b_c_c_c_c_c_d_e_]

   a                        [a_]  [a_a_]  [a_a_a_]  [a_a_a_a_]  [a_a_a_a_a_]  [a_a_a_a_a_a_]  [a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_a_]
   a || b || c              [a_]  [a_b_]  [a_b_c_]  [a_b_c_c_]  [a_b_c_c_c_]  [a_b_c_c_c_c_]  [a_b_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_c_]
   |*| |*| a || b           [b_]  [a_b_]  [_a_b_]   [__a_b_]    [___a_b_]     [____a_b_]      [_____a_b_]       [______a_b_]        [_______a_b_]
   a |*| b || c |*|         [a_]  [a_b_]  [a_b_c_]  [a_b_c_b_]  [a_b_c_b_c_]  [a_b_c_b_c_b_]  [a_b_c_b_c_b_c_]  [a_b_c_b_c_b_c_b_]  [a_b_c_b_c_b_c_b_c_]
   a || b |*| |*| d || e    [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b__d_e_]   [a_b___d_e_]    [a_b____d_e_]     [a_b_____d_e_]      [a_b______d_e_]
   a || b |*| c |*| d || e  [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b_c_d_e_]  [a_b_c_c_d_e_]  [a_b_c_c_c_d_e_]  [a_b_c_c_c_c_d_e_]  [a_b_c_c_c_c_c_d_e_]

