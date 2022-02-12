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


.. container:: row m-0 p-0

   .. container:: col-md-6 pl-0 pr-3 py-3 m-0

      .. container:: card px-0 h-100

         .. rst-class:: card-header h3

            .. rubric:: :ref:`Setting Page TSconfig <setting-page-tsconfig>`

         .. container:: card-body

            Lists different options of how to include Page TSconfig options.

   .. container:: col-md-6 pl-0 pr-3 py-3 m-0

      .. container:: card px-0 h-100

         .. rst-class:: card-header h3

            .. rubric:: :ref:`Setting User TSconfig <setting-page-tsconfig>`

         .. container:: card-body

            Lists different options of how to include User TSconfig options.

   .. container:: col-md-6 pl-0 pr-3 py-3 m-0

      .. container:: card px-0 h-100

         .. rst-class:: card-header h3

            .. rubric:: :ref:`Syntax <syntax>`

         .. container:: card-body

            A short introduction in the syntax of TSconfig and how it differs
            from TypoScript setup.

   .. container:: col-md-6 pl-0 pr-3 py-3 m-0

      .. container:: card px-0 h-100

         .. rst-class:: card-header h3

            .. rubric:: :ref:`Conditions <conditions>`

         .. container:: card-body

            Explains how Conditions can be used in TSconfig of both user and
            page.

   .. container:: col-md-6 pl-0 pr-3 py-3 m-0

      .. container:: card px-0 h-100

         .. rst-class:: card-header h3

            .. rubric:: :ref:`PHP API <phpapi>`

         .. container:: card-body

            Explains how TSconfig can be retrieved from and used
            within the PHP code of backend modules.

.. toctree::
   :titlesonly:
   :hidden:

   PageTSconfig
   UserTSconfig
   Syntax
   Conditions
   PhpApi
