..  include:: /Includes.rst.txt
..  index::
    Content objects; RECORDS
    RECORDS
..  _cobj-records:
..  _cobj-records-introduction:

=======
RECORDS
=======

This object is meant for displaying lists of records from a variety of
tables. Contrary to the :ref:`CONTENT <cobj-content>` object, it does
not allow very fine selections of records (as it has no :typoscript:`select`
property).

The register key `SYS_LASTCHANGED` is updated with the `tstamp` field of
the records selected which has a higher value than the current.

..  note::
    Records with parent ids (pid's) for non-accessible pages
    (that is hidden, timed or access-protected pages) are normally not
    selected. Pages may be of any type. Disable the check
    with the :ref:`dontCheckPid option <cobj-records-properties-dontcheckpid>`.

..  contents::
    :local:

..  index:: RECORDS; Properties
..  _cobj-records-properties:
..  _cobj-records-details:

Properties
==========

..  confval-menu::
    :display: table
    :type:

source
------


..  index:: RECORDS; source
..  _cobj-records-properties-source:

..  confval:: source
    :name: records-source
    :type: *records-list* / :ref:`stdWrap <stdwrap>`

    List of record id's, optionally with prepended table names.

    **Example:**

    ..  code-block:: typoscript

        source = tt_content_34, 45, tt_links_56


..  index:: RECORDS; categories

..  _cobj-records-properties-categories:

categories
----------

..  confval:: categories
    :name: records-categories
    :type: *categories-list* / :ref:`stdWrap <stdwrap>`

    Comma-separated list of system categories uid's.
    Records related to these categories will be retrieved
    and made available for rendering.

    Only records from the tables defined in the
    :ref:`tables property <cobj-records-properties-tables>` will be retrieved.

    ..  warning::

        If both `source` and `categories` properties are defined,
        the `source` property will take precedence, as it is considered
        more precisely targeted.

..  _cobj-records-categories-relation:

categories.relation
-------------------

..  confval:: categories.relation
    :name: records-categories-relation

    Name of the categories relation field to use for
    building the list of categorized records, as there can
    be several such fields on a given table.


..  index:: RECORDS; tables

..  _cobj-records-properties-tables:

tables
------

..  confval:: tables
    :name: records-tables
    :type: *list of tables* / :ref:`stdWrap <stdwrap>`

    List of accepted tables. For items listed in the
    :ref:`source <cobj-records-properties-source>` property
    which are not prepended with a table name, the first table
    will be used.

    Records from tables configured in :ref:`conf <cobj-records-properties-conf>`
    are also allowed.

    **Example:**

    ..  code-block:: typoscript

        tables = tt_content, tt_address, tt_links
        conf.tx_myexttable = TEXT
        conf.tx_myexttable.value = Hello world

    This adds the tables `tt_content`, `tt_address`, `tt_links` and
    `tx_myexttable`.


..  index:: RECORDS; conf

..  _cobj-records-properties-conf:

conf.[*table name*]
-------------------

..  confval:: conf.[*table name*]
    :name: records-conf
    :type: :ref:`cObject <data-type-cobject>`

    Configuration array, which defines the rendering for records from
    table *table name*.

    If this is *not* defined, the rendering of the records is done with
    the top-level object *[table name]* - just like when :typoscript:`.renderObj` is
    not set for the cObject :ref:`CONTENT <cobj-content>`!


..  index:: RECORDS; dontCheckPid

..  _cobj-records-properties-dontcheckpid:

dontCheckPid
------------

..  confval:: dontCheckPid
    :name: records-dontCheckPid
    :type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    Normally a record cannot be selected, if its parent page (pid) is not
    accessible for the website user. This option disables that check.

..  _cobj-records-properties-wrap:

wrap
----

..  confval:: wrap
    :name: records-wrap
    :type: :ref:`wrap <data-type-wrap>` / :ref:`stdWrap <stdwrap>`

    Wraps the output. Executed before :ref:`stdWrap <cobj-records-properties-stdwrap>`.

..  _cobj-records-properties-stdwrap:

stdWrap
-------

..  confval:: stdWrap
    :name: records-stdWrap
    :type: :ref:`->stdWrap <stdwrap>`

    Executed after :ref:`wrap <cobj-records-properties-wrap>`.

..  _cobj-records-properties-cache:

cache
-----

..  confval:: cache
    :name: records-cache
    :type: :ref:`cache <cache>`

    See :ref:`cache function description <cache>` for details.


..  _cobj-records-examples:

Examples
========


..  index:: RECORDS; Selection with source
..  _cobj-records-examples-source:

Selection with source
---------------------

The following example would display some related content
referenced from the :guilabel:`page properties`.

..  literalinclude:: _codesnippets/_source.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

Since no :typoscript:`conf` property is defined, the rendering will
look for a top-level TypoScript object bearing the name of the
table to be rendered (e.g. `tt_content`).


..  index:: RECORDS; Selection with source
..  _cobj-records-examples-source-ii:

Selection with source II
------------------------

..  literalinclude:: _codesnippets/_ii.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

This example loads the content elements with the UIDs 10 and 12 no
matter where these elements are located and whether these pages are
accessible for the current user.


..  index:: RECORDS; Selection with categories
..  _cobj-records-examples-categories:

Selection with categories
-------------------------

If you want to display categorized content with a :typoscript:`RECORDS` object
you could do it like this:

..  literalinclude:: _codesnippets/_categories2.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

Contrary to the previous example, in this case the :typoscript:`conf` property
is present and defines a very simple rendering of each content element
(i.e. the header with a direct link to the content element).

However, the same can be achieved with a :ref:`cobj-fluidtemplate` and
data processing. This way templating is much more flexible. See the following
example from the system extension :file:`fluid_styled_content`:

..  literalinclude:: _codesnippets/_categories.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
