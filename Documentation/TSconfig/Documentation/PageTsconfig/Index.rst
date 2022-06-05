.. include:: /Includes.rst.txt
.. index:: ! Page TSconfig
.. _pagetsconfig:
.. _pagetoplevelobjects:

Page TSconfig Reference
-----------------------

The page TSconfig primarily concerns configuration of the modules in
the TYPO3 backend, the most important section is :ref:`mod <pagemod>`.

The TSconfig for a page is accumulated from the root and extends
to cover the whole branch of sub pages as well (unless values are
overridden further out).

Note that the page TSconfig can be overridden on a user and group basis by
user TSconfig again, for details, see section
:ref:`Overriding Page TSconfig in User TSconfig <userrelationshiptovaluessetinpagetsconfig>`.


.. toctree::
   :maxdepth: 5
   :titlesonly:

   Mod
   Options
   Rte
   TcaDefaults
   TceForm
   TceMain
   Templates
   Tx
