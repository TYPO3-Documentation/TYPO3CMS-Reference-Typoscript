.. include:: /Includes.rst.txt
.. index::
   Conditions
   Conditions; Variables
   Conditions; Constant
   Conditions; Functions
   Conditions; Functions frontend
.. _conditions:
.. _condition-reference:
.. _condition-variables:
.. _condition-constant:
.. _condition-functions-in-all-contexts:
.. _condition-functions-in-frontend-context:


==========
Conditions
==========

Frontend TypoScript conditions offer a way to conditionally change TypoScript based
on current context. See the :ref:`TypoScript syntax condition chapter <t3coreapi:typoscript-syntax-conditions>`
for the basic syntax of conditions. Do not confuse conditions with the :ref:`"if" function <if>`,
which is a stdWrap property to act on current data.

The symfony expression language tends to throw warnings when sub arrays are
checked in a condition that do not exist. Use the :ref:`traverse <condition-function-traverse>`
function to avoid this.

.. contents::
   :local:
   :depth: 2


.. index:: Conditions; applicationContext
.. _condition-applicationContext:

applicationContext
==================

:aspect:`Variable`
   applicationContext

:aspect:`Type`
   String

:aspect:`Description`
   Current application context as string. See :ref:`t3coreapi:bootstrapping-context`.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [applicationContext == "Development"]

      # Any context that is "Production" or starts with "Production" (eg Production/Staging").
      [applicationContext matches "/^Production/"]


.. index:: Conditions; page
.. _condition-page:

page
====

:aspect:`Variable`
   page

:aspect:`Type`
   Array

:aspect:`Description`
   All data of the current page record as array.

:aspect:`Example`
   .. code-block:: typoscript
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


.. index:: Conditions; tree
.. _condition-tree:

tree
====

:aspect:`Variable`
   tree

:aspect:`Type`
   Object

:aspect:`Description`
   Object with tree information.


.. index::
   Conditions; tree.level
   Conditions; Page level

.. _condition-tree-level:

tree.level
----------

:aspect:`Variable`
   tree.level

:aspect:`Type`
   Integer

:aspect:`Description`
   Current tree level.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Check if page is on level 0:
      [tree.level == 0]


.. index:: Conditions; tree.pagelayout
.. _condition-tree-pagelayout:

tree.pagelayout
---------------

:aspect:`Variable`
   tree.pagelayout

:aspect:`Type`
   Integer / String

:aspect:`Description`
   Check for the defined backend layout of a page including the inheritance of
   the field `Backend Layout (subpages of this page)`.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Using backend_layout records
      [tree.pagelayout == 2]

      # Using TSconfig provider of backend layouts
      [tree.pagelayout == "pagets__Home"]


.. index::
   Conditions; tree.rootLine
.. _condition-tree-rootLine:

tree.rootLine
-------------

:aspect:`Variable`
   tree.rootLine

:aspect:`Type`
   Array

:aspect:`Description`
   Array of arrays with uid and pid.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [tree.rootLine[0]["uid"] == 1]


.. index::
   Conditions; tree.rootLineIds
   Conditions; Pid in rootline
.. _condition-tree-rootLineIds:

tree.rootLineIds
----------------

:aspect:`Variable`
   tree.rootLineIds

:aspect:`Type`
   Array

:aspect:`Description`
   An array with UIDs of the rootline.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Check if page with uid 2 is inside the root line
      [2 in tree.rootLineIds]


.. index::
   Conditions; tree.rootLineParentIds
   Conditions; Pid up in rootline
.. _condition-tree-rootLineParentIds:

tree.rootLineParentIds
----------------------

:aspect:`Variable`
   tree.rootLineParentIds

:aspect:`Type`
   Array

:aspect:`Description`
   An array with parent UIDs of the root line.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Check if page with uid 2 is the parent of a page inside the root line
      [2 in tree.rootLineParentIds]


.. index:: Conditions; backend
.. _condition-backend:

backend
=======

:aspect:`Variable`
   backend

:aspect:`Type`
   Object

:aspect:`Description`
   Object with backend information.


.. index:: Conditions; backend.user
.. _condition-backend-user:

backend.user
------------

:aspect:`Variable`
   backend.user

:aspect:`Type`
   Object

:aspect:`Description`
   Object with current backend user information.


.. index::
   Conditions; backend.user.isAdmin
   Conditions; Admin logged in
.. _condition-backend-user-isAdmin:

backend.user.isAdmin
--------------------

:aspect:`Variable`
   backend.user.isAdmin

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current user is admin.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Evaluates to true if current BE-User is administrator
      [backend.user.isAdmin]


.. index:: Conditions; backend.user.isLoggedIn
.. _condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
-----------------------

:aspect:`Variable`
   backend.user.isLoggedIn

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current user is logged in.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Evaluates to true if an BE-User is logged in
      [backend.user.isLoggedIn]


.. index:: Conditions; backend.user.userId
.. _condition-backend-user-userId:

backend.user.userId
-------------------

:aspect:`Variable`
   backend.user.userId

:aspect:`Type`
   Integer

:aspect:`Description`
   UID of current user.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Evaluates to true if user uid of current logged in BE-User is equal to 5
      [backend.user.userId == 5]


.. index:: Conditions; backend.user.userGroupIds
.. _condition-backend-user-userGroupIds:

backend.user.userGroupIds
-------------------------

:aspect:`Variable`
   backend.user.userGroupList

:aspect:`Type`
   array

:aspect:`Description`
   Array of user group ids of the current backend user.

:aspect:`Context`
   Frontend, Backend

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [2 in backend.user.userGroupIds]


.. index:: Conditions; backend.user.userGroupList
.. _condition-backend-user-userGroupList:

backend.user.userGroupList
--------------------------

:aspect:`Variable`
   backend.user.userGroupList

:aspect:`Type`
   String

:aspect:`Description`
   Comma list of group UIDs

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [like(","~backend.user.userGroupList~",", "*,1,*")]


.. index:: Conditions; frontend
.. _condition-frontend:

frontend
========

:aspect:`Variable`
   frontend

:aspect:`Type`
   Object

:aspect:`Description`
   Object with frontend information.


.. index:: Conditions; frontend.user
.. _condition-frontend-user:

frontend.user
-------------

:aspect:`Variable`
   frontend.user

:aspect:`Type`
   Object

:aspect:`Description`
   Object with current frontend user information.


.. index:: Conditions; frontend.user.isLoggedIn
.. _condition-frontend-user-isLoggedIn:

frontend.user.isLoggedIn
------------------------

:aspect:`Variable`
   frontend.user.isLoggedIn

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current user is logged in.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [frontend.user.isLoggedIn]


.. index:: Conditions; frontend.user.userId
.. _condition-frontend-user-userId:

frontend.user.userId
--------------------

:aspect:`Variable`
   .user.userId

:aspect:`Type`
   Integer

:aspect:`Description`
   UID of current user.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [frontend.user.userId == 5]

.. index:: Conditions; frontend.user.userGroupIds
.. _condition-frontend-user-userGroupIds:

frontend.user.userGroupIds
--------------------------

:aspect:`Variable`
   frontend.user.userGroupList

:aspect:`Type`
   array

:aspect:`Description`
   Array of user group ids of the current frontend user.

:aspect:`Context`
   Frontend

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [4 in frontend.user.userGroupIds]

.. index:: Conditions; frontend.user.userGroupList
.. _condition-frontend-user-userGroupList:

frontend.user.userGroupList
---------------------------

:aspect:`Variable`
   frontend.user.userGroupList

:aspect:`Type`
   String

:aspect:`Description`
   Comma list of group UIDs.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [like(","~frontend.user.userGroupList~",", "*,1,*")]


.. index:: Conditions; workspace
.. _condition-workspace:

workspace
=========

:aspect:`Variable`
   workspace

:aspect:`Type`
   Object

:aspect:`Description`
   object with workspace information


.. index:: Conditions; workspace.workspaceId
.. _condition-workspace-workspaceId:

workspace.workspaceId
---------------------

:aspect:`Variable`
   .workspaceId

:aspect:`Type`
   Integer

:aspect:`Description`
   UID of current workspace.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [workspace.workspaceId == 0]


.. index:: Conditions; workspace.isLive
.. _condition-workspace-isLive:

workspace.isLive
----------------

:aspect:`Variable`
   workspace.isLive

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current workspace is live.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [workspace.isLive]


.. index:: Conditions; workspace.isOffline
.. _condition-workspace-isOffline:

workspace.isOffline
-------------------

:aspect:`Variable`
   workspace.isOffline

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current workspace is offline

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [workspace.isOffline]


.. index:: Conditions; typo3
.. _condition-typo3:

typo3
=====

:aspect:`Variable`
   typo3

:aspect:`Type`
   Object

:aspect:`Description`
   Object with TYPO3 related information


.. index:: Conditions; typo3.version
.. _condition-typo3-version:

typo3.version
-------------

:aspect:`Variable`
   typo3.version

:aspect:`Type`
   String

:aspect:`Description`
   TYPO3_version (e.g. 9.4.0-dev)

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [typo3.version == "9.5.5"]


.. index:: Conditions; typo3.branch
.. _condition-typo3-branch:

typo3.branch
------------

:aspect:`Variable`
   typo3.branch

:aspect:`Type`
   String

:aspect:`Description`
   TYPO3_branch (e.g. 9.4)

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [typo3.branch == "11.5"]


.. index:: Conditions; typo3.devIpMask
.. _condition-typo3-devIpMask:

typo3.devIpMask
---------------

:aspect:`Variable`
   typo3.devIpMask

:aspect:`Type`
   String

:aspect:`Description`
   :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask']`

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [typo3.devIpMask == "172.18.0.6"]


.. index:: Conditions; date
.. _condition-function-date:

date()
======

:aspect:`Function`
   date()

:aspect:`Parameter`
   String

:aspect:`Type`
   String / Integer

:aspect:`Description`
   Get current date in given format. See PHP `date <https://www.php.net/manual/en/function.date.php>`_
   function as reference for possible usage.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # True if day of current month is 7
      [date("j") == 7]

      # True if day of current week is 7
      [date("w") == 7]

      # True if day of current year is 7
      [date("z") == 7]

      # True if current hour is 7
      [date("G") == 7]

.. index:: Conditions; like
.. _condition-function-like:

like()
======

:aspect:`Function`
   like()

:aspect:`Parameter`
   String, String

:aspect:`Type`
   Boolean

:aspect:`Description`
   This function has two parameters: The first parameter is the string to search in,
   the second parameter is the search string.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Search a string with * within another string
      [like("fooBarBaz", "*Bar*")]

      # Search string with single characters in between, using ?
      [like("fooBarBaz", "f?oBa?Baz")]

      # Search string using regular expression
      [like("fooBarBaz", "/f[o]{2,2}[aBrz]+/")]


.. index:: Conditions; traverse
.. _condition-function-traverse:

traverse()
==========

:aspect:`Function`
   traverse()

:aspect:`Parameter`
   Array, String

:aspect:`Type`
   Custom

:aspect:`Description`
   This function gets a value from an array with arbitrary depth and suppresses
   PHP warning when sub arrays do not exist. It has two parameters: The first parameter
   is the array to traverse, the second parameter is the path to traverse.

   In case the path is not found in the array, an empty string is returned.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Traverse query parameters of current request along tx_news_pi1[news]
      [traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]


.. index:: Conditions; compatVersion
.. _condition-function-compatVersion:

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
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # True if current version is 11.5.x
      [compatVersion("11.5")]
      [compatVersion("11.5.0")]
      [compatVersion("11.5.1")]


.. index:: Conditions; loginUser
.. _condition-function-loginUser:

loginUser()
===========

:aspect:`Function`
   loginUser()

:aspect:`Parameter`
   String

:aspect:`Type`
   Boolean

:aspect:`Description`
   Value or constraint, wildcard or RegExp.

   .. versionchanged:: 12.4
      Function loginUser() has been marked as deprecated with TYPO v12
      and should not be used anymore. Use variable :typoscript:`frontend.user`
      and :typoscript:`backend.user` instead. See
      :doc:`ext_core:Changelog/12.4/Deprecation-100349-TypoScriptLoginUserAndUsergroupConditions.rst`
      for more details.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # True if a user is logged in
      [loginUser('*')]

      # True if logged in user uid is 1
      [loginUser(1)]

      # True if logged in user uid is 1 or 3 or 5
      [loginUser('1,3,5')]

      # True if user is not logged in
      [loginUser('*') == false]


.. index:: Conditions; getTSFE
.. _condition-function-getTSFE:

getTSFE()
=========

:aspect:`Function`
   getTSFE()

:aspect:`Parameter`
   Object

:aspect:`Description`
   Provides access to TypoScriptFrontendController :php:`$GLOBALS['TSFE']`. This
   function can directly access methods of TypoScriptFrontendController. This class
   is target of a mid-term refactoring. It should be used with care since it will
   eventually vanish in the future.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # True if current typenum is 98
      [getTSFE().type == 98]

      # True if current page uid is 17. Use the page variable instead
      [getTSFE().id == 17]


.. index:: Conditions; getenv
.. _condition-function-getenv:

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


.. index:: Conditions; feature
.. _condition-function-feature:

feature()
=========

:aspect:`Function`
   feature()

:aspect:`Parameter`
   String

:aspect:`Description`
   Provides access to feature toggles current state.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # True if feature toggle for strict TypoScript syntax is enabled:
      [feature("TypoScript.strictSyntax") === false]


.. index:: Conditions; usergroup
.. _condition-function-usergroup:

usergroup()
===========

:aspect:`Function`
   usergroup()

:aspect:`Parameter`
   String

:aspect:`Value`
   Boolean

:aspect:`Description`
   Value or constraint, wildcard or RegExp. Allows to check whether current user
   is member of the expected usergroup.

   .. versionchanged:: 12.4
      Function loginUser() has been marked as deprecated with TYPO v12
      and should not be used anymore. Use variable :typoscript:`frontend.user`
      and :typoscript:`backend.user` instead. See
      :doc:`ext_core:Changelog/12.4/Deprecation-100349-TypoScriptLoginUserAndUsergroupConditions.rst`
      for more details.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # True if a logged in user is member of some group
      [usergroup("*")]

      # True if a logged in user is member of group 12
      [usergroup("12")]

      # True if a logged in user is member of group 12 or 15 or 18
      [usergroup("12,15,18")]


.. index:: Conditions; ip
.. _condition-function-ip:

ip()
====

:aspect:`Function`
   ip()

:aspect:`Parameter`
   String

:aspect:`Type`
   Boolean

:aspect:`Description`
   Value or Constraint, Wildcard or RegExp possible special value: devIP (match the devIPMask).

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [ip("172.18.*")]
         page.10.value = Your IP matches "172.18.*"
      [END]

      [ip("devIP")]
         page.10.value = Your IP matches the configured devIp
      [END]


.. index:: Conditions; request
.. _condition-function-request:

request()
=========

:aspect:`Function`
   request()

:aspect:`Parameter`
   Custom

:aspect:`Description`
   Allows to fetch information from current request.


.. index:: Conditions; request.getQueryParams()
.. _condition-function-request-getQueryParams():

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

   the following array would be provided:

   Key: ``route``
      Value: ``/ajax/system-information/render``
   Key: ``token``
      Value: ``5c53e9b715362e7b0c3275848068133b89bbed77``
   Key: ``skipSessionUpdate``
      Value: ``1``

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Safely check the query parameter array to avoid error logs in case key is not
      # defined. This will check if the GET parameter
      # tx_news_pi1[news] in the URL is greater than 0:
      [traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]


.. index:: Conditions; request.getParsedBody()
.. _condition-function-request-getParsedBody():

request.getParsedBody()
-----------------------

:aspect:`Function`
   request.getParsedBody()

:aspect:`Parameter`
   Custom

:aspect:`Type`
   Array

:aspect:`Description`
   Provides all values contained in the request body, e.g. in case of submitted
   form via POST, the submitted values.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getParsedBody()['foo'] == 1]


.. index:: Conditions; request.getHeaders()
.. _condition-function-request-getHeaders():

request.getHeaders()
--------------------

:aspect:`Function`
   request.getHeaders()

:aspect:`Parameter`
   Custom

:aspect:`Type`
   Array

:aspect:`Description`
   Provides all values from request headers.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getHeaders()['Accept'] == 'json']
         page.10.value = Accepts json
      [END]

      [request.getHeaders()['host'][0] == 'www.example.org']
         page.20.value = The host is www.example.org
      [END]


.. index:: Conditions; request.getCookieParams()
.. _condition-function-request-getCookieParams():

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
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getCookieParams()['foo'] == 1]


.. index:: Conditions; request.getNormalizedParams()
.. _condition-function-request-getNormalizedParams():

request.getNormalizedParams()
-----------------------------

:aspect:`Function`
   request.getNormalizedParams()

:aspect:`Parameter`
   Custom

:aspect:`Type`
   Array

:aspect:`Description`
   Provides access to NormalizedParams object which contains a bunch of methods:
      ``getHttpHost()``
          Example: ``www.example.org``

      ``isHttps()``
         Returns boolean whether SSL was used.

      ``getRequestHost()``
          Example: ``www.example.org``

      ``getRequestHostOnly()``
          Example: ``www.example.org``

      ``getRequestPort()``
          Returns the port, mostly ``80`` or ``443``, but can be whatever is
          configured.

      ``getScriptName()``
          Example: :samp:`/typo3/index.php`

      ``getRequestUri()``
          Example: :samp:`/typo3/index.php?route=%2Fajax%2Fsystem-information%2Frender`

      ``getRequestUrl()``
          Example: :samp:`https://example.org/typo3/index.php?route=%2Fajax%2Fsystem-information%2Frender`

      ``getRequestScript()``
          Example: :samp:`https://example.org/typo3/index.php`

      ``getRequestDir()``
          Example: :samp:`https://example.org/typo3/`

      ``isBehindReverseProxy()``
          Returns boolean.

      ``getRemoteAddress()``
          IP Adress of client, in case of docker this could be ``172.18.0.6``.

      ``getScriptFileName()``
          Example: ``/var/www/html/public/typo3/index.php``

      ``getDocumentRoot()``
          Example: ``/var/www/html/public``

      ``getSiteUrl()``
          Example: ``example.org``

      ``getSitePath()``
          Example: ``/``

      ``getSiteScript()``
          Example:
          ``typo3/index.php?route=%2Fajax%2Fsystem-information%2Frender``

      ``getPathInfo()``
          Ist bei mir leer gewesen

      ``getHttpReferer()``
          If enabled, delivers the prior visited url, e.g. :samp:`example.org/typo3/index.php`

      ``getHttpUserAgent()``
          Example: ``Mozilla/5.0 (X11; Linux x86_64) Chrome/73.0.3683.86 Safari/537.36``

      ``getHttpAcceptEncoding()``
          Example: ``gzip, deflate``

      ``getHttpAcceptLanguage()``
          Example: ``de-DE,de;q=0.9``

      ``getRemoteHost()``
          Name of client pc.

      ``getQueryString()``
          Example: ``route=%2Fajax%2Fsystem-information%2Frender``

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getNormalizedParams().isHttps()]
         page.10.value = HTTPS is being used
      [END]

      [request.getNormalizedParams().getHttpHost() == "example.org"]
         page.10.value = The host is "example.org"
      [END]



.. index:: Conditions; request.getPageArguments()
.. _condition-function-request-getPageArguments():

request.getPageArguments()
--------------------------

:aspect:`Function`
   request.getPageArguments()

:aspect:`Parameter`
   None

:aspect:`Type`
   Array

:aspect:`Description`
   Get current `PageArguments` object with resolved route parts from enhancers.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getPageArguments().get('foo_id') > 0]


.. index:: Conditions; session
.. _condition-functions-in-frontend-context-function-session:

session()
=========

:aspect:`Function`
   session()

:aspect:`Parameter`
   String

:aspect:`Value`
   Mixed

:aspect:`Description`
   Allows to access values of the current session. Available values depend on values
   written to the session, e.g. by extensions. Use :typoscript:``|`` to dig deeper
   into the structure for stored values.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Match if session has value 1234567 in structure :php:`$foo['bar']`:
      [session("foo|bar") == 1234567]


.. index:: Conditions; site
.. _condition-functions-in-frontend-context-function-site:

site()
======

:aspect:`Function`
   site

:aspect:`Parameter`
  String

:aspect:`Description`
   Get value from site configuration, or null if no site was found or property
   does not exists. Available Information:

   site("identifier")
      Returns the identifier of current site as string.

   site("base")
      Returns the base of current site as string.

   site("rootPageId")
      Returns the root page uid of current site as integer.

   site("languages")
      Returns array of available languages for current site.
      For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

   site("allLanguages")
      Returns array of available and unavailable languages for current site.
      For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

   site("defaultLanguage")
      Returns the default language for current site.
      For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

   site("configuration")
      Returns an array with all available configuration for current site.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Site identifier
      [site("identifier") == "typo395"]

      # Match site base host
      [site("base").getHost() == "www.example.org"]

      # Match base path
      [site("base").getPath() == "/"]

      # Match root page uid
      [site("rootPageId") == 1]

      # Match a configuration property
      [traverse(site("configuration"), "myCustomProperty") == true]


.. index:: Conditions; siteLanguage
.. _condition-functions-in-frontend-context-function-siteLanguage:

siteLanguage()
==============

:aspect:`Function`
   siteLanguage()

:aspect:`Parameter`
   String

:aspect:`Value`
   Mixed

:aspect:`Description`
   Get value from siteLanguage configuration, or null if no site was found or
   property not exists.

   Available information:

   * ``siteLanguage("languageId")``

   * ``siteLanguage("locale")``

   * ``siteLanguage("base")``

   * ``siteLanguage("title")``

   * ``siteLanguage("navigationTitle")``

   * ``siteLanguage("flagIdentifier")``

   * ``siteLanguage("typo3Language")`` : default or 2 letter language code

   * ``siteLanguage("twoLetterIsoCode")`` : 2 letter language code

   * ``siteLanguage("hreflang")``

   * ``siteLanguage("direction")``

   * ``siteLanguage("fallbackType")``

   * ``siteLanguage("fallbackLanguageIds")``

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [siteLanguage("locale") == "de_CH"]
         page.10.value = This site has the locale "de_CH"
      [END]

      [siteLanguage("title") == "Italy"]
         page.10.value = This site has the title "Italy"
      [END]
