.. include:: ../../Includes.txt


.. _objects-optionsplit:

===========
optionSplit
===========

.. contents:: On this page:
   :local:
   :backlinks: top
   :class: compact


Introduction
============

:ts:`optionSplit` is the codename of a very tricky - but very useful! - function
and functionality. It is primarily used with the menu objects where it is
enable for MANY properties. This make :ts:`optionSplit` really powerful.

So let's take an example from menu building.
As a result all A-tags generated from this definition will have the `class` attribute
set like this: :html:`<a class="z" ... >`::

   topmenu.1.NO {
       ATagParams = class="z"
   }

How many A-tags will there be? Usually we cannot answer that question in advance
as we cannot know how long the list of menu items is. From zero to many everything
is possible. Let's describe this as: We have an **output sequence of 0 to N items**.

In real life one more thing is important: We often want to have a different properties
for the first and the last or odd and even elements. :ts:`optionSplit` tries to offer
an easy solution for this task as well. We can specify more than just one shaping
of a value for a property. Let's describe this as: We have an **input sequence M items**.

Now we can precisely define what :ts:`optionSplit` is.

Definition:
   :ts:`optionSplit` is a **syntax** to define an input sequence of a fixed amount **M**
   of values. It has a fixed, builtin **ruleset**. Its **functionality** is to
   apply ONE of the input values to each output item according to the position of
   the output item and the ruleset.

In other words:

   1. We have an **input sequence of M items**. M is known.
   2. We have an **output sequence of 0 to N items**. N is unknown and may be zero, one, or "large".
   3. We have a **ruleset** delivered with :ts:`optionSplit` that specifies how the input sequence
      should be applied to the output sequence.

In the following we'll try to shed light on this.


PHP-Code
========

Lookout for usages of the function
:php:`\TYPO3\CMS\Core\TypoScript\TemplateService::splitConfArray()`.



.. highlight:: none


Terminology
===========

It's useful to aggree about some terms first: delimiter string, mainpart, subpart.

Mainparts
~~~~~~~~~

:ts:`optionSplit` uses the string `|*|` to split the total string into **mainparts**.
Up to **three** mainparts will be used. If there are more they
will be ignored.
On the input side we may have for example::

   wrap =                      We have: M=0  items; 1  mainpart : A      ; mainpart is empty
   wrap = A                    We have: M=1  items; 1  mainpart : A      ;
   wrap = A |*| R              We have: M=2  items; 2  mainparts: A, R   ;
   wrap = A |*| R |*| Z        We have: M=3  items; 3  mainparts: A, R, Z;
   wrap = A |*| R |*| Z |*| X  We have: M=3! items; 3! mainparts: A, R, Z; only two delimiters are important


Our terminology:
   |  A always implies that it's the first mainpart.
   |  R stands for a second mainpart.
   |  Z denotes the third mainpart.


Viewed from the perspective of how many mainpart delimiters `|*|` we have
the cases:

1. We have only mainpart A if there is no `|*|`.
2. We have mainparts A and R if `|*|` occurs exactly once.
3. We have mainparts A, R and Z if `|*|` occurs - at least - twice.


Subparts
~~~~~~~~

Each mainpart may be split further into **subparts**. The delimiter for splitting a mainpart into
subparts is `||`.

Example::

   wrap = a                       We have: M=1  item,  1 mainpart,  1 subparts
   wrap = a || b                  We have: M=2  items, 1 mainpart,  2 subparts
   wrap = a || b || c             We have: M=3  items, 1 mainpart,  3 subparts
   wrap = a || b || c || d        We have: M=4  items, 1 mainpart,  4 subparts
   wrap = a || b || c || d || ... We have: M>4  items, 1 mainpart, >4 subparts

**Rule:** There can be any number of subparts.



Full example to see how it works
================================

Let's look at a full example that visualizes what we have said so far.


Three by three items
~~~~~~~~~~~~~~~~~~~~

We have all three mainparts A, R and Z. And each mainpart is split into three
subparts::

   wrap = a || b || c  |*|  r || s || t  |*|  x || y || z

Mainpart A (the first one) consists of the three subparts a, b, c.

