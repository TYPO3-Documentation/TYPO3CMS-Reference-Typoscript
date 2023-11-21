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


==========
Conditions
==========

Frontend TypoScript conditions offer a way to conditionally change TypoScript
based on current context. Do not confuse conditions with the
:ref:`"if" function <if>`, which is a :ref:`stdWrap <stdwrap>` property to act
on current data.

..  seealso::
    Have a look at the
    :ref:`TypoScript syntax condition chapter <t3coreapi:typoscript-syntax-conditions>`
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

:aspect:`Variable`
    applicationContext

:aspect:`Type`
    String

:aspect:`Description`
    The current application context as a string.
    See :ref:`t3coreapi:bootstrapping-context`.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [applicationContext == "Development"]

        # Any context that is "Production" or starts with "Production"
        # (for example, Production/Staging").
        [applicationContext matches "/^Production/"]

..  index:: Conditions; page
..  _condition-page:

page
====

:aspect:`Variable`
    page

:aspect:`Type`
    Array

:aspect:`Description`
    All data of the current page record as array.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check single page UID
        [traverse(page, "uid") == 2]

        # Check list of page UIDs
        [traverse(page, "uid") in [17,24]]

        # Check list of page UIDs NOT in
        [traverse(page, "uid") not in [17,24]]

        # Check range of pages (example: page UID from 10 to 20)
        [traverse(page, "uid") in 10..20]

        # Check the page backend layout
        [traverse(page, "backend_layout") == 5]
        [traverse(page, "backend_layout") == "example_layout"]

        # Check the page title
        [traverse(page, "title") == "foo"]


..  index:: Conditions; tree
..  _condition-tree:

tree
====

:aspect:`Variable`
    tree

:aspect:`Type`
    Object

:aspect:`Description`
    Object with tree information.


..  index::
    Conditions; tree.level
    Conditions; Page level

..  _condition-tree-level:

tree.level
----------

:aspect:`Variable`
    tree.level

:aspect:`Type`
    Integer

:aspect:`Description`
    The current tree level.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if the page is on level 0:
        [tree.level == 0]


..  index:: Conditions; tree.pagelayout
..  _condition-tree-pagelayout:

tree.pagelayout
---------------

:aspect:`Variable`
    tree.pagelayout

:aspect:`Type`
    Integer / String

:aspect:`Description`
    Check for the defined :ref:`backend layout <be-layout>` of a page, including
    the inheritance of the field `Backend Layout (subpages of this page)`.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Using backend layout records
        [tree.pagelayout == 2]

        # Using the TSconfig provider of backend layouts
        [tree.pagelayout == "pagets__Home"]


..  index::
    Conditions; tree.rootLine
..  _condition-tree-rootLine:

tree.rootLine
-------------

:aspect:`Variable`
    tree.rootLine

:aspect:`Type`
    Array

:aspect:`Description`
    Array of arrays with UID and PID.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [tree.rootLine[0]["uid"] == 1]


..  index::
    Conditions; tree.rootLineIds
    Conditions; PID in rootline
..  _condition-tree-rootLineIds:

tree.rootLineIds
----------------

:aspect:`Variable`
    tree.rootLineIds

:aspect:`Type`
    Array

:aspect:`Description`
    An array with UIDs of the root line.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if page with uid 2 is inside the root line
        [2 in tree.rootLineIds]


..  index::
    Conditions; tree.rootLineParentIds
    Conditions; PID up in rootline
..  _condition-tree-rootLineParentIds:

tree.rootLineParentIds
----------------------

:aspect:`Variable`
    tree.rootLineParentIds

:aspect:`Type`
    Array

:aspect:`Description`
    An array with parent UIDs of the root line.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if the page with UID 2 is the parent of a page inside the root line
        [2 in tree.rootLineParentIds]


..  index:: Conditions; backend
..  _condition-backend:

backend
=======

:aspect:`Variable`
    backend

:aspect:`Type`
    Object

:aspect:`Description`
    Object with backend information.


..  index:: Conditions; backend.user
..  _condition-backend-user:

backend.user
------------

:aspect:`Variable`
    backend.user

:aspect:`Type`
    Object

:aspect:`Description`
    Object with current backend user information.


..  index::
    Conditions; backend.user.isAdmin
    Conditions; Admin logged in
..  _condition-backend-user-isAdmin:

backend.user.isAdmin
--------------------

:aspect:`Variable`
    backend.user.isAdmin

:aspect:`Type`
    Boolean

:aspect:`Description`
    True, if the current backend user is administrator.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Evaluates to true, if the current backend user is administrator
        [backend.user.isAdmin]


