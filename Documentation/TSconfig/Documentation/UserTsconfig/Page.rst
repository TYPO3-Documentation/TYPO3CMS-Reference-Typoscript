.. include:: /Includes.rst.txt
.. index:: user TSconfig; Overrider page TSconfig

====
page
====

Override any page TSconfig property on a user or group basis by prefixing
the according property path with `page.`. Find more information about this
in the :ref:`Using and setting <useroverwritingandmodifyingvalues>` section.

Example:

.. code-block:: typoscript

    page.TCEMAIN.table.pages.disablePrependAtCopy = 1
