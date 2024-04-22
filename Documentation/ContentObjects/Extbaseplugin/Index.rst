..  include:: /Includes.rst.txt
..  index:: Content objects; EXTBASEPLUGIN
..  _cobj-extbaseplugin:

=============
EXTBASEPLUGIN
=============

..  versionadded:: 12.3

The content object :typoscript:`EXTBASEPLUGIN` allows to render
:ref:`Extbase <t3coreapi:extbase>` plugins.


..  contents::
    :local:

..  _cobj-extbaseplugin-properties:

Properties
==========

..  _cobj-extbaseplugin-extensionName:

extensionName
-------------

..  confval:: extensionName
    :name: extbaseplugin-extensionName
    :type: :ref:`data-type-string`

    The :ref:`extension name <t3coreapi:extension-naming-extensionName>`.


..  _cobj-extbaseplugin-pluginName:

pluginName
----------

..  confval:: pluginName
    :name: extbaseplugin-pluginName
    :type: :ref:`data-type-string`

    The plugin name.


..  _cobj-extbaseplugin-examples:

Example
=======

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    page.10 = EXTBASEPLUGIN
    page.10.extensionName = MyExtension
    page.10.pluginName = MyPlugin

..  _cobj-extbaseplugin-history:

History
=======

The :typoscript:`EXTBASEPLUGIN` allows Extbase authors to not reference the
Extbase Bootstrap class anymore, like for previous TYPO3 versions below version
12.

Previously, TypoScript code for Extbase plugins looked like this:

..  code-block:: typoscript

    page.10 = USER
    page.10 {
        userFunc = TYPO3\\CMS\\Extbase\\Core\\Bootstrap->run
        extensionName = MyExtension
        pluginName = MyPlugin
    }

This way still works, but it is recommended to use the
:typoscript:`EXTBASEPLUGIN` content object, as the direct reference to a PHP
class (Bootstrap) might be optimized in future versions.

For extension that need to remain compatible with TYPO3 v11 and v12, the
Bootstrap way should be used.
