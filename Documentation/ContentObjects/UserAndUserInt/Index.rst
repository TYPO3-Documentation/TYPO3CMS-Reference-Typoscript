.. include:: /Includes.rst.txt
.. index::
   Content objects; USER
   Content objects; USER_INT
   PHP
   pair: PHP; Call a PHP function
   pair: PHP; Call a PHP method
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
:file:`ContentObjectRenderer.php` in the TYPO3 source code; access to :typoscript:`typolink`
or :typoscript:`stdWrap` are only two of the gimmicks you get.

If you create this object as :typoscript:`USER_INT`, it will be rendered non-cached,
outside the main page-rendering.

userFunc
========

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         userFunc

   Data type
         :ref:`data-type-function-name`

   Description
         The name of the function, which should be called. If you specify the
         name with a '->' in it, then it is interpreted as a call to a method in
         a class.

         Three parameters are sent to the PHP function: First a :php:`string $content` variable
         (which is empty for USER/USER\_INT objects, but not when the user
         function is called from stdWrap functions .postUserFunc or
         .preUserFunc). The second parameter is an array (:php:`$configuration`) with the properties
         of this cObject, if any. As third parameter, the current :php:`ServerRequestInterface $request`
         is passed.

.. note::

   The :php:`$request` object should be used to access request related variables instead of directly accessing
   the superglobal variables like :php:`$_GET` / :php:`$_POST` / :php:`$_SERVER`, or TYPO3’s API methods :php:`GeneralUtility::_GP()`
   and :php:`GeneralUtility::getIndpEnv()`.

.. ###### END~OF~TABLE ######

(properties you define)
=======================

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         (properties you define)

   Data type
         (the data type you want)

   Description
         Apart from the properties "userFunc" and "stdWrap", which are defined for
         all USER/USER\_INT objects by default, you can add additional properties
         with any name and any data type to your USER/USER\_INT object. These
         properties and their values will then be available in PHP; they will be
         passed to your function (in the second parameter). This allows you to
         process them further in any way you wish.

.. ###### END~OF~TABLE ######

stdWrap
=======

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         stdWrap

   Data type
         Everything that's made available by :ref:`stdWrap`.

.. ###### END~OF~TABLE ######


cache
=====

.. ### BEGIN~OF~TABLE ###

.. include:: ../../DataTypes/Properties/Cache.rst.txt

.. ###### END~OF~TABLE ######


.. _cobj-user-examples:
.. _cobj-user-int-examples:

Examples
========

.. attention::

   For the best result you should *always*, without exception, place your class files in
   an extension, define composer class loading for this extension and add this extension as
   a dependency of your project. Then, your classes will load without issues when you refer
   to them by their class name.

Example 1
---------

This example shows how to include your own PHP script and how to use it
from TypoScript. Use this TypoScript configuration:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page = PAGE
   page.10 = USER_INT
   page.10 {
     userFunc = Vendor\SitePackage\UserFunctions\ExampleTime->printTime
   }

The file :file:`EXT:site_package/Classes/UserFunctions/ExampleTime.php` might
amongst other things contain:

.. code-block:: php

   namespace Vendor\SitePackage\UserFunctions;

   final class ExampleTime {
     /**
      * Output the current time in red letters
      *
      * @param	string		Empty string (no content to process)
      * @param	array		TypoScript configuration
      * @return	string		HTML output, showing the current server time.
      */
     public function printTime(string $content, array $conf): string
     {
       return '<p style="color: red;">Dynamic time: ' . date('H:i:s') . '</p><br />';
     }
   }

Here :typoscript:`page.10` will give back what the PHP function :php:`printTime()`
returned. Since we did not use a :typoscript:`USER` object, but a
:typoscript:`USER_INT` object, this function is executed on every page hit.
Thus, in this example, the current time is displayed in red letters each time.

Example 2
---------

Now let us have a look at another example:

We want to display all content element headers of a page in reversed
order. For this we use the following TypoScript:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page = PAGE
   page.typeNum = 0

   page.30 = USER
   page.30 {
      userFunc = Vendor\SitePackage\UserFunctions\ExampleListRecords->listContentRecordsOnPage
      # reverseOrder is a boolean variable (see PHP code below)
      reverseOrder = 1
   }

The file :file:`EXT:site_package/Classes/UserFunctions/ExampleListRecords.php`
might amongst other things contain:

.. code-block:: php

   namespace Vendor\SitePackage\UserFunctions;

   use TYPO3\CMS\Core\Database\ConnectionPool;
   use TYPO3\CMS\Core\Utility\GeneralUtility;
   use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

   /**
    * Example of a method in a PHP class to be called from TypoScript
    *
    */
   final class ExampleListRecords {

      /**
       * Reference to the parent (calling) cObject set from TypoScript
       *
       * @var ContentObjectRenderer
       */
      private $cObj;

      public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
      {
         $this->cObj = $cObj;
      }

      /**
        * List the headers of the content elements on the page
        *
        *
        * @param  string Empty string (no content to process)
        * @param  array  TypoScript configuration
        * @return string HTML output, showing content elements (in reverse order, if configured)
        */
      public function listContentRecordsOnPage(string $content, array $conf): string
      {
         $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
         $result = $connection->select(
             ['header'],
             'tt_content',
             ['pid' => (int)$GLOBALS['TSFE']->id],
             [],
             ['sorting' => $conf['reverseOrder'] ? 'DESC' : 'ASC']
         );
         $output = [];
         foreach ($result as $row) {
             $output[] = $row['header'];
         }
         return implode($output, '<br />');
      }
   }

Since we need an instance of the :php:`ContentObjectRenderer` class, we are using
the :php:`setContentObjectRenderer()` method to get it and store it in the
:php:`cObj` class property for later use.

:typoscript:`page.30` will give back what the function :php:`listContentRecordsOnPage()` of
the class YourClass returned. This example returns some debug output
at the beginning and then the headers of the content elements on the
page in reversed order. Note how we defined the property
"reverseOrder" for this USER object and how we used it in the PHP code.


Example 3
---------

Another example can be found in the documentation of the stdWrap
property :ref:`stdwrap-postUserFunc` There you can also see how to work with
:php:`$cObj`, the reference to the parent (calling) cObject.

Example 4
---------

PHP has a function :php:`gethostname()` to "get the standard host name for
the local machine". You can make it available like this:

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   page.20 = USER_INT
   page.20 {
      userFunc = Vendor\SitePackage\UserFunctions\Hostname->getHostname
   }

Contents of :file:`EXT:site_package/Classes/UserFunctions/Hostname.php`:

.. code-block:: php

   namespace Vendor\SitePackage\UserFunctions;

   final class Hostname {
      /**
       * Return standard host name for the local machine
       *
       * @param  string Empty string (no content to process)
       * @param  array  TypoScript configuration
       * @return string HTML result
       */
      public function getHostname(string $content, array $conf): string
         {
            return gethostname() ?: '';
         }
      }
