..  include:: /Includes.rst.txt
..  index::
    config
    Top-level objects; config
..  _config:
..  _config-object-type:
..  _config-datatype:
..  _top-level-objects-config:

===============
CONFIG & config
===============

..  contents:: Table of content
    :depth: 1

..  _top-level-objects-config-about:

The 'config' top-level-object
=============================

Internally TYPO3 always creates an array `config` with various configuration
values which are evaluated during the rendering process and treated in some
special, predefined and predictive way. This is what we mean when we say the
property `config`, actually the array `'config'` is of type CONFIG. It is a
"top-level-object" because it is not subordinate to any other configuration
setting.

In PHP you can refer to the array within :file:`typo3/sysext/frontend/Classes/`
files by writing :php:`$GLOBALS['TSFE']->config['config']`.

This typoscript "top level object" `config` provides access to the internal
array. This means, that configuration settings can be made easily. For example:

..  code-block::

    # TypoScript
    config.debug = 1

    # will produce, in php
    $GLOBALS['TSFE']->config['config']['debug'] // with value 1

..  _setup-config-xmlprologue:
..  _setup-config-typolinklinkaccessrestrictedpages-ATagParams:
..  _setup-config-typolinklinkaccessrestrictedpages-addparams:
..  _setup-config-sendcacheheaders:
..  _setup-config-showwebsitetitle:
..  _setup-config-spamprotectemailaddresses:
..  _setup-config-spamprotectemailaddresses-atsubst:
..  _setup-config-recordLinks:
..  _setup-config-removedefaultcss:
..  _setup-config-pagetitle:
..  _setup-config-pagetitlefirst:
..  _setup-config-no-cache:
..  _setup-config-nopagetitle:
..  _setup-config-mp-disabletypolinkclosestmpvalue:
..  _setup-config-mp-maprootpoints:
..  _setup-config-movejsfromheadertofooter:
..  _setup-config-message-preview:
..  _setup-config-inttarget:
..  _setup-config-index-externals:
..  _setup-config-index-metatags:
..  _setup-config-htmltag-stdwrap:
..  _setup-config-index-descrlgd:
..  _setup-config-index-enable:
..  _setup-config-forceAbsoluteUrls:
..  _setup-config-forcetypevalue:
..  _setup-config-headercomment:
..  _setup-config-enablecontentlengthheader:
..  _setup-config-exttarget:
..  _setup-config-filetarget:
..  _setup-config-disableCanonical:
..  _setup-config-disableHrefLang:
..  _setup-config-disableprefixcomment:
..  _setup-config-disablepreviewnotification:
..  _disableLanguageHeader:
..  _setup-config-doctype:
..  _setup-config-disablebodytag:
..  _setup-config-debug:
..  _setup-config-cache-clearatmidnight:
..  _setup-config-cache-period:
..  _setup-config-atagparams:
..  _setup-config-admpanel:
..  _top-level-objects-config-properties:

Properties of 'config'
======================

