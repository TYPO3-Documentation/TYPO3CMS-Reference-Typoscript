..  include:: /Includes.rst.txt

..  _backend-layouts:

===============
Backend layouts
===============

Backend layouts were initially introduced to display editable versions of the
webpages in the backend (in the :guilabel:`Page` module). However, they have now
increased their functionality and can be used for frontend rendering as well. Using
TypoScript, the Fluid template for a webpage is chosen depending on which backend
layout a page has. (The TypoScript :confval:`data:pagelayout <t3tsref:data-pagelayout>`
function retrieves the backend layout).

..  figure:: /Images/ManualScreenshots/BackendLayouts/PageModule.png

    A page module with a backend layout that has 3 content areas.

Backend layouts contain content areas that are organized in rows and columns. Content
areas can span multiple rows and columns, but they cannot be nested. For nested layouts in the
backend, use an extension like :composer:`b13/container`.

The page TSconfig for the backend layout above can be found in the site package
tutorial: :ref:`Create backend page layouts <t3sitepackage:backend-page-layouts>`.

For further examples, see `backend layouts in the bootstrap
package (GitHub) <https://github.com/benjaminkott/bootstrap_package/tree/master/Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts>`__.

..  confval-menu::

..  confval:: BackendLayouts.[backendLayout]
    :name: mod-web-layout-BackendLayouts
    :type: array:guilabel:`Page` module
    :Path: mod.web_layout.BackendLayouts

    ..  confval:: title
        :name: mod-web-layout-BackendLayouts-backendLayout-title
        :type: string or language identifier

        The title of a backend layout. It will be displayed in the page
        properties in the backend.

        ..  figure:: /Images/ManualScreenshots/BackendLayouts/PageProperties.png
            :caption: Choose the backend layout in the page properties

    ..  confval:: icon
        :name: mod-web-layout-BackendLayouts-backendLayout-icon
        :type: string, extension path to an image file

        The icon in the page properties.

        ..  code-block:: tsconfig
            :caption: EXT:bootstrap_package/Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts/subnavigation_right_2_columns.tsconfig

            mod.web_layout.BackendLayouts.subnavigation_right_2_columns {
                icon = EXT:bootstrap_package/Resources/Public/Icons/BackendLayouts/subnavigation_right_2_columns.svg
            }

    ..  confval:: config.backend_layout

        ..  confval:: colCount
            :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.colCount
            :type: integer

            The total number of columns in the backend layout.

        ..  confval:: rowCount
            :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.rowCount
            :type: integer

            The total number of rows in the backend layout.

        ..  confval:: rows.[row].columns.[col]

            ..  confval:: name
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-name
                :type: string or language identifier

                The name of the input area where content elements can be added. Will be
                displayed in the :guilabel:`Page` module.

            ..  confval:: colPos
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-colPos
                :type: integer, 0 - maxInt

                If content elements have been  added to this area, the value of `colPos`

            ..  confval:: identifier
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-identifier
                :type: string

                An identifier that can be used by the page content
                DataProcessor to identify the content elements in this
                area.

                It is a more meaningful representation than just :confval:`colPos <mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-colPos>`,
                such as "main", "sidebar" and "footerArea".

            ..  confval:: slideMode
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-slideMode
                :type: string, "" (empty string), "slide", "collect", "collectReverse"

                An identifier that can be used by the page content
                DataProcessor to identify content elements in this
                area.

                `slide`
                    If no content is found, check the parent pages for more content
                `collect`
                    Use all content from this page and the parent pages as one collection
                `collectReverse`
                    The same as "collect", but in the opposite order

            ..  confval:: colspan
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-colspan
                :type: integer, 1 - :confval:`mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.colCount`

                Can be used if the content element area should span multiple
                columns as in the "Jumbotron" example above.

            ..  confval:: rowspan
                :name: mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout-rows-row-columns-col-rowspan
                :type: integer, 1 - :confval:`mod-web-layout-BackendLayouts-backendLayout-title-config-backend_layout.rowCount`

                Can be used if the content element area spans multiple
                rows.

Example: Use a backend layout in the page content data processor
================================================================

Define the backend layout via page TSconfig, like in the site below:

..  literalinclude:: _BackendLayout.tsconfig
    :caption: config/sites/my-site/page.tsconfig

Configure the output with TypoScript, using the :ref:`PAGEVIEW <t3tsref:cobj-pageview>`
content object and the `page-content` DataProcessor.

..  todo: Link Dataprocessor

..  literalinclude:: _BackendLayout.typoscript
    :caption: config/sites/my-site/setup.typoscript

Use the column identifiers in a Fluid template:

..  literalinclude:: _Default.html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html
