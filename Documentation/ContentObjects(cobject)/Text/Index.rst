

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

The content object "TEXT" can be used to output static text or HTML.

stdWrap properties are available on the very rootlevel of the object.


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
         value
   
   Description
         Text, which you want to output.
   
   Default


.. container:: table-row

   Property
         (stdWrap properties...)
   
   Data type
         ->stdWrap
   
   Description
         stdWrap properties are additionally available on the very rootlevel of the
         object. This is non-standard! You should use these stdWrap
         properties consistently to those of the other cObjects by
         accessing them through the property "stdWrap".
   
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
   10.stdWrap.case = upper


Example:
~~~~~~~~

::

   10 = TEXT
   10.stdWrap.field = bodytext
   10.stdWrap.br = 1


Example:
~~~~~~~~

::

   10 = TEXT
   10.stdWrap.field = title
   10.stdWrap.wrap = <strong>|</strong>

