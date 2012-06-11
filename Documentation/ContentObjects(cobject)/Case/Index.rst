

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


CASE
^^^^

This is a very flexible object whose rendering can vary depending on a
given key. The principle is similar to that of the "switch" construct
in PHP.

The "key" property is expected to match one of the values found in the
"Array". If none is found, the "default" property will be used. Any
string can be used as value in the "Array" except for those that match
another property. So the forbidden values are: "setCurrent", "key",
"stdWrap" and "if". And of course, "default" has a special meaning.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         setCurrent
   
   Data type
         string /stdWrap
   
   Description
         Sets the "current"-value.
   
   Default


.. container:: table-row

   Property
         key
   
   Data type
         string /stdWrap
   
   Description
         This is used to define the source of the value that will be matched
         against the values of "Array". It will generally not be a simple
         string, but use its stdWrap properties to retrieve a dynamic value
         from some specific source, typically a field of the current record
         (see example below).
   
   Default
         default


.. container:: table-row

   Property
         default
   
   Data type
         cObject
   
   Description
         Defines the rendering for all values of "key" that don't match any of
         the values of "Array".
   
   Default


.. container:: table-row

   Property
         Array...
   
   Data type
         cObject
   
   Description
         Defines the rendering for a number of values.
   
   Default


.. container:: table-row

   Property
         stdWrap
   
   Data type
         ->stdWrap
   
   Description
         stdWrap around any object that was rendered no matter what the "key"
         value is.
   
   Default


.. container:: table-row

   Property
         if
   
   Data type
         ->if
   
   Description
         If "if" returns false, nothing is returned.
   
   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).CASE]


((generated))
"""""""""""""

Example:
~~~~~~~~

This example chooses between two different renderings of some content
depending on whether the field "layout" is "1" or not ("default"). The
result is in either case wrapped with "\|<br />". If the field
"header" turns out not to be set ("false") an empty string is returned
anyway.

::

   stuff = CASE
   stuff.key.field = layout
   stuff.if.isTrue.field = header
   stuff.stdWrap.wrap = |<br />
   
   stuff.default = TEXT
   stuff.default {
     ....
   }
   stuff.1 = TEXT
   stuff.1 {
     ....
   }

