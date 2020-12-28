.. include:: /Includes.rst.txt

.. _cobj-fluidtemplate-properties-dataprocessing:
.. _dataProcessing:

==============
dataProcessing
==============

:typoscript:`dataProcessing` is a property of :ref:`cobj-fluidtemplate`.


.. rst-class:: dl-parameters

dataProcessing
   :sep:`|` :aspect:`Data type:` array of class references by full namespace
   :sep:`|`

   Add one or multiple processors to manipulate the :php:`$data` variable of
   the currently rendered content object, like tt_content or page. The sub-
   property :ts:`options` can be used to pass parameters to the processor
   class.

.. contents:: On this page:
   :local:
   :depth: 1


There are several DataProcessors available to allow flexible processing e.g.
for comma-separated values.


.. _CommaSeparatedValueProcessor:

CommaSeparatedValueProcessor
============================

The :php:`CommaSeparatedValueProcessor` allows to split values into a two-
dimensional array used for CSV files or tt_content records of CType
"table".

Using the :php:`CommaSeparatedValueProcessor` the following scenario is
possible::

   page {
      10 = FLUIDTEMPLATE
      10 {
         file = EXT:site_default/Resources/Private/Template/Default.html
         dataProcessing.4 = TYPO3\CMS\Frontend\DataProcessing\CommaSeparatedValueProcessor
         dataProcessing.4 {
            if.isTrue.field = bodytext
            fieldName = bodytext
            fieldDelimiter = |
            fieldEnclosure =
            maximumColumns = 2
            as = table
         }
      }
   }

In the Fluid template then iterate over the processed data:

.. code-block:: html

   <table>
      <f:for each="{table}" as="columns">
         <tr>
            <f:for each="{columns}" as="column">
               <td>{column}</td>
            </f:for>
         <tr>
      </f:for>
   </table>




.. _DatabaseQueryProcessor:

DatabaseQueryProcessor
======================

The :php:`DatabaseQueryProcessor` works like the code from the Content Object
CONTENT, except for just handing over the result as array. A :ts:`FLUIDTEMPLATE`
can then simply iterate over processed data automatically.


Using the :php:`DatabaseQueryProcessor` the following scenario is possible::

   tt_content.mycontent.20 = FLUIDTEMPLATE
   tt_content.mycontent.20 {
      file = EXT:site_default/Resources/Private/Templates/ContentObjects/MyContent.html

      dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor
      dataProcessing.10 {
         # regular if syntax
         if.isTrue.field = records

         # the table name from which the data is fetched from
         # + stdWrap
         table = tt_address

         # All properties from .select :ref:`select` can be used directly
         # + stdWrap
         orderBy = sorting
         pidInList = 13,14

         # The target variable to be handed to the ContentObject again, can
         # be used in Fluid e.g. to iterate over the objects. defaults to
         # "records" when not defined
         # + stdWrap
         as = myrecords

         # The fetched records can also be processed by DataProcessors.
         # All configured processors are applied to every row of the result.
         dataProcessing {
            10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
            10 {
               references.fieldName = image
            }
         }
      }
   }

In the Fluid template then iterate over the files:

.. code-block:: html

   <ul>
   <f:for each="{myrecords}" as="record">
      <li>
         <f:image image="{record.files.0}" />
         <a href="{record.data.www}">{record.data.first_name} {record.data.last_name}</a>
      </li>
   </f:for>
   </ul>


.. _FilesProcessor:

FilesProcessor
==============

The :php:`FilesProcessor` resolves file references, files, or files inside a
folder or collection to be used for output in the frontend. A
:ts:`FLUIDTEMPLATE` can then simply iterate over processed data automatically.

Using the :php:`FilesProcessor` the following scenario is possible::

   tt_content.image.20 = FLUIDTEMPLATE
   tt_content.image.20 {
      file = EXT:site_default/Resources/Private/Templates/ContentObjects/Image.html

      dataProcessing.10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
      dataProcessing.10 {
         # the field name where relations are set
         # + stdWrap
         references.fieldName = image

         # the table name where relations are put, defaults to the currently
         # selected record from $cObj->getTable()
         # + stdWrap
         references.table = tt_content

         # A list of sys_file UID records
         # + stdWrap
         files = 21,42

         # A list of File Collection UID records
         # + stdWrap
         collections = 13,14

         # A list of FAL Folder identifiers and files fetched recursive from
         # all folders
         # + stdWrap
         folders = 1:introduction/images/,1:introduction/posters/
         folders.recursive = 1

         # Property of which the files should be sorted after they have been
         # accumulated
         # can be any property of sys_file, sys_file_metadata
         # + stdWrap
         sorting = description

         # Can be "ascending", "descending" or "random", defaults to
         # "ascending" if none given
         # + stdWrap
         sorting.direction = descending

         # The target variable to be handed to the ContentObject again, can
         # be used in Fluid e.g. to iterate over the objects. defaults to
         # "files" when not defined
         # + stdWrap
         as = myfiles
      }
   }

