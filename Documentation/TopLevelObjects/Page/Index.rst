:navigation-title: Page

..  include:: /Includes.rst.txt
..  index::
    PAGE
    Top-level objects; page
..  _page:
..  _page-datatype:
..  _object-type-page:


================================
`PAGE` object type in TypoScript
================================

This defines what is rendered in the frontend.

PAGE is an object type. A good habit is to use :typoscript:`page` as
the top-level object name for the main `PAGE` object of a website.

TYPO3 does not initialize :typoscript:`page` by default. You must initialize this
explicitly, for example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE

Pages are referenced by two main values. The "id" and "type".

**The "id"** points to the uid of the page (or the alias). Thus the
page is found.

Most of this code is executed in the PHP script
:php:`\TYPO3\CMS\Frontend\Http\RequestHandler`.

..  contents:: Table of contents
    :depth: 1

..  _page-getting-started:

Getting started with the PAGE object
====================================

See :ref:`PAGE in TypoScript (Getting started), <guide-page>` for an
introduction into this object.

If no `PAGE` object is found, the error "No page configured for type=0." is
displayed. See chapter :ref:`Troubleshooting <t3tsref:guide-troubleshooting>`.

..  _page_output:

Output of the PAGE object
=========================

An empty :typoscript:`PAGE` object without further configuration renders a HTML page
like the following:

..  code-block:: html

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <!--
        This website is powered by TYPO3 - inspiring people to share!
        TYPO3 is a free open source Content Management Framework initially created by Kasper Skaarhoj and licensed under GNU/GPL.
        TYPO3 is copyright 1998-2019 of Kasper Skaarhoj. Extensions are copyright of their respective owners.
        Information and contribution at https://typo3.org/
    -->
    <title>Page title</title>
    <meta name="generator" content="TYPO3 CMS">
    </head>
    <body>
    </body>
    </html>

This default behaviour can be changed by setting the property
:ref:`setup-config-disableallheadercode`:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.config.disableAllHeaderCode = 1

If the output represents another format different from HTML the HTTP header
should also be set, for example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.config.additionalHeaders.10.header = Content-type:application/json

..  index::
    PAGE; typeNum
    PAGE; Multiple pages

..  _page_multiple:

Multiple pages
==============

When rendering pages in the frontend, TYPO3 uses the GET parameter **"type"**
to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 (which is the default) while a JSON
stream with the same content could go with type 1.

The property :ref:`typeNum <setup-page-typenum>`  defines for which type,
the page will be used.

Example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page.typeNum = 0
    page {
       # set properties ...
    }

    json = PAGE
    json.typeNum = 1
    # ...

See :ref:`An example page type used for JSON data <page_examples_json>`
about an example for the latter page.

In the frontend, the original URLs that are generated will include the type and
an id parameter (for the page id), example (for json and page id 22):

:samp:`/index.php?id=22&type=1`


..  _page_guidelines:

Guidelines
----------

Good, general PAGE object names to use are:

* **page** for the main page with content
* **json** for a json stream with content
* **xml** for a XML stream with content

These are just recommendations. However, especially the name page for the content bearing page
is very common and most documentation will imply that your main page object is called page.

..  index:: PAGE; Properties
..  _setup-page-bodytag:
..  _setup-page-bodytagadd:
..  _setup-page-bodytagcobject:
..  _setup-page-config:
..  _setup-page-cssinline:
..  _setup-page-footerdata:
..  _setup-page-headerdata:
..  _setup-page-headtag:
..  _setup-page-includecss-array:
..  _setup-page-includecsslibs-array:
..  _setup-page-includejs-array:
..  _setup-page-includejsfooter-array:
..  _setup-page-includejsfooterlibs-array:
..  _setup-page-includejslibs-array:
..  _setup-page-inlinelanguagelabelfiles:
..  _setup-page-inlinesettings:
..  _setup-page-jsfooterinline:
..  _setup-page-jsinline:
..  _meta:
..  _setup-page-meta:
..  _setup-page-shortcuticon:
..  _setup-page-stdwrap:
..  _setup-page-typenum:
..  _setup-page-wrap:
..  _setup-page-array:
..  _page_properties:

