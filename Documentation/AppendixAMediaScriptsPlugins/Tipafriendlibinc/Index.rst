.. include:: Images.txt

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


tipafriendLib.inc
^^^^^^^^^^^^^^^^^

|img-13| 
Files:
""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   File
         File:
   
   Description
         Description:


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


Static template
"""""""""""""""

plugin.tipafriend


tipafriendLib.inc properties
""""""""""""""""""""""""""""

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
         templateFile
   
   Data type
         resource
   
   Description
         The template-file.

   Default


.. container:: table-row

   Property
         code
   
   Data type
         string /stdWrap
   
   Description
         Code to define, what the script does. Case sensitive.
   
   Default


.. container:: table-row

   Property
         defaultCode
   
   Data type
         string
   
   Description
         The default code (see above) if the value is empty. By default it's
         not set and a help screen will appear
   
   Default


.. container:: table-row

   Property
         wrap1
   
   Data type
         ->stdWrap
   
   Description
         Global Wrap 1. This will be split into the markers ###GW1B### and
         ###GW1E###. Don't change the input value by the settings, only wrap it
         in something.
         
         **Example:**
         
         ::
         
            wrap1.wrap = <b> | </b>
   
   Default


.. container:: table-row

   Property
         wrap2
   
   Data type
         ->stdWrap
   
   Description
         Global Wrap 2 (see above)
   
   Default


.. container:: table-row

   Property
         color1
   
   Data type
         string /stdWrap
   
   Description
         Value for ###GC1### marker (Global color 1)
   
   Default


.. container:: table-row

   Property
         color2
   
   Data type
         string /stdWrap
   
   Description
         Value for ###GC2### marker (Global color 2)
   
   Default


.. container:: table-row

   Property
         color3
   
   Data type
         string /stdWrap
   
   Description
         Value for ###GC3### marker (Global color 3)
   
   Default


.. container:: table-row

   Property
         typolink
   
   Data type
         ->typolink
   
   Description
         TypoLink configuration for the TIPLINK to the TIPFORM page.
         .additionalParams is added the parameter "&tipUrl="
   
   Default


.. container:: table-row

   Property
         htmlmail
   
   Data type
         boolean
   
   Description
         If set, the page is fetched as HTML and send in HTML (a plain text
         version is sent as well).
   
   Default


.. ###### END~OF~TABLE ######

[tsref:(script).tipafriend]

