.. include:: ../../Includes.txt


.. _gifbuilder-object-names:

Object names in this section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Whenever you see a reference to anything named an "object" in this
section it's a reference to a "Gifbuilder Object" and not the
"cObjects" from the previous section. Confusion could happen, because
"TEXT" and "IMAGE" are objects in *both* areas; note that they are
different each time!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         1,2,3,4...

   Data type
         Gifbuilder Object \+ .if (->if)

   Description
         .if (->if) is a property of all GIFBUILDER objects. If the property is
         present and **not** set, the object is **not** rendered! This
         corresponds to the functionality of ".if" of the stdWrap-function.


.. container:: table-row

   Property
         XY

   Data type
         x,y +calc /:ref:`stdWrap <stdwrap>`

   Default
         100,20

   Description
         Size of the image file.

         For the usage of "calc" see the according note at the beginning of
         the section "GIFBUILDER".



.. container:: table-row

   Property
         format

   Data type
         "gif" / "jpg"

   Default
         gif

   Description
         Output type.

         "jpg"/"jpeg" = jpg-image



.. container:: table-row

   Property
         reduceColors

   Data type
         positive integer (1-255) /:ref:`stdWrap <stdwrap>`

   Description
         Reduce the number of colors.


.. container:: table-row

   Property
         transparentBackground

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         Set this flag to render the background transparent. TYPO3 makes the
         color found at position 0,0 of the image (upper left corner)
         transparent.

         If you render text, you should leave the niceText option OFF as the
         result will probably be more precise without the niceText antialiasing
         hack.


.. container:: table-row

   Property
         transparentColor

   Data type
         *HTMLColor* /:ref:`stdWrap <stdwrap>`

   Description
         Specify a color that should be transparent

         **Example-values:**

         #ffffcc

         red

         255,255,127

         **Option:**

         transparentColor.closest = 1

         This will allow for the closest color to be matched instead. You may
         need this if you image is not guaranteed "clean".

         **Note:** You may experience that this does not work, if you use the
         reduceColors-option or render text with niceText-option.


.. container:: table-row

   Property
         quality

   Data type
         positive integer (10-100)

   Description
         JPG-quality (if ".format" = jpg/jpeg)


.. container:: table-row

   Property
         backColor

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Default
         white

   Description
         Background color of the image.



.. container:: table-row

   Property
         offset

   Data type
         x,y +calc /:ref:`stdWrap <stdwrap>`

   Default
         0,0

   Description
         Offset all objects on the image.



.. container:: table-row

   Property
         workArea

   Data type
         x,y,w,h + calc /:ref:`stdWrap <stdwrap>`

   Description
         Define the workarea on the image file. All the Gifbuilder Objects will
         see this as the dimensions of the image file regarding alignment,
         overlaying of images an so on. Only TEXT objects exceeding the
         boundaries of the workarea will be printed outside this area.


.. container:: table-row

   Property
         maxWidth

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Maximal width of the image file.


.. container:: table-row

   Property
         maxHeight

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Maximal height of the image file.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER]


.. _gifbuilder-text:

TEXT
""""

Renders a text.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         text

   Data type
         ->stdWrap

   Description
         This is text text-string on the image file. The item is rendered only
         if this string is not empty.

         The $cObj->data-array is loaded with the page-record, if for example
         the GIFBUILDER object is used by GMENU or IMGMENU.


.. container:: table-row

   Property
         breakWidth

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Defines the maximum width for an object, overlapping elements will
         force an automatic line break.


.. container:: table-row

   Property
         breakSpace

   Data type
         float

   Default
         1.0

   Description
         Defines a value that is multiplied by the line height of the current
         element.



.. container:: table-row

   Property
         textMaxLength

   Data type
         integer

   Default
         100

   Description
         The maximum length of the text. This is just a natural break that
         prevents incidental rendering of very long texts!



.. container:: table-row

   Property
         maxWidth

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Sets the maximum width in pixels, the text must be. Reduces the
         fontSize if the text does not fit within this width.

         Does not support setting alternative fontSizes in splitRendering
         options.

         (By René Fritz <r.fritz@colorcube.de>)


.. container:: table-row

   Property
         doNotStripHTML

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, HTML-tags in the string inserted are **not** removed. Any
         other way HTML code is removed by default!



.. container:: table-row

   Property
         fontSize

   Data type
         positive integer /:ref:`stdWrap <stdwrap>`

   Default
         12

   Description
         Font size



.. container:: table-row

   Property
         fontColor

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Default
         black

   Description
         Font color



.. container:: table-row

   Property
         fontFile

   Data type
         resource /:ref:`stdWrap <stdwrap>`
         
   Default
         Nimbus (Arial-clone)         

   Description
         Font face (truetype *.ttf and opentype *.otf font you can upload!)



.. container:: table-row

   Property
         angle

   Data type
         degree

   Default
         0

         Range: -90 til 90

   Description
         Rotation degrees of the text.

         **Note:** Angle is not available if spacing/wordSpacing is set.



.. container:: table-row

   Property
         align

   Data type
         align /:ref:`stdWrap <stdwrap>`

   Default
         left

   Description
         Alignment of the text



.. container:: table-row

   Property
         offset

   Data type
         x,y +calc /:ref:`stdWrap <stdwrap>`

   Default
         0,0

   Description
         Offset of the text



.. container:: table-row

   Property
         antiAlias

   Data type
         boolean

   Default
         1 (true)

   Description
         FreeType antialiasing. Notice, the default mode is "on"!

         **Note:** This option is not available if .niceText is enabled.

         **Note:** setting this option to 0 will not work if *fontColor* is set to black (or #000000).




.. container:: table-row

   Property
         iterations

   Data type
         positive integer /:ref:`stdWrap <stdwrap>`

   Default
         1

   Description
         How many times the text should be "printed" onto it self. This will
         add the effect of bold text.

         **Note:** This option is not available if .niceText is enabled.



.. container:: table-row

   Property
         spacing

   Data type
         positive integer /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         Pixel-distance between letters. This may render ugly!



.. container:: table-row

   Property
         wordSpacing

   Data type
         positive integer /:ref:`stdWrap <stdwrap>`

   Default
         = ".spacing"\*2

   Description
         Pixel-distance between words.



.. container:: table-row

   Property
         hide

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         If this is true, the text is **not** printed.

         This feature may be used, if you need a SHADOW object to base a shadow
         on the text, but do not want the text to be displayed.



.. container:: table-row

   Property
         hideButCreateMap

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If this option is set, the text will not be rendered. Shadows and
         emboss will, though, so don't apply these! But this feature is also
         meant only to enable a text to generate the imageMap coordinates
         without rendering itself.


.. container:: table-row

   Property
         emboss

   Data type
         Gifbuilder Object->EMBOSS


.. container:: table-row

   Property
         shadow

   Data type
         Gifbuilder Object->SHADOW


.. container:: table-row

   Property
         outline

   Data type
         Gifbuilder Object->OUTLINE


.. container:: table-row

   Property
         imgMap

   Data type
         ->IMGMAP

         ->stdWrap properties for "altText" and "titleText" in this case


.. container:: table-row

   Property
         niceText

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         This is a very popular feature that helps to render small letters much
         nicer than the freetype library can normally do. But it also loads the
         system very much!

         The principle of this function is to create a black/white image file
         in twice or more times the size of the actual image file and then
         print the text onto this in a scaled dimension. Afterwards
         GraphicsMagick/ImageMagick scales down the mask and masks the font
         color down on the original image file through the temporary mask.

         The fact that the font is actually rendered in the double size and
         scaled down adds a more homogenous shape to the letters. Some fonts
         are more critical than others though. If you do not need the quality,
         then don't use the function.

         **Some sub-properties:**

         .before = GraphicsMagick/ImageMagick-params before scale

         .after = GraphicsMagick/ImageMagick-params after scale

         .sharpen = sharpen-value for the mask (after scaling), integer 0-99
         (this enables you to make the text crisper if it's too blurred!)

         .scaleFactor = scaling-factor, integer 2-5


.. container:: table-row

   Property
         splitRendering.compX

         splitRendering.compY

         splitRendering.[array]

   Data type
         integer / *(array of keys)*

   Description
         Split the rendering of a string into separate processes with
         individual configurations. By this method a certain range of
         characters can be rendered with another font face or size. This is
         very useful if you want to use separate fonts for strings where you
         have latin characters combined with e.g. Japanese and there is a
         separate font file for each.

         You can also render keywords in another font/size/color.

         **Properties:**

         **splitRendering.compX:** Integer. Additional pixelspace between
         parts, x direction.

         **splitRendering.compY:** Integer. Additional pixelspace between
         parts, y direction.

         **splitRendering.[array] = keyword** with keyword being [charRange,
         highlightWord]

         **splitRendering.[array] {**

            **fontFile:** Alternative font file for this rendering.

            **fontSize:** Alternative font size for this rendering.

            **color:** Alternative color for this rendering, works *only*
            without "niceText".

            **xSpaceBefore:** x-Space before this part.

            **xSpaceAfter:** x-Space after this part.

            **ySpaceBefore:** y-Space before this part.

            **ySpaceAfter:** y-Space after this part.

         }

         **Keyword: charRange**

         splitRendering.[array].value = Comma-separated list of character ranges
         (e.g. "100-200") given as Unicode character numbers. The list accepts
         optional starting and ending points, e.g. " - 200" or " 200 -" and
         single values, e.g. "65, 66, 67".

         **Keyword: highlightWord**

         splitRendering.[array].value = Word to highlight, makes a case
         sensitive search for this.

         **Limitations:**

         - The pixel compensation values are not corrected for scale factor used
           with niceText. Basically this means that when niceText is used, these
           values will have only the half effect.

         - When word spacing is used the "highlightWord" mode does not work.

         - The color override works only without "niceText".

         **Example:** ::

            10.splitRendering.compX = 2
            10.splitRendering.compY = -2
            10.splitRendering.10 = charRange
            10.splitRendering.10 {
              value = 200-380 , 65, 66
              fontSize = 50
              fontFile = typo3/sysext/core/Resources/Private/Font/nimbus.ttf
              xSpaceBefore = 30
            }
            10.splitRendering.20 = highlightWord
            10.splitRendering.20 {
              value = TheWord
              color = red
            }


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).TEXT]


.. _gifbuilder-shadow:

SHADOW
""""""

Creates a shadow under the associated text.

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
         The offset of the shadow.


.. container:: table-row

   Property
         color

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Description
         The color of the shadow.


.. container:: table-row

   Property
         blur

   Data type
         positive integer (1-99) /:ref:`stdWrap <stdwrap>`

   Description
         Blurring of the shadow. Above 40 only values of 40,50,60,70,80,90 mean
         something.


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
         How "massive" the shadow is. This value can - if it has a high value
         combined with a blurred shadow - create a kind of soft-edged outline.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).SHADOW]


.. _gifbuilder-emboss:

EMBOSS
""""""

Our emboss are actually two shadows offset in opposite directions and with
different colors as to create an effect of light cast onto an embossed
text.

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
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Description
         Upper border-color


.. container:: table-row

   Property
         lowColor

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

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


.. _gifbuilder-outline:

OUTLINE
"""""""

Creates a colored contour line around the shapes of the associated text.

This outline normally renders quite ugly as it's done by printing 4 or
8 texts underneath the text in question. Try to use a shadow with a
high intensity instead. That works better!

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
         thickness

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Description
         Thickness in each direction, range 1-2


.. container:: table-row

   Property
         color

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Description
         Outline color


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).OUTLINE]


.. _gifbuilder-box:

BOX
"""