Properties
==========

..  confval-menu::
    :name: page-properties
    :caption: Properties of the PAGE object
    :display: table
    :type:

    ..  confval:: 1,2,3,4...
        :name: page-array
        :type: :ref:`cObject <data-type-cobject>`

        :Examples:
            *   :ref:`Render "Hello World" <setup-page-array-example>`
            *   :ref:`A simple "Hello World" Example <page_examples_hello_world>`
            *   :ref:`A page using a Fluid template <page_examples_fluid>`

        These properties can be used to define any number of objects,
        just like you can do with a :ref:`COA content object <cobj-coa>`.

        The content of these objects will be rendered on the page in the
        order of the numbers, not in the order they get defined in the TypoScript
        definition.

        It is considered best practice to leave space between the numbers such
        that it will be possible to place objects before and after other objects
        in the future. Therefore you will often see that people use the number
        10 and no number 1 is found.

    ..  confval:: bodyTag
        :name: page-bodyTag
        :type: string
        :Default: `<body>`
        :Example: :ref:`Set a class on the body tag <setup-page-bodytag-example>`

        Body tag on the page

    ..  confval:: bodyTagAdd
        :name: page-bodyTagAdd
        :type: :ref:`data-type-string`
        :Example: :ref:`Add a parameter to the body tag <setup-page-bodytagadd-example>`

        This content is added inside of the opening :html:`<body>` tag right
        before the :html:`>` character. This is mostly useful for adding
        attributes to the :html:`<body>` tag.

    ..  confval:: bodyTagCObject
        :name: page-bodyTagCObject
        :type: cObject

        This is the default body tag. It is overridden by :ref:`confval-page-bodytag`,
        if that is set.

        ..  note::  
            Additionally to the body tag properties noted here,
            there also is the property :confval:`config.disableBodyTag <config-disableBodyTag>`,
            which, if set, disables body tag generation independently
            from what might be set here.

    ..  confval:: config
        :name: page-config
        :type: :ref:`->CONFIG <config>`

        :Examples:
            *   :ref:`A page type used for ajax requests <page_examples_ajax>`
            *   :ref:`A page type used for JSON data <page_examples_json>`

         Configuration for the page. Any entries made here override the same
         entries in the top-level object :ref:`config`.

    ..  confval:: cssInline.[array]
        :name: page-cssInline
        :type: :ref:`cObject <data-type-cobject>`
        :Example: :ref:`Add inline styles for the h1 tag <setup-page-cssinline-example>`

        Allows to add inline CSS to the page :html:`<head>` section.
        The :typoscript:`cssInline` property contains any number of numeric keys, each representing one cObject.
        Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

    ..  confval:: footerData.[array]
        :name: page-footerData
        :type: :ref:`cObject <data-type-cobject>`
        :Example: :ref:`Add a script and a comment to the page footer <setup-page-footerdata-example>`

        Same as :ref:`setup-page-headerData`,
        except that this block gets included at the bottom of the page
        (just before the closing :html:`</body>` tag).

        The :typoscript:`footerData` property contains any number of numeric keys, each representing one cObject.
        Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

    ..  confval:: headerData.[array]
        :name: page-headerData
        :type: :ref:`cObject <data-type-cobject>`

        Inserts custom content in the head section of the website.

        While you can also use this to include stylesheet references or JavaScript,
        you should better use :confval:`page.includeCSS <page-includeCSS>`
        and :confval:`page.includeJS <page-includeJS>` for such files.
        Features like file concatenation and file compression will not work on files,
        which are included using :typoscript:`headerData`.

        For meta tags, use the dedicated configuration :confval:`page.meta <page-meta>`.

        By default, gets inserted after all the style definitions.

        The :typoscript:`headerData` property contains any number of numeric keys, each representing one cObject.
        Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

    ..  confval:: headTag
        :name: page-headTag
        :type: string / :ref:`stdwrap`
        :Default: `<head>`

        Head-tag if alternatives are wanted

    ..  confval:: includeCSS.[array]
        :name: page-includeCSS
        :type: :ref:`data-type-resource`
        :Example: :ref:`Include additional css files <setup-page-includecss-example>`

        Inserts a stylesheet (just like the :typoscript:`stylesheet` property), but allows
        setting up more than a single stylesheet, because you can enter files
        in an array.

        The file definition must be a valid :ref:`data-type-resource` data type,
        otherwise nothing is inserted.

        Each file has *optional properties*:

        `allWrap`
            Wraps the complete tag, useful for conditional
            comments.
        `allWrap.splitChar`
            Defines an alternative splitting character
            (default is "\|" - the vertical line).
        `alternate`
            If set (boolean) then the rel-attribute will be
            "alternate stylesheet".
        `disableCompression`
            If :typoscript:`config.compressCss` is enabled, this
            disables the compression of this file.
        `excludeFromConcatenation`
            If :typoscript:`config.concatenateCss` is
            enabled, this prevents the file from being concatenated.
        `external`
            If set, there is no file existence check. Useful for
            inclusion of external files.
        `forceOnTop`
            Boolean flag. If set, this file will be added on top
            of all other files.
        `if`
            Allows to define conditions, which must evaluate to `true` for
            the file to be included. If they do not evaluate to `true`, the file
            will not be included. Extensive usage might cause huge numbers of
            temporary files to be created. See :ref:`function if <if>` for details.
        `inline`
            If set, the content of the CSS file is inlined using
            :html:`<style>` tags. Note that external files are not inlined.
        `media`
            Setting the media attribute of the :html:`<style>` tag.
        `title`
            Setting the title of the :html:`<style>` tag.

        Additional data attributes can be configured using a key-value list.

    ..  confval:: includeCSSLibs.[array]
        :name: page-includeCSSLibs
        :type: :ref:`data-type-resource`
        :Example: :ref:`Include CSS libraries <setup-page-includecsslibs-exqample>`

        Adds CSS library files to head of page.

        The file definition must be a valid :ref:`data-type-resource` data type,
        otherwise nothing is inserted. This means that remote files cannot be referenced
        (i.e. using :samp:`https://...`), except by using the :typoscript:`.external` property.

        Each file has *optional properties*:

        `allWrap`
            Wraps the complete tag, useful for conditional
            comments.
        `allWrap.splitChar`
            Defines an alternative
            splitting character (default is "\|" - the vertical line).
        `alternate`
            If set (boolean) then the rel-attribute will be
            "alternate stylesheet".
        `disableCompression`
            If :typoscript:`config.compressCss` is
            enabled, this disables the compression of this file.
        `excludeFromConcatenation`
            If :typoscript:`config.concatenateCss`
            is enabled, this prevents the file from being concatenated.
        `external`
            If set, there is no file existence check. Useful for
            inclusion of external files.
        `forceOnTop`
            Boolean flag. If set, this file will be added on top
            of all other files.
        `if`
            Allows to define conditions, which must
            evaluate to TRUE for the file to be included. If they do not evaluate
            to TRUE, the file will not be included. Extensive usage might cause
            huge numbers of temporary files to be created. See ->if for details.
        `media`
            Setting the media attribute of the :html:`<style>` tag.
        `title`
            Setting the title of the :html:`<style>` tag.

        Additional data attributes can be configured using a key-value list.

    ..  confval:: includeJS.[array]
        :name: page-includeJS
        :type: :ref:`data-type-resource`
        :Example: :ref:`Include JavaScript in the header <setup-page-includejs-example>`

        Inserts one or more (Java)Scripts in :html:`<script>` tags.
        With :ref:`setup-config-movejsfromheadertofooter` set to TRUE all files
        will be moved to the footer.
        The file definition must be a valid :ref:`data-type-resource` data type,
        otherwise nothing is inserted. This means that remote files cannot be referenced
        (i.e. using :samp:`https://...`), except by using the :typoscript:`.external` property.

        Each file has *optional properties*:

        `allWrap`
            Wraps the complete tag, useful for conditional
            comments.

        `allWrap.splitChar`
            Defines an alternative splitting character
            (default is "\|" - the vertical line).

        `async`
            Allows the file to be loaded asynchronously.

        `crossorigin`
            Allows to set the cross-origin attribute in script tags.
            It is automatically set to `anonymous` for external JavaScript files if an
            :typoscript:`.integrity` is set.

        `defer`
            Allows to set the HTML5 attribute :html:`defer`.

        `disableCompression`
            If :typoscript:`config.compressJs` is enabled,
            this disables the compression of this file.

        `excludeFromConcatenation`
            If :typoscript:`config.concatenateJs` is enabled,
            this prevents the file from being concatenated.

        `external`
            If set, there is no file existence check. Useful for
            inclusion of external files.

        `forceOnTop`
            Boolean flag. If set, this file will be added on top
            of all other files.

        `if`
            Allows to define conditions, which must evaluate to TRUE for
            the file to be included. If they do not evaluate to TRUE, the file will
            not be included. Extensive usage might cause huge numbers of temporary
            files to be created. See ->if for details.

        `type`
            Setting the MIME type of the script. Default: The attribute is
            omitted for frontend rendering when :typoscript:`config.doctype` is not set or
            set to :typoscript:`html5`. Otherwise :html:`text/javascript` is used as type.

        `integrity`
            Adds the integrity attribute to the script element to let
            browsers ensure subresource integrity. Useful in hosting scenarios with
            resources externalized to CDN's. See `SRI <https://www.w3.org/TR/SRI/>`_ for
            more details. Integrity hashes may be generated using `<https://srihash.org/>`_.

        `data`
            Array with key/value for additional attributes to be added to
            the script tag.

    ..  confval:: includeJSFooter.[array]
        :name: page-includeJSFooter
        :type: :ref:`data-type-resource`

        Add JavaScript files to footer (after files set in :confval:`includeJSFooterlibs <page-includeJSFooterlibs>`)

        Same as :confval:`includeJS <page-includeJS>` above, except that this block gets
        included at the bottom of the page (just before the closing :html:`</body>`
        tag).

    ..  confval:: includeJSFooterlibs.[array]
        :name: page-includeJSFooterlibs
        :type: :ref:`data-type-resource`

        Add JavaScript library files to footer.

        Same as :confval:`includeJSLibs <page-includeJSLibs>`, except that this block gets
        included at the bottom of the page (just before the closing :html:`</body>`
        tag).

        The optional properties from :confval:`includeJS <page-includeJS>`
        can be applied.

        Currently one difference between :typoscript:`includeJS` and :typoscript:`includeJSFooterlibs` exists:
        There is no :typoscript:`data`-array as optional parameter but all keys not explicitly mentioned as parameters are used as additional attributes - behaviour is the same as in :confval:`includeCSS <page-includeCSS>`.

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            # This will lead to <script src="/_assets/.../Frontend/JavaScript/somefile.js?123456" data-foo="data-bar" foo="bar"></script>
            page.includeJSFooterlibs {
                somefile = EXT:site_package/Resources/Public/JavaScript/somefile.js
                somefile.data-foo = data-bar
                somefile.foo = bar
            }

    ..  confval:: includeJSLibs.[array]
        :name: page-includeJSLibs
        :type: :ref:`data-type-resource`

        Adds JavaScript library files to head of page.

        Same as :confval:`includeJSFooterlibs <page-includeJSFooterlibs>`, except that this block gets
        included inside :html:`<head>`.
        tag).

        The optional properties from :confval:`includeJS <page-includeJS>`
        can be applied.

        Currently one difference between :typoscript:`includeJS` and :typoscript:`includeJSLibs` exists:
        There is no :typoscript:`data`-array as optional parameter but all keys not explicitly mentioned as parameters are used as additional attributes - behaviour is the same as in :confval:`includeCSS <page-includeCSS>`.

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            # This will lead to <script src="/_assets/.../Frontend/JavaScript/somefile.js?123456" data-foo="data-bar" foo="bar"></script>
            page.includeJSLibs {
                somefile = EXT:site_package/Resources/Public/JavaScript/somefile.js
                somefile.data-foo = data-bar
                somefile.foo = bar
            }

    ..  confval:: inlineLanguageLabelFiles
        :name: page-inlineLanguageLabelFiles
        :type: (array of strings)
        :Example: :ref:`Make a language file available in JavaScript <setup-page-inlinelanguagelabelfiles-example>`

        Adds language labels to the page. All labels will be then be available in
        the JavaScript object :js:`TYPO3.lang`.

        ..  rubric:: Available sub-properties:

        `selectionPrefix`
            Only label keys that start with this prefix will
            be included. Default: ''.

        `stripFromSelectionName`
            A string that will be removed from any
            included label key. Default: ''.

        `errorMode`
            Error mode if the file could not be found:
            0 - syslog entry, 1 - do nothing, 2 - throw an exception.
            Default: 0

    ..  confval:: inlineSettings
        :name: page-inlineSettings
        :type: (array of strings)
        :Example: :ref:`Make some values available in JavaScript <setup-page-inlinesettings-example>`

        Adds settings to the page as inline javascript, which is accessible within
        the JavaScript object :js:`TYPO3.settings`.

    ..  confval:: jsFooterInline.[array]
        :name: page-jsFooterInline
        :type: :ref:`cObject <data-type-cobject>`
        :Example: :ref:`Add some inline JavaScript to the page footer <setup-page-jsfooterinline-example>`

        Same as :typoscript:`jsInline`, except that the JavaScript gets inserted at the
        bottom of the page (just before the closing :html:`</body>` tag).

        The :typoscript:`jsFooterInline` property contains any number of numeric keys, each representing one cObject.
        Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

    ..  confval:: jsInline.[array]
        :name: page-jsInline
        :type: :ref:`cObject <data-type-cobject>`
        :Example: :ref:`Make a cObject available in JavaScript <setup-page-jsinline-example>`

        Use array of cObjects for creating inline JavaScript.

        ..  note::

            With :typoscript:`config.removeDefaultJS = external`, the inline JavaScript is moved
            to an external file.

        The :typoscript:`jsInline` property contains any number of numeric keys, each representing one cObject.
        Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

    ..  confval:: meta
        :name: page-meta
        :type: array of key names (string / :ref:`stdWrap <stdwrap>`)

        :Examples:
            *   :ref:`Define meta tags for description and keywords <setup-page-meta-example>`
            *   :ref:`setup-page-meta-example-keywords`
            *   :ref:`setup-page-meta-example-refresh`
            *   :ref:`setup-page-meta-example-og`

        Use the scheme :typoscript:`meta.key = value` to define any HTML meta tag.

        :typoscript:`value` is the content of the meta tag. If the value is empty (after
        trimming), the meta tag is not generated.

        The :typoscript:`key` can be the name of any meta tag, for example :html:`description` or
        :html:`keywords`. If the key is :typoscript:`refresh` (case insensitive), then the
        :html:`http-equiv` attribute is used in the meta tag instead of the :html:`name`
        attribute.

        For each key the following sub-properties are available:

        `attribute`
            Sets the attribute for the meta tag. If it is not defined, the
            default :html:`name` is used.

        `httpEquivalent`
            If set to 1, the :html:`http-equiv` attribute is used in the meta
            tag instead of the :html:`name` attribute. Default: 0.

        `replace`
            If set to 1, the tag will replace the one set earlier by a plugin. If set
            to 0 (default), the meta tag generated by the plugin will be used. If
            there is none yet, the one from TypoScript is set.

    ..  confval:: shortcutIcon
        :name: page-shortcutIcon
        :type: :ref:`data-type-resource`
        :Example: :ref:`Add a favicon to the page <setup-page-shortcuticon-example>`

        Favicon of the page. Create a reference to an icon here!

        Browsers that support favicons display them in the address bar of
        the browser, next to the name of the site in lists of bookmarks
        and next to the title of the page in the tab.

        If the file is missing no tag will be rendered.

    ..  confval:: stdWrap
        :name: page-stdWrap
        :type: :ref:`stdwrap`

        Wraps the content of the cObject array with :ref:`stdwrap` options.

    ..  confval:: typeNum
        :name: page-typeNum
        :type: :ref:`data-type-integer`
        :Default: 0

        :Examples:
            *   :ref:`A page type used for ajax requests <page_examples_ajax>`
            *   :ref:`A page type used for JSON data <page_examples_json>`

        This determines the typeId of the page. The `&type=` parameter in the URL
        determines, which page object will be rendered. The value defaults to 0 for
        the first found :typoscript:`PAGE` object, but it **must** be set and be unique as
        soon as you use *more* than one such object.

    ..  confval:: wrap
        :name: page-wrap
        :type: :ref:`data-type-wrap`

        Wraps the content of the cObject array.

