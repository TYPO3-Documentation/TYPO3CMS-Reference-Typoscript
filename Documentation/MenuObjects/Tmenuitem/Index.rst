.. include:: ../../Includes.txt
.. index:: TMENU; TMENUITEM
.. _tmenuitem:

=========
TMENUITEM
=========

The current record is the page-record of the menu item. Now, if you would
like to get data from the current menu item's page record, use
stdWrap.data = field : [field name].

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         allWrap

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the whole item.


.. container:: table-row

   Property
         wrapItemAndSub

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the whole item and any submenu concatenated to it.


.. container:: table-row

   Property
         subst\_elementUid

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, all appearances of the string '{elementUid}' in the total
         element HTML code (after wrapped in .allWrap} are substituted with the
         uid number of the menu item.

         This is useful if you want to insert an identification code in the
         HTML in order to manipulate properties with JavaScript.



.. container:: table-row

   Property
         before

   Data type
         HTML /:ref:`stdWrap <stdwrap>`


.. container:: table-row

   Property
         beforeWrap

   Data type
         wrap

   Description
         wrap around the ".before"-code


.. container:: table-row

   Property
         linkWrap

   Data type
         wrap


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         stdWrap to the link-text!


.. container:: table-row

   Property
         ATagBeforeWrap

   Data type
         boolean

   Default
         0 (false)

   Description
         If set, the link is first wrapped with "*.linkWrap*" and then the
         <A>-tag.



.. container:: table-row

   Property
         ATagParams

   Data type
         *<A>-params* /:ref:`stdWrap <stdwrap>`

   Description
         Additional parameters

         **Example:** ::

            class="board"


.. container:: table-row

   Property
         ATagTitle

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Allows you to specify the "title" attribute of the <a> tag around the
         menu item.

         **Example:** ::

            ATagTitle.field = abstract // description

         This would use the abstract or description field for the <a title="">
         attribute.


.. container:: table-row

   Property
         additionalParams

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Define parameters that are added to the end of the URL. This must be
         code ready to insert after the last parameter.

         For details, see typolink->additionalParams


.. container:: table-row

   Property
         doNotLinkIt

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         If set, the linktexts are not linked at all!



.. container:: table-row

   Property
         doNotShowLink

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Default
         0

   Description
         If set, the text will not be shown at all (smart with spacers).



.. container:: table-row

   Property
         stdWrap2

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Default
         \|

   Description
         stdWrap to the total link-text and ATag. (Notice that the plain
         default value passed to the stdWrap function is "\|".)



.. container:: table-row

   Property
         altTarget

   Data type
         target

   Description
         Alternative target overriding the target property of the TMENU if set.


.. container:: table-row

   Property
         allStdWrap

   Data type
         ->stdWrap

   Description
         stdWrap of the whole item


.. ###### END~OF~TABLE ######

[tsref:(cObject).HMENU.(mObj).TMENUITEM]

