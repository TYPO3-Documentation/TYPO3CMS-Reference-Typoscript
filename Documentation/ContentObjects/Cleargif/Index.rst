.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-cleargif:

CLEARGIF
^^^^^^^^

.. note::

   This content object has been deprecated in TYPO3 CMS 7.1. If you still use it
   for now, you need to install the system extension "compatibility6". In the
   long run, you are advised to migrate to alternatives such as FLUIDTEMPLATE to
   customize the output of the content.

Inserts a transparent gif-file.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         height

   Data type
         *<img>-data:height* /:ref:`stdWrap <stdwrap>`

   Description
         Height of the image.

   Default
         1


.. container:: table-row

   Property
         width

   Data type
         *<img>-data:width* /:ref:`stdWrap <stdwrap>`

   Description
         Width of the image.

   Default
         1


.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Default
         \|<br />


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`

   Description
         (Executed after ".wrap".)


.. ###### END~OF~TABLE ######

[tsref:(cObject).CLEARGIF]


.. _cobj-cleargif-examples:

Example:
""""""""

::

       20 = CLEARGIF
       20.height = 20

