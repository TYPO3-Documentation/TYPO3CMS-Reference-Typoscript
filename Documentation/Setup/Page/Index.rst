.. include:: ../../Includes.txt


.. _page:

====
PAGE
====

Pages are referenced by two main values. The "id" and "type".

**The "id"** points to the uid of the page (or the alias). Thus the
page is found.

**The "type"** is used to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 while a JSON stream with the same
content could go with type 1.

A good habit is to use :ts:`page` as the top-level object name for
the content-page on a website.

Most of this code is executed in the PHP script
:file:`typo3/sysext/frontend/Classes/Page/PageGenerator.php`.

Properties
==========

.. container:: ts-properties

   ============================== ===================================== ====================== ========================
   Property                       Data Type                             :ref:`stdwrap`         Default
   ============================== ===================================== ====================== ========================
   `1,2,3,4...`_                  cObject
   `bodyTag`_                     :ref:`data-type-tag`                                         <body>
   `bodyTagAdd`_                  :ref:`data-type-string`
   `bodyTagCObject`_              cObject
   `config`_                      :ref:`->CONFIG <config>`
   `CSS\_inlineStyle`_            :ref:`data-type-string`
   `cssInline`_                   ->CARRAY
   `footerData`_                  ->CARRAY
   `headerData`_                  ->CARRAY
   `headTag`_                     :ref:`data-type-tag` / :ref:`stdwrap`                        <head>
   `includeCSS.[array]`_          :ref:`data-type-resource`
   `includeCSSLibs.[array]`_      :ref:`data-type-resource`
   `includeJS.[array]`_           :ref:`data-type-resource`
   `includeJSFooter.[array]`_     :ref:`data-type-resource`
   `includeJSFooterlibs.[array]`_ :ref:`data-type-resource`
   `includeJSLibs.[array]`_       :ref:`data-type-resource`
   `inlineLanguageLabelFiles`_    (array of strings)
   `inlineSettings`_              (array of strings)
   `jsFooterInline`_              ->CARRAY
   `jsInline`_                    ->CARRAY
   `meta`_                        :ref:`->META <meta>`
   `shortcutIcon`_                :ref:`data-type-resource`
   `stdWrap`_                     :ref:`stdwrap`
   `typeNum`_                     :ref:`data-type-integer`                                     0
   `wrap`_                        :ref:`data-type-wrap`
   ============================== ===================================== ====================== ========================

.. ### BEGIN~OF~TABLE ###


.. _setup-page-1-2-3-4:

1,2,3,4...
==========

.. container:: table-row

   Property
         1,2,3,4...

   Data type
         cObject

   Description
         These properties can be used to define any number of objects,
         just like you can do with a :ref:`COA content object <cobj-coa>`.



.. _setup-page-bodytag:

bodyTag
=======

.. container:: table-row

   Property
         bodyTag

   Data type
         :ref:`data-type-tag`

   Default
         <body>

   Description
         Body tag on the page

   Example
         ::

            <body bgcolor="{$bgCol}">



.. _setup-page-bodytagadd:

bodyTagAdd
==========

.. container:: table-row

   Property
         bodyTagAdd

   Data type
         :ref:`data-type-string`

   Description
         This content is added inside of the opening :html:`<body>` tag right 
         before the :html:`>` character. This is mostly useful for adding 
         attributes to the :html:`<body>` tag.

   Example ::
   
         # This will lead to <body class="example">
         page.bodyTagAdd = class="example"



.. _setup-page-bodytagcobject:

bodyTagCObject
==============

.. container:: table-row

   Property
         bodyTagCObject

   Data type
         cObject

   Description
         This is the default body tag. It is overridden by :ref:`setup-page-bodyTag`,
         if that is set.

         **Note:** Additionally to the body tag properties noted here,
         there also is the property :ref:`setup-config-disableBodyTag`,
         which, if set, disables body tag generation independently
         from what might be set here.


.. _setup-page-config:

config
======

.. container:: table-row

   Property
         config

   Data type
         :ref:`->CONFIG <config>`

   Description
         Configuration for the page. Any entries made here override the same
         entries in the top-level object :ref:`config`.



.. _setup-page-css-inlinestyle:

CSS\_inlineStyle
================

.. container:: table-row

   Property
         CSS\_inlineStyle

   Data type
         :ref:`data-type-string`

   Description
         This value is just passed on as CSS.

         **Note:** To make TYPO3 actually output these styles as *inline* CSS
         (in-document CSS encapsulated in :html:`<style>` tags),
         :ref:`config.inlineStyle2TempFile <setup-config-inlinestyle2tempfile>`
         must be set to 0.



