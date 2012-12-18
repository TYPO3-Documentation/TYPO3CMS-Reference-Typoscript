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
of the returning image (if any) and contains width, height and so on.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         imgResource


.. container:: table-row

   Property
         params

   Data type
         <IMG>-params /stdWrap


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
         string /stdWrap

   Description
         If no alt text is specified, an empty alt text will be used.

         ("alttext" is the old spelling of this attribute. It was deprecated
         since TYPO3 4.3 and was used only if "altText" did not specify a value
         or properties. In TYPO3 4.6 "alttext" has been removed.)


.. container:: table-row

   Property
         emptyTitleHandling

   Data type
         string /stdWrap

   Description
         Value can be "keepEmpty" to preserve an empty title attribute, or
         "useAlt" to use the alt attribute instead.

   Default
         useAlt


.. container:: table-row

   Property
         longdescURL

   Data type
         string /stdWrap

   Description
         "longdesc" attribute (URL pointing to document with extensive details
         about image).


.. container:: table-row

   Property
         linkWrap

   Data type
         linkWrap /stdWrap

   Description
         (before ".wrap")


.. container:: table-row

   Property
         imageLinkWrap

   Data type
         boolean/

         ->imageLinkWrap

   Description
         **Note:** Only active if linkWrap is **not** set and file is
         **not** GIFBUILDER (as it works with the original image file).


.. container:: table-row

   Property
         if

   Data type
         ->if

   Description
         If "if" returns false, the image is not shown!


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description
         Wrap for the image tag.


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap


.. ###### END~OF~TABLE ######


[tsref:(cObject).IMAGE]


.. _cobj-image-examples:

Example:
""""""""

::

       10 = IMAGE
       10.file = toplogo*.gif
       10.params = style="margin: 0px 20px;"
       10.wrap = |<br>

