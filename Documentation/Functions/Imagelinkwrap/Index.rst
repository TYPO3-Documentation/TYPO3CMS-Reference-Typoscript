.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _imagelinkwrap:

imageLinkWrap
=============

What it does
------------

:ts:`imageLinkWrap =` [:ref:`my-data-type-boolean`, default: 0]

Set this to TRUE (:ts:`imageLinkWrap = 1`) to attach a link to an image
that opens a special view of the image. By default the link points to
the :ref:`TYPO3-CMS-eID-script` :ref:`tx_cms_showpic` that knows how to
deal with several parameters. The script adds an md5-hash to protect
the parameters. The image will only be shown if the parameters are
unchanged.


Example: Create a link to the ``tx_cms_showpic`` script
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
::

   10 = IMAGE
   10 {
         # point to the image
      file = fileadmin/demo/lorem_ipsum/images/a4.jpg
         # make it rather small
      file.width = 80
         # add a link to tx_cms_showpic.php that shows the original image
      imageLinkWrap = 1
      imageLinkWrap {
         enable = 1
         # JSwindow = 1
      }
   }

Since TYPO3 CMS 4.5 there is an alternative. You may set
:ts:`directImageLink` to TRUE (:ts:`directImageLink = 1`). Then the link
will point directly to the image - no intermediate script involved.
A use could be to display the images in a lightbox. See the
`Example: Images in a lightbox`_.


Example: Link directly to the original image
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
::

   10 = IMAGE
   10 {
      file = fileadmin/demo/lorem_ipsum/images/a4.jpg
      file.width = 80
      imageLinkWrap = 1
      imageLinkWrap {
         enable = 1
            # link directly to the image
         directImageLink = 1
         # JSwindow = 1
      }
   }


:ts:`JSwindow`: If you set this to TRUE (:ts:`JSwindow = 1`) more fancy
features become available because the preview is opened by
Javascript. That way you can specify the window title, size,
background-color and more.


Implementation
--------------

See

- imageLinkWrap__ in API__,
- method ``imageLinkWrap`` in
- class ``ContentObjectRenderer`` in
- namespace :php:`namespace TYPO3\CMS\Frontend\ContentObject;` in
- file :file:`ContentObjectRenderer.php` in
- folder ``typo3/sysext/frontend/Classes/ContentObject``.

__ http://typo3.org/api/typo3cms/search/all_69.html?imageLinkWrap
__ http://typo3.org/api/typo3cms/


Configuration
-------------

enable
~~~~~~

:ts:`imageLinkWrap.enable =` [:ref:`my-data-type-boolean`, default: 0; :ref:`my-data-type-stdWrap`]

Whether or not to link the image. Must be set to TRUE. Otherwise
:ts:`imageLinkWrap` will do nothing.



file
~~~~

:ts:`imageLinkWrap.file =` [:ref:`my-data-type-stdWrap`]

Apply :ref:`my-data-type-stdWrap` functionality to the file path.
((...))


width
~~~~~

:ts:`imageLinkWrap.width =` [:ref:`my-data-type-positive-integer`;  :ref:`my-data-type-stdWrap`]

Width of the image to be shown in pixels. If you add "m" to :ts:`width`
or :ts:`height` or both then the width and height parameters will be
interpreted as maximum and proportions of the image will be preserved.


height
~~~~~~

:ts:`imageLinkWrap.height =` [:ref:`my-data-type-positive-integer`;  :ref:`my-data-type-stdWrap`]

Width of the image to be shown in pixels. If you add "m" to :ts:`width`
or :ts:`height` or both then the width and height parameters will be
interpreted as maximum and proportions of the image will be preserved.



effects
~~~~~~~

:ts:`imageLinkWrap.effects =` [like :ref:`gifbuilder-effect` of :ref:`GIFBUILDER`;  :ref:`my-data-type-stdWrap`]

Example for effects
"""""""""""""""""""
::

   imageLinkWrap {
      effects = gamma=1.3 | sharpen=80 | solarize=70
         # effects only works when directImageLink is FALSE
      directImageLink = 0
         # at most 800 pixels wide. Keep proportions.
      width = 800m
         # at most 600 pixels wide. Keep proportions.
      height = 600m
   }

