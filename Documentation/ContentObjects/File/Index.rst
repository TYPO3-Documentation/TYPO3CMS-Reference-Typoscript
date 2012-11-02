.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-file:

FILE
^^^^

This object returns the content of the file specified in the property
"file".

It is defined as PHP function fileResource() in
typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php
(/typo3/sysext/cms/tslib/class.tslib\_content.php).

**Note** : Do not mix this up with the cObject FILES; both are
different cObjects.


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
         resource /stdWrap

   Description
         The file whose content should be returned.

         If the resource is  **jpg, jpeg, gif or png** the image is inserted as
         an image-tag. All other formats are read and inserted into the HTML-
         code.

         The maximum filesize of documents to be read is set to 1024 kb
         internally!

   Default


.. container:: table-row

   Property
         linkWrap

   Data type
         linkWrap /stdWrap

   Description
         (Executed before ".wrap" and ".stdWrap".)

   Default


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description
         (Executed after ".linkWrap" and before ".stdWrap".)

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         (Executed after ".linkWrap" and ".wrap".)

   Default


.. container:: table-row

   Property
         altText

         titleText

   Data type
         string /stdWrap

   Description
         **For <img> output only!**

         If no alttext is specified, it will use an empty alttext.

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
         **For <img> output only!**

         "longdesc" attribute (URL pointing to document with extensive details
         about image).

   Default


.. ###### END~OF~TABLE ######


[tsref:(cObject).FILE]


.. _cobj-file-examples:

Example:
""""""""

In this example a page is defined, but the content between the body-
tags comes directly from the file "gs.html"::

   page = PAGE
   page.typeNum = 0
   page.10 = FILE
   page.10.file = fileadmin/gs/gs.html

