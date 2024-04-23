..  include:: /Includes.rst.txt
..  index::
    Content objects; IMAGE
    IMAGE
..  _cobj-image:

=====
IMAGE
=====

Objects of type IMAGE return an image tag with the image file defined in the property
"file" and is processed using the properties that are set on the object.

The array :php:`$GLOBALS['TSFE']->lastImageInfo` is set with the info-array
of the returning image (if any) and contains width, height and other properties:

=============================  =============================================
Name of the getText property   Content
=============================  =============================================
0                              width
1                              height
2                              file extension
3                              resource
origFile                       relative URL pointing to the original file
_mtime                         modification time of the original file
originalFile                   The FAL object referencing the original file
processedFile                  The FAL object referencing the processed file
=============================  =============================================

**Note:** Gifbuilder also has an :ref:`IMAGE object <gifbuilder-image>` -
it is not the same as the cObject described here; both are completely
different objects.

If you only need the file path to the image; regardless of whether it's been resized, the cObject
:ref:`IMG_RESOURCE <cobj-img-resource>` will return the file path.

.. contents::
   :local:

..  _cobj-image-properties:

Properties
==========

..  _cobj-image-cache:

cache
-----

..  confval:: cache
    :name: image-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.

..  _cobj-image-if:

if
--

..  confval:: if
    :name: image-if
    :type: :ref:`->if <if>`

    If "if" returns false, the image is not shown!


..  _cobj-image-file:

file
----

..  confval:: file
    :name: image-file
    :type: :ref:`->imgResource <imgresource>`


..  _cobj-image-params:

params
------

..  confval:: params
    :name: image-params
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    HTML <IMG> parameters

..  _cobj-image-border:

border
------

..  confval:: params
    :type: :ref:`data-type-integer`
    :Default: 0

    Value of the "border" attribute of the image tag.


..  _cobj-image-altText:
..  _cobj-image-titleText:

altText / titleText
-------------------

..  confval:: altText
    :name: image-altText
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    If no alt text is specified, an empty alt text will be used.


..  confval:: titleText
    :name: image-titleText
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`


..  _cobj-image-emptyTitleHandling:

emptyTitleHandling
------------------

..  confval:: emptyTitleHandling
    :name: image-emptyTitleHandling
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`
    :Default: useAlt

    Value can be "keepEmpty" to preserve an empty title attribute, or
    "useAlt" to use the alt attribute instead.

.. index:: IMAGE; layoutKey
.. _cobj-image-layoutkey:

layoutKey
---------

