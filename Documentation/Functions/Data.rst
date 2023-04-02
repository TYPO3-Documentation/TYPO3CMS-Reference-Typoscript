.. include:: /Includes.rst.txt
.. index:: Function; getText
.. _data-type-gettext:

==============
Data / getText
==============

:aspect:`Data type:`
    getText

:aspect:`Description:`
    The getText data type is some kind of tool box allowing to retrieve
    values from a variety of sources, e.g. from GET/POST variables, from
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
    in a multidimensional array. This e.g. works with :typoscript:`TSFE`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.foo.data = TSFE : fe_user|user|username

    Some codes work with a different separator, which is documented right at the
    code.
    Spaces around the colon (:typoscript:`:`) are irrelevant. The :typoscript:`key` is
    case-insensitive.

    By separating the value of getText with :typoscript:`//` (double slash) a number of
    codes can be supplied and getText will return the first one, which is not
    empty ("" or zero).

    To get the content of the field "header". If "header is empty, "title" is
    retrieved. If "title" is empty as well, it finally gets the field "uid":

    .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = field : header // field : title // field : uid


.. contents::
   :local:

Properties
==========

.. _data-type-gettext-cobj:

cObj
====

:aspect:`getText Key:`
   cObj

:aspect:`Description:`
   For :ref:`cobj-content` and :ref:`cobj-records` cObjects that are returned by
   a select query, this returns the row number (1,2,3,...) of the current
   cObject record.

   :typoscript:`parentRecordNumber` is the only key available.

:aspect:`Example:`
   Get the number of the current cObject record:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = cObj : parentRecordNumber

.. _data-type-gettext-context:

context
=======

:aspect:`getText Key:`
   context

:aspect:`Description:`
   access values from context API (:ref:`see <t3coreapi:context-api>`).
   If a property is an array, it is converted into a comma-separated list.

   Syntax:

   .. code-block:: none
      :caption: TypoScript Syntax

      lib.foo.data = context:<aspectName>:<propertyName>

:aspect:`Example:`
   Retrieve current workspace id:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10 = TEXT
      page.10.data = context:workspace:id
      page.10.wrap = You are in workspace: |

.. _data-type-gettext-current:

current
=======

:aspect:`getText Key:`
   current

:aspect:`Description:`
   current (gets the "current" value)

   .. What is the "current" value? We should explain that.

:aspect:`Example:`
   Get the current value:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = current

.. _data-type-gettext-date:

date
====

:aspect:`getText Key:`
   date

:aspect:`Description:`
   Can be used with a colon and :t3-data-type:`date-conf`.

:aspect:`Default:`
   :typoscript:`d/m Y`

:aspect:`Example:`
   Get the current time formatted dd-mm-yy:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = date : d-m-y

.. _data-type-gettext-db:

DB
==
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
   :sql:`tt_content`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = DB : tt_content:234:header

   Get the value of the header field of a record, whose uid is stored in a GET
   parameter `myContentId`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data.dataWrap = DB : tt_content:{GP : myContentId}:header

   .. note::
      It is safe to directly use a client-/user-provided input for the id of a DB
      record here. The function :php:`ContentObjectRenderer->getData` internally
      calls the function :php:`PageRepository->getRawRecord`, which converts the
      parameter to int via :php:`QueryBuilder->createNamedParameter`

.. _data-type-gettext-debug:

debug
=====

:aspect:`getText Key:`
   debug

:aspect:`Description:`
   Returns HTML-formatted content of the PHP variable defined by the keyword.
   Available keywords are :typoscript:`rootLine`, :typoscript:`fullRootLine`, :typoscript:`data`,
   :typoscript:`register` and :typoscript:`page`.

:aspect:`Example:`
   Outputs the current root-line visually in HTML:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = debug : rootLine

.. _data-type-gettext-field:

field
=====

:aspect:`getText Key:`
   field

:aspect:`Syntax:`
   field : [field name from the current :php:`$cObj->data` array in the cObject, multi-dimensional.]

:aspect:`Description:`
   This gives read access to the current value of an internal global variable determined by the given key.

   - As default the :php:`$cObj->data` array is :php:`$GLOBALS['TSFE']->page`
     (record of the current page)

   - In :ref:`TMENU <tmenu>` :php:`$cObj->data` is set in a loop to the page-record for
     each menu item during its rendering process.

   - In :ref:`cobj-content` / :ref:`cobj-records` :php:`$cObj->data` is set to
     the actual record

   - In :ref:`GIFBUILDER <gifbuilder>` :php:`$cObj->data` is set to the data
     :ref:`GIFBUILDER <gifbuilder>` is supplied with.

:aspect:`Examples:`
   Get content from :php:`$cObj->data['header']`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = field : header

   Get content from :php:`$cObj->data['fieldname']['level1']['level2']`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = field : fieldname|level1|level2

.. _data-type-gettext-file:

file
====

:aspect:`getText Key:`
   file

:aspect:`Syntax:`
   file : [uid] : [property]

