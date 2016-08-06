.. include:: ../../Includes.txt

.. _usertoplevelobjects:

Top Level Objects
^^^^^^^^^^^^^^^^^

These are the User TSconfig Top Level Objects (TLOs):

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         admPanel

   Data type
         ->ADMPANEL

   Description
         Options regarding the frontend admin panel.


.. container:: table-row

   Property
         options

   Data type
         ->OPTIONS

   Description
         Options for the user, various


.. container:: table-row

   Property
         mod

   Data type
         *(see ->MOD of Page TSconfig)*

   Description
         Overriding values for the backend modules

         **Deprecated.** Use page.mod instead!


.. container:: table-row

   Property
         setup.default

         setup.override

   Data type
         ->SETUP

   Description
         Default values and override values for the user settings known from
         the setup module.

         **Note:**

         There is a tricky aspect to these settings: If first you have set a
         value by setup.override and then remove it again, you will experience
         that the value persists to exist. This is because it is saved in the
         backend user's profile. Therefore, if you have once set a value, do
         *not* remove it again but rather set it blank if you want to disable
         the effect again!


.. container:: table-row

   Property
         TCAdefaults.[table name].[field]

   Data type
         string

   Description
         Sets default values for records. The order of default values when
         creating new records in the backend is this:

         1. Value from $GLOBALS['TCA']

         2. Value from User TSconfig (these settings)

         3. Value from Page TSconfig

         4. Value from "defVals" GET variables (see BackendUtility::getModuleUrl('record_edit'))

         5. Value from previous record based on 'useColumnsForDefaultValues'

         However the order for default values used by
         \TYPO3\CMS\Core\DataHandling\DataHandler if a certain
         field is not granted access to for user will be:

         1. Value from $GLOBALS['TCA']

         2. Value from User TSconfig (these settings)

         So these values will be authoritative if the user has no access to the
         field anyway.

         **Example:**

         This sets the default hidden flag for pages to "clear".

         .. code-block:: typoscript

         	TCAdefaults.pages.hidden = 0


.. container:: table-row

   Property
         user

   Data type
         *(whatever)*

   Description
         This is for custom purposes.

         Deprecated, use "tx\_\*" from extensions! See blow.


.. container:: table-row

   Property
         auth

   Data type
         array

   Description
         Configuration for authentication services. Currently this is the only
         option:

         **auth.BE.redirectToURL**

         Specifies a URL to redirect to after login is performed in the backend
         login form.


.. container:: table-row

   Property
         page

   Data type
         all page TSconfig properties

   Description
         You can override all page TSconfig properties by putting them into
         user TSconfig and prefixing them with page.

         **Example:**

         .. code-block:: typoscript

			page.TCEMAIN.table.pages.disablePrependAtCopy = 1


.. container:: table-row

   Property
         tx\_[extension key with no underscore]

   Data type
         *(whatever)*

   Description
         This is reserved space for extensions.


.. ###### END~OF~TABLE ######

[beuser]