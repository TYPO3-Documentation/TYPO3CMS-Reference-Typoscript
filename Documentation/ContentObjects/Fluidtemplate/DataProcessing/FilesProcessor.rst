.. include:: /Includes.txt
.. _FilesProcessor:

==============
FilesProcessor
==============

The :php:`FilesProcessor` resolves file references, files, or files inside a
folder or collection to be used for output in the frontend. A
:ts:`FLUIDTEMPLATE` can then simply iterate over processed data automatically.

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
