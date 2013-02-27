.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _condition-reference:

Condition reference
^^^^^^^^^^^^^^^^^^^


.. _condition-syntax:

General syntax
""""""""""""""

Each condition is encapsulated by square brackets. For a list of
available conditions see below.

"[ELSE]" is available as else operator. It is a condition, which will
return TRUE, if the previous condition returned FALSE.

Each condition block is ended with "[GLOBAL]".


Example:
~~~~~~~~

::

   [browser = msie]
     # TypoScript Code for users of Internet Explorer.
   [ELSE]
     # TypoScript Code for users of other browsers.
   [GLOBAL]


.. _condition-general-notes:

General notes
"""""""""""""

Values are normally trimmed before comparison, so blanks are not taken
into account.

Note that conditions cannot be used inside of curly brackets.

You may combine several conditions with two operators: && (and), \|\|
(or)

Alternatively you may use "AND" and "OR" instead of "&&" and "\|\|".
The AND operator always takes higher precedence over OR. If no operator
has been specified, it will default to OR.


Examples:
~~~~~~~~~

This condition will match if the visitor opens the website with
Internet Explorer on Windows (but not on Mac) ::

   [browser = msie] && [system = win]

This will match with either Opera or Firefox browsers ::

   [browser = opera] || [browser = firefox]

This will match with either Firefox or Internet Explorer. In case of
Internet Explorer, the version must be above 8. ::

   [browser = firefox] || [browser = msie] && [version => 8]

For full explanations about conditions, please refer to "TypoScript
Syntax and In-depth Study".


.. _condition-browser:

browser
"""""""


Syntax:
~~~~~~~

::

   [browser = browser1,browser2,...]


Values and comparison:
''''''''''''''''''''''


.. ### BEGIN~OF~SIMPLE~TABLE ###

.. Note: The first column cannot be smaller, as ReST does not allow
   a line break in the first column of a simple table.

========================================================   ===========================
Browser:                                                   Identification:
========================================================   ===========================
Amaya                                                      amaya
AOL                                                        aol
Avant                                                      avant
Camino                                                     camino
Google Chrome                                              chrome
Mozilla Firefox                                            firefox
Flock                                                      flock
Gecko                                                      gecko
Konqueror                                                  konqueror
Lynx                                                       lynx
NCSA Mosaic                                                mosaic
Microsoft Internet Explorer                                msie
Navigator                                                  navigator
Netscape Communicator                                      netscape
OmniWeb                                                    omniweb
Opera                                                      opera
Safari                                                     safari
SeaMonkey                                                  seamonkey
Webkit                                                     webkit
?? (if none of the above was found in the user agent)      unknown
========================================================   ===========================

.. ###### END~OF~SIMPLE~TABLE ######


The condition works with the user agent string. The user agent is
parsed with a regular expression, which searches the string for
matches with the identifications named above. If there are multiple
matches, the rightmost match is finally used, because it mostly is the
most correct one.

An example user agent could look like this::

   Mozilla/5.0 (Windows NT 5.1; rv:17.0) Gecko/20100101 Firefox/17.0

This string contains the identifications "Gecko" and "Firefox". The
condition ::

   [browser = firefox]

evaluates to true.

.. figure:: ../../Images/icon_note.png
   :alt: Note

**Older TYPO3 versions**

Until TYPO3 4.2 the user agent was determined differently: Each value
was compared with the ($browsername.$browserversion, e.g.
"netscape4.72") using strstr(). So if the value was "netscape" or just
"scape" or "net" all netscape browsers would match. If the value was
"netscape4" all Netscape 4.xx browsers would match. If any value in
the list matched the current browser, the condition returned true.

TYPO3 version 4.2 or older does not detect all the browsers listed
above.


Examples:
~~~~~~~~~

This will match with Chrome and Opera-browsers::

   [browser = chrome, opera]


.. _condition-version:

version
"""""""


Syntax:
~~~~~~~

::

   [version = value1, >value2, =value3, <value4, ...]


Comparison:
'''''''''''

Values are floating-point numbers with "." as the decimal separator.

The values may be preceded by three operators:


.. ### BEGIN~OF~SIMPLE~TABLE ###

============   =======================================================================
Operator:      Function:
============   =======================================================================
[nothing]      The value must be part of the beginning of the version as a string.
               This means that if the version is "4.72" and the value is "4" or "4.7"
               it matches. But "4.73" does not match.

               Example from syntax: "value1"

