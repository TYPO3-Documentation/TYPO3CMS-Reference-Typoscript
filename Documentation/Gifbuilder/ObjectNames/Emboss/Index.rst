..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; EMBOSS
..  _gifbuilder-emboss:

======
EMBOSS
======

The :typoscript:`EMBOSS` object uses two shadow offsets in opposite directions
and with different colors to create an effect of light cast onto an embossed
text.

..  _gifbuilder-emboss-properties:

Properties
==========

..  contents::
    :local:


..  _gifbuilder-emboss-blur:

blur
----

..  confval:: blur
    :name: gifbuilder-emboss-blur

    :Data type: integer (1-99) / :ref:`stdWrap <stdwrap>`

    Blurring of the shadow. Above 40 only values of 40, 50, 60, 70, 80, 90
    are relevant.


..  _gifbuilder-emboss-highColor:

highColor
---------

..  confval:: highColor
    :name: gifbuilder-emboss-highColor

    :Data type: :ref:`data-type-GraphicColor` / :ref:`stdWrap <stdwrap>`

    Upper border color.


..  _gifbuilder-emboss-intensity:

intensity
---------

..  confval:: intensity
    :name: gifbuilder-emboss-intensity

    :Data type: integer (0-100) / :ref:`stdWrap <stdwrap>`

    How "massive" the emboss is. This value can - if it has a high value
    combined with a blurred shadow - create a kind of soft-edged outline.


..  _gifbuilder-emboss-lowColor:

lowColor
--------

..  confval:: lowColor
    :name: gifbuilder-emboss-lowColor

    :Data type: :ref:`data-type-GraphicColor` / :ref:`stdWrap <stdwrap>`

    Lower border color.


..  _gifbuilder-emboss-opacity:

opacity
-------

..  confval:: opacity
    :name: gifbuilder-emboss-opacity

    :Data type: integer (1-100) / :ref:`stdWrap <stdwrap>`

    The degree to which the shadow conceals the background. Mathematically
    speaking: Opacity = Transparency^-1. For example, 100% opacity = 0%
    transparency.

    Only active with a value for :ref:`gifbuilder-emboss-blur`.


..  _gifbuilder-emboss-offset:

offset
------

..  confval:: offset
    :name: gifbuilder-emboss-offset

    :Data type: x,y / :ref:`stdWrap <stdwrap>`

    Offset of the emboss.


..  _gifbuilder-emboss-textObjNum:

textObjNum
----------

..  confval:: textObjNum
    :name: _gifbuilder-emboss-textObjNum

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`

    Must point to the :ref:`TEXT <gifbuilder-text>` object, if these
    :typoscript:`EMBOSS` properties are not properties to a TEXT object directly
    ("stand-alone emboss"). Then the emboss needs to know which TEXT object it
    should be an emboss of!

    If - on the other hand - the :typoscript:`EMBOSS` object is a property to a
    :ref:`TEXT <gifbuilder-text>` object, this property is not needed.
