..  include:: /Includes.rst.txt
..  _appendix-a:

==================
PHP and TypoScript
==================

..  _content-object-renderer:

ContentObjectRenderer
=====================

..  _appendix-include-cobjgetsingle:

`ContentObjectRenderer::cObjGetSingle(value, properties[, TSkey = '__'])`
-------------------------------------------------------------------------

A method of :php:`TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer`.
Gets a content object from the `$conf` array.

Example:
~~~~~~~~

..  code-block:: php

    $content = $cObjectRenderer->cObjGetSingle($conf['image'], $conf['image.'], 'My Image 2');

This would return any IMAGE cObject at the property `image` of the
`$conf` array for the include script!


..  _appendix-include-stdwrap:

`ContentObjectRenderer::stdWrap(value, properties)`
---------------------------------------------------

A method of :php:`TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer`.

Hands the content in "value" to the stdWrap function, which will
process it according to the configuration of the array "properties".


Example:
~~~~~~~~

..  code-block:: php

    $content = $cObjectRenderer->stdWrap($content, $conf['stdWrap.']);

This will stdWrap the content with the properties of `.stdWrap` of the
`$conf` array!