..  _page_property-examples:

Page property examples
======================

Also see the dedicated chapter of how to use the
PAGE object: :ref:`page_examples`

..  _setup-page-array-example:

Example: Render "Hello World"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    *   :confval:`page.10 <page-array>`


..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    page.20 = TEXT
    page.20.value = World
    page.10 = TEXT
    page.10.value = Hello

    This renders to :html:`HelloWorld`.

..  _setup-page-bodytag-example:

Example: Set a class on the body tag
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.bodyTag <page-bodytag>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    # This will lead to <body class="example"> if constant "bodyClass" is set accordingly.
    page.bodyTag = <body class="{$bodyClass}">

..  _setup-page-bodytagadd-example:

Example: Add a parameter to the body tag
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.bodyTagAdd <page-bodyTagAdd>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    # This will lead to <body class="example">
    page.bodyTagAdd = class="example"

..  _setup-page-cssinline-example:

Example: Add inline styles for the h1 tag
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.cssInline <page-cssInline>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.cssInline {
        10 = TEXT
        10.value = h1 {margin:15px;}

        20 = TEXT
        20.value = h1 span {color: blue;}
    }

..  _setup-page-footerdata-example:

Example: Add a script and a comment to the page footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.footerData <page-footerData>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.footerData {
        3 = TEXT
        3.value = <script src="...."></script>

        50 = TEXT
        50.value = <!-- Hello from the comment! -->
    }

