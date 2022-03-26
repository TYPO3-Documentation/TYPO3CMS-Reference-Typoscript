.. include:: /Includes.rst.txt


.. _carray:

carray
======

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ========================== =========== ====================== =======
   Property                   Data Type   :ref:`stdwrap`         Default
   ========================== =========== ====================== =======
   `(stdWrap properties...)`_ ->stdWrap
   `(TDParams)`_              <TD>-params
   `1,2,3,4...`_              cObject
   ========================== =========== ====================== =======

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###


.. _setup-carray-stdwrap-properties:

(stdWrap properties...)
"""""""""""""""""""""""

.. container:: table-row

   Property
         (stdWrap properties...)

   Data type
         ->stdWrap

   Description
         **Note:** This applies ONLY if "CARRAY /:ref:`stdWrap <stdwrap>`" is
         set to be data type.

         If you specify any non-integer properties to a CARRAY, stdWrap will be
         invoked with all properties of the CARRAY.

         **Example:** ::

            10 = TEXT
            10.value = testing

            5 = TEXT
            5.value = This will be rendered before "10"

            wrap = <b>|</b>

         This will return '<b>This will be rendered before "10"testing</b>'.



.. _setup-carray-tdparams:

(TDParams)
""""""""""

.. container:: table-row

   Property
         (TDParams)

   Data type
         <TD>-params

   Description
         **Note:** This applies ONLY if "CARRAY +TDParams" is set to be data
         type.

         This property is used only in some cases where CARRAY is used. Please
         look out for a note about that in the various cases.



.. _setup-carray-1-2-3-4:

1,2,3,4...
""""""""""

.. container:: table-row

   Property
         1,2,3,4...

   Data type
         cObject

   Description
         This is a numerical "array" of content objects (cObjects). The order
         in which you specify the objects is not important as the array will
         be sorted numerically before it's parsed!


.. ###### END~OF~TABLE ######
