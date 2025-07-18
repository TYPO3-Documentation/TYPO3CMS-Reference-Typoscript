:navigation-title: Conditions

..  include:: /Includes.rst.txt
..  index::
    Conditions
    Conditions; Difference to TypoScript templates
    Conditions; Access backend user
..  _tsconfig-conditions:
..  _tsconfig-condition-references:
..  _conditions-example:
..  _tsconfig-condition-differences:

===========================================
Conditions in Backend TypoScript / TSconfig
===========================================

TSconfig TypoScript conditions offer a way to conditionally change TypoScript based
on current context. See the :ref:`TypoScript syntax condition chapter <t3tsref:typoscript-syntax-conditions>`
for the basic syntax of conditions.

It is possible to use TypoScript conditions in both user TSconfig and page TSconfig,
just as it is done in frontend TypoScript. The list of available variables and
functions is different, though.

The Symfony expression language tends to throw warnings when sub arrays are
checked in a condition that do not exist. Use the :ref:`traverse <tsconfig-condition-function-traverse>`
function to avoid this.

..  contents::
    :local:

..  _tsconfig-condition-variables:

Condition variables available in TSconfig
=========================================


..  index:: Conditions; applicationContext
..  _tsconfig-condition-applicationContext:

applicationContext
------------------

..  confval:: applicationContext
    :name: tsconfig-condition-applicationContext
    :type: string

    Current application context as string. See :ref:`t3coreapi:bootstrapping-context`.

..  _tsconfig-condition-applicationContext-example:

Example: Condition applies in application context "Development"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [applicationContext == "Development"]
        // Your settings go here
    [END]

