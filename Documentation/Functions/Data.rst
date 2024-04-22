..  include:: /Includes.rst.txt
..  index:: Function; getText
..  _data-type-gettext:

==============
Data / getText
==============

The `getText` data type is some kind of tool box allowing to retrieve
values from a variety of sources, for example from `GET`/`POST` variables, from
registers, values from the page tree, items in the page menus, records
from any database table, etc.

The general syntax is as follows:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = <key> : <code>

where :typoscript:`<key>` indicates the source and :typoscript:`<code>` is some form of path or
pointer to the value, which depends on the key used. The various keys and
their possible codes are described below.

The :typoscript:`code` can contain pipe characters :typoscript:`|` to separate keys
in a multidimensional array. This, for example, works with :typoscript:`TSFE`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = TSFE : fe_user | user | username

Some codes work with a different separator, which is documented right at the
code.
Spaces around the colon (:typoscript:`:`) are irrelevant. The :typoscript:`key` is
case-insensitive.

By separating the value of getText with :typoscript:`//` (double slash) a number of
codes can be supplied and getText will return the first one, which is not
empty ("" or zero).

To get the content of the field "header". If "header is empty, "title" is
retrieved. If "title" is empty as well, it finally gets the field "uid":

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
    as string.


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

    current (gets the "current" value)

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

    Value from database. Any record from a table in TCA can be selected here.
    Records marked as deleted will not return any value.

    In contrast to other keys, colons are used here to get deeper into the
    structure, instead of pipes.

..  _data-type-gettext-db-example:

Example: Get a header field value of a record
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the value of the header field of record with uid 234 from table
:sql:`tt_content`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = DB : tt_content:234:header

Get the value of the header field of a record, whose uid is stored in a GET
parameter `myContentId`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data.dataWrap = DB : tt_content:{GP : myContentId}:header

..  note::
    It is safe to directly use a client-/user-provided input for the id of a DB
    record here. The function :php:`ContentObjectRenderer->getData()` internally
    calls the function :php:`PageRepository->getRawRecord()`, which converts the
    parameter to int via :php:`QueryBuilder->createNamedParameter()`

..  _data-type-gettext-debug:

debug
-----


..  confval:: debug
    :name: data-debug

    Returns HTML-formatted content of the PHP variable defined by the keyword.
    Available keywords are :typoscript:`rootLine`, :typoscript:`fullRootLine`, :typoscript:`data`,
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
    :Syntax: field : [field name from the current :php:`$cObj->data` array in the cObject, multi-dimensional.]


    This gives read access to the current value of an internal global variable determined by the given key.

    -   As default the :php:`$cObj->data` array is :php:`$GLOBALS['TSFE']->page`
        (record of the current page)

    -   In :ref:`TMENU <tmenu>` :php:`$cObj->data` is set in a loop to the page-record for
        each menu item during its rendering process.

    -   In :ref:`cobj-content` / :ref:`cobj-records` :php:`$cObj->data` is set to
        the actual record

    -   In :ref:`GIFBUILDER <gifbuilder>` :php:`$cObj->data` is set to the data
        :ref:`GIFBUILDER <gifbuilder>` is supplied with.

..  _data-type-gettext-field-example:

Example: Get header data
~~~~~~~~~~~~~~~~~~~~~~~~

Get content from :php:`$cObj->data['header']`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = field : header

Example: Get data of a field
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
    it is also possible to reference the current file with :confval:`data-current` as UID like
    :typoscript:`file : current : size`.

    The following properties are available: name, uid, originalUid, size, sha1,
    extension, mimetype, contents, publicUrl, modification_date, creation_date

    Furthermore when manipulating references (such as images in content elements
    or media in pages), additional properties are available (not all are
    available all the time, it depends on the setup of *references* of the
    :ref:`cobj-files` cObject): title, description, link, alternative.

    Additionally, any data in the :sql:`sys_file_metadata` table can be accessed too.

    See the :ref:`FILES <cobj-files-examples>` cObject for usage examples.

..  _data-type-gettext-file-example:

Example: Get the size of a file
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the file size of the file with the sys\_file UID 17:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = file : 17 : size

..  _data-type-gettext-flexform:

flexform
--------

..  confval:: flexform
    :name: data-flexform
    :Syntax: flexform : [field containing flexform data].[property of this flexform]

    Access values from :ref:`FlexForms <t3coreapi:flexforms>`, for example inside of :sql:`tt_content` record. In contrast
    to most parts, deeper levels are accessed through dots, not pipes.

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

This property can be used to retrieve values from "above" the current page's
root. Take the below page tree and assume that we are on the page "Here you
are!". Using the :ref:`data-type-gettext-levelfield` property, it is possible
to go up only to the page "Site root", because it is the root of a new
(sub-)site.  With :typoscript:`fullRootLine` it is possible to go all the way up to page
tree root. The numbers between square brackets indicate to which page each
value of *pointer* would point to:

..  code-block:: text

    - Page tree root [-2]
      |- 1. page before [-1]
        |- Site root (root template here!) [0]
          |- Here you are! [1]

A "slide" parameter can be added just as for the
:ref:`data-type-gettext-levelfield` property.

..  _data-type-gettext-fullrootline-example:

Example: Get the title of the previous page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the title of the page right before the start of the current website:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = fullRootLine : -1, title

..  _data-type-gettext-getenv:

getenv
------

..  confval:: getenv
    :name: data-getenv

    Value from PHP environment variables.

    For a cached variation of this feature, please refer to :ref:`getEnv <getenv>`.

