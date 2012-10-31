.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _textstyle:

textStyle
^^^^^^^^^

This is used to style text with a bunch of standard options + some
site-specific.

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
         align.field

   Data type
         align

   Description
         Set to field name from the $cObj->data-array

   Default


.. container:: table-row

   Property
         face.field

   Data type
         string

   Description
         Set to field name from the $cObj->data-array

         [1] = "Times New Roman";

         [2] = "Verdana,Arial,Helvetica,Sans serif";

         [3] = "Arial,Helvetica,Sans serif";

   Default


.. container:: table-row

   Property
         face.default

   Data type
         string /stdWrap

   Description
         [default] = User defined

   Default


.. container:: table-row

   Property
         size.field

   Data type
         string

   Description
         Set to field name from the $cObj->data-array

         [1] = 1;

         [2] = 2;

         [3] = 3;

         [10] = "+1";

         [11] = "-1";

   Default


.. container:: table-row

   Property
         size.default

   Data type
         string /stdWrap

   Description
         [default] = User defined

   Default


.. container:: table-row

   Property
         color.field

   Data type
         string

   Description
         Set to field name from the $cObj->data-array

         See "content.php" for the colors available

   Default


.. container:: table-row

   Property
         color.default

   Data type
         string /stdWrap

   Description
         [default] = User defined

   Default


.. container:: table-row

   Property
         color.1

         color.2

   Data type
         string

   Description
         [1],[2] = User defined

   Default


.. container:: table-row

   Property
         properties.field

   Data type
         int

   Description
         Set to field name from the $cObj->data-array

         The property values goes like this:

         bit 0: <B>

         bit 1: <I>

         bit 2: <U>

         bit 3: (uppercase)

         Thus a value of 5 would result in bold and underlined text

   Default


.. container:: table-row

   Property
         properties.default

   Data type
         int /stdWrap

   Description
         [default] = User defined (This value will be used whenever ".field" is
         false!)

   Default


.. container:: table-row

   Property
         altWrap

   Data type
         wrap

   Description
         If this value is set, the wrapping with a font-tag based on font,size
         and color is NOT done. Rather the element is wrapped with this value.

         Use it to assign a stylesheet by setting this value to eg.

         <div class="text"> \| </div>

   Default


.. ###### END~OF~TABLE ######

[tsref:->textStyle]

