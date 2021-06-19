.. include:: /Includes.rst.txt

.. _pageoptions:

=======
options
=======

Various options for the page affecting the core at various points.

.. index::
   options.backendLayout
   Backend; Layout
.. _pagebackendlayout:

backendLayout
=============

exclude
-------

:aspect:`Datatype`
    list of identifiers / uids

:aspect:`Description`
    Exclude a list of backend layouts form being selectable when assigning a backend layout
    to a page record.

    Use the uid/identifier of the record in the default data provider.

:aspect:`Example`
    .. figure:: /Images/ManualScreenshots/BackendLayoutID.png
        :alt: Two backend layout records shown in list module

        Two backend layout records shown in list module

    .. code-block:: typoscript

        # Exclude two backend layouts from drop down selector
        options.backendLayout.exclude = 1,2

    .. figure:: /Images/ManualScreenshots/BackendLayoutsExcluded.png
        :alt: Drop down without backend layouts

        Drop down without backend layouts