..  confval-menu::
    :name: config-properties
    :caption: Properties of the CONFIG object
    :display: table
    :type:

    ..  confval:: absRefPrefix
        :name: config-absrefprefix
        :type: :ref:`data-type-string`
        :Special value: "auto"

        If set, the string is prepended to all relative links that TYPO3 generates.

        :typoscript:`config.absRefPrefix = auto` lets TYPO3 autodetect
        the site root based on path prefixes and not based on host name variables
        from the server, making this value safe for multi-domain environments.

        If the option :ref:`config.forceAbsoluteUrls <setup-config-forceAbsoluteUrls>`
        is enabled, :typoscript:`absRefPrefix` is overridden.

        Using an URI in :typoscript:`absRefPrefix` will require additional conditions
        if you use different domains for your deployment stages in CI environments.

        If you are working on a server where you have different domain names or
        different path segments leading to the same page (e.g. for internal and
        external access), you may do yourself a favor and set :typoscript:`absRefPrefix` to
        the URL and path of your site, e.g. :samp:`https://example.org/`. If you do not,
        you risk to render pages to cache from the internal network and thereby
        prefix image references and links with a wrong path or a path not accessible
        from outside.

    ..  confval:: additionalHeaders
        :name: config-additionalheaders
        :type: numerically indexed array of "HTTP header entries".
        :Example: :ref:`setup-config-additionalheaders`

        By means of :typoscript:`config.additionalHeaders` as series of additional HTTP headers
        can be configured. An entry has the following structure:

        :typoscript:`10.header = the header string`
            This value is required.

        :typoscript:`10.replace = 0 | 1`
            Optional, boolean, default is `1`.
            If `1`, the header will replace an existing one that has the same name.

        :typoscript:`10.httpResponseCode = 201`
            Optional, integer, a http status code that the page should return.

        By default TYPO3 sends a "Content-Type" header with the defined
        encoding. It then sends cache headers, if configured via
        :ref:`setup-config-sendcacheheaders`.
        Then additional headers are send, plus finally a "Content-Length"
        header, if enabled via :ref:`setup-config-enablecontentlengthheader`.

    ..  confval:: admPanel
        :name: config-admPanel
        :type: boolean

        :typoscript:`config.admPanel = 1` can
        be used to enable the admin panel. See :ref:`Configuration in
        the Admin Panel manual <ext_adminpanel:typoscript-config-admpanel>`.

    ..  confval:: ATagParams
        :name: config-ATagParams
        :type: *<A>-params*

        Additional parameters to all links in TYPO3 (excluding menu-links).

    ..  confval:: cache
        :name: config-cache
        :type: array
        :Example: :ref:`setup-config-cache`

        Determine the maximum cache lifetime of a page.

        The maximum cache lifetime of a page can not only be determined by the
        start and stop times of content elements on the page itself, but also
        by arbitrary records on any other page. However, the page has to be
        configured so that TYPO3 knows the start and stop times of which
        records to include. Otherwise, the cache entry will be used although a
        start/stop date already passed by.

        To include records of type <table name> on page <pid> into the cache
        lifetime calculation of page <page-id>, add the following TypoScript:

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            config.cache.<page-id> = <table name>:<storage-pid>

        Multiple record sources can be added as comma-separated list, see the
        examples.

        You can use the keyword "all" instead of a <page-id> to consider
        records for the cache lifetime of all pages.

        You can use the keyword "current" instead of a <storage-pid> to consider
        records on the current page for the cache life of itself.

    ..  confval:: cache_clearAtMidnight
        :name: config-cache-clearAtMidnight
        :type: :ref:`data-type-boolean`
        :Default: `0`

        With this setting the cache always expires at midnight of the day, the
        page is scheduled to expire.


    ..  confval:: cache_period
        :name: config-cache-period
        :type: :ref:`data-type-integer`
        :Default: `86400` *(= 24 hours)*

        The number of second a page may remain in cache.

        This value is overridden by the value set in the page-record
        `field="cache_timeout"` if this value is greater than zero.

    ..  confval:: compressCss
        :name: config-compressCss
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref:`setup-config-compresscss`

        If set, CSS files referenced in :typoscript:`page.includeCSS` and the like will be
        minified and compressed. Does not work on files, which are referenced
        in :typoscript:`page.headerData`.

        Minification will remove all excess space. The more significant
        compression step (using gzip compression) requires
        :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['compressionLevel']` to be enabled in the
        Install Tool. For this to work you also need to activate the gzip-
        related compressionLevel options in :file:`.htaccess`, as otherwise the
        compressed files will not be readable by the user agent.

        ..  include:: _includes/_concat-compress.rst.txt

        TYPO3 comes with a built-in compression handler, but you can
        also register your own one using
        :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler']`.

        ..  code-block:: php

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler'] =
               \TYPO3\CMS\Core\Extension\ExtensionManager::extPath('my_extension') .
               'Classes/CssCompressHandler.php:MyVendor\MyExtensionen\CssCompressHandler->compressCss';

    ..  confval:: compressJs
        :name: config-compressJs
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref:`setup-config-compressjs`

        Enabling this option together with
        :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['compressionLevel']` in the Install Tool
        delivers Frontend JavaScript files referenced in :typoscript:`page.includeJS` and
        the like using GZIP compression. Does not work on files, which are
        referenced in :typoscript:`page.headerData`.

        Please note that this requires :file:`.htaccess` to be adjusted, as otherwise
        the files will not be readable by the user agent. Please see the
        description of :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['compressionLevel']` in the
        Install Tool.

        ..  include:: _includes/_concat-compress.rst.txt

        TYPO3 comes with a built-in compression handler, but you can
        also register your own one using
        :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['jsCompressHandler']`.

        ..  code-block:: php

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsCompressHandler'] =
                \TYPO3\CMS\Core\Extension\ExtensionManager::extPath('my_extension') .
                'Classes/JsCompressHandler.php:MyVendor\MyExtension\JsCompressHandler->compressJs';

    ..  confval:: concatenateCss
        :name: config-concatenateCss
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref:`setup-config-concatenatecss`

        Setting :typoscript:`config.concatenateCss` merges Stylesheet files referenced in
        the Frontend in page.includeCSS and the like together. Files are merged
        only, if their media attribute has the same value, e.g. if it is "all"
        for several files. Does not work on files, which are referenced in
        :typoscript:`page.headerData`.

        ..  include:: _includes/_concat-compress.rst.txt

        TYPO3 comes with a built-in concatenation handler, but you
        can also register your own one using
        :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['cssConcatenateHandler']`.

        ..  code-block:: php

            $GLOBALS['TYPO3_CONF_VARS']['FE']['cssCompressHandler'] =
                \TYPO3\CMS\Core\Extension\ExtensionManager::extPath('my_extension') .
                'Classes/CssCompressHandler.php:MyVendor\MyExtension\CssCompressHandler->compressCss';

    ..  confval:: concatenateJs
        :name: config-concatenateJs
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref:`setup-config-concatenateJs`

        Setting :typoscript:`config.concatenateJs` merges JavaScript files referenced in
        the Frontend in :typoscript:`page.includeJS` and the like together. Does not work
        on files, which are referenced in :typoscript:`page.headerData`.

        If all files to be concatenated are marked with the async flag, the async attribute is assigned to the script tag.

        ..  include:: _includes/_concat-compress.rst.txt

        TYPO3 comes with a built-in concatenation handler, but you
        can also register your own one using
        :php:`$GLOBALS['TYPO3_CONF_VARS']['FE']['jsConcatenateHandler']`.

        ..  code-block:: php

            $GLOBALS['TYPO3_CONF_VARS']['FE']['jsConcatenateHandler'] =
                   \TYPO3\CMS\Core\Extension\ExtensionManager::extPath('my_extension') .
                   'Classes/JsConcatenateHandler.php:MyVendor\MyExtension\JsConcatenateHandler->concatenateJs';

    ..  confval:: contentObjectExceptionHandler
        :name: config-contentObjectExceptionHandler
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref: `setup-config-contentObjectExceptionHandler`

        Exceptions which occur during rendering of content objects (typically plugins)
        will be caught by default in production context and an error message
        is shown along with the rendered output.

        If this is done, the page will remain available while the section of the page
        that produces an error (i.e. throws an exception) will show a configurable error message.
        By default this error message contains a random code which references
        the exception and is also logged by the :ref:`logging framework <t3coreapi:logging>`
        for developer reference.

        ..  important::

            Instead of breaking the whole page when an exception occurs, an error message
            is shown for the part of the page that is broken.
            Be aware, it is possible that a page with an error message gets cached.

        To get rid of the error message not only the actual error needs to be fixed,
        but the cache must be cleared for this page.

    ..  confval:: debug
        :name: config-debug
        :type: :ref:`data-type-boolean`

        If set, then debug information in the TypoScript code is sent.
        This applies e.g. to menu objects and the parsetime output.
        The parsetime will be sent as HTTP response header `X-TYPO3-Parsetime`.

    ..  confval:: disableAllHeaderCode
        :name: config-disableAllHeaderCode
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref:`setup-config-disableallheadercode`

        If this is not set or set to `0`, the :ref:`page` object automatically
        outputs a HTML skeleton, see :ref:`page_output`.

        To disable this default behaviour set :typoscript:`disableAllHeaderCode = 1`.
        The page outputs only the result of the cObject array
        (1,2,3,4...) of the :ref:`page` object.

        Use this feature in templates supplying other content-types than HTML.
        That could be an image, a RSS-feed, an ajax request in a format like
        XML or JSON.

        This property can also be used to generate the complete HTML page,
        including the :html:`<html>` and :html:`<body>` tags manually.

    ..  confval:: disableBodyTag
        :name: config-disableBodyTag
        :type: :ref:`data-type-boolean`
        :Default: `0`

        If this option is set, the TYPO3 core will not generate the
        opening :html:`<body ...>` part of the body tag. The closing :html:`</body>`
        is not affected and will still be issued.

        :typoscript:`disableBodyTag` takes precedence over the :ref:`page` properties
        :typoscript:`bodyTagCObject`, :typoscript:`bodyTag` and
        :typoscript:`bodyTagAdd`. With :typoscript:`config.disableBodyTag = 1` the others are
        ignored and don't have any effect.

    ..  confval:: disableCanonical
        :name: config-disableCanonical
        :type: :ref:`data-type-boolean`

        When the system extension SEO is installed, canonical tags are generated
        automatically to prevent duplicate content. A good canonical is added
        in many cases by default. For edge cases, you might want to disable the
        rendering of this tag. You can do this by setting this property to `1`.

    ..  confval:: disableHrefLang
        :name: config-disableHrefLang
        :type: :ref:`data-type-boolean`

        When the system extension SEO is installed, hreflang tags are generated
        automatically in multi-language setups. By settings this option to `1`
        the rendering of those tags will be skipped.

    ..  confval:: disablePrefixComment
        :name: config-disablePrefixComment
        :type: :ref:`data-type-boolean`

        If set, the stdWrap property :ref:`stdwrap-prefixComment` will be disabled, thus
        preventing any revealing and space-consuming comments in the HTML
        source code.

    ..  confval:: disablePreviewNotification
        :name: config-disablePreviewNotification
        :type: :ref:`data-type-boolean`
        :Default: `0`

        Disables the "preview" notification box completely.

    ..  confval:: disableLanguageHeader
        :name: config-disableLanguageHeader
        :type: :ref:`data-type-boolean`
        :Default: `0`

        TYPO3 by default sends a `Content-language: XX` HTTP header,
        where "XX" is the ISO code of the according language. The
        value is based on the language defined in the
        :ref:`Site Configuration <t3coreapi:sitehandling>`.

        If :typoscript:`config.disableLanguageHeader` is set, this header will not be sent.

    ..  confval:: doctype
        :name: config-doctype
        :type: :ref:`data-type-string`

        If set, then a document type declaration (and an XML prologue) will be
        generated. The value can either be a complete doctype or one of the
        following keywords:

        `xhtml_trans`
            for the XHTML 1.0 Transitional doctype.
        `xhtml_strict`
            for the XHTML 1.0 Strict doctype.
        `xhtml_basic`
            for the XHTML basic doctype.
        `xhtml_11`
            for the XHTML 1.1 doctype.
        `xhtml+rdfa_10`
            for the XHTML+RDFa 1.0 doctype.
        `html5`
            for the HTML5 doctype.
        `none`
            for *no* doctype at all.

        See :ref:`config.htmlTag_setParams <setup-config-htmltag-setparams>`
        for more details on the effect on the HTML tag.

        Default is the HTML 5 doctype:

        ..  code-block:: html

            <!DOCTYPE html>

    ..  confval:: enableContentLengthHeader
        :name: config-enableContentLengthHeader
        :type: :ref:`data-type-boolean`
        :Default: `1`

        If set, a header "content-length: [bytes of content]" is sent.

        If a backend user is logged in, this is disabled. The reason is
        that the content length header cannot include the length of these
        objects and the content-length will cut off the length of the
        document in some browsers.

    ..  confval:: extTarget
        :name: config-extTarget
        :type: target
        :Default: `_top`

        Default external target. Used by :ref:`typolink` if no extTarget is set.

    ..  confval:: fileTarget
        :name: config-fileTarget
        :type: target

        Default file link target. Used by :ref:`typolink` if no fileTarget is set.

    ..  confval:: forceAbsoluteUrls
        :name: config-forceAbsoluteUrls
        :type: :ref:`data-type-boolean`
        :Default: `0`

        ..  versionadded:: 12.1

        If this option is set, all links, reference to images or assets
        previously built with a relative or absolute path (for example,
        :file:`/fileadmin/my-pdf.pdf`) will be rendered as absolute URLs
        with the site prefix / current domain.

        Examples for such use cases are the generation of a complete static
        version of a TYPO3 site for sending a page via email.

        ..  note::
            Setting this option will override any setting in :ref:`config.absRefPrefix
            <setup-config-absrefprefix>` and any typolink
            :ref:`typolink-forceAbsoluteUrl` options.

    ..  confval:: forceTypeValue
        :name: config-forceTypeValue
        :type: :ref:`data-type-boolean`

        Force the `&type` value of all TYPO3 generated links to a specific value
        (except if overruled by local :typoscript:`forceTypeValue` values).

        Useful if you run a template with special content at - say `&type=95` -
        but still wants to keep your targets neutral. Then you set your
        targets to blank and this value to the type value you wish.

    ..  confval:: headerComment
        :name: config-headerComment
        :type: :ref:`data-type-string`

        The content is added before the "TYPO3 Content Management Framework"
        comment in the <head> section of the page. Use this to insert a note
        like that "Programmed by My-Agency".

    ..  confval:: htmlTag.attributes
        :name: config-htmlTag-attributes
        :type: array
        :Example: setup-config-htmltag-attributes

        Sets the attributes for the :html:`<html>` tag on the page. Allows to override
        and add custom attributes via TypoScript without having to re-add the
        existing attributes generated by SiteHandling.

        This property supersedes the previous :typoscript:`config.htmlTag_setParams` option by providing
        a more flexible API to add attributes.

    ..  confval:: htmlTag_setParams
        :name: config-htmlTag-setParams
        :type: :ref:`data-type-string`
        :Example: :ref:`setup-config-htmltag-setparams`

        Sets the attributes for the :html:`<html>` tag on the page. If you set
        :ref:`setup-config-doctype` to a keyword enabling XHTML then some attributes are
        already set. This property allows you to override any preset
        attributes with your own content if needed.

        **Special:** If you set it to "none" then no attributes will be set at
        any event.

        If you are using `htmlTag.attributes` this property (`htmlTag_setParams`)
        will not have any effect.


    ..  confval:: htmlTag_stdWrap
        :name: config-htmlTag-stdWrap
        :type: :ref:`stdwrap`

        Modify the whole :html:`<html>` tag with stdWrap functionality. This can be
        used to extend or override this tag.

        For example it can be used to distinctly set a :html:`lang` attribute,
        that may diverge from the automatically created attribute using the site
        language settings. Normally, :html:`lang` is set to something like `en`
        or `de`, only indicating the primary language. You may want to use the
        :html:`hreflang` site language attribute instead (containing for example
        `en-US`, `en-GB` or `de-AT`), which you can achieve via:

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            config.htmlTag_stdWrap.override = <html lang="{siteLanguage:hreflang}">
            config.htmlTag_stdWrap.override.insertData = 1

    ..  confval:: index_descrLgd
        :name: config-index-descrLgd
        :type: :ref:`data-type-integer`
        :Default: `200`

        This indicates how many chars to preserve as description for an
        indexed page. This may be used in the search result display.

    ..  confval:: index_enable
        :name: config-index-enable
        :type: :ref:`data-type-boolean`

        Enables cached pages to be indexed.

        Automatically enabled when :t3-ext:`indexed_search` is enabled.

    ..  confval:: index_externals
        :name: config-index-externals
        :type: :ref:`data-type-boolean`

        If set, external media linked to on the pages is indexed as well.

        Automatically enabled when :t3-ext:`indexed_search` is enabled.

    ..  confval:: index_metatags
        :name: config-index-metatags
        :type: :ref:`data-type-boolean`
        :Default: `1`

        This allows to turn on or off the indexing of metatags. It is turned
        on by default.

    ..  confval:: inlineStyle2TempFile
        :name: config-inlineStyle2TempFile
        :type: :ref:`data-type-boolean`
        :Default: `1`
        :Example: :ref:`setup-config-inlinestyle2tempfile`

        If set, the inline styles TYPO3 controls in the core are written to a
        file, :file:`typo3temp/assets/css/stylesheet\_[hashstring].css`, and the header
        will only contain the link to the stylesheet.

        The file hash is based solely on the content of the styles.

    ..  confval:: intTarget
        :name: config-intTarget
        :type: target

        Default internal target. Used by :ref:`typolink` if no target is set.

    ..  confval:: linkVars
        :name: config-linkVars
        :type: list
        :Example: :ref:`setup-config-linkvars`

        :php:`HTTP_GET_VARS`, which should be passed on with links in TYPO3. This
        is compiled into a string stored in :php:`$GLOBALS['TSFE']->linkVars`

        The values are rawurlencoded in PHP.

        You can specify a range of valid values by appending a () after each
        value. If this range does not match, the variable won't be appended to
        links. This is very important to prevent that the cache system gets
        flooded with forged values.

        The range may contain one of these values:

        `[a]-[b]`
            A range of allowed integer values
        `int`
            Only integer values are allowed
        `[a]\|[b]\|[c]`
            A list of allowed strings (whitespaces will be removed)
        `/[regex]/`
            Match against a regular expression (PCRE style)

        You can use the pipe character (|) to access nested properties.

        ..  note::

            Do **not** include the `type` and `L` parameter in the linkVars
            list, as this will result in unexpected behavior.

    ..  confval:: message_preview
        :name: config-message_preview
        :type: :ref:`data-type-string`

        Alternative message in HTML that appears when the preview function is
        active.

    ..  confval:: message_preview_workspace
        :name: config-message-preview-workspace
        :type: :ref:`data-type-string`
        :Example: :ref:`setup-config-message-preview-workspace`

        Alternative message in HTML that appears when the preview function is
        active in a draft workspace. You can use sprintf() placeholders for
        Workspace title (first) and number (second).


    ..  confval:: moveJsFromHeaderToFooter
        :name: config-moveJsFromHeaderToFooter
        :type: :ref:`data-type-boolean`

        If set, all JavaScript (includes and inline) will be moved to the
        bottom of the HTML document, which is after the content and before the
        closing body tag.



    ..  confval:: MP_defaults
        :name: config-MP-defaults
        :type: :ref:`data-type-string`
        :Syntax: `[id],[id],... : [MP-var] \| [id],[id],... : [MP-var] \| ...`
        :Example: :ref:`setup-config-mp-defaults`

        Allows you to set a list of page id numbers which will always have a
        certain "&MP=..." parameter added.

        Imagine you have a TYPO3 site with several mount points, and you need
        certain pages to always include a specific mount point parameter for
        correct content rendering. By configuring :typoscript`MP_defaults`, you
        ensure consistency and reduce the risk of broken links or incorrect
        content being displayed due to missing parameters.


    ..  confval:: MP_disableTypolinkClosestMPvalue
        :name: config-MP-disableTypolinkClosestMPvalue
        :type: :ref:`data-type-boolean`

        If set, the :ref:`typolink` function will not try to find the closest MP
        value for the id.

    ..  confval:: MP_mapRootPoints
        :name: config-MP-mapRootPoints
        :type: list of PIDs / :ref:`data-type-string`

        Defines a list of ID numbers from which the MP-vars are automatically
        calculated for the branch.

        The result is used just like :ref:`MP\_defaults <setup-config-mp-defaults>` are used to
        find MP-vars if none has been specified prior to the call to
        `\TYPO3\CMS\Frontend\Typolink\PageLinkBuilder`.

        You can specify `root` as a special keyword in the list of IDs and
        that will create a map-tree for the whole site (but this may be VERY
        processing intensive if there are many pages!).

        The order of IDs specified may have a significance; Any ID in a branch
        which is processed already (by a previous ID root point) will not be
        processed again.

        The configured IDs have to be the uids of Mount Point pages itself, not the targets.

    ..  confval:: namespaces.[identifier]
        :name: config-namespaces
        :type: string
        :Example:setup-config-namespaces

        This property enables you to add XML namespaces (`xmlns`) to the :html:`<html>`
        tag. This is especially useful if you want to add RDFa or microformats
        to your HTML.

    ..  confval:: no_cache
        :name: config-no-cache
        :type: :ref:`data-type-boolean`
        :Default: `0`

        If this is set to `1`, it disables the `pages` cache, meaning that the
        rendered result/response will not be saved to cache.

        If set to `0`, it's ignored. Rendered result (e.g. full html of a page)
        is stored in the `pages` cache.

        Other parameters may have set it to true for other reasons.
        Note that setting this to `1` doesn't disable other TYPO3 caches.
        Instead of setting `config.no_cache` you might consider changing dynamic
        (non-cacheable) content from :ref:`USER <cobj-user>` to :ref:`USER_INT <cobj-user>`
        (:ref:`COA <cobj-coa>` to :ref:`COA_INT<cobj-coa>`).

        For more information about cache types see
        :ref:`cache types chapter <t3coreapi:caching-architecture-core>`.

    ..  confval:: noPageTitle
        :name: config-noPageTitle
        :type: :ref:`data-type-integer`
        :Default: `0`
        :Example: :ref:`setup-config-pagerenderertemplatefile`

         If you only want to have the site name (from the template record) in
         your :html:`<title>` tag, set this to 1. If the value is 2 then the :html:`<title>`
         tag is not printed at all.

         Please take note that this tag is required for (X)HTML compliant
         output, so you should only disable this tag if you generate it
         manually already.

    ..  confval:: pageRendererTemplateFile
        :name: config-pageRendererTemplateFile
        :type: :ref:`data-type-string`
        :Default: file:`EXT:core/Resources/Private/Templates/PageRenderer.html`

        Sets the template for page renderer class
        :php:`TYPO3\CMS\Core\Page\PageRenderer`.

    ..  confval:: pageTitle
        :name: config-pageTitle
        :type: :ref:`stdwrap`

        stdWrap for the page title. This option will be executed *after* all
        other processing options like :ref:`setup-config-pageTitleFirst`.

    ..  confval:: pageTitleFirst
        :name: config-pageTitleFirst
        :type: :ref:`data-type-boolean`
        :Default: `0`
        :Example: :ref:`setup-config-pagetitleproviders`

        TYPO3 by default prints a title tag in the format "website: page
        title".

        If :typoscript:`pageTitleFirst` is set (and if the page title is printed), then the
        page title will be printed IN FRONT OF the template title. So it will
        look like "page title: website".

    ..  confval:: pageTitleProviders
        :name: config-pageTitleProviders
        :type: array

        In order to keep setting the titles in control, an API to set the page title is available. The API uses
        :typoscript:`PageTitleProviders` to define the page title based on page record and the content on the page.

        Based on the priority of the providers, the :php:`PageTitleProviderManager` will check the providers if a title
        is given by the provider. It will start with the highest priority :typoscript:`PageTitleProviders` and will end with
        the lowest in priority.

    ..  confval:: pageTitleSeparator
        :name: config-pageTitleSeparator
        :type: array
        :Default: `:` *(colon with following space)*
        :Example: :ref:`setup-config-pagetitleseparator`

        The signs which should be printed in the title tag between the website
        name and the page title. If :typoscript:`pageTitleSeparator` is set, but *no*
        sub-properties are defined, then a space will be added to the end of the
        separator. stdWrap is useful to adjust whitespaces at the beginning and
        the end of the separator.

    ..  confval:: recordLinks
        :name: config-recordLinks
        :type: array of link configurations

        ..  code-block:: typoscript
            :caption: Frontend TypoScript definition for identifier `my_content`

            config.recordLinks.my_content {
                // Do not force link generation when the record is hidden
                forceLink = 0

                typolink {
                    // pages.uid to be used to render result (basically it contains the rendering plugin)
                    parameter = 234
                    // field values of tx_myextension_content record with uid 123
                    additionalParams.data = field:uid
                    additionalParams.wrap = &tx_myextension[uid]= | &tx_myextension[action]=show
                }
            }

    ..  confval:: removeDefaultCss
        :name: config-removeDefaultCss
        :type: :ref:`data-type-boolean`
        :Example: :ref:`setup-config-removedefaultjs`

        Remove CSS generated by :ref:`\_CSS\_DEFAULT\_STYLE
        <setup-plugin-css-default-style>` configuration of extensions.
        (:typoscript:`_CSS_DEFAULT_STYLE` outputs a set of default styles, just because
        an extension is installed.)

    ..  confval:: removeDefaultJS
        :name: config-removeDefaultJS
        :type: :ref:`data-type-boolean` / :ref:`data-type-string`
        :Example: :ref:`setup-config-removedefaultjs`

        If set, the default JavaScript in the header will be removed.

        The default JavaScript is the decryption function for email addresses.

        **Special case:** If the value is the string `external`, then the default
        JavaScript is written to a temporary file and included from that file.
        See :ref:`setup-config-inlineStyle2TempFile`.

    ..  confval:: sendCacheHeaders
        :name: config-sendCacheHeaders
        :type: :ref:`data-type-boolean`

         If set, TYPO3 will output cache-control headers to the client based
         mainly on whether the page was cached internally. This feature allows
         client browsers and/or reverse proxies to take load off TYPO3
         websites.

         The conditions for allowing client caching are:

         *  page was cached
         *  No `*_INT` or `*_EXT` objects were on the page (e.g. :ref:`cobj-user`)
         *  No frontend user is logged in
         *  No backend user is logged in

         If these conditions are met, the headers sent are:

         *  Last-Modified [SYS\_LASTCHANGED of page id]
         *  Expires [expire time of page cache]
         *  ETag [md5 of content]
         *  Cache-Control: max-age: [seconds til expiretime]
         *  Pragma: public

         In case caching is not allowed, these headers are sent to avoid client
         caching:

         *  Cache-Control: private, no-store

         Notice that enabling the browser caches means you have to consider how
         log files are written. Because when a page is cached on the client it
         will not invoke a request to the webserver, thus not writing the
         request to the log. There should be ways to circumvent these problems
         but they are outside the domain of TYPO3 in any case.

         **Tip:** Enabling cache-control headers might confuse editors seeing
         old content served from the browser cache. "Shift-Reload" will bypass
         both browser- and reverse-proxy caches and even make TYPO3 regenerate
         the page. Teach them that trick!

    ..  confval:: showWebsiteTitle
        :name: config-showWebsiteTitle
        :type: :ref:`data-type-boolean`
        :Default: 1

        ..  versionadded:: 12.0

        The option can be used to specify whether the website title defined in
        the :ref:`site configuration <t3coreapi:sitehandling>` should be added
        to the page title (used for the :html:`<title>` tag, for example).

        By default, the website title is added. To omit the website title, the
        option has to be set to `0`.

    ..  confval:: spamProtectEmailAddresses
        :name: config-spamProtectEmailAddresses
        :type: `-10` to `10`
        :Example: :ref:`setup-config-spamprotectemailaddresses-lastdotsubst`

        If set, then all email addresses in typolinks will be encrypted so
        that it is harder for spam bots to detect them.

        If you set this value to a number, then the encryption is an
        offset of character values. If you set this value to "-2" then all
        characters will have their ASCII value offset by "-2". To make this
        possible, a little JavaScript code is added to every generated web
        page!

        (It is recommended to set the value in the range from -5 to 1 since
        setting it to >= 2 means a "z" is converted to "\|" which is a special
        character in TYPO3 tables syntax – and that might confuse columns in
        tables.)

        It is required to enable the default JavaScript and not disable it.
        (see :ref:`removeDefaultJS <setup-config-removedefaultjs>`)

    ..  confval:: spamProtectEmailAddresses_atSubst
        :name: config-spamProtectEmailAddresses-atSubst
        :type: :ref:`data-type-string`
        :Default: `(at)`
        :Example: :ref:`setup-config-spamprotectemailaddresses-lastdotsubst`

        Substitute label for the at-sign (`@`).

    ..  confval:: spamProtectEmailAddresses_lastDotSubst
        :name: config-spamProtectEmailAddresses-lastDotSubst
        :type: :ref:`data-type-string`
        :Default: `.` *(just a simple dot)*
        :Example: :ref:`setup-config-spamprotectemailaddresses-lastdotsubst`

        Substitute label for the last dot in the email address.

    ..  confval:: tx_[extension key with no underscores]_[*]
        :name: config-tx-extension-key-with-no-underscores
        :type: array
        :Example: :ref:`setup-config-tx-extension-key-with-no-underscores`

        Configuration space for extensions. This can be used – for example –
        by plugins that need some TypoScript configuration, but that don't
        actually display anything in the frontend (i.e. don't receive their
        configuration as an argument from the frontend rendering process).

    ..  confval:: typolinkLinkAccessRestrictedPages
        :name: config-typolinkLinkAccessRestrictedPages
        :type: :ref:`data-type-integer` (page id) / keyword "NONE"
        :Example: :ref:`setup-config-typolinklinkaccessrestrictedpages`

        If set, typolinks pointing to access restricted pages will still link
        to the page even though the page cannot be accessed. If the value of
        this setting is an integer it will be interpreted as a page id to
        which the link will be directed.

        If the value is :typoscript:`NONE` the original link to the page will be kept
        although it will generate a page-not-found situation (which can of
        course be picked up properly by the page-not-found handler and present
        a nice login form).

        See :confval:`menu-common-properties-showaccessrestrictedpages`
        for menu objects as well (similar feature for menus)

    ..  confval:: typolinkLinkAccessRestrictedPages.ATagParams
        :name: config-typolinkLinkAccessRestrictedPages-ATagParams
        :type: :ref:`data-type-string`
        :Example: :ref:`setup-config-typolinklinkaccessrestrictedpages`

        ..  versionadded:: 12.3

        `typolinkLinkAccessRestrictedPages.ATagParams` Add custom attributes to
        the anchor tag.

    ..  confval:: typolinkLinkAccessRestrictedPages_addParams
        :name: config-typolinkLinkAccessRestrictedPages-addParams
        :type: :ref:`data-type-string`
        :Example: :ref:`setup-config-typolinklinkaccessrestrictedpages`

        See :ref:`setup-config-typolinklinkaccessrestrictedpages` above.

    ..  confval:: typolinkLinkAccessRestrictedPages_xmlprologue
        :name: config-typolinkLinkAccessRestrictedPages-xmlprologue
        :type: :ref:`data-type-string`

        If empty (not set) then the default XML 1.0 prologue is set, when the
        doctype is set to a known keyword (e.g. :typoscript:`xhtml_11`):

        ..  code-block:: none
            :caption: Output

            <?xml version="1.0" encoding="utf-8">

        If set to one of the following keywords then a standard prologue will
        be set:

        `xml_10:`
            XML 1.0 prologue (see above)
        `xml_11:`
            XML 1.1 prologue
        `none:`
            The default XML prologue is *not* set.

        Any other string is used as the XML prologue itself.

