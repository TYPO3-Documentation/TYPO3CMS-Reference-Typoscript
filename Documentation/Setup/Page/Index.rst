.. include:: /Includes.rst.txt


.. _page:
.. _page-datatype:
.. _object-type-page:
.. _tlo-page:


===========
PAGE & page
===========

This defines what is rendered in the frontend.

PAGE is an object type. A good habit is to use :typoscript:`page` as the top-level object name for
the content-page on a website.

TYPO3 does not initialize :typoscript:`page` by default. You must initialize this
explicitly, e.g.::

    page = PAGE


Pages are referenced by two main values. The "id" and "type".

**The "id"** points to the uid of the page (or the alias). Thus the
page is found.

Most of this code is executed in the PHP script
:file:`typo3/sysext/frontend/Classes/Page/PageGenerator.php`.


Multiple pages
==============


**The "type"** is used to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 while a JSON stream with the same
content could go with type 1.

A good habit is to use "page" as the top-level object name for
the content-page on a website.

Most of this code is executed in the PHP script
*typo3/sysext/frontend/Classes/Page/PageGenerator.php*.
=======
When rendering pages in the frontend, TYPO3 uses the GET parameter **"type"**
to define how the page should be rendered. This
is primarily used with different representations of the same content.
Your default page will most likely have type 0 (which is the default) while a JSON
stream with the same content could go with type 1.

The property :ref:`typeNum <setup-page-typenum>`  defines for which type,
the page will be used.

Example::

    page = PAGE
    page.typeNum = 0
    page {
       # set properties ...
    }

    json = PAGE
    json.typeNum = 1
    # ...

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



Properties
^^^^^^^^^^

.. container:: ts-properties

   ============================== ================================= ====================== ========================
   Property                       Data Type                         :ref:`stdwrap`         Default
   ============================== ================================= ====================== ========================
   `1,2,3,4...`_                  cObject
   `bodyTag`_                     <tag>                                                    <body>
   `bodyTagAdd`_                  :ref:`data-type-string`
   `bodyTagCObject`_              cObject
   `bodyTagMargins`_              :ref:`data-type-integer`
   `config`_                      ->CONFIG
   `CSS\_inlineStyle`_            :ref:`data-type-string`
   `cssInline`_                   ->CARRAY
   `footerData`_                  ->CARRAY
   `frameSet`_                    ->FRAMESET
   `headerData`_                  ->CARRAY
   `headTag`_                     <tag> /stdWrap                                           <head>
   `includeCSS.[array]`_          :ref:`data-type-resource`
   `includeCSSLibs.[array]`_      :ref:`data-type-resource`
   `includeJS.[array]`_           :ref:`data-type-resource`
   `includeJSFooter.[array]`_     :ref:`data-type-resource`
   `includeJSFooterlibs.[array]`_ :ref:`data-type-resource`
   `includeJSLibs.[array]`_       :ref:`data-type-resource`
   `inlineLanguageLabelFiles`_    *(array of strings)*
   `inlineSettings`_              *(array of strings)*
   `javascriptLibs`_              *(array of strings)*
   `jsFooterInline`_              ->CARRAY
   `jsInline`_                    ->CARRAY
   `meta`_                        :ref:`->META <meta>`
   `shortcutIcon`_                :ref:`data-type-resource`
   `stdWrap`_                     :ref:`stdWrap <stdwrap>`
   `stylesheet`_                  :ref:`data-type-resource`
   `typeNum`_                     :ref:`data-type-integer`                                 0
   `wrap`_                        wrap
   ============================== ================================= ====================== ========================

Property details
^^^^^^^^^^^^^^^^

.. ### BEGIN~OF~TABLE ###


.. _setup-page-1-2-3-4:

1,2,3,4...
""""""""""

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
"""""""

.. container:: table-row

   Property
         bodyTag

   Data type
         <tag>

   Description
         Body tag on the page

         **Example:**

         .. code:: html

         	<body bgcolor="{$bgCol}">

   Default
         <body>



.. _setup-page-bodytagadd:

bodyTagAdd
""""""""""

.. container:: table-row

   Property
         bodyTagAdd

   Data type
         string

   Description
         This content is added to the end of the bodyTag.



.. _setup-page-bodytagcobject:

bodyTagCObject
""""""""""""""

.. container:: table-row

   Property
         bodyTagCObject

   Data type
         cObject

   Description
         This is the default body tag. It is overridden by ".bodyTag", if
         that is set.

         **Note:** Additionally to the body tag properties noted here,
         there also is the property "config.disableBodyTag", which - if set
         - disables body tag generation independently from what might be set
         here.



