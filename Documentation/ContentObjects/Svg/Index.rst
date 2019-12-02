.. include:: ../../Includes.txt


.. _cobj-svg:

===
SVG
===

With this object type you can insert a SVG. You can use XML data directly
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
         SVG file resource, can also be referenced via :file:`EXT:` prefix to
         point to files of extensions.

         **Example:** ::

            src = fileadmin/svg/tiger.svg


.. container:: table-row

   Property
         renderMode

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Setting `renderMode` to inline will render an inline version of the SVG.

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
     src = EXT:my_ext/Resources/Public/Images/example.svg
   }

This example will output the svg with the defined dimensions.
