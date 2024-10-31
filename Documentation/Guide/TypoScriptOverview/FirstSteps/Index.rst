.. include:: /Includes.rst.txt


.. _guide-first-steps:

First steps
^^^^^^^^^^^

The basic rendering is defined in the "Setup" field of the main template.

TypoScript essentially consists of objects, which have certain
properties. Some of these properties can accept other objects, others
stand for functions or simple values.

The :ref:`PAGE <page>` object is responsible for the
rendering of a website page in the frontend::

   # The object mypage is defined as PAGE object.
   mypage = PAGE

   # PAGE objects have the property typeNum.
   mypage.typeNum = 0

   # mypage has an object "10" of type TEXT. It is a TEXT object.
   mypage.10 = TEXT

   # TEXT objects in turn have a property called "value".
   mypage.10.value = Hello World

The :ref:`PAGE <page>` object on the one hand offers numerous named properties
(like :typoscript:`typeNum`). On the other hand it also has an endless number of
numbered objects (a so-called content array). The names of these
objects only consist of numbers and the objects are sorted
accordingly when they are rendered, from the smallest number to the
largest. The order of the lines in the TypoScript template is
irrelevant::

   # Create a PAGE object.
   mypage = PAGE
   mypage.typeNum = 0

   mypage.30 = TEXT
   mypage.30.value = This gets rendered last.

   # Rendering will first output object number 10, then 20 and 30.
   # An object with number 25 would logically be output between 20 and 30.
   mypage.20 = TEXT
   mypage.20.value = This is rendered in the middle.

   # This is the first output object
   mypage.10 = TEXT
   mypage.10.value = This is rendered first.

   # Here we create a second PAGE object, which we can use for the
   # print view.
   print = PAGE
   print.typeNum = 98
   print.10 = TEXT
   print.10.value = This is the print version.

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

.. code-block:: php

    $TypoScript['mypage'] = 'PAGE';
    $TypoScript['mypage.']['typeNum'] = 0;
    $TypoScript['mypage.']['10'] = 'TEXT';
    $TypoScript['mypage.']['10.']['value'] = 'This is rendered first.';
    $TypoScript['mypage.']['20'] = 'TEXT';
    $TypoScript['mypage.']['20.']['value'] = 'This is rendered in the middle.';
    $TypoScript['mypage.']['30'] = 'TEXT';
    $TypoScript['mypage.']['30.']['value'] = 'This gets rendered last.';

    $TypoScript['print'] = 'PAGE';
    $TypoScript['print.']['typeNum'] = 98;
    $TypoScript['print.']['10'] = 'TEXT';
    $TypoScript['print.']['10.']['value'] = 'This is the print version.';


Empty spaces at the start and end of values are removed by TYPO3 CMS
automatically (using the PHP :php:`trim()` function).

The :typoscript:`=` sign corresponds to a simple assignment. Here is an
overview of the various operators::

   # The object test is an object of type TEXT.
   # "=" means "set value".
   test = TEXT
   test.value = Holla

   # "<" means "copy object".
   # mypage.10 returns "Holla"
   mypage.10 < test

   # Change the original object.
   # The change has no effect on mypage.10; it still returns "Holla".
   test.value = Hello world

   # "=<" means "create an object reference (link the object)".
   test.value = Holla
   mypage.10 =< test

   # Change the object which is referenced.
   # Changes DO have an effect on mypage.10.
   # mypage.10 will return "Hello world".
   test.value = Hello world


Object types are always written with capital letters; parameters and
functions typically in camel case (first word lower case, next word
starts with a capital letter, no space between words). There are some
exceptions to this.

With the :typoscript:`.` as a separator parameter, functions and child objects are
referenced and can be assigned values accordingly::

   mypage.10.stdWrap.wrap = <h1>|</h1>

The :doc:`TypoScript Reference (TSref) <Index>` is the ultimate
resource to find out which objects, functions and properties exist.

Things can get more complicated when objects are nested inside
each other and many properties are used::

   mypage = PAGE
   mypage.typeNum = 0
   mypage.10 = TEXT
   mypage.10.value = Hello world
   mypage.10.stdWrap.typolink.parameter = http://www.typo3.org/
   mypage.10.stdWrap.typolink.additionalParams = &parameter=value

   # The function name "ATagParams" does not use the standardized
   # "camelCase".
   mypage.10.stdWrap.typolink.ATagParams = class="externalwebsite"
   mypage.10.stdWrap.typolink.extTarget = _blank
   mypage.10.stdWrap.typolink.title = The website of TYPO3
   mypage.10.stdWrap.postCObject = TEXT
   mypage.10.stdWrap.postCObject.value = This text also appears in the link text
   mypage.10.stdWrap.postCObject.stdWrap.wrap = |, because the postCObject is executed before the typolink function.


To make things clearer, TypoScript code can be structured using curly braces
(:typoscript:`{}`) at each nesting level::

   mypage = PAGE
   mypage {
      typeNum = 0

      10 = TEXT
      10 {
         value = Hello world
         stdWrap {
            typolink {
               parameter = http://www.typo3.org/
               additionalParams = &parameter=value

               # The function name "ATagParams" does not use the standardized
               # "camelCase".
               ATagParams = class="externalwebsite"

               extTarget = _blank
               title = The website of TYPO3
            }

            postCObject = TEXT
            postCObject {
               value = This text also appears in the link text
               stdWrap.wrap (
                  |, because the postCObject is executed before the typolink function.
               )
            }
         }
      }
   }

.. important::

   The opening curly brace must always be on the same line as the property.

Parenthesis (:typoscript:`()`) are used for writing text values on more
than one line.

Using this style of notation reduces the danger of typographic errors
and makes the script easier to read. In addition it reduces the repetition
of variable names making it easier to rename an object.

The full reference for the syntax is found in the
:ref:`TypoScript Syntax and In-depth Study<t3coreapi:typoscript-syntax-start>`.
