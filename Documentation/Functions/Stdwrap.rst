.. include:: /Includes.rst.txt
.. index::
   Functions; stdWrap
   stdWrap
.. highlight:: typoscript


.. The label objects-stdwrap should no longer be used.
.. Use the label stdwrap instead.
.. It only remains here, in case it is still being used.

.. _objects-stdwrap:
.. _stdwrap:

=======
stdWrap
=======

When a data type is set to "*type* /stdWrap" it means that the value
is parsed through the stdWrap function with the properties of the
value as parameters.


.. _stdwrap-examples:

Example
=======

Example with the property "value" of the content object ":ref:`cobj-text`":

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper

Here the content of the object "10" is uppercased before it is
returned.


.. index:: stdWrap; Content-supplying properties
.. _stdwrap-content-supplying:

Content-supplying properties of stdWrap
=======================================

stdWrap contains properties which determine what is applied. The properties
are listed below.

The properties are parsed in the listed order. The
properties :typoscript:`data`, :typoscript:`field`, :typoscript:`current`, :typoscript:`cObject`
(in that order!) are special as they are used to import content
from variables or arrays.

If you want to study this further please refer to
:file:`typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php`,
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


.. index:: stdWrap; Getting data
.. _stdwrap-get-data:

Getting data
============


.. index:: stdWrap; setContentToCurrent
.. _stdwrap-setcontenttocurrent:

setContentToCurrent
-------------------

:aspect:`Property`
   setContentToCurrent

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Sets the current value to the incoming content of the function.


.. index:: stdWrap; addPageCacheTags
.. _stdwrap-addpagecachetags:

addPageCacheTags
----------------

:aspect:`Property`
   addPageCacheTags

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Comma-separated list of cache tags, which should be added to the page
   cache.

:aspect:`Example`
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


.. index:: stdWrap; setCurrent
.. _stdwrap-setcurrent:

setCurrent
----------

:aspect:`Property`
   setCurrent

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Sets the "current"-value. This is normally set from some outside
   routine, so be careful with this. But it might be handy to do this


.. index:: stdWrap; lang
.. _stdwrap-lang:

lang
----

:aspect:`Property`
   lang

:aspect:`Data type`
   Array of language keys / :ref:`stdWrap`

:aspect:`Description`
   This is used to define optional language specific values based on the
   :ref:`current site language <t3coreapi:sitehandling-addingLanguages>`.

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 = TEXT
      page.10.value = I am a Berliner!
      page.10.stdWrap.lang.de = Ich bin ein Berliner!

   Output will be "Ich bin..." instead of "I am..."


.. index:: stdWrap; data
.. _stdwrap-data:

data
----

:aspect:`Property`
   data

:aspect:`Data type`
   :ref:`data-type-gettext` / :ref:`stdWrap`


.. index:: stdWrap; field
.. _stdwrap-field:

field
-----

:aspect:`Property`
   field

:aspect:`Data type`
   Field name / :ref:`stdWrap`

:aspect:`Description`
   Sets the content to the value of the according field
   (which comes from :php:`$cObj->data[*field*]`).

   **Note:** :php:`$cObj->data` changes depending on the context.
   See the description for the data type ":ref:`data-type-gettext`"/field!

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.field = title

   This sets the content to the value of the field "title".

   You can also check multiple field names, if you divide them
   by "//".

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.field = nav_title // title

   Here the content from the field nav\_title will be returned
   unless it is a blank string. If a blank string, the value of
   the title field is returned.


.. index:: stdWrap; current
.. _stdwrap-current:

current
-------

:aspect:`Property`
   current

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Sets the content to the "current"-value (see :ref:`->split <split>`)


.. index:: stdWrap; cObject
.. _stdwrap-cobject:

cObject
-------

:aspect:`Property`
   cObject

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   Loads content from a content object.


.. index:: stdWrap; numRows
.. _stdwrap-numrows:

numRows
-------

:aspect:`Property`
   numRows

:aspect:`Data type`
   :ref:`->numRows <numrows>` / :ref:`stdWrap`

:aspect:`Description`
   Returns the number of rows resulting from the supplied SELECT query.

.. index:: stdWrap; preUserFunc
.. _stdwrap-preuserfunc:

preUserFunc
-----------

