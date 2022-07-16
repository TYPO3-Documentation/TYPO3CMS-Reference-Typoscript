.. include:: /Includes.rst.txt
.. index:: HMENU; special = categories
.. _hmenu-special-language:

special = language
------------------

Creates a language selector menu. Typically this is made as a menu
with flags for each language a page is translated to and when the user
clicks any element the translated page is hit.

The "language" type will create menu items based on the current page
record but with the language record for each language overlaid if
available.

Note on item states:

When "TSFE->sys\_language\_uid" matches the sys\_language uid for an
element the state is set to "ACT", otherwise "NO". However, if a page
is not available due to the pages "Localization settings" (which can
disable translations) or if no Alternative Page Language record was
found (can be disabled with ".normalWhenNoLanguage", see below) the
state is set to "USERDEF1" for non-active items and "USERDEF2" for
active items. So in total there are four states to create designs for.
It is recommended to disable the link on menu items rendered with
"USERDEF1" and "USERDEF2" in this case since they are disabled exactly
because a page in that language does not exist and might even issue an
error if tried accessed (depending on site configuration).

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         .. _hmenu-special-language-value:

         special.value

   Data type
         comma list of sys\_language uids /:ref:`stdWrap <stdwrap>` or `auto`

   Description
         The number of elements in this list determines the number of menu
         items. Setting to `auto` will include all available languages from
         the current site.


.. container:: table-row

   Property
         .. _hmenu-special-language-normalwhennolanguage:

         special.normalWhenNoLanguage

   Data type
         boolean

   Description
         If set to 1, the button for a language will be rendered as a non-
         disabled button even if no translation is found for the language.


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.special = language]


.. _hmenu-special-language-examples:

Example:
''''''''

Creates a language menu:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   lib.langMenu = HMENU
   lib.langMenu.special = language
   lib.langMenu.special.value = 0,1,2
   lib.langMenu.1 = TMENU

   lib.langMenu.1.NO = 1
   lib.langMenu.1.NO {
     doNotLinkIt = 1
     stdWrap.override = en || de || fr
     stdWrap.typolink {
         parameter.data = page:uid
         additionalParams = &L=0 || &L=1 || &L=2
         addQueryString = 1
         addQueryString.exclude = L,id
     }
   }

   lib.langMenu.1.ACT < lib.langMenu.1.NO
   lib.langMenu.1.ACT = 1
   lib.langMenu.1.ACT.stdWrap.typolink.ATagParams = class="active"
