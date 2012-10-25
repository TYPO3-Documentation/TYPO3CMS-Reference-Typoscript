.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


Case story
^^^^^^^^^^

This is a case story of how to use include-scripts.

In this situation we would like to use some libraries of our very own,
not part of TYPO3. Therefore we use the feature of including a library
at the very beginning of the page-parsing.

First we put this TypoScript line in the "Setup"-field of the
template::

   config.includeLibrary = fileadmin/scripts/include.inc

The file  **include.inc** is now included (in
typo3/sysext/frontend/Classes/Page/PageGenerator.php, in older
versions in typo3/sysext/cms/tslib/class.tslib\_pagegen.php). In this
case it looks like this:

file: fileadmin/scripts/include.inc ::

   <?
           ...
           include('fileadmin/scripts/hello_world.inc');
           include('fileadmin/scripts/other_library.inc');
           ...
   ?>

As you can see, this file includes our library "hello\_world" and some
other libraries too!

The file  **hello\_world.inc** looks like this:

file: fileadmin/scripts/hello\_world.inc ::

   <?
   class hello_world {
           function theMessage() {
                   return "Hello World";
           }
   }
   ?>

So far nothing has happened, except our libraries are included, ready
for use.

Now we need to use the outcome of the class hello\_world somewhere on
a page. So in the TypoScript code we setup a content-object that
includes the third script::

   page.100 = PHP_SCRIPT
   page.100.file = fileadmin/scripts/surprise.inc

**surprise.inc** looks like this:

file: fileadmin/scripts/surprise.inc ::

   <?
           $hello_world_object = new hello_world;             // New instance is created
           $contentBefore = $this->cObjGetSingle($conf['cObj'], $conf['cObj.']);
           $content = $contentBefore . $hello_world_object->theMessage();
           $content = $this->stdWrap($content, $conf['stdWrap.']);
   ?>

Line 1: The PHP-object $hello\_world\_object is created.

Line 2: This fetches the content of a cObject, "cObj", we defined

Line 3: The result of line 2 is concatenated with the result of the
"theMessage"-function of the $hello\_world\_object object

Line 4: Finally the content is stdWrap'ed with the properties of
".stdWrap" of the $conf-array.

The output:

With this configuration - ::

   page.100 = PHP_SCRIPT
   page.100.file = fileadmin/scripts/surprise.inc

\- the output will look like this::

   Hello World

With this configuration - ::

   page.100 = PHP_SCRIPT
   page.100 {
           file = fileadmin/scripts/surprise.inc
           cObj = TEXT
           cObj.value = Joe says:&nbsp;
   }

\- the output will look like this::

    Joe says: Hello World

With this configuration - ::

   page.100 = PHP_SCRIPT
   page.100 {
           file = fileadmin/scripts/surprise.inc
           cObj = TEXT
           cObj.value = Joe says:&nbsp;
           stdWrap.wrap = <font color="red"> | </font>
           stdWrap.case = upper
   }

\- the output will look like this::

   JOE SAYS: HELLO WORLD

End of lesson.

