.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _fe-table:

fe\_table
=========

**Note:** These options were deprecated since TYPO3 4.6 and have
been removed in TYPO3 6.0.

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ======================= ================================= ====================== ======================
   Property                Data Type                         :ref:`stdwrap`         Default
   ======================= ================================= ====================== ======================
   `allowEdit.[field]`_    :ref:`data-type-string`
   `allowNew.[field]`_     :ref:`data-type-string`
   `autoInsertPID`_        :ref:`data-type-boolean`
   `default.[field]`_      :ref:`data-type-string`
   `doublePostCheck`_      string (field name)
   `overrideEdit.[field]`_ :ref:`data-type-string`
   `processScript`_        :ref:`data-type-resource`
   `separator`_            :ref:`data-type-string`                                  chr(10) *(line break)*
   `userIdColumn`_         string (field)
   ======================= ================================= ====================== ======================

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###

.. _setup-fe-table-allowedit-field:

allowEdit.[field]
"""""""""""""""""

.. container:: table-row

   Property
         allowEdit.[field]

   Data type
         string

   Description
         Same as above ("allowNew") but this controls which fields that may be
         written in case of an update of a record (and not a new submission)

         Please pay attention to the property below! ("overrideEdit")



.. _setup-fe-table-allownew-field:

allowNew.[field]
""""""""""""""""

.. container:: table-row

   Property
         allowNew.[field]

   Data type
         string

   Description
         This property is in charge of which fields that may be written from
         the frontend.

         **Example:**

         This defines that subject is a field, that may be submitted from the
         frontend. If a value is not submitted, subject is filled with the
         default value (see above).

         The field "hidden" on the other hand cannot be changed from the
         frontend. "hidden" will gain the value from the default definition
         (see above). If fields are set to "0" (zero) it's the same as if they
         were not defined in this array. ::

            allowNew {
              subject = 1
              hidden = 0
            }



.. _setup-fe-table-autoinsertpid:

autoInsertPID
"""""""""""""

.. container:: table-row

   Property
         autoInsertPID

   Data type
         boolean

   Description
         Works with new records: Insert automatically the PID of the page,
         where the submitted data is sent to. Any "pid" supplied from the
         submitted data will override. This is for convenience.



.. _setup-fe-table-default-field:

default.[field]
"""""""""""""""

.. container:: table-row

   Property
         default.[field]

   Data type
         string

   Description
         This property is in charge of which default-values is used for the
         table:

         **Example:**

         This defines the default values used for new records. These values
         will be overridden with any value submitted instead (as long as the
         submitted fields are allowed due to "allowNew") ::

            default {
              subject = This is the default subject value!
              hidden = 1
              parent = 0
            }



.. _setup-fe-table-doublepostcheck:

doublePostCheck
"""""""""""""""

.. container:: table-row

   Property
         doublePostCheck

   Data type
         string (field name)

   Description
         Specifies a field name (integer) into which an integer-hash compiled
         of the submitted data is inserted. If the field is set, then
         submissions are checked whether another record with this value already
         exists. If so, the record is **not** inserted, because it's expected to
         be a "double post" (posting the same data more than once).



.. _setup-fe-table-overrideedit-field:

overrideEdit.[field]
""""""""""""""""""""

.. container:: table-row

   Property
         overrideEdit.[field]

   Data type
         string

   Description
         This works like default-values above but is values inserted after the
         submitted values have been processed. This means that opposite to
         default-values overwritten by the submitted values, these values
         override the submitted values.

         **Example:**

         In this case overrideEdit secures that if a user updates his record
         (if he "own" it) the "hidden"-field will be set no matter what. ::

            overrideEdit {
              hidden = 1
            }



.. _setup-fe-table-processscript:

processScript
"""""""""""""

.. container:: table-row

   Property
         processScript

   Data type
         resource

   Description
         Include-script to be used for processing of incoming data to the
         table. The script is included from a function in the class
         tslib\_feTCE.

         This is a really important option, because whether or not you are
         going to utilize the "cleaning"/"authorization" features of the
         properties above depends on how you write your script to process
         data and put it in the database.

         A very good example is to look at "pi/guest\_submit.php",
         included in the extension "tt\_guest" (used for a guestbook feature)



.. _setup-fe-table-separator:

separator
"""""""""

.. container:: table-row

   Property
         separator

   Data type
         string

   Description
         Separator character used when the submitted data is an array from e.g.
         a multiple selector box.

   Default
         chr(10) *(line break)*



.. _setup-fe-table-useridcolumn:

userIdColumn
""""""""""""

.. container:: table-row

   Property
         userIdColumn

   Data type
         string (field)

   Description
         This is a string that points to the column of a record where the user-
         id of the current fe\_user should be inserted. This fe\_user-uid is
         inserted/updated both by "new" and "edit"


.. ###### END~OF~TABLE ######

