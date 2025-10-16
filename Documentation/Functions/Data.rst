..  include:: /Includes.rst.txt
..  index:: Function; getText
..  _data-type-function-getText:
..  _data-type-gettext:

==============
Data / getText
==============

The `getText` data type is a kind of tool box for retrieving
values from different sources, for example, `GET`/`POST` variables,
registers, values from the page tree, items in the page menus and records
from database tables.

The general syntax is as follows:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = <key> : <code>

where :typoscript:`<key>` indicates the source and :typoscript:`<code>` contains paths or
pointers to values. Possible keys and codes are described below.

The :typoscript:`code` can contain pipe characters :typoscript:`|` which will
result in a multidimensional array. This, for example, works with :typoscript:`TSFE`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = TSFE : fe_user | user | username

Some codes use a different separator, but this is documented in the
code.
Spaces around the colon (:typoscript:`:`) are irrelevant. The :typoscript:`key` is
case-insensitive.

..  _data-type-gettext-double-slash:

Using multiple codes separated by a :typoscript:`//` (double slash) will return
the first one that is not empty ("" or zero). The TypoScript below gets the
content of the "header" field. If "header" is empty, "title" is
retrieved. If "title" is also empty, the "uid" field is retrieved:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = field : header // field : title // field : uid


Properties
==========

..  contents::
    :local:

..  _data-type-gettext-applicationcontext:

applicationcontext
------------------

..  versionadded:: 13.0


..  confval:: applicationcontext
    :name: data-applicationcontext

    Returns the current :ref:`application context <t3coreapi:application-context>`
    as a string.


..  _data-type-gettext-applicationcontext-example:

Example: Evaluate the current application context
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Evaluate if the current application context is "Production":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    if {
        value.data = applicationcontext
        equals = Production
    }

..  _data-type-gettext-asset:

asset
-----

..  confval:: asset
    :name: data-asset

    ..  versionadded:: 13.2
        Local resources can be cache-busted. It is no longer necessary
        to rename the asset when it is exchanged, forcing browsers to reload the file.

    The getText `asset` function includes assets like images, CSS or
    JavaScript that are cache-busted.

    Depending on :confval:`$GLOBALS['TYPO3_CONF_VARS']['FE']['versionNumberInFilename'] <t3coreapi:typo3-conf-vars-fe-versionnumberinfilename>`
    the cache buster is applied as a query string or embedded in the filename.

    The result is the same as using the argument :fluid:`useCacheBusting="true"`
    in :ref:`t3viewhelper:typo3-fluid-uri-resource`.

Example: Display extension icon with cache buster
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    page.20 = TEXT
    page.20 {
        value.stdWrap.data = asset: EXT:core/Resources/Public/Icons/Extension.svg
    }

..  _data-type-gettext-cobj:

cObj
----

..  confval:: cObj
    :name: data-cObj

    For :ref:`cobj-content` and :ref:`cobj-records` cObjects that are returned by
    a select query, this returns the row number (1,2,3,...) of the current
    cObject record.

    :typoscript:`parentRecordNumber` is the only key available.


..  _data-type-gettext-cobj-example:

Example: Get the number of the current cObject record
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = cObj : parentRecordNumber

..  _data-type-gettext-context:

context
-------

..  confval:: context
    :name: data-context

    Access values from context API (:ref:`see <t3coreapi:context-api>`).
    If a property is an array, it is converted into a comma-separated list.

    Syntax:

    ..  code-block:: none
        :caption: TypoScript Syntax

        lib.foo.data = context:<aspectName>:<propertyName>

..  _data-type-gettext-context-example:

Example: Retrieve current workspace ID
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10 = TEXT
    page.10.data = context:workspace:id
    page.10.wrap = You are in workspace: |

..  _data-type-gettext-current:

current
-------

..  confval:: current
    :name: data-current

    Current (gets the "current" value)

    ..  TODO: What is the "current" value? We should explain that.

Example: Get the current value
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = current

..  _data-type-gettext-date:

date
----

..  confval:: date
    :name: data-date
    :Default: :typoscript:`d/m Y`

    Can be used with a colon and :ref:`data-type-date-conf`.

