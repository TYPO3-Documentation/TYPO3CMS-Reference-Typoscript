.. include:: /Includes.rst.txt

.. index::
   Page TSconfig; templates
   templates
.. _pagetemplates:


=========
templates
=========

.. versionadded:: 12.0

All Fluid templates rendered by backend controllers can be overridden with own
templates on a per-file basis. The feature is available for basically all core
backend modules, as well as the backend main frame templates. Exceptions are
email templates and templates of the install tool.

.. caution::

   While this feature is powerful and allows overriding nearly any backend
   template, **it should be used with care**: Fluid templates of the Core
   extensions are not considered API. The Core development needs the freedom to
   add, change and delete Fluid templates any time, even for bugfix releases.
   Template overrides are similar to an XCLASS in PHP - the Core can not
   guarantee integrity on this level across versions.


Basic syntax
============

The various combinations are best explained by example:

The linkvalidator extension (its composer name is `typo3/cms-linkvalidator`)
comes with a backend module in the :guilabel:`Web` main section. The page tree
is displayed for this module and linkvalidator has two main views and templates:

:file:`Resources/Private/Templates/Backend/Report.html` for the
:guilabel:`Report` view and another for the :guilabel:`Check link` view. To
override the :file:`Backend/Report.html` file with a custom template, this
definition can be added to the :file:`Configuration/page.tsconfig` file of an
extension:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   # Left pattern (before equal sign): templates."composer-name"."something-unique"
   # Right pattern (after equal sign): "overriding-extension-composer-name":"entry-path"
   templates.typo3/cms-linkvalidator {
      1643293191 = my-vendor/my-extension:Resources/Private/TemplateOverrides
   }

If the target extension, identified by its composer name
`my-vendor/my-extension`, provides the
:file:`Resources/Private/TemplateOverrides/Templates/Backend/Report.html` file,
this file is used instead of the default template file from the
linkvalidator extension.

All core extensions follow the general structure for templates, layouts and
partials file. If an extension needs to override a partial that
is located in :file:`Resources/Private/Partials/SomeName/SomePartial.html`, and
an override has been specified like above to
:file:`my-vendor/my-extension:Resources/Private/TemplateOverrides`, the system
looks for the
:file:`Resources/Private/TemplateOverrides/Partials/SomeName/SomePartial.html`
file. Similar is the case for layouts.

.. note::

   The path part of the override definition can be set the way an integrator
   prefers, :file:`Resources/Private/TemplateOverrides` is just an idea here and
   hopefully not a bad one, further details rely on additional needs. For
   instance, it is probably a good idea to include the composer or extension
   name of the source extension into the path (linkvalidator in our example) -
   or when using overrides based on page or group IDs, to include them in the
   path.

   The sub-path of the source extension is automatically added by the
   system when it is searching for override files. If a layout file is located
   at :file:`Resources/Private/Layouts/ExtraLarge/Main.html` and an override
   definition uses the :file:`Resources/Private/TemplateOverrides` path, the
   system will look up
   :file:`Resources/Private/TemplateOverrides/Layouts/ExtraLarge/Main.html`.

Template overriding is based on the existence of files: Two files are never
merged. An override definition either takes effect because it actually provides
a file at the correct position with the correct file name, or it does not and
the default is used. This can become impractical for large template files. In
such cases it might be an option to request a split of a large template file
into smaller partial files so an extension can override a specific partial only.

.. important::

   When multiple override paths are defined and more than one of them contains
   overrides for a specific template, the override definition with the highest
   numerical value wins:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/page.tsconfig

      templates.typo3/cms-linkvalidator {
         23 = other-vendor/other-extension:Resources/Private/TemplateOverrides/Linkvalidator
      }

   .. code-block:: typoscript
      :caption: EXT:another_extension/Configuration/page.tsconfig

      templates.typo3/cms-linkvalidator {
         2300 = my-vendor/my-extension:Resources/Private/MyOverrideIsBigger
      }


Combinations of overrides
=========================

Due to the nature of TsConfig and its two types PageTsConfig and UserTsConfig,
various combinations are possible:

* Define "global" overrides with PageTsConfig in
  :file:`Configuration/page.tsconfig` of an extension. This works for all
  modules, regardless of whether the module renders a page tree or not.

* Define page-level overrides via the :guilabel:`TSconfig` field of page
  records. As always with PageTsConfig, sub pages and sub trees inherit these
  settings from their parent pages.

* Define overrides on user or (better) group level. As always, UserTsConfig can
  override PageTsConfig by prefixing any setting available as PageTsConfig with
  :typoscript:`page.` in UserTsConfig. A UserTsConfig template override starts
  with :typoscript:`page.templates.` instead of :typoscript:`templates.`.


Usage in own modules
====================

Extensions with backend modules that use the simplified backend module template
API automatically enable the general backend template override feature.
Extension authors do not need to further prepare their extensions to enable
template overrides by other extensions.
