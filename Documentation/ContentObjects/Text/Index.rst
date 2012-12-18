.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-text:

TEXT
^^^^

The content object "TEXT" can be used to output static text or HTML.
Note that the stdWrap properties are not available under the property
"stdWrap" (as they are for the other cObjects), but on the very
rootlevel of the object. This is non-standard! Check the examples.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:


.. container:: table-row

   Property
         value

   Data type
         string /stdWrap

   Description
         Text, which you want to output.


.. container:: table-row

   Property
         *(stdWrap properties...)*

   Data type
         ->stdWrap


.. ###### END~OF~TABLE ######

[tsref:(cObject).TEXT]


Examples:
"""""""""

::

   10 = TEXT
   10.value = This is a text in uppercase
   10.case = upper

The above example uses the stdWrap property "case". It returns "THIS
IS A TEXT IN UPPERCASE".


::

   10 = TEXT
   10.field = title
   10.wrap = <strong>|</strong>

The above example gets the header of the current page (which is
stored in the database field "title"). The header is then wrapped in
<strong> tags, before it is returned.


::

Now let us have a look at an extract from a more complex example::

   10 = TEXT
   10.field = bodytext
   10.parseFunc < lib.parseFunc_RTE
   10.dataWrap = <div>|</div>

The above example returns the content, which was found in the field
"bodytext" of the current record from $cObj->data-array. Here that
shall be the current record from the database table tt_content. This
is useful inside COA objects.

Here is the same example in its context::

   10 = CONTENT
   10 {
     table = tt_content
     select {
       andWhere.dataWrap = irre_parentid  = {field:uid}
       begin = 0
     }

     renderObj = COA
     renderObj {
       stdWrap.if.isTrue.data = field:bodytext
       10 = TEXT
       10.field = bodytext
       10.parseFunc < lib.parseFunc_RTE
       10.dataWrap = <div>|</div>
      }
   }

Here we use the cObject CONTENT to return all content elements
(records from the database table "tt_content"), which are on the
current page. (These content elements have the corresponding value in
"irre_parentid".) They are rendered using a COA cObject, which only
processes them, if there is content in the field "bodytext".

The resulting records are each rendered using a TEXT object:

The TEXT object returns the content of the field "bodytext" of the
according tt_content record. (Note that the property "field" in this
context gets content from the table "**tt_content**" and not - as in
the example above - from "**pages**". See the description for the
data type "getText"/field!) The resulting content is then parsed with
parseFunc and finally wrapped in <div> tags before it is returned.


