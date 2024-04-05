..  include:: /Includes.rst.txt
..  index::
   Top-level objects; plugin
   plugin
..  _plugin:

======
plugin
======

This is used for extensions in TYPO3 set up as frontend plugins.
Typically you can set configuration properties of the plugin here. Say
you have an extension with the key "myext" and it has a frontend
plugin named "tx\_myext\_pi1" then you would find the TypoScript
configuration at the position :typoscript:`plugin.tx_myext_pi1` in the object
tree!

Most plugins are :ref:`cobj-user` objects
which means that they have at least 1 or 2 reserved properties.
Furthermore this table outlines some other default properties.
Generally system properties are prefixed with an underscore:

..  contents::
    :local:

..  _plugin-properties:

Properties for all frontend plugin types
========================================


..  _setup-plugin-userfunc:

userFunc
--------

..  confval:: userFunc
    :name: plugin-userFunc
    :type: (array of keys)

    Property setting up the :ref:`cobj-user` object of the plugin.

..  _setup-plugin-css-default-style:

\_CSS\_DEFAULT\_STYLE
---------------------

..  confval:: _CSS_DEFAULT_STYLE
    :name: plugin-css-default-style
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    Use this to have some default CSS styles inserted in the header
    section of the document. :typoscript:`_CSS_DEFAULT_STYLE` outputs a set of
    default styles, just because an extension is installed. Most likely
    this will provide an acceptable default display from the plugin, but
    should ideally be cleared and moved to an external stylesheet.

    This value is read by the frontend :php:`RequestHandler` script when
    collecting the CSS of the document to be rendered.

    This is for example used by *frontend* and *indexed_search*. Their
    default styles can be removed with:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        plugin.tx_frontend._CSS_DEFAULT_STYLE >
        plugin.tx_indexedsearch._CSS_DEFAULT_STYLE >

    However, you will then have to define according styles yourself.


..  _setup-plugin-extbase:

Properties for all frontend plugins based on Extbase
====================================================

:ref:`Extbase <t3coreapi:extbase>` is an extension framework to create frontend
plugins.

..  _extbase_typoscript_configuration-general:

General
-------

..  _setup-plugin-configuration-ignoreFlexFormSettingsIfEmpty:

ignoreFlexFormSettingsIfEmpty
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  versionadded:: 12.3

..  confval:: ignoreFlexFormSettingsIfEmpty
    :name: plugin-ignoreFlexFormSettingsIfEmpty
    :type: :ref:`data-type-string`

    Define :ref:`FlexForm <t3coreapi:flexforms>` settings that will be
    ignored in the extension settings merge process, if their value is
    considered empty (either an empty string or a string containing `0`).

    Additionally, there is the PSR-14 event
    :ref:`BeforeFlexFormConfigurationOverrideEvent <t3coreapi:BeforeFlexFormConfigurationOverrideEvent>`
    available to further manipulate the merged configuration after standard
    override logic is applied.

..  _setup-plugin-configuration-ignoreFlexFormSettingsIfEmpty-example:

Examples: Ignore certain FlexForm settings if empty
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Definition for *all* plugins of an extension:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    plugin.tx_myextension.ignoreFlexFormSettingsIfEmpty = field1,field2

Definition for *one* plugin of an extension:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    plugin.tx_myextension_myplugin.ignoreFlexFormSettingsIfEmpty = field1,field2

If an extension already defined :typoscript:`ignoreFlexFormSettingsIfEmpty`,
integrators are advised to use :typoscript:`addToList` or
:typoscript:`removeFromList` to modify existing settings:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    plugin.tx_myextension_myplugin.ignoreFlexFormSettingsIfEmpty := removeFromList(field1)
    plugin.tx_myextension_myplugin.ignoreFlexFormSettingsIfEmpty := addToList(field3)


..  _extbase_typoscript_configuration-persistence:

Persistence
-----------

Settings, relevant to the persistence layer of Extbase.

..  _setup-plugin-persistence-enableAutomaticCacheClearing:
..  _extbase_persistence-enableAutomaticCacheClearing:

persistence.enableAutomaticCacheClearing
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: persistence.enableAutomaticCacheClearing
    :name: plugin-persistence-enableAutomaticCacheClearing
    :type: :ref:`data-type-boolean`
    :Default: `true`

    **Only for Extbase plugins**.
    Enables the automatic cache clearing when changing data sets (see also
    :ref:`t3coreapi:extbase_caching`).

..  _extbase_persistence-enableAutomaticCacheClearing-example:

Example: Disable automatic cache clearing for Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample_admin {
        persistence {
            enableAutomaticCacheClearing = 0
        }
    }

..  _setup-plugin-persistence-storagePid:

persistence.storagePid
~~~~~~~~~~~~~~~~~~~~~~

..  confval:: persistence.storagePid
    :name: plugin-persistence-storagePid
    :type: :ref:`data-type-string` (comma separated list of integers)

    **Only for Extbase plugins**. List of page IDs, from which all records
    are read.

..  _setup-plugin-persistence-storagePid-example:

Example: Set storage PID for Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        persistence {
            storagePid = 42
        }
    }

..  _setup-plugin-persistence-recursive:

persistence.recursive
~~~~~~~~~~~~~~~~~~~~~

..  confval:: persistence.recursive
    :name: plugin-persistence-recursive
    :type: :ref:`data-type-integer`

    **Only for Extbase plugins**. Number of sub-levels of the
    storagePid are read.

..  _setup-plugin-persistence-recursive-example:

Example: Fetch records recursively from storage folder
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        persistence {
            # Includes 4 sub-levels of the storagePid
            recursive = 4
        }
    }


..  _setup-plugin-view:

View
----

View and template settings.

All root paths are defined as an array which enables you to define multiple
root paths that will be used by Extbase to find the desired template files.

The root paths work just like the one in the
:ref:`FLUIDTEMPLATE <cobj-fluidtemplate-properties-templaterootpaths>`.

..  _setup-plugin-view-example:

Example: Set template paths for Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        view {
            layoutRootPaths {
                0 = EXT:blog_example/Resources/Private/Layouts/
                10 = EXT:my_extension/Resources/Private/Layouts/
            }
            partialRootPaths {
                0 = EXT:blog_example/Resources/Private/Partials/
                10 = EXT:my_extension/Resources/Private/Partials/
            }
            templateRootPaths {
                0 = EXT:blog_example/Resources/Private/Templates/
                10 = EXT:my_extension/Resources/Private/Templates/
            }
        }
    }


..  _setup-plugin-view-layoutRootPaths:

view.layoutRootPaths
~~~~~~~~~~~~~~~~~~~~

..  confval:: view.layoutRootPaths.[array]
    :name: plugin-view-layoutRootPaths
    :type: :ref:`data-type-string`

    **Only for Extbase plugins**. This can be used to specify the root paths
    for all Fluid layouts. If nothing is specified, the path
    :file:`EXT:my_extension/Resources/Private/Layouts` is used.

..  _setup-plugin-view-partialRootPaths:

view.partialRootPaths
~~~~~~~~~~~~~~~~~~~~~

..  confval:: view.partialRootPaths.[array]
    :name: plugin-view-partialRootPaths
    :type: :ref:`data-type-string`

    **Only for Extbase plugins**. This can be used to specify the root
    paths for all Fluid partials. If nothing is specified, the path
    :file:`EXT:my_extension/Resources/Private/Partials` is used.

..  _setup-plugin-view-templateRootPaths:

view.templateRootPaths
~~~~~~~~~~~~~~~~~~~~~~

..  confval:: view.templateRootPaths.[array]
    :name: plugin-view-templateRootPaths
    :type: :ref:`data-type-string`

    **Only for Extbase plugins**. This can be used to specify the root
    paths for all Fluid templates in this
    plugin. If nothing is specified, the path
    :file:`EXT:my_extension/Resources/Private/Templates` is used.


..  _setup-plugin-view-pluginNamespace:

