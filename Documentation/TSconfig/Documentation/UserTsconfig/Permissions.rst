.. include:: /Includes.rst.txt
.. index:: File permissions
.. _userTsConfigPermissions:

===========
permissions
===========

Set permissions on a user or group basis. This is especially useful for access permissions on files and
folders as part of the :ref:`Digital assets management (FAL) <t3coreapi:fal>` of the core.

Read more about FAL access permissions in the :ref:`permission chapter <t3coreapi:fal-administration-permissions-user>`
of the core API document, but find some examples below:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/user.tsconfig

   # Allow to create and upload files on all storages
   permissions.file.default.addFile = 1

   # Allow to add new folders if user has write permissions on parent folder
   permissions.file.default.addFolder = 1

   # Allow to edit contents of files on FAL storage with uid 1
   permissions.file.storage.1.writeFile = 1
