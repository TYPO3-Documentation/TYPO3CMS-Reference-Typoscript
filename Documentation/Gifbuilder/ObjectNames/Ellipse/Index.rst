..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; ELLIPSE
..  _gifbuilder-ellipse:

=======
ELLIPSE
=======

Prints a filled ellipse.

..  _gifbuilder-ellipse-example:

Example
=======

..  literalinclude:: _ellipse.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

..  _gifbuilder-ellipse-properties:

Properties
==========

..  contents::
    :local:


..  _gifbuilder-ellipse-color:

color
-----

..  confval:: color
    :name: gifbuilder-ellipse-color
    :type: :ref:`data-type-GraphicColor` / :ref:`stdWrap <stdwrap>`
    :Default: black

    Fill color of the ellipse.


..  _gifbuilder-ellipse-dimensions:

dimensions
----------

..  confval:: dimensions
    :name: gifbuilder-ellipse-dimensions
    :type: x,y,w,h :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Dimensions of a filled ellipse.

    x,y is the offset.

    w,h are the dimensions. Dimensions of 1 will result in 1-pixel wide
    lines!
