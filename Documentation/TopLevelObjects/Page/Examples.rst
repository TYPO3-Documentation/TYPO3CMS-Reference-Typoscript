..  include:: /Includes.rst.txt
..  index::
    PAGE; Examples
..  _page_examples:

=============
PAGE Examples
=============

..  _page_examples_hello_world:

A simple "Hello World" Example
==============================

Demonstrates:
    *   :confval:`page.10 <page-array>`

..  literalinclude:: _codesnippets/_world.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _page_examples_fluid:

A page using a Fluid template
=============================

Demonstrates:
    *   :confval:`page.10 <page-array>`

..  literalinclude:: _codesnippets/_fluid.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _page_examples_ajax:

A page type used for ajax requests
==================================

Demonstrates:
    *   :confval:`page.typeNum <page-typeNum>`
    *   :confval:`page.config <page-config>`

While many examples found in the internet promote to set
:typoscript:`config.no_cache = 1` it is better to only disable the cache for objects
where it absolutely needs to be disabled, leaving all other caches untouched.
This can be achieved for example by using a non-cacheable array, the
:ref:`COA_INT <cobj-coa-int>`.

..  literalinclude:: _codesnippets/_ajax.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _page_examples_json:

A page type used for JSON data
==============================

    *   :confval:`page.typeNum <page-typeNum>`
    *   :confval:`page.config <page-config>`

To create a page type in the format json an additional
header with `Content-type:application/json` has to be set:

..  literalinclude:: _codesnippets/_json.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

The built-in :php-short:`\TYPO3\CMS\Extbase\Mvc\View\JsonView` can be used to
create the content via Extbase.
