.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-case:

CASE
^^^^

This is a very flexible object whose rendering can vary depending on a
given key. The principle is similar to that of the "switch" construct
in PHP.

The value of the "key" property determines, which of the provided
cObjects will finally be rendered.

The "key" property is expected to match one of the values found in the
"array of cObjects". Any string can be used as value in this array,
except for those that match another property. So the forbidden values
are: "if", "setCurrent", "key", and "stdWrap". "default" also cannot
be used as it has a special meaning: If the value of the "key"
property is *not* found in the array of cObjects, then the cObject
from the "default" property will be used.


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
         if

   Data type
         ->if

   Description
         If "if" returns false, nothing is returned.


.. container:: table-row

   Property
         setCurrent

   Data type
         string /stdWrap

   Description
         Sets the "current"-value.


.. container:: table-row

   Property
         key

   Data type
         string /stdWrap

   Description
         The key, which determines, which cObject will be rendered. Its
         value is expected to match the name of one of the cObjects from
         the array of cObjects; this cObject is then rendered. If no name
         of a cObject is matched, the cObject from the property "default"
         is rendered.

         This defines the source of the value that will be matched against
         the values of the "array of cObjects". It will generally not be a
         simple string, but use its stdWrap properties to retrieve a
         dynamic value from some specific source, typically a field of the
         current record. See the example below.

   Default
         default


.. container:: table-row

   Property
         *(array of cObjects)*

   Data type
         cObject

   Description
         Array of cObjects. Use this to define cObjects for the different
         values of "key". If "key" has a certain value, the according
         cObject will be rendered.


.. container:: table-row

   Property
         default

   Data type
         cObject

   Description
         Use this to define the rendering for *those* values of "key" that
         do *not* match any of the values of the "array of cObjects".


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         stdWrap around any object that was rendered no matter what the "key"
         value is.


.. ###### END~OF~TABLE ######

[tsref:(cObject).CASE]


.. _cobj-case-examples:

Example:
""""""""

This example chooses between two different renderings of some content
depending on whether the field "layout" is "1" or not ("default"). The
result is in either case wrapped with "\|<br>". If the field
"header" turns out not to be set ("false") an empty string is returned
anyway. ::

   stuff = CASE
   stuff.key.field = layout
   stuff.if.isTrue.field = header

   stuff.1 = TEXT
   stuff.1 {
     ....
   }
   stuff.default = TEXT
   stuff.default {
     ....
   }

   stuff.stdWrap.wrap = |<br>

