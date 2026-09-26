..  include:: /Includes.rst.txt
..  index::
    Functions; select
    Database; select
..  _select:

======
select
======

This object generates an SQL-select statement to select records
from the database.

Some records are hidden or timed by start- and end-times. This is
automatically added to the SQL-select by looking for "enablefields"
in the :php:`$GLOBALS['TCA']`.

..  warning::

    Do not use GET or POST data like GPvar directly with this object!
    Avoid :ref:`SQL injections <t3coreapi:security-sql-injection>`! Don't trust
    any external data! Secure any unknown data, for example with
    :ref:`intval <stdwrap-intval>`.

..  contents::
    :local:

..  index:: select; Properties
..  _select-properties:

Properties
==========

..  _select-uidInList:

uidInList
---------

..  confval:: uidInList
    :name: select-uidInList
    :type: *list of record uids* / :ref:`stdWrap <stdWrap>`

    Comma-separated list of record uids from the according database table.
    For example when the select function works on the table `tt_content`, then
    this will be uids of `tt_content` records.

    **Note:** :typoscript:`this` is a *special keyword* and replaced with the id of the
    *current record*.

    ..  attention::
        :ref:`pidInList <select_pidInList>` defaults to :typoscript:`this`.
        Therefore by default only records
        from the current page are available for :typoscript:`uidInList`. If records
        should be fetched globally, :typoscript:`pidInList = 0` should also be set.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_uidInList.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

..  _select_pidInList:

pidInList
---------

..  confval:: pidInList
    :name: select_pidInList
    :type: *list of page uids* / :ref:`stdWrap <stdWrap>`
    :Default: :typoscript:`this`

    Comma-separated list of pids of the record. This will be page uids (pids). For
    example when the select function works on the table tt_content, then this
    will be pids of tt_content records, the parent pages of these records.

    Pages in the list, which are not visible for the website user, *are
    automatically removed* from the list. Thereby no records from hidden,
    timed or access-protected pages will be selected! Nor will be records
    from recyclers. Exception: The hidden pages will be listed in *preview mode*.

    **Special keyword:** :typoscript:`this`
        Is replaced with the id of the current page.

    **Special keyword:** :typoscript:`root`
        Allows to select records from the root-page level (records with pid=0,
        e.g. useful for the table "sys_category" and others).

    **Special value:** :typoscript:`-1`
        Allows to select versioned records in workspaces directly.

    **Special value:** :typoscript:`0`
        Allows to disable the `pid` constraint completely. Requirements:
        :typoscript:`uidInList` *must* be set or the table *must* have the prefix
        "static\_\*".

    ..  rubric:: Example

    Fetch related `sys_category` records stored in the MM intermediate table:

    ..  literalinclude:: _codesnippets/_pidInList.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


..  _select-recursive:

recursive
---------

..  confval:: recursive
    :name: select-recursive
    :type: :ref:`integer <data-type-integer>` / :ref:`stdWrap <stdWrap>`
    :Default: 0

    Number of recursive levels for the pidInList.

    ..  note::
        :typoscript:`recursive` is ignored for *special keyword* :typoscript:`pidInList=root`.

..  _select-orderBy:

orderBy
-------

..  confval:: orderBy
    :name: select-orderBy
    :type: *SQL-orderBy* / :ref:`stdWrap <stdWrap>`

    ORDER BY clause without the words "ORDER BY".

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        orderBy = sorting, title


..  _select-groupBy:

groupBy
-------

..  confval:: groupBy
    :name: select-groupBy
    :type: *SQL-groupBy* / :ref:`stdWrap <stdWrap>`

    GROUP BY clause without the words "GROUP BY".

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        groupBy = CType


..  _select-max:

max
---

..  confval:: max
    :name: select-max
    :type: :ref:`integer <data-type-integer>` + :ref:`Calculating values (+calc) <objects-calc>` +"total" / :ref:`stdWrap <stdWrap>`

    Max records

    **Special keyword:** "total" is substituted with :php:`count(*)`.


..  _select-begin:

begin
-----

..  confval:: begin
    :name: select-begin
    :type: :ref:`integer <data-type-integer>` + :ref:`Calculating values (+calc) <objects-calc>` +"total" / :ref:`stdWrap <stdWrap>`

    Begin with record number *value*.

    **Special keyword:** :typoscript:`total`
        Is substituted with :php:`count(*)`.


..  _select-where:

where
-----

