.. include:: /Includes.rst.txt
.. _guide-typoscript-array:

===========================
TypoScript is just an array
===========================

Internally, TypoScript is parsed and stored as a PHP array.
For example::

   page = PAGE
   page.10 = TEXT
   page.10.value = Hello World
   page.10.stdWrap.wrap = <h2>|</h2>

will be converted to the following PHP array:

.. code-block:: php

   $data = [
       'page' => 'PAGE',
       'page.' => [
           '10' => 'TEXT',
           '10.' => [
               'value' => 'Hello World',
               'stdWrap.' => [
                   'wrap' => '<h2>|</h2>',
               ],
           ],
       ],
   ],

Upon evaluation, a ":ref:`PAGE <page>`" object will be created
first, and the parameter :php:`$data['page.']` will be assigned to it.
The ":ref:`PAGE <page>`" object will then search for all properties, which
it knows about. In this case, it will find a numeric entry ("10"), which
has to be evaluated. A new object of type ":ref:`TEXT <cobj-text>`"
with the parameter :php:`$data['page.']['10.']` will be created.
The ":ref:`TEXT <cobj-text>`" object knows the parameters :typoscript:`value` and
:typoscript:`stdWrap`. It will set the content of :typoscript:`value` accordingly. The
parameters from :typoscript:`stdWrap` will be passed to the ":ref:`stdWrap <stdwrap>`" function.
There the property 'wrap' is known, and the text "Hello world" will be inserted
at the pipe (`|`) position and returned.

It is important to be aware of this relationship in order to
understand the behaviour of TypoScript.
For example, if the above TypoScript is extended
with the following line::

   page.10.myFunction = Magic!

the following entry will be added to the PHP array:

.. code-block:: php

   $data['page.']['10.']['myFunction'] = 'Magic!';

However, the ":ref:`TEXT <cobj-text>`" object does not know
any property called "myFunction". Consequently, the entry will have no effect.

.. important::

   No semantic error checking is done. If you define objects or
   properties which do not exist, you will not see any error message.
   Instead, those specific lines of TypoScript simply do nothing. This
   should be considered, especially while troubleshooting.
