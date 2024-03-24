..  include:: /Includes.rst.txt
..  index::
    Functions; HTMLparser
    HTMLparser
..  _htmlparser:

==========
HTMLparser
==========

..  contents::
    :local:

..  _htmlparser-properties:

Properties
==========

..  _htmlparser-allowTags:

allowTags
---------

..  confval:: allowTags
    :name: htmlparser-allowTags

    :Data type: list of tags

    Default allowed tags.


..  _htmlparser-stripEmptyTags:

stripEmptyTags
--------------

..  confval:: stripEmptyTags
    :name: htmlparser-stripEmptyTags

    :Data type: :ref:`data-type-boolean`

    Passes the content to PHPs :php:`strip_tags()`.


..  _htmlparser-stripEmptyTags-keepTags:

stripEmptyTags.keepTags
-----------------------

..  confval:: stripEmptyTags.keepTags
    :name: htmlparser-stripEmptyTags-keepTags

    :Data type: :ref:`data-type-string`

    Comma separated list of tags to keep when applying :php:`strip_tags()`.


..  _htmlparser-tags:

tags.[tagname]
--------------

..  confval:: tags
    :name: htmlparser-tags

    :Data type: :ref:`data-type-boolean` / string of :ref:`htmlparser-tags`

    Either set this property to `0` or `1` to allow or deny the tag. If you
    enter :ref:`htmlparser-tags` properties, those will automatically overrule
    this option, thus it's not needed then.

    [tagname] in lowercase.


..  _htmlparser-localNesting:

localNesting
------------

..  confval:: localNesting
    :name: htmlparser-localNesting

    :Data type: list of tags, must be among preserved tags

    List of tags (among the already set tags), which will be forced to
    have the nesting-flag set to true.


..  _htmlparser-globalNesting:

globalNesting
-------------

..  confval:: globalNesting
    :name: htmlparser-globalNesting

    :Data type: (ibid)

    List of tags (among the already set tags), which will be forced to
    have the nesting-flag set to "global".


..  _htmlparser-rmTagIfNoAttrib:

rmTagIfNoAttrib
---------------

..  confval:: rmTagIfNoAttrib
    :name: htmlparser-rmTagIfNoAttrib

    :Data type: (ibid)

    List of tags (among the already set tags), which will be forced to
    have the :ref:`htmlparser-rmTagIfNoAttrib` set to true.


..  _htmlparser-noAttrib:

noAttrib
--------

..  confval:: noAttrib
    :name: htmlparser-noAttrib

    :Data type: (ibid)

    List of tags (among the already set tags), which will be forced to
    have the allowedAttribs value set to zero (which means, all attributes
    will be removed.


..  _htmlparser-removeTags:

removeTags
----------

..  confval:: removeTags
    :name: htmlparser-removeTags

    :Data type: (ibid)

    List of tags (among the already set tags), which will be configured so
    they are surely removed.


..  _htmlparser-keepNonMatchedTags:

keepNonMatchedTags
------------------

..  confval:: keepNonMatchedTags
    :name: htmlparser-keepNonMatchedTags

    :Data type: :ref:`data-type-boolean` / "protect"

    If set (:typoscript:`1`), then all tags are kept regardless of tags present as
    keys in :php:`$tags`-array.

    If :typoscript:`protect`, then the preserved tags have their :html:`<>`
    converted to :html:`&lt;` and :html:`&gt;`.

    Default is to REMOVE all tags, which are not specifically assigned to
    be allowed! So you might probably want to set this value!


..  _htmlparser-htmlSpecialChars:

htmlSpecialChars
----------------

..  confval:: htmlSpecialChars
    :name: htmlparser-htmlSpecialChars

    :Data type: -1 / 0 / 1 / 2

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
