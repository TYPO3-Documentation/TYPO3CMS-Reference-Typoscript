..  include:: /Includes.rst.txt
..  index:: Constants
..  _typoscript-syntax-what-are-constants:
..  _typoscript-syntax-constants:

=========
Constants
=========

..  versionchanged:: 12.0
    The TypoScript management tools are now found in backend module
    :guilabel:`Site Management > TypoScript`. It was formerly found in
    "Page > Template".

..  figure:: /Images/ManualScreenshots/TypoScriptModule/ConstantEditor.png
    :alt: Screenshot of the TYPO3 Backend showing the constant editor

    The :ref:`Constant Editor <constant-editor>` in the TYPO3 backend

Constants are values defined in the  :guilabel:`Constants` field of a template.  They
follow the :ref:`syntax of ordinary TypoScript
<t3coreapi:typoscript-syntax-syntax>` and are case sensitive! They are used to
manage *in a single place* values, which are later used in *several places*.

..  seealso::
    Most constants can be assigned in the :guilabel:`Template` module using the
    :guilabel:`Constant Editor`.

    If you keep your constants in a site package extension you can also make
    them :ref:`available for the Constant Editor <typoscript-syntax-constant-editor>`.

..  index:: Constants; Definition
..  _typoscript-syntax-constants-definition:

Defining constants
==================

Other than constants in programming languages, values of constants in TypoScript
can be overwritten. Constants in TypoScript can more be seen as variables in
programming languages.

**Reserved name**

The object or property "file" is always interpreted as data type :ref:`data-type-resource`. That means it refers to a file, which has to be uploaded
in the TYPO3 CMS installation.

**Multi-line values: The ( ) signs**

Constants do not support multiline values!

You can use environment variables to provide instance specific values to your constants.
Refer to :ref:`getEnv <getenv>` for further information.

..  _typoscript-syntax-constants-definition-example:

Example
-------

Here :typoscript:`bgCol` is set to "red", :typoscript:`file.toplogo` is set to
:file:`fileadmin/logo.gif` and :typoscript:`topimg.file.pic2` is set to
:file:`fileadmin/logo2.gif`, assuming these files are indeed available at the
expected location.

..  code-block:: typoscript
    :emphasize-lines: 2,7

    bgCol = red
    file {
       toplogo = fileadmin/logo.gif
    }
    topimg {
       width = 200
       file.pic2 = fileadmin/logo2.gif
    }

The objects in the highlighted lines contain the reserved word "file" and the
properties are always of data type ":ref:`data-type-resource`".


..  index:: Constants; Usage
..  _typoscript-syntax-using-constants:

Using constants
===============

When a TypoScript Template is parsed by the TYPO3 CMS, constants are replaced, as
one would perform any ordinary string replacement. Constants are used in the
"Setup" field by placing them inside curly braces and prepending them with a
:typoscript:`$` sign:

..  code-block:: typoscript

    {$bgCol}
    {$topimg.width}
    {$topimg.file.pic2}
    {$file.toplogo}

Only constants, which are actually defined in the :guilabel:`Constants` field
or an included :file:`constants.typoscript` file, are
substituted.

Constants from included TypoScript files are also substituted. All TypoScript
constants are combined before the TypoScript Setup configuration is resolved.

A systematic naming scheme should be used for constants. As "paths" can be
defined, it's also possible to structure constants and prefix them with a common
path segment. This makes reading and finding of constants easier.

..  _typoscript-syntax-using-constants-example:

Example
-------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page {
        typeNum = 0
        bodyTag = <body class="{$tx_my_sitepackage.bgCol}">
        10 = IMAGE
        10.file = {$tx_my_sitepackage.file.toplogo}
    }

For the above example to work, the constants from the last example have to be
defined in the constants field or a file called :file:`constants.typoscript`:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/constants.typoscript

    tx_my_sitepackage {
        bgCol = bg-primary
        file.toplogo = EXT:my_sitepackage/Resources/Public/Images/Logo.png
    }

..  figure:: /Images/ManualScreenshots/TypoScriptModule/ConstantAndSetupRecord.png
    :alt: Screenshot of the TypoScript record editor showing the Constants and Setup fields

    The fields :guilabel:`Constants` and :guilabel:`Setup` in the TypoScript backend record

You can use the sub module :guilabel:`Site Management > TypoScript > Active TypoScript`
to display how constants are replaced. The constant key is displayed in red, the
replacement in green:

..  figure:: /Images/ManualScreenshots/TypoScriptModule/ConstantsInActiveTypoScript.png
    :alt: Screenshot of the Active TypoScript with constants substituted

..  versionchanged:: 12.0
    The TypoScript management tools are now found in backend module
    :guilabel:`Site Management > TypoScript`. It was formerly found in
    "Page > Template".

    The submodule :guilabel:`Active TypoScript` was renamed from
    "TypoScript Object Browser".

..  note::

    The TypoScript constants are evaluated in this order:

    #.  :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['defaultTypoScript_constants']`
        via :php:`\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants()`
    #.  Site specific :ref:`settings from the site configuration <t3coreapi:sitehandling>`
    #.  Constants from :sql:`sys_template` database records
