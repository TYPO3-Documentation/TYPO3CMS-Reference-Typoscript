..  include:: /Includes.rst.txt
..  _gifbuilder:
..  _gifbuilder-toc:

==========
GIFBUILDER
==========

:typoscript:`GIFBUILDER` is an object type, which is used in many situations for
creating image files (for example, GIF, PNG or JPG). Wherever the
->GIFBUILDER object type is mentioned, these are the properties that apply.

Using TypoScript, you can define a "numerical array" of
:ref:`GIFBUILDER objects <gifbuilder-object-names>` (like
:ref:`TEXT <gifbuilder-text>`, :ref:`IMAGE <gifbuilder-image>`, etc.)
and they will be rendered onto an image one by one.

The name :typoscript:`GIFBUILDER` comes from the time when GIF was the only
supported file format. PNG and JPG can be created as well today (configured with
:ref:`$TYPO3_CONF_VARS['GFX'] <t3coreapi:typo3ConfVars_gfx>`).

**Table of Contents:**

..  toctree::
    :maxdepth: 5
    :titlesonly:
    :glob:

    Examples
    Calc
    Properties
    ObjectNames/Index
