..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; IMAGE
..  _gifbuilder-image:

=====
IMAGE
=====

Renders an image file.

..  _gifbuilder-image-properties:

Properties
==========

..  contents::
    :local:


..  _gifbuilder-image-align:

align
-----

..  confval:: align
    :name: gifbuilder-image-align

    :Data type: VHalign / :ref:`stdWrap <stdwrap>`
    :Default: 1,1

    Pair of values, which defines the horizontal and vertical alignment of
    the image.

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


..  _gifbuilder-image-file:

file
----

..  confval:: file
    :name: gifbuilder-image-file

    :Data type: :ref:`data-type-imgResource`

    The image file.


..  _gifbuilder-image-mask:

mask
----

..  confval:: mask
    :name: gifbuilder-image-mask

    :Data type: :ref:`data-type-imgResource`

    Optional mask image for the image file.


..  _gifbuilder-image-offset:

offset
------

..  confval:: offset
    :name: gifbuilder-image-offset

    :Data type: x,y :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`
    :Default: 0,0

    Offset of the image.


..  _gifbuilder-image-tile:

tile
----

..  confval:: tile
    :name: gifbuilder-image-tile

    :Data type: x,y / :ref:`stdWrap <stdwrap>`
    :Default: 1,1

    Repeat the image x,y times (which creates the look of tiles).

    Maximum number of times in each direction is 20. If you need more,
    use a larger image.
