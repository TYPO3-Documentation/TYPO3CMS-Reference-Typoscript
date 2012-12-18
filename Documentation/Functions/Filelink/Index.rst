.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _filelink:

filelink
^^^^^^^^

Creates a list of file links. Input is a filename in the path "path".

icon, size and file are rendered in the listed order.

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
         path

   Data type
         path /stdWrap

   Description
         **Example:** ::

            path = "uploads/media/"


.. container:: table-row

   Property
         icon

   Data type
         boolean /stdWrap

   Description
         Set, if an icon should be shown.

         The filename of the icon used is the one of the filetype of the file
         given in "path" (see above) plus extension (by default gif). E.g. for
         CSS files the icon file "css.gif" will be used by default.

         If for a certain filetype no icon file is found in icon.path, the file
         "default" plus extension (e.g. "default.gif") will be used.

         Since TYPO3 4.7 the following sub-properties are available:

         **path:** Path to the icon set (default:
         typo3/gfx/fileicons/)

         **ext:** File extension of icons (default: gif)

         **widthAttribute:** Width of the icons in pixels (default: 18)

         **heightAttribute:** Height of the icons in pixels (default: 16)

         These sub-properties all have stdWrap available.


.. container:: table-row

   Property
         icon\_image\_ext\_list

   Data type
         *list of image extensions* /stdWrap

   Description
         This is a comma-separated list of those file extensions that should
         render as thumbnails instead of icons.


.. container:: table-row

   Property
         icon\_thumbSize

   Data type
         string /stdWrap

   Description
         Defines the size of the thumbnail in pixels.

         "icon" needs to be set for the option to take effect and the file
         extension of the image file must be part of "icon\_image\_ext\_list".

         You can set one or two values, see the examples. If you set two
         values, the first value will define the max width and the second one
         the max height. The aspect ratio of the original image will be
         preserved.

         **Examples:** ::

            icon_thumbSize = 150
            icon_thumbSize = 40x40


.. container:: table-row

   Property
         iconCObject

   Data type
         cObject

   Description
         Enter a cObject to use alternatively for the icons, e.g. IMAGE type.

         If this is set, it will substitute the use of the thumbs-script for
         display of thumbnails.


.. container:: table-row

   Property
         icon\_link

   Data type
         boolean

   Description
         Set if the icon should be linked as well.

   Default
         0


.. container:: table-row

   Property
         labelStdWrap

   Data type
         ->stdWrap

   Description
         stdWrap options for the label (by default the label is the filename)
         before being wrapped with the A-tags.

         Use this to e.g. import another label from a database field or such.


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description
         Wraps the links.


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
         file

   Data type
         ->stdWrap

   Description
         stdWrap of the label (by default the label is the filename) after
         having been wrapped with A-tag!


.. container:: table-row

   Property
         size

   Data type
         boolean /stdWrap

   Description
         Set if size should be shown


.. container:: table-row

   Property
         jumpurl

   Data type
         boolean

   Description
         Decides if the link should call the script with the jumpurl parameter
         in order to be able to register any clicks in statistics.

         This has the advantage that any clicks on the file can be registered
         in statistics.

         The disadvantage is, that users cannot right-click and select "Save
         Target As" in the browser.

         **Extra properties:**

         **.secure:** Boolean.

         If set, then the file pointed to by jumpurl is **not** redirected to,
         but rather it's read from the file and returned with a correct header.
         This option adds a hash and locationData to the URL and there MUST be
         access to the record in order to download the file. If the file
         position on the server is furthermore secured by a .htaccess file
         preventing ANY access, you've got secure download here!

         **.secure.mimeTypes:** List of MIME types.

         Syntax: [ext] = [MIME type]

         **.parameter:** String /stdWrap.

         By default the jumpurl link will use the current pid and typeNum.

         If you need alternative values (e.g. for logging) you can specify them
         here.

         For options see typolink.parameter.

         **Example:** ::

            jumpurl.secure = 1
            jumpurl.secure.mimeTypes = pdf=application/pdf, doc=application/msword


.. container:: table-row

   Property
         target

   Data type
         target /stdWrap

   Description
         Target for the <a>-tag.


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap


.. container:: table-row

   Property
         ATagParams

   Data type
         <A>-params /stdWrap

   Description
         Additional parameters

         **Example:**

         class="board"


.. container:: table-row

   Property
         removePrependedNumbers

   Data type
         boolean

   Description
         if set, any 2-digit prepended numbers ("eg \_23") in the filename is
         removed.


.. container:: table-row

   Property
         altText

         titleText

   Data type
         string /stdWrap

   Description
         For icons (image made with "iconCObject" must have their own
         properties)

         If no alttext is specified, it will use an empty alttext


.. container:: table-row

   Property
         emptyTitleHandling

   Data type
         string /stdWrap

   Description
         Value can be "keepEmpty" to preserve an empty title attribute, or
         "useAlt" to use the alt attribute instead.

   Default
         useAlt


.. container:: table-row

   Property
         longdescURL

   Data type
         string /stdWrap

   Description
         For icons (image made with "iconCObject" must have their own
         properties)

         "longdesc" attribute (URL pointing to document with extensive details
         about image).


.. ###### END~OF~TABLE ######

[tsref:->filelink]


.. _filelink-examples:

Example:
""""""""

::

       1.filelink {
         path = uploads/media/
         icon = 1
         icon.wrap = <td> | </td>
         size = 1
         size.wrap = <td> | </td>
         file.fontTag = {$styles.content.uploads.wrap}
         file.wrap = <td> | </td>
         jumpurl = 1
         target = _blank
         stdWrap = <tr> | </tr>
       }

