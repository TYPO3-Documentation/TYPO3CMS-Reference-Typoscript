..  include:: /Includes.rst.txt
..  _guide-main-template:
..  _guide-main-typoscript-record:

==========================
The main TypoScript record
==========================

The TypoScript code used to define how pages are rendered is
located in the "main" TypoScript record. In this record a so-called
"rootlevel flag" is set.

..  include:: /Images/AutomaticScreenshots/RootlevelFlag.rst.txt

When the frontend renders a page, TYPO3 CMS searches along the page tree up
to the root page to find a "main" TypoScript record. Normally, there are
additional TypoScript records besides the "main" TypoScript record.
For now, we will assume we are only using the "main" TypoScript record.

TypoScript syntax is very straightforward. On the left side, objects
and properties are defined. On the right side are the assigned values.
Both objects and properties can contain other objects. Object properties
are defined by using the dot "." notation.

The following is a typical example of TypoScript syntax:

..  literalinclude:: _page.typoscript
