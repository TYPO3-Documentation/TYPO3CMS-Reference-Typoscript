.. include:: ../../Includes.txt


.. _data-type-graphiccolor:

============
GraphicColor
============

.. container:: table-row

   Data type
         GraphicColor

   Examples
         red *(HTML-color)*

         #ffeecc *(HTML-color)*

         255,0,255 *(RGB-integers)*

         *Extra:*

         red *: \*0.8 ("red" is darkened by factor 0.8)*

         #ffeecc *: +16 ("ffeecc" is going to #fffedc because 16 is added)*

   Comment
         The color can be given as HTML-color or as a comma-separated list of
         RGB-values (integers).

         You can add an extra parameter that will modify the color
         mathematically:

         Syntax:

         [colordef] : [modifier]

         where modifier can be an integer which is added/subtracted to the
         three RGB-channels or a floating point with an "\*" before, which will
         then multiply the values with that factor.
