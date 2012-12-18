.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _plugin:

The "plugin" TLO
^^^^^^^^^^^^^^^^

This is used for extensions in TYPO3 set up as frontend plugins.
Typically you can set configuration properties of the plugin here. Say
you have an extension with the key "myext" and it has a frontend
plugin named "tx\_myext\_pi1" then you would find the TypoScript
configuration at the position "plugin.tx\_myext\_pi1" in the object
tree!

Most plugins are USER or USER\_INT objects which means that they have
at least 1 or 2 reserved properties. Furthermore this table outlines
some other default properties. Generally system properties are
prefixed with an underscore:

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         *userFunc*

   Data type
         *(array of keys)*

   Description
         *Property setting up the USER / USER\_INT object of the plugin*.


.. container:: table-row

   Property
         *includeLibs*

   Data type
         *(array of keys)*

   Description
         *Property setting up the USER / USER\_INT object of the plugin*.


.. container:: table-row

   Property
         \_CSS\_DEFAULT\_STYLE

   Data type
         string

   Description
         Use this to have some default CSS styles inserted in the header
         section of the document. Most likely this will provide a default
         acceptable display from the plugin, but should ideally be cleared and
         moved to an external stylesheet.

         This value is for all plugins read by the pagegen script when making
         the header of the document.


.. container:: table-row

   Property
         \_DEFAULT\_PI\_VARS.[piVar-key]

   Data type
         string

   Description
         Allows you to set default values of the piVars array which most
         plugins are using (and should use) for data exchange with themselves.

         This works only if the plugin calls $this->pi\_setPiVarDefaults().


.. container:: table-row

   Property
         \_LOCAL\_LANG.[lang-key].[label-key]

   Data type
         string

   Description
         Can be used to override the default locallang labels for the plugin.


.. ###### END~OF~TABLE ######

[tsref:plugin]

