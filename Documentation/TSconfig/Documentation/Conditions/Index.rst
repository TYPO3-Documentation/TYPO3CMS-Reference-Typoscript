.. include:: ../Includes.txt

.. _conditions:

Conditions
----------

It is possible to use TypoScript conditions in both
User TSconfig and Page TSconfig, just as it is done in TypoScript for
templates.


.. _conditions-example:

Examples
^^^^^^^^

.. code-block:: typoscript

	[treeLevel = 1]
	TCEFORM.tt_content.section_frame.disabled = 1
	[GLOBAL]

The above TSconfig will hide the "section\_frame" field of content
elements only on the first level of the page tree.


.. _differences:

Differences to conditions in TypoScript templates
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are some slight differences between conditions in TSconfig and
conditions in TypoScript templates, which must be taken into account:

- Conditions "usergroup" and "loginUser" apply to BE groups and BE users
  – respectively – and not to FE groups and FE users, quite obviously.

- In the "globalString" condition, key "TSFE:" will not work because the
  TSFE global object only exists in the FE context. The "LIT:" key will
  not work either as it is used to compare TypoScript constants, which
  are not available in the BE context.

- Note that conditions such as "PIDupinRootline" or "treeLevel" will
  apply correctly to pages that are being created but are not yet saved.

- You *can* use custom conditions, though.
  ``[BigCompanyName\TypoScriptLovePackage\MyCustomTypoScriptCondition = 7]``

Furthermore the following condition is available **only** in
TSconfig:

.. _adminuser:

adminUser
"""""""""


Syntax:
~~~~~~~

.. code-block:: typoscript

   [adminUser = 0/1]


Comparison
''''''''''

Checks whether the current BE user has admin rights or not. Value is 1
if the user is an admin, 0 if he is not.


Example:
~~~~~~~~

The following condition will apply only if the BE user is an admin.

.. code-block:: typoscript

   [adminUser = 1]


.. _references:

References
^^^^^^^^^^

For a general discussion about TypoScript conditions, please refer to
:ref:`TypoScript Syntax Study <t3coreapi:typoscript-syntax-conditions>` of the core API document.

For a list of available conditions, please refer to the
:ref:`TypoScript Reference <t3tsref:start>`.
