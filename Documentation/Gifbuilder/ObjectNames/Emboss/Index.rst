..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; EMBOSS
..  _gifbuilder-emboss:

======
EMBOSS
======

Our emboss are actually two shadows offset in opposite directions and with
different colors as to create an effect of light cast onto an embossed
text.

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         textObjNum

   Data type
         positive integer /:ref:`stdWrap <stdwrap>`

   Description
         Must point to the TEXT object if these shadow properties are not
         properties to a TEXT object directly ("stand-alone shadow"). Then the
         shadow needs to know which TEXT object it should be a shadow of!

         If - on the other hand - the shadow is a property to a TEXT object,
         this property is not needed.


.. container:: table-row

   Property
         offset

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Description
         Offset of the emboss.


.. container:: table-row

   Property
         highColor

   Data type
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

   Description
         Upper border-color


.. container:: table-row

   Property
         lowColor

   Data type
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

   Description
         lower border-color


.. container:: table-row

   Property
         blur

   Data type
         positive integer (1-99) /:ref:`stdWrap <stdwrap>`

   Description
         Blurring of the shadow. Above 40 only values of 40,50,60,70,80,90
         means something.


.. container:: table-row

   Property
         opacity

   Data type
         positive integer (1-100) /:ref:`stdWrap <stdwrap>`

   Description
         The degree to which the shadow conceals the background. Mathematically
         speaking: Opacity = Transparency^-1. E.g. 100% opacity = 0%
         transparency.

         Only active with a value for blur.


.. container:: table-row

   Property
         intensity

   Data type
         positive integer (0-100) /:ref:`stdWrap <stdwrap>`

   Description
         How "massive" the emboss is. This value can - if it has a high value
         combined with a blurred shadow - create a kind of soft-edged outline.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).EMBOSS]
