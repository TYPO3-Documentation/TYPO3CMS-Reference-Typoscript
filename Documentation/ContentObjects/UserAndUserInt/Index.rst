
.. include:: ../../Includes.txt

.. _cobj-user:
.. _cobj-user-int:

==================
USER and USER\_INT
==================

This calls either a PHP function or a method in a class. This is very
useful if you want to incorporate your own data processing or content.

Basically USER and USER\_INT are user defined cObjects, because they
just call a function or method, which you control!

If you call a method in a class (which is of course instantiated as an
object), the internal variable :php:`$cObj` of that class is set with a
*reference* to the parent cObject. This offers you an API of functions,
which might be more or less relevant for you. See
:file:`ContentObjectRenderer.php` in the TYPO3 source code; access to :ts:`typolink`
or :ts:`stdWrap` are only two of the gimmicks you get.

If you create this object as :ts:`USER\_INT`, it will be rendered non-cached,
outside the main page-rendering.

userFunc
========

:aspect:`Property`
      userFunc

:aspect:`Data type`
      function name

:aspect:`Description`
      The name of the function, which should be called. If you specify the
      name with a '->' in it, then it is interpreted as a call to a method in
      a class.

      Two parameters are sent to the PHP function: First a content variable
      (which is empty for USER/USER\_INT objects, but not when the user
      function is called from stdWrap functions .postUserFunc or
      .preUserFunc). The second parameter is an array with the properties of
      this cObject, if any.


Property
========

:aspect:`Property`
      myPropertyAbc

:aspect:`Data type`
      myDataTypeAbc

:aspect:`Description`
      Apart from the properties "userFunc" and "stdWrap", which are defined for
      all USER/USER\_INT objects by default, you can add additional properties
      with any name and any data type to your USER/USER\_INT object. These
      properties and their values will then be available in PHP; they will be
      passed to your function (in the second parameter). This allows you to
      process them further in any way you wish.


stdWrap
=======

:aspect:`Property`
      stdWrap

:aspect:`Data type`
      Everything that's made available by :ref:`stdWrap`.




.. _cobj-user-examples:
.. _cobj-user-int-examples:

=========
Examples:
=========

Example 1
=========

This example shows how to include your own PHP script and how to use it
from TypoScript. Use this TypoScript configuration::

   page = PAGE
   page.10 = USER_INT
   page.10 {
     userFunc = Your\NameSpace\YourClass->printTime
   }

The file fileadmin/example_time.php might amongst other things
contain::

   namespace Your\NameSpace;
   class YourClass {
     /**
      * Output the current time in red letters
      *
      * @param	string		Empty string (no content to process)
      * @param	array		TypoScript configuration
      * @return	string		HTML output, showing the current server time.
      */
     public function printTime($content, $conf) {
       return '<p style="color: red;">Dynamic time: ' . date('H:i:s') . '</p><br />';
     }
   }

Here page.10 will give back what the PHP function printTime()
returned. Since we did not use a USER object, but a USER\_INT object,
this function is executed on every page hit. So this example each time
outputs the current time in red letters.

Example 2
=========

Now let us have a look at another example:

We want to display all content element headers of a page in reversed
order. To do that we use the following TypoScript::

   page = PAGE
   page.typeNum = 0

   page.30 = USER
   page.30 {
      userFunc = Your\NameSpace\YourClass->listContentRecordsOnPage
      # reverseOrder is a boolean variable (see PHP code below)
      reverseOrder = 1
      # debugOutput is a boolean variable with /stdWrap (see PHP code below)
      debugOutput = 1
   }

The file fileadmin/example_listRecords.php might amongst other
things contain::

   namespace Your\NameSpace;
   /**
    * Example of a method in a PHP class to be called from TypoScript
    *
    */
   class YourClass {
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
         'pid=' . intval($GLOBALS['TSFE']->id) .
           $this->cObj->enableFields('tt_content'),
         '',
         'sorting' . ($conf['reverseOrder'] ? ' DESC' : '')
       );

       $output = '';
       if (isset($conf['debugOutput.'])) {
         $conf['debugOutput'] = $this->cObj->stdWrap($conf['debugOutput'], $conf['debugOutput.']);
       }https://bitbucket.org/birkenfeld/pygments-main
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

:ts:`page.30` will give back what the function :php:`listContentRecordsOnPage()` of
the class YourClass returned. This example returns some debug output
at the beginning and then the headers of the content elements on the
page in reversed order. Note how we defined the properties
"reverseOrder" and "debugOutput" for this USER object and how we used
them in the PHP code.


Example 3
=========

Another example can be found in the documentation of the stdWrap
property :ref:`stdwrap-postUserFunc` There you can also see how to work with
:php:`$cObj`, the reference to the parent (calling) cObject.

Example 4
=========

PHP has a function :php:`gethostname()` to "get the standard host name for
the local machine". You can make it available like this::

   page.20 = USER_INT
   page.20 {
      userFunc = MyVendorName\Hostname->get_hostname
   }

Contents of :file:`fileadmin/gethostname.php`:

.. code-block:: php

   <?php namespace MyVendorName;
      class Hostname {
         /**
          * Return standard host name for the local machine
          *
          * @param  string          Empty string (no content to process)
          * @param  array           TypoScript configuration
          * @return string          HTML result
          */
         public function get_hostname($content, $conf) {
            return gethostname();
         }
      }
