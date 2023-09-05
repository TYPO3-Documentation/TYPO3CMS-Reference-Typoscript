.. include:: /Includes.rst.txt
.. index::
   PAGE
   Top-level objects; page
.. _page:
.. _page-datatype:
.. _object-type-page:

====
PAGE
====

This defines what is rendered in the frontend.

PAGE is an object type. A good habit is to use :typoscript:`page` as the top-level object name for
the content-page on a website.

TYPO3 does not initialize :typoscript:`page` by default. You must initialize this
explicitly, for example:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE

Pages are referenced by two main values. The "id" and "type".

**The "id"** points to the uid of the page (or the alias). Thus the
page is found.

Most of this code is executed in the PHP script
:php:`\TYPO3\CMS\Frontend\Http\RequestHandler`.

.. _page_output:

Output of the PAGE object
=========================

An empty :typoscript:`PAGE` object without further configuration renders a HTML page
like the following:

.. code-block:: html

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

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.config.disableAllHeaderCode = 1

If the output represents another format different from HTML the HTTP header
should also be set, for example:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.config.additionalHeaders.10.header = Content-type:application/json

.. index::
   PAGE; typeNum
   PAGE; Multiple pages

Multiple pages
==============

The **type** is used to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 while a JSON stream with the same
content could go with type 1.

When rendering pages in the frontend, TYPO3 uses the GET parameter **"type"**
to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 (which is the default) while a JSON
stream with the same content could go with type 1.

The property :ref:`typeNum <setup-page-typenum>`  defines for which type,
the page will be used.

Example:

.. code-block:: typoscript
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


Guidelines
----------

Good, general PAGE object names to use are:

* **page** for the main page with content
* **json** for a json stream with content
* **xml** for a XML stream with content

These are just recommendations. However, especially the name page for the content bearing page
is very common and most documentation will imply that your main page object is called page.


Examples
========

Please see the dedicated example page about examples of how to use the
PAGE object: :ref:`page_examples`


.. index:: PAGE; Properties

Properties
==========

.. container:: ts-properties

   ============================== ===================================== ====================== ========================
   Property                       Data Type                             :ref:`stdwrap`         Default
   ============================== ===================================== ====================== ========================
   `1,2,3,4...`_                  :ref:`cObject <data-type-cobject>`
   `bodyTag`_                     :t3-data-type:`tag`                                          <body>
   `bodyTagAdd`_                  :t3-data-type:`string`
   `bodyTagCObject`_              :ref:`cObject <data-type-cobject>`
   `config`_                      :ref:`->CONFIG <config>`
   `css\_inlinestyle`_            :t3-data-type:`string`
   `cssInline.[array]`_           :ref:`cObject <data-type-cobject>`
   `footerData.[array]`_          :ref:`cObject <data-type-cobject>`
   `headerData.[array]`_          :ref:`cObject <data-type-cobject>`
   `headTag`_                     :t3-data-type:`tag` / :ref:`stdwrap`                         <head>
   `includeCSS.[array]`_          :t3-data-type:`resource`
   `includeCSSLibs.[array]`_      :t3-data-type:`resource`
   `includeJS.[array]`_           :t3-data-type:`resource`
   `includeJSFooter.[array]`_     :t3-data-type:`resource`
   `includeJSFooterlibs.[array]`_ :t3-data-type:`resource`
   `includeJSLibs.[array]`_       :t3-data-type:`resource`
   `inlineLanguageLabelFiles`_    (array of strings)
   `inlineSettings`_              (array of strings)
   `jsFooterInline.[array]`_      :ref:`cObject <data-type-cobject>`
   `jsInline.[array]`_            :ref:`cObject <data-type-cobject>`
   `meta`_                        (array of strings)
   `shortcutIcon`_                :t3-data-type:`resource`
   `stdWrap`_                     :ref:`stdwrap`
   `typeNum`_                     :t3-data-type:`integer`                                      0
   `wrap`_                        :t3-data-type:`wrap`
   ============================== ===================================== ====================== ========================

.. ### BEGIN~OF~TABLE ###


.. index:: PAGE; Content objects
.. _setup-page-1-2-3-4:

1,2,3,4...
==========

.. container:: table-row

   Property
      1,2,3,4...

   Data type
      :ref:`cObject <data-type-cobject>`

   Description
      These properties can be used to define any number of objects,
      just like you can do with a :ref:`COA content object <cobj-coa>`.

      The content of these objects will be rendered on the page in the
      order of the numbers, not in the order they get defined in the TypoScript
      definition.

      It is considered best practise to leave space between the numbers such
      that it will be possible to place objects before and after other objects
      in the future. Therefore you will often see that people use the number
      10 and no number 1 is found.

   Example
      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page = PAGE
         page.20 = TEXT
         page.20.value = World
         page.10 = TEXT
         page.10.value = Hello

      This renders to :html:`HelloWorld`.


