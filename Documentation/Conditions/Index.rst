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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [applicationContext == "Development"]
            # ...
        [END]

        # Any context that is "Production" or starts with "Production"
        # (for example, Production/Staging").
        [applicationContext matches "/^Production/"]
            # ...
        [END]


..  index:: Conditions; page
..  _condition-page:

page
====

..  confval:: page
    :name: condition-page
    :type: Array

    All data of the current page record as array.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check single page UID
        [traverse(page, "uid") == 2]
            # ...
        [END]

        # Check list of page UIDs
        [traverse(page, "uid") in [17,24]]
            # ...
        [END]

        # Check list of page UIDs NOT in
        [traverse(page, "uid") not in [17,24]]
            # ...
        [END]

        # Check range of pages (example: page UID from 10 to 20)
        [traverse(page, "uid") in 10..20]
            # ...
        [END]

        # Check the page backend layout
        [traverse(page, "backend_layout") == 5]
            # ...
        [END]
        [traverse(page, "backend_layout") == "example_layout"]
            # ...
        [END]

        # Check the page title
        [traverse(page, "title") == "foo"]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if the page is on level 0:
        [tree.level == 0]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Using backend layout records
        [tree.pagelayout === "2"]
            # ...
        [END]

        # Using the TSconfig provider of backend layouts
        [tree.pagelayout === "pagets__Home"]
            # ...
        [END]

        # Using backend layout records multiple
        [tree.pagelayout in ['2','3','4','5']]
            # ...
        [END]

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if page with uid 2 is inside the root line
        [2 in tree.rootLineIds]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if the page with UID 2 is the parent of a page inside the root line
        [2 in tree.rootLineParentIds]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Evaluates to true, if the current backend user is administrator
        [backend.user.isAdmin]
            # ...
        [END]


..  index:: Conditions; backend.user.isLoggedIn
..  _condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
-----------------------

..  confval:: backend.user.isLoggedIn
    :name: condition-backend-user-isLoggedIn
    :type: Boolean

    True, if the current backend user is logged in.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Evaluates to true, if a backend user is logged in
        [backend.user.isLoggedIn]
            # ...
        [END]


..  index:: Conditions; backend.user.userId
..  _condition-backend-user-userId:

backend.user.userId
-------------------

..  confval:: backend.user.userId
    :name: condition-backend-user-userId
    :type: Integer

    UID of the the current backend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Evaluates to true, if the user UID of the current logged-in backend
        # user is equal to 5
        [backend.user.userId == 5]
            # ...
        [END]


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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check, if in live workspace
        [workspace.workspaceId == 0]
            # ...
        [END]


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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    TYPO3_version (for example, 13.4.0)

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.version == "13.4.0"]
            # ...
        [END]


..  index:: Conditions; typo3.branch
..  _condition-typo3-branch:

typo3.branch
------------

..  confval:: typo3.branch
    :name: condition-typo3-branch
    :type: String

    TYPO3 branch (for example, 13.4)

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.branch == "13.4"]
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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the day of the current month is 7
        [date("j") == 7]
            # ...
        [END]

        # True, if the day of the current week is 7
        [date("w") == 7]
            # ...
        [END]

        # True, if the day of the current year is 7
        [date("z") == 7]
            # ...
        [END]

        # True, if the current hour is 7
        [date("G") == 7]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Search a string with * within another string
        [like("fooBarBaz", "*Bar*")]
            # ...
        [END]

        # Search string with single characters in between, using ?
        [like("fooBarBaz", "f?oBa?Baz")]
            # ...
        [END]

        # Search string using regular expression
        [like("fooBarBaz", "/f[o]{2,2}[aBrz]+/")]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Traverse query parameters of current request along tx_news_pi1[news]
        [request && traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]

        # Traverse page properties for current page
        [traverse(page ?? [], "pid") == 65]

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the current TYPO3 version is 13.4.x
        [compatVersion("13.4")]
            # ...
        [END]

        # True, if the current TYPO3 version is 13.4.0
        [compatVersion("13.4.0")]
            # ...
        [END]


..  index:: Conditions; getTSFE
..  _condition-function-getTSFE:

getTSFE()
=========

