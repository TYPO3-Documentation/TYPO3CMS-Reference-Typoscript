.. include:: ../Includes.txt

.. _pagetsconfig:
.. _pagetoplevelobjects:

Page TSconfig Reference
-----------------------

The page TSconfig primarily concerns configuration of the modules in
the TYPO3 backend, the most important section is :ref:`mod <pagemod>`.

The Page TSconfig for a page is accumulated from the root and extends
to cover the whole branch of subpages as well (unless values are
overridden further out).

Note that Page TSconfig can be overriden on a user and group basis by
User TSconfig again, for details, see section
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
   Tx
