.. include:: /Includes.rst.txt
.. index::
   Functions; HTMLparser
   HTMLparser
.. _htmlparser:

==========
HTMLparser
==========

.. contents::
   :local:

Properties
==========

.. index:: HTMLparser; allowTags
.. _htmlparser-allowtags:

allowTags
---------

:aspect:`Property`
   allowTags

:aspect:`Data type`
   list of tags

:aspect:`Description`
   Default allowed tags


.. index:: HTMLparser; stripEmptyTags
.. _htmlparser-stripemptytags:

stripEmptyTags
--------------

:aspect:`Property`
   stripEmptyTags

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   Passes the content to PHPs :php:`strip_tags()`.


.. index:: HTMLparser; stripEmptyTags.keepTags
.. _htmlparser-stripemptytags.keeptags:

stripEmptyTags.keepTags
-----------------------

:aspect:`Property`
   stripEmptyTags.keepTags

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   Comma separated list of tags to keep when applying :php:`strip_tags()`.

.. index:: HTMLparser; tags
..  _htmlparser-function-tags:

tags.[tagname]
--------------

:aspect:`Property`
   tags.[tagname]

:aspect:`Data type`
   :ref:`data-type-boolean` / :ref:`htmlparser-tags`

:aspect:`Description`
   Either set this property to `0` or `1` to allow or deny the tag. If you
   enter :ref:`htmlparser-tags` properties, those will automatically overrule
   this option, thus it's not needed then.

   [tagname] in lowercase.


.. index:: HTMLparser; localNesting
.. _htmlparser-localnesting:

localNesting
------------

:aspect:`Property`
   localNesting

:aspect:`Data type`
   list of tags, must be among preserved tags

:aspect:`Description`
   List of tags (among the already set tags), which will be forced to
   have the nesting-flag set to true


.. index:: HTMLparser; globalNesting
.. _htmlparser-globalnesting:

globalNesting
-------------

:aspect:`Property`
   globalNesting

:aspect:`Data type`
   (ibid)

:aspect:`Description`
   List of tags (among the already set tags), which will be forced to
   have the nesting-flag set to "global"


.. index:: HTMLparser; rmTagIfNoAttrib
.. _htmlparser-rmtagifnoattrib:

rmTagIfNoAttrib
---------------

:aspect:`Property`
   rmTagIfNoAttrib

:aspect:`Data type`
   (ibid)

:aspect:`Description`
   List of tags (among the already set tags), which will be forced to
   have the :ref:`htmlparser-rmTagIfNoAttrib` set to true


.. index:: HTMLparser; noAttrib
.. _htmlparser-noattrib:

noAttrib
--------

:aspect:`Property`
   noAttrib

:aspect:`Data type`
   (ibid)

:aspect:`Description`
   List of tags (among the already set tags), which will be forced to
   have the allowedAttribs value set to zero (which means, all attributes
   will be removed.


.. index:: HTMLparser; removeTags
.. _htmlparser-removetags:

removeTags
----------

:aspect:`Property`
   removeTags

:aspect:`Data type`
   (ibid)

:aspect:`Description`
   List of tags (among the already set tags), which will be configured so
   they are surely removed.


.. index:: HTMLparser; keepNonMatchedTags
.. _htmlparser-keepnonmatchedtags:

keepNonMatchedTags
------------------

:aspect:`Property`
   keepNonMatchedTags

:aspect:`Data type`
   :ref:`data-type-boolean` / "protect"

:aspect:`Description`
   If set (:typoscript:`1`), then all tags are kept regardless of tags present as
   keys in :php:`$tags`-array.

   If :typoscript:`protect`, then the preserved tags have their :html:`<>`
   converted to :html:`&lt;` and :html:`&gt;`

   Default is to REMOVE all tags, which are not specifically assigned to
   be allowed! So you might probably want to set this value!


.. index:: HTMLparser; htmlSpecialChars
.. _htmlparser-htmlspecialchars:

htmlSpecialChars
----------------

:aspect:`Property`
   htmlSpecialChars

:aspect:`Data type`
   -1 / 0 / 1 / 2

:aspect:`Description`
   This regards all content which is **not** tags:

   -1
      Does the opposite of "1". It converts :html:`&lt;` to :html:`<`,
      :html:`&gt;` to :html:`>`, :html:`&quot;` to :html:`"` etc.

   0
      Disabled - nothing is done.

   1
      The content outside tags is :php:`htmlspecialchar()`'ed (PHP-function
      which converts :html:`&"<>` to :html:`&...;`).

   2
      Same as "1", but entities like :html:`&amp;` or :html:`&#234` are
      untouched.
