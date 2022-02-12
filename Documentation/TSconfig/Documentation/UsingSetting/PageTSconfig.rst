.. include:: /Includes.rst.txt
.. index::
   Page TSconfig; Setting
   Page TSconfig; Using
   Page TSconfig
.. _setting-page-tsconfig:

=====================
Setting Page TSconfig
=====================

It is recommended to always define custom page TSconfig in a project-specific
:ref:`sitepackage <t3sitepackage:start>` extension. This way the Page TSconfig
settings can be kept under version control.

The options described below are available for setting Page TSconfig in
non-sitepackage extensions.

Page TSconfig can be defined globally as
:ref:`Default Page TSconfig <pagesettingdefaultpagetsconfig>` or for a
:ref:`page tree <include-static-page-tsconfig>`, a page and all its subpages.

It is also possible to set
:ref:`set Page TSconfig directly in the page properties <pagetsconfig-enter-data>` but
this is not recommended anymore.


.. index:: pair: Page TSconfig; Default values
.. _pagesettingdefaultpagetsconfig:

Setting the Page TSconfig globally
==================================

Many page TSconfig settings can be set globally. This is useful for
installations that contain only one site and use only one sitepackage extension.

Extensions supplying custom default Page TSconfig that should always be included,
can also set the Page TSconfig globally.

Use extension API function :code:`addPageTSConfig()` in the
:file:`ext_localconf.php` file of your extension:

.. code-block:: php
   :caption: EXT:my_sitepackage/ext_localconf.php

   use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

   ExtensionManagementUtility::addPageTSConfig('
      TCEMAIN.table.pages {
         disablePrependAtCopy = 1
      }
   ');

There is a global `TYPO3_CONF_VARS` value called
:ref:`$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultPageTSconfig'] <t3coreapi:typo3ConfVars_be_defaultPageTSconfig>`.

The API function above adds content to that array. The array value itself
however should **not** be changed or set directly (for example in the
:file:`LocalConfiguration.php`).

It is best practice to use the above API method to add your default
Page TSconfig in a project-specific
:ref:`sitepackage <t3sitepackage:start>` extension.

Use the :typoscript:`@import '...'` syntax to keep the Page TSconfig in a
separate file.

.. code-block:: php
   :caption: EXT:my_sitepackage/ext_localconf.php

   use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

   ExtensionManagementUtility::addPageTSConfig(
       "@import 'EXT:myexample/Configuration/TSconfig/Page/Mod/Wizards/NewContentElement.tsconfig'"
   );

   ExtensionManagementUtility::addPageTSConfig(
       "@import 'EXT:myexample/Configuration/TSconfig/Page/Basic.tsconfig'
       @import 'EXT:myexample/Configuration/TSconfig/Page/TCEFORM.tsconfig'"
   );

   if (ExtensionManagementUtility::isLoaded('linkvalidator')) {
        ExtensionManagementUtility::addPageTSConfig(
            "@import 'EXT:myexample/Configuration/TSconfig/Page/Linkvalidator.tsconfig'"
        );
   }


.. index:: pair: Page TSconfig; Static TSconfig files
.. _pagesettingstaticpagetsconfigfiles:

Static Page TSconfig
====================

.. _include-static-page-tsconfig:

Include static Page TSconfig into a page tree
---------------------------------------------

Static Page TSconfig that has been
:ref:`registered <register-static-page-tsconfig>` by your sitepackage or a
third party extension can be included in the page properties.

#. Go to the page properties of the page where you want to include the page TSconfig.
#. Go to the tab :guilabel:`Resources`, then to
    :guilabel:`Page TSconfig > Include static Page TSconfig (from extensions)` and
    select the desired configurations from the :guilabel:`Available Items`.

.. _register-static-page-tsconfig:

Register static Page TSconfig files
-----------------------------------

Register PageTS config files in the :file:`Configuration/TCA/Overrides/pages.php`
of any extension.

These can be :ref:`selected in the page properties <include-static-page-tsconfig>`.

.. code-block:: php
   :caption: EXT:my_sitepackage/Configuration/TCA/Overrides/pages.php

   use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

   ExtensionManagementUtility::registerPageTSConfigFile(
      'extension_name',
      'Configuration/TSconfig/Page/myPageTSconfigFile.tsconfig',
      'My special config'
   );

It is not possible to use language strings :php:`LLL:...` for the third
parameter as the extension name will be automatically appended.

If you need to localize these labels, modify the TCA directly instead of using
the API function:

.. code-block:: php
   :caption: EXT:my_sitepackage/Configuration/TCA/Overrides/pages.php

   $GLOBALS['TCA']['pages']['columns']['tsconfig_includes']['config']['items'][] =
   [
      'LLL:EXT:my_sitepackage/Resources/Private/Language/locallang_db.xlf:pages.pageTSconfig.my_ext_be_layouts'
      'EXT:my_sitepackage/Configuration/TSconfig/Page/myPageTSconfigFile.tsconfig',
   ];

.. index:: pair: Page TSconfig; Enter data
.. _pagetsconfig-enter-data:
.. _pagethetsconfigfield:

Set Page TSconfig directly in the page properties
==================================================

Go to the page properties of the page where you want to include the page TSconfig
and open the tab :guilabel:`Resources`.

You can enter page TSconfig directly into the field :guilabel:`Page TSconfig`:

.. figure:: /Images/ManualScreenshots/List/TSconfigPageInput.png
    :alt: TSconfig-related fields in the Resources tab of a page
    :class: with-shadow

Page TSconfig inserted directly into the page properties is applied to the
page itself and all its subpages.

.. note::
   The configuration is stored in the database and not in the file
   system. Therefore it cannot be kept under version control. This
   strategy is not recommended. Setting Page TSconfig in the page properties
   directly is available for backward-compatibility reasons and for quickly trying
   out some settings in development only.

.. index:: pair: Page TSconfig; Verify configuration
.. _pageverifyingthefinalconfiguration:

Verify the final configuration
==============================

The full Page TSconfig for any given page can be viewed using the module
:guilabel:`Web > Info` module, action :guilabel:`Page TSconfig`.

.. figure:: /Images/ManualScreenshots/Info/TSconfigOverview.png
   :alt: Viewing Page TSconfig using the Info module


.. index:: pair: Page TSconfig; Override values
.. _page-overriding-and-modifying-values:

Overriding and modifying values
================================

Page TSconfig is loaded in the following order, the latter override the former:

#. :ref:`Default Page TSconfig <pagesettingdefaultpagetsconfig>` that was
   set globally
#. :ref:`Static Page TSconfig <pagesettingdefaultpagetsconfig>` that was
   included for a page tree.
#. :ref:`Direct Page TSconfig <pagetsconfig-enter-data>` entered directly in
   the page properties.
#. :ref:`User TSconfig overrides <userrelationshiptovaluessetinpagetsconfig>`

Static and direct Page TSconfig are loaded for the page they are set on and
all their subpages.

The TypoScript syntax to
:ref:`modify <t3coreapi:typoscript-syntax-syntax-value-modification>` values
can also be used for the Page TSconfig.


Example
=======

Default page TSconfig

.. code-block:: typoscript

	RTE.default.showButtons = bold

Static page TSconfig included on the parent page

.. code-block:: typoscript

	RTE.default.showButtons := addToList(italic)

Finally you get the value "bold,italic".
