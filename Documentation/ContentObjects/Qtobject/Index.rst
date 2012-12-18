.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-qtobject:

QTOBJECT
^^^^^^^^

This element inserts a QuickTime Player.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         stdWrap

   Description
         Media file or URL.

         **Note:** Files are treated as URLs. You need to set fully
         qualified URLs. Use config.baseURL and/or config.absRefPrefix to get
         fully qualified URLs automatically.


.. container:: table-row

   Property
         width

   Data type
         integer

   Description
         Width of the QTOBJECT.

         If it is not set, it will be filled with defaultWidth of the player
         configuration.


.. container:: table-row

   Property
         height

   Data type
         integer

   Description
         Height of the QTOBJECT.

         If it is not set, it will be filled with defaultHeight of the player
         configuration.


.. container:: table-row

   Property
         alternativeContent

   Data type
         stdWrap

   Description
         Alternative content.

   Default
         alternativeContent.field = bodytext


.. container:: table-row

   Property
         layout

   Data type
         stdWrap

   Description
         HTML Template for the object. ###QTOBJECT### is replaced with the
         qtobject, ###ID### is replaced with the unique Id of the div/object.

   Default
         ###QTOBJECT###


.. container:: table-row

   Property
         params

   Data type
         array

   Description
         Define some parameters which should be set for the QTOBJECT. These
         settings having precedence over player specific settings
         ([type].player.default.aprams).


.. container:: table-row

   Property
         type

   Data type
         string /stdWrap

   Description
         Sets default for different media types. E.g. "audio" or "video". If
         value is "audio", the player configuration audio.player will be used.
         Player specific settings are only used, if there is no general value
         set.


.. container:: table-row

   Property
         [type].player.default

   Data type
         array

   Description
         Player specific default parameters. You can override them via params
         setting (see above).

         Usage:

         default.params {

         autoplay = true

         }


.. container:: table-row

   Property
         [type].player.defaultWidth

   Data type
         integer

   Description
         Default width.


.. container:: table-row

   Property
         [type].player.defaultHeight

   Data type
         integer

   Description
         Default height.


.. container:: table-row

   Property
         [type].player.mapping

   Data type
         array

   Description
         The mapping does the rename of a parameter for a specific player type.
         Player specific parameter mapping. See SWFOBJECT for an example.


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap


.. ###### END~OF~TABLE ######


[tsref:(cObject).QTOBJECT]

