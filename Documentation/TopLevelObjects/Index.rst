..  include:: /Includes.rst.txt
..  index:: Top-level objects
..  _setup:
..  _top-level-objects:

=================
Top-level objects
=================

As described in the :ref:`TypoScript syntax introduction <typoscript-syntax>`
TypoScript templates are converted into a multidimensional PHP array.
You can view this in the TypoScript object browser. Top level
objects are located on the top level. Top level objects are for
example `config` or `plugin`.

*   Some have an **explicit object type**, such as `PAGE` for `page`
    or `CONFIG` for `config`,
    some may be filled arbitrarily by extensions.
*   Some of these are already **initialized** by TYPO3, such as `config`
    or `plugin`, some must be initialized explicitly, such as `page`.


===================================== =========================
Top-level object                      Top-level object type
===================================== =========================
page | ...                            :ref:`PAGE <page-datatype>`
config                                :ref:`CONFIG <config-datatype>`
:ref:`plugin`
:ref:`tlo-module`
:ref:`styles <tlo-styles>`
:ref:`lib <tlo-lib>`
:ref:`tt_* <tlo-tt>`
:ref:`resources <tlo-resources>`      readonly
:ref:`sitetitle <tlo-sitetitle>`      readonly
===================================== =========================

..  toctree::
    :hidden:

    PageAndConfig
    Module
    Plugin
    Other
