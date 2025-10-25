:navigation-title: getText / data
..  include:: /Includes.rst.txt
..  _using-gettext:

===========================
Using the getText data type
===========================

There's one particular data type which might leave you wondering, because it
may seem to behave rather like a function. This is
:ref:`getText <data-type-gettext>`.

The `data` property of :ref:`stdWrap <stdwrap>` has this
particular data type. It makes it possible retrieve values from a large number
of sources, including:

*   global TYPO3 CMS arrays
*   GET/POST vars
*   database
*   localized strings
*   page rootline

Here are some examples:

..  code-block:: typoscript

    10 = TEXT
    10.data = field:abstract

Creates a text object that contains the value of the "abstract" field from the
current page:

..  code-block:: typoscript

    10 = TEXT
    10.data = leveltitle:0

Creates a text object that contains the title of the page on level 0 of the
current branch, i.e. the website root for that branch:

..  code-block:: typoscript

    10 = TEXT
    10.data = LLL:my_extension.messages:siteTitle

Creates a text object that contains the value of the "siteTitle" string in the
given localization, appropriately translated for the current language.

As you can see, the base syntax is a keyword, then a colon (`:`) and then some
values that makes with regards to the chosen keyword. Although such a tool may
appear to be a function, it is not considered one as it is entirely defined on
the right side of the assignment and is thus not a property of any given
TypoScript object.

This is just a very quick overview. As usual, the :ref:`TypoScript Reference
<data-type-gettext>` is your friend.
