:navigation-title: Conditions

..  include:: /Includes.rst.txt
..  index::
    Conditions
    Conditions; Variables
    Conditions; Constant
    Conditions; Functions
    Conditions; Functions frontend
..  _conditions:
..  _condition-reference:
..  _condition-variables:
..  _condition-constant:
..  _condition-functions-in-all-contexts:
..  _condition-functions-in-frontend-context:

=======================================
Frontend TypoScript conditions criteria
=======================================

Frontend TypoScript conditions offer a way to conditionally change TypoScript
based on current context. Do not confuse conditions with the
:ref:`"if" function <if>`, which is a :ref:`stdWrap <stdwrap>` property to act
on current data.

..  seealso::
    Have a look at the
    :ref:`TypoScript syntax condition chapter <typoscript-syntax-conditions>`
    for the basic syntax of conditions.

The :ref:`Symfony expression language <t3coreapi:symfony-expression-language>`
tends to throw warnings when sub-arrays are checked in a condition that do not
exist. Use the :ref:`traverse <condition-function-traverse>`
function to avoid this.

..  contents::
    :local:
    :depth: 2


..  index:: Conditions; applicationContext
..  _condition-applicationContext:

applicationContext
==================

..  confval:: applicationContext
    :name: condition-applicationContext
    :type: String

    The current application context as a string.
    See :ref:`t3coreapi:bootstrapping-context`.

    Example:

    ..  literalinclude:: _codesnippets/_applicationContext.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; page
..  _condition-page:

page
====

..  confval:: page
    :name: condition-page
    :type: Array

    All data of the current page record as array.

    Example:

    ..  literalinclude:: _codesnippets/_page.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; tree
..  _condition-tree:

tree
====

..  confval:: tree
    :name: condition-tree
    :type: Object

    Object with tree information.


..  index::
    Conditions; tree.level
    Conditions; Page level


..  _condition-tree-level:

tree.level
----------

..  confval:: tree.level
    :name: condition-tree-level
    :type: Integer

    The current tree level.

    Example:

    ..  literalinclude:: _codesnippets/_level.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; tree.pagelayout
..  _condition-tree-pagelayout:

tree.pagelayout
---------------

..  confval:: tree.pagelayout
    :name: condition-tree-pagelayout
    :type: Integer / String

    Check for the defined :ref:`backend layout <t3coreapi:be-layout>` of a page, including
    the inheritance of the field `Backend Layout (subpages of this page)`.

    Example:

    ..  literalinclude:: _codesnippets/_pagelayout.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    ..  attention::
        The value of `pagelayout` is a string, even when using BE layout records.
        This is especially important in conditions using `in` as shown here since
        this operator performs a strict comparison by default. For clarity and
        consistency strict comparisons should also be used in other cases.

..  index::
    Conditions; tree.rootLine
..  _condition-tree-rootLine:

tree.rootLine
-------------

..  confval:: tree.rootLine
    :name: condition-tree-rootLine
    :type: Array

    Array of arrays with UID and PID.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [tree.rootLine[0]["uid"] == 1]
            # ...
        [END]


..  index::
    Conditions; tree.rootLineIds
    Conditions; PID in rootline
..  _condition-tree-rootLineIds:

tree.rootLineIds
----------------

..  confval:: tree.rootLineIds
    :name: condition-tree-rootLineIds
    :type: Array

    An array with UIDs of the root line.

    Example:

    ..  literalinclude:: _codesnippets/_rootLineIds.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index::
    Conditions; tree.rootLineParentIds
    Conditions; PID up in rootline
..  _condition-tree-rootLineParentIds:

tree.rootLineParentIds
----------------------

..  confval:: tree.rootLineParentIds
    :name: condition-tree-rootLineParentIds
    :type: Array

    An array with parent UIDs of the root line.

    Example:

    ..  literalinclude:: _codesnippets/_rootLineParentIds.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; backend
..  _condition-backend:

backend
=======

..  confval:: backend
    :name: condition-backend
    :type: Object

    Object with backend information.


