.. include:: ../../Includes.txt


.. _cobj-template:

========
TEMPLATE
========

.. tip::

  It is recommended to use :ref:`cobj-fluidtemplate` instead of TEMPLATE.
  FLUIDTEMPLATE combines Fluid templates with TypoScript. This works very
  similar to TEMPLATE.

With this cObject you can define a template (e.g. an HTML file) which
should be used as a basis for your whole website. Inside the template
file you can define markers, which later will be replaced with dynamic
content by TYPO3.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         template

   Data type
         :ref:`cObject <data-type-cobject>`

   Description
         This must be loaded with the template-code. Usually this is done
         with a :ref:`FILE cObject <cobj-file>`. If it is not loaded with
         code, the object returns nothing.

         **Example:** ::

            page.10 = TEMPLATE
            page.10 {
               template = FILE
               template.file = fileadmin/template.html
            }

         This will use the file fileadmin/template.html as template for your
         website.


.. container:: table-row

   Property
         subparts

   Data type
         *(array of cObjects)*

   Description
         This is an array of subpart-markers (case-sensitive).

         A subpart is defined by **two** markers in the template. The markers
         must be wrapped by "###" on both sides. You may insert the subpart-
         markers inside HTML-comment-tags!

         **Example:**

         In the template there is the subpart "HELLO"::

            <!-- start of subpart ###HELLO### -->
            This is the HTML code, that will be loaded in the register
            and will be replaced with the result...
            <!-- end ###HELLO### -->

         The following TypoScript code now replaces the subpart "HELLO" with
         the text given in "value"::

            page.10.subparts {
              HELLO = TEXT
              HELLO.value = En subpart er blevet erstattet!
            }

         **Note:**

         Before the content objects of each subpart are generated, all subparts
         in the array are extracted and loaded into the register so that you
         can load them from there later on.

         The register-key for each subparts code is "SUBPART\_[theSubpartkey]".

         In addition the current-value is loaded with the content of each
         subpart just before the cObject for the subpart is parsed. That makes
         it quite easy to load the subpart of the cObject (e.g.: ".current = 1")

         E.g. this subpart above has the register-key "SUBPART\_HELLO".

         *This is valid ONLY if the property .nonCachedSubst is not set (see
         below)!*


.. container:: table-row

   Property
         relPathPrefix

   Data type
         *string / properties*

   Description
         Finds all relative references (e.g. to images or stylesheets) and
         prefixes this value.

         If you specify properties (uppercase) these will match HTML tags and
         specify alternative paths for them. See example below.

         If the property is named "style", it will set an alternative path for
         the "url()" wrapper that may be in <style> sections.

         **Example:** ::

            page.10 = TEMPLATE
            page.10 {
              template = FILE
              template.file = fileadmin/template.html
              relPathPrefix = fileadmin/
              relPathPrefix.IMG = fileadmin/img/
            }

         In this example all relative paths found are prefixed with "fileadmin/"
         unless it was the src attribute of an img tag in which case the path
         is prefixed with "fileadmin/img/"


.. container:: table-row

   Property
         marks

   Data type
         *(array of cObjects)*

   Description
         This is an array of marks-markers (case-sensitive).

         A mark is defined by **one** marker in the template. The marker must
         be wrapped by "###" on both sides. Opposite to subparts, you may **not**
         insert the subpart-markers inside HTML-comment-tags! (They will not be
         removed.)

         **Example:**

         In the template::

            <div id="copyright">
              &copy; ###DATE###
            </div>

         The following TypoScript code now dynamically replaces the marker
         "DATE" with the current year::

            page.10.marks {
              DATE = TEXT
              DATE {
                stdWrap.data = date : U
                stdWrap.strftime = %Y
            }

         Marks are substituted by a str\_replace-function. The subparts loaded
         in the register are also available to the cObjects of markers (only if
         .nonCachedSubst is not set!).


.. container:: table-row

   Property
         wraps

   Data type
         *(array of cObjects)*

   Description
         This is an array of wraps-markers (case-sensitive).

         This is shown best by an example:

         **Example:**

         In the template there is the subpart "MYLINK"::

            This is <!--###MYLINK###-->a link to my<!--###MYLINK###--> page!

         With the following TypoScript code the subpart will be substituted by
         the wrap which is the content returned by the MYLINK cObject. ::

            page.10.wraps {
              MYLINK = TEXT
              MYLINK.value = <a href="#"> | </a>
            }


.. container:: table-row

   Property
         workOnSubpart

   Data type
         string /:ref:`stdWrap <stdwrap>`

   Description
         This is an optional definition of a subpart, that we decide to work
         on. In other words; if you define this value that subpart is extracted
         from the template and is the basis for this whole template object.


.. container:: table-row

   Property
         markerWrap

   Data type
         :ref:`wrap <data-type-wrap>` /:ref:`stdWrap <stdwrap>`

   Default
         ### \| ###

   Description
         This is the wrap the markers are wrapped with. The default value is
         ### \| ### resulting in the markers to be presented as
         ###[marker\_key]###.

         Any whitespace around the wrap-items is stripped before they are set
         around the marker\_key.



.. container:: table-row

   Property
         substMarksSeparately

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If set, then marks are substituted in the content AFTER the
         substitution of subparts and wraps.

         Normally marks are not substituted inside of subparts and wraps when
         you are using the default cached mode of the TEMPLATE cObject. That is
         a problem if you have marks inside of subparts! But setting this flag
         will make the marker-substitution a non-cached, subsequent process.

         Another solution is to turn off caching, see below.


.. container:: table-row

   Property
         nonCachedSubst

   Data type
         boolean /:ref:`stdWrap <stdwrap>`

   Description
         If set, then the substitution mode of this cObject is totally
         different. Normally the raw template is read and divided into the
         sections denoted by the marks, subparts and wraps keys. The good thing
         is high speed, because this "pre-parsed" template is cached. The bad
         thing is that templates that depend on incremental substitution (where
         the order of substitution is important) will not work so well.

         By setting this flag, markers are first substituted by str\_replace in
         the template - one by one. Then the subparts are substituted one by
         one. And finally the wraps one by one.

         Obviously you loose the ability to refer to other parts in the
         template with the register-keys as described above.


.. container:: table-row

   Property
         stdWrap

   Data type
         :ref:`->stdWrap <stdwrap>`


.. ###### END~OF~TABLE ######

[tsref:(cObject).TEMPLATE]


.. _cobj-template-examples:

Example:
""""""""

::

   page.10 = TEMPLATE
   page.10 {
     template = FILE
     template.file = fileadmin/test.tmpl
     subparts {
       HELLO = TEXT
       HELLO.value = This is the replaced subpart-code.
     }
     marks {
       Testmark = TEXT
       Testmark.value = This is replacing a simple marker in the HTML code.
     }
     workOnSubpart = DOCUMENT
   }

In this example a template named test.tmpl is loaded and used. The
subpart "HELLO" and the mark "Testmark" in the template file will be
replaced with the output of the according cObjects.

