.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _data-type-imgresource:

imgResource
===========

.. container:: table-row

   Data type
         imgResource

   Examples
         Here "file" is an imgResource::

            10 = IMAGE
            10.file = fileadmin/toplogo.gif
            10.file.width = 200

         GIFBUILDER::

            10 = IMAGE
            10.file = GIFBUILDER
            10.file {
               # GIFBUILDER properties here...
            }

   Comment
         #. A "resource" (see above) plus imgResource properties (see the example
            and the object reference for imgResource below).

            Filetypes can be anything among the allowed types defined in the
            configuration variable $TYPO3\_CONF\_VARS['GFX']['imagefile\_ext'].
            Standard is pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

         #. A GIFBUILDER object. See the object reference for GIFBUILDER below.