=              The value must match exactly. Version "4.72" matches only with a value
               of "4.72"

>              The version must be greater than the value

<              The version must be less than the value
============   =======================================================================

.. ###### END~OF~SIMPLE~TABLE ######


Examples:
~~~~~~~~~

This matches with exactly "4.03" browsers ::

   [version=  =4.03]

This matches with all 4+ browsers and Netscape 3 browsers ::

   [version=  >4][browser= netscape3]


.. _condition-system:

system
""""""


Syntax:
~~~~~~~

::

   [system = system1,system2]


Values and comparison:
''''''''''''''''''''''


.. ### BEGIN~OF~SIMPLE~TABLE ###

========================   ================================
System:                    Identification:
========================   ================================
Linux                      linux
Android                    android
OpenBSD/NetBSD/FreeBSD     unix\_bsd
SGI / IRIX                 unix\_sgi
SunOS                      unix\_sun
HP-UX                      unix\_hp
Chrome OS                  chrome
iOS                        iOS
Macintosh                  mac
Windows 7                  win7
Windows Vista              winVista
Windows XP                 winXP
Windows 2000               win2k
Windows NT                 winNT
Windows 98                 win98
Windows 95                 win95
Windows 3.11               win311
Amiga                      amiga
========================   ================================

.. ###### END~OF~SIMPLE~TABLE ######


Comparison with the operating system, which the website visitor uses.
The system is extracted out of the useragent string.

Values are strings and a match happens if one of these strings is the
first part of the system-identification.

For example if the value is "win9" this will match with "win95" and
"win98" systems.


Examples:
~~~~~~~~~

This will match with windows and mac -systems only ::

   [system= win,mac]

.. figure:: ../../Images/icon_note.png
   :alt: Note

**Older TYPO3 versions and backwards compatibility**

TYPO3 version 4.4 or older does not detect all the systems listed
above.

For backwards compatibility, some systems are also matched by more
generic strings.

It is recommended to use the new identifiers documented above, but the
following are valid, too:


.. ### BEGIN~OF~SIMPLE~TABLE ###

====================   =======================================
System:                Generic identification:
====================   =======================================
Android                linux
Chrome OS              linux
iOS                    mac
Windows 7              winNT
Windows Vista          winNT
Windows XP             winNT
Windows 2000           winNT
====================   =======================================

.. ###### END~OF~SIMPLE~TABLE ######


.. _condition-device:

device
""""""


Syntax:
~~~~~~~

::

   [device= device1, device2]


Values and comparison:
''''''''''''''''''''''


.. ### BEGIN~OF~SIMPLE~TABLE ###

==================  ====================
Device:             Identification:
==================  ====================
HandHeld            pda
WAP phones          wap
Grabbers            grabber
Indexing robots     robot
==================  ====================

.. ###### END~OF~SIMPLE~TABLE ######


Values are strings and a match happens if one of these strings equals
the type of device


Examples:
~~~~~~~~~

This will match WAP-phones and PDA's ::

   [device = wap, pda]


.. _condition-useragent:

useragent
"""""""""


Syntax:
~~~~~~~

::

   [useragent = agent]


Values and comparison:
''''''''''''''''''''''

This is a direct match on the useragent string from
getenv("HTTP\_USER\_AGENT")

You have the options of putting a "\*" at the beginning and/or end of
the value *agent* thereby matching with this wildcard!


Examples:
~~~~~~~~~

If the HTTP\_USER\_AGENT is "Mozilla/4.0 (compatible; Lotus-Notes/5.0;
Windows-NT)" this will match with it::

   [useragent = Mozilla/4.0 (compatible; Lotus-Notes/5.0; Windows-NT)]

This will also match with it::

   [useragent = *Lotus-Notes*]

... but this will also match with a useragent like this: "Lotus-
Notes/4.5 ( Windows-NT )"

A short list of user-agent strings and a proper match:


.. ### BEGIN~OF~SIMPLE~TABLE ###

===========================================================   ======================   =============================
HTTP\_USER\_AGENT:                                            Agent description:       Matching condition:
===========================================================   ======================   =============================
Nokia7110/1.0+(04.77)                                         Nokia 7110 WAP phone     [useragent= Nokia7110\*]
Lotus-Notes/4.5 ( Windows-NT )                                Lotus-Notes browser      [useragent= Lotus-Notes\*]
Mozilla/3.0 (compatible; AvantGo 3.2)                         AvantGo browser          [useragent= \*AvantGo\*]
Mozilla/3.0 (compatible; WebCapture 1.0; Auto; Windows)       Adobe Acrobat 4.0        [useragent= \*WebCapture\*]
===========================================================   ======================   =============================

.. ###### END~OF~SIMPLE~TABLE ######


WAP-agents:
'''''''''''

These are some of the known WAP agents:


.. ### BEGIN~OF~SIMPLE~TABLE ###

==============================  ==============================
HTTP\_USER\_AGENT:              .. invisible comment
==============================  ==============================
ALAV UP/4.0.7                   PLM's WapBrowser
Alcatel-BE3/1.0 UP/4.0.6c       QWAPPER/1.0
AUR PALM WAPPER                 R380 2.0 WAP1.1
Device V1.12                    SIE-IC35/1.0
EricssonR320/R1A                SIE-P35/1.0 UP/4.1.2a
fetchpage.cgi/0.53              SIE-P35/1.0 UP/4.1.2a
Java1.1.8                       UP.Browser/3.01-IG01
Java1.2.2                       UP.Browser/3.01-QC31
m-crawler/1.0 WAP               UP.Browser/3.02-MC01
Materna-WAPPreview/1.1.3        UP.Browser/3.02-SY01
MC218 2.0 WAP1.1                UP.Browser/3.1-UPG1
Mitsu/1.1.A                     UP.Browser/4.1.2a-XXXX
MOT-CB/0.0.19 UP/4.0.5j         UPG1 UP/4.0.7
MOT-CB/0.0.21 UP/4.0.5m         Wapalizer/1.0
Nokia-WAP-Toolkit/1.2           Wapalizer/1.1
Nokia-WAP-Toolkit/1.3beta       WapIDE-SDK/2.0; (R320s (Arial))
Nokia7110/1.0 ()                WAPJAG Virtual WAP
Nokia7110/1.0 (04.67)           WAPJAG Virtual WAP
Nokia7110/1.0 (04.67)           WAPman Version 1.1 beta:Build W2000020401
Nokia7110/1.0 (04.69)           WAPman Version 1.1
Nokia7110/1.0 (04.70)           Waptor 1.0
Nokia7110/1.0 (04.71)           WapView 0.00
Nokia7110/1.0 (04.73)           WapView 0.20371
Nokia7110/1.0 (04.74)           WapView 0.28
Nokia7110/1.0 (04.76)           WapView 0.37
Nokia7110/1.0 (04.77)           WapView 0.46
Nokia7110/1.0 (04.80)           WapView 0.47
Nokia7110/1.0 (30.05)           WinWAP 2.2 WML 1.1
Nokia7110/1.0                   wmlb

                                YourWap/0.91

                                YourWap/1.16

                                Zetor
==============================  ==============================

.. ###### END~OF~SIMPLE~TABLE ######


.. _condition-language:

language
""""""""


Syntax:
~~~~~~~

::

   [language = lang1, lang2, ...]


Comparison:
'''''''''''

The values must be a straight match with the value of
getenv("HTTP\_ACCEPT\_LANGUAGE") from PHP. Alternatively, if the value
is wrapped in "\*" (e.g. "\*en-us\*") then it will split all languages
found in the HTTP\_ACCEPT\_LANGUAGE string and try to match the value
with any of those parts of the string. Such a string normally looks
like "de,en-us;q=0.7,en;q=0.3" and "\*en-us\*" would match with this
string.


.. _condition-ip:

IP
""


Syntax:
~~~~~~~

::

   [IP = ipaddress1, ipaddress2, ...]


Comparison:
'''''''''''

The values are compared with the getenv("REMOTE\_ADDR") from PHP.

You may include "\*" instead of one of the parts in values. You may
also list the first one, two or three parts and only they will be
tested.


Examples:
~~~~~~~~~

These examples will match any IP address starting with "123"::

   [IP = 123.*.*.*]

or ::

   [IP = 123]

These examples will match any IP address ending with "123" or being
"192.168.1.34"::

   [IP = *.*.*.123][IP = 192.168.1.34]


.. _condition-hostname:

hostname
""""""""


Syntax:
~~~~~~~

::

   [hostname = hostname1, hostname2, ...]


Comparison:
'''''''''''

The values are compared to the fully qualified hostname of
getenv("REMOTE\_ADDR") retrieved by PHP.

Value is comma-list of domain names to match with. \*-wildcard allowed
but cannot be part of a string, so it must match the full host name
(e.g. myhost.\*.com => correct, myhost.\*domain.com => wrong)


.. _condition-hour:

hour
""""


