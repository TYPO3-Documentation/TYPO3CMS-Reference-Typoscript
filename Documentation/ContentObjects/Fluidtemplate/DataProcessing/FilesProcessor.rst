.. include:: /Includes.rst.txt
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


Example 1: Render the images stored in field image
==================================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`FilesProcessor` the following scenario is possible:

.. include:: /CodeSnippets/DataProcessing/TypoScript/FilesProcessor.rst.txt


The Fluid template
------------------

In the Fluid template then iterate over the files:

.. include:: /CodeSnippets/DataProcessing/Template/DataProcFiles.rst.txt


Output
------

The array :php:`images` contains the data of the files now.

.. figure:: /Images/ManualScreenshots/FrontendOutput/DataProcessing/FilesProcessor.png
   :class: with-shadow
   :alt: files dump and output

.. note::

   For technical reasons FileReferences do not show all available data on
   using debug. See :ref:`t3coreapi:fal-using-fal-frontend`.


Example 2: use stdWrap property on references
=============================================

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
images for FLUID templates. One usual feature is to take images
attached to pages and use them on the page tree as
header images in the frontend.