Mainpart R (the second one) consists of the three subparts r, s, t.

Mainpart Z (the third one) consists of the three subparts x, y, z.

And this is what happens::

   input:
      wrap = a || b || c  |*|  r || s || t  |*|  x || y || z

   output:
       N     output sequence
       1     z
       2     y z
       3     x y z
       4     a x y z
       5     a b x y z
       6     a b c x y z
       7     a b c r x y z
       8     a b c r s x y z
       9     a b c r s t x y z
      10     a b c r s t r x y z
      11     a b c r s t r s x y z
      12     a b c r s t r s t x y z
      13     a b c r s t r s t r x y z
      14     a b c r s t r s t r s x y z
      15     a b c r s t r s t r s t x y z
      16     a b c r s t r s t r s t r x y z
      17     a b c r s t r s t r s t r s x y z
      18     a b c r s t r s t r s t r s t x y z
      19     a b c r s t r s t r s t r s t r x y z
      20     a b c r s t r s t r s t r s t r s x y z


The optionSplit ruleset
=======================

From the full example we can deduce the **builtin ruleset**:

1. The items of mainpart Z are used first.
2. The items of mainpart A are used second.
3. The items of mainpart R are used third.
4. The *order* in which input items appear in the output is from left to right
   exactly as in the input.
5. For mainpart Z the *start position* is as close to the *end* as possible.
6. For mainpart A subparts are taken from the beginning.
7. For mainpart R subparts are taken from the beginning and the whole
   sequence R is *repeated* from the beginning as long as necessary.


More Examples
=============

Three by two items
~~~~~~~~~~~~~~~~~~

Rules 1 to 7 define this behavior::

   input:
      wrap = a || b  |*|  r || s  |*|  y || z

   output:
       N     output sequence
       1     z
       2     y z
       3     a y z
       4     a b y z
       5     a b r y z
       6     a b r s y z
       7     a b r s r y z
       8     a b r s r s y z
       9     a b r s r s r y z
      10     a b r s r s r s y z
      11     a b r s r s r s r y z
      12     a b r s r s r s r s y z
      13     a b r s r s r s r s r y z
      14     a b r s r s r s r s r s y z
      15     a b r s r s r s r s r s r y z
      16     a b r s r s r s r s r s r s y z
      17     a b r s r s r s r s r s r s r y z
      18     a b r s r s r s r s r s r s r s y z
      19     a b r s r s r s r s r s r s r s r y z
      20     a b r s r s r s r s r s r s r s r s y z


Three by one items
~~~~~~~~~~~~~~~~~~

And again::

   input:
      wrap = a   |*|  r   |*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a r z
       4     a r r z
       5     a r r r z
       6     a r r r r z
       7     a r r r r r z
       8     a r r r r r r z
       9     a r r r r r r r z
      10     a r r r r r r r r z
      11     a r r r r r r r r r z
      12     a r r r r r r r r r r z
      13     a r r r r r r r r r r r z
      14     a r r r r r r r r r r r r z
      15     a r r r r r r r r r r r r r z
      16     a r r r r r r r r r r r r r r z
      17     a r r r r r r r r r r r r r r r z
      18     a r r r r r r r r r r r r r r r r z
      19     a r r r r r r r r r r r r r r r r r z
      20     a r r r r r r r r r r r r r r r r r r z



Two by three items
~~~~~~~~~~~~~~~~~~

Now the mainpart delimiter `|*|` occurrs only once. So we are
dealing with the first two mainparts A and R.

According to rules 1 to 7 we get::

   input:
      wrap = a || b || c  |*|  r || s || t

   output:
       N     output sequence
       1     a
       2     a b
       3     a b c
       4     a b c r
       5     a b c r s
       6     a b c r s t
       7     a b c r s t r
       8     a b c r s t r s
       9     a b c r s t r s t
      10     a b c r s t r s t r
      11     a b c r s t r s t r s
      12     a b c r s t r s t r s t
      13     a b c r s t r s t r s t r
      14     a b c r s t r s t r s t r s
      15     a b c r s t r s t r s t r s t
      16     a b c r s t r s t r s t r s t r
      17     a b c r s t r s t r s t r s t r s
      18     a b c r s t r s t r s t r s t r s t
      19     a b c r s t r s t r s t r s t r s t r
      20     a b c r s t r s t r s t r s t r s t r s


