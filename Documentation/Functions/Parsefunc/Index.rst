.. include:: ../../Includes.txt


.. _parsefunc:

=========
parseFunc
=========

This object is used to parse some content for stuff like special typo
tags, the :ref:`parsefunc-makeLinks`-things and so on...

.. _parsefunc-externalBlocks:

externalBlocks
==============

:aspect:`Property`
   externalBlocks

:aspect:`Data type`
   list of tagnames / +properties

:aspect:`Description`
   This allows you to pre-split the content passed to parseFunc so that
   only content outside the blocks with the given tags is parsed.

   **Extra properties:**

   **.[tagname]** {

      **callRecursive:** :ref:`data-type-boolean`. If set, the content of the block is
      directed into parseFunc again. Otherwise the content is just passed
      through with no other processing than :ref:`stdwrap` (see below).

      **callRecursive.dontWrapSelf:** :ref:`data-type-boolean`. If set, the tags of the
      block is *not* wrapped around the content returned from parseFunc.

      **callRecursive.alternativeWrap:** Alternative wrapping instead of
      the original tags.

      **callRecursive.tagStdWrap:** :ref:`stdwrap` processing of the block-tags.

      **stdWrap:** :ref:`stdwrap` processing of the whole block (regardless of
      whether callRecursive was set.)

      **stripNLprev:** :ref:`data-type-boolean`. Strips off last line break of the previous
      outside block.

      **stripNLnext:** :ref:`data-type-boolean`. Strips off first line break of the next
      outside block.

      **stripNL:** :ref:`data-type-boolean`. Does both of the above.

      **HTMLtableCells:** :ref:`data-type-boolean`. If set, then the content is expected
      to be a table and every table-cell is traversed.

      Below, "default" means all cells and "1", "2", "3", ... overrides
      for specific columns.

      **HTMLtableCells.[default/1/2/3/...]** {

         **callRecursive:** :ref:`data-type-boolean`. The content is parsed through current
         parseFunc.

         **stdWrap:** :ref:`stdwrap` processing of the content in the cell.

         **tagStdWrap:** -> The :html:`<TD>` tag is processed by :ref:`stdwrap`.

      }

   **HTMLtableCells.addChr10BetweenParagraphs:** :ref:`data-type-boolean`. If set, then
   all appearances of :html:`</P><P>` will have a :php:`chr(10)` inserted between them.

   }

:aspect:`Example`

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

.. _parsefunc-constants:

constants
=========

:aspect:`Property`
   constants

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   You can define constants in the :ref:`top-level object "constants"
   <constants>` in the *Setup* field of your TypoScript template.

   If this property is set, you can use markers (the constant name
   wrapped in "###") in your text. TYPO3 then substitutes the markers
   with the value of the according constant.

:aspect:`Example`

   ::

      constants.EMAIL = email@email.com

   *(The definition of the constant above is top-level TypoScript. It
   belongs on one level with the objects "config" and "page".)*

   If you now use parseFunc with :ts:`constants = 1`, all occurrences of the
   string ###EMAIL### in the text will be substituted with the actual
   address.

.. _parsefunc-short:

short
=====

:aspect:`Property`
   short

:aspect:`Data type`
   *(array of strings)*

:aspect:`Description`
   Like constants above, but local.

:aspect:`Example`

   This substitutes all occurrences of "T3" with "TYPO3 CMS" and "T3web"
   with a link to typo3.org. ::

      short {
            T3 = TYPO3 CMS
            T3web = <a href="http://typo3.org">typo3.org</a>
      }

.. _parsefunc-plainTextStdWrap:

plainTextStdWrap
================

:aspect:`Property`
   plainTextStdWrap

:aspect:`Data type`
   :ref:`stdwrap`

:aspect:`Description`
   This is :ref:`stdwrap` properties for all non-tag content.

.. _parsefunc-userFunc:

userFunc
========