Syntax:
~~~~~~~

::

   [hour = hour1, > hour2, < hour3, ...]

**Note:** The first "=" sign directly after the word "hour" is always
needed and is no operator. After that follow the operator and then the
hour.


Comparison:
'''''''''''

Possible values are 0 to 23 (24-hours-format). The values in floating
point are compared with the current hour of the server time.

As you see in the section "Syntax" above, you can separate multiple
conditions in one with a comma. The comma will then connect them with
a logical disjunction (OR), that means the whole condition will be
true, when *one or more* of its operands are true.


.. ### BEGIN~OF~SIMPLE~TABLE ###

=============   ==============================================================
Operator:       Function:
=============   ==============================================================
[none]          Requires an exact match with the value. Since TYPO3 6.0
                comparison with a list of values is possible as well. The
                condition then returns true, if the value is in the list.
                Values must then be separated by "|".

>               The hour must be greater than the value.

<               The hour must be less than the value.

<=              The hour must be less than or equal to the value.

>=              The hour must be greater than or equal to the value.

!=              The hour must be not equal to the value. Since TYPO3 6.0
                comparison with a list of values is possible as well. The
                condition then returns true, if the value is not in the list.
                Values must then be separated by "|".
=============   ==============================================================

.. ###### END~OF~SIMPLE~TABLE ######


Examples:
~~~~~~~~~

This will match, if it is between 9 and 10 o'clock (according to the
server time)::

   [hour = 9]

This will match, if it is not between 8 and 11 o'clock::

   [hour = != 8|9|10]

This will match, if it is before 7 o'clock::

   [hour = < 7]

This will match, if it is before 15 o'clock::

   [hour = <= 14]

The following examples will demonstrate the usage of the comma inside
the condition:

This will match, if it is between 8 and 9 o'clock (the hour equals 8)
or after 16 o'clock (the hour is bigger than or equal to 16)::

   [hour = 8, >= 16]

This will match between 16 and 8 o'clock (remember that the comma acts
as an OR)::

   [hour = > 15, < 8]

In contrast a condition matching for 8 until 16 o'clock would be::

   [hour = > 7] && [hour = < 16]


.. _condition-minute:

minute
""""""

See "Hour" above. Uses the same syntax!


Syntax:
~~~~~~~

::

   [minute = ...]


Comparison:
'''''''''''

Minute of hour, possible values are 0-59.

Apart from that this condition uses the same way of comparison as
hour.


.. _condition-month:

month
"""""

See "Hour" above. Uses the same syntax!


Syntax:
~~~~~~~

::

   [month = ...]


Comparison:
'''''''''''

Month, from January being 1 until December being 12.

Apart from that this condition uses the same way of comparison as
hour.


.. _condition-year:

year
""""

See "Hour" above. Uses the same syntax!For further information look at
the date() function in the PHP manual, format string Y.


Syntax:
~~~~~~~

::

   [year = ...]


Comparison:
'''''''''''

Year, as a 4-digit number.

Apart from that this condition uses the same way of comparison as
hour.


.. _condition-dayofweek:

dayofweek
"""""""""

See "Hour" above. Uses the same syntax!


Syntax:
~~~~~~~

::

   [dayofweek = ...]


Comparison:
'''''''''''

Day of week, starting with Sunday being 0 until Saturday being 6.

Apart from that this condition uses the same way of comparison as
hour.


.. _condition-dayofmonth:

dayofmonth
""""""""""

See "Hour" above. Uses the same syntax!


Syntax:
~~~~~~~

::

   [dayofmonth = ...]


Comparison:
'''''''''''

Day of month, possible values are 1-31.

Apart from that this condition uses the same way of comparison as
hour.


.. _condition-dayofyear:

dayofyear
"""""""""

See "Hour" above. Uses the same syntax!For further information look at
the date() function in the PHP manual, format string z.


Syntax:
~~~~~~~

::

   [dayofyear = ...]


Comparison:
'''''''''''

Day of year, 0-364 (or 365 in leap years). That this condition begins
with 0 for the first day of the year means that e.g. [dayofyear =
7]will be true on the 6 :sup:`th` of January.

Apart from that this condition uses the same way of comparison as
hour.


.. _condition-usergroup:

usergroup
"""""""""


Syntax:
~~~~~~~

::

   [usergroup = group1-uid, group2-uid, ...]


Comparison:
'''''''''''

