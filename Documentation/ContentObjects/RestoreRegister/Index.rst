.. include:: ../../Includes.txt


.. _cobj-restore-register:

=================
RESTORE\_REGISTER
=================

This unsets the latest changes in the register-array as set by
:ref:`LOAD_REGISTER <cobj-load-register>`.

Internally registers work like a stack where the original register is
saved when :ref:`LOAD_REGISTER <cobj-load-register>` is called. When a
RESTORE\_REGISTER cObject is called, the last element is pulled off
that stack and the register is replaced with the content of the
previous element.

RESTORE\_REGISTER has no properties.

.. _cobj-restore-register-examples:

Example:
""""""""

The following example shows how LOAD_REGISTER and RESTORE_REGISTER can
be used to load values into the register and to restore previous values
again. ::

     # Put first block into the register
     10 = LOAD_REGISTER
     10 {
       myTextRegister.cObject = COA
       myTextRegister.cObject {
         10 = TEXT
         10.value = This is text in the first block.
         10.stdWrap.wrap = <p>|</p>
       }
     }
     # Put second block into the register
     20 = LOAD_REGISTER
     20 {
       myTextRegister.cObject = COA
       myTextRegister.cObject {
         10 = TEXT
         10.value = This is text originally used in the second block...
         10.stdWrap.wrap = <p>|</p>
       }
     }
     # Put third block into the register using text from the second block.
     30 = LOAD_REGISTER
     30 {
       myTextRegister.cObject = COA
       myTextRegister.cObject {
         # Get the current text from myTextRegister:
         # "This is text originally used in the second block..."
         10 = TEXT
         10.stdWrap.data = register:myTextRegister
         10.stdWrap.append = TEXT
         10.stdWrap.append.value = (but now used in the third block).
         20 = TEXT
         20.value = This is a second text in the third block.
         20.stdWrap.wrap = <p>|</p>
       }
     }
     # Up to this place no actual output has been produced.

     # Outputs block 30 "This is text originally used in the second block...
     # (but now used in the third block). This is a second text in the third block."
     40 = TEXT
     40.stdWrap.data = register:myTextRegister

     # Outputs block 20 "This is text originally used in the second block..."
     50 = RESTORE_REGISTER
     60 = TEXT
     60.stdWrap.data = register:myTextRegister

     # Outputs block 10 "This is text in the first block."
     70 = RESTORE_REGISTER
     80 = TEXT
     80.stdWrap.data = register:myTextRegister

