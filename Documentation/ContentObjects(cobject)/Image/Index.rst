

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


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
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         file
   
   Data type
         imgResource
   
   Description
   
   
   Default


.. container:: table-row

   Property
         params
   
   Data type
         <IMG>-params /stdWrap
   
   Description
   
   
   Default


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
   
   Default


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
   
   Default


.. container:: table-row

   Property
         linkWrap
   
   Data type
         linkWrap /stdWrap
   
   Description
         (before ".wrap")
   
   Default


.. container:: table-row

   Property
         imageLinkWrap
   
   Data type
         boolean/
         
         ->imageLinkWrap
   
   Description
         **NOTE:** ONLY active if linkWrap is NOT set and file is NOT
         GIFBUILDER (as it works with the original imagefile)
   
   Default


.. container:: table-row

   Property
         if
   
   Data type
         ->if
   
   Description
         if "if" returns false the image is not shown!
   
   Default


.. container:: table-row

   Property
         wrap
   
   Data type
         wrap /stdWrap
   
   Description
   
   
   Default


.. container:: table-row

   Property
         stdWrap
   
   Data type
         ->stdWrap
   
   Description
   
   
   Default


.. ###### END~OF~TABLE ######


[tsref:(cObject).IMAGE]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

       10 = IMAGE 
       10.file = toplogo*.gif
       10.params = hspace=5
       10.wrap = |<BR>