:aspect:`Property`
   preUserFunc

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
   Calls the provided PHP function. If you specify the name with a '->'
   in it, then it is interpreted as a call to a method in a class.

   Two parameters are sent to the PHP function: As first parameter a
   content variable, which contains the current content. This is the
   value to be processed. As second parameter any sub-properties of
   preUserFunc are provided to the function.

   See :ref:`stdwrap-postUserFunc`.


.. index:: stdWrap; Override and conditions
.. _stdwrap-override-conditions:

Override and conditions
=======================


.. index:: stdWrap; override
.. _stdwrap-override:

override
--------

:aspect:`Property`
   override

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   if "override" returns something else than "" or zero (trimmed), the
   content is loaded with this!


.. index:: stdWrap; preIfEmptyListNum
.. _stdwrap-preifemptylistnum:

preIfEmptyListNum
-----------------

:aspect:`Property`
   preIfEmptyListNum

:aspect:`Data type`
   (as ":ref:`stdwrap-listNum`" below)

:aspect:`Description`
   (as ":ref:`stdwrap-listNum`" below)


.. index:: stdWrap; ifNull
.. _stdwrap-ifnull:

ifNull
------

:aspect:`Property`
   ifNull

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   If the content is null (:php:`NULL` type in PHP), the content is overridden
   with the value defined here.

:aspect:`Example`

   .. code-block:: typoscript
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


.. index:: stdWrap; ifEmpty
.. _stdwrap-ifempty:

ifEmpty
-------

:aspect:`Property`
   ifEmpty

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   If the trimmed content is empty at this point, the content is loaded
   with :typoscript:`ifEmpty`. Zeros are treated as empty values!


.. index:: stdWrap; ifBlank
.. _stdwrap-ifblank:

ifBlank
-------

:aspect:`Property`
   ifBlank

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Same as :typoscript:`ifEmpty` but the check is done against ''. Zeros are not
   treated as blank values!


.. index:: stdWrap; listNum
.. _stdwrap-listnum:

listNum
-------

:aspect:`Property`
   listNum

:aspect:`Data type`
   :ref:`data-type-integer` :ref:`+calc <objects-calc>` +"last" +"rand" / :ref:`stdWrap`

:aspect:`Description`
   Explodes the content with "," (comma) and the content is set to the
   item[*value*].

   **Special keyword:** :typoscript:`last`
      Is set to the last element of the array!

   **Special keyword:** :typoscript:`rand`
      Returns a random item out of a list.

   **.splitChar** (string):
      Defines the string used to explode the value. If splitChar is an
      integer, the character with that number is used (e.g. "10" to split
      lines...).

      Default: "," (comma)

   **.stdWrap** (stdWrap properties):
      stdWrap properties of the listNum...

:aspect:`Examples`
   We have a value of "item 1, item 2, item 3, item 4":

   This would return "item 3"

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 = TEXT
      page.10.value = item 1, item 2, item 3, item 4
      page.10.listNum = last – 1

   That way the subtitle field to be displayed is chosen randomly upon
   every reload:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.5 = COA_INT
      page.5 {
         10 = TEXT
         10 {
            stdWrap.field = subtitle
            stdWrap.listNum = rand
         }
      }


.. index:: stdWrap; trim
.. _stdwrap-trim:

trim
----

:aspect:`Property`
   trim

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   If set, the PHP-function :php:`trim()` will be used to remove whitespaces
   around the value.


.. index:: stdWrap; strPad
.. _stdwrap-strpad:

strPad
------

:aspect:`Property`
   strPad

:aspect:`Data type`
   :ref:`strPad`

:aspect:`Description`
   Pads the current content to a certain length. You can define the padding
   characters and the side(s), on which the padding should be added.


.. index:: stdWrap; Recursive call
.. _stdwrap-stdwrap:

stdWrap
-------

:aspect:`Property`
   stdWrap

:aspect:`Data type`
   :ref:`stdWrap`

:aspect:`Description`
   Recursive call to the :typoscript:`stdWrap` function.


.. index:: stdWrap; required
.. _stdwrap-required:

required
--------

:aspect:`Property`
   required

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   This flag requires the content to be set to some value after any
   content-import and treatment that might have happened until now
   (data, field, current, listNum, trim). Zero is **not** regarded as
   empty! Use "if" instead!

   If the content is empty, "" is returned immediately.