Two by two items
~~~~~~~~~~~~~~~~

According to rules 1 to 7 we get::

   input:
      wrap = a || b  |*|  r || s

   output:
       N     output sequence
       1     a
       2     a b
       3     a b r
       4     a b r s
       5     a b r s r
       6     a b r s r s
       7     a b r s r s r
       8     a b r s r s r s
       9     a b r s r s r s r
      10     a b r s r s r s r s
      11     a b r s r s r s r s r
      12     a b r s r s r s r s r s
      13     a b r s r s r s r s r s r
      14     a b r s r s r s r s r s r s
      15     a b r s r s r s r s r s r s r
      16     a b r s r s r s r s r s r s r s
      17     a b r s r s r s r s r s r s r s r
      18     a b r s r s r s r s r s r s r s r s
      19     a b r s r s r s r s r s r s r s r s r
      20     a b r s r s r s r s r s r s r s r s r s


Two by one items
~~~~~~~~~~~~~~~~

According to rules 1 to 7 we get::

   input:
      wrap = a  |*|  r

   output:
       N     output sequence
       1     a
       2     a r
       3     a r r
       4     a r r r
       5     a r r r r
       6     a r r r r r
       7     a r r r r r r
       8     a r r r r r r r
       9     a r r r r r r r r
      10     a r r r r r r r r r
      11     a r r r r r r r r r r
      12     a r r r r r r r r r r r
      13     a r r r r r r r r r r r r
      14     a r r r r r r r r r r r r r
      15     a r r r r r r r r r r r r r r
      16     a r r r r r r r r r r r r r r r
      17     a r r r r r r r r r r r r r r r r
      18     a r r r r r r r r r r r r r r r r r
      19     a r r r r r r r r r r r r r r r r r r
      20     a r r r r r r r r r r r r r r r r r r r



One by one items
~~~~~~~~~~~~~~~~

With no delimiters at all we still have - implictely - one mainpart
A with one subpart a::

   input:
      wrap = a

   output:
       N     output sequence
       1     a
       2     a a
       3     a a a
       4     a a a a
       5     a a a a a
       6     a a a a a a
       7     a a a a a a a
       8     a a a a a a a a
       9     a a a a a a a a a
      10     a a a a a a a a a a
      11     a a a a a a a a a a a
      12     a a a a a a a a a a a a
      13     a a a a a a a a a a a a a
      14     a a a a a a a a a a a a a a
      15     a a a a a a a a a a a a a a a
      16     a a a a a a a a a a a a a a a a
      17     a a a a a a a a a a a a a a a a a
      18     a a a a a a a a a a a a a a a a a a
      19     a a a a a a a a a a a a a a a a a a a
      20     a a a a a a a a a a a a a a a a a a a a



One by two items
~~~~~~~~~~~~~~~~

One mainpart A with two subparts a and b::

   input:
      wrap = a || b

   output:
       N     output sequence
       1     a
       2     a b
       3     a b b
       4     a b b b
       5     a b b b b
       6     a b b b b b
       7     a b b b b b b
       8     a b b b b b b b
       9     a b b b b b b b b
      10     a b b b b b b b b b
      11     a b b b b b b b b b b
      12     a b b b b b b b b b b b
      13     a b b b b b b b b b b b b
      14     a b b b b b b b b b b b b b
      15     a b b b b b b b b b b b b b b
      16     a b b b b b b b b b b b b b b b
      17     a b b b b b b b b b b b b b b b b
      18     a b b b b b b b b b b b b b b b b b
      19     a b b b b b b b b b b b b b b b b b b
      20     a b b b b b b b b b b b b b b b b b b b


One by three items
~~~~~~~~~~~~~~~~~~

