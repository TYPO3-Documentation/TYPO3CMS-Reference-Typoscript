

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Search
^^^^^^

Detected by the cObject SEARCHRESULT, which proceeds with a search if
"sword" && "scols" are set. The search MUST submit to a page with such
a content-object on it!

Input may be of both GET and POST method.

Search:

sword = the searchwords

stype = the search type

scols = the tables/columns to search

locationData = Reference to the record carrying the form. Used to look
up the original startingpoint of the search (ONLY POST-method)

(redirect = Not used)

scount = Used by the searchresult to indicate the number of results

spointer = Used by the searchresult to indicate the startingpoint for
the next number of results.

See the cObject SEARCHRESULT for a complete description.

