.. include:: ../../Includes.txt


.. _cobj-svg:

SVG
^^^

With this element you can insert a SVG. You can use XML data directly
or reference a file. A flash fallback will be used for browsers which
do not have native SVG support, so that it also works in e.g. IE
6/7/8.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         width

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Width of the SVG.

   Default
         600


.. container:: table-row

   Property
         height

   Data type
         integer /:ref:`stdWrap <stdwrap>`

   Description
         Height of the SVG.

   Default
         400


.. container:: table-row

   Property
         src

   Data type
         :ref:`file resource <data-type-resource>` /:ref:`stdWrap <stdwrap>`

   Description
         SVG file resource.

         **Example:** ::

            src = fileadmin/svg/tiger.svg


.. container:: table-row

   Property
         value

   Data type
         XML /:ref:`stdWrap <stdwrap>`

   Description
         Raw XML data for the SVG.

         Will be ignored, if "src" is defined.


.. container:: table-row

   Property
         noscript

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Output, if SVG output is not possible.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).SVG]


.. _cobj-svg-examples:

Example:
""""""""

::

   10 = SVG
   10 {
     width = 600
     height = 600
     value (
       <rect x="100" y="100" width="500" height="200" fill="white" stroke="black"/>
       <line x1="0" y1="200" x2="700" y2="200" stroke="red" stroke-width="20px"/>
       <polygon points="185 0 125 25 185 100" transform="rotate(135 125 25)" />
       <circle cx="190" cy="150" r="40" stroke="black" stroke-width="2" fill="yellow"/>
     )
     noscript.cObject = TEXT
     noscript.cObject.value = No SVG rendering possible, please use a browser.
   }

This example will show some geometric forms.

