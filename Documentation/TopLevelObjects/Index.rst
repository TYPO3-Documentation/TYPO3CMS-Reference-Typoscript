.. include:: ../Includes.txt
.. index:: Top-level objects
.. _setup:
.. _top-level-objects:

=================
Top-level objects
=================

As described in the :ref:`TypoScript syntax introduction <t3coreapi:typoscript-syntax-introduction>`
TypoScript templates are converted into a multidimensional PHP array.
You can view this in the TypoScript object browser. Top level
objects are located on the top level. Top level objects are for
example `config` or `plugin`.

* Some have an **explicit object type**, such as `PAGE` for `page`
  or `CONFIG` for `config`,
  some may be filled arbitrarily by extensions.
* Some of these are already **initialized** by TYPO3, such as `config`
  or `plugin`, some must be initialized explicitly, such as `page`.


.. container:: ts-properties

   ===================================== =========================
   Top-level object                      Top-level object type
   ===================================== =========================
   page | ...                            :ref:`PAGE <page-datatype>`
   config                                :ref:`CONFIG <config-datatype>`
   :ref:`tlo-constants`
   :ref:`plugin`
   :ref:`tlo-module`
   :ref:`temp <tlo-temp>`
   :ref:`styles <tlo-styles>`
   :ref:`lib <tlo-lib>`
   :ref:`tt_* <tlo-tt>`
   :ref:`_GIFBUILDER <tlo-gifbuilder>`
   :ref:`resources <tlo-resources>`      readonly
   :ref:`sitetitle <tlo-sitetitle>`      readonly
   :ref:`types <tlo-types>`              readonly
   ===================================== =========================



.. toctree::
   :hidden:

   ../Setup/Config/Index
   Constants
   GifbuilderTopLevelObject
   Module
   ../Setup/Page/Index
   Plugin
   Other
