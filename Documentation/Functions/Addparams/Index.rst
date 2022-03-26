.. include:: /Includes.rst.txt


.. _addparams:

addParams
^^^^^^^^^

Adds parameters to an HTML tag.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         \_offset

   Data type
         integer

   Description
         Use this to define which tag you want to manipulate.

         1 is the first tag in the input, 2 is the second, -1 is the last, -2
         is the second last.

   Default
         1


.. container:: table-row

   Property
         *(array of strings)*

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         The name of the property defines the property to be added to the
         tag. The value is what will be set as content of the property.

         If the tag already has a property with this name (case-sensitive!),
         that property will be overridden!

         If the returned value is a blank string (but not zero!), then the
         property will not be set and (if it exists already) not be
         overridden.


.. ###### END~OF~TABLE ######

[tsref:->addParams]


.. _addparams-examples:

Example:
""""""""

::

   page.13 = TEXT
   page.13.value = <tr><td>
   page.13.stdWrap.addParams.bgcolor = white
   page.13.stdWrap.addParams._offset = -1

Result example::

   <tr><td bgcolor="white">

This example adds the 'bgColor' property to the value of the TEXT
cObject.

