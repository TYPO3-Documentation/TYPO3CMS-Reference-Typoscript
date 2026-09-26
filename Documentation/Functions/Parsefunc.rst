..  include:: /Includes.rst.txt
..  index::
    Functions; parseFunc
    parseFunc
..  _parsefunc:

=========
parseFunc
=========

..  versionchanged:: 14.0

    `lib.parseFunc.allowTags` and `lib.parseFunc_RTE.allowTags` do not contain
    default values anymore. HTML sanitization is continued to be  handled by
    the htmlSanitizer.

    See also: `Breaking: #107438 - Default parseFunc configuration for Fluid Styled Content <https://docs.typo3.org/permalink/changelog:breaking-107438-1736592000>`_

This object is used to parse some content for stuff like special typo
tags, the :ref:`makelinks <makeLinks>`-things and so on...

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
    :name: parsefunc-externalBlocks
    :type: list of tagnames / +properties

    This allows you to pre-split the content passed to parseFunc so that
    only content outside the blocks with the given tags is parsed.

    **Extra properties:**

    **.[tagname]** {

    *   **callRecursive:** :ref:`boolean <data-type-boolean>`. If set, the content of the block is
        directed into parseFunc again. Otherwise the content is passed
        through with no other processing than :ref:`stdWrap <stdwrap>` (see below).

    *   **callRecursive.dontWrapSelf:** :ref:`boolean <data-type-boolean>`. If set, the tags of the
        block is *not* wrapped around the content returned from parseFunc.

    *   **callRecursive.alternativeWrap:** Alternative wrapping instead of
        the original tags.

    *   **callRecursive.tagStdWrap:** :ref:`stdWrap <stdwrap>` processing of the block-tags.

    *   **stdWrap:** :ref:`stdWrap <stdwrap>` processing of the whole block (regardless of
        whether callRecursive was set.)

    *   **stripNLprev:** :ref:`boolean <data-type-boolean>`. Strips off last line break of the previous
        outside block.

    *   **stripNLnext:** :ref:`boolean <data-type-boolean>`. Strips off first line break of the next
        outside block.

    *   **stripNL:** :ref:`boolean <data-type-boolean>`. Does both of the above.

    *   **HTMLtableCells:** :ref:`boolean <data-type-boolean>`. If set, then the content is expected
        to be a table and every table-cell is traversed.

    Below, "default" means all cells and "1", "2", "3", ... overrides
    for specific columns.

    *   **HTMLtableCells.[default/1/2/3/...]** {

        *   **callRecursive:** :ref:`boolean <data-type-boolean>`. The content is parsed through current
            parseFunc.

        *   **stdWrap:** :ref:`stdWrap <stdwrap>` processing of the content in the cell.

        *   **tagStdWrap:** -> The :html:`<TD>` tag is processed by :ref:`stdWrap <stdwrap>`.


    *   **HTMLtableCells.addChr10BetweenParagraphs:** :ref:`boolean <data-type-boolean>`. If set, then
        all appearances of :html:`</P><P>` will have a :php:`chr(10)` inserted between them.

    ..  rubric:: Example

    This example is used to split regular bodytext content so that tables
    and blockquotes in the bodytext are processed correctly. The
    blockquotes are passed into parseFunc again (recursively) and further
    their top/bottom margins are set to 0 (so no apparent line breaks are
    seen)

    The tables are also displayed with a number of properties of the cells
    overridden

    ..  literalinclude:: _codesnippets/_externalBlocks.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _parsefunc-short:

short
-----

..  confval:: short
    :name: parsefunc-short
    :type: *(array of strings)*

    If this property is set, you can replace a char or word
    in your text with the value of the according constant.

    ..  rubric:: Example

    This replaces all occurrences of "T3" with "TYPO3 CMS"
    and "T3web" with a link to typo3.org.

    ..  literalinclude:: _codesnippets/_short.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _parsefunc-plainTextStdWrap:

plainTextStdWrap
----------------

..  confval:: plainTextStdWrap
    :name: parsefunc-plainTextStdWrap
    :type: :ref:`stdWrap <stdwrap>`

    This is :ref:`stdWrap <stdwrap>` properties for all non-tag content.


..  _parsefunc-userFunc:

userFunc
--------

..  confval:: userFunc
    :name: parsefunc-userFunc
    :type: :ref:`function name <data-type-function-name>`

    ..  important::

        ..  versionchanged:: 14.0

            PHP functions called via TypoScript **must** now use the PHP
            attribute :php:`#[AsAllowedCallable]`
            (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

    This passes the non-tag content to a function of your own choice.
    Similar to, for example, :ref:`postUserFunc <stdwrap-postUserFunc>` in :ref:`stdWrap <stdWrap>`,
    or :ref:`typolink.userFunc <typolink-userFunc>`.

..  _parsefunc-nonTypoTagStdWrap:

nonTypoTagStdWrap
-----------------

..  confval:: nonTypoTagStdWrap
    :name: parsefunc-nonTypoTagStdWrap
    :type: :ref:`stdWrap <stdWrap>`

    Like :ref:`plainTextStdWrap <parsefunc-plainTextStdWrap>`. Difference:

    :typoscript:`parsefunc-plainTextStdWrap` works on ALL non-tag pieces in the
    text. :ref:`nonTypoTagStdWrap <parsefunc-nonTypoTagStdWrap>` is post processing of all text
    (including tags) between special TypoTags
    (unless :typoscript:`breakoutTypoTagContent` is not set for the TypoTag).


..  _parsefunc-nonTypoTagUserFunc:

nonTypoTagUserFunc
------------------

..  confval:: nonTypoTagUserFunc
    :name: parsefunc-nonTypoTagUserFunc
    :type: :ref:`function name <data-type-function-name>`

    ..  important::

        ..  versionchanged:: 14.0

            PHP functions called via TypoScript **must** now use the PHP
            attribute :php:`#[AsAllowedCallable]`
            (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

    Like :ref:`userFunc <parsefunc-userFunc>`.
    Differences is (like :ref:`nonTypoTagStdWrap <parsefunc-nonTypoTagStdWrap>`)
    that this is post processing of all content pieces around TypoTags while
    :typoscript:`userFunc` processes all non-tag content.
    (Notice: :typoscript:`breakoutTypoTagContent` must be set for the TypoTag
    if it's excluded from :typoscript:`nonTypoTagContent`).


..  _parsefunc-makelinks:

makelinks
---------

..  confval:: makelinks
    :name: parsefunc-makelinks
    :type: :ref:`boolean <data-type-boolean>`

    Convert web addresses prefixed with `http://` and mail addresses
    prefixed with `mailto:` to links.

    See :ref:`makelinks <makelinks>` for additional properties.

..  _parsefunc-tags:

tags
----

..  confval:: tags
    :name: parsefunc-tags
    :type: :ref:`tags <tags>`

    Here you can define **custom tags** that will parse the content to
    something.


..  _parsefunc-allowTags:

allowTags
---------

..  confval:: allowTags
    :name: parsefunc-allowTags
    :type: list of strings or "*"
    :default: Empty

    ..  versionchanged:: 14.0

        `lib.parseFunc.allowTags` and `lib.parseFunc_RTE.allowTags` do not contain
        default values anymore. HTML sanitization is continued to be  handled by
        the htmlSanitizer.

        See also: `Breaking: #107438 - Default parseFunc configuration for Fluid
        Styled Content <https://docs.typo3.org/permalink/changelog:breaking-107438-1736592000>`_

    HTML sanitization is handled by the htmlSanitizer in general. `allowTags`
    and `denyTags` can be used to further limit the allowed HTML tags.

    List of tags, which are allowed to exist in code, use "*" for all.
    Security aspects are considered automatically by the HTML sanitizer,
    unless :typoscript:`htmlSanitize` is disabled explicitly.

    If a tag is found in :typoscript:`allowTags`, the corresponding tag in
    :ref:`denyTags <parsefunc-denyTags>` is ignored!

    ..  rubric:: Example

    The example allows any tag, except :html:`<u>` which will be encoded:

    ..  literalinclude:: _codesnippets/_allowTags.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    ..  rubric:: Migration

    If you need to allow specific HTML tags, fully configure the allowTags option
    without relying on prior default configuration:

    ..  code-block:: diff

        - lib.parseFunc_RTE.allowTags := addToList(wbr)
        + lib.parseFunc_RTE.allowTags = b,span,i,em,wbr..


..  _parsefunc-denyTags:

denyTags
--------

..  confval:: denyTags
    :name: parsefunc-denyTags
    :type: list of strings

    List of tags, which may **not** exist in code! (use :typoscript:`*` for all.)

    Lowest priority: If a tag is **not** found in :ref:`allowTags <parsefunc-allowTags>`,
    :typoscript:`denyTags` is checked.
    If denyTags is not :typoscript:`*` and the tag is not found in the list, the tag may exist!

    ..  rubric:: Example

    This allows :html:`<b>`, :html:`<i>`, :html:`<a>` and :html:`<img>` -tags to exist:

    ..  literalinclude:: _codesnippets/_denyTags.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _parsefunc-if:

if
--

..  confval:: if
    :name: parsefunc-if
    :type: :ref:`if <if>`

    if "if" returns false, the input value is not parsed, but returned
    directly.

..  _parsefunc-examples:

Example
=======

This example takes the content of the field "bodytext" and parses it
through the :ref:`makelinks <parsefunc-makelinks>`-functions and substitutes all
:html:`<LINK>` and :html:`<TYPOLIST>`-tags with something else.

..  literalinclude:: _codesnippets/_parsefunc.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