.. _setup-page-bodytagmargins:

bodyTagMargins
""""""""""""""

.. container:: table-row

   Property
         bodyTagMargins

   Data type
         integer

   Description
         margins in the body tag.

         **Property:**

         .useCSS = 1 (boolean) - will set a "BODY {margin: ...}" line in the
         in-document style declaration - for XHTML compliance.

         **Example:** ::

            bodyTagMargins = 4

         This adds *leftmargin="4" topmargin="4" marginwidth="4"
         marginheight="4"* to the bodyTag.



.. _setup-page-config:

config
""""""

.. container:: table-row

   Property
         config

   Data type
         ->CONFIG

   Description
         Configuration for the page. Any entries made here override the same
         entries in the top-level object "config".



.. _setup-page-css-inlinestyle:

CSS\_inlineStyle
""""""""""""""""

.. container:: table-row

   Property
         CSS\_inlineStyle

   Data type
         string

   Description
         This value is just passed on as CSS.

         **Note:** To make TYPO3 actually output these styles as *inline* CSS
         (in-document CSS encapsulated in <style> tags),
         :ref:`config.inlineStyle2TempFile <setup-config-inlinestyle2tempfile>`
         must be set to 0.



.. _setup-page-cssinline:

cssInline
"""""""""

.. container:: table-row

   Property
         cssInline

   Data type
         ->CARRAY

   Description
         Allows to add inline CSS to the page :html:`<head>` section.
         The :typoscript:`cssInline` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

         **Example:** ::

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
""""""""""

.. container:: table-row

   Property
         footerData

   Data type
         ->CARRAY

   Description
         Same as headerData above, except that this block gets included at the
         bottom of the page (just before the closing body tag).

         The :typoscript:`footerData` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.


.. _setup-page-frameset:

frameSet
""""""""

.. container:: table-row

   Property
         frameSet

   Data type
         ->FRAMESET

   Description
         if any properties is set to this property, the page is made into a
         frameset.



.. _setup-page-headerdata:

headerData
""""""""""

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
         which are included using headerData.

         By default, gets inserted after all the style definitions.

         The :typoscript:`headerData` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

   Example
         ::

            page.headerData {
               3 = TEXT
               3.value = <script src="...."></script>

               50 = TEXT
               50.value = <!-- Hello from the comment! -->
            }


.. _setup-page-headtag:

headTag
"""""""

.. container:: table-row

   Property
         headTag

   Data type
         <tag> /stdWrap

   Description
         Head-tag if alternatives are wanted

   Default
         <head>



.. _setup-page-includecss-array:

includeCSS.[array]
""""""""""""""""""

.. container:: table-row

   Property
         includeCSS.[array]

   Data type
         resource

   Description
         Inserts a stylesheet (just like the .stylesheet property), but allows
         setting up more than a single stylesheet, because you can enter files
         in an array.

         The file definition must be a valid "resource" data type, otherwise
         nothing is inserted.

         Each file has *optional properties*:

         **.allWrap:** Wraps the complete tag, useful for conditional
         comments.

         **.allWrap.splitChar:** Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **.alternate:** If set (boolean) then the rel-attribute will be
         "alternate stylesheet".

         **.disableCompression:** If config.compressCss is enabled, this
         disables the compression of this file.

         **.excludeFromConcatenation:** If config.concatenateCss is
         enabled, this prevents the file from being concatenated.

         **.external:** If set, there is no file existence check. Useful for
         inclusion of external files.

         **.forceOnTop:** Boolean flag. If set, this file will be added on top
         of all other files.

         **.if:** Allows to define conditions, which must evaluate to TRUE for
         the file to be included. If they do not evaluate to TRUE, the file
         will not be included. Extensive usage might cause huge numbers of
         temporary files to be created. See ->if for details.

         **.import:** If set (boolean) then the @import way of including a
         stylesheet is used instead of <link>

         **.media:** Setting the media attribute of the <style> tag.

         **.title:** Setting the title of the <style> tag.

         **Example:** ::

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
""""""""""""""""""""""

.. container:: table-row

   Property
         includeCSSLibs.[array]

   Data type
         resource

   Description
         Adds CSS library files to head of page.

         The file definition must be a valid "resource" data type, otherwise
         nothing is inserted. This means that remote files cannot be referenced
         (i.e. using :samp:`https://...`), except by using the ".external" property.

         Each file has *optional properties*:

         **.allWrap:** Wraps the complete tag, useful for conditional
         comments.

         **.allWrap.splitChar:** Defines an alternative
         splitting character (default is "\|" - the vertical line).

         **.alternate:** If set (boolean) then the rel-attribute will be
         "alternate stylesheet".

         **.disableCompression:** If config.compressCss is
         enabled, this disables the compression of this file.

         **.excludeFromConcatenation:** If
         config.concatenateCss is enabled, this prevents the file from being
         concatenated.

         **.external:** If set, there is no file existence check. Useful for
         inclusion of external files.

         **.forceOnTop:** Boolean flag. If set, this file will be added on top
         of all other files.

         **.if:** Allows to define conditions, which must
         evaluate to TRUE for the file to be included. If they do not evaluate
         to TRUE, the file will not be included. Extensive usage might cause
         huge numbers of temporary files to be created. See ->if for details.

         **.import:** If set (boolean) then the @import way of including a
         stylesheet is used instead of <link>

         **.media:** Setting the media attribute of the <style> tag.

         **.title:** Setting the title of the <style> tag.

         **Example:** ::

            includeCSSLibs.twitter = https://twitter.com/styles/blogger.css
            includeCSSLibs.twitter.external = 1



.. _setup-page-includejs-array:

includeJS.[array]
"""""""""""""""""

