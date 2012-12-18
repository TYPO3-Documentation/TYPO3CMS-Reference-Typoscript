.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _tmenuitem:

TMENUITEM
^^^^^^^^^

The current record is the page-record of the menu item - just like you
have it with GMENU/gifbuilder. Now, if you would like to get data from
the current page record, use stdWrap.data = page : [field name].

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         allWrap

   Data type
         wrap /stdWrap

   Description
         Wraps the whole item.


.. container:: table-row

   Property
         wrapItemAndSub

   Data type
         wrap /stdWrap

   Description
         Wraps the whole item and any submenu concatenated to it.


.. container:: table-row

   Property
         subst\_elementUid

   Data type
         boolean

   Description
         If set, all appearances of the string '{elementUid}' in the total
         element HTML code (after wrapped in .allWrap} are substituted with the
         uid number of the menu item.

         This is useful if you want to insert an identification code in the
         HTML in order to manipulate properties with JavaScript.

   Default
         0


.. container:: table-row

   Property
         RO\_chBgColor

   Data type
         string

   Description
         If property RO is set (see below) then you can set this property to a
         certain set of parameters which will allow you to change the
         background color of e.g. the table cell when the mouse rolls over your
         text-link.

         **Syntax:** ::

            [over-color] | [out-color] | [id-prefix]

         **Example:** ::

            page = PAGE
            page.typeNum = 0
            page.10 = HMENU
            page.10.wrap = <table>|</table>
            page.10.1 = TMENU
            page.10.1.NO {
              allWrap = <tr><td id="tmenu{elementUid}" style="background: #eeeeee;">|</td></tr>
              subst_elementUid = 1
              RO_chBgColor = #cccccc | #eeeeee | tmenu
              RO = 1
            }

         This example will start out with the table cells in #eeeeee and change
         them to #cccccc (and back) when rolled over. The "tmenu" string is a
         unique id for the menu items. You may not need it (unless the same
         menu items are more than once on a page), but the important thing is
         that the id of the table cell has the exact same label before the
         {elementUid} (red marks). The other important thing is that you DO set
         a default background color for the cell with the style-attribute (blue
         marking). If you do not, Mozilla browsers will behave a little strange
         by not capturing the mouseout event the first time it's triggered.


.. container:: table-row

   Property
         before

   Data type
         HTML /stdWrap


.. container:: table-row

   Property
         beforeImg

   Data type
         imgResource


.. container:: table-row

   Property
         beforeImgTagParams

   Data type
         <img>-params


.. container:: table-row

   Property
         beforeImgLink

   Data type
         boolean

   Description
         If set, this image is linked with the same <A> tag as the text


.. container:: table-row

   Property
         beforeROImg

   Data type
         imgResource

   Description
         If set, ".beforeImg" and ".beforeROImg" is expected to create a
         rollOver-pair.


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

   Description
         If set, the link is first wrapped with "*.wrap*" and then the
         <A>-tag.

   Default
         0


.. container:: table-row

   Property
         ATagParams

   Data type
         *<A>-params* /stdWrap

   Description
         Additional parameters

         **Example:** ::

            class="board"


.. container:: table-row

   Property
         ATagTitle

   Data type
         string /stdWrap

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
         string /stdWrap

   Description
         Define parameters that are added to the end of the URL. This must be
         code ready to insert after the last parameter.

         For details, see typolink->additionalParams


.. container:: table-row

   Property
         doNotLinkIt

   Data type
         boolean /stdWrap

   Description
         If set, the linktexts are not linked at all!

   Default
         0


.. container:: table-row

   Property
         doNotShowLink

   Data type
         boolean /stdWrap

   Description
         If set, the text will not be shown at all (smart with spacers).

   Default
         0

.. container:: table-row

   Property
         stdWrap2

   Data type
         wrap /stdWrap

   Description
         stdWrap to the total link-text and ATag. (Notice that the plain
         default value passed to the stdWrap function is "\|".)

   Default
         \|


.. container:: table-row

   Property
         RO

   Data type
         boolean

   Description
         If set, rollOver is enabled for this link


.. container:: table-row

   Property
         after...

   Data type
         [mixed]

   Description
         The series of "before..." properties is duplicated to "after..."
         properties as well. The only difference is that the output generated
         by the .after.... properties are placed after the link and not before.


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

