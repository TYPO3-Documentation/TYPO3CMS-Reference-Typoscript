.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-fluidtemplate:

FLUIDTEMPLATE
^^^^^^^^^^^^^

The TypoScript object FLUIDTEMPLATE works in a similar way to the
regular "marker"-based TEMPLATE object. However, it does not use
markers or subparts, but allows Fluid-style variables with curly
braces.

.. figure:: ../../Images/icon_note.png
   :alt: Note

**Note**

The extensions "fluid" and "extbase" need to be installed for this to
work.

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
         file

   Data type
         string /stdWrap

   Description
         The fluid template file.

   Default


.. container:: table-row

   Property
         layoutRootPath

   Data type
         filepath /stdWrap

   Description
         Sets a specific layout path; usually it is Layouts/ underneath the
         template file.

   Default


.. container:: table-row

   Property
         partialRootPath

   Data type
         filepath /stdWrap

   Description
         Sets a specific partials path; usually it is Partials/ underneath the
         template file.

   Default


.. container:: table-row

   Property
         format

   Data type
         keyword /stdWrap

   Description
         Sets the format of the current request.

   Default
         html


.. container:: table-row

   Property
         extbase.pluginName

   Data type
         string /stdWrap

   Description
         Sets variables for initializing extbase.

   Default


.. container:: table-row

   Property
         extbase.controllerExtensionName

   Data type
         string /stdWrap

   Description
         Sets the extension name of the controller.

   Default


.. container:: table-row

   Property
         extbase.controllerName

   Data type
         string /stdWrap

   Description
         Sets the name of the controller.

   Default


.. container:: table-row

   Property
         extbase.controllerActionName

   Data type
         string /stdWrap

   Description
         Sets the name of the action.

   Default


.. container:: table-row

   Property
         variables

   Data type
         *Array... of*

         cObjects

   Description
         Sets variables that should be available in the fluid template. The
         keys are the variable names in Fluid.

         Reserved variables are "data" and "current", which are filled
         automatically with the current data set.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).FLUIDTEMPLATE]


.. _cobj-fluidtemplate-examples:

Example:
""""""""

The Fluid template (in fileadmin/templates/MyTemplate.html) could look
like this::

   <h1>{data.title}<f:if condition="{data.subtitle}">, {data.subtitle}</f:if></h1>
   <h3>{mylabel}</h3>
   <f:format.html>{data.bodytext}</f:format.html>

You could use it with a TypoScript code like this::

   page = PAGE
   page.10 = FLUIDTEMPLATE
   page.10 {
     file = fileadmin/templates/MyTemplate.html
     partialRootPath = fileadmin/templates/partial/
     variables {
       mylabel = TEXT
       mylabel.value = Label coming from TypoScript!
     }
   }

As a result the page title and the label from TypoScript will be
inserted as headlines.

