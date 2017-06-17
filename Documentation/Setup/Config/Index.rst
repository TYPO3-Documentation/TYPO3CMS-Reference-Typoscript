.. include:: ../../Includes.txt

.. _config:

config
======

In typo3/sysext/frontend/Classes/ this is known as
$GLOBALS['TSFE']->config['config'], thus the property "debug" below is
accessible as $GLOBALS['TSFE']->config['config']['debug'].

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ===================================================== ================================== ======================================================================
   Property                                              Data Type                          Default
   ===================================================== ================================== ======================================================================
   `absRefPrefix`_                                       :ref:`data-type-string`
   `additionalHeaders`_                                  array with numeric indices
   `admPanel`_                                           :ref:`data-type-boolean`
   `ATagParams`_                                         *<A>-params*
   `baseURL`_                                            :ref:`data-type-string`
   `beLoginLinkIPList`_                                  [IP-number]
   `beLoginLinkIPList\_login`_                           :ref:`data-type-html-code`
   `beLoginLinkIPList\_logout`_                          :ref:`data-type-html-code`
   `cache`_                                              array
   `cache\_clearAtMidnight`_                             :ref:`data-type-boolean`           false
   `cache\_period`_                                      :ref:`data-type-integer`           86400 *(= 24 hours)*
   `compensateFieldWidth`_                               double
   `compressCss`_                                        :ref:`data-type-boolean`
   `compressJs`_                                         :ref:`data-type-boolean`
   `concatenateCss`_                                     :ref:`data-type-boolean`
   `concatenateJs`_                                      :ref:`data-type-boolean`
   `concatenateJsAndCss`_                                :ref:`data-type-boolean`           0
   `content\_from\_pid\_allowOutsideDomain`_             :ref:`data-type-boolean`
   `contentObjectExceptionHandler`_                      array
   `debug`_                                              :ref:`data-type-boolean`
   `defaultGetVars`_                                     array
   `disableAllHeaderCode`_                               :ref:`data-type-boolean`           false
   `disableBodyTag`_                                     :ref:`data-type-boolean`           0
   `disableCharsetHeader`_                               :ref:`data-type-boolean`
   `disableImgBorderAttr`_                               :ref:`data-type-boolean`
   `disablePageExternalUrl`_                             :ref:`data-type-boolean`
   `disablePrefixComment`_                               :ref:`data-type-boolean`
   `disablePreviewNotification`_                         :ref:`data-type-boolean`           0
   `disableLanguageHeader`_                              :ref:`data-type-boolean`           0
   `doctype`_                                            :ref:`data-type-string`
   `doctypeSwitch`_                                      boolean / string
   `enableContentLengthHeader`_                          :ref:`data-type-boolean`           1
   `extTarget`_                                          :ref:`data-type-target`            \_top
   `fileTarget`_                                         :ref:`data-type-target`
   `forceTypeValue`_                                     :ref:`data-type-integer`
   `formMailCharset`_                                    :ref:`data-type-string`
   `ftu`_                                                :ref:`data-type-boolean`           false
   `headerComment`_                                      :ref:`data-type-string`
   `htmlTag\_dir`_                                       :ref:`data-type-string`
   `htmlTag\_langKey`_                                   :ref:`data-type-string`            en
   `htmlTag\_setParams`_                                 :ref:`data-type-string`
   `htmlTag\_stdWrap`_                                   :ref:`stdwrap`
   `index\_descrLgd`_                                    :ref:`data-type-integer`           200
   `index\_enable`_                                      :ref:`data-type-boolean`
   `index\_externals`_                                   :ref:`data-type-boolean`
   `index\_metatags`_                                    :ref:`data-type-boolean`           true
   `inlineStyle2TempFile`_                               :ref:`data-type-boolean`
   `intTarget`_                                          :ref:`data-type-target`
   `language`_                                           :ref:`data-type-string`
   `language\_alt`_                                      :ref:`data-type-string`
   `linkVars`_                                           :ref:`data-type-list`
   `locale\_all`_                                        :ref:`data-type-string`
   `lockFilePath`_                                       :ref:`data-type-string`            fileadmin/
   `message\_page\_is\_being\_generated`_                :ref:`data-type-string`
   `message\_preview`_                                   :ref:`data-type-string`
   `message\_preview\_workspace`_                        :ref:`data-type-string`
   `metaCharset`_                                        :ref:`data-type-string`            utf-8
   `moveJsFromHeaderToFooter`_                           :ref:`data-type-boolean`
   `MP\_defaults`_                                       :ref:`data-type-string`
   `MP\_disableTypolinkClosestMPvalue`_                  :ref:`data-type-boolean`
   `MP\_mapRootPoints`_                                  list of PIDs/string
   `namespaces`_                                         *(array of strings)*
   `no\_cache`_                                          :ref:`data-type-boolean`           0
   `noPageTitle`_                                        :ref:`data-type-integer`           0
   `pageGenScript`_                                      :ref:`data-type-resource`          typo3/sysext/frontend/Classes/Page/PageGenerator.php
   `pageRendererTemplateFile`_                           :ref:`data-type-string`
   `pageTitle`_                                          :ref:`stdWrap`
   `pageTitleFirst`_                                     :ref:`data-type-boolean`           0
   `pageTitleSeparator`_                                 string /:ref:`stdWrap <stdwrap>`   ": " *(colon with following space)*
   `removeDefaultCss`_                                   :ref:`data-type-boolean`
   `removeDefaultJS`_                                    boolean / string
   `removePageCss`_                                      :ref:`data-type-boolean`
   `sendCacheHeaders`_                                   :ref:`data-type-boolean`
   `sendCacheHeaders\_onlyWhenLoginDeniedInBranch`_      :ref:`data-type-boolean`
   `setJS\_mouseOver`_                                   :ref:`data-type-boolean`
   `setJS\_openPic`_                                     :ref:`data-type-boolean`
   `spamProtectEmailAddresses`_                          "ascii" /
   `spamProtectEmailAddresses\_atSubst`_                 :ref:`data-type-string`            (at)
   `spamProtectEmailAddresses\_lastDotSubst`_            :ref:`data-type-string`            . *(just a simple dot)*
   `sword\_noMixedCase`_                                 :ref:`data-type-boolean`
   `sword\_standAlone`_                                  :ref:`data-type-boolean`
   `sys\_language\_isocode`_                             :ref:`data-type-string`
   `sys\_language\_isocode\_default`_                    :ref:`data-type-string`
   `sys\_language\_mode`_                                :ref:`data-type-string`
   `sys\_language\_overlay`_                             boolean / keyword
   `sys\_language\_softExclude`_                         :ref:`data-type-string`
   `sys\_language\_softMergeIfNotBlank`_                 :ref:`data-type-string`
   `sys\_language\_uid`_                                 :ref:`data-type-integer`
   `titleTagFunction`_                                   function name
   `tx\_[extension key with no underscores]\_[\*]`_      \-
   `typolinkCheckRootline`_                              :ref:`data-type-boolean`
   `typolinkEnableLinksAcrossDomains`_                   :ref:`data-type-boolean`           0
   `typolinkLinkAccessRestrictedPages`_                  integer (page id) / keyword "NONE"
   `typolinkLinkAccessRestrictedPages\_addParams`_       :ref:`data-type-string`
   `USERNAME\_substToken`_                               :ref:`data-type-string`            <!--###USERNAME###-->
   `USERUID\_substToken`_                                :ref:`data-type-string`
   `xhtmlDoctype`_                                       :ref:`data-type-string`
   `xmlprologue`_                                        :ref:`data-type-string`
   ===================================================== ================================== ======================================================================

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

.. ### BEGIN~OF~TABLE ###



.. _setup-config-absrefprefix:

absRefPrefix
""""""""""""

