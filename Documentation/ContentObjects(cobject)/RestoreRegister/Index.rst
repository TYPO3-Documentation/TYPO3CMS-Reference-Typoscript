.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


RESTORE\_REGISTER
^^^^^^^^^^^^^^^^^

This unsets the latest changes in the register-array as set by
LOAD\_REGISTER.

Internally this works like a stack where the original register is
saved when LOAD\_REGISTER is called. Then a RESTORE\_REGISTER cObject
is called the last element is pulled of that stack the register is
replaced with it.

RESTORE\_REGISTER has no properties.

