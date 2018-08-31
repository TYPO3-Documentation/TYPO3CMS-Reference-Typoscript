.. include:: ../Includes.txt

.. _data-types:
.. _data-types-reference:

Data types
==========

The values assigned to properties in TypoScript are often of a
specific format. These formats are described in this chapter.

For example, if a value is defined as the type :ts:`<tag>`, HTML code has to be
supplied. If it is of the type :ts:`resource`, it's a reference to a file from
the resource-field in the template. If the type is :ts:`GraphicColor`, a
color-definition is expected and an HTML color code or comma-separated
RGB-values have to be provided.

The following is a list of available data types, their usage, purpose and
examples.

.. _data-type-align:

align
-----

:aspect:`Data type:`
   align

:aspect:`Description:`
   Decides about alignment.

:aspect:`Examples:`
   :ts:`left`, :ts:`center`, :ts:`right`

:aspect:`Default:`
   :ts:`left`


.. _data-type-boolean:
.. _data-type-bool:

boolean
-------

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

.. _data-type-case:

case
----

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

.. _data-types-object-types:

Object types
------------

These are some "data types" that might be mentioned and valid values
are shown here below:

.. _data-type-cobject:

cObject
"""""""

:aspect:`Data type:`
   cObject

:aspect:`Description:`
   "cObjects" are also called "Content Objects". See the section
   ":ref:`cobjects`".

:aspect:`Examples:`
    TEXT / IMAGE / TEMPLATE ...

.. _data-type-frameobj:

frameObj
""""""""

:aspect:`Data type:`
   FRAMESET / FRAME

.. _data-type-gifbuilderobj:

Gifbuilder Object
"""""""""""""""""

:aspect:`Description:`
   See section :ref:`GIFBUILDER` in this manual.

:aspect:`Examples:`
    TEXT / SHADOW / OUTLINE / EMBOSS / BOX / IMAGE / EFFECT

.. _data-type-menuobj:

menu object
"""""""""""

:aspect:`Description:`
   See the section ":ref:`Menu Objects <menu-objects>`".

:aspect:`Examples:`
    GMENU / TMENU / IMGMENU

.. _data-type-date-conf:

date-conf
---------

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

.. _data-type-degree:

degree
------

:aspect:`Data type:`
   degree

:aspect:`Description:`
   -90 to 90, integers

:aspect:`Example:`
   45

.. _data-type-dir:

dir
---

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

.. _data-type-function-name:

function name
-------------

:aspect:`Data type:`
   function name

:aspect:`Description:`
   Indicates a function or method in a class to call. See more information at
   the :ref:`USER cObject <cobj-user>`.

   Depending on implementation the class or function name, but not the method
   name, should probably be prefixed with :php:`user_`. The prefix can be
   changed in the :php:`$GLOBALS['TYPO3_CONF_VARS']` config though. The function
   / method is normally called with 2 parameters, :php:`$conf` which is the
   TypoScript configuration and :php:`$content`, some content to be processed and
   returned.

   .. Which entry in TYPO3_CONF_VARS enables the user-prefix to be changed? This
      should be mentioned. Looks like this entry has gone and this info no
      longer valid.

   If a method in a class is called, it is checked (when using the
   :ts:`USER`/:ts:`USER_INT` objects) whether a class with the same name, but
   prefixed with :php:`ux_` is present and if so, *this* class is instantiated
   instead. See the document "Inside TYPO3" for more information on extending
   classes in TYPO3!

   .. Where is this feature mentioned? We should add a reference here.

:aspect:`Examples:`
   Method in class, namespaced and preferred version:

   .. code-block:: php

      Your\NameSpace\YourClass->reverseString

   Single Function:

   .. code-block:: php

      user_reverseString

   Method in class:

   .. code-block:: php

      user_stringReversing->reverseString

.. _data-type-gettext:

getText
-------

:aspect:`Data type:`
   getText

