
.. include:: ../../Includes.txt


.. highlight:: typoscript

.. _data-type-gettext:

getText
=======

.. container:: table-row

   Data type
         getText

   Examples
         The getText data type is some kind of tool box allowing to retrieve
         values from a variety of sources, e.g. from GET/POST variables, from
         registers, values from up the page tree, from the database, etc.

         The general syntax is as follows::

            key:code

         where :ts:`key` indicates the source we are trying to retrieve the
         value from and :ts:`code` is some form of path or pointer to the value,
         which depends on the key used. The various keys (e.g. :ts:`field`,
         :ts:`parameter`, :ts:`register`...) and their possible codes are
         described below.

         The :ts:`code` can contain pipe characters (\|) to separate keys
         in a multi-dimensional array. This e.g. works with :ts:`gp` and
         :ts:`tsfe`.

         **Example:** ::

            foo = TSFE:fe_user|user|username

         Spaces around the colon (:) are irrelevant. The :ts:`key` is
         case-insensitive.

         **Getting alternative values**

         By separating the value of getText with :ts:`//` (double slash) you can
         supply a number of codes and getText will return the first one, which is not
         empty ("" or zero).

         **Example:** ::

            foo = field:header // field:title // field:uid

         This gets the content of the field "header". If "header is empty, "title" is
         retrieved. If "title" is empty as well, it finally gets the field "uid".


.. only:: html

   .. contents::
      :local:
      :depth: 1


.. _data-type-gettext-field:

field:
------

**Syntax**

field: [field name from the current :php:`$cObj->data` array in the cObject, multi-dimensional.]

- As default the :php:`$cObj->data` array is :php:`$GLOBALS['TSFE']->page`
  (record of the current page!)
- In :ref:`TMENU <tmenu>` :php:`$cObj->data` is set to the page-record for each menu
  item.
- In :ref:`CONTENT <cobj-content>`/:ref:`RECORDS <cobj-records>`
  :php:`$cObj->data` is set to the actual record
- In :ref:`GIFBUILDER <gifbuilder>` :php:`$cObj->data` is set to the data
  :ref:`GIFBUILDER <gifbuilder>` is supplied with.

**Examples**

.. code-block:: typoscript

   foo = field : header

*gets content from $cObj->data['header']*

.. code-block:: typoscript

   foo = field : fieldname|level1|level2

*gets content from $cObj->data['fieldname']['level1']['level2']*


.. _data-type-gettext-parameters:

parameters:
-----------

**Syntax**

parameters: [field name from the current `$cObj->parameters` array in the cObject.]

See :ref:`parseFunc <parsefunc>`.


**Example**::

   foo = parameters: color

*gets content from $cObj->parameters['color']*


.. _data-type-gettext-register:

register:
---------

**Syntax**

register: [field name from the $GLOBALS['TSFE']->register]

See :ref:`LOAD_REGISTER <cobj-load-register>`.


**Example**::

   foo = register: color

*gets content from $GLOBALS['TSFE']->register['color']*


.. _data-type-gettext-levelmedia:
.. _data-type-gettext-leveluid:
.. _data-type-gettext-leveltitle:

leveltitle, leveluid, levelmedia:
---------------------------------

**Syntax**

leveltitle, leveluid, levelmedia: [levelTitle, uid or media in
rootLine, 0- , negative = from behind, " , slide" parameter forces a
walk to the bottom of the rootline until there's a "true" value to
return. Useful with levelmedia.]

Returns values from up or down the page tree.


**Examples**

.. code-block:: typoscript

   foo = leveltitle : 1

*gets the title of the page on the first level of the rootline*

.. code-block:: typoscript

   foo = leveltitle : -2 , slide

*gets the title of the page on the level right below the current page
AND if that is not present, walk to the bottom of the rootline until
there's a title*

.. code-block:: typoscript

   foo = leveluid : 0

*gets the id of the root-page of the website (level zero)*


.. _data-type-gettext-levelfield:

levelfield:
-----------

**Syntax**

levelfield: Like "leveltitle" et al. but where the second
parameter is the rootLine field you want to fetch. Syntax: [pointer,
integer], [field name], ["slide"]


**Example**::

   foo = levelfield : -1 , user_myExtField , slide

