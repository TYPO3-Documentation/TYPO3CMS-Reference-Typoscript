.. include:: /Includes.rst.txt
.. index::
   Conditions
   Conditions; Difference to TypoScript templates
   Conditions; Access backend user
.. _conditions:
.. _condition-references:
.. _conditions-example:
.. _condition-differences:

==========
Conditions
==========

TSconfig TypoScript conditions offer a way to conditionally change TypoScript based
on current context. See the :ref:`TypoScript syntax condition chapter <t3coreapi:typoscript-syntax-conditions>`
for the basic syntax of conditions.

It is possible to use TypoScript conditions in both user TSconfig and page TSconfig,
just as it is done in frontend TypoScript. The list of available variables and
functions is different, though.

The Symfony expression language tends to throw warnings when sub arrays are
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
   All data of the current page record as array. Only available in page TSconfig, not
   in user TSconfig.

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
   Object with tree information. Only available in page TSconfig, not
   in user TSconfig.


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
   Current tree level. Only available in page TSconfig, not
   in user TSconfig.

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
   the field :guilabel:`Backend Layout (subpages of this page)`. Only available in page TSconfig,
   not in user TSconfig.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Use backend_layout records uids
      [tree.pagelayout == 2]

      # Use TSconfig provider of backend layouts
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
   Array of arrays with uid and pid. Only available in page TSconfig, not
   in user TSconfig.

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
   An array with UIDs of the rootline. Only available in page TSconfig, not
   in user TSconfig.

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
   An array with parent UIDs of the root line. Only available in page TSconfig, not
   in user TSconfig.

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

      # Evaluates to true if current backend user is administrator
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

      # Evaluates to true if an backend user is logged in
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

      # Evaluates to true if user uid of current logged in backend user is equal to 5
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
   Array of user group IDs of the current backend user.

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
   TYPO3 version (e.g. 12.4.0-dev)

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [typo3.version == "12.4.0"]


.. index:: Conditions; typo3.branch
.. _condition-typo3-branch:

typo3.branch
------------

:aspect:`Variable`
   typo3.branch

:aspect:`Type`
   String

:aspect:`Description`
   TYPO3 branch (e.g. 12.4)

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      [typo3.branch == "12.4"]


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

      [typo3.devIpMask == "203.0.113.6"]


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

      # True if current version is 12.4.x
      [compatVersion("12.4")]
      [compatVersion("12.4.0")]
      [compatVersion("12.4.1")]


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


site()
======

:aspect:`Function`
   site

:aspect:`Parameter`
  String

:aspect:`Description`
   Get value from site configuration, or null if no site was found or property
   does not exists. Only available in page TSconfig, not available in user TSconfig.
   Available Information:

   site("identifier")
      Returns the identifier of current site as string.

   site("base")
      Returns the base of current site as string.

   site("rootPageId")
      Returns the root page uid of current site as integer.

   site("languages")
      Returns array of available languages for current site.
      For deeper information, see :ref:`t3tsref:condition-functions-in-frontend-context-function-siteLanguage`.

   site("allLanguages")
      Returns array of available and unavailable languages for current site.
      For deeper information, see :ref:`t3tsref:condition-functions-in-frontend-context-function-siteLanguage`.

   site("defaultLanguage")
      Returns the default language for current site.
      For deeper information, see :ref:`t3tsref:condition-functions-in-frontend-context-function-siteLanguage`.

   site("configuration")
      Returns an array with all available configuration for current site.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      # Site identifier
      [site("identifier") == "my_website"]

      # Match site base host
      [site("base").getHost() == "www.example.org"]

      # Match base path
      [site("base").getPath() == "/"]

      # Match root page uid
      [site("rootPageId") == 1]

      # Match a configuration property
      [traverse(site("configuration"), "myCustomProperty") == true]
