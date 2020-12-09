.. include:: ../Includes.txt

.. _conditions:

==========
Conditions
==========

.. seealso::

   * For full explanations about the condition syntax, please refer to
     :ref:`the TypoScript Syntax chapter of the Core API <t3coreapi:typoscript-syntax-conditions>`.
     The "new" condition syntax (since TYPO3 9.4) is based on the
     `symfony expression language <https://symfony.com/doc/4.1/components/expression_language.html>`__
   * TypoScript also offers the :ref:`"if" function <if>` to create conditions.


Upgrading
=========

The "old" condition syntax has been :doc:`deprecated <t3core:Changelog/9.5/Deprecation-86068-OldConditionSyntax>`
in 9 and will be removed in 10.

.. hint::
   If it is not possible yet to fully migrate to Symfony expression language,
   the :ref:`feature toggle <feature-toggles-enable>` `[SYS][features][TypoScript.strictSyntax]` can be disabled via
   :guilabel:`Settings -> Feature Toggles` or directly in :file:`LocalConfiguration.php` or :file:`AdditionalConfiguration.php`.

Before updating from 9 to 10, you *MUST* change your templates to use the "new"
condition syntax.

Look for notices in the deprecation log, such as:

.. code-block:: none

    Mon, 27 Jul 2020 15:58:06 +0200 [NOTICE] request="a4130429dafc6" component="TYPO3.CMS.deprecations":
      Core: Error handler (BE): TYPO3 Deprecation Notice:
      Multiple conditions blocks combined with AND, OR, && or || will be removed in TYPO3 v10.0, use
      the new expression language. in ....

However, the deprecation log will only show you deprecations for pages that
are being rendered. To get a full overview of old conditions, you should
search through your own extensions and possibly the TypoScript templates
in the database (available through the "Templates" backend module).


old::

   # page uid == 2
   [page|uid = 2]

::

   # page layout == 1
   [page|layout = 1]

::

   # applicationContext is "Production"
   [applicationContext = Production*]

new::

   [page["uid"] == 2]

::

   [page["layout"] == 1]

::

   [applicationContext == "Production"]



.. _condition-reference:

Reference
=========

.. _condition-variables:

Variables
---------

The following variables are available. The values are context related.

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

:aspect:`Beispiel`
   ::

      [applicationContext == "Development"]

.. _condition-page:

page
~~~~

:aspect:`Variable`
   page

:aspect:`Type`
   Array

:aspect:`Description`
   Current page record as array.

:aspect:`Example`
   ::

      [page["uid"] == 2]

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
   If constant is an integer::

      [{$foo.bar} == 4711]

   If constant is a string put constant in quotes::

      ["{$foo.bar}" == "4711"]

.. _condition-tree:

tree
~~~~

:aspect:`Variable`
   tree

:aspect:`Type`
   Object

:aspect:`Description`
   Object with tree information.

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
   Check whether page is on level 0::

      [tree.level == 0]

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
   ::

      [tree.rootLine[0]["uid"] == 1]

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
   Check whether page with uid 2 is inside the root line::

      [2 in tree.rootLineIds]

.. _condition-backend:

backend
~~~~~~~

:aspect:`Variable`
   backend

:aspect:`Type`
   Object

:aspect:`Description`
   Object with backend information.

.. _condition-backend-user:

backend.user
""""""""""""

:aspect:`Variable`
   backend.user

:aspect:`Type`
   Object

:aspect:`Description`
   Object with current backend user information.

.. _condition-backend-user-admin:

backend.user.admin
""""""""""""""""""

:aspect:`Variable`
   backend.user.admin

:aspect:`Type`
   Boolean

:aspect:`Description`
   True if current user is admin

:aspect:`Example`
   Evaluates to true if current BE-User is administrator::

      [backend.user.isAdmin]

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
   Evaluates to true if an BE-User is logged in::

      [backend.user.isLoggedIn]


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
   Evaluates to true if user uid of current logged in BE-User is equal to 5::

      [backend.user.userId == 5]


.. _condition-backend-user-userGroupList:

backend.user.userGroupList
""""""""""""""""""""""""""

:aspect:`Variable`
   backend.user.userGroupList

:aspect:`Type`
   String

:aspect:`Description`
   Comma list of group UIDs

:aspect:`Example`
   ::

      [like(","~backend.user.userGroupList~",", "*,1,*")]


.. _condition-frontend:

frontend
~~~~~~~~

:aspect:`Variable`
   frontend

:aspect:`Type`
   Object

:aspect:`Description`
   object with frontend information (available in FE only)

.. _condition-frontend-user:

frontend.user
"""""""""""""

:aspect:`Variable`
   frontend.user

:aspect:`Type`
   Object

:aspect:`Description`
   Object with current frontend user information.


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
   ::

      [frontend.user.isLoggedIn]


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
   ::

      [frontend.user.userId == 5]


.. _condition-frontend-user-userGroupList:

frontend.user.userGroupList
"""""""""""""""""""""""""""

:aspect:`Variable`
   frontend.user.userGroupList

:aspect:`Type`
   String

:aspect:`Description`
   Comma list of group UIDs

:aspect:`Example`
   ::

      [like(","~frontend.user.userGroupList~",", "*,1,*")]

.. _condition-typo3:

typo3
~~~~~

:aspect:`Variable`
   typo3

:aspect:`Type`
   Object

:aspect:`Description`
   object with TYPO3 related information


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
   ::

      [typo3.version == "9.5.5"]

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
   ::

      [typo3.branch == "9.5"]

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
   ::

      [typo3.devIpMask == "172.18.0.6"]

.. _condition-functions-in-all-contexts:

Functions in frontend and backend context
-------------------------

Functions take over the logic of the old conditions which do more than a simple comparison check.
The following functions are available in frontend and backend context, but not CLI.

.. _condition-function-request:

request
~~~~~~~

:aspect:`Function`
   request

:aspect:`Parameter`
   Custom

:aspect:`Description`
   Allows to fetch information from current request.

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
   Check if query parameter skipSessionUpdate equals 1::

      [request.getQueryParams()['skipSessionUpdate'] == 1]
      
   Safely check query parameter array to avoid error logs in case key is not
   defined (see :ref:`condition-function-traverse`). This will check if
   `tx_news_pi1['news'] > 0`::
   
      [traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]

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
   ::

      [request.getParsedBody()['foo'] == 1]

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
   ::

      [request.getHeaders()['Accept'] == 'json']

   ::

      [request.getHeaders()['host'][0] == 'www.typo3lexikon.de']


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
   ::

      [request.getCookieParams()['foo'] == 1]


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
          Example: ``docs.typo3.org``

      ``isHttps()``
         Returns boolean whether SSL was used.

      ``getRequestHost()``
          Example: ``docs.typo3.org``

      ``getRequestHostOnly()``
          Example: ``docs.typo3.org``

      ``getRequestPort()``
          Returns the port, mostly ``80`` or ``443``, but can be whatever is
          configured.

      ``getScriptName()``
          Example: ``/typo3/index.php``

      ``getRequestUri()``
          Example: ``/typo3/index.php?route=%2Fajax%2Fsystem-information%2Frender``

      ``getRequestUrl()``
          Example: ``https://typo3.org/typo3/index.php?route=%2Fajax%2Fsystem-information%2Frender``

      ``getRequestScript()``
          Example: ``https://typo3.org/typo3/index.php``

      ``getRequestDir()``
          Example: ``https://typo3.org/typo3/``

      ``isBehindReverseProxy()``
          Returns boolean.

      ``getRemoteAddress()``
          IP Adress of client, in case of docker this could be ``172.18.0.6``.

      ``getScriptFileName()``
          Example: ``/var/www/html/public/typo3/index.php``

      ``getDocumentRoot()``
          Example: ``/var/www/html/public``

      ``getSiteUrl()``
          Example: ``typo3.org``

      ``getSitePath()``
          Example: ``/``

      ``getSiteScript()``
          Example:
          ``typo3/index.php?route=%2Fajax%2Fsystem-information%2Frender``

      ``getPathInfo()``
          Ist bei mir leer gewesen

      ``getHttpReferer()``
          If enabled, delivers the prior visited url, e.g. ``typo395.ddev.local/typo3/index.php``

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
   ::

      [request.getNormalizedParams().isHttps()]

   ::

      [request.getNormalizedParams().getHttpHost() == "typo395.ddev.local"]
 
 

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
   [request.getPageArguments().get('foo_id') > 0]
   
   Allows migration from old condition syntax using `[globalVar = GP:singlepartner > 0]`
   to `[request.getPageArguments().get('singlepartner') > 0]`.
   
   
Functions in all contexts
-------------------------

The following functions are available in **any** context:

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
   True if day of current month is 7::

      [date("j") == 7]

   True if day of current week is 7::

      [date("w") == 7]

   True if day of current year is 7::

      [date("z") == 7]

   True if current hour is 7::

      [date("G") == 7]

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
   Search a string with ``*`` within another string::

      [like("fooBarBaz", "*Bar*")]

   Search string with single characters in between, using ``?``::

      [like("fooBarBaz", "f?oBa?Baz")]

   Search string using regular expression::

      [like("fooBarBaz", "/f[o]{2,2}[aBrz]+/")]

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
   Check whether IP matches::

      [ip("172.18.*")]

   Check whether IP matches configured devIp::

      [ip("devIP")]

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
   ::

      [compatVersion("9.5")]

   Is same as::

      [compatVersion("9.5.0")]

   Another example::

      [compatVersion("9.5.1")]

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
   Any logged in user::

      [loginUser('*')]

   User with uid 1::

      [loginUser(1)]

   User 1, 3 or 5::

      [loginUser('1,3,5')]

   Not logged in::

      [loginUser('*') == false]

.. _condition-function-getTSFE:

getTSFE
~~~~~~~

:aspect:`Function`
   getTSFE

:aspect:`Parameter`
   Object

:aspect:`Description`
   Provides access to TypoScriptFrontendController (:php:`$GLOBALS['TSFE']`)

:aspect:`Example`
   Current :ref:`setup-page-typenum`::

      [getTSFE().type == 98]

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
   ::

      [getenv("VIRTUAL_HOST") == "docs.typo3.org"]

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
   Check if feature toggle for strict TypoScript syntax is enabled::

      [feature("TypoScript.strictSyntax") === false]

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
   Any usergroup::

      [usergroup("*")]

   Usergroup 12::

      [usergroup("12")]

   Usergroup 12, 15 or 18::

      [usergroup("12,15,18")]

.. _condition-functions-in-frontend-context:

Functions in frontend context
-----------------------------

The following functions are only available in **frontend** context:

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
   Example, matches if session has value 1234567 in structure :php:`$foo['bar']`::

      [session("foo|bar") == 1234567]

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
   Site identifier::

      [site("identifier") == "typo395"]

   Matches if site base host::

      [site("base").getHost() == "docs.typo3.org"]

   Base path::

      [site("base").getPath() == "/"]

   Rootpage uid::

      [site("rootPageId") == 1]

   Configuration property::

      [site("configuration")["enabled"] == true]

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

   * ``siteLanguage("typo3Language")``

   * ``siteLanguage("twoLetterIsoCode")``

   * ``siteLanguage("hreflang")``

   * ``siteLanguage("direction")``

   * ``siteLanguage("fallbackType")``

   * ``siteLanguage("fallbackLanguageIds")``

:aspect:`Example`
   Example, match if siteLanguage locale = foo::

      [siteLanguage("locale") == "de_CH"]

   Example, match if siteLanguage title = Italy::

      [siteLanguage("title") == "Italy"]