More::

   input:
      wrap = a || b || c

   output:
       N     output sequence
       1     a
       2     a b
       3     a b c
       4     a b c c
       5     a b c c c
       6     a b c c c c
       7     a b c c c c c
       8     a b c c c c c c
       9     a b c c c c c c c
      10     a b c c c c c c c c
      11     a b c c c c c c c c c
      12     a b c c c c c c c c c c
      13     a b c c c c c c c c c c c
      14     a b c c c c c c c c c c c c
      15     a b c c c c c c c c c c c c c
      16     a b c c c c c c c c c c c c c c
      17     a b c c c c c c c c c c c c c c c
      18     a b c c c c c c c c c c c c c c c c
      19     a b c c c c c c c c c c c c c c c c c
      20     a b c c c c c c c c c c c c c c c c c c

One by four items
~~~~~~~~~~~~~~~~~

More::

   input:
      wrap = a || b || c || d

   output:
       N     output sequence
       1     a
       2     a b
       3     a b c
       4     a b c d
       5     a b c d d
       6     a b c d d d
       7     a b c d d d d
       8     a b c d d d d d
       9     a b c d d d d d d
      10     a b c d d d d d d d
      11     a b c d d d d d d d d
      12     a b c d d d d d d d d d
      13     a b c d d d d d d d d d d
      14     a b c d d d d d d d d d d d
      15     a b c d d d d d d d d d d d d
      16     a b c d d d d d d d d d d d d d
      17     a b c d d d d d d d d d d d d d d
      18     a b c d d d d d d d d d d d d d d d
      19     a b c d d d d d d d d d d d d d d d d
      20     a b c d d d d d d d d d d d d d d d d d



More examples: Tricky stuff
===========================


Three items A, no item R, three items Z
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In this situation with still have **three** mainparts. We can tell this from the fact that we have
TWO occurrences of the mainpart delimiter. And the second mainpart R is really empty.

As result we get::

   input:
      wrap = a || b || c  |*||*|  x || y || z

   output:
       N     output sequence
       1     z
       2     y z
       3     x y z
       4     a x y z
       5     a b x y z
       6     a b c x y z
       7     a b c c x y z
       8     a b c c c x y z
       9     a b c c c c x y z
      10     a b c c c c c x y z
      11     a b c c c c c c x y z
      12     a b c c c c c c c x y z
      13     a b c c c c c c c c x y z
      14     a b c c c c c c c c c x y z
      15     a b c c c c c c c c c c x y z
      16     a b c c c c c c c c c c c x y z
      17     a b c c c c c c c c c c c c x y z
      18     a b c c c c c c c c c c c c c x y z
      19     a b c c c c c c c c c c c c c c x y z
      20     a b c c c c c c c c c c c c c c c x y z


**`optionSplit` rules:**

8. If mainpart R is empty the last subpart of A is repeated.


One item A, no item R, one items Z
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

With rules 1 to 8 we get::

   input:
      wrap = a  |*||*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a a z
       4     a a a z
       5     a a a a z
       6     a a a a a z
       7     a a a a a a z
       8     a a a a a a a z
       9     a a a a a a a a z
      10     a a a a a a a a a z
      11     a a a a a a a a a a z
      12     a a a a a a a a a a a z
      13     a a a a a a a a a a a a z
      14     a a a a a a a a a a a a a z
      15     a a a a a a a a a a a a a a z
      16     a a a a a a a a a a a a a a a z
      17     a a a a a a a a a a a a a a a a z
      18     a a a a a a a a a a a a a a a a a z
      19     a a a a a a a a a a a a a a a a a a z
      20     a a a a a a a a a a a a a a a a a a a z



One item A, one (unexpected!?) item R, one item Z
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. attention::

   To really make mainpart R empty there must not be a space
   in the middle of `|*||*|`!

What happens if there IS a space? Normal behavior of a three by one case! ::

   input:
      wrap = a  |*| |*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a  z
       4     a   z
       5     a    z
       6     a     z
       7     a      z
       8     a       z
       9     a        z
      10     a         z
      11     a          z
      12     a           z
      13     a            z
      14     a             z
      15     a              z
      16     a               z
      17     a                z
      18     a                 z
      19     a                  z
      20     a                   z


More
~~~~

