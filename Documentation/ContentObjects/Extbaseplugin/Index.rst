..  include:: /Includes.rst.txt
..  index:: Content objects; EXTBASEPLUGIN
..  _cobj-extbaseplugin-history:
..  _cobj-extbaseplugin:

=============
EXTBASEPLUGIN
=============

The content object :typoscript:`EXTBASEPLUGIN` allows to render
:ref:`Extbase <t3coreapi:extbase>` plugins.

..  contents::
    :local:

..  _cobj-extbaseplugin-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:

..  _cobj-extbaseplugin-cache:

..  confval:: cache
    :name: extbaseplugin-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.


..  _cobj-extbaseplugin-extensionName:

..  confval:: extensionName
    :name: extbaseplugin-extensionName
    :type: :ref:`data-type-string`

    The :ref:`extension name <t3coreapi:extension-naming-extensionName>`.


..  _cobj-extbaseplugin-pluginName:

..  confval:: pluginName
    :name: extbaseplugin-pluginName
    :type: :ref:`data-type-string`

    The plugin name.


..  _cobj-extbaseplugin-examples:

Example: Display an Extbase plugin via TypoScript
=================================================

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    page.10 = EXTBASEPLUGIN
    page.10.extensionName = MyExtension
    page.10.pluginName = MyPlugin

..  _cobj-extbaseplugin-examples-fluid:

Example: Display an Extbase plugin in a Fluid template
======================================================

It is possible to display an Extbase plugin in Fluid using the
:ref:`CObject ViewHelper <f:cObject> <t3viewhelper:typo3-fluid-cobject>`:

..  literalinclude:: _CodeSnippets/_SomeTemplate.html
    :caption: EXT:my_extension/Resources/Private/Templates/Pages/SomeTemplate.html

Create a lib object which utilizes the :typoscript:`EXTBASEPLUGIN` into
a :typoscript:`lib` object:

..  literalinclude:: _CodeSnippets/_libMyPlugin.typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

For `extensionName` and `pluginName` use the names as configured in
:php:`\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin()`:

..  literalinclude:: _CodeSnippets/_configurePlugin.php
    :caption: EXT:my_extension/ext_localconf.php
    :emphasize-lines: 9,10

If you passed data to the ViewHelper, you can access the data in the controller's
action by getting the currentContentObject from the request:

..  literalinclude:: _CodeSnippets/_MyController.php
    :caption: EXT:my_extension/Classes/Controller/MyController.php
    :emphasize-lines: 16,17

..  note::
    You should treat all data from the
    :php-short:`\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer` as
    potential user input. Do not use it unescaped and do not trust to receive
    certain types.
