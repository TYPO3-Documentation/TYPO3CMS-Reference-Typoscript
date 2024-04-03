..  include:: /Includes.rst.txt
..  index:: Top-level objects; module

..  _tlo-module:

======
module
======

The backend module of an extension can be configured via TypoScript.
The configuration is done in
:typoscript:`module.tx_<lowercaseextensionname>_<lowercasepluginname>`.
:typoscript:`_<lowercasepluginname>` can be ommited then the setting is used
for all backend modules of that extension.

Even though we are in the backend context here we use TypoScript setup. The
settings should be done globally and not changed on a per-page basis.
Therefore they are usually done in the file
:ref:`EXT:my_extension/ext_typoscript_setup.typoscript <t3coreapi:ext_typoscript_setup_typoscript>`.

..  _module-options:

Options for simple backend modules
===================================

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

Most configuration options that can be done for Extbase frontend plugins
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

features.skipDefaultArguments
-----------------------------

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
              features.skipDefaultArguments = 1
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
                100 = EXT:my_extension/Configuration/Form/CustomFormSetup.yaml
            }
        }
    }
