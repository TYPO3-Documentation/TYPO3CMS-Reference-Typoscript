..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; TEXT
..  _gifbuilder-text:

====
TEXT
====

Renders a text.

Properties
==========

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
         the GIFBUILDER object is used in TypoScript.


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
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

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
         Font face (truetype \*.ttf and opentype \*.otf font you can upload!)



.. container:: table-row

   Property
         angle

   Data type
         :t3-data-type:`degree`

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
         scaled down adds a more homogeneous shape to the letters. Some fonts
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

         * **splitRendering.compX:** Integer. Additional pixelspace between
           parts, x direction.

         * **splitRendering.compY:** Integer. Additional pixelspace between
           parts, y direction.

         * **splitRendering.[array] = keyword** with keyword being [charRange,
           highlightWord]

         * **splitRendering.[array] {**

           * **fontFile:** Alternative font file for this rendering.

           * **fontSize:** Alternative font size for this rendering.

           * **color:** Alternative color for this rendering, works *only*
             without "niceText".

           * **xSpaceBefore:** x-Space before this part.

           * **xSpaceAfter:** x-Space after this part.

           * **ySpaceBefore:** y-Space before this part.

           * **ySpaceAfter:** y-Space after this part.



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

         **Example:**

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
