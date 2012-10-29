.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


Introduction
------------

About this document
^^^^^^^^^^^^^^^^^^^

This document is a complete reference to all objects and properties of
TypoScript as used in TYPO3 templates (and not in TSconfig).

For explanations about the syntax of TypoScript itself, please refer
to the "TypoScript Syntax and In-Depth Study" manual.

This version is updated for TYPO3 version 4.7.


What's new
^^^^^^^^^^

The main changes include new config.stat\_\* options which allow
anonymized storage of log information. For page.includeCSS and
page.includeJS\* conditions are now available.

The new stdWrap properties "cache" and "orderedStdWrap" were added.
stdWrap has been added to the HMENU options "maxItems", "minItems" and
"begin". The option config.htmlTag\_stdWrap, which makes more
modifications of the html tag possible, has been appended.

New properties of filelink.icon were appended. The option
config.pageTitleSeparator has been added allowing further
customizations of the website title. The meta object now offers the
new subproperty "httpEquivalent", which makes handling of meta tags
more flexible.

Additionally various descriptions were improved and many smaller
mistakes were fixed.

For more details about changes in the various TYPO3 versions please
refer to the links below.

.. figure:: ../Images/icon_internet.png
   :alt: More information are available on these webpages.

**More information about changed properties**

You can find a list of changes for more recent TYPO3 versions here:

TYPO3 4.2: `http://wiki.typo3.org/Documentation\_changes\_in\_4.2
<http://wiki.typo3.org/Documentation_changes_in_4.2>`_

TYPO3 4.3: `http://wiki.typo3.org/Documentation\_changes\_in\_4.3
<http://wiki.typo3.org/Documentation_changes_in_4.3>`_

TYPO3 4.4 and 4.5:
`http://wiki.typo3.org/Documentation\_changes\_in\_4.4\_and\_4.5
<http://wiki.typo3.org/Documentation_changes_in_4.4_and_4.5>`_

TYPO3 4.6: `http://wiki.typo3.org/Documentation\_changes\_in\_4.6
<http://wiki.typo3.org/Documentation_changes_in_4.6>`_

TYPO3 4.7: `http://forge.typo3.org/projects/typo3v4-doc\_core\_tsref/v
ersions/1454 <http://forge.typo3.org/projects/typo3v4-doc_core_tsref/v
ersions/1454>`_


Credits
^^^^^^^

The manual was originally written by Kasper Skårhøj. Over the years it
has been maintained and updated successively by Michael Stucki,
François Suter and Christopher Stelmaszyk.


Feedback
^^^^^^^^

For general questions about the documentation get in touch by writing
to `documentation@typo3.org <mailto:documentation@typo3.org>`_ .

If you find a bug in this manual, please file an issue in this
manual's bug tracker:
`http://forge.typo3.org/projects/typo3v4-doc\_core\_tsref/issues
<http://forge.typo3.org/projects/typo3v4-doc_core_tsref/issues>`_

Maintaining quality documentation is hard work and the Documentation
Team is always looking for volunteers. If you feel like helping please
join the documentation mailing list (typo3.projects.documentation on
lists.typo3.org).


General information
^^^^^^^^^^^^^^^^^^^

Case sensitivity
""""""""""""""""

All names and references in TypoScript are  **case sensitive!** This
is very important to notice. That means that::

   myObject = TEXT
   myObject.value = <strong>Some HTML code</strong>

is not the same as ::

   myObject = text
   myObject.Value = <strong>Some HTML code</strong>

While the first will be recognized as the content-object "TEXT" and
will produce the desired output, the latter will not be recognized and
will not output anything. Even if you wrote "TEXT" in uppercase in the
second example, it would still not work, because the property "value"
is misspelled.

Always remember: In this manual the case of objects is important.


Version numbers
"""""""""""""""

For new features TSref includes a note in which TYPO3 version the
feature was added. If such a note is missing, the feature is part of
TYPO3 since version 4.5 at least.

