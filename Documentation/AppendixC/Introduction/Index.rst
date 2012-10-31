.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-include-introduction:

Introduction
^^^^^^^^^^^^

Although you can do very much with TypoScript itself, it can sometimes
be a much more flexible solution to include a PHP-script you write on
your own. But you must understand and respect some circumstances. For
example the caching system: When a page is shown with TYPO3 it's
normally cached afterwards in the SQL-database. This is done to ensure
a high performance when delivering the same page the next time. But
this also means that you can only make custom code from your include
files if you differ your output based on the same conditions that the
template may include! For example you cannot just return browser-
specific code to TypoScript if not the template also distinguishes
between the actual browsers. If you do, the cache will cache the page
with the browser-specific HTML-code and the next hit by another
browser will trigger the cache to return a wrong page. If the
condition is correctly setup "another browser"-hit will instead render
another page (which will also be cached but tagged with the other
browser!) and the two browsers will receive different pages but still
the pages will be cached.

