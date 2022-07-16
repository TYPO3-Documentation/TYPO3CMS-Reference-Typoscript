.. include:: /Includes.rst.txt
.. index:: Conditions
.. _conditions:

==========
Conditions
==========

.. seealso::

   * For full explanations about conditions, especially about condition syntax, please refer to
     :ref:`the TypoScript Syntax chapter of the Core API <t3coreapi:typoscript-syntax-conditions>`.
     The "new" condition syntax (since TYPO3 9.4) is based on the
     `symfony expression language <https://symfony.com/doc/4.1/components/expression_language.html>`__
   * TypoScript also offers the :ref:`"if" function <if>` to create conditions.

.. contents::
   :local:
   :depth: 3

.. _condition-reference:

Reference
=========

.. index:: Conditions; Variables
.. _condition-variables:

Variables
---------

The following variables are available. The values are context related.

.. index:: Conditions; applicationContext
.. _condition-applicationContext:

applicationContext
~~~~~~~~~~~~~~~~~~

:aspect:`Variable`
   applicationContext

:aspect:`Type`
   String

:aspect:`Description`
   Current application context as string.

   See :ref:`t3coreapi:bootstrapping-context`.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [applicationContext == "Development"]

   Any context that is "Production" or starts with "Production" (eg Production/Staging").

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [applicationContext matches "/^Production/"]


.. index:: Conditions; page
.. _condition-page:

page
~~~~

.. note::
   :typoscript:`page` is only available in the frontend context. As the TypoScript setup may be
   loaded in some backend modules or the CLI context, it is considered best practice to always
   guard the property by using the function :ref:`traverse() <condition-function-traverse>`

:aspect:`Variable`
   page

:aspect:`Type`
   Array

:aspect:`Description`
   All data of the current page record as array. To find out which fields are available, you can
   enable the debug mode in the TYPO3 backend which will display the field names.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Check single page uid
      [traverse(page, "uid") == 2]
      # Check list of page uids
      traverse(page, "uid") in [17,24]]
      # Check list of page uids NOT in
      [traverse(page, "uid") not in [17,24]]
      # Check range of pages (example: page uid from 10 to 20)
      [traverse(page, "uid") in 10..20]

      # Check the page backend layout
      [traverse(page, "backend_layout") == 5]
      [traverse(page, "backend_layout") == "example_layout"]

      # Check the page title
      [traverse(page, "title") == "foo"]

.. index:: Conditions; Constant
.. _condition-constant:

Constant
~~~~~~~~

:aspect:`Variable`
   {$foo.bar}

:aspect:`Type`
   Constant

:aspect:`Description`
   Any TypoScript constant is available like before.
   Depending on the type of the constant you have to use
   different conditions.

:aspect:`Example`
   If constant is an integer:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [{$foo.bar} == 4711]

   If constant is a string put constant in quotes:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      ["{$foo.bar}" == "4711"]


.. index:: Conditions; tree
.. _condition-tree:

tree
~~~~

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
""""""""""

:aspect:`Variable`
   tree.level

:aspect:`Type`
   Integer

:aspect:`Description`
   Current tree level.

:aspect:`Example`
   Check whether page is on level 0:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [tree.level == 0]



.. index:: Conditions; tree.pagelayout
.. _condition-tree-pagelayout:

tree.pagelayout
"""""""""""""""

.. versionadded:: 11.0

:aspect:`Variable`
   tree.pagelayout

:aspect:`Type`
   Integer / String

:aspect:`Description`
   Check for the defined backend layout of a page including the inheritance of
   the field `Backend Layout (subpages of this page)`. The condition is enabled
   for frontend and backend.

:aspect:`Example`
   .. code-block:: typoscript
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


.. index::
   Conditions; tree.rootLine
.. _condition-tree-rootLine:

tree.rootLine
"""""""""""""

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
""""""""""""""""

:aspect:`Variable`
   tree.rootLineIds

:aspect:`Type`
   Array

:aspect:`Description`
   An array with UIDs of the rootline.

:aspect:`Example`
   Check whether page with uid 2 is inside the root line:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [2 in tree.rootLineIds]


.. index::
   Conditions; tree.rootLineParentIds
   Conditions; Pid up in rootline
.. _condition-tree-rootLineParentIds:

tree.rootLineParentIds
""""""""""""""""""""""

.. versionadded:: 10.3

   This implements the old :typoscript:`PIDupinRootline` condition within the Symfony
   expression language, see
   :doc:`ext_core:Changelog/10.3/Feature-88962-Re-implementOldPIDupinRootlineTypoScriptCondition`

:aspect:`Variable`
   tree.rootLineParentIds

:aspect:`Type`
   Array

:aspect:`Description`
   An array with parent UIDs of the root line.

:aspect:`Example`
   Check whether page with uid 2 is the parent of a page inside the root line:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [2 in tree.rootLineParentIds]


.. index:: Conditions; backend
.. _condition-backend:

backend
~~~~~~~

:aspect:`Variable`
   backend

:aspect:`Type`
   Object

:aspect:`Description`
   Object with backend information.


.. index:: Conditions; backend.user
.. _condition-backend-user:

backend.user
""""""""""""

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
""""""""""""""""""""

:aspect:`Variable`
   backend.user.isAdmin

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current user is admin

:aspect:`Example`
   Evaluates to true if current BE-User is administrator:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [backend.user.isAdmin]


.. index:: Conditions; backend.user.isLoggedIn
.. _condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
"""""""""""""""""""""""

:aspect:`Variable`
   backend.user.isLoggedIn

:aspect:`Type`
   Boolean

:aspect:`Description`
   true if current user is logged in

:aspect:`Example`
   Evaluates to true if an BE-User is logged in:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [backend.user.isLoggedIn]


.. index:: Conditions; backend.user.userId
.. _condition-backend-user-userId:

backend.user.userId
"""""""""""""""""""

:aspect:`Variable`
   backend.user.userId

:aspect:`Type`
   Integer

:aspect:`Description`
   UID of current user

:aspect:`Example`
   Evaluates to true if user uid of current logged in BE-User is equal to 5:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [backend.user.userId == 5]


.. index:: Conditions; backend.user.userGroupIds
.. _condition-backend-user-userGroupIds:

backend.user.userGroupIds
""""""""""""""""""""""""""

:aspect:`Variable`
   backend.user.userGroupList

:aspect:`Type`
   array

:aspect:`Description`
   Array of user group ids of the current backend user

:aspect:`Context`
   Frontend, Backend

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [2 in backend.user.userGroupIds]


.. index:: Conditions; backend.user.userGroupList
.. _condition-backend-user-userGroupList:

backend.user.userGroupList
""""""""""""""""""""""""""

.. versionadded:: 11.2
   Starting with TYPO3 11.2 `backend.user.userGroupIds`,
   an array has been added. Use this instead of `like`
   expressions to test for the user group of the current
   backend user.

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
~~~~~~~~

:aspect:`Variable`
   frontend

:aspect:`Type`
   Object

:aspect:`Description`
   object with frontend information (available in FE only)


.. index:: Conditions; frontend.user
.. _condition-frontend-user:

frontend.user
"""""""""""""

:aspect:`Variable`
   frontend.user

:aspect:`Type`
   Object

:aspect:`Description`
   Object with current frontend user information.


.. index:: Conditions; frontend.user.isLoggedIn
.. _condition-frontend-user-isLoggedIn:

frontend.user.isLoggedIn
""""""""""""""""""""""""

:aspect:`Variable`
   frontend.user.isLoggedIn

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current user is logged in

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [frontend.user.isLoggedIn]


.. index:: Conditions; frontend.user.userId
.. _condition-frontend-user-userId:

frontend.user.userId
""""""""""""""""""""

:aspect:`Variable`
   .user.userId

:aspect:`Type`
   Integer

:aspect:`Description`
   UID of current user

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [frontend.user.userId == 5]

.. index:: Conditions; frontend.user.userGroupIds
.. _condition-frontend-user-userGroupIds:

frontend.user.userGroupIds
""""""""""""""""""""""""""

:aspect:`Variable`
   frontend.user.userGroupList

:aspect:`Type`
   array

:aspect:`Description`
   Array of user group ids of the current frontend user

:aspect:`Context`
   Frontend

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [4 in frontend.user.userGroupIds]

.. index:: Conditions; frontend.user.userGroupList
.. _condition-frontend-user-userGroupList:

frontend.user.userGroupList
"""""""""""""""""""""""""""

.. versionadded:: 11.2
   Starting with TYPO3 11.2 `frontend.user.userGroupIds`,
   an array has been added. Use this instead of `like`
   expressions to test for the user group of the current
   frontend user.

:aspect:`Variable`
   frontend.user.userGroupList

:aspect:`Type`
   String

:aspect:`Description`
   Comma list of group UIDs

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [like(","~frontend.user.userGroupList~",", "*,1,*")]


.. index:: Conditions; workspace
.. _condition-workspace:

workspace
~~~~~~~~~

.. versionadded:: 10.3
   :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`

:aspect:`Variable`
   workspace

:aspect:`Type`
   Object

:aspect:`Description`
   object with workspace information


.. index:: Conditions; workspace.workspaceId
.. _condition-workspace-workspaceId:

workspace.workspaceId
"""""""""""""""""""""

.. versionadded:: 10.3
   :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`


:aspect:`Variable`
   .workspaceId

:aspect:`Type`
   Integer

:aspect:`Description`
   id of current workspace

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [workspace.workspaceId == 0]


.. index:: Conditions; workspace.isLive
.. _condition-workspace-isLive:

workspace.isLive
""""""""""""""""

.. versionadded:: 10.3
   :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`


:aspect:`Variable`
   workspace.isLive

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current workspace is live

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [workspace.isLive]


.. index:: Conditions; workspace.isOffline
.. _condition-workspace-isOffline:

workspace.isOffline
"""""""""""""""""""

.. versionadded:: 10.3
   :doc:`ext_core:Changelog/10.3/Feature-90203-MakeWorkspaceAvailableInTypoScriptConditions`


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
~~~~~

:aspect:`Variable`
   typo3

:aspect:`Type`
   Object

:aspect:`Description`
   object with TYPO3 related information


.. index:: Conditions; typo3.version
.. _condition-typo3-version:

typo3.version
"""""""""""""

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
""""""""""""

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
"""""""""""""""

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


.. index:: Conditions; Functions
.. _condition-functions-in-all-contexts:

Functions in all contexts
-------------------------

Functions take over the logic of the old conditions which do more than a simple comparison check.
The following functions are available in **any** context:


.. index:: Conditions; request
.. _condition-function-request:

request
~~~~~~~

:aspect:`Function`
   request

:aspect:`Parameter`
   Custom

:aspect:`Description`
   Allows to fetch information from current request.


.. index:: Conditions; request.getQueryParams()
.. _condition-function-request-getQueryParams():

request.getQueryParams()
""""""""""""""""""""""""

:aspect:`Function`
   request.getQueryParams()

:aspect:`Parameter`
   Custom

:aspect:`Type`
   Array

:aspect:`Description`
   Allows to access all available GET-Parameters from current request.

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
   Check if query parameter skipSessionUpdate equals 1:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getQueryParams()['skipSessionUpdate'] == 1]

   Safely check query parameter array to avoid error logs in case key is not
   defined (see :ref:`condition-function-traverse`). This will check if
   `tx_news_pi1['news'] > 0`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]


.. index:: Conditions; request.getParsedBody()
.. _condition-function-request-getParsedBody():

request.getParsedBody()
"""""""""""""""""""""""

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
""""""""""""""""""""

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
      [end]

      [request.getHeaders()['host'][0] == 'www.example.org']
         page.20.value = The host is www.example.org
      [end]




.. index:: Conditions; request.getCookieParams()
.. _condition-function-request-getCookieParams():

request.getCookieParams()
"""""""""""""""""""""""""

:aspect:`Function`
   request.getCookieParams()

:aspect:`Parameter`
   Custom

:aspect:`Type`
   Array

:aspect:`Description`
   Provides all available cookies.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [request.getCookieParams()['foo'] == 1]


.. index:: Conditions; request.getNormalizedParams()
.. _condition-function-request-getNormalizedParams():

request.getNormalizedParams()
"""""""""""""""""""""""""""""

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
      [end]

      [request.getNormalizedParams().getHttpHost() == "example.org"]
         page.10.value = The host is "example.org"
      [end]



.. index:: Conditions; request.getPageArguments()
.. _condition-function-request-getPageArguments():

request.getPageArguments()
""""""""""""""""""""""""""

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

   Allows migration from old condition syntax using `[globalVar = GP:singlepartner > 0]`
   to `[request.getPageArguments().get('singlepartner') > 0]`.


.. index:: Conditions; date
.. _condition-function-date:

date
~~~~

:aspect:`Function`
   date

:aspect:`Parameter`
   String

:aspect:`Type`
   String / Integer

:aspect:`Description`
   Get current date in given format.

   See PHP `date <https://www.php.net/manual/en/function.date.php>`_ function as
   reference for possible usage.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [date("j") == 7]
         page.10.value = True if day of current month is 7
      [end]

      [date("w") == 7]
         page.10.value = True if day of current week is
      [end]

      [date("z") == 7]
         page.10.value = True if day of current year is 7
      [end]

      [date("G") == 7]
         page.10.value = rue if current hour is 7
      [end]


.. index:: Conditions; like
.. _condition-function-like:

like
~~~~

:aspect:`Function`
   like

:aspect:`Parameter`
   String, String

:aspect:`Type`
   Boolean

:aspect:`Description`
   This function has two parameters:

   The first parameter
      Is the string to search in

   The second parameter
      Is the search string

:aspect:`Example`
   Search a string with ``*`` within another string:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [like("fooBarBaz", "*Bar*")]

   Search string with single characters in between, using ``?``:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [like("fooBarBaz", "f?oBa?Baz")]

   Search string using regular expression:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [like("fooBarBaz", "/f[o]{2,2}[aBrz]+/")]


.. index:: Conditions; traverse
.. _condition-function-traverse:

traverse
~~~~~~~~

:aspect:`Function`
   traverse

:aspect:`Parameter`
   Array, String

:aspect:`Type`
   Custom

:aspect:`Description`
   This function gets a value from an array with arbitrary depth. It has two parameters:

   The first parameter
      Is the array to traverse

   The second parameter
      Is the path to traverse

   In case the path is not found in the array, an empty string is returned.

:aspect:`Example`
   Traverse query parameters of current request along `tx_news_pi1[news]`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]



.. index:: Conditions; ip
.. _condition-function-ip:

ip
~~

:aspect:`Function`
   ip

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
      [end]

      [ip("devIP")]
         page.10.value = Your IP matches the configured devIp
      [end]


.. index:: Conditions; compatVersion
.. _condition-function-compatVersion:

compatVersion
~~~~~~~~~~~~~

:aspect:`Function`
   compatVersion

:aspect:`Parameter`
   String

:aspect:`Type`
   Boolean

:aspect:`Description`
   Compares against the current TYPO3 branch.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [compatVersion("11.5")]
         page.10.value = You are using TYPO3 11.5
      [end]

   Is same as:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [compatVersion("11.5.0")]
         page.10.value = You are using TYPO3 11.5
      [end]

   Another example:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [compatVersion("11.5.1")]
         page.10.value = You are using TYPO3 11.5
      [end]


.. index:: Conditions; loginUser
.. _condition-function-loginUser:

loginUser
~~~~~~~~~

:aspect:`Function`
   loginUser

:aspect:`Parameter`
   String

:aspect:`Type`
   Boolean

:aspect:`Description`
   value or constraint, wildcard or RegExp possible

   Context dependent, uses BE-User within TSconfig, and FE-User within
   TypoScript.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [loginUser('*')]
         # matches any login user
         page.10.value = You are logged in!
      [end]

      [loginUser(1)]
         page.10.value = Your frontend user has the uid 1
      [end]

      [loginUser('1,3,5')]
         page.10.value = Your frontend user has the uid 1, 3 or 5
      [end]

      [loginUser('*') == false]
         page.10.value = You are logged out!
      [end]


.. index:: Conditions; getTSFE
.. _condition-function-getTSFE:

getTSFE
~~~~~~~

:aspect:`Function`
   getTSFE

:aspect:`Parameter`
   Object

:aspect:`Description`
   Provides access to TypoScriptFrontendController (:php:`$GLOBALS['TSFE']`)

   Conditions based on ``getTSFE()`` used in a context where TSFE is not available will always evaluate to ``false``.

:aspect:`Example`
   Current :ref:`setup-page-typenum`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [getTSFE().type == 98]

   Current page id equals to 17. However, :ref:`condition-page` should be preferred:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [getTSFE().id == 17]


.. index:: Conditions; getenv
.. _condition-function-getenv:

getenv
~~~~~~

:aspect:`Function`
   getenv

:aspect:`Parameter`
   String

:aspect:`Description`
   PHP function:  `getenv <https://www.php.net/manual/en/function.getenv.php>`_

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [getenv("VIRTUAL_HOST") == "www.example.org"]


.. index:: Conditions; feature
.. _condition-function-feature:

feature
~~~~~~~

:aspect:`Function`
   feature

:aspect:`Parameter`
   String

:aspect:`Description`
   Provides access to feature toggles current state.

:aspect:`Example`
   Check if feature toggle for strict TypoScript syntax is enabled:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [feature("TypoScript.strictSyntax") === false]


.. index:: Conditions; usergroup
.. _condition-function-usergroup:

usergroup
~~~~~~~~~

:aspect:`Function`
   usergroup

:aspect:`Parameter`
   String

:aspect:`Value`
   Boolean

:aspect:`Description`
   Value or constraint, wildcard or RegExp possible

   Allows to check whether current user (FE or BE) is part of the expected
   usergroup.

:aspect:`Example`
   Any usergroup:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [usergroup("*")]
         page.10.value = You are logged in and belong to some usergroup.
      [end]

      [usergroup("12")]
         page.10.value = You are in the usergroup with uid 12.
      [end]

      [usergroup("12,15,18")]
         page.10.value = You are in the usergroup with uid 12, 15 or 18.
      [end]


.. index:: Conditions; Functions frontend
.. _condition-functions-in-frontend-context:

Functions in frontend context
-----------------------------

The following functions are only available in **frontend** context:


.. index:: Conditions; session
.. _condition-functions-in-frontend-context-function-session:

session
~~~~~~~

:aspect:`Function`
   session

:aspect:`Parameter`
   String

:aspect:`Value`
   Mixed

:aspect:`Description`
   Allows to access values of the current session.
   Available values depend on values written to the session, e.g. by extensions.

   Use ``|`` to dig deeper into the structure for stored values.

   .. TODO: Once available again, add reference to session handling, e.g. retrieving and storing values

:aspect:`Example`
   Example, matches if session has value 1234567 in structure :php:`$foo['bar']`:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [session("foo|bar") == 1234567]


.. index:: Conditions; site
.. _condition-functions-in-frontend-context-function-site:

site
~~~~

:aspect:`Function`
   site

:aspect:`Parameter`
  String

:aspect:`Description`
   Get value from site configuration, or null if no site was found or property
   does not exists.

   Available Information:

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
   Site identifier:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [site("identifier") == "typo395"]

   Matches if site base host:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [site("base").getHost() == "www.example.org"]

   Base path:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [site("base").getPath() == "/"]

   Rootpage uid:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [site("rootPageId") == 1]

   Configuration property:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [traverse(site("configuration"), "myCustomProperty") == true]

.. warning::
   It might seem straight-forward to use `site("configuration")["myCustomProperty"]` to access
   configuration properties. However, if the property has not been set, this will trigger a runtime
   exception, and your log will fill up quickly. Using :ref:`condition-function-traverse` will silence the error messages.

.. index:: Conditions; siteLanguage
.. _condition-functions-in-frontend-context-function-siteLanguage:

siteLanguage
~~~~~~~~~~~~

:aspect:`Function`
   siteLanguage

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
      [end]

      [siteLanguage("title") == "Italy"]
         page.10.value = This site has the title "Italy"
      [end]
