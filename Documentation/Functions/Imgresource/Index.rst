.. include:: /Includes.rst.txt


.. _imgresource:

===========
imgResource
===========

imgResource contains the properties that are used with the data type
imgResource.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         ext

   Data type
         imageExtension /:ref:`stdWrap <stdwrap>`

   Default
         web

   Description
         Target file extension for the processed image. The value "web" checks if the file extension
         is one of gif, jpg, jpeg, or png and if not it will find the best target extension.
         The target extension must be in the list of file extensions perceived as images.
         This is defined in :php:`$TYPO3_CONF_VARS['GFX']['imagefile_ext']` in the install tool.


.. container:: table-row

   Property
         width

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         If both the width and the height are set and one of the numbers is
         appended by an "m", the proportions will be preserved and thus
         width and height are treated as maximum dimensions for the image. The
         image will be scaled to fit into the rectangle of the dimensions
         width and height.

         If both the width and the height are set and at least one of the
         numbers is appended by a "c", crop-scaling will be enabled. This means
         that the proportions will be preserved and the image will be scaled to
         fit **around** a rectangle with width/height dimensions. Then, a
         centered portion from **inside** of the image (size defined by
         width/height) will be cut out.

         The "c" can have a percentage value (-100 ... +100) after it, which
         defines how much the cropping will be moved off the center to the
         border.

         Notice that you can only use either "m" *or* "c" at the same time!

   Examples
         This crops 120x80px from the center of the scaled image::

            .width = 120c
            .height = 80c

         This crops 100x100px; from landscape-images at the left and portrait-
         images centered::

            .width = 100c-100
            .height = 100c

         This crops 100x100px; from landscape-images a bit right of the center
         and portrait-images a bit higher than centered::

            .width = 100c+30
            .height = 100c-25


.. container:: table-row

   Property
         height

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         See ".width"


.. container:: table-row

   Property
         params

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         GraphicsMagick/ImageMagick command-line:

         fx. "-rotate 90", "-negate" or "-quality 90"


.. container:: table-row

   Property
         sample

   Data type
         boolean

   Default
         0

   Description
         If set, `-sample` is used to scale images instead of `-geometry`. Sample
         does not use anti-aliasing and is therefore much faster.



.. container:: table-row

   Property
         noScale

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         If set, the image itself will never be scaled. Only width and height
         are calculated according to the other properties, so that the image is
         *displayed* resizedly, but the original file is used. Can be used for
         creating PDFs or printing of pages, where the original file could
         provide much better quality than a rescaled one.

   Example
         Here :file:`test.jpg` could have 1600 x 1200 pixels for example::

            file = fileadmin/test.jpg
            file.width = 240m
            file.height = 240m
            file.noScale = 1

         This example results in an image tag like the following. Note that
         `src="fileadmin/test.jpg"` is the *original* file::

            <img src="fileadmin/test.jpg" width="240" height="180" />


.. container:: table-row

   Property
         crop

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Default
         not-set (when file/image is a file_reference the crop value of
         the file reference is used)

   Description
         It is possible to define an area that should be taken (cropped) from the image.
         When not defined in typoscript the value wil be taken from the file_reference when
         possible. With this setting you can override this behavior.

   Examples
         Disable cropping set by the editor in the back-end::

            tt_content.image.20.1.file.crop =

         Overrule/set cropping for all images::

            tt_content.image.20.1.file.crop = 50,50,100,100


.. container:: table-row

   Property
         cropVariant

   Data type
         string

   Default
         default

   Description
         Since it's possible to define certain `crop variants
         <https://docs.typo3.org/typo3cms/extensions/core/8.7/Changelog/8.6/Feature-75880-ImplementMultipleCroppingVariantsInImageManipulationTool.html>`__
         you can specify which one to use here.

   Examples
      Use 'desktop' crop variant::

         tt_content.image.20.1.file.crop.data = file:current:crop
         tt_content.image.20.1.file.cropVariant = desktop


.. container:: table-row

   Property
         alternativeTempPath

   Data type
         string

   Description
         Enter an alternative path to use for temporary images.


.. container:: table-row

   Property
         frame

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Chooses the frame in a PDF or GIF file.

         "" = first frame (zero)


.. container:: table-row

   Property
         import

   Data type
         path /:ref:`stdWrap <stdwrap>`

   Description
         *value* should be set to the path of the file

         with stdWrap you get the filename from the data-array

   Example
         This returns the first image in the field "image" from the
         data-array::

            .import = uploads/pics/
            .import.field = image
            .import.listNum = 0


.. container:: table-row

   Property
         treatIdAsReference

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         If set, given UIDs are interpreted as UIDs to sys_file_reference
         instead of to sys_file. This allows using file references, for
         example with :typoscript:`import.data = levelmedia: ...`.



.. container:: table-row

   Property
         maxW

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Maximum width


.. container:: table-row

   Property
         maxH

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Maximum height


.. container:: table-row

   Property
         minW

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Minimum width (overrules maxW/maxH)


.. container:: table-row

   Property
         minH

   Data type
         pixels /:ref:`stdWrap <stdwrap>`

   Description
         Minimum height (overrules maxW/maxH)


.. container:: table-row

   Property
         stripProfile

   Data type
         boolean

   Default
         0

   Description
         If set, the GraphicsMagick/ImageMagick-command will use a
         stripProfile-command which shrinks the generated thumbnails. See the
         Install Tool for options and details.

         If :typoscript:`processor_stripColorProfileByDefault` is set in the
         Install Tool, you can deactivate it by setting :typoscript:`stripProfile=0`.

   Example
         ::

            10 = IMAGE
            10.file = fileadmin/images/image1.jpg
            10.file.stripProfile = 1


.. container:: table-row

   Property
         Masking:

         (Black hides, white shows)


.. container:: table-row

   Property
         m.mask

   Data type
         imgResource

   Description
         The mask with which the image is masked onto "m.bgImg". Both "m.mask"
         and "m.bgImg" **is scaled to fit** the size of the imgResource image!

         **Note:** Both "m.mask" and "m.bgImg" must be valid images.


.. container:: table-row

   Property
         m.bgImg

   Data type
         imgResource

   Description
         **Note:** Both "m.mask" and "m.bgImg" must be valid images.


.. container:: table-row

   Property
         m.bottomImg

   Data type
         imgResource

   Description
         An image masked by "m.bottomImg\_mask" onto "m.bgImg" before the
         imgResources is masked by "m.mask".

         Both "m.bottomImg" and "m.bottomImg\_mask" **is scaled to fit** the
         size of the imgResource image!

         This is most often used to create an underlay for the imgResource.

         **Note:** Both "m.bottomImg" and "m.bottomImg\_mask" must be valid
         images.


.. container:: table-row

   Property
         m.bottomImg\_mask

   Data type
         imgResource

   Description
         (optional)

         **Note:** Both "m.bottomImg" and "m.bottomImg\_mask" must be valid
         images.


.. ###### END~OF~TABLE ######


[tsref:->imgResource]


.. _imgresource-examples:

Examples
========

This scales the image :file:`fileadmin/toplogo.gif` to the width of 200
pixels::

   file = fileadmin/toplogo.gif
   file.width = 200