:aspect:`Property`
   userFunc

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
   This passes the non-tag content to a function of your own choice.
   Similar to e.g. :ref:`stdwrap-postuserfunc` in :ref:`stdWrap`.

   Remember the function name must possibly be prepended :php:`user_`.

.. _parsefunc-nonTypoTagStdWrap:

nonTypoTagStdWrap
=================

:aspect:`Property`
   nonTypoTagStdWrap

:aspect:`Data type`
   :ref:`stdWrap`

:aspect:`Description`
   Like :ref:`parsefunc-plainTextStdWrap`. Difference:

   :ref:`parsefunc-plainTextStdWrap` works an ALL non-tag pieces in the text.
   :ref:`parsefunc-nonTypoTagStdWrap` is post processing of all text
   (including tags) between special TypoTags
   (unless :ts:`breakoutTypoTagContent` is not set for the TypoTag).

.. _parsefunc-nonTypoTagUserFunc:

nonTypoTagUserFunc
==================

:aspect:`Property`
   nonTypoTagUserFunc

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
   Like :ref:`parsefunc-userFunc`.
   Differences is (like :ref:`parsefunc-nonTypoTagStdWrap`)
   that this is post processing of all content pieces around TypoTags while
   :ref:`parsefunc-userFunc` processes all non-tag content.
   (Notice: :ts:`breakoutTypoTagContent` must be set for the TypoTag
   if it's excluded from :ts:`nonTypoTagContent`).

.. _parsefunc-sword:

sword
=====

:aspect:`Property`
   sword

:aspect:`Data type`
   :ref:`data-type-wrap`

:aspect:`Description`
   Marks up any words from the GET-method send array :php:`sword_list[]` in the
   text. The word MUST be at least two characters long!

   **Note:** works only with :php:`$GLOBALS['TSFE']->no_cache = 1`.

:aspect:`Default`
   :ts:`<font color="red">|</font>`

.. _parsefunc-makelinks:

makelinks
=========

:aspect:`Property`
   makelinks

:aspect:`Data type`
   :ref:`data-type-boolean` / :ref:`makelinks`

:aspect:`Description`
   Convert web addresses prefixed with `http://` and mail addresses
   prefixed with `mailto:` to links.

.. _parsefunc-tags:

tags
====

:aspect:`Property`
   tags

:aspect:`Data type`
   :ref:`tags`

:aspect:`Description`
   Here you can define **custom tags** that will parse the content to
   something.

.. _parsefunc-allowTags:

allowTags
=========

:aspect:`Property`
   allowTags

:aspect:`Data type`
   list of strings

:aspect:`Description`
   List of tags, which are allowed to exist in code!

   Highest priority: If a tag is found in :ref:`parsefunc-allowTags`,
   :ref:`parsefunc-denyTags` is ignored!

.. _parsefunc-denyTags:

denyTags
========

:aspect:`Property`
   denyTags

:aspect:`Data type`
   list of strings

:aspect:`Description`
   List of tags, which may **not** exist in code! (use :ts:`*` for all.)

   Lowest priority: If a tag is **not** found in :ref:`parsefunc-allowTags`,
   :ref:`parsefunc-denyTags` is checked.
   If denyTags is not :ts:`*` and the tag is not found in the list, the tag may exist!

:aspect:`Example`

   This allows :html:`<b>`, :html:`<i>`, :html:`<a>` and :html:`<img>` -tags to exist ::

      .allowTags = b,i,a,img
      .denyTags = *

.. _parsefunc-if:

if
==

:aspect:`Property`
   if

:aspect:`Data type`
   :ref:`if`

:aspect:`Description`
   if "if" returns false, the input value is not parsed, but returned
   directly.


.. _parsefunc-examples:

Example
=======

This example takes the content of the field "bodytext" and parses it
through the :ref:`parsefunc-makelinks`-functions and substitutes all
:html:`<LINK>` and :html:`<TYPOLIST>`-tags with something else. ::

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
  
