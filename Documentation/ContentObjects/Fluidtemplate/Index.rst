.. include:: ../../Includes.txt

.. _cobj-fluidtemplate:

=============
FLUIDTEMPLATE
=============

An object of type FLUIDTEMPLATE works in a similar way to the regular
"marker"-based :ref:`TEMPLATE <cobj-template>` object. However, it does not use
markers or subparts, but allows Fluid-style variables with curly braces.


.. _cobj-fluidtemplate-properties:

Properties
==========

.. _cobj-fluidtemplate-properties-templatename:

templateName
------------

.. rst-class:: dl-parameters

templateName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   This name is used together with the set format to find the template in the
   given templateRootPaths. Use this property to define a content object, which
   should be used as template file. It is an alternative to :ts:`.file`. If
   :ts:`.templateName` is set, it takes precedence.

   **Example 1:** ::

      lib.stdContent = FLUIDTEMPLATE
      lib.stdContent {
         templateName = Default
         layoutRootPaths {
            10 = EXT:frontend/Resources/Private/Layouts
            20 = EXT:sitemodification/Resources/Private/Layouts
         }
         partialRootPaths {
            10 = EXT:frontend/Resources/Private/Partials
            20 = EXT:sitemodification/Resources/Private/Partials
         }
         templateRootPaths {
            10 = EXT:frontend/Resources/Private/Templates
            20 = EXT:sitemodification/Resources/Private/Templates
         }
         variables {
            foo = TEXT
            foo.value = bar
         }
      }

   **Example 2:** ::

      lib.stdContent = FLUIDTEMPLATE
      lib.stdContent {
         templateName = TEXT
         templateName.stdWrap {
            cObject = TEXT
            cObject {
               data = levelfield:-2,backend_layout_next_level,slide
               override.field = backend_layout
               split {
                  token = frontend__
                  1.current = 1
                  1.wrap = |
               }
            }
            ifEmpty = Default
         }
         layoutRootPaths {
            10 = EXT:frontend/Resources/Private/Layouts
            20 = EXT:sitemodification/Resources/Private/Layouts
         }
         partialRootPaths {
            10 = EXT:frontend/Resources/Private/Partials
            20 = EXT:sitemodification/Resources/Private/Partials
         }
         templateRootPaths {
            10 = EXT:frontend/Resources/Private/Templates
            20 = EXT:sitemodification/Resources/Private/Templates
         }
         variables {
            foo = bar
         }
      }


.. _cobj-fluidtemplate-properties-template:

template
--------

.. rst-class:: dl-parameters

template
   :sep:`|` :aspect:`Data type:`  :ref:`cObject <data-type-cobject>`
   :sep:`|`

   Use this property to define a content object, which should be used as
   template file. It is an alternative to ".file"; if ".template" is set, it
   takes precedence. While any content object can be used here, the cObject
   :ref:`FILE <cobj-file>` might be the usual choice.


.. _cobj-fluidtemplate-properties-file:

file
----

.. rst-class:: dl-parameters

file
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   The fluid template file. It is an alternative to ".template" and is used
   only, if ".template" is not set.


.. _cobj-fluidtemplate-properties-templaterootpaths:

templateRootPaths
-----------------

.. rst-class:: dl-parameters

templateRootPaths
   :sep:`|` :aspect:`Data type:` array of file paths with :ref:`stdWrap <stdwrap>`
   :sep:`|`

   .. note:: Mind the plural -s in "templateRootPaths"!

   Used to define several paths for templates, which will be tried in reversed
   order (the paths are searched from bottom to top). The first folder where
   the desired layout is found, is used. If the array keys are numeric, they
   are first sorted and then tried in reversed order.

   Useful in combination with the
   :ref:`templateName <cobj-fluidtemplate-properties-templatename>` property.

   **Example:** ::

      page {
         10 = FLUIDTEMPLATE
         10 {
            templateName = Default
            templateRootPaths {
               10 = EXT:sitedesign/Resources/Private/Templates
               20 = EXT:sitemodification/Resources/Private/Templates
            }
         }
      }


.. _cobj-fluidtemplate-properties-layoutrootpath:

layoutRootPath
--------------

.. rst-class:: dl-parameters

layoutRootPath
   :sep:`|` :aspect:`Data type:` file path /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets a specific layout path; usually it is Layouts/ underneath the template
   file.


.. _cobj-fluidtemplate-properties-layoutrootpaths:

layoutRootPaths
---------------

.. rst-class:: dl-parameters

