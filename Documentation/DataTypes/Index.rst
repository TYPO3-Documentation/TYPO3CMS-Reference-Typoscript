.. include:: ../Includes.txt
.. index:: Simple data types
.. _data-types:
.. _data-types-reference:

=================
Simple data types
=================

The values assigned to properties in TypoScript are often of a
specific format. These formats are described in this chapter.

For example, if a value is defined as the type :ts:`<tag>`, HTML code has to be
supplied. If it is of the type :ts:`resource`, it's a reference to a file from
the resource-field in the template. If the type is :ts:`GraphicColor`, a
color-definition is expected and an HTML color code or comma-separated
RGB-values have to be provided.

The following is a list of available data types, their usage, purpose and
examples.


.. index:: Simple data types; align
.. _data-type-align:

align
=====

:aspect:`Data type:`
   align

:aspect:`Description:`
   Decides about alignment.

:aspect:`Examples:`
   :ts:`left`, :ts:`center`, :ts:`right`

:aspect:`Default:`
   :ts:`left`


.. index:: Simple data types; boolean
.. _data-type-boolean:
.. _data-type-bool:

boolean
=======

:aspect:`Data type:`
   boolean

:aspect:`Description:`
   Possible values for boolean variables are `1` and `0`
   meaning TRUE and FALSE.

   Everything else is `evaluated to one of these values by PHP`__:
   Non-empty strings (except `0` [zero]) are treated as TRUE,
   empty strings are evaluated to FALSE.

   __ http://php.net/manual/en/language.types.boolean.php

:aspect:`Examples:`
   ::

      dummy.enable = 0   # false, preferred notation
      dummy.enable = 1   # true,  preferred notation
      dummy.enable =     # false, because the value is empty


.. index:: Simple data types; case
.. _data-type-case:

case
====

:aspect:`Data type:`
   case

:aspect:`Description:`
   Do a case conversion.

:aspect:`Possible values:`
   ===================== ==========================================================
   Value                 Effect
   ===================== ==========================================================
   :ts:`upper`           Convert all letters of the string to upper case
   :ts:`lower`           Convert all letters of the string to lower case
   :ts:`capitalize`      Uppercase the first character of each word in the string
   :ts:`ucfirst`         Convert the first letter of the string to upper case
   :ts:`lcfirst`         Convert the first letter of the string to lower case
   :ts:`uppercamelcase`  Convert underscored `upper_camel_case` to `UpperCamelCase`
   :ts:`lowercamelcase`  Convert underscored `lower_camel_case` to `lowerCamelCase`
   ===================== ==========================================================

:aspect:`Example:`
   Code::

      10 = TEXT
      10.value = Hello world!
      10.case = upper

   Result::

      HELLO WORLD!


.. index:: Simple data types; date-conf
.. _data-type-date-conf:

date-conf
=========

:aspect:`Data type:`
   date-conf

:aspect:`Description:`
   Used to format a date, see PHP function :php:`date()`.
   The following abbreviations are available:

   === ===========================================================
   Abb The abbreviation is expanded to:
   === ===========================================================
   a   "am" or "pm"
   A   "AM" or "PM"
   d   01 - 31, day of the month, numeric, 2 digits with leading zeros
   D   day of the week, textual, 3 letters like "Fri"
   F   month, textual, long, like "January"
   h   hour, numeric, 12 hour format
   H   hour, numeric, 24 hour format
   i   minutes, numeric
   j   1 - 31, day of the month, numeric, without leading zeros
   l   (lowercase 'L'), day of the week, textual, long, like "Friday"
   m   month, numeric
   M   month, textual, 3 letters, like "Jan"
   s   seconds, numeric
   S   English ordinal suffix, textual, 2 characters, like "th" or "nd"
   U   seconds since the epoch
   Y   year, numeric, 4 digits, like "2013"
   w   day of the week, numeric, 0 represents Sunday
   y   year, numeric, 2 digits, like "13"
   z   day of the year, numeric, like "299"
   === ===========================================================

:aspect:`Example:`
   ::

      d-m-y


.. index:: Simple data types; degree
.. _data-type-degree:

degree
======

:aspect:`Data type:`
   degree

:aspect:`Description:`
   -90 to 90, integers

:aspect:`Example:`
   45

.. _data-type-dir:


.. index:: Simple data types; dir

dir
===

:aspect:`Data type:`
   dir

:aspect:`Syntax:`
   [path relative to the web root of the site] \| [list of valid
   extensions] \| [sorting: name, size, ext, date] \| [reverse: "r"] \|
   [return full path: boolean]

:aspect:`Description:`
   Files matching are returned in a comma-separated string.

:aspect:`Example:`
   This example returns a list of all pdf, gif and jpg-files from
   :file:`fileadmin/files/` sorted by their name reversely and with the full path (with
   :file:`fileadmin/files/` prepended)::

      fileadmin/files/ | pdf,gif,jpg | name | r | true


.. index:: Simple data types; function name
.. _data-type-function-name:

function name
=============

:aspect:`Data type:`
   function name

:aspect:`Description:`
   Indicates a function or method in a class to call. See more information at
   the :ref:`USER cObject <cobj-user>`.

   If no namespaces are used, then the class or function name, but not the method
   name, should probably be prefixed with :php:`user_`. The prefix can be
   changed in the :php:`$GLOBALS['TYPO3_CONF_VARS']` config though. The function
   / method is normally called with 2 parameters, :php:`$conf` which is the
   TypoScript configuration and :php:`$content`, some content to be processed and
   returned.

   .. Which entry in TYPO3_CONF_VARS enables the user-prefix to be changed? This
      should be mentioned. Looks like this entry has gone and this info no
      longer valid.

   If no namespaces are used and if a method in a class is called, it is checked (when using the
   :ts:`USER`/:ts:`USER_INT` objects) whether a class with the same name, but
   prefixed with :php:`ux_` is present and if so, *this* class is instantiated
   instead. See the document "Inside TYPO3" for more information on extending
   classes in TYPO3!

   .. Where is this feature mentioned? We should add a reference here.

:aspect:`Examples:`
   Method in namespaced class. This is the preferred version:

   .. code-block:: php

      Your\NameSpace\YourClass->reverseString

   Single Function:

   .. code-block:: php

      user_reverseString

   Method in class without namespace:

   .. code-block:: php

      user_yourClass->reverseString


.. index:: Simple data types; getText
.. _data-type-gettext:

getText
=======

:aspect:`Data type:`
   getText

:aspect:`Description:`
   The getText data type is some kind of tool box allowing to retrieve
   values from a variety of sources, e.g. from GET/POST variables, from
   registers, values from the page tree, items in the page menus, records from any database table, etc.

   The general syntax is as follows::

      key : code

   where :ts:`key` indicates the source and :ts:`code` is some form of path or
   pointer to the value, which depends on the key used. The various keys and
   their possible codes are described below.

   The :ts:`code` can contain pipe characters :ts:`|` to separate keys
   in a multi-dimensional array. This e.g. works with :ts:`TSFE`::

      foo = TSFE : fe_user|user|username

   Some codes work with different separator, which is documented right at the
   code.
   Spaces around the colon (:ts:`:`) are irrelevant. The :ts:`key` is
   case-insensitive.

   By separating the value of getText with :ts:`//` (double slash) a number of
   codes can be supplied and getText will return the first one, which is not
   empty ("" or zero).

   To get the content of the field "header". If "header is empty, "title" is
   retrieved. If "title" is empty as well, it finally gets the field "uid"::

      foo = field : header // field : title // field : uid



.. index:: Simple data types; GraphicColor
.. include:: Properties/GetText.rst.txt

.. _data-type-graphiccolor:

GraphicColor
============

:aspect:`Data type:`
   GraphicColor

:aspect:`Syntax:`
   [colordef] : [modifier]

   Where modifier can be an integer which is added or subtracted to the three
   RGB-channels or a floating point with an :ts:`*` before, which will then
   multiply the values with that factor.

:aspect:`Description:`
   The color can be given as HTML-color or as a comma-separated list of
   RGB-values (integers). An extra parameter can be given, that will modify the
   color mathematically:

:aspect:`Examples:`
   red *(HTML-color)*

   #ffeecc *(HTML-color)*

   255,0,255 *(RGB-integers)*

   *Extra:*

   red *: \*0.8 ("red" is darkened by factor 0.8)*

   #ffeecc *: +16 ("ffeecc" is going to #fffedc because 16 is added)*


.. index:: Simple data types; HTML code
.. _data-type-html-code:

HTML code
=========

:aspect:`Data type:`
   HTML code

:aspect:`Description:`
   Pure HTML code

:aspect:`Example:`
   ::

      <b>Some text in bold</b>


.. index:: Simple data types; HTML-color
.. _data-type-html-color:

HTML-color
==========

:aspect:`Data type:`
   HTML-color

:aspect:`Description:`
   Named colors or color codes.

   Some HTML color codes are:

   =============  ================
   Color name     Hexadecimal code
   =============  ================
   Black             #000000
   Silver            #C0C0C0
   Gray              #808080
   White             #FFFFFF
   Maroon            #800000
   Red               #FF0000
   Purple            #800080
   Fuchsia           #FF00FF
   Green             #008000
   Lime              #00FF00
   Olive             #808000
   Yellow            #FFFF00
   Navy              #000080
   Blue              #0000FF
   Teal              #008080
   Aqua              #00FFFF
   =============  ================

:aspect:`Examples:`
   red

   #ffeecc


.. index:: Simple data types; imageExtension
.. _data-type-imageextension:

imageExtension
==============

:aspect:`Data type:`
   imageExtension

:aspect:`Description:`
   Image extensions can be anything among the allowed types defined in the
   global variable :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']`.
   Standard is pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

   The value **"web"** is special. This will just ensure that an image is
   converted to a web image format (gif or jpg) if it happens not to be already!

:aspect:`Examples:`
   jpg

   web *(gif or jpg ..)*


.. index:: Simple data types; imgResource
.. _data-type-imgresource:

imgResource
===========

:aspect:`Data type:`
   imgResource

:aspect:`Description:`
   #. A :ref:`data-type-resource` plus imgResource properties.

      Filetypes can be anything among the allowed types defined in the
      configuration variable
      :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']`.  Standard is
      pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

   #. A GIFBUILDER object. See the object reference for :ref:`gifbuilder` below.

:aspect:`Examples:`
   Here "file" is an imgResource::

      10 = IMAGE
      10 {
          file = fileadmin/toplogo.gif
          file.width = 200
      }

   GIFBUILDER::

      10 = IMAGE
      10.file = GIFBUILDER
      10.file {
          # GIFBUILDER properties here...
      }


.. index:: Simple data types; integer
.. _data-type-integer:
.. _data-type-int:

integer
=======

:aspect:`Data type:`
   integer / int

:aspect:`Examples:`
   42, -8, -9, 0

:aspect:`Description:`
   This data type is sometimes used generally though another type would have
   been more appropriate, like :ref:`data-type-pixels`.


.. index:: Simple data types; linkWrap
.. _data-type-linkwrap:

linkWrap
========

:aspect:`Data type:`
   linkWrap

:aspect:`Syntax:`
   <.. {x}.> \| </...>

:aspect:`Description:`
   {x}; x is an integer (0-9) and points to a key in the PHP array
   root line. The key is equal to the level the current page is on
   measured relatively to the root of the website.

   If the key exists the uid of the level that key pointed to is inserted
   instead of {x}.

   Thus we can insert page\_ids from previous levels.

:aspect:`Example:`
   This will make a link to the root-level of a website::

      <a href="?id={0}"> | </a>


.. index:: Simple data types; list
.. _data-type-list:

list
====

:aspect:`Data type:`
   list

:aspect:`Description:`
   List of values, comma separated.
   Values are trimmed, leading whitespace is therefore ignored before and after
   each comma.

:aspect:`Example:`
   ::

      item,item2,item3


.. index:: Simple data types; margins
.. _data-type-margins:

margins
=======

:aspect:`Data type:`
   margins

