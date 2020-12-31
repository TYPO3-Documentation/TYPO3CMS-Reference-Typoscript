.. include:: /Includes.txt
.. _GalleryProcessor:

================
GalleryProcessor
================

The :php:`GalleryProcessor` provides the logic for working with galleries and
calculates the maximum asset size. It uses the files already present in
the `processedData` array for his calculations. The :php:`FilesProcessor` can be
used to fetch the files.



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