:aspect:`Description:`
   The getText data type is some kind of tool box allowing to retrieve
   values from a variety of sources, e.g. from GET/POST variables, from
   registers, values from the page tree, items in the page menues, from the database, etc.

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

.. _data-type-gettext-cobj:

cObj
""""

:aspect:`getText Key:`
   cObj

:aspect:`Description:`
   For :ref:`cobj-content` and :ref:`cobj-records` cObjects that are returned by
   a select query, this returns the row number (1,2,3,...) of the current
   cObject record.

   :ts:`parentRecordNumber` is the only key available.

:aspect:`Example:`

   Get the number of the current cObject record::

      foo = cObj : parentRecordNumber

.. _data-type-gettext-current:

current
"""""""

:aspect:`getText Key:`
   current

:aspect:`Description:`
   current (gets the "current" value)

   .. What is the "current" value? We should explain that.

:aspect:`Example:`
   Get the current value::

      foo = current

.. _data-type-gettext-date:

date
""""

:aspect:`getText Key:`
   date

:aspect:`Description:`
   Can be used with a colon and :ref:`data-type-date-conf`.

:aspect:`Default:`
   ::

      d/m Y

:aspect:`Example:`
   Get the current time formatted dd-mm-yy::

      foo = date : d-m-y

.. _data-type-gettext-db:

DB
""
:aspect:`getText Key:`
   DB

:aspect:`Syntax:`
   DB : [table name] : [uid] : [field]

:aspect:`Description:`
   Value from database. Any record from a table in TCA can be selected here.
   Records marked as deleted will not return any value.

   In contrast to other keys, colons are used here to get deeper into the
   structure, instead of pipes.

:aspect:`Example:`
   Get the value of the header field of record with uid 234 from table
   "tt\_content"::

      foo = DB : tt_content:234:header

.. _data-type-gettext-debug:

debug
"""""

:aspect:`getText Key:`
   debug

:aspect:`Description:`
   Returns HTML-formatted content of the PHP variable defined by the keyword.
   Available keywords are :ts:`rootLine`, :ts:`fullRootLine`, :ts:`data`,
   :ts:`register` and :ts:`page`.

:aspect:`Example:`
   Outputs the current root-line visually in HTML::

      foo = debug : rootLine

.. _data-type-gettext-field:

field
"""""

:aspect:`getText Key:`
   field

:aspect:`Syntax:`
   field : [field name from the current :php:`$cObj->data` array in the cObject, multi-dimensional.]

:aspect:`Description:`
   - As default the :php:`$cObj->data` array is :php:`$GLOBALS['TSFE']->page`
     (record of the current page)

   - In :ref:`TMENU <tmenu>` :php:`$cObj->data` is set in a loop to the page-record for
     each menu item. 

   - In :ref:`cobj-content` / :ref:`cobj-records` :php:`$cObj->data` is set to
     the actual record

   - In :ref:`GIFBUILDER <gifbuilder>` :php:`$cObj->data` is set to the data
     :ref:`GIFBUILDER <gifbuilder>` is supplied with.

:aspect:`Examples:`
   Get content from :php:`$cObj->data['header']`::

      foo = field : header

   Get content from :php:`$cObj->data['fieldname']['level1']['level2']`::

      foo = field : fieldname|level1|level2

.. _data-type-gettext-file:

file
""""

:aspect:`getText Key:`
   file

:aspect:`Syntax:`
   file : [uid] : [property]

:aspect:`Description:`
   Retrieves a property from a file object (FAL) by identifying it through its
   sys\_file UID. Note that during execution of the :ref:`cobj-files` cObject,
   it's also possible to reference the current file with "current" as UID like
   :ts:`file : current : size`.

   The following properties are available: name, uid, originalUid, size, sha1,
   extension, mimetype, contents, publicUrl, modification_date, creation_date

   Furthermore when manipulating references (such as images in content elements
   or media in pages), additional properties are available (not all are
   available all the time, it depends on the setup of *references* of the
   :ref:`cobj-files` cObject): title, description, link, alternative.

   Additionally, any data in the "sys_file_metadata" table can be accessed too.

   See the :ref:`FILES <cobj-files-examples>` cObject for usage examples.

:aspect:`Example:`

   Get the file size of the file with the sys\_file UID 17::

      foo = file : 17 : size

.. _data-type-gettext-flexform:

flexform
""""""""

:aspect:`getText Key:`
   flexform

:aspect:`Syntax:`
   flexform : [field containing flexform data].[property of this flexform]

:aspect:`Description:`
   Access values from flexforms, e.g. inside of tt_content record. In contrast
   to most parts, deeper levels are accessed through dots, not pipes.

:aspect:`Example:`
   Return the flexform value of given name::

      foo = flexform : pi_flexform:settings.categories

.. _data-type-gettext-fullrootline:

fullRootLine
""""""""""""

:aspect:`getText Key:`
   fullRootLine

:aspect:`Syntax:`
   fullRootLine : [pointer, integer], [field name], ["slide"]

:aspect:`Description:`
   This property can be used to retrieve values from "above" the current page's
   root. Take the below page tree and assume that we are on the page "Here you
   are!". Using the :ref:`data-type-gettext-levelfield` property, it is possible
   to go up only to the page "Site root", because it is the root of a new
   (sub-)site.  With :ts:`fullRootLine` it is possible to go all the way up to page
   tree root.  The numbers between square brackets indicate to which page each
   value of *pointer* would point to:

   .. code-block:: text

      - Page tree root [-2]
      |- 1. page before [-1]
         |- Site root (root template here!) [0]
         |- Here you are! [1]


   A "slide" parameter can be added just as for the
   :ref:`data-type-gettext-levelfield` property.

:aspect:`Example:`

   Get the title of the page right before the start of the current website::

      foo = fullRootLine : -1, title

.. _data-type-gettext-getenv:

getenv
""""""

:aspect:`getText Key:`
   getenv

:aspect:`Description:`
   Value from PHP environment variables.

:aspect:`Example:`
   Get the env var `HTTP_REFERER`::

      foo = getenv : HTTP_REFERER

.. _data-type-gettext-getindpenv:

getIndpEnv
""""""""""
:aspect:`getText Key:`
   getIndpEnv

:aspect:`Syntax:`
   getIndpEnv : <name>

:aspect:`Description:`
   Returns the value of a *System Environment Variable* denoted by
   *name* regardless of server OS, CGI/MODULE version etc. The result is
   identical to the :php:`$_SERVER` variable in most cases. This method should
   be used instead of *getEnv* to get reliable values for all situations. The
   internal processing is handled by
   :php:`TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv()`

   Available names:

   ===================== ============================================================================= =================
   Name                  Definition                                                                    Example or result
   ===================== ============================================================================= =================
   \_ARRAY               Return an array with all available key-value pairs for debugging purposes
   HTTP_ACCEPT_LANGUAGE  language(s) accepted by client
   HTTP_HOST             [host][:[port]]                                                               `192.168.1.4:8080`
   HTTP_REFERER          [scheme]://[host][:[port]][path]                                              `http://192.168.1.4:8080/typo3/32/temp/phpcheck/index.php/arg1/arg2/arg3/?arg1,arg2,arg3&p1=parameter1&p2[key]=value`
   HTTP_USER_AGENT       client user agent
   PATH_INFO             [path_info]                                                                   `/arg1/arg2/arg3/`
   QUERY_STRING          [query]                                                                       `arg1,arg2,arg3&p1=parameter1&p2[key]=value`
   REMOTE_ADDR           client IP
   REMOTE_HOST           client host
   REQUEST_URI           [path]?[query]                                                                `/typo3/32/temp/phpcheck/index.php/arg1/arg2/arg3/?arg1,arg2,arg3&p1=parameter1&p2[key]=value`
   SCRIPT_FILENAME       absolute filename of script
   SCRIPT_NAME           [path_script]                                                                 `/typo3/32/temp/phpcheck/[index.php]`
   TYPO3_DOCUMENT_ROOT   absolute path of root of documents
   TYPO3_HOST_ONLY       [host]                                                                        `192.168.1.4`
   TYPO3_PORT            [port]                                                                        `8080`
   TYPO3_REQUEST_DIR     [scheme]://[host][:[port]][path_dir]
   TYPO3_REQUEST_HOST    [scheme]://[host][:[port]]
   TYPO3_REQUEST_SCRIPT  [scheme]://[host][:[port]][path_script]
   TYPO3_REQUEST_URL     [scheme]://[host][:[port]][path]?[query]
   TYPO3_REV_PROXY       TRUE if this session runs over a well known proxy
   TYPO3_SITE_SCRIPT     [script / Speaking URL] of the TYPO3 website
   TYPO3_SITE_URL        [scheme]://[host][:[port]][path_dir] of the TYPO3 website frontend
   TYPO3_SSL             TRUE if this session uses SSL/TLS (https)
   ===================== ============================================================================= =================

