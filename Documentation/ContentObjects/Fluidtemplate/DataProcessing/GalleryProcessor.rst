..  include:: /Includes.rst.txt
..  _GalleryProcessor:

================
GalleryProcessor
================

The :php:`GalleryProcessor` provides the logic for working with galleries and
calculates the maximum asset size. It uses the files already present in
the `processedData` array for its calculations. The :ref:`FilesProcessor` can
be used to fetch the files.


Options:
========

..  t3-data-processor-gallery:: if

    :Required: false
    :type: :ref:`if` condition
    :default: ''

    Only if the condition is met the data processor is executed.

..  t3-data-processor-gallery:: filesProcessedDataKey

    :Required: true
    :type: string, :ref:`stdWrap`
    :default: 'files'
    :Example: 'myImages'

    Key of the array previously processed by the :php:`FilesProcessor`.

..  t3-data-processor-gallery:: numberOfColumns

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: field:imagecols
    :Example: 4

    Expects the desired number of columns. Defaults to the value of the field
    `imagecols` (:guilabel:`Number of Columns`) if used with content elements.

..  t3-data-processor-gallery:: mediaOrientation

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: field:imageorient
    :Example: 2

    Expects the image orientation as used in the field `imageorient` in content
    elements such as text with images. Defaults to the value of the field
    `imageorient` (:guilabel:`Position and Alignment`) if used with content
    elements.

    .. include:: /Images/AutomaticScreenshots/Fluidtemplate/ImageOrientation.rst.txt

..  t3-data-processor-gallery:: maxGalleryWidth

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: 600

    Maximal gallery width in pixels.

..  t3-data-processor-gallery:: maxGalleryWidthInText

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: 300

    Maximal gallery width in pixels if displayed in a text.

..  t3-data-processor-gallery:: equalMediaHeight, equalMediaWidth

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: field:imageheight, field:imagewidth
    :Example: 300

    If set all images get scaled to a uniform height / width. Defaults
    to the value of the fields `imageheight` (:guilabel:`Height of each element
    (px)`), `imagewidth` (:guilabel:`Width of each element (px)`) if used with
    content elements.

    .. include:: /Images/AutomaticScreenshots/Fluidtemplate/MediaHeight.rst.txt

..  t3-data-processor-gallery:: columnSpacing

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: 0
    :Example: 4

    Space between columns in pixels

..  t3-data-processor-gallery:: borderEnabled

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: field:imageborder
    :Example: 1

    Should there be a border around the images? Defaults to the value of the
    fields `imageborder` (:guilabel:`Number of Columns`) if used with content
    elements.

..  t3-data-processor-gallery:: borderWidth

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: 0
    :Example: 2

    Width of the border in pixels.

..  t3-data-processor-gallery:: borderPadding

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: 0
    :Example: 20

    Padding around the border in pixels.

..  t3-data-processor-gallery:: cropVariant

    :Required: false
    :type: int, :ref:`stdWrap`
    :default: "default"
    :Example: "mobile"

    See :ref:`crop variants in the TCA reference <t3tca:columns-imageManipulation-properties-cropVariants>`

..  t3-data-processor-gallery:: as

    :Required: false
    :type: string, :ref:`stdWrap`
    :default: "files"

    The variable name to be used in the Fluid template.

..  t3-data-processor-gallery:: dataProcessing

    :Required: false
    :type: array of :ref:`dataProcessing`
    :default: ""

    Array of data processors to be applied to all fetched records.


Example: display images in rows and columns
===========================================

Please see also :ref:`dataProcessing-about-examples`.


TypoScript
----------

As the :php:`GalleryProcessor` expects the data of the files to be
present in the the `processedData` array, the :php:`FilesProcessor`
always has to be called first. Execution depends on the key in the
:t3-data-processor-gallery:`dataProcessing` array, not the order in which they are put there.

The content of :t3-data-processor-gallery:`filesProcessedDataKey` in the
:php:`GalleryProcessor` has to be equal to the content of
:ref:`as <FilesProcessor-as>` in the :ref:`FilesProcessor <FilesProcessor>`:

..  include:: /CodeSnippets/DataProcessing/TypoScript/GalleryProcessor.rst.txt

..  versionadded:: 12.1
    One can use the alias :typoscript:`gallery` instead
    of the fully-qualified class name
    :php:`\TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor`.

The Fluid template
------------------

..  include:: /CodeSnippets/DataProcessing/Template/DataProcGallery.rst.txt

Output
------

The array now contains the images ordered in rows and columns. For each image
there is a desired width and height supplied.

..  figure:: /Images/ManualScreenshots/FrontendOutput/DataProcessing/GalleryProcessor.png
    :class: with-shadow
    :alt: Gallery dump and output
