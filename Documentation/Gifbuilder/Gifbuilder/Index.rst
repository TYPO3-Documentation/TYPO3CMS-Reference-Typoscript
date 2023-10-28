..  include:: /Includes.rst.txt
..  index:: GIFBUILDER
..  _gifbuilder:

==========
GIFBUILDER
==========

:typoscript:`GIFBUILDER` is an object type, which is used in many situations for
creating image files (for example, GIF, PNG or JPG). Wherever the
->GIFBUILDER object type is mentioned, these are the properties that apply.

Using TypoScript, you can define a "numerical array" of
:ref:`GIFBUILDER objects <gifbuilder-object-names>` (like
:ref:`TEXT <gifbuilder-text>`, :ref:`IMAGE <gifbuilder-image>`, etc.)
and they will be rendered onto an image one by one.

The name :typoscript:`GIFBUILDER` comes from the time when GIF was the only
supported file format. PNG and JPG can be created as well today (configured with
:ref:`$TYPO3_CONF_VARS['GFX'] <t3coreapi:typo3ConfVars_gfx>`).


.. _gifbuilder-calc:

Note on (+calc)
===============

Whenever the :ref:`+calc <calc>` function is added to a value in the data type
of the properties underneath, you can use the dimensions of
:ref:`TEXT <gifbuilder-text>` and :ref:`IMAGE <gifbuilder-image>` objects from
the :typoscript:`GIFBUILDER` object array. This is done by inserting a tag like
this: :typoscript:`[10.w]` or :typoscript:`[10.h]`, where `10` is the
:typoscript:`GIFBUILDER` object number in the array and `w`/`h` signifies either
width or height of the object.

The special property :typoscript:`lineHeight` (for example,
:typoscript:`[10.lineHeight]`) uses the height a single line of text would take.

On using the special function :typoscript:`max()`, the maximum of multiple
values can be determined. Example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    XY = [10.w]+[20.w], max([10.h], [20.h])

Here is a full example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript
    :emphasize-lines: 5

    lib.example = IMAGE
    lib.example {
      file = GIFBUILDER
      file {
      XY = [10.w]+20, [10.h]+20
      backColor = #ff8700
      format = png

      10 = TEXT
      10 {
        text = TYPO3 GIFBUILDER Example
        fontSize = 20
        fontColor = #ffffff
        offset = 10,25
      }
    }

As you see, the image has a width/height defined as the width/height of the text
printed onto it + 20 pixels.

The generated image looks like:

..  figure:: /Images/ManualScreenshots/FrontendOutput/Gifbuilder/typo3-gifbuilder-example.png
    :class: with-shadow
    :alt: TYPO3 GIFBUILDER Example

    The rendered image from the example above


.. index:: GIFBUILDER; Top level object
.. _gifbuilder-top-level-object:
.. _tlo-gifbuilder:

\_GIFBUILDER top level object
=============================

You can configure some global settings for GIFBUILDER by a top-level
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
         [array]

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

         **Example:** :

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            _GIFBUILDER.charRangeMap {
              123 = vera.ttf
            ....


.. container:: table-row

   Property
         [array].charMapConfig

   Data type
         TEXT / splitRendering.[array] configuration

   Description
         splitRendering configuration to set. See GIFBUILDER TEXT object for
         details.

         **Example:** :

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            _GIFBUILDER.charRangeMap {
              123 = arial.ttf
              123 {
                charMapConfig {
                  fontFile = typo3/sysext/install/Resources/Private/Font/vera.ttf
                  value = -65
                  fontSize = 45
                }
                fontSizeMultiplicator = 2.3
              }
            }

         This example configuration shows that GIFBUILDER TEXT objects with
         font faces matching "arial.ttf" will have a splitConfiguration that
         uses "typo3/sysext/install/Resources/Private/Font/vera.ttf" for all
         characters that fall below/equal to 65 in Unicode value.


.. container:: table-row

   Property
         [array].fontSizeMultiplicator

   Data type
         double

   Description
         If set, this will take the font size of the TEXT GIFBUILDER object and
         multiply with this amount (xx.xx) and override the "fontSize" property
         inside "charMapConfig".


.. container:: table-row

   Property
         [array].pixelSpaceFontSizeRef

   Data type
         double

   Description
         If set, this will multiply the four [x/y]Space[Before/After]
         properties of split rendering with the relationship between the
         fontsize and this value.

         In other words: Since pixel space may vary depending on the font size
         used you can simply specify by this value at what fontsize the pixel
         space settings are optimized and for other fontsizes this will
         automatically be adjusted according to this font size.

         **Example:** :

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            _GIFBUILDER.charRangeMap {
              123 = arial.ttf
              123 {
                charMapConfig {
                  fontFile = typo3/sysext/install/Resources/Private/Font/vera.ttf
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


.. ###### END~OF~TABLE ######

[tsref:\_GIFBUILDER.charRangeMap]

