..  include:: /Includes.rst.txt
..  index::
    Functions; encapsLines
    encapsLines
..  _encapslines:

===========
encapsLines
===========

This function is a sub-function of :ref:`stdWrap <stdwrap>` and can be used
like this:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    page.20 = TEXT
    page.20 {
        value (
            First line of text
            Some <div>text</div>
            <p>Some text</p>
            <div>Some text</div>
            <B>Some text</B>
        )
        stdWrap.encapsLines {
            encapsTagList = div, p
            remapTag.P=DIV
        }
    }


..  contents::
    :local:

Properties
==========

..  _encapslines-encapsTagList:

encapsTagList
-------------

..  confval:: encapsTagList

    :Data type: list of :ref:`data-type-string`

    List of tags which qualify as encapsulating tags. Must be lowercase.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        encapsTagList = div, p

    This setting will recognize the highlighted lines below as encapsulated lines:

    ..  code-block:: html
        :caption: Example Output
        :emphasize-lines: 3,4

        First line of text
        Some <div>text</div>
        <p>Some text</p>
        <div>Some text</div>
        <B>Some text</B>


..  _encapslines-remapTag:

remapTag.[*tagname*]
--------------------

..  confval:: remapTag

    :Data type: array of :ref:`data-type-string`

    Enter a new tag name here if you wish the tag name of any encapsulation
    to be unified to a single tag name.

    For instance, setting this value to :typoscript:`remapTag.P=DIV` would convert:

    ..  code-block:: html

        <p>Some text</p>
        <div>Some text</div>

    to :

    ..  code-block:: html

        <div>Some text</div>
        <div>Some text</div>

    ([*tagname*] is in uppercase.)


..  _encapslines-addAttributes:

addAttributes.[*tagname*]
-------------------------

..  confval:: addAttributes

    :Data type: array of :ref:`data-type-string`
    :Default: Always override/set the value of the attributes.

    Attributes to set in the encapsulation tag.

    ([*tagname*] is in uppercase.)

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        addAttributes.P.setOnly = exists

    exists
        This will set the value ONLY if the property does not already exist.

    blank
        This will set the value ONLY if the property does not already exist OR is
        blank ("").

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        addAttributes.P {
            style = padding-bottom: 0px; margin-top: 1px; margin-bottom: 1px;
            align = center
        }


..  _encapslines-removeWrapping:

removeWrapping
--------------

..  confval:: removeWrapping

    :Data type: :ref:`data-type-boolean`

    If set, then all existing wrapping will be removed.

    This:

    ..  code-block:: html

        First line of text
        Some <div>text</div>
        <p>Some text</p>
        <div>Some text</div>
        <b>Some text</b>

    becomes this:

    ..  code-block:: html

        First line of text
        Some <div>text</div>
        Some text
        Some text
        <b>Some text</b>


..  _encapslines-wrapNonWrappedLines:

wrapNonWrappedLines
-------------------

..  confval:: wrapNonWrappedLines

    :Data type: :ref:`stdwrap-wrap`

    Wrapping for non-encapsulated lines

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        wrapNonWrappedLines = <p>|</p>

    This:

    ..  code-block:: html

        First line of text
        <p>Some text</p>

    becomes this:

    ..  code-block:: html

        <P>First line of text</P>
        <p>Some text</p>


..  _encapslines-innerStdWrap-all:

innerStdWrap\_all
-----------------

..  confval:: innerStdWrap_all

    :Data type: :ref:`stdWrap`

    Wraps the content inside all lines, whether they are encapsulated or
    not.


..  _encapslines-encapsLinesStdWrap:

encapsLinesStdWrap.[*tagname*]
------------------------------

..  confval:: encapsLinesStdWrap

    :Data type: array of :ref:`data-type-string` / :ref:`stdWrap`

    Wraps the content inside all encapsulated lines.

    ([*tagname*] is in uppercase.)


..  _encapslines-defaultAlign:

defaultAlign
------------

..  confval:: defaultAlign

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    If set, this value is set as the default "align" value of the wrapping
    tags, both from :ref:`encapslines-encapsTagList` and
    :ref:`encapslines-nonWrappedTag`


..  _encapslines-nonWrappedTag:

nonWrappedTag
-------------

..  confval:: nonWrappedTag

    :Data type: :typoscript:`tagname`

    For all non-wrapped lines, you can here set a tag in which they
    should be wrapped. Example would be "p". This is an alternative to
    :typoscript:`wrapNonWrappedLines` and has the advantage that its attributes are
    set by :typoscript:`addAttributes` as well as :typoscript:`defaultAlign`.
    Thus you can match the wrapping tags used for non-wrapped and wrapped
    lines more easily.


..  _encapslines-examples:

Examples
========

:html:`<p>` tag is used to encapsulate each line
------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    encapsLines {
        encapsTagList = div,p
        remapTag.DIV = P
        wrapNonWrappedLines = <p>|</p>
        innerStdWrap_all.ifEmpty = &nbsp;
    }

This example shows how to handle content rendered by TYPO3 and
stylesheets where the :html:`<p>` tag is used to encapsulate each line.

Say, you have made this content with the rich text editor:

..  code-block:: none
    :caption: Example input

    This is line # 1

    [Above is an empty line!]
    <div style="text-align: right;">This line is right-aligned.</div>

After being processed by encapsLines with the above configuration, the
content looks like this:

..  code-block:: html
    :caption: Example output

    <p>This is line # 1 </p>
    <p>&nbsp;</p>
    <p>[Above is an empty line!] </p>
    <p style="text-align: right;">This line is right-aligned.</p>

Each line is nicely wrapped with :html:`<p>` tags. The line from the database
which was *already* wrapped (but in :html:`<div>` tags) has been converted to
:html:`<p>`, but keeps its alignment. Overall, notice that the rich text editor
ONLY stored the line which was in fact right-aligned - every other line from the
RTE was stored without any wrapping tags, so that the content in the database
remains as human readable as possible.


Advanced example
----------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    # Make sure nonTypoTagStdWrap operates
    # on content outside <typolist> and <typohead> only:
    tt_content.text.20.parseFunc.tags.typolist.breakoutTypoTagContent = 1
    tt_content.text.20.parseFunc.tags.typohead.breakoutTypoTagContent = 1
    # ... and no <br> before typohead.
    tt_content.text.20.parseFunc.tags.typohead.stdWrap.wrap >
    # Setting up nonTypoTagStdWrap to wrap the text with p tags
    tt_content.text.20.parseFunc.nonTypoTagStdWrap >
    tt_content.text.20.parseFunc.nonTypoTagStdWrap.encapsLines {
        encapsTagList = div,p
        remapTag.DIV = P
        wrapNonWrappedLines = <p style="margin: 0 0 0;">|</p>

        # Forcing these attributes onto the encapsulation tags if any
        addAttributes.P {
            style=margin: 0 0 0;
        }
        innerStdWrap_all.ifEmpty = &nbsp;
    }
    # Finally removing the <br> tag after the content...
    tt_content.text.20.wrap >

This is an example of how to wrap the table field :sql:`tt_content.bodytext`
with :html:`<p>` tags, setting the line distances to regular space like that
generated by a :html:`<br>` tag, but staying compatible with the RTE features
such as assigning classes and alignment to paragraphs.