.. index:: stdWrap; if
.. _stdwrap-if:

if
--

:aspect:`Property`
   if

:aspect:`Data type`
   :ref:`if`

:aspect:`Description`
   If the if-object returns false, stdWrap returns "" immediately.


.. index:: stdWrap; fieldRequired
.. _stdwrap-fieldrequired:

fieldRequired
-------------

:aspect:`Property`
   fieldRequired

:aspect:`Data type`
   Field name / :ref:`stdWrap`

:aspect:`Description`
   The value in this field **must** be set.


.. index:: stdWrap; Parsing data
.. _stdwrap-parsedata:

Parsing data
============


.. index:: stdWrap; csConv
.. _stdwrap-csconv:

csConv
------

:aspect:`Property`
   csConv

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Convert the charset of the string from the charset given as value to
   the current rendering charset of the frontend (UTF-8).


.. index:: pair: stdWrap; parseFunc
.. _stdwrap-parsefunc:

parseFunc
---------

:aspect:`Property`
   parseFunc

:aspect:`Data type`
   object path reference / :ref:`parsefunc` / :ref:`stdWrap`

:aspect:`Description`
   Processing instructions for the content.

   **Note:** If you enter a string as value, this will be taken as a
   reference to an object path globally in the TypoScript object tree.
   This will be the basis configuration for parseFunc merged with any
   properties you add here. It works exactly like references does for
   content elements.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 {
          parseFunc = < lib.parseFunc_RTE
          parseFunc.tags.myTag = TEXT
          parseFunc.tags.myTag.value = This will be inserted when &lt;myTag&gt; is found!
      }

Sanitization
''''''''''''

.. versionadded:: 9.5.29/10.4.19

:ref:`stdWrap.htmlSanitize <stdwrap-htmlsanitize>` is enabled by default when
:typoscript:`stdWrap.parseFunc` is invoked. This also includes the Fluid view
helper :html:`<f:format.html>`, since it invokes :typoscript:`parseFunc`
directly using :typoscript:`lib.parseFunc_RTE`.

The following example shows how to disable the sanitization behavior that is
enabled by default. This is not recommended, but may occasionally be necessary.

.. code-block:: typoscript
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
sanitization per default - unless explicitly disabled - the following example
the following example caused a lot of generated markup to be sanitized - and was
solved by explicitly disabling it with :typoscript:`htmlSanitize = 0`.

.. code-block:: typoscript
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


.. index:: pair: stdWrap; HTMLparser
.. _stdwrap-htmlparser:

HTMLparser
----------

:aspect:`Property`
   HTMLparser

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`htmlparser` / :ref:`stdWrap`

:aspect:`Description`
   This object allows you to parse the HTML-content and perform all kinds of
   advanced filtering on the content.

   Value must be set and properties are those of :ref:`htmlparser`.

   (See :ref:`t3coreapi:rte` for more information about RTE transformations)


.. index:: pair: stdWrap; split
.. _stdwrap-split:

split
-----

:aspect:`Property`
   split

:aspect:`Data type`
   :ref:`split` / :ref:`stdWrap`


.. index:: pair: stdWrap; replacement
.. _stdwrap-replacement:

replacement
-----------

:aspect:`Property`
   replacement

:aspect:`Data type`
   :ref:`replacement` / :ref:`stdWrap`

:aspect:`Description`
   Performs an ordered search/replace on the current content with the
   possibility of using PCRE regular expressions. An array with numeric
   indices defines the order of actions and thus allows multiple
   replacements at once.


.. index:: stdWrap; prioriCalc
.. _stdwrap-prioricalc:

prioriCalc
----------

:aspect:`Property`
   prioriCalc

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Calculation of the value using operators -+\*/%^ plus respects
   priority to + and - operators and parenthesis levels ().

   . (period) is decimal delimiter.

   Returns a doublevalue.

   If :typoscript:`prioriCalc` is set to "intval" an integer is returned.

   There is no error checking and division by zero or other invalid
   values may generate strange results. Also you should use a proper syntax
   because future modifications to the function used may allow for more
   operators and features.

:aspect:`Examples`

   .. code-block:: none
      :caption: Example Output for different calculations

      100%7 = 2
      -5*-4 = 20
      +6^2 = 36
      6 ^(1+1) = 36
      -5*-4+6^2-100%7 = 54
      -5 * (-4+6) ^ 2 - 100%7 = 98
      -5 * ((-4+6) ^ 2) - 100%7 = -22


