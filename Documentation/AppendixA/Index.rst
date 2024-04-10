..  include:: /Includes.rst.txt
..  _appendix-a:

================================
Appendix A – PHP include scripts
================================

..  _appendix-include-scripts:

Including your script
=====================

This section should give you some pointers on what you can process in
your script and which functions and variables you can access.

Your script is included inside the class
:php:`\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer` in the
:t3src:`frontend/Classes/ContentObject/ContentObjectRenderer.php`
script. Thereby your file is a part of this object
(:php:`ContentObjectRenderer`). This is why you must return all
content in the variable :php:`$content` and any TypoScript configuration is
available from the array :php:`$conf` (it may not be set at all though, so
check it with :php:`is_array()`)


..  _appendix-include-content:

$content
--------

Contains the content, which was passed to the object, if any. All
content, which you want to return, **must** be in this variable.

Do not output anything directly in your script.


..  _appendix-include-conf:

$conf
-----

The array :php:`$conf` contains the configuration for the USER cObject.
Try :php:`debug($conf)` to see the content printed out for debugging!


..  _appendix-include-white-spaces:

White spaces
------------

Because nothing is sent off to the browser before everything is
rendered and returned to :php:`\TYPO3\CMS\Frontend\Http\RequestHandler`
(which originally set off the rendering process), you must ensure
that there's no whitespace before your :php:`<?php` tag
in your include or library scripts! You should not use the closing PHP tag
:php:`?>`.


..  _appendix-include-tsfe:

$GLOBALS['TSFE']->set\_no\_cache()
----------------------------------

Call the function :php:`$GLOBALS['TSFE']->set_no_cache()`, if you want to
disable caching of the page. Call this during development only! And
call it, if the content you create may not be cached.

..  note::
    If you make a syntax error in your script that keeps PHP
    from executing it, then the :php:`$GLOBALS['TSFE']->set_no_cache()`
    function is not executed and the page *is* cached! So in these
    situations, correct the error, clear the page-cache and try again.
    This is true only for :typoscript:`USER` and not for :typoscript:`USER_INT`, which is
    rendered *after* the cached page!


Example:
~~~~~~~~

..  code-block:: php

    $GLOBALS['TSFE']->set_no_cache();


..  _appendix-include-cobjgetsingle:

`ContentObjectRenderer::cObjGetSingle(value, properties[, TSkey = '__'])`
-------------------------------------------------------------------------

A method of :php:`TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer`.
Gets a content object from the `$conf` array.

Example:
~~~~~~~~

..  code-block:: php

    $content = $cObjectRenderer->cObjGetSingle($conf['image'], $conf['image.'], 'My Image 2');

This would return any IMAGE cObject at the property `image` of the
`$conf` array for the include script!


..  _appendix-include-stdwrap:

`ContentObjectRenderer::stdWrap(value, properties)`
---------------------------------------------------

A method of :php:`TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer`.

Hands the content in "value" to the stdWrap function, which will
process it according to the configuration of the array "properties".


Example:
~~~~~~~~

..  code-block:: php

    $content = $cObjectRenderer->stdWrap($content, $conf['stdWrap.']);

This will stdWrap the content with the properties of `.stdWrap` of the
`$conf` array!


..  _appendix-include-internal-variables:

Internal variables in the main frontend object, TSFE
====================================================

There are some variables in the global object, TSFE (TypoScript
Frontend), you might need to know about. These ARE ALL READ-ONLY!
(Read: Do not change them!) See the class
:php:`\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController` for the
full descriptions.

You can retrieve the :php:`TypoScriptFrontendController` via the
:ref:`request <t3coreapi:typo3-request>` attribute
:ref:`frontend.controller <t3coreapi:typo3-request-attribute-frontend-controller>`.

For instance, if you want to access the variable :php:`id`, you can do so by
writing: :php:`TypoScriptFrontendController->id`.

..  _appendix-include-tsfe-id:

TypoScriptFrontendController->id
--------------------------------

..  confval:: id
    :name: tsfe-id
    :type: integer

    The current page id

..  _appendix-include-tsfe-type:

TypoScriptFrontendController->type
----------------------------------

..  versionchanged:: 12.4
    The property has been marked as deprecated and will be removed with
    v13.0.

..  confval:: type
    :name: tsfe-type
    :type: integer

..  _appendix-include-tsfe-type-migration:

Migration from `$GLOBALS['TSFE']->type`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

When using this property in PHP code via :php:`$GLOBALS['TSFE']->type`,
it is recommended to move to the
:ref:`PSR-7 request <t3coreapi:typo3-request>` via
:php:`$request->getAttribute('routing')->getPageType()`.

..  _appendix-include-tsfe-page:

TypoScriptFrontendController->page
----------------------------------

..  confval:: page
    :name: tsfe-page
    :type: array

    The page record


..  _appendix-include-tsfe-feuser:

TypoScriptFrontendController->feuser
------------------------------------

..  confval:: fe_user
    :name: tsfe-fe-user
    :type: array

    The frontend user record

    User record in :php:`$GLOBALS['TSFE']->fe_user->user`, if any login.
    Better use the :ref:`request <t3coreapi:typo3-request>` attribute
    :ref:`frontend.user <t3coreapi:typo3-request-attribute-frontend-user>` instead.


..  _appendix-include-tsfe-rootLine:

TypoScriptFrontendController->rootLine
--------------------------------------

..  confval:: rootLine
    :name: tsfe-rootLine
    :type: array

    The root line (all the way to tree root, not only the current site!).
    Current site root line is in
    :php:`\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController->config['rootLine']`.

..  _appendix-include-tsfe-table-row:

TypoScriptFrontendController->table-row
---------------------------------------

..  confval:: rootLine
    :name: tsfe-table-row
    :type: object

    The object with page functions (object) See
    :file:`EXT:core/Classes/Domain/Repository/PageRepository.php`.

..  _appendix-include-global-variables:

Global variables
================

..  _appendix-include-global-be-user:

`$GLOBAL['BE_USER']`
--------------------

..  confval:: $GLOBAL['BE_USER']
    :name: global-be-user
    :type: object

    The backend user object. See :ref:`Backend user object <t3coreapi:be-user>`
    for more information.


..  _appendix-include-global-typo3-conf-vars:

`$GLOBAL['TYPO3_CONF_VARS']`
----------------------------

..  confval:: $GLOBAL['TYPO3_CONF_VARS']
    :name: global-typo3-conf-vars
    :type: object

    TYPO3 configuration variables. See :ref:`TYPO3_CONF_VARS <t3coreapi:typo3ConfVars>`
    for more information.


..  _appendix-include-global-tsfe:

`$GLOBAL['TYPO3_CONF_VARS']`
----------------------------

..  confval:: $GLOBAL['TSFE']
    :name: global-tsfe
    :type: object

    Main frontend object. Whenever possible, use the
    :ref:`request <t3coreapi:typo3-request>` attribute
    :ref:`frontend.controller <t3coreapi:typo3-request-attribute-frontend-controller>`
    instead. See also :ref:`TSFE <t3coreapi:tsfe>`.