::

   input:
      wrap = |*||*|  z

   output:
       N     output sequence
       1     z
       2     z z
       3     z z z
       4     z z z z
       5     z z z z z
       6     z z z z z z
       7     z z z z z z z
       8     z z z z z z z z
       9     z z z z z z z z z
      10     z z z z z z z z z z
      11     z z z z z z z z z z z
      12     z z z z z z z z z z z z
      13     z z z z z z z z z z z z z
      14     z z z z z z z z z z z z z z
      15     z z z z z z z z z z z z z z z
      16     z z z z z z z z z z z z z z z z
      17     z z z z z z z z z z z z z z z z z
      18     z z z z z z z z z z z z z z z z z z
      19     z z z z z z z z z z z z z z z z z z z
      20     z z z z z z z z z z z z z z z z z z z z


::

   input:
      wrap = |*| |*|  z

   output:
       N     output sequence
       1     z
       2      z
       3       z
       4        z
       5         z
       6          z
       7           z
       8            z
       9             z
      10              z
      11               z
      12                z
      13                 z
      14                  z
      15                   z
      16                    z
      17                     z
      18                      z
      19                       z
      20                        z

::

   input:
      wrap = |*| r || s || t  |*|

   output:
       N     output sequence
       1     r
       2     r s
       3     r s t
       4     r s t r
       5     r s t r s
       6     r s t r s t
       7     r s t r s t r
       8     r s t r s t r s
       9     r s t r s t r s t
      10     r s t r s t r s t r
      11     r s t r s t r s t r s
      12     r s t r s t r s t r s t
      13     r s t r s t r s t r s t r
      14     r s t r s t r s t r s t r s
      15     r s t r s t r s t r s t r s t
      16     r s t r s t r s t r s t r s t r
      17     r s t r s t r s t r s t r s t r s
      18     r s t r s t r s t r s t r s t r s t
      19     r s t r s t r s t r s t r s t r s t r
      20     r s t r s t r s t r s t r s t r s t r s


::

   input:
      wrap = a || b || c  |*||*|

   output:
       N     output sequence
       1     a
       2     a b
       3     a b c
       4     a b c c
       5     a b c c c
       6     a b c c c c
       7     a b c c c c c
       8     a b c c c c c c
       9     a b c c c c c c c
      10     a b c c c c c c c c
      11     a b c c c c c c c c c
      12     a b c c c c c c c c c c
      13     a b c c c c c c c c c c c
      14     a b c c c c c c c c c c c c
      15     a b c c c c c c c c c c c c c
      16     a b c c c c c c c c c c c c c c
      17     a b c c c c c c c c c c c c c c c
      18     a b c c c c c c c c c c c c c c c c
      19     a b c c c c c c c c c c c c c c c c c
      20     a b c c c c c c c c c c c c c c c c c c

::

   input:
      wrap = |*||*|  x || y || z

   output:
       N     output sequence
       1     z
       2     y z
       3     x y z
       4     x x y z
       5     x x x y z
       6     x x x x y z
       7     x x x x x y z
       8     x x x x x x y z
       9     x x x x x x x y z
      10     x x x x x x x x y z
      11     x x x x x x x x x y z
      12     x x x x x x x x x x y z
      13     x x x x x x x x x x x y z
      14     x x x x x x x x x x x x y z
      15     x x x x x x x x x x x x x y z
      16     x x x x x x x x x x x x x x y z
      17     x x x x x x x x x x x x x x x y z
      18     x x x x x x x x x x x x x x x x y z
      19     x x x x x x x x x x x x x x x x x y z
      20     x x x x x x x x x x x x x x x x x x y z

::

   input:
      wrap = a   |*|||s|*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a  z
       4     a  s z
       5     a  s  z
       6     a  s  s z
       7     a  s  s  z
       8     a  s  s  s z
       9     a  s  s  s  z
      10     a  s  s  s  s z
      11     a  s  s  s  s  z
      12     a  s  s  s  s  s z
      13     a  s  s  s  s  s  z
      14     a  s  s  s  s  s  s z
      15     a  s  s  s  s  s  s  z
      16     a  s  s  s  s  s  s  s z
      17     a  s  s  s  s  s  s  s  z
      18     a  s  s  s  s  s  s  s  s z
      19     a  s  s  s  s  s  s  s  s  z
      20     a  s  s  s  s  s  s  s  s  s z