.. container:: table-row

   Property
         absRefPrefix

   Data type
         string

   Description
         If this value is set, then all relative links in TypoScript are
         prepended with this string.

         **Examples:**

         1. Prefixing all links with a "/" results in absolute link paths::

              config.absRefPrefix = /

         2. Prefixing all links with the path to a subdirectory::

              config.absRefPrefix = /some-subsite/

         3. Prefixing all links with a URI scheme::

              config.absRefPrefix = http://example.com/

         **Special keyword:** "auto" lets TYPO3 autodetect the site root based
         on path prefixes (and not based on host name variables from the
         server, making this value safe for multi-domain environments).

         **Note:** Using an URI in absRefPrefix will require additional conditions
         if you use different domains for your deployment stages in CI environments.

         **Note:** If you're working on a server where you have different domain
         names or different path segments leading to the same page (e.g. for internal
         and external access), you might do yourself a favor and set absRefPrefix to
         the URL and path of your site, e.g. https://typo3.org/. If you do not,
         you risk to render pages to cache from the internal network and thereby
         prefix image-references and links with a wrong path or a path not accessible
         from outside.



.. _setup-config-additionalheaders:

additionalHeaders
"""""""""""""""""

.. container:: table-row

   Property
         additionalHeaders

   Data type
         array with numeric indices

   Description
         This property can be used to define additional HTTP headers.

         For each numeric index, there are the following sub-properties:

         **header:** The header string.

         **replace:** Optional. If set, previous headers with the same name
         are replaced with the current one. Default is "1".

         **httpResponseCode:** Optional. HTTP status code as an integer.

         **Example**::

            config.additionalHeaders {
               10 {
                  # The header string
                  header = WWW-Authenticate: Negotiate

                  # Do not replace previous headers with the same name.
                  replace = 0

                  # Force a 401 HTTP response code
                  httpResponseCode = 401
               }
               # Always set cache headers to private, overwriting the default TYPO3 Cache-control header
               20.header = Cache-control: Private
            }

         By default TYPO3 sends a "Content-Type" header with the defined
         encoding, unless this is disabled using config.disableCharsetHeader
         (see above). It then sends cache headers, if configured (see above).
         Then come the additional headers, plus finally a "Content-Length"
         header, if enabled (see below).



.. _setup-config-admpanel:

admPanel
""""""""

.. container:: table-row

   Property
         admPanel

   Data type
         boolean

   Description
         If set, the admin panel appears in the bottom of pages.

         **Note:** In addition the panel must be enabled for the user as well,
         using the TSconfig for the user! See the TSconfig reference about
         additional admin panel properties.



.. _setup-config-atagparams:

ATagParams
""""""""""

.. container:: table-row

   Property
         ATagParams

   Data type
         *<A>-params*

   Description
         Additional parameters to all links in TYPO3 (excluding menu-links).



.. _setup-config-baseurl:

baseURL
"""""""

.. container:: table-row

   Property
         baseURL

   Data type
         string

   Description
         This writes the <base> tag in the header of the document. Set this to
         the value that is expected to be the URL and append a "/" to the end
         of the string.

         **Example**::

            config.baseURL = http://typo3.org/sub_dir/



.. _setup-config-beloginlinkiplist:

beLoginLinkIPList
"""""""""""""""""

.. container:: table-row

   Property
         beLoginLinkIPList

   Data type
         [IP-number]

   Description
         If set and REMOTE\_ADDR matches one of the listed IP-numbers (Wild-
         card, \*, allowed) then a link to the typo3/ login script with redirect
         pointing back to the page is shown.

         **Note:** beLoginLinkIPList\_login and/or beLoginLinkIPList\_logout
         (see below) must be defined if the link should show up!



.. _setup-config-beloginlinkiplist-login:

beLoginLinkIPList\_login
""""""""""""""""""""""""

.. container:: table-row

   Property
         beLoginLinkIPList\_login

   Data type
         HTML

   Description
         HTML code wrapped with the login link, see 'beLoginLinkIPList'

         **Example**::

            <hr /><b>LOGIN</b>



.. _setup-config-beloginlinkiplist-logout:

beLoginLinkIPList\_logout
"""""""""""""""""""""""""

.. container:: table-row

   Property
         beLoginLinkIPList\_logout

   Data type
         HTML

   Description
         HTML code wrapped with the logout link, see above



.. _setup-config-cache:

cache
"""""

.. container:: table-row

   Property
         cache

   Data type
         array

   Description
         Determine the maximum cache lifetime of a page.

         The maximum cache lifetime of a page can not only be determined by the
         start and stop times of content elements on the page itself, but also
         by arbitrary records on any other page. However, the page has to be
         configured so that TYPO3 knows the start and stop times of which
         records to include. Otherwise, the cache entry will be used although a
         start/stop date already passed by.

         To include records of type <table name> on page <pid> into the cache
         lifetime calculation of page <page-id>, add the following TypoScript:

         config.cache.<page-id> = <table name>:<pid>

         Multiple record sources can be added as comma-separated list, see the
         examples.

         You can use the keyword "all" instead of a <page-id> to consider
         records for the cache lifetime of all pages.

         **Examples**::

            config.cache.10 = fe_users:2

         This includes the fe\_users records on page 2 in the cache lifetime
         calculation for page 10::

            config.cache.10 = fe_users:2,tt_news:11

         This includes records from multiple sources, namely the fe\_users
         records on page 2 and the tt\_news records on page 11::

            config.cache.all = fe_users:2

         Consider the fe\_user records on page 2 for the cache lifetime of all
         pages.



.. _setup-config-cache-clearatmidnight:

cache\_clearAtMidnight
""""""""""""""""""""""

.. container:: table-row

   Property
         cache\_clearAtMidnight

   Data type
         boolean

   Description
         With this setting the cache always expires at midnight of the day, the
         page is scheduled to expire.

   Default
         false



.. _setup-config-cache-period:

cache\_period
"""""""""""""

.. container:: table-row

   Property
         cache\_period

   Data type
         integer

   Description
         The number of second a page may remain in cache.

         This value is overridden by the value set in the page-record
         (field="cache\_timeout") if this value is greater than zero.

   Default
         86400 *(= 24 hours)*



.. _setup-config-compensatefieldwidth:

compensateFieldWidth
""""""""""""""""""""

.. container:: table-row

   Property
         compensateFieldWidth

   Data type
         double

   Description
         This floating point value will be used by the FORMS cObject to
         compensate the length of the form fields text and input.

         This option may be overridden by the property of the same name in
         the FORMS cObject.



.. _setup-config-compresscss:

compressCss
"""""""""""

.. container:: table-row

   Property
         compressCss

   Data type
         boolean

   Description
         If set, CSS files referenced in page.includeCSS and the like will be
         minified and compressed. Does not work on files, which are referenced
         in page.headerData.

         Minification will remove all excess space. The more significant
         compression step (using gzip compression) requires
         $TYPO3\_CONF\_VARS['FE']['compressionLevel'] to be enabled in the
         Install Tool. For this to work you also need to activate the gzip-
         related compressionLevel options in .htaccess, as otherwise the
         compressed files will not be readable by the user agent.

         **Example**::

            config.compressCss = 1

         **Note:** TYPO3 comes with a built-in compression handler, but you can
         also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['cssCompressHandler'].

         **Example**::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssCompressHandler.php:tx_myext_cssCompressHandler->compressCss';

   Default
         0



.. _setup-config-compressjs:

compressJs
""""""""""

.. container:: table-row

   Property
         compressJs

   Data type
         boolean

   Description
         Enabling this option together with
         $TYPO3\_CONF\_VARS['FE']['compressionLevel'] in the Install Tool
         delivers Frontend JavaScript files referenced in page.includeJS and
         the like using GZIP compression. Does not work on files, which are
         referenced in page.headerData.

         This can significantly reduce file sizes of linked JavaScript files
         and thus decrease loading times.

         Please note that this requires .htaccess to be adjusted, as otherwise
         the files will not be readable by the user agent. Please see the
         description of $TYPO3\_CONF\_VARS['FE']['compressionLevel'] in the
         Install Tool.

         **Example**::

            config.compressJs = 1

         **Note:** TYPO3 comes with a built-in compression handler, but you can
         also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['jsCompressHandler'].

         **Example**::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsCompressHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsCompressHandler.php:tx_myext_jsCompressHandler->compressJs';

   Default
         0



.. _setup-config-concatenatecss:

concatenateCss
""""""""""""""

.. container:: table-row

   Property
         concatenateCss

   Data type
         boolean

   Description
         Setting config.concatenateCss merges Stylesheet files referenced in
         the Frontend in page.includeCSS and the like together. Files are merged
         only, if their media attribute has the same value, e.g. if it is "all"
         for several files. Does not work on files, which are referenced in
         page.headerData.

         **Example**::

            config.concatenateCss = 1

         **Note:** TYPO3 comes with a built-in concatenation handler, but you
         can also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['cssConcatenateHandler'].

         **Example**::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssConcatenateHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssConcatenateHandler.php:tx_myext_cssConcatenateHandler->concatenateCss';

   Default
         0



.. _setup-config-concatenatejs:

concatenateJs
"""""""""""""

.. container:: table-row

   Property
         concatenateJs

   Data type
         boolean

   Description
         Setting config.concatenateJs merges JavaScript files referenced in
         the Frontend in page.includeJS and the like together. Does not work
         on files, which are referenced in page.headerData.

         **Example**::

            config.concatenateJs = 1

         **Note:** TYPO3 comes with a built-in concatenation handler, but you
         can also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['jsConcatenateHandler'].

         **Example**::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsConcatenateHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsConcatenateHandler.php:tx_myext_jsConcatenateHandler->concatenateJs';

   Default
         0



.. _setup-config-concatenatejsandcss:

concatenateJsAndCss
"""""""""""""""""""

.. container:: table-row

   Property
         concatenateJsAndCss

   Data type
         boolean

   Description
         Setting config.concatenateJsAndCss bundles JS and CSS files in the FE.

         **Example**::

            config.concatenateJsAndCss = 1

         **Note:** TYPO3 comes with a built-in concatenation handler, but you
         can also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['concatenateHandler'].

         **Example**::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['concatenateHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_concatenateHandler.php:tx_myext_concatenateHandler->concatenateFiles';

         **Note:** This property was deprecated and is planned to be removed!
         Use config.concatenateJs and config.concatenateCss instead.

   Default
         0



.. _setup-config-content-from-pid-allowoutsidedomain:

content\_from\_pid\_allowOutsideDomain
""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
      content\_from\_pid\_allowOutsideDomain

   Data type
      boolean

   Description
      Using the "Show content from this page instead" feature allows you to
      insert content from the current domain only. Setting this option will
      allow content included from anywhere in the page tree!

      Another use case is mount points: By means of the page type "Mount Point" you can virtually
      insert a whole subtree from somwhere else by just pointing to it. However, usually this
      only works within the page tree of the given domain. Setting :ts:`config.content_from_pid_allowOutsideDomain = 1`
      removes that restriction.

Keywords: mountpoint



.. _setup-config-contentObjectExceptionHandler:

contentObjectExceptionHandler
"""""""""""""""""""""""""""""

.. container:: table-row

   Property
         contentObjectExceptionHandler

   Data type
         array

   Description
         Exceptions which occur during rendering of content objects (typically plugins)
         will now be caught by default in production context and an error message
         is shown along with the rendered output.

         If this is done, the page will remain available while the section of the page
         that produces an error (i.e. throws an exception) will show a configurable error message.
         By default this error message contains a random code which references
         the exception and is also logged by the logging framework for developer reference.

         **Usage**

         .. code-block:: typoscript

            # Use 1 for the default exception handler (enabled by default in production context)
            config.contentObjectExceptionHandler = 1

            # Use a class name for individual exception handlers
            config.contentObjectExceptionHandler = TYPO3\CMS\Frontend\ContentObject\Exception\ProductionExceptionHandler

            # Customize the error message. A randomly generated code is replaced within the message if needed.
            config.contentObjectExceptionHandler.errorMessage = Oops an error occurred. Code: %s

            # Configure exception codes which will not be handled, but bubble up again (useful for temporary fatal errors)
            tt_content.login.20.exceptionHandler.ignoreCodes.10 = 1414512813

            # Disable the exception handling for an individual plugin/ content object
            tt_content.login.20.exceptionHandler = 0

            # ignoreCodes and errorMessage can be both configured globally …
            config.contentObjectExceptionHandler.errorMessage = Oops an error occurred. Code: %s
            config.contentObjectExceptionHandler.ignoreCodes.10 = 1414512813

            # … or locally for individual content objects
            tt_content.login.20.exceptionHandler.errorMessage = Oops an error occurred. Code: %s
            tt_content.login.20.exceptionHandler.ignoreCodes.10 = 1414512813


         .. important::

            Instead of breaking the whole page when an exception occurs, an error message
            is shown for the part of the page that is broken.
            Be aware that unlike before, it is now possible that a page with error message gets cached.

            To get rid of the error message not only the actual error needs to be fixed,
            but the cache must be cleared for this page.



.. _setup-config-debug:

debug
"""""

.. container:: table-row

   Property
         debug

   Data type
         boolean

   Description
         If set any debug-information in the TypoScript code is output.
         This applies e.g. to menu objects and the parsetime output.



.. _setup-config-defaultgetvars:

defaultGetVars
""""""""""""""

.. container:: table-row

   Property
         defaultGetVars

   Data type
         array

   Description
         Allows to set default values for GET parameters. Default value is
         taken only if the GET parameter isn't defined. Array notation is done
         with dots, e.g.:

         test[var1] will be written as text.var1

         **Example**::

            config.defaultGetVars {
                test.var1.var2.p3 = 15
                L = 3
            }



.. _setup-config-disableallheadercode:

disableAllHeaderCode
""""""""""""""""""""

.. container:: table-row

   Property
         disableAllHeaderCode

   Data type
         boolean

   Description
         If this is set, none of the features of the PAGE object is processed
         and the content of the page will be the result of the cObject array
         (1,2,3,4...) of the PAGE object. This means that the result of the
         cObject should include everything from the <HTML> .... to the </HTML>
         tag!

         Use this feature in templates supplying other content-types than HTML.
         That could be an image or a WAP-page!

   Default
         false



.. _setup-config-disablebodytag:

disableBodyTag
""""""""""""""

.. container:: table-row

   Property
      disableBodyTag

   Data type`
      boolean

   Description
      If this option is set the TYPO3 core will not generate the
      opening `<body ...>` part of the body tag. The closing `</body>`
      is not affected and will still be issued.

      :ts:`disableBodyTag` takes precedence over the *page* properties
      :ts:`bodyTagCObject`, :ts:`bodyTag`, :ts:`bodyTagMargins` and
      :ts:`bodyTagAdd`. With :ts:`config.disableBodyTag =1` the others are
      ignored and don't have any effect.

   Default
      0 (false)



.. _setup-config-disablecharsetheader:

disableCharsetHeader
""""""""""""""""""""

.. container:: table-row

   Property
         disableCharsetHeader

   Data type
         boolean

   Description
         By default a HTTP header "content-type:text/html; charset..." is sent.
         This option will disable that.



.. _setup-config-disableimgborderattr:

disableImgBorderAttr
""""""""""""""""""""

.. container:: table-row

   Property
         disableImgBorderAttr

   Data type
         boolean

   Description
         Returns the 'border' attribute for an <img> tag only if the doctype is
         not xhtml\_strict or xhtml\_11 or if the config parameter
         'disableImgBorderAttr' is not set



.. _setup-config-disablepageexternalurl:

disablePageExternalUrl
""""""""""""""""""""""

.. container:: table-row

   Property
         disablePageExternalUrl

   Data type
         boolean

   Description
         If set, pages with doktype "External Url" will not trigger jumpUrl in
         TSFE.



