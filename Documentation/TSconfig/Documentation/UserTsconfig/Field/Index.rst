.. include:: ../../Includes.txt

.. _userthetsconfigfield:

The "TSconfig" field
^^^^^^^^^^^^^^^^^^^^

This is how the TSconfig for users is entered in the backend user
records:

.. figure:: ../../Images/manual_html_m2a166eee.png
   :alt: The TSconfig inside the backend user or backend group properties


.. _useroverwritingandmodifyingvalues:

Overwriting and modifying values
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Properties, which are set in the TSconfig field of a group, are valid
for all users of that group.

Values, which are set in one group, can be overwritten and
:ref:`modified <t3tssyntax:syntax-value-modification>` in the same or
another group. If a user is member of multiple groups, the TSconfig
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

Finally you can overwrite or :ref:`modify
<t3tssyntax:syntax-value-modification>` settings from groups, of which your
user is a member, in the User TSconfig field of that user himself.

**Example:**

Let's say the user is a member of a *usergroup* with this
configuration

.. code-block:: typoscript

	TCAdefaults.tt_content {
		hidden = 1
		header = Hello!
	}

Then we set the following values in the TSconfig field of the *user*
himself

.. code-block:: typoscript

	TCAdefaults.tt_content.header = 234
	options.clearCache.all = 1

This would override the default value of the header ("234") and add the
clear cache option. The default value of the hidden field is not
changed and simply inherited directly from the group.


.. _userrelationshiptovaluessetinpagetsconfig:

Relationship to values set in Page TSconfig
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

All properties from Page TSconfig can be **overwritten** in User
TSconfig (by prepending the property name with "page."). When a Page
TSconfig property is set in **User** TSconfig that way (no matter, if
in the TSconfig field of a group or a user), it **overwrites** the
value of the according **Page** TSconfig property.

.. important::

   It is **not** possible to *reference* the value of a property from Page
   TSconfig and to *modify* this value in User TSconfig!
   If you set a property in User TSconfig, which already had been set in
   *Page* TSconfig, then the value from Page TSconfig will be overwritten.

**Example:**

* Add in **Page TSconfig**

.. code-block:: typoscript

	RTE.default.showButtons = bold

* Add in User TSconfig

.. code-block:: typoscript

	page.RTE.default.showButtons := addToList(italic)

* Finally you do *not* get the value "bold,italic", but the value "italic".


.. _userverifyingthefinalconfiguration:

Verifying the final configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

It's vital to check the resulting configuration of the users. You can
do that in the Tools > User Admin module (which is provided by the
extension "beuser") by clicking a username. Then you'll see the
TSconfig tree among other information. Here is an example:

.. figure:: ../../Images/manual_html_464ee54.png
   :alt: Comparing backend user or backend group settings with the User Admin module


.. _usersettingdefaultusertsconfig:

Setting default User TSconfig
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

User TSconfig is designed to be individual for users or groups of
users. However it can be very handy to set global values that will be
initialized for all users.

In extensions this is easily done by the extension API function,
:code:`\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig()`.
In the :file:`ext_localconf.php` file of your extension you can call use that
to set a default configuration.

.. code-block:: php

	/**
	 * Adding the admin panel to users by default and forcing the display of the edit-icons
	 */
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
		admPanel {
			enable.edit = 1
			module.edit.forceNoPopup = 1
			module.edit.forceDisplayFieldIcons = 1
			module.edit.forceDisplayIcons = 0
			hide = 1
		}
		options.enableBookmarks = 1
	');

This API function simply adds the content to
:code:`$TYPO3_CONF_VARS['BE']['defaultUserTSconfig']`.
