.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-search:

Search
^^^^^^

Detected by the cObject SEARCHRESULT, which proceeds with a search if
"sword" && "scols" are set. The search **must** submit to a page with
such a content object on it!

Input may be of both GET and POST method.

Search:

sword = the search words

stype = the search type

scols = the tables/columns to search

locationData = Reference to the record carrying the form. Used to look
up the original starting point of the search (ONLY POST-method)

(redirect = Not used)

scount = Used by the search result to indicate the number of results

spointer = Used by the search result to indicate the starting point for
the next number of results.

See the cObject SEARCHRESULT for a complete description.

