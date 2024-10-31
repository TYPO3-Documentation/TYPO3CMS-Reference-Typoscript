.. include:: /Includes.rst.txt

.. _guide-menu:

=============
Create a menu
=============

Until now, we learned how the page *content* is rendered; however, the
page *navigation* is missing.

TYPO3 CMS offers a special menu object called
:ref:`HMENU <cobj-hmenu>` ("H" stands for hierarchical) to easily build
different kinds of menus.

We want our menu to be built like a nested list:

.. code-block:: html

   <ul class="level1">
      <li>first level</li>
      <li>first level
          <ul class="level2">
              <li>second level</li>
          </ul>
      </li>
      <li>first level</li>
   </ul>

It is customary to declare new objects as sub-properties of the
`lib` top-level object. We can give it any name that hasn't
been assigned yet::

   lib.textmenu = HMENU
   lib.textmenu {

      # We define the first level as text menu.
      1 = TMENU

      # We define the normal state ("NO").
      1.NO = 1
      1.NO.allWrap = <li>|</li>

      # We define the active state ("ACT").
      1.ACT = 1
      1.ACT.wrapItemAndSub = <li>|</li>

      # Wrap the whole first level.
      1.wrap = <ul class="level1">|</ul>

      # The second and third level should be configured exactly
      # the same way.
      # In between the curly brackets, objects can be copied.
      # With the dot "." we define that the object can be found
      # in the brackets.
      # With 2.wrap and 3.wrap we overwrite the wrap, which was
      # copied from 1.wrap.
      2 < .1
      2.wrap = <ul class="level2">|</ul>
      3 < .1
      3.wrap = <ul class="level3">|</ul>
   }

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

.. important::

   Except for the normal state (`NO`), other states have to be activated
   before they get displayed (i.e. `ACT = 1`).

Now that our menu is defined, we can use it with::

   page.5 < lib.textmenu
