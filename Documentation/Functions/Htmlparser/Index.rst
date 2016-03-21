.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _htmlparser:

HTMLparser
^^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         allowTags

   Data type
         list of tags

   Description
         Default allowed tags


.. container:: table-row

   Property
         stripEmptyTags

   Data type
         boolean

   Description
         Passes the content to PHPs ``strip_tags()``.


.. container:: table-row

   Property
         stripEmptyTags.keepTags

   Data type
         string

   Description
         Comma separated list of tags to keep when applying ``strip_tags()``.


.. container:: table-row

   Property
         tags.[tagname]

   Data type
         boolean/->HTMLparser\_tags

   Description
         Either set this property to 0 or 1 to allow or deny the tag. If you
         enter ->HTMLparser\_tags properties, those will automatically overrule
         this option, thus it's not needed then.

         [tagname] in lowercase.


.. container:: table-row

   Property
         localNesting

   Data type
         list of tags, must be among preserved tags

   Description
         List of tags (among the already set tags), which will be forced to
         have the nesting-flag set to true


.. container:: table-row

   Property
         globalNesting

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be forced to
         have the nesting-flag set to "global"


.. container:: table-row

   Property
         rmTagIfNoAttrib

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be forced to
         have the rmTagIfNoAttrib set to true


.. container:: table-row

   Property
         noAttrib

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be forced to
         have the allowedAttribs value set to zero (which means, all attributes
         will be removed.


.. container:: table-row

   Property
         removeTags

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be configured so
         they are surely removed.


.. container:: table-row

   Property
         keepNonMatchedTags

   Data type
         boolean / "protect"

   Description
         If set (true=1), then all tags are kept regardless of tags present as
         keys in $tags-array.

         If "protect", then the preserved tags have their <> converted to &lt;
         and &gt;

         Default is to REMOVE all tags, which are not specifically assigned to
         be allowed! So you might probably want to set this value!


.. container:: table-row

   Property
         htmlSpecialChars

   Data type
         -1 / 0 / 1 / 2

   Description
         This regards all content which is **not** tags:

         **0:** Disabled - nothing is done.

         **1:** The content outside tags is htmlspecialchar()'ed (PHP-
         function which converts &"<> to &...;).

         **2:** Same as "1", but entities like "&amp;" or "&#234" are
         untouched.

         **-1:** Does the opposite of "1". It converts &lt; to <, &gt;
         to >, &quot; to " etc.


.. ###### END~OF~TABLE ######

[page:->HTMLparser; tsref:->HTMLparser]

