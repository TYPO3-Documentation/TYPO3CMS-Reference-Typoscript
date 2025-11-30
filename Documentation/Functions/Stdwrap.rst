..  include:: /Includes.rst.txt
..  index::
    Functions; stdWrap
    !Function stdWrap
    stdWrap

..  _stdwrap:

=======
stdWrap
=======

A "stdWrap" TypoScript property ("standard wrap") is a function that "wraps"
text values. A TEXT object value is parsed by the stdWrap function using the value's properties
as parameters.

..  contents:: Table of contents
    :local:

..  _stdwrap-properties-content-supply:

Content-supplying properties of stdWrap
=======================================

The properties that can be supplied as parameters are listed below.

..  note::
    Content-supplying properties are those that import content
    from other variables or arrays. These properties are parsed in the order :typoscript:`data`,
    :typoscript:`field`, :typoscript:`current`, :typoscript:`cObject`.

For further information see
:t3src:`frontend/Classes/ContentObject/ContentObjectRenderer.php`
on the :php:`stdWrap()` function and on the array :php:`$stdWrapOrder`,
which represents the order of execution.

Use the :typoscript:`stdWrap` property "orderedStdWrap" if you want to execute
multiple :typoscript:`stdWrap` functions in an order you choose.

In the example below, the line :typoscript:`10.value = some text` is discarded
because the value is imported from the header field in
:php:`$cObj->data-array`.

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper
   10.stdWrap.field = header

..  _stdwrap-properties:

Properties
==========

..  index:: Function stdWrap; Getting data
..  _stdwrap-get-data:

Properties for getting data
----------------------------