:aspect:`Syntax:`
   left, top, right, bottom

:aspect:`Example:`
   This sets margin-left to 10 and margin-bottom to 5. Top and right are
   not set (zero)::

      10,0,0,5


.. index:: Simple data types; page_id
.. _data-type-page-id:

page\_id
========

:aspect:`Data type:`
   page\_id

:aspect:`Description:`
   A page id (integer) or :ts:`this` (=current page id).

:aspect:`Examples:`
   ::

      this

   ::

      34


.. index:: Simple data types; path
.. _data-type-path:

path
====

:aspect:`Data type:`
   path

:aspect:`Description:`
   Path relative to the root directory from which we operate.

:aspect:`Example:`
   ::

      fileadmin/stuff/


.. index:: Simple data types; pixels
.. _data-type-pixels:

pixels
======

:aspect:`Data type:`
   pixels

:aspect:`Description:`
   pixel-distance

:aspect:`Example:`
   ::

      345


.. index::
   Simple data types; positive integer
   Simple data types; int+
.. _data-type-positive-integer:
.. _data-type-posint:
.. _data-type-intplus:

positive integer
================

:aspect:`Data type:`
   positive integer / posint / int+

:aspect:`Description:`
   Positive :ref:`data-type-integer`.

:aspect:`Examples:`
   42, 8, 9


.. index:: Simple data types; resource
.. _data-type-resource:

resource
========

:aspect:`Data type:`
   resource

:aspect:`Description:`
   If the value contains a "/", it is expected to be a reference (absolute or
   relative) to a file in the file system. There is no support for wildcard
   characters in the name of the reference.

:aspect:`Example:`
   Reference to a file in the file system::

      fileadmin/picture.gif


.. index:: Simple data types; rotation
.. _data-type-rotation:

rotation
========

:aspect:`Data type:`
   rotation

:aspect:`Description:`
   :ref:`data-type-integer`, degrees from 0 - 360

:aspect:`Example:`
   180


.. index:: Simple data types; space
.. _data-types-space:

space
=====

:aspect:`Data type:`
   space

:aspect:`Syntax:`
   "space before \| space after"

:aspect:`Description:`
   Used for content and sets the according number of pixels space
   "before \| after".

:aspect:`Example:`
   ::

      5 | 5


.. index:: Simple data types; strftime-conf
.. _data-type-strftime-conf:

strftime-conf
=============

:aspect:`Data type:`
   strftime-conf

