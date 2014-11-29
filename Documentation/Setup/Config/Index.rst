﻿.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _config:

config
======

In typo3/sysext/frontend/Classes/ (typo3/sysext/cms/tslib/) this is known
as $GLOBALS['TSFE']->config['config'], thus the property "debug" below is
accessible as $GLOBALS['TSFE']->config['config']['debug'].

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ===================================================== ================================== ====================== ======================================================================
   Property                                              Data Type                          :ref:`stdwrap`         Default
   ===================================================== ================================== ====================== ======================================================================
   `absRefPrefix`_                                       :ref:`data-type-string`
   `additionalHeaders`_                                  strings divided by "\|"
   `admPanel`_                                           :ref:`data-type-boolean`
   `ATagParams`_                                         *<A>-params*
   `baseURL`_                                            :ref:`data-type-string`
   `beLoginLinkIPList`_                                  [IP-number]
   `beLoginLinkIPList\_login`_                           :ref:`data-type-html-code`
   `beLoginLinkIPList\_logout`_                          :ref:`data-type-html-code`
   `cache`_                                              array
   `cache\_clearAtMidnight`_                             :ref:`data-type-boolean`                                  false
   `cache\_period`_                                      :ref:`data-type-integer`                                  86400 *(= 24 hours)*
   `compensateFieldWidth`_                               double
   `compressCss`_                                        :ref:`data-type-boolean`
   `compressJs`_                                         :ref:`data-type-boolean`
   `concatenateCss`_                                     :ref:`data-type-boolean`
   `concatenateJs`_                                      :ref:`data-type-boolean`
   `concatenateJsAndCss`_                                :ref:`data-type-boolean`                                  0
   `content\_from\_pid\_allowOutsideDomain`_             :ref:`data-type-boolean`
   `debug`_                                              :ref:`data-type-boolean`
   `defaultGetVars`_                                     array
   `disableAllHeaderCode`_                               :ref:`data-type-boolean`                                  false
   `disableBodyTag`_                                     :ref:`data-type-boolean`                                  0
   `disableCharsetHeader`_                               :ref:`data-type-boolean`
   `disableImgBorderAttr`_                               :ref:`data-type-boolean`
   `disablePageExternalUrl`_                             :ref:`data-type-boolean`
   `disablePrefixComment`_                               :ref:`data-type-boolean`
   `disablePreviewNotification`_                         :ref:`data-type-boolean`                                  0
   `doctype`_                                            :ref:`data-type-string`
   `doctypeSwitch`_                                      boolean / string
   `enableContentLengthHeader`_                          :ref:`data-type-boolean`                                  1
   `extTarget`_                                          :ref:`data-type-target`                                   \_top
   `fileTarget`_                                         :ref:`data-type-target`
   `forceTypeValue`_                                     :ref:`data-type-integer`
   `frameReloadIfNotInFrameset`_                         :ref:`data-type-boolean`
   `ftu`_                                                :ref:`data-type-boolean`                                  false
   `headerComment`_                                      :ref:`data-type-string`
   `htmlTag\_dir`_                                       :ref:`data-type-string`
   `htmlTag\_langKey`_                                   :ref:`data-type-string`                                   en
   `htmlTag\_setParams`_                                 :ref:`data-type-string`
   `htmlTag\_stdWrap`_                                   ->:ref:`stdwrap`
   `includeLibrary`_                                     :ref:`data-type-resource`
   `incT3Lib\_htmlmail`_                                 :ref:`data-type-boolean`
   `index\_descrLgd`_                                    :ref:`data-type-integer`                                  200
   `index\_enable`_                                      :ref:`data-type-boolean`
   `index\_externals`_                                   :ref:`data-type-boolean`
   `index\_metatags`_                                    :ref:`data-type-boolean`                                  true
   `inlineStyle2TempFile`_                               :ref:`data-type-boolean`
   `intTarget`_                                          :ref:`data-type-target`
   `jumpurl\_enable`_                                    :ref:`data-type-boolean`                                  0
   `jumpurl\_mailto\_disable`_                           :ref:`data-type-boolean`                                  0
   `language`_                                           :ref:`data-type-string`
   `language\_alt`_                                      :ref:`data-type-string`
   `linkVars`_                                           :ref:`data-type-list`
   `locale\_all`_                                        :ref:`data-type-string`
   `lockFilePath`_                                       :ref:`data-type-string`                                   fileadmin/
   `mainScript`_                                         :ref:`data-type-string`                                   index.php
   `meaningfulTempFilePrefix`_                           :ref:`data-type-integer`
   `message\_page\_is\_being\_generated`_                :ref:`data-type-string`
   `message\_preview`_                                   :ref:`data-type-string`
   `message\_preview\_workspace`_                        :ref:`data-type-string`
   `metaCharset`_                                        :ref:`data-type-string`                                   value of ".renderCharset"
   `minifyCSS`_                                          :ref:`data-type-boolean`
   `minifyJS`_                                           :ref:`data-type-boolean`
   `moveJsFromHeaderToFooter`_                           :ref:`data-type-boolean`
   `MP\_defaults`_                                       :ref:`data-type-string`
   `MP\_disableTypolinkClosestMPvalue`_                  :ref:`data-type-boolean`
   `MP\_mapRootPoints`_                                  list of PIDs/string
   `namespaces`_                                         *(array of strings)*
   `no\_cache`_                                          :ref:`data-type-boolean`                                  -
   `noPageTitle`_                                        :ref:`data-type-integer`                                  0
   `noScaleUp`_                                          :ref:`data-type-boolean`
   `pageGenScript`_                                      :ref:`data-type-resource`                                 typo3/sysext/frontend/Classes/Page/PageGenerator.php
   `pageRendererTemplateFile`_                           :ref:`data-type-string`
   `pageTitleFirst`_                                     :ref:`data-type-boolean`                                  0
   `pageTitleSeparator`_                                 Until TYPO3 6.0: string                                   : *(colon with following space)*
   `prefixLocalAnchors`_                                 :ref:`data-type-string`
   `removeDefaultCss`_                                   :ref:`data-type-boolean`
   `removeDefaultJS`_                                    boolean / string
   `removePageCss`_                                      :ref:`data-type-boolean`
   `renderCharset`_                                      :ref:`data-type-string`                                   Until TYPO3 4.6: The value of $TYPO3\_CONF\_VARS['BE']['forceCharset']
   `sendCacheHeaders`_                                   :ref:`data-type-boolean`
   `sendCacheHeaders\_onlyWhenLoginDeniedInBranch`_      :ref:`data-type-boolean`
   `setJS\_mouseOver`_                                   :ref:`data-type-boolean`
   `setJS\_openPic`_                                     :ref:`data-type-boolean`
   `simulateStaticDocuments`_                            boolean / string                                          The default is defined by the configuration option
   `simulateStaticDocuments\_addTitle`_                  :ref:`data-type-integer`
   `simulateStaticDocuments\_dontRedirectPathInfoError`_ :ref:`data-type-boolean`
   `simulateStaticDocuments\_noTypeIfNoTitle`_           :ref:`data-type-boolean`
   `simulateStaticDocuments\_pEnc`_                      :ref:`data-type-string`
   `simulateStaticDocuments\_pEnc\_onlyP`_               :ref:`data-type-string`
   `simulateStaticDocuments\_replacementChar`_           :ref:`data-type-string`
   `spamProtectEmailAddresses`_                          "ascii" /
   `spamProtectEmailAddresses\_atSubst`_                 :ref:`data-type-string`                                   (at)
   `spamProtectEmailAddresses\_lastDotSubst`_            :ref:`data-type-string`                                   . *(just a simple dot)*
   `stat`_                                               :ref:`data-type-boolean`                                  true
   `stat\_apache`_                                       :ref:`data-type-boolean`                                  false
   `stat\_apache\_logfile`_                              filename
   `stat\_apache\_niceTitle`_                            boolean / string
   `stat\_apache\_noHost`_                               :ref:`data-type-boolean`
   `stat\_apache\_noRoot`_                               :ref:`data-type-boolean`
   `stat\_apache\_notExtended`_                          :ref:`data-type-boolean`
   `stat\_apache\_pagenames`_                            :ref:`data-type-string`
   `stat\_excludeBEuserHits`_                            :ref:`data-type-boolean`                                  false
   `stat\_excludeIPList`_                                list of strings
   `stat\_IP\_anonymize`_                                :ref:`data-type-boolean`                                  0
   `stat\_IP\_anonymize\_mask\_ipv4`_                    :ref:`data-type-integer`                                  24
   `stat\_IP\_anonymize\_mask\_ipv6`_                    :ref:`data-type-integer`                                  64
   `stat\_logUser`_                                      :ref:`data-type-boolean`                                  1
   `stat\_mysql`_                                        :ref:`data-type-boolean`                                  false
   `stat\_pageLen`_                                      integer (1-100)                                           30
   `stat\_titleLen`_                                     integer (1-100)                                           20
   `stat\_typeNumList`_                                  int/list                                                  0,1
   `sword\_noMixedCase`_                                 :ref:`data-type-boolean`
   `sword\_standAlone`_                                  :ref:`data-type-boolean`
   `sys\_language\_mode`_                                :ref:`data-type-string`
   `sys\_language\_overlay`_                             boolean / keyword
   `sys\_language\_softExclude`_                         :ref:`data-type-string`
   `sys\_language\_softMergeIfNotBlank`_                 :ref:`data-type-string`
   `sys\_language\_uid`_                                 :ref:`data-type-integer`
   `titleTagFunction`_                                   function name
   `tx\_[extension key with no underscores]\_[\*]`_      -
   `typolinkCheckRootline`_                              :ref:`data-type-boolean`
   `typolinkEnableLinksAcrossDomains`_                   :ref:`data-type-boolean`                                  0
   `typolinkLinkAccessRestrictedPages`_                  integer (page id) / keyword "NONE"
   `typolinkLinkAccessRestrictedPages\_addParams`_       :ref:`data-type-string`
   `USERNAME\_substToken`_                               :ref:`data-type-string`                                   <!--###USERNAME###-->
   `USERUID\_substToken`_                                :ref:`data-type-string`
   `xhtml\_cleaning`_                                    :ref:`data-type-string`
   `xhtmlDoctype`_                                       :ref:`data-type-string`
   `xmlprologue`_                                        :ref:`data-type-string`
   ===================================================== ================================== ====================== ======================================================================

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
         prepended with this string. Used to convert relative paths to absolute
         paths.

         **Note:** If you're working on a server where you have both internal
         and external access, you might do yourself a favor and set the
         absRefPrefix to the URL and path of you site, e.g.
         http://www.typo3.org/. If you do not, you risk to render pages to
         cache from the internal network and thereby prefix image-references
         and links with a non-accessible path from outside.



