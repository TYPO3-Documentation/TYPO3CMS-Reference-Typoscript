..  include:: /Includes.rst.txt
..  _typoscript-site-sets:

======================================
TypoScript provider for sites and sets
======================================

..  versionadded:: 13.1
    TYPO3 sites have been enhanced to be able to operate as a TypoScript template
    provider.

By design, a site TypoScript provider always defines a new scope
(root-flag) and does not inherit from parent sites (for example, sites up in the
root line). This behavior is not configurable by design, as TypoScript code sharing
is intended to be implemented via :ref:`sharable sets <typoscript-site-sets-set>`.

Note that :ref:`sys_template <typoscript-syntax-typoscript-templates-structure>`
records will still be loaded, but they are optional,
and applied after the TypoScript provided by the site.

TypoScript dependencies can be included
via :ref:`set dependencies <t3coreapi:site-sets-usage>`. The TypoScript definitions
included via sets are automatically ordered and deduplicated.

..  contents::

..  _typoscript-site-sets-site:

Site as a TypoScript provider
=============================

The files :file:`setup.typoscript` and :file:`constants.typoscript` (placed next
to the site's :file:`config.yaml` file) will be loaded as TypoScript setup and
constants, if available. See also :ref:`Site handling <t3coreapi:sitehandling>`.

Site dependencies (sets) will be loaded first, that means setup and constants
can be overridden on a per-site basis.

..  _typoscript-site-sets-site-example:

Example: A site that depends on a sitepackage
---------------------------------------------

The following site configuration depends on a site set provided by
a sitepackage extension.

..  literalinclude:: _Sets/_mysite_config.yaml
    :language: yaml
    :caption: config/sites/my-site/config.yaml

You can place TypoScript constants or setup in files of that name in the same
folder like the site configuration:

..  code-block:: typoscript
    :caption: config/sites/my-site/setup.typoscript

    page.headerData {
        50 = TEXT
        50.value = <!-- This is only displayed in the header of site example.org -->
    }

Same goes for TypoScript constants:

..  code-block:: typoscript
    :caption: config/sites/my-site/constants.typoscript

    page.trackingCode = 123456

..  _typoscript-site-sets-set:

Set as a TypoScript provider
============================

Set-defined TypoScript can be shipped within a set. The files
:file:`setup.typoscript` and :file:`constants.typoscript` (placed next to the
:file:`config.yaml` file of the set) will be loaded, if available.
They are inserted into the TypoScript chain
of the :ref:`site TypoScript <typoscript-site-sets-site>` that will be defined
by a site that is using sets.

Set constants will always be overruled by
:ref:`site settings <t3coreapi:sitehandling-settings>`. Since site settings
always provide a default value, a TypoScript constant will always be overruled by a defined
setting. This can be used to provide backward compatibility with TYPO3 v12
in extensions, where constants shall be used in v12, while v13 will always
prefer defined site settings.

TypoScript dependencies dependencies to TypoScript in other extensions or
other sets are to be included via site sets.

Dependencies are included recursively.
Sets are automatically ordered and deduplicated. That means TypoScript will not
be loaded multiple times, if a shared dependency is required by multiple sets.

..  note::
    `@import` statements can still be used for local includes, but
    should be avoided for cross-set/extensions dependencies.

..  _typoscript-site-sets-set-example:

Example: The set of a sitepackage
---------------------------------

The following set of a sitepackage depends on the TypoScript and other settings
of :t3ext:`fluid_styled_content` and :t3ext:`felogin`:

..  literalinclude:: _Sets/_MySitepackage_config.yaml
    :language: yaml
    :caption: EXT:my_sitepackage/Configuration/Sets/MySitepackage/config.yaml

The set can be included as a dependency by other sets or a
:ref:`site configuration <typoscript-site-sets-site-example>`.

The set can include further TypoScript constants or setup. It can use
:typoscript:`@import` statements to import TypoScript from another location:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/MySitepackage/constants.typoscript

    @import 'EXT:my_sitepackage/Configuration/TypoScript/Constants'

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/MySitepackage/setup.typoscript

    @import 'EXT:my_sitepackage/Configuration/TypoScript/Setup'

Importing TypoScript already contained in other sets should be avoided in
favour of using a :ref:`set dependency <t3coreapi:site-sets-definition>`.
