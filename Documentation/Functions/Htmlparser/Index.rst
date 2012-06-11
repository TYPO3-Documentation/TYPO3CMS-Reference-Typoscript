

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


HTMLparser
^^^^^^^^^^

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:


.. container:: table-row

   Property
         allowTags
   
   Data type
         list of tags
   
   Description
         Default allowed tags


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
         This regards all content which is NOT tags:
         
         "0" means "disabled" - nothing is done
         
         "1" means the content outside tags is htmlspecialchar()'ed (PHP-
         function which converts &"<> to &...;)
         
         "2" is the same as "1" but entities like "&amp;" or "&#234" are
         untouched.
         
         "-1" does the opposite of "1" - converts &lt; to <, &gt; to >, &quot;
         to " etc.


.. container:: table-row

   Property
         xhtml\_cleaning
   
   Data type
         boolean
   
   Description
         Cleans up the content for XHTML compliance. Still slightly
         experimental and supports only some clean up operations (like
         conversion tags and attributes to lower case).


.. ###### END~OF~TABLE ######

[page:->HTMLparser; tsref:->HTMLparser]

