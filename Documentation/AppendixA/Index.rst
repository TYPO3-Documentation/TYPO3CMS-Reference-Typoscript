..  include:: /Includes.rst.txt
..  _appendix-a:

================================
Appendix A – PHP include scripts
================================

..  _content-object-renderer:

ContentObjectRenderer
=====================

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
..  _TypoScript-Frontend-Controller:

TypoScriptFrontendController, TSFE
==================================

You can retrieve the :php:`\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController`
via the :ref:`request <t3coreapi:typo3-request>` attribute
:ref:`frontend.controller <t3coreapi:typo3-request-attribute-frontend-controller>`.

For instance, if you want to access the variable :php:`id`, you can do so by
writing: :php:`TypoScriptFrontendController->id`.

..  _appendix-include-tsfe-id:

TypoScriptFrontendController->id
--------------------------------

..  versionchanged:: 13.0
    The property has been marked as read-only. Use
    :php:`$request->getAttribute('frontend.page.information')->getId()`
    instead. See :ref:`t3coreapi:typo3-request-attribute-frontend-page-information`.

..  confval:: id
    :name: tsfe-id
    :type: integer

    The current page id

..  _appendix-include-tsfe-type:

TypoScriptFrontendController->type
----------------------------------

..  versionchanged:: 13.0
    The property has been removed with TYPO3 v13.0. See
    :ref:`Migration <appendix-include-tsfe-type-migration>`

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

..  versionchanged:: 13.0
    The property has been marked as read-only. Use
    :php:`$request->getAttribute('frontend.page.information')->getPageRecord()`
    instead. See :ref:`t3coreapi:typo3-request-attribute-frontend-page-information`.

..  confval:: page
    :name: tsfe-page
    :type: array

    The page record


..  _appendix-include-tsfe-feuser:

TypoScriptFrontendController->feuser
------------------------------------

..  versionchanged:: 13.0
    The variable has been removed with TYPO3 v13. See
    :ref:`Migration <appendix-include-tsfe-feuser-migration>`

..  confval:: fe_user
    :name: tsfe-fe-user
    :type: array

    The frontend user record

..  _appendix-include-tsfe-feuser-migration:

Migration: Use UserAspect or context instead of `$GLOBALS['TSFE']->fe_user`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

There are two possible migrations.

First, a limited information list of frontend user details can be
retrieved using the :ref:`Context <t3coreapi:context-api>` aspect
:php:`frontend.user` in frontend calls. See class
:php:`\TYPO3\CMS\Core\Context\UserAspect` for a full list. The current
context can be retrieved using
:ref:`dependency injection <t3coreapi:DependencyInjection>`.
Example:

..  code-block:: php

    use TYPO3\CMS\Core\Context\Context;

    final class MyExtensionController {
        public function __construct(
            private readonly Context $context,
        ) {}

        public function myAction() {
            $frontendUserUsername = $this->context->getPropertyFromAspect(
                'frontend.user',
                'username',
                ''
            );
        }
    }

Additionally, the full :php:`\TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication`
object is available as :ref:`request <t3coreapi:typo3-request>` attribute
:ref:`frontend.user <t3coreapi:typo3-request-attribute-frontend-user>`
in the frontend. Note some details of that object are marked
:php:`@internal`, using the context aspect is thus the preferred way.
Example of an extension using the Extbase's :php:`ActionController`:

..  code-block:: php

    final class MyExtensionController extends ActionController {
        public function myAction() {
            // Note the 'user' property is marked @internal.
            $frontendUserUsername = $this->request
            ->getAttribute('frontend.user')->user['username'];
        }
    }


..  _appendix-include-tsfe-rootLine:

TypoScriptFrontendController->rootLine
--------------------------------------

..  versionchanged:: 13.0
    The property has been marked as read-only. Use
    :php:`$request->getAttribute('frontend.page.information')->getRootLine()`
    instead. See :ref:`t3coreapi:typo3-request-attribute-frontend-page-information`.

..  confval:: rootLine
    :name: tsfe-rootLine
    :type: array

    The root line (all the way to tree root, not only the current site!).

    The current site root line is available via
    :php:`$request->getAttribute('frontend.page.information')->getLocalRootLine()`.
    See :ref:`t3coreapi:typo3-request-attribute-frontend-page-information`.

    In TYPO3 versions before v13 the current site root line was only available
    via :php:`\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController->config['rootLine']`.

..  _appendix-include-tsfe-table-row:

TypoScriptFrontendController->table-row
---------------------------------------

..  versionchanged:: 13.0
    The property has been marked as read-only. Avoid usages altogether,
    create own instances of the
    :php:`\TYPO3\CMS\Core\Domain\Repository\PageRepository` when needed.

..  confval:: rootLine
    :name: tsfe-table-row
    :type: object

    The object with page functions (object) See
    :file:`EXT:core/Classes/Domain/Repository/PageRepository.php`.
