.. include:: /Includes.rst.txt
.. index:: Content objects; IMAGE_RESOURCE
.. _cobj-img-resource:

=============
IMG\_RESOURCE
=============

Objects of type IMG_RESOURCE returns a reference to an image, possibly
wrapped with :t3-cobj-img-resource:`stdWrap`. Can
for example be used for putting background images in tables or
table rows or to import an image in your own include scripts.

The array :php:`$GLOBALS['TSFE']->lastImgResourceInfo` is set to the info
array of the resulting image resource (if any) and contains width,
height and so on (similar to how :php:`$GLOBALS['TSFE']->lastImageInfo`
does for the cObject IMAGE).

Depending on your use case you might prefer using the cObject
:ref:`IMAGE <cobj-image>`, which creates a complete :html:`img` tag.

.. contents::
   :local:

Properties
==========

file
----

..  t3-cobj-img-resource:: file

    :Data type: imgResource

stdWrap
-------

..  t3-cobj-img-resource:: stdWrap

    :Data type: :ref:`->stdWrap <stdwrap>`
