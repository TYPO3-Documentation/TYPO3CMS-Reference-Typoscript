..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; +calc
.. _gifbuilder-colors:

===============================
Colors in TypoScript GIFBUILDER
===============================

..  _data-type-GraphicColor:
..  confval:: GraphicColor
    :name: data-type-GraphicColor

    ..  rubric:: Syntax:

    [colordef] : [modifier]

    Where modifier can be an integer which is added or subtracted to the three
    RGB-channels or a floating point with an :typoscript:`*` before, which will then
    multiply the values with that factor.


    The color can be given as HTML-color or as a comma-separated list of
    RGB-values (integers). An extra parameter can be given, that will modify the
    color mathematically:

    ..  rubric:: Examples

    *   :typoscript:`red` (HTML color)
    *   :typoscript:`#ffeecc` (HTML color as hexadecimal notation)
    *   :typoscript:`255,0,255` (HTML color as decimal notation)

    *Extra:*

    *   :typoscript:`red : *0.8` ("red" is darkened by factor 0.8)
    *   :typoscript:`#ffeecc : +16` ("ffeecc" is going to #fffedc because 16 is added)