..  index:: Conditions; backend.user
..  _condition-backend-user:

backend.user
------------

..  confval:: backend.user
    :name: condition-backend-user
    :type: Object

    Object with current backend user information.


..  index::
    Conditions; backend.user.isAdmin
    Conditions; Admin logged in
..  _condition-backend-user-isAdmin:

backend.user.isAdmin
--------------------

..  confval:: backend.user.isAdmin
    :name: condition-backend-user-isAdmin
    :type: Boolean

    True, if the current backend user is administrator.

    Example:

    ..  literalinclude:: _codesnippets/_isAdmin.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; backend.user.isLoggedIn
..  _condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
-----------------------

..  confval:: backend.user.isLoggedIn
    :name: condition-backend-user-isLoggedIn
    :type: Boolean

    True, if the current backend user is logged in.

    Example:

    ..  literalinclude:: _codesnippets/_isLoggedIn.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; backend.user.userId
..  _condition-backend-user-userId:

backend.user.userId
-------------------

..  confval:: backend.user.userId
    :name: condition-backend-user-userId
    :type: Integer

    UID of the the current backend user.

    Example:

    ..  literalinclude:: _codesnippets/_userId.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; backend.user.userGroupIds
..  _condition-backend-user-userGroupIds:

backend.user.userGroupIds
-------------------------

..  confval:: backend.user.userGroupIds
    :name: condition-backend-user-userGroupIds
    :type: Array
    :Context: Frontend, backend

    Array of user group IDs assigned to the current backend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [2 in backend.user.userGroupIds]
            # ...
        [END]


..  index:: Conditions; backend.user.userGroupList
..  _condition-backend-user-userGroupList:

backend.user.userGroupList
--------------------------

..  confval:: backend.user.userGroupList
    :name: condition-backend-user-userGroupList
    :type: String

    Comma-separated list of group UIDs.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [like(","~backend.user.userGroupList~",", "*,1,*")]
            # ...
        [END]


..  index:: Conditions; frontend
..  _condition-frontend:

frontend
========

..  confval:: frontend
    :name: condition-frontend
    :type: Object

    Object with frontend information.


..  index:: Conditions; frontend.user
..  _condition-frontend-user:

frontend.user
-------------

..  confval:: frontend.user
    :name: condition-frontend-user
    :type: Object

    Object with current frontend user information.


..  index:: Conditions; frontend.user.isLoggedIn
..  _condition-frontend-user-isLoggedIn:

frontend.user.isLoggedIn
------------------------

..  confval:: frontend.user.isLoggedIn
    :name: condition-frontend-user-isLoggedIn
    :type: Boolean

    True, if the current frontend user is logged in.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [frontend.user.isLoggedIn]
            # ...
        [END]


..  index:: Conditions; frontend.user.userId
..  _condition-frontend-user-userId:

frontend.user.userId
--------------------

..  confval:: frontend.user.userId
    :name: condition-frontend-user-userId
    :type: Integer

    The UID of the current frontend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [frontend.user.userId == 5]
            # ...
        [END]


..  index:: Conditions; frontend.user.userGroupIds
..  _condition-frontend-user-userGroupIds:

frontend.user.userGroupIds
--------------------------

..  confval:: frontend.user.userGroupIds
    :name: condition-frontend-user-userGroupIds
    :type: Array
    :Context: Frontend

    Array of user group IDs of the current frontend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [4 in frontend.user.userGroupIds]
            # ...
        [END]


..  index:: Conditions; frontend.user.userGroupList
..  _condition-frontend-user-userGroupList:

frontend.user.userGroupList
---------------------------

..  confval:: frontend.user.userGroupList
    :name: condition-frontend-user-userGroupList
    :type: String

    Comma-separated list of group UIDs.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [like(","~frontend.user.userGroupList~",", "*,1,*")]
            # ...
        [END]


..  index:: Conditions; workspace
..  _condition-workspace:

workspace
=========

..  confval:: workspace
    :name: condition-workspace
    :type: Object

    Object with :ref:`workspace <t3coreapi:workspaces>` information.


