.. include:: /Includes.rst.txt
.. index:: HMENU; special = updated
.. _hmenu-special-updated:

=================
Updated HMENU
=================

An :ref:`HMENU <cobj-hmenu>` with the property :typoscript:`special = updated`
will create a menu of the most recently updated pages.

By default the most recently updated page is displayed on top.

Mount pages are supported.

.. contents::
   :local:

Properties
==========

.. _hmenu-special-updated-value:

special.value
--------------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         special.value

   Data type
         list of page ids /:ref:`stdWrap <stdwrap>`

   Description
         This will generate a menu of the most recently updated pages from the
         branches in the tree starting with the uid's (uid=35 and uid=56)
         listed.

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            20 = HMENU
            20.special = updated
            20.special.value = 35, 56

.. _hmenu-special-updated-mode:

special.mode
-------------

.. container:: table-row

   Property
         special.mode

   Data type
         string

   Default
         SYS\_LASTCHANGED

   Description
         The field in the database which should be used to get the information
         about the last update from.

         The following values are possible:

         **SYS\_LASTCHANGED:** Is updated to the youngest tstamp of the
         records on the page when a page is generated.

         **crdate:** Uses the "crdate"-field of the pagerecord.

         **tstamp:** Uses the "tstamp"-field of the pagerecord, which is set
         automatically when the record is changed.

         **manual** or **lastUpdated:** Uses the field "lastUpdated", which
         can be set manually in the page-record.

         **starttime:** Uses the starttime field.

         Fields with empty values are generally not selected.

.. _hmenu-special-updated-depth:

special.depth
-------------

.. container:: table-row

   Property
         special.depth

   Data type
         integer

   Default
         20

   Description
         Defines the tree depth.

         The allowed range is 1-20.

         A depth of 1 means only the start id, depth of 2 means start-id +
         first level.

         **Note:** "depth" is relative to "beginAtLevel".


.. _hmenu-special-updated-beginatlevel:

special.beginAtLevel
---------------------

.. container:: table-row

   Property
         special.beginAtLevel

   Data type
         integer

   Default
         0

   Description
         Determines starting level for the page trees generated based on .value
         and .depth.

         0 is default and includes the start id.

         1 starts with the first row of subpages,

         2 starts with the second row of subpages.

         **Note:** "depth" is relative to this property.


.. _hmenu-special-updated-maxage:

special.maxAge
---------------

.. container:: table-row

   Property
         special.maxAge

   Data type
         integer :ref:`+calc <objects-calc>`

   Description
         Only show pages, whose update-date *at most* lies this number of
         seconds in the past. Or with other words: Pages with update-dates
         older than the current time minus this number of seconds will not
         be shown in the menu no matter what.

         By default all pages are shown. You may use +-\*/ for calculations.

.. _hmenu-special-updated-limit:

special.limit
--------------

.. container:: table-row

   Property
         special.limit

   Data type
         integer

   Default
         10

   Description
         Maximal number of items in the menu. Default is 10, max is 100.


.. _hmenu-special-updated-excludenosearchpages:

special.excludeNoSearchPages
-----------------------------

.. container:: table-row

   Property
         special.excludeNoSearchPages

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, pages marked "No search" are not included.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = updated]

.. _hmenu-special-updated-examples:

Examples
=========

Recently updated pages styled with Fluid
-----------------------------------------

The content element :guilabel:`Recently Updated Pages` provided by the system
Extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

.. include:: /CodeSnippets/Menu/TypoScript/MenuRecentlyUpdated.rst.txt

The following Fluid template can be used to style the menu:

.. include:: /CodeSnippets/Menu/Template/MenuRecentlyUpdated.rst.txt
