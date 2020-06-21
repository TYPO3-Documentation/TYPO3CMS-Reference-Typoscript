.. include:: ../Includes.txt


.. _encapslines:

===========
encapsLines
===========

.. _encapstaglist:

encapsTagList
=============

:aspect:`Property`
   encapsTagList

:aspect:`Data type`
   list of strings

:aspect:`Description`
   List of tags which qualify as encapsulating tags. Must be lowercase.

:aspect:`Example`
   ::

      encapsTagList = div, p

   This setting will recognize the red line below as encapsulated lines:

   .. code-block:: html

      First line of text
      Some <div>text</div>
      <p>Some text</p>
      <div>Some text</div>
      <B>Some text</B>

remapTag.[*tagname*]
====================

:aspect:`Property`
   remapTag.[*tagname*]

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   Enter a new tag name here if you wish the tagname of any encapsulation
   to be unified to a single tag name.

   For instance, setting this value to :ts:`remapTag.P=DIV` would convert:

   .. code-block:: html

      <p>Some text</p>
      <div>Some text</div>

   to :

   .. code-block:: html

      <div>Some text</div>
      <div>Some text</div>

   ([*tagname*] is in uppercase.)

.. _addattributes.[*tagname*]:

addAttributes.[*tagname*]
=========================

:aspect:`Property`
   addAttributes.[*tagname*]

:aspect:`Data type`
   *(array of strings)*

:aspect:`Description`
   Attributes to set in the encapsulation tag.

   ([*tagname*] is in uppercase.) ::

      .setOnly =

   exists
      This will set the value ONLY if the property does not already exist.

   blank
      This will set the value ONLY if the property does not already exist OR is
      blank ("").

:aspect:`Default`
   Always override/set the value of the attributes.

:aspect:`Example`
   ::

      addAttributes.P {
            style = padding-bottom: 0px; margin-top: 1px; margin-bottom: 1px;
            align = center
      }

.. _removewrapping:

removeWrapping
==============

:aspect:`Property`
   removeWrapping

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, then all existing wrapping will be removed.

   This:

   .. code-block:: html

      First line of text
      Some <div>text</div>
      <p>Some text</p>
      <div>Some text</div>
      <b>Some text</b>

   becomes this:

   .. code-block:: html

      First line of text
      Some <div>text</div>
      Some text
      Some text
      <b>Some text</b>

.. _wrapnonwrappedlines:

wrapNonWrappedLines
===================

:aspect:`Property`
   wrapNonWrappedLines

:aspect:`Data type`
   :ref:`stdwrap-wrap`

:aspect:`Description`
   Wrapping for non-encapsulated lines

:aspect:`Example`
   ::

      wrapNonWrappedLines = <p>|</p>

   This:

   .. code-block:: html

      First line of text
      <p>Some text</p>

   becomes this:

   .. code-block:: html

      <P>First line of text</P>
      <p>Some text</p>

.. _innerstdwrap\_all:

innerStdWrap\_all
=================

:aspect:`Property`
   innerStdWrap\_all

:aspect:`Data type`
   :ref:`stdWrap`

:aspect:`Description`
   Wraps the content inside all lines, whether they are encapsulated or
   not.

.. _encapslinesstdwrap.[*tagname*]:

encapsLinesStdWrap.[*tagname*]
==============================

:aspect:`Property`
   encapsLinesStdWrap.[*tagname*]

:aspect:`Data type`
   :ref:`stdWrap`

:aspect:`Description`
   Wraps the content inside all encapsulated lines.

   ([*tagname*] is in uppercase.)


.. _defaultalign:

defaultAlign
============

:aspect:`Property`
   defaultAlign

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   If set, this value is set as the default "align" value of the wrapping
   tags, both from :ref:`encapsTagList`, :ts:`bypassEncapsTagList` and
   :ref:`nonWrappedTag`

.. _nonwrappedtag:

nonWrappedTag
=============

:aspect:`Property`
   nonWrappedTag

:aspect:`Data type`
   :ts:`tagname`

:aspect:`Description`
   For all non-wrapped lines, you can here set a tag in which they
   should be wrapped. Example would be "p". This is an alternative to
   :ts:`wrapNonWrappedLines` and has the advantage that its attributes are
   set by :ts:`addAttributes` as well as :ts:`defaultAlign`.
   Thus you can match the wrapping tags used for non-wrapped and wrapped
   lines more easily.



.. _encapslines-examples:

Example
=======

::

   encapsLines {
       encapsTagList = div,p
       remapTag.DIV = P
       wrapNonWrappedLines = <p>|</p>
       innerStdWrap_all.ifEmpty = &nbsp;
   }

This example shows how to handle content rendered by TYPO3 and
stylesheets where the <p> tag is used to encapsulate each line.

Say, you have made this content with the Rich Text Editor::

   This is line # 1

   [Above is an empty line!]
   <div style="text-align: right;">This line is right-aligned.</div>

After being processed by encapsLines with the above configuration, the
content looks like this:

.. code-block:: html

   <p>This is line # 1 </p>
   <p>&nbsp;</p>
   <p>[Above is an empty line!] </p>
   <p style="text-align: right;">This line is right-aligned.</p>

Each line is nicely wrapped with :html:`<p>` tags. The line from the database
which was *already* wrapped (but in :html:`<div>`-tags) has been converted to
:html:`<p>`, but keeps it's alignment. Overall, notice that the Rich Text Editor
ONLY stored the line which was in fact right-aligned - every other line from the
RTE was stored without any wrapping tags, so that the content in the database
remains as human readable as possible.


Example
=======

::

   # Make sure nonTypoTagStdWrap operates
   # on content outside <typolist> and <typohead> only:
   tt_content.text.20.parseFunc.tags.typolist.breakoutTypoTagContent = 1
   tt_content.text.20.parseFunc.tags.typohead.breakoutTypoTagContent = 1
   # ... and no <br> before typohead.
   tt_content.text.20.parseFunc.tags.typohead.stdWrap.wrap >
   # Setting up nonTypoTagStdWrap to wrap the text with p-tags
   tt_content.text.20.parseFunc.nonTypoTagStdWrap >
   tt_content.text.20.parseFunc.nonTypoTagStdWrap.encapsLines {
       encapsTagList = div,p
       remapTag.DIV = P
       wrapNonWrappedLines = <p style="margin: 0 0 0;">|</p>

       # Forcing these attributes onto the encapsulation-tags if any
       addAttributes.P {
           style=margin: 0 0 0;
       }
       innerStdWrap_all.ifEmpty = &nbsp;
   }
   # Finally removing the <br>-tag after the content...
   tt_content.text.20.wrap >

This is an example of how to wrap traditional tt\_content bodytext
with :html:`<p>` tags, setting the line-distances to regular space like that
generated by a :html:`<br>` tag, but staying compatible with the RTE features
such as assigning classes and alignment to paragraphs.