Apply image effects to the preview image.


sample
~~~~~~

:ts:`imageLinkWrap.sample =` [:ref:`my-data-type-boolean`, default: 0;  :ref:`my-data-type-stdWrap`]

:ts:`sample` is a switch with which you can influence how
:ref:`ImageMagick` calculates the preview image. If :ts:`sample` is TRUE
then ``- sample`` is with ImageMagick instead of ``- geometry`` to
calculate the preview image. ``sample`` does not use antialiasing and is
therefore much faster than ImageMagick's ``geometry`` procedure.


alternativeTempPath
~~~~~~~~~~~~~~~~~~~

:ts:`imageLinkWrap.alternativeTempPath =` [:ref:`my-data-type-path`;  :ref:`my-data-type-stdWrap`]

This is used to specify an alternative path to be used for temporary
images. To be considered legal the value must exist in the list of
allowed temporary paths (:php:`$TYPO3_CONF_VARS['FE']['allowedTempPaths']`).


title
~~~~~

:ts:`imageLinkWrap.title =` [:ref:`my-data-type-string`;  :ref:`my-data-type-stdWrap`]

Specifies the (html-) title of the preview window. Needs :ts:`JSwindow = 1`.


bodyTag
~~~~~~~

:ts:`imageLinkWrap.bodyTag =` [:ref:`my-data-type-tag`;  :ref:`my-data-type-stdWrap`]

This is the ``<body>``-Body tag of the preview window.
Needs :ts:`JSwindow = 1`.

Example for bodyTag
"""""""""""""""""""
::

   imageLinkWrap.JSwindow = 1
   imageLinkWrap.bodyTag = <body style="background-color:black; margin:0; padding:0;">



wrap
~~~~

:ts:`imageLinkWrap.wrap =` [:ref:`my-data-type-wrap`]

This wrap is placed around the ``<img>``-tag in the preview window.
Needs :ts:`JSwindow = 1`.


target
~~~~~~

:ts:`imageLinkWrap.target =` [:ref:`my-data-type-target`, default: 'thePicture'; :ref:`my-data-type-stdWrap`]

This specifies the ``target`` attribute of the link. The attribute
will only be created if the current :ref:`Doctype <config-doctype>`
allows it. Needs :ts:`JSwindow = 1`.

Examples for target
"""""""""""""""""""
::

      # (1) to produce:  <a target="preview" ... >
   imageLinkWrap.target = preview

      # (2) to use the default:  <a target="thePicture" ...>
   // do nothing - use the built in default value of ".target"

      # (3) to use a new window for each image
      # let there be:  <a target="<hash-code>" ... >
   imageLinkWrap.JSwindow = 1
   imageLinkWrap.JSwindow.newWindow = 1


JSwindow
~~~~~~~~

:ts:`imageLinkWrap.JSwindow =` [:ref:`my-data-type-boolean`;  :ref:`my-data-type-stdWrap`]

If true (:ts:`JSwindow = 1`) Javascript will be used to open the image
in a new window. The window is automatically resized to match the
dimensions of the image.


JSwindow.expand
~~~~~~~~~~~~~~~

:ts:`imageLinkWrap.JSwindow.expand =` [:ts:`x`, :ts:`y`;  :ref:`my-data-type-stdWrap`]

:ts:`x` and :ts:`x` are of data type :ref:`my-data-type-integer`. The values
are added to the width and height of the preview image when calculating
the width and height of the preview window.


JSwindow.newWindow
~~~~~~~~~~~~~~~~~~

:ts:`imageLinkWrap.JSwindow.newWindow =` [:ref:`my-data-type-boolean`;  :ref:`my-data-type-stdWrap`]

If the :ref:`Doctype <config-doctype>` allows the :ref:`my-data-type-target` attribute
the image will be opened in a window with the respective name.
If that windows is kept open and the next image with the same :ref:`my-data-type-target`
attribute is to be shown then it will appear in the same preview window.

