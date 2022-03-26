.. include:: /Includes.rst.txt


.. _data-type-function-name:

function name
=============

.. container:: table-row

   Data type
         function name

   Examples
         Function::

            user_reverseString

         Method in class::

            user_stringReversing->reverseString

         Method in class, namespaced and preferred version::

            Your\NameSpace\YourClass->reverseString

   Comment
         Indicates a function or method in a class to call. See more
         information at the :ref:`USER cObject <cobj-user>`.

         Depending on implementation the class or function name (but not the
         method name) should probably be prefixed with "user\_". The prefix
         can be changed in the $TYPO3\_CONF\_VARS config though. The function /
         method is normally called with 2 parameters, $conf (TS configuration)
         and $content (some content to be processed and returned).

         Also if you call a method in a class, it is checked (when using the
         USER/USER\_INT objects) whether a class with the same name, but
         prefixed with "ux\_" is present and if so, *this* class is
         instantiated instead. See the document "Inside TYPO3" for more
         information on extending classes in TYPO3!


