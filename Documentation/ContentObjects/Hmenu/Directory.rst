..  include:: /Includes.rst.txt
..  index:: HMENU; special = directory
..  _hmenu-special-directory:

==================================
Directory menu - menu of subpages
==================================

A :ref:`HMENU <cobj-hmenu>` of type :typoscript:`special = directory`
lets you create a menu listing the subpages of one or more parent pages.

The parent pages are defined in the property :typoscript:`special.value`.

This menu type can be used, for example, to display all subpages of a certain
page as meta menu or footer menu.

Mount pages are supported.

..  contents::
    :local:

..  _hmenu-special-directory-properties:

Properties
==========

..  _hmenu-special-directory-value:

special.value
-------------

..  confval:: special.value
    :name: hmenu-directory-special-value
    :type: Comma separated list of page IDs /:ref:`stdWrap <stdwrap>`
    :Default: current page ID

    This will generate a menu of all pages with pid = 35 and pid = 56.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.metaMenu = HMENU
        lib.metaMenu {
            special = directory
            special.value = 35, 56
            // render the menu
        }


..  _hmenu-special-directory-example:

Example: Menu of all subpages
=============================

The content element :guilabel:`Menu > Subpages` provided by the system
extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

..  include:: /CodeSnippets/Menu/TypoScript/MenuSubpages.rst.txt

The following Fluid template can be used to style the menu:

..  include:: /CodeSnippets/Menu/Template/MenuSubpages.rst.txt
