.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _encapslines:

encapsLines
^^^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         encapsTagList

   Data type
         list of strings

   Description
         List of tags which qualify as encapsulating tags. Must be lowercase.

         **Example:** ::

            encapsTagList = div, p

         This setting will recognize the red line below as encapsulated lines::

            First line of text
            Some <div>text</div>
            <p>Some text</p>
            <div>Some text</div>
            <B>Some text</B>


.. container:: table-row

   Property
         remapTag.[*tagname*]

   Data type
         string

   Description
         Enter a new tag name here if you wish the tagname of any encapsulation
         to be unified to a single tag name.

         For instance, setting this value to "remapTag.P=DIV" would convert::

            <p>Some text</p>
            <div>Some text</div>

         to ::

            <div>Some text</div>
            <div>Some text</div>

         ([*tagname*] is in uppercase.)


.. container:: table-row

   Property
         addAttributes.[*tagname*]

   Data type
         *(array of strings)*

   Description
         Attributes to set in the encapsulation tag.

         **Example:** ::

            addAttributes.P {
              style=padding-bottom: 0px; margin-top: 1px; margin-bottom: 1px;
              align=center
            }

         ([*tagname*] is in uppercase.) ::

            .setOnly =

         exists : This will set the value ONLY if the property does not already
         exist.

         blank : This will set the value ONLY if the property does not already
         exist OR is blank ("").

         Default is to always override/set the value of the attributes.


.. container:: table-row

   Property
         removeWrapping

   Data type
         boolean

   Description
         If set, then all existing wrapping will be removed.

         This::

            First line of text
            Some <div>text</div>
            <p>Some text</p>
            <div>Some text</div>
            <b>Some text</b>

         becomes this::

            First line of text
            Some <div>text</div>
            Some text
            Some text
            <b>Some text</b>


.. container:: table-row

   Property
         wrapNonWrappedLines

   Data type
         wrap

   Description
         Wrapping for non-encapsulated lines

         **Example:** ::

            .wrapNonWrappedLines = <p>|</p>

         This::

            First line of text
            <p>Some text</p>

         becomes this::

            <P>First line of text</P>
            <p>Some text</p>


.. container:: table-row

   Property
         innerStdWrap\_all

   Data type
         ->stdWrap

   Description
         Wraps the content inside all lines, whether they are encapsulated or
         not.


.. container:: table-row

   Property
         encapsLinesStdWrap.[*tagname*]

   Data type
         ->stdWrap

   Description
         Wraps the content inside all encapsulated lines.

         ([*tagname*] is in uppercase.)


.. container:: table-row

   Property
         defaultAlign

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If set, this value is set as the default "align" value of the wrapping
         tags, both from .encapsTagList, .bypassEncapsTagList and
         .nonWrappedTag


.. container:: table-row

   Property
         nonWrappedTag

   Data type
         tagname

   Description
         For all non-wrapped lines, you can here set a tag in which they
         should be wrapped. Example would be "p". This is an alternative to
         .wrapNonWrappedLines and has the advantage that its attributes are
         set by .addAttributes as well as defaultAlign. Thus you can match
         the wrapping tags used for non-wrapped and wrapped lines more easily.


.. ###### END~OF~TABLE ######

[tsref:->encapsLines]


.. _encapslines-examples:

Example:
""""""""

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
content looks like this::

   <p>This is line # 1 </p>
   <p>&nbsp;</p>
   <p>[Above is an empty line!] </p>
   <p style="text-align: right;">This line is right-aligned.</p>

Each line is nicely wrapped with <p> tags. The line from the database
which was *already* wrapped (but in <div>-tags) has been converted to
<p>, but keeps it's alignment. Overall, notice that the Rich Text
Editor ONLY stored the line which was in fact right-aligned - every
other line from the RTE was stored without any wrapping tags, so that
the content in the database remains as human readable as possible.


Example:
""""""""

::

   # Make sure nonTypoTagStdWrap operates on content outside <typolist> and <typohead> only:
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
     addAttributes.p {
       style=margin: 0 0 0;
     }
     innerStdWrap_all.ifEmpty = &nbsp;
     innerStdWrap_all.textStyle < tt_content.text.20.textStyle
   }
   # Finally removing the old textstyle formatting on the whole bodytext part.
   tt_content.text.20.textStyle >
   # ... and <br>-tag after the content is not needed either...
   tt_content.text.20.wrap >

This is an example of how to wrap traditional tt\_content bodytext
with <p> tags, setting the line-distances to regular space like that
generated by a <br> tag, but staying compatible with the RTE features
such as assigning classes and alignment to paragraphs.

