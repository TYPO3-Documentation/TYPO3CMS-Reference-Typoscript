..  include:: /Includes.rst.txt
..  _MenuProcessor:

=============
MenuProcessor
=============

The :php:`MenuProcessor` utilizes :ref:`HMENU <cobj-hmenu>` to generate a list
of menu items which can be assigned to :typoscript:`FLUIDTEMPLATE` as a
variable.

Additional data processing is supported and will be applied to each record.

..  hint::
    The third party extension `b13/menus
    <https://extensions.typo3.org/extension/menus>`__ also provides menu
    processors like :php:`\B13\Menus\DataProcessing\TreeMenu` and
    :php:`\B13\Menus\DataProcessing\BreadcrumbsMenu`.

    Refer to the `manual of the extension b13/menus
    <https://github.com/b13/menus/blob/master/README.md>`__ for more
    information.

Options
=======

..  data-processor-menu:: levels

    :Required: true
    :type: int, :ref:`stdWrap`
    :default: 1
    :Example: 5

    Maximal number of levels to be included in the output array.


..  data-processor-menu:: expandAll

    :Required: true
    :type: int, :ref:`stdWrap`
    :default: 1
    :Example: 0

    Include all submenus (`1`) or only those of the active pages (`0`).

..  data-processor-menu:: includeSpacer

    :Required: true
    :type: int, :ref:`stdWrap`
    :default: 0
    :Example: 1

    Include pages with type "spacer".

..  data-processor-menu:: titleField

    :Required: true
    :type: int, :ref:`stdWrap`
    :default: "nav_title // title"
    :Example: "subtitle"

    Fields to be used as title.

..  data-processor-menu:: as

    :Required: false
    :type: string
    :default: "menu"

    Name for the variable in the Fluid template.

..  attention::
    Additionally, all :ref:`HMENU options <cobj-hmenu-options>` are available.


Example: Two level menu of the web page
=======================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`MenuProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/MenuProcessor.rst.txt

..  versionadded:: 12.1
    One can use the alias :typoscript:`menu` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\MenuProcessor`.


The Fluid template
------------------

This generated menu can be used in Fluid like this:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcMenu.rst.txt


Output
------

The array now contains the menu items on level one. Each item in return has the
menu items of level 2 in an array called :php:`children`.

..  include:: /Images/AutomaticScreenshots/DataProcessing/MenuProcessor.rst.txt
