..  include:: /Includes.rst.txt
..  index:: TMENU; TMENUITEM
..  _tmenuitem:

=========
TMENUITEM
=========

The current record is the page record of the menu item. If you would
like to get data from the current menu item's page record, use
:typoscript:`stdWrap.data = field : [field name]`.

Properties
==========

..  _tmenuitem-allWrap:

allWrap
-------

..  confval:: allWrap
    :name: tmenuitem-allWrap

    :Data type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    Wraps the whole item.


..  _tmenuitem-wrapItemAndSub:

wrapItemAndSub
--------------

..  confval:: wrapItemAndSub
    :name: tmenuitem-wrapItemAndSub

    :Data type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    Wraps the whole item and any submenu concatenated to it.


..  _tmenuitem-subst-elementUid:

subst_elementUid
----------------

..  confval:: subst_elementUid
    :name: tmenuitem-subst-elementUid

    :Data type: :ref:`data-type-boolean`

    :Default: 0 (false)

    If set, all appearances of the string '{elementUid}' in the HTML code of the
    element (after wrapped in :ref:`.allWrap <tmenuitem-allWrap>`) are
    substituted with the UID number of the menu item.

    This is useful, if you want to insert an identification code in the
    HTML in order to manipulate properties with JavaScript.


..  _tmenuitem-before:

before
------

..  confval:: before
    :name: tmenuitem-before

    :Data type: HTML / :ref:`stdWrap <stdwrap>`


..  _tmenuitem-beforeWrap:

beforeWrap
----------

..  confval:: beforeWrap
    :name: tmenuitem-beforeWrap

    :Data type: :ref:`data-type-wrap`

    Wrap around the :ref:`.before <tmenuitem-before>` code.


..  _tmenuitem-after:

after
-----

..  confval:: after
    :name: tmenuitem-after

    :Data type: HTML / :ref:`stdWrap <stdwrap>`


..  _tmenuitem-afterWrap:

afterWrap
---------

..  confval:: afterWrap
    :name: tmenuitem-afterWrap

    :Data type: :ref:`data-type-wrap`

    Wrap around the :ref:`.after <tmenuitem-after>` code.


..  _tmenuitem-linkWrap:

linkWrap
--------

..  confval:: linkWrap
    :name: tmenuitem-linkWrap

    :Data type: :ref:`data-type-wrap`


..  _tmenuitem-stdWrap:

stdWrap
-------

..  confval:: stdWrap
    :name: tmenuitem-stdWrap

    :Data type: :ref:`stdWrap`

    stdWrap to the link text.


..  _tmenuitem-ATagBeforeWrap:

ATagBeforeWrap
--------------

..  confval:: ATagBeforeWrap
    :name: tmenuitem-ATagBeforeWrap

    :Data type: :ref:`data-type-boolean`

    :Default: 0 (false)

    If set, the link is first wrapped with :ref:`*.linkWrap* <tmenuitem-linkWrap>`
    and then the :html:`<a>` tag.


..  _tmenuitem-ATagParams:

ATagParams
----------

..  confval:: ATagParams
    :name: tmenuitem-ATagParams

    :Data type: *<A>-params* / :ref:`stdWrap <stdwrap>`

    Additional parameters

    **Example:** :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        ATagParams = class="board"


..  _tmenuitem-ATagTitle:

ATagTitle
---------

..  confval:: ATagTitle
    :name: tmenuitem-ATagTitle

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Allows you to specify the "title" attribute of the :html:`<a>` tag around
    the menu item.

    **Example:** :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        ATagTitle.field = abstract // description

    This would use the abstract or description field for the
    :html:`<a title="">` attribute.


..  _tmenuitem-additionalParams:

additionalParams
----------------

..  confval:: additionalParams
    :name: tmenuitem-additionalParams

    :Data type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Define parameters that are added to the end of the URL. This must be
    code ready to insert after the last parameter.

    For details, see :ref:`typolink->additionalParams <typolink-additionalParams>`.


..  _tmenuitem-doNotLinkIt:

doNotLinkIt
-----------

..  confval:: doNotLinkIt
    :name: tmenuitem-doNotLinkIt

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the link texts are not linked at all.


..  _tmenuitem-doNotShowLink:

doNotShowLink
-------------

..  confval:: doNotShowLink
    :name: tmenuitem-doNotShowLink

    :Data type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the text will not be shown at all (smart with spacers).


..  _tmenuitem-stdWrap2:

stdWrap2
--------

..  confval:: stdWrap2
    :name: tmenuitem-stdWrap2

    :Data type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`
    :Default: \|

    stdWrap to the total link text and :html:`<a>` tag. (Notice that the plain
    default value passed to the stdWrap function is "\|".)


..  _tmenuitem-altTarget:

altTarget
---------

..  confval:: altTarget
    :name: tmenuitem-altTarget

    :Data type: :ref:`data-type-target`

    Alternative target overriding the target property of the
    ref:`TMENU <tmenu>`, if set.


..  _tmenuitem-allStdWrap:

allStdWrap
----------

..  confval:: allStdWrap
    :name: tmenuitem-allStdWrap

    :Data type: :ref:`stdWrap <stdwrap>`

    stdWrap of the whole item.
