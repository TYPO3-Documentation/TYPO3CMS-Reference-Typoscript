..  include:: /Includes.rst.txt
..  index:: User TSconfig
..  _setting-user-tsconfig:

=====================
Setting user TSconfig
=====================

It is recommended to always define custom user TSconfig in a project-specific
:ref:`sitepackage <t3sitepackage:start>` extension. This way the user TSconfig
settings can be kept under version control.

.. contents::
   :local:

..  index:: pair: User TSconfig; Enter data
..  _userthetsconfigfield:

Importing the user TSconfig into a backend user or group
========================================================

..  rst-class:: bignums

#.  Open the record of the user or group. Go to
    :guilabel:`Options > TSconfig`.

    ..  figure:: /Images/ManualScreenshots/BackendUsers/TSconfigUserInput.png
        :alt: The TSconfig field in the Options tab of a backend user
        :class: with-shadow

        The :guilabel:`TSconfig` field in the :guilabel:`Options` tab of a backend user

#.  Enter the following TSconfig to import a configuration file from your
    sitepackage:

    ..  code-block:: typoscript
        :caption: TsConfig added in the backend record of a backend user or group

        @import 'EXT:my_sitepackage/Configuration/TsConfig/User/my_editor.tsconfig'

This will make all settings in the file available to the user. The file
itself can be kept under version control together with your sitepackage.

TSconfig defined at user level overrides TSconfig defined at group level.

If a user is a member of several groups, the TSconfig from each
group is loaded. The order in which the groups are added to the user in field
:guilabel:`General > Grooup` is used.

The TSconfig from latter groups overrides the TSconfig from earlier groups if
both define the same property.

..  index:: pair: User TSconfig; Default values
..  _usersettingdefaultusertsconfig:

Setting default user TSconfig
=============================

User TSconfig is designed to be individual for users or groups of
users. However, good defaults can be defined and overridden by group or
user-specific TSconfig.

In extensions, this is done using the Core API function,
:php:`\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig()`.
In the :file:`ext_localconf.php` file of your extension you can call it
like this to set a default configuration.

..  literalinclude:: _UserTSconfig/_ext_localconf.php
    :language: php
    :caption: EXT:my_sitepackage/ext_localconf.php

There is a global :ref:`TYPO3_CONF_VARS <t3coreapi:typo3ConfVars>` value called
:ref:`$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] <t3coreapi:typo3ConfVars_be_defaultUserTSconfig>`.
The API function above adds content to that array. However, the array value
itself should **not** be changed or set directly without using the API.


..  index:: pair: User TSconfig; Verify configuration
..  _userverifyingthefinalconfiguration:

Verify the final configuration
==============================

The full user TSconfig of the currently logged-in backend user can be viewed
using the :guilabel:`System > Configuration` backend module and choosing the
action :guilabel:`$GLOBALS['BE_USER']->getTSConfig() (User TSconfig)`. However
this module can only be accessed by admins.

..  figure:: /Images/ManualScreenshots/Configuration/UserTSconfigOverview.png
    :alt: Viewing user TSconfig using the Configuration module
    :class: with-shadow

    Viewing user TSconfig using the :guilabel:`Configuration` module

The :guilabel:`Configuration` module is available with installed
:doc:`lowlevel <ext_lowlevel:Index>` system extension.

..  index:: pair: User TSconfig; Override values
..  _user-override-modify-values:

Override and modify values
===========================

Properties, which are set in the TSconfig field of a group, are valid
for all users of that group.

Values set in one group can be overridden and
:ref:`modified <t3coreapi:typoscript-syntax-syntax-value-modification>` in the
same or another group. If a user is a member of multiple groups, the TSconfig
settings are evaluated in the order in which the groups are included in the
user account: When editing the backend user, the selected groups are evaluated
from top to bottom.

**Example:**

*   Add in user TSconfig

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        page.RTE.default.showButtons = bold

*   You get the value "bold".

*   Add later in user TSconfig

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        page.RTE.default.showButtons := addToList(italic)

*   You get the value "bold,italic".

Finally, you can override or
:ref:`modify <t3coreapi:typoscript-syntax-syntax-value-modification>` the
settings from groups that your user is a member of in the user TSconfig
field of that specific user.

**Example:**

Let's say the user is a member of a *usergroup* with this
configuration:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCAdefaults.tt_content {
        hidden = 1
        header = Hello!
    }

Then we set the following values in the TSconfig field of the specific *user*.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    page.TCAdefaults.tt_content.header = 234
    options.clearCache.all = 1

This would override the default value of the header ("234") and add the
clear cache option. The default value of the hidden field is not
changed and simply inherited directly from the group.


..  index:: User TSconfig; Override page TSconfig
..  _userrelationshiptovaluessetinpagetsconfig:
..  _pageoverridingpagetsconfigwithusertsconfig:

Overriding page TSconfig in user TSconfig
=========================================

All properties from page TSconfig can be **overridden** in user TSconfig by
prepending the property name with :typoscript:`page.`.

When a page TSconfig property is set in **user** TSconfig that way, regardless
of whether it is in the TSconfig field of a
group or a user, it **overrides** the value of the according **page** TSconfig property.

To illustrate this feature let's say new pages and copied pages are not hidden
by default:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    TCAdefaults.pages.hidden = 0
    TCEMAIN.table.pages.disableHideAtCopy = 1

If we activate the following configuration in the user TSconfig of a certain backend
user group, new and copied pages will be hidden for that group. The user TSconfig to
be used is the same, but prefixed with :tsconfig:`page.`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TSconfig/editors.tsconfig

    // Override the settings from the page TSconfig for the editors usergroup
    page {
        TCAdefaults.pages.hidden = 1
        TCEMAIN.table.pages.disableHideAtCopy = 0
    }

..  attention::

    It is **not** possible to *reference* the value of a property from page
    TSconfig and to *modify* this value in user TSconfig! If you set a property
    in user TSconfig, which already had been set in *page* TSconfig, then the
    value from page TSconfig will be overridden.

    The result of the example below is *not* the value "bold,italic",
    but the value "italic".

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/page.tsconfig

        # Enable the "bold" button in Page TSconfig (!)
        RTE.default.showButtons = bold

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/user.tsconfig

        # Try to additionally add the "italic" button in User TSconfig (!)
        page.RTE.default.showButtons := addToList(italic)
