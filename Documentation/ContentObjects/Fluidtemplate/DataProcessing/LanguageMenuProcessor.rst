.. include:: /Includes.txt
.. _LanguageMenuProcessor:

=====================
LanguageMenuProcessor
=====================

The :php:`LanguageMenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu
string based on the site language configuration that will be decoded again
and assigned to :ts:`FLUIDTEMPLATE` as variable.

Options:

:`if`:         TypoScript if condition
:`languages`:  A list of comma separated language IDs (e.g. 0,1,2) to use
               for the menu creation or `auto` to load from site languages
:`as`:         The variable to be used within the result


Using the :php:`LanguageMenuProcessor` the following scenario is possible::

   10 = TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor
   10 {
      languages = auto
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