.. index:: PAGE; bodyTag
.. _setup-page-bodytag:

bodyTag
=======

.. container:: table-row

   Property
         bodyTag

   Data type
         :t3-data-type:`tag`

   Default
         <body>

   Description
         Body tag on the page

   Example
      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         # This will lead to <body class="example">
         page.bodyTag = <body class="{$bodyClass}">



.. index:: PAGE;
.. _setup-page-bodytagadd:

bodyTagAdd
==========

.. container:: table-row

   Property
         bodyTagAdd

   Data type
         :t3-data-type:`string`

   Description
         This content is added inside of the opening :html:`<body>` tag right
         before the :html:`>` character. This is mostly useful for adding
         attributes to the :html:`<body>` tag.

   Example
      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         # This will lead to <body class="example">
         page.bodyTagAdd = class="example"



.. index:: PAGE; bodyTagCObject
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


.. index:: PAGE; config
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



.. index:: PAGE; CSS_inlineStyle
.. _setup-page-css-inlinestyle:

CSS\_inlineStyle
================

..  versionchanged:: 12.0
    The TypoScript setting :typoscript:`page.CSS_inlineStyle` which was used to
    inject a inline CSS string into the TYPO3 Frontend will be removed with
    TYPO3 v12.

    Use :ref:`page.cssInline <setup-page-cssinline>` instead, which has
    been around since TYPO3 v4.

.. container:: table-row

   Property
         CSS\_inlineStyle

   Data type
         :t3-data-type:`string`

   Description
         This value is just passed on as CSS.

         **Note:** To make TYPO3 actually output these styles as *inline* CSS
         (in-document CSS encapsulated in :html:`<style>` tags),
         :ref:`config.inlineStyle2TempFile <setup-config-inlinestyle2tempfile>`
         must be set to 0.



.. index:: PAGE; cssInline.[array]
.. _setup-page-cssinline:

cssInline.[array]
=================

.. container:: table-row

   Property
         cssInline.[array]

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Allows to add inline CSS to the page :html:`<head>` section.
         The :typoscript:`cssInline` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            cssInline {
                10 = TEXT
                10.value = h1 {margin:15px;}

                20 = TEXT
                20.value = h1 span {color: blue;}
            }



.. index:: PAGE; footerData.[array]
.. _setup-page-footerdata:

footerData.[array]
==================

.. container:: table-row

   Property
         footerData.[array]

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Same as :ref:`setup-page-headerData`,
         except that this block gets included at the bottom of the page
         (just before the closing :html:`</body>` tag).

         The :typoscript:`footerData` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            footerData {
               3 = TEXT
               3.value = <script src="...."></script>

               50 = TEXT
               50.value = <!-- Hello from the comment! -->
            }


.. index:: PAGE; headerData.[array]
.. _setup-page-headerdata:

headerData.[array]
==================

.. container:: table-row

   Property
         headerData.[array]

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Inserts custom content in the head section of the website.

         While you can also use this to include stylesheet references or JavaScript,
         you should better use :ref:`page.includeCSS <setup-page-includecss-array>`
         and :ref:`page.includeJS <setup-page-includejs-array>` for such files.
         Features like file concatenation and file compression will not work on files,
         which are included using :typoscript:`headerData`.

         For meta tags, use the dedicated configuration :ref:`page.meta <meta>`.

         By default, gets inserted after all the style definitions.

         The :typoscript:`headerData` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.headerData {
               3 = TEXT
               3.value = <script src="...."></script>

               50 = TEXT
               50.value = <!-- Hello from the comment! -->
            }


.. index:: PAGE; headTag
.. _setup-page-headtag:

headTag
=======

.. container:: table-row

   Property
         headTag

   Data type
         :t3-data-type:`tag` / :ref:`stdwrap`

   Default
         <head>

   Description
         Head-tag if alternatives are wanted



.. index:: PAGE; includeCSS.[array]
.. _setup-page-includecss-array:

includeCSS.[array]
==================