.. _setup-config-disableprefixcomment:

disablePrefixComment
""""""""""""""""""""

.. container:: table-row

   Property
         disablePrefixComment

   Data type
         boolean

   Description
         If set, the stdWrap property "prefixComment" will be disabled, thus
         preventing any revealing and space-consuming comments in the HTML
         source code.



.. _setup-config-disablepreviewnotification:

disablePreviewNotification
""""""""""""""""""""""""""

.. container:: table-row

   Property
         disablePreviewNotification

   Data type
         boolean

   Description
         Disables the "preview" notification box completely.

   Default
         0

.. _disableLanguageHeader:

disableLanguageHeader
"""""""""""""""""""""

.. container:: table-row

   Property
         disableLanguageHeader

   Data type
         boolean

   Description
         TYPO3 by default sends a "Content-language: XX" HTTP header,
         where "XX" is the ISO code of the according lanuage.

         For the default language (sys_language_uid=0), this header is based
         on the value of config.sys_language_isocode_default. If this is unset,
         config.language is used. If that is unset as well, it finally falls
         back to "en".

         For other languages, it uses the value from language_isocode from
         sys_language. That value may be overwritten by config.sys_language_isocode.

         If config.disableLanguageHeader is set, this header will not be sent.

   Default
         0

.. _setup-config-doctype:

doctype
"""""""

.. container:: table-row

   Property
         doctype

   Data type
         string

   Description
         If set, then a document type declaration (and an XML prologue) will be
         generated. The value can either be a complete doctype or one of the
         following keywords:

         **xhtml\_trans** for the XHTML 1.0 Transitional doctype.

         **xhtml\_frames** for the XHTML 1.0 Frameset doctype.

         **xhtml\_strict** for the XHTML 1.0 Strict doctype.

         **xhtml\_basic** for the XHTML basic doctype.

         **xhtml\_11** for the XHTML 1.1 doctype.

         **xhtml+rdfa\_10** for the XHTML+RDFa 1.0 doctype.

         **html5** for the HTML5 doctype.

         **none** for *no* doctype at all.

         .. note::

            Keywords also change the way TYPO3 generates some of the
            XHTML tags to ensure valid XML. If you set doctype to a string, then
            you must also set config.xhtmlDoctype (see below).

         See :ref:`config.htmlTag_setParams <setup-config-htmltag-setparams>` and
         :ref:`comfig.htmlTag_langKey <setup-config-htmltag-langkey>` for more
         details on the effect on the HTML tag.

         Default is the HTML 5 doctype:

         .. code-block:: html

            <!DOCTYPE html>


.. _setup-config-doctypeswitch:

doctypeSwitch
"""""""""""""

.. container:: table-row

   Property
         doctypeSwitch

   Data type
         boolean / string

   Description
         If set, the order of <?xml...> and <!DOCTYPE...> will be reversed.
         This is needed for MSIE to be standards compliant with XHTML.

         **Background:**

         By default TYPO3 outputs the XML/DOCTYPE in compliance with the
         standards of XHTML. However a browser like MSIE will still run in
         "quirks-mode" unless the <?xml> and <DOCTYPE> tags are ordered
         opposite. But this breaks CSS validation...

         With this option designers can decide for themselves what they want
         then.

         If you want to check the compatibility-mode of your webbrowser you can
         do so with a simple JavaScript that can be inserted on a TYPO3 page
         like this::

            page.headerData.1 = TEXT
            page.headerData.1.value = <script>alert(document.compatMode);</script>

         If your browser has detected the DOCTYPE correctly it will report
         "CSS1Compat"

         If you are not running in compliance mode you will get some other
         message. MSIE will report "BackCompat" for instance - this means it
         runs in quirks-mode, supporting all the old "browser-bugs".



.. _setup-config-enablecontentlengthheader:

enableContentLengthHeader
"""""""""""""""""""""""""

.. container:: table-row

   Property
         enableContentLengthHeader

   Data type
         boolean

   Description
         If set, a header "content-length: [bytes of content]" is sent.

         If the Backend user is logged in, this is disabled. The reason is
         that the content length header cannot include the length of these
         objects and the content-length will cut off the length of the
         document in some browsers.

   Default
         1


.. _setup-config-exttarget:

extTarget
"""""""""

.. container:: table-row

   Property
         extTarget

   Data type
         target

   Description
         Default external target. Used by typolink if no extTarget is set

   Default
         \_top



.. _setup-config-filetarget:

fileTarget
""""""""""

.. container:: table-row

   Property
         fileTarget

   Data type
         target

   Description
         Default file link target. Used by typolink if no fileTarget is set.



.. _setup-config-forcetypevalue:

forceTypeValue
""""""""""""""

.. container:: table-row

   Property
         forceTypeValue

   Data type
         integer

   Description
         Force the &type value of all TYPO3 generated links to a specific value
         (except if overruled by local forceTypeValue values).

         Useful if you run a template with special content at - say &type=95 -
         but still wants to keep your targets neutral. Then you set your
         targets to blank and this value to the type value you wish.



.. _setup-config-formmailcharset:

formMailCharset
"""""""""""""""

.. container:: table-row

   Property
         formMailCharset

   Data type
         string

   Description
         Character set of mails sent through TYPO3 mail forms. If it is
         unset, the character set defined in config.metaCharset is used.

   Default
         "" *(unset)*



.. _setup-config-ftu:

ftu
"""

.. container:: table-row

   Property
         ftu

   Data type
         boolean

   Description
         If set, the "&ftu=...." GET-fallback identification is inserted.

         "&ftu=[hash]" is always inserted in the links on the first page a user
         hits. If it turns out in the next hit that the user has cookies
         enabled, this variable is not set anymore as the cookies does the job.
         If no cookies is accepted the "ftu" remains set for all links on the
         site and thereby we can still track the user.

         **You should not set this feature if grabber-spiders like Teleport are
         going to grab your site!**

         **You should not set this feature if you want search-engines to index
         your site.**

         You can also ignore this feature if you're certain, website users will
         use cookies.

         "ftu" means fe\_typo\_user ("fe" is "frontend").

   Default
         false



.. _setup-config-headercomment:

headerComment
"""""""""""""

.. container:: table-row

   Property
         headerComment

   Data type
         string

   Description
         The content is added before the "TYPO3 Content Management Framework"
         comment in the <head> section of the page. Use this to insert a note
         like that "Programmed by My-Agency".



.. _setup-config-htmltag-dir:

htmlTag\_dir
""""""""""""

.. container:: table-row

   Property
         htmlTag\_dir

   Data type
         string

   Description
         Sets text direction for whole document (useful for display of Arabic,
         Hebrew pages).

         Basically the value becomes the attribute value of "dir" for the
         <html> tag.

         **Values:**

         rtl = Right-To-Left (for Arabic / Hebrew)

         ltr = Left-To-Right (Default for other languages)

         **Example**::

            config.htmlTag_dir = rtl



.. _setup-config-htmltag-langkey:

htmlTag\_langKey
""""""""""""""""

.. container:: table-row

   Property
         htmlTag\_langKey

   Data type
         string

   Description
         Allows you to set the language value for the attributes "xml:lang" and
         "lang" in the <html> tag (when using "config.doctype = xhtml\*").

         The values must follow the format specified in `IETF RFC 3066
         <http://www.ietf.org/rfc/rfc3066.txt>`_

         **Example**::

            config.htmlTag_langKey = en-US

   Default
         en



.. _setup-config-htmltag-setparams:

htmlTag\_setParams
""""""""""""""""""

.. container:: table-row

   Property
         htmlTag\_setParams

   Data type
         string

   Description
         Sets the attributes for the <html> tag on the page. If you set
         "config.doctype" to a keyword enabling XHTML then some attributes are
         already set. This property allows you to override any preset
         attributes with your own content if needed.

         **Special:** If you set it to "none" then no attributes will be set at
         any event.

         **Example**::

            config.htmlTag_setParams = xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US"



