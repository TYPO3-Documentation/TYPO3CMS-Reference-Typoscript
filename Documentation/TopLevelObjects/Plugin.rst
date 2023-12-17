.. include:: /Includes.rst.txt
.. index::
   Top-level objects; plugin
   plugin
.. _plugin:

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

.. contents::
   :local:

Properties for all frontend plugin types
========================================

.. ### BEGIN~OF~TABLE ###

.. _setup-plugin-userfunc:

userFunc
--------

.. container:: table-row

   Property
         userFunc

   Data type
         (array of keys)

   Description
         Property setting up the :ref:`cobj-user` object of the plugin.



.. _setup-plugin-css-default-style:

\_CSS\_DEFAULT\_STYLE
---------------------

.. container:: table-row

   Property
         \_CSS\_DEFAULT\_STYLE

   Data type
         :ref:`data-type-string` / :ref:`stdwrap`

   Description
         Use this to have some default CSS styles inserted in the header
         section of the document. :typoscript:`_CSS_DEFAULT_STYLE` outputs a set of
         default styles, just because an extension is installed. Most likely
         this will provide an acceptable default display from the plugin, but
         should ideally be cleared and moved to an external stylesheet.

         This value is read by the frontend :php:`RequestHandler` script when
         collecting the CSS of the document to be rendered.

         This is e.g. used by *frontend* and *indexed_search*. Their
         default styles can be removed with:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            plugin.tx_frontend._CSS_DEFAULT_STYLE >
            plugin.tx_indexedsearch._CSS_DEFAULT_STYLE >

         However, you will then have to define according styles yourself.



.. _setup-plugin-css-page-style:

\_CSS\_PAGE\_STYLE
------------------

.. container:: table-row

   Property
         \_CSS\_PAGE\_STYLE

   Data type
         :ref:`data-type-string`

   Description
         `_CSS_PAGE_STYLE` is included only on the affected pages. Depending
         on your configuration it will be written in an external file and included
         on the page or directly added as inline CSS block. Compression
         for page specific CSS also depends on the global :typoscript:`config.compressCss`
         setting.

         This setting can be used to only include the CSS when the plugin of a
         certain extension is included on that page.

         This value is read by the frontend :php:`RequestHandler` when
         collecting the CSS of the document to be rendered.



.. _setup-plugin-default-pi-vars-pivar-key:

\_DEFAULT\_PI\_VARS.[piVar-key]
-------------------------------

.. container:: table-row

   Property
         \_DEFAULT\_PI\_VARS.[piVar-key]

   Data type
         :ref:`data-type-string` / :ref:`stdwrap`

   Description
         Allows you to set default values of the piVars array which most
         plugins are using (and should use) for data exchange with themselves.

         This works only if the plugin calls :php:`$this->pi_setPiVarDefaults()`.

         The values have :ref:`stdWrap`, which also works recursively for multilevel
         keys.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            plugin.tt_news._DEFAULT_PI_VARS {
                year.stdWrap.data = date:Y
            }

         This sets the key "year" to the current year.



.. _setup-plugin-local-lang-lang-key-label-key:

\_LOCAL\_LANG.[lang-key].[label-key]
------------------------------------

.. container:: table-row

   Property
         \_LOCAL\_LANG.[lang-key].[label-key]

   Data type
         :ref:`data-type-string`

   Description
         Can be used to override the default language labels for the plugin. The 'lang-key' setup part is 'default' for the default language of the website or the 2-letter (ISO 639-1) code for the language. 'label-key' is the 'trans-unit id' xml value in the XLF language file which resides in the path :file:`Resources/Private/Language` of the extension or in the :file:`typo3conf/l10n/[lang-key]` (:file:`var/labels/[lang-key]` in composer mode) subfolder of the TYPO3 root folder. And on the right side of the equation sign '=' you put the new value string for the language key which you want to override.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            plugin.tx_myext_pi1._LOCAL_LANG.de.list_mode_1 = Der erste Modus

         All variables, which are used inside an extension with
         :php:`$this->pi_getLL('list_mode_1', 'Text, if no entry in locallang.xlf', true);`
         can that way be overwritten with TypoScript. The :file:`locallang.xlf` file in
         the plugin folder in the file system can be used to get an overview of
         the entries the extension uses.

.. _setup-plugin-extbase:

Properties for all frontend plugins based on Extbase
=====================================================

.. _extbase_typoscript_configuration-features:

Features
--------

Activate features for Extbase or a specific plugin.

.. _setup-plugin-features-skipDefaultArguments:

features.skipDefaultArguments
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
         features.skipDefaultArguments

   Data type
         :ref:`data-type-boolean`

   Default
         false

   Description
         **Only for Extbase plugins**. Skip default arguments in URLs.
         If a link to the default controller or action is created, the parameters are omitted.

   Example
         .. code-block:: typoscript
            :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

            plugin.tx_blogexample_rssfeed {
              features {
                skipDefaultArguments = 1
              }
            }

.. _setup-plugin-features-ignoreAllEnableFieldsInBe:

features.ignoreAllEnableFieldsInBe
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      features.ignoreAllEnableFieldsInBe

   Data type
      :ref:`data-type-boolean`

   Default
      false

   Description
      **Only for Extbase plugins**. Ignore the enable fields in backend.


   Example
      .. code-block:: typoscript
         :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

         plugin.tx_blogexample_admin {
           features {
             ignoreAllEnableFieldsInBe = 1
           }
         }

