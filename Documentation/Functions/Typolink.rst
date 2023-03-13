.. include:: /Includes.rst.txt
.. index::
   Functions; typolink
   typolink
.. _typolink:

========
typolink
========

Wraps the incoming value in a link with an HTML 'a' tag.

If you do not want to have the HTML 'a' tag around the link, then you
must set the property by :typoscript:`returnLast = url` or
:php:`$lconf['returnLast'] = 'url'`.

.. important::

   If this is used from :typoscript:`parseFunc` the :php:`$cObj->parameters` array is
   loaded with the lowercased link-parameters!

.. contents::
   :local:

.. index:: tags; Properties
.. _tags-properties:

Properties
==========

.. index:: typolink; extTarget
.. _typolink-extTarget:

extTarget
---------

:aspect:`Property`
   extTarget

:aspect:`Data type`
   target / :ref:`stdwrap`

:aspect:`Description`
   Target used for external links

:aspect:`Default`
   \_top


.. index:: typolink; fileTarget
.. _typolink-fileTarget:

fileTarget
----------

:aspect:`Property`
   fileTarget

:aspect:`Data type`
   target / :ref:`stdwrap`

:aspect:`Description`
   Target used for file links


.. index:: typolink; language
.. _typolink-language:

language
--------

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
      page.10.value = Link to the page with the ID 23 in the current language
      page.10.typolink.parameter = 23
      page.20 = TEXT
      page.20.value = Link to the page with the ID 23 in the language 3
      page.20.typolink.parameter = 23
      page.20.typolink.language = 3


.. index:: typolink; target
.. _typolink-target:

target
------

:aspect:`Property`
   target

:aspect:`Data type`
   target / :ref:`stdwrap`

:aspect:`Description`
   Target used for internal links


.. index:: typolink; no_cache
.. _typolink-no-cache:

no\_cache
---------

:aspect:`Property`
   no\_cache

:aspect:`Data type`
   :t3-data-type:`boolean` / :ref:`stdwrap`

:aspect:`Description`
   Adds ``&no_cache=1`` to the link


.. index:: typolink; additionalParams
.. _typolink-additionalParams:

additionalParams
----------------

:aspect:`Property`
   additionalParams

:aspect:`Data type`
   :t3-data-type:`string` / :ref:`stdwrap`

:aspect:`Description`
   This is parameters that are added to the end of the URL. This must be
   code ready to insert after the last parameter.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.typolink.additionalParams = '&print=1'
      page.20.typolink.additionalParams = '&sword_list[]=word1&sword_list[]=word2'

:aspect:`Applications`
   This is very useful – for example – when linking to pages from a
   search result. The search words are stored in the register-key
   SWORD\_PARAMS and can be insert directly like this:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page.20.typolink.additionalParams.data = register:SWORD_PARAMS

   .. note:: This is only active for internal links.


.. index:: typolink; addQueryString
.. _typolink-addQueryString:

addQueryString
--------------

:aspect:`Property`
   addQueryString

:aspect:`Data type`
   :t3-data-type:`boolean`

:aspect:`Description`
   Add the current query string to the start of the link.

   ..  note::
       This option does not check for any duplicate parameters! This is not a
       problem: Only the last parameter of the same name will be applied.

   .exclude
      List of query arguments to exclude from the link. Typical examples
      are 'L' or 'cHash'.

   .. attention::

      This property should not be used for cached contents without a valid
      cHash. Otherwise the page is cached for the first set of parameters
      and subsequently taken from the cache no matter what parameters
      are given. Additionally the security risk of cache poisoning has to
      be considered.

   ..  rubric:: Example

   ..  code-block:: typoscript

       # Pass all GET parameters to the link
       typolink.addQueryString = 1

       # Remove parameter "gclid" from query string
       typolink.addQueryString.exclude = gclid


.. _typolink-wrap:

wrap
----

:aspect:`Property`
   wrap