:aspect:`Description:`
   Retrieves a property from a file object (FAL) by identifying it through its
   sys\_file UID. Note that during execution of the :ref:`cobj-files` cObject,
   it's also possible to reference the current file with "current" as UID like
   :typoscript:`file : current : size`.

   The following properties are available: name, uid, originalUid, size, sha1,
   extension, mimetype, contents, publicUrl, modification_date, creation_date

   Furthermore when manipulating references (such as images in content elements
   or media in pages), additional properties are available (not all are
   available all the time, it depends on the setup of *references* of the
   :ref:`cobj-files` cObject): title, description, link, alternative.

   Additionally, any data in the "sys_file_metadata" table can be accessed too.

   See the :ref:`FILES <cobj-files-examples>` cObject for usage examples.

:aspect:`Example:`
   Get the file size of the file with the sys\_file UID 17:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = file : 17 : size

.. _data-type-gettext-flexform:

flexform
========

:aspect:`getText Key:`
   flexform

:aspect:`Syntax:`
   flexform : [field containing flexform data].[property of this flexform]

:aspect:`Description:`
   Access values from flexforms, e.g. inside of tt_content record. In contrast
   to most parts, deeper levels are accessed through dots, not pipes.

:aspect:`Example:`
   Return the flexform value of given name:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = flexform : pi_flexform:settings.categories

.. _data-type-gettext-fullrootline:

fullRootLine
============

:aspect:`getText Key:`
   fullRootLine

:aspect:`Syntax:`
   fullRootLine : [pointer, integer], [field name], ["slide"]

:aspect:`Description:`
   This property can be used to retrieve values from "above" the current page's
   root. Take the below page tree and assume that we are on the page "Here you
   are!". Using the :ref:`data-type-gettext-levelfield` property, it is possible
   to go up only to the page "Site root", because it is the root of a new
   (sub-)site.  With :typoscript:`fullRootLine` it is possible to go all the way up to page
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
   Get the title of the page right before the start of the current website:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = fullRootLine : -1, title

.. _data-type-gettext-getenv:

getenv
======

:aspect:`getText Key:`
   getenv

:aspect:`Description:`
   Value from PHP environment variables.

   For a cached variation of this feature, please refer to :ref:`getEnv <getenv>`.

:aspect:`Example:`
   Get the env var `HTTP_REFERER`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = getenv : HTTP_REFERER

.. _data-type-gettext-getindpenv:

getIndpEnv
==========
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

:aspect:`Example:`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # get and output the client IP
      page = PAGE
      page.10 = TEXT
      page.10.stdWrap.data = getIndpEnv : REMOTE_ADDR
      page.10.stdWrap.htmlSpecialChars = 1

.. _data-type-gettext-global:

global
======

:aspect:`getText Key:`
   global

:aspect:`Syntax:`
   global : [variable]

:aspect:`Description:`
   Deprecated, use :ref:`data-type-gettext-gp`, :ref:`data-type-gettext-tsfe` or
   :ref:`data-type-gettext-getenv`.

.. _data-type-gettext-gp:

GP
==
:aspect:`getText Key:`
   GP

:aspect:`Syntax:`
   GP : [Value from GET or POST method]

:aspect:`Description:`
   Get an variable from :php:`$_GET` or :php:`$_POST` where a variable, which
   exists in both arrays, is returned from :php:`$_POST`.

:aspect:`Examples:`
   Get input value from query string &stuff=...

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = GP : stuff

   Get input value from query string &stuff[bar]=...

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = GP : stuff|bar

.. _data-type-gettext-level:

level
=====

:aspect:`getText Key:`
   level

:aspect:`Description:`
   Get the root line level of the current page.

:aspect:`Example:`
   Get the root line level of the current page:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = level

.. _data-type-gettext-levelfield:

levelfield
==========

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
   field. In order that you can use this function, your fieldname 'user_myExtField' needs be included in the comma
   separated list of ['addRootLineFields']:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = levelfield : -1, user_myExtField, slide

.. _data-type-gettext-levelmedia:
.. _data-type-gettext-leveluid:
.. _data-type-gettext-leveltitle:

leveltitle, leveluid, levelmedia
================================
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
   Get the title of the page on the first level of the root line:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = leveltitle : 1

   Get the title of the page on the level right below the current page AND if
   that is not present, walk to the bottom of the root line until there's a
   title:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = leveltitle : -2, slide

   Get the id of the root-page of the website (level zero):

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = leveluid : 0

.. _data-type-gettext-lll:

LLL
===

:aspect:`getText Key:`
   LLL

:aspect:`Description:`
   LLL: Reference to a locallang (xlf, xml or php) label.  Reference consists of
   [fileref]:[labelkey]

:aspect:`Example:`
   Get localized label for logout button:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = LLL : EXT:felogin/pi1/locallang.xlf:logout

.. _data-type-gettext-page:

page
====

:aspect:`getText Key:`
   page

:aspect:`Description:`
   page: [field in the current page record]

:aspect:`Example:`
   Get the current page title:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = page : title

