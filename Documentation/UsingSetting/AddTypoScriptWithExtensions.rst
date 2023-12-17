.. include:: /Includes.rst.txt
.. index:: TypoScript in extensions
.. _extdev-add-typoscript:

================================
Add TypoScript in your extension
================================

.. note::

   This part is written for extension developers.


.. index:: TypoScript in extensions; File locations

Create TypoScript files in your extension
=========================================

TypoScript files should have the ending :file:`.typoscript`.

They are located in :file:`Configuration/TypoScript` within your
extension.

Usually, you will have the following structure:

.. code-block:: none

   Configuration/
   └── TypoScript
       ├── constants.typoscript
       └── setup.typoscript


* :file:`constants.typoscript` contains the constants
* :file:`setup.typoscript` contains the TypoScript setup


.. index:: TypoScript in extensions; Static includes
.. _extdev-static-includes:

Make TypoScript available for static includes
=============================================

.. code-block:: php
   :caption: EXT:my_extension/Configuration/TCA/Overrides/sys_template.php

   <?php
   defined('TYPO3') or die();

   call_user_func(function()
   {
      $extensionKey = 'myextension';

      /**
       * Default TypoScript
       */
      \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
         $extensionKey,
         'Configuration/TypoScript',
         'Some descriptive title'
      );
   });

If you include the TypoScript this way, it will not be automatically loaded.
You MUST load it by adding the static include in the :guilabel:`Web > Template`
module in the backend, see :ref:`static-includes`. This has the advantage of
better configurability.

This will load your constants and your setup once the template is
included statically.

.. tip::

   You may also want to make several different templates available.


.. index:: TypoScript in extensions; Load always
.. _extdev-always-load:

Make TypoScript available (always load)
=======================================

Only do this, if your TypoScript must really be always loaded in your site.
If this is not the case, use the method described in the previous section
:ref:`extdev-static-includes`.

.. code-block:: php
   :caption: EXT:my_extension/ext_localconf.php

   defined('TYPO3') or die();

   call_user_func(function()
   {
      $extensionKey = 'myextension';

      \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
         $extensionKey,
         'setup',
         "@import 'EXT:myextension/Configuration/TypoScript/setup.typoscript'"
      );
   });


More information
================

* :ref:`t3sitepackage:typoscript-configuration` (in "Sitepackage Tutorial")`
* :ref:`t3sitepackage:extension-configuration` (in "Sitepackage Tutorial")`
