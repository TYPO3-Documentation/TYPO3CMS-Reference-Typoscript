..  include:: /Includes.rst.txt
..  index::
    Functions; parseFunc
    parseFunc
..  _parsefunc:

=========
parseFunc
=========

This object is used to parse some content for stuff like special typo
tags, the :ref:`makeLinks`-things and so on...

..  contents::
    :local:

..  index:: parsefunc; Properties
..  _parsefunc-properties:

Properties
==========

..  _parsefunc-externalBlocks:

externalBlocks
--------------

..  confval:: externalBlocks

    :Data type: list of tagnames / +properties

    This allows you to pre-split the content passed to parseFunc so that
    only content outside the blocks with the given tags is parsed.

    **Extra properties:**

    **.[tagname]** {

    *  **callRecursive:** :ref:`data-type-boolean`. If set, the content of the block is
       directed into parseFunc again. Otherwise the content is passed
       through with no other processing than :ref:`stdwrap` (see below).

    *  **callRecursive.dontWrapSelf:** :ref:`data-type-boolean`. If set, the tags of the
       block is *not* wrapped around the content returned from parseFunc.

    *  **callRecursive.alternativeWrap:** Alternative wrapping instead of
       the original tags.

    *  **callRecursive.tagStdWrap:** :ref:`stdwrap` processing of the block-tags.

    *  **stdWrap:** :ref:`stdwrap` processing of the whole block (regardless of
       whether callRecursive was set.)

    *  **stripNLprev:** :ref:`data-type-boolean`. Strips off last line break of the previous
       outside block.

    *  **stripNLnext:** :ref:`data-type-boolean`. Strips off first line break of the next
       outside block.

    *  **stripNL:** :ref:`data-type-boolean`. Does both of the above.

    *  **HTMLtableCells:** :ref:`data-type-boolean`. If set, then the content is expected
       to be a table and every table-cell is traversed.

    Below, "default" means all cells and "1", "2", "3", ... overrides
    for specific columns.

    *  **HTMLtableCells.[default/1/2/3/...]** {

       *  **callRecursive:** :ref:`data-type-boolean`. The content is parsed through current
          parseFunc.

       *  **stdWrap:** :ref:`stdwrap` processing of the content in the cell.

       *  **tagStdWrap:** -> The :html:`<TD>` tag is processed by :ref:`stdwrap`.


    *  **HTMLtableCells.addChr10BetweenParagraphs:** :ref:`data-type-boolean`. If set, then
       all appearances of :html:`</P><P>` will have a :php:`chr(10)` inserted between them.

    ..  rubric:: Example

    This example is used to split regular bodytext content so that tables
    and blockquotes in the bodytext are processed correctly. The
    blockquotes are passed into parseFunc again (recursively) and further
    their top/bottom margins are set to 0 (so no apparent line breaks are
    seen)

    The tables are also displayed with a number of properties of the cells
    overridden

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript


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


..  _parsefunc-short:

short
-----

..  confval:: short

    :Data type: *(array of strings)*

    If this property is set, you can use markers (the short name
    wrapped in "###") in your text. TYPO3 then substitutes the markers
    with the value of the according constant.

    ..  rubric:: Example

    This substitutes all occurrences of "###T3###" with "TYPO3 CMS"
    and "###T3web###" with a link to typo3.org.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.value = Learn more about ###T3###, look here: ###T3web###
        page.10.userFunc.short {
              T3 = TYPO3 CMS
              T3web = <a href="https://typo3.org">typo3.org</a>
        }
        # Output: Learn more about TYPO3 CMS, look here: <a href="https://typo3.org">typo3.org</a>


..  _parsefunc-plainTextStdWrap:

plainTextStdWrap
----------------

..  confval:: plainTextStdWrap

    :Data type: :ref:`stdwrap`

    This is :ref:`stdwrap` properties for all non-tag content.


..  _parsefunc-userFunc:

userFunc
--------

..  confval:: userFunc

    :Data type: :ref:`data-type-function-name`

    This passes the non-tag content to a function of your own choice.
    Similar to, for example, :ref:`stdwrap-postUserFunc` in :ref:`stdWrap`.

    Remember the function name must possibly be prepended :php:`user_`.


..  _parsefunc-nonTypoTagStdWrap:

nonTypoTagStdWrap
-----------------

..  confval:: nonTypoTagStdWrap

    :Data type: :ref:`stdWrap`

    Like :ref:`parsefunc-plainTextStdWrap`. Difference:

    :typoscript:`parsefunc-plainTextStdWrap` works on ALL non-tag pieces in the
    text. :ref:`parsefunc-nonTypoTagStdWrap` is post processing of all text
    (including tags) between special TypoTags
    (unless :typoscript:`breakoutTypoTagContent` is not set for the TypoTag).


..  _parsefunc-nonTypoTagUserFunc:

nonTypoTagUserFunc
------------------

..  confval:: nonTypoTagUserFunc

    :Data type: :ref:`data-type-function-name`

    Like :ref:`parsefunc-userFunc`.
    Differences is (like :ref:`parsefunc-nonTypoTagStdWrap`)
    that this is post processing of all content pieces around TypoTags while
    :typoscript:`userFunc` processes all non-tag content.
    (Notice: :typoscript:`breakoutTypoTagContent` must be set for the TypoTag
    if it's excluded from :typoscript:`nonTypoTagContent`).


..  _parsefunc-makelinks:

makelinks
---------

..  confval:: makelinks

    :Data type: :ref:`data-type-boolean`

    Convert web addresses prefixed with `http://` and mail addresses
    prefixed with `mailto:` to links.


..  _parsefunc-tags:

tags
----

..  confval:: tags

    :Data type: :ref:`tags`

    Here you can define **custom tags** that will parse the content to
    something.


..  _parsefunc-allowTags:

allowTags
---------

..  confval:: allowTags

    :Data type: list of strings

    List of tags, which are allowed to exist in code!

    Highest priority: If a tag is found in :typoscript:`allowTags`,
    :ref:`parsefunc-denyTags` is ignored!


..  _parsefunc-denyTags:

denyTags
--------

..  confval:: denyTags

    :Data type: list of strings

    List of tags, which may **not** exist in code! (use :typoscript:`*` for all.)

    Lowest priority: If a tag is **not** found in :ref:`parsefunc-allowTags`,
    :typoscript:`denyTags` is checked.
    If denyTags is not :typoscript:`*` and the tag is not found in the list, the tag may exist!

    ..  rubric:: Example


    This allows :html:`<b>`, :html:`<i>`, :html:`<a>` and :html:`<img>` -tags to exist:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        tt_content.text.20.parseFunc {
            allowTags = b,i,a,img
            denyTags = *
        }


..  _parsefunc-if:

if
--

.. confval:: if

    :Data type: :ref:`if`

    if "if" returns false, the input value is not parsed, but returned
    directly.

..  _parsefunc-examples:

Example
=======

This example takes the content of the field "bodytext" and parses it
through the :ref:`parsefunc-makelinks`-functions and substitutes all
:html:`<LINK>` and :html:`<TYPOLIST>`-tags with something else.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
