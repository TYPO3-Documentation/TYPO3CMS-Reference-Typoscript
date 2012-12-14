.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-load-register:

LOAD\_REGISTER
^^^^^^^^^^^^^^

This provides a way to load the array $GLOBALS['TSFE']->register[]
with values. It does not return anything! The usefulness of this is,
that some predefined configurations (like the page-content) can be
used in various places but use different values as the values of the
register can change during the page-rendering.

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
         *(array of field names)*

   Data type
         string /stdWrap

   Description
         **Example:**

         This sets "contentWidth", "label" and "head". ::

            page.27 = LOAD_REGISTER
            page.27 {
              contentWidth = 500

              label.field = header

              head = some text
              head.wrap = <b> | </b>
            }


.. ###### END~OF~TABLE ######

[tsref:(cObject).LOAD\_REGISTER]

