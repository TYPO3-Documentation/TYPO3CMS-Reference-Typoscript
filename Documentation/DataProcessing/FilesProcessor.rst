:navigation-title: files
..  include:: /Includes.rst.txt
..  _filesprocessor:

======================
`files` data processor
======================

This data processor :php:`\TYPO3\CMS\Frontend\DataProcessing\FilesProcessor`,
alias `files`, can be used for processing file information:

*   relations to file records (`sys_file_reference`)
*   fetch files records by their uids in table (`sys_file`)
*   all files from a certain folder
*   all files from a collection

A :typoscript:`FLUIDTEMPLATE` can then iterate over processed data
automatically.

..  contents:: Table of contents

..  _filesprocessor-options:

Options:
========

..  confval-menu::
    :display: table
    :type:
    :default:

    ..  _filesprocessor-if:

    ..  rubric:: if

    ..  confval:: if
        :name: FilesProcessor-if
        :type: :ref:`if <if>` condition
        :default: ''

        Only, if the condition is met the data processor is executed.

    ..  _filesprocessor-references:

    ..  rubric:: references

    ..  confval:: references
        :name: FilesProcessor-references
        :type: :ref:`string <data-type-string>` (comma-separated integers) / :ref:`stdWrap <stdwrap>`
        :default: ''
        :Example: '1,303,42'

        If this option contains a comma-separated list of integers, these are
        treated as uids of file references (`sys_file_reference`).

        The corresponding file records are added to the output array.

        :ref:`stdWrap <stdwrap>` properties can also be used, see
        :ref:`Example 2: use stdWrap property on references <filesprocessor-stdwrap-on-references>`.

    ..  _filesprocessor-references-fieldname:

    ..  rubric:: references.fieldName

    ..  confval:: references.fieldName
        :name: FilesProcessor-references-fieldName
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: ''
        :Example: 'media'

        If both :typoscript:`references.fieldName` and
        :typoscript:`references.table` are set, the file records are fetched from
        the referenced table and field, for example the `media` field of a
        `tt_content` record.

    ..  _filesprocessor-references-table:

    ..  rubric:: references.table

    ..  confval:: references.table
        :name: FilesProcessor-references.table
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: ''
        :Example: 'tt_content'

        If :typoscript:`references` should be interpreted as TypoScript
        :ref:`select <select>` function, :typoscript:`references.fieldName` must be set to
        the desired field name of the table to be queried.

    ..  _filesprocessor-files:

    ..  rubric:: files

    ..  confval:: files
        :name: FilesProcessor-files
        :type: :ref:`string <data-type-string>` (comma-separated integers) / :ref:`stdWrap <stdwrap>`
        :default: ''
        :Example: '1,303,42'

        If this option contains a comma-separated list of integers,
        these are treated as uids of files (`sys_file`).

    ..  _filesprocessor-collections:

    ..  rubric:: collections

    ..  confval:: collections
        :name: FilesProcessor-collections
        :type: :ref:`string <data-type-string>` (comma-separated integers) / :ref:`stdWrap <stdwrap>`
        :default: ''
        :Example: '1,303,42'

        If this option contains a comma-separated list of integers,
        these are treated as uids of collections. The file records in each
        collection are then being added to the output array.

    ..  _filesprocessor-folders:

    ..  rubric:: folders

    ..  confval:: folders
        :name: FilesProcessor-folders
        :type: :ref:`string <data-type-string>` (comma-separated folders), :ref:`stdWrap <stdwrap>`
        :default: ""
        :Example: "23:/other/folder/"

        Fetches all files from the referenced folders. The following syntax is
        possible:

        `t3://folder?storage=2&identifier=/my/folder/`
            Folder :file:`/my/folder/` from storage with uid `2`

        `23:/other/folder/`
            Folder :file:`/other/folder/` from storage with uid `23`

        `/folderInMyFileadmin/something/`:
            Folder :file:`/folderInMyFileadmin/something/` from the default storage
            `0` (:file:`fileadmin`)

    ..  _filesprocessor-folders-recursive:

    ..  rubric:: folders.recursive

    ..  confval:: folders.recursive
        :name: FilesProcessor-folders-recursive
        :type: bool  / :ref:`stdWrap <stdwrap>`
        :default: 0
        :Example: 1

        If set to a non-empty value file, records will be added from folders
        recursively.

    ..  _filesprocessor-sorting:

    ..  rubric:: sorting

    ..  confval:: sorting
        :name: FilesProcessor-sorting
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: ""
        :Example: "filesize"

        The property of the file records by which they should be sorted.
        For example, filesize or title.

    ..  _filesprocessor-sorting-direction:

    ..  rubric:: sorting.direction

    ..  confval:: sorting.direction
        :name: FilesProcessor-sorting-direction
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: "ascending"
        :Example: "descending"

        The sorting direction (:typoscript:`ascending` or :typoscript:`descending`).

    ..  _filesprocessor-as:

    ..  rubric:: as

    ..  confval:: as
        :name: FilesProcessor-as
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: "files"

        The variable name to be used in the Fluid template.