..  index:: Conditions; workspace.workspaceId
..  _condition-workspace-workspaceId:

workspace.workspaceId
---------------------

..  confval:: workspace.workspaceId
    :name: condition-workspace-workspaceId
    :type: Integer

    UID of the current workspace.

    Example:

    ..  literalinclude:: _codesnippets/_workspaceId.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; workspace.isLive
..  _condition-workspace-isLive:

workspace.isLive
----------------

..  confval:: workspace.isLive
    :name: condition-workspace-isLive
    :type: Boolean

    True, if the current workspace is the live workspace.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [workspace.isLive]
            # ...
        [END]


..  index:: Conditions; workspace.isOffline
..  _condition-workspace-isOffline:

workspace.isOffline
-------------------

..  confval:: workspace.isOffline
    :name: condition-workspace-isOffline
    :type: Boolean

    True, if the current workspace is offline.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [workspace.isOffline]
            # ...
        [END]


..  index:: Conditions; typo3
..  _condition-typo3:

typo3
=====

..  confval:: typo3
    :name: condition-typo3
    :type: Object

    Object with TYPO3-related information.


..  index:: Conditions; typo3.version
..  _condition-typo3-version:

typo3.version
-------------

..  confval:: typo3.version
    :name: condition-typo3-version
    :type: String

    TYPO3_version (for example, 14.3.1)

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [typo3.version == "14.3.1"]
            # ...
        [END]


..  index:: Conditions; typo3.branch
..  _condition-typo3-branch:

typo3.branch
------------

..  confval:: typo3.branch
    :name: condition-typo3-branch
    :type: String

    TYPO3 branch (for example, 14.3)

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [typo3.branch == "14.3"]
            # ...
        [END]


..  index:: Conditions; typo3.devIpMask
..  _condition-typo3-devIpMask:

typo3.devIpMask
---------------

..  confval:: typo3.devIpMask
    :name: condition-typo3-devIpMask
    :type: String

    :ref:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] <t3coreapi:typo3ConfVars_sys_devIPmask>`

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [typo3.devIpMask == "172.18.0.6"]
            # ...
        [END]


..  index:: Conditions; date
..  _condition-function-date:

date()
======

..  confval:: date()
    :name: condition-date

    :Parameter: String
    :type: String | Integer

    Get the current date in the given format. See the PHP `date function`_
    as a reference for the possible usage.

    ..  _date function: https://www.php.net/manual/en/function.date.php

    Example:

    ..  literalinclude:: _codesnippets/_date.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; like
..  _condition-function-like:

like()
======

..  confval:: like()
    :name: condition-like

    :Parameter: String, String
    :type: Boolean

    This function has two parameters: The first parameter is the string to
    search in, the second parameter is the search string.

    Example:

    ..  literalinclude:: _codesnippets/_like.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; traverse
..  _condition-function-traverse:

traverse()
==========

..  confval:: traverse()
    :name: condition-traverse

    :Parameter: Array, String
    :type: Mixed

    This function gets a value from an array with arbitrary depth and suppresses
    a PHP warning when sub-arrays do not exist. It has two parameters: The first
    parameter is the array to traverse, the second parameter is the path to
    traverse.

    In case the path is not found in the array, an empty string is returned.

    Example:

    ..  literalinclude:: _codesnippets/_traverse.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    ..  tip::
        Checking for the :ref:`request object <t3coreapi:typo3-request>` to be
        available before using :typoscript:`traverse()` may be necessary, for
        example, when using :ref:`Extbase <t3coreapi:extbase>` repositories in
        :ref:`CLI <t3coreapi:symfony-console-commands>` context (as Extbase
        depends on TypoScript and on the command line is no request object
        available). This avoids the error
        `Unable to call method "getQueryParams" of non-object "request"`.

        Same is true for the `page` variable, which might not be available
        in all contexts, for example backend modules without a page.
        One can use the `?? []` workaround.

..  index:: Conditions; compatVersion
..  _condition-function-compatVersion:

compatVersion()
===============

..  confval:: compatVersion()
    :name: condition-compatVersion

    :Parameter: String
    :type: Boolean

    Compares against the current TYPO3 branch.

    Example:

    ..  literalinclude:: _codesnippets/_compatVersion.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _condition-function-getTSFE:
..  _condition-function-getTSFE-migration:

getTSFE(): Migration
====================

..  versionchanged:: 14.0
    `Breaking: #107473 - TypoScript condition function getTSFE() removed <https://docs.typo3.org/permalink/changelog:breaking-107473-1758113238>`_
    The TypoScript condition function `getTSFE()` has been removed. Using a
    condition like `getTSFE()` will never evaluate to true and needs adaption.