..  _data-type-gettext-date-example:

Example:  Get the current time formatted dd-mm-yy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = date : d-m-y

..  _data-type-gettext-db:

DB
--

..  confval:: DB
    :name: data-db
    :Syntax: DB : [table name] : [uid] : [field]

    Value from the database. Any record from any table that is in the TCA can be
    selected here. Records marked as deleted will not return a value.

    In contrast to the other keys, colons are used here instead of pipes to drill down into the
    structure.

..  _data-type-gettext-db-example:

Example: Get a header field value of a record
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the value of the header field of record with uid 234 from table
:sql:`tt_content`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = DB : tt_content:234:header

Get the value of the header field of a record, where the uid is in the
`myContentId` GET parameter :

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data.dataWrap = DB : tt_content:{GP : myContentId}:header

..  note::
    It is safe to use client-/user-provided input for the id of a DB
    record here. The function :php:`ContentObjectRenderer->getData()` internally
    calls the function :php:`PageRepository->getRawRecord()`, which converts the
    parameter to an int via :php:`QueryBuilder->createNamedParameter()`

..  _data-type-gettext-debug:

debug
-----


..  confval:: debug
    :name: data-debug

    Returns HTML-formatted content of a PHP variable.
    Available variables are :typoscript:`rootLine`, :typoscript:`fullRootLine`, :typoscript:`data`,
    :typoscript:`register` and :typoscript:`page`.

..  _data-type-gettext-debug-example:

Example: Debug the current root-line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Outputs the current root-line visually in HTML:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = debug : rootLine

..  _data-type-gettext-field:

field
-----

..  confval:: field
    :name: data-field
    :Syntax: field : [a field name in the current :php:`$cObj->data` array in the cObject, multidimensional]


    This gives read access to the value of an internal global variable depending on the key.

    -   By default, the :php:`$cObj->data` array is the record of the current page.

    -   In :ref:`TMENU <tmenu>` :php:`$cObj->data` is set to the page-record of
        each menu item in loop iterations during the rendering process.

    -   In :ref:`cobj-content` / :ref:`cobj-records` :php:`$cObj->data` is set to
        the current record

    -   In :ref:`GIFBUILDER <gifbuilder>` :php:`$cObj->data` is set to the data
        :ref:`GIFBUILDER <gifbuilder>` is supplied with.

..  _data-type-gettext-field-example:

Example: Get header data
~~~~~~~~~~~~~~~~~~~~~~~~

Get content from :php:`$cObj->data['header']`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = field : header

Example: Get data in a field
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get content from :php:`$cObj->data['fieldname']['level1']['level2']`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = field : fieldname | level1 | level2

..  _data-type-gettext-file:

file
----

..  confval:: file
    :name: data-file
    :Syntax: file : [uid] : [property]

    Retrieves a property from a file object (:ref:`FAL <t3coreapi:fal>`) by identifying it through its
    :sql:`sys_file` UID. Note that during execution of the :ref:`cobj-files` cObject,
    it is possible to reference the current file using :confval:`data-current` as the UID,
    for example, :typoscript:`file : current : size`.

    The following properties are available: name, uid, originalUid, size, sha1,
    extension, mimetype, contents, publicUrl, modification_date and creation_date.

    Furthermore, when manipulating references (such as images in content elements
    and media on pages), these additional properties are available (not all are
    available all the time, it depends on the setup of *references* of the
    :ref:`cobj-files` cObject): title, description, link and alternative.

    Any data in the :sql:`sys_file_metadata` table can also be accessed.

    See the :ref:`FILES <cobj-files-examples>` cObject for examples of usage.

..  _data-type-gettext-file-example:

Example: Get the size of a file
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the size of the file with sys\_file UID 17:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = file : 17 : size

..  _data-type-gettext-flexform:

flexform
--------

..  confval:: flexform
    :name: data-flexform
    :Syntax: flexform : [field containing flexform data] : [property of this flexform]

    Access values in :ref:`FlexForms <t3coreapi:flexforms>`, for example, inside a :sql:`tt_content` record.

