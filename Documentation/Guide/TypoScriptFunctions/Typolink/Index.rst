..  include:: /Includes.rst.txt

..  _guide-function-typolink:

========
typolink
========

:ref:`typolink <typolink>` is the TYPO3 CMS function
that allows us to generate all kinds of links.
If possible one should always use this function to generate links
as they will be processed by TYPO3 CMS. This is a prerequisite,
for example, for the anti-spam protection of email addresses.

Please resist the urge to a straight `<a href="...">...</a>` construct
in your TypoScript and Fluid templates.

Basically `typolink` links the specified text according to
the defined parameters. One example:

..  literalinclude:: _temp.link.typoscript

The example above will generate this HTML code:

..  code-block:: html

    <a href="http://www.example.com/" target="_blank" class="linkclass" rel="noreferrer">Example link</a>

`typolink`, in a way, almost works like a wrap: the content which is
defined for example by the `value` property, will be wrapped by the HTML anchor tag.
If no content is defined, it will be generated automatically. With a
link to a page, the page title will be used. With an external URL, the
URL will be shown.

The above example can actually be shortened, because the
`parameter` property can take a series of values separated
by a white space:

..  literalinclude:: _temp.link2.typoscript

The exact syntax for `parameter` property is fully described,
as usual, in the :ref:`TypoScript Reference <typolink>`.

It is even possible to define links that open in JavaScript popups:

..  literalinclude:: _temp.link3.typoscript
