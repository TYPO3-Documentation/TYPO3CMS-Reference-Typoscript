.. include:: ../Includes.txt


.. _typoscript-syntax-what-are-constants:
.. _typoscript-syntax-constants:

Constants
=========

Constants are values defined in the "Constants" field of a template.  They
follow the :ref:`syntax of ordinary TypoScript
<t3coreapi:typoscript-syntax-syntax>` and are case sensitive! They are used to
manage *in a single place* values, which are later used in *several places*.

Defining constants
------------------

Other than constants in programming languages, values of constants in TypoScript
can be overwritten. Constants in TypoScript can more be seen as variables in
programming languages.

**Reserved name**

The object or property "file" is always interpreted as data type ":ref:`resource
<data-type-resource>`". That means it refers to a file, which has to be uploaded
in the TYPO3 CMS installation.

**Multi-line values: The ( ) signs**

Constants do not support multiline values!

You can use environment variables to provide instance specific values to your constants.
Refer to :ref:`getEnv <getenv>` for further information.

Example
"""""""

Here :ts:`bgCol` is set to "red", :ts:`file.toplogo` is set to
:file:`fileadmin/logo.gif` and :ts:`topimg.file.pic2` is set to
:file:`fileadmin/logo2.gif`, assuming these files are indeed available at the
expected location.

.. code-block:: typoscript
   :emphasize-lines: 2,7

   bgCol = red
   file {
       toplogo = fileadmin/logo.gif
   }
   topimg {
       width = 200
       file.pic2 = fileadmin/logo2.gif
   }

The objects in the highlighted lines contain the reserved word "file" and the
properties are always of data type ":ref:`resource <data-type-resource>`".

.. _typoscript-syntax-using-constants:

Using constants
---------------

When a TypoScript Template is parsed by TYPO3 CMS, constants are replaced, as
one would perform any ordinary string replacement. Constants are used in the
"Setup" field by placing them inside curly braces and prepending them with a
:ts:`$` sign:

.. code-block:: typoscript

   {$bgCol}
   {$topimg.width}
   {$topimg.file.pic2}
   {$file.toplogo}

Only constants, which are actually defined in the "Constants" field, are
substituted.

Constants in included templates are also substituted, as the whole
template is one large chunk of text.

A systematic naming scheme should be used for constants. As "paths" can be
defined, it's also possible to structure constants and prefix them with a common
path segment. This makes reading and finding of constants easier.

Example
"""""""

.. code-block:: typoscript

   page = PAGE
   page {
       typeNum = 0
       bodyTag = <body bgColor="{$bgCol}">
       10 = IMAGE
       10.file = {$file.toplogo}
   }

For the above example to work, the constants from the last example have to be
defined in the constants field.

.. figure:: ../Images/TemplatesSetup.png
   :alt: Overview of the defined setup

Constants in the setup code are substituted, marked in green. In the Object
Browser, it's possible to show constants substituted and unsubstituted.

The "Display constants" function is not available if "Crop lines" is selected.
