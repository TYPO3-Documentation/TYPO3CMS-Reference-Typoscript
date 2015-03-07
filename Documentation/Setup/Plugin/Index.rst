.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _plugin:

plugin
======

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

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ======================================= =============================== ====================== =======
   Property                                Data Type                       :ref:`stdwrap`         Default
   ======================================= =============================== ====================== =======
   `includeLibs`_                          (array of keys)
   `userFunc`_                             (array of keys)
   `\_CSS\_DEFAULT\_STYLE`_                string /:ref:`stdwrap`
   `\_CSS\_PAGE\_STYLE`_                   :ref:`data-type-string`
   `\_DEFAULT\_PI\_VARS.[piVar-key]`_      string /:ref:`stdwrap`
   `\_LOCAL\_LANG.[lang-key].[label-key]`_ :ref:`data-type-string`
   ======================================= =============================== ====================== =======

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###

.. _setup-plugin-includelibs:

includeLibs
"""""""""""

.. container:: table-row

   Property
         *includeLibs*

   Data type
         *(array of keys)*

   Description
         *Property setting up the USER / USER\_INT object of the plugin*.



.. _setup-plugin-userfunc:

userFunc
""""""""

.. container:: table-row

   Property
         *userFunc*

   Data type
         *(array of keys)*

   Description
         *Property setting up the USER / USER\_INT object of the plugin*.



.. _setup-plugin-css-default-style:

\_CSS\_DEFAULT\_STYLE
"""""""""""""""""""""

.. container:: table-row

   Property
         \_CSS\_DEFAULT\_STYLE

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Use this to have some default CSS styles inserted in the header
         section of the document. \_CSS\_DEFAULT\_STYLE outputs a set of
         default styles, just because an extension is installed. Most likely
         this will provide an acceptable default display from the plugin, but
         should ideally be cleared and moved to an external stylesheet.

         This value is for all plugins read by the PageGenerator script when
         making the header of the document.

         This is e.g. used by css_styled_content and indexed_search. Their
         default styles can be removed with::

            plugin.tx_cssstyledcontent._CSS_DEFAULT_STYLE >
            plugin.tx_indexedsearch._CSS_DEFAULT_STYLE >

         However, you will then have to define according styles yourself.



.. _setup-plugin-css-page-style:

\_CSS\_PAGE\_STYLE
""""""""""""""""""

.. container:: table-row

   Property
         \_CSS\_PAGE\_STYLE

   Data type
         string

   Description
         Use this to have some page-specific CSS styles inserted in the header
         section of the document. \_CSS\_PAGE\_STYLE can be used to render
         certain styles not just because an extension is installed, but only in
         a special situation, e.g. some styles will be output, when
         css_styled_content is installed **and** a textpic element with an
         image positioned alongside the text is present on the current page.
         Most likely this will provide an acceptable display from the plugin
         especially for this page, but should ideally be cleared and moved to
         an external stylesheet.

         This value is for all plugins read by the PageGenerator script when
         making the header of the document.



.. _setup-plugin-default-pi-vars-pivar-key:

\_DEFAULT\_PI\_VARS.[piVar-key]
"""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         \_DEFAULT\_PI\_VARS.[piVar-key]

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Allows you to set default values of the piVars array which most
         plugins are using (and should use) for data exchange with themselves.

         This works only if the plugin calls $this->pi\_setPiVarDefaults().

         The values have stdWrap, which also works recursively for multilevel
         keys.

         **Example:** ::

            plugin.tt_news._DEFAULT_PI_VARS {
              year.stdWrap.data = date:Y
            }

         This sets the key "year" to the current year.



.. _setup-plugin-local-lang-lang-key-label-key:

\_LOCAL\_LANG.[lang-key].[label-key]
""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         \_LOCAL\_LANG.[lang-key].[label-key]

   Data type
         string

   Description
         Can be used to override the default locallang labels for the plugin.

         **Example:** ::

            plugin.tx_myext_pi1._LOCAL_LANG.de.list_mode_1 = Der erste Modus

         All variables, which are used inside an extension with
         :code:`$this->pi_getLL('list_mode_1', 'Text, if no entry in locallang.xlf', true);`
         can that way be overwritten with TypoScript. The locallang.xlf file in
         the plugin folder in the file system can be used to get an overview of
         the entries the extension uses.

.. ###### END~OF~TABLE ######
