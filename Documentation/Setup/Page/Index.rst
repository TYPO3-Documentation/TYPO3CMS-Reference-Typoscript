.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _page:

page
====

Pages are referenced by two main values. The "id" and "type".

**The "id"** points to the uid of the page (or the alias). Thus the
page is found.

**The "type"** is used to define how the page should be rendered. This
is primarily used with framesets. Here the frameset normally has the
type=0 (or not set) and the documents in the frameset would be defined
with another type, e.g. type=1 for the content-page.

You should explore the framesets of the TYPO3-sites around. Also look
in the standard-templates for framesets.

It's a good habit to use type=1 for the main-page of a website with
frames. With no-frames sites type is normally zero.

Another good habit is to use "page" as the top-level object name for
the content-page on a website.

Most of this code is executed in the PHP script
*typo3/sysext/frontend/Classes/Page/PageGenerator.php*.

.. only:: html

   .. contents::
      :local:
      :depth: 1

Properties
^^^^^^^^^^

.. container:: ts-properties

   ============================== ================================= ====================== ========================
   Property                       Data Type                         :ref:`stdwrap`         Default
   ============================== ================================= ====================== ========================
   `1,2,3,4...`_                  cObject
   `adminPanelStyles`_            :ref:`data-type-boolean`
   `bgImg`_                       imgResource
   `bodyTag`_                     <tag>                                                    <body>
   `bodyTagAdd`_                  :ref:`data-type-string`
   `bodyTagCObject`_              cObject
   `bodyTagMargins`_              :ref:`data-type-integer`
   `config`_                      ->CONFIG
   `CSS\_inlineStyle`_            :ref:`data-type-string`
   `cssInline`_                   ->CARRAY
   `extOnReady`_                  ->CARRAY
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
   `includeLibs`_                 *(array of strings)*
   `inlineLanguageLabel`_         *(array of strings)*
   `inlineSettings`_              *(array of strings)*
   `insertClassesFromRTE`_        :ref:`data-type-boolean`
   `javascriptLibs`_              *(array of strings)*
   `jsFooterInline`_              ->CARRAY
   `jsInline`_                    ->CARRAY
   `meta`_                        ->META
   `shortcutIcon`_                :ref:`data-type-resource`
   `stdWrap`_                     ->:ref:`stdWrap <stdwrap>`
   `stylesheet`_                  :ref:`data-type-resource`
   `typeNum`_                     :ref:`data-type-integer`                                 0
   `wrap`_                        wrap
   ============================== ================================= ====================== ========================

Property details
^^^^^^^^^^^^^^^^

.. only:: html

   .. contents::
      :local:
      :depth: 1

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


.. _setup-page-adminpanelstyles:

adminPanelStyles
""""""""""""""""

.. container:: table-row

   Property
         adminPanelStyles

   Data type
         boolean

   Description
         Will include CSS styles for the Admin Panel.



.. _setup-page-bgimg:

bgImg
"""""

.. container:: table-row

   Property
         bgImg

   Data type
         imgResource

   Description
         Background image on the page. This is automatically added to the body-
         tag.



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
         Use cObjects for creating inline CSS

         **Example:** ::

            cssInline {
                10 = TEXT
                10.value = h1 {margin:15px;}

                20 = TEXT
                20.value = h1 span {color: blue;}
            }



.. _setup-page-extonready:

extOnReady
""""""""""

.. container:: table-row

   Property
         extOnReady

   Data type
         ->CARRAY

   Description
         ExtJS specific, adds inline JavaScript, wrapped in Ext.onReady.

         **Example:** ::

            page.extOnReady {
               10 = TEXT
               10.value = Ext.Msg.alert("TypoScript Message","Hello World!");
            }

         will produce following source::

            Ext.onReady(function() {Ext.Msg.alert("TypoScript Message","Hello World!"); });



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
         Inserts content in the header-section. Could be JavaScripts, meta-
         tags, other stylesheet references.

         By default, gets inserted after all the style definitions.



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
              cooliris = http://www.cooliris.com/shared/
                         resources/css/global.css
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
         (i.e. using "http://..."), except by using the ".external" property.

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

            includeCSSLibs.twitter = http://twitter.com/styles/blogger.css
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

         The file definition must be a valid "resource" data type, otherwise
         nothing is inserted. This means that remote files cannot be referenced
         (i.e. using "http://..."), except by using the ".external" property.

         Each file has *optional properties*:

         **.allWrap:** Wraps the complete tag, useful for conditional
         comments.

         **.allWrap.splitChar:** Defines an alternative splitting character
         (default is "\|" - the vertical line).

         **.async:** (Since TYPO3 7.1) Allows the file to be loaded
         asynchronously.

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

         **.async:** (Since TYPO3 7.1) Allows the file to be loaded
         asynchronously.

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

         **Example:** ::

            includeJSLibs.twitter = http://twitter.com/javascripts/blogger.js
            includeJSLibs.twitter.external = 1



.. _setup-page-includelibs:

includeLibs
"""""""""""

