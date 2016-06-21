.. include:: ../../Includes.txt

.. _pageoptions:

->OPTIONS
^^^^^^^^^

Various options for the page affecting the core at various points.


.. _pageworkspaces:

workspaces
^^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         previewPageId

   Data type
         integer/fieldReference per table

   Description
         Page uid will be used for previewing records on a workspace.

         **Examples:**

         .. code-block:: typoscript

            # Using page 123 for previewing workspaces records (in general)
            options.workspaces.previewPageId = 123

            # Using the pid field of each record for previewing (in general)
            options.workspaces.previewPageId = field:pid

            # Using page 123 for previewing workspaces records (for table tx_myext_table)
            options.workspaces.previewPageId.tx_myext_table = 123

            # Using the pid field of each record for previewing (or table tx_myext_table)
            options.workspaces.previewPageId.tx_myext_table = field:pid

.. ###### END~OF~TABLE ######


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

         Exclude these individual backend layouts from drop-down list:

         .. code-block:: typoscript

			options.backendLayout.exclude = 1,2

         .. figure:: ../../Images/BackendLayoutsExcluded.png
            :alt: Drop-down list without individual backend layouts.

.. ###### END~OF~TABLE ######