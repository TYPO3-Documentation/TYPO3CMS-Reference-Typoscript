.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-fluidtemplate:

FLUIDTEMPLATE
^^^^^^^^^^^^^

The TypoScript object FLUIDTEMPLATE works in a similar way to the
regular "marker"-based :ref:`TEMPLATE <cobj-template>` object. However, it does not use
markers or subparts, but allows Fluid-style variables with curly
braces.

.. note::

   The extensions "fluid" and "extbase" need to be installed for this to
   work.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         template

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         (Since TYPO3 6.1) Use this property to define a content object,
         which should be used as template file. It is an alternative to
         ".file"; if ".template" is set, it takes precedence. While any
         content object can be used here, the cObject :ref:`FILE <cobj-file>`
         might be the usual choice.


.. container:: table-row

   Property
         file

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         The fluid template file. It is an alternative to
         ".template" and is used only, if ".template" is not set.


.. container:: table-row

   Property
         layoutRootPaths

   Data type
         array

   Description
         Sets a specific layout path; usually it is Layouts/ underneath the
         template file.
         You can override these paths by adding multiple paths in the fashion of
         an 10, 20, 30 array type notation.

         Example:

         ::
         page.10 = FLUIDTEMPLATE
         page.10.file = EXT:sitedesign/Resources/Private/Templates/Main.html
         page.10.layoutRootPaths {
           10 = EXT:sitedesign/Resources/Private/Layouts
           20 = EXT:sitemodification/Resources/Private/Layouts
         }

         In this case if a layout is referenced TYPO3 will look for the
         first occurence in the list (starting at higher array numbers)
         and use the first result found.

         This is very handy when overriding default partials.


.. container:: table-row

   Property
         layoutRootPath

   Data type
         filepath /:ref:`stdWrap <stdwrap>`

   Description
         Sets a specific layout path; usually it is Layouts/ underneath the
         template file.


.. container:: table-row

   Property
         partialRootPaths

   Data type
         array of filepaths

   Description
         Sets a specific partials path; usually it is Partials/ underneath the
         template file.
         You can override these paths by adding multiple paths in the fashion of
         an 10, 20, 30 array type notation.

         Example:

         ::
         page.10 = FLUIDTEMPLATE
         page.10.file = EXT:sitedesign/Resources/Private/Templates/Main.html
         page.10.partialRootPaths {
           10 = EXT:sitedesign/Resources/Private/Partials
           20 = EXT:sitemodification/Resources/Private/Partials
         }

         In this case if a partial is referenced TYPO3 will look for the
         first occurence in the list (starting at higher array numbers)
         and use the first result found.

         This is very handy when overriding default partials.


.. container:: table-row

   Property
         partialRootPath

   Data type
         filepath /:ref:`stdWrap <stdwrap>`

   Description
         Sets a specific partials path; usually it is Partials/ underneath the
         template file.


.. container:: table-row

   Property
         format

   Data type
         keyword /:ref:`stdWrap <stdwrap>`

   Description
         Sets the format of the current request.

   Default
         html


.. container:: table-row

   Property
         extbase.pluginName

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Sets variables for initializing extbase.


.. container:: table-row

   Property
         extbase.controllerExtensionName

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Sets the extension name of the controller.


.. container:: table-row

   Property
         extbase.controllerName

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Sets the name of the controller.


.. container:: table-row

   Property
         extbase.controllerActionName

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Sets the name of the action.


.. container:: table-row

   Property
         variables

   Data type
         *(array of cObjects)*

   Description
         Sets variables that should be available in the fluid template. The
         keys are the variable names in Fluid.

         Reserved variables are "data" and "current", which are filled
         automatically with the current data set.


.. container:: table-row

   Property
         settings

   Data type
         *(array of keys)*

   Description
         (Since TYPO3 6.1) Sets the given settings array in the fluid
         template. In the view, the value can then be used.

         **Example:** ::

            page = PAGE
            page.10 = FLUIDTEMPLATE
            page.10 {
              file = fileadmin/templates/MyTemplate.html
              settings {
                copyrightYear = 2013
              }
            }

         To access copyrightYear in the template file use this::

            {settings.copyrightYear}

         Apart from just setting a key-value pair as done in the example,
         you can also reference objects or access constants as well.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


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
   <p>&copy; {settings.copyrightYear}</p>

You could use it with a TypoScript code like this::

   page = PAGE
   page.10 = FLUIDTEMPLATE
   page.10 {
     template = FILE
     template.file = fileadmin/templates/MyTemplate.html
     partialRootPath = fileadmin/templates/partial/
     variables {
       mylabel = TEXT
       mylabel.value = Label coming from TypoScript!
     }
     settings {
       # Get the copyright year from a TypoScript constant.
       copyrightYear = {$year}
     }
   }

As a result the page title and the label from TypoScript will be
inserted as headlines. The copyright year will be taken from the
TypoScript constant "year".