.. container:: table-row

   Property
         includeJS.[array]

   Data type
         resource

   Description
         Inserts one or more (Java)Scripts in <script> tags.
         With :ref:`setup-config-movejsfromheadertofooter` set to TRUE all files
         will be moved to the footer.
         The file definition must be a valid "resource" data type, otherwise
         nothing is inserted. This means that remote files cannot be referenced
         (i.e. using :samp:`https://...`), except by using the ".external" property.

         Each file has *optional properties*:

         **.allWrap:** Wraps the complete tag, useful for conditional
         comments.

         **.allWrap.splitChar:** Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **.async:** Allows the file to be loaded asynchronously.

         **.disableCompression:** If config.compressJs is enabled, this
         disables the compression of this file.

         **.excludeFromConcatenation:** If config.concatenateJs is enabled,
         this prevents the file from being concatenated.

         **.external:** If set, there is no file existence check. Useful for
         inclusion of external files.

         **.forceOnTop:** Boolean flag. If set, this file will be added on top
         of all other files.

         **.if:** Allows to define conditions, which must evaluate to TRUE for
         the file to be included. If they do not evaluate to TRUE, the file will
         not be included. Extensive usage might cause huge numbers of temporary
         files to be created. See ->if for details.

         **.type:** Setting the MIME type of the script (default:
         text/javascript).

         **.integrity:** Adds the integrity attribute to the script element to let
         browsers ensure subresource integrity. Useful in hosting scenarios with
         resources externalized to CDN's. See `SRI <https://www.w3.org/TR/SRI/>`_ for
         more details. Integrity hashes may be generated using `<https://srihash.org/>`_.

         **Example:** ::

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
"""""""""""""""""""""""

.. container:: table-row

   Property
         includeJSFooter.[array]

   Data type
         resource

   Description
         Same as includeJS above, except that this block gets included at the
         bottom of the page (just before the closing body tag).



.. _setup-page-includejsfooterlibs-array:

includeJSFooterlibs.[array]
"""""""""""""""""""""""""""

.. container:: table-row

   Property
         includeJSFooterlibs.[array]

   Data type
         resource

   Description
         Same as includeJSLibs, except that this block gets included at
         the bottom of the page (just before the closing body tag).



.. _setup-page-includejslibs-array:

