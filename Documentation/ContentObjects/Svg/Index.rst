.. include:: /Includes.rst.txt
.. index:: Content objects; SVG
.. _cobj-svg:

===
SVG
===

With this object type you can insert a SVG. You can use XML data directly
or reference a file.

.. contents::
   :local:

.. index:: SVG; Properties
.. _cobj-svg-properties:

Properties
==========

width
-----

..  t3-cobj-svg:: width

    :Data type: integer /:ref:`stdWrap <stdwrap>`
    :Default: 600

    Width of the SVG.


height
------

..  t3-cobj-svg:: height

    :Data type: integer /:ref:`stdWrap <stdwrap>`
    :Default: 400

    Height of the SVG.


src
---

..  t3-cobj-svg:: src

    :Data type: :ref:`data-type-resource` /:ref:`stdWrap <stdwrap>`

    SVG file resource, can also be referenced via :file:`EXT:` prefix to
    point to files of extensions.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        src = fileadmin/svg/tiger.svg

renderMode
----------

..  t3-cobj-svg:: renderMode

    :Data type: string /:ref:`stdWrap <stdwrap>`

    Setting `renderMode` to inline will render an inline version of the SVG.

stdWrap
-------

..  t3-cobj-svg:: stdWrap

    :Data type: :ref:`->stdWrap <stdwrap>`

.. _cobj-svg-examples:

Example:
========

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    10 = SVG
    10 {
      width = 600
      height = 600
      src = EXT:my_ext/Resources/Public/Images/example.svg
    }

This example will output the svg with the defined dimensions.
