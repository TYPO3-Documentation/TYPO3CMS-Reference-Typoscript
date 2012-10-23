

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


GIFBUILDER
^^^^^^^^^^

GIFBUILDER is an object, which is used in many situations for creating
gif-files. Anywhere the ->GIFBUILDER object is mentioned, these are
the properties that apply.

Using TypoScript you can define a "numerical array" of "GIFBUILDER
OBJECTS" (like "TEXT", "IMAGE", etc.) and they will be rendered onto
an image one by one.

The name "GIFBUILDER" comes from the time where GIF was the only file
format supported. PNG and JPG are just as well to create today
(configured with $TYPO3\_CONF\_VARS['GFX']).


NOTE (+calc)
""""""""""""

Whenever the "+calc"-function is added to a value in the data type of
the properties underneath, you can use the dimensions of TEXT and
IMAGE-objects from the GifBuilderObj-array. This is done by inserting
a tag like this: "[10.w]" or "[10.h]", where "10" is the
GifBuilderObj-number in the array and "w"/"h" signifies either width
or height of the object.

The special property "lineHeight" (e.g. "[10.lineHeight]") uses the
height a single line of text would take.

On using the special function max(), the maximum of multiple values
can be determined. Example:

::

   XY: [10.w]+[20.w], max([10.h], [20.h])

Here's a full example (taken from "styles.content (default)"):

::

   styles.header.gfx1 = IMAGE
   styles.header.gfx1 {
     wrap = {$styles.header.gfx1.wrap}
     file = GIFBUILDER
     file {
       XY = [10.w]+10 ,{$styles.header.gfx1.itemH}
       backColor = {$styles.header.gfx1.bgCol}
       reduceColors = {$styles.header.gfx1.reduceColors}
       10 = TEXT
       10 {
         text.current = 1
         text.crop = {$styles.header.gfx1.maxChars}
         fontSize = {$styles.header.gfx1.fontSize}
         fontFile = {$styles.header.gfx1.file.fontFile}
         fontColor = {$styles.header.gfx1.fontColor}
         offset = {$styles.header.gfx1.fontOffset}
       }
     }
   }

As you see, the gif-image has a width defined as the width of the text
printed onto it + 10 pixels. The height is fixed by the value of the
constant {$styles.header.gfx1.itemH}


The "\_GIFBUILDER" Top Level Object
"""""""""""""""""""""""""""""""""""

You can configure some global settings for GIFBUILDER by a top level
object named "\_GIFBUILDER". One of the available properties of the
global GIFBUILDER configuration is "charRangeMap".

.charRangeMap

By this property you can globally configure mapping of font files for
certain character ranges. For instance you might need GIFBUILDER to
produce gif files with a certain font for latin characters while you
need to use another true type font for Japanese glyphs. So what you
need is to specify the usage of another font file when characters fall
into another range of Unicode values.

In the GIFBUILDER object this is possible with the "splitRendering"
option but if you have hundreds of GIFBUILDER objects around your site
it is not very efficient to add 5-10 lines of configuration for each
time you render text. Therefore this global setting allows you to
match the basename of the main font face with an alternative font.

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
         [array]
   
   Data type
         string
   
   Description
         Basename of font file to match for this configuration. Notice that
         only the  *filename* of the font file is used - the path is stripped
         off. This is done to make matching easier and avoid problems when font
         files might move to other locations in extensions etc.
         
         So if you use the font file "EXT:myext/fonts/vera.ttf" or
         "t3lib/fonts/vera.ttf" both of them will match with this
         configuration.
         
         **The key:**
         
         The value of the array key will be the key used when forcing the
         configuration into "splitRendering" configuration of the individual
         GIFBUILDER objects. In the example below the key is "123".
         
         Notice; If the key is already found in the local GIFBUILDER
         configuration the content of that key is respected and not overridden.
         Thus you can make local configurations which override the global
         setting.
         
         **Example:**
         
         ::
         
            _GIFBUILDER.charRangeMap {
              123 = vera.ttf
            ....
   
   Default


.. container:: table-row

   Property
         [array].charMapConfig
   
   Data type
         TEXT / splitRendering.[array] configuration
   
   Description
         splitRendering configuration to set. See GIFBUILDER TEXT object for
         details.
         
         **Example:**
         
         ::
         
            _GIFBUILDER.charRangeMap {
              123 = arial.ttf
              123 {
                charMapConfig {
                  fontFile = t3lib/fonts/vera.ttf
                  value = -65
                  fontSize = 45
                }
                fontSizeMultiplicator = 2.3
              }
            }
         
         This example configuration shows that GIFBUILDER TEXT objects with
         font faces matching "arial.ttf" will have a splitConfiguration that
         uses "t3lib/fonts/vera.ttf" for all characters that fall below/equal
         to 65 in Unicode value.
   
   Default


.. container:: table-row

   Property
         [array].fontSizeMultiplicator
   
   Data type
         double
   
   Description
         If set, this will take the font size of the TEXT GIFBUILDER object and
         multiply with this amount (xx.xx) and override the "fontSize" property
         inside "charMapConfig".
   
   Default


.. container:: table-row

   Property
         [array].pixelSpaceFontSizeRef
   
   Data type
         double
   
   Description
         If set, this will multiply the four [x/y]Space[Before/After]
         properties of split rendering with the relationship between the
         fontsize and this value.
         
         In other words; Since pixel space may vary depending on the font size
         used you can simply specify by this value at what fontsize the pixel
         space settings are optimized and for other fontsizes this will
         automatically be adjusted according to this font size.
         
         **Example:**
         
         ::
         
            _GIFBUILDER.charRangeMap {
              123 = arial.ttf
              123 {
                charMapConfig {
                  fontFile = t3lib/fonts/vera.ttf
                  value = 48-57
                  color = green
                  xSpaceBefore = 3
                  xSpaceAfter = 3
                }
                pixelSpaceFontSizeRef = 24
              }
            }
         
         In this example xSpaceBefore and xSpaceAfter will be "3" when the font
         size is 24. If this configuration is used on a GIFBUILDER TEXT object
         where the font size is only 16, the spacing values will be corrected
         by "16/24", effectively reducing the pixelspace to "2" in that case.
   
   Default


.. ###### END~OF~TABLE ######

[tsref:\_GIFBUILDER.charRangeMap]