..  _setup-config-absrefprefix-examples:

Examples
========

..  contents::
    :local:

..  _setup-config-absrefprefix:

Example: prefix absolute paths
------------------------------

Demonstrates:
    *   :confval:`config absRefPrefix <config-absrefprefix>`

#.  Prefixing all links with a "/" results in absolute link paths:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        config.absRefPrefix = /

#.  Prefixing all links with the path to a subdirectory:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        config.absRefPrefix = /some-subsite/

#.  Prefixing all links with a URI scheme:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        config.absRefPrefix = https://example.org/

..  _setup-config-additionalheaders:

set additional headers data
---------------------------

Demonstrates:
    *   :confval:`config.additionalHeaders <config-additionalHeaders>`

#.  General usage

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        config.additionalHeaders {
          10 {
            # The header string
            header = foo

            # Do not replace previous headers with the same name.
            replace = 0

            # Force a 401 HTTP response code
            httpResponseCode = 401
          }
          # Always set cache headers to private, overwriting the default TYPO3 Cache-control header
          20.header = Cache-control: Private
        }

#.  General usage, same usage, alternate notation

    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        config.additionalHeaders.10.header = foo
        config.additionalHeaders.10.replace = 0
        config.additionalHeaders.10.httpResponseCode = 401
        config.additionalHeaders.20.header = Cache-control: Private