..  _data-type-gettext-flexform-example:

Example: Get a FlexForm value
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Return the FlexForm value of given name:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = flexform : pi_flexform:settings.categories

..  _data-type-gettext-fullrootline:

fullRootLine
------------

..  confval:: fullRootLine
    :name: data-fullRootLine
    :Syntax: fullRootLine : [pointer, integer], [field name], ["slide"]

Used to retrieve values from "above" the current page's
root. Assume that you are on the page "You are here!" in the page tree below.
Using the :ref:`data-type-gettext-levelfield` property, you
can only go up to the page "Site root", because it is the root of a new
(sub-)site.  :typoscript:`fullRootLine` allows you to go all the way up to the page
tree root. The numbers in square brackets indicate  which page each
value of *pointer* would point to:

..  code-block:: text

    - Page tree root [-2]
      |- 1. page before [-1]
        |- Site root (root template here!) [0]
          |- You are here! [1]

A "slide" parameter can be added (like in :ref:`data-type-gettext-levelfield`
property).

..  _data-type-gettext-fullrootline-example:

Example: Get the title of the previous page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the title of the page before the start of the current website:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = fullRootLine : -1, title

..  _data-type-gettext-getenv:

getenv
------

..  confval:: getenv
    :name: data-getenv

    Value from PHP environment variables.

    For a cached version of this feature, see :ref:`getEnv <getenv>`.

..  _data-type-gettext-getenv-example:

Example: Get the HTTP referer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the environment variable `HTTP_REFERER`.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = getenv : HTTP_REFERER

..  _data-type-gettext-getindpenv:

getIndpEnv
----------

..  confval:: getIndpEnv
    :name: data-getIndpEnv
    :Syntax: getIndpEnv : <name>

    Returns the value of a *System Environment Variable* denoted by
    *name* regardless of server OS, CGI/MODULE version, etc. The result is
    usually identical to the :php:`$_SERVER` variable. This method is more reliable
    then *getEnv*. Internal processing is handled by
    :php:`TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv()`

    Available names:

    ===================== ============================================================================= =================
    Name                  Definition                                                                    Example or result
    ===================== ============================================================================= =================
    \_ARRAY               Return an array with all available key-value pairs for debugging purposes
    HTTP_ACCEPT_LANGUAGE  language(s) accepted by client
    HTTP_HOST             [host][:[port]]                                                               :samp:`example.org:8080`
    HTTP_REFERER          [scheme]://[host][:[port]][path]                                              :samp:`https://example.org:8080/typo3/32/temp/phpcheck/index.php/arg1/arg2/arg3/?arg1,arg2,arg3&p1=parameter1&p2[key]=value`
    HTTP_USER_AGENT       client user agent
    PATH_INFO             [path_info]                                                                   :samp:`/arg1/arg2/arg3/`
    QUERY_STRING          [query]                                                                       :samp:`arg1,arg2,arg3&p1=parameter1&p2[key]=value`
    REMOTE_ADDR           client IP
    REMOTE_HOST           client host
    REQUEST_URI           [path]?[query]                                                                :samp:`/typo3/32/temp/phpcheck/index.php/arg1/arg2/arg3/?arg1,arg2,arg3&p1=parameter1&p2[key]=value`
    SCRIPT_FILENAME       absolute filename of script
    SCRIPT_NAME           [path_script]                                                                 :samp:`/typo3/32/temp/phpcheck/[index.php]`
    TYPO3_DOCUMENT_ROOT   absolute path of root of documents
    TYPO3_HOST_ONLY       [host]                                                                        :samp:`example.org`
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

..  _data-type-gettext-getindpenv-example:

Example: Get the remote address
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    # get and output the client IP
    page = PAGE
    page.10 = TEXT
    page.10.stdWrap.data = getIndpEnv : REMOTE_ADDR
    page.10.stdWrap.htmlSpecialChars = 1

..  _data-type-gettext-global:

global
------

