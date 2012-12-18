.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-plaintextlib:

plaintextLib.inc
^^^^^^^^^^^^^^^^


.. _appendix-plaintextlib-files:

Files:
""""""

.. ### BEGIN~OF~SIMPLE~TABLE ###

=========================   ===============================================
File:                       Description:
=========================   ===============================================
plaintextLib.inc            Main class used to display plain text content.

                            Call it from a USER cObject with 'userFunc =
                            user\_plaintext->main\_plaintext'

plaintext\_content.tmpl     Example template file.
=========================   ===============================================

.. ###### END~OF~SIMPLE~TABLE ######


Example:
""""""""

(See static\_template 'plugin.alt.plaintext' for a working
configuration)


.. _appendix-plaintextlib-template:

Static template
"""""""""""""""

plugin.alt.plaintext


.. _appendix-plaintextlib-properties:

plaintextLib.inc properties
"""""""""""""""""""""""""""

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
         siteUrl

   Data type
         string

   Description
         The URL of the site.


.. container:: table-row

   Property
         defaultOutput

   Data type
         untrimmed string

   Description
         Default output if CType is not rendered.


.. container:: table-row

   Property
         uploads.header

   Data type
         untrimmed string

   Description
         Header for uploads.


.. container:: table-row

   Property
         images.header

   Data type
         untrimmed string

   Description
         Header for images.


.. container:: table-row

   Property
         images.captionHeader

   Data type
         untrimmed string

   Description
         Header for image captions.


.. container:: table-row

   Property
         images.linkPrefix

   Data type
         untrimmed string

   Description
         Prefix for image-links.


.. container:: table-row

   Property
         **.header**


.. container:: table-row

   Property
         defaultType

   Data type
         integer

   Description
         Defines which type to use as default.


.. container:: table-row

   Property
         date

   Data type
         date-config

   Description
         For header date.


.. container:: table-row

   Property
         datePrefix

   Data type
         untrimmed string

   Description
         Prefix for header date.


.. container:: table-row

   Property
         linkPrefix

   Data type
         untrimmed string

   Description
         Prefix for header links.


.. container:: table-row

   Property
         [1-5].preLineLen

   Data type
         integer

   Description
         Length of line before header.


.. container:: table-row

   Property
         [1-5].postLineLen

   Data type
         integer

   Description
         Length of line after header.


.. container:: table-row

   Property
         [1-5].preBlanks

   Data type
         integer

   Description
         Number of blank lines before header.


.. container:: table-row

   Property
         [1-5].postBlanks

   Data type
         integer

   Description
         Number of blank lines after header.


.. container:: table-row

   Property
         [1-5].stdWrap

   Data type
         ->stdWrap

   Description
         for header text.


.. container:: table-row

   Property
         [1-5].preLineChar

   Data type
         string

   Description
         Character to pre-line.


.. container:: table-row

   Property
         [1-5].postLineChar

   Data type
         string

   Description
         Character to post-line.


.. container:: table-row

   Property
         [1-5].preLineBlanks

   Data type
         integer

   Description
         Number of blank lines between header and pre-line.


.. container:: table-row

   Property
         [1-5].postLineBlanks

   Data type
         integer

   Description
         Number of blank lines between header and post-line.


.. container:: table-row

   Property
         [1-5].autonumber

   Data type
         boolean

   Description
         If set, a number is prepended every header. The number corresponds to
         the content element number in the select.


.. container:: table-row

   Property
         [1-5].prefix

   Data type
         untrimmed string

   Description
         Header string prefix.


.. container:: table-row

   Property
         bulletlist.[0-3].bullet

   Data type
         untrimmed string

   Description
         Bullet for bullet list, layout [0-3].


.. container:: table-row

   Property
         bulletlist.[0-3].secondRow

   Data type
         untrimmed string

   Description
         If set, this is used for lines on the second row of bullet-lists.


.. container:: table-row

   Property
         menu

   Data type
         cObject

   Description
         cObject to render menu. The output is stripped for tags and the links
         is extracted. Further all <BR> chars are converted to chr(10).


.. container:: table-row

   Property
         shortcut

   Data type
         cObject

   Description
         cObject to render other elements. See config below which simply uses
         this object to render more tt\_content elements as plaintext.


.. container:: table-row

   Property
         bodytext.stdWrap

   Data type
         ->stdWrap

   Description
         stdWrap for body-text. See config example below.


.. container:: table-row

   Property
         userProc

   Data type
         function name

   Description
         Lets you process the output of each content element before it finally
         is returned. Property "parentObj" of the conf-array holds a references
         to the plainText object calling the function.


.. ###### END~OF~TABLE ######

[tsref:(script).plaintextLib]


.. _appendix-plaintextlib-untrimmed-string:

Datatype 'untrimmed string' means that you can enter a string as
usual, but if you enter a value between two vertical lines, that value
will be used and **not** trimmed. Normally values *are* trimmed.


.. _appendix-plaintextlib-examples:

Example:
~~~~~~~~

::

   lib.renderObj = USER
   lib.renderObj.userFunc = user_plaintext->main_plaintext
   lib.renderObj {
     header.defaultType = 1
     header.date = D-m-Y
     header.datePrefix = |Date: |
     header.linkPrefix = | - Headerlink: |
     header.1.preLineLen = 76
     header.1.postLineLen = 76
     header.1.preBlanks = 1
     header.1.stdWrap.case = upper

     header.2 < .header.1
     header.2.preLineChar = *
     header.2.postLineChar = *

     header.3.preBlanks = 2
     header.3.postBlanks = 1
     header.3.stdWrap.case = upper

     header.4 < .header.1
     header.4.preLineChar= =
     header.4.postLineChar= =
     header.4.preLineBlanks= 1
     header.4.postLineBlanks = 1

     header.5.preBlanks = 1
     header.5.autonumber = 1
     header.5.prefix = |: >> |


     siteUrl = {$plugin.alt.plaintext.siteUrl}
     defaultOutput (
   |
   [Unrendered Content Element; ###CType### ]
   |
     )

     uploads.header = |DOWNLOADS:|

     images.header = |IMAGES:|
     images.linkPrefix = | - Imagelink: |
     images.captionHeader = |CAPTION:|

     bulletlist.0.bullet = |*  |

     bulletlist.1.bullet = |#  |

     bulletlist.2.bullet = | - |

     bulletlist.3.bullet = |>  |
     bulletlist.3.secondRow = |.  |
     bulletlist.3.blanks = 1

     menu = <tt_content.menu.20
     shortcut = <tt_content.shortcut.20
     shortcut.0.conf.tt_content = <lib.renderObj
     shortcut.0.tables = tt_content

     bodytext.stdWrap.parseFunc.tags {
       link < styles.content.parseFunc.tags.link
       typolist = USER
       typolist.userFunc = user_plaintext->typolist
       typolist.siteUrl = {$plugin.alt.plaintext.siteUrl}
       typolist.bulletlist < temp.renderObj.bulletlist
       typohead = USER
       typohead.userFunc = user_plaintext->typohead
       typohead.siteUrl = {$plugin.alt.plaintext.siteUrl}
       typohead.header < temp.renderObj.header
       typocode = USER
       typocode.userFunc = user_plaintext->typocode
       typocode.siteUrl = {$plugin.alt.plaintext.siteUrl}
     }
   }