:aspect:`Examples:`
   ::

      # get and output the client IP
      page = PAGE
      page.10 = TEXT
      page.10.stdWrap.data = getIndpEnv : REMOTE_ADDR
      page.10.stdWrap.htmlSpecialChars = 1

.. _data-type-gettext-global:

global
""""""

:aspect:`getText Key:`
   global

:aspect:`Syntax:`
   global : [variable]

:aspect:`Description:`
   Deprecated, use :ref:`data-type-gettext-gp`, :ref:`data-type-gettext-tsfe` or
   :ref:`data-type-gettext-getenv`.

.. _data-type-gettext-gp:

GP
""
:aspect:`getText Key:`
   GP

:aspect:`Syntax:`
   GP : [Value from GET or POST method]

:aspect:`Description:`
   Get an variable from :php:`$_GET` or :php:`$_POST` where a variable, which
   exists in both arrays, is returned from :php:`$_POST`.

:aspect:`Examples:`
   Get input value from query string &stuff=...::

      foo = GP : stuff

   Get input value from query string &stuff[bar]=...::

      foo = GP : stuff|bar

.. _data-type-gettext-level:

level
"""""

:aspect:`getText Key:`
   level

:aspect:`Description:`
   Get the root line level of the current page.

:aspect:`Example:`
   Get the root line level of the current page::

      foo = level

.. _data-type-gettext-levelfield:

levelfield
""""""""""

:aspect:`getText Key:`
   levelfield

:aspect:`Syntax:`
   levelfield : [pointer, integer], [field name], ["slide"]

:aspect:`Description:`
   levelfield: Like :ref:`data-type-gettext-leveltitle` et al. but where the
   second parameter is the root line field to fetch.

:aspect:`Example:`
   Get the value of the user defined field user_myExtField in the root line.
   Requires additional configuration in
   :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields']` to include
   field.::

      foo = levelfield : -1, user_myExtField, slide

.. _data-type-gettext-levelmedia:
.. _data-type-gettext-leveluid:
.. _data-type-gettext-leveltitle:

leveltitle, leveluid, levelmedia
""""""""""""""""""""""""""""""""
:aspect:`getText Key:`
   leveltitle, leveluid or levelmedia

:aspect:`Syntax:`
   leveltitle, leveluid, levelmedia: [levelTitle, uid or media in
   root line, 0- , negative = from behind, " , slide" parameter forces a
   walk to the bottom of the root line until there's a "true" value to
   return. Useful with levelmedia.]

:aspect:`Description:`
   Returns values from up or down the page tree.

:aspect:`Examples:`
   Get the title of the page on the first level of the root line::

      foo = leveltitle : 1

   Get the title of the page on the level right below the current page AND if
   that is not present, walk to the bottom of the root line until there's a
   title::

      foo = leveltitle : -2, slide

   Get the id of the root-page of the website (level zero)::

      foo = leveluid : 0

.. _data-type-gettext-lll:

LLL
"""

:aspect:`getText Key:`
   LLL

:aspect:`Description:`
   LLL: Reference to a locallang (xlf, xml or php) label.  Reference consists of
   [fileref]:[labelkey]

:aspect:`Example:`
   Get localized label for logout button::

      foo = LLL : EXT:felogin/pi1/locallang.xlf:logout

.. _data-type-gettext-page:

page
""""

:aspect:`getText Key:`
   page

:aspect:`Description:`
   page: [field in the current page record]

:aspect:`Example:`
   Get the current page title::

      foo = page : title

.. _data-type-gettext-pagelayout:

pagelayout
""""""""""
:aspect:`getText Key:`
   pagelayout

:aspect:`Description:`
   pagelayout

:aspect:`Example:`
   Get the current backend layout::

      foo = pagelayout

.. _data-type-gettext-parameters:

parameters
""""""""""

:aspect:`getText Key:`
   parameters

:aspect:`Syntax:`
   parameters: [field name from the current :php:`$cObj->parameters` array in the cObject.]

:aspect:`Description:`
   See :ref:`parsefunc`.

   .. Why is parsefunc usefull here?

:aspect:`Example:`
   Get content from :php:`$cObj->parameters['color']`::

      foo = parameters : color

.. _data-type-gettext-path:

path
""""

:aspect:`getText Key:`
   path

:aspect:`Description:`
   Path to a file, possibly placed in an extension, returns empty if the file
   does not exist.

:aspect:`Example:`
   Get path to file rsaauth.js (inside extension rsaauth) relative to siteroot::

      foo = path : EXT:rsaauth/resources/rsaauth.js

.. _data-type-gettext-register:

register
""""""""

:aspect:`getText Key:`
   register

:aspect:`Syntax`
   register: [field name from the :php:`$GLOBALS['TSFE']->register`]

:aspect:`Description:`
   See :ref:`LOAD_REGISTER <cobj-load-register>`.

:aspect:`Example:`
   Get content from :php:`$GLOBALS['TSFE']->register['color']`::

      foo = register : color

.. _data-type-gettext-session:

session
"""""""

:aspect:`getText Key:`
   session

:aspect:`Syntax:`
   session : [key]

:aspect:`Description:`
   The :ts:`key` refers to the session key used to store the value.

:aspect:`Example:`
   Get the number of items of a stored shopping cart array/object::

      foo = session : shop_cart|itemCount

.. _data-type-gettext-tsfe:

TSFE
""""

:aspect:`getText Key:`
   TSFE

:aspect:`Syntax:`
   TSFE: [value from the :php:`$GLOBALS['TSFE']` array, multi-dimensional]

:aspect:`Description:`
   Returns a value from
   :php:`TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController`.

:aspect:`Example:`
   Get the "username" field of the current FE user::

      foo = TSFE : fe_user|user|username

.. _data-type-graphiccolor:

GraphicColor
------------

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

.. _data-type-html-code:

HTML code
---------

:aspect:`Data type:`
   HTML code

:aspect:`Description:`
   Pure HTML code

:aspect:`Example:`
   ::

      <b>Some text in bold</b>

.. _data-type-html-color:

HTML-color
----------

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

.. _data-type-imageextension:

imageExtension
--------------

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

.. _data-type-imgresource:

imgResource
-----------

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

.. _data-type-integer:
.. _data-type-int:

integer
-------

:aspect:`Data type:`
   integer / int

:aspect:`Examples:`
   42, -8, -9, 0

:aspect:`Description:`
   This data type is sometimes used generally though another type would have
   been more appropriate, like :ref:`data-type-pixels`.

.. _data-type-linkwrap:

linkWrap
--------

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

.. _data-type-list:

list
----

:aspect:`Data type:`
   list

:aspect:`Description:`
   List of values, comma separated.
   Values are trimmed, leading whitespace is therefore ignored before and after
   each comma.

:aspect:`Example:`
   ::

      item,item2,item3

.. _data-type-margins:

margins
-------

:aspect:`Data type:`
   margins

:aspect:`Syntax:`
   left, top, right, bottom

:aspect:`Example:`
   This sets margin-left to 10 and margin-bottom to 5. Top and right are
   not set (zero)::

      10,0,0,5

.. _data-type-page-id:

page\_id
--------

:aspect:`Data type:`
   page\_id

:aspect:`Description:`
   A page id (integer) or :ts:`this` (=current page id).

:aspect:`Examples:`
   ::

      this

   ::

      34

.. _data-type-path:

path
----

:aspect:`Data type:`
   path

:aspect:`Description:`
   Path relative to the root directory from which we operate.

:aspect:`Example:`
   ::

      fileadmin/stuff/

.. _data-type-pixels:

pixels
------

:aspect:`Data type:`
   pixels

:aspect:`Description:`
   pixel-distance

:aspect:`Example:`
   ::

      345

.. _data-type-positive-integer:
.. _data-type-posint:
.. _data-type-intplus:

positive integer
----------------

:aspect:`Data type:`
   positive integer / posint / int+

:aspect:`Description:`
   Positive :ref:`data-type-integer`.

:aspect:`Examples:`
   42, 8, 9

.. _data-type-resource:

resource
--------

:aspect:`Data type:`
   resource

:aspect:`Description:`
   If the value contains a "/", it is expected to be a reference (absolute or
   relative) to a file in the file system. There is no support for wildcard
   characters in the name of the reference.

:aspect:`Example:`
   Reference to a file in the file system::

      fileadmin/picture.gif

.. _data-type-rotation:

rotation
--------

:aspect:`Data type:`
   rotation

:aspect:`Description:`
   :ref:`data-type-integer`, degrees from 0 - 360

:aspect:`Example:`
   180

.. _data-type-space:

space
-----

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

.. _data-type-strftime-conf:

strftime-conf
-------------

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

.. _data-type-string:
.. _data-type-str:
.. _data-type-value:

string
------

:aspect:`Data type:`
   string / str / value

:aspect:`Description:`
   Sometimes used generally though another type would have been more
   appropriate, like "align".

:aspect:`Example:`
   The quick brown fox jumps over the lazy dog.

.. _data-type-tag:

<tag>
-----

:aspect:`Data type:`
   <tag>

:aspect:`Description:`
   An HTML tag.

:aspect:`Example:`
   ::

      <body lang="de">

.. _data-type-tag-data:

<tag>-data
------------

:aspect:`Data type:`
   <tag>-data

:aspect:`Examples:`
   *<frameset>-data: row*

   *could be '150,\*'*

.. _data-type-tag-params:

<tag>-params
--------------

:aspect:`Data type:`
   <tag>-params

:aspect:`Description:`
   Parameters for a tag.

:aspect:`Example:`
   For <frameset>-params::

      border="0" framespacing="0"

.. _data-type-target:

target
------

:aspect:`Data type:`
   target

:aspect:`Examples:`
   :ts:`_top`, :ts:`_blank`, :ts:`content`

:aspect:`Description:`
   Target in an :html:`<a>`-tag.

   This is normally the same value as the name of the root-level object
   that defines the frame.

.. _data-type-unix-time:

UNIX-time
---------

:aspect:`Data type:`
   UNIX-time

:aspect:`Description:`
   Seconds since January 1st 1970.

:aspect:`Example:`
   Seconds to May 09th 2016 12:34::

      1462790096

.. _data-type-vhalign:

VHalign
-------

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

.. _data-type-wrap:

wrap
----

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

:aspect:`Example:`
   This will cause the value to be wrapped in a p-tag coloring the
   value red::

      <p style="color: red;"> | </p>

.. _data-type-xywh:

x,y,w,h
-------

:aspect:`Data type:`
   x,y,w,h

:aspect:`Description:`
   x,y is the offset from the upper left corner.

   w,h is the width and height

:aspect:`Example:`
   ::

      10,10,5,5
