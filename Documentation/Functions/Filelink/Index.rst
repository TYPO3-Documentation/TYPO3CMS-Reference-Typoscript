.. include:: ../../Includes.txt



.. _filelink:

========
filelink
========

:aspect:`Function:`
   filelink

:aspect:`Description:`
   Creates a list of file links. Input is a filename specified in
   :ref:`filelink-path`.
   :ref:`filelink-icon`, :ref:`filelink-size` and :ref:`filelink-file`
   are rendered in the listed order.

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

.. _filelink-alttext:

altText
=======

:aspect:`Property:`
   altText

:aspect:`Data type:`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description:`
   For icons (image made with :ref:`filelink-iconCObject` must have their own properties).
   If no :ref:`filelink-altText` is specified, it will use an empty :ref:`filelink-altText`.



.. _filelink-atagbeforewrap:

ATagBeforeWrap
==============

:aspect:`Property:`
   ATagBeforeWrap

:aspect:`Data type:`
   :ref:`data-type-boolean`

:aspect:`Description:`
   If set, the link is first wrapped with :ref:`filelink-wrap` and then the :html:`<A>`-tag.

:aspect:`Default:`
   0



.. _filelink-atagparams:

ATagParams
==========

:aspect:`Property:`
   ATagParams

:aspect:`Data type:`
   <A>-params / :ref:`stdwrap`

:aspect:`Description:`
   Additional parameters

:aspect:`Example:`
   `class="board"`



.. _filelink-emptytitlehandling:

emptyTitleHandling
==================

:aspect:`Property:`
   emptyTitleHandling

:aspect:`Data type:`
    :ref:`data-type-string` /:ref:`stdwrap`

:aspect:`Description:`
   Value can be "keepEmpty" to preserve an empty title attribute or
   "useAlt" to use the alt attribute instead.

:aspect:`Default:`
   :ts:`useAlt`



.. _filelink-file:

file
====

:aspect:`Property:`
   file

:aspect:`Data type:`
   :ref:`stdwrap`

:aspect:`Description:`
   stdWrap of the label (by default the label is the filename) after
   having been wrapped with A-tag!



.. _filelink-icon:

icon
====

:aspect:`Property:`
   icon

:aspect:`Data type:`
   :ref:`data-type-boolean` / :ref:`stdwrap`

:aspect:`Overview:`
   ::

      1.filelink {
          icon = 1
          icon {
              path =
              ext =
              widthAttribute =
              heightAttribute =
              stdWrap {
                  # ...
              }
          }
      }


:aspect:`Description:`
   Set, if an icon should be shown.

   The filename of the icon used is the one of the filetype of the file
   given in :ts:`path` (see above) plus extension (by default :file:`.gif`).
   For example for CSS files the icon file :file:`css.gif` will be used
   by default.
   If for a certain filetype no icon file is found in :ts:`icon.path`, the file
   :file:`default` plus extension (for example :file:`default.gif`) will be used.

   The following sub-properties are available and have :ref:`stdwrap` functionality:

   -  :ts:`path`:
            Path to the icon set.
            Default is :file:`typo3/sysext/frontend/Resources/Public/Icons/FileIcons/`.

   -  :ts:`ext`: File extension of icons. Default is :file:`.gif`.

   -  :ts:`widthAttribute`: Width of the icons in pixels. Default: 18

   -  :ts:`heightAttribute` Height of the icons in pixels. Default: 16



.. _filelink-icon\_link:

icon\_link
==========

:aspect:`Property:`
   icon\_link

:aspect:`Data type:`
   :ref:`data-type-boolean`

:aspect:`Description:`
   Set if the icon should be linked as well.

:aspect:`Default:`
   0



.. _filelink-icon\_image\_ext\_list:

icon\_image\_ext\_list
======================

:aspect:`Property:`
   icon\_image\_ext\_list

:aspect:`Data type:`
   *list of image extensions* / :ref:`stdwrap`

:aspect:`Description:`
   This is a comma-separated list of those file extensions that should
   render as thumbnails instead of icons.



.. _filelink-icon\_thumbsize:

icon\_thumbSize
===============

:aspect:`Property:`
   icon\_thumbSize

:aspect:`Data type:`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description:`
   Defines the size of the thumbnail in pixels.

   :ts:`icon` needs to be set for the option to take effect and the file
   extension of the image file must be part of :ts:`icon_image_ext_list`.
   You can set one or two values, see the examples. If you set two
   values, the first value will define the maximum width and the second
   one the maximum height. The aspect ratio of the original image will be
   preserved.

:aspect:`Examples:`
   ::

      icon_thumbSize = 150
      icon_thumbSize = 40x40



.. _filelink-iconcobject:

iconCObject
===========

:aspect:`Property:`
   iconCObject

:aspect:`Data type:`
   :ref:`data-type-cobject`

:aspect:`Description:`
   Enter a cObject to use alternatively for the icons, for example IMAGE type.
   If this is set, it will substitute the use of the thumbs-script for
   display of thumbnails.



.. _filelink-labelstdwrap:

labelStdWrap
============

:aspect:`Property:`
   labelStdWrap

:aspect:`Data type:`
   :ref:`stdwrap`

:aspect:`Description:`
   stdWrap options for the label (by default the label is the filename)
   before being wrapped with the A-tags.
   Use this to for example import another label from a database field or such.



.. _filelink-longdescurl:

longdescURL
===========

:aspect:`Property:`
   longdescURL

:aspect:`Data type:`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description:`
   For icons (image made with "iconCObject" must have their own
   properties).
   "longdesc" attribute (URL pointing to document with extensive details
   about image).



.. _filelink-path:

path
====

:aspect:`Property:`
   path

:aspect:`Data type:`
   :ref:`data-type-path` / :ref:`stdwrap`

:aspect:`Example:`
   :ts:`path = "uploads/media/`



.. _filelink-removeprependednumbers:

removePrependedNumbers
======================

:aspect:`Property:`
   removePrependedNumbers

:aspect:`Data type:`
   :ref:`data-type-bool`

:aspect:`Description:`
   If set, any 2-digit *appended(!)* numbers in the filename are removed.

:aspect:`Example:`
   If set, :file:`filename_23.gif` becomes :file:`filename.gif`.



.. _filelink-size:

size
====

:aspect:`Property:`
   size

:aspect:`Data type:`
   :ref:`data-type-boolean` / :ref:`stdwrap`

:aspect:`Description:`
   Set if size should be shown



.. _filelink-stdwrap:

stdWrap
=======

:aspect:`Property:`
   stdWrap

:aspect:`Data type:`
   :ref:`stdwrap`



.. _filelink-target:

target
======

:aspect:`Property:`
   target

:aspect:`Data type:`
   :ref:`data-type-target` / :ref:`stdwrap`

:aspect:`Description:`
   Target for the <a>-tag.



.. _filelink-titletext:

titleText
=========

tbd.




.. _filelink-typolinkconfiguration:

typolinkConfiguration
=====================

:aspect:`Property:`
   typolinkConfiguration

:aspect:`Data type:`
   :ref:`typolink`

:aspect:`Description:`
   This property can be used to pass additional typolink settings for
   the generated file link.
   Please note that the following properties will be ignored because they are
   set by the filelink function:
   :ts:`ATagParams`,
   :ts:`fileTarget`,
   :ts:`parameter`,
   :ts:`title`.



.. _filelink-wrap:

wrap
====

:aspect:`Property:`
   wrap

:aspect:`Data type:`
   :ref:`data-type-wrap` / :ref:`stdwrap`

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
