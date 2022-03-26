.. include:: ../../Includes.txt

.. _cobj-fluidtemplate:

=============
FLUIDTEMPLATE
=============

An object of type FLUIDTEMPLATE combines TypoScript with the Fluid
templating engine. It has replaced the older and now deprecated
:ref:`cobj-template` content object.

FLUIDTEMPLATE generates content using Fluid templates.
It can be used in :ref:`content elements <t3coreapi:adding-your-own-content-elements>`
or to generate content within the top-level object page
(see :ref:`the example on this page <cobj-fluidtemplate-examples>`).

Data available in Fluid templates
=================================

The following data will be available in the called Fluid template:

*  The content of the current :php:`data` array.

   *  On page level it contains the current page record.
   *  If the :typoscript:`FLUIDTEMPLATE` is used in the
      context of the Fluid ViewHelper :html:`<f:cObject>` it contains the data set
      in the Fluid Property :ref:`data <t3viewhelper:cobject_data>`.
   *  If called in the context of Extbase it contains the data assigned to the view
      in the :ref:`Controller <t3extbasebook:controllers>`.

*  The :php:`settings` array set by the parameter
   :ref:`settings <cobj-fluidtemplate-properties-settings>`
*  Variables set by the setting
   :ref:`variables <cobj-fluidtemplate-properties-variables>`
*  Additional data retrieved by
   :ref:`data processors <cobj-fluidtemplate-properties-dataprocessing>`

You can use the ViewHelper :ref:`debug <t3viewhelper:typo3fluid-fluid-debug>` to
receive a complete listing of the available data using the magic `{_all}` variable:

.. code-block:: html

   <f:debug>{_all}</f:debug>



.. contents:: On this page:
   :local:
   :depth: 1

.. toctree::
   :hidden:

   DataProcessing


.. _cobj-fluidtemplate-properties:

Properties
==========

.. contents::
   :local:
   :depth: 1

.. _fluidtemplate-dataProcessing:

dataProcessing
--------------

.. rst-class:: dl-parameters

dataProcessing
   :sep:`|` :aspect:`Data type:` array of class references by full namespace
   :sep:`|`

   Add one or multiple processors to manipulate the :php:`$data` variable of
   the currently rendered content object, like tt_content or page. The sub-
   property :typoscript:`options` can be used to pass parameters to the processor
   class.

   .. note::

      The content was moved to the subpage :ref:`dataProcessing`.


.. _cobj-fluidtemplate-properties-extbase-controlleractionname:

extbase.controllerActionName
----------------------------

.. rst-class:: dl-parameters

extbase.controllerActionName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets the name of the action.



.. _cobj-fluidtemplate-properties-extbase-controllerextensionname:

extbase.controllerExtensionName
-------------------------------

.. rst-class:: dl-parameters

extbase.controllerExtensionName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets the extension name of the controller.

   **Important:** This is for example essential if you have translations at the
   usual paths in your extension and want to use them right away in your
   template via `<f:translate/>`.


.. _cobj-fluidtemplate-properties-extbase-controllername:

extbase.controllerName
----------------------

.. rst-class:: dl-parameters

extbase.controllerName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets the name of the controller.


.. _cobj-fluidtemplate-properties-extbase-pluginname:

extbase.pluginName
------------------

.. rst-class:: dl-parameters

extbase.pluginName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets variables for initializing extbase.




.. _cobj-fluidtemplate-properties-file:

file
----

.. rst-class:: dl-parameters

file
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   The fluid template file. It is an alternative to ".template" and is used
   only, if ".template" is not set.

   **Example:** ::

      page = PAGE
      page {
         10 = FLUIDTEMPLATE
         10 {
            file = EXT:site_package/Resources/Private/Templates/Page/MyTemplate.html
         }
      }


.. _cobj-fluidtemplate-properties-format:

format
------

.. rst-class:: dl-parameters

format
   :sep:`|` :aspect:`Data type:` keyword /:ref:`stdWrap <stdwrap>`
   :sep:`|` :aspect:`Default:` html
   :sep:`|`

   :typoscript:`format` sets the format of the current request. It can be something
   like "html", "xml", "png", "json". And it can even come in the form of
   "rss.xml" or alike.


.. _cobj-fluidtemplate-properties-layoutrootpath:

layoutRootPath
--------------

.. rst-class:: dl-parameters

layoutRootPath
   :sep:`|` :aspect:`Data type:` file path /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets a specific layout path; usually it is Layouts/ underneath the template
   file.