Thinks are different if you set :ts:`JSwindow.newWindow` to TRUE
(:ts:`JSwindow.newWindow = 1`): Then a unique hash value will be
calculated and used as ``target`` value for each image. This garantees
that each image is opened in a new window.



JSwindow.altUrl
~~~~~~~~~~~~~~~

:ts:`imageLinkWrap.JSwindow.altUrl =` [:ref:`my-data-type-string`;  :ref:`my-data-type-stdWrap`]

If this returns anything then the URL of the preview window (opened
by Javascript) is **not** pointing to :ref:`tx_cms_showpic` but it is
the URL given here!



JSwindow.altUrl\_noDefaultParams
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

:ts:`imageLinkWrap.JSwindow.altUrl_noDefaultParams =` [:ref:`my-data-type-boolean`, default: 0;  :ref:`my-data-type-stdWrap`???]

If true (:ts:`JSwindow.altUrl_noDefaultParams = 1`) then the image
parameters are not appended automatically to the :ts:`altUrl`.
This is useful if you want to add them yourself in a special way.


typolink
~~~~~~~~

:ts:`imageLinkWrap.typolink =` [like :ref:`typolink`]

This is your chance to completely control what link is being generated.
If this returns anything that will override the built in results of
:ts:`imageLinkWrap`.

Example for typolink
""""""""""""""""""""
::

   ((...))



directImageLink
~~~~~~~~~~~~~~~

:ts:`imageLinkWrap.directImageLink =` [:ref:`my-data-type-boolean`, default: 0;  :ref:`my-data-type-stdWrap`]

If true (:ts:`directImageLink = 1`) the link to preview version of the
image will point to the image file will directly. This means that
:ref:`tx_cms_showpic` will not be used.



linkParams
~~~~~~~~~~

:ts:`imageLinkWrap.linkParams =` [any of the options of :ref:`typolink`]

When the direct link to the preview image is calculated all the
attributes of :ts:`linkParams` are used as configuration of the
:ref:`typolink` function. In other words: use the properties that are
valid for :ref:`typolink` in order to apply them to the preview link.
Needs :ts:`JSwindow = 0`.


