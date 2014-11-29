.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-user:
.. _cobj-user-int:

USER and USER\_INT
^^^^^^^^^^^^^^^^^^

This calls either a PHP function or a method in a class. This is very
useful if you want to incorporate your own data processing or content.

Basically USER and USER\_INT are user defined cObjects, because they
just call a function or method, which you control!

If you call a method in a class (which is of course instantiated as an
object), the internal variable '$cObj' of that class is set with a
*reference* to the parent cObject. This offers you an API of functions,
which might be more or less relevant for you. See
ContentObjectRenderer.php in the TYPO3 source code; access to typolink
or stdWrap are only two of the gimmicks you get.

If you create this object as USER\_INT, it will be rendered non-cached,
outside the main page-rendering.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         userFunc

   Data type
         function name

   Description
         The name of the function, which should be called. If you specify the
         name with a '->' in it, then it is interpreted as a call to a method in
         a class.

         Two parameters are sent to the PHP function: First a content variable
         (which is empty for USER/USER\_INT objects, but not when the user
         function is called from stdWrap functions .postUserFunc or
         .preUserFunc). The second parameter is an array with the properties of
         this cObject, if any.

         **Note:** When using a function, the name of the *function* has to
         start with "user\_". When using a class, the name of the *class* must
         start with "user\_" (there are no conditions on the name of the
         method).


.. container:: table-row

   Property
         includeLibs

   Data type
         *(list of resources)* /:ref:`stdWrap <stdwrap>`

   Description
         **This property applies only if the object is created as USER\_INT.**

         This is a comma-separated list of resources that are included as PHP-
         scripts (with include\_once() function) if this script is included.

         This is possible to do because any include-files will be known before
         the scripts are included.


.. container:: table-row

   Property
         *(properties you define)*

   Data type
         *(the data type you want)*

   Description
         Apart from the properties "userFunc", "stdWrap" and possibly
         "includeLibs", which are defined for all USER/USER\_INT objects by
         default, you can add additional properties with any name and any data
         type to your USER/USER\_INT object. These properties and their values
         will then be available in PHP; they will be passed to your function (in
         the second parameter). This allows you to process them further in any
         way you wish.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).USER/(cObject).USER\_INT]


.. _cobj-user-examples:
.. _cobj-user-int-examples:

Examples:
"""""""""

This example shows how to include your own PHP script and how to use it
from TypoScript. Use this TypoScript configuration::

   # Include the PHP file with our custom code
   includeLibs.time = fileadmin/example_time.php

   page = PAGE
   page.10 = USER_INT
   page.10 {
     userFunc = user_printTime
   }

The file fileadmin/example_time.php might amongst other things
contain::

   /**
    * Output the current time in red letters
    *
    * @param	string		Empty string (no content to process)
    * @param	array		TypoScript configuration
    * @return	string		HTML output, showing the current server time.
    */
   function user_printTime($content, $conf) {
     return '<p style="color: red;">Dynamic time: ' . date('H:i:s') . '</p><br />';
   }

Here page.10 will give back what the PHP function user_printTime()
returned. Since we did not use a USER object, but a USER\_INT object,
this function is executed on every page hit. So this example each time
outputs the current time in red letters.


Now let us have a look at another example:

We want to display all content element headers of a page in reversed
order. To do that we use the following TypoScript::

   page = PAGE
   page.typeNum = 0
   # Include the PHP file with our custom code
   includeLibs.listRecords = fileadmin/example_listRecords.php

   page.30 = USER
   page.30 {
     userFunc = user_various->listContentRecordsOnPage
     # reverseOrder is a boolean variable (see PHP code below)
     reverseOrder = 1
     # debugOutput is a boolean variable with /stdWrap (see PHP code below)
     debugOutput = 1
   }

The file fileadmin/example_listRecords.php might amongst other
things contain::

   /**
    * Example of a method in a PHP class to be called from TypoScript
    *
    */
   class user_various {
     /**
      * Reference to the parent (calling) cObject set from TypoScript
      */
     public $cObj;

     /**
      * List the headers of the content elements on the page
      *
      *
      * @param	string		Empty string (no content to process)
      * @param	array		TypoScript configuration
      * @return	string		HTML output, showing content elements (in reverse order, if configured)
      */
     public function listContentRecordsOnPage($content, $conf) {
       $query = $GLOBALS['TYPO3_DB']->SELECTquery(
         'header',
         'tt_content',
         'pid=' . intval($GLOBALS['TSFE']->id) . $this->cObj->enableFields('tt_content'),
         '',
         'sorting' . ($conf['reverseOrder'] ? ' DESC' : '')
       );

       $output = '';
       if (isset($conf['debugOutput.'])) {
         $conf['debugOutput'] = $this->cObj->stdWrap($conf['debugOutput'], $conf['debugOutput.']);
       }
       if ($conf['debugOutput']) {
         $output = 'This is the query: <strong>' . $query . '</strong><br /><br />';
       }

       return $output . $this->selectThem($query);
     }

     /**
      * Select the records by input $query and returning the header field values
      *
      * @param	string		SQL query selecting the content elements
      * @return	string		The header field values of the content elements imploded by a <br /> tag
      */
     protected function selectThem($query) {
       $res = $GLOBALS['TYPO3_DB']->sql_query($query);
       $output = array();
       while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
         $output[] = $row['header'];
       }
       return implode($output, '<br />');
     }
   }

page.30 will give back what the function listContentRecordsOnPage() of
the class user_various returned. This example returns some debug output
at the beginning and then the headers of the content elements on the
page in reversed order. Note how we defined the properties
"reverseOrder" and "debugOutput" for this USER object and how we used
them in the PHP code.


Another example can be found in the documentation of the stdWrap
property "postUserFunc". There you can also see how to work with $cObj,
the reference to the parent (calling) cObject.

