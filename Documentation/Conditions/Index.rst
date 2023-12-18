..  include:: /Includes.rst.txt
..  index:: Conditions
..  _conditions:
..  _condition-reference:
..  _condition-variables:

==========
Conditions
==========

.. seealso::

   *  For full explanations about conditions, especially about condition syntax, please refer to
      :ref:`the TypoScript Syntax chapter of the Core API <t3coreapi:typoscript-syntax-conditions>`.
      The "new" condition syntax (since TYPO3 v9.4) is based on the
      `Symfony expression language <https://symfony.com/doc/5.4/components/expression_language.html>`__.
   *  TypoScript also offers the :ref:`"if" function <if>` to create conditions.

.. contents::
   :local:


.. index:: Conditions; applicationContext
.. _condition-applicationContext:

applicationContext
==================

..  confval:: applicationContext

    :Data type: String

    The current application context as a string.
    See :ref:`t3coreapi:bootstrapping-context`.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [applicationContext == "Development"]

    Any context that is "Production" or starts with "Production" (eg Production/Staging").

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [applicationContext matches "/^Production/"]


..  index:: Conditions; page
..  _condition-page:

page
====

..  note::
    :typoscript:`page` is only available in the frontend context. As the TypoScript setup may be
    loaded in some backend modules or the CLI context, it is considered best practice to always
    guard the property by using the function :ref:`traverse() <condition-function-traverse>`

..  confval:: page

    :Data type: Array

    All data of the current page record as array.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Check single page uid
        [traverse(page, "uid") == 2]

        # Check list of page uids
        [traverse(page, "uid") in [17,24]]

        # Check list of page uids NOT in
        [traverse(page, "uid") not in [17,24]]

        # Check range of pages (example: page uid from 10 to 20)
        [traverse(page, "uid") in 10..20]

        # Check the page backend layout
        [traverse(page, "backend_layout") == 5]
        [traverse(page, "backend_layout") == "example_layout"]

        # Check the page title
        [traverse(page, "title") == "foo"]


..  index:: Conditions; Constant
..  _condition-constant:

Constant
========

..  confval:: {$foo.bar}

    :Data type: Constant

    Any TypoScript constant is available like before.
    Depending on the type of the constant you have to use
    different conditions.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # If constant is an integer
        [{$foo.bar} == 4711]

        # If constant is a string, put constant in quotes
        ["{$foo.bar}" == "4711"]


..  index:: Conditions; tree
..  _condition-tree:

tree
====

..  confval:: tree

    :Data type: Object

    Object with tree information.


..  index::
    Conditions; tree.level
    Conditions; Page level
..  _condition-tree-level:

tree.level
----------

..  confval:: tree.level

    :Data type: Integer

    The current tree level.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [tree.level == 0]



..  index:: Conditions; tree.pagelayout
..  _condition-tree-pagelayout:

tree.pagelayout
---------------

..  versionadded:: 11.0

..  confval:: tree.pagelayout

    :Data type: Integer / String

    Check for the defined :ref:`backend layout <be-layout>` of a page, including
    the inheritance of the field `Backend Layout (subpages of this page)`.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Using backend_layout records
        [tree.pagelayout == 2]
          page.1 = TEXT
          page.1.value = Layout 2
        [END]

        # Using TSconfig provider of backend layouts
        [tree.pagelayout == "pagets__Home"]
          page.1 = TEXT
          page.1.value = Layout Home
        [END]


..  index::
    Conditions; tree.rootLine
..  _condition-tree-rootLine:

tree.rootLine
-------------

..  confval:: tree.rootLine

    :Data type: Array

    Array of arrays with UID and PID.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [tree.rootLine[0]["uid"] == 1]


..  index::
    Conditions; tree.rootLineIds
    Conditions; Pid in rootline
..  _condition-tree-rootLineIds:

tree.rootLineIds
----------------

..  confval:: tree.rootLineIds

    :Data type: Array

    An array with UIDs of the root line.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [2 in tree.rootLineIds]


..  index::
    Conditions; tree.rootLineParentIds
    Conditions; Pid up in rootline
..  _condition-tree-rootLineParentIds:

tree.rootLineParentIds
----------------------

..  versionadded:: 10.3
    This implements the old :typoscript:`PIDupinRootline` condition within the
    Symfony expression language, see
    :doc:`ext_core:Changelog/10.3/Feature-88962-Re-implementOldPIDupinRootlineTypoScriptCondition`

..  confval:: tree.rootLineParentIds

    :Data type: Array

    An array with parent UIDs of the root line.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [2 in tree.rootLineParentIds]


..  index:: Conditions; backend
..  _condition-backend:

backend
=======

..  confval:: backend

    :Data type: Object

    Object with backend information.


..  index:: Conditions; backend.user
..  _condition-backend-user:

backend.user
------------

..  confval:: backend.user

    :Data type: Object

    Object with current backend user information.


..  index::
    Conditions; backend.user.isAdmin
    Conditions; Admin logged in
..  _condition-backend-user-isAdmin:

backend.user.isAdmin
--------------------

..  confval:: backend.user.isAdmin

    :Data type: Boolean

    True, if the current backend user is administrator.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [backend.user.isAdmin]


..  index:: Conditions; backend.user.isLoggedIn
..  _condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
-----------------------

..  confval:: backend.user.isLoggedIn

    :Data type: Boolean

    True, if the current backend user is logged in.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [backend.user.isLoggedIn]


..  index:: Conditions; backend.user.userId
..  _condition-backend-user-userId:

backend.user.userId
-------------------

..  confval:: backend.user.userId

    :Data type: Integer

    UID of the the current backend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [backend.user.userId == 5]


..  index:: Conditions; backend.user.userGroupIds
..  _condition-backend-user-userGroupIds:

backend.user.userGroupIds
-------------------------

..  confval:: backend.user.userGroupIds

    :Data type: Array
    :Context: Frontend, backend

    Array of user group IDs assigned to the current backend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [2 in backend.user.userGroupIds]


.. index:: Conditions; backend.user.userGroupList
.. _condition-backend-user-userGroupList:

backend.user.userGroupList
--------------------------

..  versionadded:: 11.2
    Starting with TYPO3 v11.2 `backend.user.userGroupIds`,
    an array, has been added. Use this instead of `like`
    expressions to test for the user group of the current
    backend user.

..  confval:: backend.user.userGroupList

    :Data type: String

    Comma-separated list of group UIDs.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [like(","~backend.user.userGroupList~",", "*,1,*")]


..  index:: Conditions; frontend
..  _condition-frontend:

frontend
========

..  confval:: frontend

    :Data type: Object

    Object with frontend information.


..  index:: Conditions; frontend.user
..  _condition-frontend-user:

frontend.user
-------------

..  confval:: frontend.user

    :Data type: Object

    Object with current frontend user information.


..  index:: Conditions; frontend.user.isLoggedIn
..  _condition-frontend-user-isLoggedIn:

frontend.user.isLoggedIn
------------------------

..  confval:: frontend.user.isLoggedIn

    :Data type: Boolean

    True, if the current frontend user is logged in.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [frontend.user.isLoggedIn]


.. index:: Conditions; frontend.user.userId
.. _condition-frontend-user-userId:

frontend.user.userId
--------------------

..  confval:: frontend.user.userId

    :Data type: Integer

    The UID of the current frontend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [frontend.user.userId == 5]


..  index:: Conditions; frontend.user.userGroupIds
..  _condition-frontend-user-userGroupIds:

frontend.user.userGroupIds
--------------------------

..  confval:: frontend.user.userGroupIds

    :Data type: Array
    :Context: Frontend

    Array of user group IDs of the current frontend user.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [4 in frontend.user.userGroupIds]


..  index:: Conditions; frontend.user.userGroupList
..  _condition-frontend-user-userGroupList:

frontend.user.userGroupList
---------------------------

..  versionadded:: 11.2
    Starting with TYPO3 v11.2 `frontend.user.userGroupIds`,
    an array has been added. Use this instead of `like`
    expressions to test for the user group of the current
    frontend user.

..  confval:: frontend.user.userGroupList

    :Data type: String

    Comma-separated list of group UIDs.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [like(","~frontend.user.userGroupList~",", "*,1,*")]


.. index:: Conditions; workspace
.. _condition-workspace:

workspace
=========

..  versionadded:: 10.3
    :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`

..  confval:: workspace

    :Data type: Object

    Object with :ref:`workspace <t3coreapi:ext_workspaces>` information.


.. index:: Conditions; workspace.workspaceId
.. _condition-workspace-workspaceId:

workspace.workspaceId
---------------------

..  versionadded:: 10.3
    :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`

..  confval:: workspace.workspaceId

    :Data type: Integer

    UID of the current workspace.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [workspace.workspaceId == 0]


..  index:: Conditions; workspace.isLive
..  _condition-workspace-isLive:

workspace.isLive
----------------

..  versionadded:: 10.3
    :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`


..  confval:: workspace.isLive

    :Data type: Boolean

    True, if the current workspace is the live workspace.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [workspace.isLive]


..  index:: Conditions; workspace.isOffline
..  _condition-workspace-isOffline:

workspace.isOffline
-------------------

..  versionadded:: 10.3
    :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`

..  confval:: workspace.isOffline

    :Data type: Boolean

    True, if the current workspace is offline.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [workspace.isOffline]


.. index:: Conditions; typo3
.. _condition-typo3:

typo3
=====

..  confval:: typo3

    :Data type: Object

    Object with TYPO3-related information.


..  index:: Conditions; typo3.version
..  _condition-typo3-version:

typo3.version
-------------

..  confval:: typo3.version

    :Data type: String

    TYPO3_version (for example, 11.5.33)

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.version == "11.5.33"]


