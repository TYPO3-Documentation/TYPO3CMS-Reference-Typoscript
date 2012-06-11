

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


TEXT
^^^^

The content object "TEXT" can be used to output static text or html.
So it is very similar to the cObject "HTML". Note that the stdWrap
properties are not available under the property "stdWrap" (as they are
for the other cObjects), but on the very rootlevel of the object. This
is non-standard! Check the examples.

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
         value
   
   Data type
         value /stdWrap
   
   Description
         Text, which you want to output.
   
   Default


.. container:: table-row

   Property
         (stdWrap properties...)
   
   Data type
         ->stdWrap
   
   Description
   
   
   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).TEXT]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   10 = TEXT
   10.value = This is a text in uppercase
   10.case = upper


Example:
~~~~~~~~

::

   10 = TEXT
   10.field = bodytext
   10.br = 1


Example:
~~~~~~~~

::

   10 = TEXT
   10.field = title
   10.wrap = <strong>|</strong>