includeJSLibs.[array]
"""""""""""""""""""""

.. container:: table-row

   Property
         includeJSLibs.[array]

   Data type
         resource

   Description
         Adds JS library files to head of page.

         The file definition must be a valid "resource" data type, otherwise
         nothing is inserted. This means that remote files cannot be referenced
         (i.e. using "http://..."), except by using the ".external" property.

         Each file has *optional properties*:

         **.allWrap:** Wraps the complete tag, useful for conditional
         comments.

         **.allWrap.splitChar:** Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **.async:** Allows the file to be loaded asynchronously.

         **.disableCompression:** If config.compressJs is enabled, this
         disables the compression of this file.

         **.excludeFromConcatenation:** If config.concatenateJs is enabled,
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
         resources externalized to CDN's. See `SRI <https://www.w3.org/TR/SRI/>`_ for
         more details. Integrity hashes may be generated using `<https://srihash.org/>`_.

         **Example:** ::

            includeJSLibs.twitter = https://twitter.com/javascripts/blogger.js
            includeJSLibs.twitter.external = 1
            includeJSLibs.twitter.integrity = sha256-C6CB9UYIS9UJeqinPHWTHVqh/E1uhG5Twh+Y5qFQmYg=





.. _setup-page-inlinelanguagelabelfiles:

inlineLanguageLabelFiles
""""""""""""""""""""""""

.. container:: table-row

   Property
         inlineLanguageLabelFiles

   Data type
         *(array of strings)*

   Description
         Adds language labels to the page.

         **Available sub-properties:**

         **selectionPrefix:** Only label keys that start with this prefix will
         be included. Default: ''.

         **stripFromSelectionName:** A string that will be removed from any
         included label key. Default: ''.

         **errorMode:** Error mode if the file could not be found:
         0 - syslog entry, 1 - do nothing, 2 - throw an exception.
         Default: 0

         **Example:** ::

            inlineLanguageLabelFiles {
               someLabels = EXT:myExt/Resources/Private/Language/locallang.xlf
               someLabels.selectionPrefix = idPrefix
               someLabels.stripFromSelectionName = strip_me
               someLabels.errorMode = 2
            }


.. _setup-page-inlinesettings:

inlineSettings
""""""""""""""

.. container:: table-row

   Property
         inlineSettings

   Data type
         *(array of strings)*

   Description
         Adds settings to the page as inline javascript, which is accessible within the variable :js:`TYPO3.settings`.

         **Example:** ::

            page.inlineSettings {
               setting1 = Hello
               setting2 = GoOnTop
            }

         will produce following source::

            TYPO3.settings = {"TS":{"setting1":"Hello","setting2":"GoOnTop"}};



.. _setup-page-javascriptlibs:

javascriptLibs
""""""""""""""

.. container:: table-row

   Property
         javascriptLibs

   Data type
         *(array of strings)*

   Description
         Same as :typoscript:`jsInline`, except that the JavaScript gets inserted at the
         bottom of the page (just before the closing :html:`</body>` tag).

         The :typoscript:`jsFooterInline` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.




.. _setup-page-jsfooterinline:

jsFooterInline
""""""""""""""

.. container:: table-row

   Property
         jsFooterInline

   Data type
         ->CARRAY

   Description
         Same jsInline above, except that the JavaScript gets inserted at the
         bottom of the page (just before the closing body tag).


         The :typoscript:`jsInline` property contains any number of numeric keys, each representing one cObject.
         Internally handled as PHP integer, maximum number is therefore restricted to :php:`PHP_INT_MAX`.

.. _setup-page-jsinline:

jsInline
""""""""

.. container:: table-row

   Property
         jsInline

   Data type
         ->CARRAY

   Description
         Use cObjects for creating inline JavaScript

         **Example:** ::

            page.jsInline {
                    10 = TEXT
                    10.stdWrap.dataWrap = var pageId = {TSFE:id};
            }

         **Note:**

         With config.removeDefaultJS = external, the inline JavaScript is
         moved to an external file.



.. _setup-page-meta:

meta
""""

.. container:: table-row

   Property
         meta

   Data type
         :ref:`->META <meta>`

   Description
         ./.




.. _setup-page-shortcuticon:

shortcutIcon
""""""""""""

.. container:: table-row

   Property
         shortcutIcon

   Data type
         resource

   Description
         Favicon of the page. Create a reference to an icon here!

         Browsers that support favicons display them in the address bar of
         the browser, next to the name of the site in lists of bookmarks
         and next to the title of the page in the tab.

         **Note:** The file must be a valid ".ico" file (icon file).

         **Note:** The reference to this file will only be included in the
         output of your website, if the file actually exists! Should the
         file be missing, the tag will not be rendered.



.. _setup-page-stdwrap:

stdWrap
"""""""

.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description
         Wraps the content of the cObject array with stdWrap options.



.. _setup-page-stylesheet:

stylesheet
""""""""""

.. container:: table-row

   Property
         stylesheet

   Data type
         resource

   Description
         Inserts a stylesheet in the <HEAD>-section of the page;

         *<link rel="stylesheet" href="[resource]">*



.. _setup-page-typenum:

typeNum
"""""""

.. container:: table-row

   Property
         typeNum

   Data type
         integer

   Default
         0

   Description
         This determines the typeId of the page. The *&type=* parameter in the URL
         determines, which page object will be rendered. The value defaults to 0 for
         the first found PAGE object, but it **must** be set and be unique as
         soon as you use *more* than one such object (watch this if you use frames
         on your page)!



.. _setup-page-wrap:

wrap
""""

.. container:: table-row

   Property
         wrap

   Data type
         wrap

   Description
         Wraps the content of the cObject array.


.. ###### END~OF~TABLE ######
