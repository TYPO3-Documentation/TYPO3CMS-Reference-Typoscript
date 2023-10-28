..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; EFFECT
..  _gifbuilder-effect:

======
EFFECT
======

Allows you to apply one or more of the following effects to the image.

The EFFECT object only has one property: "value". stdWrap is available for
"value".

Syntax
======

.. code-block:: none
   :caption: Syntax

   20.value = <property> = <value> | <property> = <value>

All effects are defined as properties or property-value pairs inside
"value". Multiple properties or property-value pairs are separated by
"\|".

Example
=======

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   lib.image = IMAGE
   lib.image {
     file = GIFBUILDER
     file {
       XY = 1024,768
       format = jpg

       10 = IMAGE
       10.file = fileadmin/image.jpg

       20 = EFFECT
       20.value = gamma=1.3 | flip | rotate=180
     }
   }

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         gamma

   Data type
         double (0.5 - 3.0)

   Default
         1.0

   Description
         Sets the gamma value.



.. container:: table-row

   Property
         blur

   Data type
         positive integer (1-99)

   Default
         0

   Description
         Blurs the edges inside the image.



.. container:: table-row

   Property
         sharpen

   Data type
         positive integer (1-99)

   Default
         0

   Description
         Sharpens the edges inside the image.



.. container:: table-row

   Property
         solarize

   Data type
         positive integer (0-99)

   Description
         Color reduction, 'burning' the brightest colors black. The
         brighter the color, the darker the solarized color is. This
         happens in photography when chemical film is over exposed.

         The value sets the grayscale level above which the color is
         negated.


.. container:: table-row

   Property
         swirl

   Data type
         positive integer (0-100)

   Default
         0

   Description
         The image is swirled or spun from its center.



.. container:: table-row

   Property
         wave

   Data type
         positive integer,positive integer

   Description
         Provide values for the amplitude and the length of a wave,
         separated by comma. All horizontal edges in the image will
         then be transformed by a wave with the given amplitude and
         length.

         Maximum value for amplitude and length is 100.

         **Example:**

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            20 = EFFECT
            20.value = wave=1,20


.. container:: table-row

   Property
         charcoal

   Data type
         positive integer (0-100)

   Description
         Makes the image look as if it had been drawn with charcoal and defines
         the intensity of that effect.


.. container:: table-row

   Property
         gray

   Data type
         -

   Description
         The image is converted to gray tones.

         **Example:**

         This gives the image a slight wave and renders it in gray.

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            20 = EFFECT
            20.value = wave=1,20 | gray


.. container:: table-row

   Property
         edge

   Data type
         positive integer

   Description
         Detect edges within an image. This is a grey-scale operator, so it is
         applied to each of the three color channels separately. The value defines
         the radius for the edge detection.

.. container:: table-row

   Property
         emboss

   Data type
         -

   Description
         Creates a relief effect: Creates highlights or shadows that replace
         light and dark boundaries in the image.


.. container:: table-row

   Property
         flip

   Data type
         -

   Description
         Vertical flipping.


.. container:: table-row

   Property
         flop

   Data type
         -

   Description
         Horizontal flipping.


.. container:: table-row

   Property
         rotate

   Data type
         positive integer (0-360)

   Default
         0

   Description
         Number of degrees for a clockwise rotation.

         Image dimensions will grow if needed, so that nothing is cut off from
         the original image.



.. container:: table-row

   Property
         colors

   Data type
         positive integer (2-255)

   Description
         Defines the number of different colors to use in the image.


.. container:: table-row

   Property
         shear

   Data type
         integer (-90 - 90)

   Description
         Number of degrees for a horizontal shearing. Horizontal shearing
         slides one edge of the image along the X axis, creating a
         parallelogram. Provide an integer between -90 and 90 for the number
         of degrees.


.. container:: table-row

   Property
         invert

   Data type
         -

   Description
         Invert the colors.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).EFFECT]
