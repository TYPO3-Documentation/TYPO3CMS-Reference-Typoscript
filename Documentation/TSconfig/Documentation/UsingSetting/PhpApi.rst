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

..  literalinclude:: _PhpApi/_MyBackendController.php
    :language: php
    :caption: EXT:my_sitepackage/Classes/Controller/MyBackendController.php

Both methods return the entire TSconfig as a PHP array. The former
retrieves the user TSconfig while the latter retrieves the page TSconfig.

All imports, overrides, modifications, etc. are already resolved. This includes
page TSconfig overrides by user TSconfig.

Similar to other TypoScript-related API methods, properties that contain
sub-properties return their sub-properties using the property name with a
trailing dot, while a single property is accessible by the property
name itself. The example below gives more insight on this.

If accessing TSconfig arrays, the PHP null coalescing operator :php:`??` is
useful: TSconfig options may or not be set, accessing non-existent
array keys in PHP would thus raise PHP notice level warnings.

Combining the array access with a fallback using :php:`??` helps when accessing
these optional array structures.


..  literalinclude:: _PhpApi/_user.tsconfig
    :language: typoscript
    :caption: Incoming (user) TSconfig:

..  literalinclude:: _PhpApi/_getTSConfig.php
    :language: php
    :caption: Parsed array returned by getTSConfig(), note the dot if a property has sub keys:

..  literalinclude:: _PhpApi/_MyBackendLoggedInController.php
    :language: php
    :caption: Example how to read user TSconfig

Changing or adding page TSconfig
================================

The PSR-14 event :ref:`ModifyLoadedPageTsConfigEvent <t3coreapi:ModifyLoadedPageTsConfigEvent>`
is available to modify or add page TSconfig entries.
