.. include:: /Includes.txt
.. _GalleryProcessor:

================
GalleryProcessor
================

The :php:`GalleryProcessor` provides the logic for working with galleries and
calculates the maximum asset size. It uses the files already present in
the `processedData` array for its calculations. The :php:`FilesProcessor` can be
used to fetch the files.


Options:
========

.. confval:: if

   :Required: false
   :type: :ref:`if` condition
   :default: ''

   If the condition is not met the data is not processed

.. confval:: filesProcessedDataKey

   :Required: true
   :type: string, :ref:`stdWrap`
   :default: 'files'
   :Example: 'myImages'

   Key of the array previously processed by the
   FilesProcessor

.. confval:: numberOfColumns

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: field:imagecols
   :Example: 4

   Expects the desired number of columns. Defaults to the value of the field
   `imagecols` / "Number of Columns" if used with content elements.

.. confval:: mediaOrientation

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: field:imageorient
   :Example: 2

   Expects the image orientation as used in the field imageorient
   in content elements such as text with images. Defaults to the value of the field
   `imageorient` / "Position and Alignment" if used with content elements.

   .. image:: Images/ImageOrientation.png
      :alt: Media orientation in the content elements such as text with images
      :class: with-shadow

.. confval:: maxGalleryWidth

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: 600

   Maximal gallery width in pixels

.. confval:: maxGalleryWidthInText

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: 300

   Maximal gallery width in pixels if displayed in a text

.. confval:: equalMediaHeight, equalMediaWidth

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: field:imageheight, field:imagewidth
   :Example: 300

   If set all images get scaled to a uniform height / width. Defaults
   to the value of the fields `imageheight` / "Height of each element (px)",
   `imagewidth` / "Width of each element (px)"
   if used with content elements.

   .. image:: Images/MediaHeight.png
      :alt: Media height and width in the content element Text and Images
      :class: with-shadow

.. confval:: columnSpacing

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: 0
   :Example: 4

   Space between columns in pixels

.. confval:: borderEnabled

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: field:imageborder
   :Example: 1

   Should there be a border around the images? Defaults
   to the value of the fields `imageborder` / "Number of Columns"
   if used with content elements.


.. confval:: borderWidth

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: 0
   :Example: 2

   Width of the border in pixels

.. confval:: borderPadding

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: 0
   :Example: 20

   padding around the border in pixels

.. confval:: cropVariant

   :Required: false
   :type: int, :ref:`stdWrap`
   :default: "default" :aspect:`Example:`

   See :ref:`cropt variant in the TCA reference<t3tca:columns-imageManipulation-properties-cropVariants>`

.. confval:: as

   :Required: false
   :type: string, :ref:`stdWrap`
   :default: "files"

   The variable's name to be used in the Fluid template

.. confval:: dataProcessing

   :Required: false
   :type: array of :ref:`dataProcessing`
   :default: ""

   Array of DataProcessors to be applied to all fetched records.


Example
=======

Using the :php:`GalleryProcessor` the following scenario is possible::

   tt_content.textmedia.20 = FLUIDTEMPLATE
   tt_content.textmedia.20 {
      file = EXT:site_default/Resources/Private/Templates/ContentObjects/Image.html

      dataProcessing {
         # Process files
         10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor

         # Calculate gallery info
         20 = TYPO3\CMS\Frontend\DataProcessing\GalleryProcessor
         20 {
            # filesProcessedDataKey :: Key in processedData array that holds
            # the files (default: files) + stdWrap
            filesProcessedDataKey = files

            # mediaOrientation :: Media orientation, see:
            # TCA[tt_content][column][imageorient] (default: data.imageorient) + stdWrap
            mediaOrientation.field = imageorient

            # numberOfColumns :: Number of columns (default: data.imagecols) + stdWrap
            numberOfColumns.field = imagecols

            # equalMediaHeight :: Equal media height in pixels (default: data.imageheight) + stdWrap
            equalMediaHeight.field = imageheight

            # equalMediaWidth :: Equal media width in pixels (default: data.imagewidth) + stdWrap
            equalMediaWidth.field = imagewidth

            # maxGalleryWidth :: Max gallery width in pixels (default: 600) + stdWrap
            maxGalleryWidth = 1000

            # maxGalleryWidthInText :: Max gallery width in pixels when
            # orientation intext (default: 300) + stdWrap
            maxGalleryWidthInText = 1000

            # columnSpacing :: Column spacing width in pixels (default: 0) + stdWrap
            columnSpacing = 0

            # borderEnabled :: Border enabled (default: data.imageborder) + stdWrap
            borderEnabled.field = imageborder

            # borderWidth :: Border width in pixels (default: 0) + stdWrap
            borderWidth = 0

            # borderPadding :: Border padding in pixels  (default: 0) + stdWrap
            borderPadding = 10

            # as :: Name of key in processedData array where result is
            # placed (default: gallery) + stdWrap
            as = gallery
         }
      }
   }

   
