.. include:: /Includes.rst.txt
.. index::
   Content objects; FILES
   FILES
.. _cobj-files:

=====
FILES
=====

A content object of type FILES uses the :ref:`File Abstraction Layer <t3coreapi:fal>`
(FAL) and is used to display information about files.

.. contents::
   :local:

.. _cobj-files-properties:

Properties
==========

..  _cobj-files-cache:

cache
-----

..  confval:: cache
    :name: files-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.


.. _cobj-files-files:

files
------

..  confval:: files
    :name: files-files
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Comma-separated list of sys_file UIDs, which are loaded
    into the FILES object.

    **Example:**

    ..  code-block:: typoscript

        page.10 = FILES
        page.10.files = 12,15,16


.. _cobj-files-references:

references
----------

..  confval:: references
    :name: files-references
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>` or array

    Provides a way to load files from a file field (of type
    IRRE with sys_file_reference as child table). You can either
    provide a UID or a comma-separated list of UIDs from the
    database table sys_file_reference or you have to specify a
    table, uid and field name in the according sub-properties of
    "references". See further documentation of these
    sub-properties in the table below.

    **Examples:**

    ..  code-block:: typoscript

        references = 27,28

    This will get the items from the database table
    sys_file_reference with the UIDs 27 and 28.

    ..  code-block:: typoscript

        references {
          table = tt_content
          uid = 256
          fieldName = image
        }

    This will fetch all relations to the image field of the
    tt_content record "256".

    ..  code-block:: typoscript

        references {
          table = pages
          uid.data = page:uid
          fieldName = media
        }

    This will fetch all items related to the page.media field.


.. _cobj-files-collections:

collections
-----------

..  confval:: collections
    :name: files-collections
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Comma-separated list of :sql:`sys_file_collection` UIDs, which
    are loaded into the :typoscript:`FILES` object.


.. _cobj-files-folders:

folders
-------

..  confval:: folders
    :name: files-folders
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Comma-separated list of combined folder identifiers which
    are loaded into the FILES object.

    A combined folder identifier looks like this:
    [storageUid]:[folderIdentifier].

    The first part is the UID of the storage and the second
    part the identifier of the folder. The identifier of the
    folder is often equivalent to the relative path of the
    folder.

    The property folders has the option :typoscript:`recursive` to get
    files recursively.

    **Example:**

    ..  code-block:: typoscript

        page.10 = FILES
        page.10.folders = 2:mypics/,4:myimages/

    Example for option :typoscript:`recursive`:

    ..  code-block:: typoscript

        filecollection = FILES
        filecollection {
           folders = 1:images/
           folders.recursive = 1

           renderObj = IMAGE
           renderObj {
              file.import.data = file:current:uid
           }
        }


.. _cobj-files-sorting:

sorting
-------

..  confval:: sorting
    :name: files-sorting
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Name of the field, which should be used to sort the files.


.. _cobj-files-sorting-direction:

sorting.direction
~~~~~~~~~~~~~~~~~

..  confval:: sorting.direction
    :name: files-sorting-direction
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`
    :Default: asc

    The direction, in which the
    files should be sorted. Possible values are "asc" for ascending and
    "desc" for descending.


.. _cobj-files-begin:

begin
-----

..  confval:: begin
    :name: files-begin
    :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

    The first item to return. If not set (default), items beginning
    with the first one are returned.


.. _cobj-files-maxItems:

maxItems
--------

..  confval:: maxItems
    :name: files-maxItems
    :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

    Maximum number of items to return. If not set (default), all items
    are returned. If :ref:`cobj-files-begin` and :ref:`cobj-files-maxItems`
    together exceed the number of available items, no items beyond the
    last available item will be returned.


.. _cobj-files-renderObj:

renderObj
---------

..  confval:: renderObj
    :name: files-renderObj
    :type: :ref:`cObject <data-type-cobject>` :ref:`+optionSplit <optionsplit>`

    The cObject used for rendering the files. It is executed
    once for every file. Note that during each execution you can
    find information about the current file using the getText
    property "file" :ref:`data-type-gettext-file` with the "current" keyword.
    Look there to find out which properties of the file are available.

    **Example:**

    ..  code-block:: typoscript

        page.10.renderObj = TEXT
        page.10.renderObj {
          stdWrap.data = file:current:size
          stdWrap.wrap = <p>File size:<strong>|</strong></p>
        }

    This returns the size of the current file.


.. _cobj-files-stdWrap:

stdWrap
-------

..  confval:: stdWrap
    :name: files-stdWrap
    :type: :ref:`->stdWrap <stdwrap>`


.. index:: FILES; references
.. _cobj-files-references-sub:

Special key: "references"
=========================

.. _cobj-files-references-table:

references.table
----------------

..  confval:: references.table
    :name: files-references-table
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    The table name of the table having the file field.


.. _cobj-files-references-uid:

references.uid
--------------

..  confval:: references.uid
    :name: files-references-uid
    :type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`

    The UID of the record from which to fetch the referenced files.


.. _cobj-files-references-fieldName:

references.fieldName
--------------------

..  confval:: references.fieldName
    :name: files-references-fieldName
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Field name of the file field in the table.

.. _cobj-files-examples:

Examples
=========


.. _cobj-files-examples-files:

Usage with files
-----------------

In this example, we first load files using several of the methods
explained above (using sys_file UIDs, collection UIDs, and folders).
Then we use the :ref:`TEXT <cobj-text>` cObject as :ref:`cobj-files-renderObj`
to output the file size of all files that were found:

.. code-block:: typoscript

    page.10 = FILES

    page.10.files = 12,15,16
    page.10.collections = 2,9
    page.10.folders = 1:mypics/

    page.10.renderObj = TEXT
    page.10.renderObj {
        stdWrap.data = file:current:size
        stdWrap.wrap = <p>File size: <strong>|</strong></p>
    }


.. _cobj-files-examples-references:

Usage with references
----------------------

In this second example, we use "references" to get the images related
to a given page (in this case, the current page). We start with the
first image and return up to five images. Each image is then rendered
as an :ref:`IMAGE <cobj-image>` cObject with some meta data coming from
the file itself or from the reference to it (title):

.. code-block:: typoscript

    page.20 = FILES
    page.20 {
        references {
            table = pages
            uid.data = tsfe:id
            fieldName = media
        }

        begin = 0
        maxItems = 5

        renderObj = IMAGE
        renderObj {
            file.import.dataWrap = {file:current:storage}:{file:current:identifier}
            altText.data = file:current:title
            wrap = <div class="slide">|</div>
        }
        stdWrap.wrap = <div class="carousel">|</div>
    }


.. _cobj-files-examples-sliding:

Usage with sliding
--------------------

One usual feature is to use images attached to pages and use
them up and down the page tree, a process called "sliding".

.. code-block:: typoscript

    lib.banner = FILES
    lib.banner {
        references {
            data = levelmedia: -1, slide
        }

        renderObj = IMAGE
        renderObj {
            file.import.dataWrap = {file:current:storage}:{file:current:identifier}
            altText.data = file:current:title
            wrap = <div class="banner">|</div>
        }
    }
