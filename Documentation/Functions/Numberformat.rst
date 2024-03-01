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

    :Data type: :ref:`data-type-integer` / :ref:`stdwrap`
    :Default: 0

    Number of decimals the formatted number will have.


    Your input will in that case be rounded up or down to the next integer.


..  _numberformat-dec-point:

dec\_point
----------

..  confval:: dec_point

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`
    :Default: .

    Character that divides the decimals from the rest of the number.


..  _numberformat-thousands-sep:

thousands\_sep
--------------

..  confval:: thousands_sep

    :Data type: :ref:`data-type-string` / :ref:`stdwrap`
    :Default: ,

    Character that divides the thousands of the number.
    Set an empty value to have no thousands separator.

..  _numberformat-examples:

Examples
========

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.myPrice = TEXT
    lib.myPrice {
      value = 0.8
      stdWrap.numberFormat {
        decimals = 2
        dec_point.cObject = TEXT
        dec_point.cObject {
          value = .
          stdWrap.lang.de = ,
        }
      }
      stdWrap.noTrimWrap = || &euro;|
    }
    # Will basically result in "0.80 €", but for German in "0,80 €".

    lib.carViews = CONTENT
    lib.carViews {
        table = tx_mycarext_car
        select.pidInList = 42
        renderObj = TEXT
        renderObj {
            stdWrap.field = views
            # By default use 3 decimals or
            # use the number given by the Get/Post variable precisionLevel, if set.
            stdWrap.numberFormat.decimals = 3
            stdWrap.numberFormat.decimals.override.data = GP:precisionLevel
            stdWrap.numberFormat.dec_point = ,
            stdWrap.numberFormat.thousands_sep = .
        }
    }
    # Could result in something like "9.586,007".
