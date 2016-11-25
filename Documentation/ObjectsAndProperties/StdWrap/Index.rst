.. include:: ../../Includes.txt


.. _objects-stdwrap:

======================
Objects and stdWrap
======================

"... /stdWrap"

When a data type is set to "*type* /stdWrap" it means that the value
is parsed through the stdWrap function with the properties of the
value as parameters.


stdWrap example:
================

If the property "pixels" has the data type "integer /stdWrap", the
value should be set to an integer and can be parsed through stdWrap.

In a real application we could do like this::

   .pixels.field = imagewidth
   .pixels.intval = 1

This example imports the value from the field "imagewidth" of the
current $cObj->data-array. But we don't trust the result to be an
integer so we parse it through the intval()-function.

