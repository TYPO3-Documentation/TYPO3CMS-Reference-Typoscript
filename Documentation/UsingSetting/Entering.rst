.. include:: /Includes.rst.txt


.. _typoscript-syntax-typoscript-templates-structure:

Entering and structuring TypoScript templates
=============================================

At its most basic, TypoScript is entered manually in both the
"Constants" and "Setup" fields of template records (which are
stored in the database in table "sys_template").

.. figure:: ../Images/TemplatesRecordListView.png
   :alt: A TypoScript template as seen in the Web > List module.

.. figure:: ../Images/TemplatesInput.png
   :alt: The Constants and Setup fields of a TypoScript template

If the "t3editor" system extension is not installed or has been
disabled via configuration options, the "Constants" and "Setup" fields
will be normal multi-line text fields.

.. figure:: ../Images/TemplatesInputNoT3Editor.png
   :alt: The Constants and Setup fields without the t3editor enabled


.. _typoscript-syntax-typoscript-templates-structure-includes:

Inclusions
----------

In both the "Constants" and "Setup" fields, the
:ref:`INCLUDE_TYPOSCRIPT <t3coreapi:typoscript-syntax-includes>` syntax can be
used to include TypoScript contained inside files.

Apart from this, it is also possible to include other TypoScript template
records (in the field called "Include Basis Template") and
TypoScript provided by extensions (in the field called "Include static
(from extensions)").

.. figure:: ../Images/TemplatesIncludes.png
   :alt: Templates included from another template


Included templates can themselves include other templates.

.. _typoscript-syntax-typoscript-templates-structure-analyzer:

Template Analyzer
-----------------

With all those inclusions, it may happen that you lose the overview of the
template structure. The "Template Analyzer" provides an overview of this
structure. It shows all the templates that apply to the currently selected page,
taking into account inclusions and inheritance along the page tree.

.. figure:: ../Images/TemplatesAnalyzer.png
   :alt: All templates applying to a page, as used by the Introduction Package


Templates are taken into consideration from top to bottom, which means
that properties defined in one template may be overridden in templates
considered at a later point by the TypoScript parser.

In the Template Analyzer, you can click on any listed template to view
the content of its "Setup" and "Constants" fields.

.. figure:: ../Images/TemplatesAnalyzerDetails.png
   :alt: Viewing the content of a given template in the Template Analyzer


The line numbers are compiled from the first template to be included,
which is why the numbers are so high.
