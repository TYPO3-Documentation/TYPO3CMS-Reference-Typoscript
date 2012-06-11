

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


Top-level objects
^^^^^^^^^^^^^^^^^


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
         types
   
   Data type
         readonly
   
   Description
         Types (internal)
         
         type=99 reserved for plaintext display
   
   Default


.. container:: table-row

   Property
         resources
   
   Data type
         readonly
   
   Description
         Resources in list (internal)
   
   Default


.. container:: table-row

   Property
         sitetitle
   
   Data type
         readonly
   
   Description
         SiteTitle (internal)
   
   Default


.. container:: table-row

   Property
         config
   
   Data type
         ->CONFIG
   
   Description
         Global configuration.
         
         These values are stored with cached pages which means they are also
         accessible when retrieving a cached page.
   
   Default


.. container:: table-row

   Property
         constants
   
   Data type
         ->CONSTANTS
   
   Description
         Site-specific constants, eg. a general email-adresse. These constants
         may be substituted in the text throughout the pages. The substitution
         is done by parseFunc. (Option: constants=1)
   
   Default


.. container:: table-row

   Property
         FEData
   
   Data type
         *->FE\_DATA*
   
   Description
         Here you can configure how data submitted from the front-end should be
         processed, which script and so on.
   
   Default


.. container:: table-row

   Property
         includeLibs
   
   Data type
         *Array of strings*
   
   Description
         With this you can include php-files with function libraries for use in
         your includescript in TYPO3.
         
         Please see the PAGE-object, which has the same property.
   
   Default


.. container:: table-row

   Property
         Other reserved TLO's:
         
         plugin
         
         tt\_\*
         
         temp
         
         styles
         
         lib
         
         \_GIFBUILDER
   
   Data type
   
   
   Description
         These top-level object names are reserved. That means you can risk
         static\_templates to use them:
         
         " **plugin** " is used for rendering of special content like boards,
         e-commerce solutions, guestbooks and so on. Normally set from
         static\_templates.  *Please see separate description below!*
         
         " **tt\_\*** ", eg tt\_content (from "content (default)") is used to
         render content from tables.
         
         " **temp** " and " **styles** " are used for conde-libraries you can
         copy during parse-time, but they are not saved with the template in
         cache.  ***"temp" / "styles" are unset*** before the templateis
         cached! Therefore use these names to store temporary data.
         
         " **lib** " can be used for a "library" of code, you can reference in
         TypoScript (unlike "styles" which is unset)
   
   Default


.. container:: table-row

   Property
         ...
   
   Data type
         ->PAGE
   
   Description
         Start a new page.
         
         **Example:**
         
         ::
         
            page = PAGE
            page.typeNum = 1
         
         **Guidelines:**
         
         Good, general PAGE object names to use are such as:
         
         *page* for the main page with content
         
         *frameset, frameset2* for framesets.
         
         *top, left, menu, right, bottom, border* for top and menu frames etc.
         
         These are just recommendations. Especially the name 'page' for the
         content bearing page is very common.
   
   Default


.. container:: table-row

   Property
         ...
   
   Data type
         *(whatever)*
   
   Description
         If a top-level object is not a PAGE-object it could be used as a
         temporary repository for setup. In this case you should use the "temp"
         or "styles" objects.
         
         "tt\_..." is normally used to define the setup of content-records. Eg.
         "tt\_content" would be used for the tt\_content-table as default. See
         the "CONTENT"-cObject
   
   Default


.. ###### END~OF~TABLE ######


[tsref:(TLO)]