#.  Set content type for a page returning JSON

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        json = PAGE
        json {
          typeNum = 1617455215
          10 =< tt_content.list.20.tx_myextension_myjsonplugin
          config {
            disableAllHeaderCode = 1
            additionalHeaders.10.header = Content-type:application/json
          }
        }

..  _setup-config-cache:

config cache examples
---------------------

Demonstrates:
    *   :confval:`config.cache <config-cache>`

This includes the :sql:`fe_users` records on page 2 in the cache lifetime
calculation for page 10:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.cache.10 = fe_users:2

This includes records from multiple sources, namely the :sql:`fe_users`
records on page 2 and the :sql:`tt_new` records on page 11:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.cache.10 = fe_users:2,tt_news:11

Consider the :sql:`fe_users` records on the storage page 2 for the cache lifetime of all
pages:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.cache.all = fe_users:2

Each pages cache lifetime is influenced if fe_users stored on the page itself get
changed:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.cache.all = fe_users:current

..  _setup-config-compresscss:

Config compress CSS example
---------------------------

Demonstrates:
    *   :confval:`config.compressCss <config-compressCss>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.compressCss = 1


..  _setup-config-compressjs:

Config compress JavaScript
--------------------------

Demonstrates:
    *   :confval:`config.compressJs <config-compressJs>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.compressJs = 1

