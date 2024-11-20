..  include:: /Includes.rst.txt
..  index:: Top-level objects; module

..  _tlo-module:

======
module
======

The backend module of an extension can be configured via TypoScript.
The configuration is done in
:typoscript:`module.tx_<lowercaseextensionname>_<lowercasepluginname>`.
:typoscript:`_<lowercasepluginname>` can be omitted then the setting is used
for all backend modules of that extension.

Even though we are in the backend context here we use TypoScript setup. The
settings should be done globally and not changed on a per-page basis.
Therefore they are usually done in the file
:ref:`EXT:my_extension/ext_typoscript_setup.typoscript <t3coreapi:ext_typoscript_setup_typoscript>`.

..  versionchanged:: 12.0
    All Core extensions, and in general all extensions
    that switch to the :ref:`simplified backend templating <changelog:feature-96812>`
    no longer use the frontend TypoScript based override approach. This has been
    superseded by a general override strategy based on TSconfig:
    :ref:`templates <pagetemplates>`.

..  _module-options:

Options for simple backend modules
==================================

..  warning::
    It is strongly recommended not to use TypoScript in custom **backend modules**, for example
    :typoscript:`module.tx_myextension`. Use custom
    :ref:`Page TSconfig in namespace tx_* <page-tsconfig-extension-namespace>`
    instead.

The configuring backend modules via frontend TypoScript
is flawed by design: It on one hand forces backend modules to parse the full frontend
TypoScript, which is a general performance penalty in the backend - the backend then
scales with the amount of frontend TypoScript. Also, the implementation is based on
the Extbase ConfigurationManager, which leads to the situation that casual non-Extbase
backend modules have an indirect dependency to lots of Extbase code.

In simple backend modules extension authors can decide how to use this
namespace. By convention settings should go in the subsection
:typoscript:`settings`.

..  code-block:: typoscript
    :caption: EXT:my_extension/ext_typoscript_setup.typoscript

    module.tx_myextension_somemodule {
        settings {
            enablesomething = 1
        }
    }

..  _tlo-module-options-extbase:

Options for Extbase backend modules
===================================

Most configuration options that can be done for :ref:`Extbase <t3coreapi:extbase>` frontend plugins
can also be done for Extbase backend modules:

..  contents::
    :local:

..  index:: module; view.templateRootPaths
..  _tlo-module-properties-templaterootpaths:

view.templateRootPaths
----------------------

..  confval:: view.templateRootPaths.[array]
    :name: module-view-templateRootPaths
    :type: file path with :ref:`stdWrap <stdwrap>`

    ..  versionchanged:: 12.0
        All Core extensions, and in general all extensions
        that switch to the :ref:`simplified backend templating <changelog:feature-96812>`
        no longer use the frontend TypoScript based override approach. This has been
        superseded by a general override strategy based on TSconfig:
        :ref:`templates <pagetemplates>`.

    Used to define several paths for templates, which are executed in reverse
    order (the paths are searched from bottom to top). The first folder where
    the desired layout is found is immediately used. If the array keys are numeric, they
    are first sorted and then executed in reverse order.

..  _tlo-module-properties-templaterootpaths-example:

Example: Set the template root paths
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:my_extension/ext_typoscript_setup.typoscript

    module.tx_somebackend_module {
        view {
            templateRootPaths {
                100 = EXT:my_extension/Resources/Private/Templates/Backend
            }
        }
    }

..  index:: module; view.partialRootPaths
..  _tlo-module-properties-partialRootPaths:

view.partialRootPaths
----------------------

..  confval:: view.partialRootPaths.[array]
    :name: module-view-partialRootPaths
    :type: file path with :ref:`stdWrap <stdwrap>`

    ..  versionchanged:: 12.0
        All Core extensions, and in general all extensions
        that switch to the :ref:`simplified backend templating <changelog:feature-96812>`
        no longer use the frontend TypoScript based override approach. This has been
        superseded by a general override strategy based on TSconfig:
        :ref:`templates <pagetemplates>`.

    Used to define several paths for partials, which will be executed in reverse
    order. The first folder where the desired partial is found, is used. The
    keys of the array define the order.


Example: Set the partial root paths
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:my_extension/ext_typoscript_setup.typoscript

    module.tx_somebackend_module {
        view {
            partialRootPaths {
                100 = EXT:my_extension/Resources/Private/Partials/Backend
            }
        }
    }


..  index:: module; settings
..  _tlo-module-properties-settings:

features.enableNamespacedArgumentsForBackend
--------------------------------------------

..  versionadded:: 12.0

..  deprecated:: 12.4
    Extbase backend modules should no longer expect the namespace to be set. It
    may be necessary to adapt some Ajax calls and request-related argument
    checks in custom modules.

Extbase plugins and backend modules traditionally use the plugin / module
namespace to prefix their get parameters and form data. In the frontend context,
this makes sense, as multiple plugins may reside on a page. In the backend,
however, an Extbase module is responsible for rendering a complete view.
Therefore, the namespacing of arguments has been disabled, making URLs easier
to read, more in line with non-Extbase modules and allowing Extbase modules
to directly access outside information like the `id` parameter handed over
by the page tree.

To allow Extbase modules to configure this behavior, the Extbase feature
flag :typoscript:`enableNamespacedArgumentsForBackend` can be set in the module
configuration, turning the namespacing off or on.


.. rst-class:: dl-parameters

features.enableNamespacedArgumentsForBackend
   :sep:`|` :aspect:`Data type:` boolean
   :sep:`|`

   Extbase will by default build and react to backend module links without paying
   attention to the namespace of the parameters.

   A link may look like this:

   `https://example.org/typo3/module/web/BeuserTxBeuser?action=groups&controller=BackendUser`

   If a module explicitly wants to keep using the namespaced version of the arguments,
   the feature flag can be set:

   .. code-block:: typoscript
      :caption: EXT:my_extension/ext_typoscript_setup.typoscript

      module.tx_somebackend_module {
          features {
              enableNamespacedArgumentsForBackend = 1
          }
      }

features.skipDefaultArguments
-----------------------------

..  deprecated:: 12.4
    Switch to proper :ref:`routing configuration <t3coreapi:routing-extbase-plugin-enhancer>`
    instead.

.. rst-class:: dl-parameters

features.skipDefaultArguments
   :sep:`|` :aspect:`Data type:` boolean
   :sep:`|`

   If enabled, default controller and/or action is skipped when creating
   URIs through the URI Builder.  If a link to the default controller or
   action is created, the parameters are omitted.

   .. code-block:: typoscript
      :caption: EXT:my_extension/ext_typoscript_setup.typoscript

      module.tx_somebackend_module {
          features {
              skipDefaultArguments = 1
          }
      }

settings
--------

..  confval:: settings
    :name: module-settings
    :type: array<string, mixed>

Here resides all of the settings. These settings are
available in the controller of the backend module as the array variable
:php:`$this->settings`.

Example: Limit pagination in the backend
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Show 25 news records in the backend module of the news extension:

..  code-block:: typoscript
   :caption: EXT:my_extension/ext_typoscript_setup.typoscript

   module.tx_news {
      settings.list.paginate.itemsPerPage = 25
   }

Example: Register YAML file
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Register your :doc:`typo3/cms-form:Index` configuration for the backend via TypoScript.

..  code-block:: typoscript
    :caption: EXT:my_extension/ext_typoscript_setup.typoscript

    module.tx_form {
        settings {
            yamlConfigurations {
                # Use the current timestamp as key to avoid accidental overwriting
                1712163960 = EXT:my_extension/Configuration/Form/CustomFormSetup.yaml
            }
        }
    }
