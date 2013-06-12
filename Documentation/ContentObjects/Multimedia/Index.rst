.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-multimedia:

MULTIMEDIA
^^^^^^^^^^

This element will insert a multimedia file. Text files will be output
directly; for Java, Flash, Audio and Video files an embed tag will be
used.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         file

   Data type
         :ref:`resource <data-type-resource>` /:ref:`stdWrap <stdwrap>`

   Description
         The multimedia file. Possible file types are:

         .. ### BEGIN~OF~SIMPLE~TABLE ###

         ===============================  ===================================================
          File type                        File content
         ===============================  ===================================================
          txt, html, htm                    Will be inserted directly. Of the following
                                            properties only ".stdWrap" can be used.

          class                             Java-applet.

          swf                               Flash animation.

          swa, dcr                          Shockwave animation.

          au, wav, mp3                      Sound.

          avi, mov, asf, mpg, wmv           Movie (AVI, QuickTime, ...).
         ===============================  ===================================================

         .. ###### END~OF~SIMPLE~TABLE ######

.. container:: table-row

   Property
         params

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         These are parameters for the multimedia objects. Use this to enter
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

         **Note:** If you set a width or a height here, this will overwrite
         the width or the height which have been set using ".width" and
         ".height".


.. container:: table-row

   Property
         width

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Width attribute of the embed tag.

         Not used for txt, html, htm and sound files.

   Default
         200


.. container:: table-row

   Property
         height

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Height attribute of the embed tag.

         Not used for txt, html, htm and sound files.

   Default
         200


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).MULTIMEDIA]


.. _cobj-multimedia-params:

Meaningful parameters for .params
"""""""""""""""""""""""""""""""""

For the different file types many different parameters can be set.
This is an incomplete list of some of those parameters:


au, wav, mp3:
~~~~~~~~~~~~~


.. ### BEGIN~OF~SIMPLE~TABLE ###

================   ======================================================================   ============
Parameter:         Description:                                                             Default:
================   ======================================================================   ============
width              Width of the controls. If not set, the browser defaults to 200.
height             Height of the controls. If not set, the browser defaults to 16.
loop               Repeat the sound, when playing finished. Set to true or false.
autostart          Automatically start the sound. Set to true or false.
================   ======================================================================   ============

.. ###### END~OF~SIMPLE~TABLE ######


avi, mov, asf, mpg, wmv:
~~~~~~~~~~~~~~~~~~~~~~~~


.. ### BEGIN~OF~SIMPLE~TABLE ###

================   ======================================================================   ============
Parameter:         Description:                                                             Default:
================   ======================================================================   ============
width              Width of the movie.                                                      200
height             Height of the movie.                                                     200
autostart          Automatically start the video. Set to true or false.

                   **Note:** Not for "mov", there the parameter is called "autostart".
                   See example below.
================   ======================================================================   ============

.. ###### END~OF~SIMPLE~TABLE ######


swf, swa, dcr:
~~~~~~~~~~~~~~


.. ### BEGIN~OF~SIMPLE~TABLE ###

================   ======================================================================   ============
Parameter:         Description:                                                             Default:
================   ======================================================================   ============
width              Width of the object. If not set, the browser defaults to approx. 200.    200
height             Height of the object. If not set, the browser defaults to approx. 200.   200
quality            Quality of the video.                                                    high
================   ======================================================================   ============

.. ###### END~OF~SIMPLE~TABLE ######


class:
~~~~~~


.. ### BEGIN~OF~SIMPLE~TABLE ###

================   ======================================================================   ============
Parameter:         Description:                                                             Default:
================   ======================================================================   ============
width              Width of the object.                                                     200
height             Height of the object.                                                    200
================   ======================================================================   ============

.. ###### END~OF~SIMPLE~TABLE ######


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

