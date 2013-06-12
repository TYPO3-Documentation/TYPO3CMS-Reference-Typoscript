.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-restore-register:

RESTORE\_REGISTER
^^^^^^^^^^^^^^^^^

This unsets the latest changes in the register-array as set by
:ref:`LOAD_REGISTER <cobj-load-register>`.

Internally this works like a stack where the original register is
saved when :ref:`LOAD_REGISTER <cobj-load-register>` is called. Then a RESTORE\_REGISTER cObject
is called the last element is pulled of that stack the register is
replaced with it.

RESTORE\_REGISTER has no properties.

