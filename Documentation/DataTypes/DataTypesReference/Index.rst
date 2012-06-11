

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


Data types reference
^^^^^^^^^^^^^^^^^^^^


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Data type
         Data type:
   
   Examples
         Examples:
   
   Comment
         Comment:
   
   Default
         Default:


.. container:: table-row

   Data type
         <tag>
   
   Examples
         ::
         
            <BODY bgcolor="red">
   
   Comment
   
   
   Default


.. container:: table-row

   Data type
         align
   
   Examples
         right
   
   Comment
         **right / left / center**
         
         Decides alignment, typically in HTML-tags
   
   Default
         left


.. container:: table-row

   Data type
         VHalign
   
   Examples
         Horizontal alignment = right and Vertical alignment = center:
         
         r , c
   
   Comment
         Pair of values separated by a comma. The first value determines the
         horizontal alignment, the second one the vertical alignment.
         
         **Possible values:**
         
         **r/c/l , t/c/b**
         
         Horizontal values standing for: right, center, left
         
         Vertical values standing for: top, center, bottom
   
   Default
         l , t


.. container:: table-row

   Data type
         resource
   
   Examples
         *From the resourcefield:*
         
         ::
         
            toplogo*.gif
         
         *Reference to filesystem:*
         
         ::
         
            fileadmin/picture.gif
   
   Comment
         #. A reference to a file from the resource-field in the template.You can
            write the exact filename or you can include an asterisk (\*) as
            wildcard.It's recommended to include a "\*" before the file extension
            (see example to the left). This will ensure that the file is still
            referenced correct even if the template is copied and the file will
            have it's name prepended with numbers!!
         
         #. If the value contains a "/" it's expected to be a reference (absolute
            or relative) to a file on the file-system instead of the resource-
            field. No support for wildcards.
   
   Default


.. container:: table-row

   Data type
         imgResource
   
   Examples
         Here "file" is an imgResource:
         
         ::
         
            file = toplogo*.gif
            file.width = 200
         
         GIFBUILDER:
         
         ::
         
            file = GIFBUILDER
            file {
               ... (GIFBUILDER-properties here)
            }
   
   Comment
         #. A "resource" (see above) + imgResource-properties (see example to the
            left and object-reference below)Filetypes can be anything among the
            allowed types defined in the configuration
            variable$TYPO3\_CONF\_VARS['GFX']['imagefile\_ext']. Standard is pdf,
            gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.
         
         #. GIFBUILDER-object
   
   Default


.. container:: table-row

   Data type
         HTML-code
   
   Examples
         ::
         
            <b>Some text in bold</b>
   
   Comment
         pure HTML-code
   
   Default


.. container:: table-row

   Data type
         target
   
   Examples
         \_top
         
         \_blank
         
         content
   
   Comment
         target in <A>-tag.
         
         This is normally the same value as the name of the root-level object
         that defines the frame.
   
   Default


.. container:: table-row

   Data type
         imageExtension
   
   Examples
         jpg
         
         web  *(gif or jpg ..)*
   
   Comment
         Image extensions can be anything among the allowed types defined in
         the global variable $TYPO3\_CONF\_VARS['GFX']['imagefile\_ext'].
         Standard is pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.
         
         The value **"web"** is special. This will just ensure that an image is
         converted to a web image format (gif or jpg) if it happens not to be
         already!
   
   Default


.. container:: table-row

   Data type
         degree
   
   Examples
   
   
   Comment
         -90 to 90, integers
   
   Default


.. container:: table-row

   Data type
         posint / int+
   
   Examples
   
   
   Comment
         Positive integer
   
   Default


.. container:: table-row

   Data type
         int
   
   Examples
   
   
   Comment
         integer
         
         (sometimes used generally though another type would have been more
         appropriate, like "pixels")
   
   Default


.. container:: table-row

   Data type
         str / string / value
   
   Examples
   
   
   Comment
         string.
         
         (sometimes used generally though another type would have been more
         appropriate, like "align")
   
   Default


.. container:: table-row

   Data type
         boolean
   
   Examples
         1
   
   Comment
         boolean
         
         non-empty strings (but not zero) are "true"
   
   Default


.. container:: table-row

   Data type
         rotation
   
   Examples
   
   
   Comment
         integer, degrees from 0 - 360
   
   Default


