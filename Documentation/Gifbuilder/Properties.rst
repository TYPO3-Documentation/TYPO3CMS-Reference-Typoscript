..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; Properties
..  _gifbuilder-properties:

==========
Properties
==========

..  contents::
    :local:

..  _gifbuilder-properties-array:

1,2,3,4...
==========

..  confval:: 1,2,3,4...

    :Data type: :ref:`Gifbuilder Object <gifbuilder-object-names>` + .if (:ref:`->if <if>`)

    :typoscript:`.if` is a property of all GIFBUILDER objects. If the property
    is present and **not** set, the object is **not** rendered! This
    corresponds to the functionality of :typoscript:`.if` of the
    :ref:`stdWrap <stdwrap>` function.


.. _gifbuilder-properties-backColor:

backColor
=========

..  confval:: backColor

    :Data type: :t3-data-type:`GraphicColor` / :ref:`stdWrap <stdwrap>`
    :Default: white

    Background color of the image.


..  _gifbuilder-properties-charRangeMap:

charRangeMap
============

..  _gifbuilder-properties-charRangeMap-array:

[array]
-------

..  confval:: charRangeMap.[array]

    :Data type: string

    Basename of font file to match for this configuration. Notice that
    only the *filename* of the font file is used - the path is stripped
    off. This is done to make matching easier and avoid problems when font
    files might move to other locations in extensions etc.

    So if you use the font file
    :file:`EXT:my_extension/Resources/Private/Fonts/vera.ttf` or
    :file:`EXT:install/Resources/Private/Font/vera.ttf` both of them will
    match with this configuration.

    **The key:**

    The value of the array key will be the key used when forcing the
    configuration into :ref:`gifbuilder-text-splitRendering`
    configuration of the individual
    :ref:`GIFBUILDER objects <gifbuilder-object-names>`.
    In the :ref:`gifbuilder-properties-charRangeMap-array`
    example below the key is :typoscript:`123`.

    ..  note::
        If the key is already found in the local GIFBUILDER configuration the
        content of that key is respected and not overridden. Thus you can make
        local configurations which override the global setting.


..  _gifbuilder-properties-charRangeMap-charMapConfig:

[array].charMapConfig
---------------------

..  confval:: charRangeMap.[array].charMapConfig

    :Data type: :ref:`TEXT <gifbuilder-text>` / :ref:`splitRendering.[array] <gifbuilder-text-splitRendering>` configuration

    splitRendering configuration to set.
    See :ref:`GIFBUILDER TEXT object <gifbuilder-text>` for details.


..  _gifbuilder-properties-charRangeMap-fontSizeMultiplicator:

[array].fontSizeMultiplicator
-----------------------------

..  confval:: charRangeMap.[array].fontSizeMultiplicator

    :Data type: double

    If set, this will take the font size of the
    :ref:`GIFBUILDER TEXT object <gifbuilder-text>` and multiply with this
    amount (xx.xx) and override the :ref:`gifbuilder-text-fontSize` property
    inside :ref:`gifbuilder-properties-charRangeMap-charMapConfig`.


..  _gifbuilder-properties-charRangeMap-pixelSpaceFontSizeRef:

[array].pixelSpaceFontSizeRef
-----------------------------

..  confval:: charRangeMap.[array].pixelSpaceFontSizeRef

    :Data type: double

    If set, this will multiply the four [x/y]Space[Before/After]
    properties of split rendering with the relationship between the
    font size and this value.

    In other words: Since pixel space may vary depending on the font size
    used, you can specify by this value at what font size the pixel
    space settings are optimized and for other font sizes this will
    automatically be adjusted according to this font size.

    **Example**:

    ..  code-block:: typoscript

        _GIFBUILDER.charRangeMap {
          123 = arial.ttf
          123 {
            charMapConfig {
              fontFile = EXT:install/Resources/Private/Font/vera.ttf
              value = 48-57
              color = green
              xSpaceBefore = 3
              xSpaceAfter = 3
            }

            pixelSpaceFontSizeRef = 24
          }
        }

    In this example :typoscript:`xSpaceBefore` and :typoscript:`xSpaceAfter`
    will be "3" when the font size is 24. If this configuration is used on a
    :ref:`GIFBUILDER TEXT object <gifbuilder-text>` where the font size is only
    16, the spacing values will be corrected by "16/24", effectively reducing
    the pixel space to "2" in that case.


.. _gifbuilder-properties-format:

format
======

..  confval:: format

    :Data type: "gif" / "jpg" / "jpeg" / "png"
    :Default: gif

    File type of the output image.

    It is possible to define the quality of a JPG image globally via
    :ref:`$TYPO3_CONF_VARS['GFX']['jpg_quality'] <t3coreapi:typo3ConfVars_gfx_jpg_quality>`
    or via the :ref:`gifbuilder-properties-quality` property on a per-image basis.


.. _gifbuilder-properties-maxHeight:

maxHeight
=========

..  confval:: maxHeight

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`

    Maximal height of the image file.


.. _gifbuilder-properties-maxWidth:

maxWidth
========

..  confval:: maxWidth

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`

    Maximal width of the image file.


.. _gifbuilder-properties-offset:

offset
======

..  confval:: offset

    :Data type: x,y :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`
    :Default: 0,0

    Offset all objects on the image.


.. _gifbuilder-properties-quality:

quality
=======

..  confval:: quality

    :Data type: positive integer (10-100)

    JPG quality (if :ref:`gifbuilder-properties-format` = jpg/jpeg)


.. _gifbuilder-properties-reduceColors:

reduceColors
============

..  confval:: reduceColors

    :Data type: integer (1-255) / :ref:`stdWrap <stdwrap>`

    Reduce the number of colors.


.. _gifbuilder-properties-transparentBackground:

transparentBackground
=====================

..  confval:: transparentBackground

    :Data type: boolean / :ref:`stdWrap <stdwrap>`

    Set this flag to render the background transparent. TYPO3 makes the
    color found at position 0,0 of the image (upper left corner) transparent.

    If you render text, you should leave the
    :ref:`gifbuilder-text-niceText` option **off** as the result will
    probably be more precise without the :typoscript:`niceText` antialiasing
    hack.


.. _gifbuilder-properties-transparentColor:

transparentColor
================

..  confval:: transparentColor

    :Data type: :t3-data-type:`GraphicColor` / :ref:`stdWrap <stdwrap>`

    Specify a color that should be transparent.


.. _gifbuilder-properties-transparentColor-closest:

closest
-------

..  confval:: transparentColor.closest

    :Data Type: boolean

    This will allow for the closest color to be matched instead. You may
    need this, if your image is not guaranteed "clean".

    ..  note::
        You may experience that this does not work, if you render text with the
        :ref:`gifbuilder-text-niceText` option.


.. _gifbuilder-properties-workArea:

workArea
========

..  confval:: workArea

    :Data type: x,y,w,h :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Define the work area on the image file. All the
    :ref:`GIFBUILDER objects <gifbuilder-object-names>` will see this as the
    dimensions of the image file regarding alignment, overlaying of images and
    so on. Only :ref:`TEXT objects <gifbuilder-text>` exceeding the boundaries
    of the work area will be printed outside this area.


..  _gifbuilder-properties-XY:

XY
==

..  confval:: XY

    :Data type: x,y :ref:`+calc <gifbuilder-calc>` (1-2000) / :ref:`stdWrap <stdwrap>`
    :Default: 120,50

    Size of the image file.
