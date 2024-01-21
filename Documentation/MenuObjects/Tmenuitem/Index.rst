..  include:: /Includes.rst.txt
..  index:: TMENU; TMENUITEM
..  _tmenuitem:

=========
TMENUITEM
=========

The current record is the page-record of the menu item. Now, if you would
like to get data from the current menu item's page record, use
stdWrap.data = field : [field name].

Properties
==========

..  _tmenuitem-allWrap:

allWrap
-------

..  t3-menu-tmenu-item:: allWrap

    :Data type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    Wraps the whole item.

wrapItemAndSub
--------------

..  t3-menu-tmenu-item:: wrapItemAndSub

    :Data type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    Wraps the whole item and any submenu concatenated to it.

subst_elementUid
----------------

..  t3-menu-tmenu-item:: subst_elementUid

    :Data type: boolean

    :Default: 0 (false)

    If set, all appearances of the string '{elementUid}' in the total element
    HTML code (after wrapped in :ref:`.allWrap <tmenuitem-allWrap>`) are
    substituted with the uid number of the menu item.

    This is useful if you want to insert an identification code in the
    HTML in order to manipulate properties with JavaScript.


..  _tmenuitem-before:

before
------

..  t3-menu-tmenu-item:: before

    :Data type: HTML / :ref:`stdWrap <stdwrap>`

beforeWrap
----------

..  t3-menu-tmenu-item:: beforeWrap

    :Data type: :ref:`data-type-wrap`

    Wrap around the :ref:`.before <tmenuitem-before>` code.


..  _tmenuitem-after:

after
-----

..  t3-menu-tmenu-item:: after

    :Data type: HTML / :ref:`stdWrap <stdwrap>`

afterWrap
---------

..  t3-menu-tmenu-item:: afterWrap

    :Data type: :ref:`data-type-wrap`

    Wrap around the :ref:`.after <tmenuitem-after>` code.


..  _tmenuitem-linkWrap:

linkWrap
--------

..  t3-menu-tmenu-item:: linkWrap

    :Data type: :ref:`data-type-wrap`

stdWrap
-------

..  t3-menu-tmenu-item:: stdWrap

    :Data type: :ref:`stdWrap`

    stdWrap to the link text.

ATagBeforeWrap
--------------

..  t3-menu-tmenu-item:: ATagBeforeWrap

    :Data type: boolean

    :Default: 0 (false)

    If set, the link is first wrapped with :ref:`*.linkWrap* <tmenuitem-linkWrap>`
    and then the :html:`<a>` tag.

ATagParams
----------

..  t3-menu-tmenu-item:: ATagParams

    :Data type: *<A>-params* / :ref:`stdWrap <stdwrap>`

    Additional parameters

    **Example:** :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        ATagParams = class="board"

ATagTitle
---------

..  t3-menu-tmenu-item:: ATagTitle

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Allows you to specify the "title" attribute of the :html:`<a>` tag around
    the menu item.

    **Example:** :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        ATagTitle.field = abstract // description

    This would use the abstract or description field for the
    :html:`<a title="">` attribute.

additionalParams
----------------

..  t3-menu-tmenu-item:: additionalParams

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Define parameters that are added to the end of the URL. This must be
    code ready to insert after the last parameter.

    For details, see :ref:`typolink->additionalParams <typolink-additionalParams>`.

doNotLinkIt
-----------

..  t3-menu-tmenu-item:: doNotLinkIt

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the link texts are not linked at all.

doNotShowLink
-------------

..  t3-menu-tmenu-item:: doNotShowLink

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the text will not be shown at all (smart with spacers).

stdWrap2
--------

..  t3-menu-tmenu-item:: stdWrap2

    :Data type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`
    :Default: \|

    stdWrap to the total link text and :html:`<a>` tag. (Notice that the plain
    default value passed to the stdWrap function is "\|".)

altTarget
---------

..  t3-menu-tmenu-item:: altTarget

    :Data type: target

    Alternative target overriding the target property of the
    ref:`TMENU <tmenu>`, if set.

allStdWrap
----------

..  t3-menu-tmenu-item:: allStdWrap

    :Data type: :ref:`stdWrap <stdwrap>`

    stdWrap of the whole item.