.. _setup-config-htmltag-stdwrap:

htmlTag\_stdWrap
""""""""""""""""

.. container:: table-row

   Property
         htmlTag\_stdWrap

   Data type
         ->stdWrap

   Description
         Modify the whole <html> tag with stdWrap functionality. This can be
         used to extend or override this tag.



.. _setup-config-index-descrlgd:

index\_descrLgd
"""""""""""""""

.. container:: table-row

   Property
         index\_descrLgd

   Data type
         integer

   Description
         This indicates how many chars to preserve as description for an
         indexed page. This may be used in the search result display.

   Default
         200



.. _setup-config-index-enable:

index\_enable
"""""""""""""

.. container:: table-row

   Property
         index\_enable

   Data type
         boolean

   Description
         Enables cached pages to be indexed. *Automatically enabled when
         EXT:indexed_search is enabled.*



.. _setup-config-index-externals:

index\_externals
""""""""""""""""

.. container:: table-row

   Property
         index\_externals

   Data type
         boolean

   Description
         If set, external media linked to on the pages is indexed as well.
         *Automatically enabled when EXT:indexed_search is enabled.*



.. _setup-config-index-metatags:

index\_metatags
"""""""""""""""

.. container:: table-row

   Property
         index\_metatags

   Data type
         boolean

   Description
         This allows to turn on or off the indexing of metatags. It is turned
         on by default.

   Default
         true



.. _setup-config-inlinestyle2tempfile:

inlineStyle2TempFile
""""""""""""""""""""

.. container:: table-row

   Property
         inlineStyle2TempFile

   Data type
         boolean

   Description
         If set, the inline styles TYPO3 controls in the core are written to a
         file, typo3temp/assets/css/stylesheet\_[hashstring].css, and the header
         will only contain the link to the stylesheet.

         The file hash is based solely on the content of the styles.

         **Example**::

            config.inlineStyle2TempFile = 0

   Default
         1



.. _setup-config-inttarget:

intTarget
"""""""""

.. container:: table-row

   Property
         intTarget

   Data type
         target

   Description
         Default internal target. Used by typolink if no target is set



.. _setup-config-language:

language
""""""""

.. container:: table-row

   Property
         language

   Data type
         string

   Description
         Language key. See stdWrap.lang for more information.

         Select between:

         English (default) = [empty]

         Danish = dk

         German = de

         Norwegian = no

         Italian = it

         etc...

         The value must correspond to the key used for the backend system language if
         there is one. See inside typo3/sysext/core/Classes/Localization/Locales.php
         or look at the translation page on typo3.org for the official 2-byte key for
         a given language. Notice that selecting the official key is important if you
         want to get labels in the correct language from "locallang" files.

         If the language you need is not yet a system language in TYPO3 you can
         use an artificial string of your choice and provide values for it via
         the TypoScript template where the property "\_LOCAL\_LANG" for most
         plugins will provide a way to override/add values for labels. The keys
         to use must be looked up in the locallang-file used by the plugin of
         course.



.. _setup-config-language-alt:

language\_alt
"""""""""""""

.. container:: table-row

   Property
         language\_alt

   Data type
         string

   Description
         If "config.language" (above) is used, this can be set to another
         language key which will be used for labels if a label was not found
         for the main language. For instance a brazil portuguese website might
         specify "pt" as alternative language which means the portuguese label
         will be shown if none was available in the main language, brazil
         portuguese. This feature makes sense if one language is incompletely
         translated and close to another language.



.. _setup-config-linkvars:

linkVars
""""""""

.. container:: table-row

   Property
         linkVars

   Data type
         list

   Description
         HTTP\_GET\_VARS, which should be passed on with links in TYPO3. This
         is compiled into a string stored in $GLOBALS['TSFE']->linkVars

         The values are rawurlencoded in PHP.

         You can specify a range of valid values by appending a () after each
         value. If this range does not match, the variable won't be appended to
         links. This is very important to prevent that the cache system gets
         flooded with forged values.

         The range may contain one of these values:

         - **[a]-[b]** -A range of allowed integer values

         - **int** -Only integer values are allowed

         - **[a]\|[b]\|[c]** -A list of allowed strings (whitespaces will be
           removed)

         - **/[regex]/** -Match against a regular expression (PCRE style)

         **Example**::

            config.linkVars = L, print

         This will add "&L=[L-value]&print=[print-value]" to all links in
         TYPO3. ::

            config.linkVars = L(1-3), print

         Same as above, but "&L=[L-value]" will only be added if the current
         value is 1, 2 or 3.

         **Note:** Do **not** include the "type" parameter in the linkVars
         list, as this can result in unexpected behavior.



.. _setup-config-locale-all:

locale\_all
"""""""""""

.. container:: table-row

   Property
         locale\_all

   Data type
         string

   Description
         PHP: setlocale("LC\_ALL", [value]);

         value-examples: deutsch, de\_DE, danish, portuguese, spanish, french,
         norwegian, italian. See www.php.net for other value. Also on linux,
         look at /usr/share/locale/

         TSFE->localeCharset is intelligently set to the assumed charset of the
         locale strings. This is used in stdWrap.strftime to convert locale
         strings to the UTF-8 of the frontend.

         **Example**:

         This will render dates in danish made with stdWrap/strftime::

            locale_all = danish
            locale_all = da_DK

         .. note::

            It is possible to supply a comma-separated list of locales as a fallback chain



.. _setup-config-lockfilepath:

lockFilePath
""""""""""""

.. container:: table-row

   Property
         lockFilePath

   Data type
         string

   Description
         This value affects the functionality of :ref:`stdwrap-filelist` which is
         part of the :ref:`stdWrap` suite.

         Set :ts:`lockFilePath` to the **relative** path of a folder.
         `filelist` will only return values for a folder that starts with the path
         given by :ts:`lockFilePath`.

   Default
         fileadmin/



.. _setup-config-message-page-is-being-generated:

message\_page\_is\_being\_generated
"""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         message\_page\_is\_being\_generated

   Data type
         string

   Description
         Alternative HTML message that appears if a page is being generated.

         Normally when a page is being generated a temporary copy is stored in
         the cache-table with an expire-time of 30 seconds.

         It is possible to use some keywords that are replaced with the
         corresponding values. Possible keywords are: ###TITLE###,
         ###REQUEST\_URI###



.. _setup-config-message-preview:

message\_preview
""""""""""""""""

.. container:: table-row

   Property
         message\_preview

   Data type
         string

   Description
         Alternative message in HTML that appears when the preview function is
         active!



.. _setup-config-message-preview-workspace:

message\_preview\_workspace
"""""""""""""""""""""""""""

.. container:: table-row

   Property
         message\_preview\_workspace

   Data type
         string

   Description
         Alternative message in HTML that appears when the preview function is
         active in a draft workspace. You can use sprintf() placeholders for
         Workspace title (first) and number (second).

         **Examples**::

            config.message_preview_workspace = <div class="previewbox">Displaying workspace named "%s" (number %s)!</div>
            config.message_preview_workspace = <div class="previewbox">Displaying workspace number %2$s named "%1$s"!</div>



.. _setup-config-metacharset:

metaCharset
"""""""""""

.. container:: table-row

   Property
         metaCharset

   Data type
         string

   Description
         Charset used for the output document. For example in the meta tag::

            <meta charset=... />

         It is used for a) HTML meta tag, b) HTTP header (unless disabled with
         .disableCharsetHeader) and c) xhtml prologues (if available).

         If metaCharset is not UTF-8, the output content is
         automatically converted to metaCharset before output and likewise are
         values posted back to the page converted from metaCharset to
         UTF-8 for internal processing. This conversion takes time of
         course so there is another good reason to use the same charset for
         both.

   Default
         utf-8



.. _setup-config-movejsfromheadertofooter:

moveJsFromHeaderToFooter
""""""""""""""""""""""""

.. container:: table-row

   Property
         moveJsFromHeaderToFooter

   Data type
         boolean

   Description
         If set, all JavaScript (includes and inline) will be moved to the
         bottom of the HTML document, which is after the content and before the
         closing body tag.



.. _setup-config-mp-defaults:

MP\_defaults
""""""""""""

.. container:: table-row

   Property
         MP\_defaults

   Data type
         string

   Description
         Allows you to set a list of page id numbers which will always have a
         certain "&MP=..." parameter added.

         **Syntax:**

         [id],[id],... : [MP-var] \| [id],[id],... : [MP-var] \| ...

         **Example**::

            config.MP_defaults = 36,37,48 : 2-207

         This will by default add "&MP=2-207" to all links pointing to pages
         36,37 and 48.



.. _setup-config-mp-disabletypolinkclosestmpvalue:

MP\_disableTypolinkClosestMPvalue
"""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         MP\_disableTypolinkClosestMPvalue

   Data type
         boolean

   Description
         If set, the typolink function will not try to find the closest MP
         value for the id.



.. _setup-config-mp-maprootpoints:

MP\_mapRootPoints
"""""""""""""""""

.. container:: table-row

   Property
      MP\_mapRootPoints

   Data type
      list of PIDs/string

   Description
      Defines a list of ID numbers from which the MP-vars are automatically
      calculated for the branch.

      The result is used just like :ref:`MP\_defaults <setup-config-mp-defaults>` are used to
      find MP-vars if none has been specified prior to the call to
      `TYPO3\CMS\Core\TypoScript\TemplateService::linkData()`.

      You can specify `root` as a special keyword in the list of IDs and
      that will create a map-tree for the whole site (but this may be VERY
      processing intensive if there are many pages!).

      The order of IDs specified may have a significance; Any ID in a branch
      which is processed already (by a previous ID root point) will not be
      processed again.

      The configured IDs have to be the uids of Mount Point pages itself, not the targets.

      .. tip::

         To mount content from parts of the page tree that don't belong to the current
         domain set :ref:`setup-config-content-from-pid-allowoutsidedomain` to true.




.. _setup-config-namespaces:

namespaces
""""""""""

.. container:: table-row

   Property
         namespaces

   Data type
         *(array of strings)*

   Description
         This property enables you to add xml namespaces (xmlns) to the <html>
         tag. This is especially useful if you want to add RDFa or microformats
         to your HTML.

         **Example**::

            config.namespaces.dc = http://purl.org/dc/elements/1.1/
            config.namespaces.foaf = http://xmlns.com/foaf/0.1/

         This configuration will result in an <html> tag like ::

            <html xmlns:dc="http://purl.org/dc/elements/1.1/"
               xmlns:foaf="http://xmlns.com/foaf/0.1/">



.. _setup-config-no-cache:

no\_cache
"""""""""

.. container:: table-row

   Property
         no\_cache

   Data type
         boolean

   Description
         If this is set to true, the page will not be cached. If set to false,
         it's ignored. Other parameters may have set it to true of other
         reasons.

   Default
         -



.. _setup-config-nopagetitle:

noPageTitle
"""""""""""

.. container:: table-row

   Property
         noPageTitle

   Data type
         integer

   Description
         If you only want to have the site name (from the template record) in
         your <title> tag, set this to 1. If the value is 2 then the <title>
         tag is not printed at all.

         Please take note that this tag is required for (X)HTML compliant
         output, so you should only disable this tag if you generate it
         manually already.

   Default
         0



.. _setup-config-pagegenscript:

pageGenScript
"""""""""""""

.. container:: table-row

   Property
         pageGenScript

   Data type
         resource

   Description
         Alternative page generation script for applications using
         \\TYPO3\\CMS\\Frontend\\Http\\RequestHandler for initialization, caching,
         stating and so on. This script is included in the global scope of
         \\TYPO3\\CMS\\Frontend\\Http\\RequestHandler and thus you may include
         libraries here. Always use include\_once for libraries.

         Remember not to output anything from such an included script. **All
         content must be set into $TSFE->content.** Take a look at
         typo3/sysext/frontend/Classes/Page/PageGenerator.php.

         **Note:** This option is ignored if ::

            ['FE']['noPHPscriptInclude'] => 1;

         is set in LocalConfiguration.php.

   Default
         typo3/sysext/frontend/Classes/Page/PageGenerator.php



.. _setup-config-pagerenderertemplatefile:

pageRendererTemplateFile
""""""""""""""""""""""""

.. container:: table-row

   Property
         pageRendererTemplateFile

   Data type
         string

   Description
         Sets the template for page renderer class
         TYPO3\CMS\Core\Page\PageRenderer.

         **Example**::

            pageRendererTemplateFile = fileadmin/test_pagerender.html

   Default
         EXT:core/Resources/Private/Templates/PageRenderer.html


.. _setup-config-pagetitle:

pageTitle
"""""""""

.. container:: table-row

   Property
         pageTitle

   Data type
         :ref:`stdWrap <stdwrap>`

   Description
         stdWrap for the page title. This option will be executed *after* all
         other processing options like config.titleTagFunction and
         config.pageTitleFirst.



.. _setup-config-pagetitlefirst:

pageTitleFirst
""""""""""""""

.. container:: table-row

   Property
         pageTitleFirst

   Data type
         boolean

   Description
         TYPO3 by default prints a title tag in the format "website: page
         title".

         If pageTitleFirst is set (and if the page title is printed), then the
         page title will be printed IN FRONT OF the template title. So it will
         look like "page title: website".

   Default
         0



.. _setup-config-pagetitleseparator:

pageTitleSeparator
""""""""""""""""""

.. container:: table-row

   Property
         pageTitleSeparator

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         The signs which should be printed in the title tag between the website
         name and the page title. If pageTitleSeparator is set, but *no*
         sub-properties are defined, then a space will be added to the end of the
         separator. stdWrap is useful to adjust whitespaces at the beginning and
         the end of the separator.

         **Examples**::

            config.pageTitleSeparator = .

         This produces a title tag with the content "website. page title"::

            config.pageTitleSeparator = -
            config.pageTitleSeparator.noTrimWrap = | | |

         This produces a title tag with the content "website - page title"::

            config.pageTitleSeparator = *
            config.pageTitleSeparator.noTrimWrap = |||

         This produces a title tag with the content "website*page title".

   Default
         : *(colon with following space)*



.. _setup-config-removedefaultcss:

removeDefaultCss
""""""""""""""""

.. container:: table-row

   Property
         removeDefaultCss

   Data type
         boolean

   Description
         Remove CSS generated by :ref:`\_CSS\_DEFAULT\_STYLE
         <setup-plugin-css-default-style>` configuration of extensions.
         (\_CSS\_DEFAULT\_STYLE outputs a set of default styles, just because
         an extension is installed.)



.. _setup-config-removedefaultjs:

removeDefaultJS
"""""""""""""""

.. container:: table-row

   Property
         removeDefaultJS

   Data type
         boolean / string

   Description
         If set, the default JavaScript in the header will be removed.

         The default JavaScript is the decryption function for email addresses.

         **Special case:** If the value is "**external**", then the default
         JavaScript is written to a temporary file and included from that file.
         See "inlineStyle2TempFile" below.

         **Examples**::

            config.removeDefaultJS = external
            config.removeDefaultJS = 1

   Default
         external



.. _setup-config-removepagecss:

removePageCss
"""""""""""""

.. container:: table-row

   Property
         removePageCss

   Data type
         boolean

   Description
         Remove CSS generated by :ref:`\_CSS\_PAGE\_STYLE
         <setup-plugin-css-page-style>` configuration of extensions.
         (\_CSS\_PAGE\_STYLE renders certain styles not just because an
         extension is installed, but only in a special situation. E.g. some
         styles will be output, when a textpic element with an image
         positioned alongside the text is present on the current page.)



