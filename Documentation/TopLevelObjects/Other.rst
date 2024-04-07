..  include:: /Includes.rst.txt
..  _top-level-objects-other-reserved-tlo-s:

==========================
Reserved top level objects
==========================


..  index:: Top-level objects; temp

..  _top-level-objects-temp:
..  _tlo-temp:

temp
====

..  confval:: temp
    :name: tlo-temp

    This top-level object name is reserved.

    The top level object :typoscript:`temp` is used to store and copy
    TypoScript code during parse time.

    :typoscript:`temp` is unset before the template is cached, objects in it
    can therefore not be referenced. Use :confval:`tlo-lib` for that purpose.

Example: Use the top level object `temp` to copy code
-----------------------------------------------------

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    temp.some_content = TEXT
    temp.some_content.value = Hello World!

    // Output
    // <h1>Hello World!</h1><p>Hello World!</p>
    page = PAGE
    page {
        10 < temp.some_content
        10.wrap = <h1>|</h1>

        20 < temp.some_content
        20.wrap = <p>|</p>
    }

..  index:: Top-level objects; lib

..  _top-level-objects-lib:
..  _tlo-lib:

lib
====

..  confval:: lib
    :name: tlo-lib

    This top-level object name is reserved.

    The top level object :typoscript:`lib` is used to store, copy and reference
    TypoScript code.

    Other then :confval:`tlo-temp` is not unset before the template is cached,
    objects in it can therefore be referenced by using the operator
    :typoscript:`<=`. Just like with a :confval:`tlo-temp` object copying is
    also possible.

..  code-block:: typoscript
    :caption: EXT:my_sitepackage/Configuration/TypoScript/setup.typoscript

    lib.some_content = TEXT
    lib.some_content.value = Hello World!

    // Output
    // <p>Hello World!</p><p>Hello World!</p>
    page = PAGE
    page {
        10 <= lib.some_content
        10.wrap = <h1>|</h1>

        20 <= lib.some_content
        20.wrap = <p>|</p>
    }

..  index:: Top-level objects; styles

..  _top-level-objects-styles:
..  _tlo-styles:

styles
======

..  confval:: styles
    :name: tlo-styles

    This top-level object name is reserved. It works just like :confval:`tlo-temp`.
    It is preserved for historic reasons, use :confval:`tlo-temp` instead.

..  index:: Top-level objects; tt_content
..  _tlo-tt:
..  _tlo-tt_content:

tt_content
==========

The top level keyword :typoscript:`tt_content` is used to render content
from the table :sql:`tt_content`.


..  index:: Top-level objects; resources
..  _top-level-objects-resources:
..  _tlo-resources:

resources
=========

..  confval:: resources
    :name: tlo-resources
    :type: readonly

    Resources in list (internal)

..  index:: Top-level objects; sitetitle
..  _top-level-objects-sitetitle:
..  _tlo-sitetitle:

sitetitle
=========

..  confval:: sitetitle
    :name: tlo-sitetitle
    :type: readonly

    SiteTitle (internal)