::

   input:
      wrap = a   |*|r|||*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a r z
       4     a r  z
       5     a r  r z
       6     a r  r  z
       7     a r  r  r z
       8     a r  r  r  z
       9     a r  r  r  r z
      10     a r  r  r  r  z
      11     a r  r  r  r  r z
      12     a r  r  r  r  r  z
      13     a r  r  r  r  r  r z
      14     a r  r  r  r  r  r  z
      15     a r  r  r  r  r  r  r z
      16     a r  r  r  r  r  r  r  z
      17     a r  r  r  r  r  r  r  r z
      18     a r  r  r  r  r  r  r  r  z
      19     a r  r  r  r  r  r  r  r  r z
      20     a r  r  r  r  r  r  r  r  r  z

::

   input:
      wrap = a   |*|r|||||*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a r z
       4     a r  z
       5     a r   z
       6     a r   r z
       7     a r   r  z
       8     a r   r   z
       9     a r   r   r z
      10     a r   r   r  z
      11     a r   r   r   z
      12     a r   r   r   r z
      13     a r   r   r   r  z
      14     a r   r   r   r   z
      15     a r   r   r   r   r z
      16     a r   r   r   r   r  z
      17     a r   r   r   r   r   z
      18     a r   r   r   r   r   r z
      19     a r   r   r   r   r   r  z
      20     a r   r   r   r   r   r   z


::

   input:
      wrap = a   |*|r|||||||*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a r z
       4     a r  z
       5     a r   z
       6     a r    z
       7     a r    r z
       8     a r    r  z
       9     a r    r   z
      10     a r    r    z
      11     a r    r    r z
      12     a r    r    r  z
      13     a r    r    r   z
      14     a r    r    r    z
      15     a r    r    r    r z
      16     a r    r    r    r  z
      17     a r    r    r    r   z
      18     a r    r    r    r    z
      19     a r    r    r    r    r z
      20     a r    r    r    r    r  z






Test Code 1 (TypoScript)
========================

.. highlight:: typoscript

