:orphan:
..  include:: /Includes.rst.txt

======
web_ts
======

..  versionchanged:: 12.0
    The :guilabel:`Web > Template` module has been replaced by the
    :guilabel:`Web > TypoScript` module. The only option in this namespace
    has been removed.

..  contents::
    :local:

..  index::
    web_info.menu.function
    Module menu; Template
..  _pageblindingfunctionmenuoptions-webts:

menu.function
=============

..  versionchanged:: 12.0
    The TSconfig option :tsconfig:`mod.web_ts.menu.function` has been removed
    with TYPO3 v12.0. Use **user** TSconfig option
    :ref:`options.hideModules <useroptions-hideModules>` instead.

..  _pageblindingfunctionmenuoptions-webts-migration:

Migration from menu.function to options.hideModules
---------------------------------------------------

Migrate former usage of :tsconfig:`mod.web_ts.menu.function` in **page** TSconfig
to option :ref:`options.hideModules <useroptions-hideModules>`.

..  code-block:: typoscript
    :caption: **Page** TSconfig, for example EXT:my_extension/Configuration/page.tsconfig

    # before
    mod.web_ts.menu.function {
        TYPO3\CMS\Tstemplate\Controller\TemplateAnalyzerModuleFunctionController = 0
    }

..  code-block:: typoscript
    :caption: **User** TSconfig, for example EXT:my_extension/Configuration/user.tsconfig

    # after
    options.hideModules := addToList(web_typoscript_analyzer)

See also :ref:`setting-user-tsconfig`. You can find the names of all
TypoScript modules in :t3src:`tstemplate/Configuration/Backend/Modules.php`.
