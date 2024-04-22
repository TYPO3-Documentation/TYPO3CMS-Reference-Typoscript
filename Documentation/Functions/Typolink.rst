..  include:: /Includes.rst.txt
..  index::
    Functions; typolink
    typolink
..  _typolink:

========
typolink
========

Wraps the incoming value in a link with an HTML 'a' tag.

If you do not want to have the HTML 'a' tag around the link, then you
must set the property by :typoscript:`returnLast = url` or
:php:`$lconf['returnLast'] = 'url'`.

..  attention::

    If typolink is used from :typoscript:`parseFunc` the :php:`$cObj->parameters` array is
    loaded with the lowercase link parameters!

..  contents::
    :local:

..  index:: tags; Properties
..  _typolink-properties:

Properties
==========

..  _typolink-extTarget:

extTarget
---------

..  confval:: extTarget
    :name: typolink-extTarget
    :type: :ref:`data-type-target` / :ref:`stdwrap`
    :Default: `_top`

    Target used for external links


..  _typolink-fileTarget:

fileTarget
----------

..  confval:: fileTarget
    :name: typolink-fileTarget
    :type: :ref:`data-type-target` / :ref:`stdwrap`

    Target used for file links


..  _typolink-language:

language
--------

..  confval:: language
    :name: typolink-language
    :type: :ref:`data-type-integer`

    Language uid for link target

    Omitting the parameter :typoscript:`language` will use the current language.

    ..  rubric:: Example

    ..  code-block:: typoscript

        page.10 = TEXT
        page.10.value = Link to the page with the ID 23 in the current language
        page.10.typolink.parameter = 23

        page.20 = TEXT
        page.20.value = Link to the page with the ID 23 in the language 3
        page.20.typolink.parameter = 23
        page.20.typolink.language = 3


..  _typolink-target:

target
------

..  confval:: target
    :name: typolink-target
    :type: :ref:`data-type-target` / :ref:`stdwrap`

    Target used for internal links


..  _typolink-no-cache:

no\_cache
---------

..  confval:: no_cache
    :name: typolink-no-cache
    :type: :ref:`data-type-boolean` / :ref:`stdwrap`

    Adds `&no_cache=1` to the link


..  _typolink-additionalParams:

additionalParams
----------------

..  confval:: additionalParams
    :name: _typolink-additionalParams
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    This is parameters that are added to the end of the URL. This must be
    code ready to insert after the last parameter.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.typolink.additionalParams = '&print=1'
        page.20.typolink.additionalParams = '&sword_list[]=word1&sword_list[]=word2'

    ..  rubric:: Applications

    This is very useful – for example – when linking to pages from a
    search result. The search words are stored in the register-key
    SWORD\_PARAMS and can be insert directly like this:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

           page.20.typolink.additionalParams.data = register:SWORD_PARAMS

    ..  note:: additionalParams are only considered for internal links.


..  _typolink-addQueryString:

addQueryString
--------------

..  confval:: addQueryString
    :name: typolink-addQueryString
    :type: :ref:`data-type-boolean` / :ref:`data-type-string`

    Add the current query string to the start of the link.

    ..  note::
        This option does not check for any duplicate parameters. This is not a
        problem: Only the last parameter of the same name will be applied.

    Possible values:

    :typoscript:`0`
        No query parameters are added.

    :typoscript:`1`
        Only query parameters resolved by
        :ref:`route enhancers <t3coreapi:routing-advanced-routing-configuration-enhancers>`
        are added, any other query arguments are rejected. This way, additional
        query arguments are never added by default. This is the recommended
        behaviour.

        ..  versionchanged:: 12.0
            Before TYPO3 v12 this setting added all query parameters. To ensure
            the previous behaviour use :typoscript:`untrusted`.

    :typoscript:`untrusted`
        ..  versionadded:: 12.0

        Any given query parameters of the current request are added.

    ..  rubric:: Example

    ..  code-block:: typoscript

        # Pass resolved query parameters to the link
        typolink.addQueryString = 1

        # Pass all query parameters to the link
        typolink.addQueryString = untrusted


..  _typolink-addQueryString-exclude:

addQueryString.exclude
~~~~~~~~~~~~~~~~~~~~~~

