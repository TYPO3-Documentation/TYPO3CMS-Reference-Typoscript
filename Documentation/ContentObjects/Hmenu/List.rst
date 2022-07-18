.. include:: /Includes.rst.txt
.. index:: HMENU; special = list
.. _hmenu-special-list:

=========
List menu
=========

A :ref:`HMENU <cobj-hmenu>` of type :typoscript:`special = list` lets you
create a menu that lists the pages you define in the property
:typoscript:`special.value`.

Mount pages are supported.

.. contents::
   :local:

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. _hmenu-special-list-value:

.. container:: table-row

   Property
         value

   Data type
         list of page ids /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         This will generate a menu with the two pages (uid=35 and uid=56)
         listed:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            lib.listOfSelectedPages = HMENU
            lib.listOfSelectedPages {
                special = list
                special.value = 35, 56
                // render the menu
            }

         If :typoscript:`special.value` is not set, the default uid is 0, so
         that only your homepage will be listed.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = list]

Examples
=========

Menu of all subpages
--------------------

The content element :guilabel:`Menu > Pages` provided by the system
extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

.. include:: /CodeSnippets/Menu/TypoScript/MenuSubpages.rst.txt

The following Fluid template can be used to style the menu:

.. include:: /CodeSnippets/Menu/Template/MenuSubpages.rst.txt
