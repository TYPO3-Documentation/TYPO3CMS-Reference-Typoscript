
.. index:: Conditions
.. _conditions:
.. _condition-references:

==========
Conditions
==========

It is possible to use TypoScript :ref:`conditions <t3coreapi:typoscript-syntax-conditions>`
in both User TSconfig and Page TSconfig, just as it is done in TypoScript for templates.

For a general discussion about TypoScript conditions, please refer to
:ref:`TypoScript Syntax Study <t3coreapi:typoscript-syntax-conditions>` of the core API document.

For a list of available conditions, please refer to the
:ref:`TypoScript Reference <t3tsref:condition-reference>`.


.. _conditions-example:

Examples
========

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

	[tree.level == 1]
	TCEFORM.tt_content.section_frame.disabled = 1
	[GLOBAL]

The above TSconfig will hide the "section\_frame" field of content
elements only on the first level of the page tree.


.. index:: Conditions; Difference to TypoScript templates
.. _condition-differences:

Differences to conditions in TypoScript templates
=================================================

There are some slight differences between conditions in TSconfig and
conditions in TypoScript templates, which must be taken into account:

- The values of ``frontend.user`` will not be available, because they
  are limited to frontend context.

- The function "getTSFE()" will not work because the
  TSFE global object only exists in the FE context.

- Accessing TypoScript constants inside a condition like
  ``[{$myTypoScriptConstant} == '1']`` will not work either as they
  are not available in the BE context.

- Note that the values in the tree object like ``tree.rootLineParentIds``
  and ``tree.level`` will
  apply correctly to pages that are being created but are not yet saved.

- You *can* still use custom conditions. For doing so, look up the page
  :ref:`Symfony Expression Language <t3coreapi:symfony-expression-language>` on how to register
  custom conditions.

Furthermore, you can access the current backend user inside a TSConfig condition:

.. index:: Conditions; Access backend user
.. _condition-backend-user:

backend.user
------------

Check whether the current BE user has the uid 5:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   [backend.user.userId == 5]

The following condition will apply only if the BE user is an admin:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/page.tsconfig

   [backend.user.isAdmin]

.. todo: Does this still work with the changed Conditions syntax?
