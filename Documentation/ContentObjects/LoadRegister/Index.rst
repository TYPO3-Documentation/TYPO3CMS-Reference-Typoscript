..  include:: /Includes.rst.txt
..  index::
    Content objects; LOAD_REGISTER
    Registers; Loading
..  _cobj-load-register:

==============
LOAD\_REGISTER
==============

This provides a way to load the array :php:`$GLOBALS['TSFE']->register[]`
with values. It does not return anything!

The register is working like a stack: With each call new content can be
put on top of the stack. :ref:`RESTORE_REGISTER <cobj-restore-register>`
can be used to remove the element at the topmost position again.
The registers are processed in the reverse order. The register with the highest number
will be processed as the first, and the register with the lowest number will be processed
as the last one. This corresponds to the stack principle Last In – First Out (LIFO).

With the advent of Fluid templating, registers are used less often than
they used to be. In the Core they are not being used anymore.

..  contents::
    :local:

..  _cobj-load-register-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:

..  _cobj-load-register-array:

..  confval:: array of field names
    :name: load-register-array
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    **Example:**

    This sets :typoscript:`contentWidth`, :typoscript:`label` and
    :typoscript:`head`.

    ..  literalinclude:: _array.typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

..  _cobj-load-register-examples:

Example:
========

..  literalinclude:: _register.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

In this example we first load a special value, which is given as a
GET/POST parameter, into the register. Then we use a
:ref:`CONTENT object <cobj-content>` to render content based on this
value. This CONTENT object loads data from a table `tx_my_table` and looks up
the entry using the value from the register as a unique id. The field `tx_my_text_field`
of this record will be rendered as output.

For an example in combination with :ref:`RESTORE_REGISTER <cobj-restore-register>`
see the :ref:`example on the page RESTORE_REGISTER <cobj-restore-register-examples>`.
