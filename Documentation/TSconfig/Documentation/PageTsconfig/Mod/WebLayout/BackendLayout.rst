..  include:: /Includes.rst.txt

..  _backend-layouts:

===============
Backend layouts
===============

Backend layouts were initially introduced in order to customize the view of
the :guilabel:`Page` module in TYPO3 Backend for a page, but has then since grown also in
Frontend rendering to select for example Fluid template files via TypoScript for a page,
commonly used via :confval:`data:pagelayout <t3tsref:data-pagelayout>`.

..  figure:: /Images/ManualScreenshots/BackendLayouts/PageModule.png

    A page module with a backend layout that has 3 content areas.

Backend layouts are organized in rows and columns. Content areas can span
multiple rows and or columns. They cannot be nested. For nested layouts in the
backend use an extension like :composer:`b13/container`.

The page TSconfig for the backend layout above can be found in the site package
tutorial: :ref:`Create the backend page layouts <t3sitepackage/main:backend-page-layouts>`.

For extended examples have a look at the predefined `backend layouts of the bootstrap
package (GitHub) <https://github.com/benjaminkott/bootstrap_package/tree/master/Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts>`__.

..  confval-menu::

..  confval:: BackendLayouts.[backendLayout]
    :name: mod-web-layout-BackendLayouts
    :type: array
    :Path: mod.web_layout.BackendLayouts

    ..  confval:: title
        :name: mod-web-layout-BackendLayouts-backendLayout-title
        :type: string or language identifier

        The title of the backend layout. It will be displayed in the page
        properties in the backend.

        ..  figure:: /Images/ManualScreenshots/BackendLayouts/PageProperties.png
            :caption: Choose the backend layout in the page properties

    ..  confval:: icon
        :name: mod-web-layout-BackendLayouts-backendLayout-icon
        :type: string, extension path to an image file

        The icon to be displayed in the page properties.

        ..  code-block:: tsconfig
            :caption: EXT:bootstrap_package/Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts/subnavigation_right_2_columns.tsconfig

            mod.web_layout.BackendLayouts.subnavigation_right_2_columns {
                icon = EXT:bootstrap_package/Resources/Public/Icons/BackendLayouts/subnavigation_right_2_columns.svg
            }

    ..  confval:: config.backend_layout

        ..  confval:: colCount
            :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.colCount
            :type: integer

            Total number of columns in the backend layout.

        ..  confval:: rowCount
            :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.rowCount
            :type: integer

            Total number of rows in the backend layout.

        ..  confval:: rows.[row].columns.[col]

            ..  confval:: name
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-name
                :type: string or language identifier

                Name of the input area where content elements can be added. Will be
                displayed in the :guilabel:`Page` module.

            ..  confval:: colPos
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-colPos
                :type: integer, 0 - maxInt

                When content elements are added to this area, the value of `colPos`

            ..  confval:: colspan
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-colspan
                :type: integer, 1 - :confval:`mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.colCount`

                Can be used if the content element area should span multiple
                columns as for the "Jumbotron" example in the example above.

            ..  confval:: rowspan
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-rowspan
                :type: integer, 1 - :confval:`mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.rowCount`

                Can be used if the content element area should span multiple
                rows.