.. _setup-config-sendcacheheaders:

sendCacheHeaders
""""""""""""""""

.. container:: table-row

   Property
         sendCacheHeaders

   Data type
         boolean

   Description
         If set, TYPO3 will output cache-control headers to the client based
         mainly on whether the page was cached internally. This feature allows
         client browsers and/or reverse proxies to take load off TYPO3
         websites.

         The conditions for allowing client caching are:

         - page was cached

         - No \*\_INT or \*\_EXT objects were on the page (e.g. USER\_INT)

         - No frontend user is logged in

         - No backend user is logged in

         If these conditions are met, the headers sent are:

         - Last-Modified [SYS\_LASTCHANGED of page id]

         - Expires [expire time of page cache]

         - ETag [md5 of content]

         - Cache-Control: max-age: [seconds til expiretime]

         - Pragma: public

         In case caching is not allowed, these headers are sent to avoid client
         caching:

         - Cache-Control: private

         Notice that enabling the browser caches means you have to consider how
         log files are written. Because when a page is cached on the client it
         will not invoke a request to the webserver, thus not writing the
         request to the log. There should be ways to circumvent these problems
         but they are outside the domain of TYPO3 in any case.

         **Tip:** Enabling cache-control headers might confuse editors seeing
         old content served from the browser cache. "Shift-Reload" will bypass
         both browser- and reverse-proxy caches and even make TYPO3 regenerate
         the page. Teach them that trick!

         Thanks to Ole Tange, www.forbrug.dk for co-authoring this feature.



.. _setup-config-sendcacheheaders-onlywhenlogindeniedinbranch:

sendCacheHeaders\_onlyWhenLoginDeniedInBranch
"""""""""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         sendCacheHeaders\_onlyWhenLoginDeniedInBranch

   Data type
         boolean

   Description
         If this is set, then cache-control headers allowing client caching is
         sent only if user-logins are disabled for the branch. This feature
         makes it easier to manage client caching on sites where you have a
         mixture of static pages and dynamic sections with user logins.

         The background problem is this: In TYPO3 the same URL can show
         different content depending on whether a user is logged in or not. If
         a user is logged in, cache-headers will never allow client caching.
         But if the same URL was visited without a login prior to the login
         (allowing caching) the user will still see the page from cache when
         logged in (and so thinks he is not logged in anyway)! The only general
         way to prevent this is to have a different URL for pages when users
         are logged in.

         Another way to solve the problem is using this option in combination
         with disabling and enabling logins in various sections of the site. In
         the page records ("Advanced" page types) you can disable frontend user
         logins for branches of the page tree. Since many sites only need the
         login in a certain branch of the page tree, disabling it in all other
         branches makes it much easier to use cache-headers in combination with
         logins; Cache-headers should simply be sent when logins are not
         allowed and never be send when logins are allowed! Then there will
         never be problems with logins and same-URLs.



.. _setup-config-setjs-mouseover:

setJS\_mouseOver
""""""""""""""""

.. container:: table-row

   Property
         setJS\_mouseOver

   Data type
         boolean

   Description
         If set, the over() and out() JavaScript functions are forced to be
         included



.. _setup-config-setjs-openpic:

setJS\_openPic
""""""""""""""

.. container:: table-row

   Property
         setJS\_openPic

   Data type
         boolean

   Description
         If set, the openPic JavaScript function is forced to be included



.. _setup-config-spamprotectemailaddresses:

spamProtectEmailAddresses
"""""""""""""""""""""""""

.. container:: table-row

   Property
         spamProtectEmailAddresses

   Data type
         "ascii" /

         -10 to 10

   Description
         If set, then all email addresses in typolinks will be encrypted so
         spam

         bots cannot detect them.

         If you set this value to a number, then the encryption is simply an

         offset of character values. If you set this value to "-2" then all

         characters will have their ASCII value offset by "-2". To make this

         possible, a little JavaScript code is added to every generated web
         page!

         (It is recommended to set the value in the range from -5 to 1 since
         setting it to >= 2 means a "z" is converted to "\|" which is a special
         character in TYPO3 tables syntax – and that might confuse columns in
         tables. Now hardcoded range)

         Alternatively you can set this value to the keyword "ascii". This way
         every

         character of the "mailto:" address will be translated to a Unicode
         HTML

         notation. Have a look at the example to see how this works.

         **Example**:

         mailto:a@b.c will be converted to

         mailto:&#97;&#64;&#98;&#46;&#99;

         The big advantage of this method is that it does not need any
         JavaScript!



.. _setup-config-spamprotectemailaddresses-atsubst:

spamProtectEmailAddresses\_atSubst
""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         spamProtectEmailAddresses\_atSubst

   Data type
         string

   Description
         Substitute label for the at-sign (@).

   Default
         (at)



.. _setup-config-spamprotectemailaddresses-lastdotsubst:

spamProtectEmailAddresses\_lastDotSubst
"""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         spamProtectEmailAddresses\_lastDotSubst

   Data type
         string

   Description
         Substitute label for the last dot in the email address.

         **Example**: (dot)

   Default
         . *(just a simple dot)*



.. _setup-config-sword-nomixedcase:

sword\_noMixedCase
""""""""""""""""""

.. container:: table-row

   Property
         sword\_noMixedCase

   Data type
         boolean

   Description
         Used by the parseFunc-substitution of search Words (sword):

         If set, the words MUST be the exact same case as the search word was.



.. _setup-config-sword-standalone:

sword\_standAlone
"""""""""""""""""

.. container:: table-row

   Property
         sword\_standAlone

   Data type
         boolean

   Description
         Used by the parseFunc-substitution of search Words (sword):

         If set, the words MUST be surrounded by whitespace in order to be
         marked up.



.. _setup-config-sys-language-isocode:

sys\_language\_isocode
""""""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_isocode

   Data type
         string

   Description
        ISO 639-1 language code for the according language. By default this
        is being set by :ts:`TSFE:sys_language_isocode`. The value is derived
        from the ISO code that is stored within the sys_language record.
        You can override the value, which was retrieved that way, with this
        setting.

        The ISO code is also used for the language attribute of the HTML tag.
        Therefore the setting config.htmlTag_langKey is not needed anymore, if
        it is the same as the ISO code.

        See the example at sys\_language\_isocode\_default!


.. _setup-config-sys-language-isocode-default:

sys\_language\_isocode\_default
"""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_isocode\_default

   Data type
         string

   Description
         ISO 639-1 language code for the default language (that is
         :ts:`sys_language_uid = 0`).

         **Example**::

            # Danish by default
            config.sys_language_uid = 0
            config.sys_language_isocode_default = da

            [globalVar = GP:L = 1]
               # ISO code is filled by the respective DB value from sys_language (uid 1)
               config.sys_language_uid = 1

               # You can override this of course
               config.sys_language_isocode = fr

            [GLOBAL]

   Default
         en



.. _setup-config-sys-language-mode:

