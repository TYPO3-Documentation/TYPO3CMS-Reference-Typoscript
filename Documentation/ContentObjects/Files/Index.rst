.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-files:

FILES
^^^^^

(Since TYPO3 6.0) This content object was integrated with the
File Abstraction Layer (FAL) and is there to output information
about files.


**Note:** Do not mix this up with the cObject :ref:`FILE <cobj-file>`; both are
different cObjects.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         files

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of sys_file UIDs, which are loaded
         into the FILES object.

         **Example:** ::

            page.10 = FILES
            page.10.files = 12,15,16


.. container:: table-row

   Property
         references

   Data type
         string /:ref:`stdWrap <stdwrap>` or array

   Description
         Provides a way to load files from a file field (of type
         IRRE with sys_file_reference as child table). You can either
         provide a UID or a comma-separated list of UIDs from the
         database table sys_file_reference or you have to specify a
         table, uid and field name in the according sub-properties of
         "references". See further documentation of these
         sub-properties in the table below.

         **Examples:** ::

            references = 27,28

         This will get the items from the database table
         sys_file_reference with the UIDs 27 and 28. ::

            references {
              table = tt_content
              uid = 256
              fieldName = image
            }

         This will fetch all relations to the image field of the
         tt_content record "256". ::

            references {
              table = pages
              uid.data = page:uid
              fieldName = media
            }

         This will fetch all items related to the page.media field.


.. container:: table-row

   Property
         collections

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of sys_file_collection UIDs, which
         are loaded into the FILES object.


.. container:: table-row

   Property
         folders

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Comma-separated list of combined folder identifiers which
         are loaded into the FILES object.

         A combined folder identifier looks like this:
         [storageUid]:[folderIdentifier].

         The first part is the UID of the storage and the second
         part the identifier of the folder. The identifier of the
         folder is often equivalent to the relative path of the
         folder.

         **Example:** ::

            page.10 = FILES
            page.10.folders = 2:mypics/,4:myimages/


.. container:: table-row

   Property
         renderObj

   Data type
         :ref:`cObject <data-type-cobject>` :ref:`+optionSplit <objects-optionsplit>`

   Description
         The cObject used for rendering the files. It is executed
         once for every file. Note that during each execution you can
         find information about the current file using the getText
         property "file" with the "current" keyword.

         **Example:** ::

            page.10.renderObj = TEXT
            page.10.renderObj {
              data = file:current:size
              wrap = <p>File size:<strong>|</strong></p>
            }

         This returns the size of the current file.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).FILES]


.. _cobj-files-references:

Special key: "references"
"""""""""""""""""""""""""


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         table

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         The table name of the table having the file field.


.. container:: table-row

   Property
         uid

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         The UID of the record from which to fetch the referenced files.


.. container:: table-row

   Property
         fieldName

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Field name of the file field in the table.


.. ###### END~OF~TABLE ######

[tsref:(cObject).FILES.references]


.. _cobj-files-examples:

Examples:
"""""""""

In this example, we first load files using several of the methods
explained above (using sys_file UIDs, collection UIDs, and folders).
Then we use the :ref:`TEXT <cobj-text>` cObject as renderObj to output the file size of all
files that were found::

   page.10 = FILES

   page.10.files = 12,15,16
   page.10.collections = 2,9
   page.10.folders = 1:mypics/

   page.10.renderObj = TEXT
   page.10.renderObj {
     data = file:current:size
     wrap = <p>File size: <strong>|</strong></p>
   }


In this second example, we use "references" to get the images related
to a given page (in this case, the current page). Each image is then
rendered as an :ref:`IMAGE <cobj-image>` cObject with some meta data coming from the file
itself (publicUrl) or from the reference to it (title)::

   page.20 = FILES
   page.20 {
     references {
       table = pages
       uid.data = tsfe:id
       fieldName = media
     }
     renderObj = IMAGE
     renderObj {
       file.import.data = file:current:publicUrl
       altText.data = file:current:title
       wrap = <div class="slide">|</div>
     }
     stdWrap.wrap = <div class="carousel">|</div>
   }

