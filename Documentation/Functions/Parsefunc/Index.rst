.. include:: ../../Includes.txt


.. _parsefunc:

parseFunc
^^^^^^^^^

This object is used to parse some content for stuff like special typo
tags, the "makeLinks"-things and so on...


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         externalBlocks

   Data type
         list of tagnames/+properties

   Description
         This allows you to pre-split the content passed to parseFunc so that
         only content outside the blocks with the given tags is parsed.

         **Extra properties:**

         **.[tagname]** {

            **callRecursive:** Boolean. If set, the content of the block is
            directed into parseFunc again. Otherwise the content is just passed
            through with no other processing than stdWrap (see below).

            **callRecursive.dontWrapSelf:** Boolean. If set, the tags of the
            block is *not* wrapped around the content returned from parseFunc.

            **callRecursive.alternativeWrap:** Alternative wrapping instead of
            the original tags.

            **callRecursive.tagStdWrap:** ->stdWrap processing of the block-tags.

            **stdWrap:** ->stdWrap processing of the whole block (regardless of
            whether callRecursive was set.)

            **stripNLprev:** Boolean. Strips off last line break of the previous
            outside block.

            **stripNLnext:** Boolean. Strips off first line break of the next
            outside block.

            **stripNL:** Boolean. Does both of the above.

            **HTMLtableCells:** Boolean. If set, then the content is expected
            to be a table and every table-cell is traversed.

            Below, "default" means all cells and "1", "2", "3", ... overrides
            for specific columns.

            **HTMLtableCells.[default/1/2/3/...]** {

               **callRecursive:** Boolean. The content is parsed through current
               parseFunc.

               **stdWrap:** ->stdWrap processing of the content in the cell.

               **tagStdWrap:** -> The <TD> tag is processed by ->stdWrap.

            }

         **HTMLtableCells.addChr10BetweenParagraphs:** Boolean. If set, then
         all appearances of "</P><P>" will have a chr(10) inserted between them.

         }

         **Example:**

         This example is used to split regular bodytext content so that tables
         and blockquotes in the bodytext are processed correctly. The
         blockquotes are passed into parseFunc again (recursively) and further
         their top/bottom margins are set to 0 (so no apparent line breaks are
         seen)

         The tables are also displayed with a number of properties of the cells
         overridden. ::

            tt_content.text.20.parseFunc.externalBlocks {
              blockquote.callRecursive = 1
              blockquote.callRecursive.tagStdWrap.HTMLparser = 1
              blockquote.callRecursive.tagStdWrap.HTMLparser {
                tags.blockquote.fixAttrib.style.list = margin-bottom:0;margin-top:0;
                tags.blockquote.fixAttrib.style.always = 1
              }
              blockquote.stripNLprev = 1
              blockquote.stripNLnext = 1

              table.stripNL = 1
              table.stdWrap.HTMLparser = 1
              table.stdWrap.HTMLparser {
                tags.table.overrideAttribs = border="0" style="margin-top: 10px;"
                tags.tr.allowedAttribs = 0
                tags.td.overrideAttribs = class="table-cell" style="font-size: 10px;"
              }
            }


.. container:: table-row

   Property
         constants

   Data type
         boolean

   Description
         You can define constants in the :ref:`top-level object "constants"
         <constants>` in the *Setup* field of your TypoScript template.

         If this property is set, you can use markers (the constant name
         wrapped in "###") in your text. TYPO3 then substitutes the markers
         with the value of the according constant.

         **Example:** ::

            constants.EMAIL = email@email.com

         *(The definition of the constant above is top-level TypoScript. It
         belongs on one level with the objects "config" and "page".)*

         If you now use parseFunc with .constants = 1, all occurrences of the
         string ###EMAIL### in the text will be substituted with the actual
         address.


.. container:: table-row

   Property
         short

   Data type
         *(array of strings)*

   Description
         Like constants above, but local.

         **Example:**

         This substitutes all occurrences of "T3" with "TYPO3 CMS" and "T3web"
         with a link to typo3.org. ::

            short {
              T3 = TYPO3 CMS
              T3web = <a href="http://typo3.org">typo3.org</a>
            }