Example for linkParams
""""""""""""""""""""""
::

   JSwindow = 0
   directImageLink = 1
   linkParams.ATagParams.dataWrap (
      class="{$styles.content.imgtext.linkWrap.lightboxCssClass}"
      rel="{$styles.content.imgtext.linkWrap.lightboxRelAttribute}"
   )

In this way it is easy to use a lightbox of your choice and to display
resized images in the frontend: You only need to integrate the lightbox
by including it's Javascript and CSS files and to activate certain links
by using the right "lightbox" class. Here's a more complete example:
`Example: Images in a lightbox`_.


stdWrap
~~~~~~~

:ts:`imageLinkWrap.stdWrap =` [:ref:`my-data-type-stdWrap`]

This adds :ref:`my-data-type-stdWrap` functionality to the almost final
result.




.. _imagelinkwrap-examples:

Examples for imageLinkWrap
--------------------------


Example: Larger display in a popup window
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

   page = PAGE
   page.10 = IMAGE
   page.10 {
         # the relative path to the image
         # find the images in the 'lorem_ipsum' extension an copy them here
      file = fileadmin/demo/lorem_ipsum/images/b1.jpg
         # let's make the normal image small
      file.width = 80
         # yes, we want to have a preview link on the image
      imageLinkWrap = 1
      imageLinkWrap {
            # must be TRUE for anything to happen
         enable = 1
            # "m" = at most 400px wide - keep proportions
         width = 400m
            # "m" = at most 300px high - keep proportions
         height = 300
            # let's use fancy Javascript features
         JSwindow = 1
            # black background
         bodyTag = <body style="background-color:black; margin:0; padding:0;">
            # place a Javascript "close window" link onto the image
         wrap = <a href="javascript:close();"> | </a>
            # let there be a new and unique window for each image
         JSwindow.newWindow = 1
            # make the preview window 30px wider and 20px higher than what the image requires
         JSwindow.expand = 30,20
   }


Example: Images in a lightbox
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Let's use `fancybox <http://fancybox.net>`_ as lightbox. This code is an
example. You don't need to use "modernpackage". You can copy necessary
Javascript and CSS files to a place in :file:`fileadmin/...` for example::

    # ******************************************************************************
    # (c) 2012 Georg Ringer <typo3@ringerge.org>
    #
    # https://github.com/georgringer/modernpackage/blob/master/Resources/Private/TypoScript/content/lightbox.ts
    #
    # You can redistribute it and/or modify it under the terms of the
    # GNU General Public License as published by the Free Software Foundation;
    # either version 2 of the License, or (at your option) any later version.
    # ******************************************************************************

    # **********************************************************
    # Lightbox implementation by using plain TypoScript
    # and fancybox, see http://fancybox.net/ for details
    # **********************************************************

    # Add the CSS / JS files
    page {
        includeCSS {
            file5 = EXT:modernpackage/Resources/Public/Contrib/fancybox/jquery.fancybox-1.3.4.css
        }
        includeJSFooter {
            # Optional
            jquery_easing = EXT:modernpackage/Resources/Public/Contrib/fancybox/jquery.easing-1.3.pack.js
            # fancybox library
            fancybox = EXT:modernpackage/Resources/Public/Contrib/fancybox/jquery.fancybox-1.3.4.pack.js
            # Enabling lightbox for content images + configuration
            enable_fancybox = EXT:modernpackage/Resources/Public/Template/js/enable_fancybox.js
        }
    }

    # Change rendering of images to fit the needs of the lightbox requirements
    tt_content.image.20.1.imageLinkWrap {
        JSwindow = 0
        directImageLink = 1
        linkParams.ATagParams {
            dataWrap = class= "lightbox" rel="fancybox{field:uid}"
        }
    }


Data types
==========

((this chapter should be placed elsewhere))


.. _my-data-type-boolean:

Boolean
-------
The value is considered to be TRUE if `PHP evaluates this value to TRUE`__.
If the value is empty or `PHP evaluates to FALSE`__ it is counted as
FALSE.

__ http://php.net/manual/en/language.types.boolean.php
__ http://php.net/manual/en/language.types.boolean.php

Examples of my-data-type ``Boolean``::

   dummy.enable =               # FALSE, because value is empty
   dummy.enable = 0             # FALSE, prefered notation
   dummy.enable = 1             # TRUE, prefered notation
   dummy.enable = yes           # TRUE, because ('yes') is true in PHP
   dummy.enable = no            # TRUE (!), because ('no') is true in PHP
   dummy.enable = 0 anything    # FALSE, because ('0 anything') is false in PHP
   dummy.enable = 1 anything    # FALSE, because ('1 anything') is false in PHP





.. _my-data-type-positive-integer:

Positive Integer
----------------
((describe TypoScript my-data-type ``Positive Integer`` here))

A non-negative integer number: ``0 <= i <= maxInteger``



.. _my-data-type-integer:

Integer
-------
An integer number: ``minInteger <= i <= maxInteger``



.. _my-data-type-string:

String
------
((describe TypoScript my-data-type ``String`` here))


.. _my-data-type-stdWrap:

stdWrap
-------
((describe TypoScript my-data-type ``stdWrap`` here))


.. _my-data-type-wrap:

wrap
----

((describe my-data-type ``wrap`` here))

.. _my-data-type-target:

target
------

((describe my-data-type ``target`` here))


.. _my-data-type-tag:

tag
---

((describe my-data-type ``tag`` here))


.. _my-data-type-path:

path
----
((describe data ype ``path`` here))



What should get a description somewhere
=======================================


.. _typo3-cms-eid-script:

TYPO3 CMS eID script
--------------------

((to be described somewhere))


.. _imagemagick:

ImageMagick
-----------
((to be explained somewhere))

ImageMagick, GraphicsMagick, ...


.. _tx_cms_showpic:

tx_cms_showpic
--------------
((describe the ``tx_cms_showpic`` script somewhere))