*gets the value of the user defined field user_myExtField in the root
line (requires additional configuration in $TYPO3_CONF_VARS to include field!)*


.. _data-type-gettext-date:

date:
-----

**Syntax**

date: [date-conf]. Can also be used without colon and date
configuration. Then the date will be formatted as "d/m Y".


**Example**::

   foo = date : d-m-y

*gets the current time formatted dd-mm-yy*


.. _data-type-gettext-page:

page:
-----

**Syntax**

page: [field in the current page record]

**Example**::

   foo = page : title

*gets the current page title*


.. _data-type-gettext-pagelayout:

pagelayout:
-----------

**Syntax**

pagelayout

**Example**::

   foo = pagelayout

*gets the current backend layout*


.. _data-type-gettext-current:

current:
--------

**Syntax**

current (gets the "current" value)

**Example**::

   foo = current

*gets the current value*


.. _data-type-gettext-level:

level:
------

**Syntax**

level (gets the rootline level of the current page)

**Example**::

   foo = level

*gets the rootline level of the current page*


.. _data-type-gettext-gp:

GP:
---

**Syntax**

GP: Value from GET or POST method.

.. note::

   "GPvar" also exists, but is deprecated.

**Examples**

.. code-block:: typoscript

   foo = GP : stuff

*gets input value from query string &stuff=...*

.. code-block:: typoscript

   foo = GP : stuff | bar

*gets input value from query string &stuff[bar]=...*


.. _data-type-gettext-getenv:

getenv:
-------

**Syntax**

getenv: Value from environment variables

**Example**::

   foo = getenv : HTTP_REFERER

*gets the env var HTTP\_REFERER*


.. _data-type-gettext-getindpenv:

getIndpEnv:
-----------

*getIndpEnv* returns the value of a *System Environment Variable*
denoted by *name* regardless of server OS, CGI/MODULE version etc. The
result is identical to the SERVER variable in most cases. This method
should be used instead of *getEnv* to get reliable values for all
situations. The internal processing is handled by
:php:`TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv()`

**Syntax**::

    getIndpEnv : <name>


**Example**::

   # get and output the client IP
   page = PAGE
   page.10 = TEXT
   page.10.stdWrap.data = getIndpEnv : REMOTE_ADDR
   page.10.stdWrap.htmlSpecialChars = 1


**These names can be used with getIndpEnv**:

===================== ==================================================================== ===============
Name                  Definition                                                           Example or result
===================== ==================================================================== ===============
HTTP_ACCEPT_LANGUAGE  language(s) accepted by client
HTTP_HOST             [host][:[port]]                                                      :samp:`example.org:8080`
HTTP_REFERER          [scheme]://[host][:[port]][path]                                     :samp:`https://example.org:8080/typo3/32/temp/phpcheck/index.php/arg1/arg2/arg3/?arg1,arg2,arg3&p1=parameter1&p2[key]=value`
HTTP_USER_AGENT       client user agent
PATH_INFO             [path_info]                                                          :samp:`/arg1/arg2/arg3/`
QUERY_STRING          [query]                                                              :samp:`arg1,arg2,arg3&p1=parameter1&p2[key]=value`
REMOTE_ADDR           client IP
REMOTE_HOST           client host
REQUEST_URI           [path]?[query]                                                       :samp:`/typo3/32/temp/phpcheck/index.php/arg1/arg2/arg3/?arg1,arg2,arg3&p1=parameter1&p2[key]=value`
SCRIPT_FILENAME       absolute filename of script
SCRIPT_NAME           [path_script]                                                        :samp:`/typo3/32/temp/phpcheck/[index.php]`
TYPO3_DOCUMENT_ROOT   absolute path of root of documents
TYPO3_HOST_ONLY       [host]                                                               :samp:`example.org`
TYPO3_PORT            [port]                                                               8080
TYPO3_REQUEST_DIR     [scheme]://[host][:[port]][path_dir]
TYPO3_REQUEST_HOST    [scheme]://[host][:[port]]
TYPO3_REQUEST_SCRIPT  [scheme]://[host][:[port]][path_script]
TYPO3_REQUEST_URL     [scheme]://[host][:[port]][path]?[query]
TYPO3_REV_PROXY       TRUE if this session runs over a well known proxy
TYPO3_SITE_SCRIPT     [script / Speaking URL] of the TYPO3 website
TYPO3_SITE_URL        [scheme]://[host][:[port]][path_dir] of the TYPO3 website frontend
TYPO3_SSL             TRUE if this session uses SSL/TLS (https)
1                     Return an array with all values for debugging purposes
===================== ==================================================================== ===============



