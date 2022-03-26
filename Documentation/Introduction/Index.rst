.. include:: /Includes.rst.txt

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


What is TypoScript?
===================

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
* :doc:`t3ts45:Index` for an introduction to TypoScript Templating
* The chapter :ref:`using-and-setting` describes how to use, set
  and extend TypoScript.


.. _typoscript-syntax-typoscript-templates-usage:

Templating methods in TYPO3
===========================


TypoScript templates are used to drive frontend rendering.

A minimal amount of TypoScript will *always* be necessary to
tell TYPO3 CMS which templating method to use.
It could be any of the following.

Best practice:

- **Fluid templates:** Configure TYPO3 to use `Fluid <https://typo3.org/fluid>`__
  for templating. This allows to use external HTML templates, but
  with fluid-style variables with curly braces. A content object type
  :ref:`cobj-fluidtemplate` is available, which uses Fluid
  from inside TypoScript.

  * See :doc:`t3sitepackage:Index` for a complete walkthrough of creating a
    sitepackage, which is the basis for a custom theme for your site.
  * See :ref:`t3coreapi:adding-your-own-content-elements` for an
    introduction on how to create your own content element types using
    TypoScript :ref:`cobj-template`, Fluid and data processors.

Other methods:


- **External Templating Engines:** Any other templating system can be
  used. It will be provided via an extension. In such a case TypoScript
  may be used just to delegate the rendering to that system.

- **Custom PHP:** Configure TYPO3 to call your own PHP code which
  generates content in any way you may prefer. This might include using
  third party templating engines!

- **TS content objects:** Build the page entirely using TypoScript
  content objects. All these objects are highly configurable.

Outdated methods:


- **HTML templates:** Configure TYPO3 CMS to facilitate external HTML-
  templates with markers and subparts using the :ref:`cobj-template`
  content object type. This method is considered outdated and no
  longer recommended.

