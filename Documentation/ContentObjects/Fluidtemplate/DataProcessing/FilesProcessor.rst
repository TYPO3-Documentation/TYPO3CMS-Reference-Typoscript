.. include:: /Includes.txt
.. _FilesProcessor:

==============
FilesProcessor
==============

This data processor can be used for processing file information:

* relations to file records (sys_file_reference)
* fetch files records by their uids in table (sys_file)
* all files from a certain folder
* all files from a collection

A :ts:`FLUIDTEMPLATE` can then simply iterate over processed data automatically.


Options:
========

.. confval:: if

   :Required: false
   :type: :ref:`if` condition
   :default: ''

   If the condition is not met the data is not processed

.. confval:: references

   :Required: false
   :type: string (comma separated integers), :ref:`stdWrap`
   :default: '' '1,303,42'

   If this option contains a comma separated list
   of integers these are treated as uids of file references (sys_file_reference).

   The corresponding file records are added to the output array.

   .. versionadded:: 10.3

      :ref:`stdWrap` properties got added to the references property .

.. confval:: references.fieldName

   :Required: false
   :type: string, :ref:`stdWrap`
   :default: ''
   :Example: 'media'

   If both `references.fieldName` and `references.table` are set the file records
   are fetched from the referenced table and field, for example the `media` field
   of a `tt_content` record.


.. confval:: references.table

   :Required: false
   :type: string, :ref:`stdWrap`
   :default: ''
   :Example: 'tt_content'

   If :typoscript:`references` should be interpreted as TypoScript
   :ref:`select` function, references.fieldName must be set to the
   desired field's name of the table to be queried.

.. confval:: files

   :Required: false
   :type: string (comma separated integers), :ref:`stdWrap`
   :default: ''
   :Example: '1,303,42'

   If this option contains a comma separated list of integers,
   these are treated as uids of files (sys_files).

.. confval:: collections

   :Required: false
   :type: string (comma separated integers), :ref:`stdWrap`
   :default: ''
   :Example: '1,303,42'

   If this option contains a comma separated list of integers,
   these are treated as uids of collections. The file records in each
   collection are then being added to the the output array.


.. confval:: folders

   :Required: false
   :type: string (comma separated folders), :ref:`stdWrap`
   :default: ""
   :Example: "23:/other/folder/"

   Fetches all files from the referenced folders. The following syntax is possible:

   * `t3://folder?storage=2&identifier=/my/folder/` folder "/my/folder/" from storage with uid 2
   * `23:/other/folder/` folder "/other/folder/" from storage with uid 23
   * `/folderInMyFileadmin/something/` folder "/folderInMyFileadmin/something/" from the default storage 0 (fileadmin)

.. confval:: folders.recursive

   :Required: false
   :type: string, :ref:`stdWrap`
   :default:  ""
   :Example: "1"

   If set to a non-empty value file records will be added from folders recursively.


.. confval:: sorting

   :Required: false
   :type: string, :ref:`stdWrap`
   :default:  ""
   :Example: "filesize"

   The property of the file records by which they should be sorted. For example
   filesize or title.


.. confval:: sorting.direction

   :Required: false
   :type: string, :ref:`stdWrap`
   :default:  "ascending"
   :Example: "descending"

   The sorting direction ('ascending' or 'descending')

.. confval:: as

   :Required: false
   :type: string, :ref:`stdWrap`
   :default: "files"

   The variable's name to be used in the Fluid template

.. confval:: dataProcessing

   :Required: false
   :type: array of :ref:`dataProcessing`
   :default: ""

   Array of DataProcessors to be applied to all fetched records.

Examples
========

Using the :php:`FilesProcessor` the following scenario is possible::

   tt_content.image.20 = FLUIDTEMPLATE
   tt_content.image.20 {
      file = EXT:site_default/Resources/Private/Templates/ContentObjects/Image.html

      dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
      dataProcessing.10 {
         # the field name where relations are set
         # + stdWrap
         references.fieldName = image

         # the table name where relations are put, defaults to the currently
         # selected record from $cObj->getTable()
         # + stdWrap
         references.table = tt_content

         # A list of sys_file UID records
         # + stdWrap
         files = 21,42

         # A list of File Collection UID records
         # + stdWrap
         collections = 13,14

         # A list of FAL Folder identifiers and files fetched recursive from
         # all folders
         # + stdWrap
         folders = 1:introduction/images/,1:introduction/posters/
         folders.recursive = 1

         # Property of which the files should be sorted after they have been
         # accumulated
         # can be any property of sys_file, sys_file_metadata
         # + stdWrap
         sorting = description

         # Can be "ascending", "descending" or "random", defaults to
         # "ascending" if none given
         # + stdWrap
         sorting.direction = descending

         # The target variable to be handed to the ContentObject again, can
         # be used in Fluid e.g. to iterate over the objects. defaults to
         # "files" when not defined
         # + stdWrap
         as = myfiles
      }
   }

In the Fluid template then iterate over the files:

.. code-block:: html

   <ul>
      <f:for each="{myfiles}" as="file">
         <li><a href="{file.publicUrl}">{file.name}</a></li>
      </f:for>
   </ul>


Example: use stdWrap property on references
-------------------------------------------

.. versionadded:: 10.3

   :ref:`stdWrap` properties added to the :php:`FilesProcessor`.

The following example implements a slide-functionality on rootline
for file resources::

   page.10.dataProcessing {
      10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
      10 {
         references.data = levelmedia: -1, slide
         as = myfiles
      }
   }

The :php:`FilesProcessor` can slide up the rootline to collect
images for FLUID templates. One usual feature is to use images
attached to pages and use them down the page tree for
header images in the frontend.