:aspect:`Data type`
   wrap / :ref:`stdwrap`

:aspect:`Description`
   Wraps the links.


.. index:: typolink; ATagBeforeWrap
.. _typolink-ATagBeforeWrap:

ATagBeforeWrap
--------------

:aspect:`Property`
   ATagBeforeWrap

:aspect:`Data type`
   :t3-data-type:`boolean`

:aspect:`Description`
   If set, the link is first wrapped with :typoscript:`wrap` and then the
   <A>-tag.

:aspect:`Default`
   0


.. index:: typolink; parameter
.. _typolink-parameter:

parameter
---------

:aspect:`Property`
   parameter

:aspect:`Data type`
   :t3-data-type:`string` / :ref:`stdwrap`

:aspect:`Description`
   This is the main data that is used for creating the link. It can be
   the id of a page, the URL of some external page, an email address or
   a reference to a file on the server. On top of this there can be
   additional information for specifying a target, a class and a title.
   Below are a few examples followed by full explanations.

:aspect:`Examples`
   #. Most simple. Will create a link to page 51 (if this is not default language,
      the correct target language will be resolved from the parameter):

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page.10.typolink.parameter = t3://page?uid=51

   #. A full example. A link to the *current* page that will open in a new window.
      The link will have a class attribute with value "specialLink" and a
      title attribute reading "Very important information":

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page.10.typolink.parameter = t3://page?uid=current _blank specialLink "Very important information"

      which is converted to a link like this:

      .. code-block:: html
         :caption: Example output

         <a href="?id=51" target="_blank" class="specialLink" title="Very important information">

   #. An external link with a class attribute. Note the dash (-) that
      replaces the second value (the target). This makes it possible to
      define a class (third value) without having to define a target:

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page.10.typolink.parameter = https://example.com/ - specialLink

   #. A mailto link with a title attribute (but no target and no class):

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         page.10.typolink.parameter = mailto:info@example.org - - "Send a mail to main TYPO3 contact"


   As you can see from the examples, each significant part of the
   parameter string is separated by a space. Values that can themselves
   contain spaces must be enclosed in double quotes. Each of these values
   are described in more detail below.

   Link targets that are external or contain `_blank` will be added :html:`rel="noopener noreferrer"` automatically.