..  _setup-config-concatenatecss:

Concatenate CSS Example
-----------------------

Demonstrates:
    *   :confval:`config.concatenateCss <config-concatenateCss>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.concatenateCss = 1

..  _setup-config-concatenateJs:

concatenateJs
-------------

Demonstrates:
    *   :confval:`config.concatenateJs <config-concatenateJs>`

.. code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.concatenateJs = 1

    page = PAGE
    page.includeJSFooter {
        test = fileadmin/user_upload/test.js
        test.async = 1

        test2 = fileadmin/user_upload/test2.js
        test2.async = 1
    }

..  _setup-config-contentObjectExceptionHandler:

contentObjectExceptionHandler example
-------------------------------------

Demonstrates:
    *   :confval:`config.contentObjectExceptionHandler <config-contentObjectExceptionHandler>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

..  _setup-config-disableallheadercode:

Provide JSON and disable HTML headers
-------------------------------------


A page type providing JSON:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    json = PAGE
    json {
        typeNum = 1617455215
        10 =< tt_content.list.20.tx_myextension_myjsonplugin
        config {
            disableAllHeaderCode = 1
            additionalHeaders.10.header = Content-type:application/json
        }
    }

..  _setup-config-htmltag-attributes:

HTML tag attributes example
---------------------------

