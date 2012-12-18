.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-index.php:

Introduction
^^^^^^^^^^^^

index.php is the main script for showing pages with TYPO3 /
TypoScript. This page provides some information about this script and
how to use it.

Normally you request pages by setting a value for "id" and possibly
for "type".

"id" refers to a page. This is an integer. If a string is supplied,
it's regarded as an alias and the corresponding page is found.

"type" defines which "type" the page is of. It is always an integer
(0-255). If "type" is not set, it's regarded to be zero. "type" is
used to build framesets. For example the frameset could have "type = 0"
(or nothing) and the pages in the various frames could have "type = 1"
and "type = 2" and "type = 3". In TypoScript you define a PAGE object for
each type so TYPO3 renders different pages depending on the value of
"type". Normally the PAGE object displaying the page content is named
"page" and has the "type = 1" value.

