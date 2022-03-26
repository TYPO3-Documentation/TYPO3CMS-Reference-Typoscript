.. include:: /Includes.rst.txt


.. _glossary:
.. _objects-and-properties:
.. _objects-referencing:

========
Glossary
========

We use the terms as explained in :ref:`TypoScript Syntax <t3coreapi:typoscript-syntax-introduction>`,
with some modifications:

The section :ref:`t3coreapi:typoscript-syntax-object-paths` differentiates between Object paths, Objects,
properties and values.

To reuse the OOP analogy and compare with PHP:

+------------------------+------------------------+
|TypoScript Templates    | PHP classes            |
+========================+========================+
| **property**           | property               |
+------------------------+------------------------+
| **object**             | object                 |
| (is defined by /       | (is defined by /       |
| is an instantiation of | is an instantiation of |
| an object type)        | a class)               |
+------------------------+------------------------+
| **object type**        | class                  |
| = complex data type    |                        |
+------------------------+------------------------+
| **simple datatype**    | PHP primitive data type|
+------------------------+------------------------+
| text = TEXT            | $text = new Text()     |
+------------------------+------------------------+

Example 1 (assign value to property in object1::

   object1 = OBJECTTYPE1
   object1 {
      property = value
   }


Example 2::

   # here, object1 is defined as type OBJECTTYPE1
   #   "OBJECTTYPE1" is an object type, so is OTHER
   object1 = OBJECTTYPE1
   object1 {
      object2 = OTHER
      object2 {
         property = value
      }
   }

Note: OBJECTTYPE1 and OTHER are not real object types (as used in TypoScript) and are used here only to
illustrate the example.

Whenever you see *->[object name]* in the tables it means that the
property is an object "*object name*" with properties from object
*object name*. You don't need to define the object type. You will
often find the according documentation on its own page.

Variable:
   Is anything on the left side of an assignment, e.g. in Example 1,
   the variable is `property`, the full variable path is `object.property`.
   The variable can be a property with a simple datatype or an "object type".

Property:
   (= simple variable) A variable with a simple data type. The terms "object"
   and "property" are mutually exclusive. "Object" and "property" are both
   "variables".

"Object":
   In the context of TypoScript templates, objects are complex variables and
   have a complex data type. They contain one or more variables.

Value:
   The right side of the assignment. It must be of the correct data type.

Data type
   Variables usually have a fixed data type. It may be a **simple data type**
   (such as a string) or it may be a **complex data type** (= **Object Type**).

Simple data type
    != Complex data type. If a variable has a simple data type, it cannot be
    assigned an object. Hence, it is a property.

Object type
   = **complex data type**. If a variable is an object and thus
   has a complex data type, it will contain several variables.
   In example 2 above, `object1` has a complex data type, as does
   `object2`, but not `property`. Complex data types are usually
   spelled in full caps, e.g. CONTENT, TEXT, PAGE etc. The exception
   is the abstract complex data type `cObject` from which the data
   type CONTENT, TEXT etc. are derived.

Object path:
   The full path of an object. In the example above `object1.object2`
   is an object path

Variable path
   The full path of a variable. In the example above
   `object1.object2.property` is a variable path.

cObject data type
   This is an (abstract) complex data type. Specific cObject data types,
   such as TEXT, IMAGE etc. are all cObject data types. They are usually
   used for content elements.

Top level objects
   As described in :ref:`t3coreapi:typoscript-syntax-introduction`
   TypoScript templates are converted into a multidimensional PHP array.
   You can view this in the TypoScript object browser. Top level
   objects are located on the top level. Top level objects are for
   example `config`, `page` and `plugin`.


