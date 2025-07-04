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
    :depth: 1

..  _plugin-properties:
..  _setup-plugin-userfunc:
..  _setup-plugin-css-default-style:

Properties for all frontend plugin types
========================================

..  confval-menu::
    :name: plugin-properties-all
    :display: table
    :type:

    ..  confval:: userFunc
        :name: plugin-userFunc
        :type: (array of keys)

        Property setting up the :ref:`cobj-user` object of the plugin.

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

..  _extbase_typoscript_configuration-settings:
..  _setup-plugin-local-lang-lang-key-label-key:
..  _extbase_format:
..  _setup-plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved:
..  _setup-plugin-mvc-callDefaultActionIfActionCantBeResolved:
..  _setup-plugin-view:
..  _setup-plugin-persistence-recursive:
..  _setup-plugin-view-layoutRootPaths:
..  _setup-plugin-view-partialRootPaths:
..  _setup-plugin-view-templateRootPaths:
..  _setup-plugin-view-pluginNamespace:
..  _setup-plugin-persistence-storagePid:
..  _setup-plugin-persistence-classes-classname-newRecordStoragePid:
..  _setup-plugin-persistence-enableAutomaticCacheClearing:
..  _extbase_persistence-enableAutomaticCacheClearing:
..  _extbase_typoscript_configuration-persistence:
..  _extbase_typoscript_configuration-general:
..  _setup-plugin-configuration-ignoreFlexFormSettingsIfEmpty:
..  _setup-plugin-extbase:

Properties for all frontend plugins based on Extbase
====================================================

:ref:`Extbase <t3coreapi:extbase>` is an extension framework to create frontend
plugins.

