..  include:: /Includes.rst.txt
..  index::
    Page TSconfig; PHP API
    Page TSconfig; Retrieving
    Page TSconfig; Getting

..  _phpapi:

=======
PHP API
=======

Retrieving TSconfig settings
============================

The PHP API to retrieve page and user TSconfig in a backend module can be used
as follows:

..  code-block:: php
    :caption: EXT:my_sitepackage/Classes/Controller/MyBackendController.php

    use TYPO3\CMS\Backend\Utility\BackendUtility;

    public function someBackendAction() {
        // Retrieve user TSconfig of currently logged in user
        $userTsConfig = $GLOBALS['BE_USER']->getTSConfig();

        // Retrieve page TSconfig of the given page id
        $pageTsConfig = BackendUtility::getPagesTSconfig($currentPageId);
    }

Both methods return the entire TSconfig as a PHP array. The former
retrieves the user TSconfig while the latter retrieves the page TSconfig.

All imports, overrides, modifications, etc. are already resolved. This includes
page TSconfig overrides by user TSconfig.

Similar to other TypoScript-related API methods, properties that contain
sub-properties return their sub-properties using the property name with a
trailing dot, while a single property is accessible by the property
name itself. The example below gives more insight on this.

If accessing TSconfig arrays, the PHP null coalescence operator :php:`??` is
almost always useful: TSconfig options may or not be set, accessing non-existent
array keys in PHP would thus raise PHP notice level warnings.

Combining the array access with a fallback using :php:`??` helps when accessing
these optional array structures.

..  code-block:: php
    :caption: EXT:my_sitepackage/Classes/Controller/MyBackendController.php

    // Incoming (user) TSconfig:
    // options.someToggle = 1
    // options.somePartWithSubToggles = foo
    // options.somePartWithSubToggles.aValue = bar

    // Parsed array returned by getTSConfig(), note the dot if a property has sub keys:
    // [
    //     'options.' => [
    //         'someToggle' => '1',
    //         'somePartWithSubToggles' => 'foo',
    //         'somePartWithSubToggles.' => [
    //             'aValue' => 'bar',
    //         ],
    //     ],
    // ],

    public function someBackendAction() {
        $userTsConfig = $this->getBackendUser->getTSConfig();

        // Typical call to retrieve a sanitized value:
        $isToggleEnabled = (bool)($userTsConfig['options.']['someToggle'] ?? false);

        // Retrieve a subset, note the dot at the end:
        $subArray = $userTsConfig['options.']['somePartWithSubToggles.'] ?? [];
    }

Changing or adding page TSconfig
================================

The PSR-14 event :ref:`ModifyLoadedPageTsConfigEvent <t3coreapi:ModifyLoadedPageTsConfigEvent>`
is available to modify or add page TSconfig entries.
