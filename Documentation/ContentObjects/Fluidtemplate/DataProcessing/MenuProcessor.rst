.. include:: /Includes.rst.txt
.. _MenuProcessor:

=============
MenuProcessor
=============


The :php:`MenuProcessor` utilizes :ref:`HMENU <cobj-hmenu>` to generate a JSON encoded menu string
that will be decoded again and assigned to :ts:`FLUIDTEMPLATE` as a variable.
Additional data processing is supported and will be applied to each record.

.. hint:: The third party extension
   `b13/menus <https://extensions.typo3.org/extension/menus>`__ also provides
   Menu processors like :php:`B13\Menus\DataProcessing\TreeMenu` and
   :php:`B13\Menus\DataProcessing\BreadcrumbsMenu`.

   Refer to the
   `manual of the extension b13/menus <https://github.com/b13/menus/blob/master/README.md>`__
   for more information.

Options:
========

.. confval:: levels

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: 1
   :Example: 5

   Maximal number of levels to be included in the output array


.. confval:: expandAll

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: 1
   :Example: 0

   Should all submenus be included or only those of the active pages?

.. confval:: includeSpacer

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: 0
   :Example: 1

   Include pages with type "spacer"

.. confval:: titleField

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: "nav_title // title"
   :Example: "subtitle"

   Fields to be used as title

.. confval:: as

   :Required: false
   :type: string
   :default: "menu"

   Name for the variable in the Fluid template.

.. important::

   Additionally all :ref:`HMENU options <cobj-hmenu-options>` are available.


Example: Two level menu of the web page
=======================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`MenuProcessor` the following scenario is possible:

.. include:: /CodeSnippets/DataProcessing/TypoScript/MenuProcessor.rst.txt


The Fluid template
------------------

This generated menu can be used in Fluid like this:

.. include:: /CodeSnippets/DataProcessing/Template/DataProcMenu.rst.txt


Output
------

The array now contains the menu items on level one. Each item in return has the menu
items of level 2 in an array called :php:`children`.

.. figure:: /Images/ManualScreenshots/FrontendOutput/DataProcessing/MenuProcessor.png
   :class: with-shadow
   :alt: language menu dump and output
