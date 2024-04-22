..  include:: /Includes.rst.txt
..  _FilesProcessor:

==============
FilesProcessor
==============

This data processor can be used for processing file information:

*   relations to file records (:sql:`sys_file_reference`)
*   fetch files records by their uids in table (:sql:`sys_file`)
*   all files from a certain folder
*   all files from a collection

A :typoscript:`FLUIDTEMPLATE` can then iterate over processed data
automatically.

..  _FilesProcessor-options:

Options:
========

..  _FilesProcessor-if:

if
--

..  confval:: if
    :name: FilesProcessor-if
    :Required: false
    :type: :ref:`if` condition
    :Default: ''

    Only, if the condition is met the data processor is executed.


..  _FilesProcessor-references:

references
----------

..  confval:: references
    :name: FilesProcessor-references
    :Required: false
    :type: :ref:`data-type-string` (comma-separated integers) / :ref:`stdWrap`
    :Default: ''
    :Example: '1,303,42'

    If this option contains a comma-separated list of integers, these are
    treated as uids of file references (:sql:`sys_file_reference`).

    The corresponding file records are added to the output array.

    :ref:`stdWrap` properties can also be used, see
    :ref:`FilesProcessor-stdWrap-on-references`.


..  _FilesProcessor-references-fieldName:

references.fieldName
~~~~~~~~~~~~~~~~~~~~

..  confval:: references.fieldName
    :name: FilesProcessor-references-fieldName
    :Required: false
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default: ''
    :Example: 'media'

    If both :typoscript:`references.fieldName` and
    :typoscript:`references.table` are set, the file records are fetched from
    the referenced table and field, for example the :sql:`media` field of a
    :sql:`tt_content` record.


..  _FilesProcessor-references-table:

references.table
~~~~~~~~~~~~~~~~

..  confval:: references.table
    :name: FilesProcessor-references.table
    :Required: false
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default: ''
    :Example: 'tt_content'

    If :typoscript:`references` should be interpreted as TypoScript
    :ref:`select` function, :typoscript:`references.fieldName` must be set to
    the desired field name of the table to be queried.


..  _FilesProcessor-files:

files
-----

..  confval:: files
    :name: FilesProcessor-files
    :Required: false
    :type: :ref:`data-type-string` (comma-separated integers) / :ref:`stdWrap`
    :Default: ''
    :Example: '1,303,42'

    If this option contains a comma-separated list of integers,
    these are treated as uids of files (:sql:`sys_file`).


..  _FilesProcessor-collections:

collections
-----------

..  confval:: collections
    :name: FilesProcessor-collections
    :Required: false
    :type: :ref:`data-type-string` (comma-separated integers) / :ref:`stdWrap`
    :Default: ''
    :Example: '1,303,42'

    If this option contains a comma-separated list of integers,
    these are treated as uids of collections. The file records in each
    collection are then being added to the output array.


..  _FilesProcessor-folders:

folders
-------

..  confval:: folders
    :name: FilesProcessor-folders
    :Required: false
    :type: :ref:`data-type-string` (comma-separated folders), :ref:`stdWrap`
    :Default: ""
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


..  _FilesProcessor-folders-recursive:

folders.recursive
~~~~~~~~~~~~~~~~~

..  confval:: folders.recursive
    :name: FilesProcessor-folders-recursive
    :Required: false
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default: ""
    :Example: "1"

    If set to a non-empty value file, records will be added from folders
    recursively.


..  _FilesProcessor-sorting:

sorting
-------

..  confval:: sorting
    :name: FilesProcessor-sorting
    :Required: false
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default: ""
    :Example: "filesize"

    The property of the file records by which they should be sorted.
    For example, filesize or title.


..  _FilesProcessor-sorting-direction:

sorting.direction
~~~~~~~~~~~~~~~~~

..  confval:: sorting.direction
    :name: FilesProcessor-sorting-direction
    :Required: false
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default:  "ascending"
    :Example: "descending"

    The sorting direction (:typoscript:`ascending` or :typoscript:`descending`).


..  _FilesProcessor-as:

as
--

..  confval:: as
    :name: FilesProcessor-as
    :Required: false
    :type: :ref:`data-type-string` / :ref:`stdWrap`
    :Default: "files"

    The variable name to be used in the Fluid template.


..  _FilesProcessor-example-render-image:

Example 1: Render the images stored in field image
==================================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`FilesProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/FilesProcessor.rst.txt

..  versionadded:: 12.1
    One can use the alias :typoscript:`files` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\FilesProcessor`.


The Fluid template
------------------

Then iterate over the files in the :ref:`Fluid <t3coreapi:fluid>` template:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcFiles.rst.txt


Output
------

The array :php:`images` contains the data of the files now:

..  figure:: /Images/ManualScreenshots/FrontendOutput/DataProcessing/FilesProcessor.png
    :class: with-shadow
    :alt: files dump and output

..  note::
    For technical reasons file references do not show all available data on
    using debug. See :ref:`t3coreapi:fal-using-fal-frontend`.


..  _FilesProcessor-stdWrap-on-references:

Example 2: use stdWrap property on references
=============================================

The following example implements a slide functionality on root line
for file resources:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10.dataProcessing {
        10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
        10 {
            references.data = levelmedia: -1, slide
            as = myfiles
        }
    }

The :php:`FilesProcessor` can slide up the root line to collect images for Fluid
templates. One usual feature is to take images attached to pages and use them on
the page tree as header images in the frontend.

..  _FilesProcessor-FlexForm:

Example 3: files from a FlexForm
================================

If the files are stored in a :ref:`FlexForm <t3coreapi:FlexForms>`, the entry in
the table :sql:`sys_file_reference` uses the name of the main table, for example
:sql:`tt_content` and the FlexForm key as :sql:`fieldname`.

Therefore, you can do the following:

..  literalinclude:: _FilesProcessorFlexForm.typoscript
    :language: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

This assumes that the image was stored in a FlexForm in the table
:sql:`tt_content` like this:

..  literalinclude:: _FlexFormWithImage.xml
    :language: xml
    :caption: EXT:site_package/Configuration/FlexForm/MyFlexForm.xml

Three images in the same content element (uid 15) having the FlexForm above
would look like this in the the database table :sql:`sys_file_reference`:

===== ===== =========== ============= ============ ================== =====
uid   pid   uid_local   uid_foreign   tablenames   fieldnames         ...
===== ===== =========== ============= ============ ================== =====
42    120   12          15            tt_content   settings.myImage   ...
43    120   25          15            tt_content   settings.myImage   ...
44    120   128         15            tt_content   settings.myImage   ...
===== ===== =========== ============= ============ ================== =====
