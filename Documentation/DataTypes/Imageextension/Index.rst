.. include:: ../../Includes.txt


.. _data-type-imageextension:

imageExtension
==============

.. container:: table-row

   Data type
         imageExtension

   Examples
         jpg

         web *(gif or jpg ..)*

   Comment
         Image extensions can be anything among the allowed types defined in
         the global variable $TYPO3\_CONF\_VARS['GFX']['imagefile\_ext'].
         Standard is pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

         The value **"web"** is special. This will just ensure that an image is
         converted to a web image format (gif or jpg) if it happens not to be
         already!



