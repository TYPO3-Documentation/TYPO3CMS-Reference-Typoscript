..  include:: /Includes.rst.txt
..  index::
    Functions; imgResource
    imgResource
..  _data-type-imgResource:
..  _imgresource:

===========
imgResource
===========

An imgResource one of the following:

#.  A :confval:`data-type-resource` plus imgResource properties.

    Filetypes can be anything among the allowed types defined in the
    configuration variable
    :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']`.  Standard is
    gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp.

#.  A GIFBUILDER object. See the object reference for :ref:`gifbuilder`.

..  rubric:: Examples

Here "file" is an imgResource:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = IMAGE
    10 {
        file = fileadmin/toplogo.gif
        file.width = 200
    }

GIFBUILDER:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = IMAGE
    10.file = GIFBUILDER
    10.file {
        # GIFBUILDER properties here...
    }


..  contents::
    :local:

..  index:: imgResource; Properties
..  _imgresource-properties:

Properties
==========

..  _data-type-imageExtension:
..  _imgresource-ext:

ext
---

..  confval:: ext
    :name: imgresource-ext
    :type: string / :ref:`stdwrap`
    :Default: web

    Target file extension for the processed image. The value :typoscript:`web` checks if
    the file extension is one of gif, jpg, jpeg, png, or svg and if not it will find
    the best target extension.  The target extension must be in the list of file
    extensions perceived as images.  This is defined in
    :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']` in the install
    tool.

    Standard is gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp.


..  _imgresource-width:

width
-----

..  confval:: width
    :name: imgresource-width
    :type: integer / :ref:`stdwrap`

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

    ..  rubric:: Examples

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

..  _imgresource-height:

height
------

..  confval:: height
    :name: imgresource-height
    :type: integer / :ref:`stdwrap`

    See :ref:`imgresource-width`.


..  _imgresource-params:

params
------

..  confval:: params
    :name: imgresource-params
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    GraphicsMagick/ImageMagick command line:

    fx. `-rotate 90`, `-negate` or `-quality 90`


..  _imgresource-sample:

sample
------

..  confval:: sample
    :name: imgresource-sample
    :type: :ref:`data-type-boolean`
    :Default: 0

    If set, `-sample` is used to scale images instead of `-geometry`. Sample
    does not use anti-aliasing and is therefore much faster.


..  _imgresource-noScale:

noScale
-------

..  confval:: noScale
    :name: imgresource-noScale
    :type: :ref:`data-type-boolean` / :ref:`stdwrap`
    :Default: 0

    If set, the image itself will never be scaled. Only width and height
    are calculated according to the other properties, so that the image is
    *displayed* resized, but the original file is used. Can be used for
    creating PDFs or printing of pages, where the original file could
    provide much better quality than a rescaled one.

    ..  rubric:: Examples

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


..  _imgresource-crop:

crop
----

..  confval:: crop
    :name: imgresource-crop
    :type: :ref:`data-type-string` / :ref:`stdwrap`
    :Default: not-set (when file/image is a file_reference the crop value of

    ..  versionchanged:: 13.2
        SVG images are now processed natively in SVG during cropping.
        To keep the old behaviour of transferring them into PNG, you can set
        :confval:`imgresource-ext` to `png` explicitly.

    It is possible to define an area that should be taken (cropped) from the image.
    When not defined in typoscript the value will be taken from the file_reference when
    possible. With this setting you can override this behavior.

    the file reference is used)

    ..  rubric:: Examples

    Disable cropping set by the editor in the back-end:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        tt_content.image.20.1.file.crop =

    Overrule/set cropping for all images:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        tt_content.image.20.1.file.crop = 50,50,100,100

    Natively crop a SVG image:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = IMAGE
        page.10.file = 2:/myfile.svg
        page.10.file.crop = 20,20,500,500



..  _imgresource-cropVariant:

cropVariant
-----------

..  confval:: cropVariant
    :name: imgresource-cropVariant
    :type: :ref:`data-type-string`
    :Default: default

    Since it's possible to define certain :ref:`crop variants <t3coreapi:cropvariants>`
    you can specify which one to use here.


    ..  rubric:: Examples

    Use 'desktop' crop variant:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        tt_content.image.20.1.file {
            crop.data = file:current:crop
            cropVariant = desktop
        }


.. _imgresource-frame:

frame
-----

..  confval:: frame
    :name: imgresource-frame
    :type: :ref:`data-type-integer` / :ref:`stdwrap`

    Chooses the frame in a PDF or GIF file.

    "" = first frame (zero)


