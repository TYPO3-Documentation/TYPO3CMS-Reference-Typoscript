:navigation-title: Calc

..  include:: /Includes.rst.txt
..  index:: Functions; Calc

..  _objects-calc:
..  _calc:

==========================
Calculating values (+calc)
==========================

Sometimes a data type is set to ``someType +calc``. The ``+calc`` indicates
that the value is calculated with ``+-/\*`` operators. *Be aware that the
operators have no "weight".* The calculation is done from left to
right instead of order of operations (multiplication and division before addition and subtraction).


..  _objects-calc-calculating-values-calc-value-calculated:

How value is calculated
=======================

..  code-block:: none

    45 + 34 * 2 = 158
    (which is the same as this in ordinary arithmetic: (45+34)*2=158)


..  _objects-calc-calculating-values-calc-calc-usage-example:

calc usage example
==================

The :typoscript:`HMENU` :typoscript:`maxAge` property is of a type
:typoscript:`integer +calc`, it's value in this example equals to 259200.


..  literalinclude:: _usage.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