.. _setup-config-additionalheaders:

additionalHeaders
"""""""""""""""""

.. container:: table-row

   Property
         additionalHeaders

   Data type
         strings divided by "\|"

   Description
         This property can be used to define additional HTTP headers. Separate
         each header with a vertical line "\|".

         **Examples:**

         Content-type: text/vnd.wap.wml

         (this will send a content-header for a WAP-site)

         Content-type: image/gif \| Expires: Mon, 25 Jul 2017 05:00:00 GMT

         (this will send a content-header for a GIF-file and an Expires header)

         Location: www.typo3.org

         (This redirects the page to `www.typo3.org <http://www.typo3.org/>`_ )

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
         Additional parameters to all links in TYPO3 (excluding menu-links)

         **Example:**

         To blur links, insert::

            onFocus="blurLink(this)"



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

         If this is set, make sure that "prefixLocalAnchors" is set to "all".

         **Example:** ::

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

         **Example:** ::

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
         (Since TYPO3 4.6) Determine the maximum cache lifetime of a page.

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

         **Examples:** ::

            config.cache.10 = fe_users:2

         This includes the fe\_users records on page 2 in the cache lifetime
         calculation for page 10. ::

            config.cache.10 = fe_users:2,tt_news:11

         This includes records from multiple sources, namely the fe\_users
         records on page 2 and the tt\_news records on page 11. ::

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

         This feature was useful, if the page-option "smallFormFields"
         (removed in TYPO3 6.0) was set. In that case Netscape rendered
         form fields much longer than IE. If you wanted the two browsers
         to display the same size form fields, you could use a value of
         approx "0.6" for netscape-browsers.

         **Example:** ::

            [browser = netscape]
              config.compensateFieldWidth = 0.6
            [global]

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
         (Since TYPO3 4.6) If set, CSS files will be minified and compressed.

         Minification will remove all excess space. The more significant
         compression step (using gzip compression) requires
         $TYPO3\_CONF\_VARS['FE']['compressionLevel'] to be enabled in the
         Install Tool. For this to work you also need to activate the gzip-
         related compressionLevel options in .htaccess, as otherwise the
         compressed files will not be readable by the user agent.

         **Example:** ::

            config.compressCss = 1

         **Note:** TYPO3 comes with a built-in compression handler, but you can
         also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['cssCompressHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssCompressHandler.php:tx_myext_cssCompressHandler->compressCss';

            or before TYPO3 6.0:

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssCompressHandler.php:tx_myext_cssCompressHandler->compressCss';



.. _setup-config-compressjs:

compressJs
""""""""""

