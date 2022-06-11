.. include:: /Includes.rst.txt
.. index::
   Page TSconfig; Setting
   Page TSconfig; Using
   Page TSconfig
.. _setting-page-tsconfig:

=====================
Setting page TSconfig
=====================

It is recommended to always define custom page TSconfig in a project-specific
:doc:`sitepackage <t3sitepackage:Index>` extension. This way the page TSconfig
settings can be kept under version control.

The options described below are available for setting page TSconfig in
non-sitepackage extensions.

Page TSconfig can be defined globally as
:ref:`Default page TSconfig <pagesettingdefaultpagetsconfig>` or for a
:ref:`page tree <include-static-page-tsconfig>`, a page and all its subpages.

It is also possible to set
:ref:`set page TSconfig directly in the page properties <pagetsconfig-enter-data>` but
this is not recommended anymore.


.. index:: pair: Page TSconfig; Default values
.. _pagesettingdefaultpagetsconfig:

Setting the page TSconfig globally
==================================

.. versionadded:: 12.0
   Starting with TYPO3 12.0 page TSconfig in a file named
   :file:`Configuration/page.tsconfig` in an extension is automatically
   loaded during build time.

Global page TSconfig should be stored within an extension, usually a sitepackage
extension. The content of the file :file:`Configuration/page.tsconfig` within
an extension is automatically loaded during build time.

It is possible to load other TSconfig files with the import syntax within this
file:

.. code-block:: tsconfig
   :caption: EXT:my_sitepackage/Configuration/page.tsconfig

   @import 'EXT:myexample/Configuration/TSconfig/Page/Basic.tsconfig'
   @import 'EXT:myexample/Configuration/TSconfig/Page/Mod/Wizards/NewContentElement.tsconfig'


Many page TSconfig settings can be set globally. This is useful for
installations that contain only one site and use only one sitepackage extension.

Extensions supplying custom default page TSconfig that should always be included,
can also set the page TSconfig globally.

Global page TSconfig, compatible with TYPO3 11 and 12
-----------------------------------------------------

In TYPO3 11 installations the content of file:`Configuration/page.tsconfig`
is not loaded automatically yet. You can achive compatibility with both
TYPO3 11 and 12 by importing the content of this file with the API function
:php:`ExtensionManagementUtility::addPageTSConfig`:

.. code-block:: php
   :caption: EXT:my_sitepackage/ext_localconf.php

   use TYPO3\CMS\Core\Information\Typo3Version;
   use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
   use TYPO3\CMS\Core\Utility\GeneralUtility;

   $versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
   // Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
   if ($versionInformation->getMajorVersion() < 12) {
      ExtensionManagementUtility::addPageTSConfig('
         @import "EXT:my_sitepackage/Configuration/page.tsconfig"
      ');
   }

.. index:: pair: Page TSconfig; Static TSconfig files
.. _pagesettingstaticpagetsconfigfiles:

Static page TSconfig
====================

.. _include-static-page-tsconfig:

Include static page TSconfig into a page tree
---------------------------------------------

Static page TSconfig that has been
:ref:`registered <register-static-page-tsconfig>` by your sitepackage or a
third party extension can be included in the page properties.

#. Go to the page properties of the page where you want to include the page TSconfig.
#. Go to the tab :guilabel:`Resources`, then to
    :guilabel:`page TSconfig > Include static page TSconfig (from extensions)` and
    select the desired configurations from the :guilabel:`Available Items`.

.. _register-static-page-tsconfig:

Register static page TSconfig files
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

Set page TSconfig directly in the page properties
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
   strategy is not recommended. Setting page TSconfig in the page properties
   directly is available for backward-compatibility reasons and for quickly trying
   out some settings in development only.

.. index:: pair: Page TSconfig; Verify configuration
.. _pageverifyingthefinalconfiguration:

Verify the final configuration
==============================

The full page TSconfig for any given page can be viewed using the module
:guilabel:`Web > Info` module, action :guilabel:`Page TSconfig`.

.. figure:: /Images/ManualScreenshots/Info/TSconfigOverview.png
   :alt: Viewing Page TSconfig using the Info module


.. index:: pair: Page TSconfig; Override values
.. _page-overriding-and-modifying-values:

Overriding and modifying values
================================

Page TSconfig is loaded in the following order, the latter override the former:

#. :ref:`Default page TSconfig <pagesettingdefaultpagetsconfig>` that was
   set globally
#. :ref:`Static page TSconfig <pagesettingdefaultpagetsconfig>` that was
   included for a page tree.
#. :ref:`Direct page TSconfig <pagetsconfig-enter-data>` entered directly in
   the page properties.
#. :ref:`User TSconfig overrides <userrelationshiptovaluessetinpagetsconfig>`

Static and direct page TSconfig are loaded for the page they are set on and
all their subpages.

The TypoScript syntax to
:ref:`modify <t3coreapi:typoscript-syntax-syntax-value-modification>` values
can also be used for the page TSconfig.


Example
=======

Default page TSconfig

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

	RTE.default.showButtons = bold

Static page TSconfig included on the parent page

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

	RTE.default.showButtons := addToList(italic)

Finally you get the value "bold,italic".
