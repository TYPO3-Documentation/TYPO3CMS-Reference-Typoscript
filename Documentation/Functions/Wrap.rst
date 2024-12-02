..  include:: /Includes.rst.txt
..  _data-type-wrap:

====
Wrap
====

..  confval:: wrap
    :name: data-type-wrap

    :Syntax: <...> \| </...>

    Used to wrap something. The vertical bar ("|") is the place, where
    your content will be inserted; the parts on the left and right of the
    vertical line are placed on the left and right side of the content.

    Spaces between the wrap-parts and the divider ("|") are trimmed off
    from each part of the wrap.

    If you want to use more sophisticated data functions, then you
    should use `stdWrap.dataWrap` instead of `wrap`.

    A `wrap` is processed and rendered as the last of the other components of
    a cObject.

    ..  rubric:: Examples

    This will cause the value to be wrapped in a p-tag coloring the
    value red:

    ..  code-block:: typoscript
        :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

        page.10.wrap = <p class="bg-red"> | </p>