.. _setup-page-cssinline:

cssInline
=========

.. container:: table-row

   Property
         cssInline

   Data type
         ->CARRAY

   Description
         Use cObjects for creating inline CSS

   Example
         ::

            cssInline {
                10 = TEXT
                10.value = h1 {margin:15px;}

                20 = TEXT
                20.value = h1 span {color: blue;}

                30 = FILE
                30.file = EXT:mysite/Resources/Public/StyleSheets/styles.css
            }



.. _setup-page-footerdata:

footerData
==========

.. container:: table-row

   Property
         footerData

   Data type
         ->CARRAY

   Description
         Same as :ref:`setup-page-headerData` above,
         except that this block gets included at the bottom of the page
         (just before the closing :html:`</body>` tag).


.. _setup-page-headerdata:

headerData
==========

.. container:: table-row

   Property
         headerData

   Data type
         ->CARRAY

   Description
         Inserts content in the head section of the website. Could e.g. be Meta
         tags.

         While you can also use this to include stylesheet references or JavaScript,
         you should better use :ref:`page.includeCSS <setup-page-includecss-array>`
         and :ref:`page.includeJS <setup-page-includejs-array>` for such files.
         Features like file concatenation and file compression will not work on files,
         which are included using :ts:`headerData`.

         By default, gets inserted after all the style definitions.



.. _setup-page-headtag:

headTag
=======

.. container:: table-row

   Property
         headTag

   Data type
         :ref:`data-type-tag` / :ref:`stdwrap`

   Default
         <head>

   Description
         Head-tag if alternatives are wanted



.. _setup-page-includecss-array:

includeCSS.[array]
==================

.. container:: table-row

   Property
         includeCSS.[array]

   Data type
         :ref:`data-type-resource`

   Description
         Inserts a stylesheet (just like the :ts:`stylesheet` property), but allows
         setting up more than a single stylesheet, because you can enter files
         in an array.

         The file definition must be a valid :ref:`data-type-resource` data type,
         otherwise nothing is inserted.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **alternate**: If set (boolean) then the rel-attribute will be
         "alternate stylesheet".

         **disableCompression**: If :ts:`config.compressCss` is enabled, this
         disables the compression of this file.

         **excludeFromConcatenation**: If :ts:`config.concatenateCss` is
         enabled, this prevents the file from being concatenated.

         **external**: If set, there is no file existence check. Useful for
         inclusion of external files.

         **forceOnTop**: Boolean flag. If set, this file will be added on top
         of all other files.

         **if**: Allows to define conditions, which must evaluate to TRUE for
         the file to be included. If they do not evaluate to TRUE, the file
         will not be included. Extensive usage might cause huge numbers of
         temporary files to be created. See ->if for details.

         **import**: If set (boolean) then the `@import` way of including a
         stylesheet is used instead of :html:`<link>`

         **inline**: If set, the content of the CSS file is inlined using
         :html:`<style>` tags. Note that external files are not inlined.

         **media**: Setting the media attribute of the :html:`<style>` tag.

         **title**: Setting the title of the :html:`<style>` tag.

   Example
         ::

            includeCSS {
                file1 = fileadmin/mystylesheet1.css
                file2 = stylesheet_uploaded_to_template*.css
                file2.title = High contrast
                file2.media = print
                ie6Style = fileadmin/css/style3.css
                ie6Style.allWrap = <!--[if lte IE 7]>|<![endif]-->
                cooliris = http://www.cooliris.com/shared/resources/css/global.css
                cooliris.external = 1
            }



.. _setup-page-includecsslibs-array:

includeCSSLibs.[array]
======================

.. container:: table-row

   Property
         includeCSSLibs.[array]

   Data type
         :ref:`data-type-resource`

   Description
         Adds CSS library files to head of page.

         The file definition must be a valid :ref:`data-type-resource` data type,
         otherwise nothing is inserted. This means that remote files cannot be referenced
         (i.e. using `https://...`), except by using the :ts:`.external` property.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative
         splitting character (default is "\|" - the vertical line).

         **alternate**: If set (boolean) then the rel-attribute will be
         "alternate stylesheet".

         **disableCompression**: If :ts:`config.compressCss` is
         enabled, this disables the compression of this file.

         **excludeFromConcatenation**: If :ts:`config.concatenateCss`
         is enabled, this prevents the file from being concatenated.

         **external**: If set, there is no file existence check. Useful for
         inclusion of external files.

         **forceOnTop**: Boolean flag. If set, this file will be added on top
         of all other files.

         **if**: Allows to define conditions, which must
         evaluate to TRUE for the file to be included. If they do not evaluate
         to TRUE, the file will not be included. Extensive usage might cause
         huge numbers of temporary files to be created. See ->if for details.

         **import**: If set (boolean) then the @import way of including a
         stylesheet is used instead of :html:`<link>`

         **media**: Setting the media attribute of the :html:`<style>` tag.

         **title**: Setting the title of the :html:`<style>` tag.

   Example
         ::

            includeCSSLibs.twitter = https://twitter.com/styles/blogger.css
            includeCSSLibs.twitter.external = 1



