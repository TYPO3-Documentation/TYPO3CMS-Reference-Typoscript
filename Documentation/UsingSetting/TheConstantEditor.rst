.. include:: /Includes.rst.txt
.. _typoscript-syntax-constant-editor:
.. _constant-editor:

===================
The constant editor
===================

It's possible to add comments in TypoScript. Comments are always ignored by the
parser when the template is processed. But the backend module **WEB > Template**
has the ability to use comments in the constant editor to make simple
configuration of a template even easier than constants already make it
themselves.

.. include:: /Images/AutomaticScreenshots/TemplatesConstantEditor.rst.txt

When the "Constant Editor" parses the template, *all* comments before every
constant-definition are registered.  A certain syntax is available to define
what category the constant should be in, which type it has and to provide a
description for the constant.

.. code-block:: typoscript

   styles.content {
      # cat=content/cHeader/h0; type=int[1-5]; label=Default Header type: Enter the number of the header layout to be used by default
      defaultHeaderType = 2

      # cat=content/cShortcut/t0; type=string; label=List of accepted tables
      shortcut.tables = tt_content

      # cat=content/cTextmedia/i1; type=color; label= Media element border, color: Bordercolor of media elements in content elements when "Border"-option for an element is set
      textmedia.borderColor = #000000

      color1 =
      color2 = blue
      properties =
   }

In the above example, three constants have syntactically correct comments
and will appear in the "Constant Editor". The other three will not. The
syntax is described in the rest of this chapter.

Making most important constants available for the "Constant Editor" is a real
usability gain.


.. _typoscript-syntax-constant-editor-default-values:

Default values
==============

A constant may be given a default value when it is defined, as is the case for
the :ts:`color2` constant in the above example.

More generally, the default value of a constant is determined by the value the
constant has before the last template is parsed.

.. _typoscript-syntax-constant-editor-keys:
.. _typoscript-syntax-constant-editor-comments:

Comment Syntax
==============

How the comments are perceived by the module:

- The comment line before the constant is considered to contain
  its definition.

- Each line is split at the :code:`;` (semicolon) character, that separates
  the various parameters

- Each parameter is split at the :code:`=` (equal) sign to separate the
  parameter's key and value.

The possible keys are described below.

.. _typoscript-syntax-constant-editor-keys-cat:

cat
===

- Comma-separated list of the categories (case-insensitive) that the constant is
  a member of. Only one category should be used, because it usually turns out to
  be confusing for users, if the same constant appears in multiple categories.

- If the chosen category is *not* found among the default categories listed
  below, and is not a custom category either, it's regarded a new category.

- If the category is empty (""), the constant is excluded from the editor.

.. _typoscript-syntax-constant-editor-keys-cat-predefined-categories:

Predefined categories
---------------------

=========  ======================================================================
Category   Description
=========  ======================================================================
basic      Constants of superior importance for the template. This is typically
           dimensions, image files and enabling of various features. The most
           basic constants, which would almost always needed to be configured.
menu       Menu setup. This includes font files, sizes, background images.
           Depending on the menu type.
content    All constants related to the display of page content elements.
page       General configuration like meta tags, link targets.
advanced   Advanced functions, which are seldom used.
=========  ======================================================================

.. _typoscript-syntax-constant-editor-keys-cat-custom-categories:

Custom categories
-----------------

To define a new category, a comment including the parameter :ts:`customcategory`
has to be added. Example::

   # customcategory=mysite=LLL:EXT:myext/locallang.xlf:mysite

This line defines the new category "mysite" which will be available for any
constant defined **after** this line. The :ts:`LLL:` reference points to the
localized string used to "name" the custom category in the Constant Editor.
Usage example::

   #cat=mysite//a; type=boolean; label=Global no_cache
   config.no_cache = 0

.. _typoscript-syntax-constant-editor-keys-cat-subcategories:

Subcategories
-------------

There are a number of subcategories one can use. Subcategories are entered
after the category separated by a slash :ts:`/`. Example::

   "basic/color/a"

This will make the constant go into the "BASIC" category and be listed
under the "COLOR" section.

One of the predefined subcategories can be used or any custom subcategory. If a
non-existing subcategory us used, the constant will go into the subcategory
"Other".

.. _typoscript-syntax-constant-editor-keys-cat-predefined-subcategories:

Predefined subcategories
------------------------