view.pluginNamespace
~~~~~~~~~~~~~~~~~~~~

..  confval:: view.pluginNamespace.[array]
    :name: plugin-view-pluginNamespace
    :type: :ref:`data-type-string`

    This can be used to specify an alternative namespace for the plugin.
    Use this to shorten the Extbase default plugin namespace or to access
    arguments from other extensions by setting this option to their namespace.


..  _extbase_typoscript_configuration-mvc:

MVC
---

These are useful MVC settings about error handling:

..  _setup-plugin-mvc-callDefaultActionIfActionCantBeResolved:

mvc.callDefaultActionIfActionCantBeResolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: mvc.callDefaultActionIfActionCantBeResolved
    :name: plugin-mvc-callDefaultActionIfActionCantBeResolved
    :type: :ref:`data-type-boolean`
    :Default: `false`

    **Only for Extbase plugins**. If set, causes the controller to show
    its default action if the called action is not allowed by the controller.

..  _setup-plugin-mvc-callDefaultActionIfActionCantBeResolved-example:

Example: Call default action if action cannot be resolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        mvc {
            callDefaultActionIfActionCantBeResolved = 1
        }
    }


..  _setup-plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved:

mvc.throwPageNotFoundExceptionIfActionCantBeResolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: mvc.throwPageNotFoundExceptionIfActionCantBeResolved
    :name: plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved
    :type: :ref:`data-type-boolean`
    :Default: `false`

    Same as :ref:`setup-plugin-mvc-callDefaultActionIfActionCantBeResolved`
    but this will raise a "page not found" error.

..  _setup-plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved-example:

Example: Show 404 (page not found) page if action cannot be resolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        mvc {
            throwPageNotFoundExceptionIfActionCantBeResolved = 1
        }
    }


..  _extbase_format:

Format
------

..  warning::
    Using this parameter is considered bad practice. In most cases it is better
    use different actions for different output formats.

..  confval:: format
    :name: plugin-format
    :type: :ref:`data-type-string`
    :Default: `html`

    Define the default file ending of the template files. The template files
    have to take care of creating the desired format output.

..  _extbase_format-example:

Example: Define alternative output formats for RSS feeds
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample_rssfeedxml {
        // Use template List.xml
        format = xml
    }
    plugin.tx_blogexample_rssfeedatom {
        // Use template List.atom
        format = atom
    }

..  _setup-plugin-local-lang-lang-key-label-key:

\_LOCAL\_LANG.[lang-key].[label-key]
------------------------------------

..  confval:: _LOCAL_LANG.[lang-key].[label-key]
    :name: plugin-local-lang
    :type: :ref:`data-type-string`

    Can be used to override the default language labels for Extbase plugins.
    The `lang-key` setup part is `default` for the default language of the
    website or the 2-letter (ISO 639-1) code for the language. `label-key`
    is the 'trans-unit id' XML value in the XLF language file which
    resides in the path :file:`Resources/Private/Language` of the
    extension or in the :file:`typo3conf/l10n/[lang-key]`
    (:file:`var/labels/[lang-key]` in composer mode) subfolder of the
    TYPO3 root folder. And on the right side of the equation sign '=' you
    put the new value string for the language key which you want to override.

    All variables, which are used inside an Extbase extension with
    the ViewHelper `<f:translate>` can that way be overwritten with
    TypoScript. The :file:`locallang.xlf` file in
    the plugin folder in the file system can be used to get an overview of
    the entries the extension uses.

..  _setup-plugin-local-lang-example:

Example: Override a language key in an Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    plugin.tx_myext_pi1._LOCAL_LANG.de.list_mode_1 = Der erste Modus

..  _extbase_typoscript_configuration-settings:

Settings
--------

Here reside are all the settings, both extension-wide and plugin-specific.
These settings are available in the controllers as the array variable
:php:`$this->settings` and in any Fluid template with `{settings}`.

The settings for a specific plugin can be overridden by FlexForm values of the
same name.
