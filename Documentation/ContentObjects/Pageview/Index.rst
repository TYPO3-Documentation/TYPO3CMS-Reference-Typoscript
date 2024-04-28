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

..  contents:: Table of contents
    :local:
    :depth: 1

..  _cobj-pageview-properties-example:

Example: Display a page with Fluid templates
============================================

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page {
        10 = PAGEVIEW
        10 {
            paths {
                100 = EXT:my_sitepackage/Resources/Private/Templates/
            }
            variables {
                parentPageTitle = TEXT
                parentPageTitle.data = levelfield:-1:title
            }
            dataProcessing {
                10 = menu
                10.as = mainMenu
            }
        }
    }

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

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

    <f:layout name="Default" />
    <f:section name="Main">
        <main role="main">
            <p>The site title in the current template is: {language.websiteTitle}</p>
        </main>
    </f:section>

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

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

    <f:layout name="Default" />
    <f:section name="Main">
        <main role="main">
            <p>The title of the page with id {page.id} is: {page.pageRecord.title}. It has the
                following abstract:</p>
            <p>{page.pageRecord.abstract}</p>
        </main>
    </f:section>

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

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

    <f:layout name="Default" />
    <f:section name="Main">
        <main role="main">
            <p>Go to the root page: <f:link.page pageUid="{page.rootPageId}">Home</f:link.page></p>
            <p>...</p>
        </main>
    </f:section>

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

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page {
        10 = PAGEVIEW
        10 {
            paths {
                100 = EXT:my_sitepackage/Resources/Private/Templates/
            }
            dataProcessing {
                10 = menu
                10 {
                    as = mainMenu
                    titleField = nav_title // title
                    expandAll = 1
                }
                20 = menu
                20 {
                    as = breadcrumb
                    special = rootline
                    special.range = 0|-1
                    includeNotInMenu = 0
                }
            }
        }
    }

The page template could look like this:

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html

    <f:layout name="Default" />
    <f:section name="Main">
        <f:render partial="Navigation/MainNavigation.html" arguments="{mainMenu}"/>
        <main role="main">
            <f:render partial="Navigation/Breadcrumb.html" arguments="{breadcrumb}"/>
            <p>...</p>
        </main>
    </f:section>

With the following partials:

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Partials/Navigation/Breadcrumb.html

    <f:if condition="{breadcrumb}">
        <ol class="breadcrumb">
            <f:for each="{breadcrumb}" as="item">
                <li class="breadcrumb-item{f:if(condition: item.current, then: ' active')}" >
                    <a class="breadcrumb-link" href="{item.link}" title="{item.title}">
                        <span class="breadcrumb-text">{item.title}</span>
                    </a>
                </li>
            </f:for>
        </ol>
    </f:if>

And

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Partials/Navigation/MainNavigation.html

    <ul class="nav nav-pills">
        <f:for each="{mainMenu}" as="menuItem">
         <li class="nav-item {f:if(condition: menuItem.hasSubpages, then: 'dropdown')}">
            <f:if condition="{menuItem.hasSubpages}">
               <f:then>
                  <!-- Item has children -->
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                     {menuItem.title}
                  </a>
                  <div class="dropdown-menu">
                     <f:for each="{menuItem.children}" as="menuItemLevel2">
                          <f:link.page pageUid="{menuItemLevel2.data.uid}"
                                       class="dropdown-item {f:if(condition: menuItemLevel2.active, then: 'active')}">
                             {menuItemLevel2.title}
                          </f:link.page>
                     </f:for>
                  </div>
               </f:then>
               <f:else>
                  <!-- Item has no children -->
                  <f:link.page pageUid="{menuItem.data.uid}" class="nav-link {f:if(condition: menuItem.active, then:'active')}">
                     {menuItem.title}
                  </f:link.page>
               </f:else>
            </f:if>
         </li>
      </f:for>
   </ul>

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

You can use the paths

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

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page {
        10 = PAGEVIEW
        10 {
            paths {
                100 = EXT:my_sitepackage/Resources/Private/Templates/
            }
            variables {
                parentPageTitle = TEXT
                parentPageTitle.data = levelfield:-1:title
                another_variable <= lib.anotherVariable
            }
        }
    }

The following variables are now available in the Fluid template:

..  code-block:: html
    :caption: EXT:my_sitepackage/Resources/Private/Templates/Pages/Default.html


    <f:layout name="Default" />
    <f:section name="Main">
        <f:render partial="Navigation/MainNavigation.html" arguments="{_all}"/>

        <main role="main">
            <p>The current parent page has the title {parentPageTitle}</p>
            <p>Another variable is {another_variable}</p>
        </main>
    </f:section>
