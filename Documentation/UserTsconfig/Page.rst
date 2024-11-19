..  include:: /Includes.rst.txt
..  index:: user TSconfig; Overrider page TSconfig
..  _user-page:

====
page
====

Override any page TSconfig property on a user or group basis by prefixing
the according property path with `page.`. Find more information about this
in the :ref:`Using and setting <user-override-modify-values>` section.

Example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/user.tsconfig

    page.TCEMAIN.table.pages.disablePrependAtCopy = 1