.. index:: stdWrap; char
.. _stdwrap-char:

char
----

:aspect:`Property`
   char

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdWrap`

:aspect:`Description`
   Content is set to :php:`chr(*value*)`. This returns a one-character
   string containing the character specified by ascii code. Reliable
   results will be obtained only for character codes in the integer
   range 0 - 127. See
   `the PHP manual <https://php.net/manual/en/function.chr.php>`_:

   .. code-block:: php

      $content = chr((int)$conf['char']);


.. index:: stdWrap; intval
.. _stdwrap-intval:

intval
------

:aspect:`Property`
   intval

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   PHP function :php:`intval()` returns an integer:

   .. code-block:: php

      $content = intval($content);


.. index:: stdWrap; hash
.. _stdwrap-hash:

hash
----

:aspect:`Property`
   hash

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Returns a hashed value of the current content. Set to one of the
   algorithms which are available in PHP. For a list of supported
   algorithms see https://www.php.net/manual/en/function.hash-algos.php.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 = TEXT
      page.10 {
         value = test@example.org
         stdWrap.hash = md5
         stdWrap.wrap = <img src="https://www.gravatar.com/avatar/|" />
      }


.. index:: pair: stdWrap; round
.. _stdwrap-round:

round
-----

:aspect:`Property`
   round

:aspect:`Data type`
   :ref:`round` / :ref:`stdWrap`

:aspect:`Description`
   Round the value with the selected method to the given number of
   decimals.


.. index:: pair: stdWrap; numberFormat
.. _stdwrap-numberformat:

numberFormat
------------

:aspect:`Property`
   numberFormat

:aspect:`Data type`
   :ref:`numberformat`

:aspect:`Description`
   Format a float value to any number format you need (e.g. useful for
   prices).


.. index:: stdWrap; date
.. _stdwrap-date:

date
----

:aspect:`Property`
   date

:aspect:`Data type`
   :ref:`data-type-date-conf` / :ref:`stdWrap`

:aspect:`Description`
   The content should be data-type "UNIX-time". Returns the content
   formatted as a date. See the PHP manual (`datetime.format <https://www.php.net/manual/en/datetime.createfromformat.php>`_)
   for the format codes.


   .. code-block:: php

      $content = date($conf['date'], $content);

   Properties:

   **.GMT:** If set, the PHP function `gmdate() <https://www.php.net/gmdate>`_ will be
   used instead of `date() <https://www.php.net/date>`_.

:aspect:`Example`
   Render in human readable form:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 = TEXT
      page.10.value {
         # format like 2017-05-31 09:08
         field = tstamp
         date = Y-m-d H:i
      }


.. index:: stdWrap; strftime
.. _stdwrap-strftime:

strftime
--------

:aspect:`Property`
   strftime

:aspect:`Data type`
   :ref:`data-type-strftime-conf` / :ref:`stdWrap`

:aspect:`Description`
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


.. index:: stdWrap; strtotime
.. _stdwrap-strtotime:

strtotime
---------

:aspect:`Property`
   strtotime

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   Allows conversion of formatted dates to timestamp, e.g. to perform date calculations.

   Possible values are :typoscript:`1` or any time string valid as first argument of the PHP :php:`strtotime()` function.

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.date_as_timestamp = TEXT
      lib.date_as_timestamp {
         value = 2015-04-15
         strtotime = 1
      }

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.next_weekday = TEXT
      lib.next_weekday {
         data = GP:selected_date
         strtotime = + 2 weekdays
         strftime = %Y-%m-%d
      }


.. index:: stdWrap; age
.. _stdwrap-age:

age
---

:aspect:`Property`
   age

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` or :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
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

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.ageFormat = TEXT
      lib.ageFormat.stdWrap.data = page:tstamp
      lib.ageFormat.stdWrap.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"


.. index:: stdWrap; case
.. _stdwrap-case:

case
----

:aspect:`Property`
   case

:aspect:`Data type`
   :ref:`data-type-case` / :ref:`stdWrap`

:aspect:`Description`
   Converts case

   Uses "UTF-8" for the operation.


.. index:: stdWrap; bytes
.. _stdwrap-bytes:

bytes
-----

:aspect:`Property`
   bytes

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Default`
   iec, 1024

