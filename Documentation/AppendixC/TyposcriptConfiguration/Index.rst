.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


TypoScript Configuration
^^^^^^^^^^^^^^^^^^^^^^^^

The following objects are related to the direct inclusion of PHP code
inside templates.

**Note** : These content objects were deprecated since TYPO3 4.5 and have
been removed in TYPO3 6.0. Use the content object "USER" instead!


PHP\_SCRIPT
"""""""""""

This includes a PHP-script.

NOTE: This option is ignored if ['FE']['noPHPscriptInclude'] => 1;
is set in LocalConfiguration.php
($TYPO3\_CONF\_VARS['FE']['noPHPscriptInclude'] = 1; in localconf.php).

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
         resource /stdWrap

   Description
         File that will be included. This file must be valid PHP-code! It's
         included with "include()";

         **Directions:**

         **1) All content must be put into $content.** No output must be
         echo'ed out!

         2) Call $GLOBALS['TSFE']->set\_no\_cache(), if you want to disable
         caching of the page.Set this during development! And set it, if the
         content you create may not be cached.

         **NOTE:** If you have a parsing error in your include script the
         $GLOBALS['TSFE']->set\_no\_cache()function is NOT executed and thereby
         does not disable caching. Upon a parse-error you must manually clear
         the page-cache after you have corrected your error!

         3) the array $confcontains the configuration for the PHP\_SCRIPT
         cObject. Try debug($conf) to see the content printed out for
         debugging!

         *See the appendix later in this manual for an introduction to writing
         your own PHP include-scripts.*

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).PHP\_SCRIPT]


PHP\_SCRIPT\_INT
""""""""""""""""

(see PHP\_SCRIPT)

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
         resource /stdWrap

   Description
         File that will be included. This file must be valid PHP-code! It's
         included with "include()";

         **Purpose:**

         This basically works like PHP\_SCRIPT. But the vital difference is
         that inserting a PHP\_SCRIPT **\_INT** (internal opposed to external,
         see below) merely inserts a divider-string in the code and then
         serializes the current cObj and puts it in the
         $GLOBALS['TSFE']->config['INTincScript']-array. This array is saved
         with the cached page-content.

         Now, the point is, that including a script like this lets you avoid
         disabling pagecaching. The reason is that the cached page contains the
         divider string and when a "static" page is fetched from cache, it's
         divided by that string and the dynamic content object is inserted.

         This is the compromise option of all three PHP\_SCRIPT-cObjects,
         because the page-data is all cached, but still the pagegen.php script
         is included, which initializes all the classes, objects and so. What
         you gain here is an environment for your script almost exactly the
         same as PHP\_SCRIPT because your script is called from inside a class
         ContentObjectRenderer (tslib\_cObj) object. You can work with all
         functions of the ContentObjectRenderer (tslib\_cObj) class. But still
         all the "static" page content is only generated once, cached and only
         your script is dynamically rendered.

         **Rules:**

         \- calls to $GLOBALS['TSFE']->set\_no\_cache()and
         $GLOBALS['TSFE']->set\_cache\_timeout\_default() makes no sense in
         this situation.

         \- parsing errors do not interfere with caching

         \- Be aware that certain global variables may not be set as usual and
         be available as usual when working in this mode. Most scripts should
         work out-of-the-box with this option though.

         \- Dependence and use of LOAD\_REGISTER is fragile because the
         PHP\_SCRIPT\_INT is not rendered until  *after* the cached content and
         due to this changed order of events, use of LOAD\_REGISTER may not
         work.

         \- You can not nest PHP\_SCRIPT\_INT and PHP\_SCRIPT\_EXT in
         PHP\_SCRIPT\_INT. You may nest PHP\_SCRIPT cObjects though.

   Default


.. container:: table-row

   Property
         includeLibs

   Data type
         *list of* resource

   Description
         This is a comma-separated list of resources that are included as PHP-
         scripts (with include\_once() function) if this script is included.

         This is possible to do because any include-files will be known before
         the scripts are included. That's not the case with the regular
         PHP\_SCRIPT cObject.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######

[tsref:(cObject).PHP\_SCRIPT\_INT]


PHP\_SCRIPT\_EXT
""""""""""""""""

(see PHP\_SCRIPT)


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
         resource /stdWrap

   Description
         File that will be included. This file must be valid PHP-code! It's
         included with "include()";

         **Purpose:**

         This works like PHP\_SCRIPT\_INT, because a divider string is also
         inserted in the content for this kind of include-script. But the
         difference is thatthe content is divided as the very last thing before
         it's output to the browser.

         This basically means that PHP\_SCRIPT **\_EXT** (external, because
         it's included in the global space in index\_ts.php file!!) can output
         data directly with echo-statements!

         This is a very "raw" version of PHP\_SCRIPT because it's not included
         from inside an object and you have only very few standard functions
         from TYPO3 to call.

         This is the fastest option of all three PHP\_SCRIPT-cObjects, because
         the page-data is all cached and your dynamic content is generated by a
         raw php-script.

         **Rules:**

         \- All content can be either 1) echo'ed out directly, or 2) returned
         in $content.

         \- calls to $GLOBALS['TSFE']->set\_no\_cache()and
         $GLOBALS['TSFE']->set\_cache\_timeout\_default() makes no sense in
         this situation.

         \- parsing errors do not interfere with caching

         \- In the global name-space, the array $REC contains the current
         record when the file was "inserted" on the page, and $CONF-array
         contains the configuration for the script.

         \- Don't mess with the global vars named $EXTiS\_\*

   Default


.. container:: table-row

   Property
         includeLibs

   Data type
         *list of* resource

   Description
         This is a comma-separated list of resources that are included as PHP-
         scripts (with include\_once() function) if this script is included.

         This is possible to do because any include-files will be known before
         the scripts are included. That's not the case with the regular
         PHP\_SCRIPT cObject.

   Default


.. container:: table-row

   Property
         stdWrap

   Data type
         ->stdWrap

   Description


   Default


.. ###### END~OF~TABLE ######


[tsref:(cObject).PHP\_SCRIPT\_EXT]

