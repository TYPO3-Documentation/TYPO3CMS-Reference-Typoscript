.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


Top Level Objects
^^^^^^^^^^^^^^^^^

These are the User TSconfig Top Level Objects (TLOs):

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         admPanel

   Data type
         ->ADMPANEL

   Description
         Options regarding the front-end admin panel

   Default


.. container:: table-row

   Property
         options

   Data type
         ->OPTIONS

   Description
         Options for the user, various

   Default


.. container:: table-row

   Property
         mod

   Data type
         *(see ->MOD of Page TSconfig)*

   Description
         Overriding values for the backend modules

         **Deprecated.** Use page.mod instead!

   Default


.. container:: table-row

   Property
         setup.default

         setup.override

   Data type
         ->SETUP

   Description
         Default values and override values for the user settings known from
         the setup module.

         **Notice:**

         There is a tricky aspect to these settings; If first you have set a
         value by setup.override and then removes it again you will experience
         that the value persists to exist. This is because it is saved in the
         backend users profile. Therefore, if you have once set a value, do
         *not* remove it again by rather set it blank if you want to disable
         the effect again!

   Default


.. container:: table-row

   Property
         TCAdefaults.[tablename].[field]

   Data type
         string

   Description
         Sets default values for records. The order of default values when
         creating new records in the backend is this:

         1. Value from $TCA

         2. Value from User TSconfig (these settings)

         3. Value from Page TSconfig

         4. Value from "defVals" GET vars (see alt\_doc.php)

         5. Value from previous record based on 'useColumnsForDefaultValues'

         However the order for default values used by tcemain.php if a certain
         field is not granted access to for user will be:

         1. Value from $TCA

         2. Value from User TSconfig (these settings)

         So these values will be authoritative if the user has no access to the
         field anyway.

         **Example:**

         This sets the default hidden flag for pages to "clear" ::

            TCAdefaults.pages.hidden = 0

   Default


.. container:: table-row

   Property
         user

   Data type


   Description
         This is for custom purposes.

         Deprecated, use "tx\_\*" below from extensions

   Default


.. container:: table-row

   Property
         auth

   Data type


   Description
         Configuration for authentication services. Currently these are the
         options:

         **auth.BE.redirectToURL**

         Specifies a URL to redirect to after login is performed in the backend
         login form.

   Default


.. container:: table-row

   Property
         page

   Data type
         all page TSconfig properties

   Description
         You can override all page TSconfig properties by putting them into
         user TSconfig and prefixing them with page.

         **Example:** ::

            page.TCEMAIN.table.pages.disablePrependAtCopy = 1

   Default


.. container:: table-row

   Property
         tx\_[extension key with no underscore]

   Data type


   Description
         This is reserved space for extensions.

   Default


.. ###### END~OF~TABLE ######

[beuser]

