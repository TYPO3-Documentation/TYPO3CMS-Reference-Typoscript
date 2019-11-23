.. include:: ../Includes.txt

.. highlight:: typoscript

.. _stdwrap:

=======
stdWrap
=======

This function is often added as a property to values in TypoScript.

.. _stdwrap-examples:

Example with the property "value" of the content object ":ref:`cobj-text`"::

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper

Here the content of the object "10" is uppercased before it is
returned.

stdWrap properties are executed in the order they appear in the table
below. If you want to study this further please refer to
:file:`typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php`,
where you will find the function :php:`stdWrap()` and the array :php:`$stdWrapOrder`,
which represents the exact order of execution.

Note that the :ts:`stdWrap` property "orderedStdWrap" allows you to execute
multiple :ts:`stdWrap` functions in a freely selectable order.


.. _stdwrap-content-supplying:

Content-supplying properties of stdWrap
=======================================

The properties in this table are parsed in the listed order. The
properties :ts:`data`, :ts:`field`, :ts:`current`, :ts:`cObject`
(in that order!) are special as they are used to import content
from variables or arrays. The above example could be rewritten to this::

   10 = TEXT
   10.value = some text
   10.stdWrap.case = upper
   10.stdWrap.field = header

Now the line :ts:`10.value = some text` is obsolete, because the whole
value is "imported" from the field called "header" from the
:php:`$cObj->data-array`.


.. _stdwrap-get-data:

Getting data
============


.. _stdwrap-setcontenttocurrent:

setContentToCurrent
~~~~~~~~~~~~~~~~~~~

:aspect:`Property`
   setContentToCurrent

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Sets the current value to the incoming content of the function.


.. _stdwrap-addpagecachetags:

addPageCacheTags
~~~~~~~~~~~~~~~~

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


.. _stdwrap-setcurrent:

setCurrent
~~~~~~~~~~

:aspect:`Property`
   setCurrent

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Sets the "current"-value. This is normally set from some outside
   routine, so be careful with this. But it might be handy to do this


.. _stdwrap-lang:

lang
~~~~

:aspect:`Property`
   lang

:aspect:`Data type`
   Array of language keys / :ref:`stdWrap`

:aspect:`Description`
   This is used to define optional language specific values based on the current site language.

:aspect:`Example`
   ::

      page.10 = TEXT
      page.10.value = I am a Berliner!
      page.10.stdWrap.lang.de = Ich bin ein Berliner!

   Output will be "Ich bin..." instead of "I am..."


.. _stdwrap-data:

data
~~~~

:aspect:`Property`
   data

:aspect:`Data type`
   :ref:`data-type-gettext` / :ref:`stdWrap`


.. _stdwrap-field:

field
~~~~~

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

   ::

      .field = title

   This sets the content to the value of the field "title".

   You can also check multiple field names, if you divide them
   by "//".

:aspect:`Example`

   ::

      .field = nav_title // title

   Here the content from the field nav\_title will be returned
   unless it is a blank string. If a blank string, the value of
   the title field is returned.


.. _stdwrap-current:

current
~~~~~~~

:aspect:`Property`
   current

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Sets the content to the "current"-value (see :ref:`->split <split>`)


.. _stdwrap-cobject:

cObject
~~~~~~~

:aspect:`Property`
   cObject

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   Loads content from a content object.


.. _stdwrap-numrows:

numRows
~~~~~~~

:aspect:`Property`
   numRows

:aspect:`Data type`
   :ref:`->numRows <numrows>` / :ref:`stdWrap`

:aspect:`Description`
   Returns the number of rows resulting from the supplied SELECT query.

.. _stdwrap-preuserfunc:

preUserFunc
~~~~~~~~~~~

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


.. _stdwrap-override-conditions:

Override and conditions
=======================


.. _stdwrap-override:

override
~~~~~~~~

:aspect:`Property`
   override

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   if "override" returns something else than "" or zero (trimmed), the
   content is loaded with this!


.. _stdwrap-preifemptylistnum:

preIfEmptyListNum
~~~~~~~~~~~~~~~~~

