.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _tags:

tags
^^^^

Used to create custom tags and define how they should be parsed. This
is used in conjunction with *parseFunc*.

The best known is the "link" tag, which is used to create links.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         *(array of strings)*

   Data type
         cObject

   Description
         Every entry in the array of strings corresponds to a tag, that will
         be parsed. The elements **must** be in lowercase.

         Every entry must be set to a content object.

         "current" is set to the content of the tag, eg <TAG>content</TAG>:
         here "current" is set to "content". It can be used with
         stdWrap.current = 1.

         **Parameters:**

         Parameters of the tag are set in $cObj->parameters (key is lowercased)::

            <TAG COLOR="red">content</TAG>

         This sets $cObj->parameters[color] = red.

         $cObj->parameters[allParams] is automatically set to the whole
         parameter-string of the tag. Here it is ' color="red"'

         **Special properties for each content object:**

         **[cObject].stripNL:** Boolean option, which tells *parseFunc* that
         newlines before and after the content of the tag should be stripped.

         **[cObject].breakoutTypoTagContent:** Boolean option, which tells
         parseFunc that this block of content is breaking up the nonTypoTag
         content and that the content after this must be re-wrapped.

         **Examples:** ::

            tags.bold = TEXT
            tags.bold {
              stdWrap.current = 1
              stdWrap.wrap = <p style="font-weight: bold;"> | </p>
            }
            tags.bold.stdWrap.stripNL = 1

         This example would e.g. transform :code:`<BOLD>Important!</BOLD>`
         to :code:`<p style="font-weight: bold;">Important!</p>`.

.. ###### END~OF~TABLE ######


[tsref:->tags]


.. _tags-examples:

Example:
""""""""

This example creates 4 custom tags. The <LINK>-, <TYPOLIST>-,
<GRAFIX>- and <PIC>-tags:

<LINK> is made into a typolink and provides an easy way of creating
links in text.

<TYPOLIST> is used to create bullet-lists.

<GRAFIX> will create an image file with 90x10 pixels where the text is
the content of the tag.

<PIC> lets us place an image in the text. The content of the tag
should be the image-reference in "fileadmin/images/". ::

       tags {
         link = TEXT
         link {
           stdWrap.current = 1
           stdWrap.typolink.extTarget = _blank
           stdWrap.typolink.target = {$cLinkTagTarget}
           stdWrap.typolink.wrap = <p style="color: red;">|</p>
           stdWrap.typolink.parameter.data = parameters : allParams
         }

         typolist < tt_content.bullets.default.20
         typolist.trim = 1
         typolist.field >
         typolist.current = 1

         grafix = IMAGE
         grafix {
           file = GIFBUILDER
           file {
             XY = 90,10
             100 = TEXT
             100.text.current = 1
             100.offset = 5,10
           }
         }
         # Transforms <pic>file.png</pic> to <img src="fileadmin/images/file.png" >
         pic = IMAGE
         pic.file.import = fileadmin/images/
         pic.file.import.current = 1
       }