..  confval:: getTSFE()
    :name: condition-getTSFE
    :type: Object

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

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the current page UID is 17. Use the page variable instead
        [getTSFE()?.id == 17]


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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the feature toggle for enforcing the Content Security Policy
        # in the frontend is enabled
        [feature("security.frontend.enforceContentSecurityPolicy") === true]
            # ...
        [END]


..  index:: Conditions; ip
..  _condition-function-ip:

ip()
====

..  versionchanged:: 13.0
    This function is only available in TypoScript frontend context. For
    migration hints see the :ref:`changelog <ext_core:deprecation-100047-1677608959>`.

..  confval:: ip()
    :name: condition-ip

    :Parameter: String
    :type: Boolean

    Value or constraint, wildcard or regular expression possible; special value:
    "devIP" (matches the :ref:`devIPmask <t3coreapi:typo3ConfVars_sys_devIPmask>`).

    Example:

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Safely check the query parameter array to avoid error logs in case key
        # is not defined. This will check if the GET parameter
        # tx_news_pi1[news] in the URL is greater than 0:
        [request && traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]
            # ...
        [END]


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
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

..  confval:: request.getCookieParams()
    :name: condition-request-getCookieParams
    :type: Array

    Provides available cookies.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

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

..  confval:: request.getPageArguments()
    :name: condition-request-getPageArguments
    :type: Object

    Get the current :php:`\TYPO3\CMS\Core\Routing\PageArguments` object with
    the resolved route parts from enhancers.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getPageArguments().get('foo_id') > 0]
            # ...
        [END]

        # True, if current page type is 98
        [request && request.getPageArguments()?.getPageType() == 98]
            # ...
        [END]

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Match, if the session has the value 1234567 in the structure :php:`$foo['bar']`:
        [session("foo|bar") == 1234567]
            # ...
        [END]


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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Site identifier
        [site("identifier") == "my_site"]
            # ...
        [END]

        # Match site base host
        [site("base").getHost() == "www.example.org"]
            # ...
        [END]

        # Match base path
        [site("base").getPath() == "/"]
            # ...
        [END]

        # Match root page UID
        [site("rootPageId") == 1]
            # ...
        [END]

        # Match a configuration property
        [traverse(site("configuration"), "myCustomProperty") == true]
            # ...
        [END]

    Site settings can also be used in the conditions in TypoScript constants:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/constants.typoscript

        my.constant = my global value
        [traverse(site('configuration'), 'settings/some/setting') == 'someValue']
          my.constant = another value, if condition matches
        [global]

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

        **Note**: In TYPO3 v12 there was an unintentional breaking change,
        whereby an object and not a string is returned.
        A future TYPO3 release may address implementing a shortcut for this.

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

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [siteLanguage("locale").getName() == "de-CH"]
            page.10.value = This site has the locale "de_CH" or "de_CH.utf8"
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


..  _condition-examples:

Examples
========

..  _condition-examples-constant:

Check if a constant is set to a certain value
---------------------------------------------

TypoScript constants can be used in conditions with the
:ref:`Syntax <typoscript-syntax-conditions-syntax>` for conditions:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == 1]
        page.10.value = The feature 1 of my_extension is enabled.
    [ELSE]
        page.10.value = The feature 1 of my_extension is not enabled.
    [END]

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
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == 1]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == "1"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

In case of using strict type comparison only the next upper example is true.
That's because the stored number of the constant was not wrapped with quotes
and was therefor interpreted as integer.

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} === 1]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

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
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [{$tx_my_extension.settings.feature1Enabled} == "active"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

If you are working with strings in conditions please do it that way:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    ["{$tx_my_extension.settings.feature1Enabled}" == "active"]
        page.10.value = The feature 1 of my_extension is enabled.
    [END]

Sure, strict type string comparisons are also working:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

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

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [traverse({$foo}, "title") == "Home"]
        page.10.value (
            Value will be shown if constant is "page" and page title is "Home"
        )
    [END]

After the replacement of the constant the example will result into:

..  code-block:: typoscript
    :caption: EXT:my_extension/Configuration/TypoScript/setup.typoscript

    [traverse(page, "title") == "Home"]
        page.10.value (
            Value will be shown if constant is "page" and page title is "Home"
        )
    [END]