.. container:: table-row

   Data type
         x,y,w,h
   
   Examples
         10,10,5,5
   
   Comment
         x,y is the offset from the upper left corner.
         
         w,h is the width and height
   
   Default


.. container:: table-row

   Data type
         HTML-color
   
   Examples
         red
         
         #ffeecc
   
   Comment
         HTML-color codes:
         
         Black = "#000000"
         
         Silver = "#C0C0C0"
         
         Gray = "#808080"
         
         White = "#FFFFFF"
         
         Maroon = "#800000"
         
         Red = "#FF0000"
         
         Purple = "#800080"
         
         Fuchsia = "#FF00FF"
         
         Green = "#008000"
         
         Lime = "#00FF00"
         
         Olive = "#808000"
         
         Yellow = "#FFFF00"
         
         Navy = "#000080"
         
         Blue = "#0000FF"
         
         Teal = "#008080"
         
         Aqua = "#00FFFF"
   
   Default


.. container:: table-row

   Data type
         GraphicColor
   
   Examples
         red  *(HTML-color)*
         
         #ffeecc  *(HTML-color)*
         
         255,0,255  *(RGB-integers)*
         
         *Extra:*
         
         red  *: \*0.8*  *("red" is darkened by factor 0.8)*
         
         #ffeecc  *: +16*  *("ffeecc" is going to #fffedc because 16 is added)*
   
   Comment
         The color can be given as HTML-colors or as a comma-separated list of
         RGB-values (integers)
         
         You can add an extra parameter that will modify the color
         mathematically:
         
         Syntax:
         
         [colordef] : [modifier]
         
         where modifier can be and integer which is added/subtracted to the
         three RGB-channels or a floating point with an "\*" before, which will
         then multiply the values with that factor.
   
   Default


.. container:: table-row

   Data type
         page\_id
   
   Examples
         this
         
         34
   
   Comment
         A page id (int) or "this" (=current page id)
   
   Default


.. container:: table-row

   Data type
         pixels
   
   Examples
         345
   
   Comment
         pixel-distance
   
   Default


.. container:: table-row

   Data type
         list
   
   Examples
         item,item2,item3
   
   Comment
         list of values
   
   Default


.. container:: table-row

   Data type
         margins
   
   Examples
         *This sets leftmargin to 10 and bottom-margin to 5. Top and right is
         not set (zero)*
         
         10,0,0,5
   
   Comment
         l,t,r,b
         
         left, top, right, bottom
   
   Default


.. container:: table-row

   Data type
         wrap
   
   Examples
         *This will cause the value to be wrapped in a font-tag coloring the
         value red:*
         
         ::
         
            <font color="red"> | </font>
   
   Comment
         <...> \| </...>
         
         Used to wrap something. The part on the left and right of the vertical
         line is placed on the left and right side of the value.
   
   Default


.. container:: table-row

   Data type
         linkWrap
   
   Examples
         *This will make a link to the root-level of a website:*
         
         ::
         
            <a href="?id={0}"> | </a>
   
   Comment
         <.. {x}.> \| </...>
         
         {x}; x is an integer (0-9) and points to a key in the PHP-array
         rootLine. The key is equal to the level the current page is on
         measured relatively to the root of the website.
         
         If the key exists the uid of the level that key pointed to is inserted
         instead of {x}.
         
         Thus we can insert page\_ids from previous levels.
   
   Default


.. container:: table-row

   Data type
         case
   
   Examples
         upper
   
   Comment
         Case-conversion.
         
         Possible keywords:
         
         **upper** : Convert all letters of the string to uppercase.
         
         **lower** : Convert all letters of the string to lowercase.
         
         **capitalize** : (Since TYPO3 4.6) Uppercase the first character of
         each word in the string.
         
         **ucfirst** : (Since TYPO3 4.6) Convert the first letter of the string
         to uppercase.
         
         **lcfirst** : (Since TYPO3 4.6) Convert the first letter of the string
         to lowercase.
   
   Default


.. container:: table-row

   Data type
         space
   
   Examples
         5 \| 5
   
   Comment
         "before \| after"
         
         Used for content and sets space "before \| after".
   
   Default