Example output:
---------------

.. code-block:: typoscript

   gallery {
      position {
         horizontal = center
         vertical = above
         noWrap = FALSE
      }
      width = 600
      count {
         files = 2
         columns = 1
         rows = 2
      }
      rows {
         1 {
            columns {
               1 {
                  media = TYPO3\CMS\Core\Resource\FileReference
                  dimensions {
                     width = 600
                     height = 400
                  }
               }
            }
         }
         2 {
            columns {
               1 {
                  media = TYPO3\CMS\Core\Resource\FileReference
                  dimensions {
                     width = 600
                     height = 400
                  }
               }
            }
         }
      }
      columnSpacing = 0
      border {
         enabled = FALSE
         width = 0
         padding = 0
      }
   }

Example of corresponding Fluid templates
----------------------------------------

Content of the basic Fluid template of the gallery (rendering of the gallery
will be done in partial MediaGallery):

.. code-block:: html

   <f:if condition="{gallery.position.noWrap} != 1">
      <f:render partial="Header" arguments="{_all}" />
   </f:if>

   <div class="ce-textpic ce-{gallery.position.horizontal}
        ce-{gallery.position.vertical}{f:if(condition: '{gallery.position.noWrap}',
        then: ' ce-nowrap')}">

      <f:if condition="{gallery.position.vertical} != 'below'">
         <f:render partial="MediaGallery" arguments="{_all}" />
      </f:if>
      <div class="ce-bodytext">
         <f:if condition="{gallery.position.noWrap}">
            <f:render partial="Header" arguments="{_all}" />
         </f:if>
         <f:format.html>{data.bodytext}</f:format.html>
      </div>
      <f:if condition="{gallery.position.vertical} == 'below'">
         <f:render partial="MediaGallery" arguments="{_all}" />
      </f:if>
   </div>

Content of partial :file:`MediaGallery.html`:

.. code-block:: html

   <f:if condition="{gallery.rows}">
      <div class="ce-gallery{f:if(condition: '{data.imageborder}',
           then: ' ce-border')}" data-ce-columns="{gallery.count.columns}"
           data-ce-images="{gallery.count.files}">
         <f:if condition="{gallery.position.horizontal} == 'center'">
            <div class="ce-outer">
               <div class="ce-inner">
         </f:if>
         <f:for each="{gallery.rows}" as="row">
            <div class="ce-row">
               <f:for each="{row.columns}" as="column">
                  <f:if condition="{column.media}">
                     <div class="ce-column">
                        <f:if condition="{column.media.description}">
                           <f:then>
                              <figure>
                           </f:then>
                           <f:else>
                              <div class="ce-media">
                           </f:else>
                        </f:if>
                        <f:if condition="{column.media.type} == 2">
                           <f:render section="imageType" arguments="{_all}" />
                        </f:if>
                        <f:if condition="{column.media.type} == 4">
                           <f:render section="videoType" arguments="{_all}" />
                        </f:if>

                        <f:if condition="{column.media.description}">
                           <f:then>
                                 <figcaption>
                                    {column.media.description}
                                 </figcaption>
                              </figure>
                           </f:then>
                           <f:else>
                              </div>
                           </f:else>
                        </f:if>
                     </div>
                  </f:if>
               </f:for>
            </div>
         </f:for>
         <f:if condition="{gallery.position.horizontal} == 'center'">
                 </div>
             </div>
         </f:if>
      </div>
   </f:if>

   <f:section name="imageType">
      <f:if condition="{column.media.link}">
         <f:then>
            <f:link.typolink parameter="{column.media.link}">
               <f:render section="media" arguments="{_all}" />
            </f:link.typolink>
         </f:then>
         <f:else>
            <f:if condition="{data.image_zoom}">
               <f:then>
                  <ce:link.clickEnlarge image="{column.media}"
                        configuration="{settings.media.popup}">
                     <f:render section="media" arguments="{_all}" />
                  </ce:link.clickEnlarge>
               </f:then>
               <f:else>
                  <f:render section="media" arguments="{_all}" />
               </f:else>
            </f:if>
         </f:else>
      </f:if>
   </f:section>

   <f:section name="videoType">
      <f:render section="media" arguments="{_all}" />
   </f:section>

   <f:section name="media">
      <f:image
         image="{column.media}"
         width="{column.dimensions.width}"
         height="{column.dimensions.height}"
         alt="{column.media.alternative}"
         title="{column.media.title}"
      />
   </f:section>
