..  include:: /Includes.rst.txt
..  index:: Simple data types
..  _data-types:
..  _data-types-reference:

=================
Simple data types
=================

The values assigned to properties in TypoScript are often of a
specific format. These formats are described in this chapter.

For example, if a value is defined as the type :typoscript:`<tag>`, HTML code has to be
supplied. If it is of the type :typoscript:`resource`, it's a reference to a file from
the resource-field in the template. If the type is :typoscript:`GraphicColor`, a
color-definition is expected and an HTML color code or comma-separated
RGB-values have to be provided.

The following is a list of available data types, their usage, purpose and
examples.

..  contents::
    :local:

..  index:: Simple data types; align
..  _data-type-align:

align
=====

..  confval:: align

    :Default: :typoscript:`left`
    :Allowed values: :typoscript:`left`, :typoscript:`center`, :typoscript:`right`

    Decides about alignment.


..  index:: Simple data types; boolean
..  _data-type-boolean:

boolean
=======

..  confval:: boolean

    Possible values for boolean variables are `1` and `0`
    meaning TRUE and FALSE.

    Everything else is `evaluated to one of these values by PHP`__:
    Non-empty strings (except `0` [zero]) are treated as TRUE,
    empty strings are evaluated to FALSE.

    __ https://www.php.net/manual/en/language.types.boolean.php

    ..  rubric:: Examples

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       dummy.enable = 0   # false, preferred notation
       dummy.enable = 1   # true,  preferred notation
       dummy.enable =     # false, because the value is empty


..  index:: Simple data types; case
..  _data-type-case:

case
====

..  confval:: case


    Do a case conversion.

    ..  rubric:: Possible values:

    ============================= ==========================================================
    Value                         Effect
    ============================= ==========================================================
    :typoscript:`upper`           Convert all letters of the string to upper case
    :typoscript:`lower`           Convert all letters of the string to lower case
    :typoscript:`capitalize`      Uppercase the first character of each word in the string
    :typoscript:`ucfirst`         Convert the first letter of the string to upper case
    :typoscript:`lcfirst`         Convert the first letter of the string to lower case
    :typoscript:`uppercamelcase`  Convert underscored `upper_camel_case` to `UpperCamelCase`
    :typoscript:`lowercamelcase`  Convert underscored `lower_camel_case` to `lowerCamelCase`
    ============================= ==========================================================

    ..  rubric:: Example

    Code:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = TEXT
        10.value = Hello world!
        10.case = upper

    Result:

    ..  code-block:: text
        :caption: Example Output

        HELLO WORLD!


..  index:: Simple data types; date-conf
..  _data-type-date-conf:

date-conf
=========

..  confval:: date-conf

    Used to format a date, see PHP function :php:`date()`. See the
    documentation of `allowed date time formats in
    PHP <https://www.php.net/manual/en/datetime.format.php>`__.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.date-conf = d-m-y


..  index:: Simple data types; degree
..  _data-type-degree:

degree
======

..  confval:: degree

    `-90` to `90`, integers

    Example: `45`


..  index:: Simple data types; dir
..  _data-type-dir:

dir
===

..  confval:: dir

    ..  rubric:: Syntax

    [path relative to the web root of the site] \| [list of valid
    extensions] \| [sorting: name, size, ext, date] \| [reverse: "r"] \|
    [return full path: boolean]


    Files matching are returned in a comma-separated string.

    ..  rubric:: Example

    This example returns a list of all pdf, gif and jpg-files from
    :file:`fileadmin/files/` sorted by their name reversely and with the full path (with
    :file:`fileadmin/files/` prepended):


    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.dir = fileadmin/files/ | pdf,gif,jpg | name | r | true


..  index:: Simple data types; function name
..  _data-type-function-name:

function name
=============

..  confval:: function name

    Indicates a function or method in a class to call. See more information at
    the :ref:`USER cObject <cobj-user>`.

    If no namespaces are used, then the class or function name, but not the method
    name, should probably be prefixed with :php:`user_`. The prefix can be
    changed in the :php:`$GLOBALS['TYPO3_CONF_VARS']` config though. The function
    / method is normally called with 2 parameters, :php:`$conf` which is the
    TypoScript configuration and :php:`$content`, some content to be processed and
    returned.

    ..  todo: Which entry in TYPO3_CONF_VARS enables the user-prefix to be changed? This
        should be mentioned. Looks like this entry has gone and this info no
        longer valid.

    If no namespaces are used and if a method in a class is called, it is checked (when using the
    :typoscript:`USER`/:typoscript:`USER_INT` objects) whether a class with the same name, but
    prefixed with :php:`ux_` is present and if so, *this* class is instantiated
    instead. See the document "Inside TYPO3" for more information on extending
    classes in TYPO3!

    ..  todo: Where is this feature mentioned? We should add a reference here.

    ..  rubric:: Examples

    Method in namespaced class. This is the preferred version:

    ..  code-block:: text

        Your\NameSpace\YourClass->reverseString

    Single Function:

    ..  code-block:: text

        user_reverseString

    Method in class without namespace:

    ..  code-block:: text

        user_yourClass->reverseString


..  index:: Simple data types; getText
..  _data-type-getText:

getText
=======

The getText data type is some kind of tool box allowing to retrieve
values from a variety of sources. Read more: :ref:`data-type-gettext`


..  index:: Simple data types; GraphicColor
..  _data-type-GraphicColor:

GraphicColor
============

..  confval:: GraphicColor

    ..  rubric:: Syntax:

    [colordef] : [modifier]

    Where modifier can be an integer which is added or subtracted to the three
    RGB-channels or a floating point with an :typoscript:`*` before, which will then
    multiply the values with that factor.


    The color can be given as HTML-color or as a comma-separated list of
    RGB-values (integers). An extra parameter can be given, that will modify the
    color mathematically:

    ..  rubric:: Examples

    *   :typoscript:`red` (HTML color)
    *   :typoscript:`#ffeecc` (HTML color as hexadecimal notation)
    *   :typoscript:`255,0,255` (HTML color as decimal notation)

    *Extra:*

    *   :typoscript:`red : *0.8` ("red" is darkened by factor 0.8)
    *   :typoscript:`#ffeecc : +16` ("ffeecc" is going to #fffedc because 16 is added)


..  index:: Simple data types; imageExtension
..  _data-type-imageExtension:

imageExtension
==============

..  confval:: imageExtension

    Image extensions can be anything among the allowed types defined in the
    global variable :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']`.
    Standard is pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

    The value **"web"** is special. This will ensure that an image is
    converted to a web image format (gif or jpg) if it happens not to be already!

    ..  rubric:: Examples

    jpg

    web *(gif or jpg ..)*


..  index:: Simple data types; imgResource
..  _data-type-imgResource:

imgResource
===========

..  todo: This seems to be a duplicate of Documentation/Functions/Imgresource.rst?

..  confval:: imgResource

    #.  A :confval:`resource` plus imgResource properties.

        Filetypes can be anything among the allowed types defined in the
        configuration variable
        :php:`$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']`.  Standard is
        pdf, gif, jpg, jpeg, tif, bmp, ai, pcx, tga, png.

    #.  A GIFBUILDER object. See the object reference for :ref:`gifbuilder`.

    ..  rubric:: Examples

    Here "file" is an imgResource:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = IMAGE
        10 {
            file = fileadmin/toplogo.gif
            file.width = 200
        }

    GIFBUILDER:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        10 = IMAGE
        10.file = GIFBUILDER
        10.file {
            # GIFBUILDER properties here...
        }


..  index:: Simple data types; integer
..  _data-type-integer:

integer
=======

..  confval:: integer

    ..  rubric:: Examples

    42, -8, -9, 0


    This data type is sometimes used generally though another type would have
    been more appropriate, like :ref:`pixels <data-type-pixels>`.


..  index:: Simple data types; path
..  _data-type-path:

path
====

..  confval:: path


    Path relative to the root directory from which we operate.
    Also resolves `EXT:` syntax.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.settings.somePath = fileadmin/stuff/


..  index:: Simple data types; pixels
..  _data-type-pixels:

pixels
======

..  confval:: pixels

    pixel-distance

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.someWidth = 345


..  index:: Simple data types; positive integer
..  _data-type-positive-integer:

positive integer
================

..  confval:: positive integer


    Positive :confval:`integer`.

    ..  rubric:: Examples

    42, 8, 9


..  index:: Simple data types; resource
..  _data-type-resource:

resource
========

..  confval:: resource

    If the value contains a "/", it is expected to be a reference (absolute or
    relative) to a file in the file system. There is no support for wildcard
    characters in the name of the reference.

    ..  rubric:: Example

    Reference to a file in the file system:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       page.10.settings.someFile = fileadmin/picture.gif

..  index:: Simple data types; strftime-conf
..  _data-type-strftime-conf:

strftime-conf
=============

..  confval:: strftime-conf

    See function `strftime on php.net <https://www.php.net/manual/en/function.strftime>`__.


..  index:: Simple data types; string
..  _data-type-string:

string
======

..  confval:: string


    Sometimes used generally though another type would have been more
    appropriate, like "align".

    ..  rubric:: Example

    The quick brown fox jumps over the lazy dog.


..  index:: Simple data types; tag
..  _data-type-tag:

tag
===

..  confval:: tag

    An HTML tag.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.settings.bodyTag = <body lang="de">


..  index:: Simple data types; tag-params
..  _data-type-tag-params:

tag-params
==========

..  confval:: tag-params

    Parameters for a tag.

    ..  rubric:: Examples

    For <frameset>-params:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.settings.someParams = border="0" framespacing="0"


..  index:: Simple data types; target
..  _data-type-target:

target
======

..  confval:: target

    ..  rubric:: Examples

    :typoscript:`_top`, :typoscript:`_blank`, :typoscript:`content`


    Target in an :html:`<a>`-tag.

    This is normally the same value as the name of the root-level object
    that defines the frame.


..  index:: Simple data types; wrap
..  _data-type-wrap:

wrap
====

..  confval:: wrap

    :Syntax: <...> \| </...>


    Used to wrap something. The vertical bar ("|") is the place, where
    your content will be inserted; the parts on the left and right of the
    vertical line are placed on the left and right side of the content.

    Spaces between the wrap-parts and the divider ("|") are trimmed off
    from each part of the wrap.

    If you want to use more sophisticated data functions, then you
    should use `stdWrap.dataWrap` instead of `wrap`.

    A `wrap` is processed and rendered as the last of the other components of
    a cObject.

    ..  rubric:: Examples

    This will cause the value to be wrapped in a p-tag coloring the
    value red:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.stdWrap.wrap = <p class="bg-red"> | </p>
