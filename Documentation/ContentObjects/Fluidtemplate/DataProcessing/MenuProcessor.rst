.. include:: /Includes.txt
.. _MenuProcessor:

=============
MenuProcessor
=============

The :php:`MenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu string
that will be decoded again and assigned to :ts:`FLUIDTEMPLATE` as variable.
Additional data processing is supported and will be applied to each record.

Using the :php:`MenuProcessor` the following scenario is possible::

   10 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
   10 {
      special = directory
      special.value = <parent page uid>
      levels = 2
      as = headerMenu
      expandAll = 1
      includeSpacer = 1
      titleField = nav_title // title
   }

This generated menu can be used in Fluid like that:

.. code-block:: html

   <nav>
      <ul class="header_navigation">
         <f:for each="{headerMenu}" as="menuItem">
            <li class="{f:if(condition:'{menuItem.active}',then:'active')}">
               <f:link.page pageUid="{menuItem.uid}">{menuItem.title}</f:link.page>
            </li>
         </f:for>
      </ul>
   </nav>
