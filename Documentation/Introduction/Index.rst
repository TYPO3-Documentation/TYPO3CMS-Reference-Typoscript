.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _introduction:

Introduction
------------

.. _about-tsref:

About this document
^^^^^^^^^^^^^^^^^^^

This document is a complete reference to all objects and properties of
TypoScript as used in TYPO3 templates (and not in TSconfig).

For explanations about the syntax of TypoScript itself, please refer
to the "TypoScript Syntax and In-Depth Study" manual.

This version is updated for TYPO3 CMS version 6.1.


.. _what-s-new:

What's new
^^^^^^^^^^

The main changes include the new stdWrap property strPad, which allows
to pad the input value to a certain length. The stdWrap feature
addPageCacheTags enables you to add tags to cached pages.
noTrimWrap.splitChar has been introduced, which now allows to control
how noTrimWrap and optionSplit should work together. stdWrap has been
added to config.pageTitleSeparator. For the cObject FLUIDTEMPLATE the
properties "template" and "settings" have been added. The new config
property "removePageCss" was amended, allowing you to remove CSS
styles, which were added, because of a certain situation. The config
property "disableBodyTag" has been appended, which allows to disable
body tag creation by TYPO3 completely.

The system extension statictemplates and the associated menu objects
GMENU_LAYERS, GMENU_FOLDOUT and TMENU_LAYERS experienced removal from
the TYPO3 Core.

Additionally various descriptions were improved and many smaller
mistakes were fixed.

For more details about changes in the various TYPO3 versions please
refer to the links below.

.. tip::

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

   TYPO3 4.7: `http://forge.typo3.org/projects/typo3cms-doc-typoscript/v
   ersions/1454 <http://forge.typo3.org/projects/typo3cms-doc-typoscript/v
   ersions/1454>`_

   TYPO3 6.0: `http://forge.typo3.org/projects/typo3cms-doc-typoscript/v
   ersions/1623 <http://forge.typo3.org/projects/typo3cms-doc-typoscript/v
   ersions/1623>`_

   TYPO3 6.1: `http://forge.typo3.org/projects/typo3cms-doc-typoscript/v
   ersions/1960 <http://forge.typo3.org/projects/typo3cms-doc-typoscript/v
   ersions/1960>`_


.. _credits:

Credits
^^^^^^^

The manual was originally written by Kasper Skårhøj. Over the years it
has been maintained and updated successively by Michael Stucki,
François Suter and Christopher Stelmaszyk.


.. _feedback:

Feedback
^^^^^^^^

For general questions about the documentation get in touch by writing
to `documentation@typo3.org <mailto:documentation@typo3.org>`_ .

If you find a bug in this manual, please file an issue in this
manual's bug tracker:
`http://forge.typo3.org/projects/typo3cms-doc-typoscript/issues
<http://forge.typo3.org/projects/typo3cms-doc-typoscript/issues>`_

Maintaining quality documentation is hard work and the Documentation
Team is always looking for volunteers. If you feel like helping please
join the documentation mailing list (typo3.projects.documentation on
lists.typo3.org).


.. _general-information:

General information
^^^^^^^^^^^^^^^^^^^

.. _case-sensitivity:

Case sensitivity
""""""""""""""""

All names and references in TypoScript are **case sensitive!** This
is very important to notice. For example watch the words "TEXT" and "value"
in this TypoScript code::

   myObject = TEXT
   myObject.value = <strong>Some HTML code</strong>

This is not the same as ::

   myObject = text
   myObject.Value = <strong>Some HTML code</strong>

While the first will be recognized as the content object "TEXT" and
will produce the desired output, the latter will not be recognized and
will not output anything. Even if you wrote **"TEXT"** in uppercase in the
second example, it would still not work, because the property **"value"**
is misspelled.

Always remember: In this manual the case of objects **is** important.


.. _version-numbers:

Version numbers
"""""""""""""""

For new features TSref includes a note in which TYPO3 version the
feature was added. If such a note is missing, the feature is part of
TYPO3 since version 4.5 at least.

