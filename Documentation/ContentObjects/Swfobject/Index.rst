.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-swfobject:

SWFOBJECT
^^^^^^^^^

This object will insert a Flash player driven by JavaScript.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Media file or URL.

         **Note:** Files are treated as URLs. You need to set fully
         qualified URLs. Use config.baseURL and/or config.absRefPrefix to get
         fully qualified URLs automatically.


.. container:: table-row

   Property
         width

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Width of the swfObject.

         If it is not set, it will be filled with defaultWidth of the player
         configuration.


.. container:: table-row

   Property
         height

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Height of the swfObject.

         If it is not set, it will be filled with defaultHeight of the player
         configuration.


.. container:: table-row

   Property
         type

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Sets default for different media types. E.g. "audio" or "video". If
         value is "audio", the player configuration audio.player will be used.


.. container:: table-row

   Property
         [type].player

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Location of the player.


.. container:: table-row

   Property
         [type].player.default

   Data type
         array

   Description
         Default parameter for flashvars / params / attributes.

         Usage:

         default {

         flashvars.allowFullScreen = true

         params.wmode = transparent

         attributes.align = center

         }

         flashvars are used for swf file configuration. There is no standard
         across players, but for flvplayer see description below.

         For detailed description of possible params/attributes visit this URL:

         `http://livedocs.adobe.com/flash/9.0/UsingFlash/help.html?content=WSd6
         0f23110762d6b883b18f10cb1fe1af6-7ba7.html <http://livedocs.adobe.com/f
         lash/9.0/UsingFlash/help.html?content=WSd60f23110762d6b883b18f10cb1fe1
         af6-7ba7.html>`_


.. container:: table-row

   Property
         [type].player.defaultWidth

   Data type
         integer

   Description
         Default media width.


.. container:: table-row

   Property
         [type].player.defaultHeight

   Data type
         integer

   Description
         Default media height.


.. container:: table-row

   Property
         [type].player.mapping

   Data type
         *(array of keys)*

   Description
         The audio player does not work with file, but instead expects the file
         with the flashvar soundFile. mapping does the rename of parameter for
         you by default.

         **Example:** ::

            mapping {
              flashvars.file = soundFile
            }


.. container:: table-row

   Property
         installUrl

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Specifies the URL of your express install SWF.

   Default
         typo3/contrib/flashmedia/swfobject/expressInstall.swf


.. container:: table-row

   Property
         forcePlayer

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If the file is a URL and forcePlayer is not set, the URL will be
         called directly instead of using a player.


.. container:: table-row

   Property
         flashvars

   Data type
         array

   Description
         Flash vars.


.. container:: table-row

   Property
         params

   Data type
         array

   Description
         Flash params.


.. container:: table-row

   Property
         attributes

   Data type
         array

   Description
         Flash attributes.


.. container:: table-row

   Property
         flashVersion

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Required flash version.

   Default
         9


.. container:: table-row

   Property
         alternativeContent

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         Alternative content.

   Default
         alternativeContent.field = bodytext


.. container:: table-row

   Property
         layout

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         HTML Template for the Object. ###SWFOBJECT### is replaced with the
         sfwobject, ###ID### is replaced with the unique Id of the div/object.

   Default
         ###SWFOBJECT###


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).SWFOBJECT]