Demonstrates:
    * :confval:`config.htmlTag.attributes <config-htmlTag-attributes>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.htmlTag.attributes.class = no-js

Results in :

..  code-block:: html
    :caption: Example output

    <html lang="fr" class="no-js">

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.htmlTag.attributes.amp =

Results in :

..  code-block:: html
    :caption: Example output

    <html lang="fr" amp>


..  warning::
    If you are using :typoscript:`htmlTag.attributes` the property
    :ref:`setup-config-htmltag-setparams` will not have any effect.

..  note::
    Please note that the `lang` attribute in these examples are auto-generated by
    :ref:`site handling<t3coreapi:sitehandling>`, depending on the value added there.


..  _setup-config-htmltag-setparams:

htmlTag\_setParams example
--------------------------


Demonstrates:
    * :confval:`config.htmlTag_setParams <config-htmlTag-setParams>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.htmlTag_setParams = xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US"

..  _setup-config-inlinestyle2tempfile:

inlineStyle2TempFile example
----------------------------

Demonstrates:
    * :confval:`config.inlineStyle2TempFile <config-inlineStyle2TempFile>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.inlineStyle2TempFile = 0

..  _setup-config-linkvars:

Add `&print` parameter to all links
-----------------------------------

Demonstrates:
    * :confval:`config.linkVars <config-linkVars>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.linkVars = print

