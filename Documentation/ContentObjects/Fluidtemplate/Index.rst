..  include:: /Includes.rst.txt
..  index::
   Content objects; FLUIDTEMPLATE
   FLUIDTEMPLATE
..  _cobj-fluidtemplate:
..  _cobj-template:

=============
FLUIDTEMPLATE
=============

An object of type :typoscript:`FLUIDTEMPLATE` combines TypoScript with the Fluid
templating engine.

A :typoscript:`FLUIDTEMPLATE` object generates content using :ref:`Fluid <t3coreapi:fluid>` templates.
It can be used in :ref:`content elements <t3coreapi:adding-your-own-content-elements>`
or to generate content in the top-level page object
(see :ref:`the example on this page <cobj-fluidtemplate-examples>`).

..  versionadded:: 13.1

    Starting with TYPO3 v13.1 you can use the
    :ref:`PAGEVIEW <cobj-pageview>` content object for templates on page-level.
    It reduces the amount of TypoScript needed to render a page in the TYPO3 frontend.

    See section :ref:`cobj-fluidtemplate-migration`.

..  contents:: Table of content
    :local:
    :depth: 1

..  _cobj-fluidtemplate-data:

Data available in Fluid templates
=================================

..  versionadded:: 13.2
    The FLUIDTEMPLATE can now be used in combination with the
    :ref:`RecordTransformationProcessor` for additional computed information.
    See also :ref:`RecordTransformationProcessor-fluidtemplate-example`

The following data is available in the Fluid template:

*   The content of the current :php:`data` array.

    *   At page level it contains the current page record.
    *   If the :typoscript:`FLUIDTEMPLATE` is used in the
        context of the Fluid ViewHelper :html:`<f:cObject>` it contains data
        in the Fluid Property :confval:`data <t3viewhelper:typo3-fluid-cobject-data>`.
    *   If called in the context of Extbase it contains the data assigned to the view
        in the :ref:`Controller <t3coreapi:extbase-action-controller>`.
    *   Use the :ref:`RecordTransformationProcessor` to get additional computed
        information from the :php:`data` array.

*   The :php:`settings` array set by the parameter
    :ref:`settings <cobj-fluidtemplate-properties-settings>`
*   Variables in the
    :ref:`variables <cobj-fluidtemplate-properties-variables>` setting
*   Data retrieved by
    :ref:`data processors <cobj-fluidtemplate-properties-dataprocessing>`

You can use the :ref:`debug <t3viewhelper:typo3fluid-fluid-debug>` ViewHelper
to output all available data using the magic `{_all}` variable:

..  code-block:: html

   <f:debug>{_all}</f:debug>

..  index:: FLUIDTEMPLATE; Properties
..  _cobj-fluidtemplate-properties:

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

..  _fluidtemplate-dataProcessing:

..  confval:: dataProcessing
    :name: fluidtemplate-dataProcessing
    :type: array of class references by full namespace

    Add one or more processors to manipulate the :php:`$data` variable of
    the currently rendered content object, such as tt_content or page. Use the
    sub-property :typoscript:`options` to pass parameters to the
    processor class.

    ..  note::

        This content was moved to the subpage :ref:`dataProcessing`.

..  _cobj-fluidtemplate-properties-extbase-controlleractionname:

..  confval:: extbase.controllerActionName
    :name: fluidtemplate-extbase-controlleractionname
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets the name of the action.

..  _cobj-fluidtemplate-properties-extbase-controllerextensionname:

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

        ..  code-block:: html

            <f:translate key="LLL:EXT:my_extension/Resources/Private/Language/locallang.xlf:myKey" />

        or the `extensionName` argument plus `key` argument in the ViewHelper:

        ..  code-block:: html

            <f:translate key="myKey" extensionName="MyExtension" />

..  _cobj-fluidtemplate-properties-extbase-controllername:

..  confval:: extbase.controllerName
    :name: fluidtemplate-extbase-controllername
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets the name of the controller.

..  _cobj-fluidtemplate-properties-extbase-pluginname:

..  confval:: extbase.pluginName
    :name: fluidtemplate-extbase-pluginname
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Sets variables for initializing extbase.

..  _cobj-fluidtemplate-properties-file:

..  confval:: file
    :name: fluidtemplate-file
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    The fluid template file. It is an alternative to ".template" and is used
    only if ".template" is not set.

    ..  rubric:: Example

    ..  literalinclude:: _includes/_fluidtemplate-file.typoscript
        :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

..  _cobj-fluidtemplate-properties-format:

..  confval:: format
    :name: fluidtemplate-format
    :type: keyword / :ref:`stdWrap <stdwrap>`
    :Default: html

    :typoscript:`format` sets the format of the current request. It can be something
    like "html", "xml", "png", "json" or even "rss.xml" or something similar.

..  _cobj-fluidtemplate-properties-layoutrootpath:

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

..  _cobj-fluidtemplate-properties-layoutrootpaths:

..  confval:: layoutRootPaths
    :name: fluidtemplate-layoutrootpaths
    :type: array of :ref:`data-type-path` with :ref:`stdWrap <stdwrap>`

    ..  note:: Note the plural -s in "layoutRootPaths"!

    ..  note::
        If you want to extend layoutRootPaths conditionally, best practice
        is to use :ref:`Conditions <conditions>` instead of the :ref:`"if" function <if>`.

    Used to define several paths for layouts, which will be tried in reversed
    order (the paths are searched from bottom to top). The first folder where
    the desired layout is found is used. If the array keys are numeric, they
    are first sorted and then tried in reversed order.

    ..  rubric:: Example

    ..  literalinclude:: _includes/_layoutRootPaths.typoscript
        :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    If property
    :ref:`layoutRootPath <cobj-fluidtemplate-properties-layoutrootpath>`
    (singular) is also used, it will be placed as the first option
    in the list of fall back paths.

..  _cobj-fluidtemplate-properties-partialrootpath:

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

..  _cobj-fluidtemplate-properties-partialrootpaths:

..  confval:: partialRootPaths
    :name: fluidtemplate-partialrootpaths
    :type: array of :ref:`data-type-path` with :ref:`stdWrap <stdwrap>`

    ..  note:: Note the plural -s in "partialRootPaths"!

    ..  note::
        If you want to extend partialRootPaths conditionally, best practice
        is to use :ref:`Conditions <conditions>` instead of the :ref:`"if" function <if>`.

    Used to define several paths for partials, which will be tried in reverse
    order. The first folder where the desired partial is found is used. The
    keys of the array define the order.

    See :ref:`layoutRootPaths <cobj-fluidtemplate-properties-layoutrootpaths>`
    for more details.

..  _cobj-fluidtemplate-properties-settings:

..  confval:: settings
    :name: fluidtemplate-settings
    :type: array of keys

    Sets the settings array in the fluid template. The value
    can then be used in the view.

    ..  rubric:: Example

    ..  literalinclude:: _includes/_settings.typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    To access copyrightYear in the template file use:

    ..  code-block:: html

        {settings.copyrightYear}

    Apart from setting a key-value pair as in the example, you can
    also reference objects or access constants.

..  _cobj-fluidtemplate-properties-stdwrap:

..  confval:: stdWrap
    :name: fluidtemplate-stdwrap
    :type: :ref:`->stdWrap <stdwrap>`

    Provides the usual stdWrap functionality.

..  _cobj-fluidtemplate-properties-template:

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

..  _cobj-fluidtemplate-properties-templatename:

..  confval:: templateName
    :name: fluidtemplate-templatename
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    This name is used together with the set format to find the template in the
    templateRootPaths. Use this property to define a content object to use
    as a template file. It is an alternative to :typoscript:`.file`. If
    `.templateName` is set, it takes precedence.

    ..  rubric:: Example 1

    ..  literalinclude:: _includes/_templateName.typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    ..  rubric:: Example 2

    ..  literalinclude:: _includes/_templateNameAutomatic.typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

..  _cobj-fluidtemplate-properties-templaterootpath:

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

..  _cobj-fluidtemplate-properties-templaterootpaths:

..  confval:: templateRootPaths
    :name: fluidtemplate-templaterootpaths
    :type: array of file paths with :ref:`stdWrap <stdwrap>`

    ..  note:: Note the plural -s in "templateRootPaths"!

    ..  note::
        If you want to extend templateRootPaths conditionally, best practice
        is to use :ref:`Conditions <conditions>` instead of the :ref:`"if" function <if>`.

    Used to define several paths for templates, which will be tried in reverse
    order (the paths are searched from bottom to top). The first folder where
    the desired layout is found is used. If the array keys are numeric, they
    are first sorted and then tried in reverse order.

    Useful in combination with the
    :ref:`templateName <cobj-fluidtemplate-properties-templatename>` property.

    ..  rubric:: Example

    ..  literalinclude:: _includes/_templateRootPaths.typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