:aspect:`Property`
   preIfEmptyListNum

:aspect:`Data type`
   (as ":ref:`stdwrap-listNum`" below)

:aspect:`Description`
   (as ":ref:`stdwrap-listNum`" below)


.. _stdwrap-ifnull:

ifNull
~~~~~~

:aspect:`Property`
   ifNull

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   If the content is null (:php:`NULL` type in PHP), the content is overridden
   with the value defined here.

:aspect:`Example`

   ::

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


.. _stdwrap-ifempty:

ifEmpty
~~~~~~~

:aspect:`Property`
   ifEmpty

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   If the trimmed content is empty at this point, the content is loaded
   with :ts:`ifEmpty`. Zeros are treated as empty values!


.. _stdwrap-ifblank:

ifBlank
~~~~~~~

:aspect:`Property`
   ifBlank

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Same as :ts:`ifEmpty` but the check is done against ''. Zeros are not
   treated as blank values!


.. _stdwrap-listnum:

listNum
~~~~~~~

:aspect:`Property`
   listNum

:aspect:`Data type`
   :ref:`data-type-integer` :ref:`+calc <objects-calc>` +"last" +"rand" / :ref:`stdWrap`

:aspect:`Description`
   Explodes the content with "," (comma) and the content is set to the
   item[*value*].

   **Special keyword:** :ts:`last`
      Is set to the last element of the array!

   **Special keyword:** :ts:`rand`
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
~~~~

:aspect:`Property`
   trim

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   If set, the PHP-function :php:`trim()` will be used to remove whitespaces
   around the value.


.. _stdwrap-strpad:

strPad
~~~~~~

:aspect:`Property`
   strPad

:aspect:`Data type`
   :ref:`strPad`

:aspect:`Description`
   Pads the current content to a certain length. You can define the padding
   characters and the side(s), on which the padding should be added.


.. _stdwrap-stdwrap:

stdWrap
~~~~~~~

:aspect:`Property`
   stdWrap

:aspect:`Data type`
   :ref:`stdWrap`

:aspect:`Description`
   Recursive call to the :ts:`stdWrap` function.


.. _stdwrap-required:

required
~~~~~~~~

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


.. _stdwrap-if:

if
~~

:aspect:`Property`
   if

:aspect:`Data type`
   :ref:`if`

:aspect:`Description`
   If the if-object returns false, stdWrap returns "" immediately.


.. _stdwrap-fieldrequired:

fieldRequired
~~~~~~~~~~~~~

:aspect:`Property`
   fieldRequired

:aspect:`Data type`
   Field name / :ref:`stdWrap`

:aspect:`Description`
   The value in this field **must** be set.


.. _stdwrap-parsedata:

Parsing data
============


.. _stdwrap-csconv:

csConv
~~~~~~

:aspect:`Property`
   csConv

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Convert the charset of the string from the charset given as value to
   the current rendering charset of the frontend (UTF-8).


.. _stdwrap-parsefunc:

parseFunc
~~~~~~~~~

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

   ::

      parseFunc = < lib.parseFunc_RTE
      parseFunc.tags.myTag = TEXT
      parseFunc.tags.myTag.value = This will be inserted when &lt;myTag&gt; is found!


.. _stdwrap-htmlparser:

HTMLparser
~~~~~~~~~~

:aspect:`Property`
   HTMLparser

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`htmlparser` / :ref:`stdWrap`

:aspect:`Description`
   This object allows you to parse the HTML-content and perform all kinds of
   advanced filtering on the content.

   Value must be set and properties are those of :ref:`htmlparser`.

   (See :ref:`t3coreapi:rte` for more information about RTE transformations)


.. _stdwrap-split:

split
~~~~~

:aspect:`Property`
   split

:aspect:`Data type`
   :ref:`split` / :ref:`stdWrap`


.. _stdwrap-replacement:

replacement
~~~~~~~~~~~

:aspect:`Property`
   replacement

:aspect:`Data type`
   :ref:`replacement` / :ref:`stdWrap`

:aspect:`Description`
   Performs an ordered search/replace on the current content with the
   possibility of using PCRE regular expressions. An array with numeric
   indices defines the order of actions and thus allows multiple
   replacements at once.