Constants::

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

   temp.marray = HMENU
   temp.marray {
     special = directory
     # enter a page with at least 9 visible subpages!
     special.value = 123
     maxItems = 5

     1 = TMENU
     1 {
       NO {
         // the underscore is used to represent each item and avoid a collapsing of whitespace in html
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


Test Code 1 Result
==================

.. highlight:: none

output::

    optionsplit       1      2        3          4            5              6                7                  8                    9
   a                 [a_]  [a_a_]  [a_a_a_]  [a_a_a_a_]  [a_a_a_a_a_]  [a_a_a_a_a_a_]  [a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_a_]
   a||b||c           [a_]  [a_b_]  [a_b_c_]  [a_b_c_c_]  [a_b_c_c_c_]  [a_b_c_c_c_c_]  [a_b_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_c_]
   |*||*|a||b        [b_]  [a_b_]  [a_a_b_]  [a_a_a_b_]  [a_a_a_a_b_]  [a_a_a_a_a_b_]  [a_a_a_a_a_a_b_]  [a_a_a_a_a_a_a_b_]  [a_a_a_a_a_a_a_a_b_]
   a|*|b||c|*|       [a_]  [a_b_]  [a_b_c_]  [a_b_c_b_]  [a_b_c_b_c_]  [a_b_c_b_c_b_]  [a_b_c_b_c_b_c_]  [a_b_c_b_c_b_c_b_]  [a_b_c_b_c_b_c_b_c_]
   a||b|*||*|d||e    [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b_b_d_e_]  [a_b_b_b_d_e_]  [a_b_b_b_b_d_e_]  [a_b_b_b_b_b_d_e_]  [a_b_b_b_b_b_b_d_e_]
   a||b|*|c|*|d||e   [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b_c_d_e_]  [a_b_c_c_d_e_]  [a_b_c_c_c_d_e_]  [a_b_c_c_c_c_d_e_]  [a_b_c_c_c_c_c_d_e_]


      optionsplit            1      2        3          4            5              6                7                  8                    9
   a                        [a_]  [a_a_]  [a_a_a_]  [a_a_a_a_]  [a_a_a_a_a_]  [a_a_a_a_a_a_]  [a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_]  [a_a_a_a_a_a_a_a_a_]
   a || b || c              [a_]  [a_b_]  [a_b_c_]  [a_b_c_c_]  [a_b_c_c_c_]  [a_b_c_c_c_c_]  [a_b_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_]  [a_b_c_c_c_c_c_c_c_]
   |*| |*| a || b           [b_]  [a_b_]  [_a_b_]   [__a_b_]    [___a_b_]     [____a_b_]      [_____a_b_]       [______a_b_]        [_______a_b_]
   a |*| b || c |*|         [a_]  [a_b_]  [a_b_c_]  [a_b_c_b_]  [a_b_c_b_c_]  [a_b_c_b_c_b_]  [a_b_c_b_c_b_c_]  [a_b_c_b_c_b_c_b_]  [a_b_c_b_c_b_c_b_c_]
   a || b |*| |*| d || e    [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b__d_e_]   [a_b___d_e_]    [a_b____d_e_]     [a_b_____d_e_]      [a_b______d_e_]
   a || b |*| c |*| d || e  [e_]  [d_e_]  [a_d_e_]  [a_b_d_e_]  [a_b_c_d_e_]  [a_b_c_c_d_e_]  [a_b_c_c_c_d_e_]  [a_b_c_c_c_c_d_e_]  [a_b_c_c_c_c_c_d_e_]



Test Code 2 (TypoScript)
========================

This is the code that was used to produce many of the above examples.


.. highlight:: typoscript

Constants::

   os1 = a
   os2 = a||b||c
   os3 = |*||*|a||b
   os4 = a|*|b||c|*|
   os5 = a||b|*||*|d||e
   os6 = a||b|*|c|*|d||e

   os1 = a
   os2 = a ||
   os3 = a || b
   os4 = a || b ||
   os5 = a || b || c
   os6 = a |||| c

   os1 = a
   os2 = a |*|
   os3 = a |*| b
   os4 = a |*| b |*|
   os5 = a |*| b |*| c
   os6 = a |*| b |*| c |*| d

   os1 = a || b || c
   os2 = a || b || c  |*|
   os3 = a || b || c  |*|  r ||
   os4 = a || b || c  |*|  r || s || t
   os5 = a || b || c  |*||*|  x || y || z
   os6 = a || b || c  |*|  r || s || t  |*|  x || y || z


   os6 = a   |*|  r   |*|  z
   os6 = a || b  |*|  r || s  |*|  y || z
   os6 = a || b || c  |*|  r || s || t  |*|  x || y || z


   os6 = a || b || c  |*|  r || s || t
   os6 = a || b  |*|  r || s
   os6 = a  |*|  r

   os6 = a
   os6 = a || b
   os6 = a || b || c


   os6 = a || b || c  |*||*|  x || y || z

   os6 = a  |*||*| z
   os6 =  |*||*|  z
   os6 =  |*| |*| z

   os6 =  |*| r || s || t  |*|
   os6 = a || b || c  |*||*|
   os6 = |*||*|  x || y || z


   os6 = a   |*|||s|*|  z
   os6 = a   |*|r|||*|  z
   os6 = a   |*|r|||||*|  z
   os6 = a   |*|r|||||||*|  z


Setup::

   lib.marray = HMENU
   lib.marray {
       special = directory
       # enter the uid of a page with at least 20 visible subpages!
       special.value = 2
       maxItems = 999

       1 = TMENU
       1 {
           NO {
               before = _
               // use non-breaking space for each item instead of underscore
               before = &nbsp;
               before.wrap = {$os6}
               doNotShowLink = 1
           }
       }
   }

   lib.mrow = COA
   lib.mrow {
       1 = LOAD_REGISTER
       1.os = {$os6}

       4 = TEXT
       4.value = input:
       4.wrap =  |<br/>

       5 = TEXT
       5.data = register:os
       5.wrap = &nbsp;&nbsp;&nbsp;wrap =&nbsp; |<br/><br/>output:<br>    N     output sequence<br/>

       10 < lib.marray
       10.maxItems = 1
       10.wrap = &nbsp;&nbsp;&nbsp;&nbsp;1    &nbsp; |<br/>

       20 < .10
       20.maxItems = 2
       20.wrap = &nbsp;&nbsp;&nbsp;&nbsp;2    &nbsp; |<br/>

       30 < .10
       30.maxItems = 3
       30.wrap = &nbsp;&nbsp;&nbsp;&nbsp;3    &nbsp; |<br/>

       40 < .10
       40.maxItems = 4
       40.wrap = &nbsp;&nbsp;&nbsp;&nbsp;4    &nbsp; |<br/>

       50 < .10
       50.maxItems = 5
       50.wrap = &nbsp;&nbsp;&nbsp;&nbsp;5    &nbsp; |<br/>

       60 < .10
       60.maxItems = 6
       60.wrap = &nbsp;&nbsp;&nbsp;&nbsp;6    &nbsp; |<br/>

       70 < .10
       70.maxItems = 7
       70.wrap = &nbsp;&nbsp;&nbsp;&nbsp;7    &nbsp; |<br/>

       80 < .10
       80.maxItems = 8
       80.wrap = &nbsp;&nbsp;&nbsp;&nbsp;8    &nbsp; |<br/>

       90 < .10
       90.maxItems = 9
       90.wrap = &nbsp;&nbsp;&nbsp;&nbsp;9    &nbsp; |<br/>

       120 < .10
       120.maxItems = 10
       120.wrap = &nbsp;&nbsp;&nbsp;10    &nbsp; |<br/>

       130 < .10
       130.maxItems = 11
       130.wrap = &nbsp;&nbsp;&nbsp;11    &nbsp; |<br/>

       140 < .10
       140.maxItems = 12
       140.wrap = &nbsp;&nbsp;&nbsp;12    &nbsp; |<br/>

       150 < .10
       150.maxItems = 13
       150.wrap = &nbsp;&nbsp;&nbsp;13    &nbsp; |<br/>

       160 < .10
       160.maxItems = 14
       160.wrap = &nbsp;&nbsp;&nbsp;14    &nbsp; |<br/>

       170 < .10
       170.maxItems = 15
       170.wrap = &nbsp;&nbsp;&nbsp;15    &nbsp; |<br/>

       180 < .10
       180.maxItems = 16
       180.wrap = &nbsp;&nbsp;&nbsp;16    &nbsp; |<br/>

       190 < .10
       190.maxItems = 17
       190.wrap = &nbsp;&nbsp;&nbsp;17    &nbsp; |<br/>

       200 < .10
       200.maxItems = 18
       200.wrap = &nbsp;&nbsp;&nbsp;18    &nbsp; |<br/>

       210 < .10
       210.maxItems = 19
       210.wrap = &nbsp;&nbsp;&nbsp;19    &nbsp; |<br/>

       220 < .10
       220.maxItems = 20
       220.wrap = &nbsp;&nbsp;&nbsp;20    &nbsp; |<br/>

       1100 = RESTORE_REGISTER

       wrap = | <br>
   }

   # Default PAGE object:
   page = PAGE

   page.10 = COA
   page.10 {
       wrap = <pre>|</pre>
       10 = COA
       10 {
           wrap =

           10 < lib.mrow
           #10 {
           #    1.os = {$os6}
           #    10.1.NO.before.wrap  = {$os6}
           #}
       }
   }


Test Code 2 Result
==================

.. highlight:: none

output::

   input:
      wrap = a   |*|r|||||||*|  z

   output:
       N     output sequence
       1     z
       2     a z
       3     a r z
       4     a r  z
       5     a r   z
       6     a r    z
       7     a r    r z
       8     a r    r  z
       9     a r    r   z
      10     a r    r    z
      11     a r    r    r z
      12     a r    r    r  z
      13     a r    r    r   z
      14     a r    r    r    z
      15     a r    r    r    r z
      16     a r    r    r    r  z
      17     a r    r    r    r   z
      18     a r    r    r    r    z
      19     a r    r    r    r    r z
      20     a r    r    r    r    r  z
