.. include:: /Includes.rst.txt
.. index:: HMENU; special = directory
.. _hmenu-special-directory:

special = directory
-------------------

A HMENU of type special = directory lets you create a menu listing the
subpages of one or more parent pages. The parent pages are defined in
the property ".value". It is usually used for sitemaps.

Mount pages are supported.

.. ### BEGIN~OF~TABLE ###

.. _hmenu-special-directory-value:

special.value
-------------

.. container:: table-row


Property
special.value

Data type
list of page ids /:ref:`stdWrap <stdwrap>`

    Default
    current page id

    Description
    This will generate a menu of all pages with pid = 35 and pid = 56.

    .. code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    20 = HMENU
    20.special = directory
    20.special.value = 35, 56



    .. ###### END~OF~TABLE ######

    [tsref:(cObject).HMENU.special = directory]
