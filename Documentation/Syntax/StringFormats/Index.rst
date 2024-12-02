:navigation-title: String formats
..  include:: /Includes.rst.txt
..  _data-types:
..  _data-types-reference:
..  _string-formats:

=========================
TypoScript string formats
=========================

The values assigned to properties in TypoScript are internally handled as
strings.

Some properties expect a certain format of string. These formats are described
in this chapter.

Enforcing these string formats is up to the implementation of the property using
them. They are therefore no real constructs of the TypoScript syntax.

..  contents::
    :local:

..  index:: Simple data types; boolean
..  _data-type-boolean:

boolean
=======

..  confval:: boolean
    :name: data-type-boolean

    Possible values for boolean variables are `1` and `0`
    meaning TRUE and FALSE.

    Everything else is `evaluated to one of these values by PHP`__:
    Non-empty strings (except `0` [zero]) are treated as TRUE,
    empty strings are evaluated to FALSE.

    __ https://www.php.net/manual/en/language.types.boolean.php

    ..  rubric:: Examples

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        dummy.enable = 0   # false, preferred notation
        dummy.enable = 1   # true,  preferred notation
        dummy.enable =     # false, because the value is empty

..  index:: Simple data types; date-conf
..  _data-type-date-conf:

date-conf
=========

..  confval:: date-conf
    :name: data-type-date-conf

    Used to format a date, see PHP function :php:`date()`. See the
    documentation of `allowed date time formats in
    PHP <https://www.php.net/manual/en/datetime.format.php>`__.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.date-conf = d-m-y


..  index:: Simple data types; function name
..  _data-type-function-name:

function name
=============

..  confval:: function name
    :name: data-type-function-name

    Indicates a function or method in a class to call. See more information at
    the :ref:`USER cObject <cobj-user>`.

    ..  rubric:: Examples

    Method name in a namespaced class:

    ..  code-block:: typoscript

        lib.someThing = USER_INT
        lib.someThing.userFunc = MyVendor\MyExtension\SomeNamespace\SomeClass->someFunction

    ..  literalinclude:: _FunctionName.php
        :language: php
        :caption: EXT:my_extension/Classes/SomeNamespace/SomeClass.php

..  index:: Simple data types; integer
..  _data-type-positive-integer:
..  _data-type-integer:

integer
=======

..  confval:: integer
    :name: data-type-integer

    ..  rubric:: Examples

    42, -8, -9, 0

    Positive integers expect to be greater or equal zero.


..  index:: Simple data types; path
..  _data-type-path:

path
====

..  confval:: path
    :name: data-type-path

    Path relative to the root directory from which we operate.
    Also resolves `EXT:` syntax.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.settings.somePath = fileadmin/stuff/


..  index:: Simple data types; resource
..  _data-type-resource:

resource
========

..  confval:: resource
    :name: data-type-resource

    If the value contains a "/", it is expected to be a reference (absolute or
    relative) to a file in the file system. There is no support for wildcard
    characters in the name of the reference.

    ..  rubric:: Example

    Reference to a file in the file system:

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       page.10.settings.someFile = fileadmin/picture.gif

..  index:: Simple data types; string
..  _data-type-string:

string
======

..  confval:: string
    :name: data-type-string

    Any property in TypoScript is a string technically. String can be defined
    in a single line or with multiple lines, using the
    :ref:`typoscript-syntax-syntax-multiline-values`.

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.value = The quick brown fox jumps over the lazy dog.

    ..  include:: /CodeSnippets/TypoScriptSyntax/OperatorUnset.rst.txt