..  confval:: layoutKey
    :name: image-layoutKey
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`
    :Default: default

    Defines the render layout for the IMAGE. The render layout is the HTML Code for the IMAGE itself.
    Default values include :typoscript:`default`, :typoscript:`srcset`, :typoscript:`picture`, :typoscript:`data`.
    Each option represents a different solution to render the HTML Code of the IMAGE. The default code
    renders the img-tag as a plain html tag with the different attributes.

    When implementing a responsive layout you need different image sizes for the different displays and resolutions of your layout. Depending on
    the HTML framework, the capabilities of desired browsers and the used javascript library for progressive enhancement you can choose either one of the predefined layouts
    or you can define a new layout of your own by adding an additional layout key.

    If you don't have a responsive HTML layout you should use the default layout.

    -   :typoscript:`default` renders a normal non-responsive image as a :html:`<img>` tag:

        ..  code-block:: text

            <img src="###SRC###"
                 width="###WIDTH###"
                 height="###HEIGHT###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###>

    -   :typoscript:`srcset` renders an image tag pointing to a set of images for the different resolutions.
        They are referenced inside the :typoscript:`srcset` attribute the :html:`<img>` tag for each defined resolution.
        Each image is actually rendered by TYPO3. Srcset is a proposed addition to HTML5 (https://www.w3.org/TR/html-srcset/).

        ..  code-block:: text

            <img src="###SRC###"
                 srcset="|*|###SRC### ###SRCSETCANDIDATE###,|*|###SRC### ###SRCSETCANDIDATE###" ###PARAMS### ###ALTPARAMS######SELFCLOSINGTAGSLASH###>

    -   :typoscript:`picture` renders a picture tag containing source tags for each resolution
        and an :html:`<img>` tag for the default image.

        ..  code-block:: text

            <picture>
               <source srcset="###SRC###"
                       media="###MEDIAQUERY###"###SELFCLOSINGTAGSLASH###>
               <img src="###SRC###" ###PARAMS### ###ALTPARAMS######SELFCLOSINGTAGSLASH###>
            </picture>

    -   :typoscript:`data` renders an image tag containing data-keys for the different resolutions:

        ..  code-block:: text

            <img src="###SRC###"
                 data-###DATAKEY###="###SRC###" ###PARAMS### ###ALTPARAMS######SELFCLOSINGTAGSLASH###>

.. index:: IMAGE; layout
.. _cobj-image-layout:

layout
------

..  confval:: layout
    :name: image-layout
    :type: array

    HTML code definition for the different :ref:`cobj-image-layoutkey`.


.. index:: IMAGE; layout.layoutKey
.. _cobj-image-layout-layoutkey:

layout.layoutKey
~~~~~~~~~~~~~~~~

..  confval:: layout.layoutKey
    :name: image-layout-layoutkey
    :type: array

    Definition for the HTML rendering for the named
    :ref:`cobj-image-layoutkey`. Depending on your needs you can use the
    existing pre-defined layoutKey or you can define your own element for
    your responsive layout.

    **Example:**

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        picture {
          element = <picture>###SOURCECOLLECTION###<img src="###SRC###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###></picture>
          source = <source srcset="###SRC###" media="###MEDIAQUERY###" ###SELFCLOSINGTAGSLASH###>
        }


..  index:: IMAGE; layout.layoutKey.element
..  _cobj-image-layout-layoutkey-element:

layout.layoutKey.element
~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: layout.layoutKey.element
    :name: image-layout-layoutkey-element
    :type: :ref:`data-type-string`

    The outer element definition for the HTML rendering of the image.
    Possible markers are mainly all parameters which can be defined in the
    IMAGE object, e.g.:

    -  :html:`###SRC###` the file URL for the src attribute

    -  :html:`###WIDTH###` the width of the image for the width tag (only the
       width value)

    -  :html:`###HEIGHT###` the height of the image for the height tag (only the
       width value)

    -  :html:`###PARAMS###` additional params defined in the IMAGE object (as
       complete attribute)

    -  :html:`###ALTPARAMS###` additional alt params defined in the IMAGE object
       (as complete attribute)

    -  :html:`###SELFCLOSINGTAGSLASH###` renders the closing slash of the tag,
       depending on the setting of
       :ref:`config.xhtmlDoctype <setup-config-xhtmldoctype>` and
       :ref:`config.doctype <setup-config-doctype>`

    -  :html:`###SOURCECOLLECTION###` the additional sources of the image
       depending on the different usage in responsive webdesign. The
       definition of the sources is declared inside
       :ref:`layout.layoutKey.source <cobj-image-layout-layoutkey-source>`


..  index:: IMAGE; layout.layoutKey.source
..  _cobj-image-layout-layoutkey-source:

layout.layoutKey.source
~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: layout.layoutKey.source
    :name: image-layout-layoutkey-source
    :type: :ref:`stdWrap <stdWrap>`

    Defines the HTML code for the :html:`###SOURCECOLLECTION###`
    of the :ref:`cobj-image-layout-layoutkey-element`.
    Possible markers in the out of the box configuration are:

    -   :html:`###SRC###` the file URL for the src attribute

    -   :html:`###WIDTH###` the width of the image for the width tag (only the width value)

    -   :html:`###HEIGHT###` the height of the image for the height tag (only the width value)

    -   :html:`###SELFCLOSINGTAGSLASH###` renders the closing slash of the tag, depending on the setting of xhtmlDoctype

    -   :html:`###SRCSETCANDIDATE###` is the value of the srcsetCandidate defined in each SourceCollection.DataKey

    -   :html:`###MEDIAQUERY###` is the value of the mediaQuery defined in each SourceCollection.DataKey

    -   :html:`###DATAKEY###` is the name of the dataKey defined in the :ref:`sourceCollection <cobj-image-sourcecollection>`

    You can define additional markers by adding more datakeys to the collection.
    ###SRCSETCANDIDATE###, ###MEDIAQUERY###, ###DATAKEY### are already defined
    as additional datakeys in the out of the box typoscript. Thus can be
    overwritten by your typoscript.


..  index:: IMAGE; sourceCollection
..  _cobj-image-sourcecollection:

sourceCollection
----------------

