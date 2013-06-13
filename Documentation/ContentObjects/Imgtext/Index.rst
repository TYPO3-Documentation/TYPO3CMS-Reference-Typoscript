.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-imgtext:

IMGTEXT
^^^^^^^

This object is designed to align images and text. This is normally
used to render text/picture records from the tt\_content table.

The image(s) are placed in a table and the table is placed before,
after or left/right relative to the text.

See code examples.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         text

   Data type
         :ref:`->CARRAY <carray>` /:ref:`stdWrap <stdwrap>`

   Description
         Use this to import / generate the content, that should flow around the
         image block.


.. container:: table-row

   Property
         textPos

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Text position:

         bit[0-2]: 000 = center, 001 = right, 010 = left

         bit[3-5]: 000 = over, 001 = under, 010 text

         0 - Above: Centre

         1 - Above: Right

         2 - Above: Left

         8 - Below: Centre

         9 - Below: Right

         10 - Below: Left

         17 - In Text: Right

         18 - In Text: Left

         25 - In Text: Right (no wrap)

         26 - In Text: Left (no wrap)


.. container:: table-row

   Property
         textMargin

   Data type
         :ref:`pixels <data-type-pixels>` /:ref:`stdWrap <stdwrap>`

   Description
         Margin between the image and the content.


.. container:: table-row

   Property
         textMargin\_outOfText

   Data type
         boolean

   Description
         If set, the textMargin space will still be inserted even if the image
         is placed above or below the text.

         This flag is only for a kind of backwards compatibility because this
         "feature" was recently considered a bug and thus corrected. So if
         anyone has depended on this way things are done, you can compensate
         with this flag.

   Default
         0


.. container:: table-row

   Property
         imgList

   Data type
         *list of image files* /:ref:`stdWrap <stdwrap>`

   Description
         List of images from ".imgPath".

         **Example:**

         This imports the list of images from tt\_content's image-field. ::

            imgList.field = image


.. container:: table-row

   Property
         imgPath

   Data type
         path /:ref:`stdWrap <stdwrap>`

   Description
         Path to the images.

         **Example:**

         "uploads/pics/"


.. container:: table-row

   Property
         imgMax

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Maximum number of images.


.. container:: table-row

   Property
         imgStart

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Start with image-number ".imgStart".


.. container:: table-row

   Property
         imgObjNum

   Data type
         *imgObjNum* :ref:`+optionSplit <objects-optionsplit>`

   Description
         Here you define, which :ref:`IMAGE <cobj-image>` cObjects from the array "1,2,3,4..." in
         this object that should render the images.

         "current" is set to the image filename.

         **Example:** ::

            imgObjNum = 1 |*||*| 2

         This would render the first two images with "1. ..." and the last
         image with "2. ...", provided that the ".imgList" contains 3 images.


.. container:: table-row

   Property
         1,2,3,4

   Data type
         :ref:`->IMAGE <cobj-image>` (cObject)

   Description
         Rendering of the images.

         The register "IMAGE\_NUM" is set with the number of image being
         rendered for each rendering of an image object. Starting with zero.

         The image object should not be of type :ref:`GIFBUILDER <gifbuilder>`!

         **Important:**

         "file.import.current = 1" fetches the name of the images!


.. container:: table-row

   Property
         caption

   Data type
         :ref:`->CARRAY <carray>` /:ref:`stdWrap <stdwrap>`

   Description
         Caption.


.. container:: table-row

   Property
         captionAlign

   Data type
         :ref:`align <data-type-align>` /:ref:`stdWrap <stdwrap>`

   Description
         Caption alignment.

   Default
         default = ".textPos"


.. container:: table-row

   Property
         captionSplit

   Data type
         boolean

   Description
         If this is set, the caption text is split by the character (or string)
         from ".token", and every item is displayed under an image each in the
         image block.

         .token = (string /:ref:`stdWrap <stdwrap>`) Character to split the caption elements
         (default is chr(10))

         .cObject = cObject, used to fetch the caption for the split

         .stdWrap = stdWrap properties used to render the caption.


.. container:: table-row

   Property
         altText

         titleText

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Default altText/titleText if no alternatives are provided by the
         :ref:`->IMAGE <cobj-image>` cObjects.

         If alttext is not specified, an empty alttext will be used.


.. container:: table-row

   Property
         emptyTitleHandling

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Value can be "keepEmpty" to preserve an empty title attribute, or
         "useAlt" to use the alt attribute instead.

   Default
         useAlt


