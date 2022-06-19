.. include:: /Includes.rst.txt
.. index::
   Functions; HTMLparser_tags
   HTMLparser_tags
.. _htmlparser-tags:

================
HTMLparser\_tags
================


.. index:: HTMLparser_tags; overrideAttribs
.. _htmlparser-tags-overrideattribs:

overrideAttribs
===============

:aspect:`Property`
   overrideAttribs

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   If set, this string is preset as the attributes of the tag.


.. index:: HTMLparser_tags; allowedAttribs
.. _htmlparser-tags-allowedattribs:

allowedAttribs
==============

:aspect:`Property`
   allowedAttribs

:aspect:`Data type`
   mixed

:aspect:`Description`
   Defines the allowed attributes.

   Possible values:

   0
      No attributes allowed.

   (comma-separated list of attributes)
      Only attributes in this list are allowed.

   (blank/not set)
      All attributes are allowed.


.. index:: HTMLparser_tags; fixAttrib.[attribute].set
.. _htmlparser-tags-fixattrib-attribute-set:

fixAttrib.[attribute].set
=========================

:aspect:`Property`
   fixAttrib.[attribute].set

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   Force the attribute value to this value.


.. index:: HTMLparser_tags; fixAttrib.[attribute].unset
.. _htmlparser-tags-fixattrib-attribute-unset:

fixAttrib.[attribute].unset
===========================

:aspect:`Property`
   fixAttrib.[attribute].unset

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, the attribute is unset.


.. index:: HTMLparser_tags; fixAttrib.[attribute].default
.. _htmlparser-tags-fixattrib-attribute-default:

fixAttrib.[attribute].default
=============================

:aspect:`Property`
   fixAttrib.[attribute].default

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   If no attribute exists by this name, this value is set as default
   value (if this value is not blank)


.. index:: HTMLparser_tags; fixAttrib.[attribute].always
.. _htmlparser-tags-fixattrib-attribute-always:

fixAttrib.[attribute].always
============================

:aspect:`Property`
   fixAttrib.[attribute].always

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, the attribute is always processed. Normally an attribute is
   processed only if it exists

:aspect:`Property`
   fixAttrib.[attribute].trim

   fixAttrib.[attribute].intval

   fixAttrib.[attribute].upper

   fixAttrib.[attribute].lower

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If any of these keys are set, the value is passed through the
   respective PHP-functions.


.. index:: HTMLparser_tags; fixAttrib.[attribute].range
.. _htmlparser-tags-fixattrib-attribute-range:

fixAttrib.[attribute].range
===========================

:aspect:`Property`
   fixAttrib.[attribute].range

:aspect:`Data type`
   [low],[high]

:aspect:`Description`
   Setting integer range.


.. index:: HTMLparser_tags; fixAttrib.[attribute].list
.. _htmlparser-tags-fixattrib-attribute-list:

fixAttrib.[attribute].list
==========================

:aspect:`Property`
   fixAttrib.[attribute].list

:aspect:`Data type`
   list of values, trimmed

:aspect:`Description`
   Attribute value must be in this list. If not, the value is set to the
   first element.


.. index:: HTMLparser_tags; fixAttrib.[attribute].removeIfFalse
.. _htmlparser-tags-fixattrib-attribute-removeiffalse:

fixAttrib.[attribute].removeIfFalse
===================================

:aspect:`Property`
   fixAttrib.[attribute].removeIfFalse

:aspect:`Data type`
   :ref:`data-type-boolean` / :typoscript:`blank` string

:aspect:`Description`
   If set, then the attribute is removed if it is false (= :typoscript:`0`).
   If this value is set to :typoscript:`blank` then the value must be a blank string
   (that means a "zero" value will not be removed).


.. index:: HTMLparser_tags; fixAttrib.[attribute].removeIfEquals
.. _htmlparser-tags-fixattrib-attribute-removeifequals:

fixAttrib.[attribute].removeIfEquals
====================================

:aspect:`Property`
   fixAttrib.[attribute].removeIfEquals

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   If the attribute value matches the value set here, then it is removed.


.. index:: HTMLparser_tags; fixAttrib.[attribute].casesensitiveComp
.. _htmlparser-tags-fixattrib-attribute-casesensitivecomp:

fixAttrib.[attribute].casesensitiveComp
=======================================

:aspect:`Property`
   fixAttrib.[attribute].casesensitiveComp

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, the comparison in :ref:`htmlparser-tags-fixattrib-attribute-removeifequals`
   and :ref:`htmlparser-tags-fixattrib-attribute-list` will be case-sensitive.
   At this point, it's insensitive.


.. index:: HTMLparser_tags; fixAttrib.[attribute].prefixLocalAnchors
.. _htmlparser-tags-fixattrib-attribute-prefixlocalanchors:

fixAttrib.[attribute].prefixLocalAnchors
========================================

:aspect:`Property`
   fixAttrib.[attribute].prefixLocalAnchors

:aspect:`Data type`
   :ref:`data-type-integer`

:aspect:`Description`
   If the first char is a "#" character (anchor of fx. :html:`<a>` tags) this
   will prefix either a relative or absolute path.

   :typoscript:`1`
      will get the absolute path
      (:php:`TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL')`).

   :typoscript:`2`
      will get the relative path (stripping of
      :php:`TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL')`).

:aspect:`Example`
   ::

      ...fixAttrib.href.prefixLocalAnchors = 1


.. index:: HTMLparser_tags; fixAttrib.[attribute].prefixRelPathWith
.. _htmlparser-tags-fixattrib-attribute-prefixrelpathwith:

fixAttrib.[attribute].prefixRelPathWith
=======================================

:aspect:`Property`
   fixAttrib.[attribute].prefixRelPathWith

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   If the value of the attribute seems to be a relative URL (no scheme
   like "http" and no "/" as first char) then the value of this property
   will be prefixed the attribute.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.parser.fixAttrib.src.prefixRelPathWith = https://example.org/typo3/32/dummy/


.. index:: HTMLparser_tags; fixAttrib.[attribute].userFunc
.. _htmlparser-tags-fixattrib-attribute-userfunc:

fixAttrib.[attribute].userFunc
==============================

:aspect:`Property`
   fixAttrib.[attribute].userFunc

:aspect:`Data type`
   :ref:`data-type-function-name`

:aspect:`Description`
   User function for processing of the attribute. The return value
   of this function will be used as the new tag value.

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.parser.fixAttrib.href.userFunc = \Vendor\ExtName\ClassName->function

   Two parameters are passed to the function:

   1. The tag value as a string or an array containing the tag value
      and additional configuration (see below).
   2. The reference the to HtmlParser instance that calls the method.

   By default the first parameter is the value of the processed tag.
   This changes when you pass additional configuration options to the
   user function:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      lib.parser.fixAttrib.href.userFunc.myCustomParm = myCustomValue

   In that case the first parameter passed to the user function will
   be an array containing these values:


.. index:: HTMLparser_tags; protect
.. _htmlparser-tags-protect:

protect
=======

:aspect:`Property`
   protect

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, the tag :html:`<>` is converted to :html:`&lt;` and :html:`&gt;`


.. index:: HTMLparser_tags; remap
.. _htmlparser-tags-remap:

remap
=====

:aspect:`Property`
   remap

:aspect:`Data type`
   :ref:`data-type-string`

:aspect:`Description`
   If set, the tagname is remapped to this tagname


.. index:: HTMLparser_tags; rmTagIfNoAttrib
.. _htmlparser-tags-rmtagifnoattrib:

rmTagIfNoAttrib
===============

:aspect:`Property`
   rmTagIfNoAttrib

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, then the tag is removed if no attributes happened to be there.


.. index:: HTMLparser_tags; nesting
.. _htmlparser-tags-nesting:

nesting
=======

:aspect:`Property`
   nesting

:aspect:`Data type`
   mixed

:aspect:`Description`
   If set true, then this tag must have starting and ending tags in the
   correct order. Any tags not in this order will be discarded. Thus
   :html:`</B><B><I></B></I></B>` will be converted to :html:`<B><I></B></I>`.

   Is the value "global" then true nesting in relation to other tags
   marked for "global" nesting control is preserved. This means that if
   :html:`<B>` and :html:`<I>` are set for global nesting then this string
   :html:`</B><B><I></B></I></B>` is converted to :html:`<B></B>`
