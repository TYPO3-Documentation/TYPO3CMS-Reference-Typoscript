.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


MULTIMEDIA
^^^^^^^^^^

This element will insert a multimedia file. Text files will be output
directly; for Java, Flash, Audio and Video files an embed tag will be
used.

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
         The multimedia file. Possible file types are:

         **txt, html, htm** : Will be inserted directly, of the following
         properties only ".stdWrap" can be used.

         **class** : Java-applet.

         **swf** : Flash animation.

         **swa, dcr** : ShockWave Animation.

         **au, wav, mp3** : Sound.

         **avi, mov, asf, mpg, wmv** : Movies (AVI, QuickTime, MPEG4).

   Default


.. container:: table-row

   Property
         params

   Data type
         string /stdWrap

   Description
         These are parameters for the multimedia-objects. Use this to enter
         stuff like autostart, type, width, height and so on. For each file
         type several parameters make sense. For an incomplete list see below
         this table.

         **Example:** ::

            params (
              type = application/x-shockwave-flash
              width = 200
              height = 300
            )

         This will generate a tag like ::

            <embed .... type="application/x-shockwave-flash" width="200" height="300">

         For parameters which are set by default (see tables below) an empty
         string will remove the parameter from the embed-tag.

         **Example:** ::

            params (
              height =
            )

         **Note** : If you set a width or a height here, this will overwrite
         the width or the height which have been set using ".width" and
         ".height".

   Default


.. container:: table-row

   Property
         width

   Data type
         integer /stdWrap

   Description
         Width attribute of the embed tag.

         Not used for txt, html, htm and sound files.

   Default
         200


.. container:: table-row

   Property
         height

   Data type
         integer /stdWrap

   Description
         Height attribute of the embed tag.

         Not used for txt, html, htm and sound files.

   Default
         200


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).MULTIMEDIA]


Meaningful parameters for .params
"""""""""""""""""""""""""""""""""

For the different file types many different parameters can be set.
This is an incomplete list of some of those parameters:


au, wav, mp3:
~~~~~~~~~~~~~


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Parameter
         Parameter:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Parameter
         width

   Description
         Width of the controls. If not set, the browser defaults to 200.

   Default


.. container:: table-row

   Parameter
         height

   Description
         Height of the controls. If not set, the browser defaults to 16.

   Default


.. container:: table-row

   Parameter
         loop

   Description
         Repeat the sound, when playing finished. Set to true or false.

   Default


.. container:: table-row

   Parameter
         autostart

   Description
         Automatically start the sound. Set to true or false.

   Default


.. ###### END~OF~TABLE ######


avi, mov, asf, mpg, wmv:
~~~~~~~~~~~~~~~~~~~~~~~~


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Parameter
         Parameter:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Parameter
         width

   Description
         Width of the movie.

   Default
         200


.. container:: table-row

   Parameter
         height

   Description
         Height of the movie.

   Default
         200


.. container:: table-row

   Parameter
         autostart

   Description
         Automatically start the video. Set to true or false.

         **Note** : Not for "mov", there the parameter is called "autostart".
         See example below.

   Default


.. ###### END~OF~TABLE ######


swf, swa, dcr:
~~~~~~~~~~~~~~


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Parameter
         Parameter:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Parameter
         width

   Description
         Width of the object. If not set, the browser defaults to approx. 200.

   Default
         200


.. container:: table-row

   Parameter
         height

   Description
         Height of the object. If not set, the browser defaults to approx. 200.

   Default
         200


.. container:: table-row

   Parameter
         quality

   Description
         Quality of the video.

   Default
         high


.. ###### END~OF~TABLE ######


class:
~~~~~~


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Parameter
         Parameter:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Parameter
         width

   Description
         Width of the object.

   Default
         200


.. container:: table-row

   Parameter
         height

   Description
         Height of the object.

   Default
         200


.. ###### END~OF~TABLE ######


Example for QuickTime (mov):
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

   params (
     width = 256
     height = 208
     autoplay = true
     controller = true
     loop = false
     pluginspage = http://www.apple.com/quicktime/
   )

