.. include:: ../../Includes.txt


.. _htmlparser:

==========
HTMLparser
==========

.. ### BEGIN~OF~TABLE ###

.. _htmlparser-allowtags:

allowTags
=========

.. container:: table-row

   Property
         allowTags

   Data type
         list of tags

   Description
         Default allowed tags

.. _htmlparser-stripemptytags:

stripEmptyTags
==============

.. container:: table-row

   Property
         stripEmptyTags

   Data type
         :ref:`data-type-boolean`

   Description
         Passes the content to PHPs :php:`strip_tags()`.

.. _htmlparser-stripemptytags.keeptags:

stripEmptyTags.keepTags
=======================

.. container:: table-row

   Property
         stripEmptyTags.keepTags

   Data type
         :ref:`data-type-string`

   Description
         Comma separated list of tags to keep when applying :php:`strip_tags()`.

.. _htmlparser-tags.[tagname]:

tags.[tagname]
==============

.. container:: table-row

   Property
         tags.[tagname]

   Data type
         :ref:`data-type-boolean` / :ref:`htmlparser-tags`

   Description
         Either set this property to 0 or 1 to allow or deny the tag. If you
         enter :ref:`htmlparser-tags` properties, those will automatically overrule
         this option, thus it's not needed then.

         [tagname] in lowercase.

.. _htmlparser-localnesting:

localNesting
============

.. container:: table-row

   Property
         localNesting

   Data type
         list of tags, must be among preserved tags

   Description
         List of tags (among the already set tags), which will be forced to
         have the nesting-flag set to true

.. _htmlparser-globalnesting:

globalNesting
=============

.. container:: table-row

   Property
         globalNesting

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be forced to
         have the nesting-flag set to "global"

.. _htmlparser-rmtagifnoattrib:

rmTagIfNoAttrib
===============

.. container:: table-row

   Property
         rmTagIfNoAttrib

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be forced to
         have the :ref:`htmlparser-rmTagIfNoAttrib` set to true

.. _htmlparser-noattrib:

noAttrib
========

.. container:: table-row

   Property
         noAttrib

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be forced to
         have the allowedAttribs value set to zero (which means, all attributes
         will be removed.

.. _htmlparser-removetags:

removeTags
==========

.. container:: table-row

   Property
         removeTags

   Data type
         (ibid)

   Description
         List of tags (among the already set tags), which will be configured so
         they are surely removed.

.. _htmlparser-keepnonmatchedtags:

keepNonMatchedTags
==================

.. container:: table-row

   Property
         keepNonMatchedTags

   Data type
         :ref:`data-type-boolean` / "protect"

   Description
         If set (true=1), then all tags are kept regardless of tags present as
         keys in :php:`$tags`-array.

         If "protect", then the preserved tags have their :html:`<>`
         converted to :html:`&lt;` and :html:`&gt;`

         Default is to REMOVE all tags, which are not specifically assigned to
         be allowed! So you might probably want to set this value!

.. _htmlparser-htmlspecialchars:

htmlSpecialChars
================

.. container:: table-row

   Property
         htmlSpecialChars

   Data type
         -1 / 0 / 1 / 2

   Description
         This regards all content which is **not** tags:

         **0:** Disabled - nothing is done.

         **1:** The content outside tags is :php:`htmlspecialchar()`'ed
         (PHP-function which converts :html:`&"<>` to :html:`&...;`).

         **2:** Same as "1", but entities like :html:`&amp;` or :html:`&#234` are
         untouched.

         **-1:** Does the opposite of "1".
         It converts :html:`&lt;` to :html:`<`,
         :html:`&gt;` to :html:`>`,
         :html:`&quot;` to :html:`"` etc.


.. ###### END~OF~TABLE ######

[page:->HTMLparser; tsref:->HTMLparser]
