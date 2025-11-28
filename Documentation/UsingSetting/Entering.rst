:navigation-title: Backend Module

..  include:: /Includes.rst.txt
..  index:: TypoScript; TypoScript backend module
..  _typoscript_module:
..  _typoscript-syntax-typoscript-templates-structure:

=========================
TypoScript backend module
=========================

..  versionchanged:: 13.1
    TypoScript on a per-site basis can now be entered via
    :ref:`sites and sets <typoscript-site-sets>`. It is still possible but not
    recommended to keep TypoScript in the backend in TYPO3 13.

TypoScript can be stored in a database record or in a file. Storing it in a file
is recommended as you can keep it under version control, deploy it etc.

To store your TypoScript in a file, you can use your site set as
:ref:`TypoScript provider <t3coreapi:site-sets-typoscript>` or store the
TypoScript in a :ref:`custom site package <t3sitepackage:start>`. Use
the :ref:`submodule-active-typoscript` to analyze how the TypoScript is
interpreted after parsing and combining.

When kept in the database, TypoScript is entered manually in both the
:guilabel:`Constants` and :guilabel:`Setup` fields of template records (which are
stored in the database in table :sql:`sys_template`).

..  contents:: The following submodules are available:
    :depth: 1

..  _typoscript_module_overview:

Submodule "TypoScript records overview"
=======================================

This submodule shows all pages that contain TypoScript either by having
a TypoScript record or by having a
:ref:`Site Set TypoScript provider <t3coreapi:site-sets-typoscript>`.

..  figure:: /Images/ManualScreenshots/TypoScriptModule/TypoScriptRecordsOverview.png
    :alt: Screenshot of Submodule "TypoScript records overview" in the TYPO3 backend

If TypoScript was added by a record, it is linked.

..  _typoscript-syntax-constant-editor:
..  _constant-editor:

Submodule "Constant Editor"
===========================

..  note::
    The constant editor is only available in sites that are based on a
    TypoScript record.

..  versionchanged:: 13.3
    With the introduction of the site
    `Site settings editor <https://docs.typo3.org/permalink/t3coreapi:site-settings-editor>`_
    settings can be edited in a comfortable and type safe way on site level.

    The constant editor is kept for backward compatibility.

The backend module :guilabel:`Sites > TypoScript > Constant Editor`
used a special format of
`Comments <https://docs.typo3.org/permalink/t3tsref:typoscript-syntax-syntax-comment-blocks>`_
to display a form for editing the constants.

..  figure:: /Images/ManualScreenshots/TypoScriptModule/ConstantEditor.png
    :alt: Screenshot of the TYPO3 Backend showing the constant editor

It is not recommended to newly introduce constants in the constant editor.
The documentation of the constant editors comment format can still be found
at `Comment Syntax <https://docs.typo3.org/permalink/t3tsref:typoscript-syntax-constant-editor-comments@12.4>`_


..  _typoscript_module_edit:

Submodule "Edit TypoScript Record"
==================================

..  note::
    The constant editor is only available in sites that are based on a
    TypoScript record.

This can be done in the :guilabel:`Sites > TypoScript` module in
the submodule :guilabel:`Edit TypoScript Record`.

..  figure:: /Images/ManualScreenshots/TypoScriptModule/EditTypoScriptRecord.png
    :alt: The submodule "Edit TypoScript Record" in the TYPO3 Backend.

When you click on :guilabel:`Edit the whole TypoScript record` you can edit
the complete record:

..  figure:: /Images/ManualScreenshots/TypoScriptModule/WholeTypoScriptRecord.png
    :alt: The submodule whole TypoScript record in edit mode

As the TypoScript record is just a normal record it can also be seen in and
edited from the :guilabel:`Content > Records` module:

..  figure:: /Images/ManualScreenshots/TypoScriptModule/TypoScriptRecordListView.png
    :alt: The TypoScript record in the Content Media module

..  index:: TypoScript; Include as file
..  _typoscript-syntax-typoscript-templates-structure-includes:

Include TypoScript files
------------------------

..  note::
    Only the import of files ending on '.typoscript' or '.tsconfig' are
    supported. Importing legacy files with the legacy endings '.txt' or '.ts'
    **does not work**, even if their names are explicitly used in the import.

In both the "Constants" and "Setup" fields, the
:ref:`@import <typoscript-syntax-includes>` syntax can be
used to include TypoScript contained inside files:

..  code-block:: typoscript
    :caption: EXT:my_site_package/Configuration/TypoScript/setup.typoscript

    # Import a single file
    @import 'EXT:my_site_package/Configuration/TypoScript/randomfile.typoscript'

    # Import multiple files of a single directory in file name order
    @import 'EXT:my_site_package/Configuration/TypoScript/*.typoscript'

    # The filename extension can be omitted and defaults to .typoscript
    @import 'EXT:my_site_package/Configuration/TypoScript/'

..  index:: TypoScript; Include from extensions
..  _static-includes:

Include TypoScript from extensions
----------------------------------

..  versionchanged:: 13.1
    TypoScript on a per-site basis can now be entered via
    :ref:`sites and sets <typoscript-site-sets>`. If the extension to be used
    already supports site sets, those should be used instead of TypoScript
    includes in the record.

It is also possible to "Include TypoScript sets" from extensions in the
TypoScript record.

..  rst-class:: bignums-xxl

#.  In the :guilabel:`Sites > TypoScript` module, select
    :guilabel:`Edit TypoScript Record`.

#.  Click :guilabel:`Edit the whole TypoScript record`

#.  Chose the tab :guilabel:`Advanced Options`

#.  Click the templates to include in :guilabel:`Available Items`.

    ..  figure:: /Images/ManualScreenshots/TypoScriptModule/IncludeTypoScriptSet.png
        :alt: "Include TypoScript sets" by choosing from the "Available items"

..  tip::
    The section :ref:`extdev-add-typoscript` explains how extension
    developers can make TypoScript available for inclusion in their
    extensions.


..  index:: TypoScript; Include other TypoScript templates
..  _basedOn:

Include other TypoScript records
--------------------------------

Apart from this, it is also possible to include other TypoScript template
records (in the field called :guilabel:`Include TypoScript records`).

..  figure:: /Images/ManualScreenshots/TypoScriptModule/IncludeTypoScriptRecord.png
    :alt: Include TypoScript records

..  index:: TypoScript; Included TypoScript
..  _typoscript-syntax-typoscript-templates-structure-analyzer:

Submodule "Included TypoScript"
===============================

With all those inclusions, it may happen that you lose the overview of the
template structure. The submodule :guilabel:`Included TypoScript` provides
an overview of this structure. It shows all the TypoScript files that apply to
the currently selected page, taking into account inclusions and inheritance
along the page tree.

..  figure:: /Images/ManualScreenshots/TypoScriptModule/IncludedTypoScript.png
    :alt: A visual representation of how TypoScript is included.

TypoScript definitions are taken into consideration from top to bottom, which means
that properties defined in one TypoScript location may be overridden in another
location, considered at a later point by the TypoScript parser.

You can click on the :guilabel:`{+}` button to see details about the TypoScript
definition and its includes.

..  index:: TypoScript; Active TypoScript
..  _submodule-active-typoscript:

Submodule "Active TypoScript"
=============================

You can use the submodule :guilabel:`Active TypoScript` to debug the
configuration array build after all TypoScript configurations are parsed and
combined. TypoScript Constants and Setup are listed separately here and
Constant usage is shown. However there is no information what location the
setting came from. Use the
:ref:`typoscript-syntax-typoscript-templates-structure-analyzer` to analyze where
TypoScript was set and this module to look at the result.

..  figure:: /Images/ManualScreenshots/TypoScriptModule/ActiveTypoScript.png
    :alt: Screenshot of the Active TypoScript submodule in the TYPO3 Backend

    Debug the parsed and combined TypoScript
