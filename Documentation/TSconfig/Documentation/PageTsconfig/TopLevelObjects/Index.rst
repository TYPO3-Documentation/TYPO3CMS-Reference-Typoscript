

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Top Level Objects
^^^^^^^^^^^^^^^^^

These are the Page TSconfig Top Level Objects (TLOs):

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
         mod
   
   Data type
         ->MOD
   
   Description
         Options for the backend modules.
         
         *Notice that these options are merged with settings from User TSconfig
         (TLO: mod) which takes precedence.*
   
   Default


.. container:: table-row

   Property
         RTE
   
   Data type
         ->RTE
   
   Description
         This defines configuration for the Rich Text Editor.
         
         Please refer to the document "TYPO3 Core API" which you find in the
         section `Core Documentation on typo3.org
         <http://typo3.org/documentation/document-library/core-
         documentation/>`_ . There the chapter "RTE API" contains more
         information.
   
   Default


.. container:: table-row

   Property
         TCEMAIN
   
   Data type
         ->TCEMAIN
   
   Description
         Configuration for the TYPO3 Core Engine (TCEmain)
   
   Default


.. container:: table-row

   Property
         TCEFORM
   
   Data type
         ->TCEFORM
   
   Description
         Extra configuration for the form fields rendered by the TCEforms-class
         in general.
   
   Default


.. container:: table-row

   Property
         TSFE
   
   Data type
         ->TSFE
   
   Description
         Options for the TSFE front end object.
   
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
         tx\_[extension key with no underscore]
   
   Data type
   
   
   Description
         This is reserved space for extensions.
   
   Default


.. ###### END~OF~TABLE ######

[page]

