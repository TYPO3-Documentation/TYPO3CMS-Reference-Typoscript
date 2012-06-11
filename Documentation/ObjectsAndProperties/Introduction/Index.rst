

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Introduction
^^^^^^^^^^^^


Reference to objects
""""""""""""""""""""

Whenever you see  *->[objectname]* in the tables it means that the
property is an object " *objectname* " with properties from object
*objectname.* You don't need to define the objecttype.


Calculating values (+calc)
""""""""""""""""""""""""""

Sometimes a data type is set to "something +calc". "+calc" indicates
that the value is calculated with "+-/\*".  *Be aware that the
operators have no "weight".* The calculation is just done from left to
right.


Example:
~~~~~~~~

::

   45 + 34 * 2 = 158          (which is the same as this in ordinary arithmetic: (45+34)*2=158)


"... /stdWrap"
""""""""""""""

When a data type is set to " *type* /stdWrap" it means that the value
is parsed through the stdWrap function with the properties of the
value as parameters.


Example:
~~~~~~~~

pixels /stdWrap: Here the value should be set to pixels and parsed
through stdWrap.

In a real application we could do like this:

::

   .pixels.field = imagewidth
   .pixels.intval = 1

This example imports the value from the field "imagewidth" of the
current $cObj->data-array. But we don't trust the result to be an
integer so we parse it through the the intval()-function.


optionSplit
"""""""""""

optionSplit is a very tricky function. It's primarily used in the
menu-objects where you define properties of a whole bunch of items at
once. Here the value of properties would be parsed through this
function and depending on your setup you could e.g. let the last menu-
item appear with another color than the others.

The syntax is like this:

\|\*\| - splits the value in parts  *first, middle, last.*

\|\| - splits each of the  *first, middle, last* in subparts

#. The priority is  *last, first, middle* .

#. If the  *middle* -value is empty (""), the last part of the first-
   value is repeated.

#. If the  *first* - and  *middle* value are empty, the first part of the
   last-value is repeated before the last value

#. The  *middle* value is rotated.

ex: first1 \|\| first2 \|\*\| middle1 \|\| middle2 \|\| middle3 \|\*\|
last1 \|\| last 2


Examples:
~~~~~~~~~

This is very complex and you might think that this has gone too far.
But it's actually useful.

Now consider a menu with five items:

Introduction

Who are we?

Business

Contact

Links

... and a configuration like this (taken from the example-code on the
first pages):

::

   temp.topmenu.1.NO {
     backColor = red
     ....
   }

If you look in this reference (see later) at the linkWrap-property of
the GMENU-object, you'll discover that all properties of  *.NO* are
parsed through  *optionSplit* . This means that before the individual
menuitems are generated, the properties are split by this function.
Now lets look at some examples:


Subparts \|\|
'''''''''''''


Example:
~~~~~~~~

All items take on the same value. Only the  *first* -part is defined
and thus it's repeated to all elements

::

   TS:        backColor = red

Introduction (red)

Who are we? (red)

Business (red)

Contact (red)

Links (red)


Example:
~~~~~~~~

Here the  *first-* part is split into subparts. The third subpart is
repeated because the menu has five items.

::

   TS:        backColor = red || yellow || green

**Introduction** (red)first, subpart 1

Who are we? (yellow) first, subpart 2

Business (green) first, subpart 3

Contact (green) first, subpart 3 (repeated)

Links (green) first, subpart 3 (repeated)


Parts \|\*\|
''''''''''''


Example:
~~~~~~~~

Now a *middle* -value is also defined (" *white* "). This means that
after the first two menu-items the *middle* -value is used.

::

   TS:        backColor = red || yellow |*| white

Introduction (red) first, subpart 1

Who are we? (yellow) first, subpart 2

**Business** (white) middle

Contact (white) middle

Links (white) middle


Example:
~~~~~~~~

Now a *last* -value is also defined (" *blue \|\| olive"* ). This
means that after the first two menu-items the *middle* -value is used.

::

   TS:        backColor = red || yellow |*| white |*| blue || olive

Introduction (red) first, subpart 1

Who are we? (yellow) first, subpart 2

**Business** (white) middle

Contact (blue) last, subpart 1

Links (olive) last, subpart 2

... and if we expand the menu a bit ( *middle* -value is repeated!)

Introduction (red) first, subpart 1

Who are we? (yellow) first, subpart 2

**Business** (white) middle

.... (white) middle

.... (white) middle

.... (white) middle

.... (white) middle

Contact (blue) last, subpart 1

Links (olive) last, subpart 2

... and if we contract the menu to only four items (the  *middle*
-value is discarded as it's priority is the least)

Introduction (red) first, subpart 1

Who are we? (yellow) first, subpart 2

Contact (blue) last, subpart 1

Links (olive) last, subpart 2

... and if we contract the menu to only 3 items (the last subpart of
the  *first* -value is discarded as it's priority is less than the
*last* -value)

Introduction (red) first, subpart 1

Contact (blue) last, subpart 1

Links (olive) last, subpart 2


"1: The priority is  *last, first, middle* "
''''''''''''''''''''''''''''''''''''''''''''

Now the last two examples showed that the  *last* -value has the
highest priority, then the  *first* -value and then the  *middle*
-value.


"2: If the  *middle* -value is empty, the last part of the first-value is repeated"
'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


Example:
~~~~~~~~

The  *middle* -value is left out now. Then subpart 2 of the first
value is repeated.  *Please observe that no space must exist between
the two \|\*\|\|\*\|!*

::

   TS:        backColor = red || yellow |*||*| blue || olive

Introduction (red) first, subpart 1

Who are we? (yellow) first, subpart 2

**Business** (yellow) first, subpart 2 (repeated)

Contact (blue) last, subpart 1

Links (olive) last, subpart 2


"3: If the  *first* - and  *middle* value are empty, the first part of the last-value is repeated before the last value"
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


Example:
~~~~~~~~

The  *middle* -value and  *first* -value are left out now. Then the
subpart 1 of the last value is repeated.  *Please observe that no
space must exist between the two \|\*\|\|\*\|!*

::

   TS:        backColor = |*||*| blue || olive

Introduction (blue) last, subpart 1 (repeated)

Who are we? (blue) last, subpart 1 (repeated)

**Business** (blue) last, subpart 1 (repeated)

Contact (blue) last, subpart 1

Links (olive) last, subpart 2


"4: The  *middle* value is rotated"
'''''''''''''''''''''''''''''''''''


Example:
~~~~~~~~

::

   TS:        backColor = red |*| yellow || green |*| 

**Introduction** (red) first

Who are we? (yellow) middle, subpart 1

**Business** (green) middle, subpart 2

.... (yellow) middle, subpart 1

.... (green) middle, subpart 2

.... (yellow) middle, subpart 1

.... (green) middle, subpart 2

**Contact** (yellow) middle, subpart 1

**Links** (green) middle, subpart 2