:aspect:`Description`
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

   .. attention::

      If the value isn't a number the internal PHP function may issue a
      warning which - depending on you error handling settings - can
      interrupt execution. Example:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 {
         value = abc
         bytes = 1
      }

      will show `0` but may raise a warning or an exception.

:aspect:`Examples`
Output value 1000 without special formatting. Shows `1000`:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page = PAGE
   page.10 = TEXT
   page.10 {
      value = 1000
   }

Format value 1000 in IEC style with base=1024. Shows `0.98 Ki`:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page = PAGE
   page.10 = TEXT
   page.10 {
      value = 1000
      bytes = 1
   }

Format value 1000 in IEC style with base=1024 and 'B' supplied by us.
Shows `0.98 KiB`:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page = PAGE
   page.10 = TEXT
   page.10 {
      value = 1000
      bytes = 1
      noTrimWrap = ||B|
   }

Format value 1000 in SI style with base=1000. Shows `1.00 k`:

.. code-block:: typoscript
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

.. code-block:: typoscript
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

.. code-block:: typoscript
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

.. code-block:: typoscript
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

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page = PAGE
   page.10 = TEXT
   page.10 {
      value = 1000
      bytes = 1
      bytes.labels = " byte (B)| kibibyte (KiB)| mebibyte (MiB)| gibibyte (GiB)| tebibyte (TiB)| pepibyte (PiB)| exbibyte (EiB)| zebibyte (ZiB)| yobibyte YiB"
      bytes.base = 1024
   }


.. index:: stdWrap; substring
.. _stdwrap-substring:

substring
---------

:aspect:`Property`
   substring

:aspect:`Data type`
   [p1], [p2] / :ref:`stdWrap`

:aspect:`Description`
   Returns the substring with [p1] and [p2] sent as the 2nd and 3rd
   parameter to the PHP `mb_substr <https://www.php.net/mb_substr>`_ function.

   Uses "UTF-8" for the operation.


.. index:: stdWrap; cropHTML
.. _stdwrap-crophtml:

cropHTML
--------

:aspect:`Property`
   cropHTML

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Crops the content to a certain length. In contrast to :typoscript:`stdWrap.crop` it
   respects HTML tags. It does not crop inside tags and closes open tags.
   Entities (like ">") are counted as one char. See :typoscript:`stdWrap.crop` below
   for a syntax description and examples.

   Note that :typoscript:`stdWrap.crop` should not be used if :typoscript:`stdWrap.cropHTML` is
   already used.


.. index:: stdWrap; stripHtml
.. _stdwrap-striphtml:

stripHtml
---------

:aspect:`Property`
   stripHtml

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Strips all HTML tags.


.. index:: stdWrap; crop
.. _stdwrap-crop:

crop
----

:aspect:`Property`
   crop

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
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

:aspect:`Examples`
   :typoscript:`20 | ...` => max 20 characters. If more, the value will be truncated
   to the first 20 characters and prepended with "..."

   :typoscript:`-20 | ...` => max 20 characters. If more, the value will be truncated
   to the last 20 characters and appended with "..."

   :typoscript:`20 | ... | 1` => max 20 characters. If more, the value will be
   truncated to the first 20 characters and prepended with "...". If
   the division is in the middle of a word, the remains of that word is
   removed.

   Uses "UTF-8" for the operation.


.. index:: stdWrap; rawUrlEncode
.. _stdwrap-rawurlencode:

rawUrlEncode
------------

:aspect:`Property`
   rawUrlEncode

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Passes the content through the PHP function `rawurlencode() <https://www.php.net/rawurlencode>`_.


.. index:: stdWrap; htmlSpecialChars
.. _stdwrap-htmlspecialchars:

htmlSpecialChars
----------------

:aspect:`Property`
   htmlSpecialChars

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Passes the content through the PHP function `htmlspecialchars() <https://www.php.net/htmlspecialchars>`_.

   Additional property :typoscript:`preserveEntities` will preserve entities so only
   non-entity characters are affected.


.. index:: stdWrap; encodeForJavaScriptValue
.. _stdwrap-encodeforjavascriptvalue:

encodeForJavaScriptValue
------------------------

