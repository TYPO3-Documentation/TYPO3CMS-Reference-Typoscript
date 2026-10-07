..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; CROP
..  _gifbuilder-crop:

====
CROP
====

..  confval:: CROP
    :name: gifbuilder-crop
    :type: :ref:`GIFBUILDER object <gifbuilder-object-names>`

    Crops the image to the area set in its property `crop`.

..  note::
    This object resets :ref:`workArea <gifbuilder-properties-workarea>` to the
    new dimensions of the image!

..  _gifbuilder-crop-properties:

Properties
==========

..  contents::
    :local:

..  _gifbuilder-crop-align:

align
-----

..  confval:: align
    :name: gifbuilder-crop-align
    :type: VHalign / :ref:`stdWrap <stdwrap>`
    :default: l, t

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
        :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript

        align = c, b


..  _gifbuilder-crop-backcolor:

backColor
---------

..  confval:: backColor
    :name: gifbuilder-crop-backColor
    :type: :ref:`Colors in TypoScript GIFBUILDER <data-type-graphiccolor>` / :ref:`stdWrap <stdwrap>`
    :default: The original background color

    Background color.

..  _gifbuilder-crop-crop:

crop
----

..  confval:: crop
    :name: gifbuilder-crop-crop
    :type: x,y,w,h :ref:`+calc <gifbuilder-calc>` /:ref:`stdWrap <stdwrap>`

    x,y is the offset of the crop frame from the position specified by
    :ref:`align <gifbuilder-crop-align>`.

    w,h are the dimensions of the frame.
