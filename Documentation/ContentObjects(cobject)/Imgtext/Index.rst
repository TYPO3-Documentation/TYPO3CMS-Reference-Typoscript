.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


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
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         text

   Data type
         ->CARRAY /stdWrap

   Description
         Use this to import / generate the content, that should flow around the
         image block.

   Default


.. container:: table-row

   Property
         textPos

   Data type
         int /stdWrap

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

   Default


.. container:: table-row

   Property
         textMargin

   Data type
         pixels /stdWrap

   Description
         Margin between the image and the content.

   Default


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


.. container:: table-row

   Property
         imgList

   Data type
         *list of imagefiles* /stdWrap

   Description
         List of images from ".imgPath".

         **Example:**

         This imports the list of images from tt\_content's image-field. ::

            imgList.field = image

   Default


.. container:: table-row

   Property
         imgPath

   Data type
         path /stdWrap

   Description
         Path to the images.

         **Example:**

         "uploads/pics/"

   Default


.. container:: table-row

   Property
         imgMax

   Data type
         int /stdWrap

   Description
         Maximum number of images.

   Default


.. container:: table-row

   Property
         imgStart

   Data type
         int /stdWrap

   Description
         Start with image-number ".imgStart".

   Default


.. container:: table-row

   Property
         imgObjNum

   Data type
         *imgObjNum* +optionSplit

   Description
         Here you define, which IMAGE-cObjects from the array "1,2,3,4..." in
         this object that should render the images.

         "current" is set to the image-filename.

         **Example:** ::

            imgObjNum = 1 |*||*| 2

         This would render the first two images with "1. ..." and the last
         image with "2. ...", provided that the ".imgList" contains 3 images.

   Default


.. container:: table-row

   Property
         1,2,3,4

   Data type
         ->IMAGE (cObject)

   Description
         Rendering of the images.

         The register "IMAGE\_NUM" is set with the number of image being
         rendered for each rendering of an image-object. Starting with zero.

         The image-object should not be of type GIFBUILDER!

         **Important:**

         "file.import.current = 1" fetches the name of the images!

   Default


.. container:: table-row

   Property
         caption

   Data type
         ->CARRAY /stdWrap

   Description
         Caption.

   Default


.. container:: table-row

   Property
         captionAlign

   Data type
         align /stdWrap

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
         from ".token" , and every item is displayed under an image each in the
         image block.

         .token = (string /stdWrap) Character to split the caption elements
         (default is chr(10))

         .cObject = cObject, used to fetch the caption for the split

         .stdWrap = stdWrap properties used to render the caption.

   Default


.. container:: table-row

   Property
         altText

         titleText

   Data type
         string /stdWrap

   Description
         Default altText/titleText if no alternatives are provided by the
         ->IMAGE cObjects.

         If alttext is not specified, an empty alttext will be used.

   Default


.. container:: table-row

   Property
         emptyTitleHandling

   Data type
         string /stdWrap

   Description
         Value can be "keepEmpty" to preserve an empty title attribute, or
         "useAlt" to use the alt attribute instead.

   Default
         useAlt


.. container:: table-row

   Property
         longdescURL

   Data type
         string /stdWrap

   Description
         Default longdescURL if no alternatives are provided by the ->IMAGE
         cObjects

         "longdesc" attribute (URL pointing to document with extensive details
         about image).

   Default


.. container:: table-row

   Property
         border

   Data type
         boolean /stdWrap

   Description
         If true, a border i generated around the images.

   Default


.. container:: table-row

   Property
         borderCol

   Data type
         *HTML-color* /stdWrap

   Description
         Color of the border, if ".border" is set

   Default
         black


.. container:: table-row

   Property
         borderThick

   Data type
         pixels /stdWrap

   Description
         Width of the border around the pictures

   Default
         1


.. container:: table-row

   Property
         cols

   Data type
         int /stdWrap

   Description
         Columns

   Default


.. container:: table-row

   Property
         rows

   Data type
         int /stdWrap

   Description
         Rows (higher priority thab "cols")

   Default


.. container:: table-row

   Property
         noRows

   Data type
         boolean /stdWrap

   Description
         If set, the rows are not divided by a table-rows. Thus images are more
         nicely shown if the height differs a lot (normally the width is the
         same!)

   Default


.. container:: table-row

   Property
         noCols

   Data type
         boolean /stdWrap

   Description
         If set, the columns are not made in the table. The images are all put
         in one row separated by a clear giffile to space them apart.

         If noRows is set, noCols will be unset. They cannot be set
         simultaneously.

   Default


.. container:: table-row

   Property
         colSpace

   Data type
         int /stdWrap

   Description
         Space between columns.

   Default


.. container:: table-row

   Property
         rowSpace

   Data type
         int /stdWrap

   Description
         Space between rows.

   Default


.. container:: table-row

   Property
         spaceBelowAbove

   Data type
         int /stdWrap

   Description
         Pixel space between content an images when position of image is above
         or below text (but not in text)

   Default


