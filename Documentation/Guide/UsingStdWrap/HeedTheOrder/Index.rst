.. include:: /Includes.rst.txt
.. _guide-stdwrap-order:

==============
Heed the order
==============

The single most important thing to know about `stdWrap` is that all
properties are parsed/executed exactly in the order in which they appear in the
:ref:`TypoScript Reference <stdwrap>`, no matter in which order you
have set them in your TypoScript template.

Let's consider this example::

   10 = TEXT
   10 {
      value = typo3
      noTrimWrap = |<strong>Tool: |</strong>|
      case = upper
   }

It results in the following:

.. code-block:: html

   <strong>Tool: TYPO3</strong>

The `case` property is executed before the `noTrimWrap` property.
Hence only "typo3" was changed to uppercase and not the "Tool:" with which it
is wrapped.