.. _stdwrap-prioricalc:

prioriCalc
~~~~~~~~~~

:aspect:`Property`
   prioriCalc

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Calculation of the value using operators -+\*/%^ plus respects
   priority to + and - operators and parenthesis levels ().

   . (period) is decimal delimiter.

   Returns a doublevalue.

   If :ts:`prioriCalc` is set to "intval" an integer is returned.

   There is no error checking and division by zero or other invalid
   values may generate strange results. Also you should use a proper syntax
   because future modifications to the function used may allow for more
   operators and features.

:aspect:`Examples`

   ::

      100%7 = 2
      -5*-4 = 20
      +6^2 = 36
      6 ^(1+1) = 36
      -5*-4+6^2-100%7 = 54
      -5 * (-4+6) ^ 2 - 100%7 = 98
      -5 * ((-4+6) ^ 2) - 100%7 = -22


.. _stdwrap-char:

char
~~~~

:aspect:`Property`
   char

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdWrap`

:aspect:`Description`
   Content is set to :php:`chr(*value*)`. This returns a one-character
   string containing the character specified by ascii code. Reliable
   results will be obtained only for character codes in the integer
   range 0 - 127. See
   `the PHP manual <http://php.net/manual/en/function.chr.php>`_:

   .. code-block:: php

      $content = chr((int)$conf['char']);


.. _stdwrap-intval:

intval
~~~~~~

:aspect:`Property`
   intval

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   PHP function :php:`intval()` returns an integer:

   .. code-block:: php

      $content = intval($content);


.. _stdwrap-hash:

hash
~~~~

:aspect:`Property`
   hash

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Returns a hashed value of the current content. Set to one of the
   algorithms which are available in PHP. For a list of supported
   algorithms see `http://www.php.net/manual/en/function.hash-algos.php
   <http://www.php.net/manual/en/function.hash-algos.php>`_ .

:aspect:`Example`

   ::

      page.10 = TEXT
      page.10 {
         value = test@example.com
         stdWrap.hash = md5
         stdWrap.wrap = <img src="http://www.gravatar.com/avatar/|" />
      }


.. _stdwrap-round:

round
~~~~~

:aspect:`Property`
   round

:aspect:`Data type`
   :ref:`round` / :ref:`stdWrap`

:aspect:`Description`
   Round the value with the selected method to the given number of
   decimals.


.. _stdwrap-numberformat:

numberFormat
~~~~~~~~~~~~

:aspect:`Property`
   numberFormat

:aspect:`Data type`
   :ref:`numberformat`

:aspect:`Description`
   Format a float value to any number format you need (e.g. useful for
   prices).


.. _stdwrap-date:

date
~~~~

:aspect:`Property`
   date

:aspect:`Data type`
   :ref:`data-type-date-conf` / :ref:`stdWrap`

:aspect:`Description`
   The content should be data-type "UNIX-time". Returns the content
   formatted as a date:

   .. code-block:: php

      $content = date($conf['date'], $content);

   Properties:

   **.GMT:** If set, the PHP function `gmdate() <http://www.php.net/gmdate>`_ will be
   used instead of `date() <http://www.php.net/date>`_.

:aspect:`Example`
   Render in human readable form::

      page.10 = TEXT
      page.10.value {
         # format like 2017-05-31 09:08
         field = tstamp
         date = Y-m-d H:i
      }


.. _stdwrap-strftime:

strftime
~~~~~~~~

:aspect:`Property`
   strftime

:aspect:`Data type`
   :ref:`data-type-strftime-conf` / :ref:`stdWrap`

:aspect:`Description`
   Exactly like "date" above. See the PHP manual (`strftime <http://www.php.net/strftime>`_) for the
   codes, or data type ":ref:`data-type-strftime-conf`".

   This formatting is useful if the locale is set in advance in the
   :ref:`CONFIG <config>` object. See there.

   Properties:

   .charset
      Can be set to the charset of the output string if you need to
      convert it to UTF-8. Default is to take the intelligently guessed
      charset from :php:`TYPO3\CMS\Core\Charset\CharsetConverter`.

   .GMT
      If set, the PHP function `gmstrftime()
      <http://www.php.net/gmstrftime>`_ will be used instead of
      `strftime() <http://www.php.net/strftime>`_.


