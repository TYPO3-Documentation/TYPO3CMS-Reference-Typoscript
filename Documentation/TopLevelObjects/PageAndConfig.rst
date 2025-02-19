:navigation-title: page & config

..  include:: /Includes.rst.txt
..  _page-config:

===============================================
`page` and `config` on the TypoScript top level
===============================================

By convention the main rendering of a page (page type 0) is configured in a top
level object called `page`. It is of type
`PAGE <https://docs.typo3.org/permalink/t3tsref:object-type-page>`_.

The main TypoScript configuration is always done in a top level object called
`configuration`. It is of type
`CONFIG <https://docs.typo3.org/permalink/t3tsref:top-level-objects-config>`_.

..  contents:: Table of Contents

..  _top-level-objects-page:

The 'page' top-level-object
=============================

The `page` object should be of type `PAGE <https://docs.typo3.org/permalink/t3tsref:object-type-page>`_
with property :ref:`typeNum <t3tsref:confval-page-typenum>` (also called page type)
set to `0`, which is the default.

Some site package authors decide to give the main `PAGE <https://docs.typo3.org/permalink/t3tsref:object-type-page>`_
object a different top level name like `mypage`, however this can be confusing
to subsequent integrators and not compatible with extensions that also make
settings to the `page` top level object.

TYPO3 does not initialize :typoscript:`page` by default. You must initialize this
explicitly, for example:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page = PAGE

..  _top-level-objects-config-about:

The 'config' top-level-object
=============================

Internally TYPO3 always creates an array `config` with various configuration
values which are evaluated during the rendering process and treated in some
special, predefined and predictive way. This is what we mean when we say the
property `config`, actually the array `'config'` is of type CONFIG. It is a
"top-level-object" because it is not subordinate to any other configuration
setting.