..  _setup-page-headerdata-example:

Example: Add a script tag and a comment to the head tag
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.headerData <page-headerData>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.headerData {
        3 = TEXT
        3.value = <script src="...."></script>

        50 = TEXT
        50.value = <!-- Hello from the comment! -->
    }

..  _setup-page-includecss-example:

Example: Include additional css files
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.includeCSS <page-includeCSS>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.includeCSS {
        styles = EXT:site_package/Resources/Public/Css/styles.css

        print = EXT:site_package/Resources/Public/Css/print.css
        print.title = High contrast
        print.media = print

        additional = EXT:site_package/Resources/Public/Css/additional_styles.css
        additional.data-foo = bar

        ie6 = EXT:site_package/Resources/Public/Css/ie6.css
        ie6.allWrap = <!--[if lte IE 7]>|<![endif]-->

        example = https://example.org/some_external_styles.css
        example.external = 1
    }


..  _setup-page-includecsslibs-exqample:

Example: Include CSS libraries
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.includeCSSLibs <page-includeCSSLibs>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.includeCSSLibs {
        bootstrap = https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css
        bootstrap.external = 1

        additional = EXT:site_package/Resources/Public/Css/additional_styles.css
        additional.data-foo = bar
    }

..  _setup-page-includejs-example:

Example: Include JavaScript in the header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.includeJS <page-includeJS>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.includeJS {
        helloworld = EXT:site_package/Resources/Public/JavaScript/helloworld.js
        helloworld.type = application/x-javascript

        # Include the file only if myConstant is set in the TS constants field.
        conditional = EXT:site_package/Resources/Public/JavaScript/conditional.js
        conditional.if.isTrue = {$myConstant}

        # Include another file for consent management
        # A data attribute enriches the tag with additional information
        # which can be used in the according JavaScript.
        # This results in "<script data-consent-type="essential" ...></script>"
        consent = EXT:site_package/Resources/Public/JavaScript/consent.js
        consent.data.data-consent-type = essential

        # Another attribute can also be defined also with the "data" key.
        # This results in "<script other-attribute="value" ...></script>"
        consent.data.other-attribute = value

        jquery = https://code.jquery.com/jquery-3.4.1.min.js
        jquery.external = 1
        jquery.integrity = sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh
    }