.. _setup-page-includejs-array:

includeJS.[array]
=================

.. container:: table-row

   Property
         includeJS.[array]

   Data type
         :ref:`data-type-resource`

   Description
         Inserts one or more (Java)Scripts in <script> tags.
         With :ref:`setup-config-movejsfromheadertofooter` set to TRUE all files
         will be moved to the footer.
         The file definition must be a valid :ref:`data-type-resource` data type,
         otherwise nothing is inserted. This means that remote files cannot be referenced
         (i.e. using `https://...`), except by using the :ts:`.external` property.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **async**: Allows the file to be loaded asynchronously.

         **crossorigin**: Allows to set the crossorigin attribute in script tags.
         Is automatically set to `anonymous` for external JavaScript files if an
         :ts:`.integrity` is set.

         **defer** Allows to set the HTML5 attribute :html:`defer`.

         **disableCompression**: If :ts:`config.compressJs` is enabled,
         this disables the compression of this file.

         **excludeFromConcatenation**: If :ts:`config.concatenateJs` is enabled,
         this prevents the file from being concatenated.

         **external**: If set, there is no file existence check. Useful for
         inclusion of external files.

         **forceOnTop**: Boolean flag. If set, this file will be added on top
         of all other files.

         **if**: Allows to define conditions, which must evaluate to TRUE for
         the file to be included. If they do not evaluate to TRUE, the file will
         not be included. Extensive usage might cause huge numbers of temporary
         files to be created. See ->if for details.

         **type**: Setting the MIME type of the script (default: text/javascript).

         **integrity**: Adds the integrity attribute to the script element to let
         browsers ensure subresource integrity. Useful in hosting scenarios with
         resources externalized to CDN's. See `SRI <http://www.w3.org/TR/SRI/>`_ for
         more details. Integrity hashes may be generated using `<https://srihash.org/>`_.

   Example
         ::

            includeJS {
                file1 = fileadmin/helloworld.js
                file1.type = application/x-javascript
                # Include a second file, but only if myConstant is set
                # in the TS constants field.
                file2 = javascript_uploaded_to_template*.js
                file2.if.isTrue = {$myConstant}
            }



.. _setup-page-includejsfooter-array:

includeJSFooter.[array]
=======================

.. container:: table-row

   Property
         includeJSFooter.[array]

   Data type
         :ref:`data-type-resource`

   Description
         Same as :ref:`includeJS <setup-page-includejs-array>` above, except that this block gets
         included at the bottom of the page (just before the closing :html:`</body>`
         tag).



.. _setup-page-includejsfooterlibs-array:

includeJSFooterlibs.[array]
===========================

.. container:: table-row

   Property
         includeJSFooterlibs.[array]

   Data type
         :ref:`data-type-resource`

   Description
         Same as :ref:`includeJSLibs <setup-page-includejslibs-array>`, except that this block gets
         included at the bottom of the page (just before the closing :html:`</body>`
         tag).



.. _setup-page-includejslibs-array:

includeJSLibs.[array]
=====================

.. container:: table-row

   Property
         includeJSLibs.[array]

   Data type
         :ref:`data-type-resource`

   Description
         Adds JS library files to head of page.

         The file definition must be a valid :ref:`data-type-resource` data type,
         otherwise nothing is inserted. This means that remote files cannot be
         referenced (i.e. using `https://...`), except by using the :ts:`.external`
         property.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **async**: Allows the file to be loaded asynchronously.

         **crossorigin**: Allows to set the crossorigin attribute in script
         tags. Is automatically set to `anonymous` for external JavaScript
         files if an :ts:`.integrity` is set.

         **defer** Allows to set the HTML5 attribute :html:`defer`.

         **disableCompression**: If :ts:`config.compressJs` is enabled, this
         disables the compression of this file.

         **excludeFromConcatenation**: If :ts:`config.concatenateJs` is enabled,
         this prevents the file from being concatenated.

         **.external:** If set, there is no file existence check. Useful for
         inclusion of external files.

         **.forceOnTop:** Boolean flag. If set, this file will be added on top
         of all other files.

         **.if:** Allows to define conditions, which must evaluate to TRUE for the
         file to be included. If they do not evaluate to TRUE, the file will not be
         included. Extensive usage might cause huge numbers of temporary files to be
         created. See ->if for details.

         **.integrity:** Adds the integrity attribute to the script element to let
         browsers ensure subresource integrity. Useful in hosting scenarios with
         resources externalized to CDN's. See `SRI <http://www.w3.org/TR/SRI/>`_ for
         more details. Integrity hashes may be generated using `<https://srihash.org/>`_.

         **Example:** ::

            includeJSLibs.twitter = http://twitter.com/javascripts/blogger.js
            includeJSLibs.twitter.external = 1
            includeJSLibs.twitter.integrity = sha256-C6CB9UYIS9UJeqinPHWTHVqh/E1uhG5Twh+Y5qFQmYg=





