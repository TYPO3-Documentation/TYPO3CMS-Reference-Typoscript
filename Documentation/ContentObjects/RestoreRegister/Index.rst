..  include:: /Includes.rst.txt
..  index::
    Content objects; RESTORE_REGISTER
    Registers; Restoring
..  _cobj-restore-register:

=================
RESTORE\_REGISTER
=================

This unsets the latest changes in the register array as set by
:ref:`LOAD_REGISTER <cobj-load-register>`.

Internally registers work like a stack where the original register is
saved when :ref:`LOAD_REGISTER <cobj-load-register>` is called. When a
RESTORE\_REGISTER cObject is called, the last element is pulled off
that stack and the register is replaced with the content of the
previous element.

..  note::
    :typoscript:`RESTORE_REGISTER` has no properties.

..  contents::
    :local:

..  _cobj-restore-register-examples:

Example:
========

The following example shows how LOAD_REGISTER and RESTORE_REGISTER can
be used to load values into the register and to restore previous values
again.

..  literalinclude:: _register.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