:aspect:`Property`
   encodeForJavaScriptValue

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Encodes content to be used safely inside strings in JavaScript.
   Characters, which can cause problems inside JavaScript strings, are
   replaced with their encoded equivalents. The resulting string is
   already quoted with single quotes.

   Passes the content through the core function
   :php:`\TYPO3\CMS\Core\Utility\GeneralUtility::quoteJSvalue`.

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      10 = TEXT
      10.stdWrap {
            data = GP:sWord
            encodeForJavaScriptValue = 1
            wrap = setSearchWord(|);
      }


.. index:: stdWrap; doubleBrTag
.. _stdwrap-doublebrtag:

doubleBrTag
-----------

:aspect:`Property`
   doubleBrTag

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   All double-line-breaks are substituted with this value.


.. index:: stdWrap; br
.. _stdwrap-br:

br
--

:aspect:`Property`
   br

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Pass the value through the PHP function `nl2br() <https://www.php.net/nl2br>`_. This
   converts each line break to a :html:`<br />` or a :html:`<br>` tag depending on doctype.


.. index:: stdWrap; brTag
.. _stdwrap-brtag:

brTag
-----

:aspect:`Property`
   brTag

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   All ASCII codes of "10" (line feed, LF) are substituted with the
   *value*, which has been provided in this property.


.. index:: pair: stdWrap; encapsLines
.. _stdwrap-encapslines:

encapsLines
-----------

:aspect:`Property`
   encapsLines

:aspect:`Data type`
   :ref:`encapslines` / :ref:`stdWrap`

:aspect:`Description`
   Lets you split the content by :php:`chr(10)` and process each line
   independently. Used to format content made with the RTE.


.. index:: stdWrap; keywords
.. _stdwrap-keywords:

keywords
--------

:aspect:`Property`
   keywords

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Splits the content by characters "," ";" and php:`chr(10)` (return), trims
   each value and returns a comma-separated list of the values.


.. index:: stdWrap; innerWrap
.. _stdwrap-innerwrap:

innerWrap
---------

:aspect:`Property`
   innerWrap

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

:aspect:`Description`
   Wraps the content.


.. index:: stdWrap; innerWrap2
.. _stdwrap-innerwrap2:

innerWrap2
----------

:aspect:`Property`
   innerWrap2

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

:aspect:`Description`
   Same as :typoscript:`innerWrap` (but watch the order in which they are executed).


.. index:: stdWrap; preCObject
.. _stdwrap-precobject:

preCObject
----------

:aspect:`Property`
   preCObject

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cObject` prepended the content.


.. index:: stdWrap; postCObject
.. _stdwrap-postcobject:

postCObject
-----------

:aspect:`Property`
   postCObject

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cObject` appended the content.


.. index:: stdWrap; wrapAlign
.. _stdwrap-wrapalign:

wrapAlign
---------

:aspect:`Property`
   wrapAlign

:aspect:`Data type`
   :ref:`align <data-type-align>` / :ref:`stdWrap`

:aspect:`Description`
   Wraps content with :typoscript:`<div style=text-align:[*value*];"> | </div>`
   *if* align is set.


.. index:: pair: stdWrap; typolink
.. _stdwrap-typolink:

typolink
--------

:aspect:`Property`
   typolink

:aspect:`Data type`
   :ref:`typolink` / :ref:`stdWrap`

:aspect:`Description`
   Wraps the content with a link-tag.


.. index:: stdWrap; wrap
.. _stdwrap-wrap:

wrap
----

:aspect:`Property`
   wrap

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
   :typoscript:`splitChar` defines an alternative splitting character (default is "\|"
   - the vertical line)


.. index:: stdWrap; noTrimWrap
.. _stdwrap-notrimwrap:

noTrimWrap
----------

:aspect:`Property`
   noTrimWrap

:aspect:`Data type`
   "special" wrap /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
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
   by :ref:`objects-optionsplit` (which takes precedence over :typoscript:`noTrimWrap`).

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.noTrimWrap = | val1 | val2 |

   In this example the content with the values val1 and val2 will be
   wrapped; including the whitespaces.

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 {
         noTrimWrap = ^ val1 ^ val2 ^ || ^ val3 ^ val4 ^
         noTrimWrap.splitChar = ^
      }

   :ref:`objects-optionsplit` will use the "\|\|" to have two subparts in
   the first part. In each subpart :typoscript:`noTrimWrap` will then use the "^" as
   special character.


