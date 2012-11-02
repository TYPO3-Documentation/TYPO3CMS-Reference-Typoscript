.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-shopping-basket:

Using the built in "shopping basket"
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TYPO3 features a shopping basket for the session-data.

When you submit data from forms (or by querystring) (post/get-method)
in the array "recs" it's stored in the session-data under the key
recs.

The syntax is like this::

   recs[table_name][uid_of_record]


Example:
""""""""

This form-element will change the registered value of record with
uid=345 from the "tt\_products" table in typo3. Please note, that the
record itself is NOT in any way modified, only the "counter" in the
session-data indicating the "number of items" from the table is
modified. ::

   <input name="recs[tt_products][345]">

Note on checkboxes:

When you are creating forms with checkboxes, the value of the checkbox
is sent by MSIE/Netscape ONLY if the checkbox is checked! If you want
a value sent in case of a disabled checkbox, include a hidden
formfield of the same name just before the checkbox!


Example:
""""""""

::

   <input type="hidden" name="recs[tt_content][345]" value="0">
   <input type="checkbox" name="recs[tt_content][345]" value="1">


**Clearing the "basket"**
"""""""""""""""""""""""""

This will clear the basket::

    <input type="hidden" name="recs[clear_all]" value="1">