.. container:: table-row

   Property
         plainTextStdWrap

   Data type
         ->stdWrap

   Description
         This is stdWrap properties for all non-tag content.


.. container:: table-row

   Property
         userFunc

   Data type
         function name

   Description
         This passes the non-tag content to a function of your own choice.
         Similar to e.g. .postUserFunc in stdWrap.

         Remember the function name must possibly be prepended "user\_"


.. container:: table-row

   Property
         nonTypoTagStdWrap

   Data type
         ->stdWrap

   Description
         Like .plainTextStdWrap. Difference:

         .plainTextStdWrap works an ALL non-tag pieces in the text.
         .nonTypoTagStdWrap is post processing of all text (including tags)
         between special TypoTags (unless .breakoutTypoTagContent is not set
         for the TypoTag).


.. container:: table-row

   Property
         nonTypoTagUserFunc

   Data type
         function name

   Description
         Like .userFunc. Differences is (like nonTypoTagStdWrap) that this is
         post processing of all content pieces around TypoTags while .userFunc
         processes all non-tag content. (Notice: .breakoutTypoTagContent must
         be set for the TypoTag if it's excluded from nonTypoTagContent).


.. container:: table-row

   Property
         sword

   Data type
         wrap

   Description
         Marks up any words from the GET-method send array sword\_list[] in the
         text. The word MUST be at least two characters long!

         **Note:** works only with $GLOBALS['TSFE']->no\_cache = 1.

   Default
         <font color="red">\|</font>


.. container:: table-row

   Property
         makelinks

   Data type
         boolean / ->makelinks

   Description
         Convert web addresses prefixed with "http://" and mail addresses
         prefixed with "mailto:" to links.


.. container:: table-row

   Property
         tags

   Data type
         *->tags*

   Description
         Here you can define **custom tags** that will parse the content to
         something.


.. container:: table-row

   Property
         allowTags

   Data type
         list of strings

   Description
         List of tags, which are allowed to exist in code!

         Highest priority: If a tag is found in allowTags, denyTags is
         ignored!


.. container:: table-row

   Property
         denyTags

   Data type
         list of strings

   Description
         List of tags, which may **not** exist in code! (use "\*" for all.)

         Lowest priority: If a tag is **not** found in allowTags, denyTags is
         checked. If denyTags is not "\*" and the tag is not found in the list,
         the tag may exist!

         **Example:**

         This allows <B>, <I>, <A> and <IMG> -tags to exist ::

            .allowTags = b,i,a,img
            .denyTags = *


.. container:: table-row

   Property
         if

   Data type
         ->if

   Description
         if "if" returns false, the input value is not parsed, but returned
         directly.


.. ###### END~OF~TABLE ######


[tsref:->parseFunc]


.. _parsefunc-examples:

Example:
""""""""

This example takes the content of the field "bodytext" and parses it
through the makelinks-functions and substitutes all <LINK> and
<TYPOLIST>-tags with something else. ::

   tt_content.text.default {
     20 = TEXT
     20.stdWrap.field = bodytext
     20.stdWrap.wrap = | <br>
     20.stdWrap.brTag = <br>
     20.stdWrap.parseFunc {
       makelinks = 1
       makelinks.http.keep = path
       makelinks.http.extTarget = _blank
       makelinks.mailto.keep = path
       tags {
         link = TEXT
         link {
           stdWrap.current = 1
           stdWrap.typolink.extTarget = _blank
           stdWrap.typolink.target = {$cLinkTagTarget}
           stdWrap.typolink.wrap = <p style="color: red; font-weight: bold;">|</p>
           stdWrap.typolink.parameter.data = parameters : allParams
         }

         typolist < tt_content.bullets.default.20
         typolist.trim = 1
         typolist.field >
         typolist.current = 1
       }
     }
   }

