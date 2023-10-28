..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; WORKAREA
..  _gifbuilder-workarea:

========
WORKAREA
========

Sets another workarea.

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         set

   Data type
         x,y,w,h + calc /:ref:`stdWrap <stdwrap>`

   Description
         Sets the dimensions of the workarea.

         x,y is the offset.

         w,h are the dimensions.

         For the usage of "calc" see the according note at the beginning of the
         section "GIFBUILDER".


.. container:: table-row

   Property
         clear

   Data type
         string

   Description
         Sets the current workarea to the default workarea.

         The value is checked for using isset(): If isset() returns TRUE, the
         workarea is cleared, otherwise it is not.


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).WORKAREA]
