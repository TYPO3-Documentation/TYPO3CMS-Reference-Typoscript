.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _imgmenuitem:

IMGMENUITEM
^^^^^^^^^^^

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
         1,2,3,4...

   Data type
         ->GifBuilderObj

   Description
         **Note:**

         The way an imagemap is made is this; All IMGMENUITEMS are included in
         one big Gifbuilderobj (and renumbered!). Because of this,
         Gifbuilderobjects on the next level will not be able to access the
         data of each menuitem.

         Also the feature of using [##.w] and [##.h] with +calc is currently
         not supported by IMGMENUITEMs.

         Therefore all IMAGE-objects on the first level is checked; if "file"
         or "mask" for any IMAGE-objects are set to "GIFBUILDER", the
         Gifbuilder-object is parsed to see if any TEXT-objects are present and
         if so, the TEXT-object is "checked" - which means, that the stdWrap-
         function is called at a time where the $cObj->data-array is set to the
         actual menuitem.

         In the example below, the text of each menuitem is rendered by letting
         the title be rendered on a mask instead of directly on the image.
         Please observe that the "NO.10"-object is present in order for the
         image-map coordinates to be generated! ::

            NO.6 = IMAGE
            NO.6.file = masked_pencolor*.gif
            NO.6.mask = GIFBUILDER
            NO.6.mask {
              XY = 500, 200
              backColor = black
              10 = TEXT
              10 {
                text.field = title
                fontFile = fileadmin/fonts/caflisch.ttf
                fontSize = 34
                fontColor = white
                angle = 15
                offset = 48,110
              }
              20 = EFFECT
              20.value = blur=80
            }
            NO.10 = TEXT
            NO.10 {
              text.field = title
              fontFile = fileadmin/fonts/caflisch.ttf
              fontSize = 34
              angle = 15
              offset = 48,110
              hideButCreateMap = 1
            }


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).IMGMENUITEM]

