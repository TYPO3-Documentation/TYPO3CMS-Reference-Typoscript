.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


Differences to conditions in TypoScript templates
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are some slight differences between conditions in TSconfig and
conditions in template TypoScript, which must be taken into account:

- Conditions "usergroup" and "loginUser" apply to BE groups and BE users
  – respectively – and not to FE groups and FE users, quite obviously.

- In the "globalString" condition, key "TSFE:" will not work because the
  TSFE global object only exists in the FE context. The "LIT:" key will
  not work either as it is used to compare TypoScript constants, which
  are not available in the BE context.

- Note that conditions such as "PIDupinRootline" or "treeLevel" will
  apply correctly to pages that are being created but are not yet saved.

Furthermore the following condition is available  **only** in
TSconfig:


adminUser
"""""""""


Syntax:
~~~~~~~

::

   [adminUser = 0/1]


Comparison
''''''''''

Checks whether the current BE user has admin rights or not. Value is 1
if the user is an admin, 0 if he is not.


Example:
~~~~~~~~

The following condition will apply only if the BE user is an admin. ::

   [adminUser = 1]

