..  include:: /Includes.rst.txt

..  index::
    Page TSconfig; colorPalettes
    colorPalettes
..  _pagecolorpalettes:


=============
colorPalettes
=============

TYPO3 provides a :ref:`color picker component <t3tca:columns-color>` that
supports color palettes, or swatches. The colors can be configured and assigned
to palettes. This way, for example, colors defined in a corporate design can be
selected by a simple click. Multiple color palettes can be configured.

..  figure:: /Images/ManualScreenshots/ColorPalettes/ColorPalette.png
    :alt: Example of a color palette
    :class: with-shadow

    Example of a color palette

..  _pagecolorpalettes-basic-syntax:

Basic syntax
============

First, define the colors by name and RGB value:

..  literalinclude:: _syntax2.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

..  versionadded:: 13.4.25 | 14.2
    :changelog: feature-101843-1693895770

    A color can have a `label`.

..  versionchanged:: 14.3.1
    Before, the label could only be a static text.

A `label` is optional. Together with the value, it becomes the tooltip of the
color's swatch, for example "TYPO3 orange (#ff8700)", and screen readers
announce it. The swatch of a color without a label shows only the value.

The label can be a static text or a reference to a translated label, for
example `my_sitepackage.be:color.valid`, see
`Translation domain mapping <https://docs.typo3.org/permalink/t3coreapi:label-reference-domain>`_.

Then assign the colors to your palettes:

..  literalinclude:: _basicSyntax.typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

Now you can assign a color palette to one field, to all fields of a table or
as a global configuration, see
:ref:`TCEFORM.colorPalette <pagetsconfigtceformcolorpalette>`.