..  confval:: sourceCollection
    :name: image-sourceCollection
    :type: array

    For responsive images you need different image resolutions for each
    output device and output mode (portrait vs. landscape).
    :typoscript:`sourceCollection` defines the different resolutions for image
    rendering, normally you would define at least one
    :typoscript:`sourceCollection` per layout breakpoint. The amount of
    sourceCollections, the name and the specification for the
    sourceCollections will be defined by the HTML/CSS/JS code you are
    using. The configuration of the sourceCollection defines the size of
    the image which is rendered.

    Each resolution should be set up as separate array in the
    :typoscript:`sourceCollection`. Each :typoscript:`sourceCollection` consists of
    different :ref:`dataKey <cobj-image-datakey>` properties which you can
    define to suit your needs.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        sourceCollection {
          small {
            width = 200

            srcsetCandidate = 600w
            mediaQuery = (max-device-width: 600px)
            dataKey = small
          }
          smallRetina {
            if.directReturn = 1

            width = 200
            pixelDensity = 2

            srcsetCandidate = 600w 2x
            mediaQuery = (max-device-width: 600px) AND (min-resolution: 192dpi)
            dataKey = smallRetina
          }
        }


..  index:: IMAGE; sourceCollection.dataKey
..  _cobj-image-datakey:

sourceCollection.dataKey
~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey
    :name: image-dataKey
    :type: :ref:`stdWrap <stdWrap>`

    Definition of your image size definition depending on your responsive
    layout, breakpoints and display density.


..  index:: IMAGE; sourceCollection.dataKey.if
..  _cobj-image-datakey-if:

sourceCollection.dataKey.if
~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.if
    :name: image-datakey-if
    :type: :ref:`if <if>`

    Renders only if the condition is met, this is evaluated before any
    execution of code.


..  index:: IMAGE; sourceCollection.dataKey.pixelDensity
..  _cobj-image-datakey-pixeldensity:

sourceCollection.dataKey.pixelDensity
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.pixelDensity
    :name: image-pixeldensity
    :type: :ref:`data-type-integer` / :ref:`stdWrap <stdWrap>`
    :Default: 1

    Defines the density of the rendered Image, e.g. a retina display would
    have a density of 2, the density is a multiplier for the image
    dimensions: If the pixelDensity is set to 2 and the width is set to
    200 the generated image file will have a width of 400 but will be
    treated inside the html code as 200 pixels.


..  index:: IMAGE; sourceCollection.dataKey.width
..  _cobj-image-datakey-width:

sourceCollection.dataKey.width
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.width
    :name: image-datakey-width
    :type: :ref:`stdWrap <stdWrap>`

         Defines the width for the html code of the image defined in this
         source collection. For the image file itself the width will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


..  index:: IMAGE; sourceCollection.dataKey.height
..  _cobj-image-datakey-height:

sourceCollection.dataKey.height
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.height
    :name: image-datakey-height
    :type: :ref:`stdWrap <stdWrap>`

    Defines the height for the html code of the image defined in this
    source collection. For the image file itself the height will be multiplied by
    :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


..  index:: IMAGE; sourceCollection.dataKey.maxW
..  _cobj-image-datakey-maxW:

sourceCollection.dataKey.maxW
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.maxW
    :name: image-datakey-maxW
    :type: :ref:`stdWrap <stdWrap>`

    Defines the maxW for the html code of the image defined in this
    source collection. For the image file itself the maxW will be multiplied by
    :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


..  index:: IMAGE; sourceCollection.dataKey.maxH
..  _cobj-image-datakey-maxH:

sourceCollection.dataKey.maxH
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.maxH
    :name: image-datakey-maxH
    :type: :ref:`stdWrap <stdWrap>`

    Defines the maxH for the html code of the image defined in this
    source collection. For the image file itself the maxH will be multiplied by
    :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


..  index:: IMAGE; sourceCollection.dataKey.minW
..  _cobj-image-datakey-minW:

sourceCollection.dataKey.minW
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.minW
    :name: image-datakey-minW
    :type: :ref:`stdWrap <stdWrap>`

    Defines the minW for the html code of the image defined in this
    source collection. For the image file itself the minW will be multiplied by
    :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


..  index:: IMAGE; sourceCollection.dataKey.minH
..  _cobj-image-datakey-minH:

sourceCollection.dataKey.minH
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.minH
    :name: image-datakey-minH
    :type: :ref:`stdWrap <stdWrap>`

    Defines the minH for the html code of the image defined in this
    source collection. For the image file itself the minH will be multiplied by
    :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


..  index:: IMAGE; sourceCollection.dataKey.quality
..  _cobj-image-datakey-quality:

sourceCollection.dataKey.quality
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.quality
    :name: image-datakey-quality
    :type: :ref:`data-type-integer`

    Defines the quality of the rendered images on a scale from 1-100.


..  index:: IMAGE; sourceCollection.dataKey.*
..  _cobj-image-datakey-others:

sourceCollection.dataKey.*
~~~~~~~~~~~~~~~~~~~~~~~~~~

..  confval:: sourceCollection.dataKey.*
    :name: image-datakey-others
    :type: :ref:`data-type-string`

    You can define additional key value pairs which won't be used for
    setting the image size, but will be available as additional markers for
    the image template. See the example mediaquery.


..  _cobj-image-linkWrap:

linkWrap
--------

..  confval:: linkWrap
    :name: image-linkWrap
    :type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    (before ".wrap")


..  _cobj-image-imageLinkWrap:

imageLinkWrap
-------------

..  confval:: imageLinkWrap
    :name: image-imageLinkWrap
    :type: :ref:`data-type-boolean` / :ref:`->imageLinkWrap <imagelinkwrap>`

    **Note:** Only active if linkWrap is **not** set and file is
    **not** :ref:`GIFBUILDER <gifbuilder>` (as it works with the original
    image file).


..  _cobj-image-wrap:

wrap
----

..  confval:: wrap
    :name: image-wrap
    :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap <stdwrap>`

    Wrap for the image tag.


..  _cobj-image-stdWrap:

stdWrap
-------

..  confval:: stdWrap
    :name: image-stdWrap
    :type: :ref:`->stdWrap <stdwrap>`


..  _cobj-image-examples:

Examples
========


..  index:: IMAGE; Standard rendering example
..  _cobj-image-examples-standard:

Standard rendering
------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    page.10 = IMAGE
    # toplogo.png has the dimensions 300 x 150 pixels.
    page.10 {
      file = fileadmin/toplogo.png
      params = style="margin: 0px 20px;"
      wrap = |<br>
    }

This returns:

..  code-block:: html

    <img src="/fileadmin/toplogo.png"
         width="300"
         height="150"
         style="margin: 0px 20px;"
         alt=""><br>


..  index:: IMAGE; Responsive rendering example
..  _cobj-image-examples-responsive:

Responsive/adaptive rendering
-----------------------------

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

    30 = IMAGE
    30 {
      file = fileadmin/imagefilenamename.jpg
      file.width = 100

      layoutKey = default
      layout {

        default {
          element = <img src="###SRC###" width="###WIDTH###" height="###HEIGHT###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###>
          source =
        }

        srcset {
          element = <img src="###SRC###" srcset="###SOURCECOLLECTION###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###>
          source = |*|###SRC### ###SRCSETCANDIDATE###,|*|###SRC### ###SRCSETCANDIDATE###
        }

        picture {
          element = <picture>###SOURCECOLLECTION###<img src="###SRC###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###></picture>
          source = <source srcset="###SRC###" media="###MEDIAQUERY###" ###SELFCLOSINGTAGSLASH###>
        }

        data {
          element = <img src="###SRC###" ###SOURCECOLLECTION### ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###>
          source.noTrimWrap = | data-###DATAKEY###="###SRC###"|
        }
      }

      sourceCollection {
        small {
          width = 200

          srcsetCandidate = 800w
          mediaQuery = (min-device-width: 800px)
          dataKey = small
        }
        smallHires {
          if.directReturn = 1
          width = 300
          pixelDensity = 2

          srcsetCandidate = 800w 2x
          mediaQuery = (min-device-width: 800px) AND (foobar)
          dataKey = smallHires
          pictureFoo = bar
        }
      }
    }
    40 < 30
    40.layoutKey = data
    50 < 30
    50.layoutKey = picture
    60 < 30
    60.layoutKey = srcset


This returns as an example all per default possible HTML output:

..  code-block:: html

    <img src="/fileadmin/_processed_/imagefilenamename_595cc36c48.png"
         width="600" height="423" alt="">
    <img src="/fileadmin/_processed_/imagefilenamename_595cc36c48.png"
         data-small="/fileadmin/_processed_/imagefilenamename_595cc36c48.png"
         data-smallRetina="/fileadmin/_processed_/imagefilenamename_42fb68d642.png"
         alt="">
    <picture>
      <source srcset="/fileadmin/_processed_/imagefilenamename_595cc36c48.png"
              media="(max-device-width: 600px)">
      <source srcset="/fileadmin/_processed_/imagefilenamename_42fb68d642.png"
              media="(max-device-width: 600px) AND (min-resolution: 192dpi)">
      <img src="/fileadmin/_processed_/imagefilenamename_595cc36c48.png"
           alt="">
    </picture>
    <img src="/fileadmin/_processed_/imagefilenamename_595cc36c48.png"
         srcset="/fileadmin/_processed_/imagefilenamename_595cc36c48.png 600w,
                 /fileadmin/_processed_/imagefilenamename_42fb68d642.png 600w 2x"
         alt="">
