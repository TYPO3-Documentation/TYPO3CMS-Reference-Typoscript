..  include:: /Includes.rst.txt
..  index:: Functions; round
..  _round:

=====
round
=====

With this property you can round the value up, down or to a certain
number of decimals. For each roundType the according PHP function will
be used.

The value will be converted to a float value before applying the
selected round method.

..  contents::
    :local:

..  index:: round; Properties
..  _round-properties:

Properties
==========

..  _round-roundType:

roundType
---------

..  confval:: roundType
    :name: round-roundType

    :Data type: :ref:`data-type-string` / :ref:`stdwrap`
    :Default: round

    Round method which should be used.

    Possible keywords:

    ceil
        Round the value up to the next integer.

    floor
        Round the value down to the previous integer.

    round
        Round the value to the specified number of decimals.


..  _round-decimals:

decimals
--------

..  confval:: decimals
    :name: round-decimals

    :Data type: :ref:`data-type-integer` / :ref:`stdwrap`
    :Default: 0

    Number of decimals the rounded value will have. Only used with the
    roundType "round". Defaults to 0, so that your input will in that case
    be rounded up or down to the next integer.


..  _round-round:

round
-----

..  confval:: round
    :name: round-round

    :Data type: :ref:`data-type-boolean`
    :Default: 0

    Set round = 1 to enable rounding.

..  _round-examples:

Examples
========

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.number = TEXT
    lib.number {
        value = 3.14159
        stdWrap.round = 1
        stdWrap.round.roundType = round
        stdWrap.round.decimals = 2
    }

This returns :code:`3.14`.
