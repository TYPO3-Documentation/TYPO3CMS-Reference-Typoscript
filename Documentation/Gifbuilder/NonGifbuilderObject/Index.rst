.. include:: ../../Includes.txt
.. _gifbuilder-non-gifbuilder:

======================
NON-Gifbuilder Objects
======================



.. index:: GIFBUILDER; IMGMAP
.. _gifbuilder-imgmap:

IMGMAP
======

This is used by the Gifbuilder Object "TEXT" to create an image-map for
the image file.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         url

   Data type
         string

   Description
         The URL to link.


.. container:: table-row

   Property
         target

   Data type
         target

   Description
         target for link


.. container:: table-row

   Property
         explode

   Data type
         x,y

   Description
         This "explodes" or "implodes" the image-map. Useful to let the hot
         area cover a little more than just the letters of the text.


.. container:: table-row

   Property
         altText

   Data type
         string

   Description
         Value of the alt-attribute.

         (Used from TEXT Gifbuilding objects, this has stdWrap properties.
         Otherwise not)


.. container:: table-row

   Property
         titleText

   Data type
         string

   Description
         Value of the title attribute.

         (Used from TEXT Gifbuilding objects, this has stdWrap properties.
         Otherwise not)


.. ###### END~OF~TABLE ######

[tsref:->IMGMAP]

