.. include:: /Includes.rst.txt
.. index::
   Content objects; FLUIDTEMPLATE
   FLUIDTEMPLATE
.. _cobj-fluidtemplate:
.. _cobj-template:

=============
FLUIDTEMPLATE
=============

An object of type FLUIDTEMPLATE combines TypoScript with the Fluid
templating engine.

.. versionchanged:: 11.0
   The content object FLUIDTEMPLATE has replaced `TEMPLATE
   <https://docs.typo3.org/m/typo3/reference-typoscript/10.4/en-us/ContentObjects/Template/Index.html>`__
   which was removed with version 11.0.

A FLUIDTEMPLATE object generates content using :ref:`Fluid <t3coreapi:fluid>` templates.
It can be used in :ref:`content elements <t3coreapi:adding-your-own-content-elements>`
or to generate content in the top-level page object
(see :ref:`the example on this page <cobj-fluidtemplate-examples>`).


.. _cobj-fluidtemplate-data:

Data available in Fluid templates
=================================

The following data is available in the Fluid template:

*  The content of the current :php:`data` array.

   *  At page level it contains the current page record.
   *  If the :typoscript:`FLUIDTEMPLATE` is used in the
      context of the Fluid ViewHelper :html:`<f:cObject>` it contains data
      in the Fluid Property :confval:`data <t3viewhelper:typo3-fluid-cobject-data>`.
   *  If called in the context of Extbase it contains the data assigned to the view
      in the :ref:`Controller <t3coreapi:extbase-action-controller>`.

*  The :php:`settings` array set by the parameter
   :ref:`settings <cobj-fluidtemplate-properties-settings>`
*  Variables in the
   :ref:`variables <cobj-fluidtemplate-properties-variables>` setting
*  Data retrieved by
   :ref:`data processors <cobj-fluidtemplate-properties-dataprocessing>`

You can use the :ref:`debug <t3viewhelper:typo3fluid-fluid-debug>` ViewHelper
to output all available data using the magic `{_all}` variable:

.. code-block:: html

   <f:debug>{_all}</f:debug>

.. toctree::
   :hidden:

   DataProcessing

.. index:: FLUIDTEMPLATE; Properties
.. _cobj-fluidtemplate-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:

..  _cobj-_fluidtemplate-cache:

..  confval:: cache
    :name: _fluidtemplate-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.

.. _fluidtemplate-dataProcessing:

..  confval:: dataProcessing
    :name: fluidtemplate-dataProcessing
    :type: array of class references by full namespace

    Add one or more processors to manipulate the :php:`$data` variable of
    the currently rendered content object, such as tt_content or page. Use the
    sub-property :typoscript:`options` to pass parameters to the
    processor class.

    ..  note::

        This content was moved to the subpage :ref:`dataProcessing`.

.. _cobj-fluidtemplate-properties-extbase-controlleractionname:

..  confval:: extbase.controllerActionName
    :name: fluidtemplate-extbase-controlleractionname
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets the name of the action.

.. _cobj-fluidtemplate-properties-extbase-controllerextensionname:

..  confval:: extbase.controllerExtensionName
    :name: fluidtemplate-extbase-controllerextensionname
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets the extension name of the controller.

    ..  warning::
        Up to TYPO3 v11, this property could be used as an alternative to the `extensionName`
        argument in the :ref:`f:translate <t3viewhelper:typo3-fluid-translate>`
        and :ref:`f:uri.resource <t3viewhelper:typo3-fluid-uri-resource>` ViewHelpers,
        provided that translations and public images were stored in the usual paths in your extension.

        Since TYPO3 v12 this is no longer supported and it is recommended to either use absolute keys:

        This requires you to put translations and public images in the
        :ref:`usual paths in your extension <t3coreapi:extension-reserved-folders>`.

.. _cobj-fluidtemplate-properties-extbase-controllername:

..  confval:: extbase.controllerName
    :name: fluidtemplate-extbase-controllername
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets the name of the controller.

.. _cobj-fluidtemplate-properties-extbase-pluginname:

..  confval:: extbase.pluginName
    :name: fluidtemplate-extbase-pluginname
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets variables for initializing extbase.

.. _cobj-fluidtemplate-properties-file:

..  confval:: file
    :name: fluidtemplate-file
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    The fluid template file. It is an alternative to ".template" and is used
    only if ".template" is not set.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page {
           10 = FLUIDTEMPLATE
           10 {
              file = EXT:site_package/Resources/Private/Templates/Page/MyTemplate.html
           }
        }

.. _cobj-fluidtemplate-properties-format:

..  confval:: format
    :name: fluidtemplate-format
    :type: keyword / :ref:`stdWrap <stdwrap>`
    :Default: html

    :typoscript:`format` sets the format of the current request. It can be something
    like "html", "xml", "png", "json" or even "rss.xml" or something similar.

.. _cobj-fluidtemplate-properties-layoutrootpath:

..  confval:: layoutRootPath
    :name: fluidtemplate-layoutrootpath
    :type: :ref:`data-type-path` / :ref:`stdWrap <stdwrap>`

    Sets a specific layout path, usually
    :file:`EXT:my_extension/Resources/Private/Layouts/` or a folder below that
    path.

    ..  note::
        It is recommended to use
        :ref:`cobj-fluidtemplate-properties-layoutrootpaths` (note the
        plural "s") as it can easily be extended by custom templates in the
        sitepackage.

.. _cobj-fluidtemplate-properties-layoutrootpaths:

..  confval:: layoutRootPaths
    :name: fluidtemplate-layoutrootpaths
    :type: array of :ref:`data-type-path` with :ref:`stdWrap <stdwrap>`

    .. note:: Note the plural -s in "layoutRootPaths"!

    .. note::
        If you want to extend layoutRootPaths conditionally, best practice
        is to use :ref:`Conditions <conditions>` instead of the :ref:`"if" function <if>`.

    Used to define several paths for layouts, which will be tried in reversed
    order (the paths are searched from bottom to top). The first folder where
    the desired layout is found is used. If the array keys are numeric, they
    are first sorted and then tried in reversed order.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

..  confval:: partialRootPath
    :name: fluidtemplate-partialrootpath
    :type: :ref:`data-type-path` / :ref:`stdWrap <stdwrap>`

    Sets a specific partial path, usually
    :file:`EXT:my_extension/Resources/Private/Partials/` or a folder below that
    path.

    ..  note::
        It is recommended to use
        :ref:`cobj-fluidtemplate-properties-partialrootpaths` (note the
        plural "s") as it can be easily extended by custom templates provided
        by the sitepackage.

.. _cobj-fluidtemplate-properties-partialrootpaths:

..  confval:: partialRootPaths
    :name: fluidtemplate-partialrootpaths
    :type: array of :ref:`data-type-path` with :ref:`stdWrap <stdwrap>`

    .. note:: Note the plural -s in "partialRootPaths"!

    .. note::
        If you want to extend partialRootPaths conditionally, best practice
        is to use :ref:`Conditions <conditions>` instead of the :ref:`"if" function <if>`.

    Used to define several paths for partials, which will be tried in reverse
    order. The first folder where the desired partial is found is used. The
    keys of the array define the order.

    See :ref:`layoutRootPaths <cobj-fluidtemplate-properties-layoutrootpaths>`
    for more details.

.. _cobj-fluidtemplate-properties-settings:

..  confval:: settings
    :name: fluidtemplate-settings
    :type: array of keys

    Sets the settings array in the fluid template. The value
    can then be used in the view.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    To access copyrightYear in the template file use:

    ..  code-block:: html

        {settings.copyrightYear}

    Apart from setting a key-value pair as in the example, you can
    also reference objects or access constants.

.. _cobj-fluidtemplate-properties-stdwrap:

..  confval:: stdWrap
    :name: fluidtemplate-stdwrap
    :type: :ref:`->stdWrap <stdwrap>`

    Provides the usual stdWrap functionality.

.. _cobj-fluidtemplate-properties-template:

..  confval:: template
    :name: fluidtemplate-template
    :type: :ref:`cObject <data-type-cobject>`

    Use this property to define the content object which should be used as
    a template file. It is an alternative to ".file"; if ".template" is set, it
    takes precedence.

    ..  warning::

        The :typoscript:`FILE` object type has been removed in TYPO3 v10. As the :typoscript:`.template`
        property used :typoscript:`FILE`, you should generally check your code to see if
        this is used and switch to using :ref:`.templateName <cobj-fluidtemplate-properties-templatename>`
        with :ref:`.templateRootPaths <cobj-fluidtemplate-properties-templaterootpaths>` or use
        :ref:`.file <cobj-fluidtemplate-properties-file>`.

.. _cobj-fluidtemplate-properties-templatename:

..  confval:: templateName
    :name: fluidtemplate-templatename
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    This name is used together with the set format to find the template in the
    templateRootPaths. Use this property to define a content object to use
    as a template file. It is an alternative to :typoscript:`.file`. If
    `.templateName` is set, it takes precedence.

    **Example 1:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    **Example 2:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

.. _cobj-fluidtemplate-properties-templaterootpath:

..  confval:: templateRootPath
    :name: fluidtemplate-templaterootpath
    :type: file path /:ref:`stdWrap <stdwrap>`

    Sets a specific template path, usually
    :file:`EXT:my_extension/Resources/Private/Templates/` or a folder below that
    path.

    ..  note::
        It is recommended to use
        :ref:`cobj-fluidtemplate-properties-templaterootpaths` (note the
        plural "s") as it can be easily extended by custom templates provided
        by the sitepackage.

.. _cobj-fluidtemplate-properties-templaterootpaths:

..  confval:: templateRootPaths
    :name: fluidtemplate-templaterootpaths
    :type: array of file paths with :ref:`stdWrap <stdwrap>`

    .. note:: Note the plural -s in "templateRootPaths"!

    .. note::
        If you want to extend templateRootPaths conditionally, best practice
        is to use :ref:`Conditions <conditions>` instead of the :ref:`"if" function <if>`.

    Used to define several paths for templates, which will be tried in reverse
    order (the paths are searched from bottom to top). The first folder where
    the desired layout is found is used. If the array keys are numeric, they
    are first sorted and then tried in reverse order.

    Useful in combination with the
    :ref:`templateName <cobj-fluidtemplate-properties-templatename>` property.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

..  confval:: variables
    :name: fluidtemplate-variables
    :type: *(array of cObjects)*

    Sets the variables that will be available in the fluid template. The keys are
    the variable names in Fluid.

    Reserved variables are "data" and "current", which are set automatically
    to the current data set.

.. _cobj-fluidtemplate-examples:

Example
=======

The Fluid template in
:file:`EXT:site_default/Resources/Private/Templates/MyTemplate.html` could look
like this:

..  code-block:: html

    <h1>{data.title}<f:if condition="{data.subtitle}">, {data.subtitle}</f:if></h1>
    <h3>{mylabel}</h3>
    <f:format.html>{data.bodytext}</f:format.html>
    <p>&copy; {settings.copyrightYear}</p>

You could use it with TypoScript code like this:

..  code-block:: typoscript

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

As a result, the page title and the label from TypoScript will be inserted as
titles. The copyright year will be taken from the TypoScript constant
"year".

..  seealso::

    *   :ref:`dataProcessing` examples
    *   :ref:`t3coreapi:adding-your-own-content-elements`
    *   :doc:`t3sitepackage:Index`
