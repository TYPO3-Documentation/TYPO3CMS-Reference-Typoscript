.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _frame:

frame
=====

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ========== ========================================== ====================== ==============================================
   Property   Data Type                                  :ref:`t3tsref:stdwrap` Default
   ========== ========================================== ====================== ==============================================
   `name`_    <frame>-data:name                                                 value of ".obj"
   `obj`_     *pointer to top-level object-name*
   `options`_ :ref:`t3tsref:data-type-string`
   `params`_  <frame>-params
   `src`_     <frame>-data:src /:ref:`stdWrap <stdwrap>`                        typolink to id=[currentId]&type=[obj->typeNum]
   ========== ========================================== ====================== ==============================================

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###

.. _setup-frame-name:

name
""""

.. container:: table-row

   Property
         name

   Data type
         <frame>-data:name

   Description
         Manually set name of frame

         **Note:** Is set automatically and should not be overridden under
         normal conditions!

   Default
         value of ".obj"



.. _setup-frame-obj:

obj
"""

.. container:: table-row

   Property
         obj

   Data type
         *pointer to top-level object-name*

   Description
         top-level object-name of a PAGE / FRAMESET

         **Example:**

         "left", "page", "frameset"



.. _setup-frame-options:

options
"""""""

.. container:: table-row

   Property
         options

   Data type
         string

   Description
         URL parameters.

         **Example:** ::

            options = print=1&othervar=anotherthing

         This would add ' *&print=1&othervar=anotherthing* ' to the
         ".src"-content (if not ".src" is set manually).



.. _setup-frame-params:

params
""""""

.. container:: table-row

   Property
         params

   Data type
         <frame>-params

   Description
         **Example:**

         scrolling="AUTO" noresize frameborder="NO"



.. _setup-frame-src:

src
"""

.. container:: table-row

   Property
         src

   Data type
         <frame>-data:src /:ref:`stdWrap <stdwrap>`

   Description
         Instead of using the "obj" destination, you can define a specific src
         for your frame with this setting. This overrides the default behavior
         of using the "obj" parameter!

   Default
         typolink to id=[currentId]&type=[obj->typeNum]


.. ###### END~OF~TABLE ######


Example:
""""""""

This produces a simple frameset with a topframe and content-frame::

   frameset = PAGE
   frameset.typeNum = 0

   page = PAGE
   page.typeNum = 1

   top = PAGE
   top.typeNum = 3

   frameset.frameSet.rows = 150,*
   frameset.frameSet.params = border="0" framespacing="0" frameborder="NO"
   frameset.frameSet {
     1 = FRAME
     1.obj = top
     1.params = scrolling="NO" noresize frameborder="NO" marginwidth="0" marginheight="0"
     2 = FRAME
     2.obj = page
     2.params = scrolling="AUTO" noresize frameborder="NO"
   }

