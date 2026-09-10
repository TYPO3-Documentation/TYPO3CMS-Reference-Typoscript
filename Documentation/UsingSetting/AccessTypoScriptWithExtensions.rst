..  include:: /Includes.rst.txt
..  index:: TypoScript in extensions
..  _extdev-access-typoscript:

=================================
Access TypoScript in an extension
=================================

..  note::

    This part is written for extension developers.

This page explains how to access TypoScript settings in an extension.

Extbase controllers
===================

In :ref:`Extbase controllers <t3coreapi:extbase-action-controller>`,
:ref:`Flexform settings <t3coreapi:read-flexforms-extbase>` and TypoScript settings will be
merged together. If settings exists in both, the Flexform takes precedence and overrides the TypoScript setting.
Note that both Flexform and TypoScript settings must use the convention of preceding the setting with
:typoscript:`settings.` (for example, :typoscript:`settings.threshold`).

Extbase offers some advantages: Some things work automatically out-of-the-box. However, you must stick to the
Extbase conventions ("conventions over configuration").

In order to access TypoScript settings from an Extbase controller.

..  rst-class:: bignums-xxl

#.  Use the convention of defining your TypoScript settings in :typoscript:`settings`

    ..  code-block:: typoscript
        :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

        plugin.tx_myextension {
           view {
              # view settings
           }

           settings {
              key1 = value1
              key2 = value2
           }
        }

#.  Access them via :php:`$this->settings`

    For example, in your controller:

    ..  code-block:: php

        $myvalue1 = $this->settings['key1'] ?? 'default';

..  seealso::

    *   :ref:`Extbase TypoScript configuration <t3coreapi:extbase_typoscript_configuration>`

Fluid
=====

If Extbase controllers are used, :php:`$this->settings` is automatically passed to the
:ref:`Fluid <t3coreapi:fluid>` template. Allowing you to access settings like this:

..  code-block:: xml

    {settings.key1}

Without Extbase, a template rendered by the
:ref:`FLUIDTEMPLATE <cobj-fluidtemplate>` content object receives its
settings from the
:ref:`settings <cobj-fluidtemplate-properties-settings>` property of that
content object.

..  _extdev-access-typoscript-psr7-request:

Reading frontend TypoScript from the PSR-7 request
==================================================

Any class that can reach the
:ref:`PSR-7 request <t3coreapi:getting-typo3-request-object>` — a content
object, a middleware, an event listener — reads the parsed frontend
TypoScript from the
:ref:`frontend.typoscript
<t3coreapi:typo3-request-attribute-frontend-typoscript>` request
attribute:

..  code-block:: php
    :caption: EXT:my_extension/Classes/SomeClass.php

    $fullTypoScript = $request->getAttribute('frontend.typoscript')
        ->getSetupArray();

..  note::

    :php:`\TYPO3\CMS\Core\TypoScript\FrontendTypoScript::getSetupArray()`
    throws a :php-short:`\RuntimeException` when the frontend was fully
    served from the page cache, because the setup is not parsed in that
    case. Content objects are not affected: whenever they are calculated,
    the setup is available.

..  seealso::

    *   :ref:`Frontend TypoScript in the PHP API
        <t3coreapi:typoscript-access_frontend_typoscript>`

..  _extdev-access-page-tsconfig:

Reading page TSconfig
=====================

Page TSconfig is backend TypoScript and therefore not part of the frontend
request. It is read for a single page with
`BackendUtility::getPagesTSconfig()`, which returns the parsed TypoScript
as an array.

..  seealso::

    *   :ref:`Page TSconfig in the PHP API
        <t3coreapi:typoscript-access_page_tsconfig>`