.. _data-type-gettext-pagelayout:

pagelayout
==========
:aspect:`getText Key:`
   pagelayout

:aspect:`Description:`
   pagelayout

:aspect:`Example:`
   Get the current backend layout:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = pagelayout

.. _data-type-gettext-parameters:

parameters
==========

:aspect:`getText Key:`
   parameters

:aspect:`Syntax:`
   parameters: [field name from the current :php:`$cObj->parameters` array in the cObject.]

:aspect:`Description:`
   See :ref:`parsefunc`.

   .. Why is parsefunc useful here?

:aspect:`Example:`
   Get content from :php:`$cObj->parameters['color']`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = parameters : color

.. _data-type-gettext-path:

path
====

:aspect:`getText Key:`
   path

:aspect:`Description:`
   Path to a file, possibly placed in an extension, returns empty if the file
   does not exist.

:aspect:`Example:`
   Get path to file rsaauth.js (inside extension rsaauth) relative to siteroot:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = path : EXT:rsaauth/resources/rsaauth.js

   It can also be helpful in combination with
   :ref:`stdWrap.insertData <stdwrap-insertdata>`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.headerData.10 = TEXT
      page.headerData.10 {
        value = <link rel="preload" href="{path : EXT:site/Resources/Public/Fonts/Roboto.woff2}" as="font" type="font/woff2" crossorigin="anonymous">
        insertData = 1
      }

.. _data-type-gettext-register:

register
========

:aspect:`getText Key:`
   register

:aspect:`Syntax`
   register: [field name from the :php:`$GLOBALS['TSFE']->register`]

:aspect:`Description:`
   See :ref:`LOAD_REGISTER <cobj-load-register>`.

:aspect:`Example:`
   Get content from :php:`$GLOBALS['TSFE']->register['color']`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = register : color

.. _data-type-gettext-session:

session
=======

:aspect:`getText Key:`
   session

:aspect:`Syntax:`
   session : [key]

:aspect:`Description:`
   The :typoscript:`key` refers to the session key used to store the value.

:aspect:`Example:`
   Get the number of items of a stored shopping cart array/object:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = session : shop_cart|itemCount


..  _data-type-site:

site
====

:aspect:`Data type:`
    site

:aspect:`Description:`
    Accessing the current
    :ref:`site configuration <t3coreapi:sitehandling-basics>`.

:aspect:`Possible values:`
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

:aspect:`Example:`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.data = site:base
        page.10.wrap = This is your base URL: |

    Where :typoscript:`site` is the keyword for accessing an aspect, and the
    following parts are the configuration key(s) to access.

    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.data = site:customConfigKey.nested.value


..  _data-type-siteLanguage:

siteLanguage
============

:aspect:`Data type:`
    siteLanguage

:aspect:`Description:`
    Accessing the current
    :ref:`site language configuration <t3coreapi:sitehandling-addingLanguages>`.

:aspect:`Possible values:`
    :typoscript:`attributes`
        Additional parameters configured for this site language.

    :typoscript:`base`
        The base URL for this language.

    :typoscript:`direction`
        The direction for this language.

    :typoscript:`flagIdentifier`
        The flag key (like `gb` or `fr`) used to be used in the TYPO3 backend.

    :typoscript:`hreflang`
        The language tag for this language defined by RFC 1766 / 3066 for
        :html:`lang` and :html:`hreflang` attributes

    :typoscript:`languageId`
        The language mapped to the ID of the site language.

    :typoscript:`locale`
        The locale, like `de_CH` or `en_GB`.

    :typoscript:`navigationTitle`
        The label to be used within language menus.

    :typoscript:`title`
        The label to be used within TYPO3 to identify the language.

    :typoscript:`twoLetterIsoCode`
        The ISO-639-1 code for this language (two letters).

    :typoscript:`typo3Language`
        The prefix for TYPO3's language files (`default` for English), otherwise
        one of TYPO3's internal language keys. Previously configured via
        TypoScript :typoscript:`config.language = fr`.

    :typoscript:`websiteTitle`
        The website title for this language. No automatic fallback to the
        :typoscript:`site:websiteTitle`!

:aspect:`Example:`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10 = TEXT
        page.10.data = siteLanguage:navigationTitle
        page.10.wrap = This is the title of the current site language: |

        page.20 = TEXT
        page.20.dataWrap = The current site language direction is {siteLanguage:direction}

        # Website title for the current language with fallback
        # to the website title of the site configuration.
        page.30 = TEXT
        page.30.data = siteLanguage:websiteTitle // site:websiteTitle

.. _data-type-gettext-tsfe:

TSFE
====

:aspect:`getText Key:`
   TSFE

:aspect:`Syntax:`
   TSFE: [value from the :php:`$GLOBALS['TSFE']` array, multi-dimensional]

:aspect:`Description:`
   Returns a value from
   :php:`TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController`.

:aspect:`Example:`
   Get the "username" field of the current FE user:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.foo.data = TSFE : fe_user|user|username
