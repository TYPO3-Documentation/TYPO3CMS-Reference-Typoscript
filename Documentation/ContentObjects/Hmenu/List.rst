.. include:: /Includes.rst.txt
.. index:: HMENU; special = list
.. _hmenu-special-list:

special = list
--------------

A HMENU of type special = list lets you create a menu that lists the
pages you define in the property ".value".

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-list-value:

         value

   Data type
         list of page ids /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         This will generate a menu with the two pages (uid=35 and uid=56)
         listed:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            20 = HMENU
            20.special = list
            20.special.value = 35, 56

         If .value is not set, the default uid is 0, so that only your homepage
         will be listed.



.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = list]
