.. include:: /Includes.rst.txt
.. index::
   Content objects; Array
   Content objects; Content object array
   Content objects; COA
   Content objects; COA_INT
.. _cobj-cobj-array:
.. _cobj-coa:
.. _cobj-coa-int:

====================================
Content object array - COA, COA\_INT
====================================

.. note::

   * COA is an object type (= complex data type).
   * It is a specific :ref:`cObject <cobject>` data type.

COA stands for "content object array".

An object with the content type COA is a cObject, in which you
can place several other cObjects using numbers to enumerate them.

You can also create this object as a COA\_INT in which case it works
exactly like the :ref:`USER_INT <cobj-user-int>` object does: It's
rendered non-cached! That way you cannot only render non-cached
:ref:`USER_INT <cobj-user-int>` objects, but COA\_INT allows
you to render *every* cObject non-cached.

.. contents::
   :local:

.. ### BEGIN~OF~TABLE ###

Properties
==========

1,2,3,4...
-----------

.. container:: table-row

   Property
         1,2,3,4...

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Numbered properties to define the different cObjects, which should be
         rendered.

cache
-----

.. include:: ../../DataTypes/Properties/Cache.rst.txt

if
--

.. container:: table-row

   Property
         if

   Data type
         :ref:`->if <if>`

   Description
         If "if" returns false, the COA is **not** rendered.

stdWrap
-------

.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         Executed on all rendered cObjects after property wrap.

wrap
-----

.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wraps all rendered cObjects. Executed before property stdWrap.

.. ###### END~OF~TABLE ######


[tsref:(cObject).COA/(cObject).COA\_INT]


.. _cobj-cobj-array-examples:
.. _cobj-coa-examples:
.. _cobj-coa-int-examples:

Examples:
=========

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   lib.contentexample = COA
   lib.contentexample {
     10 = TEXT
     10.value = <h1>Header</h1>

     20 = CONTENT
     20 {
       table = tt_content
       select.orderBy = sorting
       select.where = {#colPos}=0
     }

     30 = TEXT
     30.value = <footer>Footer text</footer>
   }

The previous example will print a simple h1 header, followed by the page
content records and a footer element.

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   lib.currentDate = COA_INT
   lib.currentDate {
     10 = TEXT
     10.stdWrap.data = date:U
     10.stdWrap.strftime = %H:%M:%S
   }

This example will not be cached and so will display the current time
on each page hit.