..  index:: Conditions; backend.user.isLoggedIn
..  _condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
-----------------------

:aspect:`Variable`
    backend.user.isLoggedIn

:aspect:`Type`
    Boolean

:aspect:`Description`
    True, if the current backend user is logged in.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Evaluates to true, if a backend user is logged in
        [backend.user.isLoggedIn]


..  index:: Conditions; backend.user.userId
..  _condition-backend-user-userId:

backend.user.userId
-------------------

:aspect:`Variable`
    backend.user.userId

:aspect:`Type`
    Integer

:aspect:`Description`
    UID of the the current backend user.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Evaluates to true, if the user UID of the current logged-in backend
        # user is equal to 5
        [backend.user.userId == 5]


..  index:: Conditions; backend.user.userGroupIds
..  _condition-backend-user-userGroupIds:

backend.user.userGroupIds
-------------------------

:aspect:`Variable`
    backend.user.userGroupIds

:aspect:`Type`
    array

:aspect:`Description`
    Array of user group IDs assigned to the current backend user.

:aspect:`Context`
    Frontend, backend

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [2 in backend.user.userGroupIds]


..  index:: Conditions; backend.user.userGroupList
..  _condition-backend-user-userGroupList:

backend.user.userGroupList
--------------------------

:aspect:`Variable`
    backend.user.userGroupList

:aspect:`Type`
    String

:aspect:`Description`
    Comma-separated list of group UIDs.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [like(","~backend.user.userGroupList~",", "*,1,*")]


..  index:: Conditions; frontend
..  _condition-frontend:

frontend
========

:aspect:`Variable`
    frontend

:aspect:`Type`
    Object

:aspect:`Description`
    Object with frontend information.


..  index:: Conditions; frontend.user
..  _condition-frontend-user:

frontend.user
-------------

:aspect:`Variable`
    frontend.user

:aspect:`Type`
    Object

:aspect:`Description`
    Object with current frontend user information.


..  index:: Conditions; frontend.user.isLoggedIn
..  _condition-frontend-user-isLoggedIn:

frontend.user.isLoggedIn
------------------------

:aspect:`Variable`
    frontend.user.isLoggedIn

:aspect:`Type`
    Boolean

:aspect:`Description`
    True, if the current frontend user is logged in.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [frontend.user.isLoggedIn]


..  index:: Conditions; frontend.user.userId
..  _condition-frontend-user-userId:

frontend.user.userId
--------------------

:aspect:`Variable`
    frontend.user.userId

:aspect:`Type`
    Integer

:aspect:`Description`
    The UID of the current frontend user.

:aspect:`Example`
    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [frontend.user.userId == 5]

..  index:: Conditions; frontend.user.userGroupIds
..  _condition-frontend-user-userGroupIds:

frontend.user.userGroupIds
--------------------------

:aspect:`Variable`
    frontend.user.userGroupList

:aspect:`Type`
    array

:aspect:`Description`
    Array of user group IDs of the current frontend user.

:aspect:`Context`
    Frontend

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [4 in frontend.user.userGroupIds]

..  index:: Conditions; frontend.user.userGroupList
..  _condition-frontend-user-userGroupList:

frontend.user.userGroupList
---------------------------

:aspect:`Variable`
    frontend.user.userGroupList

:aspect:`Type`
    String

:aspect:`Description`
    Comma-separated list of group UIDs.

:aspect:`Example`
    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [like(","~frontend.user.userGroupList~",", "*,1,*")]


..  index:: Conditions; workspace
..  _condition-workspace:

workspace
=========

:aspect:`Variable`
    workspace

:aspect:`Type`
    Object

:aspect:`Description`
    Object with :ref:`workspace <t3coreapi:workspaces>` information.


..  index:: Conditions; workspace.workspaceId
..  _condition-workspace-workspaceId:

workspace.workspaceId
---------------------

:aspect:`Variable`
    workspace.workspaceId

:aspect:`Type`
    Integer

:aspect:`Description`
    UID of the current workspace.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if in live workspace
        [workspace.workspaceId == 0]


..  index:: Conditions; workspace.isLive
..  _condition-workspace-isLive:

workspace.isLive
----------------

:aspect:`Variable`
    workspace.isLive

:aspect:`Type`
    Boolean

:aspect:`Description`
    True, if the current workspace is the live workspace.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [workspace.isLive]


..  index:: Conditions; workspace.isOffline
..  _condition-workspace-isOffline:

workspace.isOffline
-------------------

:aspect:`Variable`
    workspace.isOffline

:aspect:`Type`
    Boolean

