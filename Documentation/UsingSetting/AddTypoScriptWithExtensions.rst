:navigation-title: TypoScript in Extensions

..  include:: /Includes.rst.txt
..  index:: TypoScript in extensions
..  _extdev-add-typoscript:

================================================
Provide frontend TypoScript in a TYPO3 extension
================================================

..  versionchanged:: 13.1
    TypoScript on a per-site basis can now be included via
    :ref:`sites and sets <typoscript-site-sets>`.

..  note::

    This part is written for extension developers.


..  index:: TypoScript in extensions; File locations
..  _extdev-add-typoscript-extension:

Provide TypoScript in your extension or site package
====================================================

TypoScript files **must** have the ending :file:`.typoscript`.

They are located in :path:`Configuration/Sets/MySet` within your
extension. Read more about how to
:ref:`provide the TypoScript as set for TYPO3 v13 and above <extdev-add-typoscript-sets>`
and :ref:`how to provide TypoScript for both TYPO3 v13 and v12 <extdev-add-typoscript-sets-v12>`.

*   :file:`constants.typoscript` contains the frontend TypoScript constants
*   :file:`setup.typoscript` contains the frontend TypoScript

..  _extdev-add-typoscript-sets:
..  _extdev-add-typoscript-sets-typoscript:

TypoScript provided as site set (only TYPO3 v13.1 and above)
============================================================

The file structure of the extension could, for example look like this:

..  directory-tree::
    :show-file-icons: true

    *   Configuration

        *   Sets

            *   MyExtension

                *   :ref:`config.yaml <extdev-add-typoscript-sets-main>`
                *   :ref:`constants.typoscript <extdev-add-typoscript-sets-typoscript>`
                *   :ref:`setup.typoscript <extdev-add-typoscript-sets-typoscript>`

            *   MyExtensionWithACoolFeature

                *   :ref:`config.yaml <extdev-add-typoscript-sets-feature>`
                *   :ref:`setup.typoscript <extdev-add-typoscript-sets-typoscript>`

    *   Resources

        *   ...

    *   composer.json
    *   ...

With the extension's TypoScript residing in :file:`EXT:my_extension/Configuration/Sets/MyExtension`
and the TypoScript for some optional feature in
:file:`EXT:my_extension/Configuration/Sets/MyExtensionWithACoolFeature`. Let us assume, that the
optional feature depends on the main TypoScript.

The sets can now be defined for TYPO3 v13 as follows:

..  _extdev-add-typoscript-sets-main:

The main set of the extension
-----------------------------

..  literalinclude:: _Sets/_MyExtension_config.yaml
    :language: yaml
    :caption: EXT:my_extension/Configuration/Sets/MyExtension/config.yaml


..  _extdev-add-typoscript-sets-feature:

The sub set for an optional feature
-----------------------------------

..  literalinclude:: _Sets/_MyExtensionWithACoolFeature_config.yaml
    :language: yaml
    :caption: EXT:my_extension/Configuration/Sets/MyExtensionWithACoolFeature/config.yaml


..  _extdev-add-typoscript-sets-override:

Overriding the TypoScript
-------------------------

The TypoScript provided in the site set will be loaded exactly once and respect
the dependencies defined in the site set configuration. Therefore if you
have to override the frontend TypoScript of another site set your site set
should depend on the other site set:

..  code-block:: yaml
    :caption: packages/my_site_package/Configuration/Sets/MySitePackage/config.yaml

    name: my-vendor/my-site-package
    label: My Set
    dependencies:
      - my-vendor/my-other-set
      - some-vendor/some-extension

Your extension can then safely override frontend TypoScript of the `some_extension`,
for example:

..  code-block:: typoscript
    :caption: packages/my_site_package/Configuration/Sets/MySitePackage/setup.typoscript

    plugin.some_extension_pi1.settings.someSetting = Special setting

..  _extdev-add-typoscript-sets-v12-static_includes:
..  _extdev-static-includes:
..  _extdev-add-typoscript-sets-v12:

Supporting both site sets and TypoScript records
================================================

..  versionchanged:: 13.1
    With TYPO3 13.1
    `site sets as TypoScript provider <https://docs.typo3.org/permalink/t3coreapi:site-sets-typoscript>`_
    where introduced. Existing extensions **should** support site sets as well as
    TypoScript records for backward compatibility reasons.

