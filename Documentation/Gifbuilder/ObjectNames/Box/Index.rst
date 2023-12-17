..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; BOX
..  _gifbuilder-box:

===
BOX
===

Prints a filled box.

Example
=======

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    lib.example = IMAGE
    lib.example {
      file = GIFBUILDER
      file {
        # Rectangle with 100 pixel width and 50 pixel height
        # in orange with opacity 50%
        10 = BOX
        10 {
          dimensions = 0, 0, 100, 50
          color = #ff8700
          opacity = 50
        }
      }
    }


Properties
==========

..  contents::
    :local:

..  _gifbuilder-box-align:

align
-----

..  confval:: align

    :Data type: VHalign / :ref:`stdWrap <stdwrap>`
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

    :Data type: :ref:`data-type-GraphicColor` / :ref:`stdWrap <stdwrap>`
    :Default: black

    Fill color of the box.


..  _gifbuilder-box-dimensions:

dimensions
----------

..  confval:: dimensions

    :Data type: x,y,w,h :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Dimensions of a filled box.

    x,y is the offset.

    w,h are the dimensions. Dimensions of 1 will result in 1-pixel wide
    lines!


..  _gifbuilder-box-opacity:

opacity
-------

..  confval:: opacity

    :Data type: positive integer (1-100) / :ref:`stdWrap <stdwrap>`
    :Default: 100

    The degree to which the box conceals the background.

    Mathematically speaking: Opacity = Transparency^-1, i.e. 100% opacity = 0%
    transparency.