:aspect:`Description`
    True, if the current workspace is offline.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [workspace.isOffline]


..  index:: Conditions; typo3
..  _condition-typo3:

typo3
=====

:aspect:`Variable`
    typo3

:aspect:`Type`
    Object

:aspect:`Description`
    Object with TYPO3-related information.


..  index:: Conditions; typo3.version
..  _condition-typo3-version:

typo3.version
-------------

:aspect:`Variable`
    typo3.version

:aspect:`Type`
    String

:aspect:`Description`
    TYPO3_version (for example, 12.4.5)

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.version == "12.4.5"]


..  index:: Conditions; typo3.branch
..  _condition-typo3-branch:

typo3.branch
------------

:aspect:`Variable`
    typo3.branch

:aspect:`Type`
    String

:aspect:`Description`
    TYPO3 branch (for example, 12.4)

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.branch == "12.4"]


..  index:: Conditions; typo3.devIpMask
..  _condition-typo3-devIpMask:

typo3.devIpMask
---------------

:aspect:`Variable`
    typo3.devIpMask

:aspect:`Type`
    String

:aspect:`Description`
    :ref:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] <t3coreapi:typo3ConfVars_sys_devIPmask>`

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.devIpMask == "172.18.0.6"]


..  index:: Conditions; date
..  _condition-function-date:

date()
======

:aspect:`Function`
    date()

:aspect:`Parameter`
    String

:aspect:`Type`
    String / Integer

:aspect:`Description`
    Get the current date in the given format. See the PHP `date function`_
    as a reference for the possible usage.

..  _date function: https://www.php.net/manual/en/function.date.php

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the day of the current month is 7
        [date("j") == 7]

        # True, if the day of the current week is 7
        [date("w") == 7]

        # True, if the day of the current year is 7
        [date("z") == 7]

        # True, if the current hour is 7
        [date("G") == 7]

..  index:: Conditions; like
..  _condition-function-like:

like()
======

:aspect:`Function`
    like()

:aspect:`Parameter`
    String, String

:aspect:`Type`
    Boolean

:aspect:`Description`
    This function has two parameters: The first parameter is the string to
    search in, the second parameter is the search string.

:aspect:`Example`
    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Search a string with * within another string
        [like("fooBarBaz", "*Bar*")]

        # Search string with single characters in between, using ?
        [like("fooBarBaz", "f?oBa?Baz")]

        # Search string using regular expression
        [like("fooBarBaz", "/f[o]{2,2}[aBrz]+/")]


..  index:: Conditions; traverse
..  _condition-function-traverse:

traverse()
==========

:aspect:`Function`
    traverse()

:aspect:`Parameter`
    Array, string

:aspect:`Type`
    Custom

:aspect:`Description`
    This function gets a value from an array with arbitrary depth and suppresses
    a PHP warning when sub-arrays do not exist. It has two parameters: The first
    parameter is the array to traverse, the second parameter is the path to
    traverse.

    In case the path is not found in the array, an empty string is returned.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Traverse query parameters of current request along tx_news_pi1[news]
        [request && traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]

    ..  tip::
        Checking for the :ref:`request object <t3coreapi:typo3-request>` to be
        available before using :typoscript:`traverse()` may be necessary, for
        example, when using :ref:`Extbase <t3coreapi:extbase>` repositories in
        :ref:`CLI <t3coreapi:symfony-console-commands>` context (as Extbase
        depends on TypoScript and on the command line is no request object
        available). This avoids the error
        `Unable to call method "getQueryParams" of non-object "request"`.

..  index:: Conditions; compatVersion
..  _condition-function-compatVersion:

compatVersion()
===============

:aspect:`Function`
    compatVersion()

:aspect:`Parameter`
    String

:aspect:`Type`
    Boolean

:aspect:`Description`
    Compares against the current TYPO3 branch.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the current TYPO3 version is 12.4.x
        [compatVersion("12.4")]

        True, if the current TYPO3 version is 12.4.5
        [compatVersion("12.4.5")]


..  index:: Conditions; getTSFE
..  _condition-function-getTSFE:

getTSFE()
=========

:aspect:`Function`
    getTSFE()

:aspect:`Parameter`
    Object

:aspect:`Description`
    Provides access to :ref:`TypoScriptFrontendController <t3coreapi:tsfe>`
    :php:`$GLOBALS['TSFE']`. This function can directly access methods of
    :php:`TypoScriptFrontendController`. This class is target of a mid-term
    refactoring. It should be used with care since it will eventually vanish in
    the future.

    Using the :typoscript:`getTSFE()` function, developers have to ensure that
    "TSFE" is available before accessing its properties. A missing "TSFE", for
    example, in backend context, does no longer automatically evaluate the whole
    condition to :php:`false`. Instead, the function returns  :php:`null`, which
    can be checked using either :typoscript:`[getTSFE() && getTSFE().id == 17]`
    or the null-safe operator :typoscript:`[getTSFE()?.id == 17]`.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the current page UID is 17. Use the page variable instead
        [getTSFE()?.id == 17]


..  index:: Conditions; getenv
..  _condition-function-getenv:

getenv()
========

:aspect:`Function`
    getenv()

:aspect:`Parameter`
    String

:aspect:`Description`
    PHP function `getenv <https://www.php.net/manual/en/function.getenv.php>`_.

