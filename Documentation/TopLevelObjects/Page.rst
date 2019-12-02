.. include:: ../Includes.txt

.. _tlo-page:

====
page
====


.. seealso::

    :ref:`page` object type

This defines what is rendered in the frontend.

TYPO3 does not initialize :ts:`page` by default. You must initialize this
explicitly, e.g.::

    page = PAGE


Multiple pages
==============

Pages are referenced by two main values. The "id" and "type".
The **"id"** points to the uid of the page. Thus the
page is found.
When rendering pages in the frontend, TYPO3 uses the GET parameter **"type"**
to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 (which is the default) while a JSON
stream with the same content could go with type 1.

The property :ref:`typeNum <setup-page-typenum>`  defines for which type,
the page will be used.

Example::

    page = PAGE
    page.typeNum = 0
    page {
       # set properties ...
    }

    json = PAGE
    json.typeNum = 1
    # ...

In the frontend, the original URLs that are generated will include the type and
an id parameter (for the page id), example (for json and page id 22):

``/index.php?id=22&type=1``

This

Guidelines
----------

Good, general PAGE object names to use are:

* **page** for the main page with content
* **json** for a json stream with content
* **xml** for a XML stream with content

These are just recommendations. However, especially the name page for the content bearing page
is very common and most documentation will imply that your main page object is called page.
