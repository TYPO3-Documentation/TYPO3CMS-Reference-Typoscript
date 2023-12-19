.. include:: /Includes.rst.txt
.. _appendix-a:

================================
Appendix A – PHP include scripts
================================

.. _appendix-include-scripts:

Including your script
=====================

This section should give you some pointers on what you can process in
your script and which functions and variables you can access.

Your script is included inside the class "ContentObjectRenderer" in the
:file:`typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php`
script. Thereby your file is a part of this object
(ContentObjectRenderer). This is why you must return all
content in the variable "$content" and any TypoScript configuration is
available from the array "$conf" (it may not be set at all though, so
check it with is\_array()!)


.. _appendix-include-content:

$content
--------

Contains the content, which was passed to the object, if any. All
content, which you want to return, must be in this variable!

Remember, don't output anything (but debug code) directly in your
script!


.. _appendix-include-conf:

$conf
-----

The array $conf contains the configuration for the USER cObject.
Try debug($conf) to see the content printed out for debugging!


.. _appendix-include-white-spaces:

White spaces
------------

Because nothing is sent off to the browser before everything is
rendered and returned to :php:`\TYPO3\CMS\Frontend\Http\RequestHandler`
(which originally set off the rendering process), you must ensure
that there's no whitespace before your :php:`<?php` tag
in your include or library scripts! You should not use the closing PHP tag
:php:`?>`.


.. _appendix-include-tsfe:

$GLOBALS['TSFE']->set\_no\_cache()
----------------------------------

Call the function :php:`$GLOBALS['TSFE']->set_no_cache()`, if you want to
disable caching of the page. Call this during development only! And
call it, if the content you create may not be cached.

**Note:** If you make a syntax error in your script that keeps PHP
from executing it, then the :php:`$GLOBALS['TSFE']->set_no_cache()`
function is not executed and the page *is* cached! So in these
situations, correct the error, clear the page-cache and try again.
This is true only for :typoscript:`USER` and not for :typoscript:`USER_INT`, which is
rendered *after* the cached page!


Example:
~~~~~~~~

.. code-block:: php

   $GLOBALS['TSFE']->set_no_cache();


.. _appendix-include-cobjgetsingle:

$this->cObjGetSingle(value, properties[, TSkey = '__'])
-------------------------------------------------------

Gets a content object from the $conf array. $TSkey is an optional string label used for the internal debugging tracking.


Example:
~~~~~~~~

.. code-block:: php

   $content = $this->cObjGetSingle($conf['image'], $conf['image.'], 'My Image 2');

This would return any IMAGE cObject at the property "image" of the
$conf array for the include script!


.. _appendix-include-stdwrap:

$this->stdWrap(value, properties)
---------------------------------

Hands the content in "value" to the stdWrap function, which will
process it according to the configuration of the array "properties".


Example:
~~~~~~~~

.. code-block:: php

   $content = $this->stdWrap($content, $conf['stdWrap.']);

This will stdWrap the content with the properties of ".stdWrap" of the
$conf array!


.. _appendix-include-internal-variables:

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

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Variable
         id

   PHP-Type
         integer

   Description
         The page id


.. container:: table-row

   Variable
         type

         .. versionchanged:: 13.0
            The property has been removed with TYPO3 v13.0.

   Migration
         When using this property in PHP code via :php:`$GLOBALS['TSFE']->type`,
         it is recommended to move to the
         :ref:`PSR-7 request <t3coreapi:typo3-request>` via
         :php:`$request->getAttribute('routing')->getPageType()`, which is the
         property of the :php:`PageArguments` object, as a result of the
         :php:`GET` parameter :php:`type`, or
         :php:`$GLOBALS['TSFE']->getPageArguments()->getPageType()`, if the
         request object is not available.


.. container:: table-row

   Variable
         page

   PHP-Type
         array

   Description
         The page record


.. _appendix-include-tsfe-feuser:

.. container:: table-row

   Variable
         fe\_user

         .. versionchanged:: 13.0
            The variable has been removed with TYPO3 v13.

   Migration
         There are two possible migrations.

         First, a limited information list of frontend user details can be
         retrieved using the :ref:`Context <t3coreapi:context-api>` aspect
         :php:`frontend.user` in frontend calls. See class
         :php:`\TYPO3\CMS\Core\Context\UserAspect` for a full list. The current
         context can be retrieved using
         :ref:`dependency injection <t3coreapi:DependencyInjection>`.
         Example:

         .. code-block:: php

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

         .. code-block:: php

            final class MyExtensionController extends ActionController {
                public function myAction() {
                    // Note the 'user' property is marked @internal.
                    $frontendUserUsername = $this->request
                        ->getAttribute('frontend.user')->user['username'];
                }
            }

.. container:: table-row

   Variable
         rootLine

   PHP-Type
         array

   Description
         The root line (all the way to tree root, not only the current site!).
         Current site root line is in
         :php:`\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController->config['rootLine']`.


.. container:: table-row

   Variable
         sys\_page

   PHP-Type
         object

   Description
         The object with page functions (object) See
         :file:`EXT:core/Classes/Domain/Repository/PageRepository.php`.


.. ###### END~OF~TABLE ######


.. _appendix-include-global-variables:

Global variables
================

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Variable
         BE\_USER

   PHP-Type
         object

   Description
         The backend user object (if any).

   Default
         not set


.. container:: table-row

   Variable
         TYPO3\_CONF\_VARS

   PHP-Type
         array

   Description
         TYPO3 Configuration.


.. container:: table-row

   Variable
         TSFE

   PHP-Type
         object

   Description
         Main frontend object. Whenever possible, use the
         :ref:`request <t3coreapi:typo3-request>` attribute
         :ref:`frontend.controller <t3coreapi:typo3-request-attribute-frontend-controller>`
         instead.


.. ###### END~OF~TABLE ######