.. container:: table-row

   Property
         tableStdWrap

   Data type
         ->stdWrap

   Description
         This passes the final <table> code for the image block to the stdWrap
         function.

   Default


.. container:: table-row

   Property
         maxW

   Data type
         int /stdWrap

   Description
         Maximum width of the image-table.

         This will scale images not in the right size! Takes the number of
         columns into account!

         **NOTE:** Works ONLY if IMAGE-obj is NOT GIFBUILDER!

   Default


.. container:: table-row

   Property
         maxWInText

   Data type
         int /stdWrap

   Description
         Maximum width of the image-table, if the text is wrapped around the
         image-table (on the left or right side).

         This will scale images not in the right size! Takes the number of
         columns into account!

         **NOTE:** Works ONLY if IMAGE-obj is NOT GIFBUILDER!

   Default
         50% of maxW


.. container:: table-row

   Property
         equalH

   Data type
         int /stdWrap

   Description
         If this value is greater than zero, it will secure that images in a
         row has the same height. The width will be calculated.

         If the total width of the images raise above the "maxW"-value of the
         table the height for each image will be scaled down equally so that
         the images still have the same height but is within the limits of the
         totalWidth.

         Please note that this value will override the properties "width",
         "maxH", "maxW", "minW", "minH" of the IMAGE-objects generating the
         images. Furthermore it will override the "noRows"-property and
         generate a table with no columns instead!

   Default


.. container:: table-row

   Property
         colRelations

   Data type
         string /stdWrap

   Description
         This value defines the width-relations of the images in the columns of
         IMGTEXT. The syntax is "[int] : [int] : [int] : ..." for each column.
         If there are more image columns than figures in this value, it's
         ignored. If the relation between two of these figures exceeds 10, this
         function is ignore.

         It works only fully if all images are downscaled by their maxW-
         definition.

         **Example:**

         If 6 images are placed in three columns and their width's are high
         enough to be forcibly scaled, this value will scale the images in the
         to be e.g. 100, 200 and 300 pixels from left to right

         1 : 2 : 3

   Default


.. container:: table-row

   Property
         image\_compression

   Data type
         int /stdWrap

   Description
         Image Compression:

         0= Default

         1= Don't change! (removes all parameters for the image\_object!!)

         (adds gif-extension and color-reduction command)

         10= GIF/256

         11= GIF/128

         12= GIF/64

         13= GIF/32

         14= GIF/16

         15= GIF/8

         (adds jpg-extension and quality command)

         20= IM: -quality 100

         21= IM: -quality 90 <=> Photoshop 60 (JPG/Very High)

         22= IM: -quality 80 (JPG/High)

         23= IM: -quality 70

         24= IM: -quality 60 <=> Photoshop 30 (JPG/Medium)

         25= IM: -quality 50

         26= IM: -quality 40 (JPG/Low)

         27= IM: -quality 30 <=> Photoshop 10

         28= IM: -quality 20 (JPG/Very Low)

         (adds png-extension and color-reduction command)

         30= PNG/256

         31= PNG/128

         32= PNG/64

         33= PNG/32

         34= PNG/16

         35= PNG/8

         39= PNG

         The default ImageMagick quality seems to be 75. This equals Photoshop
         quality 45. Images compressed with ImageMagick with the same visual
         quality as a Photoshop-compressed image seem to be largely 50% greater
         in size!!

         **NOTE:** Works ONLY if IMAGE-obj is NOT GIFBUILDER

   Default


.. container:: table-row

   Property
         image\_effects

   Data type
         int /stdWrap

   Description
         Adds these commands to the parameters for the scaling. This function
         has no effect if "image\_compression" above is set to 1!!

         1 => "-rotate 90",

         2 => "-rotate 270",

         3 => "-rotate 180",

         10 => "-colorspace GRAY",

         11 => "-sharpen 70",

         20 => "-normalize",

         23 => "-contrast",

         25 => "-gamma 1.3",

         26 => "-gamma 0.8"

         **NOTE:** Works ONLY if IMAGE-obj is NOT GIFBUILDER

   Default


.. container:: table-row

   Property
         image\_frames

   Data type
         Array

         \+ .key /stdWrap

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

         **NOTE:** This cancels the jpg-quality settings sent as ordinary
         ".params" to the imgResource. In addition the output of this operation
         will always be jpg or gif!

         **NOTE:** Works ONLY if IMAGE-obj is NOT GIFBUILDER

   Default


.. container:: table-row

   Property
         editIcons

   Data type
         string

   Description
         (See stdWrap.editIcons)

   Default


.. container:: table-row

   Property
         noStretchAndMarginCells

   Data type
         boolean /stdWrap

   Description
         If set (1), the cells used to add left and right margins plus stretch
         out the table will not be added. You will loose the ability to set
         margins for the object if entered "in text". So it's not recommended,
         but it has been requested by some people for reasons.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).IMGTEXT]


((generated))
"""""""""""""

Example:
~~~~~~~~

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
            bodyTag = <BODY bgColor=black>
            wrap = <A href="javascript:close();"> | </A>
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
         1.wrap = <font size="1"> |</font>
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

