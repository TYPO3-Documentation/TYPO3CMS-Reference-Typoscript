..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; TEXT
..  _gifbuilder-text:

====
TEXT
====

Renders a text.


Properties
==========

..  contents::
    :local:


..  _gifbuilder-text-align:

align
-----

..  t3-gifbuilder-text:: align

    :Data type: align / :ref:`stdWrap <stdwrap>`
    :Default: left

    The alignment of the :t3-gifbuilder-text:`text`.

    Possible values:

    *   :typoscript:`left`
    *   :typoscript:`center`
    *   :typoscript:`right`


..  _gifbuilder-text-angle:

angle
-----

..  t3-gifbuilder-text:: angle

    :Data type: :t3-data-type:`degree`
    :Default: 0
    :Range: -90 to 90

    The rotation degree of the :t3-gifbuilder-text:`text`.

    ..  note::
        The angle is not available, if :t3-gifbuilder-text:`spacing`
        / :t3-gifbuilder-text:`wordSpacing` is set.


..  _gifbuilder-text-antiAlias:

antiAlias
---------

..  t3-gifbuilder-text:: antiAlias

    :Data type: boolean
    :Default: 1 (true)

    The FreeType antialiasing.

    ..  note::
        This option is not available, if
        :t3-gifbuilder-text:`niceText` is enabled.

        Setting this option to :typoscript:`0` will not work, if
        :t3-gifbuilder-text:`fontColor` is set to black (or #000000).


..  _gifbuilder-text-breakSpace:

breakSpace
----------

..  t3-gifbuilder-text:: breakSpace

    :Data type: float
    :Default: 1.0

    Defines a value that is multiplied by the line height of the current
    element.


..  _gifbuilder-text-breakWidth:

breakWidth
----------

..  t3-gifbuilder-text:: breakWidth

    :Data type: integer / :ref:`stdWrap <stdwrap>`

    Defines the maximum width for an object, overlapping elements will
    force an automatic line break.


..  _gifbuilder-text-doNotStripHTML:

doNotStripHTML
--------------

..  t3-gifbuilder-text:: doNotStripHTML

    :Data type: boolean
    :Default: 0 (false)

    If set, HTML tags inserted in the :t3-gifbuilder-text:`text` are
    **not** removed. Any other HTML code will be removed by default!


..  _gifbuilder-text-emboss:

emboss
------

..  t3-gifbuilder-text:: emboss

    :Data type: GIFBUILDER object :ref:`->EMBOSS <gifbuilder-emboss>`


..  _gifbuilder-text-fontColor:

fontColor
---------

..  t3-gifbuilder-text:: fontColor

    :Data type: :t3-data-type:`GraphicColor` / :ref:`stdWrap <stdwrap>`
    :Default: black

    The font color.


..  _gifbuilder-text-fontFile:

fontFile
--------

..  t3-gifbuilder-text:: fontFile

    :Data type: resource / :ref:`stdWrap <stdwrap>`
    :Default: Nimbus (Arial clone)

    The font face (TrueType :file:`*.ttf` and OpenType :file:`*.otf` fonts can be
    used).


..  _gifbuilder-text-fontSize:

fontSize
--------

..  t3-gifbuilder-text:: fontSize

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`
    :Default: 12

    The font size.


..  _gifbuilder-text-hide:

hide
----

..  t3-gifbuilder-text:: hide

    :Data type: boolean / :ref:`stdWrap <stdwrap>`
    :Default: 0 (false)

    If this is true, the text is **not** printed.

    This feature may be used, if you need a :ref:`SHADOW <gifbuilder-shadow>`
    object to base a shadow on the text, but do not want the text to be
    displayed.


..  _gifbuilder-text-iterations:

iterations
----------

..  t3-gifbuilder-text:: iterations

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`
    :Default: 1

    How many times the :t3-gifbuilder-text:`text` should be "printed"
    onto it self. This will add the effect of bold text.

    ..  note::
        This option is not available, if
        :t3-gifbuilder-text:`niceText` is enabled.


..  _gifbuilder-text-maxWidth:

maxWidth
--------

..  t3-gifbuilder-text:: maxWidth

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`

    Sets the maximum width in pixels, the :t3-gifbuilder-text:`text`
    must be. Reduces the :t3-gifbuilder-text:`fontSize`, if the
    text does not fit within this width.

    Does not support setting alternative font sizes in
    :t3-gifbuilder-text:`splitRendering` options.


..  _gifbuilder-text-niceText:

niceText
--------

..  t3-gifbuilder-text:: niceText

    :Data type: boolean / :ref:`stdWrap <stdwrap>`

    This is a very popular feature that helps to render small letters much nicer
    than the FreeType library can normally do. But it also loads the system
    very much!

    The principle of this function is to create a black/white image file in
    twice or more times the size of the actual image file and then print the
    text onto this in a scaled dimension. Afterwards GraphicsMagick/ImageMagick
    scales down the mask and masks the :t3-gifbuilder-text:`fontColor` down on
    the original image file through the temporary mask.

    The fact that the font is actually rendered in the double size and
    scaled down adds a more homogeneous shape to the letters. Some fonts
    are more critical than others though. If you do not need the quality,
    then do not use the function.


..  _gifbuilder-text-niceText-after:

after
~~~~~

..  t3-gifbuilder-text:: niceText.after

    GraphicsMagick/ImageMagick parameters after scale.


..  _gifbuilder-text-niceText-before:

before
~~~~~~

..  t3-gifbuilder-text:: niceText.before

    GraphicsMagick/ImageMagick parameters before scale.


..  _gifbuilder-text-niceText-scaleFactor:

scaleFactor
~~~~~~~~~~~

..  t3-gifbuilder-text:: niceText.scaleFactor

    :Data type: integer (2-5)

    The scaling factor.


..  _gifbuilder-text-niceText-sharpen:

sharpen
~~~~~~~

..  t3-gifbuilder-text:: niceText.sharpen

    :Data type: integer (0-99)

    The sharpen value for the mask (after scaling). This enables you to make the
    text crisper, if it is too blurred!


..  _gifbuilder-text-offset:

offset
------

..  t3-gifbuilder-text:: offset

    :Data type: x,y :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`
    :Default: 0,0

    The offset of the :t3-gifbuilder-text:`text`.


..  _gifbuilder-text-outline:

outline
-------

..  t3-gifbuilder-text:: outline

    :Data type: GIFBUILDER object :ref:`->OUTLINE <gifbuilder-outline>`


..  _gifbuilder-text-shadow:

shadow
------

..  t3-gifbuilder-text:: shadow

    :Data type: GIFBUILDER object :ref:`->SHADOW <gifbuilder-shadow>`


..  _gifbuilder-text-spacing:

spacing
-------

..  t3-gifbuilder-text:: spacing

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`
    :Default: 0

    The pixel distance between letters. This may render ugly!


..  _gifbuilder-text-splitRendering:

splitRendering
--------------

..  t3-gifbuilder-text:: splitRendering

    :Data type: integer / *(array of keys)*

    Split the rendering of a string into separate processes with individual
    configurations. By this method a certain range of characters can be rendered
    with another font face or size. This is very useful if you want to use
    separate fonts for strings where you have latin characters combined with,
    for example, Japanese and there is a separate font file for each.

    You can also render keywords in another
    :ref:`font <gifbuilder-text-fontFile>` /
    :ref:`size <gifbuilder-text-fontSize>` /
    :ref:`color <gifbuilder-text-fontColor>`.


..  _gifbuilder-text-splitRendering-array:

[array]
~~~~~~~

..  t3-gifbuilder-text:: splitRendering.[array]

    :Data type: integer

    With keyword being [charRange, highlightWord].

    *   **splitRendering.[array] = keyword** with keyword being
        [:ref:`charRange <gifbuilder-text-splitRendering-charRange>`,
        :ref:`highlightWord <gifbuilder-text-splitRendering-highlightWord>`]

    *   **splitRendering.[array] {**

        *   **fontFile:** Alternative font file for this rendering.

        *   **fontSize:** Alternative font size for this rendering.

        *   **color:** Alternative color for this rendering, works *only*
            without :t3-gifbuilder-text:`niceText`.

        *   **xSpaceBefore:** x space before this part.

        *   **xSpaceAfter:** x space after this part.

        *   **ySpaceBefore:** y space before this part.

        *   **ySpaceAfter:** y space after this part.

        **}**

    ..  _gifbuilder-text-splitRendering-charRange:

    **Keyword: charRange**

    :typoscript:`splitRendering.[array].value` = Comma-separated list of
    character ranges (for example, :typoscript:`100-200`) given as Unicode
    character numbers. The list accepts optional starting and ending points,
    for example, :typoscript:`- 200` or :typoscript:`200 -` and single values,
    for example, :typoscript:`65, 66, 67`.

    ..  _gifbuilder-text-splitRendering-highlightWord:

    **Keyword: highlightWord**

    :typoscript:`splitRendering.[array].value` = Word to highlight, makes a case
    sensitive search for this.

    **Limitations:**

    *   The pixel compensation values are not corrected for scale factor used
        with :t3-gifbuilder-text:`niceText`. Basically this means
        that when :typoscript:`niceText` is used, these values will have only
        the half effect.

    *   When word spacing is used the :typoscript:`highlightWord` mode does not
        work.

    *   The color override works only without :typoscript:`niceText`.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10.splitRendering.compX = 2
        10.splitRendering.compY = -2
        10.splitRendering.10 = charRange
        10.splitRendering.10 {
          value = 200-380 , 65, 66
          fontSize = 50
          fontFile = EXT:core/Resources/Private/Font/nimbus.ttf
          xSpaceBefore = 30
        }
        10.splitRendering.20 = highlightWord
        10.splitRendering.20 {
          value = TheWord
          color = red
        }


..  _gifbuilder-text-splitRendering-compX:

compX
~~~~~

..  t3-gifbuilder-text:: splitRendering.compX

    :Data type: integer

    Additional pixel space between parts, x direction.


..  _gifbuilder-text-splitRendering-compY:

compY
~~~~~

..  t3-gifbuilder-text:: splitRendering.compY

    :Data type: integer

    Additional pixel space between parts, y direction.


..  _gifbuilder-text-text:

text
----

..  t3-gifbuilder-text:: text

    :Data type: string / :ref:`stdWrap <stdwrap>`

    This is text on the image file. The item is rendered only, if this string is
    not empty.

    The :php:`$cObj->data` array is loaded with the page record, if, for
    example, the :typoscript:`GIFBUILDER` object is used in TypoScript.


..  _gifbuilder-text-textMaxLength:

textMaxLength
-------------

..  t3-gifbuilder-text:: textMaxLength

    :Data type: integer
    :Default: 100

    The maximum length of the :t3-gifbuilder-text:`text`. This is just a
    natural break that prevents incidental rendering of very long texts!


..  _gifbuilder-text-wordSpacing:

wordSpacing
-----------

..  t3-gifbuilder-text:: wordSpacing

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`
    :Default: :ref:`spacing <gifbuilder-text-spacing>` * 2

    The pixel distance between words.