..  index:: Conditions; typo3.branch
..  _condition-typo3-branch:

typo3.branch
------------

..  confval:: typo3.branch

    :Data type: String

    TYPO3 branch (for example, 11.5)

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.branch == "11.5"]


..  index:: Conditions; typo3.devIpMask
..  _condition-typo3-devIpMask:

typo3.devIpMask
---------------

..  confval:: typo3.devIpMask

    :Data type: String

    :ref:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] <t3coreapi:typo3ConfVars_sys_devIPmask>`

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [typo3.devIpMask == "172.18.0.6"]


..  index:: Conditions; date
..  _condition-function-date:

date()
======

..  confval:: date()

    :Parameter: String
    :Data type: String | Integer

    Get the current date in the given format. See the PHP `date function`_
    as a reference for the possible usage.

    ..  _date function: https://www.php.net/manual/en/function.date.php

    Example:

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

..  confval:: like()

    :Parameter: String, String
    :Data type: Boolean

    This function has two parameters: The first parameter is the string to
    search in, the second parameter is the search string.

    Example:

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

..  confval:: traverse()

    :Parameter: Array, String
    :Data type: Mixed

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

..  confval:: compatVersion()

    :Parameter: String
    :Data type: Boolean

    Compares against the current TYPO3 branch.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the current TYPO3 version is 12.4.x
        [compatVersion("12.4")]

        # True, if the current TYPO3 version is 12.4.5
        [compatVersion("12.4.5")]


..  index:: Conditions; getTSFE
..  _condition-function-getTSFE:

getTSFE()
=========

..  confval:: getTSFE()

    :Data type: Object

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

    :Data type: String

    PHP function `getenv <https://www.php.net/manual/en/function.getenv.php>`_.

    Example:

    .. code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [getenv("VIRTUAL_HOST") == "www.example.org"]


