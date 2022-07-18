.. include:: /Includes.rst.txt
.. index:: HMENU; special = userfunction
.. _hmenu-special-userfunction:

=======================
Userfunction menu
=======================

.. attention::
   It is still possible to create a menu with :typoscript:`special = userfunction`
   for backward compatibility reasons.

   However we would advise you to write a customized MenuProcessor and style
   the output with Fluid instead.

Calls a user function/method in class which should return an array with
page records for the menu.

.. contents::
   :local:

Properties
==========

.. _hmenu-special-userfunction-userfunc:

special.userFunc
----------------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         special.userFunc

   Data type
         string

   Description
         Name of the function


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = userfunction]

Example
=======

.. _hmenu-special-userfunction-examples:

Example: Creating hierarchical menus of custom links
----------------------------------------------------

By default the HMENU object is designed to create menus from pages in
TYPO3. Such pages are represented by their page-record contents.
Usually the "title" field is used for the title and the "uid" field is
used to create a link to that page in the menu.

However the HMENU and sub-menu objects are so powerful that it would
be very useful to use these objects for creating menus of links which
do not relate to pages in TYPO3 by their ids. This could be a menu
reflecting a menu structure of a plugin where each link might link to
the same page id in TYPO3 but where the difference would be in some
parameter value.

First, this listing creates a menu in three levels where the first two
are graphical items:

.. code-block:: typoscript
   :linenos:

   # ************************
   # CUSTOM MENU
   # ************************
   lib.custommenu = HMENU
   lib.custommenu {
      special = userfunction
      special.userFunc = Vendor\MyExtension\Userfuncs\CustomMenu->makeMenuArray

      1 = TMENU
      1.wrap = <ul class="level-1">|</ul>
      1.NO = 1
      1.NO {
         wrapItemAndSub = <li>|</li>
      }

      2 = TMENU
      2.wrap = <ul class="level-2">|</ul>
      2.NO = 1
      2.NO {
         wrapItemAndSub = <li>|</li>
      }

      3 = TMENU
      3.wrap = <ul class="level-3">|</ul>
      3.NO = 1
      3.NO {
         wrapItemAndSub = <li>|</li>
      }
   }

The menu looks like this on a web page:

.. figure:: /Images/ManualScreenshots/FrontendOutput/Hmenu/ContentObjectsHmenuExampleMenu.png
   :alt: Output of the example menu.

The TypoScript code above generates this menu, but the items do not
link straight to pages as usual. This is because the *whole* menu is
generated from this array, which was returned from the function
"makeMenuArray" called in TypoScript line 5+6 :

.. code-block:: php
   :linenos:

   <?php

   declare(strict_types=1);

   namespace Vendor\MyExtension\Userfuncs;

   class CustomMenu
   {

       public function makeMenuArray(array $content, array $conf) : array
       {
           return [
               [
                   'title' => 'Contact',
                   '_OVERRIDE_HREF' => 'index.php?id=10',
                   '_SUB_MENU' => [
                       [
                           'title' => 'Offices',
                           '_OVERRIDE_HREF' => 'index.php?id=11',
                           '_OVERRIDE_TARGET' => '_top',
                           'ITEM_STATE' => 'ACT',
                           '_SUB_MENU' => [
                               [
                                   'title' => 'Copenhagen Office',
                                   '_OVERRIDE_HREF' => 'index.php?id=11&officeId=cph',
                               ],
                               [
                                   'title' => 'Paris Office',
                                   '_OVERRIDE_HREF' => 'index.php?id=11&officeId=paris',
                               ],
                               [
                                   'title' => 'New York Office',
                                   '_OVERRIDE_HREF' => 'https://example.org',
                                   '_OVERRIDE_TARGET' => '_blank',
                               ]
                           ]
                       ],
                       [
                           'title' => 'Form',
                           '_OVERRIDE_HREF' => 'index.php?id=10&cmd=showform',
                       ],
                       [
                           'title' => 'Thank you',
                           '_OVERRIDE_HREF' => 'index.php?id=10&cmd=thankyou',
                       ],
                   ],
               ],
               [
                   'title' => 'Products',
                   '_OVERRIDE_HREF' => 'index.php?id=14',
               ]
           ];
       }

   }

Notice how the array contains "fake" page-records which has *no* uid
field, only a "title" and "\_OVERRIDE\_HREF" as required and some
other fields as it fits.

- The first level with items "Contact" and "Products" contains "title"
  and "\_OVERRIDE\_HREF" fields, but "Contact" extends this by a
  "\_SUB\_MENU" array which contains a similar array of items.

- The first item on the second level, "Offices", contains a field called
  "\_OVERRIDE\_TARGET". Further the item has its state set to "ACT"
  which means it will render as an "active" item (you will have to
  calculate such stuff manually when you are not rendering a menu of
  real pages!). Finally there is even another sub-level of menu items.