sys\_language\_mode
"""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_mode

   Data type
         string

   Description
         Setting various modes of handling localization.

         The syntax is "[keyword] ; [value]".

         Possible keywords are:

         [default] - The system will look for a translation of the page (from
         "Alternative Page Language" table) and if it is not found it will fall
         back to the default language and display that.

         **content\_fallback:** Recommended. The system will always operate
         with the selected language even if the page is not translated with a
         page overlay record. This will keep menus etc. translated. However,
         the *content* on the page can still fall back to another language,
         defined by the value of this keyword, e.g. "content\_fallback ; 1,0"
         to fall back to the content of sys\_language\_uid 1 and if that is not
         present either, to default (0).

         **strict:** The system will report an error if the requested
         translation does not exist. Basically this means that all pages with
         gray background in the Web > Info / Localization overview module will
         fail (they would otherwise fall back to default language in one way
         or another).

         **ignore:** The system will stay with the selected language even if
         the page is not translated and there's no content available in this
         language, so you can handle that situation on your own then.

         An in-depth discussion is found in the
         :ref:`Frontend Localization Guide <t3l10n:localization-modes>`.


.. _setup-config-sys-language-overlay:

sys\_language\_overlay
""""""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_overlay

   Data type
         boolean / keyword

   Description
         If set, records from certain tables selected by the CONTENT cObject
         using the "languageField" setting will select the default language (0)
         instead of any language set by sys\_language\_uid /
         sys\_language\_mode. In addition the system will look for a
         translation of the selected record and overlay configured fields.

         The requirements for this is that the table is configured with
         "languageField" and "transOrigPointerField" in the [ctrl] section of
         $GLOBALS['TCA']. Also, exclusion of certain fields can be done with the
         "l10n\_mode" directive in the field-configuration of $GLOBALS['TCA'].

         For backend administration this requires that you configure the
         "Web > Page" module to display content elements accordingly; That each
         default element is shown and next to it any translation found. This
         configuration can be done with Page TSconfig for a section of the
         website using the object path "mod.web\_layout.defLangBinding = 1".

         Keyword:

         **hideNonTranslated:** If this keyword is used a record that has no
         translation will not be shown. The default is that records with no
         translation will show up in the default language.



.. _setup-config-sys-language-softexclude:

sys\_language\_softExclude
""""""""""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_softExclude

   Data type
         string

   Description
         Setting additional "exclude" flags for l10n\_mode in TCA for frontend
         rendering.

         Fields set in this property will override if the same field is set for
         "sys\_language\_softMergeIfNotBlank".



.. _setup-config-sys-language-uid:

sys\_language\_uid
""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_uid

   Data type
         integer

   Description
         This value points to the uid of a record from the "sys\_language"
         table and if set, this means that various parts of the frontend
         display code will select records which are assigned to this language.
         See ->SELECT

         Internally, the value is depending on whether an Alternative Page
         Language record can be found with that language. If not, the value
         will default to zero (default language) except if
         "sys\_language\_mode" is set to a value like "content\_fallback".



.. _setup-config-titletagfunction:

titleTagFunction
""""""""""""""""

.. container:: table-row

   Property
         titleTagFunction

   Data type
         function name

   Description
         Passes the default <title> tag content to this function. No TypoScript
         parameters are passed though.



.. _setup-config-tx-extension-key-with-no-underscores:

tx\_[extension key with no underscores]\_[\*]
"""""""""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         tx\_[extension key with no underscores]\_[\*]

   Data type
         -

   Description
         Configuration space for extensions. This can be used – for example –
         by plugins that need some TypoScript configuration, but that don't
         actually display anything in the frontend (i.e. don't receive their
         configuration as an argument from the frontend rendering process).

         **Example**::

            config.tx_realurl_enable = 1



.. _setup-config-typolinkcheckrootline:

typolinkCheckRootline
"""""""""""""""""""""

.. container:: table-row

   Property
         typolinkCheckRootline

   Data type
         boolean

   Description
         If set, then every "typolink" is checked whether it's linking to a
         page within the current rootline of the site.

         If not, then TYPO3 searches for the first found domain record (without
         redirect) in that rootline from out to in.

         If found (another domain), then that domain is prepended the link, the
         external target is used instead and thus the link jumps to the page in
         the correct domain.



.. _setup-config-typolinkenablelinksacrossdomains:

typolinkEnableLinksAcrossDomains
""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         typolinkEnableLinksAcrossDomains

   Data type
         boolean

   Description
         This option enables to create links across domains using current
         domain's linking scheme.

         If this option is not set, then all cross-domain links will be
         generated as

         "http://domain.tld/index.php?id=12345" (where 12345 is page id).
         Setting this option requires that domains, where pages are linked,
         have the same configuration for:

         \- linking scheme (i.e. all use RealURL or CoolURI but not any
         mixture)

         \- all domains have identical localization settings
         (config.sys\_language\_XXX directives)

         \- all domains have the same set of languages defined

         This option implies "config.typolinkCheckRootline=1", which will be
         activated automatically. Setting value of "config.
         typolinkCheckRootline" inside TS template will have no effect.

         Disclaimer: it must be understood that while link is generated to
         another domain, it is still generated in the context of current
         domain. No side effects are known at the time of writing of this
         documentation but they may exist. If any side effects are found, this
         documentation will be updated to include them.

   Default
         0



.. _setup-config-typolinklinkaccessrestrictedpages:

typolinkLinkAccessRestrictedPages
"""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         typolinkLinkAccessRestrictedPages

   Data type
         integer (page id) / keyword "NONE"

   Description
         If set, typolinks pointing to access restricted pages will still link
         to the page even though the page cannot be accessed. If the value of
         this setting is an integer it will be interpreted as a page id to
         which the link will be directed.

         If the value is "NONE" the original link to the page will be kept
         although it will generate a page-not-found situation (which can of
         course be picked up properly by the page-not-found handler and present
         a nice login form).

         See "showAccessRestrictedPages" for menu objects as well (similar
         feature for menus)

         **Example**::

            config.typolinkLinkAccessRestrictedPages = 29
            config.typolinkLinkAccessRestrictedPages_addParams = &return_url=###RETURN_URL###&pageId=###PAGE_ID###

         Will create a link to page with id 29 and add GET parameters where the
         return URL and original page id is a part of it.



.. _setup-config-typolinklinkaccessrestrictedpages-addparams:

typolinkLinkAccessRestrictedPages\_addParams
""""""""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         typolinkLinkAccessRestrictedPages\_addParams

   Data type
         string

   Description
         See "typolinkLinkAccessRestrictedPages" above



.. _setup-config-username-substtoken:

USERNAME\_substToken
""""""""""""""""""""

.. container:: table-row

   Property
         USERNAME\_substToken

   Data type
         string

   Description
         The is the token used on the page, which should be substituted with
         the current username IF a front-end user is logged in! If no login,
         the substitution will not happen.

   Default
         <!--###USERNAME###-->



.. _setup-config-useruid-substtoken:

USERUID\_substToken
"""""""""""""""""""

.. container:: table-row

   Property
         USERUID\_substToken

   Data type
         string

   Description
         The is the token used on the page, which should be substituted with
         the current users UID IF a front-end user is logged in! If no login,
         the substitution will not happen.

         This value has no default value and only if you specify a value for
         this token will a substitution process take place.



.. _setup-config-xhtmldoctype:

xhtmlDoctype
""""""""""""

.. container:: table-row

   Property
         xhtmlDoctype

   Data type
         string

   Description
         Sets the document type for the XHTML version of the generated page.

         If config.doctype is set to a string then config.xhtmlDoctype must be
         set to one of these keywords:

         **xhtml\_trans** for XHTML 1.0 Transitional doctype.

         **xhtml\_frames** for XHTML 1.0 Frameset doctype.

         **xhtml\_strict** for XHTML 1.0 Strict doctype.

         **xhtml\_basic** for XHTML basic doctype.

         **xhtml\_11** for XHTML 1.1 doctype.

         This is an example to use MathML 2.0 in an XHTML 1.1 document::

            config.doctype (
              <!DOCTYPE html
                  PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN"
                  "http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd">
            )
            config.xhtmlDoctype = xhtml_11

   Default
         *(same as config.doctype if set to a keyword)*



.. _setup-config-xmlprologue:

xmlprologue
"""""""""""

.. container:: table-row

   Property
         xmlprologue

   Data type
         string

   Description
         If empty (not set) then the default XML 1.0 prologue is set, when the
         doctype is set to a known keyword (e.g. xhtml\_11)::

            <?xml version="1.0" encoding="utf-8">

         If set to one of the following keywords then a standard prologue will
         be set:

         **xml\_10:** XML 1.0 prologue (see above)

         **xml\_11:** XML 1.1 prologue

         **none:** The default XML prologue is *not* set.

         Any other string is used as the XML prologue itself.




.. ###### END~OF~TABLE ######