layoutRootPaths
   :sep:`|` :aspect:`Data type:` array of file paths with :ref:`stdWrap <stdwrap>`
   :sep:`|`

   .. note:: Mind the plural -s in "layoutRootPaths"!

   Used to define several paths for layouts, which will be tried in reversed
   order (the paths are searched from bottom to top). The first folder where
   the desired layout is found, is used. If the array keys are numeric, they
   are first sorted and then tried in reversed order.

   **Example:** ::

      page {
         10 = FLUIDTEMPLATE
         10 {
            file = EXT:site_default/Resources/Private/Templates/Main.html
            layoutRootPaths {
               10 = EXT:site_default/Resources/Private/Layouts
               20 = EXT:site_modification/Resources/Private/Layouts
            }
         }
      }

   If property
   :ref:`layoutRootPath <cobj-fluidtemplate-properties-layoutrootpath>`
   (singular) is also used, it will be placed as the first option
   in the list of fall back paths.


.. _cobj-fluidtemplate-properties-partialrootpath:

partialRootPath
---------------

.. rst-class:: dl-parameters

partialRootPath
   file path /:ref:`stdWrap <stdwrap>`

   Sets a specific partials path; usually it is Partials/ underneath the
   template file.


.. _cobj-fluidtemplate-properties-partialrootpaths:

partialRootPaths
----------------

.. rst-class:: dl-parameters

partialRootPaths
   :sep:`|` :aspect:`Data type:` array of file paths with :ref:`stdWrap <stdwrap>`
   :sep:`|`

   .. note:: Mind the plural -s in "partialRootPaths"!

   Used to define several paths for partials, which will be tried in reversed
   order. The first folder where the desired partial is found, is used. The
   keys of the array define the order.

   See :ref:`layoutRootPaths <cobj-fluidtemplate-properties-layoutrootpaths>`
   for more details.


.. _cobj-fluidtemplate-properties-format:

format
------

.. rst-class:: dl-parameters

format
   :sep:`|` :aspect:`Data type:` keyword /:ref:`stdWrap <stdwrap>`
   :sep:`|` :aspect:`Default:` html
   :sep:`|`

   :ts:`format` sets the format of the current request. It can be something
   like "html", "xml", "png", "json". And it can even come in the form of
   "rss.xml" or alike.


.. _cobj-fluidtemplate-properties-extbase-pluginname:

extbase.pluginName
------------------

.. rst-class:: dl-parameters

extbase.pluginName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets variables for initializing extbase.


.. _cobj-fluidtemplate-properties-extbase-controllerextensionname:

extbase.controllerExtensionName
-------------------------------

.. rst-class:: dl-parameters

extbase.controllerExtensionName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets the extension name of the controller.

   **Important:** This is for example essential if you have translations at the
   usual paths in your extension and want to use them right away in your
   template via `<f:translate/>`.


.. _cobj-fluidtemplate-properties-extbase-controllername:

extbase.controllerName
----------------------

.. rst-class:: dl-parameters

extbase.controllerName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets the name of the controller.


.. _cobj-fluidtemplate-properties-extbase-controlleractionname:

extbase.controllerActionName
----------------------------

.. rst-class:: dl-parameters

extbase.controllerActionName
   :sep:`|` :aspect:`Data type:` string /:ref:`stdWrap <stdwrap>`
   :sep:`|`

   Sets the name of the action.


.. _cobj-fluidtemplate-properties-variables:

variables
---------

.. rst-class:: dl-parameters

variables
   :sep:`|` :aspect:`Data type:` *(array of cObjects)*
   :sep:`|`

   Sets variables that should be available in the fluid template. The keys are
   the variable names in Fluid.

   Reserved variables are "data" and "current", which are filled automatically
   with the current data set.


.. _cobj-fluidtemplate-properties-settings:

settings
--------

.. rst-class:: dl-parameters

settings
   :sep:`|` :aspect:`Data type:` array of keys
   :sep:`|`

   Sets the given settings array in the fluid template. In the view, the value
   can then be used.

   **Example:** ::

      page = PAGE
      page {
         10 = FLUIDTEMPLATE
         10 {
            file = EXT:site_default/Resources/Private/Templates/MyTemplate.html
            settings {
               copyrightYear = 2013
            }
         }
      }

   To access copyrightYear in the template file use this:

   .. code-block:: html

      {settings.copyrightYear}

   Apart from just setting a key-value pair as done in the example, you can
   also reference objects or access constants as well.


.. _cobj-fluidtemplate-properties-dataprocessing:

dataProcessing
--------------

.. rst-class:: dl-parameters

dataProcessing
   :sep:`|` :aspect:`Data type:` array of class references by full namespace
   :sep:`|`

   Add one or multiple processors to manipulate the :php:`$data` variable of
   the currently rendered content object, like tt_content or page. The sub-
   property :ts:`options` can be used to pass parameters to the processor
   class.

   **Example 1:** ::

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

   There are eight DataProcessors available to allow flexible processing e.g.
   for comma-separated values. To use e.g. with the :ts:`FLUIDTEMPLATE` content
   object.

   - The :php:`SplitProcessor` allows to split values separated with a delimiter
     inside a single database field into an array to loop over it.

   - The :php:`CommaSeparatedValueProcessor` allows to split values into a two-
     dimensional array used for CSV files or tt_content records of CType
     "table".

   - The :php:`FilesProcessor` resolves file references, files, or files inside a
     folder or collection to be used for output in the frontend. A
     :ts:`FLUIDTEMPLATE` can then simply iterate over processed data automatically.

   - The :php:`DatabaseQueryProcessor` works like the code from the Content Object
     CONTENT, except for just handing over the result as array. A :ts:`FLUIDTEMPLATE`
     can then simply iterate over processed data automatically.

   - The :php:`GalleryProcessor` provides the logic for working with galleries and
     calculates the maximum asset size. It uses the files already present in
     the `processedData` array for his calculations. The :php:`FilesProcessor` can be
     used to fetch the files.

   - The :php:`MenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu string
     that will be decoded again and assigned to :ts:`FLUIDTEMPLATE` as variable.
     Additional data processing is supported and will be applied to each record.

   - The :php:`LanguageMenuProcessor` utilizes :ts:`HMENU` to generate a JSON encoded menu
     string based on the site language configuration that will be decoded again
     and assigned to :ts:`FLUIDTEMPLATE` as variable.

   - The :php:`SiteProcessor` fetches data from the :ref:`site<t3coreapi:sitehandling>` entity.

   **With the help of the :php:`SplitProcessor` the following scenario is
   possible:** ::

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

            # All properties from .select can be used directly
            # + stdWrap
            colPos = 1
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

   Using the :php:`LanguageMenuProcessor` the following scenario is possible:

   Options:

   :`if`:         TypoScript if condition
   :`languages`:  A list of comma separated language IDs (e.g. 0,1,2) to use
                  for the menu creation or `auto` to load from site languages
   :`as`:         The variable to be used within the result

   .. code-block:: typoscript

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

   Using the :php:`SiteProcessor` the following scenario is possible:

   Options:

   :`as`: The variable to be used within the result

   .. code-block:: typoscript

      10 = TYPO3\CMS\Frontend\DataProcessing\SiteProcessor
      10 {
         as = site
      }

   In the Fluid template the properties of the site entity can be accessed:

   .. code-block:: html

      <p>{site.rootPageId}</p>
      <p>{site.someCustomConfiguration}</p>


.. _cobj-fluidtemplate-properties-stdwrap:

stdWrap
-------

.. rst-class:: dl-parameters

stdWrap
   :sep:`|`
   :aspect:`Data type:` :ref:`->stdWrap <stdwrap>`
   :sep:`|`

   Offers the usual stdWrap functionality.


.. _cobj-fluidtemplate-examples:

Example
=======

The Fluid template in
:file:`EXT:site_default/Resources/Private/Templates/MyTemplate.html` could look
like this:

.. code-block:: html

   <h1>{data.title}<f:if condition="{data.subtitle}">, {data.subtitle}</f:if></h1>
   <h3>{mylabel}</h3>
   <f:format.html>{data.bodytext}</f:format.html>
   <p>&copy; {settings.copyrightYear}</p>

You could use it with a TypoScript code like this:

.. code-block:: typoscript

   page = PAGE
   page.10 = FLUIDTEMPLATE
   page.10 {
      templateName = MyTemplate
      templateRootPaths {
         10 = EXT:site_default/Resources/Private/Templates
      }
      partialRootPaths {
         10 = EXT:site_default/Resources/Private/Partials
      }
      variables {
         mylabel = TEXT
         mylabel.value = Label coming from TypoScript!
      }
      settings {
         # Get the copyright year from a TypoScript constant.
         copyrightYear = {$year}
      }
   }

As a result the page title and the label from TypoScript will be inserted as
headlines. The copyright year will be taken from the TypoScript constant
"year".
