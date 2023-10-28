..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; BOX
..  _gifbuilder-box:

===
BOX
===

Prints a filled box.

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         dimensions

   Data type
         x,y,w,h +calc /:ref:`stdWrap <stdwrap>`

   Description
         Dimensions of a filled box.

         x,y is the offset.

         w,h are the dimensions. Dimensions of 1 will result in 1-pixel wide
         lines!


.. container:: table-row

   Property
         color

   Data type
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

   Default
         black

   Description
         Fill color of the box.



.. container:: table-row

   Property
         opacity

   Data type
         positive integer (1-100) /:ref:`stdWrap <stdwrap>`

   Default
         100

   Description
         The degree to which the box conceals the background. Mathematically
         speaking: Opacity = Transparency^-1. E.g. 100% opacity = 0%
         transparency.



.. container:: table-row

   Property
         align

   Data type
         VHalign /:ref:`stdWrap <stdwrap>`

   Default
         l, t

   Description
         Pair of values, which defines the horizontal and vertical alignment of
         the box in the image.

         **Values:**

         Horizontal alignment: r/c/l standing for right, center, left

         Vertical alignment: t/c/b standing for top, center, bottom

         **Example:**

         Horizontally centered, vertically at the bottom:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            align = c, b



.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).BOX]
