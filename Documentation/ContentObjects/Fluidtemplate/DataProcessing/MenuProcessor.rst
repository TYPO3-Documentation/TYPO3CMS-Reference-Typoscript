.. include:: /Includes.txt
.. _MenuProcessor:

=============
MenuProcessor
=============


The :php:`MenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu string
that will be decoded again and assigned to :ts:`FLUIDTEMPLATE` as variable.
Additional data processing is supported and will be applied to each record.

Options:
========

.. confval:: levels

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: 1
   :Example: 5

   Maximal number of levels to be included in the output array


.. confval:: expandAll

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: 1
   :Example: 0

   Should all submenus be included or only those of the active pages?

.. confval:: includeSpacer

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: 0
   :Example: 1

   Include pages with type "spacer"

.. confval:: titleField

   :Required: true
   :type: int, :ref:`stdWrap`
   :default: "nav_title // title"
   :Example: "subtitle"

   Fields to be used as title

.. confval:: as

   :Required: false
   :type: string
   :default: "menu"

   Name the variable in the Fluid template will have

.. important:: 
   
   Additionally all :ref:`HMENU options <cobj-hmenu-options>` are available.


Example: Menu of all language from site configuration
=====================================================

Using the :php:`MenuProcessor` the following scenario is possible::

   10 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
   10 {
       special = list
       special.value.field = pages
       levels = 7
       as = myMenu
       expandAll = 1
       includeSpacer = 1
       titleField = nav_title // subtitle // title
       dataProcessing {
           10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
           10 {
                references.fieldName = media
           }
       }
   }

This generated menu can be used in Fluid like that:

.. code-block:: html

   <nav>
      <ul class="header_navigation">
         <f:for each="{myMenu}" as="menuItem">
            <li class="{f:if(condition:'{menuItem.active}',then:'active')}">
               <f:if condition="{menuItem.media.0}">
                  <a href="{menuItem.media.0.publicUrl}">{menuItem.media.0.name}</a>
               </f>
               <f:link.page pageUid="{menuItem.uid}">{menuItem.title}</f:link.page>
            </li>
         </f:for>
      </ul>
   </nav>