.. _setup-page-inlinelanguagelabelfiles:

inlineLanguageLabelFiles
========================

.. container:: table-row

   Property
         inlineLanguageLabelFiles

   Data type
         (array of strings)

   Description
         Adds language labels to the page. All labels will be then be available in
         the Javascript object :js:`TYPO3.lang`.

         **Available sub-properties:**

         **selectionPrefix:** Only label keys that start with this prefix will
         be included. Default: ''.

         **stripFromSelectionName:** A string that will be removed from any
         included label key. Default: ''.

         **errorMode:** Error mode if the file could not be found:
         0 - syslog entry, 1 - do nothing, 2 - throw an exception.
         Default: 0

   Example
         ::

            inlineLanguageLabelFiles {
                someLabels = EXT:myExt/Resources/Private/Language/locallang.xlf
                someLabels.selectionPrefix = idPrefix
                someLabels.stripFromSelectionName = strip_me
                someLabels.errorMode = 2
            }

.. _setup-page-inlinesettings:

inlineSettings
==============

.. container:: table-row

   Property
         inlineSettings

   Data type
         (array of strings)

   Description
         ExtJS specific, adds settings to the page.

   Example
         ::

            page.inlineSettings {
                setting1 = Hello
                setting2 = GoOnTop
            }

         Will produce following source

         .. code-block:: js

            TYPO3.settings = {"TS":{"setting1":"Hello","setting2":"GoOnTop"}};



.. _setup-page-jsfooterinline:

jsFooterInline
==============

.. container:: table-row

   Property
         jsFooterInline

   Data type
         ->CARRAY

   Description
         Same :ts:`jsInline` above, except that the JavaScript gets inserted at the
         bottom of the page (just before the closing :html:`</body` tag).



.. _setup-page-jsinline:

jsInline
========

.. container:: table-row

   Property
         jsInline

   Data type
         ->CARRAY

   Description
         Use cObjects for creating inline JavaScript

         **Note:**

         With :ts:`config.removeDefaultJS = external`, the inline JavaScript is moved
         to an external file.

   Example
         ::

            page.jsInline {
                10 = TEXT
                10.stdWrap.dataWrap = var pageId = {TSFE:id};
            }



.. _setup-page-meta:

meta
====

.. container:: table-row

   Property
         meta

   Data type
         :ref:`->META <meta>`

   Description
         ./.




.. _setup-page-shortcuticon:

shortcutIcon
============

.. container:: table-row

   Property
         shortcutIcon

   Data type
         :ref:`data-type-resource`

   Description
         Favicon of the page. Create a reference to an icon here!

         Browsers that support favicons display them in the address bar of
         the browser, next to the name of the site in lists of bookmarks
         and next to the title of the page in the tab.

         **Note:** The file must be a valid :file:`.ico` file (icon file).

         **Note:** The reference to this file will only be included in the
         output of your website, if the file actually exists! Should the
         file be missing, the tag will not be rendered.



.. _setup-page-stdwrap:

stdWrap
=======

.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`stdwrap`

   Description
         Wraps the content of the cObject array with stdWrap options.


.. _setup-page-typenum:

typeNum
=======

.. container:: table-row

   Property
         typeNum

   Data type
         :ref:`data-type-integer`

   Default
         0

   Description
         This determines the typeId of the page. The `&type=` parameter in the URL
         determines, which page object will be rendered. The value defaults to 0 for
         the first found PAGE object, but it **must** be set and be unique as
         soon as you use *more* than one such object (watch this if you use frames
         on your page)!



.. _setup-page-wrap:

wrap
====

.. container:: table-row

   Property
         wrap

   Data type
         :ref:`data-type-wrap`

   Description
         Wraps the content of the cObject array.


.. ###### END~OF~TABLE ######
