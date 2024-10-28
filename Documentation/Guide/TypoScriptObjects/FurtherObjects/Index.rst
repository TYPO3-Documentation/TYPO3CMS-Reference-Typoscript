.. include:: /Includes.rst.txt


.. _guide-cobjects-further-cobjects:

===============
Further objects
===============

- :ref:`CASE <cobj-case>` allows case differentiation. In the core this
  object is used for rendering different content elements according to their
  type.

- :ref:`COA <cobj-coa>` (content object array) allows us to combine an
  arbitrary number of objects.

- :ref:`COA\_INT <cobj-coa-int>` is a COA object, but non-cached. This
  element will be regenerated upon each call. This is useful with time and date
  or user-dependent data, for example.

- :ref:`LOAD\_REGISTER <cobj-load-register>` /
  :ref:`RESTORE\_REGISTER <cobj-restore-register>` objects allow us to
  fill the global array `$GLOBALS['TSFE']->register[]` with content.
  These objects return nothing. Single values and complete TypoScript
  objects can be used. In doing so, the register works as a stack: With
  every call, a further element is stacked. With
  `RESTORE_REGISTER`, the element on top can be removed.
  Values in the register can be used with the
  :ref:`getText <data-type-gettext-register>` data type.

- :ref:`USER <cobj-user>` and USER\_INT are for user-defined functions.
  Every frontend plugin from a TYPO3 CMS extension is such an object.
  :ref:`USER\_INT <cobj-user-int>` is the non-cached variant.

- :ref:`IMG\_RESOURCE <cobj-img-resource>` is used by the
  :ref:`IMAGE <cobj-image>` object. The resource returned is
  normally the `src` attribute of the `<img>` tag.
  If images are scaled, this object serves as
  a calculation basis for the new files, which are stored in the
  :file:`_processed_` folder of each file storage.

- :ref:`GIFBUILDER <gifbuilder>` is used for generating image files
  dynamically. Various texts and images can be combined, and much more.
