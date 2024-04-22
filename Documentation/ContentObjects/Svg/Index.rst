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

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`
    :Default: 600

    Width of the SVG.


..  _cobj-svg-height:

height
------

..  confval:: height
    :name: svg-height

    :Data type: :ref:`data-type-integer` / :ref:`stdWrap <stdwrap>`
    :Default: 400

    Height of the SVG.


..  _cobj-svg-src:

src
---

..  confval:: src
    :name: svg-src

    :Data type: :ref:`data-type-resource` / :ref:`stdWrap <stdwrap>`

    SVG file resource, can also be referenced via :file:`EXT:` prefix to
    point to files of extensions.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        src = fileadmin/svg/tiger.svg


..  _cobj-svg-renderMode:

renderMode
----------

..  confval:: renderMode
    :name: svg-renderMode

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Setting `renderMode` to inline will render an inline version of the SVG.


..  _cobj-svg-stdWrap:

stdWrap
-------

..  confval:: stdWrap
    :name: svg-stdWrap

    :Data type: :ref:`->stdWrap <stdwrap>`


.. _cobj-svg-examples:

Example
=======

Output the SVG with the defined dimensions:

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = SVG
    10 {
      width = 600
      height = 600
      src = EXT:my_ext/Resources/Public/Images/example.svg
    }

