..  include:: /Includes.rst.txt
..  index:: Functions; replacement
..  _replacement:

===========
replacement
===========

This object performs an ordered search and replace operation on the
current content with the possibility of using `PCRE regular expressions`_.
An array with numeric indices defines the order of actions and thus
allows multiple replacements at once.

..  _PCRE regular expressions: https://www.php.net/manual/en/reference.pcre.pattern.syntax.php

..  contents::
    :local:

..  index:: replacement; Properties
..  _replacement-properties:

Properties
==========


..  _replacement-search:

search
------

..  confval:: search
    :name: replacement-search
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    Defines the string that shall be replaced.


..  _replacement-replace:

replace
-------

..  confval:: replace
    :name: replacement-replace
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    Defines the string to be used for the replacement.


..  _replacement-useRegExp:

useRegExp
---------

..  confval:: useRegExp
    :name: replacement-useRegExp
    :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    Defines that the search and replace strings are considered as PCRE
    regular expressions.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_useRegExp.typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript


..  _replacement-useOptionSplitReplace:

useOptionSplitReplace
---------------------

..  confval:: useOptionSplitReplace
    :name: replacement-useOptionSplitReplace
    :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    This property allows to use :ref:`optionSplit <optionsplit>` for the replace
    property. That way the replace property can be different depending on the
    occurrence of the string (first/middle/last part, ...). This works for
    both normal and regular expression replacements. For examples see below.

Examples
========

..  literalinclude:: _codesnippets/_useOptionSplitReplace3.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

This returns: "There are an animal, an animal and an animal around the
block! Yeah!".

The following examples demonstrate the use of :ref:`optionSplit <optionsplit>`:

..  literalinclude:: _codesnippets/_useOptionSplitReplace2.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

This returns: "There1are2a3cat,3a3dog3and3a3tiger3in3da3hood!3Yeah!"

..  literalinclude:: _codesnippets/_useOptionSplitReplace.typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

This returns: "There are a tiny cat, a midsized dog and a big tiger in da hood! Yeah!"
