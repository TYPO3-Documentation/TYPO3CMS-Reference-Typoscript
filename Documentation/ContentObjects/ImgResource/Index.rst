.. include:: /Includes.rst.txt


.. _cobj-img-resource:

=============
IMG\_RESOURCE
=============

Objects of type IMG_RESOURCE returns a reference to an image, possibly wrapped with stdWrap. Can
for example be used for putting background images in tables or
table-rows or to import an image in your own include-scripts.

The array $GLOBALS['TSFE']->lastImgResourceInfo is set to the info-
array of the resulting image resource (if any) and contains width,
height and so on (similar to how $GLOBALS['TSFE']->lastImageInfo
does for the cObject IMAGE).

Depending on your use case you might prefer using the cObject
:ref:`IMAGE <cobj-image>`, which creates a complete img-tag.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         imgResource


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).IMG\_RESOURCE]

