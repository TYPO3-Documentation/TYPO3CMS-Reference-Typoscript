.. include:: ../Includes.txt

.. _introduction:
.. _typoscript-syntax-typoscript-templates:

============
Introduction
============

What is to be rendered on a page in the frontend,
the menu structure, how content objects are displayed, etc. can be
defined with TypoScript - often it is used in
combination with the Fluid templating engine.

This document is a **reference**, used to lookup TypoScript templating
:ref:`basic data types <data-types>`, :ref:`object types <cobjects>`,
:ref:`functions <functions>` and :ref:`conditions <conditions>`. This
reference is not intended to give you a full introduction into the topic
TypoScript.

TypoScript can have 2 meanings:

* **TypoScript syntax** is used in TypoScript templates and in
  TSconfig
* **TypoScript templates** are used to configure
  the TYPO3 frontend rendering.

Additionally, in TypoScript templates, you must differentiate between

* TypoScript **constants** (using the TypoScript constant syntax)
* and Typoscript **setup**

Though TypoScript does include "functions" and "objects" and "conditions"
it is not a programming language. Think of it more as a configuration
language. The results of the TypoScript setup are used to build a PHP
array.

Basically think of TypoScript as a means to "configure" the **frontend**,
while TSconfig is used to configure the **backend** (with a few exceptions
to this principle)

Please read the following for an introduction:

* :ref:`TypoScript Syntax <t3coreapi:typoscript-syntax-start>`
  chapter in "TYPO3 Explained" for an introduction to the TypoScript
  syntax
* :ref:`t3start:Templating` in the "Getting Started Tutorial" for an
  introduction into templating in general.
* :ref:`t3ts45:start` for an introduction to TypoScript Templating
* The chapter :ref:`using-and-setting` describes how to use, set
  and extend TypoScript.


Further information may also be helpful:

* :ref:`t3sitepackage:start` for a complete walkthrough of creating a
  sitepackage, which is the basis for a custom theme for your site.
* :ref:`t3coreapi:config-overview` in "TYPO3 Explained" for an overview
  of various configuration languages and methods in TYPO3
