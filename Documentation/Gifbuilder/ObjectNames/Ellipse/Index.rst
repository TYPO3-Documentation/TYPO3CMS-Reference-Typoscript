..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; ELLIPSE
..  _gifbuilder-ellipse:

=======
ELLIPSE
=======

Prints a filled ellipse.

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         dimensions

   Data type
         x,y,w,h +calc /:ref:`stdWrap <stdwrap>`

   Description
         Dimensions of a filled ellipse.

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
         Fill color of the ellipse.



.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).ELLIPSE]

Example
=======

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   file = GIFBUILDER
   file {
     XY = 200,200
     format = jpg
     quality = 100
     10 = ELLIPSE
     10.dimensions = 100,100,50,50
     10.color = red
   }
