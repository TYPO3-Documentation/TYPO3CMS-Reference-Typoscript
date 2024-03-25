..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; WORKAREA
..  _gifbuilder-workarea:

========
WORKAREA
========

Sets another work area.

..  _gifbuilder-workarea-properties:

Properties
==========

..  contents::
    :local:

..  _gifbuilder-workarea-clear:

clear
-----

..  confval:: clear
    :name: gifbuilder-workarea-clear

    :Data type: string

    Sets the current work area to the default work area.

    The value is checked for using :php:`isset()`: If :php:`isset()` returns
    :php:`true`, the work area is cleared, otherwise it is not.


..  _gifbuilder-workarea-set:

set
---

..  confval:: set
    :name: gifbuilder-workarea-set

    :Data type: x,y,w,h :ref:`+calc <gifbuilder-calc>` / :ref:`stdWrap <stdwrap>`

    Sets the dimensions of the work area.

    x,y is the offset.

    w,h are the dimensions.