..  index:: Conditions; feature
..  _condition-function-feature:

feature()
=========

..  confval:: feature()

    :Data type: String

    Provides access to the current state of
    :ref:`feature toggles <typo3ConfVars_sys_features>`.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # True, if the feature toggle for enforcing the Content Security Policy
        # in the frontend is enabled
        [feature("security.frontend.enforceContentSecurityPolicy") === true]


..  index:: Conditions; ip
..  _condition-function-ip:

ip()
====

..  confval:: ip()

    :Parameter: String
    :Data type: Boolean

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

request
=======

..  confval:: request()

    :Data type: Mixed

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

..  confval:: request.getQueryParams()

    :Data type: Array

    Allows to access GET parameters from current request.

    Assuming the following query within URL:

    ``route=%2Fajax%2Fsystem-information%2Frender&token=5c53e9b715362e7b0c3275848068133b89bbed77&skipSessionUpdate=1``

    the following array would be provided:

    Key: ``route``
        Value: ``/ajax/system-information/render``
    Key: ``token``
        Value: ``5c53e9b715362e7b0c3275848068133b89bbed77``
    Key: ``skipSessionUpdate``
        Value: ``1``

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getQueryParams()['skipSessionUpdate'] == 1]

    Safely check the query parameter array to avoid error logs in case key is not
    defined (see :ref:`condition-function-traverse`). This will check if the GET parameter
    `tx_news_pi1[news]` in the URL is greater than `0`:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]


