.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt

.. highlight:: typoscript

.. _stdwrap:
.. _objects-stdwrap:

=======
stdWrap
=======

When a data type is set to "*type* /stdWrap" it means that the value
is parsed through the stdWrap function with the properties of the
value as parameters.


.. _stdwrap-examples:

Example
"""""""

Example with the property "value" of the content object ":ref:`cobj-text`"::

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper

Here the content of the object "10" is uppercased before it is
returned.


.. _stdwrap-content-supplying:

Content-supplying properties of stdWrap
"""""""""""""""""""""""""""""""""""""""

stdWrap contains properties which determine what is applied. The properties
are listed below.

The properties are parsed in the listed order. The
properties :ts:`data`, :ts:`field`, :ts:`current`, :ts:`cObject`
(in that order!) are special as they are used to import content
from variables or arrays.

If you want to study this further please refer to
:file:`typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php`,
where you will find the function :php:`stdWrap()` and the array :php:`$stdWrapOrder`,
which represents the exact order of execution.

Note that the :ts:`stdWrap` property "orderedStdWrap" allows you to execute
multiple :ts:`stdWrap` functions in a freely selectable order.

The above example could be rewritten to this::

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper
   10.stdWrap.field = header

Now the line :ts:`10.value = some text` is obsolete, because the whole
value is "imported" from the field called "header" from the
:php:`$cObj->data-array`.


.. _stdwrap-get-data:

Getting data
~~~~~~~~~~~~


.. _stdwrap-setcontenttocurrent:

setContentToCurrent
'''''''''''''''''''

.. container:: table-row

   Property
         setContentToCurrent

   Data type
         boolean /stdWrap

   Description
         Sets the current value to the incoming content of the function.


.. _stdwrap-addpagecachetags:

addPageCacheTags
''''''''''''''''

.. container:: table-row

   Property
         addPageCacheTags

   Data type
         string /stdWrap

   Description
         Comma-separated list of cache tags, which should be added to the page
         cache.

         **Example:**

         .. code-block:: typoscript

            addPageCacheTags = pagetag1,pagetag2,pagetag3

         This will add the tags "pagetag1", "pagetag2" and "pagetag3" to the
         according cached pages in cache_pages.

         Pages, which have been cached with a tag, can be deleted from cache
         again with the TSconfig option
         :ref:`TCEMAIN.clearCacheCmd <t3tsconfig:pagetcemain-clearcachecmd>`.

         .. note::

            If you instead want to store rendered content into the
            caching framework, see the :ref:`stdWrap feature cache <stdwrap-cache>`.


.. _stdwrap-setcurrent:

setCurrent
''''''''''

.. container:: table-row

   Property
         setCurrent

   Data type
         string /stdWrap

   Description
         Sets the "current"-value. This is normally set from some outside
         routine, so be careful with this. But it might be handy to do this


.. _stdwrap-lang:

lang
''''

.. container:: table-row

   Property
         lang

   Data type
         Array of language keys /stdWrap

   Description
         This is used to define optional language specific values.

         If the global language key set by the :ref:`->config <config>` property .language is
         found in this array, then this value is used instead of the default
         input value to stdWrap.

         **Example:** ::

            config.language = de
            page.10 = TEXT
            page.10.value = I am a Berliner!
            page.10.stdWrap.lang.de = Ich bin ein Berliner!

         Output will be "Ich bin..." instead of "I am..."


.. _stdwrap-data:

data
''''

.. container:: table-row

   Property
         data

   Data type
         :ref:`data-type-gettext` /stdWrap


.. _stdwrap-field:

field
'''''

.. container:: table-row

   Property
         field

   Data type
         Field name /stdWrap

   Description
         Sets the content to the value of the according field
         (which comes from $cObj->data[*field*]).

         **Example:** ::

            .field = title

         This sets the content to the value of the field "title".

         You can also check multiple field names, if you divide them
         by "//".

         **Example:** ::

            .field = nav_title // title

         Here the content from the field nav\_title will be returned
         unless it is a blank string. If a blank string, the value of
         the title field is returned.

         **Note:** $cObj->data changes depending on the context.
         See the description for the data type ":ref:`data-type-gettext`"/field!


.. _stdwrap-current:

current
'''''''

.. container:: table-row

   Property
         current

   Data type
         boolean /stdWrap

   Description
         Sets the content to the "current"-value (see :ref:`->split <split>`)


.. _stdwrap-cobject:

cObject
'''''''

.. container:: table-row

   Property
         cObject

   Data type
         :ref:`data-type-cobject`

   Description
         Loads content from a content object.


.. _stdwrap-numrows:

numRows
'''''''

.. container:: table-row

   Property
         numRows

   Data type
         :ref:`->numRows <numrows>` /stdWrap

   Description
         Returns the number of rows resulting from the supplied SELECT query.


.. _stdwrap-filelist:

filelist
''''''''

.. container:: table-row

   Property
         filelist

   Data type
         :ref:`data-type-dir` /stdWrap

   Description
         Reads a directory and returns a list of file names.

         The value is exploded by "\|" into parameters:

         1: The path

         2: comma-separated list of allowed extensions (no spaces between);
         if empty, all extensions are allowed.

         3: sorting: name, size, ext, date, mdate (modification date).

         4: reverse: Set to "r" if you want a reversed sorting.

         5: fullpath\_flag: If set, the filelist is returned with complete
         paths, and not just the filename.


.. _stdwrap-preuserfunc:

preUserFunc
'''''''''''

.. container:: table-row

   Property
         preUserFunc

   Data type
         Function name

   Description
         Calls the provided PHP function. If you specify the name with a '->'
         in it, then it is interpreted as a call to a method in a class.

         Two parameters are sent to the PHP function: As first parameter a
         content variable, which contains the current content. This is the
         value to be processed. As second parameter any sub-properties of
         preUserFunc are provided to the function.

         See *.postUserFunc*!


.. _stdwrap-override-conditions:

Override and conditions
~~~~~~~~~~~~~~~~~~~~~~~


.. _stdwrap-override:

override
''''''''

.. container:: table-row

   Property
         override

   Data type
         string /stdWrap

   Description
         if "override" returns something else than "" or zero (trimmed), the
         content is loaded with this!


.. _stdwrap-preifemptylistnum:

preIfEmptyListNum
'''''''''''''''''

.. container:: table-row

   Property
         preIfEmptyListNum

   Data type
         (as "listNum" below)

   Description
         (as "listNum" below)


.. _stdwrap-ifnull:

ifNull
''''''

.. container:: table-row

   Property
         ifNull

   Data type
         string /stdWrap

   Description
         If the content is null (NULL type in PHP), the content is overridden
         with the value defined here.

         **Example:** ::

            page.10 = COA_INT
            page.10 {
              10 = TEXT
              10 {
                stdWrap.field = description
                stdWrap.ifNull = No description defined.
              }
            }

         This example shows the content of the field description or, if that
         field contains the value NULL, the text "No description defined.".


.. _stdwrap-ifempty:

ifEmpty
'''''''

.. container:: table-row

   Property
         ifEmpty

   Data type
         string /stdWrap

   Description
         If the trimmed content is empty at this point, the content is loaded
         with "ifEmpty". Zeros are treated as empty values!


.. _stdwrap-ifblank:

ifBlank
'''''''

.. container:: table-row

   Property
         ifBlank

   Data type
         string /stdWrap

   Description
         Same as "ifEmpty" but the check is done using strlen().


.. _stdwrap-listnum:

listNum
'''''''

.. container:: table-row

   Property
         listNum

   Data type
         integer :ref:`+calc <objects-calc>` +"last" +"rand" /stdWrap

   Description
         Explodes the content with "," (comma) and the content is set to the
         item[*value*].

         **Special keyword:** "last" is set to the last element of the array!

         **Special keyword:** "rand" returns a random item out of a list.

         **.splitChar** (string):

         Defines the string used to explode the value. If splitChar is an
         integer, the character with that number is used (e.g. "10" to split
         lines...).

         Default: "," (comma)

         **.stdWrap** (stdWrap properties):

         stdWrap properties of the listNum...

         **Examples:**

         We have a value of "item 1, item 2, item 3, item 4":

         This would return "item 3"::

            .listNum = last – 1

         That way the subtitle field to be displayed is chosen randomly upon
         every reload::

            page.5 = COA_INT
            page.5 {
              10 = TEXT
              10 {
                stdWrap.field = subtitle
                stdWrap.listNum = rand
              }
            }


.. _stdwrap-trim:

trim
''''

.. container:: table-row

   Property
         trim

   Data type
         boolean /stdWrap

   Description
         If set, the PHP-function trim() will be used to remove whitespaces
         around the value.


.. _stdwrap-strpad:

strPad
''''''

.. container:: table-row

   Property
         strPad

   Data type
         :ref:`->strPad <strpad>`

   Description
         Pads the current content to a certain length. You can define the padding
         characters and the side(s), on which the padding should be added.


.. _stdwrap-stdwrap:

stdWrap
'''''''

.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         Recursive call to the stdWrap function.


.. _stdwrap-required:

required
''''''''

.. container:: table-row

   Property
         required

   Data type
         boolean /stdWrap

   Description
         This flag requires the content to be set to some value after any
         content-import and treatment that might have happened until now
         (data, field, current, listNum, trim). Zero is **not** regarded as
         empty! Use "if" instead!

         If the content is empty, "" is returned immediately.


.. _stdwrap-if:

if
''

.. container:: table-row

   Property
         if

   Data type
         :ref:`->if <if>`

   Description
         If the if-object returns false, stdWrap returns "" immediately.


.. _stdwrap-fieldrequired:

fieldRequired
'''''''''''''

.. container:: table-row

   Property
         fieldRequired

   Data type
         Field name /stdWrap

   Description
         The value in this field **must** be set.


.. _stdwrap-parsedata:

Parsing data
~~~~~~~~~~~~


.. _stdwrap-csconv:

csConv
''''''

.. container:: table-row

   Property
         csConv

   Data type
         string /stdWrap

   Description
         Convert the charset of the string from the charset given as value to
         the current rendering charset of the frontend (renderCharset).


.. _stdwrap-parsefunc:

parseFunc
'''''''''

.. container:: table-row

   Property
         parseFunc

   Data type
         object path reference / :ref:`->parseFunc <parsefunc>` /stdWrap

   Description
         Processing instructions for the content.

         **Note:** If you enter a string as value, this will be taken as a
         reference to an object path globally in the TypoScript object tree.
         This will be the basis configuration for parseFunc merged with any
         properties you add here. It works exactly like references does for
         content elements.

         **Example:** ::

            parseFunc = < lib.parseFunc_RTE
            parseFunc.tags.myTag = TEXT
            parseFunc.tags.myTag.value = This will be inserted when &lt;myTag&gt; is found!


.. _stdwrap-htmlparser:

HTMLparser
''''''''''

.. container:: table-row

   Property
         HTMLparser

   Data type
         boolean / :ref:`->HTMLparser <htmlparser>` /stdWrap

   Description
         This object allows you to parse the HTML-content and perform all kinds of
         advanced filtering on the content.

         Value must be set and properties are those of :ref:`->HTMLparser <htmlparser>`.

         (See :ref:`t3coreapi:rte` for more information about RTE transformations)


.. _stdwrap-split:

split
'''''

.. container:: table-row

   Property
         split

   Data type
         :ref:`->split <split>` /stdWrap


.. _stdwrap-replacement:

replacement
'''''''''''

.. container:: table-row

   Property
         replacement

   Data type
         :ref:`->replacement <replacement>` /stdWrap

   Description
         Performs an ordered search/replace on the current content with the
         possibility of using PCRE regular expressions. An array with numeric
         indices defines the order of actions and thus allows multiple
         replacements at once.


.. _stdwrap-prioricalc:

prioriCalc
''''''''''

.. container:: table-row

   Property
         prioriCalc

   Data type
         boolean /stdWrap

   Description
         Calculation of the value using operators -+\*/%^ plus respects
         priority to + and - operators and parenthesis levels ().

         . (period) is decimal delimiter.

         Returns a doublevalue.

         If .prioriCalc is set to "intval" an integer is returned.

         There is no error checking and division by zero or other invalid
         values may generate strange results. Also you should use a proper syntax
         because future modifications to the function used may allow for more
         operators and features.

         **Examples:** ::

            100%7 = 2
            -5*-4 = 20
            +6^2 = 36
            6 ^(1+1) = 36
            -5*-4+6^2-100%7 = 54
            -5 * (-4+6) ^ 2 - 100%7 = 98
            -5 * ((-4+6) ^ 2) - 100%7 = -22


.. _stdwrap-char:

char
''''

.. container:: table-row

   Property
         char

   Data type
         integer /stdWrap

   Description
         Content is set to chr(*value*). This returns a one-character
         string containing the character specified by ascii code. Reliable
         results will be obtained only for character codes in the integer
         range 0 - 127. See
         `the PHP manual <http://php.net/manual/en/function.chr.php>`_:

         .. code-block:: php

            $content = chr((int)$conf['char']);


.. _stdwrap-intval:

intval
''''''

.. container:: table-row

   Property
         intval

   Data type
         boolean /stdWrap

   Description
         PHP function intval(); returns an integer:

         .. code-block:: php

            $content = intval($content);


.. _stdwrap-hash:

hash
''''

.. container:: table-row

   Property
         hash

   Data type
         string /stdWrap

   Description
         Returns a hashed value of the current content. Set to one of the
         algorithms which are available in PHP. For a list of supported
         algorithms see `http://www.php.net/manual/en/function.hash-algos.php
         <http://www.php.net/manual/en/function.hash-algos.php>`_ .

         **Example:** ::

            page.10 = TEXT
            page.10 {
              value = test@example.com
              stdWrap.hash = md5
              stdWrap.wrap = <img src="http://www.gravatar.com/avatar/|" />
            }


.. _stdwrap-round:

round
'''''

.. container:: table-row

   Property
         round

   Data type
         :ref:`->round <round>` /stdWrap

   Description
         Round the value with the selected method to the given number of
         decimals.


.. _stdwrap-numberformat:

numberFormat
''''''''''''

.. container:: table-row

   Property
         numberFormat

   Data type
         :ref:`->numberFormat <numberformat>`

   Description
         Format a float value to any number format you need (e.g. useful for
         prices).


.. _stdwrap-date:

date
''''

.. container:: table-row

   Property
         date

   Data type
         :ref:`data-type-date-conf` /stdWrap

   Description
         The content should be data-type "UNIX-time". Returns the content
         formatted as a date:

         .. code-block:: php

            $content = date($conf['date'], $content);

         Properties:

         **.GMT:** If set, the PHP function `gmdate() <http://www.php.net/gmdate>`_ will be
         used instead of `date() <http://www.php.net/date>`_.

         **Example** where a timestamp is imported::

            .value.field = tstamp
            .value.date =


.. _stdwrap-strftime:

strftime
''''''''

.. container:: table-row

   Property
         strftime

   Data type
         :ref:`data-type-strftime-conf` /stdWrap

   Description
         Exactly like "date" above. See the PHP manual (`strftime <http://www.php.net/strftime>`_) for the
         codes, or data type ":ref:`data-type-strftime-conf`".

         This formatting is useful if the locale is set in advance in the
         :ref:`CONFIG <config>` object. See there.

         Properties:

         **.charset:** Can be set to the charset of the output string if you
         need to convert it to renderCharset. Default is to take the
         intelligently guessed charset from
         TYPO3\CMS\Core\Charset\CharsetConverter.

         **.GMT:** If set, the PHP function `gmstrftime() <http://www.php.net/gmstrftime>`_ will be used instead
         of `strftime() <http://www.php.net/strftime>`_.


.. _stdwrap-strtotime:

strtotime
'''''''''

.. container:: table-row

   Property
         strtotime

   Data type
         string

   Description
         Allows conversion of formatted dates to timestamp, e.g. to perform date calculations.

         Possible values are :ts:`1` or any time string valid as first argument of the PHP :php:`strtotime()` function.

         **Example:** ::

            date_as_timestamp = TEXT
            date_as_timestamp {
               value = 2015-04-15
               strtotime = 1
            }

         **Example:** ::

            next_weekday = TEXT
            next_weekday {
               data = GP:selected_date
               strtotime = + 2 weekdays
               strftime = %Y-%m-%d
            }


.. _stdwrap-age:

age
'''

.. container:: table-row

   Property
         age

   Data type
         boolean or string /stdWrap

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
         four are singular. This is the default string::

            " min| hrs| days| yrs| min| hour| day| year"

         Set another string if you want to change the units. You may include
         the "-signs. They are removed anyway, but they make sure that a space
         which you might want between the number and the unit stays.

         **Example:** ::

            lib.ageFormat = TEXT
            lib.ageFormat.stdWrap.data = page:tstamp
            lib.ageFormat.stdWrap.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"


.. _stdwrap-case:

case
''''

.. container:: table-row

   Property
         case

   Data type
         :ref:`data-type-case` /stdWrap

   Description
         Converts case

         Uses "renderCharset" for the operation.


.. _stdwrap-bytes:

bytes
'''''

.. container:: table-row

   Property
         bytes

   Data type
         boolean/stdWrap

   Default
         iec, 1024

   Description
         This is for number values. When the 'bytes' property is added and set
         to 'true' then a number will be formatted in 'bytes' style with two
         decimals like '1.53 KiB' or '1.00 MiB'.
         Learn about common notations at
         `Wikipedia "Kibibyte" <https://en.wikipedia.org/wiki/Kibibyte>`__.
         IEC naming with base 1024 is the default. Use sub-properties for
         customisation.

         .labels = iec
            This is the default. IEC labels and base 1024 are used.
            Built in IEC labels are :ts:`" | Ki| Mi| Gi| Ti| Pi| Ei| Zi| Yi"`.
            You need to append a final string like 'B' or '-Bytes' yourself.

         .labels = si
            In this case SI labels and base 1000 are used.
            Built in IEC labels are :ts:`" | k| M| G| T| P| E| Z| Y"`.
            You need to append a final string like 'B' yourself.

         .labels = "..."
            Custom values can be defined as well like with
            :ts:`.labels = " Byte| Kilobyte| Megabyte| Gigabyte"`. Use a
            vertical bar to separate the labels. Enclose the whole string in
            double quotes.

            .base = 1000
               Only with custom labels you can choose to set a base of1000. All
               other values, including the default, mean base 1024.

         .. attention::

            If the value isn't a number the internal PHP function may issue a
            warning which - depending on you error handling settings - can
            interrupt execution. Example::

               value = abc
               bytes = 1

            will show `0` but may raise a warning or an exception.

   Examples
      Output value 1000 without special formatting. Shows `1000`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
         }

      Format value 1000 in IEC style with base=1024. Shows `0.98 Ki`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
         }

      Format value 1000 in IEC style with base=1024 and 'B' supplied by us.
      Shows `0.98 KiB`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
            noTrimWrap = ||B|
         }

      Format value 1000 in SI style with base=1000. Shows `1.00 k`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
            bytes.labels = si
         }

      Format value 1000 in SI style with base=1000 and 'b' supplied by us.
      Shows `1.00 kb`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
            bytes.labels = si
            noTrimWrap = ||b|
         }

      Format value 1000 with custom label and base=1000. Shows
      `1.00 x 1000 Bytes`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
            bytes.labels = " x 1 Byte| x 1000 Bytes"
            bytes.base = 1000
         }

      Format value 1000 with custom label and base=1000. Shows
      `1.00 kilobyte (kB)`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
            bytes.labels = " byte (B)| kilobyte (kB)| megabyte (MB)| gigabyte (GB)| terabyte (TB)| petabyte (PB)| exabyte (EB)| zettabyte (ZB)| yottabyte YB"
            bytes.base = 1000
         }

      Format value 1000 with custom label and base=1024. Shows
      `0.98 kibibyte (KiB)`::

         page = PAGE
         page.10 = TEXT
         page.10 {
            value = 1000
            bytes = 1
            bytes.labels = " byte (B)| kibibyte (KiB)| mebibyte (MiB)| gibibyte (GiB)| tebibyte (TiB)| pepibyte (PiB)| exbibyte (EiB)| zebibyte (ZiB)| yobibyte YiB"
            bytes.base = 1024
         }


.. _stdwrap-substring:

substring
'''''''''

.. container:: table-row

   Property
         substring

   Data type
         [p1], [p2] /stdWrap

   Description
         Returns the substring with [p1] and [p2] sent as the 2nd and 3rd
         parameter to the PHP substring function.

         Uses "renderCharset" for the operation.


.. _stdwrap-removebadhtml:

removeBadHTML
'''''''''''''

.. container:: table-row

   Property
         removeBadHTML

   Data type
         boolean /stdWrap

   Description
         Removes "bad" HTML code based on a pattern that filters away HTML that
         is considered dangerous for XSS bugs.

         **Note:** The removal, which removeBadHTML does, is not 100% complete.
         You cannot rely on the processing to remove **all** potentially bad tags.


.. _stdwrap-crophtml:

cropHTML
''''''''

.. container:: table-row

   Property
         cropHTML

   Data type
         string /stdWrap

   Description
         Crops the content to a certain length. In contrast to stdWrap.crop it
         respects HTML tags. It does not crop inside tags and closes open tags.
         Entities (like ">") are counted as one char. See stdWrap.crop below
         for a syntax description and examples.

         Note that stdWrap.crop should not be used if stdWrap.cropHTML is
         already used.


.. _stdwrap-striphtml:

stripHtml
'''''''''

.. container:: table-row

   Property
         stripHtml

   Data type
         boolean /stdWrap

   Description
         Strips all HTML tags.


.. _stdwrap-crop:

crop
''''

.. container:: table-row

   Property
         crop

   Data type
         string /stdWrap

   Description
         Crops the content to a certain length.

         You can define up to three parameters, of which the third one is
         optional. The syntax is:
         [numbers of characters to keep] \| [ellipsis] \| [keep whole words]

         numbers of characters to keep (integer): Define the number of characters
         you want to keep. For positive numbers, the first characters from the
         beginning of the string will be kept, for negative numbers the last
         characters from the end will be kept.

         ellipsis (string): The signs to be added instead of the part, which was
         cropped of. If the number of characters was positive, the string will
         be *prepended* with the ellipsis, if it was negative, the string will
         be *appended* with the ellipsis.

         keep whole words (boolean): If set to 0 (default), the string is always
         cropped directly after the defined number of characters. If set to 1,
         only complete words are kept. Then a word, which would normally be cut
         in the middle, is removed completely.

         **Examples:**

         20 \| ... => max 20 characters. If more, the value will be truncated
         to the first 20 characters and prepended with "..."

         -20 \| ... => max 20 characters. If more, the value will be truncated
         to the last 20 characters and appended with "..."

         20 \| ... \| 1 => max 20 characters. If more, the value will be
         truncated to the first 20 characters and prepended with "...". If
         the division is in the middle of a word, the remains of that word is
         removed.

         Uses "renderCharset" for the operation.


.. _stdwrap-rawurlencode:

rawUrlEncode
''''''''''''

.. container:: table-row

   Property
         rawUrlEncode

   Data type
         boolean /stdWrap

   Description
         Passes the content through the PHP function `rawurlencode() <http://www.php.net/rawurlencode>`_.


.. _stdwrap-htmlspecialchars:

htmlSpecialChars
''''''''''''''''

.. container:: table-row

   Property
         htmlSpecialChars

   Data type
         boolean /stdWrap

   Description
         Passes the content through the PHP function `htmlspecialchars() <http://www.php.net/htmlspecialchars>`_.

         Additional property ".preserveEntities" will preserve entities so only
         non-entity characters are affected.


.. _stdwrap-encodeforjavascriptvalue:

encodeForJavaScriptValue
''''''''''''''''''''''''

.. container:: table-row

   Property
         encodeForJavaScriptValue

   Data type
         boolean /stdWrap

   Description
         Encodes content to be used safely inside strings in JavaScript.
         Characters, which can cause problems inside JavaScript strings, are
         replaced with their encoded equivalents. The resulting string is
         *not* enclosed in quotes. If needed, quotes can be added using
         TypoScript.

         Passes the content through the core function
         :php:`GeneralUtility::quoteJSvalue`.

         **Example:** ::

            10 = TEXT
            10 {
                stdWrap.data = GP:sWord
                stdWrap.encodeForJavaScriptValue = 1
                stdWrap.wrap = setSearchWord(|);
            }


.. _stdwrap-doublebrtag:

doubleBrTag
'''''''''''

.. container:: table-row

   Property
         doubleBrTag

   Data type
         string /stdWrap

   Description
         All double-line-breaks are substituted with this value.


.. _stdwrap-br:

br
''

.. container:: table-row

   Property
         br

   Data type
         boolean /stdWrap

   Description
         Pass the value through the PHP function `nl2br() <http://www.php.net/nl2br>`_. This
         converts each line break to a <br /> or a <br> tag depending on doctype.


.. _stdwrap-brtag:

brTag
'''''

.. container:: table-row

   Property
         brTag

   Data type
         string /stdWrap

   Description
         All ASCII codes of "10" (line feed, LF) are substituted with the
         *value*, which has been provided in this property.


.. _stdwrap-encapslines:

encapsLines
'''''''''''

.. container:: table-row

   Property
         encapsLines

   Data type
         :ref:`->encapsLines <encapslines>` /stdWrap

   Description
         Lets you split the content by chr(10) and process each line
         independently. Used to format content made with the RTE.


.. _stdwrap-keywords:

keywords
''''''''

.. container:: table-row

   Property
         keywords

   Data type
         boolean /stdWrap

   Description
         Splits the content by characters "," ";" and chr(10) (return), trims
         each value and returns a comma-separated list of the values.


.. _stdwrap-innerwrap:

innerWrap
'''''''''

.. container:: table-row

   Property
         innerWrap

   Data type
         :ref:`wrap <data-type-wrap>` /stdWrap

   Description
         Wraps the content.


.. _stdwrap-innerwrap2:

innerWrap2
''''''''''

.. container:: table-row

   Property
         innerWrap2

   Data type
         :ref:`wrap <data-type-wrap>` /stdWrap

   Description
         Same as .innerWrap (but watch the order in which they are executed).


.. _stdwrap-fonttag:

fontTag
'''''''

.. container:: table-row

   Property
         fontTag

   Data type
         :ref:`wrap <data-type-wrap>` /stdWrap


.. _stdwrap-addparams:

addParams
'''''''''

.. container:: table-row

   Property
         addParams

   Data type
         :ref:`->addParams <addparams>` /stdWrap

   Description
         Lets you add tag parameters to the content *if* the content is a tag!


.. _stdwrap-textstyle:

textStyle
'''''''''

.. container:: table-row

   Property
         textStyle

   Data type
         :ref:`->textStyle <textstyle>` /stdWrap

   Description
         Wraps the content in font-tags.

         **Note:** This property is deprecated since TYPO3 7.1! Use
         CSS instead.


.. _stdwrap-tablestyle:

tableStyle
''''''''''

.. container:: table-row

   Property
         tableStyle

   Data type
         :ref:`->tableStyle <tablestyle>` /stdWrap

   Description
         Wraps content with table-tags.

         **Note:** This property is deprecated since TYPO3 7.1! Use
         CSS instead.


.. _stdwrap-filelink:

filelink
''''''''

.. container:: table-row

   Property
         filelink

   Data type
         :ref:`->filelink <filelink>` /stdWrap

   Description
         Used to make lists of links to files.


.. _stdwrap-precobject:

preCObject
''''''''''

.. container:: table-row

   Property
         preCObject

   Data type
         :ref:`data-type-cobject`

   Description
         cObject prepended the content.


.. _stdwrap-postcobject:

postCObject
'''''''''''

.. container:: table-row

   Property
         postCObject

   Data type
         :ref:`data-type-cobject`

   Description
         cObject appended the content.


.. _stdwrap-wrapalign:

wrapAlign
'''''''''

.. container:: table-row

   Property
         wrapAlign

   Data type
         :ref:`align <data-type-align>` /stdWrap

   Description
         Wraps content with <div style=text-align:[*value*];"> \| </div>
         *if* align is set.


.. _stdwrap-typolink:

typolink
''''''''

.. container:: table-row

   Property
         typolink

   Data type
         :ref:`->typolink <typolink>` /stdWrap

   Description
         Wraps the content with a link-tag.


.. _stdwrap-tcaselectitem:

TCAselectItem
'''''''''''''

.. container:: table-row

   Property
         TCAselectItem

   Data type
         Array of properties /stdWrap

   Description
         Resolves a comma-separated list of values into the TCA item
         representation.

         **.table:** String. *The Table to look up.*

         **.field:** String. *The field to resolve.*

         **.delimiter:** String. *Delimiter for concatenating multiple
         elements.*

         **Note:** Currently this works only with TCA fields of type "select"
         which are not database relations.


.. _stdwrap-spacebefore:

spaceBefore
'''''''''''

.. container:: table-row

   Property
         spaceBefore

   Data type
         integer /stdWrap

   Description
         Pixels space before. Done with a clear-gif; <img ...><br>.


.. _stdwrap-spaceafter:

spaceAfter
''''''''''

.. container:: table-row

   Property
         spaceAfter

   Data type
         integer /stdWrap

   Description
         Pixels space after. Done with a clear-gif; <img ...><br>.


.. _stdwrap-space:

space
'''''

.. container:: table-row

   Property
         space

   Data type
         :ref:`space <data-type-space>` /stdWrap

   Description
         [spaceBefore] \| [spaceAfter]

         **Additional property:**

         .useDiv = 1

         If set, a clear gif is not used but rather a <div> tag with a style-
         attribute setting the height. (Affects spaceBefore and spaceAfter as
         well).


.. _stdwrap-wrap:

wrap
''''

.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /+.splitChar /stdWrap

   Description
         .splitChar defines an alternative splitting character (default is "\|"
         - the vertical line)


.. _stdwrap-notrimwrap:

noTrimWrap
''''''''''

.. container:: table-row

   Property
         noTrimWrap

   Data type
         "special" wrap /+.splitChar /stdWrap

   Description
         This wraps the content *without* trimming the values. That means that
         surrounding whitespaces stay included! Note that this kind of wrap
         does not only need a special character in the middle, but that it also
         needs the same special character to begin and end the wrap (default
         for all three is "\|").

         **Example:** ::

            noTrimWrap = | val1 | val2 |

         In this example the content with the values val1 and val2 will be
         wrapped; including the whitespaces.

         **Additional property:**

         .splitChar

         Can be set to define an alternative special character. stdWrap is
         available. Default is "\|" - the vertical line. This sub-property is
         useful in cases when the default special character would be recognized
         by :ref:`objects-optionsplit` (which takes precedence over noTrimWrap).

         **Example:** ::

            noTrimWrap = ^ val1 ^ val2 ^ || ^ val3 ^ val4 ^
            noTrimWrap.splitChar = ^

         :ref:`objects-optionsplit` will use the "\|\|" to have two subparts in
         the first part. In each subpart noTrimWrap will then use the "^" as
         special character.


.. _stdwrap-wrap2:

wrap2
'''''

.. container:: table-row

   Property
         wrap2

   Data type
         :ref:`wrap <data-type-wrap>` /+.splitChar /stdWrap

   Description
         *same as .wrap (but watch the order in which they are executed)*


.. _stdwrap-datawrap:

dataWrap
''''''''

.. container:: table-row

   Property
         dataWrap

   Data type
         mixed /stdWrap

   Description
         The content is parsed for pairs of curly braces. The content of the
         curly braces is of the type :ref:`data-type-gettext` and is substituted with the result
         of :ref:`data-type-gettext`.

         **Example:** ::

            <div id="{tsfe : id}"> | </div>

         This will produce a <div> tag around the content with an id attribute
         that contains the number of the current page.


.. _stdwrap-prepend:

prepend
'''''''

.. container:: table-row

   Property
         prepend

   Data type
         :ref:`data-type-cobject`

   Description
         cObject prepended to content (before)


.. _stdwrap-append:

append
''''''

.. container:: table-row

   Property
         append

   Data type
         :ref:`data-type-cobject`

   Description
         cObject appended to content (after)


.. _stdwrap-wrap3:

wrap3
'''''

.. container:: table-row

   Property
         wrap3

   Data type
         :ref:`wrap <data-type-wrap>` /+.splitChar /stdWrap

   Description
         *same as .wrap (but watch the order in which they are executed)*


.. _stdwrap-orderedstdwrap:

orderedStdWrap
''''''''''''''

.. container:: table-row

   Property
         orderedStdWrap

   Data type
         Array of numeric keys with /stdWrap each

   Description
         Execute multiple stdWrap statements in a freely selectable order. The order
         is determined by the numeric order of the keys. This allows to use multiple
         stdWrap statements without having to remember the rather complex sorting
         order in which the stdWrap functions are executed.

         **Example:** ::

            10 = TEXT
            10.value = a
            10.stdWrap.orderedStdWrap {
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


.. _stdwrap-outerwrap:

outerWrap
'''''''''

.. container:: table-row

   Property
         outerWrap

   Data type
         :ref:`wrap <data-type-wrap>` /stdWrap

   Description
         *Wraps the complete content*


.. _stdwrap-insertdata:

insertData
''''''''''

.. container:: table-row

   Property
         insertData

   Data type
         boolean /stdWrap

   Description
         If set, then the content string is parsed like .dataWrap above.

         **Example:**

         Displays the page title::

            10 = TEXT
            10.value = This is the page title: {page:title}
            10.stdWrap.insertData = 1


.. _stdwrap-offsetwrap:

offsetWrap
''''''''''

.. container:: table-row

   Property
         offsetWrap

   Data type
         x,y /stdWrap

   Description
         This wraps the input in a table with columns to the left and top that
         offsets the content by the values of x,y. Based on the cObject
         :ref:`OTABLE <cobj-otable>`.

         **.tableParams / .tdParams** /:ref:`stdWrap <stdwrap>`

         \- used to manipulate tableParams/tdParams (default width=99%) of the
         offset. Default: See :ref:`OTABLE <cobj-otable>`.

         **.stdWrap**

         \- stdWrap properties wrapping the offsetWrap'ed output.

         **Note:** This property is deprecated since TYPO3 7! Use
         CSS instead.


.. _stdwrap-postuserfunc:

postUserFunc
''''''''''''

.. container:: table-row

   Property
         postUserFunc

   Data type
         function name

   Description
         Calls the provided PHP function. If you specify the name with a '->'
         in it, then it is interpreted as a call to a method in a class.

         Two parameters are sent to the PHP function: As first parameter a
         content variable, which contains the current content. This is the
         value to be processed. As second parameter any sub-properties of
         postUserFunc are provided to the function.

         The description of the cObject :ref:`USER <cobj-user>` contains some
         more in-depth information.

         **Example:**

         You can paste this example directly into a new template record::

            page = PAGE
            page.typeNum = 0

            page.10 = TEXT
            page.10 {
              value = Hello World!
              stdWrap.postUserFunc = Your\NameSpace\YourClass->reverseString
              stdWrap.postUserFunc.uppercase = 1
            }

            page.20 = TEXT
            page.20 {
              value = Hello World!
              stdWrap.postUserFunc = Your\NameSpace\YourClass->reverseString
              stdWrap.postUserFunc.uppercase = 1
              stdWrap.postUserFunc.typolink = 11
            }

         Your methods will get the parameters ``$content`` and ``$conf`` (in that order) and need to return a string.

         .. code-block:: php

            /**
             * Example of a method in a PHP class to be called from TypoScript
             *
             */
            class YourClass {
              /**
               * Reference to the parent (calling) cObject set from TypoScript
               */
              public $cObj;

              /**
               * Custom method for data processing. Also demonstrates how this gives us the ability to use methods in the parent object.
               *
               * @param	string		When custom methods are used for data processing (like in stdWrap functions), the $content variable will hold the value to be processed. When methods are meant to just return some generated content (like in USER and USER_INT objects), this variable is empty.
               * @param	array		TypoScript properties passed to this method.
               * @return	string	The input string reversed. If the TypoScript property "uppercase" was set, it will also be in uppercase. May also be linked.
               */
              public function reverseString($content, $conf) {
                $content = strrev($content);
                if (isset($conf['uppercase']) && $conf['uppercase'] === '1') {
                  // Use the method caseshift() from ContentObjectRenderer.php.
                  $content = $this->cObj->caseshift($content, 'upper');
                }
                if (isset($conf['typolink'])) {
                  // Use the method getTypoLink() from ContentObjectRenderer.php.
                  $content = $this->cObj->getTypoLink($content, $conf['typolink']);
                }
                return $content;
              }
            }

         For page.10 the content, which is present when postUserFunc is
         executed, will be given to the PHP function
         ``reverseString()``. The result will be "!DLROW OLLEH".

         The content of page.20 will be processed by the function
         ``reverseString()`` from the class ``YourClass``. This also returns
         the text "!DLROW OLLEH", but wrapped into a link to the page
         with the ID 11. The result will be "<a
         href="index.php?id=11">!DLROW OLLEH</a>".

         Note how in the second example $cObj, the reference to the
         calling cObject, is utilised to use functions from
         ContentObjectRenderer.php!


.. _stdwrap-postuserfuncint:

postUserFuncInt
'''''''''''''''

.. container:: table-row

   Property
         postUserFuncInt

   Data type
         function name

   Description
         Calls the provided PHP function. If you specify the name with a '->'
         in it, then it is interpreted as a call to a method in a class.

         Two parameters are sent to the PHP function: As first parameter a
         content variable, which contains the current content. This is the
         value to be processed. As second parameter any sub-properties of
         postUserFuncInt are provided to the function.

         The result will be rendered non-cached, outside the main
         page-rendering. Please see the description of the cObject :ref:`USER_INT <cobj-user-int>`.

         Supplied by Jens Ellerbrock


.. _stdwrap-preficomment:

prefixComment
'''''''''''''

.. container:: table-row

   Property
         prefixComment

   Data type
         string /stdWrap

   Description
         Prefixes content with an HTML comment with the second part of input
         string (divided by "\|") where first part is an integer telling how
         many trailing tabs to put before the comment on a new line.

         The content is parsed through insertData.

         **Example:** ::

            prefixComment = 2 | CONTENT ELEMENT, uid:{field:uid}/{field:CType}

         Will indent the comment with 1 tab (and the next line with 2+1 tabs)


.. _stdwrap-editicons:

editIcons
'''''''''

.. container:: table-row

   Property
         editIcons

   Data type
         string /stdWrap

   Description
         If not empty, then insert an icon linking to
         typo3/sysext/backend/Classes/Controller/EditDocumentController.php
         with some parameters to build and backend user edit form for certain
         fields.

         The value of this property is a list of fields from a table to edit.
         It's assumed that the current record of the cObject is the record to
         be edited.

         Syntax: *optional table name* : *comma list of field names [list of
         pallette-field names separated by \| ]*

         **.beforeLastTag:** Possible values are 1, 0 and -1. If set (1), the
         icon will be inserted before the last HTML tag in the content. If -1,
         the icon will be prepended to the content. If zero (0), the icon is
         appended in the end of the content.

         **.styleAttribute:** String. Adds a style-attribute to the icon image
         with this value. For instance you can set "position:absolute" if you
         want a non-destructive insertion of the icon. Notice: For general
         styling all edit icons has the class "frontEndEditIcons" which can be
         addressed from the stylesheet of the site.

         **.iconTitle:** String. The title attribute of the image tag.

         **.iconImg:** HTML. Alternative HTML code instead of the default icon
         shown. Can be used to set another icon for editing (for instance a red
         dot or otherwise... :-)

         **Example:**

         This will insert an edit icon which links to a form where the header
         and bodytext fields are displayed and made available for editing
         (provided the user has access!). ::

            editIcons = tt_content : header, bodytext

         Or this line that puts the header\_align and date field into a
         "palette" which means they are displayed on a single line below the
         header field. This saves some space. ::

            editIcons = header[header_align|date], bodytext


.. _stdwrap-editpanel:

editPanel
'''''''''

.. container:: table-row

   Property
         editPanel

   Data type
         boolean / editPanel

   Description
         See cObject :ref:`cobj-editpanel`.


.. _stdwrap-cache:

cache
'''''

.. container:: table-row

   Property
         cache

   Data type
         :ref:`cache <cache>`

   Description
         Caches rendered content in the caching framework.


.. _stdwrap-debug:

debug
'''''

.. container:: table-row

   Property
         debug

   Data type
         boolean /stdWrap

   Description
         Prints content with HTMLSpecialChars() and <pre></pre>: Useful for
         debugging which value stdWrap actually ends up with, if you are
         constructing a website with TypoScript.

         Should be used under construction only.


.. _stdwrap-debugfunc:

debugFunc
'''''''''

.. container:: table-row

   Property
         debugFunc

   Data type
         boolean /stdWrap

   Description
         Prints the content directly to browser with the debug() function.

         Should be used under construction only.

         Set to value "2" the content will be printed in a table - looks nicer.


.. _stdwrap-debugdata:

debugData
'''''''''

.. container:: table-row

   Property
         debugData

   Data type
         boolean /stdWrap

   Description
         Prints the current data-array, $cObj->data, directly to browser. This
         is where ".field" gets data from.

         Should be used under construction only.


[tsref:->stdWrap]

