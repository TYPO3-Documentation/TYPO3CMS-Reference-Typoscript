.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _typolink:

typolink
^^^^^^^^

Wraps the incoming value with a link.

If this is used from parseFunc the $cObj->parameters-array is loaded
with the link-parameters (lowercased)!

Wraps the incoming value in a link with an HTML 'a' tag.

If you do not want to have the HTML 'a' tag around the link, then you
must set the property by :ts:`returnLast = url` or
:php:`$lconf['returnLast'] = 'url'`.

*Attention:*
If this is used from :ts:`parseFunc` the :php:`$cObj->parameters` array is
loaded with the lowercased link-parameters!

Examples
========

Create a link to page with uid 2::

   page.20 = TEXT
   page.20.value = anchor text
   page.20.typolink.parameter = 2

Output:

.. code-block:: html

   <a href="/somepage">anchor text</a>

Just display the URL::

   page.30 = TEXT
   page.30.typolink.parameter = 2
   page.30.typolink.returnLast = url

Output:

.. code-block:: html

   /somepage


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         extTarget

   Data type
         target /:ref:`stdWrap <stdwrap>`

   Description
         Target used for external links

   Default
         \_top


.. container:: table-row

   Property
         fileTarget

   Data type
         target /:ref:`stdWrap <stdwrap>`

   Description
         Target used for file links


.. container:: table-row

   Property
         target

   Data type
         target /:ref:`stdWrap <stdwrap>`

   Description
         Target used for internal links


.. container:: table-row

   Property
         no\_cache

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         Adds a "&no\_cache=1"-parameter to the link


.. container:: table-row

   Property
         useCacheHash

   Data type
         boolean

   Description
         If set, the additionalParams list is exploded and calculated into a
         hash string appended to the URL, like "&cHash=ae83fd7s87". When the
         caching mechanism sees this value, it calculates the same value on the
         server based on incoming values in HTTP\_GET\_VARS, excluding
         id,type,no\_cache,ftu,cHash,MP values. If the incoming cHash value
         matches the calculated value, the page may be cached based on this.

         The $TYPO3\_CONF\_VARS['SYS']['encryptionKey'] is included in the hash
         in order to make it unique for the server and non-predictable.


.. container:: table-row

   Property
         additionalParams

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         This is parameters that are added to the end of the URL. This must be
         code ready to insert after the last parameter.

         **Example:** ::

            '&print=1'

            '&sword\_list[]=word1&sword\_list[]=word2'

         **Applications:**

         This is very useful – for example – when linking to pages from a
         search result. The search words are stored in the register-key
         SWORD\_PARAMS and can be insert directly like this::

            .additionalParams.data = register:SWORD_PARAMS

         **Note:** This is only active for internal links!


.. container:: table-row

   Property
         addQueryString

   Data type
         boolean

   Description
         Add the QUERY\_STRING to the start of the link. Notice that this does
         not check for any duplicate parameters! This is not a problem: Only
         the last parameter of the same name will be applied.

         **.method:** If set to GET or POST, then the parsed query arguments
         (GET or POST data) will be used. This setting is useful, if you use
         URL processing extensions like Real URL, which translate part of the
         path into query arguments.

         It's also possible to get both, POST and GET data, on setting this to

         "POST,GET" or "GET,POST". The last method in this sequence takes
         precedence and overwrites the parts that are also present for the
         first method.

         **.exclude:** List of query arguments to exclude from the link (e.g. L
         or cHash).


.. container:: table-row

   Property
         wrap

   Data type
         wrap /:ref:`stdWrap <stdwrap>`

   Description
         Wraps the links.


.. container:: table-row

   Property
         ATagBeforeWrap

   Data type
         boolean

   Description
         If set, the link is first wrapped with "*.wrap*" and then the
         <A>-tag.

   Default
         0