..  _cobj-fluidtemplate-properties-variables:

..  confval:: variables
    :name: fluidtemplate-variables
    :type: *(array of cObjects)*

    Sets the variables that will be available in the fluid template. The keys are
    the variable names in Fluid.

    Reserved variables are "data" and "current", which are set automatically
    to the current data set.


..  _cobj-fluidtemplate-example-RecordTransformationProcessor:

Example: Usage with RecordTransformationProcessor
=================================================

..  versionadded:: 13.2
    The FLUIDTEMPLATE can now be used in combination with the
    :ref:`RecordTransformationProcessor` for additional computed information.

The :ref:`RecordTransformationProcessor` transforms the current data array of
the `FLUIDTEMPLATE` to a record object.

This can be used for content elements of
:ref:`Fluid Styled Content <typo3/cms-fluid-styled-content:start>` or
custom ones. In this example the Fluid Styled Content
element "Text" has its data transformed for easier and enhanced usage.

..  literalinclude:: /DataProcessing/_RecordTransformationProcessor/_WithDatabaseFluidTemplate.typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

For usage of the variables within Fluid see
:ref:`RecordTransformationProcessor-fluidtemplate-example`.

..  _cobj-fluidtemplate-examples:

Example
=======

..  versionadded:: 13.1
    It is recommended to use :ref:`PAGEVIEW <cobj-pageview>` for page templates
    starting with TYPO3 v13.1. See
    :ref:`How to migrate to PAGEVIEW <cobj-fluidtemplate-migration>`

The Fluid template in
:file:`EXT:my_sitepackage/Resources/Private/Templates/MyTemplate.html` could look
like this:

..  literalinclude:: _includes/_MyTemplate.html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/MyTemplate.html

You could use it with TypoScript code like this:

..  literalinclude:: _includes/_example.typoscript
    :caption: Before migration, EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

As a result, the page title and the label from TypoScript will be inserted as
titles. The copyright year will be taken from the TypoScript constant
"year".

..  seealso::

    *   :ref:`dataProcessing` examples
    *   :ref:`t3coreapi:adding-your-own-content-elements`
    *   :ref:`t3sitepackage:start`


..  _cobj-fluidtemplate-migration:

Migration from `FLUIDTEMPLATE` to `PAGEVIEW`
============================================

..  literalinclude:: _includes/_BeforeMigrationToPageview.typoscript
    :language: typoscript
    :caption: Before migration, EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

..  literalinclude:: _includes/_AfterMigrationToPageview.typoscript
    :language: typoscript
    :caption: After migration, EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

In Fluid, the pageUid is available as :fluid:`{page.uid}` and pageTitle
as :fluid:`{page.title}`, the subtitle with :fluid:`{page.subtitle}`.

In this example some Fluid templates have to be moved:

:path:`EXT:my_sitepackage/Resources/Private/Templates/Pages/`
    The page templates can stay in this folder.
:path:`EXT:my_sitepackage/Resources/Private/Partials/Pages/`
    Move files to :path:`EXT:my_sitepackage/Resources/Private/Templates/Partials/`
:path:`EXT:my_sitepackage/Resources/Private/Layouts/Pages/`
    Move files to :path:`EXT:my_sitepackage/Resources/Private/Templates/Layouts/`

If the :path:`Private` folder previously looked like this:

..  directory-tree::
    :level: 2

    *   :path:`EXT:my_sitepackage/Resources/Private/`

        *   :path:`Languages`
        *   :path:`Layouts`

            *   :path:`Pages`

        *   :path:`Partials`

            *   :path:`Pages`

        *   :path:`Templates`

            *   :path:`Pages`

It should look like this afterwards:

..  directory-tree::
    :level: 2

    *   :path:`EXT:my_sitepackage/Resources/Private/`

        *   :path:`Languages`
        *   :path:`Templates`

            *   :path:`Layouts`
            *   :path:`Pages`
            *   :path:`Partials`

