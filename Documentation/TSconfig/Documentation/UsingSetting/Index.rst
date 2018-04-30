.. include:: ../Includes.txt


.. _typoscript-syntax-tsconfig:

Using and setting TSconfig
--------------------------

TSconfig can be used in page, it is then referred to as
"Page TSconfig", or for backend users and backend user groups,
in which case it is known as "User TSconfig".

The full Page TSconfig for any given page can be viewed using the
**WEB > Info** module and choosing the "Page TSconfig" action.

.. figure:: ../Images/TSconfigOverview.png
    :alt: Viewing Page TSconfig using the Info module


There is no way to view User TSconfig in the backend directly.

While the objects, properties and conditions are different,
the *syntax* of TSconfig is basically the same as it is for
TypoScript in frontend TypoScript templates, except for constants,
which are not available in TSconfig.


.. _typoscript-syntax-tsconfig-page:

Entering Page TSconfig
^^^^^^^^^^^^^^^^^^^^^^

There are two ways to attach Page TSconfig to any given page.
When editing a page, move to the "Resources" tab. The first
way is to include a TSconfig file provided by an extension.
The second is to directly enter code in the "Page TSConfig" field.

.. figure:: ../Images/TSconfigPageInput.png
    :alt: TSconfig-related fields in the Resources tab of a page


Page TSconfig is inherited along the page tree. Consider
the TSconfig from the above screenshot:

.. code-block:: typoscript

   mod.web_list.hideTables = sys_template

It means that we want to fully hide the "sys\_template" table
on the page where we defined this TSconfig and **all** of its
child pages.

Page TSconfig is thus very convenient to have separate branches
of the page tree behave differently.


.. _typoscript-syntax-tsconfig-user:

Entering User TSconfig
^^^^^^^^^^^^^^^^^^^^^^

User TSconfig is entered in the "TSconfig" field of either
BE users or BE user groups records. For both, this field
is located in the "Options" tab.

.. figure:: ../Images/TSconfigUserInput.png
    :alt: The TSconfig field in the Options tab of a BE user


TSconfig defined at user-level is considered more relevant
than TSconfig defined at group-level. Thus if the same property
is defined both for a group the user belongs to and for the user
itself, the value defined for the user will prevail.

If a user is member of several groups, the TSconfig from each
group will simply be accumulated, identical properties from
later groups taking precedence over definitions from earlier
groups.


.. _conditions:
.. _condition-references:

Conditions
----------

It is possible to use TypoScript :ref:`conditions <t3coreapi:typoscript-syntax-conditions>`
in both User TSconfig and Page TSconfig, just as it is done in TypoScript for templates.

For a general discussion about TypoScript conditions, please refer to
:ref:`TypoScript Syntax Study <t3coreapi:typoscript-syntax-conditions>` of the core API document.

For a list of available conditions, please refer to the
:ref:`TypoScript Reference <t3tsref:condition-reference>`.


.. _conditions-example:

Examples
^^^^^^^^

.. code-block:: typoscript

	[treeLevel = 1]
	TCEFORM.tt_content.section_frame.disabled = 1
	[GLOBAL]

The above TSconfig will hide the "section\_frame" field of content
elements only on the first level of the page tree.


.. _condition-differences:

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


.. _condition-adminuser:

adminUser
"""""""""

Checks whether the current BE user has admin rights or not. Value is 1
if the user is an admin, 0 if he is not.

Syntax:

.. code-block:: typoscript

   [adminUser = 0/1]


Example:

The following condition will apply only if the BE user is an admin.

.. code-block:: typoscript

   [adminUser = 1]
