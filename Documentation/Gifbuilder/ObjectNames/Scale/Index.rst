..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; SCALE
..  _gifbuilder-scale:

=====
SCALE
=====

This scales the GIFBUILDER object to the provided dimensions.

..  note::
    This object resets :ref:`gifbuilder-properties-workArea` to the new dimensions
    of the image!

..  _gifbuilder-scale-properties:

Properties
==========

..  contents::
    :local:


..  _gifbuilder-scale-height:

height
------

..  confval:: height
    :name: gifbuilder-scale-height
    :type: pixels :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Height of the scaled image.


..  _gifbuilder-scale-params:

params
------

..  confval:: params
    :name: gifbuilder-scale-params
    :type: GraphicsMagick/ImageMagick parameters

    Parameters to be used for the processing.


..  _gifbuilder-scale-width:

width
-----

..  confval:: width
    :name: gifbuilder-scale-width
    :type: pixels :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Width of the scaled image.