..  confval-menu::
    :name: plugin-properties-extbase
    :display: table
    :type:

    ..  confval:: ignoreFlexFormSettingsIfEmpty
        :name: plugin-ignoreFlexFormSettingsIfEmpty
        :type: :ref:`data-type-string`
        :Example: :ref:`Ignore certain FlexForm settings if empty <setup-plugin-configuration-ignoreFlexFormSettingsIfEmpty-example>`

        Define :ref:`FlexForm <t3coreapi:flexforms>` settings that will be
        ignored in the extension settings merge process, if their value is
        considered empty (either an empty string or a string containing `0`).

        Additionally, there is the PSR-14 event
        :ref:`BeforeFlexFormConfigurationOverrideEvent <t3coreapi:BeforeFlexFormConfigurationOverrideEvent>`
        available to further manipulate the merged configuration after standard
        override logic is applied.

    ..  confval:: persistence
        :name: plugin-persistence
        :type: array of settings
        :Example: :ref:`Set recursive storage PID for Extbase plugin <setup-plugin-persistence-storagePid-example>`

        Settings, relevant to the persistence layer of Extbase.

    ..  confval:: persistence.enableAutomaticCacheClearing
        :name: plugin-persistence-enableAutomaticCacheClearing
        :type: :ref:`data-type-boolean`
        :Default: `true`

        **Only for Extbase plugins**.
        Enables the automatic cache clearing when changing data sets (see also
        :ref:`t3coreapi:extbase_caching`).

    ..  confval:: persistence.storagePid
        :name: plugin-persistence-storagePid
        :type: :ref:`data-type-string` (comma separated list of integers)
        :Example: :ref:`Set recursive storage PID for Extbase plugin <setup-plugin-persistence-storagePid-example>`

        **Only for Extbase plugins**. List of page IDs, from which all records
        are read.

    ..  confval:: persistence.classes.[classname].newRecordStoragePid
        :name: plugin-persistence-classes-classname-newRecordStoragePid
        :type: :ref:`data-type-integer`
        :Example: :ref:`Set storage PID for new records of Extbase plugin <setup-plugin-persistence-classes-classname-newRecordStoragePid-example>`

        **Only for Extbase plugins**. Page ID, where new records for objects
        of the class `[classname]` are stored.

    ..  confval:: persistence.recursive
        :name: plugin-persistence-recursive
        :type: :ref:`data-type-integer`
        :Example: :ref:`Set recursive storage PID for Extbase plugin <setup-plugin-persistence-storagePid-example>`

        **Only for Extbase plugins**. Number of sub-levels of the
        storagePid are read.

    ..  confval:: view.[settings]
        :name: plugin-view
        :type: settings
        :Example: :ref:`Set template paths for Extbase plugin <setup-plugin-view-example>`

        View and template settings.

        All root paths are defined as an array which enables you to define multiple
        root paths that will be used by Extbase to find the desired template files.

        The root paths work just like the one in the
        :ref:`FLUIDTEMPLATE <cobj-fluidtemplate-properties-templaterootpaths>`.

    ..  confval:: view.layoutRootPaths.[array]
        :name: plugin-view-layoutRootPaths
        :type: :ref:`data-type-string`
        :Example: :ref:`Set template paths for Extbase plugin <setup-plugin-view-example>`

        **Only for Extbase plugins**. This can be used to specify the root paths
        for all Fluid layouts. If nothing is specified, the path
        :file:`EXT:my_extension/Resources/Private/Layouts` is used.

    ..  confval:: view.partialRootPaths.[array]
        :name: plugin-view-partialRootPaths
        :type: :ref:`data-type-string`
        :Example: :ref:`Set template paths for Extbase plugin <setup-plugin-view-example>`

        **Only for Extbase plugins**. This can be used to specify the root
        paths for all Fluid partials. If nothing is specified, the path
        :file:`EXT:my_extension/Resources/Private/Partials` is used.

    ..  confval:: view.templateRootPaths.[array]
        :name: plugin-view-templateRootPaths
        :type: :ref:`data-type-string`
        :Example: :ref:`Set template paths for Extbase plugin <setup-plugin-view-example>`

        **Only for Extbase plugins**. This can be used to specify the root
        paths for all Fluid templates in this
        plugin. If nothing is specified, the path
        :file:`EXT:my_extension/Resources/Private/Templates` is used.

    ..  confval:: view.pluginNamespace.[array]
        :name: plugin-view-pluginNamespace
        :type: :ref:`data-type-string`
        :Example: :ref:`Set template paths for Extbase plugin <setup-plugin-view-example>`

        This can be used to specify an alternative namespace for the plugin.
        Use this to shorten the Extbase default plugin namespace or to access
        arguments from other extensions by setting this option to their namespace.

    ..  confval:: mvc.[setting]
        :name: plugin-mvc
        :type: array of settings

        **Only for Extbase plugins**. These are useful MVC settings about error handling:

    ..  confval:: mvc.callDefaultActionIfActionCantBeResolved
        :name: plugin-mvc-callDefaultActionIfActionCantBeResolved
        :type: :ref:`data-type-boolean`
        :Default: `false`
        :Example: :ref:`Call default action if action cannot be resolved <setup-plugin-mvc-callDefaultActionIfActionCantBeResolved-example>`

        **Only for Extbase plugins**. If set, causes the controller to show
        its default action if the called action is not allowed by the controller.

    ..  confval:: mvc.throwPageNotFoundExceptionIfActionCantBeResolved
        :name: plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved
        :type: :ref:`data-type-boolean`
        :Default: `false`
        :Example: :ref:`Show 404 (page not found) page if action cannot be resolved <setup-plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved-example>`

        Same as :ref:`setup-plugin-mvc-callDefaultActionIfActionCantBeResolved`
        but this will raise a "page not found" error.

    ..  confval:: mvc.showPageNotFoundIfTargetNotFoundException
        :name: plugin-mvc-showPageNotFoundIfTargetNotFoundException
        :type: :ref:`data-type-boolean`
        :Default: `false`

        **Only for Extbase plugins**. By default, when calling an extbase controller action
        that is not registered for an Extbase plugin, a fatal exception
        :php:`TargetNotFoundException` is thrown
        (usually an internal error message is shown).

        When this configuration option is set to `1` (true), instead the default
        "Page not Found" page will be shown instead (with a 404 HTTP header by default).

        The configuration option can be either set on the global `config.tx_extbase`
        scope, or also plugin-specific via
        `plugin.tx_yourextension.mvc.showPageNotFoundIfTargetNotFoundException` /
        `plugin.tx_yourextension_pluginName.mvc.showPageNotFoundIfTargetNotFoundException`.

    ..  confval:: mvc.showPageNotFoundIfRequiredArgumentIsMissingException
        :name: plugin-mvc-showPageNotFoundIfRequiredArgumentIsMissingException
        :type: :ref:`data-type-boolean`
        :Default: `false`

        **Only for Extbase plugins**. By default, when calling an extbase controller action
        with missing/invalid required arguments a fatal exception :php:`RequiredArgumentMissingException`
        is thrown (usually an internal error message is shown).

        When this configuration option is set to `1` (true), instead the default
        "Page not Found" page will be shown instead (with a 404 HTTP header by default).

        The configuration option can be either set on the global `config.tx_extbase`
        scope, or also plugin-specific via
        `plugin.tx_yourextension.mvc.showPageNotFoundIfRequiredArgumentIsMissingException` /
        `plugin.tx_yourextension_pluginName.mvc.showPageNotFoundIfRequiredArgumentIsMissingException`.

        Note that extension authors can also implement the Controller method
        :php:`ActionController->handleArgumentMappingExceptions()` to individually operate
        on invalid arguments.

    ..  confval:: format
        :name: plugin-format
        :type: :ref:`data-type-string`
        :Default: `html`
        :Example: :ref:`Define alternative output formats for RSS feeds <extbase_format-example>`

        ..  warning::
            Using this parameter is considered bad practice. In most cases it is better
            use different actions for different output formats.

        Define the default file ending of the template files. The template files
        have to take care of creating the desired format output.

    ..  confval:: _LOCAL_LANG.[lang-key].[label-key]
        :name: plugin-local-lang
        :type: :ref:`data-type-string`
        :Example: :ref:`Override a language key in an Extbase plugin <setup-plugin-local-lang-example>`

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

    ..  confval:: settings.[setting]
        :name: plugin-settings
        :type: array of custom settings

        Here all the settings, both extension-wide and plugin-specific, reside.
        These settings are available in the controllers as the array variable
        :php:`$this->settings` and in any Fluid template with `{settings}`.

        The settings for a specific plugin can be overridden by FlexForm values of the
        same name.

