..  include:: /Includes.rst.txt
..  index:: Content objects; SVG
..  _cobj-svg:

===
SVG
===

With this object type you can insert a SVG. You can use XML data directly
or reference a file.

..  contents::
    :local:

..  index:: SVG; Properties
..  _cobj-svg-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:

..  _cobj-svg-cache:

cache
-----

..  confval:: cache
    :name: svg-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.

..  _cobj-svg-width:

width
-----

..  confval:: width
    :name: svg-width
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>`
    :default: 600

    Width of the SVG.

..  _cobj-svg-height:

height
------

..  confval:: height
    :name: svg-height
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdwrap>`
    :default: 400

    Height of the SVG.

..  _cobj-svg-src:

src
---

..  confval:: src
    :name: svg-src
    :type: :ref:`resource <data-type-resource>` / :ref:`stdWrap <stdwrap>`

    SVG file resource, can also be referenced via :file:`EXT:` prefix to
    point to files of extensions.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript

        src = fileadmin/svg/tiger.svg

..  _cobj-svg-rendermode:

renderMode
----------

..  confval:: renderMode
    :name: svg-renderMode
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdwrap>`

    Setting `renderMode` to inline will render an inline version of the SVG.

..  _cobj-svg-stdwrap:

stdWrap
-------

..  confval:: stdWrap
    :name: svg-stdWrap
    :type: :ref:`->stdWrap <stdwrap>`


..  _cobj-svg-examples:

Example
=======

Output the SVG with the defined dimensions:

..  literalinclude:: _svg.typoscript
    :caption: EXT:my_sitepackage/Configuration/Sets/Main/setup.typoscript
