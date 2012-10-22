

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


stdWrap
^^^^^^^

This function is often added as a property to values in TypoScript.

Example with the property "value" of the content-object, "TEXT":

::

   10 = TEXT
   10.value = some text
   10.case = upper

Here the content of the object "10" is uppercased before it's
returned.

stdWrap properties are executed in the order they appear in the table
below. If you want to study this further please refer to
typo3/sysext/cms/tslib/class.tslib\_content.php, where you will find
the function stdWrap() and the array $stdWrapOrder, which represents
the exact order of execution.

Note that the stdWrap property "orderedStdWrap" allows you to execute
multiple stdWrap functions in a freely selectable order.


Content-supplying properties of stdWrap
"""""""""""""""""""""""""""""""""""""""

The properties in this table are parsed in the listed order. The
properties "data", "field", "current", "cObject" (in that order!) are
special as they are used to import content from variables or arrays.
The above example could be rewritten to this:

::

   10 = TEXT
   10.value = some text
   10.case = upper
   10.field = header

Now the line "10.value = some text" is obsolete, because the whole
value is "imported" from the field called "header" from the $cObj
->data-array.


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
         Get data:


.. container:: table-row

   Property
         setContentToCurrent
   
   Data type
         boolean
   
   Description
         Sets the current value to the incoming content of the function.
   
   Default


.. container:: table-row

   Property
         setCurrent
   
   Data type
         string /stdWrap
   
   Description
         Sets the "current"-value. This is normally set from some outside
         routine, so be careful with this. But it might be handy to do this
   
   Default


.. container:: table-row

   Property
         lang
   
   Data type
         Array of language keys
   
   Description
         This is used to define optional language specific values.
         
         If the global language key set by the ->config property .language is
         found in this array, then this value is used instead of the default
         input value to stdWrap.
         
         **Example:**
         
         ::
         
            config.language = de
            page.10 = TEXT
            page.10.value = I am a Berliner!
            page.10.lang.de = Ich bin ein Berliner!
         
         Output will be "Ich bin..." instead of "I am..."
   
   Default


.. container:: table-row

   Property
         data
   
   Data type
         getText
   
   Description
   
   
   Default


.. container:: table-row

   Property
         field
   
   Data type
         Field name
   
   Description
         Sets the content to the value $cObj->data[ *field* ]
         
         **Example:** Set content to the value of field "title": ".field =
         title"
         
         $cObj->data changes. See the description for the data type
         "getText"/field!
         
         **Note:** You can also divide field names by "//". Say, you set
         "nav\_title // title" as the value, then the content from the field
         nav\_title will be returned unless it is a blank string, in which case
         the title-field's value is returned.
   
   Default


.. container:: table-row

   Property
         current
   
   Data type
         boolean
   
   Description
         Sets the content to the "current"-value (see ->split)
   
   Default


.. container:: table-row

   Property
         cObject
   
   Data type
         cObject
   
   Description
         Loads content from a content-object
   
   Default


.. container:: table-row

   Property
         numRows
   
   Data type
         ->numRows
   
   Description
         Returns the number of rows resulting from the select
   
   Default


.. container:: table-row

   Property
         filelist
   
   Data type
         dir /stdWrap
   
   Description
         Reads a directory and returns a list of files.
         
         The value is exploded by "\|" into parameters:
         
         1: The path
         
         2: comma-list of allowed extensions (no spaces between); if empty all
         extensions goes.
         
         3: sorting: name, size, ext, date, mdate (modification date)
         
         4: reverse: Set to "r" if you want a reversed sorting
         
         5: fullpath\_flag: If set, the filelist is returned with complete
         paths, and not just the filename
   
   Default


.. container:: table-row

   Property
         preUserFunc
   
   Data type
         Function name
   
   Description
         Calling a PHP-function or method in a class, passing the current
         content to the function as first parameter and any properties as
         second parameter.
         
         See  *.postUserFunc*
   
   Default


.. container:: table-row

   Property
         Override / Conditions:


.. container:: table-row

   Property
         override
   
   Data type
         string /stdWrap
   
   Description
         if "override" returns something else than "" or zero (trimmed), the
         content is loaded with this!
   
   Default


.. container:: table-row

   Property
         preIfEmptyListNum
   
   Data type
         (as "listNum" below)
   
   Description
         (as "listNum" below)
   
   Default


.. container:: table-row

   Property
         ifEmpty
   
   Data type
         string /stdWrap
   
   Description
         if the content is empty (trimmed) at this point, the content is loaded
         with "ifEmpty". Zeros are treated as empty values!
   
   Default


.. container:: table-row

   Property
         ifBlank
   
   Data type
         string /stdWrap
   
   Description
         Same as "ifEmpty" but the check is done using strlen().
   
   Default


.. container:: table-row

   Property
         listNum
   
   Data type
         int
         
         +calc
         
         +"last"
         
         +"rand"
   
   Description
         Explodes the content with "," (comma) and the content is set to the
         item[ *value* ].
         
         **Special keyword:** "last" is set to the last element of the array!
         
         (Since TYPO3 4.6) **Special keyword** : "rand" returns a random item
         out of a list.
         
         **.splitChar** (string):
         
         Defines the string used to explode the value. If splitChar is an
         integer, the character with that number is used (eg. "10" to split
         lines...).
         
         Default: "," (comma)
         
         **.stdWrap** (stdWrap properties):
         
         stdWrap properties of the listNum...
         
         **Examples:**
         
         We have a value of "item 1, item 2, item 3, item 4":
         
         This would return "item 3":
         
         ::
         
            .listNum = last – 1
         
         That way the subtitle field to be displayed is chosen randomly upon
         every reload:
         
         ::
         
            page.5 = COA_INT
            page.5 {
              10 = TEXT
              10 {
                field = subtitle
                stdWrap.listNum = rand
              }
            }
   
   Default


.. container:: table-row

   Property
         trim
   
   Data type
   
   
   Description
         PHP-function trim(); Removes whitespace around value
   
   Default


.. container:: table-row

   Property
         stdWrap
   
   Data type
         ->stdWrap
   
   Description
         Recursive call to stdWrap function
   
   Default


.. container:: table-row

   Property
         required
   
   Data type
         boolean
   
   Description
         This flag requires the content to be set to some value after any
         content-import and treatment that might have happened now (data,
         field, current, listNum, trim). Zero is NOT regarded as empty! Use
         "if" instead!
         
         If the content i empty, "" is returned immediately.
   
   Default


.. container:: table-row

   Property
         if
   
   Data type
         ->if
   
   Description
         If the if-object returns false, stdWrap returns "" immediately
   
   Default


.. container:: table-row

   Property
         fieldRequired
   
   Data type
         Field name
   
   Description
         value in this field MUST be set
   
   Default


.. container:: table-row

   Property
         Parse data:


.. container:: table-row

   Property
         csConv
   
   Data type
         string
   
   Description
         Convert the charset of the string from the charset given as value to
         the current rendering charset of the frontend (renderCharset).
   
   Default


.. container:: table-row

   Property
         parseFunc
   
   Data type
         object path reference / ->parseFunc
   
   Description
         Processing instructions for the content.
         
         **Notice:** If you enter a string as value this will be taken as a
         reference to an object path globally in the TypoScript object tree.
         This will be the basis configuration for parseFunc merged with any
         properties you add here. It works exactly like references does for
         content elements.
         
         **Example:**
         
         ::
         
            parseFunc = < lib.parseFunc_RTE
            parseFunc.tags.myTag = TEXT
            parseFunc.tags.myTag.value = This will be inserted when &lt;myTag&gt; is found!
   
   Default


.. container:: table-row

   Property
         HTMLparser
   
   Data type
         boolean / ->HTMLparser
   
   Description
         This object allows you to parse the HTML-content and make all kinds of
         advanced filterings on the content.
         
         Value must be set and properties are those of ->HTMLparser.
         
         (See "Core API" for ->HTMLparser options)
   
   Default


.. container:: table-row

   Property
         split
   
   Data type
         ->split
   
   Description
   
   
   Default


.. container:: table-row

   Property
         replacement
   
   Data type
         ->replacement
   
   Description
         (Since TYPO3 4.6) Performs an ordered search/replace on the current
         content with the possibility of using PCRE regular expressions. An
         array with numeric indices defines the order of actions and thus
         allows multiple replacements at once.
   
   Default


.. container:: table-row

   Property
         prioriCalc
   
   Data type
         boolean
   
   Description
         Calculation of the value using operators -+\*/%^ plus respects
         priority to + and - operators and parenthesis levels ().
         
         . (period) is decimal delimiter.
         
         Returns a doublevalue.
         
         If .prioriCalc is set to "intval" an integer is returned.
         
         There is no error checking and division by zero or other invalid
         values may generate strange results. Also you use a proper syntax
         because future modifications to the function used may allow for more
         operators and features.
         
         **Examples:**
         
         ::
         
            100%7 = 2
            -5*-4 = 20
            +6^2 = 36
            6 ^(1+1) = 36
            -5*-4+6^2-100%7 = 54 
            -5 * (-4+6) ^ 2 - 100%7 = 98
            -5 * ((-4+6) ^ 2) - 100%7 = -22
   
   Default


.. container:: table-row

   Property
         char
   
   Data type
         int
   
   Description
         Content is set to the chr( *value* ).
         
         ::
         
            PHP: $content = chr(intval($conf['char']);
   
   Default


.. container:: table-row

   Property
         intval
   
   Data type
         boolean
   
   Description
         PHP function intval(); Returns an integer.
         
         ::
         
            PHP: $content = intval($content);
   
   Default


.. container:: table-row

   Property
         hash
   
   Data type
         string /stdWrap
   
   Description
         (Since TYPO3 4.6) Returns a hashed value of the current content. Set
         to one of the algorithms which are available in PHP. For a list of
         supported algorithms see `http://www.php.net/manual/en/function.hash-
         algos.php <http://www.php.net/manual/en/function.hash-algos.php>`_ .
         
         **Example:**
         
         ::
         
            page.10 = TEXT
            page.10 {
              value = test@example.com
              hash = md5
              wrap = <img src="http://www.gravatar.com/avatar/|" />
            }
   
   Default


.. container:: table-row

   Property
         round
   
   Data type
         ->round
   
   Description
         (Since TYPO3 4.6) Round the value with the selected method to the
         given number of decimals.
   
   Default


.. container:: table-row

   Property
         numberFormat
   
   Data type
         ->numberFormat
   
   Description
         Format a float value to any number format you need (e.g. useful for
         prices).
   
   Default


.. container:: table-row

   Property
         date
   
   Data type
         date-conf
   
   Description
         The content should be data-type "UNIX-time". Returns the content
         formatted as a date.
         
         ::
         
            PHP: $content = date($conf['date'], $content);
         
         Properties:
         
         **.GMT** : If set, the PHP function gmdate() will be used instead of
         date().
         
         **Example** where a timestamp is imported:
         
         ::
         
            .value.field = tstamp
            .value.date =
   
   Default


.. container:: table-row

   Property
         strftime
   
   Data type
         strftime-conf
   
   Description
         Exactly like "date" above. See the PHP-manual (strftime) for the
         codes, or datatype "strftime-conf".
         
         This formatting is useful if the locale is set in advance in the
         CONFIG-object. See this.
         
         Properties:
         
         **.charset** : Can be set to the charset of the output string if you
         need to convert it to renderCharset. Default is to take the
         intelligently guessed charset from t3lib\_cs.
         
         **.GMT** : If set, the PHP function gmstrftime() will be used instead
         of strftime().
   
   Default


.. container:: table-row

   Property
         age
   
   Data type
         boolean or string
   
   Description
         If enabled with a "1" (number, integer) the content is seen as a date
         (UNIX-time) and the difference from present time and the content-time
         is returned as one of these eight variations:
         
         "xx min" or "xx hrs" or "xx days" or "xx yrs" or "xx min" or "xx hour"
         or "xx day" or "year"
         
         The limits between which layout is used are 60 minutes, 24 hours and
         365 days.
         
         If you set this property with a non-integer, it is used to format the
         eight units. The first four values are the plural values and the last
         four are singular. This is the default string:
         
         ::
         
            " min| hrs| days| yrs| min| hour| day| year"
         
         Set another string if you want to change the units. You may include
         the "-signs. They are removed anyway, but they make sure that a space
         which you might want between the number and the unit stays.
         
         **Example:**
         
         ::
         
            lib.ageFormat = TEXT
            lib.ageFormat.data = page:tstamp
            lib.ageFormat.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"
   
   Default


.. container:: table-row

   Property
         case
   
   Data type
         case
   
   Description
         Converts case
         
         Uses "renderCharset" for the operation.
   
   Default


.. container:: table-row

   Property
         bytes
   
   Data type
         boolean
   
   Description
         Will format the input (an integer) as bytes: bytes, kb, mb
         
         If you add a value for the property "labels" you can alter the default
         suffixes. Labels for bytes, kilo, mega and giga are separated by
         vertical bar (\|) and possibly encapsulated in "". Eg: " \| K\| M\| G"
         (which is the default value)
         
         Thus:
         
         ::
         
            bytes.labels = " | K| M| G"
   
   Default


.. container:: table-row

   Property
         substring
   
   Data type
         [p1], [p2]
   
   Description
         Returns the substring with [p1] and [p2] sent as the 2nd and 3rd
         parameter to the PHP substring function.
         
         Uses "renderCharset" for the operation.
   
   Default


.. container:: table-row

   Property
         removeBadHTML
   
   Data type
         boolean
   
   Description
         Removes "bad" HTML code based on a pattern that filters away HTML that
         is considered dangerous for XSS bugs.
   
   Default


.. container:: table-row

   Property
         cropHTML
   
   Data type
   
   
   Description
         Crops the content to a certain length. In contrast to stdWrap.crop it
         respects HTML tags. It does not crop inside tags and closes open tags.
         Entities (like ">") are counted as one char. See stdWrap.crop below
         for a syntax description and examples.
         
         Note that stdWrap.crop should not be used if stdWrap.cropHTML is
         already used.
   
   Default


.. container:: table-row

   Property
         stripHtml
   
   Data type
         boolean
   
   Description
         Strips all html-tags.
   
   Default


.. container:: table-row

   Property
         crop
   
   Data type
   
   
   Description
         Crops the content to a certain length.
         
         Syntax: +/- (chars) = from left / from right \| [string] \| [boolean:
         keep whole words]
         
         **Examples:**
         
         20 \| ... => max 20 characters. If more, the value will be truncated
         to first 20 chars and prepended with "..."
         
         -20 \| ... => max 20 characters. If more, the value will be truncated
         to last 20 chars and appended with "..."
         
         20 \| ... \| 1 => max 20 characters. If more, the value will be
         truncated to last 20 chars and appended with "...". If the division is
         in the middle of a word, the remains of that word is removed.
         
         Uses "renderCharset" for the operation.
   
   Default


.. container:: table-row

   Property
         rawUrlEncode
   
   Data type
         boolean
   
   Description
         Passes the content through rawurlencode()-PHP-function.
   
   Default


.. container:: table-row

   Property
         htmlSpecialChars
   
   Data type
         boolean
   
   Description
         Passes the content through htmlspecialchars()-PHP-function.
         
         Additional property ".preserveEntities" will preserve entities so only
         non-entity chars are affected.
   
   Default


.. container:: table-row

   Property
         doubleBrTag
   
   Data type
         string
   
   Description
         All double-line-breaks are substituted with this value.
   
   Default


.. container:: table-row

   Property
         br
   
   Data type
         boolean
   
   Description
         PHP function nl2br(); converts line breaks to <br />-tags.
   
   Default


.. container:: table-row

   Property
         brTag
   
   Data type
         string
   
   Description
         All ASCII-codes of "10" (CR) are substituted with *value.*
   
   Default


.. container:: table-row

   Property
         encapsLines
   
   Data type
         ->encapsLines
   
   Description
         Lets you split the content by chr(10) and process each line
         independently. Used to format content made with the RTE.
   
   Default


.. container:: table-row

   Property
         keywords
   
   Data type
         boolean
   
   Description
         Splits the content by characters "," ";" and chr(10) (return), trims
         each value and returns a comma-separated list of the values.
   
   Default


.. container:: table-row

   Property
         innerWrap
   
   Data type
         wrap /stdWrap
   
   Description
         Wraps the content.
   
   Default


.. container:: table-row

   Property
         innerWrap2
   
   Data type
         wrap /stdWrap
   
   Description
         Same as .innerWrap (but watch the order in which they are executed).
   
   Default


.. container:: table-row

   Property
         fontTag
   
   Data type
         wrap
   
   Description
   
   
   Default


.. container:: table-row

   Property
         addParams
   
   Data type
         ->addParams
   
   Description
         Lets you add tag-parameters to the content  *if* the content is a tag!
   
   Default


.. container:: table-row

   Property
         textStyle
   
   Data type
         ->textStyle
   
   Description
         Wraps content in font-tags
   
   Default


.. container:: table-row

   Property
         tableStyle
   
   Data type
         ->tableStyle
   
   Description
         Wraps content with table-tags
   
   Default


.. container:: table-row

   Property
         filelink
   
   Data type
         ->filelink
   
   Description
         Used to make lists of links to files.
   
   Default


.. container:: table-row

   Property
         preCObject
   
   Data type
         cObject
   
   Description
         cObject prepended the content
   
   Default


.. container:: table-row

   Property
         postCObject
   
   Data type
         cObject
   
   Description
         cObject appended the content
   
   Default


.. container:: table-row

   Property
         wrapAlign
   
   Data type
         align /stdWrap
   
   Description
         Wraps content with <div style=text-align:[ *value* ];"> \| </div>
         *if* align is set
   
   Default


.. container:: table-row

   Property
         typolink
   
   Data type
         ->typolink
   
   Description
         Wraps the content with a link-tag
   
   Default


.. container:: table-row

   Property
         TCAselectItem
   
   Data type
         Array of properties
   
   Description
         Resolves a comma-separated list of values into the TCA item
         representation.
         
         **.table** (string):  *The Table to look up*
         
         **.field** (string):  *The field to resolve*
         
         **.delimiter** (string):  *Delimiter for concatenating multiple
         elements.*
         
         **Notice:** Currently this works only with TCA fields of type "select"
         which are not database relations.
   
   Default


.. container:: table-row

   Property
         spaceBefore
   
   Data type
         int /stdWrap
   
   Description
         Pixels space before. Done with a clear-gif; <img ...><BR>
   
   Default


.. container:: table-row

   Property
         spaceAfter
   
   Data type
         int /stdWrap
   
   Description
         Pixels space after. Done with a clear-gif; <img ...><BR>
   
   Default


.. container:: table-row

   Property
         space
   
   Data type
         space /stdWrap
   
   Description
         [spaceBefore] \| [spaceAfter]
         
         **Additional property:**
         
         .useDiv = 1
         
         If set, a clear gif is not used but rather a <div> tag with a style-
         attribute setting the height. (Affects spaceBefore and spaceAfter as
         well).
   
   Default


.. container:: table-row

   Property
         wrap
   
   Data type
         wrap /+.splitChar
   
   Description
         .splitChar defines an alternative splitting character (default is "\|"
         - the vertical line)
   
   Default


.. container:: table-row

   Property
         noTrimWrap
   
   Data type
         "special" wrap
   
   Description
         This wraps the content with the values val1 and val2 in the example
         below - including surrounding whitespace! - without trimming the
         values. Note that this kind of wrap requires a "\|" character to begin
         and end the wrap.
         
         **Example:**
         
         ::
         
            | val1 | val2 |
   
   Default


.. container:: table-row

   Property
         wrap2
   
   Data type
         wrap /+.splitChar
   
   Description
         *same as .wrap (but watch the order in which they are executed)*
   
   Default


.. container:: table-row

   Property
         dataWrap
   
   Data type
   
   
   Description
         The content is parsed for sections of {...} and the content of {...}
         is of the type getText and substituted with the result of getText.
         
         **Example:**
         
         This will produce a tag around the content with an attribute that
         contains the number of the current page:
         
         ::
         
            <div id="{tsfe : id}"> | </div>
   
   Default


.. container:: table-row

   Property
         prepend
   
   Data type
         cObject
   
   Description
         cObject prepended to content (before)
   
   Default


.. container:: table-row

   Property
         append
   
   Data type
         cObject
   
   Description
         cObject appended to content (after)
   
   Default


.. container:: table-row

   Property
         wrap3
   
   Data type
         wrap /+.splitChar
   
   Description
         *same as .wrap (but watch the order in which they are executed)*
   
   Default


.. container:: table-row

   Property
         orderedStdWrap
   
   Data type
         Array of numeric keys with /stdWrap each
   
   Description
         (Since TYPO3 4.7) Execute multiple stdWrap statements in a freely
         selectable order. The order is determined by the numeric order of the
         keys. This allows to use multiple stdWrap statements without having to
         remember the rather complex sorting order in which the stdWrap
         functions are executed.
         
         **Example:**
         
         ::
         
            10 = TEXT
            10.value = a
            10.orderedStdWrap {
              30.wrap = |.
            
              10.wrap = is | working
              10.innerWrap = &nbsp;|&nbsp;
            
              20.wrap = This|solution
              20.stdWrap.wrap = &nbsp;|&nbsp;
            }
         
         In this example orderedStdWrap is executed on the value "a".
         10.innerWrap is executed first, followed by 10.wrap. Then the next key
         is processed which is 20. Afterwards 30.wrap is executed on what
         already was created.
         
         This results in "This is a working solution."
   
   Default


.. container:: table-row

   Property
         outerWrap
   
   Data type
         wrap /stdWrap
   
   Description
         *Wraps the complete content*
   
   Default


.. container:: table-row

   Property
         insertData
   
   Data type
         boolean
   
   Description
         If set, then the content string is parsed like .dataWrap above.
         
         **Example:**
         
         Displays the page title:
         
         ::
         
            10 = TEXT
            10.value = This is the page title: {page:title}
            10.insertData = 1
   
   Default


.. container:: table-row

   Property
         offsetWrap
   
   Data type
         x,y
   
   Description
         This wraps the input in a table with columns to the left and top that
         offsets the content by the values of x,y. Based on the cObject OTABLE.
         
         **.tableParams / .tdParams** /stdWrap
         
         \- used to manipulate tableParams/tdParams (default width=99%) of the
         offset. Default: See OTABLE.
         
         **.stdWrap**
         
         \- stdWrap properties wrapping the offsetWrap'ed output
   
   Default


.. container:: table-row

   Property
         postUserFunc
   
   Data type
         function name
   
   Description
         Calling a PHP-function or method in a class, passing the current
         content to the function as first parameter and any properties as
         second parameter.Please see the description of the cObject USER for
         in-depth information.
         
         **Example:**
         
         You can paste this example directly into a new template record.
         
         ::
         
            page = PAGE
            page.typeNum=0
            includeLibs.something = typo3/sysext/statictemplates/media/scripts/example_callfunction.php
            
            page.10 = TEXT
            page.10 {
              value = Hello World
              postUserFunc = user_reverseString
              postUserFunc.uppercase = 1
            }
            
            page.20 = TEXT
            page.20 {
              value = Hello World
              postUserFunc = user_various->reverseString
              postUserFunc.uppercase = 1
              postUserFunc.typolink = 11
            }
   
   Default


.. container:: table-row

   Property
         postUserFuncInt
   
   Data type
         function name
   
   Description
         Calling a PHP-function or method in a class, passing the current
         content to the function as first parameter and any properties as
         second parameter. The result will be rendered non-cached, outside the
         main page-rendering. Please see the description of the cObject
         USER\_INT and the cObject PHP\_SCRIPT\_INT (which you find in the
         appendix "PHP include scripts") for in-depth information.
         
         Supplied by Jens Ellerbrock
   
   Default


.. container:: table-row

   Property
         prefixComment
   
   Data type
         string
   
   Description
         Prefixes content with an HTML comment with the second part of input
         string (divided by "\|") where first part is an integer telling how
         many trailing tabs to put before the comment on a new line.
         
         The content is parsed through insertData.
         
         **Example:**
         
         ::
         
            prefixComment = 2 | CONTENT ELEMENT, uid:{field:uid}/{field:CType}
         
         Will indent the comment with 1 tab (and the next line with 2+1 tabs)
         
         (Added in TYPO3 >3.6.0RC1)
   
   Default


.. container:: table-row

   Property
         editIcons
   
   Data type
         string
   
   Description
         If not empty, then insert an icon linking to the typo3/alt\_doc.php
         with some parameters to build and backend user edit form for certain
         fields.
         
         The value of this property is a list of fields from a table to edit.
         It's assumed that the current record of the cObj is the record to be
         edited.
         
         Syntax:  *optional tablename* :  *comma list of field names[list of
         pallette-field names separated by \| ]*
         
         **.beforeLastTag** (1,0,-1): If set (1), the icon will be inserted
         before the last HTML tag in the content. If -1 the icon will be
         prepended to the content. If zero (0) the icon is appended in the end
         of the content.
         
         **.styleAttribute** (string): Adds a style-attribute to the icon image
         with this value. For instance you can set "position:absolute" if you
         want a non-destructive insertion of the icon. Notice: For general
         styling all edit icons has the class "frontEndEditIcons" which can be
         addressed from the stylesheet of the site.
         
         **.iconTitle** (string): The title attribute of the image tag.
         
         **.iconImg** (HTML): Alternative HTML code instead of the default icon
         shown. Can be used to set another icon for editing (for instance a red
         dot or otherwise... :-)
         
         **Example:**
         
         This will insert an edit icon which links to a form where the header
         and bodytext fields are displayed and made available for editing
         (provided the user has access!).
         
         ::
         
            editIcons = tt_content : header, bodytext
         
         Or this line that puts the header\_align and date field into a
         "palette" which means they are displayed on a single line below the
         header field. This saves some space.
         
         ::
         
            editIcons = header[header_align|date], bodytext
   
   Default


.. container:: table-row

   Property
         editPanel
   
   Data type
         boolean / editPanel
   
   Description
         See cObject EDITPANEL.
   
   Default


.. container:: table-row

   Property
         cache
   
   Data type
         ->cache
   
   Description
         (Since TYPO3 4.7)Caches rendered content in the caching framework.
   
   Default


.. container:: table-row

   Property
         debug
   
   Data type
         boolean
   
   Description
         Prints content with HTMLSpecialChars() and <PRE></PRE>: Useful for
         debugging which value stdWrap actually ends up with, if you're
         constructing a website with TypoScript.
         
         Should be used under construction only.
   
   Default


.. container:: table-row

   Property
         debugFunc
   
   Data type
         boolean
   
   Description
         Prints the content directly to browser with the debug() function.
         
         Should be used under construction only.
         
         Set to value "2" the content will be printed in a table - looks nicer.
   
   Default


.. container:: table-row

   Property
         debugData
   
   Data type
         boolean
   
   Description
         Prints the current data-array, $cObj->data, directly to browser. This
         is where ".field" gets data from.
         
         Should be used under construction only.
   
   Default


.. ###### END~OF~TABLE ######


[tsref:->stdWrap]