..  _setup-page-inlinelanguagelabelfiles-example:

Example: Make a language file available in JavaScript
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.inlineLanguageLabelFiles <page-inlineLanguageLabelFiles>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.inlineLanguageLabelFiles {
        someLabels = EXT:my_extension/Resources/Private/Language/locallang.xlf
        someLabels.selectionPrefix = idPrefix
        someLabels.stripFromSelectionName = strip_me
        someLabels.errorMode = 2
    }

..  _setup-page-inlinesettings-example:

Example: Make some values available in JavaScript
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.inlineSettings <page-inlineSettings>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.inlineSettings {
        setting1 = Hello
        setting2 = GoOnTop
    }

Will produce following source

..  code-block:: js

    TYPO3.settings = {"TS":{"setting1":"Hello","setting2":"GoOnTop"}};

..  _setup-page-jsfooterinline-example:

Example: Add some inline JavaScript to the page footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.jsFooterInline <page-jsFooterInline>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.jsFooterInline {
        10 = TEXT
        10.stdWrap.dataWrap = var pageId = {TSFE:id};
    }

..  _setup-page-jsinline-example:

Example: Make a cObject available in JavaScript
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.jsFooterInline <page-jsFooterInline>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.jsInline {
        10 = TEXT
        10.stdWrap.dataWrap = var pageId = {TSFE:id};
    }