..  code-block:: diff
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript (diff)

    - [getTSFE() && getTSFE().id == 42]

    + [request?.getPageArguments()?.getPageId() == 42]

..  index:: Conditions; getenv
..  _condition-function-getenv:

getenv()
========

..  confval:: getenv()
    :name: condition-getenv
    :type: String

    PHP function `getenv <https://www.php.net/manual/en/function.getenv.php>`_.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [getenv("VIRTUAL_HOST") == "www.example.org"]
            # ...
        [END]


..  index:: Conditions; feature
..  _condition-function-feature:

feature()
=========

..  confval:: feature()
    :name: condition-feature
    :type: String

    Provides access to the current state of
    :ref:`feature toggles <t3coreapi:typo3ConfVars_sys_features>`.

    Example:

    ..  literalinclude:: _codesnippets/_feature.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; ip
..  _condition-function-ip:

ip()
====

..  confval:: ip()
    :name: condition-ip

    :Parameter: String
    :type: Boolean

    Value or constraint, wildcard or regular expression possible; special value:
    "devIP" (matches the :ref:`devIPmask <t3coreapi:typo3ConfVars_sys_devIPmask>`).

    This function is only available in TypoScript frontend context.

    Example:

    ..  literalinclude:: _codesnippets/_ip.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; request
..  _condition-function-request:

request()
=========

..  confval:: request()
    :name: condition-request
    :type: Mixed

    Allows to fetch information from current request.

    ..  note:: This function cannot be used in **page TSconfig** or
        **user TSconfig** conditions. They always evaluate to false.

..  tip::
    Checking for the :ref:`request object <t3coreapi:typo3-request>` before
    using in a condition may be necessary, for example, when using
    :ref:`Extbase <t3coreapi:extbase>` repositories in
    :ref:`CLI <t3coreapi:symfony-console-commands>` context (as Extbase
    depends on TypoScript and on the command line is no request object
    available). This avoids, for example, the error
    `Unable to call method "getQueryParams" of non-object "request"`.


..  index:: Conditions; request.getQueryParams()
..  _condition-function-request-getQueryParams():

request.getQueryParams()
------------------------

..  confval:: request.getQueryParams()
    :name: condition-request-getQueryParams
    :type: Array

    Allows to access GET parameters from current request.

    Assuming the following query within URL:

    ``route=%2Fajax%2Fsystem-information%2Frender&token=5c53e9b715362e7b0c3275848068133b89bbed77&skipSessionUpdate=1``

    then the following array would be provided:

    Key: ``route``
        Value: ``/ajax/system-information/render``
    Key: ``token``
        Value: ``5c53e9b715362e7b0c3275848068133b89bbed77``
    Key: ``skipSessionUpdate``
        Value: ``1``

    Example:

    ..  literalinclude:: _codesnippets/_request4.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; request.getParsedBody()
..  _condition-function-request-getParsedBody():

request.getParsedBody()
-----------------------

..  confval:: request.getParsedBody()
    :name: condition-request-getParsedBody
    :type: Array

    Provide all values contained in the request body, for example, in case of
    submitted form via POST, the submitted values.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [request && traverse(request.getParsedBody(), 'foo') == 1]
            # ...
        [END]


..  index:: Conditions; request.getHeaders()
..  _condition-function-request-getHeaders():

request.getHeaders()
--------------------

