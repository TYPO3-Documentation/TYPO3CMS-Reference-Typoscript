.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _top-level-objects-constants:
.. _constants:

=========
constants
=========


.. container:: table-row

   Property
         constants

   Data type
         ->CONSTANTS

   Description
         Site-specific constants, e.g. a general email address. These constants
         may be substituted in the text throughout the pages. The substitution
         is done by parseFunc (with .constants = 1 set).



CONSTANTS
=========

This object type can be used to define constants for replacement inside a
parseFunc. If parseFunc somewhere is configured with .constants = 1,
then all occurrences of the constant in the text will be substituted
with the actual value. This is useful, if you need one and the same
value at many places in your website. With constants, you can
maintain it easily.

.. note::

   The constants defined here are **not** the ones, which can be defined
   in the constants section of your template and which then in the setup
   section can be used as :ts:`{$myconstant}`. For these constants see
   :ref:`the according chapter :ref:`typoscript-syntax-what-are-constants`.

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ==================== =============================== ====================== =======
   Property             Data Type                       :ref:`stdwrap`         Default
   ==================== =============================== ====================== =======
   `(array of keys)`_   :ref:`data-type-string`
   ==================== =============================== ====================== =======

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###

.. _setup-constants-array-of-keys:

*(array of keys)*
"""""""""""""""""

.. container:: table-row

   Property
         *(array of keys)*

   Data type
         *(string)*

   Description
         Constants in the form *constants.key = value*.

         The "key" is the constant name, which you write in your texts. The
         "value" is the actual output, which you want to get in your website.

         **Examples:** ::

            constants.EMAIL = email@email.com

         If now parseFunc somewhere is configured with .constants = 1, then all
         occurrences of the string ###EMAIL### in the text will be substituted
         with the actual address.

         See :ref:`->parseFunc <parsefunc>`.



.. ###### END~OF~TABLE ######

