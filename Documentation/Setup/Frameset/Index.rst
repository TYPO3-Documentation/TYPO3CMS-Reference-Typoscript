.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: /Includes.rst.txt


.. _frameset:

FRAMESET
========

FRAME is an object type.

.. attention::

   FRAME, FRAMESET and frameSet have been deprecated in version 8.5
   of the TYPO3 core. Using this is no longer considered good practice.

   Additionally, frameset and frame are no longer supported in HTML

   See `Deprecation: #78217 - frameset and frame <https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/8.5/Deprecation-78217-FramesetAndFrame.html>`__
   (8.5 Changelog).



Properties
^^^^^^^^^^

.. container:: ts-properties

   ============= ==================== ====================== =======
   Property      Data Type            :ref:`stdwrap`         Default
   ============= ==================== ====================== =======
   `1,2,3,4...`_ frameObj
   `cols`_       <frameset>-data:cols
   `params`_     <frameset>-params
   `rows`_       <frameset>-data:rows
   ============= ==================== ====================== =======

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###


.. _setup-frameset-1-2-3-4:

1,2,3,4...
""""""""""

.. container:: table-row

   Property
         1,2,3,4...

   Data type
         frameObj

   Description
         Configuration of frames and nested framesets.



.. _setup-frameset-cols:

cols
""""

.. container:: table-row

   Property
         cols

   Data type
         <frameset>-data:cols

   Description
         Cols



.. _setup-frameset-params:

params
""""""

.. container:: table-row

   Property
         params

   Data type
         <frameset>-params

   Description
         **Example:**

         border="0" framespacing="0" frameborder="NO"



.. _setup-frameset-rows:

rows
""""

.. container:: table-row

   Property
         rows

   Data type
         <frameset>-data:rows

   Description
         Rows



.. ###### END~OF~TABLE ######

