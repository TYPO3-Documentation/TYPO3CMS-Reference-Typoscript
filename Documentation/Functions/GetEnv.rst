.. include:: /Includes.rst.txt

.. index:: Functions; getEnv

.. _getenv:

======
getEnv
======

Allows to override static values with environment variables.

The modifier checks if the variable given as its argument is set and reads the
value if so, overriding any existing value. If the environment variable is not
set, the variable given on the left-hand side of the expression is not changed.

To have a value actually inserted, your PHP execution environment (webserver,
PHP-FPM) needs to have these variables set, or you need a mechanism like dotenv
(for example: `symfony/dotenv <https://github.com/symfony/dotenv>`_ or
`vlucas/phpdotenv <https://github.com/vlucas/phpdotenv>`_) to set them in your
running TYPO3.

As it is a syntax feature you can use it in both constants and setup plus it
gets cached, as opposed to the :ref:`getText.getenv <data-type-gettext-getenv>`
feature.


.. _getEnv-examples:

Example
=======

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   # Define default value
   myConstant = defaultValue
   # Enable overriding by environment variable
   myConstant := getEnv(TS_MYCONSTANT)