..  _data-type-gettext-getenv-example:

Example: Get the HTTP referer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the environment variable `HTTP_REFERER`:

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

    Deprecated, use :ref:`data-type-gettext-gp`, :ref:`data-type-gettext-tsfe` or
    :ref:`data-type-gettext-getenv`.

..  _data-type-gettext-gp:

GP
--

..  confval:: GP
    :name: data-gp
    :Syntax: GP : [Value from GET or POST method]

    Get a variable from :php:`$_GET` or :php:`$_POST` where a variable, which
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

    Like :ref:`data-type-gettext-leveltitle` but the field do be fetched from the
    record is configurable.

..  _data-type-gettext-levelfield-example:

Example: Get a field from a page up in the root-line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the value of the user-defined field :sql:`tx_myextension_myfield` in the root line.

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    lib.foo.data = levelfield : -1, tx_myextension_myfield, slide

Requires additional configuration in
:ref:`$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] <t3coreapi:typo3ConfVars_fe_addRootLineFields>` to include
field. In order that you can use this function, your field name
:sql:`tx_myextension_myfield` needs be included in the comma
separated list of ['addRootLineFields']:

..  code-block:: php
    :caption: EXT:my_extension/ext_localconf.php

    $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',tx_myextension_myfield';

..  _data-type-gettext-levelmedia:

levelmedia
----------

..  confval:: levelmedia
    :name: data-levelmedia
    :Syntax: levelmedia : [pointer, integer], ["slide"]


    Get the media field of a page in the root-line.

    *   Use an absolute level with 0 or a positive integer.
    *   With a negative integer got x levels up
    *   The slide parameter slides until there is a non-empty value found.

..  _data-type-gettext-leveltitle:

leveltitle
----------

..  confval:: leveltitle
    :name: data-leveltitle
    :Syntax: leveltitle : [pointer, integer], ["slide"]

    Get the title of a page in the root-line.

    *   Use an absolute level with 0 or a positive integer.
    *   With a negative integer got x levels up
    *   The slide parameter slides until there is a non-empty value found.

Example: Get the title of a page up in the root line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Get the title of the page on the first level of the root line:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = leveltitle : 1

Get the title of the page on the level right below the current page AND if
that is not present, walk to the bottom of the root line until there's a
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

    *   Use an absolute level with 0 or a positive integer.
    *   With a negative integer got x levels up

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

    Get the current backend layout

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

    Get the content of a key in :php:`parameters` array of the current cObject.

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

    Path to a file, possibly placed in an extension, returns empty if the file
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

Get content from the :ref:`register <using-setting-register>`:

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

    Note that only scalar properties can be retrieved: int, float, string or
    bool as value. If the property is an object or an array, a subproperty can
    be given which then calls the getter method of the object or retrieves the
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

    The `key` refers to the session key used to store the value.

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

    Accessing the current
    :ref:`site configuration <t3coreapi:sitehandling-basics>`.

    .. rubric:: Possible keys:

    :typoscript:`attributes`
        Additional parameters configured for this site.

    :typoscript:`base`
        The base URL for this site.

    :typoscript:`baseVariants`
        The base variants for this site.

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

Where :typoscript:`site` is the keyword for accessing an aspect, and the
following parts are the configuration key(s) to access.

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

    Accessing the current
    :ref:`site language configuration <t3coreapi:sitehandling-addingLanguages>`.


    .. rubric:: Possible keys:

    :typoscript:`attributes`
        Additional parameters configured for this site language.

    :typoscript:`base`
        The base URL for this language.

    :typoscript:`flagIdentifier`
        The flag key (like `gb` or `fr`) used in the TYPO3 backend.

        ..  versionadded:: 12.4
            You can also use :typoscript:`flag` to match the corresponding site
            configuration setting.

    :typoscript:`hreflang`
        ..  versionchanged:: 12.4
            This option is not relevant anymore for regular websites without
            rendering hreflang tag, but is now customizable, and has a proper
            fallback.

        The language tag for this language defined by RFC 1766 / 3066 for
        :html:`hreflang` attributes

    :typoscript:`languageId`
        The language mapped to the ID of the site language.

    :typoscript:`locale`
        The locale, like `de_CH` or `en_GB`.

    :typoscript:`navigationTitle`
        The label to be used within language menus.

    :typoscript:`title`
        The label to be used within TYPO3 to identify the language.

    :typoscript:`typo3Language`
        The prefix for TYPO3's language files (`default` for English), otherwise
        one of TYPO3's internal language keys. Previously configured via
        TypoScript :typoscript:`config.language = fr`.

    :typoscript:`websiteTitle`
        The website title for this language. No automatic fallback to the
        :typoscript:`site:websiteTitle`!

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

..  versionadded:: 12.1

..  confval:: siteSettings
    :name: data-siteSettings

    Access the :ref:`site settings <t3coreapi:sitehandling-settings>` for the
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
    The following properties within TypoScriptFrontendController (TSFE) have
    been removed:

    *   :php:`spamProtectEmailAddresses`
    *   :php:`intTarget`
    *   :php:`extTarget`
    *   :php:`fileTarget`
    *   :php:`baseUrl`

    Migrate these properties to use the config property. You can access the
    TypoScript properties directly, for example, via
    :typoscript:`lib.something.data = TSFE : config | config | fileTarget`


..  _data-type-gettext-tsfe-example:

Example: Get the username field of the current frontend user
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.foo.data = TSFE : fe_user | user | username