.. container:: table-row

   Property
         includeCSS.[array]

   Data type
         :t3-data-type:`resource`

   Description
         Inserts a stylesheet (just like the :typoscript:`stylesheet` property), but allows
         setting up more than a single stylesheet, because you can enter files
         in an array.

         The file definition must be a valid :t3-data-type:`resource` data type,
         otherwise nothing is inserted.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **alternate**: If set (boolean) then the rel-attribute will be
         "alternate stylesheet".

         **disableCompression**: If :typoscript:`config.compressCss` is enabled, this
         disables the compression of this file.

         **excludeFromConcatenation**: If :typoscript:`config.concatenateCss` is
         enabled, this prevents the file from being concatenated.

         **external**: If set, there is no file existence check. Useful for
         inclusion of external files.

         **forceOnTop**: Boolean flag. If set, this file will be added on top
         of all other files.

         **if**: Allows to define conditions, which must evaluate to TRUE for
         the file to be included. If they do not evaluate to TRUE, the file
         will not be included. Extensive usage might cause huge numbers of
         temporary files to be created. See ->if for details.

         .. deprecated:: 11.5
            The option to use the `@import` syntax for including external CSS
            files through TypoScript has been deprecated. It is recommended to use
            the :html:`<link>` tag or instead create an inline CSS entry with TypoScript
            to load a file with the `@import` syntax.

         **import**: If set (boolean) then the `@import` way of including a
         stylesheet is used instead of :html:`<link>`

         **inline**: If set, the content of the CSS file is inlined using
         :html:`<style>` tags. Note that external files are not inlined.

         **media**: Setting the media attribute of the :html:`<style>` tag.

         **title**: Setting the title of the :html:`<style>` tag.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            includeCSS {
                styles = EXT:site_package/Resources/Public/Css/styles.css

                print = EXT:site_package/Resources/Public/Css/print.css
                print.title = High contrast
                print.media = print

                ie6 = EXT:site_package/Resources/Public/Css/ie6.css
                ie6.allWrap = <!--[if lte IE 7]>|<![endif]-->

                example = https://example.org/some_external_styles.css
                example.external = 1
            }



.. index:: PAGE; includeCSSLibs.[array]
.. _setup-page-includecsslibs-array:

includeCSSLibs.[array]
======================

.. container:: table-row

   Property
         includeCSSLibs.[array]

   Data type
         :t3-data-type:`resource`

   Description
         Adds CSS library files to head of page.

         The file definition must be a valid :t3-data-type:`resource` data type,
         otherwise nothing is inserted. This means that remote files cannot be referenced
         (i.e. using :samp:`https://...`), except by using the :typoscript:`.external` property.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative
         splitting character (default is "\|" - the vertical line).

         **alternate**: If set (boolean) then the rel-attribute will be
         "alternate stylesheet".

         **disableCompression**: If :typoscript:`config.compressCss` is
         enabled, this disables the compression of this file.

         **excludeFromConcatenation**: If :typoscript:`config.concatenateCss`
         is enabled, this prevents the file from being concatenated.

         **external**: If set, there is no file existence check. Useful for
         inclusion of external files.

         **forceOnTop**: Boolean flag. If set, this file will be added on top
         of all other files.

         **if**: Allows to define conditions, which must
         evaluate to TRUE for the file to be included. If they do not evaluate
         to TRUE, the file will not be included. Extensive usage might cause
         huge numbers of temporary files to be created. See ->if for details.

         .. deprecated:: 11.5
            The option to use the @import syntax for including external CSS
            files through TypoScript has been deprecated. It is recommended to use
            the :html:`<link>` tag or instead create an inline CSS entry with TypoScript
            to load a file with the `@import` syntax.

         **import**: If set (boolean) then the @import way of including a
         stylesheet is used instead of :html:`<link>`

         **media**: Setting the media attribute of the :html:`<style>` tag.

         **title**: Setting the title of the :html:`<style>` tag.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            includeCSSLibs.bootstrap = https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css
            includeCSSLibs.bootstrap.external = 1



.. index:: PAGE; includeJS.[array]
.. _setup-page-includejs-array:

includeJS.[array]
=================

