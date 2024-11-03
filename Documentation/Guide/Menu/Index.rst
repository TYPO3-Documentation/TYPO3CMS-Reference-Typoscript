..  include:: /Includes.rst.txt

..  _guide-menu:

=============
Create a menu
=============

Until now, we learned how the page *content* is rendered; however, the
page *navigation* is missing.

TYPO3 CMS offers a special menu object called
:ref:`HMENU <cobj-hmenu>` ("H" stands for hierarchical) to easily build
different kinds of menus.

We want our menu to be built like a nested list:

..  literalinclude:: _menu.html

It is customary to declare new objects as sub-properties of the
`lib` top-level object. We can give it any name that hasn't
been assigned yet:

..  literalinclude:: _lib.textmenu.typoscript

The :ref:`HMENU <cobj-hmenu>` object allows us to create a diversity of menus.
The main properties are numbers and correspond to the menu level.

The :ref:`TMENU <tmenu>` object renders a menu level as
text. A different
rendering can be chosen for each menu level.

On every menu level, we can configure various states for the single
menu items – see :ref:`menu items <menu-common-properties>`,
e.g. `NO` for "normal", `ACT` for "pages in the root line"
(i.e. the current page, its parent, grandparent, and so forth) or
`CUR` for "the current page".

..  important::

   Except for the normal state (`NO`), other states have to be activated
   before they get displayed (i.e. `ACT = 1`).

Now that our menu is defined, we can use it with:

..  code-block:: typoscript

    page.5 < lib.textmenu
