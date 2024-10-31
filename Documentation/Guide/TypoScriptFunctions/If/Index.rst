.. include:: /Includes.rst.txt

.. _guide-function-if:

==
if
==

The :ref:`if <if>` function is perhaps the most difficult
of all TypoScript functions. It does not work like the "if" construct
known from most programming language and is thus very open to misuse.
Hopefully the examples below will help you get it right.

Generally the `if` function returns `true`,
if **all** conditions are fulfilled. This resembles a boolean AND combination.
If what we would like returned is a `false` value,
we can use the :code:`negate` option to negate the result::

   10 = TEXT
   10 {

       # Content of the TEXT object.
       value = The L parameter is passed as GET variable.

       # Results in "true" and leads to rendering of the upper value, if the
       # GET/POST parameter is passed with a value, which is not 0.
       stdWrap.if.isTrue.data = GP:L
   }

With the use of `if` it is also possible to compare values. For this
purpose we use `value` property::

   10 = TEXT
   10 {

       # WARNING: This value resembles the value of the TEXT object, not that of the "if"!
       value = 3 is bigger than 2.

       # Compare parameter of the "if" function.
       stdWrap.if.value = 2

       # Please note: The sorting order is "backwards",
       # returning the sentence "3 is bigger than 2".
       stdWrap.if.isGreaterThan = 3
   }

Because the properties of the `if` function implement
:ref:`stdWrap functions <guide-using-stdwrap>`, all kinds of variables can be compared::

   10 = TEXT
   10 {
       # Value of the TEXT object.
       value = The record can be shown, because the starting date has passed.

       # Condition of the if clause (number of seconds since January 1st, 1970).
       stdWrap.if.value.data = date:U

       # Condition backwards again: Start time isLessThan date:U.
       stdWrap.if.isLessThan.field = starttime
   }

