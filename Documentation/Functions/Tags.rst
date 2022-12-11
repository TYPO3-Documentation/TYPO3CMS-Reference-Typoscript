.. include:: /Includes.rst.txt
.. index:: Functions; tags
.. _tags:

====
tags
====

Used to create custom tags and define how they should be parsed. This
is used in conjunction with :ref:`parseFunc`.

The best known is the "link" tag, which is used to create links.

.. contents::
   :local:

.. index:: tags; Properties
.. _tags-properties:

Properties
==========

*(array of strings)*
--------------------

..  t3-function-tags:: array of strings

    :Data type: :ref:`data-type-cobject`

    Every entry in the array of strings corresponds to a tag, that will
    be parsed. The elements **must** be in lowercase.

    Every entry must be set to a content object.

    :typoscript:`current` is set to the content of the tag, eg :html:`<TAG>content</TAG>`:
    here :typoscript:`current` is set to :typoscript:`content`. It can be used with
    :typoscript:`stdWrap.current = 1`.

    **Parameters:**

    Parameters of the tag are set in :php:`$cObj->parameters` (key is lowercased):

    .. code-block:: html

       <TAG COLOR="red">content</TAG>

    This sets :php:`$cObj->parameters['color'] = 'red'`.

    :php:`$cObj->parameters['allParams']` is automatically set to the whole
    parameter-string of the tag. Here it is :html:`color="red"`

    **Special properties for each content object:**

    **[cObject].stripNL:** :t3-data-type:`boolean` option, which tells :typoscript:`parseFunc` that
    newlines before and after the content of the tag should be stripped.

    **[cObject].breakoutTypoTagContent:** :t3-data-type:`boolean` option, which tells
    :ref:`parseFunc` that this block of content is breaking up the nonTypoTag
    content and that the content after this must be re-wrapped.

    .. rubric:: Examples

    .. code-block:: typoscript
       :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

       tags.bold = TEXT
       tags.bold {
           stdWrap.current = 1
           stdWrap.wrap = <p style="font-weight: bold;"> | </p>
       }
       tags.bold.stdWrap.stripNL = 1

    This example would e.g. transform :html:`<BOLD>Important!</BOLD>`
    to :html:`<p style="font-weight: bold;">Important!</p>`.

.. _tags-examples:

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

.. code-block:: typoscript
   :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

   tags {
       link = TEXT
       link {
           stdWrap.current = 1
           stdWrap.typolink.extTarget = _blank
           stdWrap.typolink.target = {$cLinkTagTarget}
           stdWrap.typolink.wrap = <p style="color: red;">|</p>
           stdWrap.typolink.parameter.data = parameters : allParams
       }

       typolist < tt_content.bullets.default.20
       typolist.trim = 1
       typolist.field >
       typolist.current = 1

       grafix = IMAGE
       grafix {
           file = GIFBUILDER
           file {
               XY = 90,10
               100 = TEXT
               100.text.current = 1
               100.offset = 5,10
           }
       }
       # Transforms <pic>file.png</pic> to <img src="fileadmin/images/file.png" >
       pic = IMAGE
       pic.file.import = fileadmin/images/
       pic.file.import.current = 1
   }
