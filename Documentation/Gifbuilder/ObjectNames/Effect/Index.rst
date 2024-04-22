..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; EFFECT
..  _gifbuilder-effect:

======
EFFECT
======

The :typoscript:`EFFECT` object allows to apply one or more of the
:ref:`following effects <gifbuilder-effect-effects>` to the image.

It has only one property: :typoscript:`value`.
:ref:`stdWrap <stdwrap>` is available for :typoscript:`value`.

..  _gifbuilder-effect-syntax:

Syntax
======

..  code-block:: none
    :caption: Syntax

    20 = EFFECT
    20.value = <effect>=<value> | <effect>=<value>

All effects are defined as the effect only or as an effect/value pair inside
:typoscript:`value`. Multiple effects or effect/value pairs are separated by
:typoscript:`|`.

..  _gifbuilder-effect-example:

Example
=======

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    lib.image = IMAGE
    lib.image {
      file = GIFBUILDER
      file {
        XY = 1024,768
        format = jpg

        10 = IMAGE
        10.file = fileadmin/image.jpg

        20 = EFFECT
        20.value = gamma=1.3 | flip | rotate=180
      }
    }

..  _gifbuilder-effect-effects:

Effects
=======

..  contents::
    :local:

..  _gifbuilder-effect-blur:

blur
----

..  confval:: blur
    :name: gifbuilder-effect-blur
    :type: integer (1-99)
    :Default: 0

    Blurs the edges inside the image.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = blur=10


..  _gifbuilder-effect-charcoal:

charcoal
--------

..  confval:: charcoal
    :name: gifbuilder-effect-charcoal
    :type: integer (0-100)
    :Default: 0

    Makes the image look as if it has been drawn with charcoal and defines
    the intensity of that effect.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = charcoal=5


..  _gifbuilder-effect-colors:

colors
------

..  confval:: colors
    :name: gifbuilder-effect-colors
    :type: integer (2-255)

    Defines the number of different colors to use in the image.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = colors=100


..  _gifbuilder-effect-edge:

edge
----

..  confval:: edge
    :name: gifbuilder-effect-edge
    :type: integer (0-99)
    :Default: 0

    Detect edges within an image. This is a gray-scale operator, so it is
    applied to each of the three color channels separately. The value defines
    the radius for the edge detection.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = edge=8


..  _gifbuilder-effect-emboss:

emboss
------

..  confval:: emboss
    :name: gifbuilder-effect-emboss

    Creates a relief effect: Creates highlights or shadows that replace
    light and dark boundaries in the image.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = emboss


..  _gifbuilder-effect-flip:

flip
----

..  confval:: flip
    :name: gifbuilder-effect-flip

    Vertical flipping.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = flip


..  _gifbuilder-effect-flop:

flop
----

..  confval:: flop
    :name: gifbuilder-effect-flop

    Horizontal flipping.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = flop


..  _gifbuilder-effect-gamma:

gamma
-----

..  confval:: gamma
    :name: gifbuilder-effect-gamma
    :type: double (0.5 - 3.0)
    :Default: 1.0

    Sets the `gamma <https://en.wikipedia.org/wiki/Gamma_correction>`__ value.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = gamma=1.3


..  _gifbuilder-effect-gray:

gray
----

..  confval:: gray
    :name: gifbuilder-effect-gray

    The image is converted to gray tones.

    **Example:**

    This gives the image a slight :ref:`gifbuilder-effect-wave` and
    renders it in gray.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = wave=1,20 | gray


..  _gifbuilder-effect-invert:

invert
------

..  confval:: invert
    :name: gifbuilder-effect-invert

    Invert the colors.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = invert


..  _gifbuilder-effect-rotate:

rotate
------

..  confval:: rotate
    :name: gifbuilder-effect-rotate
    :type: integer (0-360)
    :Default: 0

    Number of degrees for a clockwise rotation.

    Image dimensions will grow if needed, so that nothing is cut off from
    the original image.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = rotate=180


..  _gifbuilder-effect-sharpen:

sharpen
-------

..  confval:: sharpen
    :name: gifbuilder-effect-sharpen
    :type: integer (0-99)
    :Default: 0

    Sharpens the edges inside the image.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = sharpen=12


..  _gifbuilder-effect-shear:

shear
-----

..  confval:: shear
    :name: gifbuilder-effect-shear
    :type: integer (-90 - 90)
    :Default: 0

    Number of degrees for a horizontal shearing. Horizontal shearing
    slides one edge of the image along the X axis, creating a
    parallelogram. Provide an integer between -90 and 90 for the number
    of degrees.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = shear=-30


..  _gifbuilder-effect-solarize:

solarize
--------

..  confval:: solarize
    :name: gifbuilder-effect-solarize
    :type: integer (0-99)
    :Default: 0

    Color reduction, "burning" the brightest colors black. The brighter the
    color, the darker the solarized color is. This happens in photography when
    chemical film is over exposed.

    The value sets the grayscale level above which the color is negated.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = solarize=15


..  _gifbuilder-effect-swirl:

swirl
-----

..  confval:: swirl
    :name: gifbuilder-effect-swirl
    :type: integer (0-1000)
    :Default: 0

    The image is swirled or spun from its center.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = swirl=200


..  _gifbuilder-effect-wave:

wave
----

..  confval:: wave
    :name: gifbuilder-effect-wave
    :type: integer,integer (both 0-99)
    :Default: 0,0

    Provide values for the amplitude and the length of a wave, separated by
    comma. All horizontal edges in the image will then be transformed by a wave
    with the given amplitude and length.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = EFFECT
        20.value = wave=1,20
