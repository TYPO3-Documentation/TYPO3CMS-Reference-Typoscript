.. include:: ../../Includes.txt


.. _data-type-imgresource:

===========
imgResource
===========

.. container:: table-row

   Data type
         imgResource

   Examples
         Here "file" is an imgResource::

            10 = IMAGE
            10 {
                file = fileadmin/toplogo.gif
                file.width = 200
            }

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
            configuration variable :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']`.
            Standard is pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

         #. A GIFBUILDER object. See the object reference for :ref:`gifbuilder` below.
