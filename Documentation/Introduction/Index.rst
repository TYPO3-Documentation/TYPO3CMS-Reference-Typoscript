.. include:: /Includes.rst.txt

.. _introduction:

============
Introduction
============

This document serves as a manual for TypoScript and TSconfig, two
essential configuration tools in TYPO3.

.. _typoscript-syntax-typoscript-templates:

TypoScript
==========

TypoScript is a configuration language used to define the frontend rendering
in TYPO3. It is not a programming language but a means of configuring the
website.

Key sections to explore:

*   :ref:`TypoScript Syntax <typoscript-syntax>` for an introduction to the syntax.
*   :ref:`TypoScript Reference <data-types>` for details on data types, object types, functions, and conditions.
*   :ref:`guide` for configuring frontend behavior using TypoScript.
*   :ref:`using-and-setting` for extending and setting TypoScript properties.

.. _typoscript-syntax-typoscript-templates-usage:

Templating in TYPO3
===================

Frontend rendering in TYPO3 can use several methods, each requiring some TypoScript configuration:

**Best Practice:**

- **Fluid Templates**: Use the `Fluid <https://typo3.org/fluid>`__ engine with TypoScript's :ref:`cobj-fluidtemplate` to integrate external HTML templates with Fluid variables.
  * See :ref:`t3sitepackage:start` for creating site packages and custom themes.
  * See :ref:`t3coreapi:adding-your-own-content-elements` to create custom content elements with TypoScript and Fluid.

**Other Methods:**

- External templating engines via extensions.
- Custom PHP code for advanced use cases.
- TypoScript content objects for fully configurable rendering.

**Outdated Method:**

- **HTML Templates** using markers and subparts (:ref:`cobj-template`) are no longer recommended.

..  _about-tsconfig:

TSconfig
========

TSconfig customizes the TYPO3 backend for pages, users, and groups without requiring PHP code. It is a TypoScript-like syntax, used for backend configuration, distinct from TypoScript, which configures the frontend.

**Key Concepts:**

- **Page TSconfig**: Configures backend behavior on a per-page basis.
- **User TSconfig**: Configures options for specific users or groups.

TSconfig is primarily for integrators to control what backend users see and interact with, including:

- Configuring backend options and views.
- Customizing the Admin Panel in the frontend, which is tightly linked to backend user roles.

For details on syntax, refer to :ref:`TYPO3 Explained <t3tsref:typoscript-syntax>`. Remember, properties from the :ref:`TypoScript Reference <t3tsref:start>` cannot be used in TSconfig and vice versa.

This document provides the foundational concepts and serves as a reference for both TypoScript and TSconfig, empowering developers and integrators to customize TYPO3 effectively.
