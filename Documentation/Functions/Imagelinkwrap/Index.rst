

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


imageLinkWrap
^^^^^^^^^^^^^

This object wraps the input (an image) with a link ready for calling
up the eID "tx\_cms\_showpic" script with parameters that define such
things as the size of the image, the background color of the new
window and so on.

An md5-hash of the parameters is generated. The hash is also generated
in the "tx\_cms\_showpic" script and the hashes MUST match in order
for the image to be shown. This is a safety feature in order to
prevent users from changing the parameters in the URL themselves.

Since TYPO3 4.5 it is also possible to display the image in a lightbox
instead of using showpic.php. See the property "linkParams" below for
a short instruction.


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         file
   
   Data type
         stdWrap
   
   Description
         Override the path of the image which is displayed
   
   Default


.. container:: table-row

   Property
         width
   
   Data type
         int (1-1000) /stdWrap
   
   Description
         If you add "m" to either the width or height, the image will be held
         in proportions and width/height works as max-dimensions
   
   Default


.. container:: table-row

   Property
         height
   
   Data type
         int (1-1000) /stdWrap
   
   Description
         see ".width"
   
   Default


.. container:: table-row

   Property
         effects
   
   Data type
         see GIFBUILDER / effects. (from stdgraphics-library)
         
         /stdWrap
   
   Description
         **Example:**
         
         ::
         
            gamma=1.3 | sharpen=80 | solarize=70
   
   Default


.. container:: table-row

   Property
         sample
   
   Data type
         boolean /stdWrap
   
   Description
         If set, -sample is used to scale images instead of -geometry. Sample
         does not use antialiasing and is therefore much faster.
   
   Default


.. container:: table-row

   Property
         alternativeTempPath
   
   Data type
         path /stdWrap
   
   Description
         Enter an alternative path to use for temp images. Must be found in the
         list in $TYPO3\_CONF\_VARS['FE']['allowedTempPaths'].
   
   Default


.. container:: table-row

   Property
         title
   
   Data type
         string /stdWrap
   
   Description
         page title of the new window (HTML)
   
   Default


.. container:: table-row

   Property
         bodyTag
   
   Data type
         <tag> /stdWrap
   
   Description
         Body tag of the new window
   
   Default


.. container:: table-row

   Property
         wrap
   
   Data type
         wrap /stdWrap
   
   Description
         Wrap of the image, which is output between the body-tags
   
   Default


.. container:: table-row

   Property
         target
   
   Data type
         <A>-data:target /stdWrap
   
   Description
         NOTE: Only if ".JSwindow" is set
   
   Default


.. container:: table-row

   Property
         JSwindow
   
   Data type
         boolean /stdWrap
   
   Description
         If set to "1", the image will be opened in a new window which is
         fitted to the dimensions of the image!
         
         You can also use stdWrap here.
   
   Default


.. container:: table-row

   Property
         JSwindow.expand
   
   Data type
         x,y /stdWrap
   
   Description
         x and y is added to the window dimensions.
   
   Default


.. container:: table-row

   Property
         JSwindow.newWindow
   
   Data type
         boolean /stdWrap
   
   Description
         Each picture will open in a new window!
   
   Default


.. container:: table-row

   Property
         JSwindow.altUrl
   
   Data type
         string /stdWrap
   
   Description
         If this returns anything, the URL shown in the JS-window is NOT
         tx\_cms\_showpic but the url given here!
   
   Default


.. container:: table-row

   Property
         JSwindow.altUrl\_noDefaultParams
   
   Data type
         boolean
   
   Description
         If this is set, the image parameters are not appended to the altUrl
         
         automatically. This is useful if you want to create them with a user
         function
         
         instead.
   
   Default


.. container:: table-row

   Property
         typolink
   
   Data type
         ->typolink
   
   Description
         NOTE: This overrides the imageLinkWrap if it returns anything!!
   
   Default


.. container:: table-row

   Property
         directImageLink
   
   Data type
         boolean /stdWrap
   
   Description
         If true, a link to the generated image file will be returned directly
         (which means that showpic.php will not be used).
   
   Default
         0


.. container:: table-row

   Property
         linkParams
   
   Data type
         ->typolink
   
   Description
         Allows manipulation of the generated typolink, if JSwindow is not
         used.
         
         **Example:**
         
         ::
         
            JSwindow = 0
            directImageLink = 1
            linkParams.ATagParams.dataWrap = class="{$styles.content.imgtext.linkWrap.lightboxCssClass}" rel="{$styles.content.imgtext.linkWrap.lightboxRelAttribute}"
         
         With these options it is easy to use a lightbox of your choice to
         display resizable images in the frontend: You only need to integrate
         the lightbox by including its JS and CSS files and to activate it for
         certain links (e.g. for links with the class "lightbox").
   
   Default


.. container:: table-row

   Property
         stdWrap
   
   Data type
         ->stdWrap
   
   Description
         Enable stdWrap for the image
   
   Default


.. container:: table-row

   Property
         enable
   
   Data type
         boolean /stdWrap
   
   Description
         **The image is linked ONLY if this is true!!**
   
   Default
         0


.. ###### END~OF~TABLE ######


[tsref:->imageLinkWrap]


((generated))
"""""""""""""

Example:
~~~~~~~~

::

   1.imageLinkWrap = 1
   1.imageLinkWrap {
           enable = 1
           bodyTag = <BODY bgColor=black>
           wrap = <A href="javascript:close();"> | </A>
           width = 800m
           height = 600
   
           JSwindow = 1
           JSwindow.newWindow = 1
           JSwindow.expand = 17,20
   }

