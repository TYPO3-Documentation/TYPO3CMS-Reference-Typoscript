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

.. rst-class:: dl-parameters

levels
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` int, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` 1
   :sep:`|` :aspect:`Example:` 5
   :sep:`|`

Maximal number of levels to be included in the output array


expandAll
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` int, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` 1
   :sep:`|` :aspect:`Example:` 0
   :sep:`|`

Should all submenus be included or only those of the active pages?

includeSpacer
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` int, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` 0
   :sep:`|` :aspect:`Example:` 1
   :sep:`|`

Include pages with type "spacer"

titleField
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` int, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` "nav_title // title"
   :sep:`|` :aspect:`Example:` "subtitle"
   :sep:`|`

Fields to be used as title

as
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string
   :sep:`|` :aspect:`Default:` "menu"
   :sep:`|`

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