.. container:: table-row

   Property
         compressJs

   Data type
         boolean

   Description
         (Since TYPO3 4.6) Enabling this option together with
         $TYPO3\_CONF\_VARS['FE']['compressionLevel'] in the Install Tool
         delivers Frontend JavaScript files using GZIP compression.

         This can significantly reduce file sizes of linked JavaScript files
         and thus decrease loading times.

         Please note that this requires .htaccess to be adjusted, as otherwise
         the files will not be readable by the user agent. Please see the
         description of $TYPO3\_CONF\_VARS['FE']['compressionLevel'] in the
         Install Tool.

         **Example:** ::

            config.compressJs = 1

         **Note:** TYPO3 comes with a built-in compression handler, but you can
         also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['jsCompressHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsCompressHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsCompressHandler.php:tx_myext_jsCompressHandler->compressJs';

            or before TYPO3 6.0:

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsCompressHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsCompressHandler.php:tx_myext_jsCompressHandler->compressJs';



.. _setup-config-concatenatecss:

concatenateCss
""""""""""""""

.. container:: table-row

   Property
         concatenateCss

   Data type
         boolean

   Description
         (Since TYPO3 4.6) Setting config.concatenateCss merges Stylesheet
         files referenced in the Frontend together.

         **Example:** ::

            config.concatenateCss = 1

         **Note:** TYPO3 comes with a built-in concatenation handler, but you
         can also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['cssConcatenateHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssConcatenateHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssConcatenateHandler.php:tx_myext_cssConcatenateHandler->concatenateCss';

            or before TYPO3 6.0:

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssConcatenateHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssConcatenateHandler.php:tx_myext_cssConcatenateHandler->concatenateCss';



.. _setup-config-concatenatejs:

concatenateJs
"""""""""""""

.. container:: table-row

   Property
         concatenateJs

   Data type
         boolean

   Description
         (Since TYPO3 4.6) Setting config.concatenateJs merges JavaScript files
         referenced in the Frontend together.

         **Example:** ::

            config.concatenateJs = 1

         **Note:** TYPO3 comes with a built-in concatenation handler, but you
         can also register your own one using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['jsConcatenateHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsConcatenateHandler'] =
               TYPO3\CMS\Core\Extension\ExtensionManager::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsConcatenateHandler.php:tx_myext_jsConcatenateHandler->concatenateJs';

            or before TYPO3 6.0:

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsConcatenateHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsConcatenateHandler.php:tx_myext_jsConcatenateHandler->concatenateJs';



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

         **Example:** ::

            config.concatenateJsAndCss = 1

         **Note:** There are no default concatenation handlers, which could do
         the concatenation. A custom concatenation handler must be provided and
         registered using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['concatenateHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['concatenateHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_concatenateHandler.php:tx_myext_concatenateHandler->concatenateFiles';

         **Note:** This property was deprecated and has been removed with TYPO3
         6.0! Use config.concatenateJs and config.concatenateCss instead.

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
         Currently this applies only to the menu objects.



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

         **Example:** ::

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

   Data type
         boolean

   Description
         (Since TYPO3 6.1) This option disables <body> tag generation by the
         TYPO3 core. It is useful for extensions like TemplaVoilà, which can
         produce their own <body> tag with additional attributes.

         **Note:** disableBodyTag takes precedence over the page properties
         "bodyTagCObject", "bodyTag", "bgImg", "bodyTagMargins" and
         "bodyTagAdd". If disableBodyTag is set to "1", the others are
         ignored.

   Default
         0



.. _setup-config-disablecharsetheader:

disableCharsetHeader
""""""""""""""""""""

.. container:: table-row

   Property
         disableCharsetHeader

   Data type
         boolean

   Description
         By default a header "content-type:text/html; charset..." is sent. This
         option will disable that.



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
         not xhtml\_strict, xhtml\_11 or xhtml\_2 or if the config parameter
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
         TSFE. This may help you to have external URLs open inside you
         framesets.



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

         **xhtml\_2** for the XHTML 2 doctype.

         **html5** for the HTML5 doctype.

         **none** for *no* doctype at all.

         .. note::

            Keywords also change the way TYPO3 generates some of the
            XHTML tags to ensure valid XML. If you set doctype to a string, then
            you must also set config.xhtmlDoctype(see below).

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

         If a PHP\_SCRIPT\_EXT object is detected on the page or if the Backend
         user is logged in, this is disabled. The reason is that the content
         length header cannot include the length of these objects and the
         content-length will cut off the length of the document in some
         browsers.

   Default
         Until TYPO3 6.1: 0

         Since TYPO3 6.2: 1


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



.. _setup-config-framereloadifnotinframeset:

frameReloadIfNotInFrameset
""""""""""""""""""""""""""

.. container:: table-row

   Property
         frameReloadIfNotInFrameset

   Data type
         boolean

   Description
         If set, then the current page will check if the page object name (e.g.
         "page" or "frameset") exists as "parent.[name]" (e.g. "parent.page")
         and if not the page will be reloaded in top frame. This secures that
         links from search engines to pages inside a frameset will load the
         frameset.

         Works only with type-values different from zero.



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

         **Example:** ::

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

         **Example:** ::

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

         **Example:** ::

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
         (Since TYPO3 4.7) Modify the whole <html> tag with stdWrap
         functionality. This can be used to extend or override this tag.



.. _setup-config-includelibrary:

includeLibrary
""""""""""""""

.. container:: table-row

   Property
         includeLibrary

   Data type
         resource

   Description
         This includes a PHP file.



.. _setup-config-inct3lib-htmlmail:

incT3Lib\_htmlmail
""""""""""""""""""

.. container:: table-row

   Property
         incT3Lib\_htmlmail

   Data type
         boolean

   Description
         Include t3lib/class.t3lib\_htmlmail.php.

         **Note:** This option was deprecated since TYPO3 4.5 and has
         been removed in TYPO3 6.0.



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
         Enables cached pages to be indexed.



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
         file, typo3temp/stylesheet\_[hashstring].css, and the header will only
         contain the link to the stylesheet.

         The file hash is based solely on the content of the styles.

         Depends on the compatibility mode (see the Update wizard under Tools >
         Install):

         *compatibility mode < 4.0: 0*

         *compatibility mode >= 4.0: 1*

         **Example:** ::

            config.inlineStyle2TempFile = 1



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



.. _setup-config-jumpurl-enable:

jumpurl\_enable
"""""""""""""""

.. container:: table-row

   Property
         jumpurl\_enable

   Data type
         boolean

   Description
         jumpUrl is a concept where external links are redirected from the
         index\_ts.php script, which first logs the URL.

   Default
         0



.. _setup-config-jumpurl-mailto-disable:

jumpurl\_mailto\_disable
""""""""""""""""""""""""

.. container:: table-row

   Property
         jumpurl\_mailto\_disable

   Data type
         boolean

   Description
         Disables the use of jumpUrl when linking to email-adresses.

   Default
         0



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
         (in TYPO3 4.7 and 4.6 in t3lib/l10n/class.t3lib_l10n_locales.php and until
         TYPO3 4.5 in t3lib/config\_default.php) or look at the translation page
         on typo3.org for the official 2-byte key for a given language. Notice that
         selecting the official key is important if you want to get labels in the
         correct language from "locallang" files.

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

         **Example:** ::

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
         strings to the renderCharset of the frontend.

         **Example:**

         This will render dates in danish made with stdWrap/strftime::

            locale_all = danish
            locale_all = da_DK



.. _setup-config-lockfilepath:

lockFilePath
""""""""""""

.. container:: table-row

   Property
         lockFilePath

   Data type
         string

   Description
         This is used to lock paths to be "inside" this path.

         Used by "filelist" in stdWrap

   Default
         fileadmin/



.. _setup-config-mainscript:

mainScript
""""""""""

.. container:: table-row

   Property
         mainScript

   Data type
         string

   Description
         This lets you specify an alternative "mainScript" which is the
         document that TYPO3 expects to be the default doc. This is used in
         form-tags and other places where TYPO3 needs to refer directly to the
         main-script of the application

   Default
         index.php



.. _setup-config-meaningfultempfileprefix:

meaningfulTempFilePrefix
""""""""""""""""""""""""

.. container:: table-row

   Property
         meaningfulTempFilePrefix

   Data type
         integer

   Description
         If > 0 TYPO3 will try to create a meaningful prefix of the given
         length for the temporary image files.

         This works with GIFBUILDER files (using content from the GIFBUILDER
         TEXT objects as a base for the prefix), menus (using the title of the
         menu item) and scaled images (using the original filename base).



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

         **Examples:** ::

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

         If renderCharset and metaCharset are different, the output content is
         automatically converted to metaCharset before output and likewise are
         values posted back to the page converted from metaCharset to
         renderCharset for internal processing. This conversion takes time of
         course so there is another good reason to use the same charset for
         both.

   Default
         value of ".renderCharset"



.. _setup-config-minifycss:

minifyCSS
"""""""""

.. container:: table-row

   Property
         minifyCSS

   Data type
         boolean

   Description
         Setting this option will activate CSS minification.

         **Example:** ::

            config.minifyCSS = 1

         **Note:** CSS in external files in the FE will only be minified, if a
         compression handler is registered using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['cssCompressHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_cssCompressHandler.php:tx_myext_cssCompressHandler->minifyCss';

         **Note:** This property was deprecated and has been removed in TYPO3
         6.0. Use config.compressCss instead.



.. _setup-config-minifyjs:

minifyJS
""""""""

.. container:: table-row

   Property
         minifyJS

   Data type
         boolean

   Description
         If set, inline or externalized (see removeDefaultJS above) JavaScript
         will be minified. Minification will remove all excess space and will
         cause faster page loading. Together with removeDefaultJS = external it
         will significantly lower web site traffic.

         The default value depends on the compatibility mode (see the Update
         wizard under Tools > Install):

         *compatibility mode < 4.0: 0*

         *compatibility mode >= 4.0: 1*

         **Example:** ::

            config.minifyJS = 1

         **Note:** JavaScript in external files in the FE will only be
         minified, if a compression handler is registered using
         $GLOBALS['TYPO3\_CONF\_VARS']['FE']['jsCompressHandler'].

         **Example:** ::

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsCompressHandler'] =
               t3lib_extMgm::extPath($_EXTKEY) .
               'Classes/class.tx_myext_jsCompressHandler.php:tx_myext_jsCompressHandler->minifyJs';

         **Note:** This property was deprecated and has been removed in TYPO3
         6.0! Use config.compressJs instead.



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

         **Example:** ::

            config.MP_defaults = 36,37,48 : 2-207

         This will by default add "&MP=2-207" to all links pointing to pages
         36,37 and 48



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

         The result is used just like MP\_defaults are used to find MP-vars if
         none has been specified prior to the call to
         TYPO3\CMS\Core\TypoScript\TemplateService::linkData()
         (t3lib\_tstemplate::linkData()).

         You can specify "root" as a special keyword in the list of IDs and
         that will create a map-tree for the whole site (but this may be VERY
         processing intensive if there are many pages!).

         The order of IDs specified may have a significance; Any ID in a branch
         which is processed already (by a previous ID root point) will not be
         processed again.



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

         **Example:** ::

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



.. _setup-config-noscaleup:

noScaleUp
"""""""""

.. container:: table-row

   Property
         noScaleUp

   Data type
         boolean

   Description
         Normally images are scaled to the size specified via TypoScript. This
         also forces small images to be scaled to a larger size. This is not
         always a good thing.

         If this property is set, images are **not** allowed to be scaled up
         in size. This parameter clears the $this->mayScaleUp var of the class
         TYPO3\CMS\Core\Imaging\GraphicalFunctions (t3lib\_stdgraphics, often
         referred to as "gifbuilder").



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
         index\_ts.php for initialization, caching, stating and so on. This
         script is included in the global scope of index\_ts.php-script and
         thus you may include libraries here. Always use include\_once for
         libraries.

         Remember not to output anything from such an included script. **All
         content must be set into $TSFE->content.** Take a look at
         typo3/sysext/frontend/Classes/Page/PageGenerator.php
         (typo3/sysext/cms/tslib/pagegen.php).

         **Note:** This option is ignored if ::

            ['FE']['noPHPscriptInclude'] => 1;

         is set in LocalConfiguration.php or respectively ::

            $TYPO3_CONF_VARS['FE']['noPHPscriptInclude'] = 1;

         is set in localconf.php.

   Default
         typo3/sysext/frontend/Classes/Page/PageGenerator.php
         (typo3/sysext/cms/tslib/class.tslib\_pagegen.php)



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
         TYPO3\CMS\Core\Page\PageRenderer (t3lib\_PageRenderer).

         **Example:** ::

            pageRendererTemplateFile = fileadmin/test_pagerender.html



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
         Until TYPO3 6.0: string

         Since TYPO3 6.1: string /:ref:`stdWrap <stdwrap>`

   Description
         (Since TYPO3 4.7) The signs which should be printed in the title tag
         between the website name and the page title. If pageTitleSeparator is
         set, but *no* sub-properties are defined, then a space will be added
         to the end of the separator. stdWrap is useful to adjust whitespaces
         at the beginning and the end of the separator.

         **Examples:** ::

            config.pageTitleSeparator = .

         This produces a title tag with the content "website. page title". ::

            config.pageTitleSeparator = -
            config.pageTitleSeparator.noTrimWrap = | | |

         This produces a title tag with the content "website - page title". ::

            config.pageTitleSeparator = *
            config.pageTitleSeparator.noTrimWrap = |||

         This produces a title tag with the content "website*page title".

   Default
         : *(colon with following space)*



.. _setup-config-prefixlocalanchors:

prefixLocalAnchors
""""""""""""""""""

.. container:: table-row

   Property
         prefixLocalAnchors

   Data type
         string

   Description
         If set to one of the keywords, the content will have all local anchors
         in links prefixed with the path of the script. Basically this means
         that <a href="#"> will be transformed to <a
         href="path/path/script?params#">. This procedure is necessary if the
         <base> tag is set (e.g. if the "realurl" extension is used to produce
         speaking URLs). See property "config.baseURL".

         The keywords are the same as for "xhtml\_cleaning", see above.



.. _setup-config-removedefaultcss:

removeDefaultCss
""""""""""""""""

.. container:: table-row

   Property
         removeDefaultCss

   Data type
         boolean

   Description
         (Since TYPO3 4.6) Remove CSS generated by :ref:`\_CSS\_DEFAULT\_STYLE
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

         The default JavaScript is the blurLink function and browser detection
         variables.

         **Special case:** If the value is "**external**", then the default
         JavaScript is written to a temporary file and included from that file.
         See "inlineStyle2TempFile" below.

         Depends on the compatibility mode (see the Update wizard under Tools >
         Install):

         *compatibility mode < 4.0: 0*

         *compatibility mode >= 4.0: 1*

         **Examples:** ::

            config.removeDefaultJS = external
            config.removeDefaultJS = 1



.. _setup-config-removepagecss:

removePageCss
"""""""""""""

.. container:: table-row

   Property
         removePageCss

   Data type
         boolean

   Description
         (Since TYPO3 6.1) Remove CSS generated by :ref:`\_CSS\_PAGE\_STYLE
         <setup-plugin-css-page-style>` configuration of extensions.
         (\_CSS\_PAGE\_STYLE renders certain styles not just because an
         extension is installed, but only in a special situation. E.g. some
         styles will be output, when a textpic element with an image
         positioned alongside the text is present on the current page.)



.. _setup-config-rendercharset:

renderCharset
"""""""""""""

.. container:: table-row

   Property
         renderCharset

   Data type
         string

   Description
         Charset used for the internal rendering of the page content. It is
         highly recommended that this value is the same as the charset of the
         content coming from the main data source (e.g. the database). Thus you
         don't need to do any other conversion.

         All strings from locallang files and locale strings are (and should
         be) converted to "renderCharset" during rendering.

         If you need another output charset than the render charset, see
         "metaCharset" below.

         Until TYPO3 4.7 you can set $TYPO3\_CONF\_VARS['BE']['forceCharset'].
         If you do, its value is used for "renderCharset" by default. It is
         highly recommended to use $TYPO3\_CONF\_VARS['BE']['forceCharset'] =
         "utf-8" for multilingual websites in TYPO3. If you set this, you don't
         have to worry about renderCharset and metaCharset - the same charset
         is used in the whole system.

         **Note:** In TYPO3 4.7 $TYPO3\_CONF\_VARS['BE']['forceCharset'] has
         been removed. Since this version TYPO3 internally always uses UTF-8 by
         default.

   Default
         Until TYPO3 4.6: The value of $TYPO3\_CONF\_VARS['BE']['forceCharset']
         if set, otherwise "iso-8859-1"

         Since TYPO3 4.7: "utf-8"



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

         - Etag [md5 of content]

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
         are logged in (which the extension "realurl" can accomplish).

         Another way to solve the problem is using this option in combination
         with disabling and enabling logins in various sections of the site. In
         the page records ("Advanced" page types) you can disable frontend user
         logins for branches of the page tree. Since many sites only needs the
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



.. _setup-config-simulatestaticdocuments:

simulateStaticDocuments
"""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments

   Data type
         boolean / string

   Description
         If set TYPO3 makes all links in another way than usual. This
         affects all sites in the database. This option can be used
         with **Apache compiled with mod\_rewrite and configured in
         httpd.conf for use of this in the ".htaccess"-files.**

         Include this in the .htaccess file ::

            RewriteEngine On
            RewriteRule   ^[^/]*\.html$  index.php

         This means that any "\*.html"-documents should be handled by
         index.php.

         Now if this is done, TYPO3 will interpret the URL of the html-document
         like this:

         [title].[id].[type].html

         Title is optional and only useful for the entries in the apache log-
         files. You may omit both [title] and [type] but if title is present,
         type must also be there!

         **Example:**

         TYPO3 will interpret this as page with uid=23 and type=1::

            Startpage.23.1.html

         TYPO3 will interpret this as the page with alias = "start". The
         type is zero (default)::

            start.html

         **Alternative value (PATH\_INFO):**

         Instead of using the rewrite-module in apache (e.g. if you're running
         Windows!) you can use the PATH\_INFO variable from PHP.

         It's very simple. Just set simulateStaticDocuments to "PATH\_INFO" and
         you're up and running!

         **Also:** See below, .absRefPrefix

         **Example (to be put in the Setup field of your template):** ::

            config.simulateStaticDocuments = PATH_INFO

         **Note:** Since TYPO3 4.3 the system extension "simulatestatic" had
         to be installed to be able to activate this functionality. Since TYPO3
         6.0 the extension simulatestatic no longer is part of the TYPO3 Core.
         Instead it needs to be installed from TER.

   Default
         The default is defined by the configuration option
         ['FE']['simulateStaticDocuments'] in LocalConfiguration.php, which
         defaults to 1 ($TYPO3\_CONF\_VARS['FE']['simulateStaticDocuments'] = 1
         in localconf.php)



.. _setup-config-simulatestaticdocuments-addtitle:

simulateStaticDocuments\_addTitle
"""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments\_addTitle

   Data type
         integer

   Description
         If not zero, TYPO3 generates URLs with the title in them, limited to
         the first [simulateStaticDocuments\_addTitle] number of chars.

         **Example:** ::

            Startpage.23.1.html

         instead of the default, "23.1.html", without the title.



.. _setup-config-simulatestaticdocuments-dontredirectpathinfoerror:

simulateStaticDocuments\_dontRedirectPathInfoError
""""""""""""""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments\_dontRedirectPathInfoError

   Data type
         boolean

   Description
         Regarding PATH\_INFO mode:

         When a page is requested by "PATH\_INFO" method it must be configured
         in order to work properly. If PATH\_INFO is not configured, the
         index\_ts.php script sends a location header to the correct page.
         However if you better like an error message outputted, just set this
         option.



.. _setup-config-simulatestaticdocuments-notypeifnotitle:

simulateStaticDocuments\_noTypeIfNoTitle
""""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments\_noTypeIfNoTitle

   Data type
         boolean

   Description
         If set, then the type-value will not be set in the simulated filename
         if the type value is zero anyways. However the filename must be
         without a title.

         **Example:**

         "Startpage.23.0.html" would *still* be "Startpage.23.0.html"

         "23.0.html" would be "23.html" (that is without the zero)

         "23.1.html" would *still* be "23.1.html"



.. _setup-config-simulatestaticdocuments-penc:

simulateStaticDocuments\_pEnc
"""""""""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments\_pEnc

   Data type
         string

   Description
         Allows you to also encode additional parameters into the simulated
         filename.

         **Example:**

         You have a news-plugin. The main page has the URL "Page\_1.228.0.html"
         but when one clicks on a news item the URL will be
         "Page\_1.228.0.html?&tx\_mininews\_pi1[showUid]=2&cHash=b8d239c224"
         instead.

         Now, this URL will not be indexed by external search-engines because
         of the query-string (everything after the "?" mark). This property
         avoids this problem by encoding the parameters. These are the options:

         **Value set to "base64":**

         This will transform the filename used to this value: "Page\_1.228+B6Jn
         R4X21pbmluZXdzX3BpMVtzaG93VWlkXT0yJmNIYXNoPWI4ZDIzOWMyMjQ\_.0.html".
         The query string has simply been base64-encoded (and some more...) and
         added to the HTML filename (so now external search-engines will find
         this!). The really great thing about this that the filename is self-
         reliant because the filename contains the parameters. The downside to
         it is the very very long filename.

         **Value set to "md5":**

         This will transform the filename used to this value:

         "Page\_1.228+M57867201f4a.0.html". Now, what a lovely, short filename!
         Now all the parameters has been hashed into a 10-char string inserted
         into the filename. At the same time an entry has been added to a cache
         table in the database so when a request for this filename reaches the
         frontend, then the REAL parameter string is found in the database! The
         really great thing about this is that the filename is very short
         (opposite to the base64-method). The downside to this is that IF you
         clear the database cache table at any time, the URL here does **not**
         work until a page with the link has been generated again (re-inserting
         the parameter list into the database).

         **Note:** Since TYPO3 3.6.0 the encoding works only on parameters
         that are manually entered in the list set by
         .simulateStaticDocuments\_pEnc\_onlyP (see right below) or those
         parameters that various plugins might allow in addition. This is to
         limit the run-away risk when many parameters get combined.



.. _setup-config-simulatestaticdocuments-penc-onlyp:

simulateStaticDocuments\_pEnc\_onlyP
""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments\_pEnc\_onlyP

   Data type
         string

   Description
         A list of variables that may be a part of the md5/base64 encoded part
         of a simulate\_static\_document virtual filename (see property in the
         row above).

         **Example:** ::

            simulateStaticDocuments_pEnc_onlyP = tx_maillisttofaq_pi1[pointer], L, print

         -> this will allow the "pointer" parameter for the extension
         "maillisttofaq" to be included (in addition to whatever vars the
         extension sets itself) and further the parameter "L" (could be
         language selection) and "print" (could be print-version).



.. _setup-config-simulatestaticdocuments-replacementchar:

simulateStaticDocuments\_replacementChar
""""""""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         simulateStaticDocuments\_replacementChar

   Data type
         string

   Description
         Word separator for URLs generated by simulateStaticDocuments. If set
         to

         hyphen, this option allows search engines to index keywords in URLs.
         Before TYPO3 4.0 this character was hard-coded to underscore.

         Depends on the compatibility mode (see the Update wizard under Tools >
         Install):

         *compatibility mode < 4.0:* underscore "\_"

         *compatibility mode >= 4.0:* hyphen "-"



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

         Example:

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

         Example: (dot)

   Default
         . *(just a simple dot)*



.. _setup-config-stat:

stat
""""

.. container:: table-row

   Property
         stat

   Data type
         boolean

   Description
         Enable stat logging at all.

         **Note:** All statistics related options including this one have
         been removed in TYPO3 6.0. Use other well known tools like Google
         Analytics or Piwik instead.

   Default
         true



.. _setup-config-stat-apache:

stat\_apache
""""""""""""

.. container:: table-row

   Property
         stat\_apache

   Data type
         boolean

   Description
         Enable logging to the log file "stat\_apache\_logfile".

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         false



.. _setup-config-stat-apache-logfile:

stat\_apache\_logfile
"""""""""""""""""""""

.. container:: table-row

   Property
         stat\_apache\_logfile

   Data type
         filename

   Description
         This defines the name of the log file where TYPO3 writes an Apache-
         style logfile to. The location of the directory is defined by
         $TYPO3\_CONF\_VARS['FE']['logfile\_dir'] which must exist and be
         writable. It can be relative (to PATH\_site) or absolute, but in any
         case it must be within the regular allowed paths of TYPO3 (meaning for
         absolute paths that it must be within the "lockRootPath" set up in
         $TYPO3\_CONF\_VARS).

         It is also possible to use date markers in the filename as they are
         provided by the PHP function strftime(). This will enable a natural
         rotation of the log files.

         **Example:** ::

            config.stat_apache_logfile = typo3_%Y%m%d.log

         This will create daily log files (e.g. typo3\_20060321.log).

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-apache-nicetitle:

stat\_apache\_niceTitle
"""""""""""""""""""""""

.. container:: table-row

   Property
         stat\_apache\_niceTitle

   Data type
         boolean / string

   Description
         If set, the URL will be transliterated from the renderCharset to ASCII
         (e.g ä => ae, à => a, &#945; "alpha" => a), which yields nice and
         readable page titles in the log. All non-ASCII characters that cannot
         be converted will be changed to underscores.

         If set to "utf-8", the page title will be converted to UTF-8 which
         results in even more readable titles, if your log analyzing software
         supports it.

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-apache-nohost:

stat\_apache\_noHost
""""""""""""""""""""

.. container:: table-row

   Property
         stat\_apache\_noHost

   Data type
         boolean

   Description
         If true, the HTTP\_HOST is - if available - **not** inserted instead
         of the IP address.

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-apache-noroot:

stat\_apache\_noRoot
""""""""""""""""""""

.. container:: table-row

   Property
         stat\_apache\_noRoot

   Data type
         boolean

   Description
         If set, the root part (level 0) of the path will be removed from the
         path. This makes a shorter name in case you have only a redundant part
         like "home" or "my site".

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-apache-notextended:

stat\_apache\_notExtended
"""""""""""""""""""""""""

.. container:: table-row

   Property
         stat\_apache\_notExtended

   Data type
         boolean

   Description
         If true, the log file is **not** written in Apache extended format.

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-apache-pagenames:

stat\_apache\_pagenames
"""""""""""""""""""""""

.. container:: table-row

   Property
         stat\_apache\_pagenames

   Data type
         string

   Description
         The "page name" simulated for apache.

         Default: "[path][title]--[uid].html"

         Codes:

         [title] = inserts title, no special characters and shortened to 30
         chars.

         [uid] = the id

         [alias] = any alias

         [type] = the type (typeNum)

         [path] = the path of the page

         [request\_uri] = inserts the REQUEST\_URI server value (useful with
         RealUrl for example)

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-excludebeuserhits:

stat\_excludeBEuserHits
"""""""""""""""""""""""

.. container:: table-row

   Property
         stat\_excludeBEuserHits

   Data type
         boolean

   Description
         If set a page hit is not logged if a user is logged in into TYPO3.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         false



.. _setup-config-stat-excludeiplist:

stat\_excludeIPList
"""""""""""""""""""

.. container:: table-row

   Property
         stat\_excludeIPList

   Data type
         list of strings

   Description
         If the REMOTE\_ADDR is in the list of IP addresses, it's also not
         logged.

         Can use wildcard, e.g. "192.168.1.\*"

         **Note:** This option has been removed in TYPO3 6.0.



.. _setup-config-stat-ip-anonymize:

stat\_IP\_anonymize
"""""""""""""""""""

.. container:: table-row

   Property
         stat\_IP\_anonymize

   Data type
         boolean

   Description
         (Since TYPO3 4.7) Set to 1 to activate anonymized logging. Setting this
         to 1 will log an empty hostname and will enable anonymization of IP
         addresses.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         0



.. _setup-config-stat-ip-anonymize-mask-ipv4:

stat\_IP\_anonymize\_mask\_ipv4
"""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         stat\_IP\_anonymize\_mask\_ipv4

   Data type
         integer

   Description
         (Since TYPO3 4.7) Prefix-mask 0..32 to use for anonymisation of IP
         addresses (IPv4). Only used, if stat\_IP\_anonymize is set to 1.

         Recommendation for Germany::

            config.stat_IP_anonymize_ipv4 = 24

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         24



.. _setup-config-stat-ip-anonymize-mask-ipv6:

stat\_IP\_anonymize\_mask\_ipv6
"""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         stat\_IP\_anonymize\_mask\_ipv6

   Data type
         integer

   Description
         (Since TYPO3 4.7) Prefix-mask 0..128 to use for anonymisation of IP
         addresses (IPv6). Only used, if stat\_IP\_anonymize is set to 1.

         Recommendation for Germany::

            config.stat_IP_anonymize_ipv6 = 64

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         64



.. _setup-config-stat-loguser:

stat\_logUser
"""""""""""""

.. container:: table-row

   Property
         stat\_logUser

   Data type
         boolean

   Description
         (Since TYPO3 4.7) Configure whether to log the username of the Frontend
         user, if the user is logged in in the FE currently. Setting this to 0
         allows to anonymize the username.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         1



.. _setup-config-stat-mysql:

stat\_mysql
"""""""""""

.. container:: table-row

   Property
         stat\_mysql

   Data type
         boolean

   Description
         Enable logging to the database table sys\_stat.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         false



.. _setup-config-stat-pagelen:

stat\_pageLen
"""""""""""""

.. container:: table-row

   Property
         stat\_pageLen

   Data type
         integer (1-100)

   Description
         The length of the page name (at the end of the path) written to the
         log file/database.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         30



.. _setup-config-stat-titlelen:

stat\_titleLen
""""""""""""""

.. container:: table-row

   Property
         stat\_titleLen

   Data type
         integer (1-100)

   Description
         The length of the page names in the path written to log file/database.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         20



.. _setup-config-stat-typenumlist:

stat\_typeNumList
"""""""""""""""""

.. container:: table-row

   Property
         stat\_typeNumList

   Data type
         int/list

   Description
         List of pagetypes that should be registered in the statistics table,
         sys\_stat.

         If no types are listed, all types are logged.

         Default is "0,1" which normally logs all hits on framesets and hits on
         content keeping pages. Of course this depends on the template design.

         **Note:** This option has been removed in TYPO3 6.0.

   Default
         0,1



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
         rendering. Works exactly like sys\_language\_softMergeIfNotBlank (see
         that for details - same Syntax!).

         Fields set in this property will override if the same field is set for
         "sys\_language\_softMergeIfNotBlank".



.. _setup-config-sys-language-softmergeifnotblank:

sys\_language\_softMergeIfNotBlank
""""""""""""""""""""""""""""""""""

.. container:: table-row

   Property
         sys\_language\_softMergeIfNotBlank

   Data type
         string

   Description
         Setting additional "mergeIfNotBlank" fields from TypoScript.

         Background:

         In TCA you can configure "l10n\_mode" - localization mode - for each
         field. Two of the options affect how the frontend displays content;
         The values "exclude" and "mergeIfNotBlank" (see "TYPO3 Core API"
         document for details). The first ("exclude") simply means that the
         field when found in a translation of a record will not be overlaid the
         default records field value. The second ("mergeIfNotBlank") means that
         it will be overlaid *only* if it has a non-blank value.

         Since it might be practical to set up fields for "mergeIfNotBlank" on
         a per-site basis this options allows you to override additional fields
         from tables.

         **Syntax:**

         [table]:[field], [table]:[field], [table]:[field], ...

         **Example:** ::

            config.sys_language_softMergeIfNotBlank = tt_content:image , tt_content:header

         This setting means that the header and image field of content elements
         will be used from the translation only if they had a non-blank value.
         For the image field this might be very practical because it means that
         the image(s) from the default translation will be used unless other
         images are inserted!



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

         **Example:** ::

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

         **Example:** ::

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



.. _setup-config-xhtml-cleaning:

xhtml\_cleaning
"""""""""""""""

.. container:: table-row

   Property
         xhtml\_cleaning

   Data type
         string

   Description
         Cleans up the output to make it XHTML compliant and a bit more.
         For now this is what is done:

         *What it does:*

         \- All tags are ended with "/>"

         \- Lowercase for elements and attributes

         \- All attributes in quotes

         \- Add "alt" attribute to img-tags if it's not there already.

         *What it does **not** do (yet) according to XHTML specifications:*

         \- Wellformedness: Nesting is **not** checked

         \- name/id attribute issue is not observed at this point.

         \- Certain nesting of elements not allowed. Most interesting, <PRE>
         cannot contain img, big,small,sub,sup ...

         \- Wrapping scripts and style element contents in CDATA - or
         alternatively they should have entities converted.

         \- Setting charsets may put some special requirements on both XML
         declaration/ meta-http-equiv. (C.9)

         \- UTF-8 encoding is in fact expected by XML!

         \- stylesheet element and attribute names are **not** converted to
         lowercase

         \- ampersands (and entities in general I think) MUST be converted to
         an entity reference! (&amps;). This may mean further conversion of
         non-tag content before output to page. May be related to the charset
         issue as a whole.

         \- Minimized values not allowed: Must do this: selected="selected"

         Please see the class TYPO3\CMS\Core\Html\HtmlParser
         (t3lib\_parsehtml) for details.

         You can enable this function by setting it to one of the following
         keywords:

         **all:** The content is always processed before it is possibly
         stored in cache (or not stored in cache).

         **cached:** The content is only processed, if the page will be put
         into the cache.

         **output:** The content is processed just before it is echoed out.



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

         **xhtml\_2** for XHTML 2 doctype.

         This is an example to use MathML 2.0 in an XHTML 1.1 document::

            config.doctype (
              <!DOCTYPE html
                  PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN"
                  "http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd">
            )
            config.xhtmlDoctype = xhtml_11

   Default:

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

            <?xml version="1.0" encoding="[config.renderCharset]">

         If set to one of the following keywords then a standard prologue will
         be set:

         **xml\_10:** XML 1.0 prologue (see above)

         **xml\_11:** XML 1.1 prologue

         **none:** The default XML prologue is *not* set.

         Any other string is used as the XML prologue itself.




.. ###### END~OF~TABLE ######
