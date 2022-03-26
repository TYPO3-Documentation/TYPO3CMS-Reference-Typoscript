.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: /Includes.rst.txt


.. _cobj-file:

FILE
^^^^

This object returns the content of the file specified in the property
"file".

It is defined as PHP function fileResource() in
typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php.

**Note:** Do not mix this up with the cObject :ref:`FILES <cobj-files>`; both are
different cObjects.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         :ref:`resource <data-type-resource>` /:ref:`stdWrap <stdwrap>`

   Description
         The file whose content should be returned.

         If the resource is **jpg, jpeg, gif or png** the image is inserted as
         an image-tag. All other formats are read and inserted into the HTML
         code.

         The maximum filesize of documents to be read is set to 1024 KB
         internally!


.. container:: table-row

   Property
         linkWrap

   Data type
         :ref:`linkWrap <data-type-linkwrap>` /:ref:`stdWrap <stdwrap>`

   Description
         (Executed before ".wrap" and ".stdWrap".)


.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         (Executed after ".linkWrap" and before ".stdWrap".)


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         (Executed after ".linkWrap" and ".wrap".)


.. container:: table-row

   Property
         altText

         titleText

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         **For <img> output only!**

         If no alttext is specified, it will use an empty alttext.


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
         **For <img> output only!**

         "longdesc" attribute (URL pointing to document with extensive details
         about image).


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

