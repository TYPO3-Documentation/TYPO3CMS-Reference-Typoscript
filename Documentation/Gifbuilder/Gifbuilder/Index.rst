..  include:: /Includes.rst.txt
..  index:: GIFBUILDER
..  _gifbuilder:

==========
GIFBUILDER
==========

GIFBUILDER is an object type, which is used in many situations for creating
image files (for example, GIF, PNG or JPG). Wherever the GIFBUILDER object
type is mentioned, these are the properties that apply.

Using TypoScript, you can define a "numerical array" of "GIFBUILDER
objects" (like :ref:`TEXT <cobj-text>`, :ref:`IMAGE <cobj-image>`, etc.) and
they will be rendered onto an image one by one.

The name "GIFBUILDER" comes from the time when GIF was the only supported file
format. PNG and JPG can be created as well today (configured with
:ref:`$TYPO3_CONF_VARS['GFX'] <t3coreapi:typo3ConfVars_gfx>`).


.. _gifbuilder-calc:

Note on (+calc)
===============

Whenever the :ref:`+calc <calc>` function is added to a value in the data type
of the properties underneath, you can use the dimensions of :ref:`TEXT <cobj-text>`
and :ref:`IMAGE <cobj-image>` objects from the GIFBUILDER object array. This is
done by inserting a tag like this: :typoscript:`[10.w]` or :typoscript:`[10.h]`,
where `10` is the GIFBUILDER object number in the array and `w`/`h` signifies
either width or height of the object.

The special property :typoscript:`lineHeight` (for example,
:typoscript:`[10.lineHeight]`) uses the height a single line of text would take.

On using the special function :typoscript:`max()`, the maximum of multiple
values can be determined. Example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    XY = [10.w]+[20.w], max([10.h], [20.h])

Here's a full example (taken from "styles.content (default)" of older TYPO3
versions):

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript
    :emphasize-lines: 6

    styles.header.gfx1 = IMAGE
    styles.header.gfx1 {
      wrap = {$styles.header.gfx1.wrap}
      file = GIFBUILDER
      file {
        XY = [10.w]+10 ,{$styles.header.gfx1.itemH}
        backColor = {$styles.header.gfx1.bgCol}
        10 = TEXT
        10 {
          text.current = 1
          text.crop = {$styles.header.gfx1.maxChars}
          fontSize = {$styles.header.gfx1.fontSize}
          fontFile = {$styles.header.gfx1.file.fontFile}
          fontColor = {$styles.header.gfx1.fontColor}
          offset = {$styles.header.gfx1.fontOffset}
        }
      }
    }

As you see, the image has a width defined as the width of the text
printed onto it + 10 pixels. The height is fixed by the value of the
constant :typoscript:`{$styles.header.gfx1.itemH}`.
