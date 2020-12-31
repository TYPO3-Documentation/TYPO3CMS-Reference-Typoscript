.. include:: /Includes.txt
.. _CommaSeparatedValueProcessor:

============================
CommaSeparatedValueProcessor
============================

The :php:`CommaSeparatedValueProcessor` allows to split values into a two-
dimensional array used for CSV files or tt_content records of CType
"table".

The table data is transformed to a multi dimensional array, taking the delimiter and enclosure into account,
before it is passed to the view.


Options:
========

.. rst-class:: dl-parameters

if
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` :ref:`if` condition
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   If the condition is not met the data is not processed

fieldName
   :sep:`|` :aspect:`Required:` true
   :sep:`|` :aspect:`Type:` string, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` ''
   :sep:`|`

   Name of the field in the processed ContentObjectRenderer

as
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string
   :sep:`|` :aspect:`Default:` defaults to the fieldName
   :sep:`|`

   Name the variable in the Fluid template will have

maximumColumns
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` int, :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` 0
   :sep:`|`

   Maximal number of columns to be transformed. Excess columns will be
   silently dropped. When set to 0 (default) all columns will be
   transformed.

fieldDelimiter
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string(1), :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` ','
   :sep:`|`

   The field delimiter, a character separating the values.

fieldEnclosure
   :sep:`|` :aspect:`Required:` false
   :sep:`|` :aspect:`Type:` string(1), :ref:`stdWrap`
   :sep:`|` :aspect:`Default:` '"'
   :sep:`|`

   The field enclosure, a character surrounding the values.

.. note:: It is currently not possible to unset the fieldEnclosure.
   See: `Issue 93190 <https://forge.typo3.org/issues/93190>`__


Example: Transforming the content of CType "table" into an array
=================================================================

An example of such a field is "bodytext" in the CType "table".

Example field data:
-------------------

Field :php:`bodytext` in table :php:`tt_content`::

   This is row 1 column 1|This is row 1 column 2|This is row 1 column 3
   This is row 2 column 1|This is row 2 column 2|This is row 2 column 3
   This is row 3 column 1|This is row 3 column 2|This is row 3 column 3


TypoScript
----------

Using the :php:`CommaSeparatedValueProcessor` the following scenario is
possible::

   page {
      10 = FLUIDTEMPLATE
      10 {
         file = EXT:site_default/Resources/Private/Template/Default.html
         dataProcessing.4 = TYPO3\CMS\Frontend\DataProcessing\CommaSeparatedValueProcessor
         dataProcessing.4 {
            if.isTrue.field = bodytext
            fieldName = bodytext
            fieldDelimiter = |
            fieldEnclosure =
            maximumColumns = 2
            as = myContentTable
         }
      }
   }


Fluid template
--------------

In the Fluid template you can iterate over the processed data. "myContentTable" can
be used as a variable :html:`{myContentTable}` inside Fluid for iteration.

.. code-block:: html

   <table>
      <f:for each="{myContentTable}" as="columns">
         <tr>
            <f:for each="{columns}" as="column">
               <td>{column}</td>
            </f:for>
         <tr>
      </f:for>
   </table>

Using maximumColumns limits the amount of columns in the multi dimensional array.
In this example, the field data of the last column will be stripped off. Therefore the output would be:

.. code-block:: html

   <table>
      <tr>
         <td>This is row 1 column 1</td>
         <td>This is row 1 column 2</td>
      <tr>
      <tr>
         <td>This is row 2 column 1</td>
         <td>This is row 2 column 2</td>
      <tr>
      <tr>
         <td>This is row 3 column 1</td>
         <td>This is row 3 column 2</td>
      <tr>
   </table>