:aspect:`Description:`
   ==== ==========================================================
   Abb  The abbreviation is expanded to:
   ==== ==========================================================
   %a   abbreviated weekday name according to the current locale
   %A   full weekday name according to the current locale
   %b   abbreviated month name according to the current locale
   %B   full month name according to the current locale
   %c   preferred date and time representation for the current locale
   %C   century number (the year divided by 100 and truncated to an integer, range 00 to 99)
   %d   day of the month as a decimal number (range 00 to 31)
   %D   same as %m/%d/%y
   %e   day of the month as a decimal number, a single digit is preceded by a space (range ' 1' to '31'). Note that the %e modifier is not supported in the Windows implementation of 'strftime'.
   %h   same as %b
   %H   hour as a decimal number using a 24-hour clock (range 00 to 23)
   %I   hour as a decimal number using a 12-hour clock (range 01 to 12)
   %j   day of the year as a decimal number (range 001 to 366)
   %m   month as a decimal number (range 01 to 12)
   %M   minute as a decimal number
   %n   newline character
   %p   either \`am' or \`pm' according to the given time value, or the corresponding strings for the current locale
   %r   time in a.m. and p.m. notation
   %R   time in 24 hour notation
   %S   second as a decimal number
   %t   tab character
   %T   current time, equal to %H:%M:%S
   %u   weekday as a decimal number [1,7], with 1 representing Monday
   %U   week number of the current year as a decimal number, starting with the first Sunday as the first day of the first week
   %V   The ISO 8601:1988 week number of the current year as a decimal number, range 01 to 53, where week 1 is the first week that has at least 4 days in the current year, and with Monday as the first day of the week.
   %W   week number of the current year as a decimal number, starting with the first Monday as the first day of the first week
   %w   day of the week as a decimal, Sunday being 0
   %x   preferred date representation for the current locale without the time
   %X   preferred time representation for the current locale without the date
   %y   year as a decimal number without a century (range 00 to 99)
   %Y   year as a decimal number including the century
   %Z   time zone or name or abbreviation
   %%   a literal \`%' character
   ==== ==========================================================

:aspect:`Examples:`
   Date "DD-MM-YY" = ::

      %e:%m:%y

   Time "HH:MM:SS" = ::

      %H:%M:%S

   or just ::

      %T


.. index:: Simple data types; string
.. _data-type-string:
.. _data-type-str:
.. _data-type-value:

string
======

:aspect:`Data type:`
   string / str / value

:aspect:`Description:`
   Sometimes used generally though another type would have been more
   appropriate, like "align".

:aspect:`Example:`
   The quick brown fox jumps over the lazy dog.


.. index:: Simple data types; tag
.. _data-type-tag:

<tag>
=====

:aspect:`Data type:`
   <tag>

:aspect:`Description:`
   An HTML tag.

:aspect:`Example:`
   ::

      <body lang="de">


.. index:: Simple data types; tag-data
.. _data-type-tag-data:

<tag>-data
============

:aspect:`Data type:`
   <tag>-data

:aspect:`Examples:`
   *<frameset>-data: row*

   *could be '150,\*'*


.. index:: Simple data types; tag-params
.. _data-type-tag-params:

<tag>-params
==============

:aspect:`Data type:`
   <tag>-params

:aspect:`Description:`
   Parameters for a tag.

:aspect:`Example:`
   For <frameset>-params::

      border="0" framespacing="0"


.. index:: Simple data types; target
.. _data-type-target:

target
======

:aspect:`Data type:`
   target

:aspect:`Examples:`
   :ts:`_top`, :ts:`_blank`, :ts:`content`

:aspect:`Description:`
   Target in an :html:`<a>`-tag.

   This is normally the same value as the name of the root-level object
   that defines the frame.


.. index:: Simple data types; UNIX-time
.. _data-type-unix-time:

UNIX-time
=========

:aspect:`Data type:`
   UNIX-time

:aspect:`Description:`
   Seconds since January 1st 1970.

:aspect:`Example:`
   Seconds to May 09th 2016 12:34::

      1462790096


.. index:: Simple data types; VHalign
.. _data-type-vhalign:

VHalign
=======

:aspect:`Data type:`
   VHalign

:aspect:`Description:`
   Pair of values separated by a comma. The first value determines the
   horizontal alignment, the second one the vertical alignment.

   Possible values:

   - r/c/l

   - t/c/b

   Horizontal values standing for: right, center, left

   Vertical values standing for: top, center, bottom

:aspect:`Default:`
   ::

      l , t

:aspect:`Example:`
   Horizontal alignment = right and Vertical alignment = center::

      r , c


.. index:: Simple data types; wrap
.. _data-type-wrap:

wrap
====

:aspect:`Data type:`
   wrap

:aspect:`Syntax:`
   <...> \| </...>

:aspect:`Description:`
   Used to wrap something. The vertical bar ("|") is the place, where
   your content will be inserted; the parts on the left and right of the
   vertical line are placed on the left and right side of the content.

   Spaces between the wrap-parts and the divider ("|") are trimmed off
   from each part of the wrap.

   If you want to use more sophisticated data functions, then you
   should use `stdWrap.dataWrap` instead of `wrap`.

   A `wrap` is processed and rendered as the last of the other components of
   a cObject.

:aspect:`Example:`
   This will cause the value to be wrapped in a p-tag coloring the
   value red::

      <p style="color: red;"> | </p>


.. index:: Simple data types; x,y,w,h
.. _data-type-xywh:

x,y,w,h
=======

:aspect:`Data type:`
   x,y,w,h

:aspect:`Description:`
   x,y is the offset from the upper left corner.

   w,h is the width and height

:aspect:`Example:`
   ::

      10,10,5,5
