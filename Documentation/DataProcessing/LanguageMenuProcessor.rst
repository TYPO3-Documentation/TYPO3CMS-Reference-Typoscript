:navigation-title: language-menu
..  include:: /Includes.rst.txt
..  _languagemenuprocessor:

============================
language-menu data processor
============================

The processor :php:`\TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor`,
alias `language-menu`, generates a list of language menu items which can be
assigned to the :typoscript:`FLUIDTEMPLATE` as a variable.

..  contents:: Table of contents

..  hint::
    The third-party extension
    `b13/menus <https://extensions.typo3.org/extension/menus>`__ also provides
    a language menu processor: :php:`B13\Menus\DataProcessing\LanguageMenu`.

    Refer to the `manual of the extension b13/menus
    <https://github.com/b13/menus/blob/master/README.md>`__ for more
    information.

..  _languagemenuprocessor-options:

Options:
========

..  confval-menu::
    :display: table
    :type:
    :default:

    ..  _languagemenuprocessor-if:

    ..  rubric:: if

    ..  confval:: if
        :name: LanguageMenuProcessor-if
        :type: :ref:`if <if>` condition

        Only if the condition is met the data processor is executed.

    ..  _languagemenuprocessor-languages:

    ..  rubric:: languages

    ..  confval:: languages
        :name: LanguageMenuProcessor-languages
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: "auto"
        :Example: "0,1,2"

        A list of comma-separated language IDs (e.g. 0,1,2) to use for the menu
        creation or `auto` to load from the :ref:`site configuration
        <t3coreapi:sitehandling>`.

    ..  _languagemenuprocessor-addquerystring-exclude:

    ..  rubric:: addQueryString.exclude

    ..  confval:: addQueryString.exclude
        :name: LanguageMenuProcessor-addQueryString-exclude
        :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`
        :default: ""
        :Example: "gclid,contrast"

        A list of comma-separated parameter names to be excluded from the language
        menu URLs.

    ..  _languagemenuprocessor-as:

    ..  rubric:: as

    ..  confval:: as
        :name: LanguageMenuProcessor-as
        :type: :ref:`string <data-type-string>`
        :default: "languagemenu"

        The variable name to be used in the Fluid template.

..  _languagemenuprocessor-example:

Example: Menu of all language from site configuration
=====================================================

Please see also :ref:`About the examples <dataprocessing-about-examples>`.

..  rubric:: TypoScript

Using the :php-short:`\TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor`
the following scenario is possible:

..  literalinclude:: /CodeSnippets/DataProcessing/TypoScript/LanguageMenuProcessor.typoscript
    :caption: EXT:my_extension/Configuration/Sets/Main/setup.typoscript

..  rubric:: The Fluid template

This generated menu can be used in Fluid like this:

..  literalinclude:: /CodeSnippets/DataProcessing/Template/DataProcLangMenu.fluid.html
    :caption: EXT:my_extension/Resources/Private/Templates/ContentElements/DataProcLangMenu.fluid.html

..  rubric:: Output

The array now contains information on all languages as defined in the site
configuration. As the current page is not translated into German, the
German language has the :php:`item.available` set to `false`. It therefore
does not get linked in the template.

If the `fallbacks` of a language in the site configuration contain the
default language, `item.available` is `true` for this language. This is also
true if the page has no translation in this language. TYPO3 then shows the
page in the default language. Dansk and Deutsch have no fallbacks in this
example.

..  versionchanged:: 15.0
    :changelog: important-103451-1793198547

    Up to TYPO3 14, `item.available` was `false` for such a language if the
    page had no translation in it.

..  figure:: /Images/GeneratedScreenshots/DataProcessing/LanguageMenuProcessor.png
    :zoom: lightbox
    :alt: Dump of the variable languageNavigation with 3 languages, and a list
        in which "English" is a link, while "Dansk" and "Deutsch" are shown
        without a link
