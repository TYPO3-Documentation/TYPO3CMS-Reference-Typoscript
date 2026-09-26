..  include:: /Includes.rst.txt
..  index::
    Content objects; CONTENT
    CONTENT
    Content objects; SQL
    Content objects; Database
..  _cobj-content:

=======
CONTENT
=======

An object with the content type CONTENT is designed to generate content by allowing to
finely select records and have them rendered.

What records are visible is controlled by `start` and `end` fields and
more standard fields automatically. The internal value `SYS_LASTCHANGED`
is raised to the maximum timestamp value of the respective records.

..  seealso::

    The cObject :ref:`RECORDS <cobj-records>` in contrast is for displaying
    lists of records from a variety of tables without fine graining.

..  contents:: Table of content

..  _cobj-content-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:

..  _cobj-content-if:

if
--

..  confval:: if
    :name: content-if
    :type: :ref:`->if <if>`

    If "if" returns false, the content is not generated.

..  _cobj-content-select:

select
------

..  confval:: select
    :name: content-select
    :type: :ref:`select <select>`

    The SQL-statement, a :sql:`SELECT` query, is set here,
    including automatic visibility control.

..  _cobj-content-table:

table
-----

..  confval:: table
    :name: content-table
    :type:  *table name* / :ref:`stdWrap <stdwrap>`

    The table, the content should come from. Any table can be used;
    a check for a table prefix is not done.

    In standard configuration this will be `tt_content`.

..  _cobj-content-renderObj:

renderObj
---------

..  confval:: renderObj
    :name: content-renderObj
    :type: :ref:`Content Objects (cObject) <data-type-cObject>`
    :Default: :typoscript:`< [table name]`

    The cObject used for rendering the records resulting from the query in
    :ref:`select <cobj-content-select>`.

    If :typoscript:`renderObj` is not set explicitly, then
    :typoscript:`< [table name]` is used. So
    in this case the configuration of the according :ref:`table <cobj-content-table>`
    is being copied.

    See the notes on the example below.

..  _cobj-content-slide:

slide
-----

..  confval:: slide
    :name: content-slide
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdWrap>`

    If set and no content element is found by the select command, the
    rootLine will be traversed back until some content is found.

    Possible values are:

    :typoscript:`-1`
        Slide back up to the site root.

    :typoscript:`1`
        Only the current level.

    :typoscript:`2`
        Up from one level back.

    Use :typoscript:`-1` in combination with :ref:`collect <cobj-content-slide-collect>`.

..  _cobj-content-slide-collect:

slide.collect
-------------

..  confval:: slide.collect
    :name: content-slide-collect
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdWrap>`

    If set, all content elements found on the current and parent pages will be
    collected. Otherwise, the sliding would stop after the first hit. Set this
    value to the amount of levels to collect on, or use :typoscript:`-1`
    to collect up to the site root.

..  _cobj-content-slide-collectFuzzy:

slide.collectFuzzy
------------------

..  confval:: slide.collectFuzzy
    :name: content-slide-collectFuzzy
    :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdWrap>`

    Only useful with :ref:`slide.collect <cobj-content-slide-collect>`. If no content
    elements have been found for the specified depth in collect mode, traverse
    further until at least one match has occurred.

..  _cobj-content-slide-collectReverse:

slide.collectReverse
--------------------

..  confval:: slide.collectReverse
    :name: content-slide-collectReverse
    :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdWrap>`

    Reverse order of elements in collect mode. If set, elements of the current
    page will be at the bottom.

..  _cobj-content-wrap:

wrap
----

..  confval:: wrap
    :name: content-wrap
    :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap <stdWrap>`

    Wrap the whole content.

..  _cobj-content-stdWrap:

stdWrap
-------

..  confval:: stdWrap
    :name: content-stdWrap
    :type: :ref:`stdWrap <stdWrap>`

    Apply `stdWrap` functionality.

..  _cobj-content-cache:

cache
-----

..  confval:: cache
    :name: content-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.


..  _cobj-content-examples:

Examples
========

..  _cobj-content-example-detail:

CONTENT explained in detail
---------------------------

See PHP class :php:`\TYPO3\CMS\Frontend\ContentObject\ContentContentObject`
for details on code level.

..  literalinclude:: _codesnippets/_detail4.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

Expanded form:

..  literalinclude:: _codesnippets/_detail3.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  literalinclude:: _codesnippets/_detail2.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  literalinclude:: _codesnippets/_detail.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


See also: :ref:`if <if>`, :ref:`select <select>`, :ref:`Wrap <data-type-wrap>`, :ref:`stdWrap <stdWrap>`,
:ref:`Content Objects (cObject) <data-type-cobject>`


..  _cobj-content-example-display-all:

Display all tt_content records from this page
----------------------------------------------

Here is an example of the CONTENT object:

..  literalinclude:: _codesnippets/_all.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

Since in the above example `.renderObj` is not set explicitly, TYPO3
will automatically set :typoscript:`1.renderObj < tt_content`, so that `renderObj`
will reference the TypoScript configuration of `tt_content`. The
according TypoScript configuration will be copied to `renderObj`.


..  _cobj-content-special-rendering:

Apply special rendering
========================

Here is an example of record-rendering objects:

..  literalinclude:: _codesnippets/_rendering.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
