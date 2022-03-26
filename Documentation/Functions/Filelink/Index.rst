.. include:: /Includes.rst.txt



.. _filelink:

filelink
========

:aspect:`Function:`
   filelink

:aspect:`Description:`
   Creates a list of file links. Input is a filename specified in :typoscript:`path`.
   icon, size and file are rendered in the listed order.

:aspect:`Overview:`
   ::

      1.filelink {
         altText =
         ATagBeforeWrap =
         ATagParams =
         emptyTitleHandling =
         file =
         icon =
         icon_link =
         icon_image_ext_list =
         icon_thumbSize =
         iconCObject =
         labelStdWrap =
         longdescURL =
         path =
         removePrependedNumbers =
         size = =
         stdWrap =
         target =
         # titleText ?
         titleText =
         typolinkConfiguration =
         wrap =
      }

altText
-------

:aspect:`Property:`
   altText

:aspect:`Data type:`
   string /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   For icons (image made with "iconCObject" must have their own
   properties). If no alttext is specified, it will use an empty alttext



ATagBeforeWrap
--------------

:aspect:`Property:`
   ATagBeforeWrap

:aspect:`Data type:`
   boolean

:aspect:`Description:`
   If set, the link is first wrapped with "*.wrap*" and then the <A>-tag.

:aspect:`Default:`
   0



ATagParams
----------

:aspect:`Property:`
   ATagParams

:aspect:`Data type:`
   <A>-params /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   Additional parameters

:aspect:`Example:`
   `class="board"`



emptyTitleHandling
------------------

:aspect:`Property:`
   emptyTitleHandling

:aspect:`Data type:`
string /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   Value can be :typoscript:`keepEmpty` to preserve an empty title attribute or
   :typoscript:`useAlt` to use the alt attribute instead.

:aspect:`Default:`
   :typoscript:`useAlt`



file
----

:aspect:`Property:`
   file

:aspect:`Data type:`
   ->stdWrap

:aspect:`Description:`
   stdWrap of the label (by default the label is the filename) after
   having been wrapped with A-tag!



icon
----

:aspect:`Property:`
   icon

:aspect:`Data type:`
   :ref:`boolean <data-type-bool>`/:ref:`stdWrap <stdwrap>`

:aspect:`Overview:`
   ::

      1.filelink {
         icon = 1
         icon.path =
         icon.ext =
         icon.widthAttribute =
         icon.heightAttribute =
         icon.stdWrap {
            # ...
         ]
      }


:aspect:`Description:`
   Set, if an icon should be shown.

   The filename of the icon used is the one of the filetype of the file
   given in path_ (see above) plus extension (by default :file:`.gif`).
   For example for CSS files the icon file :file:`css.gif` will be used
   by default.
   If for a certain filetype no icon file is found in :typoscript:`icon.path`, the file
   :file:`default` plus extension (for example :file:`default.gif`) will be used.

   The following sub-properties are available and have stdWrap functionality:

   -  :typoscript:`path`:
            Path to the icon set.
            Default is :file:`typo3/sysext/frontend/Resources/Public/Icons/FileIcons/`.

   -  :typoscript:`ext`: File extension of icons. Default is :file:`.gif`.

   -  :typoscript:`widthAttribute`: Width of the icons in pixels. Default: 18

   -  :typoscript:`heightAttribute` Height of the icons in pixels. Default: 16



icon\_link
----------

:aspect:`Property:`
   icon\_link

:aspect:`Data type:`
   boolean

:aspect:`Description:`
   Set if the icon should be linked as well.

:aspect:`Default:`
   0



icon\_image\_ext\_list
----------------------

:aspect:`Property:`
   icon\_image\_ext\_list

:aspect:`Data type:`
   *list of image extensions* /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   This is a comma-separated list of those file extensions that should
   render as thumbnails instead of icons.



icon\_thumbSize
---------------

:aspect:`Property:`
   icon\_thumbSize

:aspect:`Data type:`
   string /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   Defines the size of the thumbnail in pixels.

   :typoscript:`icon` needs to be set for the option to take effect and the file
   extension of the image file must be part of :typoscript:`icon_image_ext_list`.
   You can set one or two values, see the examples. If you set two
   values, the first value will define the maximum width and the second
   one the maximum height. The aspect ratio of the original image will be
   preserved.

:aspect:`Examples:`
   ::

      icon_thumbSize = 150
      icon_thumbSize = 40x40



iconCObject
-----------

:aspect:`Property:`
   iconCObject

:aspect:`Data type:`
   cObject

:aspect:`Description:`
   Enter a cObject to use alternatively for the icons, for example IMAGE type.
   If this is set, it will substitute the use of the thumbs-script for
   display of thumbnails.



labelStdWrap
------------

:aspect:`Property:`
   labelStdWrap

:aspect:`Data type:`
   ->stdWrap

:aspect:`Description:`
   stdWrap options for the label (by default the label is the filename)
   before being wrapped with the A-tags.
   Use this to for example import another label from a database field or such.



longdescURL
-----------

:aspect:`Property:`
   longdescURL

:aspect:`Data type:`
   string /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   For icons (image made with "iconCObject" must have their own
   properties).
   "longdesc" attribute (URL pointing to document with extensive details
   about image).



path
----

:aspect:`Property:`
   path

:aspect:`Data type:`
   path /:ref:`stdWrap <stdwrap>`

:aspect:`Example:`
   :typoscript:`path = "uploads/media/`



removePrependedNumbers
----------------------

:aspect:`Property:`
   removePrependedNumbers

:aspect:`Data type:`
   boolean

:aspect:`Description:`
   If set, any 2-digit *appended(!)* numbers in the filename are removed.

:aspect:`Example:`
   If set, :file:`filename_23.gif` becomes :file:`filename.gif`.



size
----

:aspect:`Property:`
   size

:aspect:`Data type:`
   boolean /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   Set if size should be shown



stdWrap
-------

:aspect:`Property:`
   stdWrap

:aspect:`Data type:`
   ->stdWrap



target
------

:aspect:`Property:`
   target

:aspect:`Data type:`
   target /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   Target for the <a>-tag.



titleText
---------
?




typolinkConfiguration
---------------------

:aspect:`Property:`
   typolinkConfiguration

:aspect:`Data type:`
   :ref:`->typolink <typolink>`

:aspect:`Description:`
   This property can be used to pass additional typolink settings for
   the generated file link.
   Please note that the following properties will be ignored because they are
   set by the filelink function:
   :typoscript:`ATagParams`,
   :typoscript:`fileTarget`,
   :typoscript:`parameter`,
   :typoscript:`title`.



wrap
----

:aspect:`Property:`
   wrap

:aspect:`Data type:`
   wrap /:ref:`stdWrap <stdwrap>`

:aspect:`Description:`
   Wraps the links.



.. _filelink-examples:

Filelink Example
================

::

   1.filelink {
      path = uploads/media/
      icon = 1
      icon.wrap = <td> | </td>
      size = 1
      size.wrap = <td> | </td>
      file.wrap = <td> | </td>
      target = _blank
      stdWrap = <tr> | </tr>
   }