..  _filesprocessor-example-render-image:

Example 1: Render the images stored in field image
==================================================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.

..  rubric:: TypoScript

Using the :php-short:`\TYPO3\CMS\Frontend\DataProcessing\FilesProcessor` the
following scenario is possible:

..  figure:: /Images/ManualScreenshots/DataProcessing/FilesProcessor.png
    :zoom: lightbox
    :alt: Output of a FilesProcessor, including debug output

..  rubric:: The Fluid template

Then iterate over the files in the :ref:`Fluid <t3coreapi:fluid>` template:

..  literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcFiles.fluid.html
    :caption: EXT:examples/Resources/Private/Templates/ContentElements/DataProcFiles.fluid.html

..  rubric:: Output

The array `images` contains the data of the files now:

..  figure:: /Images/ManualScreenshots/FrontendOutput/DataProcessing/FilesProcessor.png
    :class: with-shadow
    :alt: files dump and output

..  note::
    For technical reasons file references do not show all available data on
    using debug. See :ref:`Using FAL in the frontend <t3coreapi:fal-using-fal-frontend>`.


..  _filesprocessor-stdwrap-on-references:

Example 2: use stdWrap property on references
=============================================

The following example implements a slide functionality on root line
for file resources:

..  literalinclude:: _references.typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript

The :php-short:`\TYPO3\CMS\Frontend\DataProcessing\FilesProcessor` can slide up
the root line to collect images for Fluid templates. One usual feature is to
take images attached to pages and use them on the page tree as header images in
the frontend.

..  _filesprocessor-flexform:

Example 3: files from a FlexForm
================================

If the files are stored in a :ref:`FlexForm <t3coreapi:FlexForms>`, the entry in
the table `sys_file_reference` uses the name of the main table, for example
`tt_content` and the FlexForm key as `fieldname`.

Therefore, you can do the following:

..  literalinclude:: _FilesProcessorFlexForm.typoscript
    :language: typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript

This assumes that the image was stored in a FlexForm in the table
`tt_content` like this:

..  literalinclude:: _FlexFormWithImage.xml
    :language: xml
    :caption: EXT:my_sitepackage/Configuration/FlexForm/MyFlexForm.xml

Three images in the same content element (uid 15) having the FlexForm above
would look like this in the the database table `sys_file_reference`:

===== ===== =========== ============= ============ ================== =====
uid   pid   uid_local   uid_foreign   tablenames   fieldnames         ...
===== ===== =========== ============= ============ ================== =====
42    120   12          15            tt_content   settings.myImage   ...
43    120   25          15            tt_content   settings.myImage   ...
44    120   128         15            tt_content   settings.myImage   ...
===== ===== =========== ============= ============ ================== =====