..  confval:: global
    :name: data-global
    :Syntax: global : [variable]

    Deprecated. Use :ref:`data-type-gettext-gp`, :ref:`data-type-gettext-tsfe` or
    :ref:`data-type-gettext-getenv`.

..  _data-type-gettext-gp:

GP
--

..  confval:: GP
    :name: data-gp
    :Syntax: GP : [Value from GET or POST method]

    Get a variable from :php:`$_GET` or :php:`$_POST` when a variable, which
    exists in both arrays, is returned from :php:`$_POST`.

..  _data-type-gettext-gp-example:

Example: Get the input value from query string
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get input value from query string `&stuff=...`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = GP : stuff

Get input value from query string `&stuff[bar]=...`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = GP : stuff | bar

..  _data-type-gettext-level:

level
-----

..  confval:: level
    :name: data-level

    Get the root line level of the current page.

..  _data-type-gettext-level-example:

Example: Get the root line level of the current page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = level

..  _data-type-gettext-levelfield:

levelfield
----------

..  confval:: levelfield
    :name: data-levelfield
    :Syntax: levelfield : [pointer, integer], [field name], ["slide"]

    Like :ref:`data-type-gettext-leveltitle` but you can choose which field should
    be fetched from the record.

..  _data-type-gettext-levelfield-example:

Example: Get a field from a page up the root-line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the value of user-defined field :sql:`tx_myextension_myfield` in the root line.

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    lib.foo.data = levelfield : -1, tx_myextension_myfield, slide

..  versionchanged:: 13.2

    Until TYPO3 v13 it was required to do additional configuration in
    :ref:`$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] <t3coreapi:typo3ConfVars_fe_addRootLineFields>` to
    use custom fields.

    To stay compatible with both TYPO3 v12 and v13, add the following to your
    extension's :file:`ext_localconf.php`:

    ..  literalinclude:: _Data/_addRootlineFields_ext_localconf.php
        :caption: EXT:my_extension/ext_localconf.php

..  _data-type-gettext-levelmedia:

levelmedia
----------

..  confval:: levelmedia
    :name: data-levelmedia
    :Syntax: levelmedia : [pointer, integer], ["slide"]


    Get the media field of a page in the root-line.

    *   Use an absolute level: 0 or a positive integer.
    *   Negative integers determine x levels up.
    *   The slide parameter slides until there is a non-empty value.

..  _data-type-gettext-leveltitle:

leveltitle
----------

..  confval:: leveltitle
    :name: data-leveltitle
    :Syntax: leveltitle : [pointer, integer], ["slide"]

    Get the title of a page in the root-line.

    *   Use an absolute level: 0 or a positive integer.
    *   Negative integers determine x levels up
    *   The slide parameter slides until there is a non-empty value.

Example: Get the title of a page up the root line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the title of the page on the first level of the root line:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = leveltitle : 1

Get the title of the page on the level immediately below the current. If
it is empty, walk to the bottom of the root line until there is a
title:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = leveltitle : -2, slide

..  _data-type-gettext-leveluid:

leveluid
--------

..  confval:: leveluid
    :name: data-leveluid
    :Syntax: leveluid : [pointer, integer]

    Get the UID of a page in the root line.

    *   Use an absolute level: 0 or a positive integer.
    *   Negative integers determine x levels up.

..  _data-type-gettext-leveluid-example:

Example: Get the ID of the root page of the page tree
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the ID of the root page of the website (level zero):

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = leveluid : 0


..  _data-type-gettext-lll:

LLL
---

..  confval:: LLL
    :name: data-lll
    :Syntax: LLL: [fileref]:[labelkey]

    Reference to a locallang label (:ref:`XLIFF <t3coreapi:xliff>`). Reference consists of
    [fileref]:[labelkey]

Example: Get a localized label
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the localized label for the logout button:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = LLL : EXT:felogin/Resources/Private/Language/locallang.xlf:logout

..  _data-type-gettext-page:

page
----

..  confval:: page
    :name: data-page
    :Syntax: page: [field in the current page record]

    Get the specified field from the current page

..  _data-type-gettext-page-example:

Example: Get the current page title
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = page : title

..  _data-type-gettext-pagelayout:

pagelayout
----------

..  confval:: pagelayout
    :name: data-pagelayout

    Get the current backend layout.

..  _data-type-gettext-pagelayout-example:

Example: Get the current backend layout
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = pagelayout

..  _data-type-gettext-parameters:

parameters
----------

..  confval:: parameters
    :name: data-parameters
    :Syntax: parameters: [field name from the current :php:`$cObj->parameters` array in the cObject.]

    Get the content of a key in the :php:`parameters` array of the current cObject.

..  _data-type-gettext-parameters-examples:

Example: Get the parameter `color`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get content from :php:`$cObj->parameters['color']`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = parameters : color

..  _data-type-gettext-path:

path
----

..  confval:: path
    :name: data-path

    Path to a file, for example, that is in an extension. Returns an empty value if the file
    does not exist.

..  _data-type-gettext-path-example:

Example: Resolve the path to a file
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get path to file `rsaauth.js` (inside extension rsaauth) relative to siteroot:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = path : EXT:rsaauth/resources/rsaauth.js

It can also be helpful in combination with the stdWrap function
:ref:`stdwrap-insertData`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.headerData.10 = TEXT
    page.headerData.10 {
        data = path : EXT:site/Resources/Public/Images/logo.png
        wrap = <a href="|">
    }

..  _data-type-gettext-register:

register
--------

..  confval:: register
    :name: data-register
    :Syntax: register: [field name from the :php:`$GLOBALS['TSFE']->register`]

    See :ref:`LOAD_REGISTER <cobj-load-register>`.

..  _data-type-gettext-register-example:

Example: Get the content of a register
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get content from a :ref:`register <using-setting-register>`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = register : color


..  _data-type-gettext-request:

request
-------

..  versionadded:: 12.4

..  confval:: request
    :name: data-request
    :Syntax: request : [attribute] | [property] ( | [subproperty] | ... )

    Retrieve the property of a
    :ref:`PSR-7 request attribute <t3coreapi:request-attributes>`.

    Only scalar properties can be retrieved: int, float, string or
    bool values. If the property is an object or an array, a subproperty can
    be used to call the getter method of the object or retrieve the
    key of the array.

..  _data-type-gettext-request-example-page-type:

Example: Get the page type
~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = request : routing | pageType

..  _data-type-gettext-request-example-queryArguments:

Example: Get a query argument
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    # Retrieve the value of the query parameter ?myParam=<value>
    lib.foo.data = request : routing | queryArguments | myParam

    # Retrieve the value of the query parameter ?tx_myext[key]=<value>
    lib.foo.data = request : routing | queryArguments | tx_myext | key

..  _data-type-gettext-request-example-nonce:

Example: Get the nonce
~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = request : nonce | value


..  _data-type-gettext-session:

session
-------

..  confval:: session
    :name: data-session
    :Syntax: session : [key]

    The `key` is the session key used to store a value.

..  _data-type-gettext-session-example:

Example: Get a value stored in the current session
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the number of items of a stored shopping cart array/object:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = session : shop_cart | itemCount


..  _data-type-site:

site
----

..  confval:: site
    :name: data-site
    :Syntax: site : [key]

    Accesses the current
    :ref:`site configuration <t3coreapi:sitehandling-basics>`.

    .. rubric:: Possible keys:

    :typoscript:`attributes`
        Additional parameters configured for this site.

    :typoscript:`base`
        The base URL for this site.

    :typoscript:`baseVariants`
        The base variants of this site.

    :typoscript:`rootPageId`
        The root page ID of this site.

    :typoscript:`identifier`
        The identifier (name) of this site configuration.

    :typoscript:`websiteTitle`
        The website title of this site.

..  _data-type-site-example:

Example: Get values from the current site
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10 = TEXT
    page.10.data = site:base
    page.10.wrap = This is your base URL: |

:typoscript:`site` is the keyword, and the parts after the colon are the
configuration key(s) to access.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10 = TEXT
    page.10.data = site:customConfigKey.nested.value


..  _data-type-siteLanguage:

siteLanguage
------------

