..  include:: /Includes.rst.txt
..  index:: Functions; numberFormat
..  _numberformat:

============
numberFormat
============

With this property you can format a float value and display it as you
want, for example as a price. It is a wrapper for the :php:`number_format()`
function of PHP.

You can define how many decimals you want and which separators you
want for decimals and thousands.

Since the properties are finally used by the PHP function
:php:`number_format()`, you need to make sure that they are valid parameters
for that function. Consult the PHP manual, if unsure.

..  contents::
    :local:

..  index:: numberformat; Properties
..  _numberformat-properties:

Properties
==========

..  _numberformat-decimals:

decimals
--------

..  confval:: decimals
    :name: numberformat-decimals
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    Number of decimals the formatted number will have.


    Your input will in that case be rounded up or down to the next integer.


..  _numberformat-dec-point:

dec\_point
----------

..  confval:: dec_point
    :name: numberformat-dec-point
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
    :Default: .

    Character that divides the decimals from the rest of the number.


..  _numberformat-thousands-sep:

thousands\_sep
--------------

..  confval:: thousands_sep
    :name: numberformat-thousands-sep
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
    :Default: ,

    Character that divides the thousands of the number.
    Set an empty value to have no thousands separator.

..  _numberformat-examples:

Examples
========

..  literalinclude:: _numberformat.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
