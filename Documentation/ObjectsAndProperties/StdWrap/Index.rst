.. include:: ../../Includes.txt


.. _objects-stdwrap:

======================
Objects and stdWrap
======================

"*type* /stdWrap"

When a data type is set to "*type* / :ts:`stdWrap`" it means that the value
is parsed through the :ts:`stdWrap` function with the properties of the
value as parameters.


stdWrap example:
================

If the property "pixels" has the data type "integer / :ts:`stdWrap`", the
value should be set to an integer and can be parsed through :ts:`stdWrap`.

In a real application we could do like this::

   .pixels.field = imagewidth
   .pixels.intval = 1

This example imports the value from the field "imagewidth" of the
current :php:`$cObj->data-array`. But we don't trust the result to be an
integer so we parse it through the :php:`intval()`-function.

