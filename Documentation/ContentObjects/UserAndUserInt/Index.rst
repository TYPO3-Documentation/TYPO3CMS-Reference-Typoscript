.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _cobj-user:
.. _cobj-user-int:

USER and USER\_INT
^^^^^^^^^^^^^^^^^^

This calls either a PHP-function or a method in a class. This is very
useful if you want to incorporate your own data processing or content.

Basically this is a user defined cObject, because it's just a call to a
function or method you control!

An important thing to know is that if you call a method in a class
(which is of course instantiated as an object) the internal variable
'cObj' of that class is set with a *reference* to the parent cObj.
See the file
typo3/sysext/statictemplates/media/scripts/example\_callfunction.php for an
example of how this may be useful for you. Basically it offers you an
API of functions which are more or less relevant for you. Refer to the
appendix "PHP include scripts" at the end of this document.

If you create this object as USER\_INT, it will be rendered non-cached,
outside the main page-rendering.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         userFunc

   Data type
         function name

   Description
         The name of the function. If you specify the name with a '->' in it,
         it's interpreted as a call to a method in a class.

         Two parameters are sent: First a content variable (which is empty in
         this case, but not when used from stdWrap function .postUserFunc and
         .preUserFunc). And the second parameter is an array with the properties
         of this cObject if any.

         **Example:**

         This TypoScript will display all content element headers of a page in
         reversed order. Please take a look at
         typo3/sysext/statictemplates/media/scripts/example\_callfunction.php! ::

            page = PAGE
            page.typeNum=0
            includeLibs.something = typo3/sysext/statictemplates/media/scripts/example_callfunction.php

            page.30 = USER
            page.30 {
              userFunc = user_various->listContentRecordsOnPage
              reverseOrder = 1
            }

         **Note:** When using a function, the name of the function has to start
         with "user\_". When using a class, the name of the class must start
         with "user\_" (there are no conditions on the name of the method).


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
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).USER/(cObject).USER\_INT]

