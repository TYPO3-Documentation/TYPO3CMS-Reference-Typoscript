:navigation-title: Content records
..  include:: /Includes.rst.txt
..  _guide-content-records:

=======================
Reading content records
=======================

..  note::

    The following chapter aims at explaining the relationship between database
    content and frontend output via TypoScript. The TYPO3 Core and system
    extension `fluid_styled_content` already contain definitions for the TYPO3
    Core content element rendering. You do not have to add anything yourself.

    If you wish a content element to be rendered differently or if you program
    an extension with new content elements, it will be necessary to understand
    this relationship to be able to design your own TypoScript properly.

Obviously entering all content for the website would be terribly tiresome,
although possible from a theoretical point of view.

What we want is to have a TypoScript which gathers the content automatically.
The example below creates a page on which, for each content element on that
page, the headline and the text is displayed.

After creating the :ref:`PAGE <page>` object, we use the :ref:`CONTENT
<cobj-content>` object to retrieve content from the database. For each
content element we use the :ref:`TEXT <cobj-text>` object to perform
the actual rendering:

..  literalinclude:: /Guide/ReadingContentRecords/_snippets/_PAGE.typoscript

The :ref:`CONTENT <cobj-content>` object executes an SQL query on the
database. The query is controlled by the `select` property, which - in
our case - defines that we want all records from the column 0 (which is the
column called "NORMAL" in the backend), and that the result should be sorted
according to the field called "sorting".

The `select` property has a `pidInList` which can be used to
retrieve elements from a specific page. If it is not defined
- as in our example - elements are taken from the current page.

The `renderObj` property defines how each record gets rendered. It is
defined as :ref:`COA (Content Object Array) <cobj-coa>`, which can hold
an arbitrary number of TypoScript objects. In this case, two :ref:`TEXT
<cobj-text>` objects are used, which are rendered one after the other
(remember that the order of the rendering is not controlled by the order in
TypoScript, but by the numbers with which they are defined). The :ref:`TEXT
<cobj-text>` object "10" will be created first and the :ref:`TEXT
<cobj-text>` object "20" will be rendered after it.

The challenge is to render all content elements like the web designer
predetermined. Therefore, we have to create TypoScript definitions for every
single database field (e.g. for images, image size, image position, link to
top, index, etc.).

..  include:: _Chapters/_ContentElements.rst.txt
    :show-buttons:
