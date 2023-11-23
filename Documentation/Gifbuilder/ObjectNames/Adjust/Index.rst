..  include:: /Includes.rst.txt
..  index:: GIFBUILDER; ADJUST
..  _gifbuilder-adjust:

======
ADJUST
======

This lets you adjust the tonal range like in the "levels" dialog of
Photoshop. You can set the input and output levels and that way remap
the tonal range of the image. If you need to adjust the gamma value,
have a look at the :ref:`EFFECT <gifbuilder-effect>` object.


Example
=======

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    20 = ADJUST
    20.value = inputLevels = 13, 230


Properties
==========

..  contents::
    :local:


..  _gifbuilder-adjust-inputLevels:

inputLevels
-----------

..  confval:: inputLevels

    :Data type: low, high (int<0,255>, int<0, 255>)

    With this option you can remap the tone of the image to make shadows
    darker, highlights lighter and increase contrast.

    Possible values for "low" and "high" are integers between 0 and 255,
    where "high" must be higher than "low".

    The value "low" will then be remapped to a tone of 0, the value "high"
    will be remapped to 255.

    **Example:**

    This example will cause the tonal range of the resulting image to
    begin at 50 of the original (which is set as 0 for the new image) and
    to end at 190 of the original (which is set as 255 for the new image).

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = ADJUST
        20.value = inputLevels = 50, 190


..  _gifbuilder-adjust-outputLevels:

outputLevels
------------

..  confval:: outputLevels

    :Data type: low, high (int<0,255>, int<0, 255>)

    With this option you can remap the tone of the image to make shadows
    lighter, highlights darker and decrease contrast.

    Possible values for "low" and "high" are integers between 0 and 255,
    where "high" must be higher than "low".

    The beginning of the tonal range, which is 0, will then be remapped to
    the value "low", the end, which is 255, will be remapped to the value
    "high".

    **Example:**

    This example will cause the resulting image to have a tonal range,
    where there is no pixel with a tone below 50 and no pixel with a tone
    above 190 in the image.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = ADJUST
        20.value = outputLevels = 50, 190


..  _gifbuilder-adjust-autoLevels:

autoLevels
----------

..  confval:: autoLevels

    Sets the :ref:`inputLevels <gifbuilder-adjust-inputLevels>` and
    :ref:`outputLevels <gifbuilder-adjust-outputLevels>` automaticallsy.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = ADJUST
        20.value = autoLevels
