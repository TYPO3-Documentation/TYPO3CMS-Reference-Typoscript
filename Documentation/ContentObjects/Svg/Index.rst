.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


SVG
^^^

With this element you can insert a SVG. You can use XML data directly
or reference a file. A flash fallback will be used for browsers which
do not have native SVG support, so that it also works in e.g. IE
6/7/8.

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
         width

   Data type
         integer /stdWrap

   Description
         Width of the SVG.

   Default
         600


.. container:: table-row

   Property
         height

   Data type
         integer /stdWrap

   Description
         Height of the SVG.

   Default
         400


.. container:: table-row

   Property
         src

   Data type
         file resource /stdWrap

   Description
         SVG file resource.

         **Example:** ::

            src = fileadmin/svg/tiger.svg

   Default


.. container:: table-row

   Property
         value

   Data type
         XML /stdWrap

   Description
         Raw XML data for the SVG.

         Will be ignored, if "src" is defined.

   Default


.. container:: table-row

   Property
         noscript

   Data type
         string/stdWrap

   Description
         Output, if SVG output is not possible.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).SVG]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   10 = SVG
   10 {
     width = 600
     height = 600
     value (
       <rect x="100" y="100" width="500" height="200" fill="white" stroke="black" stroke-width="5px"/>
       <line x1="0" y1="200" x2="700" y2="200" stroke="red" stroke-width="20px"/>
       <polygon points="185 0 125 25 185 100" transform="rotate(135 125 25)" />
       <circle cx="190" cy="150" r="40" stroke="black" stroke-width="2" fill="yellow"/>
     )
     noscript.cObject = TEXT
     noscript.cObject.value = No SVG rendering possible, please use a browser.
   }

This example will show some geometric forms.

