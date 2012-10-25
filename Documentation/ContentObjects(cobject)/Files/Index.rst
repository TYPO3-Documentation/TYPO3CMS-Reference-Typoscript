.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


FILES
^^^^^

(Since TYPO3 6.0) This content object was integrated with the
File Abstraction Layer (FAL) and is there to output information
about files.


**Note** : Do not mix this up with the cObject FILE; both are
different cObjects.


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
         files

   Data type
         string /stdWrap

   Description
         Comma separated list of sys_file UIDs, which are loaded
         into the FILES object.

         **Example:**

         ::

            page.10 = FILES
            page.10.files = 12,15,16

   Default


.. container:: table-row

   Property
         references

   Data type
         array

   Description
         Provides a way to load files from a file field (of type
         IRRE with sys_file_reference as child table). You can either
         provide a UID or a comma separated list of UIDs from the
         database table sys_file_reference or you have to specify a
         table, uid and fieldname in the according subproperties of
         "references". See further documentation of these
         subproperties in the table below.

         **Examples:**

         ::

            references = 27,28

         This will get the items from the database table
         sys_file_reference with the UIDs 27 and 28.

         ::

            references {
              table = tt_content
              uid = 256
              fieldName = image
            }

         This will fetch all relations to the image field of the
         tt_content record "256".

         ::

            references {
              table = pages
              uid.data = page:uid
              fieldName = media
            }

         This will fetch all items related to the page.media field.

   Default


.. container:: table-row

   Property
         collections

   Data type
         string /stdWrap

   Description
         Comma separated list of sys_file_collection UIDs, which
         are loaded into the FILES object.

   Default


.. container:: table-row

   Property
         folders

   Data type
         string /stdWrap

   Description
         Comma separated list of combined folder identifiers which
         are loaded into the FILES object.

         A combined folder identifier looks like this:
         [storageUid]:[folderIdentifier].

         The first part is the UID of the storage and the second
         part the identifier of the folder. The identifier of the
         folder is often equivalent to the relative path of the
         folder.

         **Example:**

         ::

            page.10 = FILES
            page.10.folders = 2:mypics/,4:myimages/

   Default


.. container:: table-row

   Property
         renderObj

   Data type
         cObject +optionSplit

   Description
         The cObject used for rendering the files. It is executed
         once for every file. Note that during each execution you can
         find information about the current file using the getText
         property "file" with the "current" keyword.

         **Example:**

         ::

            page.10.renderObj = TEXT
            page.10.renderObj {
              data = file:current:size
              wrap = <p>File size:<strong>|</strong></p>
            }

         This returns the size of the current file.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).FILES]


Special key: "references"
"""""""""""""""""""""""""


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
         table

   Data type
         string /stdWrap

   Description
         The table name of the table having the file field.

   Default


.. container:: table-row

   Property
         uid

   Data type
         string /stdWrap

   Description
         The UID of the record from which to fetch the referenced files.

   Default


.. container:: table-row

   Property
         fieldName

   Data type
         string /stdWrap

   Description
         Fieldname of the file field in the table.

   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).FILES.references]


Example:
~~~~~~~~

In this example, we first load files using all of the methods to load
files explained above (using sys_file UIDs, collection UIDs, and folders).
Then we use the TEXT cObject as renderObj to output the file size of all
files that were found.

::

   page.10 = FILES

   page.10.files = 12,15,16
   page.10.collections = 2,9
   page.10.folders = 1:mypics/

   page.10.renderObj = TEXT
   page.10.renderObj {
     data = file:current:size
     wrap = <p>File size:<strong>|</strong></p>
   }

