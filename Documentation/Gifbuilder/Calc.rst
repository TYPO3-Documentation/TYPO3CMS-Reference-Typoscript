..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; +calc
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

