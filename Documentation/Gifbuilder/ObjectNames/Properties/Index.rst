..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; Properties
..  _gifbuilder-properties:

==========
Properties
==========

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
         charRangeMap.[array]

   Data type
         string

   Description
         Basename of font file to match for this configuration. Notice that
         only the *filename* of the font file is used - the path is stripped
         off. This is done to make matching easier and avoid problems when font
         files might move to other locations in extensions etc.

         So if you use the font file "EXT:myext/fonts/vera.ttf" or
         "typo3/sysext/install/Resources/Private/Font/vera.ttf" both of them will
         match with this configuration.

         **The key:**

         The value of the array key will be the key used when forcing the
         configuration into "splitRendering" configuration of the individual
         GIFBUILDER objects. In the example below the key is "123".

         Notice: If the key is already found in the local GIFBUILDER
         configuration the content of that key is respected and not overridden.
         Thus you can make local configurations which override the global
         setting.


.. container:: table-row

   Property
         charRangeMap.[array].charMapConfig

   Data type
         TEXT / splitRendering.[array] configuration

   Description
         splitRendering configuration to set. See GIFBUILDER TEXT object for
         details.


.. container:: table-row

   Property
         charRangeMap.[array].fontSizeMultiplicator

   Data type
         double

   Description
         If set, this will take the font size of the TEXT GIFBUILDER object and
         multiply with this amount (xx.xx) and override the "fontSize" property
         inside "charMapConfig".


.. container:: table-row

   Property
         charRangeMap.[array].pixelSpaceFontSizeRef

   Data type
         double

   Description
         If set, this will multiply the four [x/y]Space[Before/After]
         properties of split rendering with the relationship between the
         fontsize and this value.

         In other words: Since pixel space may vary depending on the font size
         used, you can specify by this value at what fontsize the pixel
         space settings are optimized and for other font sizes this will
         automatically be adjusted according to this font size.


.. container:: table-row

   Property
         XY

   Data type
         x,y +calc (1-2000) /:ref:`stdWrap <stdwrap>`

   Default
         120,50

   Description
         Size of the image file.

         For the usage of "calc" see the according note at the beginning of
         the section "GIFBUILDER".


.. _gifbuilder-format:

.. container:: table-row

   Property
         format

   Data type
         "gif" / "jpg" / "jpeg" / "png"

   Default
         gif

   Description
         File type of the output image.

         It is possible to define the quality of a JPG image globally via
         :ref:`$TYPO3_CONF_VARS['GFX']['jpg_quality'] <t3coreapi:typo3ConfVars_gfx_jpg_quality>`
         or via the :ref:`quality <gifbuilder-quality>` property on a per-image
         basis.


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

         **Note:** You may experience that this does not work, if you render
         text with the niceText option.


.. _gifbuilder-quality:

.. container:: table-row

   Property
         quality

   Data type
         positive integer (10-100)

   Description
         JPG-quality (if :ref:`.format <gifbuilder-format>` = jpg/jpeg)


.. container:: table-row

   Property
         backColor

   Data type
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

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