Prints a filled box.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         dimensions

   Data type
         x,y,w,h +calc /:ref:`stdWrap <stdwrap>`

   Description
         Dimensions of a filled box.

         x,y is the offset.

         w,h are the dimensions. Dimensions of 1 will result in 1-pixel wide
         lines!


.. container:: table-row

   Property
         color

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Default
         black

   Description
         Fill color of the box.



.. container:: table-row

   Property
         opacity

   Data type
         positive integer (1-100) /:ref:`stdWrap <stdwrap>`

   Default
         100

   Description
         The degree to which the box conceals the background. Mathematically
         speaking: Opacity = Transparency^-1. E.g. 100% opacity = 0%
         transparency.



.. container:: table-row

   Property
         align

   Data type
         VHalign /:ref:`stdWrap <stdwrap>`

   Default
         l, t

   Description
         Pair of values, which defines the horizontal and vertical alignment of
         the box in the image.

         **Values:**

         Horizontal alignment: r/c/l standing for right, center, left

         Vertical alignment: t/c/b standing for top, center, bottom

         **Example:**

         Horizontally centered, vertically at the bottom::

            align = c, b



.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).BOX]


.. _gifbuilder-ellipse:

ELLIPSE
"""""""

Prints a filled ellipse.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         dimensions

   Data type
         x,y,w,h +calc /:ref:`stdWrap <stdwrap>`

   Description
         Dimensions of a filled ellipse.

         x,y is the offset.

         w,h are the dimensions. Dimensions of 1 will result in 1-pixel wide
         lines!


.. container:: table-row

   Property
         color

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Default
         black

   Description
         Fill color of the ellipse.



.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).ELLIPSE]


Example:
~~~~~~~~

::

   file = GIFBUILDER
   file {
     XY = 200,200
     format = jpg
     quality = 100
     10 = ELLIPSE
     10.dimensions = 100,100,50,50
     10.color = red
   }


.. _gifbuilder-image:

IMAGE
"""""

Renders an image file.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         imgResource

   Description
         The image file.


.. container:: table-row

   Property
         offset

   Data type
         x,y +calc /:ref:`stdWrap <stdwrap>`

   Default
         0,0

   Description
         Offset of the image



.. container:: table-row

   Property
         tile

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Description
         Repeat the image x,y times (which creates the look of tiles).

         Maximum number of times in each direction is 20. If you need more,
         use a larger image.


.. container:: table-row

   Property
         align

   Data type
         VHalign /:ref:`stdWrap <stdwrap>`

   Description
         *See in the "Data types reference" at the beginning of this document
         or in the table "BOX".*


.. container:: table-row

   Property
         mask

   Data type
         imgResource

   Description
         Optional mask-image for the image file.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).IMAGE]


.. _gifbuilder-effect:

EFFECT
""""""

Allows you to apply one or more of the following effects to the image.

The EFFECT object only has one property: "value". stdWrap is available for
"value".

Syntax:
~~~~~~~

::

   .value = [Property] = [value] | [Property] = [value]

All effects are defined as properties or property-value pairs inside
"value". Multiple properties or property-value pairs are separated by
"\|".

Example:
~~~~~~~~

::

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

         **Example:** ::

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

         This gives the image a slight wave and renders it in gray. ::

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


.. _gifbuilder-workarea:

WORKAREA
""""""""

Sets another workarea.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         set

   Data type
         x,y,w,h + calc /:ref:`stdWrap <stdwrap>`

   Description
         Sets the dimensions of the workarea.

         x,y is the offset.

         w,h are the dimensions.

         For the usage of "calc" see the according note at the beginning of the
         section "GIFBUILDER".


.. container:: table-row

   Property
         clear

   Data type
         string

   Description
         Sets the current workarea to the default workarea.

         The value is checked for using isset(): If isset() returns TRUE, the
         workarea is cleared, otherwise it is not.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).WORKAREA]


.. _gifbuilder-crop:

CROP
""""

**Note:** This object resets workArea to the new dimensions of the
image!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         backColor

   Data type
         GraphicColor /:ref:`stdWrap <stdwrap>`

   Default
         The original backColor

   Description
         *See "Data types reference".*



.. container:: table-row

   Property
         align

   Data type
         VHalign /:ref:`stdWrap <stdwrap>`

   Default
         l, t

   Description
         Horizontal and vertical alignment of the crop frame.

         *See "Data types reference".*



.. container:: table-row

   Property
         crop

   Data type
         x,y,w,h + calc /:ref:`stdWrap <stdwrap>`

   Description
         x,y is the offset of the crop-frame from the position specified by
         "align".

         w,h are the dimensions of the frame.

         For the usage of "calc" see the according note at the beginning of the
         section "GIFBUILDER".


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).CROP]


.. _gifbuilder-scale:

SCALE
"""""

This scales the GIFBUILDER object to the provided dimensions.

**Note:** This object resets workArea to the new dimensions of the
image!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         width

   Data type
         pixels + calc /:ref:`stdWrap <stdwrap>`

   Description
         Width of the scaled image.


.. container:: table-row

   Property
         height

   Data type
         pixels + calc /:ref:`stdWrap <stdwrap>`

   Description
         Height of the scaled image.


.. container:: table-row

   Property
         params

   Data type
         GraphicsMagick/ImageMagick parameters

   Description
         Parameters to be used for the processing.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).SCALE]


.. _gifbuilder-adjust:

ADJUST
""""""

This lets you adjust the tonal range like in the "levels"-dialog of
Photoshop. You can set the input- and output-levels and that way remap
the tonal range of the image. If you need to adjust the gamma value,
have a look at the EFFECT object.


Example:
~~~~~~~~

::

   20 = ADJUST
   20.value = inputLevels = 13, 230

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         inputLevels

   Data type
         low, high

   Description
         With this option you can remap the tone of the image to make shadows
         darker, highlights lighter and increase contrast.

         Possible values for "low" and "high" are integers between 0 and 255,
         where "high" must be higher than "low".

         The value "low" will then be remapped to a tone of 0, the value "high"
         will be remapped to 255.

         **Example:**

         This example will cause the tonal range of the resulting image to
         begin at 50 of the original (which is set as 0 for the new image) and
         to end at 190 of the original (which is set as 255 for the new image). ::

            20 = ADJUST
            20.value = inputLevels = 50, 190


.. container:: table-row

   Property
         outputLevels

   Data type
         low, high

   Description
         With this option you can remap the tone of the image to make shadows
         lighter, highlights darker and decrease contrast.

         Possible values for "low" and "high" are integers between 0 and 255,
         where "high" must be higher than "low".

         The beginning of the tonal range, which is 0, will then be remapped to
         the value "low", the end, which is 255, will be remapped to the value
         "high".

         **Example:**

         This example will cause the resulting image to have a tonal range,
         where there is no pixel with a tone below 50 and no pixel with a tone
         above 190 in the image. ::

            20 = ADJUST
            20.value = outputLevels = 50, 190


.. container:: table-row

   Property
         autoLevels

   Data type
         -

   Description
         Sets the levels automatically.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).ADJUST]

