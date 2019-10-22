.. include:: ../../Includes.txt


.. _cobj-image:

IMAGE
^^^^^

Returns an image tag with the image file defined in the property
"file" and processed according to the properties set.

Defined as PHP function cImage() in
typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php.

The array :php:`$GLOBALS['TSFE']->lastImageInfo` is set with the info-array
of the returning image (if any) and contains width, height and so on:

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
do not mix that one up with the cObject described here; both are
different objects.

If you only need the file path to the (possibly resized and also
otherwise adjusted) image, the cObject
:ref:`IMG_RESOURCE <cobj-img-resource>` might be what you are looking
for.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         if

   Data type
         :ref:`->if <if>`

   Description
         If "if" returns false, the image is not shown!


.. container:: table-row

   Property
         file

   Data type
         :ref:`->imgResource <imgresource>`


.. container:: table-row

   Property
         params

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         HTML <IMG> parameters


.. container:: table-row

   Property
         border

   Data type
         integer

   Description
         Value of the "border" attribute of the image tag.

   Default
         0


.. container:: table-row

   Property
         altText

         titleText

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         If no alt text is specified, an empty alt text will be used.


.. container:: table-row

   Property
         emptyTitleHandling

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         Value can be "keepEmpty" to preserve an empty title attribute, or
         "useAlt" to use the alt attribute instead.

   Default
         useAlt


.. container:: table-row

   Property
         longdescURL

   Data type
         :ref:`string <data-type-string>`/:ref:`stdWrap <stdwrap>`

   Description
         "longdesc" attribute (URL pointing to document with extensive details
         about image).


.. _cobj-image-layoutkey:

layoutKey
"""""""""

.. container:: table-row

   Property
         layoutKey

   Data type
         :ref:`string <data-type-string>`/:ref:`stdWrap <stdwrap>`

   Description
         Defines the render layout for the IMAGE. The render layout is the HTML Code for the IMAGE itself.
         Possible "out of the box" values are :ts:`default`, :ts:`srcset`, :ts:`picture`, :ts:`data`.
         Each possibility represents a different solution to render the HTML Code of the IMAGE. The default code
         renders the img-tag as plain old html tag with the different attributes.

         When implementing a responsive layout you need different image sizes for the different displays and resolutions of your layout. Depending on
         the HTML framework, the capabilities of desired browsers and the used javascript library for progressive enhancement you can choose either one of the predefined layouts
         or can define a new layout of your own by adding an additional layout key.

         If you don't have a responsive HTML layout you should use the default layout.

         - :ts:`default` renders a normal non-responsive image as a :html:`<img>` tag:

           .. code-block:: text

              <img src="###SRC###"
                   width="###WIDTH###"
                   height="###HEIGHT###" ###PARAMS### ###ALTPARAMS### ###BORDER### ###SELFCLOSINGTAGSLASH###>

         - :ts:`srcset` renders an image tag pointing to a set of images for the different resolutions.
           They are referenced inside the :ts:`srcset` attribute the :html:`<img>` tag for each defined resolution.
           Each image is actually rendered by TYPO3. Srcset is a proposed addition to HTML5 (http://www.w3.org/html/wg/drafts/srcset/w3c-srcset/).

           .. code-block:: text

              <img src="###SRC###"
                   srcset="|*|###SRC### ###SRCSETCANDIDATE###,|*|###SRC### ###SRCSETCANDIDATE###" ###PARAMS### ###ALTPARAMS######SELFCLOSINGTAGSLASH###>

         - :ts:`picture` renders a picture tag containing source tags for each resolution
           and an :html:`<img>` tag for the default image.

           .. code-block:: text

              <picture>
                 <source srcset="###SRC###"
                         media="###MEDIAQUERY###"###SELFCLOSINGTAGSLASH###>
                 <img src="###SRC###" ###PARAMS### ###ALTPARAMS######SELFCLOSINGTAGSLASH###>
              </picture>

         - :ts:`data` renders an image tag containing data-keys for the different resolutions:

           .. code-block:: text

              <img src="###SRC###"
                   data-###DATAKEY###="###SRC###" ###PARAMS### ###ALTPARAMS######SELFCLOSINGTAGSLASH###>

   Default
         default


.. _cobj-image-layout:

layout
""""""

.. container:: table-row

   Property
         layout

   Data type
         array

   Description
         HTML code definition for the different :ref:`cobj-image-layoutkey`.


.. _cobj-image-layout-layoutkey:

layout.layoutKey
""""""""""""""""

