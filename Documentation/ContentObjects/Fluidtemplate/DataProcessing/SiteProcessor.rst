.. include:: /Includes.txt
.. _SiteProcessor:

=============
SiteProcessor
=============

The :php:`SiteProcessor` fetches data from the :ref:`site<t3coreapi:sitehandling>`
configuration.


Options:
========

.. rst-class:: dl-parameters

as
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string
   :sep:`|` :aspect:`Default:` "site"
   :sep:`|`

   The variable's name to be used in the Fluid template


Example
=======

Using the :php:`SiteProcessor` the following scenario is possible::


   10 = TYPO3\CMS\Frontend\DataProcessing\SiteProcessor
   10 {
      as = site
   }

In the Fluid template the properties of the site configuration can be accessed:

.. code-block:: html

   <p>{site.rootPageId}</p>
   <p>{site.someCustomConfiguration}</p>
