.. include:: ../../Includes.txt


.. _cobj-load-register:

LOAD\_REGISTER
^^^^^^^^^^^^^^

This provides a way to load the array $GLOBALS['TSFE']->register[]
with values. It does not return anything! 

The register is working like a stack: With each call new content can be
put on top of the stack. :ref:`RESTORE_REGISTER <cobj-restore-register>`
can be used to remove the element at the topmost position again.

Registers are used at many different places, e.g. css_styled_content
uses registers to enumerate the classes of the headlines. The
usefulness of registers is that some predefined configurations (like
the page-content) can be used in various places but use different
values as the values of the register can change during page rendering.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         *(array of field names)*

   Data type
         string /:ref:`stdWrap <stdwrap>`

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


.. _cobj-load-register-examples:

Example:
""""""""

::

     1 = LOAD_REGISTER
     1.param.cObject = TEXT
     1.param.cObject.stdWrap.data = GP:the_id
     # To avoid SQL injections we use intval - so the parameter
     # will always be an integer.
     1.param.cObject.stdWrap.intval = 1

     10 = CONTENT
     10.table = tx_my_table
     10.select {
       pidInList = this
       orderBy = sorting
       # Now we use the registered parameter
       where = uid = {REGISTER:param}
       where.insertData = 1
     }
     10.renderObj = COA
     10.renderObj {
       10 = TEXT
       10.stdWrap.field = tx_my_text_field
     }

In this example we first load a special value, which is given as a
GET/POST parameter, into the register. Then we use a
:ref:`CONTENT object <cobj-content>` to render content based on this
value. This CONTENT object loads data from a table "tx_my_table" and looks up
the entry using the value from the register as a unique id. The field "tx_my_text_field" 
of this record will be rendered as output.

For an example in combination with :ref:`RESTORE_REGISTER <cobj-restore-register>`
see the :ref:`example on the page RESTORE_REGISTER <cobj-restore-register-examples>`.

