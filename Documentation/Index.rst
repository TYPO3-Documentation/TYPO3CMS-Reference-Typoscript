
.. include:: Includes.txt


.. _start:

=============================
TypoScript Template Reference
=============================

.. rst-class:: horizbuttons-primary-m
 
* :ref:`CONFIG <config>`
* :ref:`cobj-content`
* :ref:`cobj-fluidtemplate`
* :ref:`cobj-hmenu`
* :ref:`cobj-image`
* :ref:`PAGE`
* :ref:`cobj-text`


:Version:
      |release|

:Language:
      en

:Description:
      The TypoScript Template Reference (TSref) is a true reference describing the core Content Objects and functions available for Template building using the TypoScript template engine.

:Keywords:
      forAdmins, forIntermediates

:Copyright:
      2000-2015

:Author:
      :ref:`Documentation Team <feedback>` & Community, see :ref:`Credits <credits>`

:License:
      Open Publication License available from `www.opencontent.org/openpub/
      <http://www.opencontent.org/openpub/>`_

The content of this document is related to TYPO3,

a GNU/GPL CMS/Framework available from `www.typo3.org
<https://typo3.org/>`_


.. rst-class:: horizbuttons-primary-m

-  :ref:`Sitemap`


.. _about-tsref:

About This Manual
=================

This document is a complete reference to all objects types and properties of
TypoScript as used in frontend TypoScript templates, and not in :ref:`TSconfig <t3tsconfig:start>`.

.. seealso::

    * For explanations about the syntax of TypoScript itself,
      please refer to :ref:`t3tssyntax:start`
    * For an introduction to TypoScript Templates, see :ref:`t3ts45:start`



.. _version-numbers:

Version Numbers
===============

This document always refers to the latest released TYPO3 version. For older versions,
use the version selector at the bottom left of the site.

For new features TypoScript Reference includes a note in which TYPO3 version the
feature was added. If such a note is missing, the feature is part of TYPO3 since
version 7.6 at least.


.. _case-sensitivity:

Case Sensitivity
================

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


Official documentation
======================

This document is included as part of the official TYPO3 documentation.
It has been approved by the TYPO3 Documentation Team following a peer-
review process. The reader should expect the information in this
document to be accurate - please report discrepancies to the
Documentation Team (documentation@typo3.org). Official documents are
kept up-to-date to the best of the Documentation Team's abilities.


Core Manual
===========

This document is a Core Manual. Core Manuals address the built in
functionality of TYPO3 and are designed to provide the reader with in-
depth information. Each Core Manual addresses a particular process or
function and how it is implemented within the TYPO3 source code. These
may include information on available APIs, specific configuration
options, etc.

Core Manuals are written as reference manuals. The reader should rely
on the Table of Contents to identify what particular section will best
address the task at hand.


Table of Contents and Sitemap
=============================

Please visit the complete :ref:`Sitemap`.

.. toctree::
   :hidden:

   Introduction/Index
   DataTypes/Index
   ObjectsAndProperties/Index
   Conditions/Index
   Functions/Index
   Setup/Index
   ContentObjects/Index
   Gifbuilder/Index
   MenuObjects/Index
   AppendixA/Index

.. toctree::
   :caption: ____________
   :hidden:

   About
   Sitemap/Index
   Targets
