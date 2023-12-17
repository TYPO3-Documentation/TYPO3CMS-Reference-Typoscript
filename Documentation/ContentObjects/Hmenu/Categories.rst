.. include:: /Includes.rst.txt

.. index:: HMENU; special = categories
.. _hmenu-special-categories:

==================
Categories HMENU
==================

Makes a menu of pages belonging to one or more categories. If a page
belongs to several of the selected categories, it will appear only once.
By default pages are unsorted.

Each in the resulting array of pages gets an additional entry with key
:code:`_categories` containing the list of categories the page belongs to,
as a comma-separated list of uid's. It can be accessed with
:ref:`stdWrap.field <stdwrap-field>` or :ref:`getText <data-type-gettext-field>`
like any other field.

.. contents::
   :local:

Properties
==========

.. _hmenu-special-categories-value:

special.value
--------------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         special.value

   Data type
         list of categories / :ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of categories uid's.

         **Example:**

         .. code-block:: typoscript

            20 = HMENU
            20 {
            	special = categories
            	special.value = 1,2
            	1 = TMENU
            	1.NO {
            		...
            	}
            }

.. _hmenu-special-categories-relation:

special.relation
-----------------

.. container:: table-row

   Property
         special.relation

   Data type
         :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

   Default
         special.categories

   Description
         Name of the categories-relation field to use for
         building the list of categorized pages, as there can
         be several such fields on a given table.

.. _hmenu-special-categories-sorting:

special.sorting
----------------


.. container:: table-row

   Property
         special.sorting

   Data type
         :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

   Description
         Which field from the "pages" table should be used for sorting.
         Language overlays are taken into account, so alphabetical sorting
         on the "title" field, for example, will work.

         If an unknown field is defined, the pages will not be sorted.

.. _hmenu-special-categories-order:

special.order
--------------

.. container:: table-row

   Property
         special.order

   Data type
         "asc" or "desc" / :ref:`stdWrap <stdwrap>`

   Default
         asc

   Description
         Order in which the pages should be ordered, ascending or
         descending. Should be "asc" or "desc", case-insensitive.
         Will default to "asc" in case of invalid value.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = categories]


Example
=======

Menu of pages in a certain category
-----------------------------------

The content element :guilabel:`Menu > Categorized pages` provided by the system
extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

.. include:: /CodeSnippets/Menu/TypoScript/MenuCategorizedPages.rst.txt

The following Fluid template can be used to style the menu:

.. include:: /CodeSnippets/Menu/Template/MenuCategorizedPages.rst.txt
