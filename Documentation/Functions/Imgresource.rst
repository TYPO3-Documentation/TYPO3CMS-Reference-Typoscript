.. include:: /Includes.rst.txt
.. index::
   Functions; imgResource
   imgResource
.. _imgresource:

===========
imgResource
===========

imgResource contains the properties that are used with the data type
imgResource.

.. contents::
   :local:

.. index:: imgResource; Properties
.. _imgresource-properties:

Properties
==========

.. index:: imgResource;
.. _imgresource-ext:

ext
---

:aspect:`Property`
   ext

:aspect:`Data type`
   :t3-data-type:`imageExtension` / :ref:`stdwrap`

:aspect:`Default`
   web

:aspect:`Description`
   Target file extension for the processed image. The value :typoscript:`web` checks if
   the file extension is one of gif, jpg, jpeg, or png and if not it will find
   the best target extension.  The target extension must be in the list of file
   extensions perceived as images.  This is defined in
   :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']` in the install
   tool.


.. _imgresource-width:

width
-----

:aspect:`Property`
   width

:aspect:`Data type`
   :t3-data-type:`pixels` / :ref:`stdwrap`

:aspect:`Description`
   If both the width and the height are set and one of the numbers is
   appended by an :typoscript:`m`, the proportions will be preserved and thus
   width and height are treated as maximum dimensions for the image. The
   image will be scaled to fit into the rectangle of the dimensions
   width and height.

   If both the width and the height are set and at least one of the
   numbers is appended by a :typoscript:`c`, crop-scaling will be enabled. This means
   that the proportions will be preserved and the image will be scaled to
   fit **around** a rectangle with width/height dimensions. Then, a
   centered portion from **inside** of the image (size defined by
   width/height) will be cut out.

   The :typoscript:`c` can have a percentage value (-100 ... +100) after it, which
   defines how much the cropping will be moved off the center to the
   border.

   Notice that you can only use either :typoscript:`m` *or* :typoscript:`c` at the same time!

:aspect:`Examples`
   This crops 120x80px from the center of the scaled image:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.image {
          width = 120c
          height = 80c
      }

   This crops 100x100px; from landscape-images at the left and portrait-
   images centered:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.image {
          width = 100c-100
          height = 100c
      }

   This crops 100x100px; from landscape-images a bit right of the center
   and portrait-images a bit higher than centered:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.image {
          width = 100c+30
          height = 100c-25
      }

.. _imgresource-height:

height
------

:aspect:`Property`
   height

:aspect:`Data type`
   :t3-data-type:`pixels` / :ref:`stdwrap`

:aspect:`Description`
   See :ref:`imgresource-width`


.. index:: imgResource; params
.. _imgresource-params:

params
------

:aspect:`Property`
   params

:aspect:`Data type`
   :t3-data-type:`string` / :ref:`stdwrap`

:aspect:`Description`
   GraphicsMagick/ImageMagick command-line:

   fx. `-rotate 90`, `-negate` or `-quality 90`


.. _imgresource-sample:

sample
------

:aspect:`Property`
   sample

:aspect:`Data type`
   :t3-data-type:`boolean`

:aspect:`Description`
   If set, `-sample` is used to scale images instead of `-geometry`. Sample
   does not use anti-aliasing and is therefore much faster.

:aspect:`Default`
   0


.. _imgresource-noscale:

noScale
-------

:aspect:`Property`
   noScale

:aspect:`Data type`
   :t3-data-type:`boolean` / :ref:`stdwrap`

:aspect:`Description`
   If set, the image itself will never be scaled. Only width and height
   are calculated according to the other properties, so that the image is
   *displayed* resized, but the original file is used. Can be used for
   creating PDFs or printing of pages, where the original file could
   provide much better quality than a rescaled one.

:aspect:`Default`
   0

:aspect:`Example`
   Here :file:`test.jpg` could have 1600 x 1200 pixels for example:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      file = fileadmin/test.jpg
      file.width = 240m
      file.height = 240m
      file.noScale = 1

   This example results in an image tag like the following. Note that
   `src="fileadmin/test.jpg"` is the *original* file:

   .. code-block:: html

      <img src="fileadmin/test.jpg" width="240" height="180" />


.. index:: imgResource; crop
.. _imgresource-crop:

crop
----

:aspect:`Property`
   crop

:aspect:`Data type`
   :t3-data-type:`string` / :ref:`stdwrap`

:aspect:`Description`
   It is possible to define an area that should be taken (cropped) from the image.
   When not defined in typoscript the value will be taken from the file_reference when
   possible. With this setting you can override this behavior.

:aspect:`Default`
   not-set (when file/image is a file_reference the crop value of
   the file reference is used)

:aspect:`Examples`
   Disable cropping set by the editor in the back-end:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      tt_content.image.20.1.file.crop =

   Overrule/set cropping for all images:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      tt_content.image.20.1.file.crop = 50,50,100,100

.. _imgresource-cropvariant:

cropVariant
-----------

:aspect:`Property`
   cropVariant

:aspect:`Data type`
   :t3-data-type:`string`

:aspect:`Description`
   Since it's possible to define certain :ref:`crop variants <t3coreapi:cropvariants>`
   you can specify which one to use here.

