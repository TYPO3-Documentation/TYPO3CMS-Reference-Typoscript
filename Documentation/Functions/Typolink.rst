.. include:: ../Includes.txt


.. _typolink:

========
typolink
========

Wraps the incoming value with a link.

*Attention:*
If this is used from :ts:`parseFunc` the :php:`$cObj->parameters` array is
loaded with the lowercased link-parameters!

.. _typolink-extTarget:

extTarget
=========

:aspect:`Property`
   extTarget

:aspect:`Data type`
   target / :ref:`stdwrap`

:aspect:`Description`
   Target used for external links

:aspect:`Default`
   \_top


.. _typolink-fileTarget:

fileTarget
==========

:aspect:`Property`
   fileTarget

:aspect:`Data type`
   target / :ref:`stdwrap`

:aspect:`Description`
   Target used for file links


.. _typolink-language:

language
========

:aspect:`Property`
   language

:aspect:`Data type`
   integer

:aspect:`Description`
   Language uid for link target

   Omitting the parameter :typoscript:`language` will use the current language.

:aspect:`Example`
   .. code-block:: typoscript

      page.10 = TEXT
      page.10.value = Link to the page with the ID in the current language
      page.10.typolink.parameter = 23
      page.20 = TEXT
      page.20.value = Link to the page with the ID in the language 3
      page.20.typolink.parameter = 23
      page.20.typolink.language = 3


.. _typolink-target:

target
======

:aspect:`Property`
   target

:aspect:`Data type`
   target / :ref:`stdwrap`

:aspect:`Description`
   Target used for internal links


.. _typolink-no-cache:

no\_cache
=========

:aspect:`Property`
   no\_cache

:aspect:`Data type`
   :ref:`data-type-bool` / :ref:`stdwrap`

:aspect:`Description`
   Adds ``&no_cache=1`` to the link


.. _typolink-useCacheHash:

useCacheHash
============

:aspect:`Property`
   useCacheHash

:aspect:`Data type`
   :ref:`data-type-bool`

:aspect:`Description`
   If set, the additionalParams list is exploded and calculated into a
   hash string appended to the URL, like "&cHash=ae83fd7s87". When the
   caching mechanism sees this value, it calculates the same value on the
   server based on incoming values in :php:`HTTP_GET_VARS`, excluding
   id, type, no\_cache, ftu, cHash, MP values. If the incoming cHash value
   matches the calculated value, the page may be cached based on this.

   The :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']`
   is included in the hash in order to make it unique for the
   server and non-predictable.


.. _typolink-additionalParams:

additionalParams
================

:aspect:`Property`
   additionalParams

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   This is parameters that are added to the end of the URL. This must be
   code ready to insert after the last parameter.

:aspect:`Example`
      ::

         '&print=1'
         '&sword_list[]=word1&sword_list[]=word2'

:aspect:`Applications`
      This is very useful – for example – when linking to pages from a
      search result. The search words are stored in the register-key
      SWORD\_PARAMS and can be insert directly like this::

         .additionalParams.data = register:SWORD_PARAMS

      *Note:* This is only active for internal links.


.. _typolink-addQueryString:

addQueryString
==============

:aspect:`Property`
   addQueryString

:aspect:`Data type`
   :ref:`data-type-bool`

:aspect:`Description`
   Add the QUERY\_STRING to the start of the link. Notice that this does
   not check for any duplicate parameters! This is not a problem: Only
   the last parameter of the same name will be applied.

   .method
      If set to GET or POST, then the parsed query arguments
      (GET or POST data) will be used. This setting is useful, if you use
      URL processing extensions like Real URL, which translate part of the
      path into query arguments.

      It's also possible to get both, POST and GET data, on setting this to

      "POST,GET" or "GET,POST". The last method in this sequence takes
      precedence and overwrites the parts that are also present for the
      first method.

   .exclude
      List of query arguments to exclude from the link. Typical examples
      are 'L' or 'cHash'.

   .. attention::

      This property should not be used for cached contents without a valid
      cHash. Otherwise the page is cached for the first set of parameters
      and subsubsequently taken from the cache no matter what parameters
      are given. Additionally the security risk of cache poisoning has to
      be considered.


.. _typolink-wrap:

wrap
====

:aspect:`Property`
   wrap

:aspect:`Data type`
   wrap / :ref:`stdwrap`

:aspect:`Description`
   Wraps the links.


.. _typolink-ATagBeforeWrap:

ATagBeforeWrap
==============

:aspect:`Property`
   ATagBeforeWrap

:aspect:`Data type`
   :ref:`data-type-bool`

:aspect:`Description`
   If set, the link is first wrapped with :ts:`wrap` and then the
   <A>-tag.

:aspect:`Default`
   0

.. _typolink-parameter:

parameter
=========

:aspect:`Property`
   parameter

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   This is the main data that is used for creating the link. It can be
   the id of a page, the URL of some external page, an email address or
   a reference to a file on the server. On top of this there can be
   additional information for specifying a target, a class and a title.
   Below are a few examples followed by full explanations.