..  _imgresource-import:

import
------

..  confval:: import
    :name: imgresource-import
    :type: :ref:`data-type-path` / :ref:`stdwrap`

    *value* should be set to the path of the file

    with :ref:`stdwrap` you get the filename from the data-array

    ..  rubric:: Examples

    This returns the first image in the field "image" from the
    data-array:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        tt_content.image.20.1.file {
            import = uploads/pics/
            import.field = image
            import.listNum = 0
        }


..  _imgresource-treatIdAsReference:

treatIdAsReference
------------------

..  confval:: treatIdAsReference
    :name: imgresource-treatIdAsReference
    :type: :ref:`data-type-boolean` / :ref:`stdwrap`
    :Default: 0

    If set, given UIDs are interpreted as UIDs to sys_file_reference
    instead of to sys_file. This allows using file references, for
    example with :typoscript:`import.data = levelmedia: ...`.


..  _imgresource-maxW:

maxW
----

..  confval:: maxW
    :name: imgresource-maxW
    :type: integer / :ref:`stdwrap`

    Maximum width


..  _imgresource-maxH:

maxH
----

..  confval:: maxH
    :name: imgresource-maxH
    :type: integer / :ref:`stdwrap`

    Maximum height


..  _imgresource-minW:

minW
----

..  confval:: minW
    :name: imgresource-minW
    :type: integer / :ref:`stdwrap`

    Minimum width (overrules maxW/maxH)


..  _imgresource-minH:

minH
----

..  confval:: minH
    :name: imgresource-minH
    :type: integer / :ref:`stdwrap`

    Minimum height (overrules maxW/maxH)


..  _imgresource-stripProfile:

stripProfile
------------

..  confval:: stripProfile
    :name: imgresource-stripProfile
    :type: :ref:`data-type-boolean`
    :Default: 0

    If set, the GraphicsMagick/ImageMagick-command will use a
    stripProfile-command which shrinks the generated thumbnails. See the
    Install Tool for options and details.

    If :typoscript:`processor_stripColorProfileByDefault` is set in the
    Install Tool, you can deactivate it by setting :typoscript:`stripProfile=0`.


    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = IMAGE
        10.file = fileadmin/images/image1.jpg
        10.file.stripProfile = 1


..  _imgresource-masking:

Masking (m)
-----------

..  confval:: Masking:
    :name: imgresource-masking

    (Black hides, white shows)


..  _imgresource-masking-mask:

m.mask
~~~~~~

..  confval:: m.mask
    :name: imgresource-masking-mask
    :type: :ref:`data-type-imgResource`

    The mask with which the image is masked onto :typoscript:`m.bgImg`. Both :typoscript:`m.mask`
    and :typoscript:`m.bgImg` **is scaled to fit** the size of the imgResource image!

    **Note:** Both :typoscript:`m.mask` and :typoscript:`m.bgImg` must be valid images.


..  _imgresource-masking-bgImg:

m.bgImg
~~~~~~~

..  confval:: m.bgImg
    :name: imgresource-masking-bgImg
    :type: :ref:`data-type-imgResource`

    **Note:** Both :typoscript:`m.mask` and :typoscript:`m.bgImg` must be valid images.


..  _imgresource-masking-bottomImg:

m.bottomImg
~~~~~~~~~~~

..  confval:: m.bottomImg
    :name: imgresource-masking-bottomImg
    :type: :ref:`data-type-imgResource`

    An image masked by :typoscript:`m.bottomImg_mask` onto :typoscript:`m.bgImg` before the
    imgResources is masked by :typoscript:`m.mask`.

    Both :typoscript:`m.bottomImg` and :typoscript:`m.bottomImg_mask` **is scaled to fit** the
    size of the imgResource image!

    This is most often used to create an underlay for the imgResource.

    **Note:** Both "m.bottomImg" and :typoscript:`m.bottomImg_mask` must be valid
    images.


..  _imgresource-masking-bottomImg-mask:

m.bottomImg\_mask
~~~~~~~~~~~~~~~~~

..  confval:: m.bottomImg_mask
    :name: imgresource-masking-bottomImg-mask
    :type: :ref:`data-type-imgResource`

    (optional)

    **Note:** Both :typoscript:`m.bottomImg` and :typoscript:`m.bottomImg_mask` must be valid
    images.


..  _imgresource-examples:

Examples
========

This scales the image :file:`fileadmin/toplogo.png` to the width of 200
pixels:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    file = fileadmin/toplogo.png
    file.width = 200
