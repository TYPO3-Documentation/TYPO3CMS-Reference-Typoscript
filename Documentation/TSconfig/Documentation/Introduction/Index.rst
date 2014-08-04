.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt

.. _introduction:

Introduction
------------


.. _about:

About this document
^^^^^^^^^^^^^^^^^^^

TypoScript can be used to create templates for the TYPO3 frontend, but
also to configure the TYPO3 backend. In this case, it is called
"TSconfig". TSconfig is divided into configuration for pages ("Page
TSconfig") and configuration for users and groups ("User TSconfig").
Each variant is further detailed in its own chapter. TSconfig offers
vast possibilities of customizing the TYPO3 backend.

For details about the nature of TypoScript as a syntax, please read
the document :ref:`TypoScript Syntax and In-depth Study <t3tssyntax:start>`.

.. _whatsnew:

What's new
^^^^^^^^^^

This version of the TSconfig Reference was updated for TYPO3 CMS
version 6.2.

For TYPO3 6.2 the User TSconfig property options.clearCache.system has been added
which allows a non-admin user to clear frontend and page-related caches, plus some backend-related caches.
The new property mod.web_view.previewFrameWidths allows to emulate device widths.
When using the property field.options.pageTree.searchInAlias the search in the pagetree (filter) also filters on the URL alias field.
The new User TSconfig property excludeDoktypes allows to hide pages with certain doktypes in the page tree.
And last but not least the new Page TSconfig property options.backendLayout.exclude allows to control which backend layouts are usable.


For TYPO3 6.1 the Page TSconfig property noExportRecordsLinks has been added,
which allows to hide the buttons "Export" and "Download CSV file" in the list
module.

In TYPO3 6.0 already the property mod.SHARED.colPos_list has been removed.
Use Backend Layouts instead (see :ref:`Example for Backend Layouts <example_for_backend_layout>`).


.. _whatsnew-list:

Full list of changed properties
"""""""""""""""""""""""""""""""

You can find a list of changes for more recent TYPO3 versions in the
wiki:

TYPO3 4.2: `http://wiki.typo3.org/Documentation\_changes\_in\_4.2`_.

.. _http://wiki.typo3.org/Documentation\_changes\_in\_4.2: http://wiki.typo3.org/Documentation_changes_in_4.2

TYPO3 4.3: `http://wiki.typo3.org/Documentation\_changes\_in\_4.3`_.

.. _http://wiki.typo3.org/Documentation\_changes\_in\_4.3: http://wiki.typo3.org/Documentation_changes_in_4.3

TYPO3 4.4 and 4.5: `http://wiki.typo3.org/Documentation\_changes\_in\_4.4\_and\_4.5`_.

.. _http://wiki.typo3.org/Documentation\_changes\_in\_4.4\_and\_4.5: http://wiki.typo3.org/Documentation_changes_in_4.4_and_4.5

TYPO3 4.6: `http://wiki.typo3.org/Documentation\_changes\_in\_4.6`_.

.. _http://wiki.typo3.org/Documentation\_changes\_in\_4.6: http://wiki.typo3.org/Documentation_changes_in_4.6

TYPO3 4.7: `https://forge.typo3.org/versions/1428`_.

.. _https://forge.typo3.org/versions/1428: https://forge.typo3.org/versions/1428

TYPO3 6.0: `https://forge.typo3.org/versions/1624`_.

.. _https://forge.typo3.org/versions/1624: https://forge.typo3.org/versions/1624

TYPO3 6.1: `https://forge.typo3.org/versions/1961`_.

.. _https://forge.typo3.org/versions/1961: https://forge.typo3.org/versions/1961

TYPO3 6.2: `https://forge.typo3.org/versions/2011`_.

.. _https://forge.typo3.org/versions/2011: https://forge.typo3.org/versions/2011


.. _credits:

Credits
^^^^^^^

This document was originally written by Kasper Skårhøj. It has since
then been maintained successively by Michael Stucki, François Suter,
Christopher Stelmaszyk and Christian Wöbbeking.


.. _feedback:

Feedback
^^^^^^^^

For general questions about the documentation get in touch by writing
to `documentation@typo3.org <mailto:documentation@typo3.org>`_ .

If you find a bug in this manual, please file an issue in the bug
tracker of this manual:
`https://forge.typo3.org/projects/typo3cms-doc-tsconfig/issues
<https://forge.typo3.org/projects/typo3cms-doc-tsconfig/issues>`_

Maintaining quality documentation is hard work and the Documentation
Team is always looking for volunteers. If you feel like helping please
join the documentation mailing list (typo3.projects.documentation on
lists.typo3.org).


.. _versionnumbers:

Version Numbers
^^^^^^^^^^^^^^^

For new features TSconfig includes a note in which TYPO3 version the
feature was added. If such a note is missing, the feature is part of
TYPO3 since version 4.5 at least.
