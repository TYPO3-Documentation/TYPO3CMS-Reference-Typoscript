..  include:: /Includes.rst.txt
..  index:: HMENU; special = updated
..  _hmenu-special-updated:

=============
Updated HMENU
=============

An :ref:`HMENU <cobj-hmenu>` with the property :typoscript:`special = updated`
will create a menu of the most recently updated pages.

By default the most recently updated page is displayed on top.

Mount pages are supported.

..  contents::
    :local:

..  _hmenu-special-updated-properties:

Properties
==========

..  _hmenu-special-updated-value:

special.value
--------------

..  confval:: special.value
    :name: hmenu-updated-special-value
    :type: list of page IDs /:ref:`stdWrap <stdwrap>`

    This will generate a menu of the most recently updated pages from the
    branches in the tree starting with the UIDs (uid=35 and uid=56)
    listed.

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        20 = HMENU
        20.special = updated
        20.special.value = 35, 56

..  _hmenu-special-updated-mode:

special.mode
-------------

..  confval:: special.mode
    :name: hmenu-updated-special-mode
    :type: string
    :Default: `SYS_LASTCHANGED`

    The field in the database, which should be used to get the information
    about the last update from.

    Possible values are:

    `SYS_LASTCHANGED`
        Is updated to the youngest time stamp of the
        records on the page when a page is generated.

    `crdate`
        Uses the :sql:`crdate` field of the page record. This field is set
        once on creation of the record and left unchanged afterwards.

    `tstamp`
        Uses the :sql:`tstamp` field of the page record, which is set
        automatically when the record is changed.

    `manual` or `lastUpdated`
        Uses the field :sql:`lastUpdated`, which
        can be set manually in the page record.

    `starttime`
        Uses the :sql:`starttime` field.

    Fields with empty values are generally not selected.

..  _hmenu-special-updated-depth:

special.depth
-------------

..  confval:: special.depth
    :name: hmenu-updated-special-depth
    :type: integer
    :Default: 20

    Defines the tree depth.

    The allowed range is 1-20.

    A depth of 1 means only the start ID, depth of 2 means start ID +
    first level.

    **Note:** "depth" is relative to :confval:`hmenu-updated-special-beginAtLevel`.

..  _hmenu-special-updated-beginatlevel:

special.beginAtLevel
--------------------

..  confval:: special.beginAtLevel
    :name: hmenu-updated-special-beginAtLevel
    :type: integer
    :Default: 0

    Determines starting level for the page trees generated based on .value
    and .depth.

    0 is default and includes the start id.

    1 starts with the first row of subpages,

    2 starts with the second row of subpages.

    **Note:** "depth" is relative to this property.


..  _hmenu-special-updated-maxage:

special.maxAge
---------------

..  confval:: special.maxAge
    :name: hmenu-updated-special-maxAge
    :type: integer :ref:`+calc <objects-calc>`

    Only show pages, whose update-date *at most* lies this number of
    seconds in the past. Or with other words: Pages with update-dates
    older than the current time minus this number of seconds will not
    be shown in the menu no matter what.

    By default all pages are shown. You may use +-\*/ for calculations.

..  _hmenu-special-updated-limit:

special.limit
--------------

..  confval:: special.limit
    :name: hmenu-updated-special-limit
    :type: integer
    :Default: 10

    Maximal number of items in the menu. Default is 10, max is 100.


..  _hmenu-special-updated-excludenosearchpages:

special.excludeNoSearchPages
-----------------------------

..  confval:: special.excludeNoSearchPages
    :name: hmenu-updated-special-excludeNoSearchPages
    :type: boolean
    :Default: `false`

    If set, pages marked `No search` are not included.

..  _hmenu-special-updated-examples:

Example: Recently updated pages styled with Fluid
=================================================

The content element :guilabel:`Recently Updated Pages` provided by the system
extension EXT:fluid_styled_content is configured with a :php:`MenuProcessor`
which is based on the options of the :ref:`HMENU <cobj-hmenu>` and provides
all its properties:

..  include:: /CodeSnippets/Menu/TypoScript/MenuRecentlyUpdated.rst.txt

The following Fluid template can be used to style the menu:

..  include:: /CodeSnippets/Menu/Template/MenuRecentlyUpdated.rst.txt
