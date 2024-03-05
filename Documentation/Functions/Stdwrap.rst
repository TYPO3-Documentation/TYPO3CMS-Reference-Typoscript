..  include:: /Includes.rst.txt
..  index::
    Functions; stdWrap
    !Function stdWrap
    stdWrap

..  _stdwrap:

=======
stdWrap
=======

When a data type is set to "*type* /stdWrap" it means that the value
is parsed through the stdWrap function with the properties of the
value as parameters.

..  contents:: Table of contents
    :local:

Content-supplying properties of stdWrap
=======================================

stdWrap contains properties which determine what is applied. The properties
are listed below.

..  note::
    The properties are parsed in the listed order. The
    properties :typoscript:`data`, :typoscript:`field`, :typoscript:`current`, :typoscript:`cObject`
    (in that order!) are special as they are used to import content
    from variables or arrays.

If you want to study this further please refer to
:t3src:`frontend/Classes/ContentObject/ContentObjectRenderer.php`,
where you will find the function :php:`stdWrap()` and the array :php:`$stdWrapOrder`,
which represents the exact order of execution.

Note that the :typoscript:`stdWrap` property "orderedStdWrap" allows you to execute
multiple :typoscript:`stdWrap` functions in a freely selectable order.

The above example could be rewritten to this:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper
   10.stdWrap.field = header

Now the line :typoscript:`10.value = some text` is obsolete, because the whole
value is "imported" from the field called "header" from the
:php:`$cObj->data-array`.

Properties
==========

..  index:: Function stdWrap; Getting data
..  _stdwrap-get-data:

Properties for getting data
----------------------------

..  _stdwrap-setContentToCurrent:

setContentToCurrent
~~~~~~~~~~~~~~~~~~~

..  confval:: setContentToCurrent

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Sets the current value to the incoming content of the function.

..  _stdwrap-addpagecachetags:

addPageCacheTags
~~~~~~~~~~~~~~~~

..  confval:: addPageCacheTags

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Comma-separated list of cache tags, which should be added to the page
    cache.

    ..  rubric:: Examples

    .. code-block:: typoscript

        addPageCacheTags = pagetag1,pagetag2,pagetag3

    This will add the tags "pagetag1", "pagetag2" and "pagetag3" to the
    according cached pages in cache_pages.

    Pages, which have been cached with a tag, can be deleted from cache
    again with the TSconfig option
    :ref:`TCEMAIN.clearCacheCmd <t3tsconfig:pagetcemain-clearcachecmd>`.

    ..  note::
        If you instead want to store rendered content into the
        caching framework, see the stdWrap feature :ref:`stdwrap-cache`.


..  _stdwrap-setCurrent:

setCurrent
~~~~~~~~~~

..  confval:: setCurrent

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Sets the "current"-value. This is normally set from some outside
    routine, so be careful with this. But it might be handy to do this


..  _stdwrap-lang:

lang
~~~~

..  confval:: lang

    :Data type: Array of language keys / :ref:`stdWrap`

    This is used to define optional language specific values based on the
    :ref:`current site language <t3coreapi:sitehandling-addingLanguages>`.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.value = I am a Berliner!
        page.10.stdWrap.lang.de = Ich bin ein Berliner!

    Output will be "Ich bin..." instead of "I am..."


..  _stdwrap-data:

data
~~~~

..  confval:: data

    :Data type: :ref:`data-type-gettext` / :ref:`stdWrap`


..  _stdwrap-field:

field
~~~~~

..  confval:: field

    :Data type: Field name / :ref:`stdWrap`

    Sets the content to the value of the according field
    (which comes from :php:`$cObj->data[*field*]`).

    ..  note::
        :php:`$cObj->data` changes depending on the context.
        See the description for the data type ":ref:`data-type-gettext`"/field!

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.field = title

    This sets the content to the value of the field "title".

    You can also check multiple field names, if you divide them
    by "//".

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.field = nav_title // title

    Here the content from the field nav\_title will be returned
    unless it is a blank string. If a blank string, the value of
    the title field is returned.


..  _stdwrap-current:

current
~~~~~~~

..  confval:: current

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Sets the content to the "current" value (see :ref:`->split <split>`)


..  _stdwrap-cObject:

cObject
~~~~~~~

..  confval:: cObject

    :Data type: :ref:`data-type-cobject`

    Loads content from a content object.


..  _stdwrap-numRows:

numRows
~~~~~~~

..  confval:: numRows

    :Data type: :ref:`->numRows <numrows>` / :ref:`stdWrap`

    Returns the number of rows resulting from the supplied :sql:`SELECT` query.


..  _stdwrap-preUserFunc:

preUserFunc
~~~~~~~~~~~

..  confval:: preUserFunc

    :Data type: :ref:`data-type-function-name`

    Calls the provided PHP function. If you specify the name with a '->'
    in it, then it is interpreted as a call to a method in a class.

    Two parameters are sent to the PHP function: As first parameter a
    content variable, which contains the current content. This is the
    value to be processed. As second parameter any sub-properties of
    preUserFunc are provided to the function.

    See :ref:`stdwrap-postUserFunc`.


..  index:: Function stdWrap; Override and conditions
..  _stdwrap-override-conditions:

Properties for overriding and conditions
----------------------------------------

