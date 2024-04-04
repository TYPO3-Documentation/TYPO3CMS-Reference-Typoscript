..  include:: /Includes.rst.txt
..  index:: HMENU; special = userfunction
..  _hmenu-special-userfunction:

=================
Userfunction menu
=================

..  attention::
    It is still possible to create a menu with :typoscript:`special = userfunction`
    for backward compatibility reasons.

    However we would advise you to write a :ref:`customized MenuProcessor <CustomDataProcessors>`
    and style the output with Fluid instead.

Calls a user function/method in class which should return an array with
page records for the menu.

..  contents::
    :local:

..  _hmenu-special-userfunction-properties:

Properties
==========

..  _hmenu-special-userfunction-userfunc:

special.userFunc
----------------

..  confval:: special.userFunc
    :name: hmenu-userfunction-special-userfunc
    :type: string

    Name of the user function

..  _hmenu-special-userfunction-examples:

Example: Set a userFunc
~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: This is still possible for backward compability reasons but not recommended:

    lib.custommenu = HMENU
    lib.custommenu {
        special = userfunction
        special.userFunc = MyVendor\MyExtension\Userfuncs\CustomMenu->makeMenuArray
    }
