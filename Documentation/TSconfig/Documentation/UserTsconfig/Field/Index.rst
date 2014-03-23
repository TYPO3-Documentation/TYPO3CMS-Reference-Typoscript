.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

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

   :ts:`page.RTE.default.showButtons = bold`

* You get the value "bold".

* Add later in User TSconfig

   :ts:`page.RTE.default.showButtons := addToList(italic)`

* You get the value "bold,italic".

Finally you can overwrite or :ref:`modify
<t3tssyntax:syntax-value-modification>` settings from groups, of which your
user is a member, in the User TSconfig field of that user himself.

**Example:**

Let's say the user is a member of a *usergroup* with this
configuration

   :ts:`TCAdefaults.tt_content {`
       :ts:`hidden = 1`

       :ts:`header = Hello!`
   :ts:`}`

Then we set the following values in the TSconfig field of the *user*
himself

   :ts:`TCAdefaults.tt_content.header = 234`

   :ts:`options.clearCache.all = 1`

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

.. IMPORTANT::
   It is **not** possible to *reference* the value of a property from Page
   TSconfig and to *modify* this value in User TSconfig!
   If you set a property in User TSconfig, which already had been set in
   *Page* TSconfig, then the value from Page TSconfig will be overwritten.

**Example:**

* Add in **Page TSconfig**

   :ts:`RTE.default.showButtons = bold`

* Add in User TSconfig

   :ts:`page.RTE.default.showButtons := addToList(italic)`

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
t3lib\_extMgm::addUserTSConfig(). In the (ext\_)localconf.php file you
can call it like this to set default configuration

   :ts:`/**`
      :ts:`* Adding the admin panel to users by default and forcing the display of the edit-icons`

      :ts:`*/`

      :ts:`t3lib_extMgm::addUserTSConfig('`

      :ts:`admPanel {`
          :ts:`enable.edit = 1`

          :ts:`module.edit.forceNoPopup = 1`

          :ts:`module.edit.forceDisplayFieldIcons = 1`

          :ts:`module.edit.forceDisplayIcons = 0`

          :ts:`hide = 1`
          :ts:`}`
   :ts:`options.enableBookmarks = 1`
   :ts:`');`

This API function simply adds the content to
$TYPO3\_CONF\_VARS['BE']['defaultUserTSconfig'].