:aspect:`Example`
    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [getenv("VIRTUAL_HOST") == "www.example.org"]


..  index:: Conditions; feature
..  _condition-function-feature:

feature()
=========

:aspect:`Function`
    feature()

:aspect:`Parameter`
    String

:aspect:`Description`
    Provides access to the current state of
    :ref:`feature toggles <typo3ConfVars_sys_features>`.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the feature toggle for enforcing the Content Security Policy
        # in the frontend is enabled
        [feature("security.frontend.enforceContentSecurityPolicy") === true]


..  index:: Conditions; ip
..  _condition-function-ip:

ip()
====

..  versionchanged:: 13.0
    This function is only available in TypoScript frontend context. For
    migration hints see the :ref:`changelog <ext_core:deprecation-100047-1677608959>`.

:aspect:`Function`
    ip()

:aspect:`Parameter`
    String

:aspect:`Type`
    Boolean

:aspect:`Description`
    Value or constraint, wildcard or regular expression possible; special value:
    "devIP" (matches the :ref:`devIPmask <t3coreapi:typo3ConfVars_sys_devIPmask>`).

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [ip("172.18.*")]
            page.10.value = Your IP matches "172.18.*"
        [END]

        [ip("devIP")]
            page.10.value = Your IP matches the configured devIp
        [END]


..  index:: Conditions; request
..  _condition-function-request:

request()
=========

..  deprecated:: 12.3
    Using this function in **page TSconfig** or **user TSconfig** conditions is
    deprecated. Such conditions will stop working with TYPO3 v13 and will then
    always evaluate to false. For migration hints see the
    :ref:`changelog <ext_core:deprecation-100047-1677608959>`.

:aspect:`Function`
    request()

:aspect:`Parameter`
    Custom

:aspect:`Description`
    Allows to fetch information from current request.

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

:aspect:`Function`
    request.getQueryParams()

:aspect:`Parameter`
    Custom

:aspect:`Type`
    Array

:aspect:`Description`
    Allows to access GET parameters from current request.

    Assuming the following query within url:

    ``route=%2Fajax%2Fsystem-information%2Frender&token=5c53e9b715362e7b0c3275848068133b89bbed77&skipSessionUpdate=1``

    then the following array would be provided:

    Key: ``route``
        Value: ``/ajax/system-information/render``
    Key: ``token``
        Value: ``5c53e9b715362e7b0c3275848068133b89bbed77``
    Key: ``skipSessionUpdate``
        Value: ``1``

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Safely check the query parameter array to avoid error logs in case key
        # is not defined. This will check if the GET parameter
        # tx_news_pi1[news] in the URL is greater than 0:
        [request && traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]


..  index:: Conditions; request.getParsedBody()
..  _condition-function-request-getParsedBody():

request.getParsedBody()
-----------------------

:aspect:`Function`
    request.getParsedBody()

:aspect:`Parameter`
    Custom

:aspect:`Type`
    Array

:aspect:`Description`
    Provide all values contained in the request body, for example, in case of
    submitted form via POST, the submitted values.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getParsedBody()['foo'] == 1]


..  index:: Conditions; request.getHeaders()
..  _condition-function-request-getHeaders():

request.getHeaders()
--------------------

:aspect:`Function`
    request.getHeaders()

:aspect:`Parameter`
    Custom

:aspect:`Type`
    Array

:aspect:`Description`
    Provide all values from request headers.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getHeaders()['Accept'] == 'json']
            page.10.value = Accepts json
        [END]

        [request && request.getHeaders()['host'][0] == 'www.example.org']
            page.20.value = The host is www.example.org
        [END]


..  index:: Conditions; request.getCookieParams()
..  _condition-function-request-getCookieParams():

request.getCookieParams()
-------------------------

:aspect:`Function`
    request.getCookieParams()

:aspect:`Parameter`
    Custom

:aspect:`Type`
    Array

