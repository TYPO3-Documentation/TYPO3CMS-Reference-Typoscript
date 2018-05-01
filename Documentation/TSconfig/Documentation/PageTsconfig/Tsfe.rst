.. include:: ../Includes.txt

.. _pagetsfe:

====
TSFE
====

Configuration options that apply to frontend configuration.

constants
---------

:aspect:`Datatype`
    [TypoScript Frontend Constants defaults]

:aspect:`Description`
    Defaults for TypoScript Template constants!

    This feature allows you to pass some amount of information (in the
    form of TypoScript Template constants) to the frontend.

    The specific use of this should be information which you want to
    configure for both frontend and backend. For instance you could have a
    backend module which should act in a certain way depending on in which
    branch of the page tree it operates. The change of behavior is set by
    `Page TSconfig` as always, but since you need the same setting applied
    somewhere in the frontend you don't want the redundancy of specifying
    the value twice. In such a case you can use this feature.

:aspect:`Example`

    .. code-block:: typoscript

        TSFE.constants.websiteConfig.id = 123

    In the frontend TypoScript templates you can now insert this constant as `{$websiteConfig.id}`.

    .. figure:: ../../Images/TypoScriptObjectBrowser.png
        :alt: Showing TS constants with the TypoScript Object Browser

        Showing TS constants with the TypoScript Object Browser

    In the backend module (in the Web main module) you can reach the value
    by a few lines of code like these

    .. note::

        In the frontend the setting of default constants will only apply to a branch of the
        tree *if* a template record is found on that page, or if a template record is set
        for "next level". In other words: If you want the Page TSconfig constant defaults
        to affect only a certain branch of the page tree, make sure to create a template
        record (a blank one will do) on the page that carries the Page TSconfig information.