.. _cobj-fluidtemplate-properties-layoutrootpaths:

layoutRootPaths
---------------

.. rst-class:: dl-parameters

layoutRootPaths
   :sep:`|` :aspect:`Data type:` array of file paths with :ref:`stdWrap <stdwrap>`
   :sep:`|`

   .. note:: Mind the plural -s in "layoutRootPaths"!

   Used to define several paths for layouts, which will be tried in reversed
   order (the paths are searched from bottom to top). The first folder where
   the desired layout is found, is used. If the array keys are numeric, they
   are first sorted and then tried in reversed order.

   **Example:** ::

      page {
         10 = FLUIDTEMPLATE
         10 {
            file = EXT:site_default/Resources/Private/Templates/Main.html
            layoutRootPaths {
               10 = EXT:site_default/Resources/Private/Layouts
               20 = EXT:site_modification/Resources/Private/Layouts
            }
         }
      }

   If property
   :ref:`layoutRootPath <cobj-fluidtemplate-properties-layoutrootpath>`
   (singular) is also used, it will be placed as the first option
   in the list of fall back paths.

.. _cobj-fluidtemplate-properties-partialrootpath:

partialRootPath
---------------

.. rst-class:: dl-parameters

partialRootPath
   file path /:ref:`stdWrap <stdwrap>`

   Sets a specific partials path; usually it is Partials/ underneath the
   template file.


.. _cobj-fluidtemplate-properties-partialrootpaths:

partialRootPaths
----------------

.. rst-class:: dl-parameters

partialRootPaths
   :sep:`|` :aspect:`Data type:` array of file paths with :ref:`stdWrap <stdwrap>`
   :sep:`|`

   .. note:: Mind the plural -s in "partialRootPaths"!

   Used to define several paths for partials, which will be tried in reversed
   order. The first folder where the desired partial is found, is used. The
   keys of the array define the order.

   See :ref:`layoutRootPaths <cobj-fluidtemplate-properties-layoutrootpaths>`
   for more details.


.. _cobj-fluidtemplate-properties-settings:

settings
--------

.. rst-class:: dl-parameters

settings
   :sep:`|` :aspect:`Data type:` array of keys
   :sep:`|`

   Sets the given settings array in the fluid template. In the view, the value
   can then be used.

   **Example:** ::

      page = PAGE
      page {
         10 = FLUIDTEMPLATE
         10 {
            file = EXT:site_default/Resources/Private/Templates/MyTemplate.html
            settings {
               copyrightYear = 2013
            }
         }
      }

   To access copyrightYear in the template file use this:

   .. code-block:: html

      {settings.copyrightYear}

   Apart from just setting a key-value pair as done in the example, you can
   also reference objects or access constants as well.


.. _cobj-fluidtemplate-properties-stdwrap:

stdWrap
-------

.. rst-class:: dl-parameters

stdWrap
   :sep:`|`
   :aspect:`Data type:` :ref:`->stdWrap <stdwrap>`
   :sep:`|`

   Offers the usual stdWrap functionality.


.. _cobj-fluidtemplate-properties-template:

template
--------

.. rst-class:: dl-parameters

template
   :sep:`|` :aspect:`Data type:`  :ref:`cObject <data-type-cobject>`
   :sep:`|`

   Use this property to define a content object, which should be used as
   template file. It is an alternative to ".file"; if ".template" is set, it
   takes precedence.

   This property can be used to create the Fluid template dynamically
   from a TypoScript object.

   Example::

      page.10 = FLUIDTEMPLATE
      page.10 {
        template = TEXT
        template.value (
          <f:debug>{_all}</f:debug>
          <h1>{data.title}</h1>
          <p>{foo}</p>
         )
        variables {
            foo = TEXT
            foo.value = bar
         }
      }

   .. deprecated:: 9.5

      Before TYPO3 9 the template property was sometimes used with the
      deprecated content element type :ref:`cobj-file`. Migrate them
      as follows::

         page.10 = FLUIDTEMPLATE
         page.10 {
            // FILE is deprecated, don't use it anymore
            // template = FILE
            // template.file = fileadmin/Templates/MyTemplate.html
            file = fileadmin/Templates/MyTemplate.html
         }

      or::

         page.10 = FLUIDTEMPLATE
         page.10 {
            templateRootPaths.200 = fileadmin/Templates/
            templateName = MyTemplate
         }


.. _cobj-fluidtemplate-properties-templatename:

templateName
------------

.. rst-class:: dl-parameters