..  warning::
    For historic reasons you might still see filenames like :file:`setup.ts` and
    :file:`setup.txt`. These files **cannot** be included with the
    :ref:`@import <t3tsref:typoscript-syntax-import>` syntax. All frontend
    TypoScript files **must** end on `.typoscript`.

.. _extension-configuration-typoscript-set-record-one:

One TypoScript include set
--------------------------

If your extension supported one static file include you should provide the same
files in your main site set as well:

.. code-block:: php
   :caption: EXT:my_extension/Configuration/TCA/Overrides/sys_template.php (before and after)

   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
       'my_extension',
       'Configuration/TypoScript/',
       'Examples TypoScript'
   );

In your main site set provide the same files that where provided as includes
by :php:`\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile`
until now:

..  directory-tree::
    :level: 3
    :show-file-icons: true

    *   packages/my_extension/Configuration/

        *   Sets

            *   MySet

                *   config.yaml
                *   constants.typoscript
                *   setup.typoscript


        *   TypoScript

            *   constants.typoscript
            *   setup.typoscript

..  code-block:: typoscript
    :caption: packages/my_extension/Configuration/Sets/MySet/constants.typoscript

    @import 'EXT:my_extension/Configuration/TypoScript/setup.typoscript'

..  code-block:: typoscript
    :caption: packages/my_extension/Configuration/Sets/MySet/setup.typoscript

    @import 'EXT:my_extension/Configuration/TypoScript/setup.typoscript'

.. _extension-configuration-typoscript-set-record-multiple:

Multiple TypoScript include sets
--------------------------------

If there should be more then one set of TypoScript templates that may be
included, they were usually stored in sub folders of
:path:`Configuration/TypoScript` until now.

When introducing site sets usually one site set per TypoScript record include
set is needed:

..  directory-tree::
    :level: 3
    :show-file-icons: true

    *   packages/my_extension/Configuration

            *   TypoScript

                *   SpecialFeature1

                    *   constants.typoscript
                    *   setup.typoscript

                *   SpecialFeature2

                    *   setup.typoscript

                *   constants.typoscript
                *   setup.typoscript

            *   Sets

                *   MyMainSet

                    *   config.yaml
                    *   constants.typoscript
                    *   setup.typoscript

                *   MySpecialFeature1Set

                    *   config.yaml
                    *   constants.typoscript
                    *   setup.typoscript

                *   MySpecialFeature2Set

                    *   config.yaml
                    *   setup.typoscript

For backward compability reasons :php:`ExtensionManagementUtility::addStaticFile`
still needs to be called for each folder that should be available in the TypoScript
template record:

.. code-block:: php
   :caption: EXT:my_extension/Configuration/TCA/Overrides/sys_template.php

   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
       'my_extension',
       'Configuration/TypoScript/',
       'My Extension - Main TypoScript'
   );

   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
       'my_extension',
       'Configuration/TypoScript/Example1/',
       'My Extension - Additional example 1'
   );

   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
       'my_extension',
       'Configuration/TypoScript/SpecialFeature2/',
       'My Extension - Some special feature'
   );

Each site set then provides the TypoScript files the according location by
importing it, for example:

..  code-block:: typoscript
    :caption: packages/my_extension/Configuration/Sets/MySet/setup.typoscript

    @import 'EXT:my_extension/Configuration/TypoScript/MySpecialFeature2Set/setup.typoscript'

..  index:: TypoScript in extensions; Load always
..  _extdev-always-load:

Make TypoScript available (always load)
=======================================


Use :php:`ExtensionManagementUtility::addTypoScript` if the frontend
TypoScript **must** be available in backend modules without page context,
for example to :ref:`register the YAML of the EXT:form system extension
for the backend <typo3/cms-form:concepts-configuration-yamlregistration-backend>`.

..  literalinclude:: _Sets/_ext_localconf.php
    :caption: EXT:my_extension/ext_localconf.php

..  warning::
    While the content from the files
    `ext_typoscript_setup.typoscript <https://docs.typo3.org/permalink/t3coreapi:ext_typoscript_setup_typoscript>`_
    and `ext_typoscript_constants.typoscript <https://docs.typo3.org/permalink/t3coreapi:ext_typoscript_constants_typoscript>`_
    is loaded by default in sites based on **TypoScript records** it is not
    loaded in sites depending on **site sets as TypoScript providers**.


More information
================

* :ref:`t3sitepackage:typoscript-configuration` (in "Sitepackage Tutorial")`
* :ref:`t3sitepackage:extension-configuration` (in "Sitepackage Tutorial")`