:aspect:`Resource reference`
   1. The link

      The first value is the destination of the link. It may start with:

      -  `t3://`: internal TYPO3 resource references.
         See `Resource references`_ for an in depth explanation on the
         syntax of these references.

      -  `http(s)://`: regular external links

      -  `mailto:info@example.org`: regular mailto links

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
         Open page 51 in a popup window measuring 400 by 300 pixels:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            typolink.parameter = 51 400x300

         Open page 51 in a popup window measuring 400 by 300 pixels. Do
         not make the window resizable and show the location bar:

         .. code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            typolink.parameter = 51 400x300:resizable=0,location=1

   3. Class

      The third value can be used to define a class name for the link tag.
      This class is inserted in the tag before any other value from the
      "ATagParams" property. Beware of conflicting class attributes. It's
      possible to use a dash (-) to skip this value when one wants to define
      a fourth value, but no class (see examples above).

   4. Title

      The standard way of defining the title attribute of the link would
      be to use the :typoscript:`title` property or even the :typoscript:`ATagParams`
      property. However it can also be set in this fourth value, in which
      case it will override the other settings. Note that the title
      should be wrapped in double quotes (") if it contains blanks.

      *Attention:* When used from :typoscript:`parseFunc`, the value should not
      be defined explicitly, but imported like this:

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         typolink.parameter.data = parameters : allParams


.. index:: typolink; forceAbsoluteUrl
.. _typolink-forceAbsoluteUrl:

forceAbsoluteUrl
----------------

:aspect:`Property`
   forceAbsoluteUrl

:aspect:`Data type`
   :t3-data-type:`boolean`

:aspect:`Description`
   Forces links to internal pages to be absolute, thus having a proper
   URL scheme and domain prepended.

   Additional sub-property:

   .scheme
      Defines the URL scheme to be used (https or http). http is the
      default value. Example:

      .. code-block:: typoscript
         :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

         typolink {
            parameter = 13
            forceAbsoluteUrl = 1
            forceAbsoluteUrl.scheme = https
         }

:aspect:`Default`
   0


.. index:: typolink; title
.. _typolink-title:

title
-----

:aspect:`Property`
   title

:aspect:`Data type`
   :t3-data-type:`string` / :ref:`stdwrap`

:aspect:`Description`
   Sets the title parameter of the A-tag.


.. index:: typolink; JSwindow_params
.. _typolink-JSwindow-params:

JSwindow\_params
----------------

:aspect:`Property`
   JSwindow\_params

:aspect:`Data type`
   :t3-data-type:`string`

:aspect:`Description`
   Preset values for opening the window. This example lists almost all
   possible attributes:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.typolink.JSwindow_params = status=1,menubar=1,scrollbars=1,resizable=1,location=1,directories=1,toolbar=1


.. index:: typolink; returnLast
.. _typolink-returnLast:

returnLast
----------

:aspect:`Property`
   returnLast

:aspect:`Data type`
   :t3-data-type:`string`

:aspect:`Description`
   If set to "url", then it will return the URL of the link
   (:php:`$this->lastTypoLinkUrl`).

   If set to ``target``, it will return the target of the link.

   So, in these two cases you will not get the value wrapped but the URL
   or target value returned!


.. index:: typolink; section
.. _typolink-section:

    ..  versionadded:: 11.4

    If set to ``result``, it will return the json_encoded output of the
    internal ``LinkResult`` object.

    ..  code-block:: json

        {
            "href": "/my-page",
            "target": null,
            "class": null,
            "title": null,
            "linkText": "My page",
            "additionalAttributes": []
        }

section
-------

:aspect:`Property`
   section

:aspect:`Data type`
   :t3-data-type:`string` / :ref:`stdwrap`

:aspect:`Description`
   If this value is present, it's prepended with a "#" and placed after
   any internal URL to another page in TYPO3.

   This is used create a link, which jumps from one page directly the
   section on another page.


.. index:: typolink; ATagParams
.. _typolink-ATagParams:

ATagParams
----------

:aspect:`Property`
   ATagParams

:aspect:`Data type`
   <A>-params / :ref:`stdwrap`

:aspect:`Description`
   Additional parameters

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      page.10.typolink.ATagParams = class="board"


.. index:: typolink; linkAccessRestrictedPages
.. _typolink-linkAccessRestrictedPages:

linkAccessRestrictedPages
-------------------------

:aspect:`Property`
   linkAccessRestrictedPages

:aspect:`Data type`
   :t3-data-type:`boolean`

:aspect:`Description`
   If set, typolinks pointing to access restricted pages will still link
   to the page even though the page cannot be accessed.


.. index:: typolink; userFunc
.. _typolink-userFunc:

userFunc
--------

:aspect:`Property`
   userFunc

:aspect:`Data type`
   :t3-data-type:`function name`

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


.. index:: typolink; Resource references
.. _typolink-resource_references:

Resource references
===================

TYPO3 supports a modern and future-proof way of referencing resources using an
extensible and expressive syntax.

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

   - 'page' (see :php:`\TYPO3\CMS\Core\LinkHandling\PageLinkHandler`)
   - 'file' (see :php:`\TYPO3\CMS\Core\LinkHandling\FileLinkHandler`)
   - 'folder' (see :php:`\TYPO3\CMS\Core\LinkHandling\FolderLinkHandler`)
   - 'url' (see :php:`\TYPO3\CMS\Core\LinkHandling\UrlLinkHandler`)
   - 'email' (see :php:`\TYPO3\CMS\Core\LinkHandling\EmailLinkHandler`)
   - 'record' (see :php:`\TYPO3\CMS\Core\LinkHandling\RecordLinkHandler`)
   - 'telephone' (see :php:`\TYPO3\CMS\Core\LinkHandling\TelephoneLinkHandler`)

   More keys can be added via :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']` in
   an associative array where the key is the handler key and the value is a
   class implementing the LinkHandlerInterface.

Resource parameters (`?uid=13&campaignCode=ABC123`)
   These are the specific identification parameters that are used by any
   handler. Note that these may carry additional parameters in order to
   configure the behavior of any handler.


.. index::
   typolink; Link handler syntax
   Link handler

Handler syntax
==============

.. index:: Link handler; page

page
----

The page identifier is a compound string based on several optional settings.

:aspect:`uid` (int|string):
   The **uid** of a page record, or "current" to reference the current page.

   `t3://page?uid=13`

   `t3://page?uid=current`

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

   `t3://page?uid=13&type=3&my=param&will=get&added=here#c123`


.. index:: Link handler; file

file
----

:aspect:`uid` (int):
   The UID of a file within the FAL database table `sys_file`.

   `t3://file?uid=13`

:aspect:`identifier` (string):
   The identifier of a file using combined `<storage>:<path>` reference or a direct
   reference to one file like `fileadmin/path/myfile.jpg`.

   `t3://file?identifier=1:/path/myfile.jpg`

   `t3://file?identifier=fileadmin/path/myfile.jpg`


.. index:: Link handler; folder

folder
------

:aspect:`identifier` (string):
   The identifier of a given folder.

   `t3://folder?identifier=fileadmin`

:aspect:`storage` (string) *(optional)*:
   The FAL storage to the given folder.

   `t3://folder?storage=1&identifier=myfolder`


.. index:: Link handler; email

email
-----

:aspect:`email` (string):
   Mail address to be used, prefixed with `mailto:`

   `t3://email?email=mailto:user@example.org`


.. index:: Link handler; url

url
---

:aspect:`url` (string):
   URL to be used, if no scheme is used `http://` is prefixed automatically. Query parameters have to be URL-encoded.

   `t3://url?url=example.org`

   `t3://url?url=https://example.org`

   `t3://url?url=https://example.org%26parameter=value`


.. index:: Link handler; record

record
------

Aspects `identifier` and `uid` are mandatory for this link handler.

:aspect:`identifier` (string):
   The (individual) identifier of the link building configuration to be used.

:aspect:`uid` (int):
   The UID of the referenced record to be linked.

:aspect:`Example`
   The following reference relates to record `tx_myextension_content:123`. Tablename is retrieved
   from Page TSconfig settings, actual link generation is defined in TypoScript configuration for
   identifier `my_content`.

   `t3://record?identifier=my_content&uid=123`

   .. code-block:: typoscript
      :caption: Page TSconfig definition for identifier `my_content`

      TCEMAIN.linkHandler.my_content {
          handler = TYPO3\CMS\Recordlist\LinkHandler\RecordLinkHandler
          label = LLL:EXT:my_extension/Resources/Private/Language/locallang.xlf:link.customTab
          configuration {
              table = tx_myextension_content
          }
          scanBefore = page
      }

   .. code-block:: typoscript
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


Examples
========

Create a link to page with uid 2:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.20 = TEXT
   page.20.value = anchor text
   page.20.typolink.parameter = 2

Output:

.. code-block:: html
   :caption: Example output

   <a href="/somepage">anchor text</a>

Just display the URL:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.30 = TEXT
   page.30.typolink.parameter = 2
   page.30.typolink.returnLast = url

Output:

.. code-block:: html
   :caption: Example output

   /somepage


.. _typolink-link-handler:
.. _link-handler:

Using link handlers
===================

See :ref:`Link handler documentation in "TYPO3 Explained" <t3coreapi:linkhandler>`.