..  confval:: where
    :name: select-where
    :type: *SQL-where* / :ref:`stdWrap <stdWrap>`

    WHERE clause without the word "WHERE".

    ..  rubric:: Example

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        where = (title LIKE '%SOMETHING%' AND NOT doktype)

    Use `{#fieldname}` to make the database
    framework quote these fields:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

        where = ({#title} LIKE {#%SOMETHING%} AND NOT {#doktype})


..  _select-languageField:

languageField
-------------

..  confval:: languageField
    :name: select-languageField
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdWrap>`

    This defaults to whatever is defined in TCA "ctrl"-section in the
    "languageField". Change it to overwrite the behaviour in your query.

    By default all records that have language-relevant information in the
    TCA "ctrl"-section are translated on translated pages.

    This behaviour can be disabled by setting :typoscript:`languageField = 0`.


..  _select-includeRecordsWithoutDefaultTranslation:

includeRecordsWithoutDefaultTranslation
---------------------------------------

..  confval:: includeRecordsWithoutDefaultTranslation
    :name: select-includeRecordsWithoutDefaultTranslation
    :type: :ref:`boolean <data-type-boolean>` / :ref:`stdWrap <stdWrap>`
    :Default: 0

    If content language overlay is activated and the option :typoscript:`languageField` is not disabled,
    :typoscript:`includeRecordsWithoutDefaultTranslation` allows to additionally fetch records,
    which do **not** have a parent in the default language.


..  _select-selectFields:

selectFields
------------

..  confval:: selectFields
    :name: select-selectFields
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdWrap>`
    :Default: \*

    List of fields to select, or :php:`count(*)`.

    If the records need to be localized, please include the
    relevant localization-fields (uid, pid, languageField and
    transOrigPointerField). Otherwise the TYPO3 internal localization
    will not succeed.


..  _select-join:

join, leftjoin, rightjoin
-------------------------

..  confval:: join, leftjoin, rightjoin
    :name: select-join
    :type: :ref:`string <data-type-string>` / :ref:`stdWrap <stdWrap>`

    Enter the JOIN clause without :sql:`JOIN`, `LEFT OUTER JOIN` and `RIGHT OUTER JOIN`
    respectively.

    ..  rubric:: Example

    Fetch related `sys_category` records stored in the MM intermediate table:

    ..  literalinclude:: _codesnippets/_join.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    See :ref:`pidInList <select_pidInList>` for more examples.


..  _select-markers:

markers
-------

..  confval:: markers
    :name: select-markers
    :type: *(array of markers)*

    The markers defined in this section can be used, wrapped in the usual
    ###markername### way, in any other property of select. Each value is
    properly escaped and quoted to prevent SQL injection problems. This
    provides a way to safely use external data (e.g. database fields,
    GET/POST parameters) in a query.

    Available sub-properties:

    <markername>.value (value)
        Sets the value directly.

    <markername>.commaSeparatedList (:ref:`boolean <data-type-boolean>`)
        If set, the value is interpreted as a comma-separated list of values.
        Each value in the list is individually escaped and quoted.

    (stdWrap properties ...)
        All stdWrap properties can be used for each markername.


    ..  warning::

        Since TYPO3 v8 there is a problem combining orderBy with markers caused
        by the quoting of the fields, see :issue:`87799`.

    ..  rubric:: Example

    ..  literalinclude:: _codesnippets/_markers2.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    This example selects all records from table tt_content, which are on page 73 and
    which don't have the header set to the value provided by the Get/Post variable
    "first".

    ..  literalinclude:: _codesnippets/_markers.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript


    This examples selects all records from the table tt_content which are on page 73
    and which don't have a header set to a value constructed by whatever.value and
    whatever.wrap ('something').


..  _selectQuotingOfFields:

Quoting of fields
=================

It is possible to use `{#fieldname}` to make the database
framework quote these fields (see
:doc:`Important: #80506 - DBAL compatible field quoting in TypoScript
<ext_core:Changelog/8.7/Important-80506-DbalCompatibleFieldQuotingInTypoScript>`):

..  code-block:: typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    select.where = ({#title} LIKE {#%SOMETHING%} AND NOT {#doktype})

This applies to:

*   :typoscript:`select.where`

but not to:

*   :typoscript:`select.groupBy`
*   :typoscript:`select.orderBy`

as these parameters already follow a stricter syntax that allow automatic parsing and
quoting.

..  _select-example:

Example
=======

See PHP source code for
:php:`\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer`,
:php:`ContentObjectRenderer::getQuery()`,
:php:`ContentObjectRenderer::getWhere()`.

Condensed form:

..  literalinclude:: _codesnippets/_select.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

See also:

*   :ref:`CONTENT <cobj-content>`: for more complete examples with :typoscript:`select`
    and rendering the output with :typoscript:`renderObj`
*   :ref:`Wrap <data-type-wrap>`: enclosing results within text, used in some of the
    examples above
*   :ref:`stdWrap <stdWrap>`: for more functionality, can be used in some of the properties,
    such as :typoscript:`pidInList`, :typoscript:`selectFields` etc.