..  confval:: siteLanguage
    :name: data-siteLanguage
    :Syntax: siteLanguage : [key]

    Accesses the current
    :ref:`site language configuration <t3coreapi:sitehandling-addingLanguages>`.


    .. rubric:: Possible keys:

    :typoscript:`attributes`
        Additional parameters configured for this site language.

    :typoscript:`base`
        The base URL for this language.

    :typoscript:`flagIdentifier`
        The flag key (for example, `gb` or `fr`) used in the TYPO3 backend.

        :typoscript:`flag` can be used to match the site
        configuration setting.

    :typoscript:`hreflang`
        The language tag for this language defined by RFC 1766 / 3066
        :html:`hreflang` attributes.

        This option is not relevant for regular websites without
        rendering hreflang tag.

    :typoscript:`languageId`
        The language mapped to the ID of the site language.

    :typoscript:`locale`
        ..  versionchanged:: 12.3
            The :typoscript:`locale` property in typoscript can be subdivided
            using subkeys separated by a colon `:`.
            The subkeys `languageCode`, `countryCode`, and `full` allow access
            to the individual components of the :typoscript:`locale` value. For
            instance, a :typoscript:`locale` value of "en_US.UTF-8" can be
            broken down into "en", "US", and for the `full` subkey, "en-US".

            *   :typoscript:`languageCode`: this contains the two-letter
                language code (previously
                :typoscript:`siteLanguage:twoLetterIsoCode`)
            *   :typoscript:`countryCode`: contains the uppercase country code
                part of the locale
            *   :typoscript:`full`: contains the entire locale (this is also the default
                if no subkey is specified)

        The :typoscript:`locale` property represents the language, country, and
        character encoding settings for TYPO3. It is a composite value, such as
        "en_US.UTF-8", which can be dissected into different components via
        subkeys for more precise language and location specifications.

    :typoscript:`navigationTitle`
        The label used in language menus.

    :typoscript:`title`
        The label used in TYPO3 to identify the language.

    :typoscript:`typo3Language`
        The prefix for TYPO3's language files (`default` for English), otherwise
        one of TYPO3's internal language keys. Previously configured via
        TypoScript :typoscript:`config.language = fr`.

    :typoscript:`websiteTitle`
        The website title for this language. Note: there is no automatic fallback to the
        :typoscript:`site:websiteTitle`.

..  _data-type-siteLanguage-example:

Example: Get values from the current site language
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10 = TEXT
    page.10.data = siteLanguage:navigationTitle
    page.10.wrap = This is the title of the current site language: |

    page.20 = TEXT
    page.20.dataWrap = The current site language's locale is {siteLanguage:locale}

    # Website title for the current language with fallback
    # to the website title of the site configuration.
    page.30 = TEXT
    page.30.data = siteLanguage:websiteTitle // site:websiteTitle

..  _data-type-siteSettings:

siteSettings
------------

..  confval:: siteSettings
    :name: data-siteSettings

    Access the :ref:`site settings <t3coreapi:sitehandling-settings>` of the
    current site.

..  _data-type-siteSettings-example:

Example: Access the redirects HTTP status code
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10 = TEXT
    page.10.data = siteSettings:redirects.httpStatusCode


..  _data-type-gettext-tsfe:

TSFE
----

..  confval:: TSFE
    :name: data-tsfe
    :Syntax: TSFE: [value from the :php:`$GLOBALS['TSFE']` array, multi-dimensional]

    Returns a value from
    :php:`TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController`.


..  versionchanged:: 13.0
    The following TypoScriptFrontendController (TSFE) properties have
    been removed:

    *   :php:`spamProtectEmailAddresses`
    *   :php:`intTarget`
    *   :php:`extTarget`
    *   :php:`fileTarget`
    *   :php:`baseUrl`

    Migrate these properties to the config property. You can access the
    TypoScript properties directly, for example, via
    :typoscript:`lib.something.data = TSFE : config | config | fileTarget`


..  _data-type-gettext-tsfe-example:

Example: Get the username field of the current frontend user
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = TSFE : fe_user | user | username
