.. include:: /Includes.rst.txt
.. index:: Functions; makelinks
.. _makelinks:

=========
makelinks
=========

makelinks substitutes all appearances of web addresses or mail links
with a real link-tag. Web addresses and mail links must be contained in
the text in the following form:

.. code-block:: none

   https://example.org

   mailto:name@example.org


.. _makelinks-http-extTarget:

http.extTarget
==============

:aspect:`Property`
   http.extTarget

:aspect:`Data type`
   :ref:`data-type-target`

:aspect:`Description`
   The target of the link.

:aspect:`Default`
   \_top

.. _makelinks-http-wrap:

http.wrap
=========

:aspect:`Property`
   http.wrap

:aspect:`Data type`
   :ref:`data-type-wrap` / :ref:`stdwrap`

:aspect:`Description`
   Wrap around the link.

.. _makelinks-http-ATagBeforeWrap:

http.ATagBeforeWrap
===================

:aspect:`Property`
   http.ATagBeforeWrap

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, the link is first wrapped with :typoscript:`http.wrap` and then the
   :html:`<a>`-tag.

:aspect:`Default`
   0

.. _makelinks-http-keep:

http.keep
=========

:aspect:`Property`
   http.keep

:aspect:`Data type`
   list: "scheme","path","query"

:aspect:`Description`
   As default the link-text will be the full domain-name of the link.

:aspect:`Example`
   With the URL :samp:`https://example.org/test/doc.php?id=3` in our text we will
   get the following results:

   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      http.keep = "":                   # example.org
      http.keep = "scheme":             # https://example.org
      http.keep = "scheme,path":        # https://example.org/test/doc.php
      http.keep = "scheme,path,query":  # https://example.org/test/doc.php?id=3

.. _makelinks-http-ATagParams:

http.ATagParams
===============

:aspect:`Property`
   http.ATagParams

:aspect:`Data type`
   :ref:`data-type-tag-params` / :ref:`stdwrap`

:aspect:`Description`
   Additional parameters

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      http.ATagParams = class="board"

.. _makelinks-mailto.wrap:

mailto.wrap
===========

:aspect:`Property`
   mailto.wrap

:aspect:`Data type`
   :ref:`data-type-wrap` / :ref:`stdwrap`

:aspect:`Description`
   Wrap around the link.

.. _makelinks-mailto.ATagBeforeWrap:

mailto.ATagBeforeWrap
=====================

:aspect:`Property`
   mailto.ATagBeforeWrap

:aspect:`Data type`
   :ref:`data-type-boolean`

:aspect:`Description`
   If set, the link is first wrapped with mailto :typoscript:`wrap` and then the
   :html:`<a>`-tag.

:aspect:`Default`
   0

.. _makelinks-mailto.ATagParams:

mailto.ATagParams
=================

:aspect:`Property`
   mailto.ATagParams

:aspect:`Data type`
   :ref:`data-type-tag-params` / :ref:`stdwrap`

:aspect:`Description`
   Additional parameters

:aspect:`Example`
   .. code-block:: typoscript
      :caption: EXT:site_package/Configuration/TypoScript/setup.typoscript

      mailto.ATagParams = class="board"