:aspect:`Examples`
   1. Most simple. Will create a link to page 51 (if this is not default language,
      the correct target language will be resolved from the parameter)::

         parameter = t3://page?uid=51

   2. A full example. A link to page 51 that will open in a new window.
      The link will have a class attribute with value "specialLink" and a
      title attribute reading "Very important information"::

         parameter = t3://page?uid=51 _blank specialLink "Very important information"

   3. which is converted to a link like this::

         <a href="?id=51" target="_blank" class="specialLink" title="Very important information">

   4. An external link with a class attribute. Note the dash (-) that
      replaces the second value (the target). This makes it possible to
      define a class (third value) without having to define a target::

         parameter = http://typo3.org/ - specialLink

   5. A mailto link with a title attribute (but no target and no class)::

         parameter = mailto:info@typo3.org - - "Send a mail to main TYPO3 contact"


   As you can see from the examples, each significant part of the
   parameter string is separated by a space. Values that can themselves
   contain spaces must be enclosed in double quotes. Each of these values
   are described in more detail below.

:aspect:`Resource reference`
   1. The link

      The first value is the destination of the link. It may start with:

      -  `t3://`: internal TYPO3 resource references.
         See `Resource references`_ for an in depth explanation on the
         syntax of these references.

      -  `http(s)://`: regular external links

      -  `mailto:info@typo3.org`: regular mailto links

      It's also possible to direct the typolink to use a custom function (a
      "link handler") to build the link. This is described in more detail
      below.

   2. Target or popup settings

      Targets are normally as described above (extTarget, fileTarget,
      target). But it is possible to override them by explicitly defining
      a target in the parameter property. It's possible to use a dash (-)
      to skip this value when one wants to define a third or fourth
      value, but no target.

      Instead of a target, this second value can be used to define the
      parameters of a JavaScript popup window into which the link will be
      opened (using window.open). The height and width of the window can be
      defined, as well as additional parameters to be passed to the
      JavaScript function. Also see property "Jswindow".

      Examples
         Open page 51 in a popup window measuring 400 by 300 pixels::

            typolink.parameter = 51 400x300

         Open page 51 in a popup window measuring 400 by 300 pixels. Do
         not make the window resizable and show the location bar::

            typolink.parameter = 51 400x300:resizable=0,location=1

   3. Class

      The third value can be used to define a class name for the link tag.
      This class is inserted in the tag before any other value from the
      "ATagParams" property. Beware of conflicting class attributes. It's
      possible to use a dash (-) to skip this value when one wants to define
      a fourth value, but no class (see examples above).

   4. Title

      The standard way of defining the title attribute of the link would
      be to use the :ts:`title` property or even the :ts:`ATagParams`
      property. However it can also be set in this fourth value, in which
      case it will override the other settings. Note that the title
      should be wrapped in double quotes (") if it contains blanks.

      *Attention:* When used from :ts:`parseFunc`, the value should not
      be defined explicitly, but imported like this::

         typolink.parameter.data = parameters : allParams


.. _typolink-forceAbsoluteUrl:

forceAbsoluteUrl
================

:aspect:`Property`
   forceAbsoluteUrl

:aspect:`Data type`
   :ref:`boolean <data-type-bool>`

:aspect:`Description`
   Forces links to internal pages to be absolute, thus having a proper
   URL scheme and domain prepended.

   Additional sub-property:

   .scheme
      Defines the URL scheme to be used (https or http). http is the
      default value. Example::

         typolink {
            parameter = 13
            forceAbsoluteUrl = 1
            forceAbsoluteUrl.scheme = https
         }

:aspect:`Default`
   0


.. _typolink-title:

title
=====

:aspect:`Property`
   title

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   Sets the title parameter of the A-tag.


.. _typolink-JSwindow-params:

JSwindow\_params
================

:aspect:`Property`
   JSwindow\_params

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   Preset values for opening the window. This example lists almost all
   possible attributes::

      status=1,menubar=1,scrollbars=1,resizable=1,location=1,directories=1,toolbar=1


.. _typolink-returnLast:

returnLast
==========

:aspect:`Property`
   returnLast

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   If set to "url", then it will return the URL of the link
   (:php:`$this->lastTypoLinkUrl`).

   If set to ``target``, it will return the target of the link.

   So, in these two cases you will not get the value wrapped but the URL
   or target value returned!


.. _typolink-section:

section
=======

:aspect:`Property`
   section

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   If this value is present, it's prepended with a "#" and placed after
   any internal URL to another page in TYPO3.

   This is used create a link, which jumps from one page directly the
   section on another page.


.. _typolink-ATagParams:

ATagParams
==========

:aspect:`Property`
   ATagParams

:aspect:`Data type`
   <A>-params / :ref:`stdwrap`

:aspect:`Description`
   Additional parameters

   Example::

      class="board"


.. _typolink-linkAccessRestrictedPages:

linkAccessRestrictedPages
=========================

:aspect:`Property`
   linkAccessRestrictedPages

:aspect:`Data type`
   :ref:`data-type-bool`

:aspect:`Description`
   If set, typolinks pointing to access restricted pages will still link
   to the page even though the page cannot be accessed.


.. _typolink-userFunc:

userFunc
========

:aspect:`Property`
   userFunc

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
   This passes the link-data compiled by the typolink function to a user-
   defined function for final manipulation.

   The :php:`$content` variable passed to the user-function (first parameter) is
   an array with the keys "TYPE", "TAG", "url", "targetParams" and
   "aTagParams".

   TYPE is an indication of link-kind: mailto, url, file, page

   TAG is the full <A>-tag as generated and ready from the typolink
   function.

   The actual tag value is constructed like this:

   .. code-block:: php

      $contents = '<a href="' . $finalTagParts['url'] . '"'
                  . $finalTagParts['targetParams']
                  . $finalTagParts['aTagParams'] . '>';

   The userfunction must return an <A>-tag.


.. _typolink-resource_references: `Resource references`

Resource references
===================

TYPO3 supports a modern and future-proof way of referencing resources using an
extensible and expressive syntax which is easy to understand.

In order to understand the syntax, we will guide you through using a simple
page link.

`t3://page?uid=13&campaignCode=ABC123`

The syntax consists of three main parts, much like parts on an URL:

Syntax Namespace (`t3://`)
   The namespace is set to `t3://` to ensure the `LinkService` should be called
   to parse the URL. This value is fixed and mandatory.

Resource handler key (`page`)
   The resource handler key is a list of available handlers that TYPO3 can work
   with. At the time of writing these handlers are:

   - page
   - file
   - folder

   More keys can be added via :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']` in
   an associative array where the key is the handler key and the value is a
   class implementing the LinkHandlerInterface.

Resource parameters (`?uid=13&campaignCode=ABC123`)
   These are the specific identification parameters that are used by any
   handler. Note that these may carry additional parameters in order to
   configure the behavior of any handler.

Handler syntax
==============

page
----

The page identifier is a compound string based on several optional settings.

:aspect:`uid` (int):

   The **uid** of a page record.

   `t3://page?uid=13`

:aspect:`alias` (string):

   The **alias** of a page record (as an alternative to the UID).

   `t3://page?alias=myfunkyalias`

:aspect:`type` (int) *(optional)*:

   `t3://page?uid=13&type=3` will reference page 13 in type 3.

:aspect:`parameters` (string) *(optional, prefixed with &)*:

   `t3://page?uid=1313&my=param&will=get&added=here`

:aspect:`fragment` (string) *(optional, prefixed with #)*:

   `t3://page?alias=myfunkyalias#c123`

   `t3://page?uid=13&type=3#c123`

   `t3://page?uid=13&type3?my=param&will=get&added=here#c123`

file
----

:aspect:`uid` (int):

   The UID of a file within the FAL database table `sys_file`.

   `t3://file?uid=13`

:aspect:`identifier` (string):

   The identifier of a file when not indexed in FAL.

   `t3://file?identifier=folder/myfile.jpg`

folder
------

:aspect:`identifier` (string):

   The identifier of a given folder.

   `t3://folder?identifier=fileadmin`

:aspect:`storage` (string) *(optional)*:

   The FAL storage to the given folder.

   `t3://folder?storage=1&identifier=myfolder`




.. _typolink-link-handler:
.. _link-handler:

Using link handlers
===================

A feature allows you to register a link handler
for a keyword you define. For example, you can link to a page with id
34 with "<link 34>" in a typical bodytext field which converts <link>
tags with "->typolink". But what if you have an extension,
"pressrelease", and wanted to link to a press release item displayed
by a plugin on some page you don't remember? With this feature it's
possible to create the logic for this in that extension.

So, in a link field (the "parameter" value for ->typolink) you could
enter "pressrelease:123":

.. figure:: ../Images/LinkHandler.png
   :alt: Screenshot of the "link" field in the TYPO3 Backend.

Some TypoScript will usually transfer this value to the "parameter"
attribute of the ->typolink call. When "pressrelease:123" enters
->typolink as the "parameter" it will be checked if "pressrelease" is
a keyword with which a link handler is associated and if so, that
handler is allowed to create the link.

Registering the handler for keyword "pressrelease" is done like this:

.. code-block:: php

   $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_content.php']
     ['typolinkLinkHandler']['pressrelease'] =
     'EXT:pressrelease/class.linkHandler.php:&tx_linkHandler';

The class file :file:`pressrelease/class.linkHandler.php` contains the class
:php:`tx_linkHandler` which could look like this:

.. code-block:: php

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
of a GET parameter, `&tx_pressrelease[showUid]` and the "parameter"
value of a new ->typolink call is set to "34" which assumes that on
page ID 34 a plugin is put that will display pressrelease 123 when
called with `&tx_pressrelease[showUid]=123`. In addition you can see
the "userCacheHash" attribute for the typolink function used in order
to produce a cached display.

The link that results from this operation will look like this:

.. code-block:: html

   <a href="index.php?id=34&amp;
     tx_pressrelease[showUid]=123%3A456&amp;cHash=c0551fead6" >

The link would be encoded with RealURL and respect :ts:`config.linkVars`
as long as ->typolink is used to generate the final URL.