Standard subcategories (in the order they get listed in the Constant
Editor):

===========  ========================================================================
Subcategory  Description
===========  ========================================================================
enable       Used for options that enable or disable primary functions of a
             template.
dims         Dimensions of all kinds; pixels, widths, heights of images, frames,
             cells and so on.
file         Files like background images, fonts and so on. Other options related
             to the file may also enter.
typo         Typography and related constants.
color        Color setup. Many colors will be found with related options in other
             categories though.
links        Links: Targets typically.
language     Language specific options.
===========  ========================================================================

There also exists a list of subcategories based on the default content elements:

cheader, cheader\_g, ctext, cimage, ctextmedia, cbullets, ctable, cuploads,
cmultimedia, cmedia, cmailform, csearch, clogin, cmenu, cshortcut, clist,
chtml

These are all categories reserved for options that relate to content
rendering for each type of :ts:`tt_content` element. See the
`static template <https://github.com/TYPO3/TYPO3.CMS/blob/master/typo3/sysext/fluid_styled_content/Configuration/TypoScript/constants.typoscript>`__
of extension "fluid\_styled\_content" for examples.

.. _typoscript-syntax-constant-editor-keys-cat-custom-subcategories:

Custom subcategories
--------------------

Defining a custom subcategory is similar to defining a custom category,
using the :ts:`customsubcategory` parameter. Example::

   # customsubcategory=cache=LLL:EXT:myext/locallang.xlf:cache

Usage example::

   #cat=mysite/cache/a; type=boolean; label=Global no_cache
   config.no_cache = 0

Will look in the Constant Editor like this:

.. figure:: /Images/ManualScreenshots/Templates/CustomSubcategory.png
   :alt: The Constant Editor showing a custom category.


.. _typoscript-syntax-constant-editor-keys-cat-constants-ordering:

Ordering
--------

The third part of the category definition is optional and represents
the order in which the constants are displayed in the Constant Editor.
The values are sorted alphabetically, so it is traditional to use letters.
Example:

.. code-block:: typoscript

   #cat=mysite/cache/b; type=boolean; label=Special cache
   config.no_cache = 0
   #cat=mysite/cache/a; type=boolean; label=Global no_cache
   config.no_cache = 0

The "Special cache" constant will be displayed after the "Global no_cache"
constant, because it is ranked with letter "b" and the other constant
has letter "a". Constants without any ordering information will come last.


.. _typoscript-syntax-constant-editor-keys-type:

type
====

There exists a number of predefined types, which define what kind of field is
rendered for inputting the constant.

===========================  ============================================================================
Type                         Description
===========================  ============================================================================
int [low-high]               Integer, optional in range "low" to "high".

int+                         Positive integer

offset [L1,L2,...L6]         Comma-separated list of integers. Default is "x,y", but as comma separated
                             parameters in brackets one can specify up to 6 labels being comma separated.
                             If wished to omit one of the last 4 fields, leave the label empty
                             for that element.

color                        HTML color

wrap                         HTML code that is wrapped around some content.

options [item1,item2,...]    Selectbox with values/labels item1, item2 etc. Comma-separated. Split
                             by "=" also and in that case, first part is label, second is value.

boolean [truevalue]          Boolean, optional can define the value of "true", default is 1.

comment                      Boolean, checked= "", not-checked = "#".

string (the default)         A string value

user                         Path to the file and method which renders the option HTML,
                             for example :ts:`type=user[Vendor\Extension\Namespace\ClassName->myCustomField]`.
                             The method should have following signature:
                             :php:`public function myCustomField(array $params)`.
===========================  ============================================================================


.. _typoscript-syntax-constant-editor-keys-label:

label
=====

The label is a trimmed text string. It gets split on the first :ts:`:` (colon)
to separate header and body of the comment. The header is displayed on its own
line in bold.

The string can be localized by using the traditional "LLL" syntax. Example::

   #cat=Site conf/cache/a; type=boolean; label=LLL:EXT:examples/locallang.xlf:config.no_cache
   config.no_cache = 0

Only a single string is referenced, not one for the header and one for the
description. This means that the localized string must contain the colon
separator (:code:`:`). Example:

.. code-block:: xml

   <trans-unit id="config.no_cache" xml:space="preserve">
       <source>Global no_cache: Check the box to turn off all caches.</source>
   </trans-unit>
