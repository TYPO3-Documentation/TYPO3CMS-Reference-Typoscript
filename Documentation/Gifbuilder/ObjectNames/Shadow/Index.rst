..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; SHADOW
..  _gifbuilder-shadow:

======
SHADOW
======

Creates a shadow under the associated text.

..  _gifbuilder-shadow-properties:

Properties
==========

..  contents::
    :local:


..  _gifbuilder-shadow-blur:

blur
----

..  confval:: blur
    :name: gifbuilder-shadow-blur

    :Data type: integer (1-99) / :ref:`stdWrap <stdwrap>`

    Blurring of the shadow. Above 40 only values of 40,50,60,70,80,90
    are relevant.


..  _gifbuilder-shadow-color:

color
-----

..  confval:: color
    :name: gifbuilder-shadow-color

    :Data type: :ref:`data-type-GraphicColor` / :ref:`stdWrap <stdwrap>`

    The color of the shadow.


..  _gifbuilder-shadow-intensity:

intensity
---------

..  confval:: intensity
    :name: gifbuilder-shadow-intensity

    :Data type: integer (1-100) / :ref:`stdWrap <stdwrap>`

    How "massive" the shadow is. This value can - if it has a high value
    combined with a blurred shadow - create a kind of soft-edged outline.


..  _gifbuilder-shadow-offset:

offset
------

..  confval:: offset
    :name: gifbuilder-shadow-offset

    :Data type: x,y / :ref:`stdWrap <stdwrap>`

    The offset of the shadow.


..  _gifbuilder-shadow-opacity:

opacity
-------

..  confval:: opacity
    :name: gifbuilder-shadow-opacity

    :Data type: integer (1-100) / :ref:`stdWrap <stdwrap>`

    The degree to which the shadow conceals the background. Mathematically
    speaking: Opacity = Transparency^-1. E.g. 100% opacity = 0%
    transparency.

    Only active with a value for :ref:`gifbuilder-shadow-blur`.


..  _gifbuilder-shadow-textObjNum:

textObjNum
----------

..  confval:: textObjNum
    :name: gifbuilder-shadow-textObjNum

    :Data type: positive integer / :ref:`stdWrap <stdwrap>`

    Must point to the :ref:`TEXT <gifbuilder-text>` object, if these shadow
    properties are not properties to a TEXT object directly ("stand-alone
    shadow"). Then the shadow needs to know which TEXT object it should be a
    shadow of!

    If - on the other hand - the shadow is a property to a
    :ref:`TEXT <gifbuilder-text>` object, this property is not needed.