.. _data-type-gettext-tsfe:

TSFE:
-----

**Syntax**

TSFE: [value from the :php:`$GLOBALS['TSFE']` array, multi-dimensional]

**Example**::

   foo = TSFE:fe_user|user|username

*gets the "username" field of the current FE user*


.. _data-type-gettext-db:

DB:
---

**Syntax**

DB: Value from database, syntax is [table name] : [uid] : [field].
Any record from a table in TCA can be selected here. Records
marked as deleted will not return any value.

**Example**::

   foo = DB : tt_content:234:header

*gets the value of the header field of record with uid 234 from table "tt\_content"*


.. _data-type-gettext-file:

file:
-----

**Syntax**

file: syntax is [uid] : [property]. Retrieves a property from a
file object (FAL) by identifying it through its sys\_file UID. Note
that during execution of the FILES cObject, you can also reference the
current file with "current" as UID like "file : current : size".

The following properties are available:

name, uid, originalUid, size, sha1, extension, mimetype, contents, publicUrl, modification_date, creation_date

Furthermore when manipulating references (such as images in content
elements or media in pages), additional properties are available (not
all are available all the time, it depends on the setup of *references*
of the FILES cObject):

title, description, link, alternative

Additionally, any data in the "sys_file_metadata" table can be accessed too.

See the :ref:`FILES cObject for usage examples <cobj-files-examples>`.

**Example**::

   foo = file : 17 : size

*gets the file size of the file with the sys\_file UID 17.*


.. _data-type-gettext-fullrootline:

fullRootLine:
-------------

**Syntax**

fullRootLine: syntax is [pointer, integer], [field name], ["slide"]

This property can be used to retrieve values from "above" the current
page's root. Take the below page tree and assume that we are on the
page "Here you are!". Using the "levelfield" propertydescribed above,
it is possible to goup only to the page "Site root", because it is the
root of a new (sub-)site. With "fullRootLine" it is possible to go all
the way up to page tree root. The numbers between square brackets
indicate to which page each value of *pointer* would point to::

   - Page tree root [-2]
    |- 1. page before [-1]
      |- Site root (root template here!) [0]
       |- Here you are! [1]


A "slide" parameter can be added just as for the "levelfield" property
above.

**Example**::

   foo = fullRootLine : -1, title

*gets the title of the page right before the start of the current website*


.. _data-type-gettext-lll:

LLL:
----

**Syntax**

LLL: Reference to a locallang (xlf, xml or php) label.
Reference consists of [fileref]:[labelkey]

**Example**::

   foo = LLL:EXT:felogin/pi1/locallang.xlf:logout

*gets localized label for logout button*

.. _data-type-gettext-path:

path:
-----

**Syntax**

path: path to a file, possibly placed in an extension, returns
empty if the file does not exist.

**Example**::

   foo = path:EXT:rsaauth/resources/rsaauth.js

*gets path to file rsaauth.js (inside extension rsaauth) relative to siteroot*

.. _data-type-gettext-cobj:

cObj:
-----

**Syntax**

cObj: parentRecordNumber

For CONTENT and RECORDS cObjects that are returned
by a select query, this returns the row number (1,2,3,...) of the
current cObject record.

"parentRecordNumber" is the only key available.

**Example**::

   foo = cObj : parentRecordNumber

*gets the number of the current cObject record*

.. _data-type-gettext-debug:

debug:
------

**Syntax**

debug: Returns HTML-formatted content of the PHP variable defined
by the keyword. Available keywords are "rootLine", "fullRootLine",
"data", "register" and "page".

**Example**::

   foo = debug : rootLine

*outputs the current root-line visually in HTML*


.. _data-type-gettext-global:

global:
-------

**Syntax**

global: [GLOBAL variable, split with \| if you want to get from an
array! Deprecated, use GP, TSFE or getenv!]