..  confval:: request.getHeaders()
    :name: condition-request-getHeaders
    :type: Array

    Provide all values from request headers.

    Example:

    ..  literalinclude:: _codesnippets/_request3.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; request.getCookieParams()
..  _condition-function-request-getCookieParams():

request.getCookieParams()
-------------------------

..  confval:: request.getCookieParams()
    :name: condition-request-getCookieParams
    :type: Array

    Provides available cookies.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        [request && request.getCookieParams()['foo'] == 1]
            # ...
        [END]


..  index:: Conditions; request.getNormalizedParams()
..  _condition-function-request-getNormalizedParams():

request.getNormalizedParams()
-----------------------------

..  confval:: request.getNormalizedParams()
    :name: condition-request-getNormalizedParams
    :type: Array

    Provides access to the :php:`\TYPO3\CMS\Core\Http\NormalizedParams` object.
    Have a look at the
    :ref:`normalized parameters of the request object <t3coreapi:typo3-request-attribute-normalizedParams>`
    for a list of the available methods.

    Example:

    ..  literalinclude:: _codesnippets/_request2.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript



..  index:: Conditions; request.getPageArguments()
..  _condition-function-request-getPageArguments():

request.getPageArguments()
--------------------------

..  confval:: request.getPageArguments()
    :name: condition-request-getPageArguments
    :type: Object

    Get the current :php:`\TYPO3\CMS\Core\Routing\PageArguments` object with
    the resolved route parts from enhancers.

    Example:

    ..  literalinclude:: _codesnippets/_request.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

..  index:: Conditions; session
..  _condition-functions-in-frontend-context-function-session:

session()
=========

..  confval:: session()
    :name: condition-session

    :Parameter: String
    :type: Mixed

    Allows to access values of the current session. Available values depend on
    values written to the session, for example, by extensions. Use
    :typoscript:`|` to dig deeper into the structure for stored values.

    Example:

    ..  literalinclude:: _codesnippets/_session.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  index:: Conditions; site
..  _condition-functions-in-frontend-context-function-site:

site()
======

..  confval:: site()
    :name: condition-site

    :Parameter: String
    :type: Mixed

    Get a value from the :ref:`site configuration <t3coreapi:sitehandling>`, or
    null, if no site was found or the property does not exists.

    Available information:

    :typoscript:`site("identifier")`
        Returns the identifier of the current site as a string.

    :typoscript:`site("base")`
        Returns the base of the current site as a string.

    :typoscript:`site("rootPageId")`
        Returns the root page UID of the current site as an integer.

    :typoscript:`site("languages")`
        Returns an array of the available languages for the current site.
        For deeper information, see
        :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    :typoscript:`site("allLanguages")`
        Returns an array of available and unavailable languages for the current
        site. For deeper information, see
        :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    :typoscript:`site("defaultLanguage")`
        Returns the default language for the current site.
        For deeper information, see
        :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    :typoscript:`site("configuration")`
        Returns an array with the available configuration for the current site.

    Example:

    ..  literalinclude:: _codesnippets/_site2.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    Site settings can also be used in the conditions in TypoScript constants:

    ..  literalinclude:: _codesnippets/_site.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/constants.typoscript

..  index:: Conditions; siteLanguage
..  _condition-functions-in-frontend-context-function-siteLanguage:

siteLanguage()
==============

