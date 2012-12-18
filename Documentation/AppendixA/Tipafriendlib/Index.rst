.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-tipafriendlib:

tipafriendLib.inc
^^^^^^^^^^^^^^^^^

.. figure:: ../../Images/TipAFriend.png
   :alt: This is what the form can look like.


.. _appendix-tipafriendlib-files:

Files:
""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   File
         tipafriendLib.inc

   Description
         Main class used to display the Tip-a-Friend form.

         Call it from a USER cObject with 'userFunc =
         user\_tipafriend->main\_tipafriend'


.. container:: table-row

   File
         tipafriend\_template.tmpl

   Description
         Example template file.


.. ###### END~OF~TABLE ######


Example:
""""""""

(See static\_template 'plugin.tipafriend' for a working configuration)


.. _appendix-tipafriendlib-template:

Static template
"""""""""""""""

plugin.tipafriend


.. _appendix-tipafriendlib-properties:

tipafriendLib.inc properties
""""""""""""""""""""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         templateFile

   Data type
         resource

   Description
         The template-file.


.. container:: table-row

   Property
         code

   Data type
         string /stdWrap

   Description
         Code to define, what the script does. Case sensitive.


.. container:: table-row

   Property
         defaultCode

   Data type
         string

   Description
         The default code (see above) if the value is empty. By default it is
         not set and a help screen will appear.


.. container:: table-row

   Property
         wrap1

   Data type
         ->stdWrap

   Description
         Global Wrap 1. This will be split into the markers ###GW1B### and
         ###GW1E###. Don't change the input value by the settings, only wrap it
         in something.

         **Example:** ::

            wrap1.wrap = <b> | </b>


.. container:: table-row

   Property
         wrap2

   Data type
         ->stdWrap

   Description
         Global Wrap 2 (see above)


.. container:: table-row

   Property
         color1

   Data type
         string /stdWrap

   Description
         Value for ###GC1### marker (Global color 1)


.. container:: table-row

   Property
         color2

   Data type
         string /stdWrap

   Description
         Value for ###GC2### marker (Global color 2)


.. container:: table-row

   Property
         color3

   Data type
         string /stdWrap

   Description
         Value for ###GC3### marker (Global color 3)


.. container:: table-row

   Property
         typolink

   Data type
         ->typolink

   Description
         TypoLink configuration for the TIPLINK to the TIPFORM page.
         .additionalParams is added the parameter "&tipUrl="


.. container:: table-row

   Property
         htmlmail

   Data type
         boolean

   Description
         If set, the page is fetched as HTML and send in HTML (a plain text
         version is sent as well).


.. ###### END~OF~TABLE ######

[tsref:(script).tipafriend]

