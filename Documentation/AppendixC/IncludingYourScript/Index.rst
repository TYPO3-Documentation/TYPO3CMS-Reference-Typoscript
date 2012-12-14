.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _appendix-include-scripts:

Including your script
^^^^^^^^^^^^^^^^^^^^^

Your script is included by a function, PHP\_SCRIPT, inside the class
"ContentObjectRenderer" (tslib\_cObj) in the
typo3/sysext/frontend/Classes/ContentObject/ContentObjectRenderer.php
(tslib\_content.php) script. Thereby your file is a part of this object
(ContentObjectRenderer, respectively tslib\_cObj) and function. This is
why you must return all content in the variable "$content" and any
TypoScript-configuration is available from the array "$conf" (it may
not be set at all though so check it with is\_array()!)


.. _appendix-include-conf:

$conf
"""""

The array $conf contains the configuration for the PHP\_SCRIPT cObject.
Try debug($conf) to see the content printed out for debugging!


.. _appendix-include-content:

$content
""""""""

Return all content in this variable.

Remember, don't output anything (but debug code) in your script!


.. _appendix-include-white-spaces:

White spaces
""""""""""""

Because nothing is sent off to the browser before everything is
rendered and returned to index\_ts.php which originally set of the
rendering process, you must ensure that there's no whitespace before
and after your <?php...?> tags in your include- or library-scripts!


.. _appendix-include-tsfe:

$GLOBALS['TSFE']->set\_no\_cache()
""""""""""""""""""""""""""""""""""

Call the function $GLOBALS['TSFE']->set\_no\_cache(), if you want to
disable caching of the page.Call this during development! And call it,
if the content you create may not be cached.

**Note:** If you make a syntax error in your script that keeps PHP
from executing it, then the $GLOBALS['TSFE']->set\_no\_cache()
function is not executed and the page  *is* cached! So in these
situations, correct the error, clear the page-cache and try again.
This is true only for PHP\_SCRIPT and not for PHP\_SCRIPT\_INT and
PHP\_SCRIPT\_EXT which are rendered  *after* the cached page!


Example:
~~~~~~~~

::

   $GLOBALS['TSFE']->set_no_cache();


.. _appendix-include-cobjgetsingle:

$this->cObjGetSingle( value , properties )
""""""""""""""""""""""""""""""""""""""""""

Gets a content-object from the $conf-array. (See the section below
named "Case story" on how to use this!)


Example:
~~~~~~~~

::

   $content = $this->cObjGetSingle($conf['image'], $conf['image.']);

This would return any IMAGE-cObject at the property "image" of the
conf-array for the include-script!


.. _appendix-include-stdwrap:

$this->stdWrap( value, properties )
"""""""""""""""""""""""""""""""""""

stdWrap's the content "value" due to the configuration of the array
"properties".


Example:
~~~~~~~~

::

   $content = $this->stdWrap($content, $conf['stdWrap.']);

This will stdWrap the content with the properties of ".stdWrap" of the
$conf-array!


.. _appendix-include-internal-vars:

Internal Vars in the main frontend object, TSFE (TypoScript Front End)
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

There are some variables in the global object, TSFE, you might need to
know about. These ARE ALL READ-ONLY! (Read: Don't change them!) See
the class TypoScriptFrontendController (tslib\_fe) for the full
descriptions.

If you for instance want to access the variable "id", you can do so by
writing: $GLOBALS['TSFE']->id

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Var
         Var:

   PHP-Type
         PHP-Type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Var
         id

   PHP-Type
         integer

   Description
         The page id


.. container:: table-row

   Var
         type

   PHP-Type
         integer

   Description
         The type


.. container:: table-row

   Var
         page

   PHP-Type
         array

   Description
         The pagerecord


.. container:: table-row

   Var
         fe\_user

   PHP-Type
         object

   Description
         The current front-end user.

         Userrecord in $GLOBALS['TSFE']->fe\_user->user, if any login.


.. container:: table-row

   Var
         loginUser

   PHP-Type
         boolean

   Description
         Flag indicating that a front-end user is logged in.

   Default
         0


.. container:: table-row

   Var
         rootLine

   PHP-Type
         array

   Description
         The rootLine (all the way to tree root, not only the current site!).
         Current site root line is in $GLOBALS['TSFE']->tmpl->rootLine


.. container:: table-row

   Var
         sys\_page

   PHP-Type
         object

   Description
         The object with pagefunctions (object) See
         typo3/sysext/frontend/Classes/Page/PageRepository.php
         (t3lib/class.t3lib_page.php).


.. container:: table-row

   Var
         gr\_list

   PHP-Type
         string (list)

   Description
         The group list, sorted numerically. Group -1 = no login


.. container:: table-row

   Var
         beUserLogin

   PHP-Type
         boolean

   Description
         Flag that indicates if a Backend user is logged in!

   Default
         0


.. ###### END~OF~TABLE ######


.. _appendix-include-global-vars:

Global vars
"""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Var
         Var:

   PHP-Type
         PHP-Type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Var
         BE\_USER

   PHP-Type
         object

   Description
         The back-end user object (if any).

   Default
         not set


.. container:: table-row

   Var
         TYPO3\_CONF\_VARS

   PHP-Type
         array

   Description
         TYPO3 Configuration.


.. container:: table-row

   Var
         TSFE

   PHP-Type
         object

   Description
         Main frontend object.


.. ###### END~OF~TABLE ######

