.. include:: /Includes.rst.txt

.. The label objects-calc should no longer be used.
.. Use the label calc instead.
.. It only remains here, in case it is still being used.

.. _objects-calc:
.. _calc:

======================
Calc
======================


Calculating values (+calc)
==========================

Sometimes a data type is set to ``someType +calc``. The ``+calc`` indicates
that the value is calculated with ``+-/\*`` operators. *Be aware that the
operators have no "weight".* The calculation is just done from left to
right.


How value is calculated
~~~~~~~~~~~~~~~~~~~~~~~

::

   45 + 34 * 2 = 158
   (which is the same as this in ordinary arithmetic: (45+34)*2=158)


calc usage example
~~~~~~~~~~~~~~~~~~

The :typoscript:`HMENU` :typoscript:`maxAge` property is of a type ``integer +calc``, it's value in this example equals to 259200.

::

   20 = HMENU
   20.special = updated
   20.special.value = 35, 56
   20.special {
     mode = tstamp
     depth = 2
     maxAge = 3600*24*3
     limit = 8
   }
