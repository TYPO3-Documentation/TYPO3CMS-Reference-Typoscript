..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; BOX
..  _gifbuilder-box:

===
BOX
===

Prints a filled box.

Example
=======

..  literalinclude:: _box.typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

..  _gifbuilder-box-properties:

Properties
==========

..  contents::
    :local:

..  _gifbuilder-box-align:

align
-----

..  confval:: align
    :name: gifbuilder-box-align
    :type: VHalign / :ref:`stdWrap <stdwrap>`
    :Default: l, t

    Pair of values, which defines the horizontal and vertical alignment of
    the box in the image.

    **Values:**

    Horizontal alignment:

    l
        left

    c
        center

    r
        right

    Vertical alignment:

    t
        top

    c
        center

    b
        bottom

    **Example:**

    Horizontally centered, vertically at the bottom:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        align = c, b


..  _gifbuilder-box-color:

color
-----

..  confval:: color
    :name: gifbuilder-box-color
    :type: :ref:`Colors in TypoScript GIFBUILDER <data-type-GraphicColor>` / :ref:`stdWrap <stdwrap>`
    :Default: black

    Fill color of the box.


..  _gifbuilder-box-dimensions:

dimensions
----------

..  confval:: dimensions
    :name: gifbuilder-box-dimensions
    :type: x,y,w,h :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Dimensions of a filled box.

    x,y is the offset.

    w,h are the dimensions. Dimensions of 1 will result in 1-pixel wide
    lines!


..  _gifbuilder-box-opacity:

opacity
-------

..  confval:: opacity
    :name: gifbuilder-box-opacity
    :type: positive integer (1-100) / :ref:`stdWrap <stdwrap>`
    :Default: 100

    The degree to which the box conceals the background.

    Mathematically speaking: Opacity = Transparency^-1, i.e. 100% opacity = 0%
    transparency.


