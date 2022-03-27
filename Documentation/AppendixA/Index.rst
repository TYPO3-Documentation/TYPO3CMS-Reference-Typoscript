.. include:: /Includes.rst.txt
.. _appendix-a:

================================
Appendix A – PHP include scripts
================================

.. _appendix-include-scripts:

Including your script
=====================

This section should give you some pointers on what you can process in
your script and which functions and variables you can access.

Your script is included inside the class "ContentObjectRenderer" in the
:file:`typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php`
script. Thereby your file is a part of this object
(ContentObjectRenderer). This is why you must return all
content in the variable "$content" and any TypoScript configuration is
available from the array "$conf" (it may not be set at all though, so
check it with is\_array()!)


.. _appendix-include-content:

$content
--------

Contains the content, which was passed to the object, if any. All
content, which you want to return, must be in this variable!

Remember, don't output anything (but debug code) directly in your
script!


.. _appendix-include-conf:

$conf
-----

The array $conf contains the configuration for the USER cObject.
Try debug($conf) to see the content printed out for debugging!


.. _appendix-include-white-spaces:

White spaces
------------

Because nothing is sent off to the browser before everything is
rendered and returned to :php:`\TYPO3\CMS\Frontend\Http\RequestHandler`
(which originally set off the rendering process), you must ensure
that there's no whitespace before your :php:`<?php` tag
in your include or library scripts! You should not use the closing PHP tag
:php:`?>`.


.. _appendix-include-tsfe:

$GLOBALS['TSFE']->set\_no\_cache()
----------------------------------

Call the function :php:`$GLOBALS['TSFE']->set_no_cache()`, if you want to
disable caching of the page. Call this during development only! And
call it, if the content you create may not be cached.

**Note:** If you make a syntax error in your script that keeps PHP
from executing it, then the :php:`$GLOBALS['TSFE']->set_no_cache()`
function is not executed and the page *is* cached! So in these
situations, correct the error, clear the page-cache and try again.
This is true only for :typoscript:`USER` and not for :typoscript:`USER_INT`, which is
rendered *after* the cached page!


Example:
~~~~~~~~

.. code-block:: php

   $GLOBALS['TSFE']->set_no_cache();


.. _appendix-include-cobjgetsingle:

$this->cObjGetSingle(value, properties[, TSkey = '__'])
-------------------------------------------------------

Gets a content object from the $conf array. $TSkey is an optional string label used for the internal debugging tracking.


Example:
~~~~~~~~

.. code-block:: php

   $content = $this->cObjGetSingle($conf['image'], $conf['image.'], 'My Image 2');

This would return any IMAGE cObject at the property "image" of the
$conf array for the include script!


.. _appendix-include-stdwrap:

$this->stdWrap(value, properties)
---------------------------------

Hands the content in "value" to the stdWrap function, which will
process it according to the configuration of the array "properties".


Example:
~~~~~~~~

.. code-block:: php

   $content = $this->stdWrap($content, $conf['stdWrap.']);

This will stdWrap the content with the properties of ".stdWrap" of the
$conf array!


.. _appendix-include-internal-variables:

Internal variables in the main frontend object, TSFE
====================================================

There are some variables in the global object, TSFE (TypoScript
Frontend), you might need to know about. These ARE ALL READ-ONLY!
(Read: Don't change them!) See the class :php:`TypoScriptFrontendController`
for the full descriptions.

.. important::

   In previous versions, the properties `gr_list`, `loginUser` and `beUserLogin` where
   used for context specific information. Since TYPO3 v9 these variables have been
   replaced by the :ref:`TYPO3 Context API <t3coreapi:context-api>`.

If you for instance want to access the variable "id", you can do so by
writing: :php:`$GLOBALS['TSFE']->id`

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Variable
         id

   PHP-Type
         integer

   Description
         The page id


.. container:: table-row

   Variable
         type

   PHP-Type
         integer

   Description
         The type


.. container:: table-row

   Variable
         page

   PHP-Type
         array

   Description
         The page record


.. container:: table-row

   Variable
         fe\_user

   PHP-Type
         object

   Description
         The current front-end user.

         User record in :php:`$GLOBALS['TSFE']->fe_user->user`, if any login.


.. container:: table-row

   Variable
         rootLine

   PHP-Type
         array

   Description
         The rootLine (all the way to tree root, not only the current site!).
         Current site root line is in :php:`$GLOBALS['TSFE']->tmpl->rootLine`


.. container:: table-row

   Variable
         sys\_page

   PHP-Type
         object

   Description
         The object with page functions (object) See
         :file:`typo3/sysext/core/Classes/Domain/Repository/PageRepository.php`.


.. ###### END~OF~TABLE ######


.. _appendix-include-global-variables:

Global variables
================

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Variable
         BE\_USER

   PHP-Type
         object

   Description
         The backend user object (if any).

   Default
         not set


.. container:: table-row

   Variable
         TYPO3\_CONF\_VARS

   PHP-Type
         array

   Description
         TYPO3 Configuration.


.. container:: table-row

   Variable
         TSFE

   PHP-Type
         object

   Description
         Main frontend object.


.. ###### END~OF~TABLE ######

