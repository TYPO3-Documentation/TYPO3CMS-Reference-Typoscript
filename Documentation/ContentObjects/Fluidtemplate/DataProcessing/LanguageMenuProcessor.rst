..  include:: /Includes.rst.txt
..  _LanguageMenuProcessor:

=====================
LanguageMenuProcessor
=====================

This menu processor generates a list of language menu items which can be
assigned to the :typoscript:`FLUIDTEMPLATE` as a variable.

..  hint::
    The third-party extension
    `b13/menus <https://extensions.typo3.org/extension/menus>`__ also provides
    a language menu processor: :php:`B13\Menus\DataProcessing\LanguageMenu`.

    Refer to the `manual of the extension b13/menus
    <https://github.com/b13/menus/blob/master/README.md>`__ for more
    information.


..  _LanguageMenuProcessor-options:

Options:
========

..  _LanguageMenuProcessor-if:

if
--

..  confval:: if
    :name: LanguageMenuProcessor-if

    :Required: false
    :Data type: :ref:`if` condition

    Only if the condition is met the data processor is executed.


..  _LanguageMenuProcessor-languages:

languages
---------

..  confval:: languages
    :name: LanguageMenuProcessor-languages

    :Required: true
    :Data type: :ref:`data-type-string` / :ref:`stdWrap`
    :default: "auto"
    :Example: "0,1,2"

    A list of comma-separated language IDs (e.g. 0,1,2) to use for the menu
    creation or `auto` to load from the :ref:`site configuration
    <t3coreapi:sitehandling>`.


..  _LanguageMenuProcessor-addQueryString-exclude:

addQueryString.exclude
----------------------

..  confval:: addQueryString.exclude
    :name: LanguageMenuProcessor-addQueryString-exclude

    :Required: true
    :Data type: :ref:`data-type-string` / :ref:`stdWrap`
    :default: ""
    :Example: "gclid,contrast"

    A list of comma-separated parameter names to be excluded from the language
    menu URLs.


..  _LanguageMenuProcessor-as:

as
--

..  confval:: as
    :name: LanguageMenuProcessor-

    :Required: false
    :Data type: :ref:`data-type-string`
    :default: defaults to the fieldName

    The variable name to be used in the Fluid template.

..  _LanguageMenuProcessor-example:

Example: Menu of all language from site configuration
=====================================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

Using the :php:`LanguageMenuProcessor` the following scenario is possible:

..  include:: /CodeSnippets/DataProcessing/TypoScript/LanguageMenuProcessor.rst.txt

..  versionadded:: 12.1
    One can use the alias :typoscript:`language-menu` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor`.


The Fluid template
------------------

This generated menu can be used in Fluid like this:

..  include:: /CodeSnippets/DataProcessing/Template/DataProcLangMenu.rst.txt


Output
------

The array now contains information on all languages as defined in the site
configuration. As the current page is not translated into German, the
German language has the :php:`item.available` set to `false`. It therefore
does not get linked in the template.

..  include:: /Images/AutomaticScreenshots/DataProcessing/LanguageMenuProcessor.rst.txt
