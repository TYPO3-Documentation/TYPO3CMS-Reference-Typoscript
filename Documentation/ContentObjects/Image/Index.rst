.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-image:

IMAGE
^^^^^

Returns an image tag with the image file defined in the property
"file" and processed according to the properties set.

Defined as PHP function cImage() in
typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php
(/typo3/sysext/cms/tslib/class.tslib\_content.php).

The array $GLOBALS['TSFE']->lastImageInfo is set with the info-array
of the returning image (if any) and contains width, height and so on:

=============================  ==========================================
Name of the getText property   Content
=============================  ==========================================
0                              width
1                              height
2                              file extension
3                              resource
origFile                       path and file name of the original file
_mtime                         modification time of the original file
=============================  ==========================================

**Note:** Gifbuilder also has an :ref:`IMAGE object <gifbuilder-image>` -
do not mix that one up with the cObject described here; both are
different objects.

If you only need the file path to the (possibly resized and also
otherwise adjusted) image, the cObject
:ref:`IMG_RESOURCE <cobj-img-resource>` might be what you are looking
for.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         if

   Data type
         :ref:`->if <if>`

   Description
         If "if" returns false, the image is not shown!


.. container:: table-row

   Property
         file

   Data type
         imgResource


.. container:: table-row

   Property
         params

   Data type
         <IMG>-params /:ref:`stdWrap <stdwrap>`


.. container:: table-row

   Property
         border

   Data type
         integer

   Description
         Value of the "border" attribute of the image tag.

   Default
         0


.. container:: table-row

   Property
         altText

         titleText

         (alttext)

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If no alt text is specified, an empty alt text will be used.

         ("alttext" is the old spelling of this attribute. It was deprecated
         since TYPO3 4.3 and was used only if "altText" did not specify a value
         or properties. In TYPO3 4.6 "alttext" has been removed.)


.. container:: table-row

   Property
         emptyTitleHandling

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Value can be "keepEmpty" to preserve an empty title attribute, or
         "useAlt" to use the alt attribute instead.

   Default
         useAlt


.. container:: table-row

   Property
         longdescURL

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         "longdesc" attribute (URL pointing to document with extensive details
         about image).


.. container:: table-row

   Property
         linkWrap

   Data type
         :ref:`linkWrap <data-type-linkwrap>` /:ref:`stdWrap <stdwrap>`

   Description
         (before ".wrap")


.. container:: table-row

   Property
         imageLinkWrap

   Data type
         boolean/ :ref:`->imageLinkWrap <imagelinkwrap>`

   Description
         **Note:** Only active if linkWrap is **not** set and file is
         **not** :ref:`GIFBUILDER <gifbuilder>` (as it works with the original image file).


.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wrap for the image tag.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######


[tsref:(cObject).IMAGE]


.. _cobj-image-examples:

Example:
""""""""

::

       10 = IMAGE
       # toplogo.gif has the dimensions 300 x 150 pixels.
       10.file = fileadmin/toplogo.gif
       10.params = style="margin: 0px 20px;"
       10.wrap = |<br>

This returns ::

   <img src="fileadmin/toplogo.gif" width="300" height="150" border="0" style="margin: 0px 20px;" alt=""><br>

