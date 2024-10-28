.. include:: /Includes.rst.txt


.. _guide-main-template:

The main template
^^^^^^^^^^^^^^^^^

The TypoScript code used to define how pages are rendered is
located in the "main" template. In this template a so-called
"rootlevel flag" is set.

.. include:: /Images/AutomaticScreenshots/RootlevelFlag.rst.txt

When the frontend renders a page, TYPO3 CMS searches along the page tree up
to the root page to find a "main" template. Normally, there are
additional templates besides the "main" template.
For now, we will assume we are only using the "main" template.

TypoScript syntax is very straightforward. On the left side, objects
and properties are defined. On the right side are the assigned values.
Both objects and properties can contain other objects. Object properties
are defined by using the dot "." notation.

The following is a typical example of TypoScript syntax::

   page = PAGE
   page.10 = TEXT
   page.10.value = Hello World

