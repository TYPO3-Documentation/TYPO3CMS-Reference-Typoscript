..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; CROP
..  _gifbuilder-crop:

====
CROP
====

**Note:** This object resets workArea to the new dimensions of the
image!

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         backColor

   Data type
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

   Default
         The original backColor

   Description
         *See "Data types reference".*



.. container:: table-row

   Property
         align

   Data type
         VHalign /:ref:`stdWrap <stdwrap>`

   Default
         l, t

   Description
         Horizontal and vertical alignment of the crop frame.

         *See "Data types reference".*



.. container:: table-row

   Property
         crop

   Data type
         x,y,w,h + calc /:ref:`stdWrap <stdwrap>`

   Description
         x,y is the offset of the crop-frame from the position specified by
         "align".

         w,h are the dimensions of the frame.

         For the usage of "calc" see the according note at the beginning of the
         section "GIFBUILDER".


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).CROP]
