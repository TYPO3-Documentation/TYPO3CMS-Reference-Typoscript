.. include:: /Includes.rst.txt
.. index:: TMENU; TMENUITEM
.. _tmenuitem:

=========
TMENUITEM
=========

The current record is the page-record of the menu item. Now, if you would
like to get data from the current menu item's page record, use
stdWrap.data = field : [field name].

Properties
==========

allWrap
-------

..  confval:: allWrap
    :name: tmenuitem-allWrap
    :type: wrap /:ref:`stdWrap <stdwrap>`

    Wraps the whole item.

wrapItemAndSub
--------------

..  confval:: wrapItemAndSub
    :name: tmenuitem-wrapItemAndSub
    :type: wrap /:ref:`stdWrap <stdwrap>`

    Wraps the whole item and any submenu concatenated to it.

subst_elementUid
----------------

..  confval:: subst_elementUid
    :name: tmenuitem-subst-elementUid
    :type: boolean
    :Default: 0 (false)

     If set, all appearances of the string '{elementUid}' in the total
     element HTML code (after wrapped in .allWrap} are substituted with the
     uid number of the menu item.

     This is useful if you want to insert an identification code in the
     HTML in order to manipulate properties with JavaScript.

before
------

..  confval:: before
    :name: tmenuitem-before
    :type: HTML /:ref:`stdWrap <stdwrap>`

beforeWrap
----------

..  confval:: beforeWrap
    :name: tmenuitem-beforeWrap
    :type: wrap

    wrap around the ".before"-code

after
-----

..  confval:: after
    :name: tmenuitem-after
    :type: HTML /:ref:`stdWrap <stdwrap>`

afterWrap
---------

..  confval:: afterWrap
    :name: tmenuitem-afterWrap
    :type: wrap

    wrap around the ".after"-code

linkWrap
--------

..  confval:: linkWrap
    :name: tmenuitem-linkWrap
    :type: wrap

stdWrap
-------

..  confval:: stdWrap
    :name: tmenuitem-stdWrap
    :type: :ref:`stdWrap`

    stdWrap to the link-text

ATagBeforeWrap
--------------

..  confval:: ATagBeforeWrap
    :name: tmenuitem-ATagBeforeWrap
    :type: boolean
    :Default: 0 (false)

    If set, the link is first wrapped with "*.linkWrap*" and then the
    <A>-tag.

ATagParams
----------

..  confval:: ATagParams
    :name: tmenuitem-ATagParams
    :type: *<A>-params* /:ref:`stdWrap <stdwrap>`

    Additional parameters

    **Example:** :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        ATagParams = class="board"

ATagTitle
---------

..  confval:: ATagTitle
    :name: tmenuitem-ATagTitle
    :type: string /:ref:`stdWrap <stdwrap>`

    Allows you to specify the "title" attribute of the <a> tag around the
    menu item.

    **Example:** :

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        ATagTitle.field = abstract // description

    This would use the abstract or description field for the <a title="">
    attribute.

additionalParams
----------------

..  confval:: additionalParams
    :name: tmenuitem-additionalParams
    :type: string /:ref:`stdWrap <stdwrap>`

    Define parameters that are added to the end of the URL. This must be
    code ready to insert after the last parameter.

    For details, see typolink->additionalParams

doNotLinkIt
-----------

..  confval:: doNotLinkIt
    :name: tmenuitem-doNotLinkIt
    :type: boolean /:ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the link texts are not linked at all

doNotShowLink
-------------

..  confval:: doNotShowLink
    :name: tmenuitem-doNotShowLink
    :type: boolean /:ref:`stdWrap <stdwrap>`
    :Default: 0

    If set, the text will not be shown at all (smart with spacers).

stdWrap2
--------

..  confval:: stdWrap2
    :name: tmenuitem-stdWrap2
    :type: wrap /:ref:`stdWrap <stdwrap>`
    :Default: \|

    stdWrap to the total link-text and ATag. (Notice that the plain
    default value passed to the stdWrap function is "\|".)

altTarget
---------

..  confval:: altTarget
    :name: tmenuitem-altTarget
    :type: target

    Alternative target overriding the target property of the TMENU if set.

allStdWrap
----------

..  confval:: allStdWrap
    :name: tmenuitem-allStdWrap
    :type: ->stdWrap

    stdWrap of the whole item