..  confval:: siteLanguage()
    :name: condition-siteLanguage

    :Parameter: String
    :type: Mixed

    Get a value from the
    :ref:`site language configuration <t3coreapi:sitehandling-addingLanguages>`,
    or null if no site was found or property not exists.

    Available information:

    :typoscript:`siteLanguage("languageId")`
        Returns the language ID as an integer.

    :typoscript:`siteLanguage("locale")`
        Returns the current locale as :php:`\TYPO3\CMS\Core\Localization\Locale`.
        You can call all public methods of the object, for example
        :typoscript:`siteLanguage("locale").getName()` returns `en-GB` or `de-DE`.

        ..  versionchanged:: 14.0
            You can use expression `locale() <https://docs.typo3.org/permalink/t3tsref:condition-functions-in-frontend-context-function-locale>`_
            as a shortcut to get the :php-short:`\TYPO3\CMS\Core\Localization\Locale`.

    :typoscript:`siteLanguage("base")`
        Returns the configured base URL as a string.

    :typoscript:`siteLanguage("title")`
        Returns the internal human-readable name for this language as a string.

    :typoscript:`siteLanguage("navigationTitle")`
        Returns the navigation title as a string.

    :typoscript:`siteLanguage("flagIdentifier")`
        Returns the flag identifier as a string, for example `gb`.

    :typoscript:`siteLanguage("typo3Language")`
        Returns the language identifier used in TYPO3
        :ref:`XLIFF <t3coreapi:xliff>` files as a string, for example `default`
        or the two-letter language code.

    :typoscript:`siteLanguage("hreflang")`
        Returns the language information for the hreflang tag as a string.

    :typoscript:`siteLanguage("fallbackType")`
        Returns the language fallback mode as a string, one of `fallback`,
        `strict` or `free`.

    :typoscript:`siteLanguage("fallbackLanguageIds")`
        Returns the list of fallback languages as a string, for example `1,0`.

    Example:

    ..  literalinclude:: _codesnippets/_siteLanguage.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

..  _condition-functions-in-frontend-context-function-locale:

locale()
========

..  confval:: locale()
    :name: condition-locale

    ..  versionadded:: 14.0

    This expression allows integrators and developers to access
    the current site locale, which is provided as a locale object of type
    :php-short:`\TYPO3\CMS\Core\Localization\Locale`.

    All public methods of this object are available for use,  for example
    :typoscript:`locale().getName()` returns `en-GB` or `de-DE`.

    ..  seealso::
        *   `TYPO3 explained: Locale API <https://docs.typo3.org/permalink/t3coreapi:locale-api>`_

    ..  literalinclude:: _codesnippets/_locale.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

..  _condition-examples:

Examples
========

..  _condition-examples-constant:

Check if a constant is set to a certain value
---------------------------------------------

TypoScript constants can be used in conditions with the
:ref:`Syntax <typoscript-syntax-conditions-syntax>` for conditions:

..  literalinclude:: _codesnippets/_constant.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

..  note::
    TypoScript constants can be used in frontend TypoScript *setup* conditions,
    but not in Frontend TypoScript *constants* conditions. At the time of
    evaluation the constants are not yet available in constants conditions.

    It is, however, possible to use :confval:`site settings <condition-site>`
    in constant conditions.

..  _condition-examples-constant-strict-types:

Compare constant with strict types
----------------------------------

All constants are by default string. But as constants were replaced
before expression check, numeric values will interpreted as integer if they
were not wrapped into quotes. This may lead to miss-understanding while using
strict type comparison `===` in expressions. See following examples:

Without using strict type comparison following two examples are true if
constant is set to 1:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == 1]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == "1"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

In case of using strict type comparison only the next upper example is true.
That's because the stored number of the constant was not wrapped with quotes
and was therefor interpreted as integer.

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} === 1]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} === "1"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

..  _condition-examples-constant-compare-strings:

Compare constant against strings
--------------------------------

All constants are by default string. As they are replaced with their
contained value before expression check, you have to wrap them into quotes
to prevent interpreting the values as integer or float.

Following condition is always false:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == "active"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

If you are working with strings in conditions please do it that way:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    ["{$tx_my_extension.settings.feature1Enabled}" == "active"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

Sure, strict type string comparisons are also working:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

    ["{$tx_my_extension.settings.feature1Enabled}" === "active"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

..  _condition-examples-constant-reserved-keywords:

Use constants with reserved keywords
------------------------------------

As explained, above constants were replaced with their values before they are
processed by expression language. That allows experimental structures: If
`{$foo}` is set to the reserved :ref:`page <t3tsref:condition-page>` array
and page title is `Home` following condition is true:

..  literalinclude:: _codesnippets/_keywords2.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

After the replacement of the constant the example will result into:

..  literalinclude:: _codesnippets/_keywords.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript
