.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


General information
^^^^^^^^^^^^^^^^^^^


Case sensitivity
""""""""""""""""

All names and references in TypoScript are  **case sensitive!** This
is very important to notice. That means that::

   myObject = TEXT
   myObject.value = <strong>Some HTML code</strong>

is not the same as ::

   myObject = text
   myObject.Value = <strong>Some HTML code</strong>

While the first will be recognized as the content-object "TEXT" and
will produce the desired output, the latter will not be recognized and
will not output anything. Even if you wrote "TEXT" in uppercase in the
second example, it would still not work, because the property "value"
is misspelled.

Always remember: In this manual the case of objects is important.


Version numbers
"""""""""""""""

For new features TSref includes a note in which TYPO3 version the
feature was added. If such a note is missing, the feature is part of
TYPO3 since version 4.5 at least.

