.. include:: /Includes.txt
.. _LanguageMenuProcessor:

=====================
LanguageMenuProcessor
=====================

This menu processor generates a json encoded menu string that will be
decoded again and assigned to the :ts:`FLUIDTEMPLATE` as variable.


Options:
========

.. confval:: if

   :Required: false
   :type: :ref:`if` condition
   :default: ""

   If the condition is not met the data is not processed

.. confval:: languages

   :Required: true
   :type: string, :ref:`stdWrap`
   :default: "auto"
   :Example: "0,1,2"

   A list of comma separated language IDs (e.g. 0,1,2) to use
   for the menu creation or `auto` to load from site configuration

.. confval:: as

   :Required: false
   :type: string
   :default: defaults to the fieldName

   The variable's name to be used in the Fluid template


Example: Menu of all language from site configuration
=====================================================

Using the :php:`LanguageMenuProcessor` the following scenario is possible::

   10 = TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor
   10 {
      languages = 0,1,2
      as = languageNavigation
   }

This generated menu can be used in Fluid like this:

.. code-block:: html

   <f:if condition="{languageNavigation}">
      <ul id="language" class="language-menu">
         <f:for each="{languageNavigation}" as="item">
            <li class="{f:if(condition: item.active, then: 'active')}
                       {f:if(condition: item.available, else: ' text-muted')}">
               <f:if condition="{item.available}">
                  <f:then>
                     <a href="{item.link}" hreflang="{item.hreflang}"
                        title="{item.navigationTitle}">
                        <span>{item.navigationTitle}</span>
                     </a>
                  </f:then>
                  <f:else>
                     <span>{item.navigationTitle}</span>
                  </f:else>
               </f:if>
            </li>
         </f:for>
      </ul>
   </f:if>

