.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt

.. _pageoptions:

->OPTIONS
^^^^^^^^^

Various options for the page affecting the core at various points.


.. _pagebackendlayout:

backendLayout
"""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         exclude

   Data type
         *(list of integers)*

   Description
         Excludes a list of backend layouts form being usable during assigning a layout in the backend.

         Use the uid of the record in the default data provider.

         **Example:**

         2 existing individual backend layouts should be excluded from drop-down list.

         .. figure:: ../../Images/BackendLayoutID.png
            :alt: 2 individual backend layouts.

         Exclude these individual backend layouts from drop-down list::

            options.backendLayout.exclude = 1,2

         .. figure:: ../../Images/BackendLayoutsExcluded.png
            :alt: Drop-down list without individual backend layouts.

.. ###### END~OF~TABLE ######