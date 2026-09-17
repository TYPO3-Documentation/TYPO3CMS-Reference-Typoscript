..  include:: /Includes.rst.txt
..  index:: Functions; tags
..  _tags:

====
tags
====

Used to create custom tags and define how they should be parsed. This
is used in conjunction with :ref:`parseFunc`.

The best known is the "link" tag, which is used to create links.

..  contents::
    :local:

..  index:: tags; Properties
..  _tags-properties:

Properties
==========

..  _tags-array:

*(array of strings)*
--------------------

..  confval:: array of strings
    :name: tags-array
    :type: :ref:`data-type-cobject`

    Every entry in the array of strings corresponds to a tag, that will
    be parsed. The elements **must** be in lowercase.

    Every entry must be set to a content object.

    :typoscript:`current` is set to the content of the tag, eg :html:`<TAG>content</TAG>`:
    here :typoscript:`current` is set to :typoscript:`content`. It can be used with
    :typoscript:`stdWrap.current = 1`.

    **Parameters:**

    Parameters of the tag are set in :php:`$cObj->parameters` (key is lowercased):

    ..  code-block:: html

        <TAG COLOR="red">content</TAG>

    This sets :php:`$cObj->parameters['color'] = 'red'`.

    :php:`$cObj->parameters['allParams']` is automatically set to the whole
    parameter-string of the tag. Here it is :html:`color="red"`

    **Special properties for each content object:**

    **[cObject].stripNL:** :ref:`data-type-boolean` option, which tells :typoscript:`parseFunc` that
    newlines before and after the content of the tag should be stripped.

    **[cObject].breakoutTypoTagContent:** :ref:`data-type-boolean` option, which tells
    :ref:`parseFunc` that this block of content is breaking up the nonTypoTag
    content and that the content after this must be re-wrapped.

    ..  rubric:: Examples

    ..  literalinclude:: _array.typoscript
        :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript

    This example would e.g. transform :html:`<BOLD>Important!</BOLD>`
    to :html:`<p style="font-weight: bold;">Important!</p>`.

..  _tags-examples:

Example
=======

This example creates 4 custom tags. The :html:`<LINK>`-, :html:`<TYPOLIST>`-,
:html:`<GRAFIX>`- and :html:`<PIC>`-tags:

:html:`<LINK>` is made into a typolink and provides an easy way of creating
links in text.

:html:`<TYPOLIST>` is used to create bullet-lists.

:html:`<GRAFIX>` will create an image file with 90x10 pixels where the text is
the content of the tag.

:html:`<PIC>` lets us place an image in the text. The content of the tag
should be the image-reference in :file:`fileadmin/images/`.

..  literalinclude:: _tags.typoscript
    :caption: EXT:site_package/Configuration/Sets/Main/setup.typoscript