..  index:: Conditions; request.getParsedBody()
..  _condition-function-request-getParsedBody():

request.getParsedBody()
-----------------------

..  confval:: request.getParsedBody()

    :Data type: Array

    Provide all values contained in the request body, for example, in case of
    submitted form via POST, the submitted values.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getParsedBody()['foo'] == 1]


..  index:: Conditions; request.getHeaders()
..  _condition-function-request-getHeaders():

request.getHeaders()
--------------------

..  confval:: request.getHeaders()

    :Data type: Array

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

    :Data type: Array

    Provides available cookies.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getCookieParams()['foo'] == 1]


..  index:: Conditions; request.getNormalizedParams()
..  _condition-function-request-getNormalizedParams():

request.getNormalizedParams()
-----------------------------

..  confval:: request.getNormalizedParams()

    :Data type: Array

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

    :Data type: Object

    Get the current :php:`\TYPO3\CMS\Core\Routing\PageArguments` object with
    the resolved route parts from enhancers.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [request && request.getPageArguments().get('foo_id') > 0]

    Allows migration from old condition syntax using `[globalVar = GP:singlepartner > 0]`
    to `[request && request.getPageArguments().get('singlepartner') > 0]`.


..  index:: Conditions; loginUser
..  _condition-function-loginUser:

loginUser
=========

..  note::
    This method is deprecated in TYPO3 v12.4. The transition can be done in
    existing TYPO3 v11 projects already. You should use either
    :ref:`frontend.user <condition-frontend-user>` to test for frontend user
    state (available in frontend TypoScript), or
    :ref:`backend.user <condition-backend-user>` (available in frontend
    TypoScript and TSconfig).

..  confval:: loginUser

    :Parameter: String
    :Data type: Boolean

    Value or constraint, wildcard or RegExp possible

    Context dependent, uses backend user within TSconfig, and frontend user
    within TypoScript.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [loginUser('*')]
          # matches any login user
          page.10.value = You are logged in!
        [END]

        [loginUser(1)]
          page.10.value = Your frontend user has the uid 1
        [END]

        [loginUser('1,3,5')]
          page.10.value = Your frontend user has the uid 1, 3 or 5
        [END]

        [loginUser('*') == false]
          page.10.value = You are logged out!
        [END]


..  index:: Conditions; usergroup
..  _condition-function-usergroup:

usergroup
=========

