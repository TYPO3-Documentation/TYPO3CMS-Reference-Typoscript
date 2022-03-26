
.. index:: User TSconfig
.. _setting-page-tsconfig:

=============
User TSconfig
=============

It is recommended to always define custom User TSconfig in a project-specific
:doc:`sitepackage <t3sitepackage:Index>` extension. This way the User TSconfig
settings can be kept under version control.

.. index:: pair: User TSconfig; Enter data
.. _userthetsconfigfield:

Importing the User TSconfig into a backend user or group
========================================================

.. rst-class:: bignums

#. Open the record of the user or group. Go to
   :guilabel:`Options > TSconfig`.

   .. figure:: /Images/ManualScreenshots/BackendUsers/TSconfigUserInput.png
      :alt: The TSconfig field in the Options tab of a BE user

#. Enter the following TSconfig to import a configuration file from your
   sitepackage:

   .. code-block:: typoscript
      :caption: TsConfig added in the backend record of a backend user or group

      @import 'EXT:my_sitepackage/Configuration/TSconfig/User/my_editor.tsconfig'

This will make all settings from the file available for the user. The file
itself can be kept under version control together with your sitepackage.

TSconfig defined at user-level overrides TSconfig defined at group-level.

If a user is a member of several groups, the TSconfig from each
group is loaded. The order in which the groups are added to the user in field
:guilabel:`General > Grooup` is used.

The TSconfig from latter groups overrides the TSconfig from earlier groups if
both define the same property.

.. index:: pair: User TSconfig; Default values
.. _usersettingdefaultusertsconfig:

Setting default user TSconfig
=============================

User TSconfig is designed to be individual for users or groups of
users. However good default values can be defined and overridden by group or
user specific TSconfig.

In extensions this is easily done by the extension API function,
:php:`\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig()`.
In the :file:`ext_localconf.php` file of your extension you can call it
like this to set a default configuration.

.. code-block:: php
   :caption: my_sitepackage/ext_localconf.php

	/**
	 * Adding the default User TSconfig
	 */
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
      @import "EXT:my_sitepackage/Configuration/TSconfig/User/default.tsconfig"
	');

There is a global :ref:`TYPO3_CONF_VARS <t3coreapi:typo3ConfVars>` value called
:php:`$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] <t3coreapi:typo3ConfVars_be_defaultUserTSconfig>`.
The API function above adds content to that array. The array value itself
however should **not** be changed or set directly without using the API.


.. index:: pair: User TSconfig; Verify configuration
.. _userverifyingthefinalconfiguration:

Verify the final configuration
==============================

The full User TSconfig of the currently logged-in backend user can be viewed
using the :guilabel:`System > Configuration` module and choosing the
action :guilabel:`$GLOBALS['BE_USER']->getTSConfig() (User TSconfig)`. However
this module can only be accessed by admins.

.. figure:: /Images/ManualScreenshots/Configuration/UserTSconfigOverview.png
    :alt: Viewing User TSconfig using the Configuration module


.. index:: pair: User TSconfig; Override values
.. _user-override-modify-values:

Override and modify values
===========================

Properties, which are set in the TSconfig field of a group, are valid
for all users of that group.

Values which are set in one group can be overridden and
:ref:`modified <t3coreapi:typoscript-syntax-syntax-value-modification>` in the same or
another group. If a user is a member of multiple groups, the TSconfig
settings are evaluated in *the* order, in which the groups are included
in the user account: When you are editing the backend user, the
selected groups are evaluated from top to bottom.

**Example:**

* Add in User TSconfig

.. code-block:: typoscript

	page.RTE.default.showButtons = bold

* You get the value "bold".

* Add later in User TSconfig

.. code-block:: typoscript

	page.RTE.default.showButtons := addToList(italic)

* You get the value "bold,italic".

Finally you can override or
:ref:`modify <t3coreapi:typoscript-syntax-syntax-value-modification>`
settings from groups, of which your user is a member, in the User TSconfig
field of that specific user.

**Example:**

Let's say the user is a member of a *usergroup* with this
configuration

.. code-block:: typoscript

	TCAdefaults.tt_content {
		hidden = 1
		header = Hello!
	}

Then we set the following values in the TSconfig field of the specific *user*.

.. code-block:: typoscript

	TCAdefaults.tt_content.header = 234
	options.clearCache.all = 1

This would override the default value of the header ("234") and add the
clear cache option. The default value of the hidden field is not
changed and simply inherited directly from the group.


.. index:: User TSconfig; Override page TSconfig
.. _userrelationshiptovaluessetinpagetsconfig:
.. _pageoverridingpagetsconfigwithusertsconfig:

Overriding Page TSconfig in User TSconfig
=========================================

All properties from Page TSconfig can be **overridden** in User TSconfig by
prepending the property name with `page.`.

When a Page TSconfig property is set in **User** TSconfig that way, regardless
of whether it is in the TSconfig field of a
group or a user, it **overrides** the value of the according **Page** TSconfig property.

To illustrate this feature let's say the action
:guilabel:`Web > Info > Localization Overview` has been disabled via Page
TSconfig:

.. code-block:: typoscript

   mod.web_info.menu.function {
      TYPO3\CMS\Info\Controller\TranslationStatusController = 0
   }

If we activate this configuration in the TSconfig of a certain backend user, that
user would still be able to select this menu item because the value of his User TSconfig
overrides the same value set in the Page TSconfig, just prefixed with `page.`:

.. code-block:: typoscript

   page.mod.web_info.menu.function {
      TYPO3\CMS\Info\Controller\TranslationStatusController = 1
   }

.. important::

   It is **not** possible to *reference* the value of a property from Page
   TSconfig and to *modify* this value in User TSconfig! If you set a property
   in User TSconfig, which already had been set in *Page* TSconfig, then the
   value from Page TSconfig will be overridden.

   The result of the example below is *not* the value "bold,italic",
   but the value "italic".

   .. code-block:: typoscript

     # Enable the "bold" button in Page TSconfig (!)
     RTE.default.showButtons = bold

   .. code-block:: typoscript

     # Try to additionally add the "italic" button in User TSconfig (!)
     page.RTE.default.showButtons := addToList(italic)
