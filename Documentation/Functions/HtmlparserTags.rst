..  include:: /Includes.rst.txt
..  index::
    Functions; HTMLparser_tags
    HTMLparser_tags
..  _htmlparser-tags:

================
HTMLparser\_tags
================

..  contents::
    :local:

..  _htmlparser-tags-properties:

Properties
==========

..  _htmlparser-tags-overrideAttribs:

overrideAttribs
---------------

..  confval:: overrideAttribs
    :name: htmlparser-tags-overrideAttribs

    :Data type: :ref:`data-type-string`

    If set, this string is preset as the attributes of the tag.


..  _htmlparser-tags-allowedAttribs:

allowedAttribs
--------------

..  confval:: allowedAttribs
    :name: htmlparser-tags-allowedAttribs

    :Data type: mixed

    Defines the allowed attributes.

    Possible values:

    0
        No attributes allowed.

    (comma-separated list of attributes)
        Only attributes in this list are allowed.

    (blank/not set)
        All attributes are allowed.


..  _htmlparser-tags-fixAttrib-set:

fixAttrib.[attribute].set
-------------------------

..  confval:: fixAttrib.[attribute].set
    :name: htmlparser-tags-fixAttrib-set

    :Data type: :ref:`data-type-string`

    Force the attribute value to this value.


..  _htmlparser-tags-fixAttrib-unset:

fixAttrib.[attribute].unset
---------------------------

..  confval:: fixAttrib.[attribute].unset
    :name: htmlparser-tags-fixAttrib-unset

    :Data type: :ref:`data-type-boolean`

    If set, the attribute is unset.


..  _htmlparser-tags-fixAttrib-default:

fixAttrib.[attribute].default
-----------------------------

..  confval:: fixAttrib.[attribute].default
    :name: htmlparser-tags-fixAttrib-default

    :Data type: :ref:`data-type-string`

    If no attribute exists by this name, this value is set as default
    value (if this value is not blank)


..  _htmlparser-tags-fixAttrib-always:

fixAttrib.[attribute].always
----------------------------

..  confval:: fixAttrib.[attribute].always
    :name: htmlparser-tags-fixAttrib-always

    :Data type: :ref:`data-type-boolean`

    If set, the attribute is always processed. Normally an attribute is
    processed only if it exists


..  _htmlparser-tags-fixAttrib-trim:

fixAttrib.[attribute].trim
--------------------------

..  confval:: fixAttrib.[attribute].trim
    :name: htmlparser-tags-fixAttrib-trim

    :Data type: :ref:`data-type-boolean`

    If true, the value is passed through the
    respective PHP-function.


..  _htmlparser-tags-fixAttrib-intval:

fixAttrib.[attribute].intval
----------------------------

..  confval:: fixAttrib.[attribute].intval
    :name: htmlparser-tags-fixAttrib-intval

    :Data type: :ref:`data-type-boolean`

    If true, the value is passed through the
    respective PHP-function.


..  _htmlparser-tags-fixAttrib-upper:

fixAttrib.[attribute].upper
---------------------------

..  confval:: fixAttrib.[attribute].upper
    :name: htmlparser-tags-fixAttrib-upper

    :Data type: :ref:`data-type-boolean`

    If true, the value is passed through the PHP function
    `strtoupper() <https://www.php.net/manual/en/function.strtoupper.php>`__.


..  _htmlparser-tags-fixAttrib-lower:

fixAttrib.[attribute].lower
---------------------------

..  confval:: fixAttrib.[attribute].lower
    :name: htmlparser-tags-fixAttrib-lower

    :Data type: :ref:`data-type-boolean`

    If true, the value is passed through the PHP function
    `strtolower() <https://www.php.net/manual/en/function.strtolower.php>`__.


..  _htmlparser-tags-fixAttrib-range:

fixAttrib.[attribute].range
---------------------------

..  confval:: fixAttrib.[attribute].range
    :name: htmlparser-tags-fixAttrib-range

    :Data type: [low],[high]

    Setting integer range.


..  _htmlparser-tags-fixAttrib-list:

fixAttrib.[attribute].list
--------------------------

..  confval:: fixAttrib.[attribute].list
    :name: htmlparser-tags-fixAttrib-list

    :Data type: list of values, trimmed

    Attribute value must be in this list. If not, the value is set to the
    first element.


..  _htmlparser-tags-fixAttrib-removeIfFalse:

fixAttrib.[attribute].removeIfFalse
-----------------------------------

..  confval:: fixAttrib.[attribute].removeIfFalse
    :name: htmlparser-tags-fixAttrib-removeIfFalse

    :Data type: :ref:`data-type-boolean` / :typoscript:`blank` string

    If set, then the attribute is removed if it is false (= :typoscript:`0`).
    If this value is set to :typoscript:`blank` then the value must be a blank string
    (that means a "zero" value will not be removed).


..  _htmlparser-tags-fixAttrib-removeIfEquals:

fixAttrib.[attribute].removeIfEquals
------------------------------------

..  confval:: fixAttrib.[attribute].removeIfEquals
    :name: htmlparser-tags-fixAttrib-removeIfEquals

    :Data type: :ref:`data-type-string`

    If the attribute value matches the value set here, then it is removed.


..  _htmlparser-tags-fixAttrib-casesensitiveComp:

fixAttrib.[attribute].casesensitiveComp
---------------------------------------

..  confval:: fixAttrib.[attribute].casesensitiveComp
    :name: htmlparser-tags-fixAttrib-casesensitiveComp

    :Data type: :ref:`data-type-boolean`

    If set, the comparison in :ref:`htmlparser-tags-fixAttrib-removeIfEquals`
    and :ref:`htmlparser-tags-fixAttrib-list` will be case-sensitive.
    At this point, it's insensitive.


..  _htmlparser-tags-fixAttrib-prefixRelPathWith:

fixAttrib.[attribute].prefixRelPathWith
---------------------------------------

..  confval:: fixAttrib.[attribute].prefixRelPathWith
    :name: htmlparser-tags-fixAttrib-prefixRelPathWith

    :Data type: :ref:`data-type-string`

    If the value of the attribute seems to be a relative URL (no scheme
    like "http" and no "/" as first char) then the value of this property
    will be prefixed the attribute.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.parser.fixAttrib.src.prefixRelPathWith = https://example.org/typo3/32/dummy/


..  _htmlparser-tags-fixAttrib-userFunc:

fixAttrib.[attribute].userFunc
------------------------------

..  confval:: fixAttrib.[attribute].userFunc
    :name: htmlparser-tags-fixAttrib-userFunc

    :Data type: :ref:`data-type-function-name`

    User function for processing of the attribute. The return value
    of this function will be used as the new tag value.

    Example:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.parser.fixAttrib.href.userFunc = \Vendor\ExtName\ClassName->function

    Two parameters are passed to the function:

    1. The tag value as a string or an array containing the tag value
       and additional configuration (see below).
    2. The reference the to HtmlParser instance that calls the method.

    By default the first parameter is the value of the processed tag.
    This changes when you pass additional configuration options to the
    user function:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.parser.fixAttrib.href.userFunc.myCustomParm = myCustomValue

    In that case the first parameter passed to the user function will
    be an array containing these values:


..  _htmlparser-tags-protect:

protect
-------

..  confval:: protect
    :name: htmlparser-tags-protect

    :Data type: :ref:`data-type-boolean`

    If set, the tag :html:`<>` is converted to :html:`&lt;` and :html:`&gt;`


..  _htmlparser-tags-remap:

remap
-----

..  confval:: remap
    :name: htmlparser-tags-remap

    :Data type: :ref:`data-type-string`

    If set, the tagname is remapped to this tagname


..  _htmlparser-tags-rmTagIfNoAttrib:

rmTagIfNoAttrib
---------------

..  confval:: rmTagIfNoAttrib
    :name: htmlparser-tags-rmTagIfNoAttrib

    :Data type: :ref:`data-type-boolean`

    If set, then the tag is removed if no attributes happened to be there.


..  _htmlparser-tags-nesting:

nesting
-------

..  confval:: nesting
    :name: htmlparser-tags-nesting

    :Data type: mixed

    If set true, then this tag must have starting and ending tags in the
    correct order. Any tags not in this order will be discarded. Thus
    :html:`</B><B><I></B></I></B>` will be converted to :html:`<B><I></B></I>`.

    Is the value "global" then true nesting in relation to other tags
    marked for "global" nesting control is preserved. This means that if
    :html:`<B>` and :html:`<I>` are set for global nesting then this string
    :html:`</B><B><I></B></I></B>` is converted to :html:`<B></B>`