.. index:: stdWrap; wrap2
.. _stdwrap-wrap2:

wrap2
-----

:aspect:`Property`
   wrap2

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
   same as :ref:`stdwrap-wrap` (but watch the order in which they are executed)


.. index:: stdWrap; dataWrap
.. _stdwrap-datawrap:

dataWrap
--------

:aspect:`Property`
   dataWrap

:aspect:`Data type`
   mixed / :ref:`stdWrap`

:aspect:`Description`
   The content is parsed for pairs of curly braces. The content of the
   curly braces is of the type :ref:`data-type-gettext` and is substituted with the result
   of :ref:`data-type-gettext`.

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.dataWrap = <div id="{tsfe : id}"> | </div>

   This will produce a :html:`<div>` tag around the content with an id attribute
   that contains the number of the current page.


.. index:: stdWrap; prepend
.. _stdwrap-prepend:

prepend
-------

:aspect:`Property`
   prepend

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cobject` prepended to content (before)


.. index:: stdWrap; append
.. _stdwrap-append:

append
------

:aspect:`Property`
   append

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cobject` appended to content (after)


.. index:: stdWrap; wrap3
.. _stdwrap-wrap3:

wrap3
-----

:aspect:`Property`
   wrap3

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
   same as :typoscript:`wrap` (but watch the order in which they are executed)


.. index:: stdWrap; orderedStdWrap
.. _stdwrap-orderedstdwrap:

orderedStdWrap
--------------

:aspect:`Property`
   orderedStdWrap

:aspect:`Data type`
   Array of numeric keys with / :ref:`stdWrap` each

:aspect:`Description`
   Execute multiple :typoscript:`stdWrap` statements in a freely selectable order. The order
   is determined by the numeric order of the keys. This allows to use multiple
   stdWrap statements without having to remember the rather complex sorting
   order in which the :typoscript:`stdWrap` functions are executed.

:aspect:`Example`

   .. code-block:: typoscript
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


.. index:: stdWrap; outerWrap
.. _stdwrap-outerwrap:

outerWrap
---------

:aspect:`Property`
   outerWrap

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

:aspect:`Description`
   *Wraps the complete content*


.. index:: stdWrap; insertData
.. _stdwrap-insertdata:

insertData
----------

:aspect:`Property`
   insertData

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   If set, then the content string is parsed like :typoscript:`dataWrap` above.

:aspect:`Example`
   Displays the page title:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      10 = TEXT
      10.value = This is the page title: {page:title}
      10.stdWrap.insertData = 1

.. warning::
   Never use this on content that can be edited in the backend. This allows editors to disclose
   normally hidden information. Never use this to insert data into wraps.
   Use :ref:`dataWrap <stdwrap-datawrap>` instead.


.. index:: stdWrap; postUserFunc
.. _stdwrap-postuserfunc:

postUserFunc
------------

:aspect:`Property`
   postUserFunc

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
   Calls the provided PHP function. If you specify the name with a '->'
   in it, then it is interpreted as a call to a method in a class.

   Two parameters are sent to the PHP function: As first parameter a
   content variable, which contains the current content. This is the
   value to be processed. As second parameter any sub-properties of
   :typoscript:`postUserFunc` are provided to the function.

   The description of the :typoscript:`cObject` :ref:`USER <cobj-user>` contains some
   more in-depth information.

:aspect:`Example`
   You can paste this example directly into a new template record:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

   Your methods will get the parameters :php:`$content` and :php:`$conf`
   (in that order) and need to return a string.

   .. code-block:: php
      :caption: EXT:site_package/Classes/UserFunctions/YourClass.php

      namespace Vendor\SitePackage\UserFunctions;
      /**
         * Example of a method in a PHP class to be called from TypoScript
         *
         */
      class YourClass
      {
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
         public function reverseString($content, $conf)
         {
            $content = strrev($content);
            if (isset($conf['uppercase']) && $conf['uppercase'] === '1') {
            // Use the method caseshift() from ContentObjectRenderer.php.
            $content = $this->cObj->caseshift($content, 'upper');
            }
            if (isset($conf['typolink'])) {
            // Use the method typoLink() from ContentObjectRenderer.php.
            $content = $this->cObj->typoLink($content, ['parameter' => $conf['typolink']]);
            }
            return $content;
         }
      }

   For :typoscript:`page.10` the content, which is present when :typoscript:`postUserFunc` is
   executed, will be given to the PHP function
   :php:`reverseString()`. The result will be "!DLROW OLLEH".

   The content of :typoscript:`page.20` will be processed by the function
   :php:`reverseString()` from the class :php:`YourClass`. This also returns
   the text "!DLROW OLLEH", but wrapped into a link to the page
   with the ID 11. The result will be :html:`<a href="index.php?id=11">!DLROW OLLEH</a>`.

   Note how in the second example :php:`$cObj`, the reference to the
   calling :typoscript:`cObject`, is utilised to use functions from
   :file:`ContentObjectRenderer.php`!


