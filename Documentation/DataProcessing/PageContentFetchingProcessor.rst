:navigation-title: page-content
..  include:: /Includes.rst.txt
..  _PageContentFetchingProcessor:

=============================
`page-content` data processor
=============================

..  versionadded:: 13.2

This data processor :php:`\TYPO3\CMS\Frontend\DataProcessing\PageContentFetchingProcessor`,
alias `page-content`, loads all :sql:`tt_content` records from the current
:ref:`backend layout <t3coreapi:be-layout>` into
the template with a given identifier for each :sql:`colPos`, also respecting slideMode or
collect options based on the page layouts content columns.

An array of :ref:`Record objects <t3coreapi:record_objects>` will be passed to
the Fluid template. You can use the
:ref:`CObject ViewHelper <f:cObject> <t3viewhelper:typo3-fluid-cobject>` to
display the content elements.

..  contents:: Table of contents

..  _PageContentFetchingProcessor-options:

Options
=======

..  confval-menu::
    :display: table
    :type:
    :Default:

    ..  confval:: as
        :name: PageContentFetchingProcessor-as
        :Required: false
        :type: :ref:`data-type-string`
        :Default: "content"

        Name for the variable in the Fluid template.

    ..  confval:: if
        :name: PageContentFetchingProcessor-if
        :Required: false
        :type: :ref:`if` condition
        :Default: ''

        Only if the condition is met the data processor is executed.

..  _PageContentFetchingProcessor-example:

Example: Use the page-content data processor to display the content
===================================================================

..  literalinclude:: _PageContentFetchingProcessor/_BackendLayout.typoscript
    :caption: config/sites/my-site/setup.typoscript

Use the identifiers of the columns in the Fluid template:

..  literalinclude:: _PageContentFetchingProcessor/_Default.html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

You can use the :ref:`CObject ViewHelper <f:cObject> <t3viewhelper:typo3-fluid-cobject>`
to render the content element using :composer:`typo3/cms-fluid-styled-content`
or render it your self.

`{contentElement.mainType}`
    Is always "tt_content" for content elements.
`{contentElement.fullType}`
    Is composed of "tt_content.[CType]". For a content element of type text it
    contains "tt_content.text".

The :ref:`backend layout <t3coreapi:be-layout>` is defined like this:

..  literalinclude:: _PageContentFetchingProcessor/_BackendLayout.tsconfig
    :caption: config/sites/my-site/page.tsconfig

..  _PageContentFetchingProcessor-AfterContentHasBeenFetchedEvent:

Modify the result via AfterContentHasBeenFetchedEvent
=====================================================

..  versionadded:: 13.4.2 | 14.0
    The event `AfterContentHasBeenFetchedEvent <https://docs.typo3.org/permalink/t3coreapi:aftercontenthasbeenfetchedevent>`_
    has been introduced to adjust the page content fetched by the `page-content`
    data processor.

The event `AfterContentHasBeenFetchedEvent <https://docs.typo3.org/permalink/t3coreapi:aftercontenthasbeenfetchedevent>`_
can be used to modify the content elements fetched by the by the `page-content`
data processor.

See the following example:
`Filter content elements provided by the page-content data processor <https://docs.typo3.org/permalink/t3coreapi:aftercontenthasbeenfetchedevent-example>`_.