.. container:: table-row

   Property
         includeLibs

   Data type
         *(array of strings)*

   Description
         With this you may include PHP files. This does the same as
         "includeLibrary" in ->CONFIG but this can include more than one file.
         These files are included *after* the file of includeLibrary.

         **Note:**

         The top-level object "includeLibs" and the scripts defined with this
         property is added to each other. Script-keys (that is the "array of
         strings"-value, like below "tx\_myext") from this property of the page
         overrides any scripts-keys from the top-level "includeLibs" property!

         The script filenames are of the data type "resource".

         **Example:** ::

            includeLibs.tx_myext = lib_filename.php



.. _setup-page-inlinelanguagelabel:

inlineLanguageLabel
"""""""""""""""""""

.. container:: table-row

   Property
         inlineLanguageLabel

   Data type
         *(array of strings)*

   Description
         ExtJS specific, adds language labels to the page.

         **Example:** ::

            inlineLanguageLabel {
               label1 = 123
               label2 = 456
            }

         will produce following source::

            TYPO3.lang = {"label1":"123","label2":"456"};



.. _setup-page-inlinesettings:

inlineSettings
""""""""""""""

.. container:: table-row

   Property
         inlineSettings

   Data type
         *(array of strings)*

   Description
         ExtJS specific, adds settings to the page.

         **Example:** ::

            page.inlineSettings {
               setting1 = Hello
               setting2 = GoOnTop
            }

         will produce following source::

            TYPO3.settings = {"TS":{"setting1":"Hello","setting2":"GoOnTop"}};



.. _setup-page-insertclassesfromrte:

insertClassesFromRTE
""""""""""""""""""""

.. container:: table-row

   Property
         insertClassesFromRTE

   Data type
         boolean

   Description
         If set, the classes for the Rich Text Editor configured in Page
         TSconfig are inserted as the first thing in the Style-section right
         after the setting of the stylesheet.

         **.add\_mainStyleOverrideDefs:** [\* / list of tags ]. Will add all
         the "RTE.default. mainStyleOverride\_add" - tags configured as well.

         *Might be deprecated soon. Most likely the RTE should be configured by
         the stylesheet instead. Stay tuned...*



.. _setup-page-javascriptlibs:

javascriptLibs
""""""""""""""

.. container:: table-row

   Property
         javascriptLibs

   Data type
         *(array of strings)*

   Description
         This allows to include the JavaScript libraries that are shipped with
         the TYPO3 Core. ::

            javascriptLibs {
               # include jQuery (boolean)
               jQuery = 1
               # Change the version
               # (possible values: latest|1.7.2|…, default: latest)
               # Note: jQuery.source has to be a CDN like "google"
               # when jQuery.version is not "latest"
               jQuery.version = latest
               # Include from local or different CDNs
               # (possible values: local|google|jquery|msn, default: local)
               jQuery.source = local
               # Set jQuery into its own scope to avoid conflicts (boolean)
               jQuery.noConflict = 1
               # Change the namespace when noConflict is activated
               # and use jQuery with "TYPO3.###NAMESPACE###(…);"
               # (string, default: jQuery)
               jQuery.noConflict.namespace = ownNamespace

                 # include prototype
               Prototype = 1

                 # include Scriptaculous
               Scriptaculous = 1
                 # adds modules dragdrop and controls to Scriptaculous
               Scriptaculous.modules = dragdrop,controls

                 # include ExtCore
               ExtCore = 1
                 # include ExtCore debug file (uncompressed)
               ExtCore.debug = 1

                 # includes ExtJS
               ExtJs = 1
                 # include ext-all.css
               ExtJs.css = 1
                 # include default theme
               ExtJs.theme = 1
                # load specific adapter (jquery|prototype|yui)
               ExtJs.adapter = …
                 # initialize QuickTips
               ExtJs.quickTips = 1
                 # includes ExtJS debug file (uncompressed)
               ExtJs.debug = 1

                 # include SVG library
               SVG = 1
                 # include SVG debug file
               SVG.debug = 1
                 #force rendering with flash
               SVG.forceFlash = 1
            }

         **Note:** If both ExtCore and ExtJS are requested, the only superset
         ExtJS will be loaded. This will also affect any options set. They will
         only come from ExtJS.



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
         ->META



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

   Description
         This determines the typeId of the page. The *&type=* parameter in the URL
         determines, which page object will be rendered. The value defaults to 0 for
         the first found PAGE object, but it **must** be set and be unique as
         soon as you use *more* than one such object (watch this if you use frames
         on your page)!

   Default
         0



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
