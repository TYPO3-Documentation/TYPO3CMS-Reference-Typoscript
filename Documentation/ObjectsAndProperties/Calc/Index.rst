.. include:: ../../Includes.txt


.. _objects-calc:

======================
Calc
======================


Calculating values (+calc)
==========================

Sometimes a data type is set to ``someType +calc``. The ``+calc`` indicates
that the value is calculated with ``+-/\*`` operators. *Be aware that the
operators have no "weight".* The calculation is just done from left to
right.


how value is calculated:
~~~~~~~~~~~~~~~~~~~~~~~~

::

   45 + 34 * 2 = 158
   (which is the same as this in ordinary arithmetic: (45+34)*2=158)


calc usage example:
~~~~~~~~~~~~~~~~~~~

The :ts:`HMENU` :ts:`maxAge` property is of a type ``integer +calc``, it's value in this example equals to 259200.

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
