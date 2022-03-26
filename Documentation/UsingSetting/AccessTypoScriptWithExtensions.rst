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

In Extbase controllers, :ref:`Flexform settings <t3coreapi:read-flexforms-extbase>` and TypoScript settings will be
merged together. If settings exists in both, the Flexform takes precedence and overrides the TypoScript setting.
Note that both Flexform and TypoScript settings must use the convention of preceding the setting with
`settings.` (e.g. `settings.threshold`).

Extbase offers some advantages: Some things work automatically out-of-the-box. However, you must stick to the
Extbase conventions ("conventions over configuration").

In order to access TypoScript settings from an Extbase Controller.

.. rst-class:: bignums-xxl

#. Use the convention of defining your TypoScript settings in :typoscript:`settings`

   .. code-block:: ts

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

   * :ref:`settings in Extbase extensions <t3extbasebook:configuration>`
   * :ref:`Extbase TypoScript reference <t3extbasebook:typoscript_configuration>`

Fluid
=====

If Extbase controllers are used, :php:`$this->settings` is automatically passed to the Fluid template. Allowing you to
access settings like this:

.. code-block:: xml

   {settings.key1}