..  _setup-plugin-extbase-examples:

Extbase plugin TypoScript examples
==================================

..  contents::
    :local:

..  _extbase_typoscript_configuration-general-example:

Plugin general examples
-----------------------

..  _setup-plugin-configuration-ignoreFlexFormSettingsIfEmpty-example:

Examples: Ignore certain FlexForm settings if empty
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].ignoreFlexFormSettingsIfEmpty <plugin-ignoreflexformsettingsifempty>`

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

..  _extbase_typoscript_configuration-persistence-example:

Plugin persistence Examples
---------------------------

..  _extbase_persistence-enableAutomaticCacheClearing-example:

Example: Disable automatic cache clearing for an Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].persistence.enableAutomaticCacheClearing <plugin-persistence-enableautomaticcacheclearing>`

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample_admin {
        persistence {
            enableAutomaticCacheClearing = 0
        }
    }

..  _setup-plugin-persistence-recursive-example:
..  _setup-plugin-persistence-storagePid-example:
..  _setup-plugin-persistence-classes-classname-newRecordStoragePid-example:

Example: Set recursive storage PID for Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].persistence.storagePid <plugin-persistence-storagepid>`
    *   :confval:`plugin.[extension].persistence.classes.[classname].newRecordStoragePid <plugin-persistence-classes-classname-newRecordStoragePid>`
    *   :confval:`plugin.[extension].persistence.recursive <plugin-persistence-recursive>`

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        persistence {
            storagePid = 42
            # Includes 4 sub-levels of the storagePid
            recursive = 4

            T3docs\BlogExample\Domain\Model\Post {
                newRecordStoragePid = 43
            }
            T3docs\BlogExample\Domain\Model\Comment {
                newRecordStoragePid = 44
            }
        }
    }

..  _extbase_typoscript_configuration-view-example:

Plugin view Examples
--------------------

..  _setup-plugin-view-example:

Example: Set template paths for Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].view.layoutRootPaths.[array] <plugin-view-layoutrootpaths>`
    *   :confval:`plugin.[extension].view.partialRootPaths.[array] <plugin-view-partialrootpaths>`
    *   :confval:`plugin.[extension].view.templateRootPaths.[array] <plugin-view-templaterootpaths>`

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

..  _extbase_typoscript_configuration-mvc-example:

Plugin MVC Examples
-------------------

..  _setup-plugin-mvc-callDefaultActionIfActionCantBeResolved-example:

Example: Call default action if action cannot be resolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].mvc.callDefaultActionIfActionCantBeResolved <plugin-mvc-calldefaultactionifactioncantberesolved>`

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        mvc {
            callDefaultActionIfActionCantBeResolved = 1
        }
    }

..  _setup-plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved-example:

Example: Show 404 (page not found) page if action cannot be resolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].mvc.throwPageNotFoundExceptionIfActionCantBeResolved <plugin-mvc-throwpagenotfoundexceptionifactioncantberesolved>`

..  code-block:: typoscript
    :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

    plugin.tx_blogexample {
        mvc {
            throwPageNotFoundExceptionIfActionCantBeResolved = 1
        }
    }


..  _extbase_format-examples:

Plugin format examples
----------------------

..  _extbase_format-example:

Example: Define alternative output formats for RSS feeds
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension].format <plugin-format>`

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

..  _extbase_localization-examples:

Plugin localization examples
----------------------------

..  _setup-plugin-local-lang-example:

Example: Override a language key in an Extbase plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`plugin.[extension]._LOCAL_LANG <plugin-local-lang>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    plugin.tx_myext_pi1._LOCAL_LANG.de.list_mode_1 = Der erste Modus
