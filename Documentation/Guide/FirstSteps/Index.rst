:navigation-title: First steps
..  include:: /Includes.rst.txt
..  _guide-first-steps:

===========
First steps
===========

The system extension "tstemplate - TYPO3 CMS TypoScript" must be installed.

The basic rendering is defined in the "Setup" field of the main TypoScript record.

TypoScript essentially consists of objects, which have certain
properties. Some of these properties can accept other objects, others
stand for functions or simple values.

The :ref:`PAGE <page>` object is responsible for the
rendering of a website page in the frontend:

..  literalinclude:: _snippets/_mypage.typoscript

The :ref:`PAGE <page>` object on the one hand offers numerous named properties
(like :typoscript:`typeNum`). On the other hand it also has an endless number of
numbered objects (a so-called content array). The names of these
objects only consist of numbers and the objects are sorted
accordingly when they are rendered, from the smallest number to the
largest. The order of the lines in the TypoScript record is
irrelevant:

..  literalinclude:: _snippets/_mypage2.typoscript

Every entry is stored in a multidimensional PHP array. Every object
and every property, therefore, is unique. We could define an arbitrary
number of PAGE objects; however, the :typoscript:`typeNum` has to be unique. For
every :typoscript:`typeNum`, there can be only one :ref:`PAGE <page>` object.

In the example, for the parameter :typoscript:`typeNum = 98`, a different output
mode is created. By using :typoscript:`typeNum`, various output types can be
defined. If :typoscript:`typeNum` is not set explicitly, it defaults to "0".
Typically, :typoscript:`typeNum = 0` is used for the HTML output.

When a page is requested with just :code:`index.php?id=1`, :typoscript:`typeNum = 0`
will be assumed and the output will be HTML. To get the print output, the request
will have to pass a "type" attribute, i.e. :code:`index.php?id=1&type=98`.

It is thus possible to generate many different outputs depending on one's
needs (XML, JSON, PDF, etc.). TypoScript configuration can be copied between
those various views, changing only what's specific for each of them.

The previous example would look like this as a PHP array:

..  literalinclude:: _snippets/_mypage.php

Empty spaces at the start and end of values are removed by TYPO3 CMS
automatically (using the PHP :php:`trim()` function).

The :typoscript:`=` sign corresponds to a simple assignment. Here is an
overview of the various operators:

..  literalinclude:: _snippets/_mypage3.typoscript

Object types are always written with capital letters; parameters and
functions typically in camel case (first word lower case, next word
starts with a capital letter, no space between words). There are some
exceptions to this.

With the :typoscript:`.` as a separator parameter, functions and child objects are
referenced and can be assigned values accordingly:

..  code-block:: typoscript

    page.10.stdWrap.wrap = <h1>|</h1>

The :doc:`TypoScript Reference (TSref) <Index>` is the ultimate
resource to find out which objects, functions and properties exist.

Things can get more complicated when objects are nested inside
each other and many properties are used:

..  literalinclude:: _snippets/_mypage4.typoscript

To make things clearer, TypoScript code can be structured using curly braces
(:typoscript:`{}`) at each nesting level:

..  literalinclude:: _snippets/_mypage5.typoscript

..  important::

    The opening curly brace must always be on the same line as the property.

Parenthesis (:typoscript:`()`) are used for writing text values on more
than one line.

Using this style of notation reduces the danger of typographic errors
and makes the script easier to read. In addition it reduces the repetition
of variable names making it easier to rename an object.

The full reference for the syntax is found in the
:ref:`TypoScript Syntax and In-depth Study <typoscript-syntax>`.
