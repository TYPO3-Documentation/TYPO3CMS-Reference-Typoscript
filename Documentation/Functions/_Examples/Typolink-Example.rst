:orphan:
..  include:: /Includes.rst.txt
..  index::
    Functions; typolink
    typolink

..  _typolink-userfunc-examples:

================================
Examples for `typolink.userFunc`
================================

Given this TypoScript example:

..  literalinclude:: ../_StdWrap/_UserFunc.typoscript
    :language: typoscript
    :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

This would first create a TypoLink :php:`LinkResultInterface` that would resolve to something like
:html:`<a href="/en/pages/4711?someKey=someValue" rel="noreferrer">My Link Title</a>`.

But because :typoscript:`userFunc = MyVendor\SitePackage\UserFunctions\TypoLinkUserFunc->createUserFuncLink`
is defined you can now manipulate the generated link to your liking.

The usual case would be to enrich the link with any kind of attributes, or also
to change existing ones:

..  literalinclude:: ../_StdWrap/_UserFuncSimple.php
    :language: php
    :caption: EXT:site_package/Classes/UserFunctions/TypoLinkUserFunc.php

This class would take the :php:`LinkResultInterface` object, enrich it with
attributes, pass it to a new immutable object and return that. Then this is what finally
gets emitted after full processing:

..  code-block:: html
    <a href="/en/pages/4711"
       target="_blank"
       title="Custom Title"
       rel="noreferrer">A replaced link</a>

Here is another example which uses more complex operations and also operates on the
linked URL:

..  literalinclude:: ../_StdWrap/_UserFunc.php
    :language: php
    :caption: EXT:site_package/Classes/UserFunctions/TypoLinkUserFunc.php

This class would take the :php:`LinkResultInterface` object, retrieve some data from it,
alter it, pass it to a new immutable object and return that. Then this is what finally
gets emitted after full processing:

..  code-block:: html
    <a href="/en/pages/4711/event/18"
       target="_blank"
       title="Custom: My Link Title"
       rel="noreferrer">Event Title #18</a>


You can also apply a custom :typoscript:`userFunc` to vital objects like the
:ref:`lib.parseFunc_RTE.userFunc <t3tsref:parsefunc-userFunc>`
routine. This would allow you to modify any kind of link generated from the
parsing of the Rich-Text-Editor (RTE), usually by adding CSS classes to it,
adjusting :html:`rel` attributes or attaching :html:`data-XXX` attributes.