.. container:: table-row

   Property
         includeJS.[array]

   Data type
         :t3-data-type:`resource`

   Description
         Inserts one or more (Java)Scripts in <script> tags.
         With :ref:`setup-config-movejsfromheadertofooter` set to TRUE all files
         will be moved to the footer.
         The file definition must be a valid :t3-data-type:`resource` data type,
         otherwise nothing is inserted. This means that remote files cannot be referenced
         (i.e. using :samp:`https://...`), except by using the :typoscript:`.external` property.

         Each file has *optional properties*:

         **allWrap**: Wraps the complete tag, useful for conditional
         comments.

         **allWrap.splitChar**: Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **async**: Allows the file to be loaded asynchronously.

         **crossorigin**: Allows to set the crossorigin attribute in script tags.
         Is automatically set to `anonymous` for external JavaScript files if an
         :typoscript:`.integrity` is set.

         **defer** Allows to set the HTML5 attribute :html:`defer`.

         **disableCompression**: If :typoscript:`config.compressJs` is enabled,
         this disables the compression of this file.

         **excludeFromConcatenation**: If :typoscript:`config.concatenateJs` is enabled,
         this prevents the file from being concatenated.

         **external**: If set, there is no file existence check. Useful for
         inclusion of external files.

         **forceOnTop**: Boolean flag. If set, this file will be added on top
         of all other files.

         **if**: Allows to define conditions, which must evaluate to TRUE for
         the file to be included. If they do not evaluate to TRUE, the file will
         not be included. Extensive usage might cause huge numbers of temporary
         files to be created. See ->if for details.

         **type**: Setting the MIME type of the script. Default: The attribute is
         omitted for frontend rendering when :typoscript:`config.doctype` is not set or
         set to :typoscript:`html5`. Otherwise :html:`text/javascript` is used as type.

         **integrity**: Adds the integrity attribute to the script element to let
         browsers ensure subresource integrity. Useful in hosting scenarios with
         resources externalized to CDN's. See `SRI <https://www.w3.org/TR/SRI/>`_ for
         more details. Integrity hashes may be generated using `<https://srihash.org/>`_.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            includeJS {
                helloworld = EXT:site_package/Resources/Public/JavaScript/helloworld.js
                helloworld.type = application/x-javascript

                # Include the file only if myConstant is set in the TS constants field.
                conditional = EXT:site_package/Resources/Public/JavaScript/conditional.js
                conditional.if.isTrue = {$myConstant}

                jquery = https://code.jquery.com/jquery-3.4.1.min.js
                jquery.external = 1
                jquery.integrity = sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh
            }



.. index:: PAGE; includeJSFooter.[array]
.. _setup-page-includejsfooter-array:

includeJSFooter.[array]
=======================

.. container:: table-row

   Property
         includeJSFooter.[array]

   Data type
         :t3-data-type:`resource`

   Description
         Add JS files to footer (after possible files set in :ref:`includeJSFooterlibs <setup-page-includejsfooterlibs-array>`)

         Same as :ref:`includeJS <setup-page-includejs-array>` above, except that this block gets
         included at the bottom of the page (just before the closing :html:`</body>`
         tag).



.. index:: PAGE; includeJSFooterlibs.[array]
.. _setup-page-includejsfooterlibs-array:

includeJSFooterlibs.[array]
===========================

.. container:: table-row

   Property
         includeJSFooterlibs.[array]

   Data type
         :t3-data-type:`resource`

   Description
         Add JS library files to footer.

         Same as :ref:`includeJSLibs <setup-page-includejslibs-array>`, except that this block gets
         included at the bottom of the page (just before the closing :html:`</body>`
         tag).

         The optional properties from :ref:`includeJS <setup-page-includejs-array>`
         can be applied.


.. index:: PAGE; includeJSLibs.[array]
.. _setup-page-includejslibs-array:

includeJSLibs.[array]
=====================

.. container:: table-row

   Property
         includeJSLibs.[array]

   Data type
         :t3-data-type:`resource`

   Description
         Adds JS library files to head of page.

         Same as :ref:`includeJSFooterlibs <setup-page-includejsfooterlibs-array>`, except that this block gets
         included inside :html:`<head>`.
         tag).

         The optional properties from :ref:`includeJS <setup-page-includejs-array>`
         can be applied.


.. index:: PAGE; inlineLanguageLabelFiles
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
         the JavaScript object :js:`TYPO3.lang`.

         **Available sub-properties:**

         **selectionPrefix:** Only label keys that start with this prefix will
         be included. Default: ''.

         **stripFromSelectionName:** A string that will be removed from any
         included label key. Default: ''.

         **errorMode:** Error mode if the file could not be found:
         0 - syslog entry, 1 - do nothing, 2 - throw an exception.
         Default: 0

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            inlineLanguageLabelFiles {
                someLabels = EXT:myExt/Resources/Private/Language/locallang.xlf
                someLabels.selectionPrefix = idPrefix
                someLabels.stripFromSelectionName = strip_me
                someLabels.errorMode = 2
            }


.. index:: PAGE; inlineSettings
.. _setup-page-inlinesettings:

inlineSettings
==============

.. container:: table-row

   Property
         inlineSettings

   Data type
         (array of strings)

   Description
         Adds settings to the page as inline javascript, which is accessible within the variable :js:`TYPO3.settings`.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.inlineSettings {
                setting1 = Hello
                setting2 = GoOnTop
            }

         Will produce following source

         .. code-block:: js

            TYPO3.settings = {"TS":{"setting1":"Hello","setting2":"GoOnTop"}};