.. container:: table-row

   Data type
         date-conf
   
   Examples
         d-m-y  *(dd-mm-yy format)*
   
   Comment
         See PHP function Date()!
         
         a - "am" or "pm"
         
         A - "AM" or "PM"
         
         d - day of the month, numeric, 2 digits (with leading zeros)
         
         D - day of the week, textual, 3 letters; e.g. "Fri"
         
         F - month, textual, long; e.g. "January"
         
         h - hour, numeric, 12 hour format
         
         H - hour, numeric, 24 hour format
         
         i - minutes, numeric
         
         j - day of the month, numeric, without leading zeros
         
         l (lowercase 'L') - day of the week, textual, long; i.e. "Friday"
         
         m - month, numeric
         
         M - month, textual, 3 letters; e.g. "Jan"
         
         s - seconds, numeric
         
         S - English ordinal suffix, textual, 2 characters; i.e. "th", "nd"
         
         U - seconds since the epoch
         
         Y - year, numeric, 4 digits
         
         w - day of the week, numeric, 0 represents Sunday
         
         y - year, numeric, 2 digits
         
         z - day of the year, numeric; e.g. "299"
   
   Default


.. container:: table-row

   Data type
         strftime-conf
   
   Examples
         Date "DD-MM-YY" =
         
         ::
         
            %e:%m:%y
         
         Time "HH:MM:SS" =
         
         ::
         
            %H:%M:%S
         
         or just
         
         ::
         
            %T
   
   Comment
         %a - abbreviated weekday name according to the current locale
         
         %A - full weekday name according to the current locale
         
         %b - abbreviated month name according to the current locale
         
         %B - full month name according to the current locale
         
         %c - preferred date and time representation for the current locale
         
         %C - century number (the year divided by 100 and truncated to an
         integer, range 00 to 99)
         
         %d - day of the month as a decimal number (range 00 to 31)
         
         %D - same as %m/%d/%y
         
         %e - day of the month as a decimal number, a single digit is preceded
         by a space (range ' 1' to '31')
         
         %h - same as %b
         
         %H - hour as a decimal number using a 24-hour clock (range 00 to 23)
         
         %I - hour as a decimal number using a 12-hour clock (range 01 to 12)
         
         %j - day of the year as a decimal number (range 001 to 366)
         
         %m - month as a decimal number (range 01 to 12)
         
         %M - minute as a decimal number
         
         %n - newline character
         
         %p - either \`am' or \`pm' according to the given time value, or the
         corresponding strings for the current locale
         
         %r - time in a.m. and p.m. notation
         
         %R - time in 24 hour notation
         
         %S - second as a decimal number
         
         %t - tab character
         
         %T - current time, equal to %H:%M:%S
         
         %u - weekday as a decimal number [1,7], with 1 representing Monday
         
         %U - week number of the current year as a decimal number, starting
         with the first Sunday as the first day of the first week
         
         %V - The ISO 8601:1988 week number of the current year as a decimal
         number, range 01 to 53, where week 1 is the first week that has at
         least 4 days in the current year, and with Monday as the first day of
         the week.
         
         %W - week number of the current year as a decimal number, starting
         with the first Monday as the first day of the first week
         
         %w - day of the week as a decimal, Sunday being 0
         
         %x - preferred date representation for the current locale without the
         time
         
         %X - preferred time representation for the current locale without the
         date
         
         %y - year as a decimal number without a century (range 00 to 99)
         
         %Y - year as a decimal number including the century
         
         %Z - time zone or name or abbreviation
         
         %% - a literal \`%' character
   
   Default


.. container:: table-row

   Data type
         UNIX-time
   
   Examples
         *Seconds to 07/04 2000 23:58:*
         
         955144722
   
   Comment
         Seconds since 1/1 1970...
   
   Default


.. container:: table-row

   Data type
         path
   
   Examples
         *fileadmin/stuff/*
   
   Comment
         path relative to the directory from which we operate.
   
   Default


.. container:: table-row

   Data type
         < *tag* >-data
   
   Examples
         *<frameset>-data: row*
         
         *could be '150,\*'*
   
   Comment
   
   
   Default


.. container:: table-row

   Data type
         < *tag* >-params
   
   Examples
         *<frameset>-params*
         
         *could be 'border="0" framespacing="0"'*
   
   Comment
   
   
   Default


.. container:: table-row

   Data type
         getText
   
   Examples
         **= field : header**
         
         *get content from the $cObj->data-array[ **header** ]*
         
         **= parameters : color**
         
         *get content from the $cObj->parameters-array[ **color** ]*
         
         **= register : color**
         
         *get content from the $GLOBALS['TSFE']->register[ **color** ]*
         
         **= leveltitle : 1**
         
         *get the title of the page on the first level of the rootline*
         
         **= leveltitle : -2 , slide**
         
         *get the title of the page on the level right below the current page
         AND if that is not present, walt to the bottom of the rootline until
         there's a title*
         
         **= leveluid : 0**
         
         *get the id of the root-page of the website (level zero)*
         
         **= levelfield : -1 , user\_myExtField , slide**
         
         *get the value of the user defined field "user\_myExtField" in the
         root line (requires additional configuration in $TYPO3\_CONF\_VARS to
         include field!)*
         
         **= global : HTTP\_COOKIE\_VARS \| some\_cookie**
         
         *get the env variable $HTTP\_COOKIE\_VARS[some\_cookie]*
         
         **= date : d-m-y**
         
         *get the current time formatted dd-mm-yy*
         
         **= page : title**
         
         *get the current page-title*
         
         **= current : 1**
         
         *get the current value*
         
         **= level : 1**
         
         *get the rootline level of the current page*
         
         **= GP : stuff**
         
         *get input value from query string, (&stuff=)*
         
         **= GP : stuff \| key**
         
         *get input value from query string, (&stuff[key]=)*
         
         **= getenv : HTTP\_REFERER**
         
         *get the env var HTTP\_REFERER*
         
         **= getIndpEnv : REMOTE\_ADDR**
         
         *get the client IP*
         
         **= DB : tt\_content:234:header**
         
         *get the value of the header of record with uid 234 from table
         tt\_content*
         
         **= fullRootLine : -1, title**
         
         *get the title of the page right before the start of the current
         website*
         
         **= LLL:EXT:css\_styled\_content/pi1/locallang.x:login.logout**
         
         *get localized label for logout button*
         
         **= path:EXT:ie7/js/ie7-standard.js**
         
         *get path to file relative to siteroot possibly placed in an
         extension*
         
         **= cObj : parentRecordNumber**
         
         *get the number of the current cObject record*
         
         **= debug : rootLine**
         
         *output the current root-line visually in HTML*
   
   Comment
         This returns a value from somewhere in a PHP-array, as defined by the
         type. The syntax is "type : pointer". The type is case-insensitive.
         
         **field:** [field name from the current  *$cObj* ->data-array in the
         cObj.]
         
         As default the  *$cObj* ->data-array is $GLOBALS['TSFE']->page (record
         of the current page!)
         
         In TMENU:  *$cObj* ->data is set to the page-record for each menu
         item.
         
         In CONTENT/RECORDS  *$cObj* ->data is set to the actual record
         
         In GIFBUILDER  *$cObj* ->data is set to the data GIFBUILDER is
         supplied with.
         
         **parameters:** [field name from the current  *$cObj* ->parameters-
         array in the cObj.]
         
         See ->parseFunc!
         
         **register:** [field name from the $GLOBALS['TSFE']->register]
         
         See cObject "LOAD\_REGISTER"
         
         **leveltitle, leveluid, levelmedia:** [levelTitle, uid or media in
         rootLine, 0- , negative = from behind, " , slide" parameter forces a
         walk to the bottom of the rootline until there's a "true" value to
         return. Useful with levelmedia.]
         
         **levelfield:** Like "leveltitle" et al. but where the second
         parameter is the rootLine field you want to fetch. Syntax: [pointer,
         integer], [field name], ["slide"]
         
         **global:** [GLOBAL-var, split with \| if you want to get from an
         array! DEPRECATED, use GP, TSFE or getenv]
         
         **date:** [date-conf]
         
         **page:** [current page record]
         
         **current: 1** (gets 'current' value)
         
         **level: 1** (gets the rootline level of the current page)
         
         **GP:** Value from GET or POST method. Use this instead of global
         
         **GPvar:**  **usage of "GPvar" is deprecated. Use "GP" instead**
         
         **getenv:** Value from environment variables
         
         **getIndpEnv:** Value from t3lib\_div::getIndpEnv()
         
         **DB:** Value from database, syntax is [table name] : [uid] : [field].
         Any record from a table in TCA can be selected here. Only marked-
         deleted records does not return a value here.
         
         **fullRootLine:** syntax is [pointer, integer], [field name],
         ["slide"]
         
         This property can be used to retrieve values from "above" the current
         page's root. Take the below page tree and assume that we are on the
         page "Here you are!". Using the "levelfield" propertydescribed above,
         it is possible to goup only to the page "Site root", because it is the
         root of a new (sub-)site. With "fullRootLine" it is possible to go all
         the way up to page tree root. The numbers between square brackets
         indicate to which page each value of *pointer* would point to:
         
         \- Page tree root [-2]
         
         \|- 1. page before [-1]
         
         \|- Site root (root template here!) [0]
         
         \|- Here you are! [1]
         
         A "slide" parameter can be added just as for the "levelfield" property
         above.
         
         **LLL:** Reference to a locallang (php or xml) label. Reference
         consists of [fileref]:[labelkey]
         
         **path:** path to a file, possibly placed in an extension, returns
         empty if the file doesn't exist.
         
         **cObj:** [internal variable from list: "parentRecordNumber"]: For
         CONTENT and RECORDS cObjects that are returned
         
         by a select query, this returns the row number (1,2,3,...) of the
         current cObject record.
         
         **debug:** Returns HTML formatted content of PHP variable defined by
         keyword. Available keys are "rootLine", "fullRootLine", "data"
         
         **Getting array/object elements**
         
         You can fetch the value of an array/object by splitting it with a pipe
         "\|".Example:=  *TSFE:fe\_user\|user\|username*
         
         **Getting more values**
         
         By separating the value of getText with "//" (double slash) you let
         getText fetch the first value. If it appears empty ("" or zero) the
         next value is fetched and so on. Example:
         
         =  *field:header // field:title // field:uid*
         
         This gets "title" if "header" is empty. If "title" is also empty it
         gets field "uid"
   
   Default


.. container:: table-row

   Data type
         dir
   
   Examples
         *returns a list of all pdf, gif and jpg-*  *files from
         fileadmin/files/ sorted by*  *their name* reversely and with the full
         path (with " *fileadmin/files/" prepended)*
         
         **fileadmin/files/ \| pdf,gif,jpg \| name** \| r \| true
   
   Comment
         [path relative to the web root of the site] \| [list of valid
         extensions] \| [sorting: name, size, ext, date] \| [reverse: "r"] \|
         [return full path: boolean
         
         Files matching is returned in a comma-separated string.
         
         **Note:**
         
         The value of config-option "lockFilePath" must equal the first part of
         the path. Thereby the path is locked to that folder.
   
   Default


.. container:: table-row

   Data type
         function name
   
   Examples
         Function:
         
         ::
         
            user_reverseString
         
         Method in class:
         
         ::
         
            user_stringReversing
            ->reverseString
   
   Comment
         Indicates a function or method in a class to call. See more
         information at the USER cObject.
         
         Depending on implementation the class or function name (but not the
         method name) should probably be prefixed with "user\_". This can be
         changed in the $TYPO3\_CONF\_VARS config though. Also the function /
         method is normally called with 2 parameters, $conf (TS config) and
         $content (some content to be processed and returned)
         
         Also if you call a method in a class, it is checked (when using the
         USER/USER\_INT objects) whether a class with the same name, but
         prefixed with "ux\_" is present and if so, this class is instantiated
         instead. See "Inside TYPO3" document for more information on extending
         the classes in TYPO3!
   
   Default


.. ###### END~OF~TABLE ######


[tsref:(datatypes)]


Data types: Object types
""""""""""""""""""""""""

These are some "data-types" that might be mentioned and valid values
are shown here below:


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Data type
         Data type:
   
   Comment
         Comment:


.. container:: table-row

   Data type
         cObject
   
   Comment
         "cObjects" are also called "Content Objects". See the section "Content
         Objects" later in this manual.
         
         **Examples:**
         
         ::
         
            TEXT / IMAGE / MEDIA ....


.. container:: table-row

   Data type
         frameObj
   
   Comment
         FRAMESET / FRAME


.. container:: table-row

   Data type
         menuObj
   
   Comment
         See the section "Menu Objects" later in this manual.
         
         **Examples:**
         
         ::
         
            GMENU / TMENU / IMGMENU / JSMENU


.. container:: table-row

   Data type
         GifBuilderObj
   
   Comment
         See the section "GIFBUILDER" later in this manual.
         
         **Examples:**
         
         ::
         
            TEXT / SHADOW / OUTLINE / EMBOSS / BOX / IMAGE / EFFECT


.. ###### END~OF~TABLE ######

