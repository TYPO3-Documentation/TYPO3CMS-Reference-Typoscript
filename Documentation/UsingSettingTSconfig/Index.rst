.. include:: /Includes.rst.txt
.. index::
   TSconfig; Setting
   TSconfig; Using
.. _typoscript-syntax-using-setting:

==========================
Using and setting TSconfig
==========================

This chapter gives an overview where TSconfig is set, how it
can be edited, and the load order of the different variants.

TSconfig can be used in page, it is then referred to as
"Page TSconfig", or for backend users and backend user groups,
in which case it is known as "User TSconfig".


..  card-grid::
    :columns: 1
    :columns-md: 2
    :gap: 4
    :class: pb-4
    :card-height: 100

    ..  card:: :ref:`Setting Page TSconfig <setting-page-tsconfig>`

        Lists different options of how to include Page TSconfig options.


    ..  card:: :ref:`Setting User TSconfig <setting-user-tsconfig>`

        Lists different options of how to include User TSconfig options.


    ..  card:: :ref:`Conditions <conditions>`

        Explains how Conditions can be used in TSconfig of both user and
        page.

    ..  card:: :ref:`PHP API <phpapi>`

        Explains how TSconfig can be retrieved from and used
        within the PHP code of backend modules.

.. toctree::
   :titlesonly:
   :hidden:

   PageTSconfig
   UserTSconfig
   Conditions
   PhpApi
