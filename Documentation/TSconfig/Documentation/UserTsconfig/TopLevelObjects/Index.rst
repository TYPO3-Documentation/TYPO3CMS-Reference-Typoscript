.. include:: ../../Includes.txt

.. _usertoplevelobjects:

=================
Top Level Objects
=================

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
         setup.default

         setup.override

   Data type
         ->SETUP

   Description
         Default values and override values for the user settings known from
         the setup module.

         .. attention::

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

Example
   This sets the default hidden flag for pages to "clear".

   .. code-block:: typoscript

      TCAdefaults.pages.hidden = 0

   .. important::

      This example will not work when creating the page from the context menu
      since this is triggered by the values listed in the `ctrl` section of
      :file:`typo3/sysext/core/Configuration/TCA/pages.php`::

         'ctrl' => [
            'useColumnsForDefaultValues' => 'doktype,fe_group,hidden',

      If 'hidden' is in the list, it gets overwritten with the "neighbor"
      record value (see
      :php:`\TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::setDefaultsFromNeighborRow`)
      and as the value is set - usually to '0' - it will not be overwritten
      again. To make it work as expected, that value must be overridden. This
      can be done for example in the :file:`Configuration/TCA/Overrides` folder
      of an extension::

         $GLOBALS['TCA']['pages']['ctrl']['useColumnsForDefaultValues'] = 'doktype,fe_group';


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