..  _setup-page-meta-example:

Example: Define meta tags for description and keywords
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.meta <page-meta>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.meta {
        description = This is the description of the content in this document.
        keywords = These are the keywords.
    }


..  _setup-page-meta-example-keywords:

Example: Fetch data for the keyword meta tag from the page record
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.meta <page-meta>`

If the page record is not set search up the root line of pages.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.meta {
        keywords.data = levelfield:-1, keywords, slide
    }

..  _setup-page-meta-example-refresh:

Example: Make a meta.refresh entry
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.meta <page-meta>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.meta.refresh = 5; url=https://example.org/
    page.meta.refresh.attribute = http-equiv

..  _setup-page-meta-example-og:

Example set Open graph meta tags
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.meta <page-meta>`

Meta tags with a different attribute name are supported like the
Open Graph meta tags:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE
    # [...]

    page.meta {
        keywords = TYPO3
        og:site_name = TYPO3
        og:site_name.attribute = property
        description = Inspiring people to share Normal
        dc\.description = Inspiring people to share [DC tags]
        og:description = Inspiring people to share [OpenGraph]
        og:description.attribute = property
        og:locale = en_GB
        og:locale.attribute = property
        og:locale:alternate {
            attribute = property
            value {
                1 = fr_FR
                2 = de_DE
            }
        }
        article:modified_time {
            attribute = property
            if.isTrue.field = lastUpdated
            field = lastUpdated
            formattedDate = Y-MM-dd'T'HH:mm:ssZ
        }
    }

..  note::

    Since the dot (`.`) has a meaning in TypoScript, it must be escaped with
    a backslash if used in a :typoscript:`meta` key.

They can be used like :typoscript:`property` used for OG tags in the example.

You may also supply multiple values for one name, which results in
multiple meta tags with the same name to be rendered.

Result for :typoscript:`og:description`:

..  code-block:: html

    <meta property="og:description"
    content="Inspiring people to share [OpenGraph]" />

See https://ogp.me/ for more information about the Open Graph
protocol and its properties.

..  _setup-page-shortcuticon-example:

Example: Add a favicon to the page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Demonstrates:
    * :confval:`page.shortcutIcon <page-shortcutIcon>`

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.shortcutIcon = EXT:site_package/Resources/Public/Images/favicon.ico

..  toctree::
    :hidden:

    Examples
