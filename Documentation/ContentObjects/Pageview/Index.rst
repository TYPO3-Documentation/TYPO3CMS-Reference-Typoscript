..  include:: /Includes.rst.txt
..  index:: Content objects; PAGEVIEW
..  _cobj-pageview:

========
PAGEVIEW
========

..  versionadded:: 13.1

    This API is considered experimental until TYPO3 v13 LTS. It will be further
    adapted to be used for further rendering of
    custom Content Elements and Content Blocks.

The content object :typoscript:`EXTBASEPLUGIN` allows to render
:ref:`Extbase <t3coreapi:extbase>` plugins.

The new :typoscript:`PAGEVIEW` content object has very specific conventions and
defaults, that requires (and allows) less configuration, with the benefit that
following these conventions means less boilerplate code to maintain.

If you follow these conventions, a few directories and files most follow the
structure outlined below.

..  contents:: Table of contents
    :local:
    :depth: 1

..  _cobj-pageview-properties-example:

Example: Display a page with Fluid templates
============================================

..  literalinclude:: _includes/_pageWithFluid.typoscript
    :language: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

.. _cobj-pageview-data:

Default variables in Fluid templates
====================================

..  contents::
    :local:

The following variables are available by default in the Fluid template.

Additional variables can be defined with property
:ref:`variables <cobj-pageview-variables>`.


.. _cobj-pageview-data-language:

language
--------

..  confval:: language
    :name: pageview-data-language
    :type: :php:`\TYPO3\CMS\Core\Site\Entity\SiteLanguage`

    The current :php:`SiteLanguage` object, see also
    :ref:`the SiteLanguage object <t3coreapi:sitehandling-sitelanguage-object>`.


.. _cobj-pageview-data-language-example:

Example: Display the site title in the current language
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  literalinclude:: _includes/_DisplaySiteTitle.html
    :language: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

.. _cobj-pageview-data-page:

page
----

..  confval:: page
    :name: pageview-data-page
    :type: :php:`TYPO3\CMS\Frontend\Page\PageInformation`

    The current `PageInformation` as object. See also
    :ref:`Frontend page information <t3coreapi:typo3-request-attribute-frontend-page-information>`.

.. _cobj-pageview-data-page-example:

Example: Display the title and abstract of the current page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  literalinclude:: _includes/_DisplayPageInfo.html
    :language: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

.. _cobj-pageview-data-settings:

settings
--------

..  confval:: settings
    :name: pageview-data-settings
    :type: array

    Contains all TypoScript settings (= Constants)

..  todo: How does this work?

.. _cobj-pageview-data-site:

site
----

..  confval:: site
    :name: pageview-data-site
    :type: :php:`\TYPO3\CMS\Core\Site\Entity\Site`

    The current :php:`Site` object. See also
    :ref:`the Site object <t3coreapi:sitehandling-site-object>`.

.. _cobj-pageview-data-site-example:

Example: Link to the root page of the current site
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  literalinclude:: _includes/_LinkToRootPage.html
    :language: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

..  _cobj-pageview-properties:

Properties
==========

..  contents::
    :local:

..  _cobj-pageview-cache:

cache
-----

..  confval:: cache
    :name: pageview-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.

..  _cobj-pageview-dataProcessing:

dataProcessing
--------------

..  confval:: dataProcessing.[key]
    :name: pageview-dataProcessing
    :type: :ref:`data-type-path` with :ref:`stdWrap <stdwrap>`

    Add one or multiple :ref:`data processors <dataProcessing>`. The
    sub-property :typoscript:`options` can be used to pass parameters to the
    processor class.

Example: Display a main menu and a breadcrumb on the page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  literalinclude:: _includes/_pageWithBreadcrumb.typoscript
    :language: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript


The page template could look like this:

..  literalinclude:: _includes/_PageWithBreadcrumb.html
    :language: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html


With the following partials:

..  literalinclude:: _includes/_PartialBreadCrumb.html
    :language: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Partials/Navigation/Breadcrumb.html

And

..  literalinclude:: _includes/_PartialMainNavigation.html
    :language: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Partials/Navigation/MainNavigation.html


..  _cobj-pageview-paths:

paths
-----

..  confval:: paths.[priority]
    :name: pageview-paths
    :type: :ref:`data-type-path` with :ref:`stdWrap <stdwrap>`

    Sets an array of paths for the Fluid templates, usually
    :file:`EXT:my_extension/Resources/Private/Templates/` or a folder below that
    path like :file:`EXT:my_extension/Resources/Private/Templates/MyPages`.

    The templates are expected in a subfolder :path:`Pages` or
    :path:`pages`.

    Fluid partials are looked up in a sub-directory called :path:`Partials` or
    :path:`partials`, layouts in :path:`Layouts` or :path:`layouts`.

    The name of the used page layout (:ref:`Backend layout <t3coreapi:be-layout>`)
    is resolved automatically.

    The paths are evaluated from highest to lowest priority.


..  _cobj-pageview-paths-example:

Example: Define a path that contains all templates
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This is a basic definition of a :fluid:`PAGEVIEW` object with only one path to the
templates:

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page.10 = PAGEVIEW
    page.10.paths.100 = EXT:my_sitepackage/Resources/Private/Templates/

The content of the folder could look like this:

*   EXT:my_sitepackage/Resources/Private/Templates/

    *   Layouts

        *   Default.html
        *   WithoutHeader.html

    *   Pages

        *   Default.html
        *   StartPage.html
        *   TwoColumns.html
        *   With_sidebar.html

    *   Partials

        *   Footer.html
        *   Sidebar.html
        *   Menu.html

If a page has a backend layout named "with_sidebar", the template file is
then resolved
to :file:`EXT:my_sitepackage/Resources/Private/Templates/Pages/With_sidebar.html`.

If the backend layout is named "TwoColumns" it is resovled to
:file:`EXT:my_sitepackage/Resources/Private/Templates/Pages/TwoColumns.html`.

For all these templates
:ref:`partials <t3viewhelper:render_partial>`
are expected in folder
:path:`EXT:my_sitepackage/Resources/Private/Templates/Pages/Partials` and
:ref:`layouts <t3viewhelper:typo3fluid-fluid-layout>` in
:path:`EXT:my_sitepackage/Resources/Private/Templates/Pages/Layouts`.

..  _cobj-pageview-paths-example-extended:

Example: Define fallbacks for a template paths
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can use the directories defined in :confval:`pageview-paths` to
define fallback directories for the templates:

.. code-block:: typoscript

    page = PAGE
    page {
        10 = PAGEVIEW
        10.paths {
            100 = EXT:my_basic_sitepackage/Resources/Private/Templates/
            200 = EXT:my_general_sitepackage/Resources/Private/Templates/
            300 = EXT:my_special_sitepackage/Resources/Private/Templates/
        }
    }

The template for a page with a certain backend layout is first searched in
:path:`EXT:my_special_sitepackage/Resources/Private/Templates/Pages/` then in
:path:`EXT:my_general_sitepackage/Resources/Private/Templates/Pages/` and last
in :path:`EXT:my_special_sitepackage/Resources/Private/Templates/Pages/`.

..  _cobj-pageview-variables:

variables
---------

..  confval:: variables.[variable_name]
    :name: pageview-variables
    :type: :ref:`Content Object <cobject>`

    Sets variables that should be available in Fluid.

Example: Make additional variables available in the Fluid template
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  literalinclude:: _includes/_pageWithVariables.typoscript
    :langugage: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

The following variables are now available in the Fluid template:

..  literalinclude:: _includes/_PageWithVariables.html
    :langugage: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