..  note::
    This method is deprecated in TYPO3 v12.4. The transition can be done in
    existing TYPO3 v11 projects already. You should use either
    :ref:`frontend.user <condition-frontend-user>` to test for frontend user
    state (available in frontend TypoScript), or
    :ref:`backend.user <condition-backend-user>` (available in frontend
    TypoScript and TSconfig).

..  confval:: usergroup

    :Parameter: String
    :Data type: Boolean

    Value or constraint, wildcard or RegExp possible.

    Allows to check whether current user (FE or BE) is part of the expected
    usergroup.

    Example:


    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        # Any usergroup
        [usergroup("*")]
          page.10.value = You are logged in and belong to some usergroup.
        [END]

        [usergroup("12")]
          page.10.value = You are in the usergroup with uid 12.
        [END]

        [usergroup("12,15,18")]
          page.10.value = You are in the usergroup with uid 12, 15 or 18.
        [END]


.. index:: Conditions; session
.. _condition-functions-in-frontend-context-function-session:

session()
=========

..  confval:: session()

    :Parameter: String
    :Data type: Mixed

    Allows to access values of the current session. Available values depend on
    values written to the session, for example, by extensions. Use
    :typoscript:`|` to dig deeper into the structure for stored values.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [session("foo|bar") == 1234567]


..  index:: Conditions; site
..  _condition-functions-in-frontend-context-function-site:

site()
======

..  confval:: site()

    :Parameter: String
    :Data type: Mixed

    Get a value from the :ref:`site configuration <t3coreapi:sitehandling>`, or
    null, if no site was found or the property does not exists.

    Available Information:

    :typoscript:`site("identifier")`
        Returns the identifier of current site as string.

    :typoscript:`site("base")`
        Returns the base of current site as string.

    :typoscript:`site("rootPageId")`
        Returns the root page uid of current site as integer.

    :typoscript:`site("languages")`
        Returns array of available languages for current site.
        For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    :typoscript:`site("allLanguages")`
        Returns an array of available and unavailable languages for the current
        site. For deeper information, see
        :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    :typoscript:`site("defaultLanguage")`
        Returns the default language for current site.
        For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    :typoscript:`site("configuration")`
        Returns an array with all available configuration for current site.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [site("identifier") == "typo395"]

    Matches if site base host:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [site("base").getHost() == "www.example.org"]

    Base path:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [site("base").getPath() == "/"]

    Rootpage uid:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [site("rootPageId") == 1]

    Configuration property:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [traverse(site("configuration"), "myCustomProperty") == true]

..  warning::
    It might seem straight-forward to use :typoscript:`site("configuration")["myCustomProperty"]` to access
    configuration properties. However, if the property has not been set, this will trigger a runtime
    exception, and your log will fill up quickly. Using :ref:`condition-function-traverse` will silence the error messages.

..  index:: Conditions; siteLanguage
..  _condition-functions-in-frontend-context-function-siteLanguage:

siteLanguage()
==============

..  confval:: siteLanguage()

    :Parameter: String
    :Data type: Mixed

    Get a value from the
    :ref:`site language configuration <t3coreapi:sitehandling-addingLanguages>`,
    or null if no site was found or property not exists.

    Available information:

    *   ``siteLanguage("languageId")``

    *   ``siteLanguage("locale")``

    *   ``siteLanguage("base")``

    *   ``siteLanguage("title")``

    *   ``siteLanguage("navigationTitle")``

    *   ``siteLanguage("flagIdentifier")``

    *   ``siteLanguage("typo3Language")`` : default or 2 letter language code

    *   ``siteLanguage("twoLetterIsoCode")`` : 2 letter language code

    *   ``siteLanguage("hreflang")``

    *   ``siteLanguage("direction")``

    *   ``siteLanguage("fallbackType")``

    *   ``siteLanguage("fallbackLanguageIds")``

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        [siteLanguage("locale") == "de_CH"]
          page.10.value = This site has the locale "de_CH"
        [END]

        [siteLanguage("title") == "Italy"]
          page.10.value = This site has the title "Italy"
        [END]