templateName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   This name is used together with the set format to find the template in the
   given templateRootPaths. Use this property to define a content object, which
   should be used as template file. It is an alternative to :typoscript:`.file`. If
   :typoscript:`.templateName` is set, it takes precedence.

   **Example 1:** ::

      lib.stdContent = FLUIDTEMPLATE
      lib.stdContent {
         templateName = Default
         layoutRootPaths {
            10 = EXT:frontend/Resources/Private/Layouts
            20 = EXT:sitemodification/Resources/Private/Layouts
         }
         partialRootPaths {
            10 = EXT:frontend/Resources/Private/Partials
            20 = EXT:sitemodification/Resources/Private/Partials
         }
         templateRootPaths {
            10 = EXT:frontend/Resources/Private/Templates
            20 = EXT:sitemodification/Resources/Private/Templates
         }
         variables {
            foo = TEXT
            foo.value = bar
         }
      }

   **Example 2:** ::

      lib.stdContent = FLUIDTEMPLATE
      lib.stdContent {
         templateName = TEXT
         templateName.stdWrap {
            cObject = TEXT
            cObject {
               data = levelfield:-2,backend_layout_next_level,slide
               override.field = backend_layout
               split {
                  token = frontend__
                  1.current = 1
                  1.wrap = |
               }
            }
            ifEmpty = Default
         }
         layoutRootPaths {
            10 = EXT:frontend/Resources/Private/Layouts
            20 = EXT:sitemodification/Resources/Private/Layouts
         }
         partialRootPaths {
            10 = EXT:frontend/Resources/Private/Partials
            20 = EXT:sitemodification/Resources/Private/Partials
         }
         templateRootPaths {
            10 = EXT:frontend/Resources/Private/Templates
            20 = EXT:sitemodification/Resources/Private/Templates
         }
         variables {
            foo = bar
         }
      }






.. _cobj-fluidtemplate-properties-templaterootpaths:

templateRootPaths
-----------------

.. rst-class:: dl-parameters

templateRootPaths
   :sep:`|` :aspect:`Data type:` array of file paths with :ref:`stdWrap <stdwrap>`
   :sep:`|`

   .. note:: Mind the plural -s in "templateRootPaths"!

   Used to define several paths for templates, which will be tried in reversed
   order (the paths are searched from bottom to top). The first folder where
   the desired layout is found, is used. If the array keys are numeric, they
   are first sorted and then tried in reversed order.

   Useful in combination with the
   :ref:`templateName <cobj-fluidtemplate-properties-templatename>` property.

   **Example:** ::

      page {
         10 = FLUIDTEMPLATE
         10 {
            templateName = Default
            templateRootPaths {
               10 = EXT:sitedesign/Resources/Private/Templates
               20 = EXT:sitemodification/Resources/Private/Templates
            }
         }
      }





.. _cobj-fluidtemplate-properties-variables:

variables
---------

.. rst-class:: dl-parameters

variables
   :sep:`|` :aspect:`Data type:` *(array of cObjects)*
   :sep:`|`

   Sets variables that should be available in the fluid template. The keys are
   the variable names in Fluid.

   Reserved variables are "data" and "current", which are filled automatically
   with the current data set.

.. _cobj-fluidtemplate-examples:

Example
=======

The Fluid template in
:file:`EXT:site_default/Resources/Private/Templates/MyTemplate.html` could look
like this:

.. code-block:: html

   <h1>{data.title}<f:if condition="{data.subtitle}">, {data.subtitle}</f:if></h1>
   <h3>{mylabel}</h3>
   <f:format.html>{data.bodytext}</f:format.html>
   <p>&copy; {settings.copyrightYear}</p>

You could use it with a TypoScript code like this:

.. code-block:: typoscript

   page = PAGE
   page.10 = FLUIDTEMPLATE
   page.10 {
      templateName = MyTemplate
      templateRootPaths {
         10 = EXT:site_default/Resources/Private/Templates
      }
      partialRootPaths {
         10 = EXT:site_default/Resources/Private/Partials
      }
      variables {
         mylabel = TEXT
         mylabel.value = Label coming from TypoScript!
      }
      settings {
         # Get the copyright year from a TypoScript constant.
         copyrightYear = {$year}
      }
   }

As a result the page title and the label from TypoScript will be inserted as
headlines. The copyright year will be taken from the TypoScript constant
"year".

.. seealso::

   * :ref:`dataProcessing` examples
   * :ref:`t3coreapi:adding-your-own-content-elements`
   * :doc:`t3sitepackage:Index`