.. _stdwrap-strtotime:

strtotime
~~~~~~~~~

:aspect:`Property`
   strtotime

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   Allows conversion of formatted dates to timestamp, e.g. to perform date calculations.

   Possible values are :ts:`1` or any time string valid as first argument of the PHP :php:`strtotime()` function.

:aspect:`Example`
   ::

      date_as_timestamp = TEXT
      date_as_timestamp {
         value = 2015-04-15
         strtotime = 1
      }

:aspect:`Example`

   ::

      next_weekday = TEXT
      next_weekday {
         data = GP:selected_date
         strtotime = + 2 weekdays
         strftime = %Y-%m-%d
      }


.. _stdwrap-age:

age
~~~

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
   four are singular. This is the default string::

      " min| hrs| days| yrs| min| hour| day| year"

   Set another string if you want to change the units. You may include
   the "-signs. They are removed anyway, but they make sure that a space
   which you might want between the number and the unit stays.

:aspect:`Example`

   ::

      lib.ageFormat = TEXT
      lib.ageFormat.stdWrap.data = page:tstamp
      lib.ageFormat.stdWrap.age = " Minuten | Stunden | Tage | Jahre | Minute | Stunde | Tag | Jahr"


.. _stdwrap-case:

case
~~~~

:aspect:`Property`
   case

:aspect:`Data type`
   :ref:`data-type-case` / :ref:`stdWrap`

:aspect:`Description`
   Converts case

   Uses "UTF-8" for the operation.


.. _stdwrap-bytes:

bytes
~~~~~

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

:aspect:`Examples`
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
~~~~~~~~~

:aspect:`Property`
   substring

:aspect:`Data type`
   [p1], [p2] / :ref:`stdWrap`

:aspect:`Description`
   Returns the substring with [p1] and [p2] sent as the 2nd and 3rd
   parameter to the PHP `mb_substr <http://www.php.net/mb_substr>`_ function.

   Uses "UTF-8" for the operation.

.. _stdwrap-crophtml:

cropHTML
~~~~~~~~

:aspect:`Property`
   cropHTML

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   Crops the content to a certain length. In contrast to :ts:`stdWrap.crop` it
   respects HTML tags. It does not crop inside tags and closes open tags.
   Entities (like ">") are counted as one char. See :ts:`stdWrap.crop` below
   for a syntax description and examples.

   Note that :ts:`stdWrap.crop` should not be used if :ts:`stdWrap.cropHTML` is
   already used.


.. _stdwrap-striphtml:

stripHtml
~~~~~~~~~

:aspect:`Property`
   stripHtml

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Strips all HTML tags.


.. _stdwrap-crop:

crop
~~~~

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

   :ts:`20 | ...` => max 20 characters. If more, the value will be truncated
   to the first 20 characters and prepended with "..."

   :ts:`-20 | ...` => max 20 characters. If more, the value will be truncated
   to the last 20 characters and appended with "..."

   :ts:`20 | ... | 1` => max 20 characters. If more, the value will be
   truncated to the first 20 characters and prepended with "...". If
   the division is in the middle of a word, the remains of that word is
   removed.

   Uses "UTF-8" for the operation.


.. _stdwrap-rawurlencode:

rawUrlEncode
~~~~~~~~~~~~

:aspect:`Property`
   rawUrlEncode

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Passes the content through the PHP function `rawurlencode() <http://www.php.net/rawurlencode>`_.


.. _stdwrap-htmlspecialchars:

htmlSpecialChars
~~~~~~~~~~~~~~~~

:aspect:`Property`
   htmlSpecialChars

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Passes the content through the PHP function `htmlspecialchars() <http://www.php.net/htmlspecialchars>`_.

   Additional property :ts:`preserveEntities` will preserve entities so only
   non-entity characters are affected.


.. _stdwrap-encodeforjavascriptvalue:

encodeForJavaScriptValue
~~~~~~~~~~~~~~~~~~~~~~~~

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

   ::

      10 = TEXT
      10.stdWrap {
            data = GP:sWord
            encodeForJavaScriptValue = 1
            wrap = setSearchWord(|);
      }


.. _stdwrap-doublebrtag:

doubleBrTag
~~~~~~~~~~~

:aspect:`Property`
   doubleBrTag

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   All double-line-breaks are substituted with this value.


.. _stdwrap-br:

br
~~

:aspect:`Property`
   br

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Pass the value through the PHP function `nl2br() <http://www.php.net/nl2br>`_. This
   converts each line break to a :html:`<br />` or a :html:`<br>` tag depending on doctype.


.. _stdwrap-brtag:

brTag
~~~~~

:aspect:`Property`
   brTag

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   All ASCII codes of "10" (line feed, LF) are substituted with the
   *value*, which has been provided in this property.


.. _stdwrap-encapslines:

encapsLines
~~~~~~~~~~~

:aspect:`Property`
   encapsLines

:aspect:`Data type`
   :ref:`encapslines` / :ref:`stdWrap`

:aspect:`Description`
   Lets you split the content by :php:`chr(10)` and process each line
   independently. Used to format content made with the RTE.


.. _stdwrap-keywords:

keywords
~~~~~~~~

:aspect:`Property`
   keywords

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Splits the content by characters "," ";" and php:`chr(10)` (return), trims
   each value and returns a comma-separated list of the values.


.. _stdwrap-innerwrap:

innerWrap
~~~~~~~~~

:aspect:`Property`
   innerWrap

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

:aspect:`Description`
   Wraps the content.


.. _stdwrap-innerwrap2:

innerWrap2
~~~~~~~~~~

:aspect:`Property`
   innerWrap2

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

:aspect:`Description`
   Same as :ts:`innerWrap` (but watch the order in which they are executed).


.. _stdwrap-addparams:

addParams
~~~~~~~~~

:aspect:`Property`
   addParams

:aspect:`Data type`
   :ref:`addparams` / :ref:`stdWrap`

:aspect:`Description`
   Lets you add tag parameters to the content *if* the content is a tag!


.. _stdwrap-filelink:

filelink
~~~~~~~~

.. warning:: 
   `addParams` is deprecated since version 9 and will be removed in version 10. 
   Use DataProcessors or Fluid Styled Content instead.

:aspect:`Property`
   filelink

:aspect:`Data type`
   :ref:`filelink` / :ref:`stdWrap`

:aspect:`Description`
   Used to make lists of links to files.


.. _stdwrap-precobject:

preCObject
~~~~~~~~~~

:aspect:`Property`
   preCObject

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cObject` prepended the content.


.. _stdwrap-postcobject:

postCObject
~~~~~~~~~~~

:aspect:`Property`
   postCObject

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cObject` appended the content.


.. _stdwrap-wrapalign:

wrapAlign
~~~~~~~~~

:aspect:`Property`
   wrapAlign

:aspect:`Data type`
   :ref:`align <data-type-align>` / :ref:`stdWrap`

:aspect:`Description`
   Wraps content with :ts:`<div style=text-align:[*value*];"> | </div>`
   *if* align is set.


.. _stdwrap-typolink:

typolink
~~~~~~~~

:aspect:`Property`
   typolink

:aspect:`Data type`
   :ref:`typolink` / :ref:`stdWrap`

:aspect:`Description`
   Wraps the content with a link-tag.

.. _stdwrap-wrap:

wrap
~~~~

:aspect:`Property`
   wrap

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
   :ts:`splitChar` defines an alternative splitting character (default is "\|"
   - the vertical line)


.. _stdwrap-notrimwrap:

noTrimWrap
~~~~~~~~~~

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

   :ts:`splitChar`

   Can be set to define an alternative special character. :ts:`stdWrap` is
   available. Default is "\|" - the vertical line. This sub-property is
   useful in cases when the default special character would be recognized
   by :ref:`objects-optionsplit` (which takes precedence over :ts:`noTrimWrap`).

