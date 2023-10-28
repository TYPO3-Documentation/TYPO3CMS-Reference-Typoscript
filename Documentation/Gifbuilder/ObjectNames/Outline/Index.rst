..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; OUTLINE
..  _gifbuilder-outline:

=======
OUTLINE
=======

Creates a colored contour line around the shapes of the associated text.

This outline normally renders quite ugly as it's done by printing 4 or
8 texts underneath the text in question. Try to use a shadow with a
high intensity instead. That works better!

Properties
==========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         textObjNum

   Data type
         positive integer /:ref:`stdWrap <stdwrap>`

   Description
         Must point to the TEXT object if these shadow properties are not
         properties to a TEXT object directly ("stand-alone shadow"). Then the
         shadow needs to know which TEXT object it should be a shadow of!

         If - on the other hand - the shadow is a property to a TEXT object,
         this property is not needed.


.. container:: table-row

   Property
         thickness

   Data type
         x,y /:ref:`stdWrap <stdwrap>`

   Description
         Thickness in each direction, range 1-2


.. container:: table-row

   Property
         color

   Data type
         :t3-data-type:`GraphicColor` /:ref:`stdWrap <stdwrap>`

   Description
         Outline color


.. ###### END~OF~TABLE ######

[tsref:->GIFBUILDER.(GBObj).OUTLINE]