.. _extbase_typoscript_configuration-persistence:

Persistence
-----------

Settings, relevant to the persistence layer of Extbase.

.. _setup-plugin-persistence-enableAutomaticCacheClearing:
.. _extbase_persistence-enableAutomaticCacheClearing:

persistence.enableAutomaticCacheClearing
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      persistence.enableAutomaticCacheClearing

   Data type
      :ref:`data-type-boolean`

   Default
      true

   Description
      **Only for Extbase plugins**.
      Enables the automatic cache clearing when changing data sets (see also
      :ref:`t3coreapi:extbase_caching_of_actions_and_records`).


   Example
      .. code-block:: typoscript
         :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

         plugin.tx_blogexample_admin {
           persistence {
             enableAutomaticCacheClearing = 0
           }
         }

.. _setup-plugin-persistence-storagePid:

persistence.storagePid
~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      persistence.storagePid

   Data type
      :ref:`data-type-boolean`

   Default
      true

   Description
      **Only for Extbase plugins**. List of Page-IDs, from which all records
      are read.


   Example
      .. code-block:: typoscript
         :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

         plugin.tx_blogexample {
           persistence {
             storagePid = 42
           }
         }


.. _setup-plugin-view:

View
----

View and template settings.

All root paths are defined as an array which enables you to define multiple
root paths that will be used by Extbase to find the desired template files.

The root paths work just like the one in the
:ref:`FLUIDTEMPLATE <cobj-fluidtemplate-properties-templaterootpaths>`.

**Example**

.. code-block:: typoscript
   :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

   plugin.blog_example {
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


.. _setup-plugin-view-layoutRootPaths:

view.layoutRootPaths
~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      view.layoutRootPaths

   Data type
      (array of indexes)

   Description
      **Only for Extbase plugins**. This can be used to specify the root paths
      for all Fluid layouts. If nothing is specified, the path
      :file:`EXT:my_extension/Resources/Private/Layouts` is used.

.. _setup-plugin-view-partialRootPaths:

view.partialRootPaths
~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      view.partialRootPaths

   Data type
      (array of indexes)

   Description
      **Only for Extbase plugins**. This can be used to specify the root
      paths for all Fluid partials. If nothing is specified, the path
      :file:`EXT:my_extension/Resources/Private/Partials` is used.

.. _setup-plugin-view-templateRootPaths:

view.templateRootPaths
~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      view.templateRootPaths

   Data type
      (array of indexes)

   Description
      This can be used to specify the root paths for all Fluid templates in this
      extension. If nothing is specified, the path
      :file:`EXT:my_extension/Resources/Private/Templates` is used.


.. _setup-plugin-view-pluginNamespace:

view.pluginNamespace
~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      view.pluginNamespace

   Data type
      (array of indexes)

   Description
      This can be used to specify an alternative namespace for the plugin.
      Use this to shorten the Extbase default plugin namespace or to access
      arguments from other extensions by setting this option to their namespace.


.. _extbase_typoscript_configuration-mvc:

MVC
---

These are useful MVC settings about error handling:

.. _setup-plugin-mvc-callDefaultActionIfActionCantBeResolved:

mvc.callDefaultActionIfActionCantBeResolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      mvc.callDefaultActionIfActionCantBeResolved

   Data type
      :ref:`data-type-boolean`

   Default
      false

   Description
      **Only for Extbase plugins**. Will cause the controller to show
      its default action if the called action is not allowed by the controller.

   Example
      .. code-block:: typoscript
         :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

         plugin.tx_blogexample {
           mvc {
             callDefaultActionIfActionCantBeResolved = 1
           }
         }


.. _setup-plugin-mvc-throwPageNotFoundExceptionIfActionCantBeResolved:

mvc.throwPageNotFoundExceptionIfActionCantBeResolved
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. container:: table-row

   Property
      mvc.callDefaultActionIfActionCantBeResolved

   Data type
      :ref:`data-type-boolean`

   Default
      false

   Description
      Same as :ref:`setup-plugin-mvc-callDefaultActionIfActionCantBeResolved`
      but this will raise a "page not found" error.

   Example
      .. code-block:: typoscript
         :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

         plugin.tx_blogexample {
           mvc {
             throwPageNotFoundExceptionIfActionCantBeResolved = 1
           }
         }


.. _extbase_format:

Format
------

.. warning::
   Using this parameter is considered bad practice. In most cases it is better
   use different actions for different output formats.

.. container:: table-row

   Property
      format

   Data type
      :ref:`data-type-string`

   Default
      html

   Description
      Define the default file ending of the template files. The template files
      have to take care of creating the desired format output.

   Example
      .. code-block:: typoscript
         :caption: EXT:blog_example/Configuration/TypoScript/setup.typoscript

         plugin.tx_blogexample_rssfeedxml {
           // Use template List.xml
           format = xml
         }
         plugin.tx_blogexample_rssfeedatom {
           // Use template List.atom
           format = atom
         }

.. _extbase_typoscript_configuration-settings:

Settings
--------

Here reside are all the settings, both extension-wide and plugin-specific.
These settings are available in the controllers as the array variable
:php:`$this->settings` and in any Fluid template with `{settings}`.

The settings for a specific plugin can be overridden by FlexForm values of the
same name.

.. ###### END~OF~TABLE ######