Example: Condition applies in any application context that does not start with "Production"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This condition applies in any context that is "Production" or starts with
"Production" (for example Production/Staging"):

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [applicationContext matches "/^Production/"]
        // Your settings go here
    [END]


..  index:: Conditions; page
..  _tsconfig-condition-page:

page
----

..  confval:: page
    :name: tsconfig-condition-page
    :type: array

    All data of the current page record as array. Only available in page TSconfig, not
    in user TSconfig.

..  _tsconfig-condition-page-example:

Example: Condition applies only on certain pages
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Check single page uid
    [traverse(page, "uid") == 2]
        // Your settings go here
    [END]
    # Check list of page uids
    [traverse(page, "uid") in [17,24]]
        // Your settings go here
    [END]
    # Check list of page uids NOT in
    [traverse(page, "uid") not in [17,24]]
        // Your settings go here
    [END]
    # Check range of pages (example: page uid from 10 to 20)
    [traverse(page, "uid") in 10..20]
        // Your settings go here
    [END]

    # Check the page backend layout
    [traverse(page, "backend_layout") == 5]
        // Your settings go here
    [END]
    [traverse(page, "backend_layout") == "example_layout"]
        // Your settings go here
    [END]

    # Check the page title
    [traverse(page, "title") == "foo"]
        // Your settings go here
    [END]


..  index:: Conditions; tree
..  _tsconfig-condition-tree:

tree
----

..  confval:: tree
    :name: tsconfig-condition-tree
    :type: Object

    Object with tree information. Only available in page TSconfig, not
    in user TSconfig.

..  index::
    Conditions; tree.level
    Conditions; Page level

..  _tsconfig-condition-tree-level:

tree.level
----------

..  confval:: tree.level
    :name: tsconfig-condition-tree-level
    :type: integer

    Current tree level. Only available in page TSconfig, not
    in user TSconfig. Starts at `1` (root level).

..  _tsconfig-condition-tree-level-example:

Example: Condition applies on a page on root level
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Check if page is on level 1 (root):
    [tree.level == 1]
        // Your settings go here
    [END]

..  hint::

    In older versions before TYPO3 v10, this setting was available as
    `treeLevel` variable.
    That variable started the root level at value `0`, and now it starts at `1`.
    Keep this in mind when migrating old conditions.

    Unlike the frontend TypoScript condition `tree.level`, the backend tree level
    is not affected by `pages.is_siteroot`. This means, for nested sites it cannot
    be used to match "site roots" or in general any n-th levels of page tree depths.
    It's the *absolute depth* of the entire page tree, starting with `1`.

..  index:: Conditions; tree.pagelayout
..  _tsconfig-condition-tree-pagelayout:

tree.pagelayout
---------------

..  confval:: tree.pagelayout
    :name: tsconfig-condition-tree-pagelayout
    :type: integer / string

    Check for the defined backend layout of a page including the inheritance of
    the field :guilabel:`Backend Layout (subpages of this page)`. Only available in page TSconfig,
    not in user TSconfig.

..  _tsconfig-condition-tree-pagelayout-example:

Example: Condition applies on pages with a certain backend layout
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Use backend_layout records uids
    [tree.pagelayout == 2]
        // Your settings go here
    [END]

    # Use TSconfig provider of backend layouts
    [tree.pagelayout == "pagets__Home"]
        // Your settings go here
    [END]


..  index::
    Conditions; tree.rootLine
..  _tsconfig-condition-tree-rootLine:

tree.rootLine
-------------

..  confval:: tree.rootLine
    :name: tsconfig-condition-tree-rootLine
    :type: array

    An array of arrays with uid and pid. Only available in page TSconfig, not
    in user TSconfig.

..  _tsconfig-condition-tree-rootLine-example:

Example: Condition applies on all subpages of page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [tree.rootLine[0]["uid"] == 1]
        // Your settings go here
    [END]


..  index::
    Conditions; tree.rootLineIds
    Conditions; Pid in rootline
..  _tsconfig-condition-tree-rootLineIds:

tree.rootLineIds
----------------

..  confval:: tree.rootLineIds
    :name: tsconfig-condition-tree-rootLineIds
    :type: array

    An array with UIDs of the root line. Only available in page TSconfig, not
    in user TSconfig.

..  _tsconfig-condition-tree-rootLineIds-example:

Example: Condition applies if a page is in the root line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Check if page with uid 2 is inside the root line
    [2 in tree.rootLineIds]
        // Your settings go here
    [END]


..  index::
    Conditions; tree.rootLineParentIds
    Conditions; Pid up in rootline
..  _tsconfig-condition-tree-rootLineParentIds:

tree.rootLineParentIds
----------------------

..  confval:: tree.rootLineParentIds
    :name: tsconfig-condition-tree-rootLineParentIds
    :type: array

    An array with parent UIDs of the root line. Only available in page TSconfig, not
    in user TSconfig.

..  _tsconfig-condition-tree-rootLineParentIds-example:

Example: Condition applies if a page's parent is in the root line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Check if page with uid 2 is the parent of a page inside the root line
    [2 in tree.rootLineParentIds]
        // Your settings go here
    [END]


..  index:: Conditions; backend
..  _tsconfig-condition-backend:

backend
-------

..  confval:: backend
    :name: tsconfig-condition-backend
    :type: Object

    Object with backend information.


..  index:: Conditions; backend.user
..  _tsconfig-condition-backend-user:

backend.user
------------

..  confval:: backend.user
    :name: tsconfig-condition-backend-user
    :type: Object

    Object with current backend user information.

..  index::
    Conditions; backend.user.isAdmin
    Conditions; Admin logged in
..  _tsconfig-condition-backend-user-isAdmin:

backend.user.isAdmin
--------------------

..  confval:: backend.user.isAdmin
    :name: tsconfig-condition-backend-user-isAdmin
    :type: boolean

    True if current user is admin.

..  _tsconfig-condition-backend-user-isAdmin-example:

Example: Condition applies if the current backend user is an admin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Evaluates to true if current backend user is administrator
    [backend.user.isAdmin]
        // Your settings go here
    [END]


..  index:: Conditions; backend.user.isLoggedIn
..  _tsconfig-condition-backend-user-isLoggedIn:

backend.user.isLoggedIn
-----------------------

..  confval:: backend.user.isLoggedIn
    :name: tsconfig-condition-backend-user-isLoggedIn
    :type: boolean

    True if current user is logged in.

..  todo: When does this make sense? TSconfig is only applied in backend context...

..  _tsconfig-condition-backend-user-isLoggedIn-example:

Example: Condition applies if any backend user is logged in
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [backend.user.isLoggedIn]
        // Your settings go here
    [END]


..  index:: Conditions; backend.user.userId
..  _tsconfig-condition-backend-user-userId:

backend.user.userId
-------------------

..  confval:: backend.user.userId
    :name: tsconfig-condition-backend-user-userId
    :type: integer

    UID of current user.

..  _tsconfig-condition-backend-user-userId-example:

Example: Condition applies if a certain backend user is logged in
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Evaluates to true if user uid of current logged in backend user is equal to 5
    [backend.user.userId == 5]
        // Your settings go here
    [END]


..  index:: Conditions; backend.user.userGroupIds
..  _tsconfig-condition-backend-user-userGroupIds:

backend.user.userGroupIds
-------------------------

..  confval:: backend.user.userGroupList
    :name: tsconfig-condition-backend-user-userGroupIds
    :type: array

    array of user group IDs of the current backend user.

..  _tsconfig-condition-backend-user-userGroupIds-example:

Example: Condition applies if a backend user of a certain group is logged in
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [2 in backend.user.userGroupIds]
        // Your settings go here
    [END]

..  index:: Conditions; backend.user.userGroupList
..  _tsconfig-condition-backend-user-userGroupList:

backend.user.userGroupList
--------------------------

..  confval:: backend.user.userGroupList
    :name: tsconfig-condition-backend-user-userGroupList
    :type: string

    Comma list of group UIDs

..  _tsconfig-condition-backend-user-userGroupList-example:

Example: Condition applies if the groups of a user meet a certain pattern
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  todo: Does this example make sense? What does it really do?

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [like(","~backend.user.userGroupList~",", "*,1,*")]
        // Your settings go here
    [END]

..  index:: Conditions; workspace
..  _tsconfig-condition-workspace:

workspace
---------

..  confval:: workspace
    :name: tsconfig-condition-workspace
    :type: Object

    object with workspace information


..  index:: Conditions; workspace.workspaceId
..  _tsconfig-condition-workspace-workspaceId:

workspace.workspaceId
---------------------

..  confval:: .workspaceId
    :name: tsconfig-condition-workspace-workspaceId
    :type: integer

    UID of current workspace.

..  _tsconfig-condition-workspace-workspaceId-example:

Example: Condition applies only in a certain workspace
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [workspace.workspaceId == 0]
        // Your settings go here
    [END]


..  index:: Conditions; workspace.isLive
..  _tsconfig-condition-workspace-isLive:

workspace.isLive
----------------

..  confval:: workspace.isLive
    :name: tsconfig-condition-workspace-isLive
    :type: boolean

    True if current workspace is live.

..  _tsconfig-condition-workspace-isLive-example:

Example: Condition applies only in live workspace
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [workspace.isLive]
        // Your settings go here
    [END]


..  index:: Conditions; workspace.isOffline
..  _tsconfig-condition-workspace-isOffline:

workspace.isOffline
-------------------

..  confval:: workspace.isOffline
    :name: tsconfig-condition-workspace-isOffline
    :type: boolean

    True if current workspace is offline

..  _tsconfig-condition-workspace-isOffline-example:

Example: Condition applies only in offline workspace
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [workspace.isOffline]
        // Your settings go here
    [END]


..  index:: Conditions; typo3
..  _tsconfig-condition-typo3:

typo3
-----

..  confval:: typo3
    :name: tsconfig-condition-typo3
    :type: Object

    Object with TYPO3 related information

..  index:: Conditions; typo3.version
..  _tsconfig-condition-typo3-version:

typo3.version
-------------

..  confval:: typo3.version
    :name: tsconfig-condition-typo3-version
    :type: string

    TYPO3 version (e.g. 13.4.0-dev)

..  _tsconfig-condition-typo3-version-example:

Example: Condition only applies in an exact TYPO3 version like 13.4.0
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [typo3.version == "13.4.0"]
        // Your settings go here
    [END]


..  index:: Conditions; typo3.branch
..  _tsconfig-condition-typo3-branch:

typo3.branch
------------

..  confval:: typo3.branch
    :name: tsconfig-condition-typo3-branch
    :type: string

    TYPO3 branch (e.g. 13.4)


..  _tsconfig-condition-typo3-branch-example:

Example: Condition applies in all TYPO3 versions of a branch like 13.4
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [typo3.branch == "13.4"]
        // Your settings go here
    [END]


..  index:: Conditions; typo3.devIpMask
..  _tsconfig-condition-typo3-devIpMask:

typo3.devIpMask
---------------

..  confval:: typo3.devIpMask
    :name: tsconfig-condition-typo3-devIpMask
    :type: string

    :php:`$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask']`

..  _tsconfig-condition-typo3-devIpMask-example:

Example: Condition only applies if the devIpMask is set to a certain value
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  todo: Does this example make sense? Shouldn't we compare it to the
    IP of the currently logged in backend user or some such?

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [typo3.devIpMask == "203.0.113.6"]
        // Your settings go here
    [END]


..  _tsconfig-condition-functions:

Condition functions available in TSconfig
=========================================

..  index:: Conditions; date
..  _tsconfig-condition-function-date:

date()
------

..  confval:: date([parameter])
    :name: tsconfig-condition-function-date
    :type: integer
    :Parameter: [parameter]: string / integer

    Get current date in given format. See PHP `date <https://www.php.net/manual/en/function.date.php>`_
    function as reference for possible usage.

..  _tsconfig-condition-function-date-example:

Example: Condition applies at certain dates or times
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # True if day of current month is 7
    [date("j") == 7]
        // Your settings go here
    [END]

    # True if day of current week is 7
    [date("w") == 7]
        // Your settings go here
    [END]

    # True if day of current year is 7
    [date("z") == 7]
        // Your settings go here
    [END]

    # True if current hour is 7
    [date("G") == 7]
        // Your settings go here
    [END]


..  index:: Conditions; like
..  _tsconfig-condition-function-like:

like()
------

..  confval:: like([search-string], [pattern])
    :name: tsconfig-condition-function-like
    :type: boolean
    :parameter: [search-string] : string; [pattern]: string

    This function has two parameters: The first parameter is the string to search in,
    the second parameter is the search string.

..  _tsconfig-condition-function-like-example:

Example: Use the "like()" function in conditions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Search a string with * within another string
    [like("fooBarBaz", "*Bar*")]
        // Your settings go here
    [END]

    # Search string with single characters in between, using ?
    [like("fooBarBaz", "f?oBa?Baz")]
        // Your settings go here
    [END]

    # Search string using regular expression
    [like("fooBarBaz", "/f[o]{2,2}[aBrz]+/")]
        // Your settings go here
    [END]


..  index:: Conditions; traverse
..  _tsconfig-condition-function-traverse:

traverse()
----------

..  confval:: traverse([array], [key])
    :name: tsconfig-condition-function-traverse
    :type: any
    :Parameter: [array]: array; [key]: string or integer

    This function gets a value from an array with arbitrary depth and suppresses
    PHP warning when sub arrays do not exist. It has two parameters: The first parameter
    is the array to traverse, the second parameter is the path to traverse.

    In case the path is not found in the array, an empty string is returned.

..  _tsconfig-condition-function-traverse-example:

Example: Condition applies if request parameter matches a certain value
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  todo: This example does not really make sense in the backend context?

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Traverse query parameters of current request along tx_news_pi1[news]
    [traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]
        // Your settings go here
    [END]


..  index:: Conditions; compatVersion
..  _tsconfig-condition-function-compatVersion:

compatVersion()
---------------

..  confval:: compatVersion([version-pattern])
    :name: tsconfig-condition-function-compatVersion
    :type: boolean
    :Parameter: [version-pattern]: string

    Compares against the current TYPO3 branch.

..  _tsconfig-condition-function-compatVersion-example:

Example: Condition applies if the current TYPO3 version matches a pattern
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # True if current version is 13.4.x
    [compatVersion("13.4")]
        // Your settings go here
    [END]
    [compatVersion("13.4.0")]
        // Your settings go here
    [END]
    [compatVersion("13.4.1")]
        // Your settings go here
    [END]

..  _tsconfig-condition-function-getenv:

getenv()
--------

..  confval:: getenv([enviroment_variable])
    :name: tsconfig-condition-function-getenv
    :type: string
    :Parameter: [enviroment_variable]: string

    PHP function `getenv <https://www.php.net/manual/en/function.getenv.php>`_.

..  _tsconfig-condition-function-getenv-example:

Example: Condition applies if the virtual host is set to a certain value
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    [getenv("VIRTUAL_HOST") == "www.example.org"]
        // Your settings go here
    [END]

..  index:: Conditions; feature
..  _tsconfig-condition-function-feature:

feature()
---------

..  confval:: feature([feature_key])
    :name: tsconfig-condition-function-feature
    :type: any
    :Parameter: [feature_key]: string

    Provides access to feature toggles current state.

..  _tsconfig-condition-function-feature-example:

Example: condition applies if a feature toggle is enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  todo: Add another feature as TypoScript.strictSyntax is not available anymore in current versions.

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # True if feature toggle for strict TypoScript syntax is enabled:
    [feature("TypoScript.strictSyntax") === false]
        // Your settings go here
    [END]

..  _tsconfig-condition-function-site:

site()
------

..  confval:: site([keyword])
    :name: tsconfig-condition-function-site
    :type: string
    :Parameter: [keyword]: string

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
        For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    site("allLanguages")
        Returns array of available and unavailable languages for current site.
        For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    site("defaultLanguage")
        Returns the default language for current site.
        For deeper information, see :ref:`condition-functions-in-frontend-context-function-siteLanguage`.

    site("configuration")
        Returns an array with all available configuration for current site.

..  _tsconfig-condition-function-site-example:

Example: Condition applies if a certain value is set in the site configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/page.tsconfig

    # Site identifier
    [site("identifier") == "my_website"]
        // Your settings go here
    [END]

    # Match site base host
    [site("base").getHost() == "www.example.org"]
        // Your settings go here
    [END]

    # Match base path
    [site("base").getPath() == "/"]
        // Your settings go here
    [END]

    # Match root page uid
    [site("rootPageId") == 1]
        // Your settings go here
    [END]

    # Match a configuration property
    [traverse(site("configuration"), "myCustomProperty") == true]
        // Your settings go here
    [END]
