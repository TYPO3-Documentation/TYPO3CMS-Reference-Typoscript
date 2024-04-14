..  include:: /Includes.rst.txt

..  _pageoptions:

=======
options
=======

Various options for the page affecting the Core at various points.

Properties
==========

..  contents::
    :depth: 2
    :local:

..  index::
    options.backendLayout
    Backend; Layout
..  _pagebackendlayout:

backendLayout.exclude
---------------------

..  confval:: backendLayout.exclude
    :name: options-backendLayout-exclude
    :type: list of identifiers / uids

    Exclude a list of backend layouts from being selectable when assigning a backend layout
    to a page record.

    Use the uid/identifier of the record in the default data provider.

..  _pagebackendlayout-example:

Example: Exclude two backend layouts from drop down selector
------------------------------------------------------------

..  figure:: /Images/ManualScreenshots/List/BackendLayoutID.png
    :alt: Two backend layout records shown in list module

    Before: Two backend layout records shown in list module

..  code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   # Exclude two backend layouts from drop down selector
   options.backendLayout.exclude = 1,2

..  figure:: /Images/ManualScreenshots/List/BackendLayoutsExcluded.png
    :alt: Drop down without backend layouts

    After: Drop down without backend layouts

..  index::
   options.backendLayout
   Backend; Layout
..  _pagedefaultuploadfolder:

defaultUploadFolder
-------------------

..  versionadded:: 12.3

..  confval:: defaultUploadFolder
    :name: options-defaultUploadFolder
    :type: string

    Identical to the user TSconfig setting
    :ref:`options.defaultUploadFolder <useroptions-defaultUploadFolder>`,
    this allows the setting of a default upload folder per page.

    If specified and the given folder exists, this setting will override the
    value defined in user TSconfig.

    The syntax is "storage_uid:file_path".

Example: Set default upload
---------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Set default upload folder to "fileadmin/page_upload" on PID 1
    [traverse(page, "uid") == 1]
        options.defaultUploadFolder = 1:/page_upload/
    [END]