..  confval-menu::
    :name: stdwrap-get
    :display: table
    :type:

    ..  _stdwrap-setContentToCurrent:

    ..  confval:: setContentToCurrent
        :name: stdwrap-setContentToCurrent
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Sets the current value to the incoming content of the function.

    ..  _stdwrap-addpagecachetags:

    ..  confval:: addPageCacheTags
        :name: stdwrap-addpagecachetags
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Comma-separated list of cache tags to tag pages in the page
        cache.

        ..  rubric:: Examples

        .. code-block:: typoscript

            addPageCacheTags = pagetag1,pagetag2,pagetag3

        This will add the tags "pagetag1", "pagetag2" and "pagetag3" to the
        cached pages in cache_pages.

        Cached pages with a tag can be deleted from the cache using the TSconfig option
        :ref:`TCEMAIN.clearCacheCmd <pagetcemain-clearcachecmd>`.

        ..  note::
            To store rendered content in the
            caching framework use the :ref:`stdwrap-cache`:typoscript:`cache`
            property.


    ..  _stdwrap-setCurrent:

    ..  confval:: setCurrent
        :name: stdwrap-setCurrent
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Sets the "current"-value. This is normally set from an external
        routine, so be careful with this. But it might come in useful.


    ..  _stdwrap-lang:

    ..  confval:: lang
        :name: stdwrap-lang
        :type: Array of language keys / :ref:`stdWrap`

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

    ..  confval:: data
        :name: stdwrap-data
        :type: :ref:`data-type-gettext` / :ref:`stdWrap`

    ..  _stdwrap-field:

    ..  confval:: field
        :name: stdwrap-field
        :type: Field name / :ref:`stdWrap`

        Sets the content to the value of the corresponding field
        (from :php:`$cObj->data[*field*]`).

        ..  note::
            :php:`$cObj->data` changes depending on the context.
            See the description of the data type ":ref:`data-type-gettext`" field

        ..  rubric:: Examples

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.field = title

        This sets the content to the value of the field "title".

        You can provide multiple field name options separated by "//".

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.field = nav_title // title

        The content from the `nav_title` field will be returned
        unless it is a blank string. If it is a blank string, the value of
        the title field is returned.


    ..  _stdwrap-current:

    ..  confval:: current
        :name: stdwrap-current
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Sets the content to the "current" value (see :ref:`->split <split>`)


    ..  _stdwrap-cObject:

    ..  confval:: cObject
        :name: stdwrap-cObject
        :type: :ref:`data-type-cobject`

        Loads content from a content object.


    ..  _stdwrap-numRows:

    ..  confval:: numRows
        :name: stdwrap-numRows
        :type: :ref:`->numRows <numrows>` / :ref:`stdWrap`

        Returns the number of rows resulting from a supplied :sql:`SELECT` query.


    ..  _stdwrap-preUserFunc:

    ..  confval:: preUserFunc
        :name: stdwrap-preUserFunc
        :type: :ref:`data-type-function-name`

        ..  important::

            ..  versionchanged:: 14.0

                PHP functions called via TypoScript **must** now use the PHP
                attribute :php:`#[AsAllowedCallable]`
                (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

        Calls a provided PHP function. If you specify the name with a '->'
        in it, then it is interpreted as a call to a class method.

        Two parameters are sent to the PHP function: a
        content variable, which contains the current content (the
        value to be processed), and any sub-properties of
        preUserFunc.

        PHP functions called via TypoScript **must** use the PHP
        attribute :php:`#[AsAllowedCallable]`
        (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

        See :ref:`stdWrap-postUserFunc`:typoscript:`postUserFunc`.


..  index:: Function stdWrap; Override and conditions
..  _stdwrap-override-conditions:

Properties for overriding and conditions
----------------------------------------

..  confval-menu::
    :name: stdwrap-override
    :display: table
    :type:

    ..  _stdwrap-override:

    ..  confval:: override
        :name: stdwrap-override
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        If `override` returns something other than "" or zero (trimmed), the
        content is loaded with this.


    ..  _stdwrap-preIfEmptyListNum:

    ..  confval:: preIfEmptyListNum
        :name: stdwrap-preIfEmptyListNum
        :type: (as ":ref:`stdwrap-listNum`" below)


    ..  _stdwrap-ifNull:

    ..  confval:: ifNull
        :name: stdwrap-ifNull
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Sets the content if the content is null (:php:`NULL` type in PHP).

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

        This example displays the content of the description field or, if that
        value is :php:`NULL`, the text "No description defined.".


    ..  _stdwrap-ifEmpty:

    ..  confval:: ifEmpty
        :name: stdwrap-ifEmpty
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        If the trimmed content is empty, the content is loaded
        with :typoscript:`ifEmpty`. Zeros are treated as empty values.


    ..  _stdwrap-ifBlank:

    ..  confval:: ifBlank
        :name: stdwrap-ifBlank
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Same as :typoscript:`ifEmpty` but the check is done against '' (empty
        string). Zeros are not treated as blank values.


    ..  _stdwrap-listNum:

    ..  confval:: listNum
        :name: stdwrap-listNum
        :type: :ref:`data-type-string` / :ref:`stdWrap`

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
            After the special keywords are replaced with their numeric
            values.

        0 - last
            If the content of `listNum` can be interpreted as an integer the
            corresponding index of the exploded content is returned. Counting
            starts at 0.

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

        ..  confval:: listNum.splitChar
            :name: stdwrap-listNum-splitChar
            :type: :ref:`data-type-string`
            :Default: `,` (comma)

            .. rubric:: Examples

            Splits the content of the `subtitle` field by the pipe character and returns
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

    ..  confval:: trim
        :name: stdwrap-trim
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        If set, the PHP-function :php:`trim()` removes whitespace around the value.


    ..  _stdwrap-strPad:

    ..  confval:: strPad
        :name: stdwrap-strPad
        :type: :ref:`strPad`

        Pads the current content to a certain length. You can define the padding
        characters and which side(s) the padding should be added.


    ..  _stdwrap-stdWrap:

    ..  confval:: stdWrap
        :name: stdwrap-stdWrap
        :type: :ref:`stdWrap`

        Recursive call to the :typoscript:`stdWrap` function.


    ..  _stdwrap-required:

    ..  confval:: required
        :name: stdwrap-required
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        This flag requires the content to be set to a certain value after a
        content import and any processing that has occurred
        (data, field, current, listNum, trim). Zero is **not** regarded as
        empty. Use "if" instead.

        If the content is empty, "" is returned.


    ..  _stdwrap-if:

    ..  confval:: if
        :name: stdwrap-if
        :type: :ref:`if`

        If the if-object returns false, stdWrap returns "".


    ..  _stdwrap-fieldRequired:

    ..  confval:: fieldRequired
        :name: stdwrap-fieldRequired
        :type: Field name / :ref:`stdWrap`

        The value in this field **must** be set.

..  _stdwrap-properties-parsing:

Properties for parsing data
---------------------------

..  confval-menu::
    :name: stdwrap-parse
    :display: table
    :type:

    ..  _stdwrap-csConv:

    ..  confval:: csConv
        :name: stdwrap-csConv
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Converts the charset of the string from the charset given as a value to
        the current rendering charset of the frontend (UTF-8).


    ..  _stdwrap-parseFunc:

    ..  confval:: parseFunc
        :name: stdwrap-parseFunc
        :type: object path reference / :ref:`parsefunc` / :ref:`stdWrap`

        Processing instructions to be applied to content.

        ..  Note::
            If you enter a string value, this will be interpreted as a
            reference to a global object path in the TypoScript object tree.
            This will be the basic configuration for parseFunc merged with any
            properties you add here. It works like references does for
            content elements.

        ..  rubric:: Examples

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10 {
                parseFunc = < lib.parseFunc_RTE
                parseFunc.tags.myTag = TEXT
                parseFunc.tags.myTag.value = This will be inserted when &lt;myTag&gt; is found!
            }

    ..  _stdwrap-parseFunc-sanitization:

    :ref:`stdwrap-htmlSanitize`:typoscript:`htmlSanitize` is enabled by default when
    :ref:`stdwrap-parseFunc`:typoscript:`parseFunc` is invoked. This includes the Fluid Viewhelper
    :html:`<f:format.html>`, since it invokes :ref:`stdwrap-parseFunc`:typoscript:`parseFunc`
    directly using :typoscript:`lib.parseFunc_RTE`.

    The following example shows how to disable the sanitization behavior (enabled
    by default). This is not recommended.

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

    Since an invocation of :typoscript:`stdWrap.parseFunc` triggers HTML
    sanitization, the following example causes a lot of generated markup to be
    sanitized and can be solved by explicitly disabling it with :typoscript:`htmlSanitize = 0`.

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

    ..  confval:: HTMLparser
        :name: stdwrap-htmlparser
        :type: :ref:`data-type-boolean` / :ref:`htmlparser` / :ref:`stdWrap`

        This object allows you to parse HTML content and perform advanced
        filtering on the content.

        Value must be set and properties are those of :ref:`htmlparser`.

        (See :ref:`t3coreapi:rte` for more information about RTE transformations)


    ..  _stdwrap-split:

    ..  confval:: split
        :name: stdwrap-split
        :type: :ref:`split` / :ref:`stdWrap`


    ..  _stdwrap-replacement:

    ..  confval:: replacement
        :name: stdwrap-replacement
        :type: :ref:`replacement` / :ref:`stdWrap`

        Performs an ordered search/replace on the current content and
        PCRE regular expressions can be used. An array with numeric
        indices defines the order of actions and thus allows multiple
        replacements at once.


    ..  _stdwrap-prioriCalc:

    ..  confval:: prioriCalc
        :name: stdwrap-prioriCalc
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Calculation of the value using operators -+\*/%^ while respecting
        the priority of + and - operators and parenthesis levels ().

        . (period) is a decimal delimiter.

        Returns a double value.

        If :typoscript:`prioriCalc` is set to `intval`, an integer is returned.

        There is no error checking, and division by zero or other invalid
        values may generate strange results. You should use proper syntax
        because future modifications to the function may add more
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

    ..  confval:: char
        :name: stdwrap-char
        :type: :ref:`data-type-integer` / :ref:`stdWrap`

        Content is set to :php:`chr(*value*)`. This returns a one-character
        string containing the character specified by ascii code. Reliable
        results will be obtained only for character codes in the integer
        range 0 - 127. See
        `the PHP manual <https://php.net/manual/en/function.chr.php>`_:

        ..  code-block:: php

            $content = chr((int)$conf['char']);


    ..  _stdwrap-intval:

    ..  confval:: intval
        :name: stdwrap-intval
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        PHP function :php:`intval()` returns an integer:

        ..  code-block:: php

            $content = intval($content);


    ..  _stdwrap-hash:

    ..  confval:: hash
        :name: stdwrap-hash
        :type: :ref:`data-type-string` / :ref:`stdWrap`

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

    ..  confval:: round
        :name: stdwrap-round
        :type: :ref:`round` / :ref:`stdWrap`

        Round the value using the selected method to the given number of
        decimals.


    ..  _stdwrap-numberFormat:

    ..  confval:: numberFormat
        :name: stdwrap-numberFormat
        :type: :ref:`numberformat`

        Format a float value to the number format you need (e.g. useful for
        prices).


    ..  _stdwrap-date:

    ..  confval:: date
        :name: stdwrap-date
        :type: :ref:`data-type-date-conf` / :ref:`stdWrap`

        The content should be the an integer representing the UNIX time (second since 1.1.1970). Returns content
        formatted as a date. See the PHP manual (`datetime.format <https://www.php.net/manual/en/datetime.createfromformat.php>`_)
        for format codes.


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
            :ref:`stdwrap-formattedDate`:typoscript:`formattedDate`.


    ..  _stdwrap-strtotime:

    ..  confval:: strtotime
        :name: stdwrap-strtotime
        :type: :ref:`data-type-string`

        Allows conversion of formatted dates to timestamps, for example to perform date calculations.

        Possible values are :typoscript:`1` or any time string valid as the first
        argument of the PHP :php:`strtotime()` function.

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


    ..  _data-type-strftime-conf:
    ..  _stdwrap-strftime:

    ..  confval:: strftime
        :name: stdwrap-strftime
        :type: :ref:`data-type-strftime-conf` / :ref:`stdWrap`

        Similar to property `date`, but uses a different format. See the PHP manual
        (`strftime <https://www.php.net/strftime>`_) for format codes.

        This formatting is useful if the locale is set in the
        :ref:`CONFIG <config>` object.

        Properties:

        .charset
            Can be set to the charset of the output string if you need to
            convert it to UTF-8. The default is to take the
            charset predicted by :php:`TYPO3\CMS\Core\Charset\CharsetConverter`.

        .GMT
            If set, PHP function `gmstrftime()
            <https://www.php.net/gmstrftime>`_ will be used instead of
            `strftime() <https://www.php.net/strftime>`_.

        ..  note::
            You should consider using the more flexible function
            :ref:`stdwrap-formattedDate`:typoscript:`formattedDate`.


    ..  _stdwrap-formattedDate:

    ..  confval:: formattedDate
        :name: stdwrap-formattedDate
        :type: :ref:`data-type-string`

        This function renders date and time based on formats/patterns defined by
        the International Components for Unicode standard (ICU). ICU-based date and
        time formatting is much more flexible for rendering than
        :ref:`stdwrap-date`:typoscript:`date` or :ref:`stdwrap-strftime`:typoscript:`strftime`, as it ships
        with default patterns for date and time based on the given locale
        (the examples below are for locale `en-US` and timezone `America/Los_Angeles`):

        *   `FULL`, for example: `Friday, March 17, 2023 at 3:00:00 AM Pacific Daylight Time`
        *   `LONG`, for example: `March 17, 2023 at 3:00:00 AM PDT`
        *   `MEDIUM`, for example: `Mar 17, 2023, 3:00:00 AM`
        *   `SHORT`, for example: `3/17/23, 3:00 AM`

        TYPO3 also adds custom patterns:

        *   `FULLDATE`, for example: `Friday, March 17, 2023`
        *   `FULLTIME`, for example: `3:00:00 AM Pacific Daylight Time`
        *   `LONGDATE`, for example: `March 17, 2023`
        *   `LONGTIME`, for example: `3:00:00 AM PDT`
        *   `MEDIUMDATE`, for example: `Mar 17, 2023`
        *   `MEDIUMTIME`, for example: `3:00:00 AM`
        *   `SHORTDATE`, for example: `3/17/23`
        *   `SHORTTIME`, for example: `3:00 AM`

        ..  note::
            You can specify your own pattern to suit your requirements, for example:
            `qqqq, yyyy` will result in `1st quarter, 2023`. Have a look into the
            `available options <https://unicode-org.github.io/icu/userguide/format_parse/datetime/#datetime-format-syntax>`__.

        The locale is typically fetched from the
        :ref:`locale setting <t3coreapi:sitehandling-addingLanguages-locale>` in the
        site configuration.

        Properties:

        .locale
            A locale other than the locale of the site language.

        ..  rubric:: Example: Full German output from a date/time value

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

        ..  rubric:: Example: Full French output from a relative date value

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            lib.my_formatted_date = TEXT
            lib.my_formatted_date {
                value = -5 days
                formattedDate = FULL
                formattedDate.locale = fr-FR
            }

        will result in "dimanche 12 mars 2023 à 11:16:44 heure d’été du Pacifique".

        ..  rubric:: Example: Custom format from a timestamp

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            lib.my_formatted_date = TEXT
            lib.my_formatted_date {
                value = 1679022000
                formattedDate = Y-MM-dd'T'HH:mm:ssZ
            }

        will return the date in the ISO 8601 format: "2023-03-17T03:00:00+00:00"

        ..  note::
            The timezone will be taken from the setting `date.timezone` in your
            :file:`php.ini`.


    ..  _stdwrap-age:

    ..  confval:: age
        :name: stdwrap-age
        :type: :ref:`data-type-boolean` or :ref:`data-type-string` / :ref:`stdWrap`

        If enabled with a "1" (number, integer) the content is seen as a date
        (UNIX-time) and the difference between current time and the content-time
        is returned as one of these eight variations:

        "xx min" or "xx hrs" or "xx days" or "xx yrs" or "xx min" or "xx hour"
        or "xx day" or "year"

        The upper limits of the variations are 60 minutes, 24 hours and
        365 days.

        If you set this property as non-integer, it is used to format the
        eight units. The first four values are the plural values and the last
        four are singular. This is the default string:

        .. code-block:: none
           :caption: Default string for age format

           min| hrs| days| yrs| min| hour| day| year

        Set another string if you want to change the units. You can include
        "-" signs. They will be removed, but they make sure that there is a
        space between the number and the unit.

        ..  rubric:: Examples
        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            lib.ageFormat = TEXT
            lib.ageFormat.stdWrap.data = page:tstamp
            lib.ageFormat.stdWrap.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"


    ..  _data-type-case:
    ..  _stdwrap-case:

    ..  confval:: case
        :name: stdwrap-case
        :type: string / :ref:`stdWrap`

        Converts case

        Uses "UTF-8" for the operation.

        ..  rubric:: Possible values:

        ============================= ==========================================================
        Value                         Effect
        ============================= ==========================================================
        :typoscript:`upper`           Convert all letters of the string to uppercase
        :typoscript:`lower`           Convert all letters of the string to lowercase
        :typoscript:`capitalize`      Convert the first character of each word in the string to uppercase
        :typoscript:`ucfirst`         Convert the first letter of the string to uppercase
        :typoscript:`lcfirst`         Convert the first letter of the string to lowercase
        :typoscript:`uppercamelcase`  Convert underscored `upper_camel_case` to `UpperCamelCase`
        :typoscript:`lowercamelcase`  Convert underscored `lower_camel_case` to `lowerCamelCase`
        ============================= ==========================================================

        ..  rubric:: Example

        Code:

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            10 = TEXT
            10.value = Hello world!
            10.case = upper

        Result:

        ..  code-block:: text
            :caption: Example Output

            HELLO WORLD!


    ..  _stdwrap-bytes:

    ..  confval:: bytes
        :name: stdwrap-bytes
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`
        :Default: iec, 1024

        This is for number values. When the 'bytes' property is added and set
        to 'true' then a number will be formatted in 'bytes' style with two
        decimals, for example, '1.53 KiB' and '1.00 MiB'.
        Learn about common notations in
        `Wikipedia "Kibibyte" <https://en.wikipedia.org/wiki/Kibibyte>`__.
        IEC naming with base 1024 is the default. Use subproperties for
        customisation.

        .labels = iec
            This is the default. IEC labels and base 1024 are used.
            Built in IEC labels are :typoscript:`" | Ki| Mi| Gi| Ti| Pi| Ei| Zi| Yi"`.
            You need to append a final string like 'B' or '-Bytes' yourself.

        .labels = si
            SI labels and base 1000 are used. Built in IEC labels are
            :typoscript:`" | k| M| G| T| P| E| Z| Y"`.
            You need to append a final string like 'B' yourself.

        .labels = "..."
            Custom values can be defined such as
            :typoscript:`.labels = " Byte| Kilobyte| Megabyte| Gigabyte"`. Use a
            vertical bar to separate the labels. Enclose the whole string in
            double quotes.

        .base = 1000
            You can set custom labels to base 1000. All
            other values, including the default, are base 1024.

        ..  attention::

            If the value isn't a number the internal PHP function may issue a
            warning which can interrupt execution depending on you error
            handling settings. Example:

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

    ..  confval:: substring
        :name: stdwrap-substring
        :type: [p1], [p2] / :ref:`stdWrap`

        Returns the substring with [p1] and [p2] sent as the 2nd and 3rd
        parameter to the PHP `mb_substr <https://www.php.net/mb_substr>`__ function.

        Uses "UTF-8".


    ..  _stdwrap-cropHTML:

    ..  confval:: cropHTML
        :name: stdwrap-cropHTML
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Crops the content to a certain length. In contrast to :typoscript:`stdWrap.crop`, it
        respects HTML tags. It does not crop inside tags and closes open tags.
        Entities (like ">") are counted as one char. See :typoscript:`stdWrap.crop` below
        for a syntax description and examples.

        Note that :typoscript:`stdWrap.crop` should not be used if :typoscript:`stdWrap.cropHTML` is
        already being used.


    ..  _stdwrap-stripHtml:

    ..  confval:: stripHtml
        :name: stdwrap-stripHtml
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Strips all HTML tags.


    ..  _stdwrap-crop:

    ..  confval:: crop
        :name: stdwrap-crop
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Crops the content to a certain length.

        You can define up to three parameters, where the third one is
        optional. The syntax is:
        [number of characters to keep] \| [ellipsis] \| [keep whole words]

        numbers of characters to keep (integer): Defines the number of characters
        to keep. For positive numbers, the first characters from the
        beginning of the string will be kept, for negative numbers, the last
        characters from the end will be kept.

        ellipsis (string): The symbols to be added replacing the part that was
        cropped. If the number of characters to keep is positive, the string will
        be *prepended* with the ellipsis, if it is negative, the string will
        be *appended* with the ellipsis.

        keep whole words (boolean): If set to 0 (default), the string is
        cropped after the defined number of characters. If set to 1,
        complete words are kept. A word which would normally be cut
        in the middle will be removed.

        ..  rubric:: Examples

        :typoscript:`20 | ...` => max 20 characters. If more, the value will be truncated
        to the first 20 characters and prepended with "..."

        :typoscript:`-20 | ...` => max 20 characters. If more, the value will be truncated
        to the last 20 characters and appended with "..."

        :typoscript:`20 | ... | 1` => max 20 characters. If more, the value will be
        truncated to the first 20 characters and prepended with "...". If
        the division is in the middle of a word, the rest of that word will be
        removed.

        Uses "UTF-8".


    ..  _stdwrap-rawUrlEncode:

    ..  confval:: rawUrlEncode
        :name: stdwrap-rawUrlEncode
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Passes the content through the `rawurlencode() <https://www.php.net/rawurlencode>`_
        PHP function .


    ..  _stdwrap-htmlSpecialChars:

    ..  confval:: htmlSpecialChars
        :name: stdwrap-htmlSpecialChars
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Passes the content through the `htmlspecialchars() <https://www.php.net/htmlspecialchars>`_ PHP function.

        Additional property :typoscript:`preserveEntities` will preserve entities so that only
        non-entity characters are affected.


    ..  _stdwrap-encodeForJavaScriptValue:

    ..  confval:: encodeForJavaScriptValue
        :name: stdwrap-encodeForJavaScriptValue
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Encodes content so that it can be safely used inside strings in JavaScript.
        Characters which can cause problems inside JavaScript strings are
        replaced with their encoded equivalents. The resulting string is
        quoted with single quotes.

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

    ..  confval:: doubleBrTag
        :name: stdwrap-doubleBrTag
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Double line breaks are substituted with this value.


    ..  _stdwrap-br:

    ..  confval:: br
        :name: stdwrap-br
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Pass the value through the `nl2br() <https://www.php.net/nl2br>`__ PHP function. This
        converts each line break to a :html:`<br />` or a :html:`<br>` tag depending on doctype.


    ..  _stdwrap-brTag:

    ..  confval:: brTag
        :name: stdwrap-brTag
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        All ASCII codes of "10" (line feed, LF) are substituted with the
        *value* of this property.


    ..  _stdwrap-encapsLines:

    ..  confval:: encapsLines
        :name: stdwrap-encapsLines
        :type: :ref:`encapslines` / :ref:`stdWrap`

        Lets you split the content with :php:`chr(10)` and process each line
        independently. Used to format RTE content .


    ..  _stdwrap-keywords:

    ..  confval:: keywords
        :name: stdwrap-keywords
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Splits the content by characters "," ";" and :php:`chr(10)` (return), trims
        each value and returns a comma-separated list of the values.


..  _stdwrap-properties-wrap:

Properties for wrapping data
----------------------------

..  confval-menu::
    :name: stdwrap-wrap
    :display: table
    :type:

    ..  _stdwrap-innerWrap:

    ..  confval:: innerWrap
        :name: stdwrap-innerWrap
        :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

        Wraps content.


    ..  _stdwrap-innerWrap2:

    ..  confval:: innerWrap2
        :name: stdwrap-innerWrap2
        :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

        Same as :typoscript:`innerWrap` (but watch the order in which they are executed).


    ..  _stdwrap-preCObject:

    ..  confval:: preCObject
        :name: stdwrap-preCObject
        :type: :ref:`data-type-cobject`

        :ref:`stdwrap-cObject`:typoscript:`cObject` prepended the content.


    ..  _stdwrap-postCObject:

    ..  confval:: postCObject
        :name: stdwrap-postCObject
        :type: :ref:`data-type-cobject`

        :ref:`stdwrap-cObject`:typoscript:`cObject` appended the content.


    ..  _data-type-align:
    ..  _stdwrap-wrapAlign:

    ..  confval:: wrapAlign
        :name: stdwrap-wrapAlign
        :type: string / :ref:`stdWrap`
        :Allowed values: :typoscript:`left`, :typoscript:`center`, :typoscript:`right`

        Wraps content with :typoscript:`<div style=text-align:[*value*];"> | </div>`
        *if* align is set.


    ..  _stdwrap-typolink:

    ..  confval:: typolink
        :name: stdwrap-typolink
        :type: :ref:`typolink` / :ref:`stdWrap`

        Wraps content with a link tag.


    ..  _stdwrap-wrap:

    ..  confval:: wrap
        :name: stdwrap-wrap
        :type: :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

        :typoscript:`splitChar` defines an alternative splitting character (the default is "\|"
        - the vertical line)

    ..  _stdwrap-noTrimWrap:

    ..  confval:: noTrimWrap
        :name: stdwrap-noTrimWrap
        :type: "special" wrap /+.splitChar / :ref:`stdWrap`

        This wraps the content *without* trimming the values. That means that
        surrounding whitespace is not removed. Note that this kind of wrap
        needs a special character in the middle as well as the same special
        character at the beginning and end of the wrap (the default
        for all three is "\|").

        **Additional property:**

        :typoscript:`splitChar`

        Can be set to define an alternative special character. :typoscript:`stdWrap` is
        available. The default is "\|" - the vertical line. This subproperty is
        useful when the default special character would be recognized
        by :ref:`optionsplit` (which takes precedence over :typoscript:`noTrimWrap`).

        ..  rubric:: Examples
        .. code-block:: typoscript
           :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

           page.10.noTrimWrap = | val1 | val2 |

        In this example the values val1 and val2 will be wrapped, including the
        whitespace.

        ..  rubric:: Examples
        .. code-block:: typoscript
           :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

           page.10 {
              noTrimWrap = ^ val1 ^ val2 ^ || ^ val3 ^ val4 ^
              noTrimWrap.splitChar = ^
           }

        :ref:`optionsplit` will use the "\|\|" to determine two subparts. In
        each subpart :typoscript:`noTrimWrap` will then use the "^" as
        special character.


    ..  _stdwrap-wrap2:

    ..  confval:: wrap2
        :name: stdwrap-wrap2
        :type: :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

        same as :ref:`stdwrap-wrap`:typoscript:`wrap` (but watch the order in which they are executed)


    ..  _stdwrap-dataWrap:

    ..  confval:: dataWrap
        :name: stdwrap-dataWrap
        :type: mixed / :ref:`stdWrap`

        The content is parsed for pairs of curly braces. The content of the
        curly braces is of the type :ref:`data-type-gettext` and is substituted with the result
        of :ref:`data-type-gettext`.

        ..  rubric:: Examples

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.dataWrap = <div id="{tsfe : id}"> | </div>

        This will produce a :html:`<div>` tag around the content with an id attribute
        that contains the id of the current page.


    ..  _stdwrap-prepend:

    ..  confval:: prepend
        :name: stdwrap-prepend
        :type: :ref:`data-type-cobject`

        :ref:`stdwrap-cObject` prepended to content (before)


    ..  _stdwrap-append:

    ..  confval:: append
        :name: stdwrap-append
        :type: :ref:`data-type-cobject`

        :ref:`stdwrap-cObject` appended to content (after)


    ..  _stdwrap-wrap3:

    ..  confval:: wrap3
        :name: stdwrap-wrap3
        :type: :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

        same as :typoscript:`wrap` (but watch the order in which they are executed)


    ..  _stdwrap-orderedStdWrap:

    ..  confval:: orderedStdWrap
        :name: stdwrap-orderedStdWrap
        :type: Array of numeric keys with / :ref:`stdWrap` each

        Execute multiple :typoscript:`stdWrap` statements in an order that
        you choose. The order is determined by the numeric order of the keys.You
        can use multiple stdWrap statements without having to remember the rather complex sorting
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
        Then the 20 key is processed. Finally :typoscript:`30.wrap`
        is executed on what already was created.

        This results in "This is a working solution."


    ..  _stdwrap-outerWrap:

    ..  confval:: outerWrap
        :name: stdwrap-outerWrap
        :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

        Wraps the complete content


    ..  _stdwrap-insertData:

    ..  confval:: insertData
        :name: stdwrap-insertData
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

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
        Never use this on content that can be edited in the backend. This would
        allows editors to disclose information that is normally hidden. Never
        use this to insert data into wraps. Use :ref:`stdwrap-dataWrap`
        :typoscript:`dataWrap` instead.


    ..  _stdwrap-postUserFunc:

    ..  confval:: postUserFunc
        :name: stdwrap-postUserFunc
        :type: :ref:`data-type-function-name`

        ..  versionchanged:: 14.0

            PHP functions called via TypoScript **must** now use the PHP
            attribute :php:`#[AsAllowedCallable]`
            (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

        Calls the provided PHP function. If the function name contains '->',
        it will be interpreted as a call to a class method.

        Two parameters are sent to the PHP function: a
        content variable containing the current content (this is the value that
        will be processed) and subproperties of
        :typoscript:`postUserFunc`.

        See description of the :ref:`USER <cobj-user>` :typoscript:`cObject` for
        more in-depth information.

        PHP functions called via TypoScript **must** use the PHP
        attribute :php:`#[AsAllowedCallable]`
        (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

        ..  rubric:: Examples

        You can paste this example directly into a new template record:

        ..  literalinclude:: _StdWrap/_UserFunction.typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        Your methods will get the parameters :php:`$content` and :php:`$conf`
        (in that order) and need to return a string.

        ..  literalinclude:: _StdWrap/_UserFunction.php
            :caption: EXT:site_package/Classes/UserFunctions/YourClass.php

        For :typoscript:`page.10`: the content which exists when
        :typoscript:`postUserFunc` is executed, will be processed by the function
        :php:`reverseString()` in the class :php:`YourClass`. The result will be
        `!DLROW OLLEH`.

        For :typoscript:`page.20` the result will be the same, but wrapped into
        a link to the page with ID 11. The result will be
        :html:`<a href="/path/to/page/id/11">!DLROW OLLEH</a>`.

        Note how in the PHP code :php:`$this->cObj`, the reference to the
        calling :typoscript:`cObject`, uses functions from
        :php:`ContentObjectRenderer` class.


    ..  _stdwrap-postUserFuncInt:

    ..  confval:: postUserFuncInt
        :name: stdwrap-postUserFuncInt
        :type: :ref:`data-type-function-name`

        ..  versionchanged:: 14.0

            PHP functions called via TypoScript **must** now use the PHP
            attribute :php:`#[AsAllowedCallable]`
            (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

        Calls the provided PHP function. If you specify a function name with '->'
        it will be interpreted as a call to a class method.

        Two parameters are sent to the PHP function: a
        content variable containing the current content (this is the value that
        will be processed) and subproperties of
        :typoscript:`postUserFuncInt`.

        The result will be rendered non-cached outside the main
        page-rendering. See the :typoscript:`cObject`
        :ref:`USER_INT <cobj-user-int>` description.

        PHP functions called via TypoScript **must** use the PHP
        attribute :php:`#[AsAllowedCallable]`
        (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).


    ..  _stdwrap-prefixComment:

    ..  confval:: prefixComment
        :name: stdwrap-prefixComment
        :type: :ref:`data-type-string` / :ref:`stdWrap`

        Prefixes content with an HTML comment. The second part of the input
        string (divided by "\|") is the comment and the first part is an integer
        denoting how many trailing tabs to put in front of the comment on a new line.

        The content is parsed through :ref:`stdwrap-insertData` :typoscript:`insertData`.

        ..  rubric:: Examples

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            prefixComment = 2 | CONTENT ELEMENT, uid:{field:uid}/{field:CType}

        Will indent the comment by 1 tab (and the next line by 2+1 tabs)


..  _stdwrap-properties-cache:

Properties for sanitizing and caching data
------------------------------------------

..  confval-menu::
    :name: stdwrap-cache
    :display: table
    :type:

    ..  _stdwrap-htmlSanitize:

    ..  confval:: htmlSanitize
        :name: stdwrap-htmlSanitize
        :type: :ref:`data-type-boolean` / array with key "build"

        This property is responsible for sanitization and removal of XSS from markup. It
        strips tags, attributes and values that are not explicitly allowed.

        * :typoscript:`htmlSanitize = [boolean]` - whether to invoke sanitization
          (enabled by default when invoked by :typoscript:`stdWrap.parseFunc`).
        * :typoscript:`htmlSanitize.build = [string]` - defines which builder
          to use (must be an instance of :php:`\TYPO3\HtmlSanitizer\Builder\BuilderInterface`)
          for building a :php:`\TYPO3\HtmlSanitizer\Sanitizer` instance
          using a particular :php:`\TYPO3\HtmlSanitizer\Behavior`. It can either be
          a fully qualified class name or the name of a preset as defined in
          :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['htmlSanitizer']` - the default is
          :php:`\TYPO3\CMS\Core\Html\DefaultSanitizerBuilder`.

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

        The following code is equivalent to the above, but specifies a builder:

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

    ..  confval:: cache
        :name: stdwrap-cache
        :type: :ref:`cache`

        Caches rendered content in the caching framework.

..  _stdwrap-properties-debug:

Properties for debugging data
-----------------------------

..  confval-menu::
    :name: stdwrap-debug
    :display: table
    :type:

    ..  _stdwrap-debug:

    ..  confval:: debug
        :name: stdwrap-debug
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Prints content with :php:`HTMLSpecialChars()` and :html:`<pre></pre>`.
        Useful for debugging the resulting value of :typoscript:`stdWrap`.

    .. attention::

       Only use this for debugging during development, otherwise output can break.


    ..  _stdwrap-debugFunc:

    ..  confval:: debugFunc
        :name: stdwrap-debugFunc
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Prints the content directly to the browser using the :php:`debug()` function.

        If set to value "2" the content will be printed in a table (which looks nicer).

    ..  attention::

        Only use this for debugging during development, otherwise output can break.


    ..  _stdwrap-debugData:

    ..  confval:: debugData
        :name: stdwrap-debugData
        :type: :ref:`data-type-boolean` / :ref:`stdWrap`

        Prints the current data-array, :php:`$cObj->data`, directly to the browser. This
        is where :typoscript:`field` gets data from.

    ..  attention::

        Only use this for debugging during development, otherwise output can break.

.. _stdwrap-examples:

Example
=======

Content object ":ref:`cobj-text`" containing property "value":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = TEXT
    10.value = some text
    10.stdWrap.case = upper

Here the content in object "10" is converted into uppercase before it is
returned.
