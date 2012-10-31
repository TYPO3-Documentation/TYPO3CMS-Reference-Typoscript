.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _addparams:

addParams
^^^^^^^^^

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
         \_offset

   Data type
         int

   Description
         Use this to define which tag you want to manipulate.

         1 is the first tag in the input, 2 is the second, -1 is the last, -2
         is the second last

   Default
         1


.. container:: table-row

   Property
         (array of strings)

   Data type
         string /stdWrap

   Description
         This defines the content of each added property to the tag.

         If there is a tag-property with this name already (case-sensitive!)
         that property will be overridden!

         If the returned value is a blank string (but not zero!) then the
         existing (if any) property will not be overridden.

   Default


.. ###### END~OF~TABLE ######

[tsref:->addParams]


.. _addparams-example:

((generated))
"""""""""""""

Example:
~~~~~~~~

::

   page.13 = TEXT
   page.13.value = <tr><td valign=top>
   page.13.addParams.bgcolor = {$menuCol.bgColor}
   page.13.addParams._offset = -1

Result example::

   <tr><td valign="top" bgcolor="white">

(This example adds the 'bgColor' property to the value of the TEXT
cObject, if the content is not "". (zero counts as a value here!))

