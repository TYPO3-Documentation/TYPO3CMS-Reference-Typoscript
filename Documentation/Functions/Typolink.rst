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

.. contents::
   :local:

..  index:: tags; Properties
..  _typolink-properties:

Properties
==========

extTarget
---------

..  t3-function-typolink:: extTarget

    :Data type: target / :ref:`stdwrap`

    :Default: `_top`

    Target used for external links

fileTarget
----------

..  t3-function-typolink:: fileTarget

    :Data type: target / :ref:`stdwrap`

    Target used for file links

language
--------

..  t3-function-typolink:: language

    :Data type: integer

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

target
------

..  t3-function-typolink:: target

    :Data type: target / :ref:`stdwrap`

    Target used for internal links

no\_cache
---------

..  t3-function-typolink:: no_cache

    :Data type: :t3-data-type:`boolean` / :ref:`stdwrap`

    Adds `&no_cache=1` to the link

additionalParams
----------------

..  t3-function-typolink:: additionalParams

    :Data type: :t3-data-type:`string` / :ref:`stdwrap`

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

addQueryString
--------------

..  t3-function-typolink:: addQueryString

    :Data type: :t3-data-type:`boolean` / :t3-data-type:`string`

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


addQueryString.exclude
~~~~~~~~~~~~~~~~~~~~~~

..  t3-function-typolink:: addQueryString.exclude

    :Data type: :t3-data-type:`string`

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


wrap
----

..  t3-function-typolink:: wrap

    :Data type: wrap / :ref:`stdwrap`

    Wraps the links.

ATagBeforeWrap
--------------

..  t3-function-typolink:: ATagBeforeWrap

    :Data type: :t3-data-type:`boolean`
    :Default: 0

    If set, the link is first wrapped with :typoscript:`wrap` and then the
    <A>-tag.

parameter
---------

..  t3-function-typolink:: parameter

    :Data type: :t3-data-type:`string` / :ref:`stdwrap`

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
    :html:`rel="noopener noreferrer"` automatically.

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

forceAbsoluteUrl
----------------

..  t3-function-typolink:: forceAbsoluteUrl

    :Data type: :t3-data-type:`boolean`

    :Default: :php:`false`

    Forces links to internal pages to be absolute, thus having a proper
    URL scheme and domain prepended.

    Additional sub-property: :t3-function-typolink:`forceAbsoluteUrl.scheme`

..  note::
    If the option :ref:`config.forceAbsoluteUrls <setup-config-forceAbsoluteUrls>`
    is enabled, :t3-function-typolink:`forceAbsoluteUrl` is overridden.

forceAbsoluteUrl.scheme
~~~~~~~~~~~~~~~~~~~~~~~

..  t3-function-typolink:: forceAbsoluteUrl.scheme

    :Data type: string

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

title
-----

..  t3-function-typolink:: title

    :Data type: :t3-data-type:`string` / :ref:`stdwrap`

    Sets the title parameter of the A-tag.

JSwindow\_params
----------------

..  t3-function-typolink:: JSwindow_params

    :Data type: :t3-data-type:`string`

    Preset values for opening the window. This example lists almost all
    possible attributes:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.typolink.JSwindow_params = status=1,menubar=1,scrollbars=1,resizable=1,location=1,directories=1,toolbar=1

returnLast
----------

..  t3-function-typolink:: returnLast

    :Data type: :t3-data-type:`string`

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

section
-------

..  t3-function-typolink:: section

    :Data type: :t3-data-type:`string` / :ref:`stdwrap`

    If this value is present, it's prepended with a "#" and placed after
    any internal URL to another page in TYPO3.

    This is used create a link, which jumps from one page directly the
    section on another page.

ATagParams
----------

..  t3-function-typolink:: ATagParams

    :Data type: <A>-params / :ref:`stdwrap`

    Additional parameters

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.typolink.ATagParams = class="board"

linkAccessRestrictedPages
-------------------------

..  t3-function-typolink:: linkAccessRestrictedPages

    :Data type: :t3-data-type:`boolean`

    If set, typolinks pointing to access restricted pages will still link
    to the page even though the page cannot be accessed.

userFunc
--------

..  t3-function-typolink:: userFunc

    :Data type: :t3-data-type:`function name`

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

.. index:: typolink; Resource references
.. _typolink-resource_references:

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

    -   :t3-typolink-handler:`page`
    -   :t3-typolink-handler:`file`
    -   :t3-typolink-handler:`folder`
    -   :t3-typolink-handler:`url`
    -   :t3-typolink-handler:`email`
    -   :t3-typolink-handler:`record` (see :php:`\TYPO3\CMS\Core\LinkHandling\RecordLinkHandler`)
    -   :t3-typolink-handler:`phone` (see :php:`\TYPO3\CMS\Core\LinkHandling\TelephoneLinkHandler`)

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

..  index:: Link handler; page

