.. include:: /Includes.rst.txt
.. index:: Functions; round
.. _round:

=====
round
=====

With this property you can round the value up, down or to a certain
number of decimals. For each roundType the according PHP function will
be used.

The value will be converted to a float value before applying the
selected round method.

.. _round-roundtype:

roundType
=========

:aspect:`Property`
   roundType

:aspect:`Data type`
   :ref:`data-type-string` / :ref:`stdwrap`

:aspect:`Description`
   Round method which should be used.

   Possible keywords:

   ceil
      Round the value up to the next integer.

   floor
      Round the value down to the previous integer.

   round
      Round the value to the specified number of decimals.

:aspect:`Default`
   round

.. _round-decimals:

decimals
========

:aspect:`Property`
   decimals

:aspect:`Data type`
   :ref:`data-type-integer` / :ref:`stdwrap`

:aspect:`Description`
   Number of decimals the rounded value will have. Only used with the
   roundType "round". Defaults to 0, so that your input will in that case
   be rounded up or down to the next integer.

:aspect:`Default`
   0

.. _round-round:

round
=====

:aspect:`Property`
   round

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   Set round = 1 to enable rounding.

:aspect:`Default`
   0

.. _round-examples:

Examples
""""""""


.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   lib.number = TEXT
   lib.number {
       value = 3.14159
       stdWrap.round = 1
       stdWrap.round.roundType = round
       stdWrap.round.decimals = 2
   }

This returns :code:`3.14`.

