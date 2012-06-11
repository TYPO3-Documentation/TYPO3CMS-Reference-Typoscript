

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


JSMENU
^^^^^^

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
         levels
   
   Data type
         int, 1-5
   
   Description
         How many levels there are
   
   Default
         1


.. container:: table-row

   Property
         menuName
   
   Data type
         string
   
   Description
         JavaScript menu name.
         
         If you have more than one JSMENU on the page, you should set this
         value for each one.
   
   Default


.. container:: table-row

   Property
         target
   
   Data type
         target
   
   Description
         Decides target of the menu-links
   
   Default


.. container:: table-row

   Property
         forceTypeValue
   
   Data type
         int
   
   Description
         If set, the &type parameter of the link is forced to this value
         regardless of target.
   
   Default


.. container:: table-row

   Property
         1,2,3,4...
   
   Data type
         JSMENUITEM
   
   Description
         levels-config
   
   Default


.. container:: table-row

   Property
         wrap
   
   Data type
         wrap
   
   Description
         wrap around the selector-boxes
   
   Default


.. container:: table-row

   Property
         wrapAfterTags
   
   Data type
         wrap
   
   Description
         wrap around the selector-boxes with wrap and form-tags og JS-code.
   
   Default


.. container:: table-row

   Property
         firstLabelGeneral
   
   Data type
         string
   
   Description
         General first label. May be overridden by the one set in each
         JSMENUITEM
   
   Default


.. container:: table-row

   Property
         SPC
   
   Data type
         boolean
   
   Description
         If set, spacer can go into the menu, else not.
   
   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).JSMENU]