In the Fluid template then iterate over the files:

.. code-block:: html

   <ul>
      <f:for each="{myfiles}" as="file">
         <li><a href="{file.publicUrl}">{file.name}</a></li>
      </f:for>
   </ul>

.. _GalleryProcessor:

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


.. _LanguageMenuProcessor:

LanguageMenuProcessor
=====================

The :php:`LanguageMenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu
string based on the site language configuration that will be decoded again
and assigned to :ts:`FLUIDTEMPLATE` as variable.

Options:

:`if`:         TypoScript if condition
:`languages`:  A list of comma separated language IDs (e.g. 0,1,2) to use
               for the menu creation or `auto` to load from site languages
:`as`:         The variable to be used within the result


Using the :php:`LanguageMenuProcessor` the following scenario is possible::

   10 = TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor
   10 {
      languages = auto
      as = languageNavigation
   }

This generated menu can be used in Fluid like this:

.. code-block:: html

   <f:if condition="{languageNavigation}">
      <ul id="language" class="language-menu">
         <f:for each="{languageNavigation}" as="item">
            <li class="{f:if(condition: item.active, then: 'active')}
                       {f:if(condition: item.available, else: ' text-muted')}">
               <f:if condition="{item.available}">
                  <f:then>
                     <a href="{item.link}" hreflang="{item.hreflang}"
                        title="{item.navigationTitle}">
                        <span>{item.navigationTitle}</span>
                     </a>
                  </f:then>
                  <f:else>
                     <span>{item.navigationTitle}</span>
                  </f:else>
               </f:if>
            </li>
         </f:for>
      </ul>
   </f:if>


.. _MenuProcessor:

MenuProcessor
=============

The :php:`MenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu string
that will be decoded again and assigned to :ts:`FLUIDTEMPLATE` as variable.
Additional data processing is supported and will be applied to each record.

Using the :php:`MenuProcessor` the following scenario is possible::

   10 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
   10 {
      special = directory
      special.value = <parent page uid>
      levels = 2
      as = headerMenu
      expandAll = 1
      includeSpacer = 1
      titleField = nav_title // title
   }

This generated menu can be used in Fluid like that:

.. code-block:: html

   <nav>
      <ul class="header_navigation">
         <f:for each="{headerMenu}" as="menuItem">
            <li class="{f:if(condition:'{menuItem.active}',then:'active')}">
               <f:link.page pageUid="{menuItem.uid}">{menuItem.title}</f:link.page>
            </li>
         </f:for>
      </ul>
   </nav>


.. _SiteProcessor:

SiteProcessor
=============

The :php:`SiteProcessor` fetches data from the :ref:`site<t3coreapi:sitehandling>`
entity.


Options:

:`as`: The variable to be used within the result


Using the :php:`SiteProcessor` the following scenario is possible::


   10 = TYPO3\CMS\Frontend\DataProcessing\SiteProcessor
   10 {
      as = site
   }

In the Fluid template the properties of the site entity can be accessed:

.. code-block:: html

   <p>{site.rootPageId}</p>
   <p>{site.someCustomConfiguration}</p>

.. _splitProcessor:

SplitProcessor
==============

The :php:`SplitProcessor` allows to split values separated with a delimiter
inside a single database field into an array to loop over it.

With the help of the :php:`SplitProcessor` the following scenario is
possible::

   page {
      10 = FLUIDTEMPLATE
      10 {
         file = EXT:site_default/Resources/Private/Template/Default.html

         dataProcessing.2 = TYPO3\CMS\Frontend\DataProcessing\SplitProcessor
         dataProcessing.2 {
            if.isTrue.field = bodytext
            delimiter = ,
            fieldName = bodytext
            removeEmptyEntries = 1
            filterIntegers = 0
            filterUnique = 1
            as = keywords
         }
      }
   }

In the Fluid template then iterate over the splitted data:

.. code-block:: html

   <f:for each="{keywords}" as="keyword">
      <li>Keyword: {keyword}</li>
   </f:for>



.. _CustomDataProcessors:

Custom dataProcessors
=====================

Last but not least, it is possible to create your own data processors and
use them in a `FLUIDTEMPLATE` content object::

      my_custom_ctype = FLUIDTEMPLATE
      my_custom_ctype {
         templateName = CustomName
         templateRootPaths {
            10 = EXT:site_default/Resources/Private/Templates
         }
         settings {
            extraParam = 1
         }
         dataProcessing {
            1 = Vendor\YourExtensionKey\DataProcessing\MyFirstCustomProcessor
            2 = Vendor2\AnotherExtensionKey\DataProcessing\MySecondCustomProcessor
            2 {
               options {
                  myOption = SomeValue
               }
            }
         }
      }