.. container:: table-row

   Property
         longdescURL

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Default longdescURL if no alternatives are provided by the :ref:`->IMAGE <cobj-image>`
         cObjects

         "longdesc" attribute (URL pointing to document with extensive details
         about image).


.. container:: table-row

   Property
         border

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If true, a border i generated around the images.


.. container:: table-row

   Property
         borderCol

   Data type
         *HTML-color* /:ref:`stdWrap <stdwrap>`

   Description
         Color of the border, if ".border" is set

   Default
         black


.. container:: table-row

   Property
         borderThick

   Data type
         :ref:`pixels <data-type-pixels>` /:ref:`stdWrap <stdwrap>`

   Description
         Width of the border around the pictures

   Default
         1


.. container:: table-row

   Property
         cols

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Number of columns.


.. container:: table-row

   Property
         rows

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Number of rows (higher priority than "cols").


.. container:: table-row

   Property
         noRows

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If set, the rows are not divided by a table-rows. Thus images are more
         nicely shown if the height differs a lot (normally the width is the
         same!)


.. container:: table-row

   Property
         noCols

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If set, the columns are not made in the table. The images are all put
         in one row separated by a clear gif-file to space them apart.

         If noRows is set, noCols will be unset. They cannot be set
         simultaneously.


.. container:: table-row

   Property
         colSpace

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Space between columns.

   Default
         0


.. container:: table-row

   Property
         rowSpace

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Space between rows.

   Default
         0


.. container:: table-row

   Property
         spaceBelowAbove

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Pixel space between content an images when position of image is above
         or below text (but not in text)

   Default
         0


.. container:: table-row

   Property
         tableStdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         This passes the final <table> code for the image block to the stdWrap
         function.


.. container:: table-row

   Property
         maxW

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Maximum width of the image-table.

         This will scale images not in the right size! Takes the number of
         columns into account!

         **Note:** Works ONLY if the :ref:`IMAGE <cobj-image>` object is **not** :ref:`GIFBUILDER <gifbuilder>`!


.. container:: table-row

   Property
         maxWInText

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Maximum width of the image-table, if the text is wrapped around the
         image-table (on the left or right side).

         This will scale images not in the right size! Takes the number of
         columns into account!

         **Note:** Works ONLY if the :ref:`IMAGE <cobj-image>` object is **not** :ref:`GIFBUILDER <gifbuilder>`!

   Default
         50% of maxW


.. container:: table-row

   Property
         equalH

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         If this value is greater than zero, it will secure that images in a
         row has the same height. The width will be calculated.

         If the total width of the images raise above the "maxW"-value of the
         table the height for each image will be scaled down equally so that
         the images still have the same height but is within the limits of the
         totalWidth.

         Please note that this value will override the properties "width",
         "maxH", "maxW", "minW", "minH" of the :ref:`IMAGE <cobj-image>` objects generating the
         images. Furthermore it will override the "noRows"-property and
         generate a table with no columns instead!


.. container:: table-row

   Property
         colRelations

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         This value defines the width-relations of the images in the columns of
         IMGTEXT. The syntax is "[integer] : [integer] : [integer] : ..." for
         each column. If there are more image columns than figures in this
         value, it's ignored. If the relation between two of these figures
         exceeds 10, this function is ignored.

         It works only fully if all images are downscaled by their maxW-
         definition.

         **Example:**

         If 6 images are placed in three columns and their width's are high
         enough to be forcibly scaled, this value will scale the images in the
         to be e.g. 100, 200 and 300 pixels from left to right::

            1 : 2 : 3