..  _stdwrap-override:

override
~~~~~~~~

..  confval:: override

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    If `override` returns something else than "" or zero (trimmed), the
    content is loaded with this!


..  _stdwrap-preIfEmptyListNum:

preIfEmptyListNum
~~~~~~~~~~~~~~~~~

..  confval:: preIfEmptyListNum

    :Data type: (as ":ref:`stdwrap-listNum`" below)


..  _stdwrap-ifNull:

ifNull
~~~~~~

..  confval:: ifNull

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    If the content is null (:php:`NULL` type in PHP), the content is overridden
    with the value defined here.

    ..  rubric:: Examples
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = COA_INT
        page.10 {
           10 = TEXT
           10 {
              stdWrap.field = description
              stdWrap.ifNull = No description defined.
           }
        }

    This example shows the content of the field description or, if that
    field contains the value :php:`NULL`, the text "No description defined.".


..  _stdwrap-ifEmpty:

ifEmpty
~~~~~~~

..  confval:: ifEmpty

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    If the trimmed content is empty at this point, the content is loaded
    with :typoscript:`ifEmpty`. Zeros are treated as empty values!


..  _stdwrap-ifBlank:

ifBlank
~~~~~~~

..  confval:: ifBlank

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Same as :typoscript:`ifEmpty` but the check is done against ''. Zeros are not
    treated as blank values!


..  _stdwrap-listNum:

listNum
~~~~~~~

..  confval:: listNum

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Explodes the current content :ref:`stdwrap-listNum-splitChar`
    (Default: `,`) and returns the object specified by `listNum`.

    Possible values:

    :typoscript:`last`
        The special keyword :typoscript:`last` is replaced with the index of
        the last element in the exploded content.

    :typoscript:`rand`
        The special keyword :typoscript:`rand` is replaced with the index of
        a random element in the exploded content.

    :ref:`calc`
        After the special keywords are replaced with their according numeric
        values the

    0 - last
        If the content of `listNum` can be interpreted as integer the according
        index of the exploded content is returned. Counting starts with 0.

    .. rubric:: Examples

    This would return "item 1":

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.value = item 1, item 2, item 3, item 4
        page.10.listNum = 0

    This would return "item 3"

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.value = item 1, item 2, item 3, item 4
        page.10.listNum = last – 1


..  _stdwrap-listNum-splitChar:

listNum.splitChar
"""""""""""""""""

..  confval:: listNum.splitChar

    :Data type: :ref:`data-type-string`
    :Default: `,` (comma)

    .. rubric:: Examples

    Splits the content of the field `subtitle` by the pipe character and returns
    a random element

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.5 = COA_INT
        page.5 {
           10 = TEXT
           10 {
              stdWrap.field = subtitle
              stdWrap.listNum = rand
              stdWrap.listNum.splitChar = |
           }
        }


..  _stdwrap-trim:

trim
~~~~

..  confval:: trim

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    If set, the PHP-function :php:`trim()` will be used to remove whitespaces
    around the value.


..  _stdwrap-strPad:

strPad
~~~~~~

..  confval:: strPad

    :Data type: :ref:`strPad`

    Pads the current content to a certain length. You can define the padding
    characters and the side(s), on which the padding should be added.


..  _stdwrap-stdWrap:

stdWrap
~~~~~~~

..  confval:: stdWrap

    :Data type: :ref:`stdWrap`

    Recursive call to the :typoscript:`stdWrap` function.


..  _stdwrap-required:

required
~~~~~~~~

..  confval:: required

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    This flag requires the content to be set to some value after any
    content-import and treatment that might have happened until now
    (data, field, current, listNum, trim). Zero is **not** regarded as
    empty! Use "if" instead!

    If the content is empty, "" is returned immediately.


..  _stdwrap-if:

if
--

..  confval:: if

    :Data type: :ref:`if`

    If the if-object returns false, stdWrap returns "" immediately.


..  _stdwrap-fieldRequired:

fieldRequired
~~~~~~~~~~~~~

..  confval:: fieldRequired

    :Data type: Field name / :ref:`stdWrap`

    The value in this field **must** be set.


Properties for parsing data
---------------------------

..  _stdwrap-csConv:

csConv
~~~~~~

..  confval:: csConv

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Convert the charset of the string from the charset given as value to
    the current rendering charset of the frontend (UTF-8).


..  _stdwrap-parseFunc:

parseFunc
~~~~~~~~~

..  confval:: parseFunc

    :Data type: object path reference / :ref:`parsefunc` / :ref:`stdWrap`

    Processing instructions for the content.

    ..  Note::
        If you enter a string as value, this will be taken as a
        reference to an object path globally in the TypoScript object tree.
        This will be the basis configuration for parseFunc merged with any
        properties you add here. It works exactly like references does for
        content elements.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 {
            parseFunc = < lib.parseFunc_RTE
            parseFunc.tags.myTag = TEXT
            parseFunc.tags.myTag.value = This will be inserted when &lt;myTag&gt; is found!
        }

Sanitization
""""""""""""

:ref:`stdwrap-htmlSanitize` is enabled by default when
:ref:`stdwrap-parseFunc` is invoked. This also includes the Fluid Viewhelper
:html:`<f:format.html>`, since it invokes :ref:`stdwrap-parseFunc`
directly using :typoscript:`lib.parseFunc_RTE`.

The following example shows how to disable the sanitization behavior that is
enabled by default. This is not recommended, but it can be disabled when required.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    // either disable globally
    lib.parseFunc.htmlSanitize = 0
    lib.parseFunc_RTE.htmlSanitize = 0

    // or disable individually per use case
    10 = TEXT
    10 {
        value = <div><img src="invalid.file" onerror="alert(1)"></div>
        parseFunc =< lib.parseFunc_RTE
        parseFunc.htmlSanitize = 0
    }

Since any invocation of :typoscript:`stdWrap.parseFunc` triggers HTML
sanitization automatically; unless explicitly disabled
the following example causes a lot of generated markup to be sanitized and can be
solved by explicitly disabling it with :typoscript:`htmlSanitize = 0`.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = FLUIDTEMPLATE
    10 {
        templateRootPaths {
            // ...
        }
        variables {
            // ...
        }
        stdWrap.parseFunc {
            // replace --- with soft-hyphen
            short.--- = &shy;
            // sanitization of ALL MARKUP is NOT DESIRED here
            htmlSanitize = 0
        }
    }

..  _stdwrap-htmlparser:

HTMLparser
~~~~~~~~~~

..  confval:: HTMLparser

    :Data type: :ref:`data-type-boolean` / :ref:`htmlparser` / :ref:`stdWrap`

    This object allows you to parse the HTML-content and perform all kinds of
    advanced filtering on the content.

    Value must be set and properties are those of :ref:`htmlparser`.

    (See :ref:`t3coreapi:rte` for more information about RTE transformations)


..  _stdwrap-split:

split
~~~~~

..  confval:: split

    :Data type: :ref:`split` / :ref:`stdWrap`


..  _stdwrap-replacement:

replacement
~~~~~~~~~~~

..  confval:: replacement

    :Data type: :ref:`replacement` / :ref:`stdWrap`

    Performs an ordered search/replace on the current content with the
    possibility of using PCRE regular expressions. An array with numeric
    indices defines the order of actions and thus allows multiple
    replacements at once.


..  _stdwrap-prioriCalc:

prioriCalc
~~~~~~~~~~

..  confval:: prioriCalc

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Calculation of the value using operators -+\*/%^ plus respects
    priority to + and - operators and parenthesis levels ().

    . (period) is decimal delimiter.

    Returns a doublevalue.

    If :typoscript:`prioriCalc` is set to "intval" an integer is returned.

    There is no error checking and division by zero or other invalid
    values may generate strange results. Also you should use a proper syntax
    because future modifications to the function used may allow for more
    operators and features.

    ..  rubric:: Examples

    ..  code-block:: none
        :caption: Example Output for different calculations

        100%7 = 2
        -5*-4 = 20
        +6^2 = 36
        6 ^(1+1) = 36
        -5*-4+6^2-100%7 = 54
        -5 * (-4+6) ^ 2 - 100%7 = 98
        -5 * ((-4+6) ^ 2) - 100%7 = -22


..  _stdwrap-char:

char
~~~~

..  confval:: char

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap`

    Content is set to :php:`chr(*value*)`. This returns a one-character
    string containing the character specified by ascii code. Reliable
    results will be obtained only for character codes in the integer
    range 0 - 127. See
    `the PHP manual <https://php.net/manual/en/function.chr.php>`_:

    ..  code-block:: php

        $content = chr((int)$conf['char']);


..  _stdwrap-intval:

intval
~~~~~~

..  confval:: intval

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    PHP function :php:`intval()` returns an integer:

    ..  code-block:: php

        $content = intval($content);


..  _stdwrap-hash:

hash
~~~~

..  confval:: hash

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Returns a hashed value of the current content. Set to one of the
    algorithms which are available in PHP. For a list of supported
    algorithms see https://www.php.net/manual/en/function.hash-algos.php.

    ..  rubric:: Examples
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10 {
           value = test@example.org
           stdWrap.hash = md5
           stdWrap.wrap = <img src="https://www.gravatar.com/avatar/|" />
        }


..  _stdwrap-round:

round
~~~~~

..  confval:: round

    :Data type: :ref:`round` / :ref:`stdWrap`

    Round the value with the selected method to the given number of
    decimals.


..  _stdwrap-numberFormat:

numberFormat
~~~~~~~~~~~~

..  confval:: numberFormat

    :Data type: :ref:`numberformat`

    Format a float value to any number format you need (e.g. useful for
    prices).


..  _stdwrap-date:

date
~~~~

..  confval:: date

    :Data type: :ref:`data-type-date-conf` / :ref:`stdWrap`

    The content should be data-type "UNIX-time". Returns the content
    formatted as a date. See the PHP manual (`datetime.format <https://www.php.net/manual/en/datetime.createfromformat.php>`_)
    for the format codes.


    ..  code-block:: php

        $content = date($conf['date'], $content);

    Properties:

    **.GMT:** If set, the PHP function `gmdate() <https://www.php.net/gmdate>`_ will be
    used instead of `date() <https://www.php.net/date>`_.

    ..  rubric:: Examples

    Render in human readable form:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.value {
           # format like 2017-05-31 09:08
           field = tstamp
           date = Y-m-d H:i
        }

    ..  note::
        You should consider using the more flexible function
        :ref:`stdwrap-formattedDate`.


..  _stdwrap-strtotime:

strtotime
~~~~~~~~~

..  confval:: strtotime

    :Data type: :ref:`data-type-string`

    Allows conversion of formatted dates to timestamp, e.g. to perform date calculations.

    Possible values are :typoscript:`1` or any time string valid as first argument of the PHP :php:`strtotime()` function.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.date_as_timestamp = TEXT
        lib.date_as_timestamp {
           value = 2015-04-15
           strtotime = 1
        }

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.next_weekday = TEXT
        lib.next_weekday {
           data = GP:selected_date
           strtotime = + 2 weekdays
           strftime = %Y-%m-%d
        }


..  _stdwrap-strftime:

strftime
~~~~~~~~

..  confval:: strftime

    :Data type: :ref:`data-type-strftime-conf` / :ref:`stdWrap`

    Very similar to "date", but using a different format. See the PHP manual (`strftime <https://www.php.net/strftime>`_) for the
    format codes.

    This formatting is useful if the locale is set in advance in the
    :ref:`CONFIG <config>` object. See there.

    Properties:

    .charset
        Can be set to the charset of the output string if you need to
        convert it to UTF-8. Default is to take the intelligently guessed
        charset from :php:`TYPO3\CMS\Core\Charset\CharsetConverter`.

    .GMT
        If set, the PHP function `gmstrftime()
        <https://www.php.net/gmstrftime>`_ will be used instead of
        `strftime() <https://www.php.net/strftime>`_.

    ..  note::
        You should consider using the more flexible function
        :ref:`stdwrap-formattedDate`.


..  _stdwrap-formattedDate:

formattedDate
~~~~~~~~~~~~~

..  versionadded:: 12.3

..  confval:: formattedDate

    :Data type: :ref:`data-type-string`

    The function renders date and time based on formats/patterns defined by
    the International Components for Unicode standard (ICU). ICU-based date and
    time formatting is much more flexible in rendering as
    :ref:`stdwrap-date` or :ref:`stdwrap-strftime`, as it ships
    with default patterns for date and time based on the given locale (given
    examples for locale `en-US` and timezone `America/Los_Angeles`):

    *   `FULL`, for example: `Friday, March 17, 2023 at 3:00:00 AM Pacific Daylight Time`
    *   `LONG`, for example: `March 17, 2023 at 3:00:00 AM PDT`
    *   `MEDIUM`, for example: `Mar 17, 2023, 3:00:00 AM`
    *   `SHORT`, for example: `3/17/23, 3:00 AM`

    TYPO3 also adds prepared custom patterns:

    *   `FULLDATE`, for example: `Friday, March 17, 2023`
    *   `FULLTIME`, for example: `3:00:00 AM Pacific Daylight Time`
    *   `LONGDATE`, for example: `March 17, 2023`
    *   `LONGTIME`, for example: `3:00:00 AM PDT`
    *   `MEDIUMDATE`, for example: `Mar 17, 2023`
    *   `MEDIUMTIME`, for example: `3:00:00 AM`
    *   `SHORTDATE`, for example: `3/17/23`
    *   `SHORTTIME`, for example: `3:00 AM`

    ..  note::
        You can specify an own pattern to suit your requirements, for example:
        `qqqq, yyyy` will result in `1st quarter, 2023`. Have a look into the
        `available options <https://unicode-org.github.io/icu/userguide/format_parse/datetime/#datetime-format-syntax>`__.

    The locale is typically fetched from the
    :ref:`locale setting <t3coreapi:sitehandling-addingLanguages-locale>` in the
    site configuration.

    Properties:

    .locale
        A locale other than the locale of the site language.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.my_formatted_date = TEXT
        lib.my_formatted_date {
            value = 2023-03-17 3:00:00
            formattedDate = FULL
            # Optional, if a different locale is wanted other than the site language's locale
            formattedDate.locale = de-DE
        }

    will result in "Freitag, 17. März 2023 um 03:00:00 Nordamerikanische Westküsten-Sommerzeit".

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.my_formatted_date = TEXT
        lib.my_formatted_date {
            value = -5 days
            formattedDate = FULL
            formattedDate.locale = fr-FR
        }

        will result in "dimanche 12 mars 2023 à 11:16:44 heure d’été du Pacifique".

    ..  note::
        The timezone will be taken from the setting `date.timezone` in your
        :file:`php.ini`.


..  _stdwrap-age:

age
~~~

..  confval:: age

    :Data type: :ref:`data-type-boolean` or :ref:`data-type-string` / :ref:`stdWrap`

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

    .. code-block:: none
       :caption: Default string for age format

       min| hrs| days| yrs| min| hour| day| year

    Set another string if you want to change the units. You may include
    the "-signs. They are removed anyway, but they make sure that a space
    which you might want between the number and the unit stays.

    ..  rubric:: Examples
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.ageFormat = TEXT
        lib.ageFormat.stdWrap.data = page:tstamp
        lib.ageFormat.stdWrap.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"


..  _stdwrap-case:

case
~~~~

..  confval:: case

    :Data type: :ref:`data-type-case` / :ref:`stdWrap`

    Converts case

    Uses "UTF-8" for the operation.


..  _stdwrap-bytes:

bytes
~~~~~

..  confval:: bytes

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    :Default: iec, 1024

    This is for number values. When the 'bytes' property is added and set
    to 'true' then a number will be formatted in 'bytes' style with two
    decimals like '1.53 KiB' or '1.00 MiB'.
    Learn about common notations at
    `Wikipedia "Kibibyte" <https://en.wikipedia.org/wiki/Kibibyte>`__.
    IEC naming with base 1024 is the default. Use sub-properties for
    customisation.

    .labels = iec
        This is the default. IEC labels and base 1024 are used.
        Built in IEC labels are :typoscript:`" | Ki| Mi| Gi| Ti| Pi| Ei| Zi| Yi"`.
        You need to append a final string like 'B' or '-Bytes' yourself.

    .labels = si
        In this case SI labels and base 1000 are used.
        Built in IEC labels are :typoscript:`" | k| M| G| T| P| E| Z| Y"`.
        You need to append a final string like 'B' yourself.

    .labels = "..."
        Custom values can be defined as well like with
        :typoscript:`.labels = " Byte| Kilobyte| Megabyte| Gigabyte"`. Use a
        vertical bar to separate the labels. Enclose the whole string in
        double quotes.

    .base = 1000
        Only with custom labels you can choose to set a base of1000. All
        other values, including the default, mean base 1024.

    ..  attention::

        If the value isn't a number the internal PHP function may issue a
        warning which - depending on you error handling settings - can
        interrupt execution. Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 {
           value = abc
           bytes = 1
        }

        will show `0` but may raise a warning or an exception.

    ..  rubric:: Examples

    Output value 1000 without special formatting. Shows `1000`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
        }

    Format value 1000 in IEC style with base=1024. Shows `0.98 Ki`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
        }

    Format value 1000 in IEC style with base=1024 and 'B' supplied by us.
    Shows `0.98 KiB`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
           noTrimWrap = ||B|
        }

    Format value 1000 in SI style with base=1000. Shows `1.00 k`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
           bytes.labels = si
        }

    Format value 1000 in SI style with base=1000 and 'b' supplied by us.
    Shows `1.00 kb`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
           bytes.labels = si
           noTrimWrap = ||b|
        }

    Format value 1000 with custom label and base=1000. Shows
    `1.00 x 1000 Bytes`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
           bytes.labels = " x 1 Byte| x 1000 Bytes"
           bytes.base = 1000
        }

    Format value 1000 with custom label and base=1000. Shows
    `1.00 kilobyte (kB)`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
           bytes.labels = " byte (B)| kilobyte (kB)| megabyte (MB)| gigabyte (GB)| terabyte (TB)| petabyte (PB)| exabyte (EB)| zettabyte (ZB)| yottabyte YB"
           bytes.base = 1000
        }

    Format value 1000 with custom label and base=1024. Shows
    `0.98 kibibyte (KiB)`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.10 = TEXT
        page.10 {
           value = 1000
           bytes = 1
           bytes.labels = " byte (B)| kibibyte (KiB)| mebibyte (MiB)| gibibyte (GiB)| tebibyte (TiB)| pepibyte (PiB)| exbibyte (EiB)| zebibyte (ZiB)| yobibyte YiB"
           bytes.base = 1024
        }


..  _stdwrap-substring:

substring
~~~~~~~~~

..  confval:: substring

    :Data type: [p1], [p2] / :ref:`stdWrap`

    Returns the substring with [p1] and [p2] sent as the 2nd and 3rd
    parameter to the PHP `mb_substr <https://www.php.net/mb_substr>`__ function.

    Uses "UTF-8" for the operation.


..  _stdwrap-cropHTML:

cropHTML
~~~~~~~~

..  confval:: cropHTML

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Crops the content to a certain length. In contrast to :typoscript:`stdWrap.crop` it
    respects HTML tags. It does not crop inside tags and closes open tags.
    Entities (like ">") are counted as one char. See :typoscript:`stdWrap.crop` below
    for a syntax description and examples.

    Note that :typoscript:`stdWrap.crop` should not be used if :typoscript:`stdWrap.cropHTML` is
    already used.


..  _stdwrap-stripHtml:

stripHtml
~~~~~~~~~

..  confval:: stripHtml

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Strips all HTML tags.


..  _stdwrap-crop:

crop
~~~~

..  confval:: crop

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

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

    ..  rubric:: Examples

    :typoscript:`20 | ...` => max 20 characters. If more, the value will be truncated
    to the first 20 characters and prepended with "..."

    :typoscript:`-20 | ...` => max 20 characters. If more, the value will be truncated
    to the last 20 characters and appended with "..."

    :typoscript:`20 | ... | 1` => max 20 characters. If more, the value will be
    truncated to the first 20 characters and prepended with "...". If
    the division is in the middle of a word, the remains of that word is
    removed.

    Uses "UTF-8" for the operation.


..  _stdwrap-rawUrlEncode:

rawUrlEncode
~~~~~~~~~~~~

..  confval:: rawUrlEncode

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Passes the content through the PHP function `rawurlencode() <https://www.php.net/rawurlencode>`_.


..  _stdwrap-htmlSpecialChars:

htmlSpecialChars
~~~~~~~~~~~~~~~~

..  confval:: htmlSpecialChars

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Passes the content through the PHP function `htmlspecialchars() <https://www.php.net/htmlspecialchars>`_.

    Additional property :typoscript:`preserveEntities` will preserve entities so only
    non-entity characters are affected.


..  _stdwrap-encodeForJavaScriptValue:

encodeForJavaScriptValue
~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: encodeForJavaScriptValue

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Encodes content to be used safely inside strings in JavaScript.
    Characters, which can cause problems inside JavaScript strings, are
    replaced with their encoded equivalents. The resulting string is
    already quoted with single quotes.

    Passes the content through the core function
    :php:`\TYPO3\CMS\Core\Utility\GeneralUtility::quoteJSvalue()`.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = TEXT
        10.stdWrap {
              data = GP:sWord
              encodeForJavaScriptValue = 1
              wrap = setSearchWord(|);
        }


..  _stdwrap-doubleBrTag:

doubleBrTag
~~~~~~~~~~~

..  confval:: doubleBrTag

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    All double line breaks are substituted with this value.


..  _stdwrap-br:

br
~~

..  confval:: br

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Pass the value through the PHP function `nl2br() <https://www.php.net/nl2br>`__. This
    converts each line break to a :html:`<br />` or a :html:`<br>` tag depending on doctype.


..  _stdwrap-brTag:

brTag
~~~~~

..  confval:: brTag

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    All ASCII codes of "10" (line feed, LF) are substituted with the
    *value*, which has been provided in this property.


..  _stdwrap-encapsLines:

encapsLines
~~~~~~~~~~~

..  confval:: encapsLines

    :Data type: :ref:`encapslines` / :ref:`stdWrap`

    Lets you split the content by :php:`chr(10)` and process each line
    independently. Used to format content made with the RTE.


..  _stdwrap-keywords:

keywords
~~~~~~~~

..  confval:: keywords

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Splits the content by characters "," ";" and php:`chr(10)` (return), trims
    each value and returns a comma-separated list of the values.


..  _stdwrap-innerWrap:

innerWrap
~~~~~~~~~

..  confval:: innerWrap

    :Data type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

    Wraps the content.


..  _stdwrap-innerWrap2:

innerWrap2
~~~~~~~~~~

..  confval:: innerWrap2

    :Data type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

    Same as :typoscript:`innerWrap` (but watch the order in which they are executed).


..  _stdwrap-preCObject:

preCObject
~~~~~~~~~~

..  confval:: preCObject

    :Data type: :ref:`data-type-cobject`

    :ref:`stdwrap-cObject` prepended the content.


..  _stdwrap-postCObject:

postCObject
~~~~~~~~~~~

..  confval:: postCObject

    :Data type: :ref:`data-type-cobject`

    :ref:`stdwrap-cObject` appended the content.


..  _stdwrap-wrapAlign:

wrapAlign
~~~~~~~~~

..  confval:: wrapAlign

    :Data type: :ref:`data-type-align` / :ref:`stdWrap`

    Wraps content with :typoscript:`<div style=text-align:[*value*];"> | </div>`
    *if* align is set.


..  _stdwrap-typolink:

typolink
~~~~~~~~

..  confval:: typolink

    :Data type: :ref:`typolink` / :ref:`stdWrap`

    Wraps the content with a link tag.


..  _stdwrap-wrap:

wrap
~~~~

..  confval:: wrap

    :Data type: :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

    :typoscript:`splitChar` defines an alternative splitting character (default is "\|"
    - the vertical line)

..  _stdwrap-noTrimWrap:

noTrimWrap
~~~~~~~~~~

..  confval:: noTrimWrap

    :Data type: "special" wrap /+.splitChar / :ref:`stdWrap`

    This wraps the content *without* trimming the values. That means that
    surrounding whitespaces stay included! Note that this kind of wrap
    does not only need a special character in the middle, but that it also
    needs the same special character to begin and end the wrap (default
    for all three is "\|").

    **Additional property:**

    :typoscript:`splitChar`

    Can be set to define an alternative special character. :typoscript:`stdWrap` is
    available. Default is "\|" - the vertical line. This sub-property is
    useful in cases when the default special character would be recognized
    by :ref:`optionsplit` (which takes precedence over :typoscript:`noTrimWrap`).

    ..  rubric:: Examples
    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       page.10.noTrimWrap = | val1 | val2 |

    In this example the content with the values val1 and val2 will be
    wrapped; including the whitespaces.

    ..  rubric:: Examples
    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       page.10 {
          noTrimWrap = ^ val1 ^ val2 ^ || ^ val3 ^ val4 ^
          noTrimWrap.splitChar = ^
       }

    :ref:`optionsplit` will use the "\|\|" to have two subparts in
    the first part. In each subpart :typoscript:`noTrimWrap` will then use the "^" as
    special character.


..  _stdwrap-wrap2:

wrap2
~~~~~

..  confval:: wrap2

    :Data type: :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

    same as :ref:`stdwrap-wrap` (but watch the order in which they are executed)


..  _stdwrap-dataWrap:

dataWrap
~~~~~~~~

..  confval:: dataWrap

    :Data type: mixed / :ref:`stdWrap`

    The content is parsed for pairs of curly braces. The content of the
    curly braces is of the type :ref:`data-type-gettext` and is substituted with the result
    of :ref:`data-type-gettext`.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.dataWrap = <div id="{tsfe : id}"> | </div>

    This will produce a :html:`<div>` tag around the content with an id attribute
    that contains the number of the current page.


..  _stdwrap-prepend:

prepend
~~~~~~~

..  confval:: prepend

    :Data type: :ref:`data-type-cobject`

    :ref:`stdwrap-cObject` prepended to content (before)


..  _stdwrap-append:

append
~~~~~~

..  confval:: append

    :Data type: :ref:`data-type-cobject`

    :ref:`stdwrap-cObject` appended to content (after)


..  _stdwrap-wrap3:

wrap3
~~~~~

..  confval:: wrap3

    :Data type: :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

    same as :typoscript:`wrap` (but watch the order in which they are executed)


..  _stdwrap-orderedStdWrap:

orderedStdWrap
~~~~~~~~~~~~~~

..  confval:: orderedStdWrap

    :Data type: Array of numeric keys with / :ref:`stdWrap` each

    Execute multiple :typoscript:`stdWrap` statements in a freely selectable order. The order
    is determined by the numeric order of the keys. This allows to use multiple
    stdWrap statements without having to remember the rather complex sorting
    order in which the :typoscript:`stdWrap` functions are executed.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
    :typoscript:`10.innerWrap` is executed first, followed by :typoscript:`10.wrap`.
    Then the next key is processed which is 20. Afterwards :typoscript:`30.wrap`
    is executed on what already was created.

    This results in "This is a working solution."


..  _stdwrap-outerWrap:

outerWrap
~~~~~~~~~

..  confval:: outerWrap

    :Data type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

    Wraps the complete content


..  _stdwrap-insertData:

insertData
~~~~~~~~~~

..  confval:: insertData

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    If set, then the content string is parsed like :typoscript:`dataWrap` above.

    ..  rubric:: Examples

    Displays the page title:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       10 = TEXT
       10.value = This is the page title: {page:title}
       10.stdWrap.insertData = 1

       # TEXT is already stdWrapable, so we can also use insertData right away
       20 = TEXT
       20.value = <link rel="preload" href="{path : EXT:site/Resources/Public/Fonts/Roboto.woff2}" as="font" type="font/woff2" crossorigin="anonymous">
       20.insertData = 1

..  warning::
    Never use this on content that can be edited in the backend. This allows editors to disclose
    normally hidden information. Never use this to insert data into wraps.
    Use :ref:`stdwrap-dataWrap` instead.


..  _stdwrap-postUserFunc:

postUserFunc
~~~~~~~~~~~~

..  confval:: postUserFunc

    :Data type: :ref:`data-type-function-name`

    Calls the provided PHP function. If you specify the name with a '->'
    in it, then it is interpreted as a call to a method in a class.

    Two parameters are sent to the PHP function: As first parameter a
    content variable, which contains the current content. This is the
    value to be processed. As second parameter any sub-properties of
    :typoscript:`postUserFunc` are provided to the function.

    The description of the :typoscript:`cObject` :ref:`USER <cobj-user>` contains some
    more in-depth information.

    ..  rubric:: Examples

    You can paste this example directly into a new template record:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page = PAGE
        page.typeNum = 0

        page.10 = TEXT
        page.10 {
           value = Hello World!
           stdWrap.postUserFunc = Vendor\SitePackage\UserFunctions\YourClass->reverseString
           stdWrap.postUserFunc.uppercase = 1
        }

        page.20 = TEXT
        page.20 {
           value = Hello World!
           stdWrap.postUserFunc = Vendor\SitePackage\UserFunctions\YourClass->reverseString
           stdWrap.postUserFunc.uppercase = 1
           stdWrap.postUserFunc.typolink = 11
        }

    Your methods will get the parameters :php:`$content` and :php:`$conf`
    (in that order) and need to return a string.

    ..  code-block:: php
        :caption: EXT:site_package/Classes/UserFunctions/YourClass.php

        namespace Vendor\SitePackage\UserFunctions;

        /**
         * Example of a method in a PHP class to be called from TypoScript
         */
        final class YourClass
        {
           /*
            * Reference to the parent (calling) cObject set from TypoScript
            *
            * @var ContentObjectRenderer
            */
           private $cObj;

           public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
           {
               $this->cObj = $cObj;
           }

           /**
            * Custom method for data processing. Also demonstrates how this gives us the
            * ability to use methods in the parent object.
            *
            * @param  string When custom methods are used for data processing (like in stdWrap functions), the $content variable will hold the value to be processed. When methods are meant to return some generated content (like in USER and USER_INT objects), this variable is empty.
            * @param  array  TypoScript properties passed to this method.
            * @return string The input string reversed. If the TypoScript property "uppercase" was set, it will also be in uppercase. May also be linked.
            */
           public function reverseString(string $content, array $conf): string
           {
              $content = strrev($content);
              if (isset($conf['uppercase']) && $conf['uppercase'] === '1') {
                 // Use the method caseshift() from ContentObjectRenderer
                 $content = $this->cObj->caseshift($content, 'upper');
              }
              if (isset($conf['typolink'])) {
                 // Use the method typoLink() from ContentObjectRenderer
                 $content = $this->cObj->typoLink($content, ['parameter' => $conf['typolink']]);
              }
              return $content;
           }
        }

    For :typoscript:`page.10` the content, which is present when
    :typoscript:`postUserFunc` is executed, will be given to the PHP function
    :php:`reverseString()`. The result will be `!DLROW OLLEH`.

    The content of :typoscript:`page.20` will be processed by the function
    :php:`reverseString()` from the class :php:`YourClass`. This also returns
    the text `!DLROW OLLEH`, but wrapped into a link to the page with the ID 11.
    The result will be :html:`<a href="/path/to/page/id/11">!DLROW OLLEH</a>`.

    Note how in the second example :php:`$this->cObj`, the reference to the
    calling :typoscript:`cObject`, is utilised to use functions from
    :php:`ContentObjectRenderer` class!


..  _stdwrap-postUserFuncInt:

postUserFuncInt
~~~~~~~~~~~~~~~

..  confval:: postUserFuncInt

    :Data type: :ref:`data-type-function-name`

    Calls the provided PHP function. If you specify the name with a '->'
    in it, then it is interpreted as a call to a method in a class.

    Two parameters are sent to the PHP function: As first parameter a
    content variable, which contains the current content. This is the
    value to be processed. As second parameter any sub-properties of
    postUserFuncInt are provided to the function.

    The result will be rendered non-cached, outside the main
    page-rendering. Please see the description of the :typoscript:`cObject`
    :ref:`USER_INT <cobj-user-int>`.

    Supplied by Jens Ellerbrock


..  _stdwrap-prefixComment:

prefixComment
~~~~~~~~~~~~~

..  confval:: prefixComment

    :Data type: :ref:`data-type-string` / :ref:`stdWrap`

    Prefixes content with an HTML comment with the second part of input
    string (divided by "\|") where first part is an integer telling how
    many trailing tabs to put before the comment on a new line.

    The content is parsed through :ref:`stdwrap-insertData`.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        prefixComment = 2 | CONTENT ELEMENT, uid:{field:uid}/{field:CType}

    Will indent the comment with 1 tab (and the next line with 2+1 tabs)


..  _stdwrap-htmlSanitize:

htmlSanitize
~~~~~~~~~~~~

..  confval:: htmlSanitize

    :Data type: :ref:`data-type-boolean` / array with key "build"

    The property controls the sanitization and removal of XSS from markup. It
    strips tags, attributes and values that are not explicitly allowed.

    * :typoscript:`htmlSanitize = [boolean]`: whether to invoke sanitization
      (enabled per default when invoked via :typoscript:`stdWrap.parseFunc`).
    * :typoscript:`htmlSanitize.build = [string]`: defines which specific builder
      (must be an instance of :php:`\TYPO3\HtmlSanitizer\Builder\BuilderInterface`)
      to be used for building a :php:`\TYPO3\HtmlSanitizer\Sanitizer` instance
      using a particular :php:`\TYPO3\HtmlSanitizer\Behavior`. This can either be
      a fully qualified class name or the name of a preset as defined in
      :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['htmlSanitizer']` - per default,
      :php:`\TYPO3\CMS\Core\Html\DefaultSanitizerBuilder` is used.

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = TEXT
        10 {
            value = <div><img src="invalid.file" onerror="alert(1)"></div>
            htmlSanitize = 1
        }

    will result in the following output:

    ..  code-block:: html

        <div><img src="invalid.file"></div>

    The following code is equivalent to above, but with a builder specified:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = TEXT
        10 {
            value = <div><img src="invalid.file" onerror="alert(1)"></div>
            htmlSanitize = 1
            // Use either "default" for the default builder
            htmlSanitize.build = default
            // or use the full class name of the default builder
            // htmlSanitize.build = TYPO3\CMS\Core\Html\DefaultSanitizerBuilder
        }


..  _stdwrap-cache:

cache
~~~~~

..  confval:: cache

    :Data type: :ref:`cache`

    Caches rendered content in the caching framework.


..  _stdwrap-debug:

debug
~~~~~

..  confval:: debug

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Prints content with :php:`HTMLSpecialChars()` and :html:`<pre></pre>`:
    Useful for debugging which value :typoscript:`stdWrap` actually ends up with,
    if you are constructing a website with TypoScript.

.. attention::

   Only for debugging during development, otherwise output can break.


..  _stdwrap-debugFunc:

debugFunc
~~~~~~~~~

..  confval:: debugFunc

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Prints the content directly to browser with the :php:`debug()` function.

    Set to value "2" the content will be printed in a table which looks nicer.

..  attention::

    Only for debugging during development, otherwise output can break.


..  _stdwrap-debugData:

debugData
~~~~~~~~~

..  confval:: debugData

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap`

    Prints the current data-array, :php:`$cObj->data`, directly to browser. This
    is where :typoscript:`field` gets data from.

..  attention::

    Only for debugging during development, otherwise output can break.

.. _stdwrap-examples:

Example
=======

Example with the property "value" of the content object ":ref:`cobj-text`":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = TEXT
    10.value = some text
    10.stdWrap.case = upper

Here the content of the object "10" is upper-cased before it is
returned.