:aspect:`Example`

   ::

      noTrimWrap = | val1 | val2 |

   In this example the content with the values val1 and val2 will be
   wrapped; including the whitespaces.

:aspect:`Example`

   ::

      noTrimWrap = ^ val1 ^ val2 ^ || ^ val3 ^ val4 ^
      noTrimWrap.splitChar = ^

   :ref:`objects-optionsplit` will use the "\|\|" to have two subparts in
   the first part. In each subpart :ts:`noTrimWrap` will then use the "^" as
   special character.


.. _stdwrap-wrap2:

wrap2
~~~~~

:aspect:`Property`
   wrap2

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
   same as :ref:`stdwrap-wrap` (but watch the order in which they are executed)


.. _stdwrap-datawrap:

dataWrap
~~~~~~~~

:aspect:`Property`
   dataWrap

:aspect:`Data type`
   mixed / :ref:`stdWrap`

:aspect:`Description`
   The content is parsed for pairs of curly braces. The content of the
   curly braces is of the type :ref:`data-type-gettext` and is substituted with the result
   of :ref:`data-type-gettext`.

:aspect:`Example`

   ::

      <div id="{tsfe : id}"> | </div>

   This will produce a :html:`<div>` tag around the content with an id attribute
   that contains the number of the current page.


.. _stdwrap-prepend:

prepend
~~~~~~~

:aspect:`Property`
   prepend

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cobject` prepended to content (before)


.. _stdwrap-append:

append
~~~~~~

:aspect:`Property`
   append

:aspect:`Data type`
   :ref:`data-type-cobject`

:aspect:`Description`
   :ref:`stdwrap-cobject` appended to content (after)


.. _stdwrap-wrap3:

wrap3
~~~~~

:aspect:`Property`
   wrap3

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` /+.splitChar / :ref:`stdWrap`

:aspect:`Description`
   same as :ts:`wrap` (but watch the order in which they are executed)


.. _stdwrap-orderedstdwrap:

orderedStdWrap
~~~~~~~~~~~~~~

:aspect:`Property`
   orderedStdWrap

:aspect:`Data type`
   Array of numeric keys with / :ref:`stdWrap` each

:aspect:`Description`
   Execute multiple :ts:`stdWrap` statements in a freely selectable order. The order
   is determined by the numeric order of the keys. This allows to use multiple
   stdWrap statements without having to remember the rather complex sorting
   order in which the :ts:`stdWrap` functions are executed.

:aspect:`Example`

   ::

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
   :ts:`10.innerWrap` is executed first, followed by :ts:`10.wrap`.
   Then the next key is processed which is 20. Afterwards :ts:`30.wrap`
   is executed on what already was created.

   This results in "This is a working solution."


.. _stdwrap-outerwrap:

outerWrap
~~~~~~~~~

:aspect:`Property`
   outerWrap

:aspect:`Data type`
   :ref:`wrap <data-type-wrap>` / :ref:`stdWrap`

:aspect:`Description`
   *Wraps the complete content*


.. _stdwrap-insertdata:

insertData
~~~~~~~~~~

:aspect:`Property`
   insertData

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   If set, then the content string is parsed like :ts:`dataWrap` above.

:aspect:`Example`

   Displays the page title::

      10 = TEXT
      10.value = This is the page title: {page:title}
      10.stdWrap.insertData = 1

   .. warning:
      Never use this on content that can be edited in backend. This allows editors to disclose
      normally hidden information. Never use this to insert data into wraps.
      Use :ref:`dataWrap <stdwrap-datawrap>` instead.


.. _stdwrap-postuserfunc:

postUserFunc
~~~~~~~~~~~~

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
   :ts:`postUserFunc` are provided to the function.

   The description of the :ts:`cObject` :ref:`USER <cobj-user>` contains some
   more in-depth information.

