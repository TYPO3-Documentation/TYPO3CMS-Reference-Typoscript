..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; IMAGE
..  _gifbuilder-image:

=====
IMAGE
=====

Renders an image file.

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         imgResource

   Description
         The image file.


.. container:: table-row

   Property
         offset

   Data type
         x,y +calc /:ref:`stdWrap <stdwrap>`

   Default
         0,0

   Description
         Offset of the image



.. container:: table-row

   Property
         tile

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Default
         1,1

   Description
         Repeat the image x,y times (which creates the look of tiles).

         Maximum number of times in each direction is 20. If you need more,
         use a larger image.


.. container:: table-row

   Property
         align

   Data type
         VHalign /:ref:`stdWrap <stdwrap>`

   Description
         *See in the "Data types reference" at the beginning of this document
         or in the table "BOX".*


.. container:: table-row

   Property
         mask

   Data type
         imgResource

   Description
         Optional mask-image for the image file.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).IMAGE]
