..  include:: /Includes.rst.txt
..  index:: HMENU; special = list
..  _hmenu-special-list:

=========
List menu
=========

A :ref:`HMENU <cobj-hmenu>` of type :typoscript:`special = list` lets you
create a menu that lists the pages you define in the property
:typoscript:`special.value`.

Mount pages are supported.

..  contents::
   :local:

..  _hmenu-special-list-properties:

Properties
==========

..  _hmenu-special-list-value:

special.value
-------------

..  confval:: special.value
    :name: hmenu-list-special-value
    :type: list of page IDs /:ref:`stdWrap <stdwrap>`
    :Default: 0

    This will generate a menu with the two pages (uid=35 and uid=56)
    listed:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.listOfSelectedPages = HMENU
        lib.listOfSelectedPages {
            special = list
            special.value = 35, 56
            // render the menu
        }

    If :typoscript:`special.value` is not set, the default uid is 0, so
    that only your homepage will be listed.

Example: Menu of all subpages
-----------------------------

The content element :guilabel:`Menu > Pages` provided by the system
extension fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

..  include:: /CodeSnippets/Menu/TypoScript/MenuPages.rst.txt

The following Fluid template can be used to style the menu:

..  include:: /CodeSnippets/Menu/Template/MenuPages.rst.txt