:aspect:`Example`

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

   Your methods will get the parameters :php:`$content` and :php:`$conf`
   (in that order) and need to return a string.

   .. code-block:: php

      namespace Your\NameSpace;
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
            // Use the method getTypoLink() from ContentObjectRenderer.php.
            $content = $this->cObj->getTypoLink($content, $conf['typolink']);
            }
            return $content;
         }
      }

   For :ts:`page.10` the content, which is present when :ts:`postUserFunc` is
   executed, will be given to the PHP function
   :php:`reverseString()`. The result will be "!DLROW OLLEH".

   The content of :ts:`page.20` will be processed by the function
   :php:`reverseString()` from the class :php:`YourClass`. This also returns
   the text "!DLROW OLLEH", but wrapped into a link to the page
   with the ID 11. The result will be :html:`<a href="index.php?id=11">!DLROW OLLEH</a>`.

   Note how in the second example :php:`$cObj`, the reference to the
   calling :ts:`cObject`, is utilised to use functions from
   :file:`ContentObjectRenderer.php`!


.. _stdwrap-postuserfuncint:

postUserFuncInt
~~~~~~~~~~~~~~~

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
   page-rendering. Please see the description of the :ts:`cObject`
   :ref:`USER_INT <cobj-user-int>`.

   Supplied by Jens Ellerbrock


.. _stdwrap-preficomment:
.. _stdwrap-prefixcomment:

prefixComment
~~~~~~~~~~~~~

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

   ::

      prefixComment = 2 | CONTENT ELEMENT, uid:{field:uid}/{field:CType}

   Will indent the comment with 1 tab (and the next line with 2+1 tabs)


.. _stdwrap-editicons:

editIcons
~~~~~~~~~

:aspect:`Property`
   editIcons

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdWrap`

:aspect:`Description`
   If not empty, then insert an icon linking to
   :file:`typo3/sysext/backend/Classes/Controller/EditDocumentController.php`
   with some parameters to build and backend user edit form for certain
   fields.

   The value of this property is a list of fields from a table to edit.
   It's assumed that the current record of the cObject is the record to
   be edited.

   Syntax: *optional table name* : *comma list of field names [list of
   pallette-field names separated by \| ]*

   :ts:`.beforeLastTag:`
      Possible values are 1, 0 and -1. If set (1), the icon will be inserted
      before the last HTML tag in the content. If -1, the icon will be prepended
      to the content. If zero (0), the icon is appended in the end of the
      content.

   :ts:`.styleAttribute:` String.
      Adds a style-attribute to the icon image with this value. For instance you
      can set "position:absolute" if you want a non-destructive insertion of the
      icon. Notice: For general styling all edit icons has the class
      "frontEndEditIcons" which can be addressed from the stylesheet of the
      site.

   :ts:`.iconTitle:` String.
      The title attribute of the image tag.

   :ts:`.iconImg:` HTML.
      Alternative HTML code instead of the default icon shown. Can be used to
      set another icon for editing (for instance a red dot or otherwise... :-)

:aspect:`Example`

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
~~~~~~~~~

:aspect:`Property`
   editPanel

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`cobj-editpanel`

:aspect:`Description`
   See :ts:`cObject` :ref:`cobj-editpanel`.


.. _stdwrap-cache:

cache
~~~~~

:aspect:`Property`
   cache

:aspect:`Data type`
   :ref:`cache`

:aspect:`Description`
   Caches rendered content in the caching framework.


.. _stdwrap-debug:

debug
~~~~~

:aspect:`Property`
   debug

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Prints content with :php:`HTMLSpecialChars()` and :html:`<pre></pre>`:
   Useful for debugging which value :ts:`stdWrap` actually ends up with,
   if you are constructing a website with TypoScript.

   Should be used under construction only.


.. _stdwrap-debugfunc:

debugFunc
~~~~~~~~~

:aspect:`Property`
   debugFunc

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Prints the content directly to browser with the :php:`debug()` function.

   Should be used under construction only.

   Set to value "2" the content will be printed in a table - looks nicer.


.. _stdwrap-debugdata:

debugData
~~~~~~~~~

:aspect:`Property`
   debugData

:aspect:`Data type`
   :ref:`boolean <data-type-bool>` / :ref:`stdWrap`

:aspect:`Description`
   Prints the current data-array, :php:`$cObj->data`, directly to browser. This
   is where :ts:`field` gets data from.

   Should be used under construction only.
