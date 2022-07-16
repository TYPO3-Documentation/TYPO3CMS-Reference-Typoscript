.. include:: /Includes.rst.txt
.. index:: HMENU; special = directory
.. _hmenu-special-directory:

==================================
Directory menu - menu of subpages
==================================

A :ref:`HMENU <cobj-hmenu>` of type :typoscript:`special = directory`
lets you create a menu listing the subpages of one or more parent pages.

The parent pages are defined in the property :typoscript:`special.value`.

This menu type can be used for example to display all subpages of a certain page
as meta menu or footer menu.

Mount pages are supported.

.. contents::
   :local:

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. _hmenu-special-directory-value:

special.value
-------------

.. container:: table-row

   Property
      special.value

   Data type
      list of page ids /:ref:`stdWrap <stdwrap>`

   Default
      current page id

   Description
      This will generate a menu of all pages with pid = 35 and pid = 56.

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         lib.metaMenu = HMENU
         lib.metaMenu {
            special = directory
            special.value = 35, 56
            // render the menu
         }

.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = directory]


Examples
=========

Menu of all subpages
--------------------

The content element :guilabel:`Menu > Subpages` provided by the system
Extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

.. include:: /CodeSnippets/Menu/TypoScript/MenuSubpages.rst.txt

The following Fluid template can be used to style the menu:

.. include:: /CodeSnippets/Menu/Template/MenuSubpages.rst.txt
