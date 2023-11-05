..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; IMAGE
..  _gifbuilder-image:

=====
IMAGE
=====

Renders an image file.


Properties
==========

..  contents::
    :local:


..  _gifbuilder-image-align:

align
-----

..  t3-gifbuilder-image:: align

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

..  t3-gifbuilder-image:: file

    :Data type: :t3-data-type:`imgResource`

    The image file.


..  _gifbuilder-image-mask:

mask
----

..  t3-gifbuilder-image:: mask

    :Data type: :t3-data-type:`imgResource`

    Optional mask image for the image file.


..  _gifbuilder-image-offset:

offset
------

..  t3-gifbuilder-image:: offset

    :Data type: x,y :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`
    :Default: 0,0

    Offset of the image.


..  _gifbuilder-image-tile:

tile
----

..  t3-gifbuilder-image:: tile

    :Data type: x,y / :ref:`stdWrap <stdwrap>`
    :Default: 1,1

    Repeat the image x,y times (which creates the look of tiles).

    Maximum number of times in each direction is 20. If you need more,
    use a larger image.
