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
tutorial: :ref:`Create the backend page layouts <t3sitepackage:backend-page-layouts>`.

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

            ..  confval:: identifier
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-identifier
                :type: string

                An identifier that can be used by the page content
                DataProcessor to identify the content elements within this
                area.

                It is a speaking representation for the :confval:`colPos <mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-colPos>`,
                such as "main", "sidebar" or "footerArea".

            ..  confval:: slideMode
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-slideMode
                :type: string, "" (empty string), "slide", "collect", "collectReverse"

                An identifier that can be used by the page content
                DataProcessor to identify the content elements within this
                area.

                `slide`
                    If no content is found, check the parent pages for more content
                `collect`
                    Use all content from this page, and the parent pages as one collection
                `collectReverse`
                    Same as "collect" but in the opposite order

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

Example: Use a backend layout in the page content data processor
================================================================

Define the backend layout via page TSconfig, for example in the site:

..  literalinclude:: _BackendLayout.tsconfig
    :caption: config/sites/my-site/page.tsconfig

Configure the output via TypoScript, using the content object
:ref:`PAGEVIEW <t3tsref:cobj-pageview>` and the DataProcessor
`page-content`.

..  todo: Link Dataprocessor

..  literalinclude:: _BackendLayout.typoscript
    :caption: config/sites/my-site/setup.typoscript

Use the identifiers of the columns in the Fluid template:

..  literalinclude:: _Default.html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html
