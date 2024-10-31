.. include:: /Includes.rst.txt

.. _guide-cobjects-database-queries:

==================================
Objects executing database queries
==================================

- :ref:`CONTENT <cobj-content>` can be used to access arbitrary tables
  of TYPO3 CMS internals. This does not only include table "tt\_content", but
  extension tables can also be referenced. The :ref:`select <select>`
  function makes it possible to generate complex SQL queries.

- :ref:`RECORDS <cobj-records>` can be used to reference specific data
  records. This is very helpful if the same text has to be present on all
  pages. By using RECORDS, a single content element can be defined and shown.
  Thus, an editor can edit the content without having to copy the element
  repetitively. This object is also used by the content element type "Insert
  records".

  In the following example, the email address from an address record is
  rendered and linked as email at the same time::

      page.80 = RECORDS
      page.80 {
         source = 1
         tables = tt_address
         conf.tt_address = COA
         conf.tt_address {
            20 = TEXT
            20.stdWrap.field = email
            20.stdWrap.typolink.parameter.field = email
         }
      }

- :ref:`HMENU <cobj-hmenu>` imports the page tree and offers
  comfortable ways to generate a menu of pages or a sitemap. Special menus
  include the breadcrumb trail, simple list of pages or subpages, a page
  browser (providing "Previous" and "Next" buttons for a set of pages) and a
  language selector.