:aspect:`Default`
   default

:aspect:`Examples`
   Use 'desktop' crop variant:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      tt_content.image.20.1.file {
          crop.data = file:current:crop
          cropVariant = desktop
      }


.. _imgresource-frame:

frame
-----

:aspect:`Property`
   frame

:aspect:`Data type`
   :t3-data-type:`integer` / :ref:`stdwrap`

:aspect:`Description`
   Chooses the frame in a PDF or GIF file.

   "" = first frame (zero)


.. index:: imgResource; import
.. _imgresource-import:

import
------

:aspect:`Property`
   import

:aspect:`Data type`
   :t3-data-type:`path` / :ref:`stdwrap`

:aspect:`Description`
   *value* should be set to the path of the file

   with :ref:`stdwrap` you get the filename from the data-array

:aspect:`Example`
   This returns the first image in the field "image" from the
   data-array:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      tt_content.image.20.1.file {
          import = uploads/pics/
          import.field = image
          import.listNum = 0
      }


.. index:: imgResource; treatIdAsReference
.. _imgresource-treatidasreference:

treatIdAsReference
------------------

:aspect:`Property`
   treatIdAsReference

:aspect:`Data type`
   :t3-data-type:`boolean` / :ref:`stdwrap`

:aspect:`Description`
   If set, given UIDs are interpreted as UIDs to sys_file_reference
   instead of to sys_file. This allows using file references, for
   example with :typoscript:`import.data = levelmedia: ...`.

:aspect:`Default`
   0

.. _imgresource-maxw:

maxW
----

:aspect:`Property`
   maxW

:aspect:`Data type`
   :t3-data-type:`pixels` / :ref:`stdwrap`

:aspect:`Description`
   Maximum width

.. _imgresource-maxh:

maxH
----

:aspect:`Property`
   maxH

:aspect:`Data type`
   :t3-data-type:`pixels` / :ref:`stdwrap`

:aspect:`Description`
   Maximum height

.. _imgresource-minw:

minW
----

:aspect:`Property`
   minW

:aspect:`Data type`
   :t3-data-type:`pixels` / :ref:`stdwrap`

:aspect:`Description`
   Minimum width (overrules maxW/maxH)

.. _imgresource-minh:

minH
----

:aspect:`Property`
   minH

:aspect:`Data type`
   :t3-data-type:`pixels` / :ref:`stdwrap`

:aspect:`Description`
   Minimum height (overrules maxW/maxH)


.. index:: imgResource; stripProfile
.. _imgresource-stripprofile:

stripProfile
------------

:aspect:`Property`
      stripProfile

:aspect:`Data type`
      :t3-data-type:`boolean`

:aspect:`Description`
      If set, the GraphicsMagick/ImageMagick-command will use a
      stripProfile-command which shrinks the generated thumbnails. See the
      Install Tool for options and details.

      If :typoscript:`processor_stripColorProfileByDefault` is set in the
      Install Tool, you can deactivate it by setting :typoscript:`stripProfile=0`.

:aspect:`Default`
      0

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      10 = IMAGE
      10.file = fileadmin/images/image1.jpg
      10.file.stripProfile = 1

Masking (m)
-----------

:aspect:`Property`
   Masking:

   (Black hides, white shows)

m.mask
~~~~~~

:aspect:`Property`
   m.mask

:aspect:`Data type`
   :t3-data-type:`imgResource`

:aspect:`Description`
   The mask with which the image is masked onto :typoscript:`m.bgImg`. Both :typoscript:`m.mask`
   and :typoscript:`m.bgImg` **is scaled to fit** the size of the imgResource image!

   **Note:** Both :typoscript:`m.mask` and :typoscript:`m.bgImg` must be valid images.

m.bgImg
~~~~~~~

:aspect:`Property`
   m.bgImg

:aspect:`Data type`
   :t3-data-type:`imgResource`

:aspect:`Description`
   **Note:** Both :typoscript:`m.mask` and :typoscript:`m.bgImg` must be valid images.

m.bottomImg
~~~~~~~~~~~

:aspect:`Property`
   m.bottomImg

:aspect:`Data type`
   :t3-data-type:`imgResource`

:aspect:`Description`
   An image masked by :typoscript:`m.bottomImg_mask` onto :typoscript:`m.bgImg` before the
   imgResources is masked by :typoscript:`m.mask`.

   Both :typoscript:`m.bottomImg` and :typoscript:`m.bottomImg_mask` **is scaled to fit** the
   size of the imgResource image!

   This is most often used to create an underlay for the imgResource.

   **Note:** Both "m.bottomImg" and :typoscript:`m.bottomImg_mask` must be valid
   images.

m.bottomImg\_mask
~~~~~~~~~~~~~~~~~

:aspect:`Property`
   m.bottomImg\_mask

:aspect:`Data type`
   :t3-data-type:`imgResource`

:aspect:`Description`
   (optional)

   **Note:** Both :typoscript:`m.bottomImg` and :typoscript:`m.bottomImg_mask` must be valid
   images.


.. _imgresource-examples:

Examples
========

This scales the image :file:`fileadmin/toplogo.gif` to the width of 200
pixels:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   file = fileadmin/toplogo.gif
   file.width = 200