This will add `&print=[print-value]` to all links in TYPO3.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.linkVars = tracking|green(0-5)

With the above configuration the following example GET parameters will
be kept: `&tracking[green]=3`. But a get parameter like
`tracking[blue]` will not be kept.

..  _setup-config-message-preview-workspace:

Customize workspace display box
-------------------------------

Demonstrates:
    * :confval:`config.message_preview_workspace <config-message_preview_workspace>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.message_preview_workspace = <div class="previewbox">Displaying workspace named "%s" (number %s)!</div>
    config.message_preview_workspace = <div class="previewbox">Displaying workspace number %2$s named "%1$s"!</div>


..  _setup-config-mp-defaults:

Define mounting point defaults for certain pages
------------------------------------------------

Demonstrates:
    * :confval:`config.MP_defaults <config-MP_defaults>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.MP_defaults = 36,37,48 : 2-207

This will by default add `&MP=2-207` to all links pointing to pages
36,37 and 48.

..  _setup-config-namespaces:

Define Dublin Core Metadata Element Set (dc) xmlns namespace
------------------------------------------------------------

Demonstrates:
    * :confval:`config.namespaces <config-namespaces>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.namespaces.dc = http://purl.org/dc/elements/1.1/
    config.namespaces.foaf = http://xmlns.com/foaf/0.1/

This configuration will result in an :html:`<html>` tag like:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    <html xmlns:dc="http://purl.org/dc/elements/1.1/"
       xmlns:foaf="http://xmlns.com/foaf/0.1/">

..  _setup-config-pagerenderertemplatefile:

Set a custom page renderer template
-----------------------------------

Demonstrates:
    * :confval:`config.pageRendererTemplateFile <config-pageRendererTemplateFile>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.pageRendererTemplateFile = EXT:my_extension/Resources/Private/Templates/TestPagerender.html


