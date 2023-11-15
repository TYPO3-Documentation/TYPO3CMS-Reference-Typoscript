..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; CROP
..  _gifbuilder-crop:

====
CROP
====

..  note::
    This object resets :t3-gifbuilder-property:`workArea` to the
    new dimensions of the image!

Properties
==========

..  contents::
    :local:

..  _gifbuilder-crop-align:

align
-----

..  t3-gifbuilder-crop:: align

    :Data type: VHalign / :ref:`stdWrap <stdwrap>`
    :Default: l, t

    Pair of values, which defines the horizontal and vertical alignment of
    the crop frame.

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


..  _gifbuilder-crop-backColor:

backColor
---------

..  t3-gifbuilder-crop:: backColor

    :Data type: :t3-data-type:`GraphicColor` / :ref:`stdWrap <stdwrap>`
    :Default: The original background color

    Background color.

..  _gifbuilder-crop-crop:

crop
----

..  t3-gifbuilder-crop:: crop

    :Data type: x,y,w,h :ref:`+calc <gifbuilder-calc>` /:ref:`stdWrap <stdwrap>`

    x,y is the offset of the crop frame from the position specified by
    :t3-gifbuilder-crop:`align`.

    w,h are the dimensions of the frame.