page
----

..  t3-typolink-handler:: page

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/PageLinkHandler.php`
    :Example:  `t3://page?uid=42&type=3`

    The page identifier is a compound string based on several optional settings.

..  t3-typolink-handler:: page.uid

    :Data Type: int / string
    :Example:  `t3://page?uid=13`

    The UID (field :sql:`uid`) of a page record, or "current" to reference
    the current page.

    *   `t3://page?uid=13`
    *   `t3://page?uid=current`


..  t3-typolink-handler:: page.alias

    :Data Type: string
    :Example: `t3://page?alias=myfunkyalias`

    The alias (field :sql:`alias`) of a page record (as an alternative to
    :t3-typolink-handler:`page.uid`).


..  t3-typolink-handler:: page.type

    :Data Type: int
    :Default: 0
    :Example: `t3://page?uid=13&type=3`

    The type (:ref:`setup-page-typenum` property of the :ref:`page` top level
    object). `t3://page?uid=13&type=3` will reference page 13 in type 3.


..  t3-typolink-handler:: page.parameters

    :Data Type: string of parameters
    :Example: `t3://page?uid=1313&my=param&will=get&added=here`

    String of parameters, prefixed with `&`, to be added to the URL. If the
    parameters

..  t3-typolink-handler:: page.fragment

    :Data Type: string
    :Example: `t3://page?uid=13&type=3#c123`

    The anchor or section to jump to. Must be prefixed with `#`.


.. index:: Link handler; file

file
----

..  t3-typolink-handler:: file

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/FileLinkHandler.php`
    :Example:  `t3://file?uid=13`

    Links to a file to download.


..  t3-typolink-handler:: file.uid

    :Data Type: int
    :Example:  `t3://file?uid=13`

    The UID of a file within the file abstraction layer (FAL) database table
    :sql:`sys_file`.


..  t3-typolink-handler:: file.identifier

    :Data Type: int
    :Example: `t3://file?identifier=fileadmin/path/myfile.jpg`

    The identifier of a file using combined `<storage>:<path>` reference or a direct
    reference to a file in the default storage with UID `0` as a fallback.

    Examples:

    *    `t3://file?identifier=1:/path/myfile.jpg`
    *    `t3://file?identifier=fileadmin/path/myfile.jpg`

    ..  attention::
        :t3-typolink-handler:`file` cannot resolve links to files in extensions.
        The files must lie in a storage and be accessible via the backend module
        :guilabel:`Filelist`.


.. index:: Link handler; folder

folder
------

..  t3-typolink-handler:: folder

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/FolderLinkHandler.php`
    :Example:  `t3://folder?storage=1&identifier=myfolder`

    Links to a folder.

..  t3-typolink-handler:: folder.identifier

    :Data Type: string
    :Example:  `t3://folder?identifier=fileadmin`

    The identifier of a given folder.

..  t3-typolink-handler:: folder.storage

    :Data Type: string
    :Example: `t3://folder?storage=1&identifier=myfolder`
    :Default: 0

    The file abstraction layer (FAL) storage UID to the given folder.

.. index:: Link handler; email

email
-----

..  t3-typolink-handler:: email

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/EmailLinkHandler.php`
    :Example:  `t3://email?email=mailto:user@example.org`

    Mail address to be used, prefixed with `mailto:`

.. index:: Link handler; url

url
---

..  t3-typolink-handler:: url

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/EmailLinkHandler.php`
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

.. index:: Link handler; record

record
------

..  t3-typolink-handler:: record

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/RecordLinkHandler.php`
    :Example: `t3://record?identifier=my_content&uid=123`

    Can be used to link to a record of a certain table. See also the
    :ref:`Record link tutorial in TYPO3 Explained
    <t3coreapi:TableRecordLinkBrowserTutorials>`.

    Parameters :t3-typolink-handler:`record.identifier` and
    :t3-typolink-handler:`record.uid` are mandatory for this link handler.

..  t3-typolink-handler:: record.identifier

    :Data Type: string

    The (individual) identifier of the link building configuration to be used.

    The same identifier is used as key in the TypoScript configuration of
    the frontend rendering: :t3-tlo-config:`recordLinks` and the :ref:`TSconfig
    backend link handler configuration <t3tsconfig:pagetcemaintables-linkhandler>`

..  t3-typolink-handler:: record.uid

    :Data Type: int

    The UID of the referenced record to be linked.


.. index:: Link handler; url

phone
-----

..  t3-typolink-handler:: phone

    :Data Type: string of parameters
    :Implementation: :t3src:`core/LinkHandling/TelephoneLinkHandler.php`
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

..  code-block:: html
    :caption: Example output

    /somepage


..  _typolink-link-handler:
..  _link-handler:

Using link handlers
===================

See :ref:`Link handler documentation in "TYPO3 Explained" <t3coreapi:linkhandler>`.
