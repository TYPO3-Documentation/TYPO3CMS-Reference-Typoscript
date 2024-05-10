.. include:: /Includes.rst.txt
.. index:: TypoScript in extensions
.. _extdev-add-typoscript:

================================
Add TypoScript in your extension
================================

..  versionchanged:: 13.1
    TypoScript on a per-site basis can now be included via
    :ref:`sites and sets <typoscript-site-sets>`.

.. note::

   This part is written for extension developers.


.. index:: TypoScript in extensions; File locations

.. _extdev-add-typoscript-extension:

Create TypoScript files in your extension
=========================================

TypoScript files **must** have the ending :file:`.typoscript`.

They are located in :path:`Configuration/Sets/MySet` within your
extension. Read more about how to
:ref:`provide the TypoScript as set for TYPO3 v13 and above <extdev-add-typoscript-sets>`
and :ref:`how to provide TypoScript for both TYPO3 v13 and v12 <extdev-add-typoscript-sets-v12>`.

*   :file:`constants.typoscript` contains the constants
*   :file:`setup.typoscript` contains the TypoScript setup


.. _extdev-add-typoscript-sets:

TypoScript provided as site set (only TYPO3 v13.1 and above)
============================================================

The file structure of the extension could, for example look like this:

..  directory-tree::
    :show-file-icons: true

    *   Classes

        *   ...

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

.. _extdev-add-typoscript-sets-main:

The main set of the extension
-----------------------------

..  literalinclude:: _Sets/_MyExtension_config.yaml
    :language: yaml
    :caption: EXT:my_extension/Configuration/Sets/MyExtension/config.yaml


.. _extdev-add-typoscript-sets-feature:

The sub set for an optional feature
-----------------------------------

..  literalinclude:: _Sets/_MyExtensionWithACoolFeature_config.yaml
    :language: yaml
    :caption: EXT:my_extension/Configuration/Sets/MyExtensionWithACoolFeature/config.yaml


.. _extdev-add-typoscript-sets-typoscript:

TypoScript files provided by the sets
-------------------------------------

The TypoScript placed in the same folder like the set, contains your
configurations.


.. _extdev-add-typoscript-sets-v12:

TypoScript provided by extensions supporting TYPO3 v12.4 and v13
================================================================

When an extension provides TypoScript and should be compatible with both
TYPO3 v12.4 and v13, you can provide site sets but still support including
the TypoScript in the :sql:`sys_template` record via `static_file_include`'s.

The files in the sets are the same as in the
:ref:`example for TYPO3 v13 only <extdev-add-typoscript-sets>`.

The extended file structure of the extension could, for example look like this:

..  directory-tree::
    :show-file-icons: true

    *   Classes

        *   ...

    *   Configuration

        *   Sets

            *   MyExtension

                *   :ref:`config.yaml <extdev-add-typoscript-sets-main>`
                *   :ref:`constants.typoscript <extdev-add-typoscript-sets-typoscript>`
                *   :ref:`setup.typoscript <extdev-add-typoscript-sets-typoscript>`

            *   MyExtensionWithACoolFeature

                *   :ref:`config.yaml <extdev-add-typoscript-sets-feature>`
                *   :ref:`setup.typoscript <extdev-add-typoscript-sets-typoscript>`

        *   TCA

            *   Overrides

                sys_template.php


    *   Resources

        *   ...

    *   composer.json
    *   ...


.. _extdev-add-typoscript-sets-v12-static_includes:
.. _extdev-static-includes:

Only when supporting TYPO3 v12.4: Make TypoScript available for static includes
-------------------------------------------------------------------

Make TypoScript available for static includes (only needed if your extensions aims to support TYPO3 v12.4):

..  literalinclude:: _Sets/_TcaOverridesSystemplateV12.php
    :language: php
    :caption: EXT:my_extension/Configuration/TCA/Overrides/sys_template.php

If you include the TypoScript this way, it will not be automatically loaded.
You MUST load it by adding the static include in the :guilabel:`Web > Template`
module in the backend, see :ref:`static-includes`. This has the advantage of
better configurability.

This will load your constants and your setup once the template is
included statically.

.. index:: TypoScript in extensions; Load always
.. _extdev-always-load:

Make TypoScript available (always load)
=======================================

Only do this, if your TypoScript must really be always loaded in your site.
If this is not the case, use the method described in the previous section
:ref:`extdev-add-typoscript-sets`.

..  literalinclude:: _Sets/_ext_localconf.php
    :language: php
    :caption: EXT:my_extension/ext_localconf.php

It is also possible to put your TypoScript in a file called
:ref:`ext_typoscript_setup.typoscript <t3coreapi:ext_typoscript_setup_typoscript>`
or :ref:`ext_typoscript_constants.typoscript <t3coreapi:ext_typoscript_constants_typoscript>`
(for constants).


More information
================

* :ref:`t3sitepackage:typoscript-configuration` (in "Sitepackage Tutorial")`
* :ref:`t3sitepackage:extension-configuration` (in "Sitepackage Tutorial")`
