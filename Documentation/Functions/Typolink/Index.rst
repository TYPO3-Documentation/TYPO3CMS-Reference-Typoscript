.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt
.. include:: Images.txt


typolink
^^^^^^^^

Wraps the incoming value with link.

If this is used from parseFunc the $cObj->parameters-array is loaded
with the link-parameters (lowercased)!

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         extTarget

   Data type
         target /stdWrap

   Description
         Target used for external links

   Default
         \_top


.. container:: table-row

   Property
         fileTarget

   Data type
         target /stdWrap

   Description
         Target used for file links

   Default


.. container:: table-row

   Property
         target

   Data type
         target /stdWrap

   Description
         Target used for internal links

   Default


.. container:: table-row

   Property
         no\_cache

   Data type
         boolean /stdWrap

   Description
         Adds a "&no\_cache=1"-parameter to the link

   Default


.. container:: table-row

   Property
         useCacheHash

   Data type
         boolean

   Description
         If set, the additionalParams list is exploded and calculated into a
         hash string appended to the url, like "&cHash=ae83fd7s87". When the
         caching mechanism sees this value, it calculates the same value on the
         server based on incoming values in HTTP\_GET\_VARS, excluding
         id,type,no\_cache,ftu,cHash,MP values. If the incoming cHash value
         matches the calculated value, the page may be cached based on this.

         The $TYPO3\_CONF\_VARS['SYS']['encryptionKey'] is included in the hash
         in order to make it unique for the server and non-predictable.

   Default


.. container:: table-row

   Property
         additionalParams

   Data type
         string /stdWrap

   Description
         This is parameters that are added to the end of the url. This must be
         code ready to insert after the last parameter.

         **Example:**

         '&print=1'

         '&sword\_list[]=word1&sword\_list[]=word2'

         **Applications:**

         This is very useful – for example – when linking to pages from a
         search result. The search words are stored in the register-key
         SWORD\_PARAMS and can be insert directly like this::

            .additionalParams.data = register:SWORD_PARAMS

         **NOTE:** This is only active for internal links!

   Default


.. container:: table-row

   Property
         addQueryString

   Data type
         boolean

   Description
         Add the QUERY\_STRING to the start of the link. Notice that this does
         not check for any duplicate parameters! This is not a problem (only
         the last parameter of the same name will be applied), but enable
         "config.uniqueLinkVars" if you still don't like it.

         **.method:** If set to to GET or POST then then the parsed query
         arguments (GET or POST data) will be used. This settings are useful if
         you use URL processing extensions like Real URL, which translate part
         of the path into query arguments.

         It's also possible to get both, POST and GET data, on setting this to

         "POST,GET" or "GET,POST". The last method in this sequence takes

         precedence and overwrites the parts that are also present for the
         first

         method.

         **.exclude:** List of query arguments to exclude from the link (eg L
         or cHash).

   Default


.. container:: table-row

   Property
         jumpurl

   Data type
         boolean

   Description
         Decides if the link should call the script with the jumpurl parameter
         in order to register any clicks in statistics.

         This works the same way as "filelink.jumpurl" does – for more details
         see the description there.

         **Example:** ::

            lib.parseFunc_RTE.tags.link {
              typolink.jumpurl = 1
              typolink.jumpurl.secure = 1
              typolink.jumpurl.secure.mimeTypes = pdf=application/pdf, doc=application/msword, png=image/png, gif=image/gif, jpg=image/jpg
            }

         These settings in the TS template will make any link to an internal
         file inserted in the RTE be rendered as a secure file download.

   Default
         0


.. container:: table-row

   Property
         wrap

   Data type
         wrap /stdWrap

   Description
         Wraps the links.

   Default


.. container:: table-row

   Property
         ATagBeforeWrap

   Data type
         boolean

   Description
         If set, the link is first wrapped with " *.wrap"* and then the
         <A>-tag.

   Default


