:navigation-title: Introduction
.. include:: /Includes.rst.txt
..  _typoscript-syntax-typoscript-templates:
..  _typoscript-syntax-typoscript-templates-usage:
..  _introduction:

============================
Introduction into TypoScript
============================

TypoScript is a configuration language used to configure both the frontend
output and the backend of a a TYPO3 web site.

TypoScript is not a programming language but a means of configuring the
website.

..  contents::

..  _introduction-frontend-typoscript:

Frontend TypoScript
===================

Frontend TypoScript is mainly used to configure which data should be send to the
Fluid templates.

It can also be used to define settings send to Extbase plugins, metadata for
a whole page etc.

In the beginning of TYPO3, TypoScript was used as templating language. In modern
project it is not common to do that anymore.

For an introduction see
`Getting started: A quick introduction into TypoScript <https://docs.typo3.org/permalink/t3tsref:guide>`_.

..  _about-tsconfig:

Backend TypoScript / TSconfig
=============================

Backend TypoScript, also called TSconfig, can be used to configure the output
of certain forms etc in the TYPO3 backend.

..  _about-page-tsconfig:

Page TSconfig
-------------

Page TSconfig can be made available globally, on a per site or per page level.

For the possibilities see the
`Page TSconfig Reference <https://docs.typo3.org/permalink/t3tsref:pagetoplevelobjects>`_.

..  _about-user-tsconfig:

User TSconfig
-------------

User TSconfig can be made available globally for certain user groups or certain
users. It cannot be set for just one site or page. It can however override
:ref:`about-page-tsconfig`.

For the possibilities see the
`User TSconfig reference <https://docs.typo3.org/permalink/t3tsref:usertoplevelobjects>`_.
