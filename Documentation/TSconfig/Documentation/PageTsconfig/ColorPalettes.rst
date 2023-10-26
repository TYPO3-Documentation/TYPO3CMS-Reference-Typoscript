..  include:: /Includes.rst.txt

..  index::
    Page TSconfig; colorPalettes
    colorPalettes
..  _pagecolorpalettes:


=============
colorPalettes
=============

..  versionadded:: 13.0

TYPO3 provides a :ref:`color picker component <t3tca:columns-color>` that
supports color palettes, or swatches. The colors can be configured and assigned
to palettes. This way, for example, colors defined in a corporate design can be
selected by a simple click. Multiple color palettes can be configured.

..  figure:: /Images/ManualScreenshots/ColorPalettes/ColorPalette.png
    :alt: Example of a color palette
    :class: with-shadow

    Example of a color palette

Basic syntax
============

First, define the colors by name and RGB value:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    colorPalettes {
      colors {
        typo3 {
          value = #ff8700
        }
        blue {
          value = #0080c9
        }
        darkgrey {
          value = #515151
        }
        valid {
          value = #5abc55
        }
        error {
          value = #dd123d
        }
      }
    }

Then assign the colors to your palettes:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/page.tsconfig

    colorPalettes {
      palettes {
        main = typo3
        key_colors = typo3, blue, darkgrey
        messages = valid, error
      }
    }

Now you can assign a color palette to one field, to all fields of a table or
as a global configuration, see
:ref:`TCEFORM.colorPalette <pageTsConfigTceFormColorPalette>`.
