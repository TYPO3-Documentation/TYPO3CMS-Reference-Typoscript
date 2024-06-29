..  include:: /Includes.rst.txt
..  _PageContentFetchingProcessor:

============================
PageContentFetchingProcessor
============================

This data processor loads all :sql:`tt_content` records from the current
:ref:`backend layout <t3coreapi:be-layout>` into
the template with a given identifier for each :sql:`colPos`, also respecting slideMode or
collect options based on the page layouts content columns.

..  _PageContentFetchingProcessor-options:

Options
=======

..  confval-menu::

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

..  todo: Use new viewhelper once https://review.typo3.org/c/Packages/TYPO3.CMS/+/83718/2 is merged

The :ref:`backend layout <t3coreapi:be-layout>` is defined like this:

..  literalinclude:: _PageContentFetchingProcessor/_BackendLayout.tsconfig
    :caption: config/sites/my-site/page.tsconfig