.. index:: stdWrap; postUserFuncInt
.. _stdwrap-postuserfuncint:

postUserFuncInt
---------------

:aspect:`Property`
   postUserFuncInt

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
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


.. index:: stdWrap; prefixComment
.. _stdwrap-preficomment:
.. _stdwrap-prefixcomment:

prefixComment
-------------

:aspect:`Property`
   prefixComment

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Prefixes content with an HTML comment with the second part of input
   string (divided by "\|") where first part is an integer telling how
   many trailing tabs to put before the comment on a new line.

   The content is parsed through :ref:`stdwrap-insertData`.

:aspect:`Example`

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      prefixComment = 2 | CONTENT ELEMENT, uid:{field:uid}/{field:CType}

   Will indent the comment with 1 tab (and the next line with 2+1 tabs)


.. index:: stdWrap; cache
.. _stdwrap-cache:

htmlSanitize
------------

.. index:: stdWrap; htmlSanitize
.. _stdwrap-htmlsanitize:

.. versionadded:: 9.5.29/10.4.19

:aspect:`Property`
   htmlSanitize

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / array with key "build"

:aspect:`Description`
   The property controls the sanitization and removal of XSS from markup. It
   strips tags, attributes or values that were not explicitly allowed.

   * :typoscript:`htmlSanitize = [boolean]`: whether to invoke sanitization
     (enabled per default when invoked via :typoscript:`stdWrap.parseFunc`).
   * :typoscript:`htmlSanitize.build = [string]`: defines which specific builder
     (must be an instance of :php:`\TYPO3\HtmlSanitizer\Builder\BuilderInterface`)
     to be used for building a :php:`\TYPO3\HtmlSanitizer\Sanitizer` instance
     using a particular :php:`\TYPO3\HtmlSanitizer\Behavior`. This can either be
     a fully qualified class name or the name of a preset as defined in
     :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['htmlSanitizer']` - per default,
     :php:`\TYPO3\CMS\Core\Html\DefaultSanitizerBuilder` is used.

:aspect:`Examples`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      10 = TEXT
      10 {
          value = <div><img src="invalid.file" onerror="alert(1)"></div>
          htmlSanitize = 1
      }

   will result in the following output:

   .. code-block:: html

      <div><img src="invalid.file"></div>

   The following code is equivalent to above, but with a builder specified:

   .. code-block:: typoscript
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


cache
-----

:aspect:`Property`
   cache

:aspect:`Data type`
   :ref:`cache`

:aspect:`Description`
   Caches rendered content in the caching framework.


.. index:: stdWrap; debug
.. _stdwrap-debug:

debug
-----

:aspect:`Property`
   debug

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Prints content with :php:`HTMLSpecialChars()` and :html:`<pre></pre>`:
   Useful for debugging which value :typoscript:`stdWrap` actually ends up with,
   if you are constructing a website with TypoScript.

.. attention::

   Only for debugging during development, otherwise output can break.


.. index:: stdWrap; debugFunc
.. _stdwrap-debugfunc:

debugFunc
---------

:aspect:`Property`
   debugFunc

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Prints the content directly to browser with the :php:`debug()` function.

   Set to value "2" the content will be printed in a table which looks nicer.

.. attention::

   Only for debugging during development, otherwise output can break.


.. index:: stdWrap; debugData
.. _stdwrap-debugdata:

debugData
---------

:aspect:`Property`
   debugData

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Prints the current data-array, :php:`$cObj->data`, directly to browser. This
   is where :typoscript:`field` gets data from.

.. attention::

   Only for debugging during development, otherwise output can break.