The comparison can only return true if the grouplist is not empty
(global var "gr\_list").

The values must either exists in the grouplist OR the value must be a
"\*".


Example:
~~~~~~~~

This matches all logins::

   [usergroup = *]

This matches logins from users members of groups with uid's 1 and/or
2::

   [usergroup = 1,2]


.. _condition-loginuser:

loginUser
"""""""""


Syntax:
~~~~~~~

::

   [loginUser = fe_users-uid, fe_users-uid, ...]


Comparison:
'''''''''''

Matches on the uid of a logged in frontend user. Works like
'usergroup' above including the \* wildcard to select ANY user.


Example:
~~~~~~~~

This matches any login (use this instead of "[usergroup = \*]" to
match when a user is logged in!)::

   [loginUser = *]

Additionally it is possible to check if no FE user is logged in.


Example:
~~~~~~~~

This matches when no user is logged in::

   [loginUser = ]


.. _condition-page:

page
""""


Syntax:
~~~~~~~

::

   [page|field = value]


Comparison:
'''''''''''

This condition checks values of the current page record. While you can
achieve the same with TSFE:[field] conditions in the frontend, this
condition is usable in both frontend and backend.


Example:
~~~~~~~~

This condition matches, if the layout field is set to 1::

   [page|layout = 1]


.. _condition-treelevel:

treeLevel
"""""""""


Syntax:
~~~~~~~

::

   [treeLevel = levelnumber, levelnumber, ...]


Comparison:
'''''''''''

This checks if the last element of the rootLine is at a level
corresponding to one of the figures in "treeLevel". Level = 0 is the
"root" of a website. Level=1 is the first menu level.


Example:
~~~~~~~~

This changes something with the template, if the page viewed is on
level either level 0 (basic) or on level 2 ::

   [treeLevel = 0,2]


.. _condition-pidinrootline:

PIDinRootline
"""""""""""""


Syntax:
~~~~~~~

::

   [PIDinRootline = pages-uid, pages-uid, ...]


Comparison:
'''''''''''

This checks if one of the figures in "treeLevel" is a PID (pages-uid)
in the rootline.


Example:
~~~~~~~~

This changes something with the template, if the page viewed is or is
a subpage to page 34 or page 36 ::

   [PIDinRootline = 34,36]


.. _condition-pidupinrootline:

PIDupinRootline
"""""""""""""""


Syntax:
~~~~~~~

::

   [PIDupinRootline = pages-uid, pages-uid, ...]


Comparison:
'''''''''''

Do the same as PIDinRootline, except the current page-uid is excluded
from check.


.. _condition-compatversion:

compatVersion
"""""""""""""


Syntax:
~~~~~~~

::

   [compatVersion = x.y.z]


Comparison:
'''''''''''

Require a minimum compatibility version. This version is not necessary
equal with the TYPO3 version, it is a configurable value that can be
changed in the Upgrade Wizard of the Install Tool.

"compatVersion" is especially useful if you want to provide new
default settings but keep the backwards compatibility for old versions
of TYPO3.


.. _condition-globalvar:

globalVar
"""""""""


Syntax:
~~~~~~~

::

   [globalVar = var1 = value1, var2 > value2, var3 < value3, var4 <= value4, var5 >= value5, var6 != value6, ...]


Comparison:
'''''''''''

The values in floating point are compared to the global variables
"var1", "var2" ... from above.

You can use multiple conditions in one by separating them with a
comma. The comma then acts as alogical disjunction, that means the
whole condition evaluates to true,whenever *one or more* of its
operands are true.


.. ### BEGIN~OF~SIMPLE~TABLE ###

=============   ==============================================================
Operator:       Function:
=============   ==============================================================
=               Requires an exact match with the value. Since TYPO3 6.0
                comparison with a list of values is possible as well. The
                condition then returns true, if the value is in the list.
                Values must then be separated by "|".

>               The var must be greater than the value.

<               The var must be less than the value.

<=              The var must be less than or equal to the value.

>=              The var mast be greater than or equal to the value.

!=              The var must be not equal to the value. Since TYPO3 6.0
                comparison with a list of values is possible as well. The
                condition then returns true, if the value is not in the list.
                Values must then be separated by "|".
=============   ==============================================================

.. ###### END~OF~SIMPLE~TABLE ######