.. container:: table-row

   Property
         parameter

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         This is the main data that is used for creating the link. It can be
         the id of a page, the URL of some external page, an email address or
         a reference to a file on the server. On top of this there can be
         additional information for specifying a target, a class and a title.
         Below are a few examples followed by full explanations.

         **Examples:** ::

            parameter = 51

         *Most simple. Will create a link to page 51.* ::

            parameter = 51 _blank specialLink "Very important information"

         *A full example. A link to page 51 that will open in a new window. The
         link will have a class attribute with value "specialLink" and a title
         attribute reading "Very important information". So the result will be
         the following:* ::

            <a href="?id=51" target="_blank" class="specialLink" title="Very important information">

            parameter = https://example.org/ - specialLink

         *An external link with a class attribute. Note the dash (-) that
         replaces the second value (the target). This makes it possible to
         define a class (third value) without having to define a target.* ::

            parameter = info@example.org - - "Send a mail to main TYPO3 contact"

         *Creates a mailto link with a title attribute (but no target and no
         class).*

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
         made to it (even if it does not exist as it must consider that it might
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

         *Creates a link to page 51 with an anchor to tt\_content element number
         345* ::

            typolink.parameter = #top

         *Creates a link to the current page with an anchor called "top".*

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

         *Opens page 51 in a popup window measuring 400 by 300 pixels* ::

            typolink.parameter = 51 400x300:resizable=0,location=1

         *Same as above, but the window will not be resizable and will show
         the location bar.*

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


.. container:: table-row

   Property
         forceAbsoluteUrl

   Data type
         boolean

   Description
         Forces links to internal pages to be absolute, thus having a proper
         URL scheme and domain prepended.

         Additional sub-property:

         **.scheme:** Defines the URL scheme to be used (https or http). http is
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
         string /:ref:`stdWrap <stdwrap>`

   Description
         Sets the title parameter of the A-tag.


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


.. container:: table-row

   Property
         returnLast

   Data type
         string

   Description
         If set to "url", then it will return the URL of the link
         ($this->lastTypoLinkUrl).

         If set to "target", it will return the target of the link.

         So, in these two cases you will not get the value wrapped but the URL
         or target value returned!


.. container:: table-row

   Property
         section

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If this value is present, it's prepended with a "#" and placed after
         any internal URL to another page in TYPO3.

         This is used create a link, which jumps from one page directly the
         section on another page.


.. container:: table-row

   Property
         ATagParams

   Data type
         <A>-params /:ref:`stdWrap <stdwrap>`

   Description
         Additional parameters

         Example:

         class="board"


.. container:: table-row

   Property
         linkAccessRestrictedPages

   Data type
         boolean

   Description
         If set, typolinks pointing to access restricted pages will still link
         to the page even though the page cannot be accessed.


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


.. ###### END~OF~TABLE ######

[tsref:->typolink]


.. _typolink-link-handler:
.. _link-handler:

Using link handlers
"""""""""""""""""""

A feature allows you to register a link handler
for a keyword you define. For example, you can link to a page with id
34 with "<link 34>" in a typical bodytext field which converts <link>
tags with "->typolink". But what if you have an extension,
"pressrelease", and wanted to link to a press release item displayed
by a plugin on some page you don't remember? With this feature it's
possible to create the logic for this in that extension.

So, in a link field (the "parameter" value for ->typolink) you could
enter "pressrelease:123":

.. figure:: ../../Images/LinkHandler.png
   :alt: Screenshot of the "link" field in the TYPO3 Backend.

Some TypoScript will usually transfer this value to the "parameter"
attribute of the ->typolink call. When "pressrelease:123" enters
->typolink as the "parameter" it will be checked if "pressrelease" is
a keyword with which a link handler is associated and if so, that
handler is allowed to create the link.

Registering the handler for keyword "pressrelease" is done like this::

   $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_content.php']
     ['typolinkLinkHandler']['pressrelease'] =
     'EXT:pressrelease/class.linkHandler.php:&tx_linkHandler';

The class file "pressrelease/class.linkHandler.php" contains the class
"tx\_linkHandler" which could look like this::

   class tx_linkHandler {
     function main($linktxt, $conf, $linkHandlerKeyword,
       $linkHandlerValue, $link_param, &$pObj) {
       $lconf = array();
       $lconf['useCacheHash'] = 1;
       $lconf['parameter'] = 34;
       $lconf['additionalParams'] = '&tx_pressrelease[showUid]=' .
         rawurlencode($linkHandlerValue);

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

   <a href="index.php?id=34&amp;
     tx_pressrelease[showUid]=123%3A456&amp;cHash=c0551fead6" >

The link would be encoded with RealURL and respect config.linkVars as
long as ->typolink is used to generate the final URL.