..  _setup-config-pagetitleproviders:

Reorder the default page title providers
----------------------------------------

Demonstrates:
    * :confval:`config.pageTitleProviders <config-pageTitleProviders>`

By default, TYPO3 ships with two providers:

.. code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.pageTitleProviders {
        record {
            provider = TYPO3\CMS\Core\PageTitle\RecordPageTitleProvider
        }
        seo {
            provider = TYPO3\CMS\Seo\PageTitle\SeoTitlePageTitleProvider
            before = record
        }
    }

The ordering of the providers is based on the :typoscript:`before` and
:typoscript:`after` parameters. If you want a provider
to be handled before a specific other provider, set that provider in
the :typoscript:`before`, do the same with :typoscript:`after`.

..  note::
    The :typoscript:`seo` PageTitleProvider is only available with installed SEO system extension.

You can find information about creating own PageTitleProviders in the section
:ref:`PageTitle API <t3coreapi:pagetitle>`.


..  _setup-config-pagetitleseparator:

Use custom separators between page title parts
----------------------------------------------

Demonstrates:
    * :confval:`config.pageTitleSeparator <config-pageTitleSeparator>`

This produces a title tag with the content "website . page title":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.pageTitleSeparator = .

This produces a title tag with the content "website - page title":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.pageTitleSeparator = -
    config.pageTitleSeparator.noTrimWrap = | | |

This produces a title tag with the content "website*page title":

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.pageTitleSeparator = *
    config.pageTitleSeparator.noTrimWrap = |||

If you want to remove the web page title from the displayed title, choose a separator that is not included in the web page title.
Then split the title from that character and return the second part only:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.pageTitleSeparator = *
    config.pageTitle.stdWrap {
        split {
            token = *
            returnKey = 1
        }
    }

..  _setup-config-removedefaultjs:

Remove default external JavaScript and all default CSS
------------------------------------------------------

Demonstrates:
    * :confval:`config.removeDefaultJS <config-removeDefaultJS>`
    * :confval:`config.removeDefaultCss <config-removeDefaultCss>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config  {
        removeDefaultJS = external
        removeDefaultCss = 1
    }


..  _setup-config-spamprotectemailaddresses-lastdotsubst:

Spam protect email addresses automatically
------------------------------------------

Demonstrates:

    * :confval:`config.spamProtectEmailAddresses <config-spamProtectEmailAddresses>`
    * :confval:`config.spamProtectEmailAddresses_atSubst <config-spamProtectEmailAddresses_atSubst>`
    * :confval:`config.spamProtectEmailAddresses_lastDotSubst <config-spamProtectEmailAddresses_lastDotSubst>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config {
        spamProtectEmailAddresses = -2
        spamProtectEmailAddresses_atSubst = (at)
        spamProtectEmailAddresses_lastDotSubst = (dot)
    }

..  _setup-config-tx-extension-key-with-no-underscores:

Define configuration for custom namespaces
------------------------------------------

Demonstrates:
    * :confval:`config.tx_myextension <config-tx-extension-key-with-no-underscores>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config.tx_realurl_enable = 1
    config.tx_myextension.width  = 10
    config.tx_myextension.length = 20

..  _setup-config-typolinklinkaccessrestrictedpages:

Define custom styling for access restricted page links
------------------------------------------------------

Demonstrates:
    * :confval:`config.typolinkLinkAccessRestrictedPages <config-typolinkLinkAccessRestrictedPages>`
    * :confval:`config.typolinkLinkAccessRestrictedPages.ATagParams <config-typolinkLinkAccessRestrictedPages-ATagParams>`
    * :confval:`config.typolinkLinkAccessRestrictedPages_addParams <config-typolinkLinkAccessRestrictedPages_addParams>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    config {
        typolinkLinkAccessRestrictedPages = 29
        typolinkLinkAccessRestrictedPages.ATagParams = class="restricted"
        typolinkLinkAccessRestrictedPages_addParams = &return_url=###RETURN_URL###&pageId=###PAGE_ID###
    }

Will create a link to page with id 29 and add GET parameters where the
return URL and original page id is a part of it. Additionally, a CSS
class "restricted" is added to the anchor tag.
