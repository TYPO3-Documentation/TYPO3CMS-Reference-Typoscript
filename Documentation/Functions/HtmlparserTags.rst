.. include:: /Includes.rst.txt
.. index::
   Functions; HTMLparser_tags
   HTMLparser_tags
.. _htmlparser-tags:

================
HTMLparser\_tags
================

.. contents::
   :local:

Properties
==========

overrideAttribs
---------------

..  t3-function-htmlparser-tags:: overrideAttribs

    :Data type: :t3-data-type:`string`

    If set, this string is preset as the attributes of the tag.

allowedAttribs
--------------

..  t3-function-htmlparser-tags:: allowedAttribs

    :Data type: mixed

    Defines the allowed attributes.

    Possible values:

    0
        No attributes allowed.

    (comma-separated list of attributes)
        Only attributes in this list are allowed.

    (blank/not set)
        All attributes are allowed.

fixAttrib.[attribute].set
-------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].set

    :Data type: :t3-data-type:`string`

    Force the attribute value to this value.

fixAttrib.[attribute].unset
---------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].unset

    :Data type: :t3-data-type:`boolean`

    If set, the attribute is unset.

fixAttrib.[attribute].default
-----------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].default

    :Data type: :t3-data-type:`string`

    If no attribute exists by this name, this value is set as default
    value (if this value is not blank)

fixAttrib.[attribute].always
----------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].always

    :Data type: :t3-data-type:`boolean`

    If set, the attribute is always processed. Normally an attribute is
    processed only if it exists

fixAttrib.[attribute].trim
--------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].trim

    :Data type: :t3-data-type:`boolean`

    If true, the value is passed through the
    respective PHP-function.

fixAttrib.[attribute].intval
----------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].intval

    :Data type: :t3-data-type:`boolean`

    If true, the value is passed through the
    respective PHP-function.

fixAttrib.[attribute].upper
---------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].upper

    :Data type: :t3-data-type:`boolean`

    If true, the value is passed through the
    respective PHP-function.

    .. TODO: There is not such PHP function, probably strtoupper?

fixAttrib.[attribute].lower
---------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].lower

    :Data type: :t3-data-type:`boolean`

    If true, the value is passed through the
    respective PHP-function.

    .. TODO: There is not such PHP function, probably strtolower?

fixAttrib.[attribute].range
---------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].range

    :Data type: [low],[high]

    Setting integer range.

fixAttrib.[attribute].list
--------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].list

    :Data type: list of values, trimmed

    Attribute value must be in this list. If not, the value is set to the
    first element.

fixAttrib.[attribute].removeIfFalse
-----------------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].removeIfFalse

    :Data type: :t3-data-type:`boolean` / :typoscript:`blank` string

    If set, then the attribute is removed if it is false (= :typoscript:`0`).
    If this value is set to :typoscript:`blank` then the value must be a blank string
    (that means a "zero" value will not be removed).

fixAttrib.[attribute].removeIfEquals
------------------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].removeIfEquals

    :Data type: :t3-data-type:`string`

    If the attribute value matches the value set here, then it is removed.

fixAttrib.[attribute].casesensitiveComp
---------------------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].casesensitiveComp

    :Data type: :t3-data-type:`boolean`

    If set, the comparison in :t3-function-htmlparser-tags:`fixAttrib.[attribute].removeIfEquals`
    and :t3-function-htmlparser-tags:`fixAttrib.[attribute].list` will be case-sensitive.
    At this point, it's insensitive.

fixAttrib.[attribute].prefixRelPathWith
---------------------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].prefixRelPathWith

    :Data type: :t3-data-type:`string`

    If the value of the attribute seems to be a relative URL (no scheme
    like "http" and no "/" as first char) then the value of this property
    will be prefixed the attribute.

:aspect:`Example`
    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        lib.parser.fixAttrib.src.prefixRelPathWith = https://example.org/typo3/32/dummy/

fixAttrib.[attribute].userFunc
------------------------------

..  t3-function-htmlparser-tags:: fixAttrib.[attribute].userFunc

    :Data type: :t3-data-type:`function name`

    User function for processing of the attribute. The return value
    of this function will be used as the new tag value.

:aspect:`Example`
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

protect
-------

..  t3-function-htmlparser-tags:: protect

    :Data type: :t3-data-type:`boolean`

    If set, the tag :html:`<>` is converted to :html:`&lt;` and :html:`&gt;`

remap
-----

..  t3-function-htmlparser-tags:: remap

    :Data type: :t3-data-type:`string`

    If set, the tagname is remapped to this tagname

rmTagIfNoAttrib
---------------

..  t3-function-htmlparser-tags:: rmTagIfNoAttrib

    :Data type: :t3-data-type:`boolean`

    If set, then the tag is removed if no attributes happened to be there.

nesting
-------

..  t3-function-htmlparser-tags:: nesting

    :Data type: mixed

    If set true, then this tag must have starting and ending tags in the
    correct order. Any tags not in this order will be discarded. Thus
    :html:`</B><B><I></B></I></B>` will be converted to :html:`<B><I></B></I>`.

    Is the value "global" then true nesting in relation to other tags
    marked for "global" nesting control is preserved. This means that if
    :html:`<B>` and :html:`<I>` are set for global nesting then this string
    :html:`</B><B><I></B></I></B>` is converted to :html:`<B></B>`
