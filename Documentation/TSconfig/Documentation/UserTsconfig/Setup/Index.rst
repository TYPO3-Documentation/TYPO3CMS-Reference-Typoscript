.. include:: ../../Includes.txt

.. _usersetup:

->SETUP
^^^^^^^

Default values and overriding values for the "User tools > User
settings" module.

.. note::

   The "User tools > User settings" module only represents a
   subset of the options from the table below.


.. figure::  ../../Images/UserSettings.png
   :alt: Default values and overriding values for the "User tools > User settings" module

Default values are set by 'setup.default' while overriding values are
set by 'setup.override'. Overriding values will be impossible for the
user to change himself and no matter what the current value is, the
overriding value will overrule it. The default values are used for new
users or if the setup is re-initialized.

.. note::

   If you have first set a value (by override e.g.) and then
   *remove* that value from being set, the value is **not** restored to
   the original default but is kept at the current value! Therefore
   setting a value and later removing that value would require the users
   preferences to be reset (you can do that from the Install Tool >
   Database Analyser > Reset user preferences) OR better, don't remove
   the value, just change the value of it! (e.g. to a blank string if you
   wish to "reset" the value).

This table shows the keys for both defaults and override values:


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         thumbnailsByDefault

   Data type
         boolean

   Description
         Show Thumbnails by default


.. container:: table-row

   Property
         emailMeAtLogin

   Data type
         boolean

   Description
         Notify me by email, when somebody logs in from my account


.. container:: table-row

   Property
         helpText

   Data type
         boolean

   Description
         Show help text when applicable


.. container:: table-row

   Property
         titleLen

   Data type
         positive integer

   Description
         Max. Title Length


.. container:: table-row

   Property
         edit\_RTE

   Data type
         boolean

   Description
         Enable Rich Text Editor


.. container:: table-row

   Property
         edit\_docModuleUpload

   Data type
         boolean

   Description
         File upload directly in Doc. module


.. container:: table-row

   Property
         lang

   Data type
         language-key

   Description
         One of the language-keys. For current options see
         typo3/sysext/core/Classes/Localization/Locales.php.
         E.g. "dk", "de", "es" etc.


.. container:: table-row

   Property
         copyLevels

   Data type
         positive integer

   Description
         Recursive Copy: Enter the number of page sub-levels to include, when a
         page is copied


.. container:: table-row

   Property
         recursiveDelete

   Data type
         boolean

   Description
         Recursive Delete(!): Allow ALL subpages to be deleted when deleting a
         page


.. container:: table-row

   Property
         neverHideAtCopy

   Data type
         boolean

   Description
         If set, then the hideAtCopy feature for records in TCE will not be
         used.


.. container:: table-row

   Property
         startModule

   Data type
         string

   Description
         Name of the module that is called when the user logs into the Backend


.. container:: table-row

   Property
         resizeTextareas

   Data type
         boolean

   Description
         This option makes textareas resizable. When moving towards the right
         or bottom border of the textarea, the mouse cursor changes to a resize
         cursor. This is active by default.

   Default
         1


.. container:: table-row

   Property
         resizeTextareas\_MaxHeight

   Data type
         positive integer

   Description
         Defines the maximal height of textarea (in pixels).

   Default
         600


.. container:: table-row

   Property
         resizeTextareas\_Flexible

   Data type
         boolean

   Description
         This option makes textareas flexible, which means that their height
         grows automatically while typing. Limit is the maximal height set.
         This is active by default.

   Default
         1


.. ###### END~OF~TABLE ######


[beuser:setup.default/setup.override]

Do not use any other properties than the ones listed in the table
above.

On top of being able to set default values or override them as
described above, it is also possible to hide fields in the module
"User tools > User Settings".

The table below describes the related option:


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         <field name>.disabled

   Data type
         boolean

   Description
         This setting hides the option with the name <field name> in the module
         User Settings.

         You can find the names of the fields in the Module "Configuration".
         Just browse through the "User Settings" array.

         **Example:**

         .. code-block:: typoscript

			setup.fields.emailMeAtLogin.disabled = 1

         With this example, we hide the "E-mail me when I login" checkbox.

         You can also combine setup.fields.<field name>.disabled and
         setup.override.<field name>.

         **Example:**

         .. code-block:: typoscript

			setup.fields.emailMeAtLogin.disabled = 1
			setup.override.emailMeAtLogin = 1

         Now the "Email me when I login" field is removed, but the user will
         still receive an email when he logs in.

   Default
         0


.. ###### END~OF~TABLE ######


[beuser:setup.fields]