:aspect:`Description`
    Provides available cookies.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getCookieParams()['foo'] == 1]


..  index:: Conditions; request.getNormalizedParams()
..  _condition-function-request-getNormalizedParams():

request.getNormalizedParams()
-----------------------------

:aspect:`Function`
    request.getNormalizedParams()

:aspect:`Parameter`
    Custom

:aspect:`Type`
    Array

:aspect:`Description`
    Provides access to the :php:`\TYPO3\CMS\Core\Http\NormalizedParams` object.
    Have a look at the
    :ref:`normalized parameters of the request object <t3coreapi:typo3-request-attribute-normalizedParams>`
    for a list of the available methods.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getNormalizedParams().isHttps()]
            page.10.value = HTTPS is being used
        [END]

        [request && request.getNormalizedParams().getHttpHost() == "example.org"]
            page.10.value = The host is "example.org"
        [END]



..  index:: Conditions; request.getPageArguments()
..  _condition-function-request-getPageArguments():

request.getPageArguments()
--------------------------

:aspect:`Function`
    request.getPageArguments()

:aspect:`Parameter`
    None

:aspect:`Type`
    Array

:aspect:`Description`
    Get the current :php:`\TYPO3\CMS\Core\Routing\PageArguments` object with
    the resolved route parts from enhancers.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getPageArguments().get('foo_id') > 0]

        # True, if current page type is 98
        [request && request.getPageArguments()?.getPageType() == 98]


..  index:: Conditions; session
..  _condition-functions-in-frontend-context-function-session:

session()
=========

:aspect:`Function`
    session()

:aspect:`Parameter`
    String

:aspect:`Value`
    Mixed

:aspect:`Description`
    Allows to access values of the current session. Available values depend on
    values written to the session, for example, by extensions. Use
    :typoscript:`|` to dig deeper into the structure for stored values.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Match, if the session has the value 1234567 in the structure :php:`$foo['bar']`:
        [session("foo|bar") == 1234567]


..  index:: Conditions; site
..  _condition-functions-in-frontend-context-function-site:

site()
======

:aspect:`Function`
    site

:aspect:`Parameter`
    String

:aspect:`Description`
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

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Site identifier
        [site("identifier") == "my_site"]

        # Match site base host
        [site("base").getHost() == "www.example.org"]

        # Match base path
        [site("base").getPath() == "/"]

        # Match root page UID
        [site("rootPageId") == 1]

        # Match a configuration property
        [traverse(site("configuration"), "myCustomProperty") == true]


..  index:: Conditions; siteLanguage
..  _condition-functions-in-frontend-context-function-siteLanguage:

siteLanguage()
==============

:aspect:`Function`
    siteLanguage()

:aspect:`Parameter`
    String

:aspect:`Value`
    Mixed

:aspect:`Description`
    Get a value from the
    :ref:`site language configuration <t3coreapi:sitehandling-addingLanguages>`,
    or null if no site was found or property not exists.

    Available information:

    :typoscript:`siteLanguage("languageId")`
        Returns the language ID as an integer.

    :typoscript:`siteLanguage("locale")`
        Returns the current locale as a string, for example `en_GB` or `de_DE`.

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
        ..  versionchanged:: 12.4
            This option is not relevant anymore for regular websites without
            rendering hreflang tag, but is now customizable, and has a proper
            fallback.

        Returns the language information for the hreflang tag as a string.

    :typoscript:`siteLanguage("fallbackType")`
        Returns the language fallback mode as a string, one of `fallback`,
        `strict` or `free`.

    :typoscript:`siteLanguage("fallbackLanguageIds")`
        Returns the list of fallback languages as a string, for example `1,0`.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [siteLanguage("locale") == "de_CH"]
            page.10.value = This site has the locale "de_CH"
        [END]

        [siteLanguage("title") == "Italy"]
            page.10.value = This site has the title "Italy"
        [END]


..  index:: Conditions; loginUser
..  _condition-function-loginUser:

loginUser()
===========

..  versionchanged:: 13.0
    This function has been removed. Use the variables
    :ref:`condition-frontend-user` and :ref:`condition-backend-user` instead.
    For migration hints see the
    :ref:`changelog <ext_core:deprecation-100349-1680097287>`.


..  index:: Conditions; usergroup
..  _condition-function-usergroup:

usergroup()
===========

..  versionchanged:: 13.0
    This function has been removed. Use the variables
    :ref:`condition-frontend-user` and :ref:`condition-backend-user` instead.
    For migration hints see the
    :ref:`changelog <ext_core:deprecation-100349-1680097287>`.
