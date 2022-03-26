.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: /Includes.rst.txt


.. _data-type-linkwrap:

linkWrap
========

.. container:: table-row

   Data type
         linkWrap

   Examples
         *This will make a link to the root-level of a website:* ::

            <a href="?id={0}"> | </a>

   Comment
         <.. {x}.> \| </...>

         {x}; x is an integer (0-9) and points to a key in the PHP array
         rootLine. The key is equal to the level the current page is on
         measured relatively to the root of the website.

         If the key exists the uid of the level that key pointed to is inserted
         instead of {x}.

         Thus we can insert page\_ids from previous levels.