.. container:: table-row

   Property
         parameter

   Data type
         string /stdWrap

   Description
         This is the main data that is used for creating the link. It can be
         the id of a page, the URL of some external page, an e-mail address or
         a reference to a file on the server. On top of this there can be
         additional information for specifying a target, a class and a title.
         Below are a few examples followed by full explanations.

         **Examples:** ::

            parameter = 51

         *Most simple. Will create a link page 51.* ::

            parameter = 51 _blank specialLink "Very important information"

         *A full example. A link to page 51 that will open in a new window. The
         link will a class attribute with value "specialLink" and a title
         attribute reading "Very important information". So the result will be
         the following:* ::

            <a href="?id=51" target="_blank" class="specialLink" title="Very important information">

            parameter = http://typo3.org/ - specialLink

         *An external link with a class attribute. Note the dash (-) that
         replaces the second value (the target). This makes it possible to
         define a class (third value) without having to define a class.* ::

            parameter = info@typo3.org - - "Send a mail to main TYPO3 contact"

         *Create a mailto link with a title attribute (but no target and no
         class)*

         As you can see from the examples, each significant part of the
         parameter string is separated by a space. Values that can themselves
         contain spaces must be enclosed in double quotes. Each of these values
         are described in more detail below.

         **Destination**

         The first value is the destination of the link. If there's a @ it will
         be considered to be a mail address and a mailto link will be created.
         If the value contains a dot (.) before the first slash (/) or a double
         slash (//) or if a scheme (like http) is found inside it, the link
         will be considered to be an external one. If there's a slash but not a
         dot before it, it is considered to be a path to a file and link is
         made to it (even if it doesn't exist as it must consider that it might
         be a speaking URL). In all other cases it is assumed that the value is
         either a page id and a page alias and a link is made to that page, if
         it exists.

         In the case of a link to a page, the value can be more complex than
         just a number or an alias. There can be three "sub-values" separated
         by commas. Here's an example::

            typolink.parameter = 51,100,&test=1 - - "RSS Feed"

         The first value is the page id, the second is the type, the third will
         override the "additionalParams" property. It's also possible to
         specify a section that will override the section property. If the
         section mark is an integer, it will be considered as a pointer to a
         tt\_content record. If not, it's used as is. If there's only a section
         mark, the link is made to the current page.

         **Examples:** ::

            typolink.parameter = 51#345

         *Create a link to page 51 with an anchor to tt\_content element number
         345* ::

            typolink.parameter = #top

         *Create a link to the current page with an anchor called "top".*

         It's also possible to direct the typolink to use a custom function (a
         "link handler") to build the link. This is described in more details
         below this table.

         **Target or popup settings**

         Targets are normally defined the properties described above
         (extTarget, fileTarget and target) but it is possible to override them
         by explicitly defining a target in the parameter property. It's
         possible to use a dash (-) to skip this value when one wants to define
         a third or fourth value, but no target (see examples above).

         Instead of a target, this second value can be used to define the
         parameters of a JavaScript popup window into which the link will be
         opened (using window.open). The height and width of the window can be
         defined, as well as additional parameters to be passed to the
         JavaScript function. Also see property "Jswindow".

         **Examples:** ::

            typolink.parameter = 51 400x300

         *Open page 51 in a popup window measuring 400 by 300 pixels* ::

            typolink.parameter = 51 400x300:resizable=0,location=1

         *Same as above, but window will not be resizable and will show the
         location bar*

         **Class**

         The third value can be used to define a class name for the link tag.
         This class is inserted in the tag before any other value from the
         "ATagParams" property. Beware of conflicting class attributes. It's
         possible to use a dash (-) to skip this value when one wants to define
         a fourth value, but no class (see examples above).

         **Title**

         The standard way of defining the title attribute of the link would be
         to use the "title" property or even the "ATagParams" property. However
         it can also be set in this fourth value, in which case it will
         override the other settings. Note that the title should be wrapped in
         double quotes (") if it contains blanks.

         **Note:** When used from parseFunc, the value should not be defined
         explicitly, but imported using::

            typolink.parameter.data = parameters : allParams

   Default


.. container:: table-row

   Property
         forceAbsoluteUrl

   Data type
         boolean

   Description
         Forces links to internal pages to be absolute, thus having a proper
         URL scheme and domain prepended.

         Additional property:

         .scheme: Defines the URL scheme to be used (https or http). http is
         the default value.

         **Example:** ::

            typolink {
              parameter = 13
              forceAbsoluteUrl = 1
              forceAbsoluteUrl.scheme = https
            }

   Default
         0


.. container:: table-row

   Property
         title

   Data type
         string /stdWrap

   Description
         Sets the title parameter of the A-tag.

   Default


.. container:: table-row

   Property
         JSwindow\_params

   Data type
         string

   Description
         Preset values for opening the window. This example lists almost all
         possible attributes:

         status=1,menubar=1,scrollbars=1,resizable=1,location=1,directories=1,t
         oolbar=1

   Default


.. container:: table-row

   Property
         returnLast

   Data type
         string

   Description
         If set to "url" then it will return the URL of the link
         ($this->lastTypoLinkUrl)

         If set to "target" it will return the target of the link.

         So, in these two cases you will not get the value wrapped but the url
         or target value returned!

   Default


.. container:: table-row

   Property
         section

   Data type
         string /stdWrap

   Description
         If this value is present, it's prepended with a "#" and placed after
         any internal url to another page in TYPO3.

         This is used create a link, which jumps from one page directly the
         section on another page.

   Default


.. container:: table-row

   Property
         ATagParams

   Data type
         <A>-params /stdWrap

   Description
         Additional parameters

         Example:

         class="board"

   Default


.. container:: table-row

   Property
         linkAccessRestrictedPages

   Data type
         boolean

   Description
         If set, typolinks pointing to access restricted pages will still link
         to the page even though the page cannot be accessed.

   Default


.. container:: table-row

   Property
         userFunc

   Data type
         function name

   Description
         This passes the link-data compiled by the typolink function to a user-
         defined function for final manipulation.

         The $content variable passed to the user-function (first parameter) is
         an array with the keys "TYPE", "TAG", "url", "targetParams" and
         "aTagParams".

         TYPE is an indication of link-kind: mailto, url, file, page

         TAG is the full <A>-tag as generated and ready from the typolink
         function.

         The latter three is combined into the 'TAG' value after this formula::

            <a href="' . $finalTagParts['url'] . '"' .
                       $finalTagParts['targetParams'] .
                       $finalTagParts['aTagParams'] . '>

         The userfunction must return an <A>-tag.

   Default


.. ###### END~OF~TABLE ######

[tsref:->typolink]


Using link handlers
"""""""""""""""""""

A feature (added in TYPO3 4.1) allows you to register a link handler
for a keyword you define. For example, you can link to a page with id
34 with "<link 34>" in a typical bodytext field which converts <link>
tags with "->typolink". But what if you have an extension,
"pressrelease", and wanted to link to a press release item displayed
by a plugin on some page you don't remember? With this feature it's
possible to create the logic for this in that extension.

So, in a link field (the "parameter" value for ->typolink) you could
enter "pressrelease:123":

|img-5| Some TypoScript will usually transfer this value to the "parameter"
attribute of the ->typolink call. When "pressrelease:123" enters
->typolink as the "parameter" it will be checked if "pressrelease" is
a keyword with which a link handler is associated and if so, that
handler is allowed to create the link.

Registering the handler for keyword "pressrelease" is done like this::

   $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_content.php']['typolinkLinkHandler']['pressrelease'] = 'EXT:pressrelease/class.linkHandler.php:&tx_linkHandler';

The class file "pressrelease/class.linkHandler.php" contains the class
"tx\_linkHandler" which could look like this::

   class tx_linkHandler {
           function main($linktxt, $conf, $linkHandlerKeyword, $linkHandlerValue, $link_param, &$pObj) {
                   $lconf = array();
                   $lconf['useCacheHash'] = 1;
                   $lconf['parameter'] = 34;
                   $lconf['additionalParams'] = '&tx_pressrelease[showUid]='.rawurlencode($linkHandlerValue);

                   return $pObj->typoLink($linktxt, $lconf);
           }
   }

In this function, the value part after the keyword is set as the value
of a GET parameter, "&tx\_pressrelease[showUid]" and the "parameter"
value of a new ->typolink call is set to "34" which assumes that on
page ID 34 a plugin is put that will display pressrelease 123 when
called with &tx\_pressrelease[showUid]=123. In addition you can see
the "userCacheHash" attribute for the typolink function used in order
to produce a cached display.

The link that results from this operation will look like this::

   <a href="index.php?id=34&amp;tx_pressrelease[showUid]=123%3A456&amp;cHash=c0551fead6" >

The link would be encoded with RealURL and respect config.linkVars as
long as ->typolink is used to generate the final URL.

