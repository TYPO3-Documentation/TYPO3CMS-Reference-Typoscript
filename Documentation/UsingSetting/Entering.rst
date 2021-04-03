.. include:: /Includes.rst.txt
.. index:: TypoScript; Add in the backend
.. _typoscript-syntax-typoscript-templates-structure:

=============================
Add TypoScript in the backend
=============================

At its most basic, TypoScript is entered manually in both the
:guilabel:`Constants` and :guilabel:`Setup` fields of template records (which are
stored in the database in table "sys_template").

This can be done in the :guilabel:`Web > Template` module in
the TYPO3 backend.

.. hint::

   It is best practice to use a Sitepackage extension to bundle
   various configuration in an extension. See :ref:`t3sitepackage:start`.


.. include:: /Includes/Images/RstIncludes/TemplatesRecordListView.rst.txt

.. include:: /Includes/Images/RstIncludes/TemplatesInput.rst.txt

If the "t3editor" system extension is not installed or has been
disabled via configuration options, the :guilabel:`Constants` and :guilabel:`Setup` fields
will be normal multi-line text fields.

.. figure:: ../Images/TemplatesInputNoT3Editor.png
   :alt: The Constants and Setup fields without the t3editor enabled


.. index:: TypoScript; Include as file
.. _typoscript-syntax-typoscript-templates-structure-includes:

Include TypoScript files
========================

In both the "Constants" and "Setup" fields, the
:ref:`@import <t3coreapi:typoscript-syntax-includes>` syntax can be
used to include TypoScript contained inside files::

   # Import a single file
   @import 'EXT:myproject/Configuration/TypoScript/randomfile.typoscript'

   # Import multiple files of a single directory in file name order
   @import 'EXT:myproject/Configuration/TypoScript/*.typoscript'

   # The filename extension can be omitted and defaults to .typoscript
   @import 'EXT:myproject/Configuration/TypoScript/'

   # Import TypoScript files with legacy ".txt" extension
   @import 'EXT:myproject/Configuration/TypoScript/Setup/*.txt'


.. index:: TypoScript; Include from extensions
.. _static-includes:

Include TypoScript from extensions
==================================

It is also possible to "Include static" templates from extensions.


.. rst-class:: bignums-xxl

#. In the :guilabel:`Web > Template` module, select :guilabel:`Info / Modify`

#. Click :guilabel:`Edit the whole template record`

   .. include:: /Includes/Images/RstIncludes/TemplatesStaticIncludes1.rst.txt

.. rst-class:: bignums-xxl

#. Chose the tab :guilabel:`Includes`

#. Click the templates to include in :guilabel:`Available Items`.

   .. include:: /Includes/Images/RstIncludes/TemplatesStaticIncludes2.rst.txt

.. tip::

   The section :ref:`extdev-add-typoscript` explains how extension
   developers can make TypoScript available for inclusion in their
   extensions.


.. index:: TypoScript; Include other TypoScript templates

Include other TypoScript templates
==================================

Apart from this, it is also possible to include other TypoScript template
records (in the field called "Include Basis Template").

.. include:: /Includes/Images/RstIncludes/TemplatesIncludes.rst.txt

.. index:: TypoScript; Analyzer
.. _typoscript-syntax-typoscript-templates-structure-analyzer:

Template analyzer
=================

With all those inclusions, it may happen that you lose the overview of the
template structure. The :guilabel:`Template Analyzer` (1) provides an overview
of this
structure. It shows all the templates that apply to the currently selected page,
taking into account inclusions and inheritance along the page tree.

.. include:: /Includes/Images/RstIncludes/TemplatesAnalyzerDetails.rst.txt

Templates are taken into consideration from top to bottom, which means
that properties defined in one template may be overridden in templates
considered at a later point by the TypoScript parser.

In the Template Analyzer, you can click on any listed template (2) to view
the content of its "Setup" and "Constants" fields.


The line numbers are compiled from the first template to be included,
which is why the numbers are so high.
