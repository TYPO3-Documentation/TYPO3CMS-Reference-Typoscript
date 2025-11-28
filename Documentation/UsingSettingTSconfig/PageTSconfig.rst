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
:ref:`sitepackage <t3sitepackage:start>` extension. This way the page TSconfig
settings can be kept under version control.

The options described below are available for setting page TSconfig in
non-sitepackage extensions.

Page TSconfig can be defined globally as
:ref:`Default page TSconfig <pagesettingdefaultpagetsconfig>`, on site level via
:ref:`Page TSconfig via site or set <include-static-page-tsconfig-per-site>` or for a
:ref:`page tree <include-static-page-tsconfig>`, a page and all its subpages.

It is also possible to set
:ref:`set page TSconfig directly in the page properties <pagetsconfig-enter-data>` but
this is not recommended anymore.

.. contents::
   :local:

.. index:: pair: Page TSconfig; Default values
.. _pagesettingdefaultpagetsconfig:

Setting the page TSconfig globally
==================================

Global page TSconfig should be stored within an extension, usually a sitepackage
extension. The content of the file :file:`Configuration/page.tsconfig` within
an extension is automatically loaded during build time.

It is possible to load other TSconfig files with the import syntax within this
file:

.. code-block:: typoscript
   :caption: EXT:my_sitepackage/Configuration/page.tsconfig

   @import 'EXT:my_sitepackage/Configuration/TsConfig/Page/Basic.tsconfig'
   @import 'EXT:my_sitepackage/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig'


Many page TSconfig settings can be set globally. This is useful for
installations that contain only one site and use only one sitepackage extension.

Extensions supplying custom default page TSconfig that should always be included,
can also set the page TSconfig globally.

The PSR-14 event :ref:`t3coreapi:BeforeLoadedPageTsConfigEvent` is available to
add global static page TSconfig before anything else is loaded.

.. _include-static-page-tsconfig-per-site:

Page TSconfig on site level
===========================

..  versionadded:: 13.1
    Page TSconfig can be included on a per site level.

Page TSconfig can be defined on a site level by placing a file called
:file:`page.tsconfig` in the storage directory of the site
(:ref:`config/sites/<identifier>/ <t3coreapi:site-storage>`).

Extensions and site packages can provide page TSconfig in
:ref:`site sets <t3coreapi:site-sets>` by placing a file called :file:`page.tsconfig`
into the folder of that set.

This way sites and sets can ship page TSconfig without the need for database
entries or by polluting global scope. Dependencies can be expressed via site sets,
allowing for automatic ordering and deduplication.

See also
:ref:`site sets as page TSconfig provider <t3coreapi:site-sets-page-tsconfig>`.

.. _include-static-page-tsconfig-per-site-example:

Example: load page TSconfig from the site set and the site
----------------------------------------------------------

Let us assume, you have a site set defined in your extension:

..  code-block:: yaml
    :caption: EXT:my_extension/Configuration/Sets/MySet/config.yaml

    name: my-vendor/my-set
    label: My Set

And use it in a site in your project:

..  code-block:: yaml
    :caption: config/sites/my-site/config.yaml

    base: 'http://example.com/'
    rootPageId: 1
    dependencies:
      - my-vendor/my-set

You can now put a file called :file:`page.tsconfig` in the same folder like your
site configuration and it will be automatically loaded for all pages in that
site.

..  code-block:: tsconfig
    :caption: config/sites/my-site/page.tsconfig

    # This tsconfig will be loaded for pages in site "my-site"
    # [...]

Or you can put the file :file:`page.tsconfig` in the same directory like the
site set you defined in your extension. It will then be loaded by all pages
of all sites that depend on this set:


..  code-block:: tsconfig
    :caption: EXT:my_extension/Configuration/Sets/MySet/page.tsconfig

    # This tsconfig will be loaded for pages in all sites that depend on set 'my-vendor/my-set'
    # [...]


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

#.  Go to the page properties of the page where you want to include the page TSconfig.
#.  Go to the tab :guilabel:`Resources`, then to
    :guilabel:`page TSconfig > Include static page TSconfig (from extensions)` and
    select the desired configurations from the :guilabel:`Available Items`.

.. _register-static-page-tsconfig:

Register static page TSconfig files
-----------------------------------

Register PageTS config files in the :file:`Configuration/TCA/Overrides/pages.php`
of any extension.

These can be :ref:`selected in the page properties <include-static-page-tsconfig>`.

..  literalinclude:: _PageTSconfig/_pages.php
    :language: php
    :caption: EXT:my_sitepackage/Configuration/TCA/Overrides/pages.php

It is not possible to use label reference <https://docs.typo3.org/permalink/t3coreapi:label-reference>`_
for the third parameter as the extension name will be automatically appended.

If you need to localize these labels, modify the TCA directly instead of using
the API function:

..  literalinclude:: _PageTSconfig/_pages_localized.php
    :language: php
    :caption: EXT:my_sitepackage/Configuration/TCA/Overrides/pages.php

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
:guilabel:`Page TSconfig` with in the :guilabel:`Sites` section.


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
:ref:`modify <t3tsref:typoscript-syntax-syntax-value-modification>` values
can also be used for the page TSconfig.

Example
=======

Default page TSconfig

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   RTE.default.proc.allowTagsOutside = hr

Static page TSconfig included on the parent page

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   RTE.default.proc.allowTagsOutside := addToList(blockquote)

Finally you get the value "hr,blockquote".
