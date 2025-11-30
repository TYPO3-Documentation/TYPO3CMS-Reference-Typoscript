..  include:: /Includes.rst.txt
..  index::
    Content objects; USER
    Content objects; USER_INT
    PHP
    pair: PHP; Call a PHP function
    pair: PHP; Call a PHP method
..  _cobj-user:
..  _cobj-user-int:

==================
USER and USER\_INT
==================

..  important::

    ..  versionchanged:: 14.0

        PHP functions called via TypoScript **must** now use the PHP
        attribute :php:`#[AsAllowedCallable]`
        (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

This calls either a PHP function or a method in a class. This is very
useful if you want to incorporate your own data processing or content.

Basically USER and USER\_INT are user defined cObjects, because they
call a function or method, which you control!

If you call a method in a class (which is of course instantiated as an
object), the internal variable :php:`$cObj` of that class is set with a
*reference* to the parent cObject. This offers you an API of functions,
which might be more or less relevant for you. See
:file:`ContentObjectRenderer.php` in the TYPO3 source code; access to :typoscript:`typolink`
or :typoscript:`stdWrap` are only two of the gimmicks you get.

If you create this object as :typoscript:`USER_INT`, it will be rendered non-cached,
outside the main page-rendering.

..  contents::
    :local:

..  index::
    USER; Properties
    USER_INT; Properties
..  _cobj-user-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:

..  _cobj-user-userFunc:

..  confval:: userFunc
    :name: user-userFunc
    :type: :ref:`data-type-function-name`

    The name of the function, which should be called. If you specify the
    name with a '->' in it, then it is interpreted as a call to a method in
    a class.

    Three parameters are sent to the PHP function: First a :php:`string $content` variable
    (which is empty for USER/USER\_INT objects, but not when the user
    function is called from stdWrap functions .postUserFunc or
    .preUserFunc). The second parameter is an array (:php:`$configuration`) with the properties
    of this cObject, if any. As third parameter, the current :php:`ServerRequestInterface $request`
    is passed.

    PHP functions called via TypoScript **must** use the PHP
    attribute :php:`#[AsAllowedCallable]`
    (:php:`TYPO3\CMS\Core\Attribute\AsAllowedCallable`).

..  note::

    The :php:`$request` object should be used to access request related variables instead of directly accessing
    the superglobal variables like :php:`$_GET` / :php:`$_POST` / :php:`$_SERVER`, or TYPO3’s API methods :php:`GeneralUtility::_GP()`
    and :php:`GeneralUtility::getIndpEnv()`.

..  _cobj-user-defined-properties:

..  confval:: (properties you define)
    :name: user-defined-properties
    :type: (the data type you want)

    Apart from the properties "userFunc" and "stdWrap", which are defined for
    all USER/USER\_INT objects by default, you can add additional properties
    with any name and any data type to your USER/USER\_INT object. These
    properties and their values will then be available in PHP; they will be
    passed to your function (in the second parameter). This allows you to
    process them further in any way you wish.

..  _cobj-user-stdWrap:

..  confval:: stdWrap
    :name: user-stdWrap
    :type: :ref:`stdWrap`.

..  _cobj-user-cache:

..  confval:: cache
    :name: user-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.


..  _cobj-user-examples:
..  _cobj-user-int-examples:

Examples
========

..  attention::

    For the best result you should *always*, without exception, place your class files in
    an extension, define composer class loading for this extension and add this extension as
    a dependency of your project. Then, your classes will load without issues when you refer
    to them by their class name.

Example 1
---------

This example shows how to include your own PHP script and how to use it
from TypoScript. Use this TypoScript configuration:

..  literalinclude:: _ExampleTime.typoscript
    :language: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

The file :file:`EXT:site_package/Classes/UserFunctions/ExampleTime.php` might
amongst other things contain:

..  literalinclude:: _ExampleTime.php
    :language: php
    :caption:  EXT:site_package/Classes/UserFunctions/ExampleTime.php

Here :typoscript:`page.10` will give back what the PHP function :php:`printTime()`
returned. Since we did not use a :typoscript:`USER` object, but a
:typoscript:`USER_INT` object, this function is executed on every page hit.
Thus, in this example, the current time is displayed in red letters each time.

The method :php:`printTime()` uses the PHP attribute
:php:`#[AsAllowedCallable]` so that TypoScript is allowed to call is as a
user function.

Example 2
---------

Now let us have a look at another example:

We want to display all content element headers of a page in reversed
order. For this we use the following TypoScript:

..  literalinclude:: _ExampleListRecords.typoscript
    :language: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

The file :file:`EXT:site_package/Classes/UserFunctions/ExampleListRecords.php`
may contain amongst other things:

..  literalinclude:: _ExampleListRecords.php
    :language: php
    :caption: EXT:site_package/Classes/UserFunctions/ExampleListRecords.php

Since we need an instance of the :php:`ContentObjectRenderer` class, we are using
the :php:`setContentObjectRenderer()` method to get it and store it in the
:php:`cObj` class property for later use.

:typoscript:`page.30` will give back what the function :php:`listContentRecordsOnPage()` of
the class YourClass returned. This example returns some debug output
at the beginning and then the headers of the content elements on the
page in reversed order. Note how we defined the property
"reverseOrder" for this :typoscript:`USER` object and how we used it in the PHP code.

The method :php:`listContentRecordsOnPage()` uses the PHP attribute
:php:`#[AsAllowedCallable]` so that TypoScript is allowed to call is as a
user function.

Example 3
---------

Another example can be found in the documentation of the stdWrap
property :ref:`stdwrap-postUserFunc` There you can also see how to work with
:php:`$cObj`, the reference to the parent (calling) cObject.

Example 4
---------

PHP has a function :php:`gethostname()` to "get the standard host name for
the local machine". You can make it available like this:

..  literalinclude:: _Hostname.typoscript
    :language: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

Contents of :file:`EXT:site_package/Classes/UserFunctions/Hostname.php`:

..  literalinclude:: _Hostname.php
    :language: php
    :caption: EXT:site_package/Classes/UserFunctions/Hostname.php

The method :php:`getHostname()` uses the PHP attribute
:php:`#[AsAllowedCallable]` so that TypoScript is allowed to call is as a
user function.