.. index:: PAGE; jsFooterInline.[array]
.. _setup-page-jsfooterinline:

jsFooterInline.[array]
======================

.. container:: table-row

   Property
         jsFooterInline

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Same as :typoscript:`jsInline`, except that the JavaScript gets inserted at the
         bottom of the page (just before the closing :html:`</body>` tag).

         The :typoscript:`jsFooterInline` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.jsFooterInline {
                10 = TEXT
                10.stdWrap.dataWrap = var pageId = {TSFE:id};
            }


.. index:: PAGE; jsInline.[array]
.. _setup-page-jsinline:

jsInline.[array]
================

.. container:: table-row

   Property
         jsInline

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         Use array of cObjects for creating inline JavaScript.

         **Note:**

         With :typoscript:`config.removeDefaultJS = external`, the inline JavaScript is moved
         to an external file.

         The :typoscript:`jsInline` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

   Example
         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.jsInline {
                10 = TEXT
                10.stdWrap.dataWrap = var pageId = {TSFE:id};
            }



.. index:: PAGE; meta
.. _setup-page-meta:
.. _meta:

meta
====

.. container:: table-row

   Property
         meta

   Data type
         array of key names (string / :ref:`stdWrap <stdwrap>`)

   Description
         Use the scheme :typoscript:`meta.key = value` to define any HTML meta tag.

         :typoscript:`value` is the content of the meta tag. If the value is empty (after
         trimming), the meta tag is not generated.

         The :typoscript:`key` can be the name of any meta tag, for example :html:`description` or
         :html:`keywords`. If the key is :typoscript:`refresh` (case insensitive), then the
         :html:`http-equiv` attribute is used in the meta tag instead of the :html:`name`
         attribute.

         For each key the following sub-properties are available:

         :aspect:`httpEquivalent`
         If set to 1, the :html:`http-equiv` attribute is used in the meta
         tag instead of the :html:`name` attribute. Default: 0.

         :aspect:`replace`
         If set to 1, the tag will replace the one set earlier by a plugin. If set
         to 0 (default), the meta tag generated by the plugin will be used. If
         there is none yet, the one from TypoScript is set.

   Examples:
         Simple definition:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

             meta.description = This is the description of the content in this document.
             meta.keywords = These are the keywords.

         Fetch data from the keywords field of the current or any parent page:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

             meta.keywords.data = levelfield:-1, keywords, slide

         Make a meta.refresh entry:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

             meta.refresh = [seconds]; [URL, leave blank for same page]

         Usage of :typoscript:`httpEquivalent`:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

             meta.X-UA-Compatible = IE=edge
             meta.X-UA-Compatible.httpEquivalent = 1

         Result:

         .. code-block:: html
            :caption: Example output

              <meta http-equiv="X-UA-Compatible" content="IE=edge">.

         Meta tags with a different attribute name are supported like the
         Open Graph meta tags:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page {
                meta {
                   X-UA-Compatible = IE=edge
                   X-UA-Compatible.attribute = http-equiv
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
                   refresh = 5; url=https://example.org/
                   refresh.attribute = http-equiv
                }
            }

         They can be used like :typoscript:`property` used for OG tags in the example.

         You may also supply multiple values for one name, which results in
         multiple meta tags with the same name to be rendered.

         Result for :typoscript:`og:description`:

         .. code-block:: html

              <meta property="og:description"
                  content="Inspiring people to share [OpenGraph]" />

         See https://ogp.me/ for more information about the Open Graph
         protocol and its properties.


.. index:: PAGE; shortcutIcon
.. _setup-page-shortcuticon:

shortcutIcon
============

.. container:: table-row

   Property
      shortcutIcon

   Data type
      :t3-data-type:`resource`

   Description
      Favicon of the page. Create a reference to an icon here!

      Browsers that support favicons display them in the address bar of
      the browser, next to the name of the site in lists of bookmarks
      and next to the title of the page in the tab.

      Example:
      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page.shortcutIcon = EXT:site_package/Resources/Public/Images/favicon.ico

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


.. index:: PAGE; typeNum
.. _setup-page-typenum:

typeNum
=======

.. container:: table-row

   Property
         typeNum

   Data type
         :t3-data-type:`integer`

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
         :t3-data-type:`wrap`

   Description
         Wraps the content of the cObject array.


.. ###### END~OF~TABLE ######


.. toctree::
   :hidden:

   Examples