Examples:
~~~~~~~~~

This will match with a URL like "...&print=1"::

   [globalVar = GP:print > 0]

This will match, if the page-id is equal to either 10, 12 or 15::

   [globalVar = TSFE:id = 10|12|15]

This will match, if the page-id is not equal to 10, 12 and 15::

   [globalVar = TSFE:id != 10|12|15]

This will match, if the page-id is higher than or equal to 10::

   [globalVar = TSFE:id >= 10]

This will match, if the page-id is not equal to 316::

   [globalVar = TSFE:id != 316]

This will match the non-existing GET/POST variable "style"::

   [globalVar = GP:style = ]

This will match, if the GET/POST variable "L" equals 8 or the GET/POST
variable "M" equals 2 or both::

   [globalVar = GP:L = 8, GP:M = 2]

This will match with the pages having the layout field set to "Layout
1"::

   [globalVar = TSFE:page|layout = 1]

If the constant {$constant\_to\_turnSomethingOn} is "1" then this
matches::

   [globalVar = LIT:1 = {$constant_to_turnSomethingOn}]

Find out if there currently is a valid backend login::

   [globalVar = TSFE : beUserLogin = 1]


.. _condition-globalstring:

globalString
""""""""""""


Syntax:
~~~~~~~

::

   [globalString =   var1=value,  var2= *value2, var3= *value3*, ...]


Comparison:
'''''''''''

This is a direct match on global strings.

You have the options of putting a "\*" as a wildcard or using a PCRE
style regular expression (must be wrapped in "/") to the value.


Examples:
~~~~~~~~~

If the HTTP\_HOST is "www.typo3.org" this will match with::

   [globalString = IENV:HTTP_HOST = www.typo3.org]

This will also match with it::

   [globalString = IENV:HTTP_HOST = *typo3.org]

... but this will also match with an HTTP\_HOST like this:
"demo.typo3.org"


Important note on globalVar and globalString
''''''''''''''''''''''''''''''''''''''''''''

You can use values from global arrays and objects by dividing the var-
name with a "\|" (vertical line).


Examples:
~~~~~~~~~

The global var $HTTP\_POST\_VARS['key']['levels'] would be retrieved
by "HTTP\_POST\_VARS\|key\|levels"

Also note that it's recommended to program your scripts in compliance
with the php.ini-optimized settings. Please see that file (from your
distribution) for details.

Caring about this means that you would get values like HTTP\_HOST by
getenv() and you would retrieve GET/POST values with
TYPO3\CMS\Core\Utility\GeneralUtility::\_GP() (t3lib\_div::\_GP()).
Finally a lot of values from the TSFE object are
useful. In order to get those values for comparison with "globalVar"
and "globalString" conditions, you prefix that variable's name with
either "IENV:"/"ENV:", "GP:", "TSFE:" or "LIT:" respectively. Still
the "\|" divider may be used to separate keys in arrays and/or
objects. "LIT" means "literal" and the string after ":" is trimmed and
returned as the value (without being divided by "\|" or anything)

**Note:** Using the "IENV:" prefix is highly recommended to get
server/environment variables which are system-independent. Basically
this will get the value using
TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv()
(t3lib\_div::getIndpEnv()). With "ENV:" you get the raw output from
getenv() which is **not** always the same on all systems!


Examples:
~~~~~~~~~

This will match with a remote-addr beginning with "192.168." ::

   [globalString = IENV:REMOTE_ADDR = 192.168.*]

This will match with the user whose username is "test"::

   [globalString = TSFE:fe_user|user|username = test]


.. _condition-userfunc:

userFunc
""""""""


Syntax:
~~~~~~~

::

   [userFunc = user_match(checkLocalIP)]


Comparison:
'''''''''''

This call the function "user\_match" with the first parameter
"checkLocalIP". You write that function. You decide what it checks.
Function result is evaluated as true/false.


Example:
~~~~~~~~

Put this function in your AdditionalConfiguration.php
(localconf.php) file::

   function user_match($cmd) {
           switch($cmd) {
                   case 'checkLocalIP':
                           if (strstr(getenv('REMOTE_ADDR'), '192.168')) {
                                   return TRUE;
                           }
                   break;
                   case 'checkSomethingElse':
                           // ....
                   break;
           }
   }

This condition will return true if the remote address contains
"192.168" - which is what your function finds out. ::

   [userFunc = user_match(checkLocalIP)]

