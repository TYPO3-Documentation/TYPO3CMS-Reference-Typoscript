.. include:: /Includes.rst.txt


.. _function-imgresource:
.. _imgresource:

imgResource
^^^^^^^^^^^

The :ref:`imgResource <imgresource>` function relates to modifications of
pictures. Its main usage is the property `file` of the
:ref:`IMAGE <cobj-image>` object.

This, for example, allows an image to be resized::

   temp.myImage = IMAGE
   temp.myImage {
      file = toplogo.gif
      file.width = 200
      file.height = 300
   }

It is also possible to set minimum or maximum dimensions::

   temp.myImage = IMAGE
   temp.myImage {
      file = toplogo.gif

      # maximum size
      file.maxW = 200
      file.maxH = 300

      # minimum size
      file.minW = 100
      file.minH = 120
   }

`imgResource` also provides direct access to
ImageMagick/GraphicsMagick features::

   temp.myImage = IMAGE
   temp.myImage {
      file = toplogo.gif
      file.params = -rotate 90
   }

