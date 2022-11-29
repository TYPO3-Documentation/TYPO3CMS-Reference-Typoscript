..  include:: /Includes.rst.txt
..  index:: Content objects; CASE
..  _cobj-case:

====
CASE
====

..  note::

    * CASE is an object type (= complex data type).
    * It is a specific :ref:`cObject <cobject>` data type.

This is a very flexible object whose rendering can vary depending on a
given key. The principle is similar to that of the "switch" construct
in PHP.

The value of the "key" property determines, which of the provided
cObjects will finally be rendered.

The "key" property is expected to match one of the values found in the
"array of cObjects". Any string can be used as value in this array,
except for those that match another property. So the forbidden values
are: "if", "setCurrent", "key", and "stdWrap". "default" also cannot
be used as it has a special meaning: If the value of the "key"
property is *not* found in the array of cObjects, then the cObject
from the "default" property will be used.

.. contents::
   :local:

Properties
==========

(array of cObjects)
-------------------

..  t3-cobj-case-:: array of cObjects

    :Data type: :ref:`cObject <data-type-cobject>`

    Array of cObjects. Use this to define cObjects for the different
    values of :t3-cobj-case-:`key`. If :t3-cobj-case-:`key` has a certain value,
    the according cObject will be rendered. The cObjects can have any name, but not
    the names of the other properties of the cObject CASE.

cache
-----

..  t3-cobj-case-:: cache

    :Data type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.

default
-------

..  t3-cobj-case-:: default

    :Data type: :ref:`cObject <data-type-cobject>`

     Use this to define the rendering for *those* values of :t3-cobj-case-:`key` that
     do *not* match any of the values of the :t3-cobj-case-:`array of cObjects`. If no
     default cObject is defined, an empty string will be returned for
     the default case.

if
--

..  t3-cobj-case-:: if

    :Data type: :ref:`->if <if>`

    If :ref:`if <if>` returns false, nothing is returned.

key
---

..  t3-cobj-case-:: key

    :Data type: string /:ref:`stdWrap <stdwrap>`
    :Default: default

    The key, which determines, which cObject will be rendered. Its
    value is expected to match the name of one of the cObjects from
    the array of cObjects; this cObject is then rendered. If no name
    of a cObject is matched, the cObject from the property :t3-cobj-case-:`default`
    is rendered.

    This property defines the source of the value that will be matched against
    the values of the :t3-cobj-case-:`array of cObjects`. It will generally not be a
    simple string, but use its :ref:`stdWrap` properties to retrieve a
    dynamic value from some specific source, typically a field of the
    current record. See the :ref:`example below <t3-cobj-case--examples>`.


setCurrent
----------

..  t3-cobj-case-:: setCurrent

    :Data type: string /:ref:`stdWrap <stdwrap>`

    Sets the "current"-value.

stdWrap
-------


..  t3-cobj-case-:: stdWrap

    :Data type: :ref:`stdWrap <stdwrap>`

    :ref:`stdWrap` around any object that was rendered no matter what the
    :t3-cobj-case-:`key` value is.

..  _cobj-case-examples:

Example:
========

If in this example the field :sql:`header` turns out not to be set ("false"), an
empty string is returned. Otherwise TYPO3 chooses between two different
renderings of some content depending on whether the :t3-cobj-case-:`key` field
`layout` is "1" or not (:t3-cobj-case-:`default`).

The result is in either case wrapped with "\|<br>".

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    stuff = CASE
    stuff.if.isTrue.field = header
    # This value determines, which of the following cObjects will be rendered.
    stuff.key.field = layout

    # cObject for the case that field layout is "1".
    stuff.1 = TEXT
    stuff.1 {
        # ....
    }
    # cObject for all other cases.
    stuff.default = TEXT
    stuff.default {
        # ....
    }

    stuff.stdWrap.wrap = |<br>
