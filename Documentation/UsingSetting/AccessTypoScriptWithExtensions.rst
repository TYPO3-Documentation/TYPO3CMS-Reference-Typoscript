.. include:: /Includes.rst.txt
.. index:: TypoScript in extensions
.. _extdev-access-typoscript:

=================================
Access TypoScript in an extension
=================================

.. note::

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

.. rst-class:: bignums-xxl

#. Use the convention of defining your TypoScript settings in :typoscript:`settings`

   .. code-block:: typoscript
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

#. Access them via :php:`$this->settings`

   For example, in your controller:

   .. code-block:: php

      $myvalue1 = $this->settings['key1'] ?? 'default';

.. seealso::

   * :ref:`Extbase TypoScript configuration <t3coreapi:extbase_typoscript_configuration>`

Fluid
=====

If Extbase controllers are used, :php:`$this->settings` is automatically passed to the
:ref:`Fluid <t3coreapi:fluid>` template. Allowing you to access settings like this:

.. code-block:: xml

   {settings.key1}
