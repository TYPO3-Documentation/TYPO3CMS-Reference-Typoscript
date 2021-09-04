.. include:: /Includes.rst.txt
.. index:: Content objects; EDITPANEL
.. _cobj-editpanel:

=========
EDITPANEL
=========

.. deprecated:: 11.4
   With the extraction of the :file:`feedit` extension from TYPO3 Core in v10
   this related TypoScript property have been rendered unused. Extensions that
   provide a frontend editing approach should implement this on their own.


.. _cobj-editpanel_migration:

Migration
=========

Frontend editing related extensions like EXT:feedit and EXT:frontend_editing
should no longer rely on Core provided preparation. The stdWrap functionality
can be integrated with stdWrap related hooks, the `EDITPANEL` cObj can be
registered as extension provided content object, which obsoletes the use of the
:php:`typo3/classes/class.frontendedit.php` hook.
