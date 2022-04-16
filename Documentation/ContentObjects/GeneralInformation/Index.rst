.. include:: /Includes.rst.txt
.. index:: Content objects; General
.. _cobjects-general-information:

=====================================
Content objects (general information)
=====================================

.. index:: Content objects; PHP
.. _cobjects-php:

PHP information
===============

The content objects (data type: cObject) are primarily controlled by the PHP-
script :file:`typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php`.
The PHP-class is named :php:`ContentObjectRenderer` and often this is also
the variable-name of the objects (:php:`$cObj`).

The $cObj in PHP has an array, :php:`$this->data`, which holds records of
various kind. See data type :ref:`"getText" <data-type-gettext>`.

This record is normally "loaded" with the record from a table
depending on the situation. Say if you are creating a menu it's often
loaded with the page-record of the actual menu item or if it's about
content-rendering it will be the content-record.


.. index:: Content objects; Reusing
.. _reusing-cobjects:

Reusing content objects
=======================

When dealing with "cObjects", you're allowed to use a special syntax
in order to reuse cObjects without actually creating a copy. This has
the advantage of minimizing the size of the cached template. But on
the other hand it does not give you the flexibility of overriding
values.

This example will show you how it works:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   #
   # Temporary objects are defined:
   #
   lib.stdheader = COA
   lib.stdheader {
     stdWrap.wrapAlign.field = header_position
     stdWrap.typolink.parameter.field = header_link
     stdWrap.fieldRequired = header

     1 = TEXT
     1.stdWrap.current = 1

     stdWrap.space = {$content.headerSpace}
   }


   #
   # CType: header
   #
   tt_content.header = COA
   tt_content.header {
     10 < lib.stdheader
     10.stdWrap.space >

     20 = TEXT
     20.stdWrap.field = subheader
   }


   #
   # CType: bullet
   #
   tt_content.bullets = COA
   tt_content.bullets {
     10 = < lib.stdheader
     20 < styles.content.bulletlist_gr
   }

First :typoscript:`lib.stdheader` is defined. This is (and must be) a cObject! (In
this case it is :ref:`COA <cobj-coa>`.)

Now :typoscript:`lib.stdheader` is copied to :typoscript:`tt_content.header.10` with the
":typoscript:`<`" operator. This means that an actual copy of :typoscript:`lib.stdheader` is
created at *parsetime*.

But this is not the case with :typoscript:`tt_content.bullets.10`. Here
:typoscript:`lib.stdheader` is just pointed to and :typoscript:`lib.stdheader` will be used as the
cObject at *runtime*.

The reason why lib.stdheader was copied in the first case is the fact
that it's needed to unset ".stdWrap.space" inside the cObject
(:typoscript:`10.stdWrap.space >`). This could **not** be done in the second case
where only a pointer is created.


.. _reusing-cobjects-temp-objects:

Note:
-----

If :typoscript:`lib.stdheader` was :typoscript:`temp.stdheader` instead, the pointer would
not work! This is due to the fact that the runtime-reference would
find nothing in `temp.` as this is unset before the template is stored
in cache!

This goes for :typoscript:`temp.` and :typoscript:`styles.` (see the top-level object
definition elsewhere).

Overriding values anyway:

Although you cannot override values TypoScript-style (using the
operators and all) the properties of the object which has the
reference will be merged with the configuration of the reference.


.. _reusing-cobjects-examples:

Example:
--------

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.10 = TEXT
   page.10.value = kasper
   page.10.stdWrap.case = upper

   page.20 = < page.10
   page.20.stdWrap.case = lower
   page.20.value >
   page.20.stdWrap.field = pages

The result is this configuration:

.. include:: /Images/ManualScreenshots/FrontendOutput/StdWrap/ContentObjectsExampleMerge1.rst.txt

Notice that :typoscript:`.value` was *not* cleared, because it's simply two arrays
which are joined:

.. include:: /Images/ManualScreenshots/FrontendOutput/StdWrap/ContentObjectsExampleMerge2.rst.txt

So hence the line :typoscript:`page.20.value >` in the above example is useless.
