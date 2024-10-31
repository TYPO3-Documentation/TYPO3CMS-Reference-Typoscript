..  include:: /Includes.rst.txt

..  _guide-function-if:

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
we can use the :code:`negate` option to negate the result:

..  literalinclude:: _if.typoscript

With the use of `if` it is also possible to compare values. For this
purpose we use `value` property:

..  literalinclude:: _if2.typoscript

Because the properties of the `if` function implement
:ref:`stdWrap functions <guide-using-stdwrap>`, all kinds of variables can be compared:

..  literalinclude:: _if3.typoscript