.. container:: table-row

   Property
         image\_compression

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Set to one of the following numbers to get the according kind of image
         compression:

         0 = Default (no image compression)

         1 = Do not change the image (removes all parameters except "import"
         and its sub-properties for the image object!)

         *The following numbers add gif extension and color-reduction command:*

         10 = GIF/colors unchanged (up to 256 colors)

         11 = GIF/128 colors

         12 = GIF/64 colors

         13 = GIF/32 colors

         14 = GIF/16 colors

         15 = GIF/8 colors

         *The following numbers add jpg extension and quality command:*

         20 = JPG/quality 100

         21 = JPG/quality 90 <=> Photoshop 60 (JPG/Very High)

         22 = JPG/quality 80 (JPG/High)

         23 = JPG/quality 70

         24 = JPG/quality 60 <=> Photoshop 30 (JPG/Medium)

         25 = JPG/quality 50

         26 = JPG/quality 40 (JPG/Low)

         27 = JPG/quality 30 <=> Photoshop 10

         28 = JPG/quality 20 (JPG/Very Low)

         *The following numbers add png extension and color-reduction command:*

         30 = PNG/256 colors

         31 = PNG/128 colors

         32 = PNG/64 colors

         33 = PNG/32 colors

         34 = PNG/16 colors

         35 = PNG/8 colors

         39 = PNG/colors unchanged (up to 256 colors)

         The default GraphicsMagick/ImageMagick quality seems to be 75. This
         equals Photoshop quality 45. Images compressed with
         GraphicsMagick/ImageMagick with the same visual quality as a
         Photoshop-compressed image seem to be largely 50% greater in size!

         **Note:** Works ONLY if the :ref:`IMAGE <cobj-image>` object is **not** :ref:`GIFBUILDER <gifbuilder>`!


.. container:: table-row

   Property
         image\_effects

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Set to one of the following numbers to get the according effect. Adds
         the respective commands to the parameters for the scaling. This
         function has no effect if "image\_compression" above is set to 1!

         1 = "-rotate 90",

         2 = "-rotate 270",

         3 = "-rotate 180",

         10 = "-colorspace GRAY",

         11 = "-sharpen 70",

         20 = "-normalize",

         23 = "-contrast",

         25 = "-gamma 1.3",

         26 = "-gamma 0.8"

         **Note:** Works ONLY if the :ref:`IMAGE <cobj-image>` object is **not** :ref:`GIFBUILDER <gifbuilder>`!


.. container:: table-row

   Property
         image\_frames

   Data type
         Array

         \+ .key /:ref:`stdWrap <stdwrap>`

   Description
         **Frames:**

         .key points to the frame used.

         ".image\_frames.x" is imgResource-mask (".m")properties which will
         override to the [imgResource].m properties of the imageObjects. This
         is used to mask the images into a frame. See how it's done in the
         default configuration and IMGTEXT in the static\_template-table.

         **Example:** ::

            1 {
              mask = fileadmin/darkroom1_mask.jpg
              bgImg = GIFBUILDER
              bgImg {
                XY = 100,100
                backColor = {$bgCol}
              }
              bottomImg = GIFBUILDER
              bottomImg {
                XY = 100,100
                backColor = black
              }
              bottomImg_mask = fileadmin/darkroom1_bottom.jpg
            }

         **Note:** This cancels the jpg-quality settings sent as ordinary
         ".params" to the imgResource. In addition the output of this operation
         will always be jpg or gif!

         **Note:** Works ONLY if the :ref:`IMAGE <cobj-image>` object is **not** :ref:`GIFBUILDER <gifbuilder>`!


.. container:: table-row

   Property
         editIcons

   Data type
         string

   Description
         (See stdWrap.editIcons)


.. container:: table-row

   Property
         noStretchAndMarginCells

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If set (1), the cells used to add left and right margins plus stretch
         out the table will not be added. You will loose the ability to set
         margins for the object if entered "in text". So it's not recommended,
         but it has been requested by some people for reasons.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).IMGTEXT]


.. _cobj-imgtext-examples:

Example:
""""""""

::

   tt_content.textpic.default {
     5 = IMGTEXT
     5 {
       text < tt_content.text.default
       imgList.field = image
       textPos.field = imageorient
       imgPath = uploads/pics/
       imgObjNum = 1
       1 {
          file.import.current = 1
          file.width.field = imagewidth
          imageLinkWrap = 1
          imageLinkWrap {
            bodyTag = <body style="background-color: black;">
            wrap = <a href="javascript:close();"> | </A>
            width = 800m
            height = 600m
            JSwindow = 1
            JSwindow.newWindow = 1
            JSwindow.expand = 17,20
          }
       }
       maxW = 450
       maxWInText = 300
       cols.field = imagecols
       border.field = imageborder
       caption {
         1 = TEXT
         1.field = imagecaption
         1.wrap = <p style="font-size: 12px;"> |</p>
         1.wrap2 = {$cBodyTextWrap}
       }
       borderThick = 2
       colSpace = 10
       rowSpace = 10
       textMargin = 10
     }
     30 = TEXT
     30.value = <br>
   }

