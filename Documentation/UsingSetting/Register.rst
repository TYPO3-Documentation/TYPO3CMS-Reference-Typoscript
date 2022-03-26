.. include:: ../Includes.txt

.. _using-setting-register:

Register
========

It is possible to store variable values into a memory stack which is called
"register".  The cObjects :ref:`LOAD_REGISTER <cobj-load-register>` and
:ref:`RESTORE_REGISTER <cobj-restore-register>` provide this storage functionality.
Some TYPO3 cObjects use internal registers. Esp.  the menus are built be
registers (e.g. count_HMENU, count_HMENU_MENUOBJ, count_menuItems).

Defining registers
------------------

Registers in TypoScript can be seen as stack array variables in programming
languages. Each register can store a complex TypoScript block. Use
:ref:`LOAD_REGISTER <cobj-load-register>` to put a variable to the stack, use
:ref:`RESTORE_REGISTER <cobj-restore-register>` to pull a variable from the stack
and curly braces around a variable name to read the current value of the
variable. You need a :ref:`stdWrap.data <stdwrap-data>` or a
:ref:`stdWrap.dataWrap <stdwrap-datawrap>` cObject. The registers cannot be read
on other places than inside of these cObjects.

Example
-------

.. code-block:: typoscript

   10 = COA
   10 {
       ### left menu table column
       10 = LOAD_REGISTER
       10 {
           ulClass = col-left
       }

       ### right menu table column
       20 = LOAD_REGISTER
       20 {
           ulClass = col-right
       }

       30 = HMENU
       30 {
           special = list
           special.value = 1
           1 = TMENU
           # ...
           3 = TMENU
           3 {
               stdWrap {
                   preCObject = COA
                   preCObject {
                       10 = RESTORE_REGISTER
                   }
                   dataWrap = <ul class="{register:ulClass}">|</ul>
               }
               wrap =
               SPC = 1
               SPC {
                   allStdWrap {
                       replacement {
                           10 {
                               search = ---
                               replace =
                           }
                       }
                       dataWrap = </ul>|<ul class="{register:ulClass}">
                   }
               }
           }
       }
   }

This example shows a part of a TypoScript which builds a 2 column menu based on
a spacer page. A class is added to the ul tag depending on the value of the
register variable `ulClass`. The first pages will have the class `col-left` and
the pages following the spacer page will get the class `col-right`.

:typoscript:`{register:variablename}` returns the "current" value of the variable
`variablename`. A register stack can be like any TypoScript setup.

.. code-block:: typoscript

  10 = COA
  10 {
    10 = LOAD_REGISTER
    10 {
        ulClass = col-left
        aClass = a-special
        colors {
            chief = red
            servant = white
        }
    }
  }

The "current" value is just an internal variable that can be used by functions
to pass a single value on to another function later in the TypoScript
processing. It is like "load accumulator" in the good old C64 days. Basically
you can use a "register" as you like. The TSref will tell if functions are
setting this value before calling some other object so that you know if it holds
any special information.