.. container:: table-row

   Property
         layout.layoutKey

   Data type
         array

   Description
         Definition for the HTML rendering for the named
         :ref:`cobj-image-layoutkey`. Depending on your needs you can use the
         existing pre-defined layoutKey or you can define your own element for
         your responsive layout.

         **Example:** ::

          picture {
              element = <picture>###SOURCECOLLECTION###<img src="###SRC###" ###PARAMS### ###ALTPARAMS### ###SELFCLOSINGTAGSLASH###></picture>
              source = <source srcset="###SRC###" media="###MEDIAQUERY###" ###SELFCLOSINGTAGSLASH###>
          }


.. _cobj-image-layout-layoutkey-element:

layout.layoutKey.element
""""""""""""""""""""""""

.. container:: table-row

   Property
         layout.layoutKey.element

   Data type
         :ref:`string <data-type-string>`

   Description
         The outer element definition for the HTML rendering of the image.
         Possible markers are mainly all parameters which can be defined in the
         IMAGE object, e.g.:

         - :html:`###SRC###` the file URL for the src attribute

         - :html:`###WIDTH###` the width of the image for the width tag (only the
           width value)

         - :html:`###HEIGHT###` the height of the image for the height tag (only the
           width value)

         - :html:`###PARAMS###` additional params defined in the IMAGE object (as
           complete attribute)

         - :html:`###ALTPARAMS###` additional alt params defined in the IMAGE object
           (as complete attribute)

         - :html:`###BORDER###` border for the image tag (as complete attribute)

         - :html:`###SELFCLOSINGTAGSLASH###` renders the closing slash of the tag,
           depending on the setting of
           :ref:`config.xhtmlDoctype <setup-config-xhtmldoctype>` and
           :ref:`config.Doctype <setup-config-doctype>`

         - :html:`###SOURCECOLLECTION###` the additional sources of the image
           depending on the different usage in responsive webdesign. The
           definition of the sources is declared inside
           :ref:`layout.layoutKey.source <cobj-image-layout-layoutkey-source>`


.. _cobj-image-layout-layoutkey-source:

layout.layoutKey.source
"""""""""""""""""""""""

.. container:: table-row

   Property
         layout.layoutKey.source

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
        Defines the HTML code for the :html:`###SOURCECOLLECTION###`
        of the :ref:`cobj-image-layout-layoutkey-element`.
        Possible markers in the out of the box configuration are:

        - :html:`###SRC###` the file URL for the src attribute

        - :html:`###WIDTH###` the width of the image for the width tag (only the width value)

        - :html:`###HEIGHT###` the height of the image for the height tag (only the width value)

        - :html:`###SELFCLOSINGTAGSLASH###` renders the closing slash of the tag, depending on the setting of xhtmlDoctype

        - :html:`###SRCSETCANDIDATE###` is the value of the srcsetCandidate defined in each SourceCollection.DataKey

        - :html:`###MEDIAQUERY###` is the value of the mediaQuery defined in each SourceCollection.DataKey

        - :html:`###DATAKEY###` is the name of the dataKey defined in the :ref:`sourceCollection <cobj-image-sourcecollection>`

        You can define additional markers by adding more datakeys to the collection.
        ###SRCSETCANDIDATE###, ###MEDIAQUERY###, ###DATAKEY### are already defined
        as additional datakeys in the out of the box typoscript. Thus can be
        overwritten by your typoscript.


.. _cobj-image-sourcecollection:

sourceCollection
""""""""""""""""

.. container:: table-row

   Property
         sourceCollection

   Data type
         array

   Description
         For responsive images you need different image resolutions for each
         output device and output mode (portrait vs. landscape).
         :ts:`sourceCollection` defines the different resolutions for image
         rendering, normally you would define al least one
         :ts:`sourceCollection` per layout breakpoint. The amount of
         sourceCollections, the name and the specification for the
         sourceCollections will be defined by the HTML/CSS/JS code you are
         using. The configuration of the sourceCollection defines the size of
         the image which is rendered.

         Each resolution should be set up as separate array in the
         :ts:`sourceCollection`. Each :ts:`sourceCollection` consists of
         different :ref:`dataKey <cobj-image-datakey>` properties which you can
         define to suit your needs.




         **Example:** ::

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


.. _cobj-image-datakey:

dataKey
"""""""

.. container:: table-row

   Property
         sourceCollection.dataKey

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Definition of your image size definition depending on your responsive
         layout, breakpoints and display density.


.. _cobj-image-datakey-if:

dataKey.if
""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.if

   Data type
         :ref:`if <if>`

   Description
         Renders only if the condition is met, this is evaluated before any
         execution of code.


.. _cobj-image-datakey-pixeldensity:

dataKey.pixelDensity
""""""""""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.pixelDensity

   Data type
         integer / :ref:`stdWrap <stdWrap>`

   Description
         Defines the density of the rendered Image, e.g. retina display would
         have a density of 2, the density is a multiplicator for the image
         dimensions: If the pixelDensity is set to 2 and the width is set to
         200 the generated image file will have a width of 400 but will be
         treated inside the html code as 200 pixel.

   Default
         1

.. _cobj-image-datakey-width:

dataKey.width
"""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.width

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Defines the width for the html code of the image defined in this
         source collection. For the image file itself the width will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.

.. _cobj-image-datakey-height:

dataKey.height
""""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.height

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Defines the height for the html code of the image defined in this
         source collection. For the image file itself the height will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.

.. _cobj-image-datakey-maxW:

dataKey.maxW
""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.maxW

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Defines the maxW for the html code of the image defined in this
         source collection. For the image file itself the maxW will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.

.. _cobj-image-datakey-maxH:

dataKey.maxH
""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.maxH

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Defines the maxH for the html code of the image defined in this
         source collection. For the image file itself the maxH will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.


.. _cobj-image-datakey-minW:

dataKey.minW
""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.minW

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Defines the minW for the html code of the image defined in this
         source collection. For the image file itself the minW will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.

.. _cobj-image-datakey-minH:

dataKey.minH
""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.minH

   Data type
         :ref:`stdWrap <stdWrap>`

   Description
         Defines the minH for the html code of the image defined in this
         source collection. For the image file itself the minH will be multiplied by
         :ref:`dataKey.pixelDensity <cobj-image-datakey-pixeldensity>`.

.. _cobj-image-datakey-quality:

dataKey.quality
"""""""""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.quality

   Data type
         integer

   Description
         Defines the quality of the rendered images on a scale from 1-100.

.. _cobj-image-datakey-others:

dataKey.*
"""""""""

.. container:: table-row

   Property
         sourceCollection.dataKey.*

   Data type
         string

   Description
         You can define additional key value pairs which won't be used for
         setting the image size, but will be available as additional markers for
         the image template. See example mediaquery.


.. container:: table-row

   Property
         linkWrap

   Data type
         :ref:`linkWrap <data-type-linkwrap>` /:ref:`stdWrap <stdwrap>`

   Description
         (before ".wrap")


.. container:: table-row

   Property
         imageLinkWrap

   Data type
         boolean/ :ref:`->imageLinkWrap <imagelinkwrap>`

   Description
         **Note:** Only active if linkWrap is **not** set and file is
         **not** :ref:`GIFBUILDER <gifbuilder>` (as it works with the original
         image file).


.. container:: table-row

   Property
         wrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Description
         Wrap for the image tag.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`





.. ###### END~OF~TABLE ######


[tsref:(cObject).IMAGE]


.. _cobj-image-examples:

Examples:
"""""""""


.. _cobj-image-examples-standard:

Standard rendering
~~~~~~~~~~~~~~~~~~

::

       10 = IMAGE
       # toplogo.gif has the dimensions 300 x 150 pixels.
       10.file = fileadmin/toplogo.gif
       10.params = style="margin: 0px 20px;"
       10.wrap = |<br>

This returns:

.. code-block:: html

   <img src="fileadmin/toplogo.gif"
        width="300"
        height="150"
        border="0"
        style="margin: 0px 20px;"
        alt=""><br>


.. _cobj-image-examples-responsive:

Responsive/adaptive rendering
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

        30 = IMAGE
        30 {
          file = fileadmin/imagefilenamename.jpg
          file.width = 100

          layoutKey = default
          layout {

            default {
             element = <img src="###SRC###" width="###WIDTH###" height="###HEIGHT###" ###PARAMS### ###ALTPARAMS### ###BORDER### ###SELFCLOSINGTAGSLASH###>
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


This returns as an example all per default possible HTML-Output:

.. code-block:: html

   <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png"
     width="600" height="423"    alt=""  border="0" />
   <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png"
     data-small="fileadmin/_processed_/imagefilenamename_595cc36c48.png"
     data-smallRetina="fileadmin/_processed_/imagefilenamename_42fb68d642.png"
     alt="" />
   <picture>
     <source srcset="fileadmin/_processed_/imagefilenamename_595cc36c48.png"
       media="(max-device-width: 600px)" />
     <source srcset="fileadmin/_processed_/imagefilenamename_42fb68d642.png"
       media="(max-device-width: 600px) AND (min-resolution: 192dpi)" />
     <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png"
       alt="" />
   </picture>
   <img src="fileadmin/_processed_/imagefilenamename_595cc36c48.png"
     srcset="fileadmin/_processed_/imagefilenamename_595cc36c48.png 600w,
       fileadmin/_processed_/imagefilenamename_42fb68d642.png 600w 2x"
     alt="" />

