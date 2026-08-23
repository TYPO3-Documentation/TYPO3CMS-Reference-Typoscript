..  include:: /Includes.rst.txt
..  index:: TMENU; TMENUITEM
..  _tmenuitem:

=========
TMENUITEM
=========

..  warning::
    This TypoScript object is still available to provide backward compatibility
    for old sites. When creating a new menu or refactoring an existing one
    always use the `menu data processor <https://docs.typo3.org/permalink/t3tsref:menuprocessor>`_
    and a Fluid template.

For examples on how to use the TMENUITEM please refer to old version of this
document, for example :ref:`TMENUITEM <t3tsref/11.5:tmenuitem>`-.

The current record is the page record of the menu item. If you would
like to get data from the current menu item's page record, use
:typoscript:`stdWrap.data = field : [field name]`.

..  _tmenuitem-properties:

Properties
==========

..  confval-menu::
    :display: table
    :type:
    :Default:

allWrap
-------


..  _tmenuitem-allWrap:

..  confval:: allWrap
    :name: tmenuitem-allWrap
    :type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    Wraps the whole item.

wrapItemAndSub
--------------



..  _tmenuitem-wrapItemAndSub:

..  confval:: wrapItemAndSub
    :name: tmenuitem-wrapItemAndSub
    :type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`

    Wraps the whole item and any submenu concatenated to it.

subst_elementUid
----------------



..  _tmenuitem-subst-elementUid:

..  confval:: subst_elementUid
    :name: tmenuitem-subst-elementUid
    :type: :ref:`data-type-boolean`
    :Default: 0 (false)

    If set, all appearances of the string '{elementUid}' in the HTML code of the
    element (after wrapped in :ref:`.allWrap <tmenuitem-allWrap>`) are
    substituted with the UID number of the menu item.

    This is useful, if you want to insert an identification code in the
    HTML in order to manipulate properties with JavaScript.

before
------



..  _tmenuitem-before:

..  confval:: before
    :name: tmenuitem-before
    :type: HTML / :ref:`stdWrap <stdwrap>`

beforeWrap
----------



..  _tmenuitem-beforeWrap:

..  confval:: beforeWrap
    :name: tmenuitem-beforeWrap
    :type: :ref:`data-type-wrap`

    Wrap around the :ref:`.before <tmenuitem-before>` code.

after
-----



..  _tmenuitem-after:

..  confval:: after
    :name: tmenuitem-after
    :type: HTML / :ref:`stdWrap <stdwrap>`

afterWrap
---------



..  _tmenuitem-afterWrap:

..  confval:: afterWrap
    :name: tmenuitem-afterWrap
    :type: :ref:`data-type-wrap`

    Wrap around the :ref:`.after <tmenuitem-after>` code.

linkWrap
--------



..  _tmenuitem-linkWrap:

..  confval:: linkWrap
    :name: tmenuitem-linkWrap
    :type: :ref:`data-type-wrap`

stdWrap
-------



..  _tmenuitem-stdWrap:

..  confval:: stdWrap
    :name: tmenuitem-stdWrap
    :type: :ref:`stdWrap`

    stdWrap to the link text.

ATagBeforeWrap
--------------



..  _tmenuitem-ATagBeforeWrap:

..  confval:: ATagBeforeWrap
    :name: tmenuitem-ATagBeforeWrap
    :type: :ref:`data-type-boolean`
    :Default: 0 (false)

    If set, the link is first wrapped with :ref:`*.linkWrap* <tmenuitem-linkWrap>`
    and then the :html:`<a>` tag.

ATagParams
----------



..  _tmenuitem-ATagParams:

..  confval:: ATagParams
    :name: tmenuitem-ATagParams
    :type: *<A>-params* / :ref:`stdWrap <stdwrap>`

    Additional parameters

ATagTitle
---------



..  _tmenuitem-ATagTitle:

..  confval:: ATagTitle
    :name: tmenuitem-ATagTitle
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Allows you to specify the "title" attribute of the :html:`<a>` tag around
    the menu item.

additionalParams
----------------



..  _tmenuitem-additionalParams:

..  confval:: additionalParams
    :name: tmenuitem-additionalParams
    :type: :ref:`data-type-string` / :ref:`stdWrap <stdwrap>`

    Define parameters that are added to the end of the URL. This must be
    code ready to insert after the last parameter.

    For details, see :ref:`typolink->additionalParams <typolink-additionalParams>`.

doNotLinkIt
-----------



..  _tmenuitem-doNotLinkIt:

..  confval:: doNotLinkIt
    :name: tmenuitem-doNotLinkIt
    :type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the link texts are not linked at all.

doNotShowLink
-------------



..  _tmenuitem-doNotShowLink:

..  confval:: doNotShowLink
    :name: tmenuitem-doNotShowLink
    :type: :ref:`data-type-boolean` / :ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the text will not be shown at all (smart with spacers).

stdWrap2
--------



..  _tmenuitem-stdWrap2:

..  confval:: stdWrap2
    :name: tmenuitem-stdWrap2
    :type: :ref:`data-type-wrap` / :ref:`stdWrap <stdwrap>`
    :Default: \|

    stdWrap to the total link text and :html:`<a>` tag. (Notice that the plain
    default value passed to the stdWrap function is "\|".)

altTarget
---------



..  _tmenuitem-altTarget:

..  confval:: altTarget
    :name: tmenuitem-altTarget
    :type: string

    Alternative target overriding the target property of the
    ref:`TMENU <tmenu>`, if set.

allStdWrap
----------



..  _tmenuitem-allStdWrap:

..  confval:: allStdWrap
    :name: tmenuitem-allStdWrap
    :type: :ref:`stdWrap <stdwrap>`

    stdWrap of the whole item.
