..  include:: /Includes.rst.txt
..  _guide-imgresource:

===========
imgResource
===========

The :ref:`imgResource <imgresource>` function relates to modifications of
pictures. Its main usage is the property `file` of the
:ref:`IMAGE <cobj-image>` object.

This, for example, allows an image to be resized:

..  literalinclude:: _temp.myImage.typoscript

It is also possible to set minimum or maximum dimensions:

..  literalinclude:: _temp.myImage2.typoscript

`imgResource` also provides direct access to
ImageMagick/GraphicsMagick features:

..  literalinclude:: _temp.myImage3.typoscript