..  confval:: addQueryString.exclude
    :name: typolink-addQueryString-exclude
    :type: :ref:`data-type-string`

    List of query arguments to exclude from the link. Typical examples are
    :typoscript:`L` or :typoscript:`cHash`.

    ..  attention::
        This property should not be used for cached contents without a valid
        cHash. Otherwise the page is cached for the first set of parameters
        and subsequently taken from the cache no matter what parameters
        are given. Additionally the security risk of cache poisoning has to
        be considered.

    ..  rubric:: Example

    ..  code-block:: typoscript

        # Remove parameter "gclid" from query string
        typolink.addQueryString.exclude = gclid


..  _typolink-wrap:

wrap
----

..  confval:: wrap
    :name: typolink-wrap
    :type: :ref:`data-type-wrap` / :ref:`stdwrap`

    Wraps the links.


..  _typolink-ATagBeforeWrap:

ATagBeforeWrap
--------------

..  confval:: ATagBeforeWrap
    :name: typolink-ATagBeforeWrap
    :type: :ref:`data-type-boolean`
    :Default: 0

    If set, the link is first wrapped with :typoscript:`wrap` and then the
    <A>-tag.


..  _typolink-parameter:

parameter
---------

..  confval:: parameter
    :name: typolink-parameter
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    This is the main data that is used for creating the link. It can be
    the id of a page, the URL of some external page, an email address or
    a reference to a file on the server. On top of this there can be
    additional information for specifying a target, a class and a title.
    Below are a few examples followed by full explanations.

    ..  rubric:: Examples

    #.  Most simple. Will create a link to page 51 (if this is not default language,
        the correct target language will be resolved from the parameter):

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.typolink.parameter = t3://page?uid=51

    #.  A full example. A link to the *current* page that will open in a new window.
        The link will have a class attribute with value "specialLink" and a
        title attribute reading "Very important information":

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.typolink.parameter = t3://page?uid=current _blank specialLink "Very important information"

        which is converted to a link like this:

        ..  code-block:: html
            :caption: Example output

            <a href="?id=51" target="_blank" class="specialLink" title="Very important information">

    #.  An external link with a class attribute. Note the dash (-) that
        replaces the second value (the target). This makes it possible to
        define a class (third value) without having to define a target:

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.typolink.parameter = https://example.com/ - specialLink

    #.  A mailto link with a title attribute (but no target and no class):

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            page.10.typolink.parameter = mailto:info@example.org - - "Send a mail to main TYPO3 contact"


    As you can see from the examples, each significant part of the
    parameter string is separated by a space. Values that can themselves
    contain spaces must be enclosed in double quotes. Each of these values
    are described in more detail below.

    Link targets that are external or contain `_blank` will be added
    :html:`rel="noreferrer"` automatically.

    ..  rubric:: Resource reference

    1.  The link

        The first value is the destination of the link. It may start with:

        -   `t3://`: internal TYPO3 resource references.
            See `Resource references`_ for an in depth explanation on the
            syntax of these references.

        -   `http(s)://`: regular external links

        -   `mailto:info@example.org`: regular mailto links

        It's also possible to direct the typolink to use a custom function (a
        "link handler") to build the link. This is described in more detail
        below.

    2.  Target or popup settings

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

        ..  rubric:: Examples

        Open page 51 in a popup window measuring 400 by 300 pixels:

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            typolink.parameter = 51 400x300

        Open page 51 in a popup window measuring 400 by 300 pixels. Do
        not make the window resizable and show the location bar:

        ..  code-block:: typoscript
            :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

            typolink.parameter = 51 400x300:resizable=0,location=1

    3.  Class

        The third value can be used to define a class name for the link tag.
        This class is inserted in the tag before any other value from the
        "ATagParams" property. Beware of conflicting class attributes. It's
        possible to use a dash (-) to skip this value when one wants to define
        a fourth value, but no class (see examples above).

    4.  Title

        The standard way of defining the title attribute of the link would
        be to use the :typoscript:`title` property or even the :typoscript:`ATagParams`
        property. However it can also be set in this fourth value, in which
        case it will override the other settings. Note that the title
        should be wrapped in double quotes (") if it contains blanks.

        .. attention::
            When used from :typoscript:`parseFunc`, the value should not
            be defined explicitly, but imported like this:

            ..  code-block:: typoscript
                :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

                typolink.parameter.data = parameters : allParams


..  _typolink-forceAbsoluteUrl:

forceAbsoluteUrl
----------------

..  confval:: forceAbsoluteUrl
    :name: typolink-forceAbsoluteUrl
    :type: :ref:`data-type-boolean`
    :Default: :php:`false`

    Forces links to internal pages to be absolute, thus having a proper
    URL scheme and domain prepended.

    Additional sub-property: :ref:`typolink-forceAbsoluteUrl-scheme`

..  note::
    If the option :ref:`config.forceAbsoluteUrls <setup-config-forceAbsoluteUrls>`
    is enabled, :ref:`typolink-forceAbsoluteUrl-scheme` is overridden.


..  _typolink-forceAbsoluteUrl-scheme:

forceAbsoluteUrl.scheme
~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: forceAbsoluteUrl.scheme
    :name: typolink-forceAbsoluteUrl-scheme
    :type: :ref:`data-type-string`

    :Values: :php:`http` / :php:`https`
    :Default: :php:`http`

    Defines the URL scheme to be used (https or http). http is the
    default value. Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        typolink {
           parameter = 13
           forceAbsoluteUrl = 1
           forceAbsoluteUrl.scheme = https
        }


..  _typolink-title:

title
-----

..  confval:: title
    :name: typolink-title
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    Sets the title parameter of the A-tag.


..  _typolink-JSwindow-params:

JSwindow\_params
----------------

..  confval:: JSwindow_params
    :name: typolink-JSwindow-params
    :type: :ref:`data-type-string`

    Preset values for opening the window. This example lists almost all
    possible attributes:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.typolink.JSwindow_params = status=1,menubar=1,scrollbars=1,resizable=1,location=1,directories=1,toolbar=1


..  _typolink-returnLast:

returnLast
----------

..  confval:: returnLast
    :name: typolink-returnLast
    :type: :ref:`data-type-string`

    If set to "url", then it will return the URL of the link
    (:php:`$this->lastTypoLinkUrl`).

    If set to ``target``, it will return the target of the link.

    So, in these two cases you will not get the value wrapped but the URL
    or target value returned!

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


..  _typolink-section:

section
-------

..  confval:: section
    :name: typolink-section
    :type: :ref:`data-type-string` / :ref:`stdwrap`

    If this value is present, it's prepended with a "#" and placed after
    any internal URL to another page in TYPO3.

    This is used create a link, which jumps from one page directly the
    section on another page.


..  _typolink-ATagParams:

ATagParams
----------

..  confval:: ATagParams
    :name: typolink-ATagParams
    :type: <A>-params / :ref:`stdwrap`

    Additional parameters

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.typolink.ATagParams = class="board"


..  _typolink-linkAccessRestrictedPages:

linkAccessRestrictedPages
-------------------------

..  confval:: linkAccessRestrictedPages
    :name: typolink-linkAccessRestrictedPages
    :type: :ref:`data-type-boolean`

    If set, typolinks pointing to access restricted pages will still link
    to the page even though the page cannot be accessed.


..  _typolink-userFunc:

userFunc
--------

..  confval:: userFunc
    :name: typolink-userFunc
    :type: :ref:`data-type-function-name`

    This passes the link-data compiled by the typolink function to a user-
    defined function for final manipulation.

    The :php:`$content` variable passed to the user-function (first parameter) is
    an array with the keys "TYPE", "TAG", "url", "targetParams" and
    "aTagParams".

    TYPE is an indication of link-kind: mailto, url, file, page

    TAG is the full <A>-tag as generated and ready from the typolink
    function.

    The actual tag value is constructed like this:

    ..  code-block:: php

        $contents = '<a href="' . $finalTagParts['url'] . '"'
                   . $finalTagParts['targetParams']
                   . $finalTagParts['aTagParams'] . '>';

    The userfunction must return an <A>-tag.

..  index:: typolink; Resource references
..  _typolink-resource_references:

Resource references
===================

..  todo: Move the link handler syntax to TYPO3 explained? It is also used in
    in the Fluid ViewHelpers etc

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

    -   :ref:`typolink-handler-page`
    -   :ref:`typolink-handler-file`
    -   :ref:`typolink-handler-folder`
    -   :ref:`typolink-handler-url`
    -   :ref:`typolink-handler-email`
    -   :ref:`typolink-handler-record` (see :php:`\TYPO3\CMS\Core\LinkHandling\RecordLinkHandler`)
    -   :ref:`typolink-handler-phone` (see :php:`\TYPO3\CMS\Core\LinkHandling\TelephoneLinkHandler`)

    More keys can be added via :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']` in
    an associative array where the key is the handler key and the value is a
    class implementing the LinkHandlerInterface.

Resource parameters (`?uid=13&campaignCode=ABC123`)
    These are the specific identification parameters that are used by any
    handler. Note that these may carry additional parameters in order to
    configure the behavior of any handler.


..  index::
    typolink; Link handler syntax
    Link handler

..  _typolink-handler-syntax:

Handler syntax
==============

..  index:: Link handler; page
..  _typolink-handler-page:

page
----

..  confval:: page
    :name: typolink-handler-page
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/PageLinkHandler.php`
    :Example:  `t3://page?uid=42&type=3`

    The page identifier is a compound string based on several optional settings.

..  _typolink-handler-page-uid:

page.uid
~~~~~~~~

..  confval:: page.uid
    :name: typolink-handler-page-uid
    :type: :ref:`data-type-integer` / :ref:`data-type-string`
    :Example:  `t3://page?uid=13`

    The UID (field :sql:`uid`) of a page record, or "current" to reference
    the current page.

    *   `t3://page?uid=13`
    *   `t3://page?uid=current`

..  _typolink-handler-page-alias:

page.alias
~~~~~~~~~~

..  confval:: page.alias
    :name: typolink-handler-page-alias
    :type: :ref:`data-type-string`
    :Example: `t3://page?alias=myfunkyalias`

    The alias (field :sql:`alias`) of a page record (as an alternative to
    :ref:`page.uid <typolink-handler-page-uid>`).

..  _typolink-handler-page-type:

page.type
~~~~~~~~~

..  confval:: page.type
    :name: typolink-handler-page-type
    :type: :ref:`data-type-integer`
    :Default: 0
    :Example: `t3://page?uid=13&type=3`

    The type (:ref:`setup-page-typenum` property of the :ref:`page` top level
    object). `t3://page?uid=13&type=3` will reference page 13 in type 3.

..  _typolink-handler-page-parameters:

page.parameters
~~~~~~~~~~~~~~~

..  confval:: page.parameters
    :name: typolink-handler-page-parameters
    :type: string of parameters
    :Example: `t3://page?uid=1313&my=param&will=get&added=here`

    String of parameters, prefixed with `&`, to be added to the URL.

..  _typolink-handler-page-fragment:

page.fragment
~~~~~~~~~~~~~

..  confval:: page.fragment
    :name: typolink-handler-page-fragment
    :type: :ref:`data-type-string`
    :Example: `t3://page?uid=13&type=3#123`

    The anchor or section to jump to. Must be prefixed with `#`.


..  index:: Link handler; file
..  _typolink-handler-file:

file
----

..  confval:: file
    :name: typolink-handler-file
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/FileLinkHandler.php`
    :Example:  `t3://file?uid=13`

    Links to a file to download.

..  _typolink-handler-file-uid:

file.uid
~~~~~~~~

..  confval:: file.uid
    :name: typolink-handler-file-uid
    :type: :ref:`data-type-integer`
    :Example:  `t3://file?uid=13`

    The UID of a file within the file abstraction layer (FAL) database table
    :sql:`sys_file`.

..  _typolink-handler-file-identifier:

file.identifier
~~~~~~~~~~~~~~~

..  confval:: file.identifier
    :name: typolink-handler-file-identifier
    :type: :ref:`data-type-integer`
    :Example: `t3://file?identifier=fileadmin/path/myfile.jpg`

    The identifier of a file using combined `<storage>:<path>` reference or a direct
    reference to a file in the default storage with UID `0` as a fallback.

    Examples:

    *    `t3://file?identifier=1:/path/myfile.jpg`
    *    `t3://file?identifier=fileadmin/path/myfile.jpg`

    ..  attention::
        :typoscript:`file` cannot resolve links to files in extensions.
        The files must lie in a storage and be accessible via the backend module
        :guilabel:`File > Filelist`.


..  index:: Link handler; folder
..  _typolink-handler-folder:

folder
------

..  confval:: folder
    :name: typolink-handler-folder
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/FolderLinkHandler.php`
    :Example:  `t3://folder?storage=1&identifier=myfolder`

    Links to a folder.

..  _typolink-handler-folder-identifier:

folder.identifier
~~~~~~~~~~~~~~~~~

..  confval:: folder.identifier
    :name: typolink-handler-folder-identifier
    :type: :ref:`data-type-string`
    :Example:  `t3://folder?identifier=fileadmin`

    The identifier of a given folder.

..  _typolink-handler-folder-storage:

folder.storage
~~~~~~~~~~~~~~

..  confval:: folder.storage
    :name: typolink-handler-folder-storage
    :type: :ref:`data-type-string`
    :Example: `t3://folder?storage=1&identifier=myfolder`
    :Default: 0

    The file abstraction layer (FAL) storage UID to the given folder.

..  index:: Link handler; email
..  _typolink-handler-email:

email
-----

..  confval:: email
    :name: typolink-handler-email
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/EmailLinkHandler.php`
    :Example:  `t3://email?email=mailto:user@example.org`

    Mail address to be used, prefixed with `mailto:`

..  index:: Link handler; url
..  _typolink-handler-url:

url
---

..  confval:: url
    :name: typolink-handler-url
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/EmailLinkHandler.php`
    :Example:  `t3://url?url=example.org`

    URL to be used, if no scheme is used
    :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['defaultScheme']` is prefixed
    automatically. The schemes `javascript:` and `data:` are forbidden for
    security reasons and result in an empty url.

    Query parameters have to be URL-encoded.

    Examples:

    *   `t3://url?url=example.org`
    *   `t3://url?url=https://example.org`
    *   `t3://url?url=https://example.org%26parameter=value`

..  index:: Link handler; record
..  _typolink-handler-record:

record
------

..  confval:: record
    :name: typolink-handler-record
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/RecordLinkHandler.php`
    :Example: `t3://record?identifier=my_content&uid=123`

    Can be used to link to a record of a certain table. See also the
    :ref:`Record link tutorial in TYPO3 Explained
    <t3coreapi:TableRecordLinkBrowserTutorials>`.

    Parameters :ref:`record.identifier <typolink-handler-record-identifier>` and
    :ref:`record.uid <typolink-handler-record-uid>` are mandatory for this link
    handler.

..  _typolink-handler-record-identifier:

record.identifier
~~~~~~~~~~~~~~~~~

..  confval:: record.identifier
    :name: typolink-handler-record-identifier
    :type: :ref:`data-type-string`

    The (individual) identifier of the link building configuration to be used.

    The same identifier is used as key in the TypoScript configuration of
    the frontend rendering: :ref:`setup-config-recordLinks` and the :ref:`TSconfig
    backend link handler configuration <t3tsconfig:pagetcemaintables-linkhandler>`

..  _typolink-handler-record-uid:

record.uid
~~~~~~~~~~

..  confval:: record.uid
    :name: typolink-handler-record-uid
    :type: :ref:`data-type-integer`

    The UID of the referenced record to be linked.


..  index:: Link handler; url
..  _typolink-handler-phone:

phone
-----

..  confval:: phone
    :name: typolink-handler-phone
    :type: string of parameters
    :Implementation: :t3src:`core/Classes/LinkHandling/TelephoneLinkHandler.php`
    :Example:  `t3://phone?phone=tel:+4912345678`

    This link handler sets links to phone numbers using the `tel:` protocol.

Examples
========

Create a link to page with uid 2:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.20 = TEXT
    page.20.value = anchor text
    page.20.typolink.parameter = 2

Output:

..  code-block:: html
    :caption: Example output

    <a href="/somepage">anchor text</a>

Just display the URL:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.30 = TEXT
    page.30.typolink.parameter = 2
    page.30.typolink.returnLast = url

Output:

..  code-block:: text
    :caption: Example output

    /somepage


..  _typolink-link-handler:
..  _link-handler:

Using link handlers
===================

See :ref:`Link handler documentation in "TYPO3 Explained" <t3coreapi:linkhandler>`.
