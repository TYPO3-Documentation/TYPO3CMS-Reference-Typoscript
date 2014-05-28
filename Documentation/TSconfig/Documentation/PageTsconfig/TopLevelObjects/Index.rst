.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt

.. _pagetoplevelobjects:

Top-Level Objects
^^^^^^^^^^^^^^^^^

These are the Page TSconfig Top-Level Objects (TLOs):

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         mod

   Data type
         ->MOD

   Description
         Options for the backend modules.

         *Notice that these options are merged with settings from User TSconfig
         (TLO: mod) which takes precedence.*


.. container:: table-row

   Property
         RTE

   Data type
         ->RTE

   Description
         This defines configuration for the Rich Text Editor.

         Please refer to the :ref:`RTE Page Tsconfig chapter <t3api:transformations-tsconfig>`
         in Core APIs.


.. container:: table-row

   Property
         TCEMAIN

   Data type
         ->TCEMAIN

   Description
         Configuration for the TYPO3 Core Engine (TCEmain).


.. container:: table-row

   Property
         TCEFORM

   Data type
         ->TCEFORM

   Description
         Extra configuration for the form fields rendered by the TCEforms-class
         in general.


.. container:: table-row

   Property
         TSFE

   Data type
         ->TSFE

   Description
         Options for the TSFE frontend object.


.. container:: table-row

   Property
         user

   Data type
         *(whatever)*

   Description
         This is for custom purposes.

         Deprecated, use "tx\_\*" below from extensions


.. container:: table-row

   Property
         tx\_[extension key with no underscore]

   Data type
         *(whatever)*

   Description
         This is reserved space for extensions.


.. ###### END~OF~TABLE ######

[page]